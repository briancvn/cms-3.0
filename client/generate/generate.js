const request = require('request');
const fs = require('fs');
const path = require('path');

const APP_DIR = 'src/App';
const SCSS_DIR = 'src/';
const HOST = 'http://dev.cms.com/cms/';

console.log('START GENERATE');
console.log('==================================================================');
function generate(startPath) {
    var files = fs.readdirSync(startPath);
    files.forEach((name) => {
        var filename = path.join(startPath, name);
        var stat = fs.lstatSync(filename);
        if (stat.isDirectory()){
            generate(filename);
        } else if (/Component.ts$/.test(filename)) {
            var replaceArr = [];
            var fileContent = Buffer.from(fs.readFileSync(filename, 'utf8')).toString();
            var match = fileContent.match(/templateUrl:\s+?\'(.*\/(\w+.html))\'(\s+?\,?)?/);
            var templateUrl = match && match[1];
            var htmlFileName = match && match[2];
            if (templateUrl && htmlFileName) {
                replaceArr.push({ source: templateUrl, destination: htmlFileName});
                loadHtmlFile(startPath+'/'+htmlFileName, templateUrl)
            }

            match = fileContent.match(/styleUrls:\s+?(\[.*\])(\s+?\,?)?/);
            var styleUrls = match && match[1];
            if (styleUrls) {
                replaceArr.push(...loadScssFiles(startPath, JSON.parse(styleUrls.replace(/\'/g, '"'))));
            }

            backupFile(filename, fileContent, ...replaceArr);
        };
    });
};

function backupFile(filename, data, ...replaces) {
    var backupFileName = filename.replace('.ts', '.bk');
    replaces.forEach(replace => data = data.replace(replace.source, replace.destination));
    fs.copyFile(filename, backupFileName, (err) => {
        if (err) throw err;

        fs.writeFile(filename, data, err => {
            if (err) throw err;
        });
    });
};

function loadHtmlFile(createfilePath, templateUrl) {
    var url = HOST+templateUrl;
    request(url, { json: false }, (error, request, body) => {
        if (error) throw error;
        process.stdout.write(`GET ${url}`);
        console.log(` ==> CREATE ${createfilePath}`);

        fs.appendFile(createfilePath, body, (err) => {
            if (err) throw err;
        });
    });
};

function loadScssFiles(startPath, filePathArr) {
    var replaceArr = [];
    filePathArr.forEach((filePath) => {
        var match = filePath.trim().match(/(.*\/(\w+.scss))/);
        var styleUrl = match && match[1];
        var styleFileName = match && match[2];
        if (styleUrl && styleFileName) {
            var stylePath = SCSS_DIR + styleUrl;
            var createfilePath = startPath+'/'+styleFileName;
            process.stdout.write(`GET ${stylePath}`);
            console.log(` ==> CREATE ${createfilePath}`);

            var styleContent = Buffer.from(fs.readFileSync(stylePath, 'utf8')).toString();
            if (!styleContent) throw new Error(`${stylePath} not exists`)
            
            replaceArr.push({ source: styleUrl, destination: styleFileName});
            fs.appendFile(createfilePath, styleContent, (err) => {
                if (err) throw err;
            });
        }                    
    });
    return replaceArr;
};

generate(APP_DIR);
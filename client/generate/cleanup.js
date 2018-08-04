const rimraf = require('rimraf');
const fs = require('fs');
const path = require('path');

const APP_DIR = 'src/App';
const REVERSE_OPTION = '--reverse';

function cleanup() {
    dropFileType('html');
    dropFileType('scss');

    if (process.argv.slice(2) && process.argv.slice(2)[0] === REVERSE_OPTION) {
        reverse(APP_DIR);
        return;
    }
    dropFileType('bk');
}

function dropFileType(type) {
    rimraf(`${APP_DIR}/**/*.${type}`, err => { if (err) throw err; });
}

function reverse(startPath) {
    var files = fs.readdirSync(startPath);
    files.forEach((name) => {
        var filename = path.join(startPath, name);
        var stat = fs.lstatSync(filename);
        if (stat.isDirectory()){
            generateHtml(filename);
        } else {
            var match = filename.match(/(.*).bk/);
            if (match) {
                let tsFile = `${match[1]}.ts`;
                process.stdout.write(`REVERSE ${tsFile}`);
                fs.unlinkSync(tsFile);
                console.log(` ==> REMOVE ${filename}`);
                fs.renameSync(filename, tsFile);
            } 
        };
    });
}

cleanup();
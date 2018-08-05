const rimraf = require('rimraf');
const fs = require('fs');
const path = require('path');

const APP_DIR = 'src/App';

function reverse() {
    dropFileType('html');
    dropFileType('scss');
    reverseHandler(APP_DIR);
}

function reverseHandler(startPath) {
    var files = fs.readdirSync(startPath);
    files.forEach((name) => {
        var filename = path.join(startPath, name);
        var stat = fs.lstatSync(filename);
        if (stat.isDirectory()){
            reverseHandler(filename);
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

function dropFileType(type) {
    rimraf(`${APP_DIR}/**/*.${type}`, err => { if (err) throw err; });
}

reverse();
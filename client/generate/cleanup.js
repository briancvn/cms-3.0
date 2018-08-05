const rimraf = require('rimraf');

const APP_DIR = 'src/App';

function cleanup() {
    dropFileType('html');
    dropFileType('scss');
    dropFileType('bk');
    rimraf('../../public/client', err => { if (err) throw err; });
}

function dropFileType(type) {
    rimraf(`${APP_DIR}/**/*.${type}`, err => { if (err) throw err; });
}

cleanup();
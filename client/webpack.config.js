const path = require('path');
const webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CopyWebpackPlugin = require("copy-webpack-plugin");
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const ForkTsCheckerWebpackPlugin = require('fork-ts-checker-webpack-plugin');
const ForkTsCheckerNotifierWebpackPlugin = require('fork-ts-checker-notifier-webpack-plugin');
const fs = require('fs');
const lodash = require('lodash');

const STYLE_DIR = 'src/Styles';
const EXCLUDE_STYLES = ['external.scss', 'variable.scss'];

function extendEntry(entry, startPath) {
    fs.readdirSync(startPath).forEach(name => {
        if (!lodash.includes(EXCLUDE_STYLES, name)) {
            var filename = path.join(startPath, name);
            var stat = fs.lstatSync(filename);
            if (stat.isDirectory()){
                extendEntry(entry, filename);
            } else {
                var styleSourcePath = `./${startPath}/${name}`.replace(/\\/g, '/');
                var match = styleSourcePath.match(/^.\/src\/(.*).scss$/);
                entry[match[1]] = styleSourcePath;
            }
        }
    })
    return entry;
}

module.exports = {
    mode: "development",
    entry: extendEntry({
        polyfills: './src/polyfills.ts',
        app: './src/main.ts',
        external: './src/Styles/external.scss',
        main: './src/main.scss'
    }, STYLE_DIR),
    resolve: {
        extensions: ['.ts','.js','.json'],
        unsafeCache: true
    },
    output: {
        filename: '[name].bundle.js',
        path: path.resolve(__dirname, 'dist')
    },
    devtool: 'source-map',
    module: {
        rules: [
            {
                test: /\.ts$/,
                loader: 'ts-loader',
                options: {
                    transpileOnly: true,
                    logLevel: "error"
                }
            },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract(['css-loader', 'sass-loader'])
            },
            {
                test: /\.(eot|woff|woff2|ttf|svg|png|jpg|gif|ico)$/,
                use: {
                    loader: 'url-loader',
                    options: {
                        limit: 3000,
                        fallback: 'file-loader',
                        name: 'Assets/[name]-[hash].[ext]'
                    }
                }
            },            
            {
                // Mark files inside `@angular/core` as using SystemJS style dynamic imports.
                // Removing this will cause deprecation warnings to appear.
                test: /[\/\\]@angular[\/\\]core[\/\\].+\.js$/,
                parser: { system: true }
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin('[name].css'),
        new ForkTsCheckerWebpackPlugin(),
        new ForkTsCheckerNotifierWebpackPlugin({ excludeWarnings: true }),
        new HtmlWebpackPlugin({
            template: 'src/index.html',
            inject: 'body'
        }),
        new CopyWebpackPlugin([ { from: 'src/Assets', to: 'Assets' } ]),
        new webpack.ContextReplacementPlugin(
            // The (\\|\/) piece accounts for path separators in *nix and Windows
            /angular(\\|\/)core(\\|\/)@angular/,
            path.resolve(__dirname, './src/App'), {}
        ),
        new webpack.DefinePlugin({
            ENVIRONMENT_VARIABLE_REPLACED_BY_WEBPACK_IS_DEBUG_MODE: true
        }),
        new webpack.DefinePlugin({ 'process.browser': true }),
        new webpack.HotModuleReplacementPlugin()
    ],
    devServer: {
        port: 4200,
        hot: true,
        proxy: {
            '/Api/**': {
                target: "http://dev.cms.com/cms",
                secure: false,
                changeOrigin: true,
            },
            '/Template/**': {
                target: "http://dev.cms.com/cms",
                secure: false,
                changeOrigin: true,
            },
            "/Styles/**": {
                target: "http://localhost:4200",
                secure: false,
                changeOrigin: true,
                bypass: (req, res, proxyOptions) => {
                    return `${req.url.toString()}`.replace('.scss', '.css');
                }
            }
        }
    },
    performance: {
        hints: false
    }
};
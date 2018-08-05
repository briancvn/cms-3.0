const path = require('path');
const webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CopyWebpackPlugin = require("copy-webpack-plugin");
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const ForkTsCheckerWebpackPlugin = require('fork-ts-checker-webpack-plugin');
const ForkTsCheckerNotifierWebpackPlugin = require('fork-ts-checker-notifier-webpack-plugin');
const autoprefixer = require('autoprefixer');

var extractPlugin = new ExtractTextPlugin({
    filename: 'main.css',
    allChunks: true
 });

module.exports = {
    mode: "development",
    entry: {
        polyfills: './src/polyfills.ts',
        app: './src/main.ts',
        main: './src/main.scss'
    },
    resolve: {
        extensions: ['.ts','.js','.json','.scss'],
        unsafeCache: true
    },
    output: {
        filename: '[name].bundle.js',
        path: path.resolve(__dirname, 'dist')
    },
    devtool: 'inline-source-map',
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
                test: /\.css$/,
                use: ['css-loader', 'postcss-loader'],
            },
            {
                test: /\.scss$/,
                use: extractPlugin.extract({  
                    fallback: "style-loader",
                    use: [
                        { loader: 'css-loader', options: { importLoaders: 2, sourceMap: true }},
                        { loader: 'postcss-loader', options: { sourceMap: true, plugins: () => [autoprefixer] }},
                        { loader: 'sass-loader', options: { sourceMap: true }}
                    ]
                }) 
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
        new ExtractTextPlugin("[name].scss"),
        new ForkTsCheckerWebpackPlugin(),
        new ForkTsCheckerNotifierWebpackPlugin({ excludeWarnings: true }),
        new HtmlWebpackPlugin({
            template: 'src/index.html',
            inject: 'body',
            title: 'CMS-Development'
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
        extractPlugin
    ],
    devServer: {
        port: 4200,
        disableHostCheck: true,
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
                    return `/Assets${req.url.toString()}`;
                }
            }
        }
    },
    performance: {
        hints: false
    }
};
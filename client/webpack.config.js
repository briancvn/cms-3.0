const path = require('path');
var webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CopyWebpackPlugin = require("copy-webpack-plugin");
const cssLoader = {
    loader: 'css-loader',
    options: { minimize: false }
}

module.exports = {
    mode: "development",
    entry: {
        polyfills: './src/polyfills.ts',
        app: './src/main.ts'
    },
    resolve: {
        extensions: ['.ts','.js','.json'],
        unsafeCache: true
    },
    devtool: 'inline-source-map',
    plugins: [
        new CleanWebpackPlugin(['dist']),
        new HtmlWebpackPlugin({
            template: 'src/index.html',
            inject: 'body',
            title: 'Development'
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
        new webpack.DefinePlugin({
            'process.browser': true
        })
    ],
    output: {
        filename: '[name].bundle.js',
        path: path.resolve(__dirname, 'dist')
    },
    devServer: {
        port: 4200,
        contentBase: path.join(__dirname, 'dist'),
        compress: true,
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
                bypass: function(req, res, proxyOptions) {
                    return "/Assets" + req.url.toString();
                }
            }
        }
    },
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
                use: [MiniCssExtractPlugin.loader, cssLoader, 'postcss-loader'],
            },
            {
                test: /\.scss$/,
                use: [MiniCssExtractPlugin.loader, cssLoader, 'postcss-loader', 'sass-loader'],
            },
            {
                // Mark files inside `@angular/core` as using SystemJS style dynamic imports.
                // Removing this will cause deprecation warnings to appear.
                test: /[\/\\]@angular[\/\\]core[\/\\].+\.js$/,
                parser: { system: true }
            }
        ]
    },
    performance: {
        hints: false
    }
};
/**
 * 2007-2020 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
 const path = require('path');
 const webpack = require('webpack');
 const MiniCssExtractPlugin = require("mini-css-extract-plugin");
 
 module.exports = {
   mode: 'development',
   
   entry: {
     index: './_dev/module.ts',
     front: './_dev/front.ts',
     print: './_dev/print.js',
    },
   output: {
     path: path.resolve(__dirname, 'public'),
     filename: '[name].module.js',
     clean: true
   },
   devtool: 'inline-source-map',
   module: {
    rules: [
        {
            test: /\.css$/i,
            use: [
                {
                  loader: MiniCssExtractPlugin.loader,
                },
                {
                    loader: 'css-loader',
                    options: {
                      sourceMap: true,
                    },
                },
            ],
        },
        {
            test: /\.scss$/i,
            use: [
                {
                  loader: MiniCssExtractPlugin.loader,
                },
                {
                    loader: 'css-loader',
                    options: {
                      sourceMap: true,
                    },
                },
                {
                    loader: 'postcss-loader',
                    options: {
                      sourceMap: true,
                    },
                },
                {
                    loader: 'sass-loader',
                    options: {
                      sourceMap: true,
                    },
                },
            ],
        },
        {
            test: /\.(graphql|gql)$/,
            exclude: /node_modules/,
            loader: 'graphql-tag/loader',
        },
        {
            test: /\.(png|svg|jpg|jpeg|gif)$/i,
            type: 'asset/resource',
        },
        {
            test: /\.(woff|woff2|eot|ttf|otf)$/i,
            type: 'asset/resource'
        },
        {
            test: /\.js$/,
            use: [
                {
                    loader: 'esbuild-loader'
                }
            ],
        },
        {
            test: /\.ts?$/,
            loader: 'esbuild-loader',
            options: {
              loader: 'ts',
              target: 'es2015',
            },
            exclude: /node_modules/,
        }
    ]
   },
   plugins: [
    new MiniCssExtractPlugin({filename: '[name].css'}),
   ],
   resolve: {
    extensions: ['.tsx', '.ts', '.js']
   }
 };
 
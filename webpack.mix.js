const mix = require('laravel-mix');
const path = require('path');

var dir = __dirname;
var name = dir.split(path.sep).pop();

var assetPath = __dirname + '/Resources/assets';
var publicPath = 'module-assets/';

mix.webpackConfig({
  resolve: {
    alias: {
      'Block': path.resolve(assetPath + '/js/components', './Block'),
    }
  }
});

//Javascript
mix.js(assetPath + '/js/app.js', publicPath + name+'.js');

//Css
mix.sass(assetPath + '/sass/app.scss', publicPath + name+'.css');
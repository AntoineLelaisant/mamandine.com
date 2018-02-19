var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .addStyleEntry('css/bootstrap.min', './assets/css/bootstrap.min.css')
;

module.exports = Encore.getWebpackConfig();

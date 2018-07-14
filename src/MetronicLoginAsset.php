<?php
namespace evondu\metronic;

use yii\web\AssetBundle;

class MetronicLoginAsset extends AssetBundle //需要继承AssetBundle类
{
    public $sourcePath = '@evondu/metronic/assets';
    public $css = [
        "http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all",
        "metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css",
        "metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css",
        "metronic/assets/global/plugins/uniform/css/uniform.default.css",
        "metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css",
        "metronic/assets/global/plugins/uniform/css/uniform.default.css",
        "metronic/assets/global/css/components.min.css",
        "metronic/assets/global/css/plugins.min.css",
        "metronic/assets/pages/css/login.min.css",
    ];
    public $js = [
        "metronic/assets/global/plugins/jquery.min.js",
        "metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js",
        "metronic/assets/global/plugins/jquery.blockui.min.js",
        "metronic/assets/global/plugins/uniform/jquery.uniform.min.js",
        "metronic/assets/global/scripts/app.min.js",
        "metronic/assets/pages/scripts/login.min.js",
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',         //依赖Bootstrap
        'yii\bootstrap\BootstrapPluginAsset',   //依赖BootstrapJs
        'yii\web\JqueryAsset',                  //依赖jquery
    ];
}
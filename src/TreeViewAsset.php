<?php
namespace evondu\metronic;

use yii\web\AssetBundle;

class TreeViewAsset extends AssetBundle //需要继承AssetBundle类
{
    public $sourcePath = '@metronic/assets';
    public $css = [
        "global/plugins/jstree/dist/themes/default/style.min.css",
    ];
    public $js = [
        "global/plugins/jstree/dist/jstree.min.js",
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',         //依赖Bootstrap
        'yii\bootstrap\BootstrapPluginAsset',   //依赖BootstrapJs
        'yii\web\JqueryAsset',                  //依赖jquery
        'metronic\MetronicAsset'
    ];
}
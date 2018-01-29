<?php
namespace evondu\metronic;

use yii\web\AssetBundle;

class SummernoteAsset extends AssetBundle //需要继承AssetBundle类
{
    public $sourcePath = '@metronic/assets';
    public $css = [
        "http://oq6uyj3ku.bkt.clouddn.com/admin_templet/metronic/assets/global/plugins/bootstrap-summernote/summernote.css",
    ];
    public $js = [
        "http://oq6uyj3ku.bkt.clouddn.com/admin_templet/metronic/assets/global/plugins/bootstrap-summernote/summernote.min.js"
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',         //依赖Bootstrap
        'yii\bootstrap\BootstrapPluginAsset',   //依赖BootstrapJs
        'yii\web\JqueryAsset',                  //依赖jquery
        'metronic\MetronicAsset'
    ];
}
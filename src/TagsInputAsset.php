<?php
namespace evondu\metronic;

use yii\web\AssetBundle;

class TagsInputAsset extends AssetBundle
{
    public $sourcePath = '@evondu/metronic/assets';
    public $css = [
        "http://oq6uyj3ku.bkt.clouddn.com/admin_templet/metronic/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css",
    ];
    public $js = [
        "http://oq6uyj3ku.bkt.clouddn.com/admin_templet/metronic/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js",
        "http://oq6uyj3ku.bkt.clouddn.com/admin_templet/metronic/assets/pages/scripts/components-bootstrap-tagsinput.min.js",
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\JqueryAsset',
        'evondu\metronic\MetronicAsset'
    ];
}
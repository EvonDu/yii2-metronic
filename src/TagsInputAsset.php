<?php
namespace evondu\metronic;

use yii\web\AssetBundle;

class TagsInputAsset extends AssetBundle
{
    public $sourcePath = '@evondu/metronic/assets';
    public $css = [
        "global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css",
    ];
    public $js = [
        "global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js",
        "pages/scripts/components-bootstrap-tagsinput.min.js",
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\JqueryAsset',
        'evondu\metronic\MetronicAsset'
    ];
}
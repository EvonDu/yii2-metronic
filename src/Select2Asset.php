<?php
namespace evondu\metronic;

use yii\web\AssetBundle;

class Select2Asset extends AssetBundle
{
    public $sourcePath = '@evondu/metronic/assets';
    public $css = [
        "global/plugins/select2/css/select2.min.css",
        "global/plugins/select2/css/select2-bootstrap.min.css",
    ];
    public $js = [
        "global/plugins/select2/js/select2.full.min.js",
        "pages/scripts/components-select2.min.js",
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\JqueryAsset',
        'evondu\metronic\MetronicAsset'
    ];
}
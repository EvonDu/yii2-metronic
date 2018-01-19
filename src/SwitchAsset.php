<?php
namespace evondu\metronic;

use yii\web\AssetBundle;

class SwitchAsset extends AssetBundle
{
    public $sourcePath = '@evondu/metronic/assets';
    public $css = [
        "global/plugins/bootstrap-switch/css/bootstrap-switch.min.css",
    ];
    public $js = [
        "global/plugins/bootstrap-switch/js/bootstrap-switch.min.js",
        "pages/scripts/components-bootstrap-switch.min.js",
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\JqueryAsset',
        'evondu\metronic\MetronicAsset'
    ];
}
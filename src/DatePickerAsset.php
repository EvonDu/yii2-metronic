<?php
namespace evondu\metronic;

use yii\web\AssetBundle;

class DatePickerAsset extends AssetBundle
{
    public $sourcePath = '@evondu/metronic/assets';
    public $css = [
        "global/plugins/datatables/datatables.min.css",
        "global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css",
        "global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css",
        "global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css",
    ];
    public $js = [
        "global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js",
        "global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js",
        "global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js",
        "pages/scripts/components-date-time-pickers.min.js",
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\JqueryAsset',
        'evondu\metronic\MetronicAsset'
    ];
}
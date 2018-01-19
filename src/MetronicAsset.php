<?php
namespace evondu\metronic;

use yii\web\AssetBundle;

class MetronicAsset extends AssetBundle
{
    public $sourcePath = '@evondu/metronic/assets';
    public $css = [
        //"http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all",
        //文字图标库
        "global/plugins/simple-line-icons/simple-line-icons.min.css",
        "global/plugins/font-awesome/css/font-awesome.min.css",
        //加载
        "global/plugins/uniform/css/uniform.default.css",
        "global/plugins/bootstrap-switch/css/bootstrap-switch.min.css",
        "global/css/components.min.css",
        "global/css/plugins.min.css",
        "layouts/layout/css/layout.min.css",
        "layouts/layout/css/themes/darkblue.min.css",
        "layouts/layout/css/custom.min.css",
        //弹窗
        "global/plugins/bootstrap-modal/css/bootstrap-modal.css",
        "global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css",
        //表格
        "global/plugins/datatables/datatables.min.css",
        //调整
        'other/css/main'
    ];
    public $js = [
        //加载
        "global/plugins/js.cookie.min.js",
        "global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js",
        "global/plugins/jquery.blockui.min.js",
        "global/plugins/uniform/jquery.uniform.min.js",
        "global/plugins/bootstrap-switch/js/bootstrap-switch.min.js",
        "global/scripts/app.min.js",
        "layouts/global/scripts/quick-sidebar.min.js",
        "layouts/layout/scripts/layout.min.js",
        "layouts/layout/scripts/demo.min.js",
        "global/scripts/app.min.js",
        "global/plugins/jquery-slimscroll/jquery.slimscroll.min.js",
        //弹窗
        "global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js",
        "global/plugins/bootstrap-modal/js/bootstrap-modal.js",
        //调整
        'other/js/nav'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\JqueryAsset',
    ];
}
<?php
namespace evondu\metronic;

use yii\web\AssetBundle;

class MetronicAsset extends AssetBundle
{
    public $sourcePath = '@evondu/metronic/assets';
    public $css = [
        //调整
        'css/main.css',

        //文字图标库
        //"http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all",
        "metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css",
        "metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css",

        //布局
        "metronic/assets/global/css/components.min.css",
        "metronic/assets/global/css/plugins.min.css",
        "metronic/assets/layouts/layout/css/layout.min.css",
        "metronic/assets/layouts/layout/css/themes/darkblue.min.css",
        "metronic/assets/layouts/layout/css/custom.min.css",

        //弹窗
        "metronic/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css",
        //"http://oq6uyj3ku.bkt.clouddn.com/admin_templet/metronic/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css",

        //表格
        "metronic/assets/global/plugins/datatables/datatables.min.css",
    ];
    public $js = [
        //导航
        'js/nav.js',
        'js/jquery-compatibility.js',

        //布局
        "metronic/assets/global/scripts/app.min.js",
        "metronic/assets/layouts/global/scripts/quick-sidebar.min.js",
        "metronic/assets/layouts/layout/scripts/layout.min.js",
        "metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js",

        //弹窗
        "metronic/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js",
        "metronic/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js",
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\JqueryAsset',
    ];
}
<?php
namespace evondu\metronic\widgets;

use yii\base\Widget;
use evondu\metronic\MetronicAsset;

class MetronicWidget extends Widget
{
    //color
    const COLOR_DEFAULT = "default";
    const COLOR_RED = "red";
    const COLOR_BLUE = "blue";
    const COLOR_GREEN = "green";
    const COLOR_YELLOW = "yellow";
    const COLOR_PURPLE = "purple";
    const COLOR_DARK = "dark";
    const COLOR_RED_MINT = "red-mint";
    const COLOR_BLUE_HOKI = "blue-hoki";
    const COLOR_GREEN_HAZE = "green-haze";
    const COLOR_YELLOW_MINT = "yellow-mint";
    const COLOR_PURPLE_MINT = "purple-sharp";
    const COLOR_GREY_MINT = "grey-mint";
    //size
    const SIZE_NORMAL = "norm";
    const SIZE_SMALL = "sm";
    const SIZE_LARGE = "lg";
    const SIZE_EXTRA_SMALL = 'xs';
    //bootstrap class
    const CLASS_INFO = "info";
    const CLASS_DANGER = "danger";
    const CLASS_DEFAULT = "default";
    const CLASS_PRIMARY = "primary";
    const CLASS_WARNING = "warning";
    const CLASS_SUCCESS = "success";
    //has
    const HAS_INFO = "has-info";
    const HAS_ERROR = "has-error";
    const HAS_WARNING = "has-warning";
    const HAS_SUCCESS = "has-success";

    public function run()
    {
        //加载必须资源包ImagesInputAsset资源包
        MetronicAsset::register($this->view);

        //调用父类初始化方法
        parent::run(); // TODO: Change the autogenerated stub
    }

    public function getFontColor($color){
        return "font-".$color;
    }
}
?>
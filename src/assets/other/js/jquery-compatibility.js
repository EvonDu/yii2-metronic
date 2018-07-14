//由于高版本去除了size方法，所以重新定义回来以补偿
$.fn.size=function(){
    return $(this).length;
}
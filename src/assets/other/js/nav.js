$(function(){
    //获取当前url
    var url = window.location.href;

    //遍历判断
    $(".nav-item a").each(function(){
        //获取Url
        var item_url = $(this).attr("href");

        //执行正则表达式
        var reg_exp = '^[\\w\\W]*'+item_url;
        //console.log(reg_exp);
        reg_exp = reg_exp.replace("?","\\?");
        if(reg_exp == "") return true;
        var reg = RegExp(reg_exp);
        if(reg.test(url)){
            $(this).closest("li").addClass("active");
            $(this).closest(".nav-item").find(".arrow").addClass("open");
            $(this).closest(".page-sidebar-menu > .nav-item").addClass("start active open");
            $(this).closest(".page-sidebar-menu > .nav-item").find(".arrow").addClass("open");
            return false;
        }
    })

    //附加二次遍历（只精确到控制器）
    $(".nav-item a").each(function(){
        //获取Url
        var item_url = $(this).attr("href");

        //获取上一级目录URL
        item_url = item_url.replace("%2F","/");
        var item_purl_index = item_url.lastIndexOf("/");
        var item_purl = item_url.slice(0,item_purl_index);

        //执行正则表达式
        //var reg_exp = "^"+item_url;
        var reg_exp = '^[\\w\\W]*'+item_purl;//对比上一级目录
        reg_exp = reg_exp.replace("?","\\?");
        if(reg_exp == "") return true;
        var reg = RegExp(reg_exp);
        if(reg.test(url)){
            $(this).closest(".page-sidebar-menu > .nav-item").addClass("start active open");
            $(this).closest(".page-sidebar-menu > .nav-item").find(".arrow").addClass("open");
            return false;
        }
    })
})
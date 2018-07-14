<?php
namespace evondu\metronic\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/*
use evondu\metronic\widgets\Portlet;
<?php Portlet::begin([
    // 窗口类型：
    // TYPE_BOXED：盒型
    // TYPE_LIGHT：线条型，默认
    "type"=>Portlet::TYPE_LIGHT,
    // 窗口颜色，盒型时生效
    "Color"=>Portlet::COLOR_BLUE
    // 标题文字颜色，线条型时生效
    "fontColor"=>Portlet::COLOR_DARK,
    "title"=>$this->title,
    // 标题旁的帮助信息，只在线条型时生效
    "helper"=>"标题帮助信息",
    "icon"=>'icon-user',
    // 12删栏中占的删栏数
    "col"=>12,
    // 标题是否加粗
    "bold"=>true,
    // 是否显示边框，只在线条型时生效
    "bordered"=>true,
    // 是否显示工具条
    "showTools"=>false,
    // 是否显示全屏按钮
    "showFullscreen"=>true,
    // 动作条按钮配置，可用配置/内容两种方式设置
    'actions'=> [
        Html::button("Edit",["class"=>"btn btn-circle btn-default"]),
        ["url"=>['infoupdate', 'id' => $model->user_id], "icon"=>'icon-pencil']
    ]
]);?>
echo 'Body portlet';
<?php Portlet::end();?>
 */
class Portlet extends MetronicWidget
{
    //Const
    const TYPE_BOXED="boxed";
    const TYPE_LIGHT="light";
    //CommonParam
    public $type = self::TYPE_LIGHT;
    public $title = "TITLE PORTLET";
    public $icon = "icon-user";
    public $col = 12;
    public $actions = [];
    public $showTools = false;
    public $showFullscreen = true;
    //BoxedParam
    public $color = self::COLOR_BLUE;
    //LightParam
    public $helper = "";
    public $bold = true;
    public $bordered = true;
    public $fontColor = self::COLOR_DARK;

    public function init()
    {
        //调用父类初始化方法
        parent::init();

        //默认设置
        $actionOptions = ["icon"=>"icon-pencil", "url"=>'', "text"=>""];
        if(!empty($this->actions)){
            foreach ($this->actions as $key => $value){
                //只有数组才补全配置
                if(is_array($this->actions[$key]))
                    $this->actions[$key] = ArrayHelper::merge($actionOptions,$this->actions[$key]);
            }
        }

        //缓冲文档,用于获取begin和end中的内容
        ob_start();
    }

    public function run()
    {
        //执行父函数，并解除文档缓存
        parent::run();
        $content = ob_get_clean();

        //获取Portlet
        switch ($this->type){
            case self::TYPE_LIGHT:
                $portlet = $this->renderLightPortlet($content);
                break;
            case self::TYPE_BOXED:
                $portlet = $this->renderBoxedPortlet($content);
                break;
            default:
                $portlet = $this->renderBoxedPortlet($content);
        }

        //添加col-md
        if(!empty($this->col))
            $portlet = Html::tag("div",$portlet,['class'=>"col-md-$this->col"]);

        //返回
        echo $portlet;
    }

    protected function renderBoxedPortlet($content){
        $options = ["class"=>'portlet'];
        Html::addCssClass($options,"box");
        Html::addCssClass($options,$this->color);

        $title = $this->renderBoxedTitle();
        $body = Html::tag("div",$content,["class"=>"portlet-body"]);
        $portlet = Html::tag("div","$title\n$body",$options);

        return $portlet;
    }

    protected function renderBoxedTitle(){
        $icon = Html::tag("i","",['class'=>$this->icon]);
        $text = Html::tag("span",$this->title);
        $caption = Html::tag("div","$icon\n$text",["class"=>"caption"]);
        $tools = $this->showTools?$this->renderTools():"";
        $actions = $this->renderActions();
        $title = Html::tag("div","$caption\n$tools\n$actions",["class"=>"portlet-title"]);
        return $title;
    }

    protected function renderLightPortlet($content){
        $options = ["class"=>'portlet'];
        Html::addCssClass($options,"light");
        Html::addCssClass($options,"bordered");

        $title = $this->renderLightTitle();
        $body = Html::tag("div",$content,["class"=>"portlet-body"]);
        $portlet = Html::tag("div","$title\n$body",$options);

        return $portlet;
    }

    protected function renderLightTitle(){
        $subjectOptons = ["class"=>"caption-subject uppercase"];
        Html::addCssClass($subjectOptons,$this->getFontColor($this->fontColor));
        if($this->bold)
            Html::addCssClass($subjectOptons,"bold");
        $iconOptions = ['class'=>$this->icon];
        Html::addCssClass($iconOptions,$this->getFontColor($this->fontColor));


        $lines[] = Html::beginTag("div",["class"=>"portlet-title"]);
        $icon = Html::tag("i","",$iconOptions);
        $subject = Html::tag("span",$this->title,$subjectOptons);
        $helper = Html::tag("span",$this->helper,["class"=>"caption-helper"]);
        $caption = Html::tag("div","$icon\n$subject\n$helper",["class"=>"caption"]);
        $tools = $this->showTools?$this->renderTools():"";
        $actions = $this->renderActions();
        $title = Html::tag("div","$caption\n$tools\n$actions",["class"=>"portlet-title"]);
        return $title;
    }

    protected function renderTools(){
        $contents[] = Html::a("", "javascript:;", ['class' => "collapse","data-original-title"=>"","title"=>""]);
        $contents[] = Html::a("", "javascript:;", ['class' => "fullscreen","data-original-title"=>"","title"=>""]);
        $contents[] = Html::a("", "javascript:;", ['class' => "reload","data-original-title"=>"","title"=>""]);
        $contents[] = Html::a("", "javascript:;", ['class' => "remove","data-original-title"=>"","title"=>""]);
        $tools = Html::tag("div",implode("\n",$contents),["class"=>"tools"]);
        return $tools;
    }

    protected function renderActions(){
        //按钮组
        foreach($this->actions as $action){
            if(is_array($action)){
                $button = Button::widget([
                    'tag'=>Button::TAG_A,
                    'iconOnly' => empty($action["text"])?true:false,
                    'icon'=>isset($action["icon"])?$action["icon"]:'',
                    'text'=>isset($action["text"])?$action["text"]:'',
                    'size'=>Button::SIZE_SMALL,
                    'circle'=>true,
                    'color'=>isset($action["color"])?$action["color"]:Button::COLOR_DEFAULT,
                    'url'=>isset($action["url"])?$action["url"]:'',
                    'options'=>isset($action["options"])?$action["options"]:[],
                ]);

                $contents[] = $button;
            }
            else{
                $contents[] = $action;
            }
        }

        //全屏按钮
        if($this->type == self::TYPE_LIGHT && $this->showTools == false && $this->showFullscreen == true) {
            $contents[] = Html::a("", "javascript:;", ['class' => "btn btn-circle btn-icon-only btn-default fullscreen"]);
        }

        $actions = Html::tag("div",implode("\n",$contents),["class"=>"actions"]);
        return $actions;
    }
}
?>
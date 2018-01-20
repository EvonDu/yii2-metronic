<?php
namespace evondu\metronic\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/*
use evondu\metronic\widgets\TimeLine;
<?= TimeLine::widget([
    'items' => [
        [
            //项icon，当存在images时会覆盖掉icon
            'icon'=>"icon-docs",
            'image'=>"",
            'title'=>"Title",
            'time'=>"2018-18-18 11:11:11",
            'content'=>"Content",
            //颜色类型，有：TYPE_M_BLUE、TYPE_M_GREEN、TYPE_M_RED
            'type'=>TimeLine::TYPE_M_BLUE,
            //下拉按钮的设置
            'actionsOptions'=>[
                'content'=>'Actions',
                'class'=>'btn-circle blue',
                'items'=>[
                    ['content'=>'action', 'url'=>'']
                ]
            ],
        ]
    ],
    //是否使用白色背景
    'whiteBg' => 'false'
]);
 */
class TimeLine extends MetronicWidget
{
    /**
     * const
     */
    const TYPE_M_RED = 'red';
    const TYPE_M_BLUE = 'blue';
    const TYPE_M_GREEN = 'green';

    /**
     * @var array
     */
    public $items = [];
    public $whiteBg = false;

    /**
     * init
     */
	public function init(){
        //调用父类初始化方法
	    parent::init();

        //默认设置
        $options = [
            'icon'=>"icon-user",
            'image'=>"",
            'title'=>"Title",
            'time'=>"2018-18-18 11:11:11",
            'content'=>"Content",
            'type'=>self::TYPE_M_BLUE,
            'actionsOptions'=>[
                'content'=>'Actions',
                'class'=>'btn-circle blue',
                'items'=>[]
            ]
        ];
        $actionsItem = [
            'content'=>'Action',
            'url'=>''
        ];
		foreach($this->items as $key=>$value){
            $this->items[$key] = ArrayHelper::merge($options,$this->items[$key]);
            if(!empty($this->items[$key]["actionsOptions"]['items'])){
                foreach ($this->items[$key]["actionsOptions"]['items'] as $key2=>$value2){
                    $this->items[$key]["actionsOptions"]['items'][$key2] = ArrayHelper::merge($actionsItem,$this->items[$key]["actionsOptions"]['items'][$key2]);
                }
            }
		}
	}

    /**
     * run
     */
    public function run()
    {
        //Items
        $items = [];
        foreach($this->items as $itemOptions){
            $items[] = $this->renderItem($itemOptions);
        }

        //TimeLine
        $timelineOptions = ['class'=>"timeline"];
        if($this->whiteBg)
            Html::addCssClass($timelineOptions,"white-bg");
        $timeline = Html::tag("div",implode("\n",$items),$timelineOptions);
        return $timeline;
    }

    /**
     * @param $options
     * @param $type
     * @return mixed
     */
    protected function addTypeClass($options,$type){
        switch($type){
            case self::TYPE_M_BLUE:{
                Html::addCssClass($options,"font-green-haze");
                break;
            }
            case self::TYPE_M_GREEN:{
                Html::addCssClass($options,"font-blue-madison");
                break;
            }
            case self::TYPE_M_RED:{
                Html::addCssClass($options,"font-red-intense");
                break;
            }
            default:{
                Html::addCssClass($options,"font-green-haze");
                break;
            }
        }
        return $options;
    }

    /**
     * @param $options
     * @return array
     */
	protected function renderItem($options){
        $badg = $this->renderItemBadge($options);
        $body = $this->renderItemBody($options);
        $item = Html::tag("div","$badg\n$body",['class'=>"timeline-item"]);
        return $item;
	}

    /**
     * @param $options
     * @return array
     */
	protected function renderItemBadge($options){
        //Image或Icon
        if(empty($options["image"])){
            $iconOptions = ['class'=>$options["icon"]];
            $iconOptions = $this->addTypeClass($iconOptions, $options["type"]);
            $icon = Html::tag("i","",$iconOptions);
            $content = Html::tag("div",$icon,['class'=>"timeline-icon"]);
        }else{
            $content = Html::img($options["image"],['class' => 'timeline-badge-userpic']);
        }
        //Badge
        $badge = Html::tag("div","$content",['class'=>"timeline-badge"]);
        return $badge;
    }

    /**
     * @param $options
     * @return array
     */
    protected function renderItemBody($options)
    {
       	//arrow
        $arrow = Html::tag("div","",['class'=>'timeline-body-arrow']);
        //header
        $caption = $this->renderItemCaption($options);
        $actions = $this->renderItemActions($options["actionsOptions"]);
        $header = Html::tag("div","$caption\n$actions",['class'=>"timeline-body-head"]);
        //content
        $span = Html::tag("span",$options["content"],['class'=>"font-grey-cascade"]);
        $content = Html::tag("div",$span,['class'=>"timeline-body-content"]);

        //body
        $body = Html::tag("div","$arrow\n$header\n$content",['class'=>"timeline-body"]);
        return $body;
    }

    /**
     * @param $options
     * @return string
     */
    protected function renderItemCaption($options){
        $titleOptions = ['class'=>'timeline-body-alerttitle'];
        $titleOptions = $this->addTypeClass($titleOptions,$options["type"]);

        $title = Html::tag("span",$options["title"],$titleOptions);
        $time = Html::tag("span",$options["time"],['class'=>'timeline-body-time font-grey-cascade']);
        $caption = Html::tag("div","$title\n$time",['class'=>"timeline-body-head-caption"]);
        return $caption;
    }

    /**
     * @param $options
     * @return array
     */
    protected function renderItemActions($options){
        //Content
        $content = "";
        if(!empty($options["items"])) {
            //BUTTON
            $buttonOptions = [
                'class' => 'btn btn-sm dropdown-toggle',
                'type' => 'button',
                "data-toggle" => "dropdown",
                "data-hover" => "dropdown",
                "data-close-others" => "true"];
            Html::addCssClass($buttonOptions, $options["class"]);
            $button = Html::Button($options["content"] . "&nbsp<i class='fa fa-angle-down'></i>", $buttonOptions);

            //UL
            $li = array();
            foreach ($options["items"] as $action) {
                $a = Html::a($action["content"], $action["url"]);
                $li[] = Html::tag("li", $a);
            }
            $ul = Html::tag("ul", implode("\n", $li), ['class' => 'dropdown-menu pull-right', 'role' => 'menu']);

            //GROUP
            $content = Html::tag("div", "$button\n$ul", ['class' => "btn-group"]);
        }

        //Actions
        $actions = Html::tag("div",$content,['class'=>"timeline-body-head-actions"]);
        return $actions;
    }
}
?>
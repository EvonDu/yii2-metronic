<?php
namespace evondu\metronic\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/*
use evondu\metronic\widgets\Step;
<?= Step::widget([
    // Step 类型（显示样式）
    // 1、TYPE_LINE：线型，默认
    // 2、TYPE_DEFAULT、TYPE_BACKGROUND、TYPE_NO_BACKGROUND：普通型，分无背景和黑背景
    // 3、TYPE_THIN、TYPE_BACKGROUND_THIN、TYPE_NO_BACKGROUND_THIN：细条型，分无背景和黑背景
    'type'=>Step::TYPE_LINE,
    // 每个步骤的配置，Status的取值：
    // STATUS_ACTIVE：正在进行的步骤
    // STATUS_DONE：已经完成的步骤
    // STATUS_ERROR：错误的步骤
    'items'=>[
        ['title'=>'Step1','content'=>'step1','status'=>Step::STATUS_ACTIVE],
        ['title'=>'Step2','content'=>'step2','status'=>Step::STATUS_ACTIVE],
        ['title'=>'Step3','content'=>'step3']],
    // 是否使用黑色背景
    'bgDark'=>false,
    // 步骤描述配置，可忽略
    'desc'=>[
        'title'=>'Title',
        'content'=>'desc content'
    ]
])?>
*/
class Step extends MetronicWidget
{
    //TYPE
    const TYPE_DEFAULT = "default";
    const TYPE_THIN = "thin";
    const TYPE_BACKGROUND = "background";
    const TYPE_BACKGROUND_THIN = "background-thin";
    const TYPE_NO_BACKGROUND = "no-background";
    const TYPE_NO_BACKGROUND_THIN = "no-background-thin";
    const TYPE_LINE = "line";
    //STATUS
    const STATUS_DEFAULT = "default";
    const STATUS_ACTIVE = "active";
    const STATUS_ERROR = "error";
    const STATUS_DONE = "done";

    //PARAM
    public $type = self::TYPE_LINE;
    public $bgDark = false;
    public $items = [];
    public $desc = [];
    //SETTING
    private $count = 1;
    private $size = 12;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        //设置默认值
        $this->count = count($this->items);
        $this->size = (int)(12/$this->count);
        $defaultItem = [
            'icon'=>'',
            'title'=>'Title',
            'content'=>'step content',
            'status'=>self::STATUS_DEFAULT
        ];
        foreach ($this->items as $key=>$value){
            $this->items[$key] = ArrayHelper::merge($defaultItem,$this->items[$key]);
        }
        $defaultDesc = [
            "title"=>"",
            "content"=>""
        ];
        $this->desc = ArrayHelper::merge($defaultDesc,$this->desc);
    }

    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub

        //items
        $items = array();
        foreach($this->items as $index=>$item){
            $items[] = $this->renderItem($index,$item);
        }

        //desc
        $desc = $this->renderDesc();

        //line
        $line = $this->renderLine("$desc\n".implode("\n",$items));

        //step
        $step = $this->renderStep($line);

        //return
        return $step;
    }

    protected function renderDesc(){
        if(empty($this->desc["title"]) && empty($this->desc["content"]))
            return '';

        $titleOptions = ['class'=>'bold uppercase'];
        if($this->bgDark)
            Html::addCssClass($titleOptions,"font-white");
        else
            Html::addCssClass($titleOptions,"font-dark");

        $title = Html::tag("div",$this->desc["title"],$titleOptions);
        $content = Html::tag("div",$this->desc["content"],["class"=>"caption-desc font-grey-cascade"]);
        $br = Html::tag("br","");
        $desc = Html::tag("div","$title\n$content\n$br",['class'=>'mt-step-desc']);
        return $desc;
    }

    protected function renderStep($content){
        $stepOptions = ["class"=>"mt-element-step"];
        if($this->bgDark)
            Html::addCssClass($stepOptions,"bg-dark");

        $step = Html::tag("div",$content,$stepOptions);
        return $step;
    }

    protected function renderLine($content){
        $lineOptions = ["class"=>"row"];
        switch ($this->type){
            case self::TYPE_THIN:{
                Html::addCssClass($lineOptions,"step-thin");
                break;
            }
            case self::TYPE_NO_BACKGROUND:{
                Html::addCssClass($lineOptions,"step-no-background");
                break;
            }
            case self::TYPE_NO_BACKGROUND_THIN:{
                Html::addCssClass($lineOptions,"step-no-background-thin");
                break;
            }
            case self::TYPE_BACKGROUND:{
                Html::addCssClass($lineOptions,"step-background");
                break;
            }
            case self::TYPE_BACKGROUND_THIN:{
                Html::addCssClass($lineOptions,"step-background-thin");
                break;
            }
            case self::TYPE_LINE:{
                Html::addCssClass($lineOptions,"step-line");
                break;
            }
            default:{
                Html::addCssClass($lineOptions,"step-default");
                break;
            }
        }
        $line = Html::tag("div",$content,$lineOptions);

        return $line;
    }

    protected function renderItem($index,$item){
        $itemsOptions = ["class"=>"col-md-$this->size mt-step-col"];
        $numberOptions = ["class"=>"mt-step-number"];
        $titleOptions = ["class"=>"mt-step-title uppercase font-grey-cascade"];
        $contentOptions = ["class"=>"mt-step-content font-grey-cascade"];

        //DEFAULT
        if($this->type == self::TYPE_DEFAULT || $this->type == self::TYPE_THIN){
            Html::addCssClass($itemsOptions,"bg-grey");
            Html::addCssClass($numberOptions,"font-grey");
            if($this->bgDark)
                Html::addCssClass($numberOptions,"bg-dark");
            else
                Html::addCssClass($numberOptions,"bg-white");
        }
        //NO_BACKGROUND
        if($this->type == self::TYPE_NO_BACKGROUND || $this->type == self::TYPE_NO_BACKGROUND_THIN){
            Html::addCssClass($numberOptions,"font-grey-cascade");
        }
        //BACKGROUND
        if($this->type == self::TYPE_BACKGROUND || $this->type == self::TYPE_BACKGROUND_THIN){
            Html::addCssClass($itemsOptions,"bg-grey-steel");
        }
        //LINE
        if($this->type == self::TYPE_LINE){
            Html::addCssClass($numberOptions,"font-grey");
            if($this->bgDark)
                Html::addCssClass($numberOptions,"bg-dark");
            else
                Html::addCssClass($numberOptions,"bg-white");
        }
        //ORDER
        if($index == 0)
            Html::addCssClass($itemsOptions,"first");
        //LAST
        if(($index + 1) == $this->count)
            Html::addCssClass($itemsOptions,"last");
        //STATUS
        switch ($item["status"]){
            case self::STATUS_ACTIVE:
                Html::addCssClass($itemsOptions,"active");
                break;
            case self::STATUS_ERROR:
                Html::addCssClass($itemsOptions,"error");
                break;
            case self::STATUS_DONE:
                Html::addCssClass($itemsOptions,"done");
        }

        if(empty($item["icon"])){
            $number = Html::tag("div",$index+1,$numberOptions);
        }
        else{
            Html::addCssStyle($numberOptions,"padding:12px 18px; margin-top: -8px;");
            $icon = Html::tag("i","",["class"=>$item["icon"]]);
            $number = Html::tag("div",$icon,$numberOptions);
        }

        $title = Html::tag("div",$item["title"],$titleOptions);
        $content = Html::tag("div",$item["content"],$contentOptions);
        $item = Html::tag("div","$number\n$title\n$content",$itemsOptions);

        return $item;
    }
}
?>
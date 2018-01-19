<?php
namespace evondu\metronic\widgets;

use yii\helpers\Html;
use yii\widgets\ActiveForm AS YiiActiveForm;

class SearchBar extends MetronicWidget
{
    //参数
    public $model;                                   //绑定模型
    public $field;                                   //绑定字段
    public $formOptions=['method' => 'get',];        //FORM设置
    private $searchName;

    public function run()
    {
        //获取查询名
        $this->searchName = pathinfo($this->model->className(),PATHINFO_BASENAME);

        //输出代码
        echo Html::beginTag("div",["class"=>"row"]);
        echo Html::beginTag("div",["class"=>"col-md-4 col-sm-4"]);
        $form = YiiActiveForm::begin($this->formOptions);
        echo Html::beginTag("div",["class"=>"input-group"]);
        echo $form->field($this->model, $this->field,['template' => "{input}"])->input('text',['class'=>'form-control','placeholder'=>$this->model->getAttributeLabel($this->field)]);
        $submit = Html::submitButton('<i class="fa fa-search"></i>',['class' => 'btn blue']);
        echo Html::tag("span",$submit,["class"=>"input-group-btn"]);
        echo Html::endTag("div");
        YiiActiveForm::end();
        echo Html::endTag("div");
        echo Html::endTag("div");
    }
}
?>
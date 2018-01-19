<?php
namespace evondu\metronic\widgets;

use yii\helpers\Html;

class SearchTable extends MetronicWidget
{
    //参数
    public $model;                    //绑定模型
    public $fields;                   //绑定字段

    public function run()
    {
        $form = ActiveForm::begin(['method' => 'get', 'type'=> ActiveForm::TYPE_INLINE]);
        foreach($this->fields as $field){
            echo $form->field($this->model, $field,["template"=>"{input}"])
                ->input('text',[
                    'class'=>'form-control',
                    "style"=>"margin-top:1px;margin-bottom:1px",
                    "placeholder"=>$this->model->getAttributeLabel($field)
                ]);
        }
        echo Html::submitButton('<i class="fa fa-search"></i>',['class' => 'btn blue']);
        ActiveForm::end();
    }
}
?>
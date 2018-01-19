<?php
namespace evondu\metronic\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use evondu\metronic\field\CheckboxList;
use evondu\metronic\field\DatePicker;
use evondu\metronic\field\BootstrapSwitch;
use evondu\metronic\field\Select2;
use evondu\metronic\field\TagsInput;

class ActiveField extends \yii\widgets\ActiveField {
    /**
     * @param array $items
     * @param array $options
     * @return $this
     */
    public function checkboxList($items, $options = [])
    {
        $options = array_merge($options, ['items'=>$items,'model' => $this->model, 'attribute' => $this->attribute]);
        $this->parts['{input}'] = CheckboxList::widget($options);
        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function datePicker($options = []){
        $options = array_merge($options, ['model' => $this->model, 'attribute' => $this->attribute]);
        $this->parts['{input}'] = DatePicker::widget($options);
        return $this;
    }

    /**
     * @param $items
     * @param array $options
     * @return $this
     */
    public function select2($items, $options = []){
        $options = array_merge($options, ['items'=>$items,'model' => $this->model, 'attribute' => $this->attribute]);
        $this->parts['{input}'] = Select2::widget($options);
        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function bootstrapSwitch($options = []){
        $options = array_merge($options, ['model' => $this->model, 'attribute' => $this->attribute]);
        $this->parts['{input}'] = BootstrapSwitch::widget($options);
        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function tagsInput($options = []){
        $options = array_merge($options, ['model' => $this->model, 'attribute' => $this->attribute]);
        $this->parts['{input}'] = TagsInput::widget($options);
        return $this;
    }
}

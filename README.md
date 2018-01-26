# Yii2-Metronic
这是一个基于[Metronic v4.5.2](http://www.keenthemes.com/)的Yii2组件/小部件库。使用时需要先加载好Metronic的js和css资源。

## 安装
```
composer install evondu/yii2-metronic
```

## 使用方法
#### 1、GrdiView
使用方法与原本YII2中的一样，其主要是修改了样式和布局，使它符合Metronic风格。
```
<!-- Use -->
<?php use evondu\metronic\widgets\ActiveForm;?>

<!-- GridView -->
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'name',
        ['class' => 'evondu\metronic\widgets\ActionColumn'],
    ],
]); ?>
```

#### 2、ActiveForm
主要在YII2基础上，增加了表单布局类型(Horizontal、Vertical、Inline)和提供更多ActiveField类型。
```
<!-- Use -->
<?php use evondu\metronic\widgets\ActiveForm;?>

<!-- ActiveForm -->
<?php $form = ActiveForm::begin([
    // 布局类型，参考Bootstrap：TYPE_HORIZONTAL、TYPE_VERTICAL、TYPE_INLINE
    "type"=>ActiveForm::TYPE_INLINE,
    // Separated风格：项分割线
    "separated"=>false,
    // Stripped风格：颜色相间
    "stripped"=>true,
    // Bordered风格：网格型
    "bordered"=>true,
    // 表单操作栏设置，即提交按钮等
    'buttons' => [
        Html::submit("Save",['class'=>'btn']),
        Html::button("Back",['class'=>'btn']),
    ]
]); ?>
<?php ActiveForm::end(); ?>
```

##### 2.1、DatePicker
DatePicker日期输入组件：
```
<!-- Use -->
<?php use evondu\metronic\widgets\ActiveForm;?>

<!-- ActiveForm -->
<?php $form = ActiveForm::begin([]);?>

<!-- DatePicker-->
<?= $form->field($model,"username")->datePicker([
    // 时间格式
    "format" => "yyyy-mm-dd",
    "readonly "=>false,
    // 是否为建议样式，即不是InputGroup
    "simple"=>false,
    // 为InputGroup时的样式配置
    "buttonOptions" => [
        "icon"=>"fa fa-calendar",
        "color"=>\evondu\metronic\widgets\Button::COLOR_DEFAULT
    ]
])?>

<?php ActiveForm::end([]); ?>
```

##### 2.2、Select2
Select2下拉表单组件：
```
<!-- Use -->
<?php use evondu\metronic\widgets\ActiveForm;?>

<!-- ActiveForm -->
<?php $form = ActiveForm::begin([]);?>

<!-- Select2 -->
<?= $form->field($model,"name")->select2(
    //下拉框的选项，支持二级
    [
        "CA"=>"California",
        "NV"=>"Nevada",
        "OR"=>"Oregon",
        "WA"=>"Washington",
        "Mountain Time Zone"=>[
            "AZ"=>"Arizona",
            "CO"=>"Colorado",
            "ID"=>"Idaho",
        ]
    ],
    //配置项
    [
        //是否多选
        "multiple" => false
    ]
)?>

<?php ActiveForm::end([]); ?>
```

##### 2.3、TagsInput
TagsInput标签输入组件：
```
<!-- Use -->
<?php use evondu\metronic\widgets\ActiveForm;?>

<!-- ActiveForm -->
<?php $form = ActiveForm::begin([]);?>

<!-- TagsInput -->
<?= $form->field($model,"tags")->tagsInput([])?>

<?php ActiveForm::end([]); ?>
```

##### 2.4、Switch
Switch滑动开关组件：
```
<!-- Use -->
<?php 
    use evondu\metronic\widgets\ActiveForm;
    use evondu\metronic\field\BootstrapSwitch;
?>

<!-- ActiveForm -->
<?php $form = ActiveForm::begin([]);?>

//Switch
<?= $form->field($model,"username")->bootstrapSwitch([
    // 按钮颜色设置
    "onColor"=>BootstrapSwitch::CLASS_PRIMARY,
    "offColor"=>BootstrapSwitch::CLASS_DEFAULT,
    // 设置大小
    "size"=>BootstrapSwitch::SIZE_NORMAL,
    // 是否可输入
    "readonly"=>false,
    // 按钮内容设置
    "onText"=>"ON",
    "offText"=>"OFF"
])?>

<?php ActiveForm::end([]); ?>
```

##### 2.5、checkboxList
主要调整了相关样式成符合Metronic风格：
```
<!-- Use -->
<?php 
    use evondu\metronic\widgets\ActiveForm;
    use evondu\metronic\field\CheckboxList;
?>

<!-- ActiveForm -->
<?php $form = ActiveForm::begin([]);?>

<!-- CheckboxList -->
<?= $form->field($model,"roles")->checkboxList(
    //选项
    [
        "CA"=>"California",
        "NV"=>"Nevada",
        "OR"=>"Oregon",
    ],
    //配置
    [
        // 类型：
        // TYPE_LIST：列显示
        // TYPE_INLINE：行显示
        'type'=>CheckboxList:TYPE_LIST
    ]
)?>

<?php ActiveForm::end([]); ?>
```

##### 2.5、other
用于支持其他自定义的widget作为表单组件，需要设置对应的Widget类名和其配置（配置中已隐含了models和attribute），使用例子
```
<?= $form->field($model, 'photo')->other('common\widgets\fileinput\ImageInput', [
    //外部widgets的配置(已经隐含了models和attribute)
    'template'=>'{input}',
    'uploadPath'=>yii\helpers\Url::to(['/helpers/file/upload-base64']),
    'uploadType'=>'base64'
]) ?>
```

#### 3、Portlet（窗口）
窗口部件，使用前需要先导入`evondu\metronic\widgets\Portlet`，使用例子：
```
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
```

#### 4、Button（按钮）
按钮部件，使用前需要先导入`evondu\metronic\widgets\Button`，使用例子：
```
<?= Button::widget([
    // tag类型，支持a、submit、button(默认)
    'tag'=>Button::TAG_A,
    // tag为TAG_A时，的url地址
    'url'=>['create'],
    'text'=>'SUCCESS',
    'icon'=>'fa fa-plus',
    'color'=>Button::COLOR_GREEN,
    'size'=>Button::SIZE_NORMAL,
    // 是否加粗
    'sbold'=>true,
    // 是否使用描边样式
    'outline'=>false,
    // 是否可用
    'disabled'=>true,
    // 是否使用圆角
    'circle'=>false,
    // 是否为icon按钮
    'iconOnly'=>false,
    // 是否使用Bootstrap样式
    'bootstrap'=>false,
    // Bootstrap样式时生效，用于指定类型：info、danger、primary、warning、success
    'type'=>Button::TYPE_PRIMARY
])?>
```

#### 5、Badge（徽章）
徽章部件，使用前需要先导入`evondu\metronic\widgets\Badge`，使用例子：
```
<?= Badge::widget([
    'text'=>'SUCCESS',
    // 类型：info、danger、primary、warning、success
    'class'=>Badge::TYPE_SUCCESS,
    // 是否为label型
    'label'=>false,
    // 是否使用方形
    'round'=>false
])?>
```

#### 6、ProgressBar（进度条）
进度部件，使用前需要先导入`evondu\metronic\widgets\ProgressBar`，使用例子：
```
<?= ProgressBar::widget([
    // 进度值：1-100
    'value'=>20,
    // 显示样式：
    // THEME_BASIC：默认样式
    // THEME_STRIPED：条纹样式
    // TYPE_ANIMATED：带动画条纹样式
    'theme'=>ProgressBar::TYPE_ANIMATED
    // 类型：info、danger、primary、success、warning
    'class'=>ProgressBar::CLASS_SUCCESS,
    // 是否显示文字进度
    'showText'=>true
    // 是否存在下部外边距
    'marginBottom'=>true
])?>
```


#### 7、Setp（步骤）
步骤部件，使用前需要先导入`evondu\metronic\widgets\Step`，使用例子：
```
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
```


#### 8、TimeLine（时间线）
时间线部件，使用前需要先导入`evondu\metronic\widgets\TimeLine`，使用例子：
```
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
```
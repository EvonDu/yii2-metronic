<?php
namespace metronic\widgets;

use evondu\metronic\TreeViewAsset;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/*
use evondu\metronic\widgets\TreeView;
<?= TreeView::widget([
    //选填，可以自动生成
    "id"=>"tree",
    //是否有checkbox
    "checkbox"=>false,
    //有checkbox时生效，配置input的name属性
    "checkboxName"=>'tree',
    //是否为wholerow样式
    "wholerow" => false,
    //是否关联父级子级选择，即勾选父级自动勾选所有子级
    "threeState" => true,
    //是否选择后的显示背景颜色
    "keepSelectedStyle" => true,
    //数据选项
    "items"=>[
        [ "id" => "ajson1", "parent" => "#", "text" => "Simple root node" ,"data"=>"11" ,"icon"=>"fa fa-briefcase icon-state-success"],
        [ "id" => "ajson2", "parent" => "#", "text" => "Root node 2" ,"data"=>"12"],
        [ "id" => "ajson3", "parent" => "ajson1", "text" => "Child 1" ,"data"=>"13"],
        [ "id" => "ajson4", "parent" => "ajson1", "text" => "Child 2" ,"data"=>"14"],
    ]
])?>
 */
class TreeView extends MetronicWidget
{
    public $id = "";
    public $items = [];
    public $checkbox = false;
    public $checkboxName = "";
    public $wholerow = false;
    public $keepSelectedStyle = true;
    public $threeState = true;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        //加载资源
        TreeViewAsset::register($this->view);

        //获取ID
        if(empty($this->id))
            $this->id = uniqid();
    }

    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub

        //构建树
        $tree = $this->registerTree();
        echo $tree;

        //输出JS
        $this->registerJs();
    }

    public function registerTree(){
        //构建树
        $tree = Html::tag("div","",["id"=>$this->id]);

        //构建值栏
        $inputs = $this->checkbox?Html::tag("div","",["class"=>"tree-inputs"]):"";

        //主体
        $body = Html::tag("div","$tree\n$inputs",["role"=>'tree-view']);

        return $body;
    }

    public function registerJs(){
        $view = $this->getView();

        //配置
        $options = (object)array(
            "plugins"=>[]
        );
        if($this->checkbox){
            $options->plugins[] = "checkbox";
            $options->checkbox = [
                'keep_selected_style' => $this->keepSelectedStyle,
                'three_state' => $this->threeState,
                'cascade' => ''
            ];
        }
        if($this->wholerow){
            $options->plugins[] = "wholerow";
        }

        //加载数据
        $options->core = (object)array(
            "data"=>$this->items,
            "themes"=>(object)array(
                "responsive"=>!1
            )
        );

        //初始化JS
        $view->registerJs(
            "$('#$this->id').jstree(".json_encode($options).");"
        );

        //取值JS
        if($this->checkbox){
            $checkbox_name = empty($this->checkboxName)?"":$this->checkboxName."[]";
            $view->registerJs(
                "
            $('#$this->id').on(\"changed.jstree\", function (e, data) {
                var inputs = $(this).siblings(\".tree-inputs\");
                if(inputs){
                    inputs.empty();
                    for(var i = 0; i < data.selected.length; i++) {
                        var id = data.selected[i];
                        var node = data.instance.get_node(id);
                        var value = node.data;
                        if(value){
                            var input = document.createElement(\"input\");
                            $(input).attr(\"type\",\"hidden\");
                            $(input).attr(\"name\",\"$checkbox_name\")
                            $(input).val(value);
                            $(inputs).append(input);
                        }
                    }
                }
            });
            "
            );
        }
    }
}
?>
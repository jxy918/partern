<?php
/**
 *  项目分成三组每个组需要接受增删改的命令
 */ 

abstract class Group {
    /* 甲乙双方分开办公，你要和那个讨论，先找到哪个组 */
    public abstract function find();
    
    /* 被要求增加功能 */
    public abstract function add();
    
    /* 被要求删除功能 */
    public abstract function delete();
    
    /* 被要求修改功能 */
    public abstract function change();
    
    /* 被要求给出所有变更计划 */
    public abstract function plan();     

}

/**
 * 需求组的职责是和客服谈需求，这个组的人应该都是业务领域专家
 */
class RequirementGroup extends Group {
    
    /* 客户要求组过去谈 */
    public function find() {
        var_dump('找到需求组');
    }
    
    /* 客户要求增加一项需求 */
    public function add() {
        var_dump('客户要求增加一项需求');
    }
    
    /* 客户要求修改一项需求 */
    public function change() {
        var_dump('客户要求修改一项需求');
    }
    
    /* 客户要求删除一项需求 */
    public function delete() {
        var_dump('客户要求删除一项需求');
    }
    
    /* 客户要求出变更计划 */
    public function plan() {
        var_dump('客户要求需求变更计划');
    }
}

/**
 * 美工组的职责就是设计一套漂亮，简单，便捷的界面
 */ 

class PageGroup extends Group {

    /* 首先找到美工组，要不谁跟你谈啊 */
    public function find() {
        var_dump('找到美工组...');
    }
    
    /* 美工被要求增加一个页面 */
    public function add() {
        var_dump('客户要求增加一个页面...');
    }
    
    /* 客户要求现有界面做修改 */
    public function change() {
        var_dump('客户要求修改一个页面...');
    }
    
    /* 甲方是老大，要求删除一些页面 */
    public function delete() {
        var_dump('客户要求删除一个页面...');
    }
    
    /* 所有的增删改，那都需要出计划的啊 */
    public function plan() {
        var_dump('客户要求页面变更计划');
    }
} 

/**
 * 代码组的职责是实现业务逻辑，当然包过数据库设计
 */
class CodeGroup extends Group {

    /* 首先找到美工组，要不谁跟你谈啊 */
    public function find() {
        var_dump('找到代码组...');
    }
    
    /* 美工被要求增加一个页面 */
    public function add() {
        var_dump('客户要求增加一个功能...');
    }
    
    /* 客户要求现有界面做修改 */
    public function change() {
        var_dump('客户要求修改一个功能...');
    }
    
    /* 甲方是老大，要求删除一些页面 */
    public function delete() {
        var_dump('客户要求删除一个功能...');
    }
    
    /* 所有的增删改，那都需要出计划的啊 */
    public function plan() {
        var_dump('客户要求功能变更计划...');
    }
} 

/* 客户就是甲方，给我们钱的一方，是老大 */
$rg = new RequirementGroup();
$rg->find();   //找到需求组
$rg->add();    //增加一个需求
$rg->plan();   //需求变更计划
var_dump('******************1********************');

$pg = new PageGroup();
$pg->find();    //找到美工组
$pg->delete();  //删除一个页面
$pg->plan();    //页面变更计划

var_dump('******************2********************');

/* 计划变更，需要执行什么命令，找特定人处理，不要一个组处理 */

/**
 *  命令的抽象类, 把客户发出去的命令定义成一个一个的对象
 */  
abstract class Command {

    //把三个组定义好，子类可以直接使用
    protected $rg = null;
    protected $pg = null;
    protected $cg = null;
    public function __construct() {
        $this->rg = new RequirementGroup();
        $this->pg = new PageGroup();
        $this->cg = new CodeGroup();
    }
    
    //定义一个执行方法,你要我坐什么事情
    public abstract function execute();
}

/**
 *  增加一项需求
 */ 

class AddRequirementCommand extends Command {    
    //执行增加一项需求的命令
    public function execute() { 
        $this->rg->find();   //找到需求组
        $this->rg->add();    //增加一份需求
        
        $this->pg->add();    //增加页面
        $this->cg->add();    //增加代码功能
        
        $this->rg->plan();   //给出计划
        

    }
}

/**
 *  删除一个页面的命令
 */ 
 
class DeletePageCommand extends Command {
    
    //删除一个页面的需求
    public function execute() {
        $this->pg->find();
        $this->pg->delete();
        $this->pg->plan();
    }
}

/**
 * 接头人的职责就是接受命令，并执行命令
 */

class Invoker {
    
    //什么命令
    private $command = null;
    
    //客户发出命令
    public function setCommand($cmd) {
        $this->command = $cmd;
    }
    
    public function action() {
        $this->command->execute();
    }
}

/* 执行上面的流程 */

$xiaosan = new Invoker();     //定义接头人
$command = new AddRequirementCommand();   //客户给我们下命令

$xiaosan->setCommand($command);           //接头人接到命令
$xiaosan->action();                       //接头人执行命令

var_dump('******************2********************');

$xiaosan = new Invoker();    //欢迎我们的接头人小三
$command = new DeletePageCommand();     //客户下达命令
$xiaosan->setCommand($command);         //小三接到命令
$xiaosan->action();                     //小三行动了

//后续，要是客户要求撤销问题，怎么实现啊，可以增加undo命令
     
  
?>
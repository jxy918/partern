<?php
/**
 * 定义一个接口，所有项目都是一个接口, 面向接口编程当然要定义接口
 */

interface IProject {

    /* 增加项目 */
    public function add($name, $num, $cost);

    /* 从老板这得到就是项目信息 */
    public function getProjectInfo(); 
    
    /* 获得一个可遍历的对象 */
    public function iterator();      
}

/**
 *  所有项目的信息类
 */ 

class Project implements IProject {

    /* 定义一个项目列表 */
    private $project_list = array();
    
    /* 项目名称 */
    private $name = '';
    
    /* 项目成员数 */
    private $num = 0;
    
    /* 项目费用 */
    private $cost = 0;
        
    public function __construct($name, $num, $cost) {
        $this->name = $name;
        $this->num  = $num;
        $this->cost = $cost;        
    }
    
    public function add($name, $num, $cost) {
        $this->project_list = array_push($this->project_list, new Project($name, $num, $cost));
    }
    
    public function getProjectInfo() {
        $info = '';
        $info .= '项目名称是:'.$this->name;
        $info .= '项目人数是:'.$this->num;
        $info .= '项目费用是:'.$this->cost;
        return $info;
    }
    
    /* 产生一个遍历对象 */
    public function iterator() {
        return new ProjectIterator($this->project_list);
    }
}

/* 老板来指定项目信息 */

$project_list = array();
array_push($project_list, new Project('星球大战项目', 10, 100000));
array_push($project_list, new Project('扭转时空项目', 100, 1000000));
array_push($project_list, new Project('超人改造计划', 1000, 10000000));

/* 这有10个项目 */
for($i = 0; $i < 10; $i++) {
    array_push($project_list, new Project('第'.$i.'个项目', $i *5, $i * 10000));
}

foreach($project_list as $val) {
    var_dump($val->getProjectInfo());
}

/* 想了下，遍历，可以用迭代实现 */

/**
 * 定义一个迭代接口
 */

interface IProjectIterator {


}

class ProjectIterator implements IProjectIterator {
    
    private $project_list = array();
    
    private $currentItem = 0;
    
    public function __construct($project_list) {
        $this->project_list = $project_list;
    }
    
    /* 判断是否有元素 */
    public function hasNext() {
        $ret = true;
        if ($this->currentItem > count($this->project_list) || @$this->project_list[$this->currentItem] == null) {
            $ret = false;
        }
        return $ret;        
    }
    
    /* 取得下一个值 */
    public function next() {
        return $this->project_list[$this->currentItem++];
    }
    
    /* 删除一个对象，暂时没用到 */
    /*
    public function remove() {
    
    }
    */
} 

/* 老板来看项目了啊 */
var_dump('***************************1*******************************');

$project = array();

array_push($project, new Project('星球大战项目', 10, 100000));
array_push($project, new Project('扭转时空项目', 100, 1000000));
array_push($project, new Project('超人改造计划', 1000, 10000000));

/* 这有10个项目 */
for($i = 0; $i < 10; $i++) {
    array_push($project, new Project('第'.$i.'个项目', $i *5, $i * 10000));
}

/* 遍历一下数组，把所有数据都取出来 */
$project_iterator = new ProjectIterator($project);

while($project_iterator->hasNext()){
    $p = $project_iterator->next();
    var_dump($p->getProjectInfo());
}


?>
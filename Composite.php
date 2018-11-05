<?php
/**
 *  组合模式，其实就是数据结构里的数结构
 */
 
 
 
/**
 *  定义一个根节点，就为总经理服务
 */

// interface IRoot {
//     
//     /* 得到总经理信息 */
//     public function getInfo();
//     
//     /* 总经理下边还有虾兵蟹将，那得能增加虾兵蟹将， 比如研发部经理，这是个树枝节点 */
//     public function addBrance($brance);
//     
//     /* 还要能增加叶子节点 */
//     public function addLeaf($leaf);
//     
//     /* 既然增加了那得能遍历,不可能总经理不知道他手下的那些人吧 */
//     public function getSubordinateInfo();
//         
// }

/**
 *  根节点实现类
 */

// class Root implements IRoot {
//     
//     private $subordinateList = array();    //保存根节点下的分支和树叶
//     
//     private $name = '';        //根节点名称
//     
//     private $position = '';    //根节点的职位
//     
//     private $salary = 0;      //根节点薪水
//     
//     /* 根据构造函数传递进来总经理信息 */
//     public function __construct($name, $position, $salary) {
//         $this->name = $name;
//         $this->position = $position;
//         $this->salary = $salary;
//         
//     }
//     
//     /* 增加树枝检点 */
//     public function addBrance($brance) {
//         array_push($this->subordinateList, $brance);    
//     }
//     
//     /* 增加叶子节点 */
//     public function addLeaf($leaf) {
//         array_push($this->subordinateList, $leaf);
//     }
//     
//     /* 得到自己的信息 */
//     public function getInfo() {
//         $info = '';
//         $info .= '名称：'.$this->name;
//         $info .= "\t职位: ".$this->position;
//         $info .= "\t薪水：".$this->salary;
//         return $info;
//     }
//     
//     /* 得到下级信息 */
//     public function getSubordinateInfo() {
//         return $this->subordinateList;
//     }
// 
// } 

/**
 * 树枝节点，也就是各个部门经理和组长的角色
 */ 
// interface IBrance {
// 
//     /* 获得信息 */
//     public function getInfo();
//     
//     /* 增加数据节点，例如研发不下的研发一组 */
//     public function addBrance($brance);
//     
//     /* 增加叶子节点 */
//     public function addLeaf($leaf);
//     
//     /* 获得下级信息 */
//     public function getSubordinateInfo();
// }

/**
 * 所有树枝节点的实现
 */

// class Brance implements IBrance {
//     
//     private $subordinateList = array();        //存储子节点信息
//     
//     private $name = '';                         //树枝节点名称
//     
//     private $position = '';                     //树枝节点职位
//     
//     private $salary = 0;                        //树枝节点薪水
//     
//     public function __construct($name, $position, $salary) {
//         $this->name = $name;
//         $this->position = $position;
//         $this->salary = $salary;
//     }
//     
//     public function addBrance($brance) {
//          array_push($this->subordinateList, $brance);    
//     }
//     
//     public function addLeaf($leaf) {
//          array_push($this->subordinateList, $leaf); 
//     }
//     
//     /* 得到自己的信息 */
//     public function getInfo() {
//         $info = '';
//         $info .= '名称：'.$this->name;
//         $info .= "\t职位: ".$this->position;
//         $info .= "\t薪水：".$this->salary;
//         return $info;
//     }
//     
//     /* 得到下级信息 */
//     public function getSubordinateInfo() {
//         return $this->subordinateList;
//     }
// }

/**
 * 叶子节点，也就是最小的小兵了，
 */
// interface ILeaf {
//     
//     /* 获得自己信息 */
//     public function getInfo();
// 
// }

/**
 *  最小的叶子节点
 */ 

// class Leaf implements ILeaf {
//     
//     private $name = '';                 //叶子节点叫什么名字
//     
//     private $position = '';             //叶子节点的职位是什么
//     
//     private $salary = 0;                //薪水
//     
//     public function __construct($name, $position, $salary) {
//         $this->name = $name;
//         $this->position = $position;
//         $this->salary = $salary;
//     }
//     
//     /* 得到自己的信息 */
//     public function getInfo() {
//         $info = '';
//         $info .= '名称：'.$this->name;
//         $info .= "\t职位: ".$this->position;
//         $info .= "\t薪水：".$this->salary;
//         return $info;
//     }
// }
// 
// /* 组装一个树，并遍历一遍 */
// $ceo = new Root('王大麻子', '1经理', 100000);         //根节点ceo
// 
// /* 产生三个部门经理 */
// $developDep = new Brance('刘大瘸子', '2研发部经理', 10000);
// $salasDep   = new Brance('马二拐子', '2销售部经理', 20000);
// $financeDep = new Brance('赵三驼子', '2财务不经理', 30000);
// 
// /* 产生三个小组长 */
// $firstDevGroup  = new Brance('杨三乜斜', '3开发一组组长', 5000);
// $secondDevGroup = new Brance('吴大棒槌', '3开发二组组长',6000); 
// 
// /* 剩下的及时我们这些小兵了,就是路人甲，路人乙 */ 
// 
// $a = new Leaf("a", "4开发人员", 2000); 
// $b = new Leaf("b", "4开发人员", 2000); 
// $c = new Leaf("c", "4开发人员", 2000); 
// $d = new Leaf("d", "4开发人员", 2000); 
// $e = new Leaf("e", "4开发人员", 2000); 
// $f = new Leaf("f", "4开发人员", 2000); 
// $g = new Leaf("g", "开发人员", 2000); 
// $h = new Leaf("h", "3销售人员", 5000); 
// $i = new Leaf("i", "3销售人员", 4000); 
// $j = new Leaf("j", "3财务人员", 5000); 
// $k = new Leaf("k", "2CEO秘书", 8000); 
// 
// $zhengLaoLiu = new Leaf("郑老六", "3研发部副总", 20000); 
// 
// /* 首先是定义总经理下有三个部门经理 */
// $ceo->addBrance($developDep); 
// 
// $ceo->addBrance($salasDep); 
// 
// $ceo->addBrance($financeDep); 
// 
// //总经理下还有一个秘书 
// $ceo->addLeaf($k); 
// 
// //定义研发部门 下的结构 
// $developDep->addBrance($firstDevGroup); 
// 
// $developDep->addBrance($secondDevGroup); 
// 
// //研发部经理下还有一个副总 
// $developDep->addLeaf($zhengLaoLiu); 
// 
// //看看开发两个开发小组下有什么 
// $firstDevGroup->addLeaf($a); 
// 
// $firstDevGroup->addLeaf($b); 
// 
// $firstDevGroup->addLeaf($c); 
// 
// $secondDevGroup->addLeaf($d); 
// 
// $secondDevGroup->addLeaf($e); 
// 
// $secondDevGroup->addLeaf($f); 
// 
// //再看销售部下的人员情况 
// $salasDep->addLeaf($h); 
// 
// $salasDep->addLeaf($i); 
// 
// //最后一个财务 
// $financeDep->addLeaf($j);
// 
// //打印出来整个树形 
// $tree = $ceo->getSubordinateInfo(); 
// 
// readTree($ceo);

// /* 开始设计模式 */
// interface ICorp {
// 
//     /* 每个员工都有信息，你想隐藏，门都没有啊 */
//     public function getInfo();
// 
// }
// 
// /**
//  * 树叶节点,即小兵
//  */
// class Leaf implements ICorp {
//     
//     /* 小兵也有名字 */
//     private $name = '';
//     
//     /* 小兵也有职位 */
//     private $position = '';
//     
//     /* 小兵也有薪水，否则谁给你干 */
//     private $salary = 0;
//     
//     /* 构造函数传递小兵信息 */
//     public function __construct($name, $position, $salary) {
//         $this->name = $name;
//         $this->position = $position;
//         $this->salary = $salary;
//     }
//     
//     /* 获得小兵系想你 */
//     public function getInfo() {
//         $info = '';
//         $info .= '名称：'.$this->name;
//         $info .= "\t职位: ".$this->position;
//         $info .= "\t薪水：".$this->salary;
//         return $info;
//         
//     }
// }
// 
// /**
//  *  树枝节点接口,即经理级别的人
//  */
//  
// interface IBrance {
//     
//     /* 增加小兵（树叶节点）或经理级别的人(树枝节点) */
//     public function addSubordinate($corp);
//     
//     /* 还能够获得下属信息 */
//     public function getSubordinateInfo();
// }
// 
// /**
//  *  树枝节点特点，就是领导既要知道自己的信息，也要知道下属的信息
//  *
//  */
// class Brance implements ICorp,IBrance {
//     
//     /* 领导需要知道自己的名字 */
//     private $name = '';
//     
//     /* 领导的职位 */
//     private $position = '';
//     
//     /* 领导的薪水 */
//     private $salary = 0;
//     
//     /* 领导下边的虾兵蟹将信息 */
//     private $subordinateList = array();
//     
//     public function __construct($name, $position, $salary) {
//         $this->name     = $name;
//         $this->position = $position;
//         $this->salary   = $salary;
//     }
//     
//     public function addSubordinate($corp) {
//         array_push($this->subordinateList, $corp);    
//     }
//     
//     public function getSubordinateInfo() {
//         return $this->subordinateList;
//     }
//     
//     public function getInfo() {
//         $info = '';
//         $info .= '名称：'.$this->name;
//         $info .= "\t职位: ".$this->position;
//         $info .= "\t薪水：".$this->salary;
//         return $info;    
//     }
// } 

/* 继续优化，返现Brance和Leaf都有getinfo() ,继续抽象一下*/

abstract class Corp {
    
    /* 公司每个人的名字 */
    private $name = '';
    
    /* 公司每个人的职位 */
    private $position = '';
    
    /* 公司每个人的薪水 */
    private $salary = 0;
    
    /* 父节点 */
    private $_parent = null;
    
    public function __construct($name, $position, $salary) {
        $this->name = $name; 
        $this->position = $position;
        $this->salary = $salary;
    }
    
    public function getInfo() {
        $info = '';
        $info .= '名称：'.$this->name;
        $info .= "\t职位: ".$this->position;
        $info .= "\t薪水：".$this->salary;
        return $info;
    }
    
    public function setParent($corp) {
        $this->_parent = $corp;
    }
    
    public function getParentInfo() {
        return $this->_parent;
    }
}

/**
 *  叶子节点，即普通员工，写一个构造函数就可以了啊
 */
class Leaf extends Corp {
    public function __construct($name, $position, $salary) {
        parent::__construct($name, $position, $salary);
    }
}

class Brance extends Corp {
    
    /* 树枝下的树枝或树叶信息 */
    private $subordinateList = array();
    
    public function __construct($name, $position, $salary) {
        parent::__construct($name ,$position, $salary);
    }
    
    /* 增加下属 */
    public function addSubordinate($corp) {
        array_push($this->subordinateList, $corp);
    }
    
    /* 得到下属信息*/
    public function getSubordinateInfo() {
        return $this->subordinateList;
    }
}


function readTree($obj) {
   if (is_object($obj)) {
        echo $obj->getInfo()."<br />";  
        if(method_exists($obj, 'getSubordinateInfo')) {
            $son = $obj->getSubordinateInfo();
            $cnt = count($son); 
            if($cnt > 0) {
                foreach($son as $val) {
                    readTree($val);
                }
            }
        }
    }
}



/* 组装这个结构 */
$ceo = new Brance('王大麻子', '1经理', 100000);         //根节点ceo

/* 产生三个部门经理 */
$developDep = new Brance('刘大瘸子', '2研发部经理', 10000);
$salasDep   = new Brance('马二拐子', '2销售部经理', 20000);
$financeDep = new Brance('赵三驼子', '2财务不经理', 30000);

/* 产生三个小组长 */
$firstDevGroup  = new Brance('杨三乜斜', '3开发一组组长', 5000);
$secondDevGroup = new Brance('吴大棒槌', '3开发二组组长',6000); 

/* 剩下的及时我们这些小兵了,就是路人甲，路人乙 */ 

$a = new Leaf("a", "4开发人员", 2000); 
$b = new Leaf("b", "4开发人员", 2000); 
$c = new Leaf("c", "4开发人员", 2000); 
$d = new Leaf("d", "4开发人员", 2000); 
$e = new Leaf("e", "4开发人员", 2000); 
$f = new Leaf("f", "4开发人员", 2000); 
$g = new Leaf("g", "开发人员", 2000); 
$h = new Leaf("h", "3销售人员", 5000); 
$i = new Leaf("i", "3销售人员", 4000); 
$j = new Leaf("j", "3财务人员", 5000); 
$k = new Leaf("k", "2CEO秘书", 8000); 

$zhengLaoLiu = new Leaf("郑老六", "3研发部副总", 20000); 

/* 首先是定义总经理下有三个部门经理 */
$ceo->addSubordinate($developDep); 
$ceo->addSubordinate($salasDep); 
$ceo->addSubordinate($financeDep); 

//总经理下还有一个秘书 
$ceo->addSubordinate($k); 

//定义研发部门 下的结构 
$developDep->addSubordinate($firstDevGroup); 
$developDep->addSubordinate($secondDevGroup); 

//研发部经理下还有一个副总 
$developDep->addSubordinate($zhengLaoLiu); 

//看看开发两个开发小组下有什么 
$firstDevGroup->addSubordinate($a); 
$firstDevGroup->addSubordinate($b); 
$firstDevGroup->addSubordinate($c); 
$secondDevGroup->addSubordinate($d); 
$secondDevGroup->addSubordinate($e); 
$secondDevGroup->addSubordinate($f); 

//再看销售部下的人员情况 
$salasDep->addSubordinate($h); 
$salasDep->addSubordinate($i); 
//最后一个财务 
$financeDep->addSubordinate($j);

//打印出来整个树形 
$tree = $ceo->getSubordinateInfo(); 
readTree($ceo);

?>
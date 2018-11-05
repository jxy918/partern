<?php
/**
 *  单一就是独苗，独一份的意思
 *  中国的历史上一般都是一个朝代一个皇帝，有两个皇帝的话，必然要PK出一个皇帝出来  
 *
 */
 
class Emperor {
    private static $emperor = null;    //定义一个皇帝在那里，然后给这个皇帝名字
     
    private function __construct(){}
    
    private function __clone(){}       //防止对象被克隆
    
    public static function getInstance() {
        if(Emperor::$emperor == null) {
            Emperor::$emperor = new Emperor;
        }
        return Emperor::$emperor;
    }
    
    public function emperorInfo() {
        var_dump('我就是皇帝xxx');
    }
}


/* 大臣是天天要面见皇帝，今天见的皇帝和昨天的，前天不一样那就出问题了！ */

$emperor1 = Emperor::getInstance();   // 第一天见的皇帝名字
$emperor1->emperorInfo();

$emperor2 = Emperor::getInstance();  // 第二天见的皇帝名字
$emperor2->emperorInfo();

$emperor3 = Emperor::getInstance();  // 三天见的皇帝是同一个人
$emperor3->emperorInfo();



/* 测试单例模式被对象克隆破坏，clone */
class Boss {
    private $name;
    private static $instance = null;

    private function __construct() {}    // 不能构造
//    private function __clone() {}        // 对象不能克隆
    
    
    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Boss;
        }
        return self::$instance;
    }

    public function bossInfo() {
        var_dump('我是老板'.$this->name);
    }
    
    public function setName($name) {
        $this->name = $name;
    }
}


$boss1 = Boss::getInstance();
$boss2 = Boss::getInstance();
$boss3 = clone $boss2; 

$boss1->setName('jxy_1');
$boss2->setName('jxy_2');
$boss3->setName('jxy_3');

$boss1->bossInfo();
$boss2->bossInfo();
$boss3->bossInfo();

/** 输出结果 
 * string '我是老板jxy_2' (length=13)
 * string '我是老板jxy_2' (length=13)
 * string '我是老板jxy_3' (length=13)
 * 说明clone破坏了单例模式
 * 处理方法是：覆写一个私有的clone方法，可以杜绝clone。  
*/


?>




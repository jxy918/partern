<?php
/* 韩非字，李斯之战 */

// /**
//  * 类似与韩非子这样的人，被监控起来还不知道
//  */ 
// 
// interface IHanFeiZi {
//     
//     /* 韩非子也是人，也要吃早饭 */
//     public function haveBreakfast(); 
//     
//     /* 韩非子也是人，是人就要娱乐吗，不说了啊 */
//     public function haveFun();
// }
// 
// /**
//  * 韩非子，李斯的师弟，韩国重要人物
//  */
// 
// class HanFeiZi implements IHanFeiZi {
//     
//     private $lisi = null;                  //把李斯叫出来
// 
//     
//     public function __construct() {
//         $this->lisi = new LiSi();
//     }
//     
//     public function haveBreakfast() {
//         var_dump('韩非子开始吃饭了...');
//         $this->lisi->update('韩非子吃饭');
//         $this->isHaveBreakfast = true;
//     }
//     
//     public function haveFun() {
//         var_dump('韩非子，开始娱乐了...');
//         $this->lisi->update('韩非子在娱乐');
//         $this->isHaveFun = true;
//     }
// 
// }
// 
// /**
//  *  监控者李斯，类似于现在的偷窥狂
//  */
// interface ILiSi {
// 
//     /* 一个发现别人有动静，自己要行动起来 */
//     public function update($context);
// }
// 
// /**
//  *  李斯这个人是观察者，只要韩非子一有动静，这边就知道
//  */
// 
// class LiSi implements ILiSi {
//     
//     public function update($context) {
//         var_dump('李斯：观察到韩非子活动，开始向老板汇报...');
//         $this->reportToQinShiHuang($context);
//         var_dump('李斯：汇报完毕，秦始皇赏他两个萝卜...');
//     }
//     
//     /* 汇报给秦始皇 */
//     public function reportToQinShiHuang($reportContext) {
//         var_dump('李斯：报告秦老板，韩非子有活动--'.$reportContext);        
//     }
// 
// } 
// 
// /* 测试观察者设计模式 */
// $hanfeizi = new HanFeiZi();
// $hanfeizi->haveBreakfast();
// $hanfeizi->haveFun();

/**
 * 所有被观察者, 通用接口
 */ 
interface Observable {
    
    /* 增加一个观察者 */
    public function addObserver($observer);
    
    /* 删除一个观察者 */
    public function deleteObserver($observer);
    
    /* 发生改变了，要通知观察者 */
    public function notifyObserver($context);

}

/**
 * 韩非子，李斯师弟，韩国重要人物
 */
class HanFeiZi implements Observable {
    
    /* 存放观察者数组 */
    private $observerList = array();
    
    /* 增加观察者 */
    public function addObserver($observer) {
        array_push($this->observerList, $observer);
    }
    
    /* 删除观察者 */
    public function deleteObserver($observer) {
        $key = array_search($observer, $this->observerList);
        unset($this->observerList[$key]);    
    }
    
    /* 通知所有观察者 */
    public function notifyObserver($context) {
        foreach($this->observerList as $val) {
            $val->update($context);
        }
    }
    
    /* 韩非子要吃饭 */
    public function haveBreakfast() {
        var_dump('韩非子：开始吃饭了...');
        /* 通知所有的观察者 */
        $this->notifyObserver('韩非子在吃饭');
    }
    
    /* 韩非子娱乐*/
    public function haveFun() {
        var_dump('韩非子：开始happy...');
        /* 通知所有的观察者 */
        $this->notifyObserver('韩非子在happy');
    }    
}

/**
 *  所有观察者, 通用接口
 */

interface Observer {
    
    /* 一个发现别人有动静，自己也要行动起来 */
    public function update($context);

}

/* 然后出现三个很无耻的偷窥狂 */
class LiSi implements Observer {
    
    public function update($context) {
        var_dump('李斯：观察到韩非子活动，开始先老板汇报');
        $this->reportToQinShiHuang($context);
        var_dump('李斯：汇报完毕秦老板，赏赐两个萝卜吃吃');
    }
    
    public function reportToQinShiHuang($reprotContext) {
        var_dump('李斯：报告秦老板，韩非子有活动-----'.$reprotContext);
    }
}

class WangSi implements Observer {
    
    public function update($context) {
        var_dump('王斯：观察到韩非子活动，自己也开始行动了');
        $this->cry($context);
        var_dump('王斯：王斯真的哭死了');
    }
    
    public function cry($reprotContext) {
        var_dump('王斯：因为'.$reprotContext.'--所以我悲伤');
    }
}

class LiuSi implements Observer {
    
    public function update($context) {
        var_dump('刘斯：观察到韩非子活动，自己也开始行动了');
        $this->happy($context);
        var_dump('刘斯：刘斯真的乐死了');
    }
    
    public function happy($reprotContext) {
        var_dump('刘斯：因为'.$reprotContext.'--所以我快乐呀');
    }
} 

/* 看是监视了 */

$lisi   = new LiSi();
$wangsi = new WangSi();
$liusi  = new LiuSi();

$hanfeizi = new HanFeiZi();

$hanfeizi->addObserver($lisi);
$hanfeizi->addObserver($wangsi);
$hanfeizi->addObserver($liusi);

$hanfeizi->haveBreakfast();
$hanfeizi->haveFun()

?>
<?php
/**
 * 什么是代理模式呢？我很忙，忙的没空理你，那你要找我呢就先找我的代理人吧，那代理人总要知道 
 * 被代理人能做哪些事情不能做哪些事情吧，那就是两个人具备同一个接口，代理人虽然不能干活，但是被代理的人能干活呀。  
 * 比如西门庆找潘金莲，那潘金莲不好意思答复呀，咋办，找那个王婆做代理，表现在程序上时这样的：
 */
 
/** 

 
/**
 * 定义一种类型的女人， 王婆和潘金莲都属于这类型的女人
 *
 *
 */
interface KindWomen {
    //种种类型的女人能做什么事呢？    
    public function makeEyesWithMan();    // 抛媚眼
    public function happyWithMan();       // 你懂的
}

/**
 * 定义潘金莲是什么样的人
 */
class PanJinLian implements KindWomen {
    public function makeEyesWithMan() {
        var_dump('潘金莲抛媚眼');
    }
    
    public function happyWithMan() {
        var_dump('潘金莲在和男人做那个...');
    }
}

/**
 * 王婆这个人老聪明了，她太老了，是个男人都看不上，但是他有智慧经验，她作为一类女人的代理
 *
 */
class WangPo implements KindWomen {
    private $kindWomen;
    
    /* $obj_kind_women 她可以是任何女人的代理，只要你是这一类型 */
    public function __construct($obj_kind_women) {
        $this->kindWomen = $obj_kind_women;
    }
    
    public function makeEyesWithMan() {
        $this->kindWomen->makeEyesWithMan();    // 王婆这么大年龄，谁还看她抛媚眼啊？ ！
    }
    
    public function happyWithMan() {
        $this->kindWomen->happyWithMan();       //  自己老了，不干了，可以让年轻的代替
    }
}

/* 西门庆上场了，男主角出现 */ 

$wang_po = new WangPo(new PanJinLian());  // 王婆把潘金莲叫出来了
$wang_po->makeEyesWithMan();              // 王婆抛媚眼，实际是潘金莲
$wang_po->happyWithMan();                 // 虽然对象是王婆，但是爽的是潘金莲   

/* 继续扩展，联想，水浒里面是否还有这样的女人，卢俊义的老婆贾氏，杨雄的老婆潘巧云，哈哈我们继续创建这类女人，由王婆来代理 */

class JiaShi implements KindWomen {
    public function makeEyesWithMan() {
        var_dump('贾氏抛媚眼');
    }
    public function happyWithMan() {
        var_dump('贾氏正在happy中...');
    }
} 

class PanQiaoYun implements KindWomen {
    public function makeEyesWithMan() {
        var_dump('潘巧云抛媚眼');
    }
    public function happyWithMan() {
        var_dump('潘巧云happy中...');
    }
}

/* 西门庆勾引贾氏，勾引潘巧云 */

$jiashi = new WangPo(new JiaShi());
$jiashi->makeEyesWithMan();
$jiashi->happyWithMan();

$panqiaoyun = new WangPo(new PanQiaoYun());
$panqiaoyun->makeEyesWithMan();
$panqiaoyun->happyWithMan();      

?>
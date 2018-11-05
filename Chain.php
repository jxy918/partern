<?php
/**
 * 古代悲哀女性的总称
 */
 
interface IWomen {
    
    public function getType();     //获得个人状况
    
    public function getRequest();   //获得个人请示，你要干什么？出去逛街？约会？看电影
} 

/**
 * 古代女性的总称
 */

// class Women implements IWomen {
//     
//     /* 通过一个int类型来描述妇女的个人情况：1--未出嫁，2--出嫁，3--夫死 */
//     private $type = 0;
//     
//     /* 妇女请示 */
//     private $request = '';
//     
//     public function __construct($type, $request) {
//         
//         $this->type    = $type;
//         $this->request = $request;    
//     }
//     
//     /* 获得自己的状况 */
//     public function getType() {
//         return $this->type;
//     }
//     
//     /* 获得妇女的请求 */
//     public function getRequest() {
//         return $this->request;
//     }
// }

/**
 *  父系社会那就是男性有最高权力，handler控制权
 *
 */ 
// interface IHandler {
//     
//     public function handleMessage($women);
// 
// }
// 
// class Father implements IHandler {
//     
//     /* 未出嫁的女儿请示父亲 */
//     public function handleMessage($women) {
//         var_dump('女儿的请示是：'.$women->getRequest());
//         var_dump('父亲答应是：同意');
//     }
// }
// 
// class Husband implements IHandler {
//     
//     /* 妻子向丈夫请示 */
//     public function handleMessage($women) {
//         var_dump('妻子的请示是：'.$women->getRequest());
//         var_dump('丈夫的答复是：同意');
//     }
// } 
// 
// class Son implements IHandler {
// 
//     /* 母亲向儿子请示 */
//     public function handleMessage($women) {
//         var_dump('母亲的请示是：'.$women->getRequest());
//         var_dump('儿子的答复是：同意');
//     }
// } 


/*********************************************************责任链设计模式*************************************************/


/**
 *  父系社会，那就是男性有至高权利，handler控制权
 */
abstract class Handler {
    
    /* 能处理的级别 */
    private $level = 0;
    
    /* 责任传递，下一个责任人是谁 */
    private $nextHandler;
    
    /* 每个类要说明一下自己处理的请求 */
    public function __construct($level) {
        $this->level = $level;
    }
    
    /* 一个女性（女儿，妻子，母亲）要求逛街，你要处理这个请求 */
    public function handleMessage($women) {
        if($women->getType() == $this->level) {
            $this->response($women);
        } else {
            if($this->nextHandler != null) {
                $this->nextHandler->handleMessage($women);
            } else {
                var_dump('没地方请示了，不做处理');
            }
        }
    }
    
    /* 如果你属于处理的返回，应找下一环节处理人 */
    public function setNext($handle) {
        $this->nextHandler = $handle;
    }
    
    /* 有请示当然要回复 */
    public abstract function response($women);
}

/**
 *  父亲
 */
class Father extends Handler {
    
    /* 父亲只处理女儿的请求 */
    public function __construct() {
        parent::__construct(1);
    }
    
    /* 父亲的答复 */
    public function response($women) {
        var_dump('--------女儿向父亲请示--------');
        var_dump($women->getRequest());
        var_dump('父亲的答复是：同意');        
    }
}

/**
 *  丈夫
 */
class Husband extends Handler {
    
    /* 丈夫只处理妻子的请求 */
    public function __construct() {
        parent::__construct(2);
    }
    
    /* 丈夫的答复 */
    public function response($women) {
        var_dump('--------妻子向丈夫请示--------');
        var_dump($women->getRequest());
        var_dump('丈夫的答复是：同意');        
    }
}

/**
 *  儿子
 */
class Son extends Handler {
    
    /* 儿子只处理母亲的请求 */
    public function __construct() {
        parent::__construct(3);
    }
    
    /* 儿子的答复 */
    public function response($women) {
        var_dump('--------母亲向儿子请示--------');
        var_dump($women->getRequest());
        var_dump('儿子的答复是：同意');        
    }
} 

class Women implements IWomen {
    
    /* 通过一个int类型来描述妇女的个人情况：1--未出嫁，2--出嫁，3--夫死 */
    private $type = 0;
    
    /* 妇女的请示 */
    private $request = '';
    
    public function __construct($type, $request) {
        $this->type = $type;
        switch($this->type) {
            case 1 :
                $this->request = '女儿的请求是：'.$request;
                break;
            case 2 :
                $this->request = '妻子的请求是：'.$request;
                break;
            case 3 :
                $this->request = '母亲的请求是：'.$request;
                break;            
        }
    }
    
    /* 获得自己的类型 */
    public function getType() {
        return $this->type;
    }
    
    /* 获得妇女请求 */
    public function getRequest() {
        return $this->request;
    }
}

/* 我们后人来看这样的社会道德 */

$women   = new Women(3, '我要出去逛街');
$father  = new Father();
$husband = new Husband();
$son     = new Son();

$father->setNext($husband);
$husband->setNext($son);

$father->handleMessage($women);

?>
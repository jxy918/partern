<?php
/**
 *  首先定一个策略接口，这是诸葛亮老人家给赵云的三个锦囊妙计的接口
 */
interface Strategy {
    //每个锦囊妙计都有个可执行方法
    public function operate();
}

/**
 *  找乔国老帮忙是孙权不能杀刘备
 */
class BackDoor implements Strategy {
    public function operate() {
        var_dump('找乔国老帮忙，让吴国太给孙权施加压力');
    }
}

/**
 *  求吴国太开个绿灯
 */
class GiveGreenLight implements Strategy {
    public function operate() {
        var_dump('求吴国太开绿灯，放行');
    }
}

/**
 *  孙夫人断后，挡住追兵
 */
class BlockEnemy implements Strategy {
    public function operate() {
        var_dump( '孙夫人断后，挡住追兵');
    }
}

/**
 *  计谋有了，还要有锦囊,也就是容器
 */
class Context {
    private $strategy;
    
    /* 构造你要使用的妙计 */
    public function __construct($obj_strategy) {
        $this->strategy = $obj_strategy;
        
    }
    /* 使用妙计，看我出招 */
    public function operate() {
        $this->strategy->operate();
    }
}

/* 赵云使用妙计 */

/* 刚刚到吴国拆开第一个妙计 */
$context = new Context(new BackDoor());  // 拿到妙计
$context->operate();                     // 拆开执行
echo "<br />";

/* 刘备乐不思蜀，拆开第二个妙计 */
$context = new Context(new GiveGreenLight());
$context->operate();    //拆开执行第二个妙计
echo "<br />";

/*孙权的小追兵，咋办，果断拆开第三个 */
$context = new Context(new BlockEnemy());
$context->operate();  //孙夫人退兵
echo "<br />";




?>
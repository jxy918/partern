<?php
/** 女娲补天的故事大家都听说过吧，今天不说这个，说女娲创造人的故事，可不是“造人”的工作，这 
 * 个词被现代人滥用了。这个故事是说，女娲在补了天后，下到凡间一看，哇塞，风景太优美了，天空是湛 
 * 蓝的，水是清澈的，空气是清新的，太美丽了，然后就待时间长了就有点寂寞了，没有动物，这些看的到 
 * 都是静态的东西呀，怎么办？  
 * 别忘了是神仙呀，没有办不到的事情，于是女娲就架起了八卦炉（技术术语：建立工厂）开始创建人， 
 * 具体过程是这样的：先是泥巴捏，然后放八卦炉里烤，再扔到地上成长，但是意外总是会产生的：  
 * 第一次烤泥人，兹兹兹兹~~，感觉应该熟了，往地上一扔，biu~，一个白人诞生了，没烤熟！  
 * 第二次烤泥人，兹兹兹兹兹兹兹兹~~，上次都没烤熟，这次多烤会儿，往地上一扔，嘿，熟过头了， 
 * 黑人哪！  
 * 第三次烤泥人，兹~兹~兹~，一边烤一边看着，嘿，正正好，Perfect！优品，黄色人种！
 */

/* 定义一个人类统称接口 */
interface Human {
    /* 人是愉快的，回笑的啊 */
    public function laugh();
    
    /* 人类还会哭，代表痛苦 */
    public function cry();
    
    /* 人类会说话 */
    public function talk(); 
}

/**
 * 黄种人，聪明的人种
 */
class YellowHuman implements Human {
    public function laugh() {
        var_dump('黄种人大笑,幸福呀');
    }
    
    public function cry() {
        var_dump('黄色人种会哭');
    }
    
    public function talk() {
        var_dump('黄种人会说话，一般是双字节');
    }
}

/**
 * 白色人种
 */
class WhiteHuman implements Human {
    public function laugh() {
        var_dump('白种人大笑，侵略的笑声');
    }
    
    public function cry() {
        var_dump('白种人种会哭');
    }
    
    public function talk() {
        var_dump('白色人种会说话，但是一般是单字节');
    }
} 

/**
 * 黑色人种，记得中学学英语，老师说 black man 是侮辱人的意思，不懂，没跟老外说过话
 */ 

class BlackHuman implements Human {
    public function laugh() {
        var_dump('黑人会笑');
    }
    
    public function cry() {
        var_dump('黑人会哭');
    }
    
    public function talk() {
        var_dump('黑人可以说话，不过一般人听不懂，太饶舌了啊');
    }
}

/** 
 * 今天讲女娲造人的故事，这个故事梗概是这样的： 
 * 很久很久以前，盘古开辟了天地，用身躯造出日月星辰、山川草木，天地一片繁华 
 * One day，女娲下界走了一遭，哎！太寂寞，太孤独了，没个会笑的、会哭的、会说话的东东 
 * 那怎么办呢？不用愁，女娲，神仙呀，造出来呀，然后捏泥巴，放八卦炉（后来这个成了太白金星的宝 贝）中烤，于是就有了人： 
 * 我们把这个生产人的过程用PHP程序表现出来： 
*/
class HumanFactory {
    // 定一个烤箱，泥巴塞进去，人就出来，太先进了啊
    public static function createHuman($obj_name) {
        $obj_human = null;
        try {
            $obj_human = new $obj_name;
        } catch (Exception $e) {
            var_dump('你要是不说个人种的话没法去烤，要白的，黑的，你说话就行');        
        }
        return $obj_human;      
    }
}

/* 现在女娲开始造人了啊 */

/* 女娲第一次造人，实验性质，少造一点，火候不足，缺陷产品 */
$whiteHuman = HumanFactory::createHuman('WhiteHuman');
$whiteHuman->laugh();
$whiteHuman->cry();
$whiteHuman->talk();

/* 女娲第二次造人，火候加足了一点，出了次品黑人 */
$blackHuman = HumanFactory::createHuman('BlackHuman');
$blackHuman->laugh();
$blackHuman->cry();
$blackHuman->talk();

/* 第三批人了，这次火候掌握的正好，黄色人种（不写黄人，免得引起歧义），备注：RB人不属此列  */
$yellowHuman = HumanFactory::createHuman('YellowHuman');
$yellowHuman->laugh();
$yellowHuman->cry();
$yellowHuman->talk();

?>
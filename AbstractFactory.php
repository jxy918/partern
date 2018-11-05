<?php
/**
 *
 * 人是造出来了，世界时热闹了，可是低头一看，都 
 * 是清一色的类型，缺少关爱、仇恨、喜怒哀乐等情绪，人类的生命太平淡了，女娲一想，猛然一拍脑袋， 
 * Shit！忘记给人类定义性别了，那怎么办？抹掉重来，然后就把人类重新洗牌，准备重新开始制造人类。  
 * 由于先前的工作已经花费了很大的精力做为铺垫，也不想从头开始了，那先说人类（Product产品类） 
 * 怎么改吧，好，有了，给每个人类都加一个性别，然后再重新制造，这个问题解决了，那八卦炉怎么办？ 
 * 只有一个呀，要么生产出全都是男性，要不都是女性，那不行呀，有了，把已经有了一条生产线——八卦 
 * 炉（工厂模式中的 Concrete Factory）拆开，于是女娲就使用了“八卦拷贝术”，把原先的八卦炉一个变两 
 * 个，并且略加修改，就成了女性八卦炉（只生产女性，一个具体工厂的实现类）和男性八卦炉（只生产男 
 *性，又一个具体工厂的实现类）
 */
 
interface Human {
    /* 人是愉快的，回笑的啊 */
    public function laugh();
    
    /* 人类还会哭，代表痛苦 */
    public function cry();
    
    /* 人类会说话 */
    public function talk(); 
    
    /* 定义性别 */
    public function sex();
}

/**
 *  为什么要定义成抽象类呢？因为要定义性别啊
 */
abstract class AbstractYellowHuman implements Human {
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
 *  这里是白色人种的天下
 */
abstract class AbstractWhiteHuman implements Human {
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

abstract class AbstractBlackHuman implements Human {
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
 *  女性黄种人
 */
class YellowFemaleHuman extends AbstractYellowHuman {
    public function sex() {
        var_dump('该黄种人的性别是女性');
    }
}

/**
 *  男性黄种人
 */
class YellowMaleHuman extends AbstractYellowHuman {
    public function sex() {
        var_dump('该黄种人的性别是男性');
    }
}

/**
 *  女性白种人
 */
class WhiteFemaleHuman extends AbstractWhiteHuman {
    public function sex() {
        var_dump('该白种人的性别是女性');
    }
}

/**
 *  男性白种人
 */
class WhiteMaleHuman extends AbstractWhiteHuman {
    public function sex() {
        var_dump('该白种人的性别是男性');
    }
}

/**
 *  女性黑种人
 */
class BlackFemaleHuman extends AbstractBlackHuman {
    public function sex() {
        var_dump('该黑种人的性别是女性');
    }
}

/**
 *  男性黑种人
 */
class BlackMaleHuman extends AbstractBlackHuman {
    public function sex() {
        var_dump('该黑种人的性别是男性');
    }
} 


/**
 * 定义工厂接口，各种火炉 
 */ 
interface HumanFactory {
    /* 制造黄色人种 */
    public function createYellowHuman();
    
    /* 制造白色人种 */
    public function createWhiteHuman();
    
    /* 制造黑色人种 */
    public function createBlackHuman();
}

/**
 * 编写抽象类，根据类型创造出不同人种 
 */
abstract class AbstractHumanFactory {
    protected function CreateHuman($obj_name) {
        $human = null;
        $human = new $obj_name;
        return $human;
    }
}

/* 男性工厂 */
class MaleHumanFactory extends AbstractHumanFactory {
    public function createYellowHuman() {
        return AbstractHumanFactory::CreateHuman('YellowMaleHuman'); 
    }
    
    public function createWhiteHuman() {
        return AbstractHumanFactory::CreateHuman('WhiteMaleHuman'); 
    }
    
    public function createBlackHuman() {
        return AbstractHumanFactory::CreateHuman('BlackMaleHuman'); 
    }
}

/* 女性工厂 */
class FemaleHumanFactory extends AbstractHumanFactory {
    public function createYellowHuman() {
        return AbstractHumanFactory::CreateHuman('YellowFemaleHuman'); 
    }
    
    public function createWhiteHuman() {
        return AbstractHumanFactory::CreateHuman('WhiteFemaleHuman'); 
    }
    
    public function createBlackHuman() {
        return AbstractHumanFactory::CreateHuman('BlackFemaleHuman'); 
    }
}

$maleHumanFactory = new MaleHumanFactory();

$femaleHumanFactory = new FemaleHumanFactory();

$maleYellowHuman = $maleHumanFactory->createYellowHuman();

$femaleYellowHuman = $femaleHumanFactory->createYellowHuman();

$maleYellowHuman->laugh();
$maleYellowHuman->cry();
$maleYellowHuman->talk();
$maleYellowHuman->sex();

?>
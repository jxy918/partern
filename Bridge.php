<?php
/**
 * 今天我要说说我自己，梦想中的我自己，我身价过亿，有两个大公司，一个是房地产公司，一个是服装制造 
 * 业，这两个公司都很赚钱，天天帮我在累加财富，其实是什么公司我倒是不关心，我关心的是是不是在赚钱，赚 
 * 了多少，这才是我关心的，我是商人呀，唯利是图是我的本性，偷税漏税是我的方法，欺上瞒下、压榨员工血汗 
 * 我是的手段嘛
 */

abstract class Crop {

    /* 公司就应当有生产吧， 不管什么公司都会有生产，虽然产品不一样 */
    protected abstract function produce();

    /* 有了产品，就得销售啊，不销售公司怎么生存 */
    protected abstract function sell();

    public function makeMoney() {

	$this->produce();
	$this->sell();
    }
}


/**
 * 房地产公司，正确翻译是realty corp，为了适合中国翻译我将它翻译成House crop
 *
 */

class HouseCrop extends Crop {

    protected function produce() {

	var_dump('房地产公司盖房子');
    }

    protected function sell() {

	var_dump('发地产公司买房子');
    }

    /* 房地产公司很high，赚钱，计算利润 */
    public function makeMoney() {

	parent::makeMoney();
	var_dump('房地产公司赚大钱‘...');
    }
}

/**
 * 服装公司，这个行当现在不怎么样
 *
 */

class ClothesCrop extends Crop {
    
    protected function produce() {
    
	var_dump('服装公司生产衣服...');
    }

    protected function sell() {

	var_dump('服装公司出售衣服');
    }

    public function makeMoney() {

	parent::makeMoney();
	var_dump('服装公司赚小钱...');
    }
}

/* 测试 */

/* 先找到我的公司 */

$houseCrop = new HouseCrop();
$houseCrop->makeMoney();

$clothesCrop = new ClothesCrop();
$clothesCrop->makeMoney();

echo '*********************1***************************';

/* 为了公司挣大钱，公司开始改头换面 */

/**
 *  我是山寨老大，你流行啥我就生产啥
 *  现在流行iPod
 */
class IPodCrop extends Crop {

    /* 开始生产iPod */
    protected function produce() {
    
	var_dump('我生产iPod...');
    }

    /* 山寨iPod很畅销 */
    protected function sell(){

	var_dump('iPod畅销');
    }

    /* 狂赚钱 */
    public function makeMoney() {
    
	parent::makeMoney();
	var_dump('我赚钱呀...');
    }
}

/* 我要关心我自己的公司 */
$hcrop = new HouseCrop();
$hcrop->makeMoney();

$iCrop = new IPodCrop();
$iCrop->makeMoney();

echo '*********************2***************************';


/**
 * 这是我整个公司的产品类
 */

abstract class Product {

    /* 甭管什么产品它总要被生产出来 */
    public abstract function beProducted();

    /* 生产出来的东西，一定要销售出去，否则扩本呀*/
    public abstract function beSelled();

}

/**
 * 这个是我集团公司盖的房子
 *
 */
class House extends Product {

    /* 豆腐渣就豆腐渣呗，好歹也是个房子啊 */
    public function beProducted() {

	var_dump('生产出房子是这样子的...');
    }

    /* 虽然是豆腐渣，也是能够销售出去的 */
    public function beSelled() {

	var_dump('生产出的房子卖出去了...');
    }
}

/**
 * 我的集团公司生产衣服
 *
 */

class Clothes extends Product {

    public function beProducted() {

	var_dump('生产出衣服是这样子的啊...');
    }

    public function beSelled() {

	var_dump('生产出的衣服卖出去了...');
    }
}

class IPod extends Product {

    public function beProducted() {

	var_dump('生产出的iPod是这个样子的...');
    }

    public function beSelled() {

	var_dump('生产出iPod卖出去了...');
    }	
}


/**
 * 定义一个公司的抽象类
 */

abstract class Corp {

    /* 定义一个产品对象，抽象的了，不知道具体是什么产品 */
    private $product;

    public function __construct($product) {

        $this->product = $product;
    }

    public function makeMoney() {

    	$this->product->beProducted();
    
    	$this->product->beSelled();
    }
}

/**
 *  房地产公司
 */
class HouseCorp extends Corp {
    
    public function __construct($product) {
        parent::__construct($product);
    }
    
    public function makeMoney() {
        parent::makeMoney();
        var_dump('房地产公司赚大钱了啊!');
    } 
}

/**
 *  我是山寨老大，你流行啥，我就生产啥
 */
class ShanZhaiCorp extends Corp {

    public function __construct($product) {
        parent::__construct($product);
    }
    
    public function makeMoney() {
        parent::makeMoney();
        var_dump('我赚钱呀');
    }     
} 

/* 我要关心我自己的公司了啊 */ 

$house = new House();
$housecorp = new HouseCorp($house);
$housecorp->makeMoney();

/* 山寨公司的生产的产品挺多，不过我们只要指定产品就行  */
$shanzhaicorp = new ShanZhaiCorp(new Clothes());
$shanzhaicorp->makeMoney();

/* 上面的山寨公司生产衣服，现在我要声场Ipod */
$shanzhaicorp = new ShanZhaiCorp(new IPod());
$shanzhaicorp->makeMoney();
?>

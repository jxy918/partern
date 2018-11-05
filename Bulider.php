<?php
/**
* @file Bulider.php
* @brief 定义一个车辆模型的抽象类，所有的车辆模型都继承这个类
* @author jxy918 jxy918@163.com
* @version none
* @date 2012-07-16
 */

abstract class CarModel {
    /** 这个参数是各种基本方法的执行顺序 */
    private $sequence = array();

    /** 模型启动，开始跑了 */
    protected abstract function start();

    /** 能发动，那还要能停下来，才是本事 */
    protected abstract function stop();

    /** 喇叭会出声音是滴滴响，还是哗哗响 */
    protected abstract function alarm();

    /** 引擎轰隆隆的响，不响那是假的 */
    protected abstract function enginBoom();

    /** 那模型应当会跑，不管是人力推的，还是店里驱动，总之要回跑 */
    final public function run() {

	foreach($this->sequence as $val) {
	    switch($val) {
		case 'start':
		    $this->start();      //开启汽车
		    break;
		case 'stop':
		    $this->stop();       //停止汽车
		    break;
		case 'alarm':
		    $this->alarm();      //喇叭开始响了
		    break;
		case 'enginBoom':
		    $this->enginBoom();  //引擎开始轰鸣
		    break;
	    }
	}
    }

    /** 把传递过来的值传递到类里面 */
    final public function setSequence($array_list) {
	
	$this->sequence = $array_list;
    }


}


/**
 * 奔驰车模型
 */

class BenzModel extends CarModel {

    protected function alarm() {
	
	var_dump('奔驰车的喇叭声音是这样叫的啊...');
    }

    protected function enginBoom() {

	var_dump('奔驰车的引擎是这个声音...');
    }

    protected function start() {

	var_dump('奔驰车跑起来是这个样子的...');
    }

    protected function stop() {

	var_dump('奔驰车应该这样停车');
    }
}

/**
 * 宝马车模型
 */

class BMWModel extends CarModel {
    
    protected function alarm() {
	
	var_dump('宝马车的喇叭声音是这样叫的啊...');
    }

    protected function enginBoom() {

	var_dump('宝马车的引擎是这个声音...');
    }

    protected function start() {

	var_dump('宝马车跑起来是这个样子的...');
    }

    protected function stop() {

	var_dump('宝马车应该这样停车');
    }

}

/** 用户开始使用了，先要一个本次模型，这个模型要求跑的时候，先发动引擎，然后在挂档启动，然后停下来，不需要喇叭 */

$benz = new BenzModel();
$sequence = array();
array_push($sequence,'enginBoom','start','stop');

$benz->setSequence($sequence);
$benz->run();


/** 还要下一个需求，然后是第2件宝马模型，只要启动，停止，其他的什么都不要，第3件模型，先喇叭，然后启动，让后停止，第4件...,直到把你逼疯位置，那怎么办呢，我们修改程序满足这种变态需求  */

/**  要什么顺序的车，你说，我给建造出来 */
abstract class CarBuilder {

    /** 建造一个模型，你要给我一个组装顺序 */
    public abstract  function setSequence($sequence);

    /** 设置完毕顺序后就直接拿到这个车辆模型 */
    public abstract  function getCarModel();

}

/**
 * 各种设施都给了，我们按照一定的顺序制造一辆奔驰车
 */

class BenzBuilder extends CarBuilder {

    private $benz;

    public function __construct() {

	$this->benz = new BenzModel();
    }

    public function getCarModel() {
    
	return $this->benz;
    }

    public function setSequence($sequence) {

	$this->benz->setSequence($sequence);
    }
}

/**
 * 给定给一个顺序，建造宝马车
 */

class BMWBuilder extends CarBuilder {

    private $bmw;

    public function __construct() {

	$this->bmw = new BMWModel();
    }

    public function getCarModel() {

	return $this->bmw;
    }

    public function setSequence($sequence) {

	$this->bmw->setSequence($sequence);
    }
}



/** 客户开始使用程序 */

$sequ = array();
array_push($sequ, 'enginBoom', 'start', 'stop');

$benzBuilder = new BenzBuilder();
$benzBuilder->setSequence($sequ);
$benz = $benzBuilder->getCarModel();
$benz->run();

/** 按照同样的顺序我要在造一量宝马 */

$bmwBuilder = new BMWBuilder();
$bmwBuilder->setSequence($sequ);
$bmw = $bmwBuilder->getCarModel();
$bmw->run();

/**
 * 这四个过程 （start,stop,alarm,engineBoom）按照排列组合有很多种，那我们怎么满足这种需求呢？也就是要有个类 
 * 来安排这几个方法组合，就像导演安排演员一样，那个先出场那个后出场，那个不出场，我们这个也叫导演类，
 */

/**
 * 导演安排顺序，生产车辆模型
 *
 */

class Director {

    private $sequence = array();
    private $benzBuilder;
    private $bmwBuilder;

    public function __construct() {
	$this->benzBuilder = new BenzBuilder();
	$this->bmwBuilder  = new BMWBuilder();
    }

    public function getABenzBuilder() {

	/** 清理场景 */
	$this->sequence = array();

	/** 这只ABenzModel的执行顺序 */
	array_push($this->sequence, 'start', 'stop');

	$this->benzBuilder->setSequence($this->sequence);
	return $this->benzBuilder->getCarModel();	
    }

    public function getBBenzBuilder() {

	$this->sequence = array();

	array_push($this->sequence, 'enginBoom', 'start', 'stop');
	$this->benzBuilder->setSequence($this->sequence);
	return $this->benzBuilder->getCarModel();
    }

    public function getCBMWBuilder() {

	$this->sequence = array();
	array_push($this->sequence, 'alarm', 'start' , 'stop');

	$this->bmwBuilder->setSequence($this->sequence);
	return $this->bmwBuilder->getCarModel();
    }

    public function getDBMWBuilder() {
	
	$this->sequence = array();
	array_push($this->sequence, 'start');

	$this->bmwBuilder->setSequence($this->sequence);
	return $this->bmwBuilder->getCarModel();

    }

}


/* 这个是牛叉公司的天下，要啥车就有啥车 */

$director = new Director();

/* 5量A类型的奔驰车 */
for($i = 0; $i < 5; $i++) {

    $director->getABenzBuilder()->run();
}

/* 5量B类型的本次车 */
for($i = 0; $i < 5; $i++) {

    $director->getBBenzBuilder()->run();
}

/* 5量C类型的本次宝马车 */
for($i = 0; $i < 5; $i++) {

    $director->getCBMWBuilder()->run();
}

/* 5量D类型的本次宝马车 */
for($i = 0; $i < 5; $i++) {

    $director->getDBMWBuilder()->run();
}


?>

<?php
/**
 * Hummer Model 是悍马车辆模型的意思，不是悍马美女车模
 */
abstract class HummerModel {

    /**
     * 首先这个模型要被发动起来，别管是手动还是电动，
     * 反正是要发动起来，那个实现要在实现类里
     */
    protected abstract function start();

    /**
     * 能发动起，那还有能停才是本事
     */
    protected abstract function stop();

    /**
     * 喇叭会出声是，滴滴叫，还是哗哗叫
     */
    protected abstract function alarm();

    /**
     * 引擎会轰轰响的，不响那是假的
     */
    protected abstract function enginBoom();

    /**
     * 那模型应该会跑吧，别管是人推，还是店里驱动，总之要会跑
     */
    final public function run() {
	
	//先发动汽车
	$this->start();

	//引擎开始轰鸣
	$this->enginBoom();

	//然后开始跑了，跑了一段时间遇到狗，按喇叭
	if($this->isAlarm()) {

	    $this->alarm();
	}

	//到达目的地就停车
	$this->stop();
    }

    /**
     * 钩子方法，默认喇叭是会响的
     */
    protected function isAlarm() {

	return true;
    }
}

/**
 * 悍马车是每个越野者的最爱，其中H1系列最接近军用系列
 */
class HummerH1Model extends HummerModel {
    
    private $alarmFlag = true;    //是否要想喇叭 

    public function alarm() {

	var_dump('悍马H1鸣笛...');
    }

    public function enginBoom() {

	var_dump('悍马H1引擎声音是这样在...');
    }

    public function start() {

	var_dump('悍马H1发动');
    }

    public function stop() {

	var_dump('悍马H1停车');
    }

    protected function isAlarm() {

	return $this->alarmFlag;
    }

    public function setAlarm($isAlarm) {

	$this->alarmFlag = $isAlarm;
    }

}

/**
 * H1和H2有什么差别，还真不知道，没接触过悍马
 */
class HummerH2Model extends HummerModel {
    public function alarm() {

	var_dump('悍马H2鸣笛...');
    }

    public function enginBoom() {

	var_dump('悍马H2引擎声音是这样在...');
    }

    public function start() {

	var_dump('悍马H2发动');
    }

    public function stop() {

	var_dump('悍马H2停车');
    }

    public function isAlarm() {

	return false;   //默认没有喇叭
    }


}

/* 模型造好，客服开始使用 */

$h1 = new HummerH1Model();
$h1->run();     //汽车h1跑起来

$h2 = new HummerH2Model();
$h2->run();    //汽车h2跑起来    


$hx1 = new HummerH1Model();
$hx1->setAlarm(true);
$hx1->run();

?>

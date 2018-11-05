<?php
// /**
//  *  在一个单位里谁都是员工，不管你是部门经理还是小兵
//  */
 
// abstract class Employee {
    
//     public static  $male   = 0;        //代表男性
//     public static $female  = 1;        //代表女性
    
//     private $name;                           //甭管谁，都有名字
//     private $salary = 0;                     //薪水
//     private $sex;                              //性别
    
//     public function getName() {
//         return $this->name;
//     }
    
//     public function setName($name) {
//         $this->name = $name;
//     }
    
//     public function getSalary() {
//         return $this->salary;
//     } 
    
//     public function setSalary($salary) {
//         $this->salary = $salary;
//     }
    
//     public function getSex() {
//         return $this->sex;
//     }
    
//     public function setSex($sex) {
//         $this->sex = $sex;
//     } 
    
//     public function report() {
        
//         $info  = "姓名：".$this->name."\t";
//         $info .= "性别：".($this->sex == self::$female ? "女" : "男")."\t";
//         $info .= "薪水：".$this->salary."\t";
//         $info .= $this->getOtherInfo();
//         var_dump($info);
//     }
    
//     /* 拼装员工的其他信息 */
//     protected abstract function getOtherInfo();  
// }

// /**
//  *  普通员工，也就是最小的兵了
//  */

// class CommonEmployee extends Employee {
    
//     /* 工作内容，这个非常重要，以后的职业规划就是靠这个 */
//     private $job;
    
//     public function getJob() {
//         return $this->job;
//     }
    
//     public function setJob($job) {
//         return $this->job = $job;
//     }
    
//     protected function getOtherInfo() {
//         return "工作：".$this->job."\t";
//     }
    
//     public function bbb() {
//         $this->aaaa = 'bbbbb';
//     }
    
//     public function aaaa() {
//         var_dump($this->aaaa);
//     }                                      
// }

// /**
//  *
//  */
// class Manager extends Employee {
    
//     /* 这类人的职责，非常明确：业绩 */
//     private $performance;
    
//     public function getPerformance() {
//         return $this->performance;
//     }
    
//     public function setPerformance($performance) {
//         $this->performance = $performance;
//     }
    
//     protected function getOtherInfo() {
//         return "业绩：".$this->performance."\t";
//     }
// }

// /* 模拟公司人员情况 */
// $emplist = array();

// /* 产生张三这个员工 */
// $zhangSan = new CommonEmployee();
// $zhangSan->setJob('编写Java，绝对的蓝领，苦工加搬运工');
// $zhangSan->setName('张三');
// $zhangSan->setSalary(1800);
// $zhangSan->setSex(Employee::$male);
// array_push($emplist, $zhangSan);

// /* 产生李四这个员工 */
// $liSi = new CommonEmployee();
// $liSi->setJob('页面美工, 审美素质太不流行了');
// $liSi->setName('李四');
// $liSi->setSalary(1900);
// $liSi->setSex(Employee::$female);
// array_push($emplist, $liSi);

// /* 在产生一个经理 */
// $wangWu = new Manager();
// $wangWu->setPerformance('基本上是负值');
// $wangWu->setName('王五');
// $wangWu->setSalary(18750);
// $wangWu->setSex(Employee::$male);
// array_push($emplist, $wangWu);
// foreach($emplist as $val) {
//     $val->report();
// }


/*上面的功能可以用访问者模式改造*/

/**
 * 访问者我要去访问人家数据
 * @author Administrator
 *
 */
interface IVisitor {
	//首先我可以访问普通员工
	public function visitCommon($obj_common = null);
	//首先我可以访问部门经理
	public function visitManager($obj_manager = null);
}

/**
 * 访问者实现
 * @author Administrator
 * 改造，增加薪水的统计功能
 */
class Visitor implements IVisitor {
	//部门经理工资系数是5
	private static  $MANAGER_COEFFICIENT = 5;
	
	//员工的工资系数是2
	private static  $COMMONEMPLOYEE_COEFFICIENT = 2;
	
	//普通员工的工资总和
	private $commonTotalSalary = 0;
	
	//部门经理工资总和
	private $manageTotalSalary = 0;
	
	//访问普通员工打印报表
	public function visitCommon($obj_common = null) {
		var_dump($this->getCommonEmployee($obj_common));
		//计算普通员工工资总和
		$this->calCommonSalay($obj_common->getSalary());	
	}
	
	//访问经理打印报表
	public function visitManager($obj_manage = null) {
		var_dump($this->getManagerInfo($obj_manage));
		//计算部门经理工资总和
		$this->calManangerSalary($obj_manage->getSalary());		
	}
	
	//组装基础信息
	private function getBaseInfo($obj) {
		$info = '姓名：'. $obj->getName()."\t";
		$info .= '性别:'.$obj->getSex()."\t";
		$info .= '薪水:'.$obj->getSalary()."\t";
		return $info;	
	}
	
	//获得经理信息
	private function getManagerInfo($obj_manager = null) {
		$baseinfo = $this->getBaseInfo($obj_manager);
		$otherinfo = '业绩:'.$obj_manager->getPerformance()."\t";
		return $baseinfo.$otherinfo;
	}
	
	//获得普通员工信息
	private function getCommonEmployee($obj_common = null) {
		$baseinfo = $this->getBaseInfo($obj_common);
		$otherinfo = '工作:'.$obj_common->getJob()."\t";
		return $baseinfo.$otherinfo;
	}

	//计算普通员工工资总和
	private function calCommonSalay($salary = 0) {
		$this->commonTotalSalary += $salary * self::$COMMONEMPLOYEE_COEFFICIENT;	
	}
	
	//计算总经理工资总和
	private function calManangerSalary($salary = 0) {
		$this->manageTotalSalary += $salary * self::$MANAGER_COEFFICIENT;
		
	}
	
	public function getTotalSalay() {
		return $this->commonTotalSalary + $this->manageTotalSalary;
	}
}

/**
 *  在一个单位里谁都是员工，不管你是部门经理还是小兵
 */

abstract class Employee {

	public static  $male   = 0;        //代表男性
	public static $female  = 1;        //代表女性

	private $name;                           //甭管谁，都有名字
	private $salary = 0;                     //薪水
	private $sex;                              //性别

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getSalary() {
		return $this->salary;
	}

	public function setSalary($salary) {
		$this->salary = $salary;
	}

	public function getSex() {
		return $this->sex;
	}

	public function setSex($sex) {
		$this->sex = $sex;
	}
	
	//允许一个访问者过来访问
	public function accpet($visitor = null) {}
}

class CommonEmployee extends Employee {

    /* 工作内容，这个非常重要，以后的职业规划就是靠这个 */
    private $job;

    public function getJob() {
        return $this->job;
    }

    public function setJob($job) {
        return $this->job = $job;
    }

    //允许访问者过来访问
    public function accept($visitor = null) {
    	$visitor->visitCommon($this);
    }
}

class Manager extends Employee {

    /* 这类人的职责，非常明确：业绩 */
    private $performance;

    public function getPerformance() {
        return $this->performance;
    }

    public function setPerformance($performance) {
        $this->performance = $performance;
    }

    //允许访问者来访问
    public function accept($visitor = null) {
    	$visitor->visitManager($this);
    }
}

/* 模拟公司人员情况 */
$emplist = array();

/* 产生张三这个员工 */
$zhangSan = new CommonEmployee();
$zhangSan->setJob('编写Java，绝对的蓝领，苦工加搬运工');
$zhangSan->setName('张三');
$zhangSan->setSalary(1800);
$zhangSan->setSex(Employee::$male);
array_push($emplist, $zhangSan);

/* 产生李四这个员工 */
$liSi = new CommonEmployee();
$liSi->setJob('页面美工, 审美素质太不流行了');
$liSi->setName('李四');
$liSi->setSalary(1900);
$liSi->setSex(Employee::$female);
array_push($emplist, $liSi);

/* 在产生一个经理 */
$wangWu = new Manager();
$wangWu->setPerformance('基本上是负值');
$wangWu->setName('王五');
$wangWu->setSalary(18750);
$wangWu->setSex(Employee::$male);
array_push($emplist, $wangWu);

$visitor = new Visitor();
foreach($emplist as $val) {
    $val->accept($visitor);
}
var_dump('本月的月工资总和为：'.$visitor->getTotalSalay()."\t");

//多个访问者的情况， 大家自己去实现以下， 上面的例子其实就可以拆成是两个访问者


?>
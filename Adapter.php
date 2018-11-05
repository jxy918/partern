<?php
/** 这 个模式也很简单，你笔记本上的那个拖在外面的黑盒子就是个适配器，一般你在中国能用，在日本也能用， 
 * 虽然两个国家的的电源电压不同，中国是 220V，日本是 110V，但是这个适配器能够把这些不同的电压转换 
 * 为你需要的 36V 电压，保证你的笔记本能够正常运行，那我们在设计模式中引入这个适配器模式是不是也 
 * 是这个意思呢？是的，一样的作用，两个不同接口，有不同的实现，但是某一天突然上帝命令你把 B 接口 
 * 转换为 A 接口，怎么办？继承，能解决，但是比较傻，而且还违背了 OCP 原则，怎么办？好在我们还有适配器模式。  
*/

/* 用户信息接口 */
interface IUserInfo {
    public function getUserName();           // 获得用户姓名
    public function getHomeAddress();        // 获得用户家庭地址
    public function getMobileNumber();       // 手机号码。这个挑重要了，泛滥啊
    public function getOfficeTelNumber();    // 办公电话，一般为座机
    public function getJobPosition();        // 这个人的职位是啥
    public function getHomeTelNumber();      // 获得家庭电话，这个有点缺德，我不喜欢往家里打电话
}


/* 实现接口 */

class UserInfo implements IUserInfo {
    /** 
     *  获得家庭地址，下属送礼好找对地方 
     */
    public function getHomeAddress() {
        var_dump('这是员工的家庭地址...');
    }
    
    /**
     * 获得家庭电话号码
     */
    public function getHomeTelNumber() {
        var_dump('获得家庭电话号码...');
    }
    
    /**
     * 员工的职位是部门经理，还是小兵
     */
    public function getJobPosition() {
        var_dump('这个人的职位是Boss');
    }
    
    /**
     * 手机号码
     */
    public function getMobileNumber() {
        var_dump('这个人的手机号是0000...');
    }
    
    /**
     *  办公室电话号码是
     */
    public function getOfficeTelNumber() {
        var_dump('办公室电话号码是...');
    }
    
    /**
     *  姓名了，这个老重要了，不要张冠李戴啊
     */
    function getUserName() {
        var_dump('姓名叫做...');
    }
}

/* 测试一下 */

$youngGirl = new UserInfo();

for($i = 0; $i <= 10; $i++) {
    $youngGirl->getMobileNumber();
}

/* 继续扩展，外系统的人员信息 */
interface IOuterUser {
    public function getUserBaseInfo();              // 基本信息，比如姓名，性别，手机号码等
    public function getUserOfficeInfo();            // 工作区域信息
    public function getUserHomeInfo();              // 用户家庭信息

}

/* 接口实现 */
class OuterUser implements IOuterUser {
    private $baseInfo   = array();
    private $officeInfo = array();
    private $homeInfo   = array();
   
   /**
    *  用户基本信息
    */       
    public function getUserBaseInfo() {
        $this->baseInfo['userName']     = 'outer：这个员工叫混世魔王';
        $this->baseInfo['mobileNumber'] = 'outer：这个员工手机是...';
        return $this->baseInfo;
        
    }
    
    /**
     *  员工家庭信息
     */
    public function getUserHomeInfo() {
        $this->homeInfo['homeTelNumber'] = 'outer：员工家庭电话...';
        $this->homeInfo['homeAddress']   = 'outer：员工的家庭地址是...';
        return $this->homeInfo;
    }
    
    /**
     *  员工的工作信息
     */
    public function getUserOfficeInfo() {
        $this->officeInfo['jobPosition']     = 'outer：这个人的职位是Boss';
        $this->officeInfo['officeTelNumber'] = 'outer：员工办公室号码1是：...';
        return $this->officeInfo;
    }                  
}

/* 那么怎么把外系统的用户信息包装成我们公司的人员信息呢？ 这就是我们的适配器了 */

/**
 * 把OuterUser包装称UserInfo
 */

class OuterUserInfo extends OuterUser implements IUserInfo {
    private $baseInfo;
    private $homeInfo;
    private $officeInfo;
    
    public function __construct() {
        $this->baseInfo   = parent::getUserBaseInfo();
        $this->homeInfo   = parent::getUserHomeInfo();
        $this->officeInfo = parent::getUserOfficeInfo(); 
    }
       
    /** 
     *  获得家庭地址，下属送礼好找对地方 
     */
    public function getHomeAddress() {
        var_dump($this->homeInfo['homeAddress']);
    }
    
    /**
     * 获得家庭电话号码
     */
    public function getHomeTelNumber() {
        var_dump($this->homeInfo['homeTelNumber']);
    }
    
    /**
     * 员工的职位是部门经理，还是小兵
     */
    public function getJobPosition() {
        var_dump($this->officeInfo['jobPosition']);
    }
    
    /**
     * 手机号码
     */
    public function getMobileNumber() {
        var_dump($this->baseInfo['mobileNumber']);
    }
    
    /**
     *  办公室电话号码是
     */
    public function getOfficeTelNumber() {
        var_dump($this->officeInfo['officeTelNumber']);
    }
    
    /**
     *  姓名了，这个老重要了，不要张冠李戴啊
     */
    public function getUserName() {
        var_dump($this->baseInfo['userName']);
    }    
}


/* 接口调用 */ 

/* 没有与外系统连接的时候，是这样写的 */ 

$youngGirl = new UserInfo(); 

/* 老板一想不对呀，兔子不吃窝边草，还是找人力资源的员工好点 */ 

$outerYoungGirl = new OuterUserInfo();  //我们只修改了这一句好 

//从数据库中查到101个 
for($i = 0; $i <= 10; $i++){ 
    $outerYoungGirl->getMobileNumber(); 
} 



?>
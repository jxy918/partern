<?php
/**
 *  成绩单抽象类
 */ 

abstract class SchoolReport {
    
    /* 成绩单的主要展示就是你的成绩 */
    public abstract function report();
    
    /* 成绩单要家长签字，这个是最要命的 */
    public abstract function sign($name);

}

/**
 *  四年级的成绩单，这个是我学校第一次实施，以前没有干过这种缺德事
 */

class FouthGradeSchoolReport extends SchoolReport {
    
    public function report() {
        var_dump('尊敬的家长：xxx');
        var_dump('.........');
        var_dump('语文：86 数学：65 体育：98 自然：65');
        var_dump('.........');
        var_dump('家长签字:');
    }
    
    public function sign($name) {
        var_dump('家长签字：'.$name);      
    }
}

/* 成绩单拿给父亲看，原装的没修改过的啊 */
$sr = new FouthGradeSchoolReport();
$sr->report();
/* 分数太低了，签字休想 */

/* 成绩不太理想对这个成绩单进行美化 */

class SugerFouthGradeSchoolReport extends FouthGradeSchoolReport {
    
    /* 首先定义要美化的方法, 先给老爸说学校最高成绩 */
    public function reportHighScore() {
        var_dump('这次考试语文最高是：75，数学：78，自然：80');
    }
    
    /* 在老爸看完成绩后，向老爸汇报学校排名情况 */
    public function reportSort() {
        var_dump('我的排名第38名');
    }
    
    /* 因为汇报内容发生变化，所以重写父类 */
    public function report() {
        $this->reportHighScore();           //先报学校最高分
        parent::report();                   //然后老爸看成绩单
        $this->reportSort();                //最后告诉学校排名
    }
}

var_dump('*********************1*********************');
$sr = new SugerFouthGradeSchoolReport();
$sr->report();
$sr->sign('老三');

/* 通过生面继承的确解决问题了，但是，要是情况很多，那就会造成类爆炸 ，很多类要写啊 ,累死了 */

/**
 * 装饰类，我们要把成绩单装饰一下
 */ 

abstract class Decorator extends SchoolReport {
    
    /* 首先要知道是那个通知单 */
    private $sr = null;
    
    public function __construct($sr) {
        $this->sr = $sr;
    }
    
    /* 成绩单还是要被看到 */
    public function report() {
        $this->sr->report();
        
    }
    
    /* 看完毕后还是要签名 */
    public function sign($name) {
        $this->sr->sign($name);
    }
}

/**
 *  我要把学校最高成绩告诉老爸
 */

class HighScoreDecorator extends Decorator {
    
    public function __construct($sr) {
        parent::__construct($sr);    
    }
    
    /* 我要汇报最高成绩 */
    private function reportHighScore() {
        var_dump('这次考试语文最高是：75，数学：78，自然：80');
    }
    
    /* 老爸看成绩单，先告诉他最高成绩，再看成绩单，要不然等着挨棍子 */
    public function report() {
        $this->reportHighScore();
        parent::report();
    }
}

/**
 * 学校排名情况汇报
 */

class SortDecorator extends Decorator {
    
    public function __construct($sr) {
        parent::__construct($sr);
    }
    
    /* 告诉老爸学校的排名情况 */
    private function reportSort() {
        var_dump('我是排名第38名...');
    }
    
    /* 老爸看完成绩单后，在告诉他我的排名情况，加强作用 */
    public function report() {
        parent::report();
        $this->reportSort();
    }
}
/* 老爸开始看成绩单了啊 */
var_dump('*********************2*********************'); 

$sr = new FouthGradeSchoolReport();       //原装的成绩单

$sr = new HighScoreDecorator($sr);        //加了最高分说明的成绩单

$sr = new SortDecorator($sr);             //又增加了排名的说明

$sr->report();      //看成绩单
$sr->sign('老三')   //高兴签字了


/* 装饰器模式很好的对继承进行了补充 */
 
?>
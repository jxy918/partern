<?php
/**
 * 大家都是高智商的人，都写过纸质的信件吧，比如给女朋友写情书什么的，写信 
 * 的过程大家都还记得吧，先写信的内容，然后写信封，然后把信放到信封中，封好，投递到信箱中进行邮 
 * 递，这个过程还是比较简单的，虽然简单，这四个步骤都是要跑的呀，信多了还是麻烦，比如到了情人节， 
 * 为了大海捞针，给十个女孩子发情书，都要这样跑一遍，你不要累死，更别说你要发个广告信啥的，一下 
 * 子发 1 千万封邮件，那不就完蛋了？那怎么办呢？还好，现在邮局开发了一个新业务，你只要把信件的必 \
 * 要信息高速我，我给你发，我来做这四个过程，你就不要管了，只要把信件交给我就成了。  
 */              


interface LetterProcess {
    public function writeContext($context);                // 首先写信内容
    public function fillEnvelope($address);                // 其次写信封
    public function letterIntoEnvelope();          // 把信放入信封
    public function sendLetter();                  // 发信
}

/* 写信的具体实现 */

class LetterProcessImpl implements LetterProcess {
    // 写信
    public function writeContext($context) {
        var_dump('填写写信内容：'.$context);    
    }
    
    // 在信封天禧详细信息
    public function fillEnvelope($address) {
        var_dump('填写收件人姓名及地址：'.$address);
    }
    
    // 把信放到信封中，封好
    public function letterIntoEnvelope() {
        var_dump('把信放入信封...');
    }
    
    // 塞到邮箱中，邮递
    public function sendLetter() {
        var_dump('邮递信件...');
    }
}

/* 有人开始发邮递了啊 */

$letter_process = new LetterProcessImpl();

$letter_process->writeContext('Hello,It is me,do you know who I am ? I am your old lover,I do like to ....');
$letter_process->fillEnvelope('Happy Load No. 666,God Province Haven');
$letter_process->letterIntoEnvelope();
$letter_process->sendLetter();

/* 问题：这个过程与高内聚的要求相差甚远，你想，你要知道这四个步骤，而且还要知道这四个步骤的顺序， 一旦出错，信就不可能邮寄出去，那我们如何来改进呢？*/

class ModenPostOffice {
    private $LetterProcess;
    private $police;
    
    public function __construct() {
        $this->LetterProcess = new LetterProcessImpl();
        $this->Police        = new Police();
    }
    
    /* 写信，封装，投递，一体化 */
    public function sendLetter($context,$address) {   
        $this->LetterProcess->writeContext($context);    // 帮你写信
        $this->LetterProcess->fillEnvelope($address);    // 写好信封
        $this->LetterProcess->letterIntoEnvelope();      // 把信放入信封
        $this->Police->checkLetter($this->LetterProcess); // 警察要检查信封了
        $this->LetterProcess->sendLetter();              // 邮递信件
    }  

}

class Police {
    public function checkLetter($obj_letter_process) {
        var_dump('警察检查信封...');
    }
}

/* 说明：邮局提供一种新型服务，把这些服务都一体化了 */
$modenpostoffice = new ModenPostOffice();
$modenpostoffice->sendLetter('Hello,It is me,do you know who I am ? I am your old lover,I do like to ....','Happy Load No. 666,God Province Haven');

?>
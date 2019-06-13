<?php
/*
 * 装饰器模式，又名包装(Wrapper)模式，该模式向一个已有的对象添加新的功能，而不改变其结构。
 * 装饰器模式是典型的基于对象组合的方式，可以很灵活的给对象添加所需要的功能，
 * */

//邮件模板生成的例子
/*
 * 邮件内容接口， 规范实现类
 * */
interface EmailBody{
    public function body();
}

//正常邮件内容
class MainEmail implements EmailBody {
    public function body()
    {
        echo "The company is ready to raise your salary by 50%. \n";
    }
}

//然后是主装饰器类，这个类用属性保存MainEmail类的对象，然后根据需要改变它的行为。
/*
 * 邮件内容装饰器
 * */
abstract class EmailBodyDecorator implements EmailBody {
    // 保存MainEmail类对象
    protected $emailBody;

    // 实例化这个类或者子类时，必须传入一个被修饰的对象
    public function __construct(EmailBody $emailBody){
        $this->emailBody = $emailBody;
    }

    // 用抽象方法声明EmailBody规定的方法，
    // 在子类中用来改变MainEmail对象的行为
    abstract public function body();
}

//装饰器的子类
class NewYearEmail extends EmailBodyDecorator {
    public function body() {
        echo "Happly new year! \n";
        $this->emailBody->body();
    }
}

class SpringFestivalEmail extends EmailBodyDecorator {
    public function body() {
        echo "Spring Festival! \n";
        $this->emailBody->body();
    }
}


//Client
$email = new MainEmail();
$email->body();

$emailNewYear = new NewYearEmail($email);
$emailNewYear->body();

/**
 * 发送有【春节】祝福的邮件
 * 输出： 春节快乐！公司准备为您加薪50%。
 */
$emailSpring = new SpringFestivalEmail($email);
$emailSpring->body();

/**
 * 发送同时有【元旦】和【春节】祝福的邮件
 * 输出： 春节快乐！元旦快乐！公司准备为您加薪50%。
 */
$emailTwo = new SpringFestivalEmail($emailNewYear);
$emailTwo->body();
<?php
/*
 * 观察者模式，也称发布-订阅模式，定义了一个被观察者和多个观察者的、一对多的对象关系。
 * 在被观察者状态发生变化的时候，它的所有观察者都会收到通知，并自动更新。
 *
 * 观察者模式通常用在实时事件处理系统、组件间解耦、数据库驱动的消息队列系统，同时也是MVC设计模式中的重要组成部分。
 *
 * 以下我们以订单创建为例:
 *  当订单创建后，系统会发送邮件和短信，并保存日志记录。
 * */

//观察者接口
interface Observer {
    //接收到通知的处理方法
    public function update(Observable $observable);
}

//被观察者接口
interface Observable {
    //添加 注册观测者
    public function attach(Observer $observer);
    //删除观察者
    public function detach(Observer $observer);
    //触发通知
    public function notify();
}

/**
 * 被观察者
 * 职责：添加观察者到$observers属性中，
 * 有变动时通过notify()方法运行通知
 */
class Order implements Observable {
    //保存观察者
    private $observers = array();
    //订单状态
    private $state = 0;

    //添加（注册）观察者
    public function attach(Observer $observer) {
        $key = array_search($observer, $this->observers);
        if($key === false){
            $this->observers[] = $observer;
        }
    }

    //移除观察者
    public function detach(Observer $observer) {
        $key = array_search($observer, $this->observers);
        if ($key !== false){
            unset($this->observers[$key]);
        }
    }

    //遍历调用观察者的update()方法进行通知，不关心其具体实现方式
    public function notify() {
        foreach ($this->observers as $observer) {
            //把本类对象传给观察者， 以便观察者获取当前类目对象的信息
            $observer->update($this);
        }
    }

    //订单状态有变化时发送通知
    public function addOrder(){
        $this->state = 1;
        $this->notify();
    }

    //获取提供给观察者的状态
    public function getState() {
        return $this->state;
    }
}


//观察者
/*
 * 观察者1： 发送邮件
 * */
class Email implements Observer {
    public function update(Observable $observable)
    {
        $state = $observable->getState();
        if($state) {
            echo "Send Email: You have placed the order successfully. \n";
        }else{
            echo "Send Email: Placed the order Failed! \n";
        }
    }
}

/*
 * 观察者2： 短信通知
 * */
class Message implements Observer {
    public function update(Observable $observable) {
        $state = $observable->getState();
        if($state) {
            echo "Short Message: You have placed the order successfully. \n";
        }else{
            echo "Short Message: Placed the order Failed! \n";
        }
    }
}

/*
 * 观察者3： 记录日志
 * */
class Log implements Observer {
    public function update(Observable $observable)
    {
        echo "Logs: Create one order logs! \n";
    }
}

// 创建观察者对象
$email = new Email();
$message = new Message();
$log = new Log();
// 创建订单对象
$order = new Order();

// 向订单对象中注册3个观察者：发送邮件、短信通知、记录日志
$order->attach($email);
$order->attach($message);
$order->attach($log);
// 添加订单，添加时会自动发送通知给观察者
$order->addOrder();

echo "--------------------------------> \n";
// 删除记录日志观察者
$order->detach($log);
// 添加另一个订单，会再次发送通知给观察着
$order->addOrder();

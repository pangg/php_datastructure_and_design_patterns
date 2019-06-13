<?php
/*
 * 适配器模式，
 * 即根据客户端需要，将某个类的接口转换成特定样式的接口，以解决类之间的兼容问题。
 * 如果我们的代码依赖一些外部的API，或者依赖一些可能会经常更改的类，那么应该考虑用适配器模式
 * */

//支付宝支付类
class Alipay {
    public function sendPayment(){
        echo "Using Alipay! \n";
    }
}

/*
 *适配器接口，所有的支付适配器都需实现这个接口。
 * 不管第三方支付实现方式如何，对于客户端来说，都
 * 用pay()方法完成支付
 * */
interface PayAdapter {
    public function pay();
}

/*
 * 支付宝适配器
 * */
class AlipayAdapter implements PayAdapter {
    public function pay() {
        //实例化Alipay, 并用Alipay的方法实现支付
        $alipay = new Alipay();
        $alipay->sendPayment();
    }
}


/*
 *  支付扩展
 *  添加微信扫码支付
 * */
class WechatPay {
    public function scan(){
        echo "Sweep code payment! \n";
    }

    public function dopay(){
        echo "Using WechatPay ! \n";
    }
}

/*
 *  微信支付适配器
 * */
class WechatPayAdapter implements PayAdapter {
    public function pay() {
        // 实例化WechatPay类，并用WechatPay的方法实现支付。
        // 注意，微信支付的方式和支付宝的支付方式不一样，但是
        // 适配之后，他们都能用pay()来实现支付功能。
        $wechatPay = new WechatPay();
        $wechatPay->scan();
        $wechatPay->dopay();
    }
}

//客户端代码
//Alipay支付
$alipay = new AlipayAdapter();
$alipay->pay();

//微信支付
$wechat = new WechatPayAdapter();
$wechat->pay();
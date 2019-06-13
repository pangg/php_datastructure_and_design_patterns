<?php
/*
 * 工厂方法模式：
 *定义一个创建对象的接口，让子类决定哪个类实例化。
 * 他可以解决简单工厂模式中的封闭开放原则问题。
 * */
interface people {
    public function jiehun();
}

class man implements people {
    public function jiehun(){
        echo "Give roses, give rings! \n";
    }
}

class women implements people {
    public function jiehun(){
        echo "Wear wedding dress! \n";
    }
}

interface createMan {
    public function create();
}

class FactoryMan implements createMan {
    public function create() {
        return new man;
    }
}

class FactoryWomen implements createMan {
    public function create() {
        return new women;
    }
}

class Client {
    //factory function
    public function test() {
        $Factory = new FactoryMan();
        $man = $Factory->create();
        $man->jiehun();

        $Factory = new FactoryWomen;
        $women = $Factory->create();
        $women->jiehun();
    }
}

$f = new Client;
$f->test();
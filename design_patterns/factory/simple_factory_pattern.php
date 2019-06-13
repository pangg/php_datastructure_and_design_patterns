<?php
/*
 * 简单工厂又叫静态工厂方法模式，这样理解可以确定，
 * 简单工厂模式是通过一个静态方法创建对象的。
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
class SimpleFactory {
    // 简单工厂里的静态方法
    static function createMan(){
        return new man;
    }

    static function createWomen(){
        return new women;
    }
}

$man = SimpleFactory::createMan();
$man->jiehun();
$women = SimpleFactory::createWomen();
$women->jiehun();
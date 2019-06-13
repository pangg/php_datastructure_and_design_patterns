<?php
/*
 *  类之间关系
 *  六种：继承、实现、组合、聚合、关联和依赖
 * */

/*
 * 继承
 * 继承关系也称泛化关系（Generalization），用于描述父类与子类之间的关系。
 * 父类又称作基类，子类又称作派生类。
 * 继承关系中，子类继承父类的所有功能，父类所具有的属性、方法，子类应该都有。
 * 子类中除了与父类一致的信息以外，还包括额外的信息。
 *
 * 例如：公交车、出租车和小轿车都是汽车，他们都有名称，并且都能在路上行驶。
 * */
class Car {
    public $name;
    public function run(){
        return 'running';
    }
}

class Bus extends Car {
    public function __construct(){
        $this->name = 'Bus';
    }
}

class Taxi extends Car {
    public function __construct(){
        $this->name = 'Taxi';
    }
}

$line2 = new Bus;
echo $line2->name . ' ' . $line2->run();
<?php
/*
 *  类之间关系
 *  六种：继承、实现、组合、聚合、关联和依赖
 * */

/*
 * 实现
 * 接口（包括抽象类）是方法的集合，在实现关系中，
 * 类实现了接口，类中的方法实现了接口声明的所有方法。
 *
 * 例如：汽车和轮船都是交通工具，而交通工具只是一个可移动工具的抽象概念，
 * 船和车实现了具体移动的功能。
 * */
interface Vehicle {
    public function run();
}

class Car implements Vehicle {
    public $name = 'Bus';
    public function run() {
        return $this->name . ' running on the road';
    }
}

class Ship implements Vehicle {
    public $name = 'Ship';
    public function run()
    {
        return $this->name . ' on the sea';
    }
}

$car = new Car();
echo $car->run();
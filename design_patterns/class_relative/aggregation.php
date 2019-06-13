<?php
/*
 *  类之间关系
 *  六种：继承、实现、组合、聚合、关联和依赖
 * */

/*
 * 聚合关系
 * 聚合关系（Aggregation）：整体和部分的关系，整体与部分可以分开。
 * 聚合关系也表示类之间整体与部分的关系，成员对象是整体对象的一部分，但是成员对象可以脱离整体对象独立存在。
 *
 * 例如：公交车司机和工衣、工帽是整体与部分的关系，但是可以分开，
 * 工衣、工帽可以穿在别的司机身上，公交司机也可以穿别的工衣、工帽。
 * */
class Clothes {
    public $name = 'Clothes';
}

class Hat {
    public $name = 'Hat';
}

class Driver {
    public $clothes;
    public $hat;

    public function wearClothes(Clothes $clothes){
        $this->clothes = $clothes;
    }

    public function wearHat(Hat $hat){
        $this->hat = $hat;
    }

    public function show(){
        return sprintf('Driver has %s and %s !', $this->clothes->name,
            $this->hat->name);
    }
}

$driver = new Driver();
$driver->wearClothes(new Clothes());
$driver->wearHat(new Hat());
echo $driver->show();
<?php
/*
 * 抽象工厂模式
 * */
interface Cat {
    public function Voice();
}

interface Dog {
    public function Voice();
}

class BlackCat implements Cat {
    public function Voice() {
        echo "Black Cat miaomiaomiao... \n";
    }
}

class WhiteCat implements Cat {
    public function Voice() {
        echo "White Cat miaomiaomiao \n";
    }
}

class BlackDog implements Dog {
    public function Voice(){
        echo "Black Dog wangwangwang... \n";
    }
}

class WhiteDog implements Dog {
    public function Voice(){
        echo "White Dog wangwangwagng... \n";
    }
}


interface AnimalFactory {
    public function createCat();
    public function createDog();
}

class BlackAnimalFactory implements AnimalFactory {
    public function createCat() {
        return new BlackCat();
    }
    public function createDog()
    {
        return new BlackDog();
    }
}

class WhiteAnimalFactory implements AnimalFactory {
    public function createCat()
    {
        return new WhiteCat();
    }
    public function createDog()
    {
        return new WhiteDog();
    }
}

class Client {
    public static function main(){
        self::run(new BlackAnimalFactory());
        self::run(new WhiteAnimalFactory());
    }

    public static function run (AnimalFactory $animalFactory){
        $cat = $animalFactory->createCat();
        $cat->Voice();

        $dog = $animalFactory->createDog();
        $dog->Voice();
    }
}

Client::main();
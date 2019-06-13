<?php
/*
 *  类之间关系
 *  六种：继承、实现、组合、聚合、关联和依赖
 * */

/*
 * 组合关系
 * 整体与部分的关系，但是整体与部分不可以分开。
 * 组合关系表示类之间整体与部分的关系，整体和部分有一致的生存期。
 * 一旦整体对象不存在，部分对象也将不存在，是同生共死的关系。
 *
 * 例如：人由头部和身体组成，两者不可分割，共同存在。
 * */
class Head {
    public $name = 'Head';
}

class Body {
    public $name = 'Body';
}

class Human {
    public $head;
    public $body;

    public function setHead(Head $head){
        $this->head = $head;
    }

    public function setBody(Body $body){
        $this->body = $body;
    }

    public function display(){
        return sprintf('Human has %s and %s!', $this->head->name, $this->body->name);
    }
}

$man = new Human();
$man->setHead(new Head());
$man->setBody(new Body());
echo $man->display();
<?php
/*
 * 策略模式定义了一族相同类型的算法，算法之间独立封装，并且可以互换代替。
 * 这些算法是同一类型问题的多种处理方式，他们具体行为有差别。
 * 每一个算法、或说每一种处理方式称为一个策略。
 *
 * 以数组输出为例:
 * 数组的输出有序列化输出、JSON字符串输出和数组格式输出等方式。
 * 每种输出方式都可以独立封装起来，作为一个策略。
 * */

/*
 * 策略接口
 * */
interface OutputStrategy {
    public function render($array);
}

/*
 * 策略类1：返回序列化字符串
 * */
class SerializeStrategy implements OutputStrategy {
    public function render($array) {
        return serialize($array);
    }
}

/*
 * 策略类2： 返回JSON编码后的字符串
 * */
class JsonStrategy implements OutputStrategy {
    public function render($array){
        return json_encode($array);
    }
}

/*
 * 策略类3： 直接返回数组
 * */
class ArrayStrategy implements OutputStrategy {
    public function render($array){
        return $array;
    }
}


//环境角色用来管理策略，实现不同策略的切换功能。
/*
 *  环境角色类
 * */
class Output {
    private $outputStrategy;

    // 传入的参数必须是策略接口的子类或子类的实例
    public function __construct(OutputStrategy $outputStrategy) {
        $this->outputStrategy = $outputStrategy;
    }

    public function renderOutput($array){
        return $this->outputStrategy->render($array);
    }
}


//Client
$test = ['a', 'b', 'c'];

//array
$output = new Output(new ArrayStrategy());
$data = $output->renderOutput($test);
var_dump($data);

//json
$output = new Output(new JsonStrategy());
$data = $output->renderOutput($test);
var_dump($data);
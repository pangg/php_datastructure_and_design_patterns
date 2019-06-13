<?php

class data {
    private $data;

    public function __construct($data=null){
        $this->data = $data;
        echo $data . ": Push Stack \n";
    }

    public function getData(){
        return $this->data;
    }

    public function __destruct(){
        echo $this->data . ": Pop Stack \n";
    }
}

class stack{
    private $size;
    private $top;
    private $stack = array();

    public function __construct($size){
        $this->Init_Stack($size);
    }

    public function Init_Stack($size){
        $this->size = $size;
        $this->top = -1;
    }

    public function Empty_Stack(){
        if($this->top == -1)
            return 1;
        else
            return 0;
    }

    public function Full_Stack(){
        if($this->top < ($this->size - 1))
            return 0;
        else
            return 1;
    }

    public function Push_Stack($data){
        if($this->Full_Stack())
            echo "Stack Full \n";
        else
            $this->stack[++$this->top] = new data($data);
    }

    public function Pop_Stack(){
        if($this->Empty_Stack())
            echo "Stack Empty \n";
        else
            unset($this->stack[$this->top--]);
    }

    public function Top_Stack(){
        return $this->Empty_Stack() ? "Stack No Data \n" : $this->stack[$this->top]->getData();
    }

}

$stack = new stack(4);
//$stack->Pop_Stack();
$stack->Push_Stack("aa");
$stack->Push_Stack("aa1");
//$stack->Pop_Stack("aa1");
$stack->Push_Stack("aa2");
$stack->Push_Stack("aa3");
$stack->Push_Stack("aa4");
$stack->Push_Stack("aa5");

echo $stack->Top_Stack() . "\n";

$stack->Pop_Stack();
$stack->Pop_Stack();
$stack->Pop_Stack();
$stack->Pop_Stack();
$stack->Pop_Stack();
$stack->Pop_Stack();
<?php

class data{
    private $data;
    public function __construct($data){
        $this->data = $data;
        echo $data . ": Enqueue \n";
    }

    public function getData(){
        return $this->data;
    }

    public function __destruct(){
        echo $this->data . ": Dequeue \n";
    }
}

class queue{
    protected $front;
    protected $rear;
    protected $queue = array(0=>'QueueEnd');
    protected $maxsize;

    public function __construct($size){
        $this->initQ($size);
    }

    private function initQ($size){
        $this->front = 0;
        $this->rear = 0;
        $this->maxsize = $size;
    }

    public function QIsEmpty(){
        return $this->front == $this->rear;
    }

    public function QIsFull(){
        return ($this->front - $this->rear) == $this->maxsize;
    }

    public function getFrontData(){
        return $this->queue[$this->front]->getData();
    }

    public function InQ($data){
        if($this->QIsFull()){
            echo $data . ": Is Full \n";
        }else{
            $this->front++;
            for ($i=$this->front; $i>$this->rear;$i--){
                if(isset($this->queue[$i]) && $this->queue[$i]){
                    unset($this->queue[$i]);
                }
                if(isset($this->queue[$i-1])) {
                    $this->queue[$i] = $this->queue[$i - 1];
                }
            }
            $this->queue[$this->rear+1] = new data($data);

            echo $data . ": Push Queue Success \n";
        }
    }

    public function OutQ(){
        if($this->QIsEmpty()){
            echo "Queue Is Empty! \n";
        }else{
            unset($this->queue[$this->front]);
            $this->front --;
            echo "Pop Queue Success \n";
        }
    }
}

$q = new queue(3);
$q->InQ("xiaomiao");
$q->InQ("mashuai");
$q->InQ("liubing");
$q->InQ("zhangshijia");
$q->OutQ();
$q->InQ("zhouruixiao");
$q->OutQ();
$q->OutQ();
$q->OutQ();
$q->OutQ();
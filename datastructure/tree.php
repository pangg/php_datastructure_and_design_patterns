<?php

class Node_tree {
    public $leftNode = null;
    public $rightNode = null;
    public $parentNode = null;
    public $data;

    function __construct($value=null){
        $this->update($value);
    }

    function update($newValue) {
        $this->data = $newValue;
    }

    protected function _formatNode($value){
        if(!($value instanceof Node_tree)){
            $value = new Node_tree($value);
        }
        $value->parentNode = $this;
        return $value;
    }

    function setLeft($value){
        $node = $this->_formatNode($value);
        $this->leftNode = $node;
    }

    function setRight($value){
        $value = $this->_formatNode($value);
        $this->rightNode = $value;
    }

    //树的深度
    static function depth($tree) {
        $leftDepth = 0;
        $rightDepth = 0;
        if($tree->leftNode){
            $leftDepth = self::depth($tree->leftNode);
        }
        if($tree->rightNode){
            $rightDepth = self::depth($tree->rightNode);
        }
        return max($leftDepth, $rightDepth) + 1;
    }

    //节点层次
    function level() {
        $count = 1;
        $parentNode = $this->parentNode;
        while ($parentNode) {
            $parentNode = $parentNode->parentNode;
            $count++;
        }
        return $count;
    }

    //节点数量
    static function length($tree){
        $leftTreeLength = 0;
        $rightTreeLength = 0;
        if($tree->leftNode){
            $leftTreeLength = self::length($tree->leftNode);
        }
        if($tree->rightNode){
            $rightTreeLength = self::length($tree->rightNode);
        }
        return $leftTreeLength + $rightTreeLength + 1;
    }

    static function preOrderTraversal($tree, $fn){
        if(!($tree instanceof Node_tree)){
            return false;
        }
        if(is_callable($fn, $tree)){
            $fn($tree->data);
        }
        self::preOrderTraversal($tree->leftNode, $fn);
        self::preOrderTraversal($tree->rightNode, $fn);
    }

    static function inOrderTraversal($tree, $fn){
        if(!($tree instanceof Node_tree)){
            return false;
        }

        self::inOrderTraversal($tree->leftNode, $fn);
        if(is_callable($fn, true)){
            $fn($tree->data);
        }
        self::inOrderTraversal($tree->rightNode, $fn);
    }

    static function postOrderTraversal($tree, $fn){
        if(!($tree instanceof Node_tree)){
            return false;
        }
        self::postOrderTraversal($tree->leftNode, $fn);
        self::postOrderTraversal($tree->rightNode, $fn);
        if(is_callable($fn, true)){
            $fn($tree->data);
        }
    }

    static function levelOrderTraversal($tree, $fn){
        if(!($tree instanceof Node_tree)){
            return false;
        }
        $queue = [];
        array_push($queue, $tree);
        while (!empty($queue)){
            $node = array_shift($queue);
            if(is_callable($fn, true)){
                $fn($node->data);
            }
            if($node->leftNode){
                array_push($queue, $node->leftNode);
            }
            if($node->rightNode){
                array_push($queue, $node->rightNode);
            }
        }
        return true;
    }

    static function invertBinaryTree1($tree){
        if(!($tree instanceof Node_tree)){
            return false;
        }

        $temp = $tree->leftNode;
        $tree->leftNode = $tree->rightNode;
        $tree->rightNode = $temp;
        self::invertBinaryTree1($tree->leftNode);
        self::invertBinaryTree1($tree->rightNode);
        return true;
    }

    static function invertBinaryTree2($tree){
        if(!($tree instanceof Node_tree)){
            return false;
        }
        $queue = [];
        array_push($queue, $tree);
        while(!empty($queue)){
            $node = array_shift($queue);
            if($node->leftNode){
                array_push($queue, $node->leftNode);
            }
            if($node->rightNode){
                array_push($queue, $node->rightNode);
            }

            $temp = $node->leftNode;
            $node->leftNode = $node->rightNode;
            $node->rightNode = $temp;
        }
        return true;
    }
}
<?php
/*
 * 二叉查找树(Binary Search Tree)，又被称为二叉搜索树。
 * 设x为二叉查找树中的一个结点，x节点包含关键字key，节点x的key值记为key[x]。
 * 如果y是x的左子树中的一个结点，则key[y] <= key[x]；如果y是x的右子树的一个结点，则key[y] >= key[x]。
 *
 * 在二叉查找树中：
 *       (01) 若任意节点的左子树不空，则左子树上所有结点的值均小于它的根结点的值；
 *       (02) 任意节点的右子树不空，则右子树上所有结点的值均大于它的根结点的值；
 *       (03) 任意节点的左、右子树也分别为二叉查找树。
 *       (04) 没有键值相等的节点（no duplicate nodes）。
 * */
class Node {
    public $key, $value, $left, $right;

    public function __construct($key, $value){
        $this->key = $key;
        $this->value = $value;
        $this->left = $this->right = null;
    }
}

class BST {
    /**
     * @var $count 当前二叉搜索树中的节点数
     * @var $root 当前二叉搜索树
     */
    private $count, $root;

    public function __construct(){
        $this->root = null;
        $this->count = 0;
    }

    public function __destruct(){
        $this->destroy($this->root);
    }

    public function size(){
        return $this->count;
    }

    public function isEmpty(){
        return $this->count == 0;
    }

    public function insert($key, $value){
        $this->__insert($this->root, $key, $value);
    }

    public function contain($key){
        return $this->__contain($key);
    }

    public function search($key){
        return $this->__search($this->root, $key);
    }

    public function preOrder(){
        $this->__preOrder($this->root);
    }

    public function inOrder(){
        $this->__inOrder($this->root);
    }

    public function afterOrder(){
        $this->__afterOrder($this->root);
    }

    private function destroy(&$node){
        if($node != null){
            if($node->left != null){
                $this->destroy($node->left);
            }
            if($node->right != null){
                $this->destroy($node->right);
            }
            unset($node);
            $this->count --;
        }
    }

    private function __afterOrder(&$node){
        if($node != null){
            $this->__afterOrder($node->left);
            $this->__afterOrder($node->right);
            echo $node->key ."\n";
        }
    }

    private function __inOrder(&$node){
        if($node != null){
            $this->__inOrder($node->left);
            echo $node->key . "\n";
            $this->__inOrder($node->right);
        }
    }

    private function __preOrder(&$node){
        if($node != null){
            echo $node->key . "\n";
            $this->__preOrder($node->left);
            $this->__preOrder($node->right);
        }
    }

    private function __search(&$node, $key){
        if($node == null){
            return null;
        }
        if($key == $node->key)
            return $node->value;
        else if ($key < $node->key)
            return $this->__search($node->left, $key);
        else
            return $this->__search($node->right, $key);
    }

    //在以node为根的二叉搜索树中查找key是否存在
    private function __contain(&$node, $key){
        if($node == null)
            return false;
        if ($key == $node->key)
            return true;
        else if ($key < $node->key)
            return $this->__contain($node->left, $key);
        else
            return $this->__contain($node->right, $key);
    }

    private function __insert(&$node, $key, $value){
        if($node == null){
            $this->count ++;
            $node = new Node($key, $value);
        }
        if($key == $node->key)
            $node->value = $value;
        else if($key < $node->key)
            $this->__insert($node->left, $key, $value);
        else
            $this->__insert($node->right, $key, $value);

    }
}

$bst = new BST();
$bst->insert(1, 'jiang');
$bst->insert(4, 'jiang4');
$bst->insert(3, 'jiang3');
$bst->insert(2, 'jiang3');
/*           1
 *            \
 *             4
 *            /
 *           3
 *          /
 *         2
 * */
$bst->preOrder();
echo "--------------------------\n";
$bst->inOrder();
echo "--------------------------\n";
$bst->afterOrder();
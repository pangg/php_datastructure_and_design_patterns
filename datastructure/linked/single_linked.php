<?php

class node{
    public $id;
    public $name;
    public $next;
    public function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
        $this->next = null;
    }
}

class singelLinkList  {
    private $header;

    public function __construct($id=null, $name=null){
        $this->header = new node($id, $name, null);
    }

    public function getLinkLength(){
        $i = 0;
        $current = $this->header;
        while ($current->next != null){
            $i++;
            $current = $current->next;
        }
        return $i;
    }

    public function addLink($node) {
        $current = $this->header;
        while ($current->next != null){
            if($current->next->id > $node->id){
                break;
            }
            $current = $current->next;
        }
        $node->next = $current->next;
        $current->next = $node;
    }

    public function delLink($id){
        $current = $this->header;
        $flag = false;
        while ($current->next != null){
            if ($current->next->id == $id){
                $flag = true;
                break;
            }
            $current = $current->next;
        }
        if($flag){
            $current->next = $current->next->next;
        }else{
            echo '未找到id=' . $id . '的节点！<br />';
        }
    }

    public function isEmpty(){
        return $this->header == null;
    }

    public function clear(){
        $this->header = null;
    }

    public function getLinkList(){
        $current = $this->header;
        if($current->next == null){
            echo ("链表为空 \n");
            return;
        }
        while ($current->next != null){
            echo 'id:' . $current->next->id . '  name: ' . $current->next->name ." \n";
            if($current->next->next == null){
                break;
            }
            $current = $current->next;
        }
    }

    public function getLinkNameById($id){
        $current = $this->header;
        if($current->next == null){
            echo "链表为空！\n";
            return;
        }
        while ($current->next != null){
            if($current->id == $id){
                break;
            }
            $current = $current->next;
        }
        return $current->name;
    }

    public function updateLink($id, $name){
        $current = $this->header;
        if($current->next == null){
            echo "链表为空！";
            return;
        }
        while ($current->next != null){
            if($current->id == $id){
                break;
            }
            $current = $current->next;
        }
        return $current->name = $name;
    }

}

$lists = new singelLinkList();
$lists->addLink(new node(5, 'eeeeeeee'));
$lists->addLink(new node(1, 'aaaaaaaa'));
$lists->addLink(new node(6, 'ffffffff'));
$lists->addLink(new node(4, 'dddddddd'));
$lists->addLink(new node(3, 'cccccccc'));
$lists->addLink(new node(2, 'bbbbbbbb'));
$lists->getLinkList();

echo "\n--------Delete Linked-------------- \n";
$lists->delLink(5);
$lists->getLinkList();

echo "\n----------Update Linked----------- \n";
$lists->updateLink(3, '2222222222');
$lists->getLinkList();

echo "\n----------Get linked-------------- \n";
echo $lists->getLinkNameById(2);

echo "\n-----------Get linke length---------- \n";
echo $lists->getLinkLength();


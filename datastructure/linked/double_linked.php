<?php

class Rank {
    public $pre = null;
    public $next = null;
    public $id;
    public $username;

    public function __construct($id=0, $username=''){
        $this->id = $id;
        $this->username = $username;
    }

    public static function addRank($head, $rank){
        $cur = $head;
        $isExist = false;
        while ($cur->next != null){
            if($cur->next->id > $rank->id){
                break;
            }else if($cur->next->id == $rank->id){
                $isExist = true;
                echo "\n 不能添加相同的id \n";
                return;
            }
            $cur = $cur->next;
        }

        if(!$isExist){
            if($cur->next != null){
                $rank->next = $cur->next;
            }
            $rank->pre = $cur;
            if($cur->next != null){
                $cur->next->pre = $rank;
            }
            $cur->next = $rank;
        }
    }

    public static function delRank($head, $rankid){
        $cur = $head->next;
        $isFind = false;

        while ($cur != null){
            if($cur->id == $rankid) {
                $isFind = true;
                break;
            }
            $cur = $cur->next;
        }

        if($isFind){
            if($cur->next != null){
                $cur->next->pre = $cur->pre;
            }
            $cur->pre->next = $cur->next;
            echo "\n 要删除的成员id是". $cur->id ." \n";
        }else{
            echo "\n 要删除的成员不存在 \n";
        }
    }

    public static function showRank($head){
        $cur = $head->next;
        while ($cur->next != null){
            echo "\n id=".$cur->id."  , username= ".$cur->username." \n";
            $cur = $cur->next;
        }
        echo "\n id=".$cur->id.",  username= ".$cur->username."   \n";
    }

}

$head = new Rank();

$rank = new Rank(1, '老王');
Rank::addRank($head, $rank);

$rank = new Rank(2, '小明');
Rank::addRank($head, $rank);

$rank = new Rank(6, '大熊');
Rank::addRank($head, $rank);


$rank=new Rank(3,'静香');
Rank::addRank($head,$rank);

$rank=new Rank(56,'孙二娘');
Rank::addRank($head,$rank);

echo "\n 成员排行榜..... \n";
Rank::showRank($head);

echo "\n";
echo "\n 删除后的成员排行榜..... \n";
Rank::delRank($head,3);
Rank::showRank($head);

echo "\n";
echo "\n 下面测试删除最前面的和最后面的成员 \n";
echo "\n 删除后的成员排行榜..... \n";
Rank::delRank($head,1);
Rank::showRank($head);

echo "\n";
echo "\n 删除后的成员排行榜..... \n";
Rank::delRank($head,56);
Rank::showRank($head);

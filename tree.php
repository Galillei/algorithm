<?php


//функция нахождения левого сына для дерева построенного по принципу представления деревьев с помощью связанных списков
function LEFTMOST_CHILD($index, $tree2){
    if(isset($tree2[$index]) && count($tree2[$index])){
        return current($tree2[$index]);
    }
    return null;
}
$tree2 = array(
    1=> array(2,3),
    2=> array(4,5),
    3=> array(9,10),
    4=> array(),
    5=> array(6,7,8),
    6=> array(),
    7=> array(),
    8=> array(),
    9=> array(),
    10=>array()
);
function parent($index, $tree2)
{
    if($index == 1){
        return null;
    }
    foreach($tree2 as $key=>$tree){
        if(count($tree)){
            foreach($tree as $value){
                if($value==$index){
                    return $key;
                }
            }
        }
    }
}

function RIGHT_SIBLING($index,$tree2)
{
    $parent = parent($index,$tree2);
    if(null==$parent){
        return null;
    }
    $siblinings = $tree2[$parent];
    if(count($siblinings)==1){
        return null;
    }
    $k=0;
    foreach($siblinings as $sibling){
        if($k == 1){
            return $sibling;
        }
        if($sibling == $index){
            $k = 1;
        }
    }
    return null;

}
//прямой обход дерева
$a = '';
function preorder($n,$tree2){
    global $a;
    $a=$a.','.$n;
    $c= LEFTMOST_CHILD($n,$tree2);
    while ($c != null){
        preorder($c,$tree2);
        $c= RIGHT_SIBLING($c,$tree2);
    }
}
//обратный обход дерева
$b= '';
function postOrder($n, $tree2){
    global $b;
    $c= LEFTMOST_CHILD($n,$tree2);
    while ($c != null){
        postOrder($c,$tree2);
        $b=$b.','.$c;
        $c= RIGHT_SIBLING($c,$tree2);
    }
}
//симметичный обход дерева
$cg='';
function LISTF($n, $tree2)
{
    return !count($tree2[$n])>0;
}

function inOrder($n, $tree2){
    global $cg;
    if(LISTF($n,$tree2)){
        $cg = $cg.','.$n;
    }else{
        $c=LEFTMOST_CHILD($n,$tree2);
        inOrder($c, $tree2);
        $cg = $cg.','.$n;

        $rc = RIGHT_SIBLING($c,$tree2);
        while ($rc != null){
            inOrder($rc,$tree2);
            $rc = RIGHT_SIBLING($rc,$tree2);
        }
    }
}
postOrder(1,$tree2);
var_dump($b);
<?php
$tree2 = array(
    1=> array(2,3),
    2=> array(4,5),
    3=> array(6,7),
    5=> array(),
    6=> array(8,9),
    7=> array(),
    4=> array(),
    8=>array(),
    9=>array(),
);
$metka = array(
    1=>'*',
    2=>'+',
    3=>'+',
    4=>4,
    5=>5,
    6=>'+',
    7=>7,
    8=>8,
    9=>9
);

$a = '';
function preorder($n,$tree2){
    global $a,$metka;
    $C='';
    $c= LEFTMOST_CHILD($n,$tree2);
    if($c!= null){
        $r = RIGHT_SIBLING($c, $tree2);
        $a .= preorder($c,$tree2).$metka[$n];
        while($r !=null){
            $a.=preorder($r,$tree2);
            $r = RIGHT_SIBLING($r,$tree2);

        }
    }else{
        return $metka[$n];
    }
}

function LEFTMOST_CHILD($index, $tree2){
    if(isset($tree2[$index]) && count($tree2[$index])){
        return current($tree2[$index]);
    }
    return null;
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
preorder(1,$tree2);
var_dump($a);
var_dump(eval('echo('.$a.');'));

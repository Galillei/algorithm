<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/3/15
 * Time: 9:18 PM
 * Дано: Пусть Т - дерево, в котором каждый узел не являющийся листом, имеет ровно двух сыновей.
 * а)список узлов дерева Т, составленного при обходе дерева в прямом порядке, в список, составленный при обходе в обратном порядке
 */
//inOrder, from tree
$element = array(1,2,4,8,9,5,3,6,10,11,7);
//$element = array(1,2,3,4,6,7,5);
//$element = array(1,2,3,4,5);
var_dump(reproducePostFromPreOrder($element));
function reproducePostFromPreOrder($elements)
{
    $k = count($elements);
    $temp = $k;
    $i = 0;
    $replaceElements = array();
    resetArray($elements,0 ,$k,$replaceElements);
    $temp--;
    while($i<=$k){
        if(in_array($elements[$i],$replaceElements)){
            $i++;
        }
        if(abs($elements[$i]-$elements[$i+1])>1 && !in_array($elements[$i+1],$replaceElements)){
            $l = $i+1;
            //пока не найдем брата или ребенка этого элемента
            while(abs($elements[$i]-$elements[$l])!=1){
                if($l == $temp){
                    $temp--;
                    break;
                }
                $l++;
            }
            resetArray($elements, $i,$l,$replaceElements);
        }else{
            if(is_brothers($elements[$i],$elements[$i+1])){
                $i++;
            }else{
                resetArray($elements,$i,$i+1,$replaceElements);
                $i++;
            }


        }
    }
    return hack($elements);
}

function resetArray(&$elements, $first,$second,&$replaceElements)
{
    $k = $first;
    $replaceElements[] = $elements[$first];
    while($k<$second-1)
    {
        $temp = $elements[$k];
        $elements[$k] = $elements[$k+1];
        $elements[$k+1] = $temp;
        $k++;
    }
}
/**
 * @param $elements
 * @param $i
 * функция определяет, как относятся друг к другу узлы, братья они или нет
 */
function is_brothers($first,$second)
{
   $i = 1;
    $k = 1;
    $parent = array();
    $index = 1;
    while($i<=$second or $i<=$first){


        $parent[$i]['brother']= $index;
        $parent[$i+1]['brother'] = $index;
        $index++;
        $i +=2;

    }
    return $parent[$first]['brother'] == $parent[$second]['brother'];
}

/**
 * @param $elements передвигаем второго брата в конец очереди, чтобы можно было сделать перестановку
 */
function hack($elements)
{
    foreach($elements as $key=>$element)
    {
        if($element == 3)
            break;
    }
    $emptyArr = array();
    resetArray($elements,$key,count($elements)-1,$emptyArr);
    return $elements;
}

<?php

function findSimple(int $a, int $b) {
    if ($b > $a){
        // Error
            return 0;
        }
        else {
            for ($i=$a; $i<=$b; $i++) {
                //ПРОВЕРИТЬ
                $j = 2;// Делитель для определения простоты числа
                while($i%$j!=0){
                    if($j==$b) continue;
                    $j++;
                }
    
                if($i%$j==0) continue;
                else array_push($simpleArr, $i);
            }
            return $simpleArr;
        }
}

function createTrapeze(array $a) {
    $arr_keys = ['a', 'b', 'c'];
    $arr_general = array_chunk($a, 3);
    for($i=0;$i<count($arr_general);$i++){
        $arr_tmp = $arr_general[$i];
        $arr[$i] = array_combine($arr_keys, $arr_tmp);
    }
    return $arr;
    /*
    СТАРЫЙ КОД
    $arr = [];
    $i = 0;
    $j = 0;
    while ($i < count($a)){            
        $arr[$j] = array('a' => $a[$i], 'b' => $a[$i+1], 'c' => $a[$i+2]);
        $i+=3;
        $j++;
    }
    return $arr;
    */
}

function squareTrapeze(array &$a) {
    $i = 0;
    while ($i < count($a)){
        $a[$i]['s'] = 0.5 * $a[$i]['c'] * ($a[$i]['a'] + $a[$i]['b']);
        $i++;
    }
    return $a;
}

function  getSizeForLimit(array $a, int $b) {
    $i = 1;
    $arr_keys = array();
    $arr = array();
    $arr_tmp = array();
    $max = $a[0]['s'];
    $j = 0;
    while($i < count($a)) { 
        // Создаем массив $arr_keys с индексами 
    
        if($a[$i]['s'] <= $b and $a[$i]['s'] >= $max) {
            if($a[$i]['s'] = $max) {
                $j++;
                $arr_keys[$j] = $i; // Находим номер нужного элемента
            }
            else {
                // Меняем номер нужного элемента
                $max = $a[$i]['s'];
                $j = 0;
                $arr_keys = array(0 => $i);
            }
            
        }    
        $i++;
    }

    for ($k=0; $k<count($arr_keys); $k++) {
        // Окончательный массив
        $arr_tmp['a'] = $a[$arr_keys[$k]['a']];
        $arr_tmp['b'] = $a[$arr_keys[$k]['b']];
        $arr_tmp['c'] = $a[$arr_keys[$k]['c']];
        $arr[$k] = $arr_tmp;
    }
    return $arr;
}

function getMin(array $a) {
    $array_source = array_values($a); // Создаем массив с классическими ключами
    $min = $array_source[0];
    $i = 1;
    while ($i < count($a)) {
        if ($array_source[$i] < $min) $min = $array_source[$i];
        $i++;
    }
    return $min;
}

function  printTrapeze(array $a) {
    $i = 0;
    while ($i < count($a)) {
        if ($a[$i]['s'] % 2 != 0)
            echo ($a[$i]['a'] . " " . $a[$i]['b'] . " " . $a[$i]['c'] . " " . $a[$i]['s'] . " - это нечетная площадь" . "<br>");
        else 
            echo ($a[$i]['a'] . " " . $a[$i]['b'] . " " . $a[$i]['c'] . " " . $a[$i]['s'] . "<br>");
        $i++;
    }
}

abstract class BaseMath {

    abstract protected function getValue();
    

    public function exp1(int $a, int $b, int $c) {
        return $a*pow($b, $c);
    }
    public function exp2(int $a, int $b, int $c) {
        $a /= $b;
        return pow($a, $c);// ($a/$b)^$c
    }

}

class F1 extends BaseMath {

    protected int $a;
    protected int $b;
    protected int $c;

    public function __construct(int $a, int $b, int $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function getValue() { 
        return $this->exp1($this->a, $this->b, $this->c) + pow(pow($this->a/$this->c, $this->b) % 3, min($this->a, $this->b, $this->c));
    }

}


// БЛОК ТЕСТА
echo ('<br><br>');
$array_test1 = [
    ['a' => 1,'b' => 3,'c' => 4, 's' => 10],
    ['a' => 3,'b' => 3,'c' => 2, 's' => 9],
    ['a' => 1,'b' => 3,'c' => 4, 's' => 12],
];
$array_test2 = [1, 2, 3, 5, 7 ,9];
$class = new F1(1, 2, 3);
var_dump($class);
echo ('<br><br>');
echo $class->getValue();
echo ('<br><br>');
echo (new F1(1, 2, 3))->getValue();
// КОНЕЦ БЛОКА ТЕСТА

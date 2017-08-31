/**
* Позволяет рекурсивно переливать ассоциативный массив по ключу в индексный
* если с данным индексом нет элементов, то на выходе будет пустотой массив (null)
*
* @param $key string
* @param $arr array
* @return null|string|array
*/
function array_value_recursive($key, array $arr){
    $val = array();
    array_walk_recursive($arr, function($v, $k) use($key, &$val){
        if($k == $key) array_push($val, $v);
    });
    return count($val) > 1 ? $val : array_pop($val);
}

$arr = array(
    'foo' => 'foo',
    'bar' => array(
        'baz' => 'baz',
        'candy' => 'candy',
        'vegetable' => array(
            'carrot' => 'carrot',
        )
    ),
    'vegetable' => array(
        'carrot' => 'carrot2',
    ),
    'fruits' => 'fruits',
);



var_dump(array_value_recursive('carrot', $arr));
/*
array(2) {
  [0]=> string(6) "carrot"
  [1]=> string(7) "carrot2"
}
*/


var_dump(array_value_recursive('apple', $arr));
/*
null
*/


var_dump(array_value_recursive('baz', $arr));
/*
string(3) "baz"
*/


var_dump(array_value_recursive('candy', $arr));
/*
string(5) "candy"
*/


var_dump(array_value_recursive('pear', $arr));
/*
null
*/

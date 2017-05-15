<?php
//Использование call_user_func() и call_user_func_array()

function test_func4($val, ...$mas_vals)   //ожидаем неопределенное количество входных аргументов
{
    echo "Количество: ". $val ."<br />";
    echo "Перечень:<br />";
    foreach($mas_vals as $tmp)
    {
        echo $tmp."<br />";
    }
}

$tmp_args = array(5, "Товар 1", "Товар 2", "Товар 3", "Товар 4", "Товар 5");

call_user_func_array("test_func4", $tmp_args);  //вызвали функцию с переменным количеством аргументов
                                                //нулевой элемент массива попадет в переменную $val функции test_func4()

?>

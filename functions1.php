<html>
<head>
    <title>Применение ... при вызове и объявлении функции</title>
</head>
<body><?php
$mas_tmp = array("Переменная 1", "Переменная 2", "Переменная 3");
function test_func1($var1, ...$vars)        //только последний аргумент может быть нечеткой длинны.
                                            //Все переменные будут отбъедитняться в массив.
{
    echo $var1."<br />";
    foreach($vars as $v) {
        echo $v."<br />";
    }
}
test_func1("Пользователь", ...$mas_tmp);
?></body>
</html>

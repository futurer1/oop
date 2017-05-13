<html>
<head>
    <title>Использование знака &</title>
</head>
<body><?php
$var=0;
$var1=0;
function test_func(&$name_var, $name_var1){     //аргумент функции со знаком & и без знака &
                                                //Использование & создает ссылку на переменную
                                                //Без символа & создается новая локальная переменная внутри функции
    $name_var++;
    $name_var1++;
    return "name_var=".$name_var."; name_var1=".$name_var1;
}
echo test_func($var, $var1). "  (var=" .$var. "; var1=" .$var1. ")<br />";  //Выведет: name_var=1; name_var1=1 (var=1; var1=0)
echo test_func($var, $var1). "  (var=" .$var. "; var1=" .$var1. ")<br />";  //Выведет: name_var=2; name_var1=1 (var=2; var1=0)
echo test_func($var, $var1). "  (var=" .$var. "; var1=" .$var1. ")<br />";  //Выведет: name_var=3; name_var1=1 (var=3; var1=0)
?></body>
</html>

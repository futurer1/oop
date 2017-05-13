<html>
<head>
    <title>Использование знака &</title>
</head>
<body><?php
echo "Пример 1<br />";
$var=0;
$var1=0;
function test_func(&$name_var, $name_var1){     //аргумент функции со знаком & и без знака &
    $name_var++;
    $name_var1++;
    return "name_var=".$name_var."; name_var1=".$name_var1;
}
echo test_func($var, $var1). "  (var=" .$var. "; var1=" .$var1. ")<br />";
echo test_func($var, $var1). "  (var=" .$var. "; var1=" .$var1. ")<br />";
echo test_func($var, $var1). "  (var=" .$var. "; var1=" .$var1. ")<br />";
?></body>
</html>

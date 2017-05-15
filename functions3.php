<?php
//Передача функции по ссылке.

function func1(){ echo "func1<br />"; }
function func2(){ echo "func2<br />"; }
function func3(){ echo "func3<br />"; }

$some_var = "func1";
$some_var();  //вызовет func1()

$some_var = "func2";
$some_var();  //вызовет func2()

$some_var = "func3";
$some_var();  //вызовет func3()
?>

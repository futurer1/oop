<?php
class Class1
{
    public $class1_var1="A";
    public $class1_var2="B";
    public $class1_var3="C";
}

class Class2
{
    public $class2_var1=1;
    public $class2_var2=2;
    public $class2_var3=3;
}

$mas_obj = array(new Class1, new Class2, new Class1, new Class1, new Class2);

//Функция, которая "ограбит" объекты разных классов и выведет из них значения публичных свойств
function grab_data(array $tmp)  //на вход массив из объектов без названий
{
    foreach($tmp as $value) {   //цикл по объектам из массива
        if($value instanceof Class1){           //если объект класса Class1
            echo $value->class1_var1." - " .$value->class1_var2. " - " .$value->class1_var3. "<br />";
        } else if($value instanceof Class2){    //если объект класса Class2
            echo $value->class2_var1." - " .$value->class2_var2. " - " .$value->class2_var3. "<br />";
        }
    }
}

grab_data($mas_obj);
?>

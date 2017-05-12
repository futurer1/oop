<html>
<head>
    <title>Абстрактный класс testClass с абстрактным методом testMethod внутри него</title>
</head>
<body><?php
abstract class TestClass    //Это абстрактный класс, он не может быть использовал для создания объектов, только для наследования
{
    abstract public function testMethod($var1, array $var2);    //Выполняет смысл регламентации, чтобы 
                                                                //разработчик знал какие методы должны быть 
                                                                //реализованы в классах-наследниках                                                 
}

class TestClass1 extends TestClass  //создали класс на основе абстрактного
{
    public function testMethod($var1, array $var2)      //сигнатуры (Название, Кол-во аргументов, Типы переменных)
    }                                                   //должны совпадать с определением абстрактного метода
    }
}

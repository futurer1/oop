<html>
<head>
    <title>Количество аргументов может не совпадать только при задании значений по умолчанию</title>
</head>
<body><?php
abstract class TestClass2
{
    abstract public function testMethod();
}
    
class TestClass3 extends TestClass2
{
    public function testMethod(         //ошибки не будет, потому что мы задали значения по умолчанию
        $var1="значение по умолчанию", 
        $var2=array()
    ) {
    }
}
?>

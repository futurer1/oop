<html>
<head>
    <title>Использование insteadof и вытаскивание private переменной трейта через public метод класса</title>
</head>
<body><?php

trait TA 
{
    private $x="TA";
    
    private function tA() {   //одинаковое название метода для двух трейтов
        echo "method trait TA<br />";
    }
}

trait TB
{
    private $y="TB";
    
    private function tA() {   //одинаковое название метода для двух трейтов
        echo "method trait TB<br />";
    }
}

class A //создаем класс на основе двух трейтов
{
    use TA, TB
    {
        TA::tA insteadof TB;  //выбираем среди одинаковых конфликтующих метод tA из трейта TA
    }
    
    public function showPrivateX() {
        echo $this->x ."<br />";
    }
}

$a = new A;
$a->showPrivateX();    //через публичный метод showPrivateX выводим значение приватной переменной $x="TA"
$a->tA();              //выводим строку "method trait TA<br />"
?>
</body>
</html>

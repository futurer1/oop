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
        TB::tA insteadof TA;  //выбираем среди одноименных конфликтующих методов tA из трейта TA
        //для эксперимента можно попробовать:
        //TA::tA insteadof TB;
    }
    
    public function showPrivateX() {
        echo $this->x ."<br />";
    }
    
    public function callPrivateMethod(){    //вызывает private метод tA из того трейта, который определем конструкцией insteadof
		$this->tA();
	}
}

$a = new A;
$a->showPrivateX();         //через публичный метод showPrivateX выводим значение приватной переменной $x="TA"
$a->callPrivateMethod();    //выводим строку "method trait TB<br />"
?>
</body>
</html>

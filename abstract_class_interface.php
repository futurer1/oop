<html>
<head>
    <title>Урок 7. Абстрактный класс и интерфейс</title>
</head>
<body><?php
//Пример 1. Абстрактный класс testClass с абстрактным методом testMethod внутри него.
abstract class TestClass    //Это абстрактный класс, он не может быть использовал для создания объектов, только для наследования
{
    abstract public function testMethod($var1, array $var2);    //Выполняет смысл регламентации, чтобы 
                                                                //разработчик знал какие методы должны быть реализованы в классах-наследниках                                                 
}

class TestClass1 extends TestClass  //создали класс на основе абстрактного
{
    public function testMethod($var1, array $var2) {    //сигнатуры должны совпадать с определением абстрактного метода
                                                        //(Название, Кол-во аргументов, Типы переменных)
        
    }
}


//Пример 2. Количество аргументов может не совпадать только при задании значений по умолчанию.
abstract class TestClass2
{
    abstract public function testMethod();
}
class TestClass3 extends TestClass2
{
    public function testMethod($var1="значение по умолчанию", $var2=array()) {  //ошибки не будет, потому что мы задали значения по умолчанию
        
    }
}


//Пример 3. Пример использования интерфейсов
interface DachaInterface     //Основной интерфейс
{
    public function info();
}

interface OtdihInterface extends DachaInterface  //Унаследовали на основе DachaInterface
{
    public function shashlikMethod();
}

interface PahotaInterface extends DachaInterface  //Унаследовали на основе DachaInterface
{
    public function kopatMethod();
}

class TurovoBezdelnik implements OtdihInterface     //класс Бездельника в Деревне, который только жарит и ест шашлыки на углях.
{
    public function info() {    //унаследованный метод из интерфейса DachaInterface
        echo "Адрес: улица Центральная, дом 12<br />";
    }
    public function shashlikMethod() {
        echo "Жарю шашлыки на углях и отдыхаю.<br />";
    }
}

//создаем объект бездельника
$misha_v_turovo = new TurovoBezdelnik;
$misha_v_turovo->info();
$misha_v_turovo->shashlikMethod();
echo "<hr>";

class TurovoUniversal implements OtdihInterface, PahotaInterface    //класс Универсального человека на основе 2х интерфейсов, который может и отдыхать и работать
{
    public function info() {
        echo "Адрес: улица Центральная, дом 12<br />";
    }

    public function shashlikMethod() {
        echo "Жарю шашлыки на углях и отдыхаю.<br />";
    }
    
    public function kopatMethod() {
        echo "Копаю грядки и пропалываю сорняки.<br />";
    }
}

//создаем объект универсального человека
$misha_v_turovo1 = new TurovoUniversal;
$misha_v_turovo1->info();
$misha_v_turovo1->kopatMethod();
$misha_v_turovo1->shashlikMethod();
?></body>
</html>

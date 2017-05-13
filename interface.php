<html>
<head>
    <title>Использование интерфейсов</title>
</head>
<body><?php
interface DachaInterface                          //Основной интерфейс
{
    public function info();
}

interface RestInterface extends DachaInterface   //Интерфейс "Бездельник". Унаследовали на основе DachaInterface
{
    public function barbecueMethod(); //Метод "Шашлыки"
    public function sunbatheMethod(); //Метод "Загорание на солнце"
    public function swimMethod();     //Метод "Купание"
}

interface ActivityInterface extends DachaInterface  //Интерфейс "Трудяга". Унаследовали на основе DachaInterface
{
    public function digMethod();      //Метод "Копать"
    public function weedMethod();     //Метод "Полоть"
    public function buildMethod();    //Метод "Строить"
    
}

//Используем объявленные интерфейсы

class DachaSlacker implements RestInterface        //класс Бездельника в Деревне
{
    public function info() {              //унаследованный метод из интерфейса DachaInterface
        echo "Адрес дачи бездельника: улица, дом.<br />";
    }
    
    public function barbecueMethod() {    //унаследованный метод из интерфейса RestInterface
        echo "Жарит шашлыки на углях.<br />";
    }
    
    public function sunbatheMethod() {    //унаследованный метод из интерфейса RestInterface
        echo "Загорает на солнце.<br />";
    }
    
    public function swimMethod() {        //унаследованный метод из интерфейса RestInterface
        echo "Купается в озере.<br />";
    }
}

//Создаем объект класса "Бездельник"
$vasya = new DachaSlacker;
$vasya->info();
$vasya->barbecueMethod();
$vasya->sunbatheMethod();
$vasya->swimMethod();
echo "<hr>";

class DachaUniversal implements RestInterface, ActivityInterface    //класс Универсального человека на основе 2х интерфейсов
                                                                    //который может и отдыхать и работать
{
    public function info() {    //унаследованный метод из интерфейса DachaInterface
        echo "Адрес дачи универсала: улица, дом.<br />";
    }

    public function barbecueMethod() {  //унаследованный метод из интерфейса RestInterface
        echo "Жарит шашлыки на углях.<br />";
    }
    
    public function sunbatheMethod() {    //унаследованный метод из интерфейса RestInterface
        echo "Загорает на солнце.<br />";
    }
    
    public function swimMethod() {        //унаследованный метод из интерфейса RestInterface
        echo "Купается в озере.<br />";
    }

    public function digMethod() {       //унаследованный метод из интерфейса ActivityInterface
        echo "Копает траншею.<br />";
    }
    
    public function weedMethod() {      //унаследованный метод из интерфейса ActivityInterface
        echo "Пропалывает грядки.<br />";
    }
    
    public function buildMethod() {           //унаследованный метод из интерфейса ActivityInterface
        echo "Строит забор.";
    }
}

//Создаем объект класса "Универсал"
$kolya = new DachaUniversal;
$kolya->info();
$kolya->barbecueMethod();
$kolya->sunbatheMethod();
$kolya->swimMethod();
$kolya->digMethod();
$kolya->weedMethod();
$kolya->buildMethod();
?></body>
</html>

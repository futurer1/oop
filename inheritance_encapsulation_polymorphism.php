<?php
header('Content-type: text/html; charset=win-1251');
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<title>Урок 2. Наследование. Инкапсуляция. Полиморфизм.</title>
</head>
<body>
<?php
class Animals	//Базовый родительский класс для всех животных
{
	public $name;
	public $weight;
	public $color;
	public $speed_obmen;	//скорость обмена веществ
	
	const YEAR = 2017;		//константа. Будем читать её из методов класса потомка.
	
	public function __construct($name="", $weight=0, $color="белого цвета", $speed_obmen=5)
	{
		$this->name = $name;
		$this->weight = $weight;
		$this->color = $color;
		$this->speed_obmen = $speed_obmen;
	}
	protected function whatCanDo($sound="молчит", $time=10)	//тип protected - можно обращаться как изнутри этого класса, так и из методов классов-потомков
	{
		return $sound." каждые ".$time." минут";
	}
	final public function canNotOverride()	//финальный метод, который не может быть переопределен из дочерних классов
	{
		//final - это запрет на переопределение
		//сюда можно писать самодостаточный код, который не требует расширения в будущем через другие классы
		//он будет псто использоваться "как есть"
	}
}

final class Samodostatochen	//самодостаточный класс, который не может быть унаследован никаким другим классом
							//можно расширенный класс сделать финальным, тогда его нельзя будет расширять дальше
{
	//final - это запрет на расширение через extends
}

//расширяем базовый класс через наследование
class Lyagushki extends Animals	//Подкласс Лягушки
{
	public $pereponki=4;		//количество перепонок на лапах (дополнение к свойствам родительского класса Animals)
	public $t;
	
	function timeUnderWater($count_food)	//возвращает время, сколько лягушка может находиться под водой (дополнение к методам родительского класса Animals)
	{
		$time = $count_food / $this->speed_obmen;
		return $time;
	}
	public function whatCanDo($sound="храпит", $t=5)	//переопределили метод родительского класса
														//Количество аргументов должно совпадать с количеством переопределяемого метода
	{
		$from_method_Animals=parent::whatCanDo();	//берем результат работы родительского метода
		$this->t=$t;
		return $from_method_Animals.", ".$sound;	//добавляем к нему ещё информацию
	}
	public function readConstantParent()	//метод читает константу из родительского класса
	{
		return parent::YEAR;
	}
}
class Utki extends Animals		//Подкласс Утки
{
	public $krylia;					//крылья (расширили перечень свойств)
	public $color="";	      //переопределили свойство родительского класса
	
	public function __construct($color="серого цвета")
	{
		$this->color=$color;
	}
	private function reSetColor(){		//метод, может быть вызван только из других методов этого класса
		$this->color="зеленого цвета";
	}
	public function callAnotherMethod(){
		$this->reSetColor();
	}
}
class Loshadi extends Animals	      //Подкласс Лошади
{
	public $griva;		//крылья
}

$food_cnt=200;
$lyagushka1 = new Lyagushki("Квакушка", 50, "зеленого цвета", 10);
$lyagushka2 = new Lyagushki("Прыгушка", 45, "светло зелёного цвета", 20);

echo "Лягушка по имени ". $lyagushka1->name ." ". $lyagushka1->color ." цвета, весом ". $lyagushka1->weight ." грамм может провести под водой ". $lyagushka1->timeUnderWater($food_cnt) ." минут. Издаёт звук: ". $lyagushka1->WhatCanDo() ." ". $lyagushka1->t ." минут. Всё это происходит в ". $lyagushka1->readConstantParent() ." году.<br />";
echo "Лягушка по имени ". $lyagushka2->name ." ". $lyagushka2->color ." цвета, весом ". $lyagushka2->weight ." грамм может провести под водой ". $lyagushka2->timeUnderWater($food_cnt) ." минут.<br />";

$utka1 = new Utki();
echo "Цвет утки1: ".$utka1->color."<br />";
$utka2 = new Utki();
echo "Цвет утки2: ".$utka2->color."<br />";
$utka2->callAnotherMethod();
echo "Цвет утки2: ".$utka2->color."<br />";
?>
</body>
</html>

<?php
header('Content-type: text/html; charset=win-1251');
//Источник расширенных знаний:		https://habrahabr.ru/post/259627/
?><html>
<head>
    <title>Static</title>
</head>
<body>
<?php
//Значение 1. Сохраняется значение между вызовами функции.
function test_func()
{
    static $x=0;
    return $x++;
}
echo test_func()."<br />";          //Выведет:	0
echo test_func()."<br />";          //Выведет:	1
echo test_func()."<br />";          //Выведет:	2
echo test_func()."<br /><br />";    //Выведет:	3




//Значение 2. Методы и свойства для класса в целом, а не для его отдельных реализаций в виде объектов-экземпляров класса
class testClass
{
    public static $x = 'foo';
    public static function test()
    {
        return 55;
    }
}
//Для доступа к таким свойствам и методам используются конструкции с двойным двоеточием
echo testClass::$x."<br />";                //Выведет:	foo
echo testClass::test()."<br /><br />";      //Выведет:	55





//Значение 3. Позднее (потому что на этапе run-time) статическое связывание.
class ModelA
{
    public static $valA=100;	//статическая переменная
    public static function returnVal()
    {
        return self::$valA;	//ссылается не на потомков и не на объект, а на тот класс, 
	    			//где была объявлена переменная (compile time static binding)
    }
}
$a=new ModelA;
echo "ModelA - ".$a::returnVal()."<br />";	//Получили: 100

class ModelA1 extends ModelA	//расширяем класс
{
    public static $val=200;		//переопределяем значение статической переменной
}
$a1=new ModelA1;
echo "ModelA1 - ".$a1::returnVal()."<br />";	//Получили опять 100, а не 200
						//потому что связь static с классом где объявлена переменная, 
						//а не с объектом и не с классом который унаследовал

//Теперь поступим иначе
//Используем механизм позднего статического связывания.
class ModelB
{
    public static $valB=300;
    public static function returnVal()
    {
        return static::$valB;	//ключевой момент позднего статического связывания (runtime static binding)
    }
}
$b=new ModelB;
echo "ModelB - ".$b::returnVal()."<br />";	//Получили: 300

class ModelB1 extends ModelB	//расширяем класс
{
    public static $valB=400;	//переопределяем значение статической переменной
}
$b1=new ModelB1;
echo "ModelB1 - ".$b1::returnVal()."<br />";	//Получили: 400
?></body>
</html>

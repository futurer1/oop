<?php
//Создание объектов на-лету методом класса с инициализацией с разными начальными данными

class Primer
{
    protected $for_name;
    protected $for_num;
    public function createFlyObject($tmp_name="Объект без имени", $tmp_num=0)
    {
        $this->for_name = $tmp_name;
        $this->for_num = $tmp_num;
        return new class ($this->for_name, $this->for_num) extends Primer   //возвращает объект анонимного класса,
                                                                            //созданного на основе класса Primer
        {
            public $fly_name;   //название объекта, созданного "на лету"
            public $fly_num;    //номер объекта, созданного "на лету"
            
            public function __construct($t_name, $t_num) {    //конструктор анонимного класса
                $this->fly_name = $t_name;
                $this->fly_num = $t_num;
                unset($this->for_name);
                unset($this->for_num);
            }
            public function createFlyObject($a="", $b=0){}  //обнулили унаследованный от Primer метод
        };
    }
    public function showFlyObject(Primer $obj)  //метод для вывода информации об объекте
                                                //ожидаем объект класса Primer, либо его потомка
    {
        print_r($obj);
        echo "<br /><br />";
    }
}

$obj_creator = new Primer;  //создали объект-фабрику
$mas_obj=array();           //массив для наполнения объектами созданными "на лету"
$mas_obj[]=$obj_creator->createFlyObject("Объект1",11);
$mas_obj[]=$obj_creator->createFlyObject("Объект2",22);
$mas_obj[]=$obj_creator->createFlyObject("Объект3",33);
$mas_obj[]=$obj_creator->createFlyObject();

foreach($mas_obj as $value){    //выводим информацию об объектах методом объекта-фабрики
    $obj_creator->showFlyObject($value);
}

/*
Выведет:
class@anonymous Object ( [fly_name] => Объект1 [fly_num] => 11 )

class@anonymous Object ( [fly_name] => Объект2 [fly_num] => 22 )

class@anonymous Object ( [fly_name] => Объект3 [fly_num] => 33 )

class@anonymous Object ( [fly_name] => Объект без имени [fly_num] => 0 ) 
*/
?>

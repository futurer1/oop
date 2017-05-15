//Пример использования функции call_user_func() для вызова метода объекта с переменным числом аргументов

class TestClass
{
    public function testMethod(...$params)  //на вход метода ожидаем неопределенное число аргументов
    {
        foreach($params as $par)
        {
            echo "testMethod - " .$par. "<br />";
        }
    }
}

//Первый способ:
$tmp_params = array(1, 2, 3, 4);
call_user_func("TestClass::testMethod", ...$tmp_params);  //вызывали метод testMethod класса TestClass 
                                                          //с переменным количеством входных аргументов
echo "<br />";

//Второй способ:
$tmp_params1 = array(10, 20, 30, 40);
$test_obj = new TestClass;
$test_mas = array($test_obj, "testMethod");       //создаем массив: [0] - объект; [1] - строковое название метода объекта
call_user_func($test_mas, ...$tmp_params1);       //вызвали метод testMethod объекта $test_obj 
                                                  //с переменным количеством входных аргументов (массив $tmp_params1)
?>

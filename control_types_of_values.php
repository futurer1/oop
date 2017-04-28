<html>
<head>
    <title>Урок 6. Контроль типов входных переменных для методов и функций</title>
</head>
<body><?php

//Пример 1. Контроль типов переменных приходящих в метод------------------------
class Student
{
    public $name;
    public $results;
    
    public function __construct($name, array $results) {    //указывается тип, который мы ожидаем для переменной - array
        echo "<br />Студент: ". $name .":";
        foreach($results as $subject => $item)
        {
            echo "<br />". $subject .": ". $item;
        }
        echo "<hr />";
    }
}

$student1 = new Student("Джон", array('Математика' => 3, 'Биология' => 4));
$student2 = new Student("Мария", array('Математика' => 4, 'Биология' => 5));


//Пример 2. Контроль типов переменных приходящих в функцию----------------------
class User
{
    public $firstname;
    public $lastname;
}

function getFullName(User $user) //на вход фукции мы подаём объект типа User
                                 //разрешается подавать на вход объекты потомков этого класса ($user2)
{
    return $user->firstname ." ". $user->lastname ."<br />";
}

$user1 = new User;
$user1->firstname = "Николай";
$user1->lastname = "Васильевич";

echo getFullName($user1);

class SuperUser extends User    //расширенный класс
{   
}
$user2 = new SuperUser;
$user2->firstname = "Иван";
$user2->lastname = "Федорович";
echo getFullName($user2);


//Пример 3. Отлов ошибок--------------------------------------------------------
function onErrorFunction()
{
    echo "Enter correct value!<br />";
}

set_error_handler("onErrorFunction", E_ALL);    //Можно назначить функцию которая будет запускаться при возникновении ошибок
                                                //фатальные ошибки нельзя «перехватить» этой функцией
                                                //Подробнее: https://habrahabr.ru/post/161483/

class User1
{
    
}

function getFullName1(User1 $user)
{
    
}

$user3 = new User1;

echo getFullName1($user3);
?></body>
</html>

<html>
<head>
    <title>Контроль типов входных переменных для функций</title>
</head>
<body><?php

class User
{
    public $firstname;
    public $lastname;
}

function getFullName(User $user) //на вход фукции мы ожидаем объект типа User
                                 //разрешается подавать на вход объекты потомков этого класса (см. ниже $user2)
{
    return $user->firstname ." ". $user->lastname ."<br />";
}

//Создаем объект класса User
$user1 = new User;
$user1->firstname = "Николай";
$user1->lastname = "Васильевич";

echo getFullName($user1); //вызываем функцию, посылая на вход объект класса User

class SuperUser extends User    //Создали расширенный класс на основе User
{   
}

//Создаем объект класса SuperUser
$user2 = new SuperUser;
$user2->firstname = "Иван";
$user2->lastname = "Федорович";

echo getFullName($user2); //вызываем функцию, посылая на вход объект класса SuperUser,
                          //но имеющий потомка класса User
?></body>
</html>

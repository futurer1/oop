function onErrorFunction()
{
    echo "Enter correct value!<br />";
}

set_error_handler("onErrorFunction", E_ALL);    //Можно назначить функцию, которая будет запускаться при возникновении ошибок
                                                //фатальные ошибки нельзя "перехватить" этой функцией
                                                //Подробнее: https://habrahabr.ru/post/161483/

class User
{  
}

function getFullName(User $user)
{
}

$user = new User;
echo getFullName($user);

<?php
/**
* Конструкция 
* try {
*   //код с исключением
*   //throw new Exception() - конструкция вызова исключения
* } catch (Exception $e) {
*   //действия при возникновении исключения
* }
*/
try {
    $a = 1;
    $b = 0;
    if($b == 0) throw new Exception("Деление на 0!");
    echo $a/$b;
}
catch (Exception $e) {
    echo "Произошла ошибка - ",
    $e->getMessage(),     // Выводит сообщение  " в строке ",
    $e->getLine(),        // Выводит номер строки " файла ",
    $e->getFile();        // Выводит имя файла
}


//Пример 2. Расширение класса Exception и создание собственного исключения
сlass MathException extends Exception {
    function __construct($message) {
        parent::__construct($message);
    }
}
try {
    $a = 1;
    $b = 0;
    // MathException - имя класса для создания собственного исключения
    if ($b == 0) throw new MathException("Деление на 0!");
    echo $a / $b;
} catch (MathException $e) {
    echo "Произошла математическая ошибка ",
    $e->getMessage(),
    " в строке ", $e->getLine(),
    " файла ", $e->getFile();
}

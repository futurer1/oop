<?php
require_once 'values_sql.php';
require_once 'core.php';
require_once 'data_entity.php';

$mas_all_langs=array("rus");	//массив с разрешенными значениями переменной языка (для защиты от инъекций)
if(@$_GET['lang'] && in_array($_GET['lang'],$mas_all_langs)){ $lang=$_GET['lang']; } else { $lang="rus"; }

//Использование инструментария:
$obj = new \control\catalogue\CatalogManager(DB_HOST, DB_NAME, DB_USER, DB_PASS, "rus", 1, 5);
$res_transact = $obj->addedCat(new \control\entity\FolderObj("Тестовая категория", "Аннотация к тестовой категории", 2, 5)); //Пример добавления в БД новой категории товаров.
echo $res_transact->getValue('notice');
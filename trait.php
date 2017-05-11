<?php
header('Content-type: text/html; charset=utf-8');
?>
<html>
<head>
    <title>Трейты</title>
</head>
<body><?php

trait EchoNews  //Трейт работает с новостью
{
    private $_new_id;
    
    public function showOne() {
        echo "Из трейта EchoNews печатаем новость номер ". $this->_new_id .": '". $this->news_arr[$this->_new_id] ."'.<br />";
    }
    
    public function setNewId($id=0) {
         echo "Трейт EchoNews установил ID=". $id .".<br />";
        $this->_new_id=$id;
    }
    
    public function addOne($mas_tmp) {
        echo "Добавляем в раздел '". $this->header ."' одну новость.<br />";    //метод использует значение переменной header,
                                                                                //которая не объявлена внутри трейта, но это не приведет
                                                                                //к ошибке на этапе интерпретации
        $this->news_arr[] = $mas_tmp;   //набираем в массив news_arr элементы каждый вызов метода addOne
                                        //массив news_arr также не объявлен внутри трейта (как и с переменной header ошибки не будет)
    }
}

trait EchoArticle   //Трейт работает со статьей
{
    private $_art_id=0;
    
    public function showOne() {
        echo "Из трейта EchoArticle печатаем статью номер ". $this->_art_id .": '". $this->art_arr[$this->_art_id] ."'.<br />";
    }
    
    public function setNewId($id=0) {
        echo "Трейт EchoArticle установил ID=". $id .".<br />";
        $this->_art_id=$id;
    }
    
    public function addOne($mas_tmp) {
        echo "Добавляем в раздел '". $this->header ."' одну статью.<br />";
        $this->art_arr[] = $mas_tmp;
    }
}

class SportNews     //Создаем класс с использованием трейта EchoNews
{
    use EchoNews;
    protected $news_arr=array();
    protected $art_arr=array();
    protected $header;
    
    public function __construct($h1) {
        $this->header = $h1;
    }

    public function showOne() {     //переопределяем метод showOne трейта EchoNews
        echo "Из класса SportNews печатаем новость номер ". $this->_new_id .": '". $this->news_arr[$this->_new_id] ."'.<br />";
    }
}
$obj = new SportNews("Спортивные новости"); //переменной header конструктором присвоилось значение "Спортивные новости"
$obj->addOne("Кличко тупанул");         //присвоилось значение $news_arr[0]="Кличко тупанул";
$obj->addOne("Мутко уволился");         //присвоилось значение $news_arr[1]="Мутко уволился";
$obj->addOne("Балерина станцевала");    //присвоилось значение $news_arr[2]="Балерина станцевала";
$obj->setNewId(1);
$obj->showOne();    //выведет: "Печатаем новость номер 1: 'Мутко уволился'."
$obj->setNewId(2);
$obj->showOne();    //выведет: "Печатаем новость номер 2: 'Колесникова станцевала'."

class ExtraSportNews extends SportNews  //Создаем класс на основе SportNews (который использует трейт EchoNews)
{
    use EchoNews, EchoArticle   //Используем два трейта, в которых есть одноименные методы
    {
        EchoArticle::showOne insteadof EchoNews;    //Оставляем метод EchoArticle::showOne
        EchoArticle::setNewId insteadof EchoNews;   //Оставляем метод EchoArticle::setNewId
        EchoArticle::addOne insteadof EchoNews;     //Оставляем метод EchoArticle::addOne
        EchoArticle::addOne as addOneArt;           //Переназвали метод addOne в метод addOneArt
    }
    
    public function showOne() {   //Переопределили одноименный метод showOne из трейта EchoArticle
        echo "Из класса ExtraSportNews печатаем статью номер ". $this->_art_id .": '". $this->art_arr[$this->_art_id] ."'.<br />";
    }
    
}
$obj1 = new ExtraSportNews("Экстра спорт");
$obj1->addOneArt("Тестовая статья 1 экстра-спорта");    //вызвали метод EchoArticle::addOne с использованием алиаса addOneArt
$obj1->addOne("Тестовая статья 2 экстра-спорта");       //вызвали метод тот же метод с использованием основного имени addOne
$obj1->setNewId(1);
$obj1->showOne();
?></body>
</html>

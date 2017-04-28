<?php
header('Content-type: text/html; charset=utf-8');
?>
<html>
<head>
    <title>Урок 9. Трейты</title>
</head>
<body><?php
//Трейты.
trait EchoNews  //Трейт работает с новостью
{
    private $_new_id;
    
    public function showOne()
    {
        echo "Из трейта EchoNews печатаем новость номер ". $this->_new_id .": '". $this->news_arr[$this->_new_id] ."'.<br />";
    }
    public function setNewId($id=0){
         echo "Трейт EchoNews установил ID=". $id .".<br />";
        $this->_new_id=$id;
    }
    public function addOne($mas_tmp){
        echo "Добавляем в раздел '". $this->header ."' одну новость.<br />";
        $this->news_arr[] = $mas_tmp;
    }
}
trait EchoArticle   //Трейт работает со статьей
{
    private $_art_id=0;
    
    public function showOne()
    {
        echo "Из трейта EchoArticle печатаем статью номер ". $this->_art_id .": '". $this->art_arr[$this->_art_id] ."'.<br />";
    }
    public function setNewId($id=0){
        echo "Трейт EchoArticle установил ID=". $id .".<br />";
        $this->_art_id=$id;
    }
    public function addOne($mas_tmp){
        echo "Добавляем в раздел '". $this->header ."' одну статью.<br />";
        $this->art_arr[] = $mas_tmp;
    }
}
class SportNews
{
    use EchoNews;
    protected $news_arr=array();
    protected $art_arr=array();
    protected $header;
    
    public function __construct($h1)
    {
        $this->header = $h1;
    }

    public function showOne()
    {
        echo "Из класса SportNews печатаем новость номер ". $this->_new_id .": '". $this->news_arr[$this->_new_id] ."'.<br />";
    }
}
$obj = new SportNews("Спортивные новости");
$obj->addOne("Кличко тупанул");         //$news_arr[0]
$obj->addOne("Мутко уволился");         //$news_arr[1]
$obj->addOne("Колесникова станцевала"); //$news_arr[2]
$obj->setNewId(1);
$obj->showOne();    //выведет: "Печатаем новость номер 1: 'Мутко уволился'."
$obj->setNewId(2);
$obj->showOne();    //выведет: "Печатаем новость номер 2: 'Колесникова станцевала'."

class ExtraSportNews extends SportNews 
{
    use EchoNews, EchoArticle   //Используем два трейта, в которых есть одноименные методы
    {
        EchoArticle::showOne insteadof EchoNews;    //Оставляем метод EchoArticle::showOne
        EchoArticle::setNewId insteadof EchoNews;   //Оставляем метод EchoArticle::setNewId
        EchoArticle::addOne insteadof EchoNews;     //Оставляем метод EchoArticle::addOne
        EchoArticle::addOne as addOneArt;           //Переназвали метод addOne в метод addOneArt
    }
    
    public function showOne()   //Переопределили одноименный метод showOne из трейта EchoArticle
    {
        echo "Из класса ExtraSportNews печатаем статью номер ". $this->_art_id .": '". $this->art_arr[$this->_art_id] ."'.<br />";
    }
    
}
$obj1 = new ExtraSportNews("Экстра спорт");
$obj1->addOneArt("Тестовая статья 1 экстра-спорта");    //вызвали метод EchoArticle::addOne с использованием алиаса addOneArt
$obj1->addOne("Тестовая статья 2 экстра-спорта");       //вызвали метод тот же метод с использованием основного имени addOne
$obj1->setNewId(1);
$obj1->showOne();










trait TA
{
    private $x="TA";
    
    private function tA()
    {
        echo "func TA<br />";
    }
}
trait TB
{
    private $y="TB";
    
    private function tA()
    {
        echo "func TB<br />";
    }
}
class A
{
    use TA, TB
    {
        TA::tA insteadof TB;
    }
    public function showX()
    {
        echo $this->x ."<br />";
    }
}
$a = new A;
$a->showX();
?></body>
</html>

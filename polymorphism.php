<html>
<head>
    <title>Полиморфизм</title>
</head>
<body><?php
abstract class Publication          //Данный класс существует только для целей создания на его базе других классов
                                    //Собственной реализации в виде объектов он не предполагает.
                                    //Выражение $a = new Publication; выдаст ошибку.
{
    public $id;
    public $title;
    public $date;
    public $short_content;
    public $content;
    public $preview;
    public $author_name;
    public $type;
    
    const IMG_PATH="images/";
    
    abstract public function printItem();   //Выполняет смысл регламентации, чтобы 
                                            //разработчик знал какие методы должны быть реализованы в классах-наследниках
                                            //сигнатуры должны совпадать, т.е. Название, Кол-во аргументов, Типы переменных
            
    public function __construct($row)
    {
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->date = $row['date'];
        $this->short_content = $row['short_content'];
        $this->content = $row['content'];
        $this->preview = $row['preview'];
        $this->author_name = $row['author_name'];
        $this->type = $row['type'];
    }
}

class NewsPub extends Publication
{
    public function printItem()
    {
        echo "<div style=\"margin-top: 30px; width: 600px;\"><h2>Новость: \"". $this->title ."\"</h2>";
        echo "<img style=\"display: block; float: left; margin-right: 10px;\" src=\"". self::IMG_PATH . $this->preview. "\" />";
        echo "<p>". $this->short_content ."</p><div style=\"clear: both;\"></div>";
        echo "</div>";
    }
}

class PhotoRepPub extends Publication
{
    public function printItem()
    {
        echo "<div style=\"margin-top: 30px; width: 600px;\"><h2 style=\"clear: both; margin-top: 30px;\">Фотоотчет: \"". $this->title ."\"</h2>";
        echo "<img style=\"display: block; float: left; margin-right: 10px;\" src=\"". self::IMG_PATH . $this->preview. "\" />";
        echo "<p>". $this->short_content ."</p><div style=\"clear: both;\"></div>";
        echo "</div>";
    }
}

class ArticlePub extends Publication
{
    public function printItem()
    {
        echo "<div style=\"margin-top: 30px; width: 600px;\"><h2 style=\"clear: both; margin-top: 30px;\">Статья: \"". $this->title ."\"</h2>";
        echo "<img style=\"display: block; float: left; margin-right: 10px;\" src=\"". self::IMG_PATH . $this->preview. "\" />";
        echo "<p>". $this->short_content ."</p><div style=\"clear: both;\"></div>";
        echo "</div>";
    }
}

$host="localhost";
$user="root";
$password="";
$database="learn_oop";

$con = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySql: ". mysqli_connect_error();
}
$result = mysqli_query($con, "SELECT * FROM test_table");

//создаем массив для хранения объектов
$mas_obj=array();

//заполяем массив объектами
while($row = mysqli_fetch_array($result)) {
    $mas_obj[] = new $row['type']($row);    //создается объект такого типа, которого типа запись в БД. Название класса берется в БД из поля type
    //запись равназначна той, что из переменной $row['type'] берется название класса, создаётся объект этого класса и в конструктор этого класса передаётся значение $row
    //аналогично, например: $mas_obj[] = new PhotoRepPub($row);
}

//echo '<pre>';
//print_r($mas_obj);

foreach($mas_obj as $item) {
    $item->printItem();     //вызываем метод объекта. У всех типов объектов одно и то же название метода printItem. Но делать оно будет разное
}
?></body>
</html>

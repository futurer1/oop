<html>
<head>
    <title>Контроль типов входных переменных для методов</title>
</head>
<body><?php

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
?></body>
</html>

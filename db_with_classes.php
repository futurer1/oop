<?php
header('Content-type: text/html; charset=win-1251');
?><html>
<head>
	<title>Урок 4. Как можно структурировать работу с БД через классы.</title>
</head>
<body>
<?php
class bdDataController		//класс для работы с БД
{
	public $val1;
	public $val2;
	public $val3;
	
	private function bdSave($query)
	{
		//выполняем запрос $query к БД
	}
	public function insertTableName1($field1, $field2, $field3)
	{
	}
	public function insertTableName2($field1, $field2, $field3)
	{
	}
	public function insertTableName3($field1, $field2, $field3)
	{
	}
	public function updateTableName1($field1, $field2, $field3)
	{
		//составляем запрос к БД на основе входных данных $field1, $field2, $field3
		//отправляем его на выполнение к mySQL в private метод bdSave через конструкцию $this->bdSave($query)
	}
	public function updateTableName2($field1, $field2, $field3)
	{
	}
	public function updateTableName3($field1, $field2, $field3)
	{
	}
	public function deleteTableName1($field1, $field2, $field3)
	{
	}
	public function deleteTableName2($field1, $field2, $field3)
	{
	}
	public function deleteTableName3($field1, $field2, $field3)
	{
	}
}
$obj=new bdDataController;
?>
</body>
</html>

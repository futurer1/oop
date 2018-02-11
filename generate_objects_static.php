class SomeClass
{
  private function __construct($a, $b) // закрытый внешний доступ к конструктору
  {
    //...
  }
  
  public static function createModelOne($c)
  {
    return new self($c, 'config param 1'); //различные предустановленные конфигурации конструктора
  }
  
  public static function createModelTwo($c)
  {
    return new self($c, 'config param 2');
  }
}

// использование
$obj = SomeClass::createModelOne('Ivan'); // использование статического метода класса для получения объекта
$obj1 = SomeClass::createModelTwo('Nikolay');

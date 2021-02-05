<?php

// использование одного и того же трейта в статических и нестатических методах класса через алиас метода

// объявление трейта
trait SomeTrait
{
    public function doSomething()
    {
        echo "Used".PHP_EOL;
    }
    
    // Алиас для метода трейта для вызова из статических методов
    public static function doSomethingStatic()
    {
        $self = new static;
        $self->doSomething();
    }
}

// применение трейта в статическом методе через алиас
class SomeClass
{
    use SomeTrait {
        SomeTrait::doSomethingStatic as staticDoSomethingStatic;
    }
    
    public static function staticMethod()
    {
        self::staticDoSomethingStatic(); // статический вызов
    }
}

// применение трейта в обычном методе класса
class SomeClass1
{
    use SomeTrait {
        SomeTrait::doSomething as doSomethingSpecial;
    }
    
    public function basicMethod()
    {
        $this->doSomethingSpecial(); // нестатический вызов
    }
}


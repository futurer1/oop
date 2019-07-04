<?php
/**
 * Однократная инициализация объекта внутри статического класса
 */
class SomeClass
{
    /**
     * @var \Database
     */
    private static $db = null;

    /**
     * @return Database
     */
    private static function getDb()
    {
        if (null === self::$db) { // Инициализация произойдет один раз только в момент первого вызова
            self::$db = new \Database();
        }
        return self::$db;
    }
}

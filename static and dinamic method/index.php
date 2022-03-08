<?php
class greeting {
    public static function welcome() {
        echo "Hello World!";
    }
}

// Вызов статического метода
greeting::welcome();


class pi
{
    public static $value = 3.14159;
}

// Вызов статического метода
echo pi::$value;



class MethodTest
{
    public function __call($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        echo "Calling object method '$name' "
            . implode(', ', $arguments). "\n";
    }

    public static function __callStatic($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        echo "Calling static method '$name' "
            . implode(', ', $arguments). "\n";
    }
}

$obj = new MethodTest;
$obj->runTest('in object context');

MethodTest::runTest('in static context');

?>
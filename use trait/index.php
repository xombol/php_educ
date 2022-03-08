<?php

trait Hello
{
    function sayHello() {
        echo "Привет";
    }
}

trait World
{
    function sayWorld() {
        echo "Мир";
    }
}

class MyWorld
{
    use Hello, World;
}

$world = new MyWorld();
echo $world->sayHello() . " " . $world->sayWorld(); //Hello World




/*
Вывод

Привет Мир

*/


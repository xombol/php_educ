<?php
// проверим, было ли получено значение в $_POST 
if ($_GET) {

    // подключаем файлы для работы с базой данных и файлы с объектами 
    include_once 'config/database.php';
    include_once 'objects/cars.php';

    // получаем соединение с базой данных 
    $database = new Database();
    $db = $database->getConnection();

    // подготавливаем объект Product 
    $car = new Car($db);

    // устанавливаем ID товара для удаления 
    $car->id = $_GET['id_delete'];

    // удаляем товар 
    if ($car->delete()) {
        echo "Товар был удалён.";
		
		echo '<a href="https://phpstorm.tmweb.ru/main/cars_info.php?id_delete=40">На главную</a> ';
    }

    // если невозможно удалить товар 
    else {
        echo "Невозможно удалить товар.";
    }
}
?>
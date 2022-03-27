<?php
// страница, указанная в параметре URL, страница по умолчанию - 1 
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// устанавливаем ограничение количества записей на странице 
$records_per_page = 5;

// подсчитываем лимит запроса 
$from_record_num = ($records_per_page * $page) - $records_per_page;

// включаем соединение с БД и файлы с объектами 
include_once 'config/database.php';
include_once 'objects/cars.php';

// создаём экземпляры классов БД и объектов 
$database = new Database();
$db = $database->getConnection();

$car = new Car($db);


// запрос товаров 
$stmt = $car->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

if($_GET['id_delete'] !== NULL)
{
	 $car->id = $_GET['id_delete'];
	 $car->deleteCar($delete_id);
   // $car->deleteCar($delete_id);
}


// установка заголовка страницы 
$page_title = "Вывод машин";

require_once "layout_header.php";
?>
<div class="container">

<div class='right-button-margin'>
    <a href='cars_create.php' class='btn btn-default pull-right'>Добавить машину</a>
</div>

<?php // подвал 
require_once "layout_footer.php";
?>

<?php
// отображаем товары, если они есть 
if ($num > 0) {

    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Товар</th>";
            echo "<th>Цена</th>";
            echo "<th>Описание</th>";
            echo "<th>Категория</th>";
            echo "<th>Действия</th>";
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            extract($row);

            echo "<tr>";
                echo "<td>{$marka}</td>";
                echo "<td>{$model}</td>";
                echo "<td>{$year}</td>";
                echo "<td>{$year}</td>";
                echo "<td><a href=" . "/main/cars_delete.php?id_delete={$id}"."> Удалить (". "{$id}"." ) </a></td>";

                echo "</td>";
  
                echo "<td>";
                    // здесь будут кнопки для просмотра, редактирования и удаления 
                echo "</td>";

            echo "</tr>";

        }

    echo "</table>";

    // здесь будет пагинация 
}

// сообщим пользователю, что товаров нет 
else {
    echo "<div class='alert alert-info'>Товары не найдены.</div>";
}
?>
</div>
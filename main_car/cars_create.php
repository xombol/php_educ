<?php
// подключим файлы, необходимые для подключения к базе данных и файлы с объектами 
include_once 'config/database.php';
include_once 'objects/cars.php';


// получаем соединение с базой данных 
$database = new Database();
$db = $database->getConnection();

// создадим экземпляры классов Product и Category 
$car = new Car($db);


$page_title = "Доб машины";

require_once "layout_header.php";
?>

<?php
// если форма была отправлена 
if ($_POST) {

    // установим значения свойствам товара 
    $car->marka = $_POST['marka'];
    $car->model = $_POST['model'];
    $car->year = $_POST['year'];
    $car->owner = $_POST['owner'];

    // создание товара 
    if ($car->create_car()) {
        echo "<div class='alert alert-success'>Товар был успешно создан.</div>";
    }

    // если не удается создать товар, сообщим об этом пользователю 
    else {
        echo "<div class='alert alert-danger'>Невозможно создать товар.</div>";
    }
}
?>

<div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-5">
<!-- HTML-формы для создания товара -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  
    <table class='table table-hover table-responsive table-bordered'>
  
        <tr>
            <td>Марка</td>
            <td><input type='text' name='marka' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Модель</td>
            <td><input type='text' name='model' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Год</td>
            <td><input name='year' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Владелец</td>
            <td>
             <input type='text' name='owner' class='form-control' />
            </td>
        </tr>
  
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Создать</button>
            </td>
        </tr>
  
    </table>
</form>
</div>
</div>


<?php // подвал 
require_once "layout_footer.php";
?>
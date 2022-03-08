<?php
$server = 'localhost';
$name = 'root';
$pass = '';
$name_db = 'cq82669_tiras';

$link =  mysqli_connect($server, $name, $pass, $name_db);
if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    print("Соединение установлено успешно");
}

echo '<br>';

//вывод всез данных из таблицы table1

$sql2 = 'SELECT id, name FROM table1';

$result = mysqli_query($link, $sql2);

while ($row = mysqli_fetch_array($result)) {
//    print("Город: " . $row['name'] . "; Идентификатор: . " . $row['id'] . "<br>");
}


// вывод в виде двухмерного массива

$sql = 'SELECT id, name FROM table1';

$result = mysqli_query($link, $sql);

while ($row = mysqli_fetch_array($result)) {
    print("Город: " . $row['name'] . "; Идентификатор: . " . $row['id'] . "<br>");
}
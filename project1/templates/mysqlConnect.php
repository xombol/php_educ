<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$BDname = "forum_project";

$mysqli = new mysqli($servername, $username, $password, $BDname);
mysqli_set_charset($mysqli, 'utf8');
if ($mysqli -> connect_error) {
    printf("Соединение не удалось: %s\n", $mysqli -> connect_error);
    exit();
};
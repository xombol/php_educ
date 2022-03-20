<?php
include_once "./templates/generation.php";

$id_topic = $_REQUEST['id_topic'];
$detail_id = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Категория</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <?php
    generation_head_menu($mysqli, $auth);
    generation_breadcrumb($mysqli, $id_topic, $detail_id);
    generation_posts_topic($mysqli, $id_topic);
    ?>
</div>
</body>
</html>
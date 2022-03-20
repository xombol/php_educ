<?php
include_once "./templates/generation.php";
include_once "./templates/session_main.php";
$id_article = $_REQUEST["id_article"];
//$comment = $_REQUEST["comment"];

//print_r($comment);

function send_comment ($mysqli, $comment, $id_article) {
    $sql = "INSERT INTO `comments` (`comment`, `id_article`, `date`) VALUES ('$comment', '$id_article', CURRENT_TIMESTAMP)";
    $mysqli -> query($sql);
    echo '<script>location.replace("http://localhost:63342/project1/post.php?id_article=' . $id_article . '");</script>'; exit;
}

if (isset($_REQUEST['doGo']) === true) {
    send_comment($mysqli, $_REQUEST['comment'], $id_article);
}

$id_topic_detail = $id_article;
$detail_name = $id_article;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Статья</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <?php
    generation_head_menu($mysqli, $auth);
    geot_id_topic_detail($mysqli, $id_topic_detail, $detail_name);

    generation_post($mysqli, $id_article);
    ?>
</div>
<div class="comments container">
    <hr>
    <form action="<?= $_SERVER["SCRIPT_NAME"] ?>">
        <textarea name="comment" id="" style="max-width: 800px;height:50px;width: 100%;"></textarea>
        <input type="hidden" name="id_article" value="<?php echo $id_article ?>">
        <input name="doGo" type="submit" value="Отправить">
    </form>
    <p>Коментарии:</p>
    <hr>

    <?php
    generation_comment($mysqli, $id_topic_detail);
    ?>
</div>
</body>
</html>
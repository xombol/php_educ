<?php
include_once "./templates/generation.php";
include_once "./templates/session_main.php";

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Регистрация</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>

    <div class="container">

        <?php
        generation_head_menu($mysqli, $auth);
        ?>
        <?php
        if ($auth->isAuth()) { // Если пользователь авторизован, приветствуем:
            echo "Hello, " . $auth->getLogin() ;
            echo "<br/><br/><a href='?is_exit=1'>Exit</a>"; //Показываем кнопку выхода
        }
        else { //Если не авторизован, показываем форму ввода логина и пароля
            ?>
            <div class="row">
                <div class="col-lg-4">
                    <h2>Registration</h2>
                    <form method="post" action="./templates/obr.php" name="signin-form">
                        <input type="hidden" name="register" value="new">
                        <div class="form-element">
                            <label>Username</label>
                            <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
                        </div>
                        <div class="form-element">
                            <label>login</label>
                            <input type="text" name="login" required />
                        </div>
                        <div class="form-element">
                            <label>Password</label>
                            <input type="password" name="password" required />
                        </div>
                        <button type="submit" >Register</button>
                    </form>
                </div>
                <div class="col-lg-4">
                    <h2>Login</h2>
                    <form method="POST" action="./templates/obr.php" name="auth">
                        <input type="hidden" name="auth" value="new_auth">
                        login <input name="login" type="text"><br>

                        Password <input name="password" type="password"><br>

                        Не прикреплять к IP(не безопасно) <input type="checkbox" name="not_attach_ip"><br>

                        <input name="submit" type="submit" value="Login">

                    </form>
                </div>
            </div>

            <?php
        }
        ?>

    </div>

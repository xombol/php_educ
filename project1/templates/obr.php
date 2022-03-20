<?php
include_once "session_main.php";
include_once "mysqlConnect.php";
// register

if(isset($_POST['register'])){
    if ($_POST['login'] != "" && $_POST['password'] != "" &&  $_POST['username'] != "" ) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $username = $_POST['username'];

        $sql = "SELECT login FROM users WHERE login='".$login."' LIMIT 1";
        $resSQL = $mysqli -> query($sql);
        while ($check_login = $resSQL -> fetch_assoc()) {
           $login_new_user =   $check_login["login"];
        }

        if (isset($login_new_user)) {
            if ($login_new_user == $login ) {
                echo "This user is register. Please write new login!";
            }
        }
        else {
            register($mysqli, $login, $username, $password);
        }
    }
}
function register ($mysqli, $login, $username, $password ) {
    $sql = "INSERT INTO `users` (`login`, `username`, `password`, `date`) VALUES ('$login','$username', '$password' , CURRENT_TIMESTAMP())";
    $mysqli -> query($sql);
     echo '<script>location.replace("http://localhost:63342/project1/auth.php");</script>'; exit;
}
function auth_user($mysqli, $login ) {
    $sql = "SELECT id, password, login FROM users WHERE login='".$login."' LIMIT 1";
    $resSQL = $mysqli -> query($sql);
    while ($data = $resSQL -> fetch_assoc()) {
        global $data_sql, $data_id;

        echo "<br>";
        echo "In BD = " . ($data["password"]) . "<br>";
        echo "In POST = " . ($_POST['password']) . "<br>";

        $data_sql = $data["password"];
        $data_id = $data["id"];
         $login_sql = $data["login"];
    }

    if(!$login_sql){
        echo "Данный логи не существует вернитеьс на главную";
    } else {
        echo "Логин существует";
    }


}
# Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {

        $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}
function auth_user_session (){
    $_SESSION["login"] = $_POST['login'];
    $_SESSION["is_auth"] = true;
}

# Соединямся с БД
if(isset($_POST['auth'])) {
    $login = $_POST['login'];
    echo "Текущий логин " . $login;
    # Вытаскиваем из БД запись, у которой логин равняеться введенному
    auth_user($mysqli, $login);

    # Соавниваем пароли
    if($data_sql == $_POST['password']) {
        # Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        if(!@$_POST['not_attach_ip'])
        {
            # Если пользователя выбрал привязку к IP
            # Переводим IP в строку
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        }

        # Записываем в БД новый хеш авторизации и IP
       // mysqli_query("UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        # Start session

       /* echo "<pre>";
            print_r($_SESSION);
        echo "</pre>"; */
        auth_user_session();

        # Переадресовываем браузер на страницу проверки нашего скрипта

        header("Location: /project1/auth.php"); exit();

    }
    else {

        print "Вы ввели неправильный логин/пароль";

    }

}

?>

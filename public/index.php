<?php
//============Блок для вывода всех ошибок интерпретатора=========//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//============Конец блока для вывода всех ошибок интерпретатора=========//
$cssFile =  'css/stylesheets/style.css';
var_dump($_POST);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=$cssFile?>">
    <title>Login</title>
</head>
<body>
    <div class="main_box">
        <div class="body">
                <form action="" method="post" class="login_form">
                    <h3>Вход</h3>
                    <hr>
                    <label for="login">Логин</label>
                    <input type="text" name="login" value="fedorov">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" value="ivan">
                    <input type="button" name="login_button" value="Войти">
                </form>
        </div>
        <!-- <div class="footer"></div> -->
    </div>
</body>
</html>

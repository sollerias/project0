<?php
//============Блок для вывода всех ошибок интерпретатора=========//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//============Конец блока для вывода всех ошибок интерпретатора=========//
$cssFile =  'css/stylesheets/style.css';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?=$cssFile?>">
    <title>Login</title>
</head>
<body>
    <div class="main_box">
        <div class="body">
               <h1>Главная страница</h1>
               <a href="http://localhost:8888/project0/public/index.php">Вернуться на страницу Логина</a>
        </div>
        <!-- <div class="footer"></div> -->
    </div>
</body>
</html>

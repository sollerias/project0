<?php
//============Блок для вывода всех ошибок интерпретатора=========//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//============Конец блока для вывода всех ошибок интерпретатора=========//
// require_once __DIR__ . '/ClassIngos.php'; 
var_dump($_POST);
$users = 
    [ 
       0 => 
        [
            'login' => 'sollerij',
            'password' => '012345',
            'userFirstName' => 'Ivan',
            'userLastName' => 'Ivanov'
        ],
       1 => 
        [
            'login' => 'bazzlighter',
            'password' => '123456',
            'userFirstName' => 'Ivan',
            'userLastName' => 'Petrov'
        ]  
    ]
;
$userLogin = mb_strtolower($_POST['login']);
$userPass = $_POST['password'];
if (isset($_POST['login_button'])) {
    $error = [];

     # проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
     {
 
         $err[] = "Логин может состоять только из букв английского алфавита и цифр";
 
     }

    if(strlen($userLogin) < 6 or strlen($userLogin) > 20)
    {

        $err[] = "Логин должен быть не меньше 3-х символов и не больше 20";

    }
    foreach ($users as $value) {
        var_dump($value);
        if (isset($users['login']) == $userLogin) {
            echo 'Такой пользователь уже существует';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="../public/index.php">Turn Back</a>
</body>
</html>
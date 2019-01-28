<?php
//============Блок для вывода всех ошибок интерпретатора=========//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//============Конец блока для вывода всех ошибок интерпретатора=========//
var_dump($_POST);

class Users
{
    public function __construct(){
    }
    public function Login($formData)
    {
        // var_dump();
        $arrJsonDecode = json_decode($formData, true);
        var_dump($arrJsonDecode);
        $loginButton =  $arrJsonDecode['login_button'];
        $userLogin =  mb_strtolower($arrJsonDecode['login']);
        $userPass =  $arrJsonDecode['password'];


        var_dump($loginButton);

        require_once(__DIR__ . '/login_data.php');
        if (isset($loginButton)) {
            $error = [];
        
             # проверям логин
            if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
             {
         
                 $error[] = "Логин может состоять только из букв английского алфавита и цифр";
         
             }
        
            if(strlen($userLogin) < 6 or strlen($userLogin) > 20)
            {
        
                $error[] = "Логин должен быть не меньше 3-х символов и не больше 20";
        
            }
            // foreach ($users as $value) {
            //     var_dump($value);
            //     if (isset($userLogin) && $userLogin == $users[0]['login']) {
            //         echo 'kakashka';
            //         $error[] =  'Такой пользователь уже существует';
            //     }
            // }
            var_dump($value);
        
        }
    }
}
$users = new Users;
$users->Login($_POST['loginData']);
?>
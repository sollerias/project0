<?php
//============Блок для вывода всех ошибок интерпретатора=========//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//============Конец блока для вывода всех ошибок интерпретатора=========//
// var_dump($_POST);

class Users
{
    public function __construct(){
    }
    public function Login($formData)
    {
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
            if(!preg_match("/^[a-zA-Z0-9]+$/", $userLogin))
             {
                 $error[] = "Логин может состоять только из букв английского алфавита и цифр";
             }
            if(strlen($userLogin) < 6 or strlen($userLogin) > 20)
            {
                $error[] = "Логин должен быть не меньше 3-х символов и не больше 20";
            }
            foreach ($users as $value) {
                if ($userLogin == $value['login']) {
                    $error[] = "Такой пользователь уже существует.<br>Введите другое имя.";
                }
            }
            if (!empty($error)) {
                foreach ($error as $value) {
                    echo $value . "<br>";
                }
                unset($error);
            } else{
                // $userLoginData = ;
                file_put_contents();
            }
            
        
        }
    }
}
$users = new Users;
$users->Login($_POST['loginData']);
?>
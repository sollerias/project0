<?php
//============Блок для вывода всех ошибок интерпретатора=========//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//============Конец блока для вывода всех ошибок интерпретатора=========//
// var_dump($_POST);
require_once(__DIR__ . '/ClassAutoload.php');
class Users
{
    private $userLogin;
    private $userPass;
    private $userLoginData = [];

    public function __construct(){
    }
    public function Login($formData)
    {
        require_once(__DIR__ . '/login_data.php');
        $db = new DB;
        $arrJsonDecode = json_decode($formData, true);
        $loginButton =  $arrJsonDecode['login_button'];
        $this->userLogin =  pg_escape_string(trim(mb_strtolower($arrJsonDecode['login'])));
        $this->userPass =  pg_escape_string(trim($arrJsonDecode['password']));
        var_dump($this->userLogin);
        var_dump($this->userPass);
        if (isset($loginButton)) {
            $error = [];
             # проверям логин
            if(!preg_match("/^[a-zA-Z0-9]+$/", $this->userLogin))
             {
                 $error[] = "Логин может состоять только из букв английского алфавита и цифр";
             }
            if(strlen($this->userLogin) < 6 or strlen($this->userLogin) > 20)
            {
                $error[] = "Логин должен быть не меньше 6-ти символов и не больше 20";
            }
            $query_sel = $db->sql("SELECT * FROM t_user;");
            while ($row = $db->getRow($query_sel)) {
                // Начало: для проверки регистрации
                // if ($row['user_login'] == $this->userLogin) {
                //     $error[] = "Такой пользователь уже существует. Введите другой логин";
                // }
                // Конец: для проверки регистрации

                if ($row['user_login'] == $this->userLogin && 
                    $row['user_password'] ==  $this->makeHash($this->userPass)) {
                    $pathToMain = "http://localhost:8888/project0/public/main.php";
                    header("Location: {$pathToMain}");
                }
            }
            if (!empty($error)) {
                foreach ($error as $value) {
                    echo $value . "<br>";
                }
                unset($error);
            } else{
                $this->userLoginData['login'] = $this->userLogin;
                $this->userLoginData['password'] = $this->makeHash($this->userPass);
                var_dump($this->userLogin . ' | ' . $this->userPass);
                $query_ins = $db->sql("INSERT INTO t_user (user_login, user_password)
                                        VALUES ('{$this->userLoginData['login']}', '{$this->userLoginData['password']}') ");
                // $this->userLoginData = json_encode($this->userLoginData, JSON_UNESCAPED_UNICODE);
                // $filePath = __DIR__ . '/user_data.php';
                // file_put_contents($filePath, $this->userLoginData, FILE_APPEND);
            }
        }
    }

    private function makeHash($data)
    {
        $dataHash = hash('sha512', $data);
        return $dataHash;
    }
}
$users = new Users;
$users->Login($_POST['loginData']);
?>
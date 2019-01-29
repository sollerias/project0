<?php
//============Блок для вывода всех ошибок интерпретатора=========//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//============Конец блока для вывода всех ошибок интерпретатора=========//
// require_once __DIR__ . '/ClassIngos.php'; 
class Autoload
{
    public function __construct(){
        spl_autoload_register(
            function($className) {
                require "Class{$className}.php";
            }
        );
    }
}
$autoload = new Autoload;

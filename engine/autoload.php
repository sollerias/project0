<?php
//============Блок для вывода всех ошибок интерпретатора=========//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//============Конец блока для вывода всех ошибок интерпретатора=========//
// require_once __DIR__ . '/ClassIngos.php'; 
spl_autoload_register(function ($name) {
    echo "Хочу загрузить $name.\n";
    throw new Exception("Невозможно загрузить $name.");
});

try {
    // $obj = new ClassIngos();
    $obj = new MyClass();

} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}
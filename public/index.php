<?php
//============Блок для вывода всех ошибок интерпретатора=========//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//============Конец блока для вывода всех ошибок интерпретатора=========//
// require_once  __DIR__ . '/engine.php';
// require_once  __DIR__ . '/config.php';

$a = 11.2;
$b = 3.4;

$a *= 100;
$b *= 100;

for ($i=0;$i<3;$i++) {
    $c = $a/$b;
    var_dump("#$i | " . $c);


    // Избавляемся от лишних чисел
    $c *= 100;
    var_dump("#$i | " . $c);

    $c = (int)$c;
    var_dump("#$i | " . $c);

    $c /= 100;
    var_dump("#$i | " . $c);

}
var_dump($c);
?>


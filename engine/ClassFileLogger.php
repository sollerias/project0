<?php
//============Блок для вывода всех ошибок интерпретатора=========//
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//============Конец блока для вывода всех ошибок интерпретатора=========//

class FileLogger
{
    public $name; // имя журнала
    public $lines = []; //накапливаемые строки
    private $file; // открытый файл
    /**
     * __construct - Создает новый файл журнала или открывает дозапись в конец 
     * существующего. Параметр $name - логическое имя журнала.
     *
     * @param string $name - имя журнала
     * @param string $fname - имя файла
     */
    public function __construct($name, $fname)
    {
        $this->name = $name;
        $this->file = fopen($fname, "a+");
    }
    /**
     * __destruct - Гарантированно вызывается при уничтожении объекта.
     * Закрывает файл журнала.
     */
    public function __destruct()
    {
        fputs($this->file, join("", $this->lines));
        fclose($this->file);
    }
    /**
     * log - Добавляет в журнал одну строку. Она не попадает в файл сразу же,
     * а записывается в буфер и остается там до вызова __destruct()
     *
     * @param mixed $str - строка с данными
     */
    public function log($str)
    {
        date_default_timezone_set("Europe/Kaliningrad");
        // $file_path = __DIR__  . '/logs';
		// if ( !is_dir($file_path) ) {
		// 	mkdir( $file_path, 0777);
		// }
        // Каждая строка предваряется текущей датой и именем журнала
        $prefix = "[" . date("Y-m-d_H:i:s ") . "{$this->name}]";
        $str =  $prefix . " Запись №" . microtime(true) . " " .  $str;
		$str = str_replace( array("\r", "\n"), '', trim($str) );
        // Сохраняем строку
        $this->lines[] = $str . "\n";
    }
}
?>
<?php
//============Блок для вывода всех ошибок интерпретатора=========//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//============Конец блока для вывода всех ошибок интерпретатора=========//
class DB
{
    public $dbconn;
    private $sql;
    public function __construct() {
        require realpath(__DIR__ . '/../config/connect.php');
        $con = "host=" . DBHOST . " port=" . DBPORT . " dbname=" . DBNAME . " user=" . DBUSER . " password=" . DBPASS;
        try{
            $this->dbconn = pg_connect($con);
            if(!$this->dbconn){
                throw new Exception("Ошибка подключения к Базе Данных: " . ' "' . DBNAME . '"' . pg_last_error());
                pg_close();
            } 
            // else {
            //     echo 'Успешное подключение к БД';
            // }
        } 
        catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $this->dbconn;
    }

    public function __destruct()
    {
        pg_close();
    }
    public function sql($query)
    {
        $sql = pg_query($this->dbconn, $query);
        var_dump($sql);
        return $sql;
    }
    public function getRow($query){
		return pg_fetch_array($query, null, PGSQL_ASSOC);
	}
}
// $db = new DB;
// $var1 = $db->sql("SELECT * FROM t_user");
// $var2 = $db->getRow($var1);
// foreach ($var2 as $key => $value) {
//     echo $key . " | " . $value;
// }
?>
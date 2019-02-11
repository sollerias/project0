<?php
require_once(__DIR__ . '/ClassAutoload.php');
ini_set('xdebug.var_display_max_depth', '10');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
class BotDirect  
{
    private $token = '706516504:AAEZoTTAYvDtV9Cl8NM2yuVscTiYjX-L-cc';
    private $proxy = "188.191.63.232:50939";
    private $url = '';
    private $error = [];
    private $baseUrl = 'getUpdates';
    private $sendUrl = 'sendMessage';
    private $chat = [];

    // public function __construct(){
    //     $this->url = "https://api.telegram.org/bot" . $this->token . "/getUpdates";
    //     $this->sendRequest($this->url, '', '');
    // }
    /**
     * getBotData - отправляет запрос в Telegram для получения данных чата
     *
     * @return void
     */
    public function getBotData(){
        $this->url = "https://api.telegram.org/bot" . $this->token . "/" . $this->baseUrl;
        $request = $this->sendRequest($this->url, '', '');
        $this->parseTelegramData($request);
    }

    /**
     * sendMessage - отправляет ответ в Telegram-чат по определенному ID
     *
     * @param int $chat_id
     * @return void
     */
    public function sendMessage(){
        var_dump($chat_id = $this->chat['id']);
        // if ($chat_id == 211630379) {
        //     $params = 
        //     [
        //         'chat_id' => $chat_id,
        //         'text' => 'Не только с помощью бота. Еще с помощью поцелуйчикоув. :)'
        //     ];
        // }
        $params = 
            [
                'chat_id' => $chat_id,
                'text' => 'Привет. Обращение принято!'
            ];
        
        // $this->url = "https://api.telegram.org/bot" . $this->token . '/' . $this->sendUrl . '?' . http_build_query($params);
        // $request = $this->sendRequest($this->url, '', '');
        // var_dump($request);
    }
    /**
     * returnHeaders - заголовки для отправки curl-запроса
     *
     * @param string $soapAction - url для передачи данных по SOAP
     * @param string $xml - xml-запрос
     * @return headers
     */
    private function returnHeaders($soapAction, $data){
        $headers = 
            [ 
                "Content-Type: text/xml; charset=utf-8",
                "Accept: text/xml",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
                "SOAPAction:" . '"' . $soapAction . '"',
                // "Content-length: " . strlen($data)
            ];
        return $headers;
    }
    /**
     * sendRequest - отправка curl-запроса в СК
     *
     * @param string $url - URL, на который отправляется запрос
     * @param string $soapAction - URL для передачи данных по SOAP
     * @param string $xml - xml-запрос
     * @return output
     */
    private function sendRequest($url, $soapAction, $data){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->returnHeaders($soapAction, $data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $output = curl_exec($ch);
        $status = curl_getinfo($ch);
        if ($output === false) {
            $data = "cURL Error: " . curl_error($ch) . ' = ' . curl_errno($ch);
            $this->errorLog("api_arsenal_error.log", "logs/api_error.log",  __LINE__, $data);
            echo "cURL Error: " . curl_error($ch) . ' = ' . curl_errno($ch) ;
        } else{
            if ($status['http_code'] != 200) {
                $data = __LINE__ . 'Информация по запросу: ' . var_export($status, true);
                $this->errorLog("api_arsenal_error.log", "logs/api_error.log", __LINE__, $data);
            } else {
                $data = ' Информация по запросу: ' . "url: " .substr($status['url'], 0, 55) . " | " ."http_code: {$status['http_code']} | " . "primary_port: {$status['primary_port']} | " . "primary_ip: {$status['primary_ip']}";
                $this->errorLog("api_arsenal.log", "logs/api.log",  __LINE__ , $data);
            }
            // echo 'Информация по запросу: ' . "<pre>" . print_r($status, true) . "</pre><br>";
        }
        // echo $output;
        curl_close($ch);

        return $output;
    }

    private function parseTelegramData($data){
        $chat = [];
        $updateId = '';
        $data = json_decode($data, true);
        if ($data['ok'] && !empty($data['result'])) {
            foreach ($data['result'] as $update) {
                echo $update['message']['text'] . '<br>';
                echo $updateId = $update['update_id'] . '<br>';
                // echo $chat['id'] = $update['message']['chat']['id'] . '<br>';
                echo $this->chat['id'] = $update['message']['chat']['id'];

            }
            echo (int)$updateId;
            // (int)$updateIdPlus = ($updateId+1);
        } else{
            $this->error[] = 'Нет данных для вывода';
            foreach ($this->error as $value) {
                echo $value . "<br>";
            }
        }
        // var_dump($data);
    }

    private function getLastMessage($idMessage){
        echo 'trim';
        $offset = '?offset='; 
        var_dump($offset);
        // $offset .= $idMessage + 1;
        // var_dump($offset);
        $this->sendRequest($this->url, '', '', $offset);
    }
     /**
     * errorLog - метод записи данных в лог
     *
     * @param string $journalName
     * @param string $fileName
     * @param mixed $logData
     * @return void
     */
    private function errorLog($journalName, $fileName,  $lineNumber, $logData)
    {
        $filePath =  pathinfo(__FILE__, PATHINFO_DIRNAME) . "/" . pathinfo(__FILE__, PATHINFO_BASENAME);
        $logger = new FileLogger($journalName, $fileName);
        $logger->log($logData, $filePath, $lineNumber);
    }

    
}
$bot = new BotDirect;
$bot->getBotData();
$bot->sendMessage();
// $bot->sendMessage(158798917);
// $bot->sendMessage(211630379);


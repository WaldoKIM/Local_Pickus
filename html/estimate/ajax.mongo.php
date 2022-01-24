
<?php
$model_code = $_GET['model_code'];
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database file
include_once 'mongodb_config.php';

$dbname = 'product';
$collection = 'productAll';


//DB connection
$db = new DbManager();
$conn = $db->getConnection();

// read all records
$filter = ['model_code' => ['$regex' => '^'.$model_code.'$', '$options' => 'i']];
$option = ['limit' => 1];
$read = new MongoDB\Driver\Query($filter, $option);

//fetch records
$records = $conn->executeQuery("$dbname.$collection", $read);
$json = json_encode(iterator_to_array($records), JSON_UNESCAPED_UNICODE);

// if($json == '[]'){
    $dir = "/var/www/html/estimate/log". date('Y/n/d');

    if(!is_dir($dir)){
        mkdir($dir,0777,true);
        chmod($dir,0777,true);
    }

    $log_txt = date('Y_m_d_H:i:s') . ' | '. '검색모델명'. ' : ' . $model_code . ' | ' . '검색된 정보' . ' : ' . $json;

    $log_dir = $dir."/";

    $file_name = date('Y_m_d');

    $log_file = fopen($log_dir."/".$file_name.".txt", "a");

    fwrite($log_file, $log_txt."\r\n");

    fclose($log_file);
// }
 echo $json;

?>
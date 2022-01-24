
<?php
$model_code = $_GET['model_code'];
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database file
include_once 'mongodb_config.php';

$dbname = 'product';
$collection = 'productnew';


//DB connection
$db = new DbManager();
$conn = $db->getConnection();

// read all records
$filter = ['model_code' => ['$regex' => $model_code, '$options' => 'i']];
$option = [];
$read = new MongoDB\Driver\Query($filter, $option);

//fetch records
$records = $conn->executeQuery("$dbname.$collection", $read);

echo json_encode(iterator_to_array($records), JSON_UNESCAPED_UNICODE);


?>

<?php
// $idx = $_POST['idx'];
// $model_code = $_POST['model_code'];
// $brand = $_POST['brand'];
// $model_name = $_POST['model_code'];
// $price = $_POST['price'];
// $year = $_POST['year'];
// $category2 = $_POST['category2'];
// $cateogry3 = $_POST['category3'];

$idx = '123123';
$model_code = '123123';
$brand = 'test';
$model_name = 'test';
$price = '123123';
$year = '1234년';
$category2 = 'test';
$cateogry3 = 'test';

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database file
include_once '../mongodb_config.php';

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

// insert records
$bulk = new MongoDB\Driver\BulkWrite;
$doc = [
    '_id' => new MongoDB\BSON\ObjectID, 
    'brand' => $brand,
    'model_code' => $model_code,
    'model_name' => $model_name,
    'price' => $price,
    'year' => $year,
    'category2' => $category2,
    'category3' => $cateogry3,
];
$bulk->insert($doc);

//update recodrds
$bulk2->insert(
    $filter,
    ['$push' => ['price' => $price]],
);

if($records == ''){
    $conn->executeBulkWrite("$dbname.$collection", $bulk);
} else {
    $conn->executeBulkWrite("$dbname.$collection", $bulk2);
}



?>
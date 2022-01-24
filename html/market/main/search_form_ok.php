<?include('../common.php');

$search_input = $_GET['search_input'];


// $goods_stat = $db->select("cs_goods_keyword", "where search_name = '$search_input'");
// $goods_data = mysqli_fetch_object($goods_stat);

// if($goods_data){
//     $db->update("cs_goods_keyword", "count='$goods_data->count'+1 where idx='$goods_data->idx'");
// } else {
//     $db->insert("cs_goods_keyword", "search_name='$search_input', count=1");
// }

    $db->insert("cs_goods_keyword", "search_name='$search_input', count=1, update_time=now()");
?>

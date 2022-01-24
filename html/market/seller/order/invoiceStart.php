<? 
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS; 
// 넘겨받은 데이타
$mv_data	= $_GET[trade_data];
$trade_data	= $tools->decode( $_GET[trade_data] );

if($_GET[idx] )	{ $idx = $_GET[idx]; }	else { $idx = $trade_data[idx]; }

if($_POST[idx]) {
	$order_stat = $db->object("cs_trade_goods", "where idx='$_POST[idx]'");
    $order_stat2 = $db->object("cs_trade", "where idx='$_POST[idx]'");
	if($order_stat->trage_stat <= 2){
		if($db->update("cs_trade_goods", "deliv_number='배송시작', trade_stat='3' where idx='$order_stat->idx'")){
			$db->update("cs_trade", "trade_stat='3' where idx='$order_stat2->idx'");
            $tools->msg('배송중 상태로 변경되었습니다.');
            $tools->javaGo("trade.php?trade_data=$mv_data");
		}
	}
}else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
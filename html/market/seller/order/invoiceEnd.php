<? 
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS; 
// 넘겨받은 데이타
$mv_data	= $_GET[trade_data];
$trade_data	= $tools->decode( $_GET[trade_data] );

if($_GET[idx] )	{ $idx = $_GET[idx]; }	else { $idx = $trade_data[idx]; }

if($_POST[idx]) {
	$order_stat = $db->object("cs_trade_goods", "where idx='$_POST[idx]'");
	if($order_stat->invoice_stat == 0){
		if($db->update("cs_trade_goods", "deliv_number='배송완료', invoice_stat='1' where idx='$order_stat->idx'") && $db->update("cs_trade", "invoice_stat='1' where trade_code='$order_stat->trade_code'")){
			
            $tools->msg('배송완료 상태로 변경되었습니다.');
            $tools->javaGo("trade.php?trade_data=$mv_data");
		}
	}
}else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
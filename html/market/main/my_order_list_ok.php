<?
include('../common.php'); 

$mv_data	= $_GET[trade_data];
$trade_data	= $tools->decode( $_GET[trade_data] );
if($_GET[idx] )	{ $idx = $_GET[idx]; }	else { $idx = $trade_data[idx]; }

	// 구매취소 처리
if( $_POST[idx] && $_POST[refund_remark] && $_POST[state]=="5") {
	$trade_stat = $db->object("cs_trade_goods", "where idx='$_POST[idx]'");
	if($trade_stat->trade_stat == 1 || $trade_stat->trade_stat == 0){
		if($db->update("cs_trade", "trade_stat=52, refund_remark='$_POST[refund_remark]',  refund_type='입금 전 취소',  refund_start=now(),  refund_end=now(), refund_ok=now(), trade_end_day=now() where idx='$trade_stat->idx' ")){
			$db->update("cs_trade_goods", "trade_stat=52,  refund_remark='$_POST[refund_remark]',  refund_type='입금 전 취소',  refund_start=now(),  refund_end=now(), refund_ok=now(), trade_end_day=now() where trade_code='$trade_stat->trade_code' ");
			$tools->javaGo("my_order_list.php?trade_data=$mv_data");
		}
	}else if($trade_stat->trade_stat ==2 OR $trade_stat->trade_stat ==3){
		if($db->update("cs_trade", "trade_stat=5, refund_remark='$_POST[refund_remark]', refund_type='구매자 요청', refund_start=now() where idx='$trade_stat->idx' ")){
			$db->update("cs_trade_goods", "trade_stat=5,  refund_remark='$_POST[refund_remark]',  refund_type='입금 전 취소',  refund_start=now(),  refund_ok=now(),  refund_end=now(), trade_end_day=now() where trade_code='$trade_stat->trade_code' ");
			$tools->javaGo("my_order_list.php?trade_data=$mv_data");
		}
	}
}else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

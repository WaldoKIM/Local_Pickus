<?
include('../../common.php'); 

$mv_data	= $_GET[trade_data];
$trade_data	= $tools->decode( $_GET[trade_data] );
if($_GET[idx] )	{ $idx = $_GET[idx]; }	else { $idx = $trade_data[idx]; }

// 거래취소 처리
if( $_POST[idx] && $_POST[refund_remark] && $_POST[state]=="51") {
	$order_stat = $db->object("cs_trade_goods", "where idx='$_POST[idx]'");
	if($order_stat->trade_stat == 1){
		if($db->update("cs_trade_goods", "trade_stat=52, refund_remark='$_POST[refund_remark]',  refund_type='입금 전 판매자 요청',  refund_start=now(), refund_end=now(), trade_end_day=now() where idx='$order_stat->idx' ")){
			$db->update("cs_goods", "number=1 where idx='$order_stat->goods_idx'");
			$tools->javaGo("trade.php?trade_data=$mv_data");
		}
	}if($order_stat->trade_stat == 5){
		if($db->update("cs_trade_goods", "trade_stat=51, refund_start=now(), refund_ok=now(),  trade_end_day=now() where idx='$order_stat->idx' ")){
			$db->update("cs_goods", "number=1 where idx='$order_stat->goods_idx'");
			$tools->javaGo("trade.php?trade_data=$mv_data");
		}
	}else if($order_stat->trade_stat < 4){
		if($db->update("cs_trade_goods", "trade_stat=51, refund_remark='$_POST[refund_remark]', refund_type='판매자 요청',  refund_start=now(), refund_ok=now(), trade_end_day=now() where idx='$order_stat->idx' ")){
			$db->update("cs_goods", "number=1 where idx='$order_stat->goods_idx'");
			$tools->javaGo("trade.php?trade_data=$mv_data");
		}
	}
	
	
}else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

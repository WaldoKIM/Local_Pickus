<?
include('../common.php'); 


if($_GET[idx] )	{ $idx = $_GET[idx]; }	else { $idx = $trade_data[idx]; }

	// 구매취소 처리
if( $_POST[idx] && $_POST[state]=="5" && $_POST[res_cd]=="0000" && $_POST[mod_type]=="STSC" ) {
	$trade_stat = $db->object("cs_trade_goods", "where idx='$_POST[idx]'");
	if($trade_stat->trade_stat <= 2 ){
		if($db->update("cs_trade", "trade_stat=52, refund_remark='고객변심',  refund_type='결제취소',  refund_start=now(),  refund_end=now(), refund_ok=now(), trade_end_day=now() where trade_code='$trade_stat->trade_code' ")){
			$db->update("cs_trade_goods", "trade_stat=52,  refund_remark='고객변심',  refund_type='결제취소',  refund_start=now(),  refund_end=now(), refund_ok=now(), trade_end_day=now() where trade_code='$trade_stat->trade_code' ");
			$db->update("cs_goods", "number=1 where idx='$trade_stat->goods_idx'");
            echo "<script>alert(\"결제 취소가 정상적으로 처리됐습니다.\");</script>";
            $tools->javaGo("my_order_list.php");
		}
	}
}else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
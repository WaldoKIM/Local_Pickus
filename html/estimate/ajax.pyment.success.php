<?php
include_once("./_common.php");

	$sql = "select * from g5_shop_order where od_id = $no_estimate";

	$info = sql_fetch($sql);

	if($info == null){
		
		$time = date("Y-m-d H:i:s");
		
		$sql_match = "insert into g5_shop_order (od_id,mb_id,od_name,od_tel,od_email,od_status,od_time,od_invoice,od_receipt_price,od_cart_count,od_delivery_company) value('$no_estimate','$email','$name','$number','$email','완료','$time','$title','$money','$items_count','$company')";
				
		sql_query($sql_match);
	}else{
		$time = date("Y-m-d H:i:s");
		
		$sql_match = "update g5_shop_order set od_time = '$time' where od_id = '$no_estimate'";
				
		sql_query($sql_match);

		$sql_match = "update g5_shop_order set od_receipt_price = '$money' where od_id = '$no_estimate'";

		sql_query($sql_match);

		$sql_match = "update g5_shop_order set od_status = '완료' where od_id = '$no_estimate'";

		sql_query($sql_match);
	}

?>
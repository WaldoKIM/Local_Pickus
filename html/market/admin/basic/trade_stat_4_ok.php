<?
include('../../common.php'); 
//if( !$_SESSION["ADMIN_USERID"] || !$_SESSION["ADMIN_PASSWD"]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}

// 판매완료
$trade_goods_result=$db->select("cs_trade_goods", "where trade_stat='3' and TO_DAYS(trade_start_day) < TO_DAYS(DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -15 Day), '%Y-%m-%d')) ");
$i = 1;
while( $trade_goods_stat=@mysqli_fetch_object( $trade_goods_result)){
	$trade_stat = $db->object("cs_trade","where trade_code='$trade_goods_stat->trade_code' ");
	//포인트 적용	
	if($trade_goods_stat->order_userid && $trade_goods_stat->goods_point !=0) {
		
		$title="상품구입적립금 거래번호 : ".$trade_goods_stat->trade_code."(".$trade_goods_stat->goods_code.")";
		$save_point= $trade_goods_stat->trade_price*$trade_goods_stat->goods_cnt*$trade_goods_stat->goods_point*0.01; 
		if($db->insert("cs_point", "userid='$trade_goods_stat->order_userid', title='$title', point='$save_point', register=now()")){
		}
	}
	//$db->update("cs_trade", "trade_stat=4, trade_end_day=now() where idx=$idx");
	$db->update("cs_trade_goods", "trade_stat=4, trade_end_day=now() where idx=$trade_goods_stat->idx");			

	//판매자에게 판매대금 적립
	$seller_stat = $db->object("cs_member", "where userid = '$trade_goods_stat->seller' ");
	$fee_rate = (100 - $admin_stat->fee_rate)*0.01;
	$save_point = ($trade_goods_stat->goods_price * $trade_goods_stat->goods_cnt * $fee_rate)+$trade_goods_stat->trade_deliv_price;
	$fee_point = ($trade_goods_stat->goods_price * $trade_goods_stat->goods_cnt) -($trade_goods_stat->goods_price * $trade_goods_stat->goods_cnt * $fee_rate);
	$title = "수익금(판매금액-수수료(".$admin_stat->fee_rate."%), 거래번호 : ".$trade_goods_stat->trade_code."(".$trade_goods_stat->goods_code.")배송비(".$trade_goods_stat->trade_deliv_price.")<br>".$trade_goods_stat->goods_price." * ".$trade_goods_stat->goods_cnt." - ".$fee_point." + ".$trade_goods_stat->trade_deliv_price;
	$db->insert("cs_cash", "userid='$trade_goods_stat->seller', title='$title', point='$save_point', cash=1, register=now()");			
	//echo $trade_goods_stat->seller."<br>";
	//echo $title."<br>";
	//echo $save_point."<br>";	
	//exit;	
	$i++;
}
$tools->javaGo("etc.php");	
?>
<?//=$i;?>

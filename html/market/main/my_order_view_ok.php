<?
include('../common.php');
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;
$MV_DATA	= $_GET["trade_data"];

if(!$_SERVER['HTTP_REFERER']){
	$tools->errMsg('잘못된 방식으로 접근하셨습니다.');
	exit;
}else if($_GET[state]==4){
	// 적립할 포인트를 적립한다.
	$trade_data	= $tools->decode( $MV_DATA );
	$idx = $trade_data[idx];
	
	$trade_goods_stat = $db->object("cs_trade_goods", "where idx=$idx");
	$trade_stat = $db->object("cs_trade", "where trade_code='$trade_goods_stat->trade_code'");
	if($trade_goods_stat->order_userid != $_SESSION[USERID] || $trade_goods_stat->trade_stat =="4" ){
		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.1');
		exit;
	}
	if($trade_goods_stat->order_userid && $trade_goods_stat->goods_point !=0) {
		$title="상품구입적립금 거래번호 : ".$trade_goods_stat->trade_code."(".$trade_goods_stat->goods_code.")";
		$save_point= $trade_goods_stat->trade_price*$trade_goods_stat->goods_cnt*$trade_goods_stat->goods_point*0.01; 
		$db->insert("cs_point", "userid='$trade_stat->order_userid', title='$title', point='$save_point', register=now()");
	}
	//$db->update("cs_trade", "trade_stat=4, trade_end_day=now() where idx=$idx");
	$db->update("cs_trade_goods", "trade_stat=4 where idx=$idx");	
	
	//판매자에게 판매대금 적립
	$trade_goods_result=$db->select("cs_trade_goods", "where trade_code='$trade_stat->trade_code' order by idx asc");
	//while( $trade_goods_row=@mysqli_fetch_object( $trade_goods_result)) {
		//$seller_stat = $db->object("cs_member", "where userid = '$trade_goods_stat->seller' ");
		$fee_rate = (100 - $admin_stat->fee_rate)*0.01;
		$save_point = ($trade_goods_stat->goods_price * $trade_goods_stat->goods_cnt * $fee_rate)+$trade_goods_stat->trade_deliv_price;
		$fee_point = ($trade_goods_stat->goods_price * $trade_goods_stat->goods_cnt) -($trade_goods_stat->goods_price * $trade_goods_stat->goods_cnt * $fee_rate);
		$title .= "수익금(판매금액-수수료(".$admin_stat->fee_rate."%), 거래번호 : ".$trade_stat->trade_code."(".$trade_goods_stat->goods_code.")배송비(".$trade_goods_stat->trade_deliv_price.")<br>".$trade_goods_stat->goods_price." * ".$trade_goods_stat->goods_cnt." - ".$fee_point." + ".$trade_goods_stat->trade_deliv_price;
		
		$db->insert("cs_cash", "userid='$trade_goods_stat->seller', title='$title', fee_trade_code = '$trade_stat->trade_code', fee_goods_price = '$trade_goods_stat->goods_price', fee_rate='$admin_stat->fee_rate', point='$save_point', cash=1, register=now()");			
		//echo $trade_goods_stat->seller."<br>";
		//echo $title."<br>";
		//echo $save_point."<br>";	
		//exit;		
	//}
	$tools->alertJavaGo("구매가 확정되었습니다..", "my_order_view.php?trade_data=$MV_DATA");
}else{
	if(!$_POST["content"]){
		$tools->errMsg('내용을 입력해 주세요.');
	} else if( $_POST["trade_goods_idx"] ) {	
		if( $_FILES[upfile][size] > 0 ) {
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
			if( $EXT_TMP = explode( ".", $_FILES[upfile][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[upfile][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n".$MAXFILESIZE."메가 까지 업로드 가능합니다"); exit(); }
			$upfile	= time()."&&".$_FILES[upfile][name];
			if( !@move_uploaded_file($_FILES[upfile][tmp_name], "../data/trade_data/".$upfile) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[upfile][tmp_name]);	} 
		} else {
			$upfile 	= "none";
		}
		
		$_POST["content"]	= $db->addSlash( $_POST["content"] );		
		$db->insert("cs_trade_comment", "content = '$_POST[content]', trade_goods_idx='$_POST[trade_goods_idx]', userid = '$_SESSION[USERID]', name='$_SESSION[NAME]', upfile='$upfile', reg_date = now()");
		$tools->alertJavaGo("등록 하였습니다.", "my_order_view.php?trade_data=$MV_DATA");
	} else {
		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.2');
	}
}
?>

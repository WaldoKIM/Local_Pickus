<?
include('../common.php');
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

// 즉시 구매
if($_POST[opt_code]) { //2021-04-29 다중선택 구매 추가 sinn
	$tools->javaGo('order.php?trade_method=2&CACHE=1&opt_code='.$_POST[opt_code]);
}else if($_GET[trade_method]==2) {
	$mv_data	= $_GET[goods_data];
	$goods_data	= $tools->decode( $_GET[goods_data] );
	if($_GET[idx] ) { $idx = $_GET[idx];} else { $idx = $goods_data[idx];}
	if($_GET[part_idx] ) { $part_idx = $_GET[part_idx]; } else { $part_idx = $goods_data[part_idx]; }
		
	// 장바구니를 먼저 비운다.
	$db->delete("cs_cart", "where cartopt=1 and (code ='$_SESSION[CART]' or userid='$_SESSION[USERID]')");
	$goods_stat = $db->object("cs_goods", "where idx=$idx");


	if(($goods_stat->unlimit==0) && ($goods_stat->number < $_POST[buy_goods_cnt])) {
		$tools->alertJavaGo('상품 재고가 부족합니다. 상품 수량을 확인해 주세요.', 'cart.php');
	} else {
		// 따음표 문제 해결
		$shopPrice = $goods_stat->shop_price;
		$goods_stat_name = addslashes($goods_stat->name);

		for($j=0;$j<sizeof($_POST[part_name]);$j++) {
			$priceCut = "";
			if($_POST[part_name][$j]){ $Optdata .= $_POST[part_name][$j]."/^/^".$_POST[option_select][$j]."/^CUT/^"; }
			$priceCut = explode(":", $_POST[option_select][$j]);
			$shopPrice += $priceCut[1];
		}
		$db->insert("cs_cart", "userid='$_SESSION[USERID]', code='$_SESSION[CART]', part_idx=$goods_stat->part_idx, goods_idx=$goods_stat->idx, goods_code='$goods_stat->code', goods_name='$goods_stat_name', goods_price=$shopPrice, goods_point=$goods_stat->point, goods_cnt=$_POST[buy_goods_cnt], opt_data='$Optdata', box=$goods_stat->box,  register=now(), seller='$goods_stat->seller', cartopt=1");
		
		//$_SESSION[CARTIDX] = mysqli_insert_id();
		$cart_stat = $db->object("cs_cart","where code='$_SESSION[CART]' ORDER BY idx DESC limit 1");
		$_SESSION[CARTIDX] = $cart_stat->idx;
		//echo $_SESSION[CARTIDX];
		//exit;
		
		$tools->javaGo('order.php?trade_method=2&CACHE=1&opt_code='.$_POST[opt_code]);
	}
}
?>

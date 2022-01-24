<?
include('../common.php');


$mv_data	= $_GET[goods_data];
$goods_data	= $tools->decode( $_GET[goods_data] );
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $goods_data[idx]; }
if($_GET[part_idx] )			{ $part_idx = $_GET[part_idx]; }						else { $part_idx = $goods_data[part_idx]; }
// 회원체크
if( !$_SESSION[USERID] || !$_SESSION[PASSWD] ) {
// 로그인 상태가 아니면 회원 로그인으로 보낸다
$tools->javaGo('login.php?login_go='.$_SERVER[REQUEST_URI]);
}
?>
<?
	if($_GET[wishlist_method]==1) {
		$goods_stat = $db->object("cs_goods", "where idx=$idx");
		$goods_stat_name = addslashes($goods_stat->name);
		$shopPrice = $goods_stat->shop_price;
		for($j=0;$j<sizeof($_POST[part_name]);$j++) {
			$priceCut = "";
			if($_POST[part_name][$j]){ $Optdata .= $_POST[part_name][$j]."/^/^".$_POST[option_select][$j]."/^CUT/^"; }
			$priceCut = explode(":", $_POST[option_select][$j]);
			$shopPrice += $priceCut[1];
		}
		$wishlist_goods_cnt = $db->object("cs_wishlist", "where userid='$_SESSION[USERID]' and goods_idx=$idx and opt_data='$Optdata'");
		if(($goods_stat->unlimit==0) && ($goods_stat->number < ($wishlist_goods_cnt->goods_cnt + $_POST[buy_goods_cnt]))) {
			$tools->alertJavaGo('상품 재고가 부족합니다. 상품 수량을 확인해 주세요.', 'cart.php');
		} else {
			if(empty($wishlist_goods_cnt->goods_cnt)) {
				$db->insert("cs_wishlist", "userid='$_SESSION[USERID]', part_idx=$part_idx, goods_idx=$idx, goods_code='$goods_stat->code', goods_name='$goods_stat_name', goods_price=$shopPrice, goods_point=$goods_stat->point, goods_cnt=$_POST[buy_goods_cnt], opt_data='$Optdata', box=$goods_stat->box, register=now()");
			} else {
				$update_buy_goods_cnt=$wishlist_goods_cnt->goods_cnt + $_POST[buy_goods_cnt];
				$db->update("cs_wishlist", "goods_cnt=$update_buy_goods_cnt where goods_idx=$idx");
			}
		}
	} else if($_GET[wishlist_method]==2) {
		// 현재 상품수량 체크
		$goods_stat=$db->object("cs_goods", "where idx=$_GET[goods_edit_idx]", "unlimit,shop_price, number");
		$shopPrice = $goods_stat->shop_price;
		for($j=0;$j<sizeof($_POST[part_name]);$j++) {
			$priceCut = "";
			if($_POST[part_name][$j]){ $Optdata .= $_POST[part_name][$j]."/^/^".$_POST[option_select][$j]."/^CUT/^"; }
			$priceCut = explode(":", $_POST[option_select][$j]);
			$shopPrice += $priceCut[1];
		}
		if(!$goods_stat->unlimit && ($goods_stat->number < $_GET[edit_goods_cnt])){
			$tools->msg('상품 보유량이 부족합니다\n\n보유량 : '.$goods_stat->number.' 개입니다.');
		} else {
			$updatecnt = $db->cnt("cs_wishlist", "where userid='$_SESSION[USERID]' and opt_data='$Optdata' and goods_idx=$_GET[goods_edit_idx]");
			$updateInfo = $db->object("cs_wishlist", "where userid='$_SESSION[USERID]' and opt_data='$Optdata' and goods_idx=$_GET[goods_edit_idx]");
			if($updateInfo->idx!=$_GET[wishlist_edit_idx] && $updatecnt){
				$tools->msg('같은 옵션의 상품이 존재합니다. 확인 후 이용하여 주세요.');
			}else{
				$db->update("cs_wishlist", "goods_price=$shopPrice, goods_cnt=$_GET[edit_goods_cnt], opt_data='$Optdata' where idx=$_GET[wishlist_edit_idx]");
			}
		}
	} else if($_GET[wishlist_method]==3) {
		$db->delete("cs_wishlist", "where idx=$_GET[wishlist_edit_idx]");
	}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/popup.css" rel="stylesheet" type="text/css">
</head><!------------제품 기본정보 출력 테이블 시작---------->
<table width="100%">
    <tr>
        <td height="100" align="center"><img src="skinimage/main_popupicon_title2.gif" border="0"></td>
	</tr>
</table>
<table width="100%">
    <tr>
        <td height="100" align="center"><!--<a href="javascript:parent.close_cenlayer()"><img src="skinimage/main_popupicon_close.gif" border="0"></a> --><a href="my_wishlist.php" target="_parent"><img src="skinimage/main_popupicon5.gif" border="0"></a></td>
	</tr>
</table>
<?//2021-04-29 다중선택 구매 추가 sinn
include('../common.php');

//echo $_GET[goods_data];
//echo $_POST[buy_goods_cnt];
//echo $_POST[part_name];
//echo $_POST[option_select];
//exit;

// 즉시 구매
$mv_data	= $_GET[goods_data];
$goods_data	= $tools->decode( $_GET[goods_data] );
if($_POST[idx] ) { $idx = $_POST[idx];} else { $idx = $goods_data[idx];}
if($_POST[part_idx] ) { $part_idx = $_POST[part_idx]; } else { $part_idx = $goods_data[part_idx]; }
$cnt_str = $_GET[cnt];

$db->delete("cs_cart_tmp","WHERE register < DATE_SUB(NOW(),INTERVAL 30 minute)"); // 30분 이상이 지난 데이터 삭제

if($cnt_str !="dn" && $cnt_str !="up" && $cnt_str !="del" && $_GET[opt_idx] ){ // 수량 변경
	$opt_stat = $db->object("cs_cart_tmp","WHERE idx=$_GET[opt_idx] and opt_code='$_GET[opt_code]' ");
	$goods_stat = $db->object("cs_goods", "where idx=$opt_stat->goods_idx");	
	if($cnt_str <1 &&  $_GET[opt_idx]){
		$tools->msg("1개 이상부터 구매하실 수 있습니다.");
	}else{
		if(($goods_stat->unlimit==0) && ($goods_stat->number < $cnt_str)) {
			$tools->msg('상품 재고가 부족합니다. 상품 수량을 확인해 주세요.');
		}else{			
			$db->update("cs_cart_tmp","goods_cnt=$cnt_str WHERE idx=$_GET[opt_idx] ");
		}		
	}
}else if($_GET[opt_idx] AND $cnt_str){ // 수량 변경
	$opt_stat = $db->object("cs_cart_tmp","WHERE idx=$_GET[opt_idx] and opt_code='$_GET[opt_code]' ");
	$goods_stat = $db->object("cs_goods", "where idx=$opt_stat->goods_idx");
	
	if($cnt_str=="del"){
		$db->delete("cs_cart_tmp","WHERE idx=$_GET[opt_idx] ");
	}else if($cnt_str=="up"){
		if(($goods_stat->unlimit==0) && ($goods_stat->number < $opt_stat->goods_cnt+1)) {
			$tools->msg('상품 재고가 부족합니다. 상품 수량을 확인해 주세요.');
		}else{
			$db->update("cs_cart_tmp","goods_cnt=goods_cnt+1 WHERE idx=$_GET[opt_idx] ");
		}		
	}else if($cnt_str=="dn"){
		if($opt_stat->goods_cnt ==1){
			$tools->msg("1개 이상부터 구매하실 수 있습니다.");
		}else{
			$db->update("cs_cart_tmp","goods_cnt=goods_cnt-1 WHERE idx=$_GET[opt_idx] ");
		}
	}else{
		$tools->msg("Error 1");
	}
}else{
	$opt_stat = $db->object("cs_cart_tmp","WHERE goods_idx=$idx and opt_code='$_GET[opt_code]'");
	$opt_sum = $db->sum("cs_cart_tmp", "where goods_idx=$idx and opt_code='$_GET[opt_code]'", "goods_cnt");
	$goods_stat = $db->object("cs_goods", "where idx=$idx");

	if(($goods_stat->unlimit==0) && ($goods_stat->number < $opt_sum+1)) {
		$tools->msg('상품 재고가 부족합니다. 상품 수량을 확인해 주세요.');
	}else {
		// 따음표 문제 해결
		$shopPrice = $goods_stat->shop_price;
		$goods_stat_name = addslashes($goods_stat->name);

		for($j=0;$j<sizeof($_POST[part_name]);$j++) {
			$priceCut = "";
			if($_POST[part_name][$j]){ $Optdata .= $_POST[part_name][$j]."/^/^".$_POST[option_select][$j]."/^CUT/^"; }
			$priceCut = explode(":", $_POST[option_select][$j]);
			$shopPrice += $priceCut[1];
			
			//if($_POST[option_select][$j] != "none"){
			//	echo $_POST[part_name][$j];
			//	echo $priceCut[0];
			//}?>
		<?
		}
		// /^/^none/^CUT/^
		if(preg_match('/\/\^\/\^none\/\^CUT\/\^/',$Optdata)){
			$tools->msg('옵션을 선택해 주세요.');
		}else if($db->cnt("cs_cart_tmp","WHERE opt_data='$Optdata' and opt_code='$_GET[opt_code]'")) {
			$tools->msg('이미 선택한 상품입니다.');
		}else{
			$db->insert("cs_cart_tmp", "userid='$_SESSION[USERID]', code='$_SESSION[CART]', opt_code='$_GET[opt_code]',  part_idx=$goods_stat->part_idx, goods_idx=$goods_stat->idx, goods_code='$goods_stat->code', 
				goods_name='$goods_stat_name', goods_price=$shopPrice, goods_point=$goods_stat->point, goods_cnt=1, 
				opt_data='$Optdata',  box=$goods_stat->box, seller='$goods_stat->seller', register=now(), cartopt=1");
			$cart_stat = $db->object("cs_cart_tmp","where code='$_SESSION[CART]' ORDER BY idx DESC limit 1");
			$_SESSION[CARTIDX] = $cart_stat->idx;
		}
	}
}
?>	
<?
	$cart_result=$db->select("cs_cart_tmp", "where 1 and opt_code='$_GET[opt_code]' order by idx asc");
	$total_goods_price=0;  // 총금액
	$total_goods_point=0;  // 총포인트
	$form_cnt=0;
	while($cart_row=@mysqli_fetch_object($cart_result)) {
		$form_cnt++;
		// 총금액
		$total_goods_price+=$cart_row->goods_price*$cart_row->goods_cnt;
		// 총포인트
		$total_goods_point+=$cart_row->goods_price*$cart_row->goods_cnt*$cart_row->goods_point*0.01;
		$goods_name=stripslashes($cart_row->goods_name);
		// 기본 데이타 엔코딩
		$goods_data = $tools->encode("idx=".$cart_row->goods_idx."&part_idx=".$cart_row->part_idx);
		$goodsInfo = $db->object("cs_goods", "where idx=$cart_row->goods_idx and display=1");
		$ThumbEncode = $tools->encode("idx=".$cart_row->goods_idx."&table=cs_goods&img=images1&dire=goodsImages&w=125&h=125");
		//삭제된 경우 나오지 않도록 한다.
		$lastidx = $cart_row->goods_idx;
	?>
		<p style="padding-top:20px;">
	<?
		$optArr = explode("/^CUT/^", $cart_row->opt_data);
		for($i=0;$i<count($optArr)-1;$i++){
			$optRec = explode("/^/^", $optArr[$i]);	
			$optView = explode(":", $optRec[1] );
		?>		
			<?=$optView[0];?>
			<?if(count($optArr)-1 > $i+1){?>/<?}?>
		<?}?>
			/<?=number_format($cart_row->goods_price * $cart_row->goods_cnt);?>원
			<br>
			<a href="javascript:opt_cnt('<?=$mv_data;?>',<?=$cart_row->idx;?>,'dn')" class='company_smallBtn02'>-</a>
				<input name="buy_goods_cnt_<?=$cart_row->idx;?>" type="text" class="formText" size="5" value="<?=$cart_row->goods_cnt;?>" style="text-align: right;" onchange="opt_cnt('<?=$mv_data;?>',<?=$cart_row->idx;?>,this.value)<?/*if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;*/?>"> 개
			<a href="javascript:opt_cnt('<?=$mv_data;?>',<?=$cart_row->idx;?>,'up')" class='company_smallBtn02'>+</a>
			<a href="javascript:opt_cnt('<?=$mv_data;?>',<?=$cart_row->idx;?>,'del')" class='company_smallBtn03' style="margin-left:50px;">삭제</a>			
		</p>
	<?}?>

<p style="font-size: 18pt; color: #181818;font-weight: 700; padding: 20px 0;">
	합계 : <?=number_format($total_goods_price);?>원
</p>

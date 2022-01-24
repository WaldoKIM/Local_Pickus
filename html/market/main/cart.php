<? include('./include/head.inc.php');?>
<?
//2021-04-29 다중선택 구매 추가 sinn
if($_POST[opt_code]) { //다중 선택 즉시구매
	$_GET[goods_data] = "";
	$_GET[cart_method] = "";
	$cart_tmp_result=$db->select("cs_cart_tmp", "where opt_code='$_POST[opt_code]' order by idx asc");
	$cart_cnt=$db->cnt("cs_cart_tmp", "where opt_code='$_POST[opt_code]'");
	while($cart_tmp_row=@mysqli_fetch_object($cart_tmp_result)) {
		$goods_stat = $db->object("cs_goods","where code='$cart_tmp_row->goods_code'");
		if($db->cnt("cs_cart","WHERE userid='$_SESSION[USERID]' and opt_data='$cart_tmp_row->opt_data' and goods_idx=$cart_tmp_row->goods_idx ")) {
			
		}else{
			$db->insert("cs_cart", "userid='$_SESSION[USERID]', code='$_SESSION[CART]', 
				part_idx='$cart_tmp_row->part_idx', goods_idx='$cart_tmp_row->goods_idx', 
				goods_code='$cart_tmp_row->goods_code', goods_name='$cart_tmp_row->goods_name', 
				goods_price='$cart_tmp_row->goods_price', 
				goods_point='$cart_tmp_row->goods_point', goods_cnt='$cart_tmp_row->goods_cnt', 
				opt_data='$cart_tmp_row->opt_data', box='$cart_tmp_row->box', seller='$goods_stat->seller', register=now()");
			
			$db->delete("cs_cart_tmp", "where idx='$cart_tmp_row->idx'");
		}
	}
}

$mv_data	= $_GET[goods_data];
$goods_data	= $tools->decode( $_GET[goods_data] );
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $goods_data[idx]; }
if($_GET[part_idx] )			{ $part_idx = $_GET[part_idx]; }						else { $part_idx = $goods_data[part_idx]; }
//회원여부판단하여 장바구니 보여줌
if(!$_SESSION[USERID]){
	$query = "code='$_SESSION[CART]'";
}else{
	$query = "userid='$_SESSION[USERID]'";
}

	//기존의 바로구매 내역은 정리
	$db->delete("cs_cart", "where cartopt=1 and (code ='$_SESSION[CART]' or userid='$_SESSION[USERID]')");
	// 상품 상세정보에서 넘어온다 [cart_method 는 1입니다]
	if($_GET[cart_method]==1) {
		$goods_stat = $db->object("cs_goods", "where idx=$idx");
		$goods_stat_name = addslashes($goods_stat->name);
		$shopPrice = $goods_stat->shop_price;
		for($j=0;$j<sizeof($_POST[part_name]);$j++) {
			$priceCut = "";
			if($_POST[part_name][$j]){ $Optdata .= $_POST[part_name][$j]."/^/^".$_POST[option_select][$j]."/^CUT/^"; }
			$priceCut = explode(":", $_POST[option_select][$j]);
			$shopPrice += $priceCut[1];
		}
		$cart_goods_cnt = $db->object("cs_cart", "where goods_idx=$idx and $query and opt_data='$Optdata'");
		if(($goods_stat->unlimit==0) && ($goods_stat->number < ($cart_goods_cnt->goods_cnt + $_POST[buy_goods_cnt]))) {
			$tools->alertJavaGo('상품 재고가 부족합니다. 상품 수량을 확인해 주세요.', 'cart.php');
		} else {
			if(empty($cart_goods_cnt->goods_cnt)) {
				// 따음표 문제 해결
				$db->insert("cs_cart", "userid='$_SESSION[USERID]', code='$_SESSION[CART]', part_idx=$part_idx, goods_idx=$idx, goods_code=$goods_stat->code, goods_name='$goods_stat_name', goods_price=$shopPrice, goods_point=$goods_stat->point, goods_cnt=$_POST[buy_goods_cnt], opt_data='$Optdata', box=$goods_stat->box, seller='$goods_stat->seller', register=now()");
			} else {
				$update_buy_goods_cnt=$cart_goods_cnt->goods_cnt + $_POST[buy_goods_cnt];
				$db->update("cs_cart", "goods_cnt=$update_buy_goods_cnt where idx=$cart_goods_cnt->idx");
			}
		}
		// 장바구니 수량수정한다.[ cart_method 는 2입니다]
	} else if($_GET[cart_method]==2) {
		// 현재 상품수량 체크
		$goods_stat=$db->object("cs_goods", "where idx=$_GET[goods_edit_idx]");
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
			$updatecnt = $db->cnt("cs_cart", "where code='$_SESSION[CART]' and opt_data='$Optdata' and goods_idx=$_GET[goods_edit_idx]");
			$updateInfo = $db->object("cs_cart", "where code='$_SESSION[CART]' and  opt_data='$Optdata' and goods_idx=$_GET[goods_edit_idx]");
			if($updateInfo->idx!=$_GET[cart_edit_idx] && $updatecnt){
				$tools->msg('같은 옵션의 상품이 존재합니다. 확인 후 이용하여 주세요.');
			}else{
				$db->update("cs_cart", "goods_price=$shopPrice, goods_cnt=$_GET[edit_goods_cnt], opt_data='$Optdata' where idx=$_GET[cart_edit_idx]");
			}
		}
		// 장바구니 삭제한다.[ cart_method 는 3입니다]
	} else if($_GET[cart_method]==3) {
		$db->delete("cs_cart", "where idx=$_GET[cart_edit_idx]");
	}
	
//장바구니 정리 - 로그인이전에 장바구니 담긴 제품에 대하여 로그인후 적용
//동일한 제품이 있을경우에는 이전제품은 삭제후 등록
if($_SESSION[USERID]){
	$cart_result=$db->select("cs_cart", "where 1 and code='$_SESSION[CART]' and userid='' order by idx asc");
	while($cart_row=@mysqli_fetch_object($cart_result)) {
		if($db->cnt("cs_cart", "where goods_idx='$cart_row->goods_idx' and userid='$_SESSION[USERID]' and idx<>'$cart_row->idx'")){
			$delobj = $db->object("cs_cart", "where goods_idx='$cart_row->goods_idx' and userid='$_SESSION[USERID]' and idx<>'$cart_row->idx'");
			$db->delete("cs_cart", "where idx='$cart_row->idx'");
		}
		$db->update("cs_cart", "userid='$_SESSION[USERID]' where idx='$cart_row->idx'");
	}
}
//장바구니 정보 갱신 - 가격변경 및 옵션변경건의 경우 삭제처리한다.
$cart_result=$db->select("cs_cart", "where 1 and $query order by idx asc");
$atemp = 0;
while($cart_row=@mysqli_fetch_object($cart_result)) {
	$err = $itemprice = 0;
	$goodsInfo = "";
	$goodsInfo = $db->object("cs_goods", "where idx=$cart_row->goods_idx and display=1");
	$itemprice = $goodsInfo->shop_price;
	if(!$goodsInfo->idx) $err = 1;
	$optArr = explode("/^CUT/^", $goodsInfo->opt_data);
	$CartoptArr = explode("/^CUT/^", $cart_row->opt_data);
	if(count($optArr)!=count($CartoptArr)) $err = 1;
	for($i=0;$i<count($optArr)-1;$i++){
		$optRec = explode("/^/^", $optArr[$i]);
		$CartoptRec = explode("/^/^", $CartoptArr[$i]);
		if($optRec[0]!=$CartoptRec[0]) $err = 1;
		$option1_arr = explode("&&", "&&".$optRec[1]);
		if(array_search($CartoptRec[1],$option1_arr) < 1)  $err = 1;
		for( $ot1=0; $ot1 < count($option1_arr)-1; $ot1++ ) {
			$optView = "";
			$optView = explode(":", $option1_arr[$ot1] );
			if($option1_arr[$ot1]==$CartoptRec[1]) $itemprice += $optView[1];
		}
	}
	if($itemprice!=$cart_row->goods_price) $err = 1;
	if($err==1){
		$db->delete("cs_cart", "where idx='$cart_row->idx'");
		$delinfo = 1;
	}
	if($goodsInfo->subitem > 1){
		$atemp++;
		$subitem[$atemp] = $cart_row->goods_idx;
	}
}
//장바구니 갯수
$cartCnt=$db->cnt("cs_cart", "where 1 and $query");

?>
<script language="JavaScript">
	<!--
	function cartEdit(f, cartIdx, goodsIdx) {
		if(f.edit_goods_cnt.value=="" ||f.edit_goods_cnt.value=="0" ||f.edit_goods_cnt.value==0 ) {
			alert("수량을 입력해 주십시오.");
			f.edit_goods_cnt.focus();
		} else {
			f.action = "<?=$_SERVER[PHP_SELF];?>?goods_data=<?=$mv_data;?>&cart_method=2&cart_edit_idx="+cartIdx+"&edit_goods_cnt="+f.edit_goods_cnt.value+"&goods_edit_idx="+goodsIdx;
			f.submit();
		}
	}
	function cartcheckbox(){
		var str = "";
		var price = point = j = 0;
		/*  해당 그룹에 있는 체크박스 모두 해제  */
		for (i = 1; i <= <?=$cartCnt?>; i++)
		{
			if(document.all["checkidx_"+i].checked==true){
				j++;
				if(j==1){
					str = document.all["checkidx_"+i].value;
				}else{
					str = str+","+document.all["checkidx_"+i].value;
				}
				price = price + Number(document.all["cartprice_"+i].value);
				point = point + Number(document.all["cartpoint_"+i].value);
			}
		}
		document.buycartinfo.cartidx.value = str;
		document.buycartinfo.cartprice.value = price;
		document.all.tprice.innerHTML = commify(price)+"";
		document.all.tpoint.innerHTML = commify(point)+"";
	}
	function commify(n) {
	  var reg = /(^[+-]?\d+)(\d{3})/;   // 정규식
	  n += '';                          // 숫자를 문자열로 변환
	  while (reg.test(n))
		n = n.replace(reg, '$1' + ',' + '$2');
	  return n;
	}
	function cartsubmit() {
		form = document.buycartinfo;
		if(form.cartprice.value > 0){
			form.submit();
		}else{
			alert("구매상품을 하나 이상 선택하여 주세요.");
		}
	}
	//-->
</script>
<script type="text/javascript">
	$(function(){
	  $('ul.data_cell li.prd_ea span.plus').click(function(){
		var n = $('ul.data_cell li.prd_ea span.plus').index(this);
		var num = $(".num:eq("+n+")").val();
		num = $(".num:eq("+n+")").val(num*1+1);
	  });
	  $('ul.data_cell li.prd_ea span.minus').click(function(){
		var n = $('ul.data_cell li.prd_ea span.minus').index(this);
		var num = $(".num:eq("+n+")").val();
		var num2 = $(".num:eq("+n+")").val();
		num = $(".num:eq("+n+")").val(num*1-1);
		if(num2 <= 1){
			alert('수량은 1개 이상이어야 합니다.');
			$(".num:eq("+n+")").val(1)
		}
	  });
	})
</script>
<div class="site-wrapper" id="box_wrapper">
	<!--상단로고, 가이드메뉴-->
	<? include('./include/top_guide.inc.php');?>
	<!--상단메뉴, 로테이트베너-->
	<? include('./include/top_menu.inc.php');?>
		<!--페이지 위치-->
		<div class="my_location">
			<ol class="breadcrumb titletxt_B">
				<li><a href="index.php" class="titletxt_A">Home</a></li>
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li><i class="fas fa-arrow-left"></i>장바구니</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section style="margin-bottom: 100px !important;"id="blog" class="section cart_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<h3 class="tit">장바구니</h3>
					<!--********************내용영역 출력 시작********************-->
					<!--장바구니 테이블 시작-->
					<div class="order_list_area">
						<form name="buycartinfo" method="POST" action="order.php?trade_method=1">
							<input type="hidden" name="cartidx" value="">
							<input type="hidden" name="cartprice" value="">
						</form>
						<ul class="header_cell">
							<li class="check">선택</li>
							<li class="prd_info">상품정보</li>
							<li style="display:none;" class="sell_p">판매가격</li>
							<li class="order_p">주문금액</li>
							<li class="prd_ea">수량</li>
							<li style="display:none;" class="point">적립금</li>
							<li style="display:none;" class="btn">계산&middot;삭제</li>
						</ul>
						<?
							$cart_result=$db->select("cs_cart", "where 1 and $query order by idx asc");
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
						<form name="form_<?=$form_cnt;?>" method="post">
							<input type="hidden" name="cartprice_<?=$form_cnt;?>" value="<?=$cart_row->goods_price*$cart_row->goods_cnt?>">
							<input type="hidden" name="cartpoint_<?=$form_cnt;?>" value="<?=$cart_row->goods_price*$cart_row->goods_cnt*$cart_row->goods_point*0.01?>">
							<ul class="data_cell">
								<li class="check"><input type="checkbox" name="checkidx_<?=$form_cnt;?>" value="<?=$cart_row->idx?>" onclick="cartcheckbox()" checked></li>
								<li class="prd_photo">
									<a href="product_view.php?goods_data=<?=$goods_data;?>" class="product-image"><img src="../data/goodsImages/<?=$goodsInfo->images1?>" border="0"></a>
								</li>
								<li class="prd_name_option">
									<a href="product_view.php?goods_data=<?=$goods_data;?>"><?=$goods_name;?></a>
									<!--옵션-->
									<?
									$optArr = "";
									$optArr = explode("/^CUT/^", $goodsInfo->opt_data);
									$CartoptArr = explode("/^CUT/^", $cart_row->opt_data);
									for($i=0;$i<count($optArr)-1;$i++){
										$optRec = explode("/^/^", $optArr[$i]);
										$CartoptRec = explode("/^/^", $CartoptArr[$i]);
									?>
									<dl>
										<dt><?=$optRec[0];?></dt>
										<dd>
											<input type="hidden" name="part_name[]" value="<?=$optRec[0];?>">
											<select name="option_select[]" class="formSelect">
												<!-- <option value="none"<?if("none"==$CartoptRec[1]){?>selected<?}?>>옵션선택</option> -->
												<?
												$option1_arr = explode("&&", $optRec[1] );
												for( $ot1=0; $ot1 < count($option1_arr)-1; $ot1++ ) {
													$optView = "";
													$optView = explode(":", $option1_arr[$ot1] );
												?>
												<option value="<?=$option1_arr[$ot1];?>"<?if($option1_arr[$ot1]==$CartoptRec[1]){?>selected<?}?>><?=$optView[0]?><?if($optView[1]){?>:<?=number_format($optView[1])?>원<?}?></option>
												<? }?>
											</select>
										</dd>
									</dl>
									<?}?>
									<!--//옵션-->
								</li>
								<li style="display:none;" class="sell_p"><span><?=number_format($cart_row->goods_price);?></span>원</li>
								<li class="order_p"><span><?=number_format($cart_row->goods_price*$cart_row->goods_cnt);?></span>원</li>
								<li class="prd_ea">
									<div>
										<span style="display:none;" class="plus">+</span>
										<input name="edit_goods_cnt" class="num" type="text" value="<?=$cart_row->goods_cnt;?>" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">개
										<span style="display:none;" class="minus">-</span>
									</div>
								</li>
								<li style="display:none;" class="point"><span><?=number_format($cart_row->goods_price*$cart_row->goods_point*0.01);?></span>point</li>
								
								<li class="btn">
								<a href="order.php?trade_method=2&cartidx=<?=$cart_row->idx;?>" onfocus="this.blur()" alt="바로구매"  class='cart_btn_buy order' >바로구매</a>
								<a style="display:none;" href="javascript:cartEdit(document.form_<?=$form_cnt;?>, <?=$cart_row->idx;?>, <?=$cart_row->goods_idx;?>);" onfocus="this.blur()" alt="새로계산" class='new'>새로계산</a>
								<a href="<?=$_SERVER[PHP_SELF];?>?goods_data=<?=$mv_data;?>&cart_method=3&cart_edit_idx=<?=$cart_row->idx;?>" onfocus="this.blur()" alt="삭제하기" class='cart_btn_del del'>삭제</i></a>
								</li>
							</ul>
						</form>
						<? }?>
							<? if($form_cnt==0) {?>
							<div class='none_list'>장바구니에 담겨진 상품이 없습니다.</div>
						<? }?>
					</div>
                    <!--//장바구니 테이블 시작-->
					<!--합계금액-->
					<div class="amount_of_payment">
						<table>
							<tr style="display:none;">
								<th>총 적립금</th>
								<th>총 결제금액</th>
							</tr>
							<tr class="total_tr">
								<td style="display:none;"><?=number_format($total_goods_point);?><span class="point">point</span></td>
								<td>총 결제금액<span class="total"><?=number_format($total_goods_price);?></span>원</td>
							</tr>
						</table>
					</div>
					<!--모바일 합계금액-->
					<div class="m_amount_of_payment">
						<table>
							<tr style="display:none;">
								<th>총 적립금</th>
								<td><?=number_format($total_goods_point);?><span class="point">point</span></td>
							</tr>
							<tr>
								<th>총 결제금액</th>
								<td><span class="total"><?=number_format($total_goods_price);?></span>원</td>
							</tr>
						</table>
					</div>
					<div class="bottom_btn">
						<!-- 계속쇼핑하기 -->
						<? if($form_cnt) {?>
						<a href="product_list.php?goods_data=<?=$goods_data;?>" class="btn1">
						<?} else {?>
						<a href="index.php" class="btn1">
						<? }?>
						쇼핑계속하기</a>
						<!-- 주문서작성 -->
						<?php /*
						<? if($form_cnt) {?>
						<a href="javascript:cartsubmit()" class="btn2">주문하기</a>
						<?} else {?>
						<? }?>
						*/?>
					</div>
					<!--장바구니 테이블 끝-->
					<?/*
					<!--관련상품 테이블 시작-->
					<!-- 장바구니 담겨진 제품중 관련상품 설정이 되어 있는 상품만 배열화하여 랜덤하게 장바구니 관련상품으로 추출-->
					<div class="main">
						<?
						if(count($subitem)>0){
						echo "<hr/>";
						$randidx = $subitem[rand(1,count($subitem))];
						$goods_stat = $db->object("cs_goods", "where idx=$randidx");
						if($goods_stat->subitem==2) include('./include/related_a_type.inc.php');
						else if($goods_stat->subitem==3) include('./include/related_b_type.inc.php');
						}
						?>
					</div>
					*/?>
					<!--********************내용영역 출력 끝********************-->
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->
<script language="JavaScript">
	<!--
	cartcheckbox();
	//-->
</script>
<?if($delinfo) $tools->msg("상품가격 및 옵션 변경으로 인하여 일부 제품이 삭제처리 되었습니다.");?>
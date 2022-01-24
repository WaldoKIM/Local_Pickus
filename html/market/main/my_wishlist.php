<? include('./include/head.inc.php');?>
<?
//2021-04-29 다중선택 구매 추가 sinn
if($_POST[opt_code]) { //다중 선택 즉시구매
	$_GET[goods_data] = "";
	$_GET[wishlist_method] = "";
	$cart_tmp_result=$db->select("cs_cart_tmp", "where opt_code='$_POST[opt_code]' order by idx asc");
	$cart_cnt=$db->cnt("cs_cart_tmp", "where opt_code='$_POST[opt_code]'");
	while($cart_tmp_row=@mysqli_fetch_object($cart_tmp_result)) {
		if($db->cnt("cs_wishlist","WHERE opt_data='$cart_tmp_row->opt_data' and goods_idx=$cart_tmp_row->goods_idx ")) {
			
		}else{
			$db->insert("cs_wishlist", "userid='$_SESSION[USERID]', part_idx='$cart_tmp_row->part_idx', goods_idx='$cart_tmp_row->goods_idx', 
			goods_code='$cart_tmp_row->goods_code', goods_name='$cart_tmp_row->goods_name', goods_price='$cart_tmp_row->goods_price', goods_point='$cart_tmp_row->goods_point', 
			goods_cnt='$cart_tmp_row->goods_cnt', opt_data='$cart_tmp_row->opt_data', box='$cart_tmp_row->box', register=now()");
			
			$db->delete("cs_cart_tmp", "where idx='$cart_tmp_row->idx'");
		}
	}
}

$mv_data	= $_GET[goods_data];
$goods_data	= $tools->decode( $_GET[goods_data] );
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $goods_data[idx]; }
if($_GET[part_idx] )			{ $part_idx = $_GET[part_idx]; }						else { $part_idx = $goods_data[part_idx]; }
// 회원체크
if( !$_SESSION[USERID] || !$_SESSION[PASSWD] ) {
	// 로그인 상태가 아니면 회원 로그인으로 보낸다
	$tools->metaGo('../../bbs/login.php?login_go=my_wishlist.php');
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
	//장바구니 정보 갱신 - 가격변경 및 옵션변경건의 경우 삭제처리한다.
	$cart_result=$db->select("cs_wishlist", "where 1 and userid='$_SESSION[USERID]' order by idx asc");
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
			$db->delete("cs_wishlist", "where idx='$cart_row->idx'");
			$delinfo = 1;
		}
	}
?>
<script language="JavaScript">
	<!--
	function wishlistEdit(f, wishlistIdx, goodsIdx) {
		if(f.edit_goods_cnt.value=="" ||f.edit_goods_cnt.value=="0" ||f.edit_goods_cnt.value==0 ) {
			alert("수량을 입력해 주십시오.");
			f.edit_goods_cnt.focus();
		} else {
			f.action = "<?=$_SERVER[PHP_SELF];?>?goods_data=<?=$mv_data;?>&wishlist_method=2&wishlist_edit_idx="+wishlistIdx+"&edit_goods_cnt="+f.edit_goods_cnt.value+"&goods_edit_idx="+goodsIdx;
			f.submit();
		}
	}
	function MM_swapImgRestore() { //v3.0
		var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
	}
	function MM_preloadImages() { //v3.0
		var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
			var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
		if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
	}
	function MM_findObj(n, d) { //v4.01
		var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
		d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
		if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
		for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
		if(!x && d.getElementById) x=d.getElementById(n); return x;
	}
	function MM_swapImage() { //v3.0
		var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
		if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
	}
	//-->
</script>
<script language="JavaScript" type="text/JavaScript">
	<!--
	function MM_reloadPage(init) {  //reloads the window if Nav4 resized
		if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
			document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
			else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
		}
		MM_reloadPage(true);
		function MM_showHideLayers() { //v6.0
			var i,p,v,obj,args=MM_showHideLayers.arguments;
			for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
				if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
			obj.visibility=v; }
		}
		//-->
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
				<li><i class="fas fa-arrow-left"></i>마이페이지</li>				
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li><i class="fas fa-arrow-left"></i>상품보관함</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section order_check login_check_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************내용영역 출력 시작********************-->
					<!--페이지서브메뉴-->
					<? include('./include/mymenu.inc.php');?>
					<!--페이지서브메뉴-->
					<div class="main">
						<h2 class="tit">상품보관함</h2>
						<table class='joinform_size'>
							<tr>
								<td>
									<table width="100%" class="mypage_border jointable_all" style='margin:0 auto;'>
										<tr style="display:none;">
											<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB noneoolim_del'>
												No
											</td>
											<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>
												상품명
											</td>
											<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB noneoolim_del'>
												가격
											</td>
											<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB noneoolim_del'>
												수량
											</td>
											<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB noneoolim_del'>
												적립금
											</td>
											<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB noneoolim_del2'>
												합 계
											</td>
											<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>
												관리
											</td>
										</tr>
										<?
											$wishlist_result=$db->select("cs_wishlist", "where userid='$_SESSION[USERID]' and userid is not null order by idx asc");
											$total_goods_price=0;  // 총금액
											$total_goods_point=0;  // 총적립금
											$form_cnt=0;
											while($wishlist_row=@mysqli_fetch_object($wishlist_result)) {
												$form_cnt++;
												$goodsInfo = $db->object("cs_goods", "where idx=$wishlist_row->goods_idx");
												// 총금액
												$total_goods_price+=$wishlist_row->goods_price*$wishlist_row->goods_cnt;
												// 총적립금
												$total_goods_point+=$wishlist_row->goods_price*$wishlist_row->goods_cnt*$wishlist_row->goods_point*0.01;
												// 따음표나 공백 복원
												$goods_name=stripslashes($wishlist_row->goods_name);
												$option1_select=stripslashes($wishlist_row->option1_select);
												$option2_select=stripslashes($wishlist_row->option2_select);
												// 기본 데이타 엔코딩
												$goods_data = $tools->encode("idx=".$wishlist_row->goods_idx."&part_idx=".$wishlist_row->part_idx);
												// 옵션 레이어 설정
												$LAYER_TOP=5;    //레이어 높이 설정
												$LAYER_TR= 27;		// 레이어의 출력 간격 * 줄과 같이 출력할경우는 $form_cnt 를 곱한다.
												$layer_top= $LAYER_TOP + ($LAYER_TR*$form_cnt);
											?>
										<form name="form_<?=$form_cnt;?>" method="post">
										<tr class="mypage_design" height="25" align="center">
											<td width="15" class='mypage_border calendar_list_tableTD_bg  noneoolim_del'>
												<font color="333333"><div class="mypage_design_font">No</div><?=$form_cnt;?></font>
											</td>
											<td class='mypage_border calendar_list_tableTD_bg'><div class="mypage_design_font">상품명</div><a href="product_view.php?goods_data=<?=$goods_data;?>"><?=$goods_name;?></a><br>
												<?
												$optArr = "";
												$optArr = explode("/^CUT/^", $goodsInfo->opt_data);
												$CartoptArr = explode("/^CUT/^", $wishlist_row->opt_data);
												for($i=0;$i<count($optArr)-1;$i++){
													$optRec = explode("/^/^", $optArr[$i]);
													$CartoptRec = explode("/^/^", $CartoptArr[$i]);
												?>
												<?=$optRec[0];?>:&nbsp;
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
												</select><br>
												<?}?>
											</td>
											<td style="display:none;" class='mypage_border calendar_list_tableTD_bg price  noneoolim_del'>
												<?=number_format($wishlist_row->goods_price);?>
											</td>
											<td class='mypage_border calendar_list_tableTD_bg  noneoolim_del'>
												<div class="mypage_design_font">수량</div><input name="edit_goods_cnt" type="text" class="formText" size="4" value="<?=$wishlist_row->goods_cnt;?>" style="text-align:center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">
											</td>
											<td style="display:none;" class='mypage_border calendar_list_tableTD_bg noneoolim_del'>
												<?=number_format($wishlist_row->goods_price*$wishlist_row->goods_point*0.01);?>
											</td>
											<td class='mypage_border calendar_list_tableTD_bg price noneoolim_del2'>
												<div class="mypage_design_font">결제금액</div><?=number_format($wishlist_row->goods_price*$wishlist_row->goods_cnt);?>원
											</td>
											<td class='mypage_border calendar_list_tableTD_bgright' width="70" class="menublue">
												<span class='new_price_mpage noneoolim_del3'><?=number_format($wishlist_row->goods_price*$wishlist_row->goods_cnt);?>원</span>
												<a href="order.php?trade_method=3&wishlist_idx=<?=$wishlist_row->idx;?>" class='mypage_btn Btn_orderlist1'>바로구매</a><br><a style="display:none;"href="javascript:wishlistEdit(document.form_<?=$form_cnt;?>, <?=$wishlist_row->idx;?>, <?=$wishlist_row->goods_idx;?>);" onfocus="this.blur()" class='Btn_orderlist2'>새로계산</a><a href="<?=$_SERVER[PHP_SELF];?>?goods_data=<?=$mv_data;?>&wishlist_method=3&wishlist_edit_idx=<?=$wishlist_row->idx;?>" onfocus="this.blur()" class='mypage_btn Btn_orderlist5'>삭제하기</a>
											</td>
										</tr>
										</form>
										<? }?>
										<? if($form_cnt==0) {?>
										<tr height="25" align="center">
											<td height="100" colspan="7" class="menu">
												보관함에 담겨진 상품이 없습니다.
											</td>
										</tr>
										<? }?>
									</table>
											<p style="text-align:center;"><span style='padding-right:1em'>총합계금액 : <span class='col-2C_priceA'><?=number_format($total_goods_price);?></span>원</span>
											받으실적립금 : <span class='col-2C_priceB'><?=number_format($total_goods_point);?></span>원
											</p>
											<hr />
									<table width="100%">
										<tr>
											<td height="75" align="center">
											<?/*
												<!-- 주문서작성 -->
												<? if($form_cnt) {?>
												<a href="order.php?trade_method=3" class="btn-type4" style="width:150px">전체 주문하기</a>&nbsp;
												<?} else {?>
												&nbsp;
												<? }?>
											*/?>
												<!-- 계속쇼핑하기 -->
												<? if($form_cnt) {?>
												<a href="product_list.php?goods_data=<?=$goods_data;?>">
												<?} else {?>
												<a href="index.php" class="btn-type2" style="width:150px">쇼핑계속하기
												<? }?></a>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
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
<?if($delinfo) $tools->msg("상품가격 및 옵션 변경으로 인하여 일부 제품이 삭제처리 되었습니다.");?>
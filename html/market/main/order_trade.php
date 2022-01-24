<? include('./include/head.inc.php'); ?>
<?


if (!$_POST[TRADE_CODE]) {
	$tools->alertJavaGo('잘못된 주문입니다\n\n처음부터 다시 주문하세요', 'index.php');
}
// 이메일 체크 장바구니 기능때문에 문제가 됨
// if( !$tools->chkMail($_POST[order_email], 1)) { $tools->errMsg('정확한 이메일주소를 입력해주세요.');}
// 입력한 주문정보를 trade_tmp 입력한다.
if ($_POST[deliv_content]) {
	$_POST[deliv_content]		= $db->addSlash($_POST[deliv_content]);
}
if ($_POST[deliv_pree_day1] && $_POST[deliv_pree_day2] && $_POST[deliv_pree_day3]) {
	$deliv_pree_day	= $_POST[deliv_pree_day1] . "-" . $_POST[deliv_pree_day2] . "-" . $_POST[deliv_pree_day3];
} else {
	$deliv_pree_day = "";
}
$trade_buy_data = $tools->encode("trade_code=" . $_POST[TRADE_CODE] . "&order_userid=" . $_POST[order_userid] . "&order_name=" . $_POST[order_name] . "&order_email=" . $_POST[order_email] . "&order_tel1=" . $_POST[order_tel1] . "&order_tel2=" . $_POST[order_tel2] . "&order_tel3=" . $_POST[order_tel3] . "&deliv_name=" . $_POST[deliv_name] . "&deliv_email=" . $_POST[deliv_email] . "&deliv_tel1=" . $_POST[deliv_tel1] . "&deliv_tel2=" . $_POST[deliv_tel2] . "&deliv_tel3=" . $_POST[deliv_tel3] . "&deliv_phone1=" . $_POST[deliv_phone1] . "&deliv_phone2=" . $_POST[deliv_phone2] . "&deliv_phone3=" . $_POST[deliv_phone3] . "&deliv_zip=" . $_POST[deliv_zip] . "&deliv_add1=" . $_POST[deliv_add1] . "&deliv_add2=" . $_POST[deliv_add2] . "&deliv_content=" . $_POST[deliv_content] . "&deliv_pree_day=" . $deliv_pree_day . "&cartinfo=" . $_SESSION[CARTIDX]);
$db->insert("cs_trade_tmp", "code='$_POST[TRADE_CODE]', item=1, data='$trade_buy_data', register=now()");
//회원레벨정보
if ($_SESSION[LEVEL]) {
	$userLavalNmae = $db->object("cs_user_list", "where idx=$_SESSION[LEVEL]");
} else {
	$_SESSION[LEVEL] = 0;
}
// 회원 사용가능한 포인트
if ($_SESSION[USERID] && $_SESSION[PASSWD]) {
	$member_point = $db->sum("cs_point", "where userid='$_SESSION[USERID]'", "point");
}
//결제정보
$pginfo = $db->object("cs_pgsetup", "");
//추가배송비 여부확인
$expplusaddrcheck = $db->cnt("cs_zip_over", "where zip='" . $_POST[deliv_zip] . "'");
?>
<script language="JavaScript">
	<!--
	function tradeCheck(value) {
		if (value == "on") {
			document.all.trade_method_view[0].style.display = "";
			document.all.trade_method_view[1].style.display = "";
		} else {
			document.all.trade_method_view[0].style.display = "none";
			document.all.trade_method_view[1].style.display = "none";
		}
	}

	function pointWinOpen() {
		window.open("point_search.php", "", "scrollbars=yes, width=418, height=300");
	}
	// 회원이면 포인트 체크
	<? if ($_SESSION[USERID] && $_SESSION[PASSWD]) { ?>

		function tradePriceCheck(totalGoodsPrice, tradeDelivPrice) {
			var form = document.trade_form;
			var totalGoodsPriceTmp = totalGoodsPrice + tradeDelivPrice <? if ($admin_stat->{"dc" . $_SESSION[LEVEL]} != 0) { ?> - form.trade_member_dc.value<? } ?>;
			if (form.trade_use_point.value > <? if ($member_point) {
													echo ($member_point);
												} else {
													echo ("0");
												} ?>) {
				alert('적립된 포인트 보다 많이 입력 하셨습니다.');
				form.trade_use_point.value = ""
				form.trade_price.value = totalGoodsPriceTmp;
				form.trade_use_point.focus();
			} else if (form.trade_use_point.value > totalGoodsPriceTmp) {
				alert("구입금액보다 많은 포인트를 입력 하셨습니다.");
				form.trade_use_point.value = ""
				form.trade_price.value = totalGoodsPriceTmp;
				form.trade_use_point.focus();
			} else {
				form.trade_price.value = totalGoodsPriceTmp - form.trade_use_point.value;
			}
		}
	<? } ?>

	function sendit() {
		var form = document.trade_form;
		<? if ($_SESSION[USERID] && $_SESSION[PASSWD]) { ?>
			if (form.trade_method[0].checked && form.trade_price.value < 1000) {
				alert("결제 금액이 1000 미만인 경우에는 카드결제 불가능합니다");
				form.trade_use_point.focus();
			} else if (form.trade_method[form.trade_method.length - 1].checked && form.trade_price.value != 0) {
				alert("결제 금액이 0 인 경우에는 포인트 결제가능합니다");
				form.trade_use_point.focus();
			} else {
				<? if ($SECURITYDOMAIN) { ?>
					form.action = "<?= $SECURITYOUTDOMAIN ?>/order_trade_end.php?CACHE=1";
				<? } else { ?>
					form.action = "order_trade_end.php?CACHE=1";
				<? } ?>
				form.submit();
			}
		<? } else { ?>
			<? if ($SECURITYDOMAIN) { ?>
				form.action = "<?= $SECURITYOUTDOMAIN ?>/order_trade_end.php?CACHE=1";
			<? } else { ?>
				form.action = "order_trade_end.php?CACHE=1";
			<? } ?>
			form.submit();
		<? } ?>
	}
	//
	-->
</script>
<div class="site-wrapper" id="box_wrapper">
	<!--상단로고, 가이드메뉴-->
	<? include('./include/top_guide.inc.php'); ?>
	<!--상단메뉴, 로테이트베너-->
	<? include('./include/top_menu.inc.php'); ?>
	<!--페이지 위치-->
	<div class="my_location">
		<ol class="breadcrumb titletxt_B">
			<li><a href="index.php" class="titletxt_A">Home</a></li>
			<li class="arrow"><i class="fas fa-angle-right"></i></li>
			<li>결제하기</li>
		</ol>
	</div>
	<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section order_trade">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<h3 class="tit">결제하기</h3>
					<!--********************내용영역 출력 시작********************-->
					<div class="order_list_area">
						<ul class="header_cell">
							<li class="prd_info">상품정보</li>
							<li class="sell_p">판매가격</li>
							<li class="prd_ea">수량</li>
							<li style="display:none;" class="point">적립금</li>
							<li class="point">배송비</li>
						</ul>
						<?
						if (!$_POST[TRADE_CODE]) {
							$tools->errMsg('경고 잘못된 접근입니다');
						}
						$trade_result = $db->select("cs_trade_tmp", "where item=0 and code is not null and code='$_POST[TRADE_CODE]' order by idx asc");
						$total_goods_price = 0;  // 총금액
						$total_goods_point = 0;  // 총포인트
						while ($trade_row = @mysqli_fetch_object($trade_result)) {
							$form_cnt++;
							$trade_data	= $tools->decode($trade_row->data);
							$total_goods_price += $trade_data[goods_price] * $trade_data[goods_cnt];
							$total_goods_point += $trade_data[goods_price] * $trade_data[goods_cnt] * $trade_data[goods_point] * 0.01;
							$total_goods_box += $trade_data[box] * $trade_data[goods_cnt];
							$ThumbEncode = $tools->encode("idx=" . $trade_data[goods_idx] . "&table=cs_goods&img=images1&dire=goodsImages&w=125&h=125");
							$goods_info = $db->object("cs_goods", "where idx='$trade_data[goods_idx]' ");
							$total_deliv_fee = $total_deliv_fee + $trade_data[deliv_fee];
						?>
							<ul class="data_cell">
								<li class="prd_photo"><a href="product_view.php?goods_data=<?= $trade_row->data; ?>" class="product-image"><img src="../data/goodsImages/<?= $goods_info->images1 ?>" border="0"></a></li>
								<li class="prd_name_option">
									<div><?= urldecode($trade_data[goods_name]); ?></div>
									<?
									$optArr = explode("/^CUT/^", $trade_data[opt_data]);
									for ($i = 0; $i < count($optArr) - 1; $i++) {
										$optRec = explode("/^/^", $optArr[$i]);
										$optView = "";
										$optView = explode(":", $optRec[1]);
									?>
										<div class="op_data"><span><?= $optRec[0]; ?>:&nbsp;<?= $optView[0] ?><? if ($optView[1]) { ?>:<?= number_format($optView[1]) ?>원<? } ?></span></div>
									<? } ?>
								</li>
								<li class="sell_p"><?= number_format($trade_data[goods_price]); ?>원</li>
								<li class="prd_ea"><?= number_format($trade_data[goods_cnt]); ?>개</li>
								<li style="display:none;" class="point"><?= number_format($trade_data[goods_price] * $trade_data[goods_cnt] * $trade_data[goods_point] * 0.01); ?>point</li>
								<li class="point"><?= number_format($trade_data[deliv_fee]); ?>원</li>
							</ul>
						<? } ?>
					</div>
					<!--합계금액 -->
					<div class="amount_of_payment">
						<table>
							<tr>
								<th style="display:none;">총 적립금</th>
								<th>총 주문금액</th>
							</tr>
							<tr>
								<td style="display:none;"><?= number_format($total_goods_point); ?><span class="point">point</span></td>
								<td><span class="total"><?= number_format($total_goods_price); ?></span>원</td>
							</tr>
						</table>
					</div>
					<!--구매관련 정보안내-->
					<div style="display:none;" class="purchase_info">
						<h3 class="par_tit">구매관련 정보안내</h3>
						<table width="100%" class='oolimmobilemenu'>
							<!-- 특별회원 DC 정책 -->
							<? if ($admin_stat->{"dc" . $_SESSION[LEVEL]} != 0) { ?>
								<tr>
									<td height="2" bgcolor='#333333'>
									</td>
									<td height="2" bgcolor='#333333'>
									</td>
								</tr>
								<tr height="45">
									<td align='left' width="120" bgcolor="F7F7F7" height='40' class='ordertitleM'>
										<?= $userLavalNmae->name ?> DC 안내
									</td>
									<td align='left' class='ordertitleM_Box'>
										&nbsp;레벨별로 특별할인율이 적용되며, 회원님께는&nbsp;<font color="FF00FF"><?= number_format($admin_stat->{"dc" . $_SESSION[LEVEL]}); ?></font> % 인하하여 판매합니다.
									</td>
								</tr>
							<? } ?>
							<!-- 포인트 정책 -->
							<? if ($_SESSION[USERID] && $_SESSION[PASSWD]) { ?>
								<tr>
									<td height="1" bgcolor='DDDDDD'>
									</td>
									<td height="1" bgcolor='DDDDDD'>
									</td>
								</tr>
								<tr height="45">
									<td align='left' width="120" bgcolor="F7F7F7" height='40' class='ordertitleM'>
										현재 적립금
									</td>
									<td align='left' class='ordertitleM_Box'>
										&nbsp;<font color="C00000"><?= number_format($member_point); ?></font>원 <a href="#" rel="point_search.php" class='company_smallBtn01 quick-view'>적립금조회</a>
									</td>
								</tr>
								<tr>
									<td height="1" bgcolor='DDDDDD'>
									</td>
									<td height="1" bgcolor='DDDDDD'>
									</td>
								</tr>
								<tr height="45">
									<td align='left' width="120" bgcolor="F7F7F7" height='40' class='ordertitleM'>
										적립금사용안내
									</td>
									<td align='left' class='ordertitleM_Box'>
										&nbsp;결제시 사용가능한 적립금은 <?= number_format($admin_stat->point_use); ?> 원 <span style='display: inline-block;'>이상일때만 사용이 가능합니다.</span>
									</td>
								</tr>
								<tr>
									<td height="1" bgcolor='DDDDDD'>
									</td>
									<td height="1" bgcolor='DDDDDD'>
									</td>
								</tr>
							<? } ?>
							<?/*
							<!--  배송비 정책 -->
							<? if($admin_stat->express_check==0) { $trade_deliv_price=0;?>
							<tr height="45">
								<td align='left' colspan="2" align="center">
										저희는 배송비를 완전 무료 배송를 해드리고 있습니다.
								</td>
							</tr>
							
							<?} else if($admin_stat->express_check==1) {?>
							<tr>
								<td height="1" bgcolor='DDDDDD'>
								</td>
								<td height="1" bgcolor='DDDDDD'>
								</td>
							</tr>
							<tr height="45">
								<td align='left' width="120" bgcolor="F7F7F7" height='40' class='ordertitleM'>
									일반배송방식
								</td>
								<td align='left' class='ordertitleM_Box'>
									<? if($total_goods_price >= $admin_stat->express_free) { $trade_deliv_price=0;?><span class="company_smallBtn02">무료배송</span> <span style='display: inline-block;'>구매금액이 무료 배송조건에 해당됩니다. <?} else {?> 배송비는 <?=number_format($admin_stat->express_money); $trade_deliv_price=$admin_stat->express_money;?> 원입니다.<?}?>
								</td>
							</tr>
							<?} else if($admin_stat->express_check==2) {?>
							<tr>
								<td height="1" bgcolor='DDDDDD'>
								</td>
								<td height="1" bgcolor='DDDDDD'>
								</td>
							</tr>
							<tr height="45">
								<td align='left' width="120" bgcolor="F7F7F7" height='40' class='ordertitleM'>
									가중치배송방식
								</td>
								<td align='left' class='ordertitleM_Box'>
										<? if($total_goods_price >= $admin_stat->express_free) { $trade_deliv_price=0;?><font color="#FF00FF">무료배송</font> 구매금액이 무료 배송조건에 만족합니다. <?} else {?>  &nbsp;배송비&nbsp;<?=number_format($admin_stat->express_box_money*$total_goods_box*0.01); $trade_deliv_price=$admin_stat->express_box_money*$total_goods_box*0.01;?> 원 &nbsp;1BOX : <?=number_format($admin_stat->express_box_money);?>원 ×  수량 : <?=number_format($total_goods_box*0.01);?>개<?}?>
								</td>
							</tr>
							<?}?>
							<?if($expplusaddrcheck>0){?>
							<tr>
								<td height="1" bgcolor='DDDDDD'>
								</td>
								<td height="1" bgcolor='DDDDDD'>
								</td>
							</tr>
							<tr height="45">
								<td align='left' width="120" bgcolor="F7F7F7" height='40' class='ordertitleM'>
									추가배송비
								</td>
								<td align='left' class='ordertitleM_Box'>
									<?
									if($admin_stat->express_check==0) {
										$trade_deliv_price=$admin_stat->express_over;
									}else if($admin_stat->express_check==1){
										$trade_deliv_price+=$admin_stat->express_over;
									}else if($admin_stat->express_check==2){
										$trade_deliv_price+=$admin_stat->express_over*$total_goods_box*0.01;
									}
									?>
									도서산간지역 배송비 추가금액 : <?=number_format($admin_stat->express_over)?><br>
									박스별 포장일 경우 박스수량 * <?=number_format($admin_stat->express_over)?> 적용됩니다.<br>
									<font color="red">무료배송 조건에 적용되더라도 추가배송비는 발생합니다.</font>
								</td>
							</tr>
							<?}?>
							<tr>
								<td colspan="2" height="1" bgcolor='DDDDDD'>
								</td>
							</tr>
							<tr height="45">
								<td colspan="2" align="center" class='oolimmobilemenu'>
									<span style='color:#FF7A7A'>무료배송안내</span> : 구매금액이 <span style='color:#FF7A7A'><?=number_format($admin_stat->express_free);?></span>원 <span style='display: inline-block;'>이상 일경우에 무료로 배송이 됩니다.</span>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" bgcolor='DDDDDD'>
								</td>
							</tr>
							*/ ?>
						</table>
					</div>
					<!--//구매관련 정보안내-->
					<!--결제-->
					<div class="order_method">
						<h3 class="par_tit">결제</h3>
						<form method="post" name="trade_form">
							<input type="hidden" name="TRADE_CODE" value="<?= $_POST[TRADE_CODE]; ?>">
							<!-- 적립포인트 -->
							<input type="hidden" name="trade_save_point" value="<?= $total_goods_point; ?>">
							<table class="info_tb">
								<tr>
									<th>결제방법선택</th>
									<td>
										<ul class="method">
											<li>
												<? if ($pginfo->pg_card) { ?>
													<input type="radio" name="trade_method" value="1" onClick="tradeCheck('on');" checked><span>카드결제</span>
												<? } else { ?>
													<input type="radio" name="trade_method" value="1" onClick="tradeCheck('off');" style="display:none;">
												<? } ?>
											</li>
											<li>
												<? if ($pginfo->pg_ich) { ?>
													<input type="radio" name="trade_method" value="2" onClick="tradeCheck('off');"><span>계좌이체</span>
													<? if ($pginfo->pg_ich_escr) { ?> ( EC )<? } ?>
													<? } else { ?>
														<input type="radio" name="trade_method" value="2" onClick="tradeCheck('off');" style="display:none;">
													<? } ?>
											</li>
											<li>
												<? if ($pginfo->pg_phone) { ?>
													<input type="radio" name="trade_method" value="3" onClick="tradeCheck(' off');"><span>휴대폰결제</span>
												<? } else { ?>
													<input type="radio" name="trade_method" value="3" onClick="tradeCheck('off');" style="display:none;"'>
												<? } ?>
											</li>
											<li style="display:none;" >
												<? if ($pginfo->pg_vich) { ?>
													<input type="radio" name="trade_method" value="4" onClick="tradeCheck(' off');"><span>가상계좌</span>
													<? if ($pginfo->pg_vich_escr) { ?> ( 가상계좌_EC )<? } ?>
													<? } else { ?>
														<input type="radio" name="trade_method" value="4" onClick="tradeCheck('off');" style="display:none;">
													<? } ?>
											</li>
											<li style="display:none;">
												<input type="radio" name="trade_method" value="5" onClick="tradeCheck('off');"><span>무통장입금</span>
												<? if ($_SESSION[USERID]) { ?>
													<input type="radio" name="trade_method" value="6" onClick="tradeCheck('off');"><span>적립금전용</span>
												<? } ?>
											</li>
										</ul>
									</td>
								</tr>
								<tr id="trade_method_view" style="display: none;">
									<th>계좌선택</th>
									<td>
										<select name="trade_method_info" class="formSelect">
											<?
											$result		= $db->select("cs_banklist", "where main_marking=1 order by ranking asc");
											while ($row = mysqli_fetch_object($result)) {
											?>
												<option value="<?= $row->bank_name ?> <?= $row->bank_account ?> <?= $row->name ?>"><?= $row->bank_name ?> <?= $row->bank_account ?> <?= $row->name ?></option>
											<? } ?>
										</select>
									</td>
								</tr>
								<tr id="trade_method_view" style="display: none;">
								</tr>
								<tr>
									<th>총구매금액</th>
									<td>
										<input type="text" name="trade_total_price" class="formText" readOnly maxlength="11" size="12" value="<?= $total_goods_price; ?>" style="text-align: right;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;"> 원
									</td>
								</tr>
								<!-- 특별회원 DC 정책 -->
								<? if ($_SESSION[USERID]) { ?>
									<tr style="display:none;">
										<th>회원할인금액</th>
										<td>
											<input type="text" name="trade_member_dc" class="formText" readOnly maxlength="11" size="12" value="<?= round($total_goods_price * $admin_stat->{"dc" . $_SESSION[LEVEL]} * 0.01, -2); ?>" style="text-align: right;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;"><span style=' display: inline-block;'>회원 할인금액입니다.</span>
										</td>
									</tr>
								<? } ?>
								<tr>
									<th>배송비</th>
									<td>
										<input type="text" name="trade_deliv_price" class="formText" readOnly style="text-align: right;" value="<?= $total_deliv_fee; ?><? //=$trade_deliv_price;
																																										?>" readOnly maxlength="11" size="12"> <span style='display: inline-block;'>원</span>
									</td>
								</tr>
								<? if ($_SESSION[USERID]) { ?>
									<tr style="display:none;">
										<th>사용적립금</th>
										<td>
											<input type="text" name="trade_use_point" class="formText" maxlength="11" size="12" style="text-align: right;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" onKeyup="javascript:tradePriceCheck(<?= $total_goods_price ?>, <?= $trade_deliv_price; ?>);" <? if ($member_point < $admin_stat->point_use) {
																																																																																					echo ('readonly=true');
																																																																																				} ?>> <span style='display: inline-block;'>사용하실 적립금을 입력해주세요.</span>
										</td>
									</tr>
								<? } ?>
								<?
								if ($admin_stat->{"dc" . $_SESSION[LEVEL]} != 0) {
									$trade_price = $total_goods_price - round($total_goods_price * $admin_stat->{"dc" . $_SESSION[LEVEL]} * 0.01, -2) + $trade_deliv_price;
								} else {
									$trade_price = $total_goods_price + $trade_deliv_price;
								}
								?>
								<tr>
									<th>결제금액</th>
									<td>
										<input type="text" name="trade_price" class="formText" maxlength="11" size="12" style="text-align: right; color:#FF0000;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?= $trade_price; ?>" readonly> <span style='display: inline-block;'>원</span>
									</td>
								</tr>
							</table>
						</form>
					</div>
					<!--//결제-->
					<br><br>
					<div class="bottom_btn"><a href="javascript:sendit();" class="oolimbtn-botton1" style="width:160px">결제하기</a></div>
					<br><br>
					<!--********************내용영역 출력 끝********************-->
				</div>
				<!--to_animate-->
			</div>
			<!--row-->
		</div>
		<!--container-->
	</section>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php'); ?>
	<!--하단-->
</div>
<!--site-wrapper End-->
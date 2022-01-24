<? include('./include/head.inc.php');?>
<?
if(!$_POST[TRADE_CODE]) { $tools->alertJavaGo('잘못된 주문입니다\n\n처음부터 다시 주문하세요', 'index.php');}
// 포인트 점검
if($_SESSION[USERID] && $_SESSION[PASSWD]) {
$member_point = $db->sum("cs_point", "where userid='$_SESSION[USERID]'", "point");
if($member_point < $_POST[trade_use_point]) { $tools->errMsg('사용하신 포인트가 \n\n적립된 포인트초과 했습니다.');}
}
if(!$_POST[trade_method_info]) {$_POST[trade_method_info]="";}
$trade_end_data =$tools->encode( "trade_code=".$_POST[TRADE_CODE]."&trade_total_price=".$_POST[trade_total_price]."&trade_price=".$_POST[trade_price]."&trade_use_point=".$_POST[trade_use_point]."&trade_save_point=".$_POST[trade_save_point]."&trade_member_dc=".$_POST[trade_member_dc]."&trade_deliv_price=".$_POST[trade_deliv_price]."&trade_method=".$_POST[trade_method]."&trade_method_info=".$_POST[trade_method_info]);
$db->insert("cs_trade_tmp", "code='$_POST[TRADE_CODE]', item=2, data='$trade_end_data', register=now()");
//결제정보
$pginfo = $db->object("cs_pgsetup","");
?>
<script language="JavaScript">
	<!--
	function sendit() {
		var form=document.trade_form;
		if(form.TRADE_CODE.value=="") {
			alert("잘못된 구매방법입니다. 다시 주문해주세요");
			history.back();
		} else {
			form.submit();
		}
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
				<li>주문정보확인</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section order_trade">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<h3 class="tit">주문정보확인</h3>
					<!--********************내용영역 출력 시작********************-->
					<div class="order_list_area">
						<ul class="header_cell">
							<li class="prd_info">상품정보</li>
							<li class="sell_p">판매가격</li>
							<li class="prd_ea">수량</li>
							<li class="point">적립금</li>
							<li class="point"></li>
						</ul>
						<?
						if(!$_POST[TRADE_CODE]) { $tools->errMsg('경고 잘못된 접근입니다');}
						$trade_result=$db->select("cs_trade_tmp", "where item=0 and code is not null and code='$_POST[TRADE_CODE]' order by idx asc");
						$total_goods_price=0;  // 총금액
						$total_goods_point=0;  // 총포인트
						while($trade_row=@mysqli_fetch_object($trade_result)) {
							$form_cnt++;
							$trade_data	= $tools->decode( $trade_row->data );
							$total_goods_price+=$trade_data[goods_price]*$trade_data[goods_cnt];
							$total_goods_point+=$trade_data[goods_price]*$trade_data[goods_cnt]*$trade_data[goods_point]*0.01;
							$total_goods_box+=$trade_data[box]*$trade_data[goods_cnt];
							$ThumbEncode = $tools->encode("idx=".$trade_data[goods_idx]."&table=cs_goods&img=images1&dire=goodsImages&w=70&h=70");
							$goods_info = $db->object("cs_goods","where idx='$trade_data[goods_idx]' ");
						?>
						<ul class="data_cell">
							<li class="prd_photo"><a href="product_view.php?goods_data=<?=$goods_data;?>" class="product-image"><img src="../data/goodsImages/<?=$goods_info->images1?>" border="0"></a></li>
							<li class="prd_name_option">
								<div><?=urldecode($trade_data[goods_name]);?><div>
								<?
								$optArr = explode("/^CUT/^", $trade_data[opt_data]);
								for($i=0;$i<count($optArr)-1;$i++){
									$optRec = explode("/^/^", $optArr[$i]);
									$optView = "";
									$optView = explode(":", $optRec[1] );
								?>
								<div class="op_data"><span><?=$optRec[0];?>:&nbsp;<?=$optView[0]?><?if($optView[1]){?>:<?=number_format($optView[1])?>원<?}?></span></div>
								<?}?>
							</li>
							<li class="sell_p"><span><?=number_format($trade_data[goods_price]);?></span>원</li>
							<li class="prd_ea"><?=number_format($trade_data[goods_cnt]);?>개</li>
							<li class="point"><span><?=number_format($trade_data[goods_price]*$trade_data[goods_cnt]*$trade_data[goods_point]*0.01);?></span>point</li>
							<li class="point"></li>
						</ul>
						<? }?>
					</div>
					<!--합계금액 -->
					<div class="amount_of_payment">
						<table>
							<tr>
								<th>총 적립금</th>
								<th>총 주문금액</th>
							</tr>
							<tr>
								<td><?=number_format($total_goods_point);?><span class="point">point</span></td>
								<td><span class="total"><?=number_format($total_goods_price);?></span>원</td>
							</tr>
						</table>
					</div>
					<!-- 상품구매자 정보 출력 -->
					<div class="buyer_info">
						<h3 class="par_tit"><i class="fas fa-user"></i>주문자 정보</h3>
						<?
						$order_stat=$db->object("cs_trade_tmp", "where item=1 and code is not null and code='$_POST[TRADE_CODE]' order by idx asc");
						$order_stat_data= $tools->decode( $order_stat->data );
						?>
						<table class="info_tb">
							<tr>
								<th>이 름</th>
								<td><?=$order_stat_data[order_name];?></td>
							</tr>
							<tr>
								<th>이메일</th>
								<td><?=$order_stat_data[order_email];?></td>
							</tr>
							<tr>
								<th>전화번호</th>
								<td><?=$order_stat_data[order_tel1];?> - <?=$order_stat_data[order_tel2];?> - <?=$order_stat_data[order_tel3];?></td>
							</tr>
						</table>
					</div>
					<!-- 상품 결제정보 출력 -->
					<div class="trade_info">
						<h3 class="par_tit"><i class="far fa-credit-card"></i>결제정보</h3>
						<?
						$trade_stat=$db->object("cs_trade_tmp", "where item=2 and code is not null and code='$_POST[TRADE_CODE]' order by idx asc");
						$trade_stat_data= $tools->decode( $trade_stat->data );
						?>
						<table class='info_tb'>
							<tr>
								<th>총구매금액</th>
								<td><?=number_format($trade_stat_data[trade_total_price]);?>원</td>
							</tr>
							<? if($_SESSION[USERID] && $_SESSION[LEVEL]) {?>
							<tr>
								<th>회원할인금액</th>
								<td><?=number_format($trade_stat_data[trade_member_dc]);?> 원 할인금액입니다.</td>
							</tr>
							<?}?>
							<tr>
								<th>배송비</th>
								<td><?=number_format($trade_stat_data[trade_deliv_price]);?> 원</td>
							</tr>
							<? if($_SESSION[USERID] && $_SESSION[PASSWD]) {?>
							<tr>
								<th>적립금 결제</th>
								<td><?=number_format($trade_stat_data[trade_use_point]);?> 원</td>
							</tr>
							<?}?>
							<tr>
								<th>결제금액</th>
								<td><?=number_format($trade_stat_data[trade_price]);?>원</td>
							</tr>
							<tr>
								<td colspan="2">※ 위 정보를 확인하시고 맞으시다면 결제버튼을 눌러주세요</td>
							</tr>
						</table>
					</div>
					<table style='margin:0 auto;'>
						<?
							// 0:카드결제
							if($trade_stat_data[trade_method] < 5) {
								if(__MOBILE__==1000){	//모바일결제로 이동
							?>
								<a href="../payplus_mobile/index.php?TRADE_CODE=<?=$_POST[TRADE_CODE];?>"><img src="images/bt_payment.gif" border="0"/></a>
							<?}else{?>
							<section style="display:none">
								<h3><?=$_POST[TRADE_CODE];?></h3>
								<span><?=$trade_stat_data[trade_price];?> 원</span>
								<p>----------------------</p>
								<div><label><input type="radio" name="method" value="카드" checked/>신용카드</label></div>
								<div><label><input type="radio" name="method" value="가상계좌"/>가상계좌</label></div>
								<div><label><input type="radio" name="method" value="빌링" />자동결제(카드)</label></div>
								<p>----------------------</p>																
							</section>
							<button id="payment-button" class="oolimbtn-botton1">결제하기</button>
							<script src="https://js.tosspayments.com/v1"></script>
							<script>
								var tossPayments = TossPayments("test_ck_mnRQoOaPz8LQ7xBdXG3y47BMw6vl");
								var button = document.getElementById("payment-button");

								var orderId = new Date().getTime();

								button.addEventListener("click", function () {
									var method = document.querySelector('input[name=method]:checked').value; // "카드" 혹은 "가상계좌"

									if (method === '빌링') {
										var randomCustomerKey = 'customer' + new Date().getTime();

										tossPayments.requestBillingAuth('카드', {
											customerKey: randomCustomerKey,
											successUrl: location.href + '/toss_pay/billing_confirm.php',
											failUrl: location.href + '/toss_pay/fail.php',
										});
									} else {
										var paymentData = {
											amount: <?=$trade_stat_data[trade_price];?>,
											orderId: '<?=$_POST[TRADE_CODE];?>',
											orderName: '<?=urldecode($trade_data[goods_name]);?>',
											customerName: '<?=$order_stat_data[order_name];?>',
											successUrl: window.location.origin + "/toss_pay/success.php",
											failUrl: window.location.origin + "/toss_pay/fail.php",
										};

										if (method === '가상계좌') {
											paymentData.virtualAccountCallbackUrl = 'http://www.oolim.net/toss_pay/virtual_account_callback.php'
										}

										tossPayments.requestPayment(method, paymentData);
									}
								});
							</script>							
							
						<?
							}
						} else {?>
							<script language="JavaScript">
								<!--
								function sendit(value) {
									var form=document.trade_form;
									if(form.TRADE_CODE.value=="") {
										alert("잘못된 구매방법입니다. 다시 주문해주세요");
										history.back();
									} else {
										form.submit();
									}
								}
								//-->
							</script>
							<form method="post" name="trade_form" action="order_trade_end_ok.php">
							<input type="hidden" name="goods_data" value="<?=$mv_data;?>">
							<input type="hidden" name="TRADE_CODE" value="<?=$_POST[TRADE_CODE];?>">
							<tr>
								<td style='height:80px;'><a href="javascript:sendit();" class="oolimbtn-botton1" style="width:160px">결제하기</a></td>
							</tr>
							<tr>
								<td height="35"></td>
							</tr>
							</form>
							<? }?>	
						</table>
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
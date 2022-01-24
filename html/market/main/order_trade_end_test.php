<? include('./include/head.inc.php'); ?>
<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<?
if (!$_POST[TRADE_CODE]) {
	$tools->alertJavaGo('잘못된 주문입니다\n\n처음부터 다시 주문하세요', 'index.php');
}
// 포인트 점검
if ($_SESSION[USERID] && $_SESSION[PASSWD]) {
	$member_point = $db->sum("cs_point", "where userid='$_SESSION[USERID]'", "point");
	if ($member_point < $_POST[trade_use_point]) {
		$tools->errMsg('사용하신 포인트가 \n\n적립된 포인트초과 했습니다.');
	}
}
if (!$_POST[trade_method_info]) {
	$_POST[trade_method_info] = "";
}
$trade_end_data = $tools->encode("trade_code=" . $_POST[TRADE_CODE] . "&trade_total_price=" . $_POST[trade_total_price] . "&trade_price=" . $_POST[trade_price] . "&trade_use_point=" . $_POST[trade_use_point] . "&trade_save_point=" . $_POST[trade_save_point] . "&trade_member_dc=" . $_POST[trade_member_dc] . "&trade_deliv_price=" . $_POST[trade_deliv_price] . "&trade_method=" . $_POST[trade_method] . "&trade_method_info=" . $_POST[trade_method_info]);
$db->insert("cs_trade_tmp", "code='$_POST[TRADE_CODE]', item=2, data='$trade_end_data', register=now()");
//결제정보
$pginfo = $db->object("cs_pgsetup", "");
?>
<script language="JavaScript">
	<!--
	function sendit() {
		var form = document.trade_form;
		if (form.TRADE_CODE.value == "") {
			alert("잘못된 구매방법입니다. 다시 주문해주세요");
			history.back();
		} else {
			form.submit();
		}
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
							$ThumbEncode = $tools->encode("idx=" . $trade_data[goods_idx] . "&table=cs_goods&img=images1&dire=goodsImages&w=70&h=70");
							$goods_info = $db->object("cs_goods", "where idx='$trade_data[goods_idx]' ");
						?>
							<ul class="data_cell">
								<li class="prd_photo"><a href="product_view.php?goods_data=<?= $goods_data; ?>" class="product-image"><img src="../data/goodsImages/<?= $goods_info->images1 ?>" border="0"></a></li>
								<li class="prd_name_option">
									<div><?= urldecode($trade_data[goods_name]); ?><div>
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
								<li class="sell_p"><span><?= number_format($trade_data[goods_price]); ?></span>원</li>
								<li class="prd_ea"><?= number_format($trade_data[goods_cnt]); ?>개</li>
								<li class="point"><span><?= number_format($trade_data[goods_price] * $trade_data[goods_cnt] * $trade_data[goods_point] * 0.01); ?></span>point</li>
								<li class="point"></li>
							</ul>
						<? } ?>
					</div>
					<!--합계금액 -->
					<div class="amount_of_payment">
						<table>
							<tr>
								<th>총 적립금</th>
								<th>총 주문금액</th>
							</tr>
							<tr>
								<td><?= number_format($total_goods_point); ?><span class="point">point</span></td>
								<td><span class="total"><?= number_format($total_goods_price); ?></span>원</td>
							</tr>
						</table>
					</div>
					<!-- 상품구매자 정보 출력 -->
					<div class="buyer_info">
						<h3 class="par_tit"><i class="fas fa-user"></i>주문자 정보</h3>
						<?
						$order_stat = $db->object("cs_trade_tmp", "where item=1 and code is not null and code='$_POST[TRADE_CODE]' order by idx asc");
						$order_stat_data = $tools->decode($order_stat->data);
						?>
						<table class="info_tb">
							<tr>
								<th>이 름</th>
								<td><?= $order_stat_data[order_name]; ?></td>
							</tr>
							<tr>
								<th>이메일</th>
								<td><?= $order_stat_data[order_email]; ?></td>
							</tr>
							<tr>
								<th>전화번호</th>
								<td><?= $order_stat_data[order_tel1]; ?> <?= $order_stat_data[order_tel2]; ?> <?= $order_stat_data[order_tel3]; ?></td>
							</tr>
						</table>
					</div>
					<!-- 상품 결제정보 출력 -->
					<div class="trade_info">
						<h3 class="par_tit"><i class="far fa-credit-card"></i>결제정보</h3>
						<?
						$trade_stat = $db->object("cs_trade_tmp", "where item=2 and code is not null and code='$_POST[TRADE_CODE]' order by idx asc");
						$trade_stat_data = $tools->decode($trade_stat->data);
						?>
						<table class='info_tb'>
							<tr>
								<th>총구매금액</th>
								<td><?= number_format($trade_stat_data[trade_total_price]); ?>원</td>
							</tr>
							<? if ($_SESSION[USERID] && $_SESSION[LEVEL]) { ?>
								<tr>
									<th>회원할인금액</th>
									<td><?= number_format($trade_stat_data[trade_member_dc]); ?> 원 할인금액입니다.</td>
								</tr>
							<? } ?>
							<tr>
								<th>배송비</th>
								<td><?= number_format($trade_stat_data[trade_deliv_price]); ?> 원</td>
							</tr>
							<? if ($_SESSION[USERID] && $_SESSION[PASSWD]) { ?>
								<tr>
									<th>적립금 결제</th>
									<td><?= number_format($trade_stat_data[trade_use_point]); ?> 원</td>
								</tr>
							<? } ?>
							<tr>
								<th>결제금액</th>
								<td><?= number_format($trade_stat_data[trade_price]); ?>원</td>
							</tr>
							<tr>
								<td colspan="2">※ 위 정보를 확인하시고 맞으시다면 결제버튼을 눌러주세요</td>
							</tr>
						</table>
					</div>
					<table style='margin:0 auto;'>
						<?
						// 0:카드결제
						if ($trade_stat_data[trade_method] < 5) {

						?>

							<link rel="stylesheet" type="text/css" href="https://www.kcp.co.kr/css/popup.css" />
							<script language='javascript' src='<? if ($pginfo->pg_true == "1") { ?>http://pay.kcp.co.kr/plugin/payplus_web.jsp<? } else { ?>https://testpay.kcp.co.kr/plugin/payplus_web.jsp<? } ?>'></script>
							<script language='javascript'>
								<? $g_wsdl = real_KCPPaymentService . wsdl; ?>
								//2020-08-19  추가
								function m_Completepayment(FormOrJson, closeEvent) {
									var frm = document.order_info;
									GetField(frm, FormOrJson);
									if (frm.res_cd.value == "0000") {
										frm.submit();
									} else {
										alert("[" + frm.res_cd.value + "] " + frm.res_msg.value);
										closeEvent();
									}
								}

								// 플러그인 설치(확인)
								// StartSmartUpdate(); 웹표준 적용을 위해 삭제 2020-08-19 

								function jsf__pay(form) {
									try {
										KCP_Pay_Execute(form);
									} catch (e) {}
								}
								<?/*
								function  jsf__pay( form )
								{
									var RetVal = false;
									// Payplus Plugin 실행 
									if ( MakePayMessage( form ) == true )
									{
										openwin = window.open( "proc_win.html", "proc_win", "width=449, height=209, top=300, left=300" );
										RetVal = true ;
									}
									else
									{
										//  res_cd와 res_msg변수에 해당 오류코드와 오류메시지가 설정됩니다.
										//	ex) 고객이 Payplus Plugin에서 취소 버튼 클릭시 res_cd=3001, res_msg=사용자 취소
										//	값이 설정됩니다.										
										res_cd  = document.order_info.res_cd.value ;
										res_msg = document.order_info.res_msg.value ;	
										//alert ( "Payplus Plug-in 실행 결과(샘플)\n" + "res_cd = " + res_cd + "|" + "res_msg=" + res_msg ) ;
									}
									return RetVal ;
								}
								*/ ?>
							</script>
							<!--고객이 결과를 받기원하는 URL을 action부분에 입력하세요-->
							<form name="order_info" action="pp_ax_hub.php" method="post" <?/*onSubmit="return jsf__pay(this)"*/ ?>>
								<!-- 사이트 로고 -->
								<? if ($pginfo->pg_logo_option == 1) {
									$Temp_A = explode(".", $design_stat->title_logo);
									if (strtolower($Temp_A[count($Temp_A) - 1]) == "gif" || strtolower($Temp_A[count($Temp_A) - 1]) == "jpg" || strtolower($Temp_A[count($Temp_A) - 1]) == "bmp" || strtolower($Temp_A[count($Temp_A) - 1]) == "png") {
								?>
										<input type='hidden' name='site_logo' value='http://<?= $admin_stat->shop_domain ?>/data/designImages/<?= $design_stat->title_logo ?>'>
									<? } ?>
								<? } else if ($pginfo->pg_logo_option == 2) { ?>
									<input type='hidden' name='site_logo' value='http://<?= $admin_stat->shop_domain ?>/data/designImages/<?= $pginfo->pg_logo ?>'>
								<? } ?>
								<!-- 필수 항목 -->
								<!-- 요청종류 승인(pay)/취소,매입(mod) 요청시 사용 -->
								<input type='hidden' name='req_tx' value='pay'>
								<!-- 테스트 결제시 : T0000 으로 설정, 리얼 결제시 : 부여받은 사이트코드 입력 -->
								<input type='hidden' name='site_cd' value='<? if ($pginfo->pg_true == "1") { ?><?= $pginfo->pg_code ?><? } else { ?>T0000<? } ?>'>
								<!-- MPI 결제창에서 사용 한글 사용 불가 -->
								<input type='hidden' name='site_name' value='<?= $admin_stat->shop_name ?>'>
								<!-- http://testpay.kcp.co.kr/Pay/Test/site_key.jsp 로 접속하신후 부여받은 사이트코드를 입력하고 나온 값을 입력하시기 바랍니다. -->
								<input type='hidden' name='site_key' value='<? if ($pginfo->pg_true == "1") { ?><?= $pginfo->pg_key ?><? } else { ?>3grptw1.zW0GSo4PQdaGvsF__<? } ?>'>
								<!-- 필수 항목 : PULGIN 설정 정보 변경하지 마세요 -->
								<input type='hidden' name='module_type' value='01'>
								<!-- 필수 항목 : 결제 금액/화폐단위 -->
								<input type='hidden' name='currency' value='WON'>
								<!-- 주문 번호 (자바 스크립트 샘플(init_orderid()) 참고) -->
								<input type='hidden' name='ordr_idxx' value='<?= $_POST[TRADE_CODE]; ?>'>
								<!-- 필수 항목 : PLUGIN에서 값을 설정하는 부분으로 반드시 포함되어야 합니다. ※수정하지 마십시오.-->
								<input type='hidden' name='res_cd' value=''>
								<input type='hidden' name='res_msg' value=''>
								<input type='hidden' name='tno' value=''>
								<input type='hidden' name='trace_no' value=''>
								<input type='hidden' name='enc_info' value=''>
								<input type='hidden' name='enc_data' value=''>
								<input type='hidden' name='ret_pay_method' value=''>
								<input type='hidden' name='tran_cd' value=''>
								<input type='hidden' name='bank_name' value=''>
								<input type='hidden' name='bank_issu' value=''>
								<input type='hidden' name='use_pay_method' value=''>
								<? if (($trade_stat_data[trade_method] == 2 && $pginfo->pg_ich_escr == 1) || ($trade_stat_data[trade_method] == 4 && $pginfo->pg_vich_escr == 1)) { ?>
									<!-- 에스크로 항목 -->
									<!-- 에스크로 사용 여부(필수) : 반드시 Y 로 세팅 -->
									<input type="hidden" name="escw_used" value="Y">
									<!-- 에스크로 결제처리 모드(필수) : 에스크로: Y, 일반: N, KCP 설정 조건: O -->
									<input type="hidden" name="pay_mod" value="Y">
									<!-- 배송 소요일(필수) : 예상 배송 소요일을 입력 -->
									<input type="hidden" name="deli_term" value="03">
									<!-- 장바구니 상품 개수(필수) : 장바구니에 담겨있는 상품의 개수를 입력 -->
									<input type="hidden" name="bask_cntx" value="1">
									<!-- 장바구니 상품 상세 정보 (자바 스크립트 샘플(create_goodInfo()) 참고) -->
									<!-- 장바구니 상품 상세 정보 (자바 스크립트 샘플(create_goodInfo()) 참고) -->
									<script language='javascript'>
										document.write(String.fromCharCode(31));
										document.write("<input type='hidden' name='good_info' value='seq=1");
										document.write(String.fromCharCode(31));
										document.write("ordr_numb=<?= $_POST[TRADE_CODE]; ?>");
										document.write(String.fromCharCode(31));
										document.write("good_name=<?= $_POST[TRADE_CODE]; ?>");
										document.write(String.fromCharCode(31));
										document.write("good_cntx=1");
										document.write(String.fromCharCode(31));
										document.write("good_amtx=<?= $trade_stat_data[trade_price]; ?>'");
									</script>
									<input type="hidden" name="rcvr_name" value="<?= $order_stat_data[deliv_name]; ?>" size="20">
									<input type="hidden" name="rcvr_tel1" value="<?= $order_stat_data[deliv_tel1]; ?>-<?= $order_stat_data[deliv_tel2]; ?>-<?= $order_stat_data[deliv_tel3]; ?>" size="20">
									<input type="hidden" name="rcvr_tel2" value="<?= $order_stat_data[deliv_phone1]; ?>-<?= $order_stat_data[deliv_phone2]; ?>-<?= $order_stat_data[deliv_phone3]; ?>" size="20">
									<input type="hidden" name="rcvr_mail" value="<?= $order_stat_data[deliv_email]; ?>" size="40">
									<input type="hidden" name="rcvr_zipx" value="<?= $order_stat_data[deliv_zip1]; ?><?= $order_stat_data[deliv_zip2]; ?>" size="6">
									<input type="hidden" name="rcvr_add1" value="<?= $order_stat_data[deliv_add1]; ?>" size="50">
									<input type="hidden" name="rcvr_add2" value="<?= $order_stat_data[deliv_add2]; ?>" size="50">
								<? } ?>
								<!-- 신용카드사 삭제 파라미터 입니다. -->
								<!--input type='hidden' name='not_used_card' value='CCPH:CCSS:CCKE:CCHM:CCSH:CCLO:CCLG:CCJB:CCHN:CCCH'-->
								<!-- 신용카드 결제시 OK캐쉬백 적립 여부를 묻는 창을 설정하는 파라미터 입니다. - 포인트 가맹점의 경우에만 창이 보여집니다.-->
								<input type='hidden' name='save_ocb' value='Y'>
								<!--무이자 옵션
							※ 설정할부    (가맹점 관리자 페이지에 설정 된 무이자 설정을 따른다)                            - '' 로 세팅
							※ 일반할부    (KCP 이벤트 이외에 설정 된 모든 무이자 설정을 무시한다)                          - 'N' 로 세팅
							※ 무이자 할부 (가맹점 관리자 페이지에 설정 된 무이자 이벤트 중 원하는 무이자 설정을 세팅한다)  - 'Y' 로 세팅-->
								<input type='hidden' name='kcp_noint' value=''>
								<!--무이자 설정
							※ 주의 1 : 할부는 결제금액이 50,000 원 이상일경우에만 가능합니다.
							※ 주의 2 : 무이자 설정값은 무이자 옵션이 Y일 경우에만 결제 창에 적용 됩니다.
							예) 전 카드 2,3,6개월 무이자(국민,비씨,엘지,삼성,신한,현대,롯데,외환) : ALL-02:03:06
							BC 2,3,6개월, 국민 3,6개월, 삼성 6,9개월 무이자 : CCBC-02:03:06,CCKM-03:06,CCSS-03:06:09-->
								<input type='hidden' name='kcp_noint_quota' value='ALL-02:03:06'>
								<!--할부개월 최대수-->
								<input type='hidden' name='quotaopt' value='12'>
								<!-- 가상계좌 은행 선택 파라미터 입니다. -->
								<!--input type='hidden' name='wish_vbank_list' value='05:03:04:07:11:26:81:71'-->
								<!-- 가상계좌 입금 기한 설정하는 파라미터 입니다. - 발급일 + 3일 -->
								<!--input type='hidden' name='vcnt_expire_term'value='3'-->
								<!-- 가상계좌 입금 시간 설정하는 파라미터 입니다. - 설정을 안하시는경우 기본적으로 23시59분59초가 세팅이 됩니다.-->
								<!--input type='hidden' name='vcnt_expire_term_time' value='235959'-->
								<!-- 복합 포인트 결제시 넘어오는 포인트사 코드 : OK캐쉬백(SCSK), 복지(SCWB) -->
								<input type='hidden' name='epnt_issu' value=''>
								<!-- 포인트 결제시 복합 결제(신용카드+포인트) 여부를 결정할 수 있습니다.- N 일경우 복합결제 사용안함-->
								<!--<input type="hidden" name="complex_pnt_yn" value="N">-->
								<!-- 현금영수증 등록 창을 보여줄지 여부를 세팅하는 파라미너 입니다. - 5000원 이상 금액에만 보여지게 됩니다.-->
								<input type='hidden' name='disp_tax_yn' value='Y'>
								<!-- 현금영수증 관련 정보 : PLUGIN 에서 내려받는 정보입니다 -->
								<input type='hidden' name='cash_tsdtime' value=''>
								<input type='hidden' name='cash_yn' value=''>
								<input type='hidden' name='cash_authno' value=''>
								<input type='hidden' name='cash_tr_code' value=''>
								<input type='hidden' name='cash_id_info' value=''>
								<!-- 교통카드 테스트용 파라미터 (교통카드 테스트 시에만 이용하시기 바랍니다.) -->
								<input type='hidden' name='test_flag' value='T_TEST'>
								<input type='hidden' name='good_name' value='<?= $_POST[TRADE_CODE]; ?>'>
								<input type='hidden' name='good_mny' value='<?= $trade_stat_data[trade_price]; ?>'>
								<input type='hidden' name='buyr_name' value='<?= $order_stat_data[order_name]; ?>'>
								<input type='hidden' name='buyr_mail' value='<?= $order_stat_data[order_email]; ?>'>
								<input type='hidden' name='buyr_tel1' value=''>
								<input type='hidden' name='buyr_tel2' value=''>
								<input type='hidden' name='pay_method' value='<? if ($trade_stat_data[trade_method] == 1) { ?>100000000000<? } else if ($trade_stat_data[trade_method] == 2) { ?>010000000000<? } else if ($trade_stat_data[trade_method] == 3) { ?>000010000000<? } else if ($trade_stat_data[trade_method] == 4) { ?>001000000000<? } ?>'>
								<tr>
									<td class='ordertitleM_Box' align="center">
										<?/*<input type="image" src="images/bt_payment.gif" align="absmiddle">
									<img src="./images/bt_payment.gif" alt="결제요청" onClick="javascript:reqPaySubmit();" style="cursor:pointer;"/>
								*/ ?>
										<!-- <input name="" type="button" class="oolimbtn-botton1" value="결제요청" onclick="jsf__pay(this.form);" /> -->
										<input class="main_bg mobile pay_now" type="button" onclick="" value="아임포트 결제">
									</td>
								</tr>
							</form>
						<?
						} else { ?>
							<script language="JavaScript">
								<!--
								function sendit(value) {
									var form = document.trade_form;
									if (form.TRADE_CODE.value == "") {
										alert("잘못된 구매방법입니다. 다시 주문해주세요");
										history.back();
									} else {
										form.submit();
									}
								}
								//
								-->
							</script>
							<form method="post" name="trade_form" action="order_trade_end_ok.php">
								<input type="hidden" name="goods_data" value="<?= $mv_data; ?>">
								<input type="hidden" name="TRADE_CODE" value="<?= $_POST[TRADE_CODE]; ?>">
								<tr>
									<td style='height:80px;'><a href="javascript:sendit();" class="oolimbtn-botton1" style="width:160px">결제하기</a></td>
								</tr>
								<tr>
									<td height="35"></td>
								</tr>
							</form>
						<? } ?>
					</table>
					<!--********************내용영역 출력 끝********************-->
					<table style='margin:0 auto;'>
						<? if ($trade_stat_data[trade_method] == 1) { ?>
							<!-- jQuery -->
							<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
							<!-- iamport.payment.js -->
							<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.8.js"></script>
							<script>
								var IMP = window.IMP; // 생략해도 괜찮습니다.
								IMP.init("imp03915712"); // "imp00000000" 대신 발급받은 "가맹점 식별코드"를 사용합니다.
								jQuery(document).ready(function() {
									$(".pay_now").click(function() {
										$("#modal_payment").modal("show");
										//imp();
									});

									$("#card").click(function() {

										//결제수단
										var p_method = 'card';

										//주문번호
										var p_uid = '<? echo $_POST['TRADE_CODE'] ?>';

										//제목
										var p_name = '<? echo urldecode($trade_data['goods_name']); ?>';

										//금액
										var price = '<? echo $trade_stat_data['trade_price'] ?>'

										//이메일
										var uemail = '<? echo $order_stat_data['order_email'] ?>';

										//전화번호
										var umobile = '<? echo $order_stat_data['order_tel1'] ?>'

										//결제유저
										var uname = '<? echo $order_stat_data['order_name'] ?>'

										//상품수
										// var money_items = $('#pay_no_estimate7').val();
										// money_items = money_items.split('`');

										// var items_count = 0;
										// for (i = 0; i < 11; i++) {
										// 	if (money_items[i] != "") {
										// 		items_count++;
										// 	}
										// }

										//업체명
										// var company = $('#pay_no_estimate8').val();

										//imp(p_method, p_uid, p_name, price, uemail, umobile, uname, items_count, company);
										imp(p_method, p_uid, p_name, price, uemail, umobile, uname);
									});




									function imp(p_method, p_uid, p_name, price, uemail, umobile, uname) {

										IMP.init('imp34946134'); //iamport 대신 자신의 "가맹점 식별코드"를 사용하시면 됩니다
										var regex = new RegExp(',', 'g');
										price = price.replace(regex, '');

										//모바일 구분자
										var mobile = 'yes';

										var redirect_url = null;

										if (p_method == 'card') {
											redirect_url = 'https://repickus.com/market/main/order_trade_end.php?CACHE=1';

										} else {
											redirect_url = 'https://repickus.com/market/main/order_trade_end.php?CACHE=1';
										}

										IMP.request_pay({
												pg: 'html5_inicis', //필수
												pay_method: p_method, //필수
												merchant_uid: p_uid + '_' + new Date().getTime(), //필수
												name: p_name, //필수(주문명 보통 상품명 입력함)
												amount: price, //필수
												buyer_email: uemail,
												buyer_name: uname,
												buyer_tel: umobile, //필수
												//buyer_addr : uaddr,
												//buyer_postcode : '123-456',
												app_scheme: 'iamportapp',
												m_redirect_url: redirect_url //결제완료 후 이동될 페이지 주소를 지정해주세요. query string이 추가되
												//m_redirect_url : 'https://repickus.com/estimate/my_estimate_form_match_sa.php?no_estimate=' + p_uid //결제완료 후 이동될 페이지 주소를 지정해주세요. query string이 추가되어 전달됩니다.

											},
											function(rsp) { // callback
												if (rsp.success) {
													//위의 parameter 들을 보내서 결제 동작을 한경우

													//결제 성공 검증 후 가맹점 서버에 내용 기록
													var imp_uid = rsp.imp_uid; //iamport 거래고유번호
													var merchant_uid = rsp.merchant_uid; //iamport 주문번호
													var amount = price; //결제된 금액
													var apply_num = rsp.apply_num; //카드승인 번호
													var vbank_name = rsp.vbank_name //가상계좌 은행사
													var vbank_num = rsp.vbank_num //가상계좌번호

													if (p_method == 'card')
													//카드결제
													{
														$.ajax({
															url: "/estimate/ajax_confirm_impayment.php",
															type: "post",
															dataType: "json",
															data: {
																p_uid: p_uid,
																imp_uid: imp_uid,
																merchant_uid: merchant_uid,
																amount: amount,
																p_name: p_name,
																uname: uname,
																uemail: uemail,
																umobile: umobile,
																//uaddr : uaddr,
																apply_num: apply_num,
																// items_count: items_count,
																// company: company
															},
															error: function(request, status, error) {
																alert("code = " + request.status +
																	" message = " + request.responseText +
																	" error = " + error); // 실패 시 처리
															},

														}).done(function(data) {
															//console.log("test");
															if (data.ret == true) {
																var f = document.pporder_info;
																f.submit();
															} else {
																alert(data.msg);
															}
														});

													} else
													//가상계좌	
													{
														//document.frmpay_confirm.submit();
														//alert(imp_uid);//imp_417225010233
														$.ajax({
															url: "./ajax_confirm_imvbank.php",
															type: "post",
															dataType: "json",
															data: {
																p_uid: p_uid,
																imp_uid: imp_uid,
																merchant_uid: merchant_uid,
																amount: amount,
																p_name: p_name,
																uname: uname,
																uemail: uemail,
																umobile: umobile,
																//uaddr : uaddr,
																vbank_name: vbank_name,
																vbank_num: vbank_num,
																items_count: items_count,
																company: company
															},

															error: function(request, status, error) {
																alert("code = " + request.status +
																	" message = " + request.responseText +
																	" error = " + error); // 실패 시 처리
															},

														}).done(function(data) { //200정상.
															//console.log("test");

															if (data.ret == true) {
																location.reload();
																//document.frmpay_confirm.submit();
																alert(data.msg);
															} else {

																//alert(data.msg);
															}

														});
													}
												} else {


													var msg = rsp.error_msg;

													alert(msg);
												}
											}
										)
									}
								});
							</script>

							<form name="pporder_info" action="pp_ax_imhub.php" method="post" <?/*onSubmit="return jsf__pay(this)"*/ ?>>
								<!-- 사이트 로고 -->
								<? if ($pginfo->pg_logo_option == 1) {
									$Temp_A = explode(".", $design_stat->title_logo);
									if (strtolower($Temp_A[count($Temp_A) - 1]) == "gif" || strtolower($Temp_A[count($Temp_A) - 1]) == "jpg" || strtolower($Temp_A[count($Temp_A) - 1]) == "bmp" || strtolower($Temp_A[count($Temp_A) - 1]) == "png") {
								?>
										<input type='hidden' name='site_logo' value='http://<?= $admin_stat->shop_domain ?>/data/designImages/<?= $design_stat->title_logo ?>'>
									<? } ?>
								<? } else if ($pginfo->pg_logo_option == 2) { ?>
									<input type='hidden' name='site_logo' value='http://<?= $admin_stat->shop_domain ?>/data/designImages/<?= $pginfo->pg_logo ?>'>
								<? } ?>
								<!-- 필수 항목 -->
								<!-- 요청종류 승인(pay)/취소,매입(mod) 요청시 사용 -->
								<input type='hidden' name='req_tx' value='pay'>
								<!-- 테스트 결제시 : T0000 으로 설정, 리얼 결제시 : 부여받은 사이트코드 입력 -->
								<input type='hidden' name='site_cd' value='<? if ($pginfo->pg_true == "1") { ?><?= $pginfo->pg_code ?><? } else { ?>T0000<? } ?>'>
								<!-- MPI 결제창에서 사용 한글 사용 불가 -->
								<input type='hidden' name='site_name' value='<?= $admin_stat->shop_name ?>'>
								<!-- http://testpay.kcp.co.kr/Pay/Test/site_key.jsp 로 접속하신후 부여받은 사이트코드를 입력하고 나온 값을 입력하시기 바랍니다. -->
								<input type='hidden' name='site_key' value='<? if ($pginfo->pg_true == "1") { ?><?= $pginfo->pg_key ?><? } else { ?>3grptw1.zW0GSo4PQdaGvsF__<? } ?>'>
								<!-- 필수 항목 : PULGIN 설정 정보 변경하지 마세요 -->
								<input type='hidden' name='module_type' value='01'>
								<!-- 필수 항목 : 결제 금액/화폐단위 -->
								<input type='hidden' name='currency' value='WON'>
								<!-- 주문 번호 (자바 스크립트 샘플(init_orderid()) 참고) -->
								<input type='hidden' name='ordr_idxx' value='<?= $_POST[TRADE_CODE]; ?>'>
								<!-- 필수 항목 : PLUGIN에서 값을 설정하는 부분으로 반드시 포함되어야 합니다. ※수정하지 마십시오.-->
								<input type='hidden' name='res_cd' value=''>
								<input type='hidden' name='res_msg' value=''>
								<input type='hidden' name='tno' value=''>
								<input type='hidden' name='trace_no' value=''>
								<input type='hidden' name='enc_info' value=''>
								<input type='hidden' name='enc_data' value=''>
								<input type='hidden' name='ret_pay_method' value=''>
								<input type='hidden' name='tran_cd' value=''>
								<input type='hidden' name='bank_name' value=''>
								<input type='hidden' name='bank_issu' value=''>
								<input type='hidden' name='use_pay_method' value=''>
								<? if (($trade_stat_data[trade_method] == 2 && $pginfo->pg_ich_escr == 1) || ($trade_stat_data[trade_method] == 4 && $pginfo->pg_vich_escr == 1)) { ?>
									<!-- 에스크로 항목 -->
									<!-- 에스크로 사용 여부(필수) : 반드시 Y 로 세팅 -->
									<input type="hidden" name="escw_used" value="Y">
									<!-- 에스크로 결제처리 모드(필수) : 에스크로: Y, 일반: N, KCP 설정 조건: O -->
									<input type="hidden" name="pay_mod" value="Y">
									<!-- 배송 소요일(필수) : 예상 배송 소요일을 입력 -->
									<input type="hidden" name="deli_term" value="03">
									<!-- 장바구니 상품 개수(필수) : 장바구니에 담겨있는 상품의 개수를 입력 -->
									<input type="hidden" name="bask_cntx" value="1">
									<!-- 장바구니 상품 상세 정보 (자바 스크립트 샘플(create_goodInfo()) 참고) -->
									<!-- 장바구니 상품 상세 정보 (자바 스크립트 샘플(create_goodInfo()) 참고) -->
									<script language='javascript'>
										document.write(String.fromCharCode(31));
										document.write("<input type='hidden' name='good_info' value='seq=1");
										document.write(String.fromCharCode(31));
										document.write("ordr_numb=<?= $_POST[TRADE_CODE]; ?>");
										document.write(String.fromCharCode(31));
										document.write("good_name=<?= $_POST[TRADE_CODE]; ?>");
										document.write(String.fromCharCode(31));
										document.write("good_cntx=1");
										document.write(String.fromCharCode(31));
										document.write("good_amtx=<?= $trade_stat_data[trade_price]; ?>'");
									</script>
									<input type="hidden" name="rcvr_name" value="<?= $order_stat_data[deliv_name]; ?>" size="20">
									<input type="hidden" name="rcvr_tel1" value="<?= $order_stat_data[deliv_tel1]; ?>-<?= $order_stat_data[deliv_tel2]; ?>-<?= $order_stat_data[deliv_tel3]; ?>" size="20">
									<input type="hidden" name="rcvr_tel2" value="<?= $order_stat_data[deliv_phone1]; ?>-<?= $order_stat_data[deliv_phone2]; ?>-<?= $order_stat_data[deliv_phone3]; ?>" size="20">
									<input type="hidden" name="rcvr_mail" value="<?= $order_stat_data[deliv_email]; ?>" size="40">
									<input type="hidden" name="rcvr_zipx" value="<?= $order_stat_data[deliv_zip1]; ?><?= $order_stat_data[deliv_zip2]; ?>" size="6">
									<input type="hidden" name="rcvr_add1" value="<?= $order_stat_data[deliv_add1]; ?>" size="50">
									<input type="hidden" name="rcvr_add2" value="<?= $order_stat_data[deliv_add2]; ?>" size="50">
								<? } ?>
								<!-- 신용카드사 삭제 파라미터 입니다. -->
								<!--input type='hidden' name='not_used_card' value='CCPH:CCSS:CCKE:CCHM:CCSH:CCLO:CCLG:CCJB:CCHN:CCCH'-->
								<!-- 신용카드 결제시 OK캐쉬백 적립 여부를 묻는 창을 설정하는 파라미터 입니다. - 포인트 가맹점의 경우에만 창이 보여집니다.-->
								<input type='hidden' name='save_ocb' value='Y'>
								<!--무이자 옵션
						※ 설정할부    (가맹점 관리자 페이지에 설정 된 무이자 설정을 따른다)                            - '' 로 세팅
						※ 일반할부    (KCP 이벤트 이외에 설정 된 모든 무이자 설정을 무시한다)                          - 'N' 로 세팅
						※ 무이자 할부 (가맹점 관리자 페이지에 설정 된 무이자 이벤트 중 원하는 무이자 설정을 세팅한다)  - 'Y' 로 세팅-->
								<input type='hidden' name='kcp_noint' value=''>
								<!--무이자 설정
						※ 주의 1 : 할부는 결제금액이 50,000 원 이상일경우에만 가능합니다.
						※ 주의 2 : 무이자 설정값은 무이자 옵션이 Y일 경우에만 결제 창에 적용 됩니다.
						예) 전 카드 2,3,6개월 무이자(국민,비씨,엘지,삼성,신한,현대,롯데,외환) : ALL-02:03:06
						BC 2,3,6개월, 국민 3,6개월, 삼성 6,9개월 무이자 : CCBC-02:03:06,CCKM-03:06,CCSS-03:06:09-->
								<input type='hidden' name='kcp_noint_quota' value='ALL-02:03:06'>
								<!--할부개월 최대수-->
								<input type='hidden' name='quotaopt' value='12'>
								<!-- 가상계좌 은행 선택 파라미터 입니다. -->
								<!--input type='hidden' name='wish_vbank_list' value='05:03:04:07:11:26:81:71'-->
								<!-- 가상계좌 입금 기한 설정하는 파라미터 입니다. - 발급일 + 3일 -->
								<!--input type='hidden' name='vcnt_expire_term'value='3'-->
								<!-- 가상계좌 입금 시간 설정하는 파라미터 입니다. - 설정을 안하시는경우 기본적으로 23시59분59초가 세팅이 됩니다.-->
								<!--input type='hidden' name='vcnt_expire_term_time' value='235959'-->
								<!-- 복합 포인트 결제시 넘어오는 포인트사 코드 : OK캐쉬백(SCSK), 복지(SCWB) -->
								<input type='hidden' name='epnt_issu' value=''>
								<!-- 포인트 결제시 복합 결제(신용카드+포인트) 여부를 결정할 수 있습니다.- N 일경우 복합결제 사용안함-->
								<!--<input type="hidden" name="complex_pnt_yn" value="N">-->
								<!-- 현금영수증 등록 창을 보여줄지 여부를 세팅하는 파라미너 입니다. - 5000원 이상 금액에만 보여지게 됩니다.-->
								<input type='hidden' name='disp_tax_yn' value='Y'>
								<!-- 현금영수증 관련 정보 : PLUGIN 에서 내려받는 정보입니다 -->
								<input type='hidden' name='cash_tsdtime' value=''>
								<input type='hidden' name='cash_yn' value=''>
								<input type='hidden' name='cash_authno' value=''>
								<input type='hidden' name='cash_tr_code' value=''>
								<input type='hidden' name='cash_id_info' value=''>
								<!-- 교통카드 테스트용 파라미터 (교통카드 테스트 시에만 이용하시기 바랍니다.) -->
								<input type='hidden' name='test_flag' value='T_TEST'>
								<input type='hidden' name='good_name' value='<?= $_POST[TRADE_CODE]; ?>'>
								<input type='hidden' name='good_mny' value='<?= $trade_stat_data[trade_price]; ?>'>
								<input type='hidden' name='buyr_name' value='<?= $order_stat_data[order_name]; ?>'>
								<input type='hidden' name='buyr_mail' value='<?= $order_stat_data[order_email]; ?>'>
								<input type='hidden' name='buyr_tel1' value=''>
								<input type='hidden' name='buyr_tel2' value=''>
								<input type='hidden' name='pay_method' value='<? if ($trade_stat_data[trade_method] == 1) { ?>100000000000<? } else if ($trade_stat_data[trade_method] == 2) { ?>010000000000<? } else if ($trade_stat_data[trade_method] == 3) { ?>000010000000<? } else if ($trade_stat_data[trade_method] == 4) { ?>001000000000<? } ?>'>

							</form>


							<div class="modal fade modal_table" id="modal_payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content" style="margin-top:20rem;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">결제</h4>
										</div>
										<div class="modal-body" style="padding-top:0;">
											<div class="form-group one_line" style="border:0 !important; padding-bottom:0; margin-top:3rem;">
												<ul class="row text-center">
													<li class="col-xs-12" style="margin-bottom:2rem;">
														<input type="button" class=" btn btn-primary" id="card" value="카드" style="width:15rem; height:5rem; font-size:2rem;">
													</li>
												</ul>

											</div>
										</div>
									</div>
								</div>
							</div>
						<? } ?>

					</table>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
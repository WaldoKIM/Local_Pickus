<? include('./include/head.inc.php'); ?>
<?


if ($_GET[cartidx]) {
	$cartidx = $_GET[cartidx];
} else {
	$cartidx = $_POST[cartidx];
}
if ($_GET[trade_method] == 1 || $_GET[trade_method] == 2) {
	if (!$cartidx) $cartidx = $_SESSION[CARTIDX];
	$_SESSION[CARTIDX] = $cartidx;
}
if ($_GET[trade_method] == 1 || $_GET[trade_method] == 2) {
	if (!$cartidx) $tools->alertJavaGo('구매목록을 확인후 다시 주문을 진행하여 주세요', 'cart.php');
}
// trade_tmp에 상품주문 목록을 입력한다.여기서 주문코드를 생성시킨다.
mt_srand((float)microtime() * 1000000);
$TRADE_CODE = chr(mt_rand(65, 90));
$TRADE_CODE .= chr(mt_rand(65, 90));
$TRADE_CODE .= chr(mt_rand(65, 90));
$TRADE_CODE .= chr(mt_rand(65, 90));
$TRADE_CODE .= chr(mt_rand(65, 90));
$TRADE_CODE .= time();
// 회원체크
if (!$_GET[nologin]) {
	if (!$_SESSION[USERID] || !$_SESSION[PASSWD]) {
		// 로그인 상태가 아니면 회원과 비회원을 선택을 하게 한다.
		$tools->metaGo('login_check.php?login_go=' . basename($_SERVER['PHP_SELF']) . '?' . $_SERVER['QUERY_STRING'] . '&opt_code=' . $_GET[opt_code]);
	} else {
		// 만약에 회원이면 회원정보를 가지고 온다.
		$member_stat = $db->object("cs_member", "where userid='$_SESSION[USERID]' and passwd='$_SESSION[PASSWD]'");
	}
}
?>
<div id="layer" class="post_number_search">
	<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:2px;top:2px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
</div>
<? if (!$_SERVER[HTTPS]) { ?>
	<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<? } else { ?>
	<script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
<? } ?>
<script>
	// 우편번호 찾기 화면을 넣을 element
	var element_layer = document.getElementById('layer');

	function closeDaumPostcode() {
		// iframe을 넣은 element를 안보이게 한다.
		element_layer.style.display = 'none';
	}

	function sample2_execDaumPostcode() {
		new daum.Postcode({
			oncomplete: function(data) {
				// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
				// 각 주소의 노출 규칙에 따라 주소를 조합한다.
				// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
				var fullAddr = data.address; // 최종 주소 변수
				var extraAddr = ''; // 조합형 주소 변수
				// 기본 주소가 도로명 타입일때 조합한다.
				if (data.addressType === 'R') {
					//법정동명이 있을 경우 추가한다.
					if (data.bname !== '') {
						extraAddr += data.bname;
					}
					// 건물명이 있을 경우 추가한다.
					if (data.buildingName !== '') {
						extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
					}
					// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
					fullAddr += (extraAddr !== '' ? ' (' + extraAddr + ')' : '');
				}
				// 우편번호와 주소 정보를 해당 필드에 넣는다.
				document.getElementById('deliv_zip').value = data.zonecode;
				document.getElementById('deliv_add1').value = fullAddr;
				// iframe을 넣은 element를 안보이게 한다.
				// (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
				element_layer.style.display = 'none';
			},
			width: '100%',
			height: '100%'
		}).embed(element_layer);
		// iframe을 넣은 element를 보이게 한다.
		element_layer.style.display = 'block';
		// iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
		initLayerPosition();
	}
	// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
	// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
	// 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
	function initLayerPosition() {
		var width = 300; //우편번호서비스가 들어갈 element의 width
		var height = 460; //우편번호서비스가 들어갈 element의 height
		var borderWidth = 5; //샘플에서 사용하는 border의 두께
		// 위에서 선언한 값들을 실제 element에 넣는다.
		element_layer.style.width = width + 'px';
		element_layer.style.height = height + 'px';
		element_layer.style.border = borderWidth + 'px solid';
		// 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
		// element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
		// element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
	}
</script>
<script language="JavaScript">
	<!--
	// 우편번호찾기
	function postWinOpen(data) {
		window.open("post_search.php?method=" + data, "", "scrollbars=yes, width=500, height=400");
	}

	function sendit() {
		var form = document.trade_form;
		if (form.order_name.value == "") {
			alert("주문자 이름을 입력해 주세요.");
			form.order_name.focus();
		} else if (form.order_email.value == "") {
			alert("주문자 E-Mail를 입력해 주세요.");
			form.order_email.focus();
		} else if (form.order_tel1.value == "") {
			alert("주문자 전화번호를 입력해 주세요.");
			form.order_tel1.focus();
			//} else if(form.order_tel2.value=="") {
			//	alert("주문자 전화번호를 입력해 주세요.");
			//	form.order_tel2.focus();
			//} else if(form.order_tel3.value=="") {
			//	alert("주문자 전화번호를 입력해 주세요.");
			//	form.order_tel3.focus();
		} else if (form.deliv_name.value == "") {
			alert("수취인 이름을 입력해 주세요.");
			form.deliv_name.focus();
		} else if (form.deliv_tel1.value == "") {
			alert("수취인 전화번호를 입력해 주세요.");
			form.deliv_tel1.focus();
			//} else if(form.deliv_tel2.value=="") {
			//	alert("수취인 전화번호를 입력해 주세요.");
			//	form.deliv_tel2.focus();
			//} else if(form.deliv_tel3.value=="") {
			//	alert("수취인 전화번호를 입력해 주세요.");
			//	form.deliv_tel3.focus();
		} else if (form.deliv_email.value == "") {
			alert("수취인 E-Mail를 입력해 주세요.");
			form.deliv_email.focus();
		} else if (form.deliv_zip.value == "") {
			alert("수취인 우편번호를 입력해 주세요.");
			form.deliv_zip.focus();
		} else if (form.deliv_zip.value.length != 5) {
			alert("수취인 우편번호 5자리를 입력해 주세요.");
			form.deliv_zip.focus();
		} else if (form.deliv_add1.value == "") {
			alert("수취인 주소를 입력해 주세요.");
			form.deliv_add1.focus();
		} else if (form.deliv_add2.value == "") {
			alert("수취인 상세주소(번지)를 입력해 주세요.");
			form.deliv_add2.focus();
			<? if ($_GET[nologin] == 1) { ?>
		} else if (document.all.useragreecheck[0].checked != true) {
			alert("개인정보취급방침에 동의하여 주세요.");
		<? } ?>
		} else {
			<? if ($SECURITYDOMAIN) { ?>
				form.action = "<?= $SECURITYDOMAIN ?>/order_trade.php?CACHE=1";
			<? } else { ?>
				form.action = "order_trade.php?CACHE=1";
			<? } ?>
			form.submit();
		}
	}
	// 토글전역변수
	var toggle = 0;

	function toggleCheck() {
		var form = document.trade_form;
		toggle = 1 - toggle;
		if (toggle) {
			form.deliv_name.value = form.order_name.value;
			form.deliv_email.value = form.order_email.value;
			form.deliv_tel1.value = form.order_tel1.value;
			//form.deliv_tel2.value		=form.order_tel2.value;
			//form.deliv_tel3.value		=form.order_tel3.value;
			form.deliv_phone1.value = form.order_phone1.value;
			//form.deliv_phone2.value=form.order_phone2.value;
			//form.deliv_phone3.value=form.order_phone3.value;
			form.deliv_zip.value = form.order_zip.value;
			form.deliv_add1.value = form.order_add1.value;
			form.deliv_add2.value = form.order_add2.value;
			form.deliv_tel3.value = form.order_tel3.value;
			form.deliv_tel2.value = form.order_tel2.value;
			form.deliv_tel3.value = form.order_tel3.value;
		} else {
			form.deliv_name.value = "";
			form.deliv_email.value = "";
			form.deliv_tel1.value = "";
			//form.deliv_tel2.value		="";
			//form.deliv_tel3.value		="";
			form.deliv_phone1.value = "";
			form.deliv_phone2.value = "";
			form.deliv_phone3.value = "";
			form.deliv_zip.value = "";
			form.deliv_add1.value = "";
			form.deliv_add2.value = "";
			form.deliv_tel3.value = "";
			form.deliv_tel2.value = "";
			form.deliv_tel3.value = "";
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
			<li>주문서작성</li>
		</ol>
	</div>
	<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section order_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<h3 class="tit">주문서작성</h3>
					<!--********************내용영역 출력 시작********************-->
					<div class="order_list_area">
						<ul class="header_cell">
							<li class="prd_info">상품정보</li>
							<li class="sell_p">판매가격</li>
							<li class="prd_ea">수량</li>
							<li style="display:none;" class="point">적립금</li>
							<li class="point">배송비</li>
							<li class="order_p">주문금액</li>

						</ul>
						<? if ($_GET[trade_method] == 1) {		//장바구니
							$cart_result = $db->select("cs_cart", "where idx IN($cartidx) order by goods_idx asc, idx asc");
							$total_goods_price = 0;  // 총금액
							$total_goods_point = 0;  // 총포인트

							$cart_cnt_plus = 1;
							while ($cart_row = @mysqli_fetch_object($cart_result)) {
								//배송비 계산중 210519
								$cart_cnt = $db->cnt("cs_cart", "where  idx IN($cartidx) and goods_idx=$cart_row->goods_idx");
								$goods_stat = $db->object("cs_goods", "where idx=$cart_row->goods_idx");
								$deliv_fee = 0;
								if ($cart_cnt == 1) {
									$deliv_fee = $goods_stat->deliv_fee;
								} else if ($cart_cnt > 1 && $goods_code != $goods_stat->code) {
									$deliv_fee = $goods_stat->deliv_fee;
									$goods_code = $goods_stat->code;
									//}else if($goods_stat->exc >0){
									//	$deliv_fee = $goods_stat->deliv_fee;
								} else {
									$deliv_fee = 0;
								}
								//배송비 계산중 //

								$form_cnt++;
								// 총금액
								$total_goods_price += $cart_row->goods_price * $cart_row->goods_cnt;
								// 총포인트
								$total_goods_point += $cart_row->goods_price * $cart_row->goods_cnt * $cart_row->goods_point * 0.01;
								// 따음표나 공백 복원
								$goods_name = stripslashes($cart_row->goods_name);
								// trade tmp 에 저장한다.
								$encode_goods_name = urlencode($goods_name);

								//할인 후 가격
								$trade_price = $cart_row->goods_price - round($cart_row->goods_price * $admin_stat->{"dc" . $_SESSION[LEVEL]} * 0.01, -2);

								$trade_goods_data = $tools->encode("trade_code=" . $TRADE_CODE . "&part_idx=" . $cart_row->part_idx . "&goods_idx=" . $cart_row->goods_idx . "&goods_code=" . $cart_row->goods_code . "&goods_name=" . $encode_goods_name . "&goods_price=" . $cart_row->goods_price . "&goods_cnt=" . $cart_row->goods_cnt . "&goods_point=" . $cart_row->goods_point . "&opt_data=" . $cart_row->opt_data . "&box=" . $cart_row->box . "&seller=" . $cart_row->seller . "&order_userid=" . $cart_row->userid . "&trade_price=" . $trade_price . "&deliv_fee=" . $deliv_fee);

								$goodsInfo = $db->object("cs_goods", "where idx=$cart_row->goods_idx and display=1");
								$db->insert("cs_trade_tmp", "code='$TRADE_CODE', item=0, data='$trade_goods_data', register=now()");
								$ThumbEncode = $tools->encode("idx=" . $cart_row->goods_idx . "&table=cs_goods&img=images1&dire=goodsImages&w=125&h=125");
						?>
								<ul class="data_cell">
									<li class="prd_photo"><a href="product_view.php?goods_data=<?= $trade_goods_data; ?>"><img src="../data/goodsImages/<?= $goodsInfo->images1 ?>" border="0"></a></li>
									<li class="prd_name_option">
										<div><?= $goods_name; ?><div>
												<?
												$optArr = explode("/^CUT/^", $cart_row->opt_data);
												for ($i = 0; $i < count($optArr) - 1; $i++) {
													$optRec = explode("/^/^", $optArr[$i]);
													$optView = "";
													$optView = explode(":", $optRec[1]);
												?>
													<div class="op_data"><span><?= $optRec[0]; ?>:&nbsp;<?= $optView[0] ?><? if ($optView[1]) { ?>:<?= number_format($optView[1]) ?>원<? } ?></span></div>
												<? } ?>
									</li>
									<li class="sell_p"><span><?= number_format($cart_row->goods_price); ?></span>원</li>
									<li class="prd_ea"><?= number_format($cart_row->goods_cnt); ?>개</li>
									<li style="display:none;" class="point"><span><?= number_format($cart_row->goods_price * $cart_row->goods_point * 0.01); ?></span>point</li>
									<li class="point"><span><?= number_format($deliv_fee); ?></span>원</li>
									<li class="order_p"><span><?= number_format($cart_row->goods_price * $cart_row->goods_cnt); ?></span>원</li>
								</ul>
							<? } ?>
							<? if ($total_goods_price == 0) {
								$tools->errMsg("구매상품 확인후 다시 진행하시기 바랍니다.");
							?>
							<? } ?>
							<? } else if ($_GET[trade_method] == 2) { //즉시구매
							if ($_GET[opt_code]) { //2021-04-29 다중선택 구매 추가 sinn
								$cart_result = $db->select("cs_cart_tmp", "where opt_code='$_GET[opt_code]' and code='$_SESSION[CART]' order by idx asc");
								$total_goods_price = 0;  // 총금액
								$total_goods_point = 0;  // 총포인트
								while ($cart_row = @mysqli_fetch_object($cart_result)) {
									//배송비 계산중 210519
									$cart_cnt = $db->cnt("cs_cart_tmp", "where goods_idx=$cart_row->goods_idx");
									$goods_stat = $db->object("cs_goods", "where idx=$cart_row->goods_idx");
									$deliv_fee = 0;
									if ($cart_cnt == 1) {
										$deliv_fee = $goods_stat->deliv_fee;
									} else if ($cart_cnt > 1 && $goods_code != $goods_stat->code) {
										$deliv_fee = $goods_stat->deliv_fee;
										$goods_code = $goods_stat->code;
										//}else if($goods_stat->exc >0){
										//	$deliv_fee = $goods_stat->deliv_fee;
									} else {
										$deliv_fee = 0;
									}
									//배송비 계산중 //

									$form_cnt++;
									// 총금액
									$total_goods_price += $cart_row->goods_price * $cart_row->goods_cnt;
									// 총포인트
									$total_goods_point += $cart_row->goods_price * $cart_row->goods_cnt * $cart_row->goods_point * 0.01;
									// 따음표나 공백 복원
									$goods_name = stripslashes($cart_row->goods_name);
									// trade tmp 에 저장한다.
									$encode_goods_name = urlencode($goods_name);

									//할인 후 가격
									$trade_price = $cart_row->goods_price - round($cart_row->goods_price * $admin_stat->{"dc" . $_SESSION[LEVEL]} * 0.01, -2);
									$trade_goods_data = $tools->encode("trade_code=" . $TRADE_CODE . "&part_idx=" . $cart_row->part_idx . "&goods_idx=" . $cart_row->goods_idx . "&goods_code=" . $cart_row->goods_code . "&goods_name=" . $encode_goods_name . "&goods_price=" . $cart_row->goods_price . "&goods_cnt=" . $cart_row->goods_cnt . "&goods_point=" . $cart_row->goods_point . "&opt_data=" . $cart_row->opt_data . "&box=" . $cart_row->box . "&seller=" . $cart_row->seller . "&order_userid=" . $cart_row->userid . "&trade_price=" . $trade_price . "&deliv_fee=" . $deliv_fee);
									$goodsInfo = $db->object("cs_goods", "where idx=$cart_row->goods_idx and display=1");
									$db->insert("cs_trade_tmp", "code='$TRADE_CODE', item=0, data='$trade_goods_data', register=now()");
									$ThumbEncode = $tools->encode("idx=" . $cart_row->goods_idx . "&table=cs_goods&img=images1&dire=goodsImages&w=125&h=125");
							?>
									<ul class="data_cell">
										<li class="prd_photo"><a href="product_view.php?goods_data=<?= $trade_goods_data; ?>"><img src="../data/goodsImages/<?= $goodsInfo->images1 ?>" border="0"></a></li>
										<li class="prd_name_option">
											<div><?= $goods_name; ?><div>
													<?
													$optArr = explode("/^CUT/^", $cart_row->opt_data);
													for ($i = 0; $i < count($optArr) - 1; $i++) {
														$optRec = explode("/^/^", $optArr[$i]);
														$optView = "";
														$optView = explode(":", $optRec[1]);
													?>
														<div class="op_data"><span><?= $optRec[0]; ?>:&nbsp;<?= $optView[0] ?><? if ($optView[1]) { ?>:<?= number_format($optView[1]) ?>원<? } ?></span></div>
													<? } ?>
										</li>
										<li class="sell_p"><span><?= number_format($cart_row->goods_price); ?></span>원</li>
										<li class="prd_ea"><?= number_format($cart_row->goods_cnt); ?>개</li>
										<li style="display:none;" class="point"><span><?= number_format($cart_row->goods_price * $cart_row->goods_point * 0.01); ?></span>point</li>
										<li class="point"><span><?= number_format($deliv_fee); ?></span>원</li>
										<li class="order_p"><span><?= number_format($cart_row->goods_price * $cart_row->goods_cnt); ?></span>원</li>
									</ul>
								<? } ?>
								<? if ($total_goods_price == 0) {
									$tools->errMsg("구매상품 확인후 다시 진행하시기 바랍니다.");
								?>
								<? } ?>
								<? } else { // 단일 선택 즉시구매
								$cart_result = $db->select("cs_cart", "where idx IN($cartidx) order by idx asc");
								$total_goods_price = 0;  // 총금액
								$total_goods_point = 0;  // 총포인트
								while ($cart_row = @mysqli_fetch_object($cart_result)) {
									//배송비 계산중 210519
									$cart_cnt = $db->cnt("cs_cart", "where goods_idx=$cart_row->goods_idx");
									$goods_stat = $db->object("cs_goods", "where idx=$cart_row->goods_idx");
									$deliv_fee = 0;
									if ($cart_cnt == 1) {
										$deliv_fee = $goods_stat->deliv_fee;
									} else if ($cart_cnt > 1 && $goods_code != $goods_stat->code) {
										$deliv_fee = $goods_stat->deliv_fee;
										$goods_code = $goods_stat->code;
										//}else if($goods_stat->exc >0){
										//	$deliv_fee = $goods_stat->deliv_fee;
									} else {
										$deliv_fee = 0;
									}
									//배송비 계산중 //

									$form_cnt++;
									// 총금액
									$total_goods_price += $cart_row->goods_price * $cart_row->goods_cnt;
									// 총포인트
									$total_goods_point += $cart_row->goods_price * $cart_row->goods_cnt * $cart_row->goods_point * 0.01;
									// 따음표나 공백 복원
									$goods_name = stripslashes($cart_row->goods_name);
									// trade tmp 에 저장한다.
									$encode_goods_name = urlencode($goods_name);

									//할인 후 가격
									$trade_price = $cart_row->goods_price - round($cart_row->goods_price * $admin_stat->{"dc" . $_SESSION[LEVEL]} * 0.01, -2);

									$trade_goods_data = $tools->encode("trade_code=" . $TRADE_CODE . "&part_idx=" . $cart_row->part_idx . "&goods_idx=" . $cart_row->goods_idx . "&goods_code=" . $cart_row->goods_code . "&goods_name=" . $encode_goods_name . "&goods_price=" . $cart_row->goods_price . "&goods_cnt=" . $cart_row->goods_cnt . "&goods_point=" . $cart_row->goods_point . "&opt_data=" . $cart_row->opt_data . "&box=" . $cart_row->box . "&seller=" . $cart_row->seller . "&order_userid=" . $cart_row->userid . "&trade_price=" . $trade_price . "&deliv_fee=" . $deliv_fee);
									$goodsInfo = $db->object("cs_goods", "where idx=$cart_row->goods_idx and display=1");
									$db->insert("cs_trade_tmp", "code='$TRADE_CODE', item=0, data='$trade_goods_data', register=now()");
									$ThumbEncode = $tools->encode("idx=" . $cart_row->goods_idx . "&table=cs_goods&img=images1&dire=goodsImages&w=70&h=70");
								?>
									<ul class="data_cell">
										<li class="prd_photo"><a href="product_view.php?goods_data=<?= $trade_goods_data; ?>"><img src="../data/goodsImages/<?= $goodsInfo->images1 ?>" border="0"></a></li>
										<li class="prd_name_option">
											<div><?= $goods_name; ?><div>
													<?
													$optArr = explode("/^CUT/^", $cart_row->opt_data);
													for ($i = 0; $i < count($optArr) - 1; $i++) {
														$optRec = explode("/^/^", $optArr[$i]);
														$optView = "";
														$optView = explode(":", $optRec[1]);
													?>
														<div class="op_data"><span><?= $optRec[0]; ?>:&nbsp;<?= $optView[0] ?><? if ($optView[1]) { ?>:<?= number_format($optView[1]) ?>원<? } ?></span></div>
													<? } ?>
										</li>
										<li class="sell_p"><span><?= number_format($cart_row->goods_price); ?></span>원</li>
										<li class="prd_ea"><?= number_format($cart_row->goods_cnt); ?>개</li>
										<li style="display:none;" class="point"><span><?= number_format($cart_row->goods_price * $cart_row->goods_point * 0.01); ?></span>point</li>
										<li class="point"><span><?= number_format($deliv_fee); ?></span>원</li>
										<li class="order_p"><span><?= number_format($cart_row->goods_price * $cart_row->goods_cnt); ?></span>원</li>
									</ul>
								<? } ?>
								<? if ($total_goods_price == 0) {
									$tools->errMsg("구매상품 확인후 다시 진행하시기 바랍니다.");
								} ?>
							<? } ?>

							<? } else if ($_GET[trade_method] == 3) { //관심상품
							if (!$_SESSION[USERID] || !$_SESSION[PASSWD]) {
								$toods->msgClose('잘못된 접근입니다');
							}

							if ($_GET[wishlist_idx]) {
								$wishlist_result = $db->select("cs_wishlist", "where idx='$_GET[wishlist_idx]' and userid='$_SESSION[USERID]'");
							} else {
								$wishlist_result = $db->select("cs_wishlist", "where userid='$_SESSION[USERID]' order by idx asc");
							}

							$total_goods_price = 0;  // 총금액
							$total_goods_point = 0;  // 총포인트
							while ($withlist_row = @mysqli_fetch_object($wishlist_result)) {
								//배송비 계산중 210519
								$cart_cnt = $db->cnt("cs_cart", "where goods_idx=$withlist_row->goods_idx");
								$goods_stat = $db->object("cs_goods", "where idx=$withlist_row->goods_idx");
								$deliv_fee = 0;
								if ($cart_cnt == 1) {
									$deliv_fee = $goods_stat->deliv_fee;
								} else if ($cart_cnt > 1 && $goods_code != $goods_stat->code) {
									$deliv_fee = $goods_stat->deliv_fee;
									$goods_code = $goods_stat->code;
									//}else if($goods_stat->exc >0){
									//	$deliv_fee = $goods_stat->deliv_fee;
								} else {
									$deliv_fee = 0;
								}
								//배송비 계산중 //
								$form_cnt++;
								// 상품 수량 체크(wishlist는 구매시 수량 보유량 체크해야 됨)
								$goods_stat = $db->object("cs_goods", "where idx=$withlist_row->goods_idx");
								$deliv_fee = $goods_stat->deliv_fee;
								if (($goods_stat->unlimit == 0) && ($goods_stat->number < $withlist_row->goods_cnt)) {
									$tools->errMsg('상품 재고가 부족합니다. 상품 수량을 확인해 주세요.');
								}
								// 총금액
								$total_goods_price += $withlist_row->goods_price * $withlist_row->goods_cnt;
								// 총포인트
								$total_goods_point += $withlist_row->goods_price * $withlist_row->goods_cnt * $withlist_row->goods_point * 0.01;
								// 따음표나 공백 복원
								$goods_name = stripslashes($withlist_row->goods_name);
								//할인 후 가격
								$trade_price = $withlist_row->goods_price - round($withlist_row->goods_price * $admin_stat->{"dc" . $_SESSION[LEVEL]} * 0.01, -2);

								// trade tmp 에 저장한다.
								$encode_goods_name = urlencode($goods_name);
								$trade_goods_data = $tools->encode("trade_code=" . $TRADE_CODE . "&part_idx=" . $withlist_row->part_idx . "&goods_idx=" . $withlist_row->goods_idx . "&goods_code=" . $withlist_row->goods_code . "&goods_name=" . $encode_goods_name . "&goods_price=" . $withlist_row->goods_price . "&goods_cnt=" . $withlist_row->goods_cnt . "&goods_point=" . $withlist_row->goods_point . "&opt_data=" . $withlist_row->opt_data . "&box=" . $withlist_row->box . "&seller=" . $goods_stat->seller . "&order_userid=" . $withlist_row->userid . "&trade_price=" . $trade_price . "&deliv_fee=" . $deliv_fee);

								$db->insert("cs_trade_tmp", "code='$TRADE_CODE', item=0, data='$trade_goods_data', register=now()");
								$ThumbEncode = $tools->encode("idx=" . $withlist_row->goods_idx . "&table=cs_goods&img=images1&dire=goodsImages&w=70&h=70");
							?>
								<ul class="data_cell">
									<li class="prd_photo"><a href="product_view.php?goods_data=<?= $trade_goods_data; ?>"><img src="../data/goodsImages/<?= $goods_stat->images1 ?>" border="0"></a></li>
									<li class="prd_name_option">
										<div><?= $goods_name; ?><div>
												<?
												$optArr = explode("/^CUT/^", $withlist_row->opt_data);
												for ($i = 0; $i < count($optArr) - 1; $i++) {
													$optRec = explode("/^/^", $optArr[$i]);
													$optView = "";
													$optView = explode(":", $optRec[1]);
												?>
													<div class="op_data"><span><?= $optRec[0]; ?>:&nbsp;<?= $optView[0] ?><? if ($optView[1]) { ?>:<?= number_format($optView[1]) ?>원<? } ?></span></div>
												<? } ?>
									</li>
									<li class="sell_p"><span><?= number_format($withlist_row->goods_price); ?></span>원</li>
									<li class="prd_ea"><?= number_format($withlist_row->goods_cnt); ?>개</li>
									<li style="display:none;" class="point"><span><?= number_format($withlist_row->goods_price * $withlist_row->goods_point * 0.01); ?></span>point</li>
									<li class="point"><span><?= number_format($deliv_fee); ?></span>원</li>
									<li class="order_p"><span><?= number_format($withlist_row->goods_price * $withlist_row->goods_cnt); ?></span>원</li>
								</ul>
							<? } ?>
							<? if ($total_goods_price == 0) {
								$tools->errMsg("구매상품 확인후 다시 진행하시기 바랍니다.");
							?>

							<? } ?>
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
								<td style="display:none;><?= number_format($total_goods_point); ?><span class="point">point</span></td>
								<td><span class="total"><?= number_format($total_goods_price); ?></span>원</td>
							</tr>
						</table>
					</div>
					<? if ($_GET[nologin] == 1) { ?>
						<div class="joinInfo">
							<h3>개인정보취급방침</h3>
							<div class="ruleBox">
								<?
								echo $admin_stat->memberinfoadmin;
								?>
							</div>
							<div class="user_select">
								<input type="radio" value="0" name="useragreecheck"><span>약관동의</span>
								<input type="radio" value="1" name="useragreecheck"><span>동의하지않음 </span>
							</div>
						</div>
					<? } ?>
					<form method=post name="trade_form">
						<input type="hidden" name="order_phone1" value="<?= $member_stat->phone1; ?>">
						<input type="hidden" name="order_phone2" value="<?= $member_stat->phone2; ?>">
						<input type="hidden" name="order_phone3" value="<?= $member_stat->phone3; ?>">
						<input type="hidden" name="order_zip" value="<?= $member_stat->zip; ?>">
						<input type="hidden" name="order_add1" value="<?= $member_stat->add1; ?>">
						<input type="hidden" name="order_add2" value="<?= $member_stat->add2; ?>">
						<input type="hidden" name="order_userid" value="<?= $member_stat->userid; ?>">
						<input type="hidden" name="trade_price" value="<?= $total_goods_price; ?>">
						<input type="hidden" name="trade_save_point" value="<?= $total_goods_point; ?>">
						<input type="hidden" name="TRADE_CODE" value="<?= $TRADE_CODE; ?>">
						<!-- 상품구매자 정보 입력 -->
						<div class="order_user">
							<h3>주문자 정보</h3>
							<table>
								<tr>
									<th>이름</th>
									<td><input name="order_name" class="u_name" type="text" maxlength="10" size="20" value="<?= $member_stat->name; ?>"></td>
								</tr>
								<tr>
									<th>이메일</th>
									<td><input name="order_email" class="u_mail" type="text" maxlength="40" style="IME-MODE:disabled" value="<?= $member_stat->email; ?>"></td>
								</tr>
								<tr>
									<th>전화번호</th>
									<td>
										<input name="order_tel1" class="u_phone" type="text" maxlength="15" size="15" value="<?= $member_stat->phone1; ?>" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">
										<?/*
										<span>-</span>
										<input name="order_tel2" class="u_phone" type="text" maxlength="4" size="4" value="<?=$member_stat->tel2;?>" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">
										<span>-</span>
										<input name="order_tel3" class="u_phone" type="text" maxlength="4" size="4" value="<?=$member_stat->tel3;?>" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">
										*/ ?>
									</td>
								</tr>
							</table>
						</div>
						<!-- //상품구매자 정보 입력 -->
						<!--배송지정보-->
						<div class="delivery_info">
							<h3>배송지 정보
								<a href="javascript:toggleCheck();" onfocus="this.blur()">주문자 정보와 동일</a>
							</h3>
							<table>
								<tr class="u_name">
									<th>수취인이름</th>
									<td><input name="deliv_name" class="enter" type="text" maxlength="10" size="20" /></td>
								</tr>
								<tr class="u_phone">
									<th>전화번호</th>
									<td>
										<input name="deliv_tel1" class="enter" type="text" maxlength="15" size="15" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" />
										<?/*
										<span>-</span>
										<input name="deliv_tel2" class="enter" type="text" maxlength="4" size="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;"/>
										<span>-</span>
										<input name="deliv_tel3" class="enter" type="text" maxlength="4" size="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;"/>
										*/ ?>
									</td>
								</tr>
								<tr class="u_phone">
									<th>핸드폰</th>
									<td>

										<input name="deliv_phone1" type="text" class="enter" maxlength="15" size="15" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" />
										<?/*
										<span>-</span>
										<input name="deliv_phone2" type="text" class="enter" maxlength="4" size="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;"/>
										<span>-</span>
										<input name="deliv_phone3" type="text" class="enter" maxlength="4" size="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;"/>
										*/ ?>
									</td>
								</tr>
								<tr class="u_email">
									<th>이메일</th>
									<td>
										<input name="deliv_email" type="text" class="enter" maxlength="40" style="IME-MODE:disabled" />
									</td>
								</tr>
								<tr class="u_post">
									<th>우편번호</th>
									<td>
										<input name="deliv_zip" id="deliv_zip" type="text" class="enter" maxlength="5" size="5" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" placeholder="우편번호">
										<a href="javascript:sample2_execDaumPostcode()" title="우편번호">주소검색</a>
									</td>
								</tr>
								<tr class="u_address">
									<th></th>
									<td>
										<input name="deliv_add1" id="deliv_add1" type="text" class="enter" placeholder="주소">
									</td>
								</tr>
								<tr class="u_address">
									<th></th>
									<td><input name="deliv_add2" type="text" class="enter" placeholder='상세주소를 입력해주세요'></td>
								</tr>
								<tr class="comment">
									<th>주문시 요청사항</th>
									<td><textarea name="deliv_content" id="comment" class="enter"></textarea></td>
								</tr>
								<tr class="d_day">
									<th>배송희망일</th>
									<td>
										<select name="deliv_pree_day1" size="1" class="sel1">
											<? for ($i = date("Y"); $i <= date("Y") + 1; $i++) { ?><option value="<?= $i ?>"><?= $i ?></option><? } ?><option value="0" selected>선택</option>
										</select>
										<span>년</span>
										<select name="deliv_pree_day2" size="1" class="sel2">
											<? for ($i = 1; $i < 13; $i++) { ?><option value="<?= $i ?>"><?= $i ?></option><? } ?><option value="0" selected>선택</option>
										</select>
										<span>월</span>
										<select name="deliv_pree_day3" size="1" class="sel2">
											<? for ($i = 1; $i < 32; $i++) { ?><option value="<?= $i ?>"><?= $i ?></option><? } ?><option value="0" selected>선택</option>
										</select>
										<span>일</span>
										<span class="ment">(※ 희망일은 주문일보다 3일 이후로 선택 가능합니다.)</span>
									</td>
								</tr>
							</table>
						</div>
						<!--//배송지정보-->
					</form>
					<div class="bottom_btn">
						<a href="javascript:sendit();">주문서작성완료</a>
					</div>
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
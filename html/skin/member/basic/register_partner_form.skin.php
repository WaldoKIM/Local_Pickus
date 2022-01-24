<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (!$biztype) {
	$biztype = "1";
}

$sql = " select * from {$g5['content_table']} where co_id = 'privacy' ";
$row = sql_fetch($sql);
$privacy = $row['co_content'];

$sql = " select * from {$g5['content_table']} where co_id = 'provision' ";
$row = sql_fetch($sql);
$provision = $row['co_content'];



$sql = " select * from {$g5['content_table']} where co_id = 'work' ";
$row = sql_fetch($sql);
$work = $row['co_content'];



?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<link rel="stylesheet" type="text/css" href="/css/board.css" />
<link rel="stylesheet" type="text/css" href="/css/member.css" />
<link rel="stylesheet" href="/skin/member/basic/style.css">
<style type="text/css">
	#two_line {
		padding-top: 8px;
	}

	.at-body {
		background-color: #f4f5f9;
	}

	@media(min-width: 600px) {
		.tit_desc br {
			display: none;
		}

		#two_line {
			padding-top: 0;
		}
	}
</style>
<div class="sub_title login">
	<h5>회원 로그인</h5>
	<h1>피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</h1>
</div><!-- sub_title -->

<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">파트너 회원가입</h1>
			<p class="tit_desc">홈페이지의 다양한 정보와 맞춤 서비스를<br /> 이용하시려면 회원가입이 필요합니다.</p>
		</div><!-- sub_title -->
		<div class="join_wrap">
			<div class="form_wrap">

				<form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="w" value="<?php echo $w ?>">
					<input type="hidden" name="url" value="<?php echo $urlencode ?>">
					<input type="hidden" id="mb_biz_type" name="mb_biz_type" value="<?php echo $biztype ?>">
					<input type="hidden" name="mb_level" value="1">
					<input type="hidden" name="mb_id">
					<input type="hidden" name="mb_name">
					<input type="hidden" name="mb_password">
					<input type="hidden" name="mb_password_type" value="md5">
					<input type="hidden" name="mb_biz_goods_item">
					<input type="hidden" name="mb_biz_goods_year">
					<input type="hidden" name="mb_biz_remove_item">
					<input type="hidden" name="mb_biz_remove_etc">
					<input type="hidden" name="mb_biz_charge_rate" value="10">

					<div class="form-group">
						<ul class="way" id="divBizType">
							<li class="current col-xs-4" data-tab="tab1">
								<a href="#none">재활용 센터</a>
							</li>
							<li class="col-xs-4" data-tab="tab2">
								<a href="#none">철거업체</a>
							</li>
							<li class="col-xs-4" id="two_line" data-tab="tab3">
								<a href="#none">센터, 업체 둘다</a>
							</li>
						</ul>
					</div>

					<div class="form-group">
						<input type="text" id="mb_biz_name" name="mb_biz_name" aria-describedby="센터이름" placeholder="센터이름">
						<p class="input_error error" id="lbl_bizname">8-16자 영문과 숫자를 조합해 주세요</p>
					</div><!-- 센터이름 -->

					<div class="form-group text-right">
						<input type="text" id="mb_email" name="mb_email" aria-describedby="이메일" placeholder="이메일">
						<p class="input_error error" id="lbl_email">8-16자 영문과 숫자를 조합해 주세요</p>
						<label name="sendAgree_lbl">
							<input type="checkbox" id="sendAgree" name="email" /><i></i>&nbsp;&nbsp;피커스의 다양한 정보메일 수신 하겠습니다.
						</label>
					</div><!-- 이메일 -->

					<div class="form-group">
						<input type="password" id="password_new" name="password_new" aria-describedby="비밀번호 (영문, 숫자 조합 8-16)" placeholder="비밀번호 (영문, 숫자 조합 8-16)">
						<p class="input_error error" id="lbl_password">8-16자 영문과 숫자를 조합해 주세요</p>
					</div><!-- 비밀번호 -->

					<div class="form-group">
						<input type="password" id="password_new_c" name="password_new_c" aria-describedby="비밀번호 확인 (영문, 숫자 조합 8-16)" placeholder="비밀번호 확인 (영문, 숫자 조합 8-16)">
						<p class="input_error error" id="lbl_passwordConfirm">8-16자 영문과 숫자를 조합해 주세요</p>
					</div><!-- 비밀번호 확인 -->

					<div class="form-group">
						<input type="text" id="mb_hp" name="mb_hp" aria-describedby="센터전화번호" placeholder="센터전화번호">
						<p class="input_error error" id="lbl_phone">8-16자 영문과 숫자를 조합해 주세요</p>
					</div><!-- 센터전화번호 -->

					<div class="form-group">
						<ul class="row">
							<li style="padding-right: 5px;" class="col-xs-4 col-md-3"><input type="text" id="mb_biz_post" name="mb_biz_post" aria-describedby="우편번호" placeholder="우편번호" readonly></li>
							<li style="padding: 0 5px; max-width: 51.33%;" class="col-xs-5 col-md-7"><a href="javascript:doSearchPost1()"><input type="text" id="mb_biz_addr1" name="mb_biz_addr1" aria-describedby="센터주소" placeholder="센터주소" readonly></a></li>
							<li style="padding: 0 5px;" class="col-xs-3 col-md-2">
								<a href="javascript:doSearchPost1()" class="main_bg form_btn">검색</a>
							</li>
						</ul>
						<p class="input_error error" id="lbl_bizAddr1">8-16자 영문과 숫자를 조합해 주세요</p>
					</div><!-- 센터주소 -->
					<div class="form-group">
						<div id="wrap" style="display:none;border:1px solid;width:90%;height:300px;margin:5px 0;position:relative">
							<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="width:40px;cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
						</div>
						<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

						<script>
							// 우편번호 찾기 찾기 화면을 넣을 element
							var element_wrap = document.getElementById('wrap');

							function foldDaumPostcode() {
								// iframe을 넣은 element를 안보이게 한다.
								element_wrap.style.display = 'none';
							}

							function doSearchPost1() {
								// 현재 scroll 위치를 저장해놓는다.
								var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
								new daum.Postcode({
									oncomplete: function(data) {
										// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

										// 각 주소의 노출 규칙에 따라 주소를 조합한다.
										// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
										var addr = ''; // 주소 변수
										var extraAddr = ''; // 참고항목 변수

										//사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
										if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
											addr = data.roadAddress;
										} else { // 사용자가 지번 주소를 선택했을 경우(J)
											addr = data.jibunAddress;
										}

										// 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
										if (data.userSelectedType === 'R') {
											// 법정동명이 있을 경우 추가한다. (법정리는 제외)
											// 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
											if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
												extraAddr += data.bname;
											}
											// 건물명이 있고, 공동주택일 경우 추가한다.
											if (data.buildingName !== '' && data.apartment === 'Y') {
												extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
											}
											// 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
											if (extraAddr !== '') {
												extraAddr = ' (' + extraAddr + ')';
											}

										}

										// 우편번호와 주소 정보를 해당 필드에 넣는다.
										$('#mb_biz_post').val(data.zonecode); //5자리 새우편번호 사용
										$('#mb_biz_addr1').val(addr);
										// iframe을 넣은 element를 안보이게 한다.
										// (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
										element_wrap.style.display = 'none';

										// 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
										document.body.scrollTop = currentScroll;
									},
									// 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
									onresize: function(size) {
										element_wrap.style.height = size.height + 'px';
									},
									width: '100%',
									height: '100%'
								}).embed(element_wrap);

								// iframe을 넣은 element를 보이게 한다.
								element_wrap.style.display = 'block';
							}
						</script>
					</div><!-- 상세주소 -->
					<div class="form-group">
						<input type="text" id="mb_biz_addr2" name="mb_biz_addr2" aria-describedby="상세주소" placeholder="상세주소">
					</div><!-- 정산계좌 -->
					<div class="form-group">
						<input type="hidden" name="mb_bank" id="mb_bank" value="NH농협">
						<select id="mb_bank_select">
							<option value="NH농협">NH농협</option>
							<option value="우리은행">우리은행</option>
							<option value="국민은행">국민은행</option>
							<option value="기업은행">기업은행</option>
							<option value="신한은행">신한은행</option>
							<option value="하나은행">하나은행</option>
							<option value="SC은행">SC은행</option>
							<option value="카카오뱅크">카카오뱅크</option>
							<option value="산업은행">산업은행</option>
							<option value="대구은행">대구은행</option>
							<option value="광주은행">광주은행</option>
							<option value="전북은행">전북은행</option>
							<option value="한국씨티은행">한국씨티은행</option>
							<option value="부산은행">부산은행</option>
							<option value="수협은행">수협은행</option>
							<option value="경남은행">경남은행</option>
							<option value="기타은행입력">기타은행입력</option>
						</select>
					</div>
					<div class="form-group">
						<input id="mb_bank_txt" style="display: none" type="text" name="mb_bank_txt" placeholder="은행명">
					</div>

					<div class="form-group">
						<input type="number" id="mb_bank_num" name="mb_bank_num" aria-describedby="계좌번호" placeholder="정산계좌번호">
					</div>
					<div class="form-group">
						<input type="number" id="mb_biz_num" name="mb_biz_num" aria-describedby="사업자번호" placeholder="사업자번호">
					</div><!-- 사업자번호 -->
					<div class="form-group">
						<input type="hidden" id="mb_photo" name="mb_photo">
						<input type="hidden" id="mb_photo_rotate" name="mb_photo_rotate">
						<input type="hidden" id="mb_photo_site" name="mb_photo_site">
						<input type="hidden" id="mb_photo_site_rotate" name="mb_photo_site_rotate">
						<input type="hidden" id="mb_photo_bizcard" name="mb_photo_bizcard">
						<input type="hidden" id="mb_photo_bizcard_rotate" name="mb_photo_bizcard_rotate">
						<ul class="row">
							<li class="col-md-6">
								<div id="divPhotoBizcard" style="display: none;">
									<div class="estimate_image_click_bg">
										<img src="/img/common/estimate_icon_image_info.png" />
										<p>사업자등록증 또는 명함사진</p>
									</div>
								</div>
								<div id="divPhotoSite">

									<div class="estimate_image_click_bg">
										<input href="#none" onClick="doImageSearch('divPhotoSite','photoSite','사업장 정면 또는 내부 사진 업로드');">
										<img src="/img/common/estimate_icon_image_info.png" />
										<p>사업장 정면 또는 내부 사진 업로드</p>
										</a>
									</div>
								</div>
							</li>
							<li class="col-md-6">
								<div id="divPhoto">
									<div class="estimate_image_click_bg">
										<a href="#none" onClick="doImageSearch('divPhoto','photo','담당자사진 업로드');">
											<img src="/img/common/estimate_icon_image_info.png" />
											<p>담당자사진 업로드</p>
										</a>
									</div>
								</div>
							</li>
						</ul>
					</div><!-- 사진업로드 -->

					<div class="form-group">
						<h2 class="txt_title"><span>담당자 정보</span></h2>
					</div>

					<div class="form-group">
						<input type="text" id="mb_biz_worker_name" name="mb_biz_worker_name" aria-describedby="담당자 이름" placeholder="담당자 이름">
						<p class="input_error" id="lbl_bizWorkerName" style="display:none;">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>

					<div class="form-group">
						<input type="text" id="mb_biz_worker_phone" name="mb_biz_worker_phone" aria-describedby="담당자 휴대전화번호" placeholder="담당자 휴대전화번호">
						<p class="input_error" id="lbl_bizWorkerPhone" style="display:none;">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>

					<div class="form-group">
						<textarea id="mb_biz_intro" name="mb_biz_intro" placeholder="업체 소개글 " style="height:270px;"></textarea>
						<p class="input_error" id="lbl_intro" style="display:none;">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>

					<div class="form-group">
						<h2 class="txt_title"><span>맞춤 견적 설정</span></h2>
					</div>

					<div id="area" class="form-group">

						<div class="row title">
							<div class="col-xs-4 main_co">수거 / 철거 주 지역</div>
							<p class="col-xs-8 text-right">* 여러 지역 설정이 가능합니다.</p>
						</div>

						<div class="row">
							<div class="col-xs-4">
								<select id="area1" name="area1">
									<option>시/도</option>
								</select>
							</div>
							<div class="col-xs-4">
								<select id="area2" name="area2">
									<option>시/구/군</option>
								</select>
							</div>
							<div class="col-xs-4">
								<a class="main_bg form_btn" href="javascript:doSaveArea()">지역 추가</a>
							</div>
							<div class="col-xs-12" id="divArea">

							</div>
						</div>

					</div><!-- 지역 -->

					<div id="divGoodsItemList" class="ch_list form-group tab1 tab3 tabcontent current">
						<div class="row title">
							<div class="col-xs-4 main_co">매입품목/년식 설정</div>
							<p class="col-xs-8 text-right">* 여러 품목 지정 설정이 가능합니다.</p>
						</div>

						<div class="row" id="divGoodsItem">
						</div><!-- row -->
					</div><!-- 매입품목 -->

					<div id="divRemoveItemList" class="form-group tab2 tab3 tabcontent current">

						<div class="row title">
							<div class="col-xs-4 main_co">철거품목</div>
							<div class="col-xs-8 text-right">* 여러 품목 지정 설정이 가능합니다.</div>
						</div>
						<div id="divRemoveItem">


						</div>
					</div><!-- 철거품목 -->
					<div class="form-group">
						<label for="matchAgree" name="matchAgree_lbl">
							<input type="checkbox" name="matchAgree" id="matchAgree" value="1" style="display:none;" /><i></i>&nbsp;&nbsp;중고 물품 판매도 하고싶어요
						</label>
					</div>
					<div class="form-group">
						<label for="pbAgree" name="pbAgree_lbl">
							<input type="checkbox" id="pbAgree" /><i></i>&nbsp;&nbsp;본인은
							<a class="main_co" href="#" data-toggle="modal" data-target="#terms">이용약관</a> 및
							<a class="main_co" href="#" data-toggle="modal" data-target="#privacy">개인정보보호방침</a>,
							<a class="main_co" href="#" data-toggle="modal" data-target="#work">업무제휴</a>
							에 대한 내용을 모두 이해하였으며 이에 동의합니다.
						</label>
					</div>

					<div class="btn_wrap">
						<ul class="col-md-4 col-md-offset-4">
							<li><input class="main_bg" type="button" onclick="fregisterform_submit()" value="회원가입 하기"></li>
						</ul>
					</div>
				</form>

			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->
<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">이용약관</h4>
			</div>
			<div class="modal-body">
				<div class="scroll">
					<?php echo $provision ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- 이용약관 -->

<div class="modal fade" id="privacy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">개인정보보호방침</h4>
			</div>
			<div class="modal-body">
				<div class="scroll">
					<?php echo $privacy ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- 개인정보보호방침 -->

<div class="modal fade" id="work" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">업무제휴</h4>
			</div>
			<div class="modal-body">
				<div class="scroll">
					<?php echo $work ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- 업무제휴 -->

<script>
	var vBizType;
	jQuery(document).ready(function() {
		doInitImageAjax("mb_photo", "divPhoto", "담당자 사진");
		doInitImageAjax("mb_photo_site", "divPhotoSite", "사업장 정면 또는 내부 사진");
		vBizType = $("#mb_biz_type").val();
		cfnBizTypes("divBizType", vBizType, "./register_partner_form.php");
		cfnGoodsItem("divGoodsItem", "가전", "2006년");
		cfnRemoveItem("divRemoveItem", "", "");

		$('#mb_bank_select').change(function() {
			if ($(this).val() == '기타은행입력') {
				$('#mb_bank_txt').css('display', 'block');
				$("#mb_bank").val('');
			} else {
				$('#mb_bank_txt').css('display', 'none');
				$("#mb_bank").val($(this).val());
			}
		});

		if (vBizType == "1") {
			$("#divGoodsItemList").show();
			$("#divRemoveItemList").hide();
		} else if (vBizType == "2") {
			$("#divRemoveItemList").show();
			$("#divGoodsItemList").hide();
		} else if (vBizType == "3") {
			$("#divGoodsItemList").show();
			$("#divRemoveItemList").show();
		}

		$('input[name="goodsItem"]').click(function() {
			var vId = $(this).attr('id');
			var vIdx = vId.replace("goodsItem", "");
			var vValue = $(this).val();
			if ($(this).is(':checked')) {
				if (vValue == "모두수거") {
					$("input:checkbox[name='goodsItem']").each(function() {
						this.checked = true;
					});
					for (var i = 0; i < cfnGoodsItemLength() - 1; i++) {
						$("#goodsYear" + i).show();
						$("#goodsYear" + vIdx).val("1");
					}
				}
				$("#goodsYear" + vIdx).show();
				$("#goodsYear" + vIdx).val("1");
			} else {
				if (vValue == "모두수거") {
					$("input:checkbox[name='goodsItem']").each(function() {
						this.checked = false;
					});
					for (var i = 0; i < cfnGoodsItemLength() - 1; i++) {
						$("#goodsYear" + i).hide();
					}
				}
				$("#goodsYear" + vIdx).hide();
			}

		});

		$('#goodsYear4').change(function() {
			var vValue = $(this).val();
			for (var i = 0; i < cfnGoodsItemLength() - 1; i++) {
				$("#goodsYear" + i).val(vValue);
			}
		});

		$('input[name="removeItem"]').click(function() {
			var vValue = $(this).val();
			var vId = $(this).attr('id');
			var vIdx = vId.replace("removeItem", "");
			var vSeq = cfnRemoveItemLength();
			if (vIdx == vSeq) {
				$("#removeEtc").val("");
				if ($(this).is(':checked')) {
					$("#removeEtc").show();
				} else {
					$("#removeEtc").hide();
				}
			}

			if ($(this).is(':checked')) {
				if (vValue == "모두철거") {
					$("input:checkbox[name='removeItem']").each(function() {
						this.checked = true;
					});
					$("#removeEtc").val("");
					$("#removeEtc").show();
				}
			} else {
				if (vValue == "모두철거") {
					$("input:checkbox[name='removeItem']").each(function() {
						this.checked = false;
					});
					$("#removeEtc").val("");
					$("#removeEtc").hide();
				}
			}
		});

		$("#mb_hp").inputFilter(function(value) {
			return /^\d*$/.test(value);
		});

		$("#mb_biz_worker_phone").inputFilter(function(value) {
			return /^\d*$/.test(value);
		});

		doSelectArea1();

	});

	function doSelectArea1() {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.area1.php",
			data: {
				"area1": $('#area1').val()
			},
			cache: false,
			success: function(data) {
				var fvHtml = "<option value=\"\" selected>시/도</option>";
				fvHtml += data;
				$("#area1").html(fvHtml);
				fvHtml = "<option value=\"\" selected>시/구/군</option>";
				$("#area2").html(fvHtml);
				$('#area1').change(function() {
					doSelectArea2();
				});
			}
		});
	}

	function doSelectArea2() {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.area2.php",
			data: {
				"area1": $('#area1').val()
			},
			cache: false,
			success: function(data) {
				var fvHtml = "";
				if ($("#area1").val()) {
					fvHtml += "<option value=\"\" selected>" + $("#area1").val() + " 전체</option>";
				} else {
					fvHtml += "<option value=\"\" selected>시/도</option>";
				}
				fvHtml += data;
				$("#area2").html(fvHtml);

			}
		});
	}

	function doSaveArea() {
		if (!$("#area1").val()) {
			alert("시/도를 선택하십시오.");
			return;
		}

		var area1 = $("#area1").val();
		var area2 = $("#area2").val();

		var vHtml = "";
		vHtml += "<p class='signup_txt_area'>";
		vHtml += "<input type='hidden' name='mb_area1[]' value='" + area1 + "'>";
		vHtml += "<input type='hidden' name='mb_area2[]' value='" + area2 + "'>";
		vHtml += area1 + " " + cfNvl2(area2, "전체");
		vHtml += "&nbsp;&nbsp;";
		vHtml += "<a href='javascript:' class='remove_area'>";
		vHtml += "<i class='xi-close-min'></i>";
		vHtml += "</a></p>";
		//vHtml += "</p>";
		$("#divArea").append(vHtml);
		$('.remove_area').click(function() {
			var $el = $(this).closest(".signup_txt_area");
			$el.remove();
		})
	}

	function fregisterform_submit() {
		//return false;

		var f = document.fregisterform;
		if (!checkFields()) return false;

		f.mb_name.value = f.mb_biz_name.value;

		var mb_email = f.mb_email.value;
		$.ajax({
			type: "POST",
			url: "<?php echo G5_BBS_URL ?>/ajax.mb_email.php",
			data: {
				"mb_email": mb_email
			},
			cache: false,
			async: false,
			success: function(data) {
				f.mb_id.value = f.mb_email.value;

				f.mb_password.value = hex_md5(f.password_new.value);

				//alert(f.mb_id.value);
				var goodsItem = "";
				var goodsYear = "";

				if (vBizType == "1" || vBizType == "3") {
					$('input[name="goodsItem"]:checked').each(function(index, item) {
						if (index != 0) {
							goodsItem += ",";
							goodsYear += ",";
						}
						goodsItem += $(this).val();

						var vId = $(this).attr('id');
						var vIdx = vId.replace("goodsItem", "");

						if ($("#goodsYear" + vIdx).val()) {
							goodsYear += $("#goodsYear" + vIdx).val();
						} else {
							goodsYear += "0";
						}
					});
				}

				var removeItem = "";
				var removeEtc = "";
				if (vBizType == "2" || vBizType == "3") {
					$('input[name="removeItem"]:checked').each(function(index, item) {
						if (index != 0) {
							removeItem += ",";
						}
						removeItem += $(this).val();
					});
					removeEtc = $("#removeEtc").val();
				}


				f.mb_biz_goods_item.value = goodsItem;
				f.mb_biz_goods_year.value = goodsYear;
				f.mb_biz_remove_item.value = removeItem;
				f.mb_biz_remove_etc.value = removeEtc;

				//return false;
				f.submit();
			}
		});

		checkFields(f);


	}

	function checkFields() {

		removeClass();

		if (!$("#mb_biz_name").val()) {
			alert("센터이름을 입력해주세요.");
			return false;
		}

		if (!$("#mb_email").val()) {
			alert("이메일을 입력해주세요.");

			return false;
		}

		if (!this.validateEmail($("#mb_email").val())) {
			alert("올바른 이메일형식을 입력해주세요.");
			return false;
		}

		if (!$("#password_new").val()) {
			alert("비밀번호를 입력해주세요.");
			return false;
		}

		if ($("#password_new").val() != $("#password_new_c").val()) {
			alert("비밀번호와 비밀번호 확인이 일치하지 않습니다.")
			return false;
		}

		if ($("#password_new").val().length < 8 || $("#password_new").val().length > 15) {
			alert('비밀번호는 8자 이상 15자 이하입니다.')
			return false;
		}


		if (!$("#mb_hp").val()) {
			alert('전화번호를 입력해주세요.');
			return false;
		}


		if (!$("#mb_biz_addr1").val()) {
			alert('센터주소를 입력해주세요.');
			return false;
		}

		if (!$("#mb_biz_addr2").val()) {
			alert('센터상세주소를 입력해주세요.');
			return false;
		}

		if (!$("#mb_biz_worker_name").val()) {
			alert('담당자 이름을 입력해주세요.');
			return false;
		}

		if (!$("#mb_biz_worker_phone").val()) {
			alert('담당자 휴대전화번호를 입력해주세요.');
			return false;
		}
		if (!$("#mb_biz_num").val()) {
			alert('사업자번호를 입력해주세요.');
			return false;
		}
		if (!$("#mb_biz_intro").val()) {
			alert('업체 소개글을 입력해주세요.');
			return false;
		}

		if (!cfnNullCheckSelect($("#mb_photo_site").val(), "사업장사진")) return false;
		if (!cfnNullCheckSelect($("#mb_photo").val(), "담당자사진")) return false;

		/*	var msg = reg_mb_email_check($("#mb_email").val());
		    if (msg) {
		        alert(msg);
		        return false;
		    }	*/

		if (!$("#pbAgree").prop("checked")) {
			alert("이용약관에 동의해주세요!");
			return false;
		}
		return true;
	}

	function removeClass() {
		$("#lbl_bizname").hide();
		$("#lbl_email").hide();
		$("#lbl_password").hide();
		$("#lbl_passwordConfirm").hide();
		$("#lbl_phone").hide();
		$("#lbl_bizAddr1").hide();
		$("#lbl_bizAddr2").hide();
		$("#lbl_bizWorkerName").hide();
		$("#lbl_bizWorkerPhone").hide();
		$("#lbl_intro").hide();

		$("#bizname").removeClass("input_error");
		$("#email").removeClass("input_error");
		$("#password").removeClass("input_error");
		$("#passwordConfirm").removeClass("input_error");
		$("#phone").removeClass("input_error");
		$("#bizAddr1").removeClass("input_error");
		$("#bizAddr2").removeClass("input_error");
		$("#bizWorkerName").removeClass("input_error");
		$("#bizWorkerPhone").removeClass("input_error");
		$("#intro").removeClass("input_error");
	}

	function goMove() {
		location.href = "<?php echo G5_URL; ?>";
	}
</script>
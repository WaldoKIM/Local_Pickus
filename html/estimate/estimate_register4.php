<?php
include_once('./_common.php');

include_once(G5_PATH . '/head.php');
$g5['title'] = '견적신청';

if ($member['mb_level'] == '2') {
	alert('업체회원은 이용하실 수 없습니다.');
}
?>
<link rel="stylesheet" type="text/css" href="/css/base2.css?after">
<link rel="stylesheet" type="text/css" href="/css/board2.css" />
<link rel="stylesheet" type="text/css" href="/css/member2.css?after" />
<link rel="stylesheet" type="text/css" href="/css/estimate2.css" />
<link rel="stylesheet" type="text/css" href="/css/new_estimate.css?after" />

<!--GW-전환-견적신청-->
<!-- <script>
	gtag('event', 'conversion', {
		'send_to': 'AW-715468370/chWuCOrEiakBENLclNUC',
		'transaction_id': 'estimate'
	});
</script> -->
<!--NAVER ADS-전환-견적신청-->
<!-- <script type="text/javascript">
	var _nasa = {};
	_nasa["cnv"] = wcs.cnv("4", "100000");
</script> -->

<style type="text/css">
	ul#btm_fixed_bar {
		display: none;
	}

	@media(max-width: 800px) {
		.sub_title {
			padding-top: 10px;
		}

		.sub_title h1 {
			font-size: 26px;
			margin-bottom: 0;
		}

		.form-group {
			margin: 0 !important;
		}

		.btn_cate .col-md-2 {
			width: 25%;
		}

		.sell_single .section_view01 .box input[type="radio"]+i {
			padding: 0px;
		}

		.sell_single .section_view01 .box i p {
			font-size: 12px;
		}

		.btn_cate .col-md-2 {
			padding: 0 5px;
		}

		.form_order {
			padding: 0 25px;
		}

		#content {
			margin-top: 15px;
		}

		.form-group h2.txt_title {
			margin-top: 1em;
		}
	}

	h5.guide_title {
		font-size: 14px !important;
		font-weight: 800 !important;
		font-stretch: normal !important;
		font-style: normal !important;
		line-height: normal !important;
		letter-spacing: normal !important;
		text-align: left !important;
		color: #333333 !important;
		margin-bottom: 15px !important;
	}

	ul.guide_content>li {
		font-size: 14px;
		font-weight: 800;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #333333;
		margin-bottom: 10px;
	}

	em.em_nu {
		color: #0b71c8;
	}

	em.em_un {
		color: #333333;
		border-bottom: 2px solid #0b71c8;
	}
</style>

<div id="process_banner" style="width: 100%; height:450px;">
	<div style="
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-left: 30%; padding-top:7%;">
		<p style="color:#fff;  font-weight: 800;
  font-stretch: normal;
  font-style: normal;
  line-height: normal;
  letter-spacing: normal;text-align:cetner; font-size:24px; margin-bottom:30px;">우리동네 재활용센터 '피커스'</p>
		<p style="color:#fff; text-align:cetner; font-size:20px; margin-bottom:10px;">중고 전문가와 함께 하는 안심거래부터 공간정리까지</p>
		<p style="color:#fff; text-align:cetner; font-size:20px;">총 견적가 : 6,719,266,000원 || 총 파트너 : 230명</p>
	</div>
</div>

<div style="margin-top:65px;" id="margin" class="form_estimate layout_estimate">

	<div class="request">
		<div class="form_wrap layout_wrap">
			<form name="frmregister" action="<?php echo G5_URL; ?>/estimate/estimate_register4_update.php" method="post" enctype="multipart/form-data" autocomplete="off" class="form_order sell_single process_margin layout_form">
				<input type="hidden" name="sub_key" value="<?php echo time(); ?>">
				<input type="hidden" name="e_type" value="3">
				<input type="hidden" name="simple_yn" value="0">
				<input type="hidden" name="test_type" value="A">

				<?php
				$readonly = "";
				if ($is_member) {
					$readonly = "readonly";
				}
				?>
				<!--==================================섹션1====================================-->
				<div class="form_section section_view01">
					<div class="header">
						<div class="container_sub_title">
							<p>원스톱 중고매입+철거</p>
						</div>
						<div>
							<!-- <div class="progress">
								<div style="width:0%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>0%</p>
							</div> -->
							<div class="container_title">
								<p>기업고객전용 서비스</p>
							</div>
						</div>
					</div>
					<!--================섹션 - 입력 영역===============-->
					<div class="form_wrap" id="divNotLogin">
						<div>
							<hr class="hr">
							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										이름
									</li>
									<li class="col-md-9">
										<input type="text" name="nickname" id="nickname" aria-describedby="이름" placeholder="이름" value="<?php echo $member['mb_name'] ?>" <?php echo $readonly ?>>
										<p class="input_error error" id="lbl_nickname">8-16자 영문과 숫자를 조합해 주세요</p>
									</li>
								</ul>

							</div>
							<hr class="hr">
							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										이메일
									</li>
									<li class="col-md-9">
										<input type="text" name="email" id="email" aria-describedby="이메일" placeholder="이메일" value="<?php echo $member['mb_email'] ?>" <?php echo $readonly ?>>
										<p class="input_error error" id="lbl_email">8-16자 영문과 숫자를 조합해 주세요</p>
									</li>
								</ul>

							</div>
							<hr class="hr">
							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										휴대폰 번호
									</li>
									<li class="col-md-9">
										<input type="number" name="phone" id="phone" aria-describedby="휴대폰 번호" placeholder="숫자만 입력해주세요" value="<?php echo $member['mb_hp'] ?>">
										<p class="input_error error" id="lbl_phone">8-16자 영문과 숫자를 조합해 주세요</p>
									</li>
								</ul>

							</div>

						</div>
					</div><!-- form_wrap -->
					<hr class="hr">
					<div class="form-group">
						<ul>
							<li class="title">
								참고사항
							</li>
							<li>
								<textarea id="content" name="content" placeholder="- 처분하실 매입 품목을 간단히 작성해 주세요.
- 처리하실 철거 내역을 간단히 작성해 주세요."></textarea>
								<!-- <p class="text-right red_co">*물품에 대해 상세히(스크래치, 문콕 등) 작성해 주시면 좀 더 정확한 견적을 받을 수 있습니다.</p> -->
							</li>
						</ul>
					</div>
					<?php
					if (!$is_member) {
					?>
						<div style="margin-top:10px !important; margin-bottom:10px !important;" class="form-group">
							<label for="pbAgree" name="pbAgree_lbl">
								<input type="checkbox" style="display: none;" id="pbAgree" /><i></i>&nbsp;&nbsp;본인은
								<a class="main_co" href="#" data-toggle="modal" data-target="#terms">이용약관</a> 및
								<a class="main_co" href="#" data-toggle="modal" data-target="#privacy">개인정보보호방침</a>에 대한 내용을 모두 이해하였으며 이에 동의합니다.
							</label>
						</div>
					<?php
					}
					?>
					<hr class="hr">
					<p class="btng_bottom">

						<a href="#" class="next_section_btn end_btn" name="click_et" onclick="doRegistEstimate();">견적신청하기</a>
					</p>

				</div>
				<!--==================================섹션1끝====================================-->
				<script>
					$("a[name='click_et']").click(function() {

						$('#load').show();

						return true;

					});
				</script>

				<div style="display:none;" id="load">
					<p class="loading_font">견적신청중...</p>
				</div>

				<style type="text/css">
					@media(max-width:768px) {
						.loading_font {
							font-size: 24px;
							font-weight: 800;
							color: #1379cd;
							margin: auto;
							margin-top: 70%;
							opacity: 1 !important;
						}

						#load {
							width: 100%;
							height: 100%;
							top: 0;
							left: 0;
							position: fixed;
							display: block;
							opacity: 0.8;
							background: white;
							z-index: 99999999;
							text-align: center;
						}
					}

					@media(min-width:768px) {
						.loading_font {
							font-size: 24px;
							font-weight: 800;
							color: #1379cd;
							margin: auto;
							margin-top: 20%;
							opacity: 1 !important;
						}

						#load {
							width: 100%;
							height: 100%;
							top: 0;
							left: 0;
							position: fixed;
							display: block;
							opacity: 0.8;
							background: white;
							z-index: 99999999;
							text-align: center;
						}
					}
				</style>


			</form>

			<!--스텝별 가이드-->
			<div class="section_view01" id="process_text">
				<div class="process_text_flex">
					<div class="step_guide_content">
						<p class="step_guide_title">피커스는?</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<div class="step_guide_subtitle">
								중고 가전/가구 무료견적, 철거/원상 복구 비교서비스이며 다양한 전문가들을 통해서 서비스를 제공해드리고 있습니다.</div>
						</div>
					</div>
					<div class="step_guide_content">
						<p class="step_guide_title">보상제외 가전은?</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">
								고장 및 파손으로 인한 작동이 불가능한 가전</p>
						</div>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">빌트인가전(가구와 함께 인테리어 된 가전)</p>
						</div>
					</div>
					<div class="step_guide_content">
						<p class="step_guide_title">보상가 감가 사유는?</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">사다리차 이용 및 엘리베이터 유/무에 따른 사유</p>
						</div>
					</div>
				</div>
			</div>


			<!--스텝별 가이드 끝-->
		</div>
		<!--form_wrap 끝-->
	</div>
	<!--request 끝-->
	<div class="step_layout">
		<div style="width:100%; margin-bottom:50px;">
			<p class="step_img_title" style="color:#555; text-align: center;">신속하고 간편하게 무료 비교 견적을 원할 땐
				＇피커스＇에게 맡기세요!</p>
		</div>
		<div style="width:240px" class="step_img_margin">
			<p class="step_img_title">1. 간편하게 무료견적신청!</p>
			<img class="step_img" src="/estimate/img/pick1.png">
			<p class="step_img_subtitle">PC, 모바일 상관없이 5분안에 쉽고 빠른 과정을 통해서 간편하게 신청 가능합니다.</p>
		</div>
		<div style="width:271px" class="step_img_margin">
			<p class="step_img_title">2. 다양한 견적을 고르고 선택!</p>
			<img class="step_img" src="/estimate/img/pick2.png">
			<p class="step_img_subtitle">원하시는 파트너님을 선택하시면 파트너님이 고객님께 연락드려서 작업일정을 조율합니다.</p>
		</div>
		<div style="width:311px" class="step_img_margin">
			<p class="step_img_title">3. 전문가를 통해 안전하고 빠르게!</p>
			<img class="step_img" src="/estimate/img/pick3.png">
			<p class="step_img_subtitle">수거일에 맞춰 파트너님들이 직접 방문하셔서 안전하고 빠르게 수거 완료 후 계좌 또는 현금으로 정산됩니다!</p>
		</div>
	</div>
</div>





<script type="text/javascript">
	function doRegistEstimate() {
		var f = document.frmregister;

		if (!cfnNullCheckInput($("#nickname").val(), "이름"))
			return;
		if (!cfnNullCheckInput($("#email").val(), "이메일"))
			return;
		if (!cfnNullCheckInput($("#phone").val(), "연락처"))
			return;
		<?php
		if (!$is_member) {
		?>
			if (!validateEmail($("#email").val())) {
				alert("이메일 형식이 잘못되었습니다.");
				return false;
			}

			if (!$("#pbAgree").prop("checked")) {
				alert("이용약관에 동의해주세요!");
				return false;
			}
		<?php
		}
		?>
		if (!cfnNullCheckInput($("#content").val(), "참고사항"))
			return;
		$(".layer").removeClass("hidden");

		var f = document.frmregister;
		f.submit();
	}

	function goMove() {
		location.href = "<?php echo G5_URL; ?>/estimate/estimate_register.php";
	}
</script>
<?php
include_once(G5_PATH . '/tail.php');
?>
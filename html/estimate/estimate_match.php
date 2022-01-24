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
<link rel="stylesheet" type="text/css" href="/css/estimate2.css?after" />
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
	.btn_add_price div {
		display: inline-block;
		cursor: pointer;
		font-size: 10px;
		border: 1px solid #ededed;
		padding: 5px 10px;
	}

	div#multiList {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: space-between;
	}

	.btn_add_price {
		margin: auto;
		margin-top: 15px;
	}

	.form_new.add_pro {
		width: 100%;
		margin-top: 20px;
		border: 3px solid #0b71c8;
		margin-left: 5px;
		margin-right: 5px;
		border-radius: 10px;
		padding: 5px;
		text-align: center;
		display: flex;
		flex-wrap: nowrap;
		align-items: center;
		justify-content: space-around;
	}

	a.form_btn.line_bg.delete_item {
		padding: 5px;
		border-radius: 10px;
		font-weight: 800 !important;
	}

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

	#add_goods {
		display: flex;
		justify-content: center;
		margin-left: auto;
		margin-right: auto;
		margin-top: 20px;
		width: 50%;
		font-weight: 800;
		background-color: #0b71c8;
		height: 40px;
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
			<form style="height:100%;" class="form_order sell_single process_margin layout_form" action="/estimate/estimate_match_update.php" method="post" name="form_match">
				<input type="hidden" name="no_estimate" value="<?php echo time(); ?>">


				<!--==================================섹션1====================================-->
				<div class="form_section" id="section1">
					<div class="header">
						<div class="container_sub_title">
							<p>구매정보입력</p>
						</div>
						<div>
							<div class="progress">
								<div style="width:0%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>0%</p>
							</div>
							<div class="container_title">
								<p>구매정보를 알려주세요!</p>
							</div>

						</div>
					</div>
					<!--===================섹션 - 입력 영역==================-->
					<div class="form_section_value">
						<hr class="hr">
						<div class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									제목
								</li>
								<li class="col-md-9 col-xs-8">
									<input placeholder="제목" type="text" name="title" id="tit_req">
								</li>
							</ul>
							<hr class="hr">
						</div>
						<div class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									카테고리
								</li>
								<li class="col-md-9 col-xs-8">
									<select name="item_cat" id="cate">
										<option value="\">선택</option>
										<option value="가전">가전</option>
										<option value="주방집기">주방집기</option>
										<option value="헬스용품">헬스용품</option>
										<option value="가구">가구</option>
										<option value="기타">기타</option>
									</select>
								</li>
							</ul>
							<hr class="hr">
						</div>
						<div class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									세부카테고리
								</li>
								<li class="col-md-9 col-xs-6">
									<input type="hidden" name="item_cat_dtl" id="item_cat_dtl">
									<select name="item_cat_dtl_s" id="item_cat_dtl_s"></select>
									<input type="text" id="item_cat_dtl_etc" name="item_cat_dtl_etc" placeholder="세부카테고리를 입력해주세요!" style="max-width: 86%;display:none;">
								</li>
							</ul>
							<hr class="hr">
						</div>

						<div class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									<span style="line-height: 25px !important;" class="title">구매수량</span>
								</li>
								<li class="col-md-9 col-xs-6">

									<input type="number" min="1" id="qty" placeholder="수량을 입력해주세요!">
								</li>
							</ul>
						</div>
						<input type="button" name="add_goods" id="add_goods" value="+추가">
						<hr class="hr">
						<div id="multiList">
						</div>

					</div>
					<!--===================섹션 - 입력 영역 끝==================-->

					<p class="btng_bottom">
						<a href="#" class="next_section_btn first_btn" onclick="pre_section_btn()" style="left:25%; background: #fff; height:50px;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn third_btn" onclick="next_section_btn()">다음</a>
					</p>
				</div>
				<!--==================================섹션1끝====================================-->


				<!--==================================섹션2====================================-->
				<div style="display:none;" class="form_section" id="section2">

					<div class="header">
						<div class="container_sub_title">
							<p>예산선택</p>
						</div>
						<div>
							<div class="progress">
								<div style="width:20%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>20%</p>
							</div>
							<div class="container_title">
								<p>구매예산을 알려주세요!</p>
							</div>
						</div>
					</div>
					<!--================섹션 - 입력 영역===============-->
					<div class="form_section_value">
						<hr class="hr">
						<div class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									<span style="line-height: 25px !important;" class="title">구매예산</span>
								</li>
								<li class="col-md-9 col-xs-6">
									<input type="number" placeholder="구매예산을 입력해주세요!" name="price" id="price">
								</li>
							</ul>

							<div class="btn_add_price">
								<div id="one_add">+ 1,000</div>
								<div id="two_add">+ 10,000</div>
								<div id="three_add">+ 100,000</div>
								<div id="four_add">+ 1,000,000</div>
							</div>
						</div>
						<div style="margin-top:30px;" class="form_section_value">
							<div class="form-group">
								요청사항을 작성해주세요!
								<ul style="margin-top: 1.3%;">
									<li>
										<textarea id="etc_req" name="etc_req" placeholder="원하시는 물품에 대해 상세히 작성해 주시면 좀 더 정확한 매칭이 가능합니다. "></textarea>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<hr class="hr">



					<p class="btng_bottom">
						<a href="#" class="next_section_btn second_btn" onclick="pre_section_btn()" style="left:25%; background: #fff;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn fourth_btn" onclick="next_section_btn()">다음</a>
					</p>
				</div>
				<!--==================================섹션2끝====================================-->


				<!--==================================섹션3====================================-->
				<div style="display:none;" class="form_section" id="section3">

					<div class="header">
						<div class="container_sub_title">
							<p>구매환경입력</p>
						</div>
						<div>
							<div class="progress">
								<div style="width:40%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>40%</p>
							</div>
							<div class="container_title">
								<p>구매환경을 알려주세요!</p>
							</div>
						</div>
					</div>

					<!--=================섹션 - 입력 영역===================-->
					<div class="form_section_value">
						<div class="form-group address">
							<ul class="row">
								<li class="col-md-2 title">시.도</li>
								<li class="col-md-9 col-xs-6">
									<select id="area1" name="area1">
										<option value="" selected="selected">선택</option>
									</select>
								</li>

							</ul>
						</div>
						<hr class="hr">
						<div class="form-group address">
							<ul class="row">
								<li class="col-md-2 title">구.군</li>
								<li class="col-md-9 col-xs-6">
									<select id="area2" name="area2">
										<option value="" selected="selected">선택</option>
									</select>
								</li>
							</ul>
						</div>
						<hr class="hr">
						<div style="padding-top:15px;" class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									읍.면.동
								</li>
								<li class="col-md-9 col-xs-8">
									<input type="text" placeholder="읍.면.동을 입력해주세요" name="place" id="place">
								</li>
							</ul>
						</div>
						<hr class="hr">
						<div class="form-group qs">
							<div class="col-md-2 title" style="margin-top: 15px;">
								엘리베이터 유무를 알려주세요!
							</div>
							<ul style="justify-content: center;" class="row adr">

								<li class="col-md-2 col-xs-6 btn_check">
									<label class="box"><input type="radio" name="elevator_yn" id="elevator_yn1" onchange="setDisplay()" value="엘리베이터 있음" checked /><i>유</i></label>
								</li>
								<li class="col-md-2 col-xs-6 btn_check">
									<label class="box"><input type="radio" name="elevator_yn" id="elevator_yn2" onchange="setDisplay()" value="엘리베이터 없음" /><i>무</i></label>

								</li>
							</ul>
							<div style="display:none;" id="noneDiv">
								<div style="margin-bottom:10px;" class="col-md-2 title">
									층수를 알려주세요!
								</div>
								<ul class="row">

									<li class="col-md-9">
										<input type="text" id="floor" name="floor" aria-describedby="ex) 아파트 8층" placeholder="ex) 아파트 8층">
									</li>
								</ul>
							</div>
						</div>
						<hr class="hr">
					</div>

					<p class="btng_bottom">
						<a href="#" class="next_section_btn third_btn" onclick="pre_section_btn()" style="left:25%; background: #fff;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn fifth_btn" onclick="next_section_btn()">다음</a>
					</p>
				</div>
				<!--==================================섹션3끝====================================-->


				<!--==================================섹션4====================================-->
				<div style="padding-bottom:100px; display:none;" class="form_section" id="section4">
					<div class="header">
						<div class="container_sub_title">
							<p>날짜선택</p>
						</div>
						<div>
							<div class="progress">
								<div style="width:60%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>60%</p>
							</div>
							<div class="container_title">
								<p>날짜를 골라주세요!</p>
							</div>
						</div>
					</div>
					<!--=================섹션 - 입력 영역===================-->
					<div class="form_section_value">
						<hr class="hr">
						<div class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									견적마감일
								</li>
								<li class="col-md-9">
									<input readonly="" type="text" name="date_close" id="date_close" aria-describedby="희망 견적마감일을 입력해 주세요" placeholder="희망 견적마감일을 입력해 주세요">
								</li>
							</ul>
						</div>
						<hr class="hr">
						<div class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									배송요청일
								</li>
								<li class="col-md-9">
									<input readonly="" type="text" name="date_req" aria-describedby="희망 배송요청일을 입력해 주세요" placeholder="희망 배송요청일을 입력해 주세요" id="date_req">
								</li>
							</ul>
						</div>
						<hr class="hr">
					</div>
					<p class="btng_bottom">
						<a href="#" class="next_section_btn fourth_btn" onclick="pre_section_btn()" style="left:25%; background: #fff;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn sixth_btn" onclick="next_section_btn()">다음</a>
					</p>
				</div>
				<!--==================================섹션4끝====================================-->


				<!--==================================섹션5====================================-->
				<div style="display:none;" class="form_section" id="section5">
					<div class="header">
						<div class="container_sub_title">
							<p>개인정보입력</p>
						</div>
						<div>
							<div class="progress">
								<div style="width:80%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>80%</p>
							</div>
							<div class="container_title">
								<p>개인정보를 입력해주세요!</p>
							</div>
						</div>
					</div>
					<!--=================섹션 - 입력 영역===================-->
					<div class="form_section_value">
						<?php
						$readonly = "";
						if ($is_member) {
							$readonly = "readonly";
						}
						?>
						<div class="form_wrap" id="divNotLogin">
							<div>
								<div class="form-group">
									<ul class="row">
										<li class="col-md-2 title">
											이름
										</li>
										<li class="col-md-9">
											<input placeholder="이름" type="text" name="name" id="name" value="<?php echo $member['mb_name'] ?>" <?php echo $readonly ?>>
											<p class="input_error error" id="lbl_nickname">8-16자 영문과 숫자를 조합해 주세요</p>
										</li>
									</ul>
								</div>
								<div class="form-group"></div>

								<div class="form-group">
									<ul class="row">
										<li style="margin-top: 15px;" class="col-md-2 title">
											이메일
										</li>
										<li class="col-md-9">
											<input placeholder="이메일" type="email" name="email" id="email" value="<?php echo $member['mb_email'] ?>" <?php echo $readonly ?>>
											<p class="input_error error" id="lbl_email">8-16자 영문과 숫자를 조합해 주세요</p>
										</li>
									</ul>
								</div>

								<div class="form-group">
									<ul class="row">
										<li style="margin-top: 15px;" class="col-md-2 title">
											휴대폰 번호
										</li>
										<li class="col-md-9">
											<input placeholder="휴대폰번호" type="number" min="0" step="1" name="phone" id="phone" placeholder="숫자만 입력해주세요" value="<?php echo $member['mb_hp'] ?>">
										</li>
									</ul>
								</div>
								<?php
								if (!$is_member) {
								?>
									<div style="margin-top:1.2%;" class="form-group">
										<label for="pbAgree" style="margin-top: 15px;" name="pbAgree_lbl">
											<input type="checkbox" id="pbAgree" style="display: none;" />
											<i></i>&nbsp;&nbsp;본인은
											<a class="main_co" href="#" data-toggle="modal" data-target="#terms">이용약관</a>
											및
											<a class="main_co" href="#" data-toggle="modal" data-target="#privacy">개인정보보호방침</a>에 대한 내용을 모두 이해하였으며 이에 동의합니다.
										</label>
									</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>

					<p class="btng_bottom">
						<a href="#" class="next_section_btn fifth_btn" onclick="pre_section_btn()" style="left:25%; background: #fff;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn end_btn" name="click_et" id="btn_send5" onclick="next_section_btn()">견적신청하기</a>

					</p>
				</div>
				<!--==================================섹션6끝====================================-->

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
				<!-- <div style="display:none; background: #0b71c8;
    padding: 10px;
    border-radius: 10px;" class="form_section section_view07">
					<div class="form_section_value">
						<div class="form_wrap">
							<p style="margin-top:132px; " class="end_content">견적신청이 완료되었습니다!</br>업체에서 확인 후에 연락 드리겠습니다!</p>
							<div style="margin-top:132px; margin-bottom:252px;" class="end_btn_flex"><a style="margin-right:20px;" class="end_btn2" href="">견적신청내역</a><a class="end_btn" href="">홈으로</a></div>
						</div>
					</div>
				</div> -->
			</form>

			<!--스텝별 가이드-->
			<div id="process_text">
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
						<p class="step_guide_title">추가비용 발생 사유</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">
								사다리차 이용 및 엘리베이터 유/무에 따른 사유</p>
						</div>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">제품 설치에 따른 추가비용 발생 사유</p>
						</div>
					</div>
					<div class="step_guide_content">
						<p class="step_guide_title">날짜 선택 가이드</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">견적 마감일과 배송 요청일은 추후 수정이 가능합니다.</p>
						</div>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">견적 마감일에도 견적이 신청되지 않았을 경우에는 재신청 하실 수 있습니다.</p>
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
			<p class="step_img_subtitle">일정까지 조율이 끝나게 되면 파트너님들이 직접 방문하셔서 안전하고 빠르게 배송해주십니다!</p>
		</div>
	</div>



</div>


<script type="text/javascript">
	$(document).ready(function() {
		var estimateCnt = 0;

		$("#add_goods").click(function() {
			var itemCatDtl = $("#item_cat_dtl_s").val();
			if (itemCatDtl == "직접입력") {
				itemCatDtl = $("#item_cat_dtl_etc").val();
			}


			if (itemCatDtl == "" || $("#qty").val() == "") {
				alert('세부카테고리, 품목, 구매수량을 입력해주세요');
			} else {
				var vHtml = "";
				vHtml += "<div class='form_new add_pro'>";

				vHtml += "<input type='hidden' name='qty[]' id='qty_hidden' value='" + $("#qty").val() + "'>";
				vHtml += "<input type='hidden' name='cate[]' id='cate_hidden' value='" + $("#cate").val() + "'>";
				vHtml += "<input type='hidden' name='item_cat_dtl_s[]' id='item_cat_dtl_s_hidden' value='" + itemCatDtl + "'>";
				vHtml += "<div class='category'>" + $("#cate").val() + "</div><div>" + itemCatDtl + "</div>";
				vHtml += "<div class='add_qty'>" + $("#qty").val() + "개</div>";
				vHtml += "<div class='remove_pro'><a class='form_btn line_bg delete_item' href='javascript:' >삭제</a></div>";
				vHtml += "</div>";
				$("#multiList").append(vHtml);
				estimateCnt++;
			}


			$("#qty").val("");
		});

		// $("#search_goods_").autocomplete({
		// 	source: availableTags,

		// });

		$(document).on("click", ".delete_item", function() {
			$(this).closest(".add_pro").remove();
			estimateCnt--;
		});

		var now = new Date();

		var Year = now.getFullYear();

		var Month = (now.getMonth() + 1);

		if (Month < 10) Month = "0" + Month

		var Day = now.getDate();

		if (Day < 10) Day = "0" + Day

		var toDate = Year + "-" + Month + "-" + Day;

		var date = $.datepicker.parseDate('yy-mm-dd', toDate);
		// date.setDate(date.getDate() + 1);



		$.datepicker.setDefaults({
			dateFormat: 'yymmdd',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			dayNames: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			showMonthAfterYear: true,
			yearSuffix: '년'
		});

		$("#date_req").datepicker({
			dateFormat: "yy-mm-dd",
			language: "kr",
			minDate: date
		});
		$("#date_close").datepicker({
			dateFormat: "yy-mm-dd",
			language: "kr",
			minDate: date
		});



		$('#place_req').change(function() {
			if ($('#place_req option:selected').text() == '기타') {
				$('#jangso_text').css('display', 'block');
			} else {
				$('#jangso_text').css('display', 'none');
				$('#jangso_text').val('');
			}
		});

		$('#one_add').click(function() {
			var now = $('#price').val();
			$('#price').val(Number(now) + 1000);
		});

		$('#two_add').click(function() {
			var now = $('#price').val();
			$('#price').val(Number(now) + 10000);
		});

		$('#three_add').click(function() {
			var now = $('#price').val();
			$('#price').val(Number(now) + 100000);
		});

		$('#four_add').click(function() {
			var now = $('#price').val();
			$('#price').val(Number(now) + 1000000);
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
					var fvHtml = "<option value=\"\" selected>선택</option>";
					fvHtml += data;
					$("#area1").html(fvHtml);
					fvHtml = "<option value=\"\" selected>선택</option>";
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
					fvHtml += "<option value=\"\" selected>선택</option>";
					fvHtml += data;
					$("#area2").html(fvHtml);
				}
			});
		}

		doSelectArea1();
		doSelectArea2();
	});

	function doCheckForm(vGubun) {

		if (vGubun == "1") {
			if (!cfnNullCheckInput($('#tit_req').val(), "제목")) return false;
			if (!$('.add_pro').length) {
				alert('물품을 한개 이상 추가해야 합니다')
				return false;
			}
			if ($("#qty").val() !== "") {
				alert('작성된 물품을 추가해 주세요');
				return false;
			}

		} else if (vGubun == "2") {
			if (!cfnNullCheckInput($('#price').val(), "구매예산")) return false;
			if (!cfnNullCheckInput($('#etc_req').val(), "기타요청사항")) return false;
		} else if (vGubun == "3") {
			if (!cfnNullCheckSelect($('#area1').val(), "시.도")) return false;
			if (!cfnNullCheckSelect($('#area2').val(), "구.군")) return false;
			if (!cfnNullCheckInput($('#place').val(), "읍.면.동")) return false;
			if ($('input:radio[id=elevator_yn2]').is(':checked')) {
				if (!cfnNullCheckInput($("#floor").val(), "층수"))
					return false;
			}

		} else if (vGubun == "4") {
			if (!cfnNullCheckInput($('#date_close').val(), "견적마감일")) return false;
			if (!cfnNullCheckInput($('#date_req').val(), "배송요청일")) return false;
			var req_Array = $('#date_req').val().split('-');
			var close_Array = $('#date_close').val().split('-');

			var date_req = new Date(req_Array[0], req_Array[1], req_Array[2]);
			var date_close = new Date(close_Array[0], close_Array[1], close_Array[2]);

			if (date_req.getTime() < date_close.getTime()) {
				alert('마감일이 배송일보다 뒤에 있을 수 없습니다.');
				return false;
			}
			if (date_req.getTime() == date_close.getTime()) {
				alert('마감일이 배송일과 같을 수 없습니다.');
				return false;
			}
		} else if (vGubun == "5") {
			if (!cfnNullCheckInput($('#name').val(), "이름")) return false;
			if (!cfnNullCheckInput($('#email').val(), "이메일")) return false;
			if (!cfnNullCheckInput($('#phone').val(), "휴대폰")) return false;
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
		}

		return true;
	}

	var section_toggle = 1;

	function next_section_btn() {
		if (!doCheckForm(section_toggle)) return;

		if (section_toggle == 1) {
			$('#section1').css('display', 'none');
			$('#section2').css('display', 'block');
			section_toggle = 2;
		} else if (section_toggle == 2) {
			$('#section2').css('display', 'none');
			$('#section3').css('display', 'block');
			section_toggle = 3;
		} else if (section_toggle == 3) {
			$('#section3').css('display', 'none');
			$('#section4').css('display', 'block');
			section_toggle = 4;
		} else if (section_toggle == 4) {
			$('#section4').css('display', 'none');
			$('#section5').css('display', 'block');
			section_toggle = 5;
		} else if (section_toggle == 5) {
			var f = document.form_match;
			$(".layer").removeClass("hidden");
			f.submit();
		}
	}

	function pre_section_btn() {
		if (section_toggle == 2) {
			$('#section2').css('display', 'none');
			$('#section1').css('display', 'block');
			section_toggle = 1;
		} else if (section_toggle == 3) {
			$('#section3').css('display', 'none');
			$('#section2').css('display', 'block');
			section_toggle = 2;
		} else if (section_toggle == 4) {
			$('#section4').css('display', 'none');
			$('#section3').css('display', 'block');
			section_toggle = 3;
		} else if (section_toggle == 5) {
			$('#section5').css('display', 'none');
			$('#section4').css('display', 'block');
			section_toggle = 4;
		}
	}

	function setDisplay() {
		if ($('input:radio[id=elevator_yn1]').is(':checked')) {
			$('#noneDiv').hide();
		} else {
			$('#noneDiv').show();
		}
	}



	function doSelectCategory2() {


		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.category2.php",
			data: {
				category1: $('select[name="item_cat"]').val()
			},
			cache: false,
			success: function(data) {
				$('#item_cat_dtl_etc').hide();
				$("#item_cat_dtl_s").html("");
				var fvHtml = "<option value=\"\" selected>선택</option>";

				if ($('select[name="item_cat"]').val()) {
					fvHtml += data;
					$("#item_cat_dtl_s").html(fvHtml);
					$('#item_cat_dtl_s').change(function() {
						$('#item_cat_dtl_etc').val("");
						if ($(this).val() == "직접입력") {
							$('#item_cat_dtl_etc').show();
						} else {
							$('#item_cat_dtl_etc').hide();
						}
					});

				}
				$("#item_cat_dtl_s").html(fvHtml);
			}
		});
	}
	$('select[name="item_cat"]').change(function() {
		doSelectCategory2();

	});


	doSelectCategory2();




	$(function() {
		var ga_availableTags = [
			"TV",
			"냉장고",
			"세탁기",
			"김치냉장고",
			"에어컨",
			"냉동고",
			"냉온풍기",
			"전기밥솥",
			"가스레인지"
		];

		var gu_availableTags = [
			"책상",
			"침대",
			"쇼파",
			"장롱",
			"식탁",
			"피아노",
			"책장",
			"의자",
			"사무용의자",
			"서랍장",
			"화장대",
			"장식장"
		];

		$("#item_cat_dtl_s").autocomplete({
			source: ga_availableTags
		});
		// $("#manufacturer_s").autocomplete({
		// 	source: ma_availableTags
		// });
		$('select[name="item_cat"]').change(function() {
			var itemCat = $('select[name="item_cat"]:selected').val();
			if (itemCat == "가구") {
				$("#item_cat_dtl_s").autocomplete({
					source: gu_availableTags
				});
				$("#manufacturer_s").autocomplete({
					source: ""
				});
			} else if (itemCat == "가전") {
				$("#item_cat_dtl_s").autocomplete({
					source: ga_availableTags
				});
				$("#manufacturer_s").autocomplete({
					source: ma_availableTags
				});
			}
		});
	});
</script>

<?php
include_once(G5_PATH . '/tail.php');
?>
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
	div#process_text {
		height: 100% !important;
	}

	li.col-xs-3.col-md-2 {
		width: 50% !important;
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
			<form style="height: 100%;" name="frmregister" action="<?php echo G5_URL; ?>/estimate/estimate_register3B_update.php" method="post" enctype="multipart/form-data" autocomplete="off" class="form_order sell_single process_margin layout_form">
				<input type="hidden" name="sub_key" value="<?php echo time(); ?>">
				<input type="hidden" name="e_type" value="2">
				<input type="hidden" name="simple_yn" value="0">
				<input type="hidden" name="test_type" value="B">
				<input type="hidden" name="type" value="B">
				<input type="hidden" name="pull_kind" value="">
				<input type="hidden" name="pull_kind_etc" value="">


				<!--==================================섹션1====================================-->
				<div class="form_section section_view01">
					<div class="header">
						<div class="container_sub_title">
							<p>철거정보입력</p>
						</div>
						<div>
							<div class="progress">
								<div style="width:0%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>0%</p>
							</div>
							<div class="container_title">
								<p>철거 정보를 입력해주세요!</p>
							</div>
						</div>
					</div>
					<!--================섹션 - 입력 영역===============-->
					<div class="form_section_value">
						<hr class="hr">
						<div class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									철거제목
								</li>
								<li class="col-md-9">
									<input type="text" class="input_default" id="title" name="title" placeholder="제목을 입력해주세요!">
								</li>
							</ul>
						</div>
						<hr class="hr">
						<div class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									철거장소
								</li>
								<li class="col-md-9">
									<input type="hidden" name="item_cat_dtl" id="item_cat_dtl">
									<select class="input_default" id="item_cat_dtl_s" name="item_cat_dtl_s">
										<option value="가정">가정</option>
										<option value="사무실">사무실</option>
										<option value="카페">카페</option>
										<option value="식당">식당</option>
										<option value="기타">기타</option>
									</select>
								</li>
								<li class="col-md-9 col-xs-6">
									<input type="text" class="input_default" id="item_cat_dtl_etc" name="item_cat_dtl_etc" style="display:none; max-width: 100%; margin-top: 15px;">
								</li>
							</ul>
						</div>
						<hr class="hr">
						<div class="form-group" id="divRemoveItemList">
							<ul class="row">
								<li style="width:100% !important;" class="col-md-2 title">
									철거종류
								</li>
								<li class="col-md-9" style="overflow: hidden;">
									<div id="divRemoveItem"></div>
								</li>
							</ul>
						</div>
						<hr class="hr">
						<div class="form-group">
							<ul style="display: flex; flex-wrap: wrap;" class="row">
								<li style="width:100% !important;" class="col-md-2 title">
									천장/바닥 철거
								</li>

								<li class="col-md-9">
								<li class="col-md-2 col-xs-6 btn_check">
									<label class="box"><input type="radio" name="pull_floor_bottom" id="pull_floor_bottom1" value="유" checked /><i>유</i></label>
								</li>
								<li class="col-md-2 col-xs-6 btn_check">
									<label class="box"><input type="radio" name="pull_floor_bottom" id="pull_floor_bottom2" value="무" /><i>무</i></label>
								</li>
								</li>
							</ul>
						</div>
						<hr class="hr">
					</div>


					<p class="btng_bottom">
						<a href="#" class="next_section_btn first_btn" onclick="next_section_btn()">다음</a>
					</p>
				</div>
				<!--==================================섹션1끝====================================-->


				<!--==================================섹션2====================================-->
				<div class="form_section section_view02">
					<div class="header">
						<div class="container_sub_title">
							<p>상세품목선택</p>
						</div>
						<div>
							<div class="progress">
								<div style="width:20%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>20%</p>
							</div>
							<div class="container_title">
								<p>상세품목을 골라주세요!</p>
							</div>

						</div>
					</div>
					<!--===================섹션 - 입력 영역==================-->
					<div class="form_section_value">
						<hr class="hr">
						<div class="form-group">
							사진을 등록해주세요!
							<div class="row" id="imageList">

							</div>

						</div>
					</div>
					<div class="form_section_value">




						<div class="form-group">
							<div class="row" id="imageList">
							</div>
						</div>
						<hr class="hr">
						<div class="form-group">
							참고사항을 작성해주세요!
							<ul style="margin-top:1.3%;">

								<li>
									<textarea id="content" name="content" placeholder="예) 철거 내역을 상세히 작성해 주세요"></textarea>
									<!-- <p class="text-right red_co">*물품에 대해 상세히(스크래치, 문콕 등) 작성해 주시면 좀 더 정확한 견적을 받을 수 있습니다.</p> -->
								</li>
							</ul>
						</div>
						<hr class="hr">


					</div>
					<!--===================섹션 - 입력 영역 끝==================-->

					<p class="btng_bottom">
						<a href="#" class="next_section_btn first_btn" onclick="prev_section_btn()" style="left:25%; background: #fff; height:50px;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn third_btn" onclick="next_section_btn()">다음</a>
					</p>
				</div>
				<!--==================================섹션2끝====================================-->


				<!--==================================섹션3====================================-->
				<div class="form_section section_view03">

					<div class="header">
						<div class="container_sub_title">
							<p>철거환경입력</p>
						</div>
						<div>
							<div class="progress">
								<div style="width:40%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>40%</p>
							</div>
							<div class="container_title">
								<p>철거환경을 알려주세요!</p>
							</div>
						</div>
					</div>

					<!--=================섹션 - 입력 영역===================-->
					<div class="form_section_value">
						<hr class="hr">
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
									<input type="text" id="area3" name="area3" aria-describedby="읍.면.동을 입력해 주세요" placeholder="읍.면.동을 입력해 주세요">
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
						<a href="#" class="next_section_btn third_btn" onclick="prev_section_btn()" style="left:25%; background: #fff;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn fifth_btn" onclick="next_section_btn()">다음</a>
					</p>
				</div>
				<!--==================================섹션3끝====================================-->


				<!--==================================섹션4====================================-->
				<div style="padding-bottom:100px;" class="form_section section_view04">
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
									<input type="text" readonly="" id="pickup_date_magam" name="pickup_date_magam" aria-describedby="희망 마감날짜를 입력해 주세요" placeholder="희망 마감날짜를 입력해 주세요">
								</li>
							</ul>
						</div>
						<hr class="hr">
						<div class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									철거요청일
								</li>
								<li class="col-md-9">
									<input type="text" readonly="" id="pickup_date" name="pickup_date" aria-describedby="희망 철거날짜를 입력해 주세요" placeholder="희망 철거날짜를 입력해 주세요">
								</li>
							</ul>
						</div>
						<hr class="hr">
					</div>
					<p class="btng_bottom">
						<a href="#" class="next_section_btn fourth_btn" onclick="prev_section_btn()" style="left:25%; background: #fff;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn sixth_btn" onclick="next_section_btn()">다음</a>
					</p>
				</div>
				<!--==================================섹션4끝====================================-->


				<!--==================================섹션5====================================-->
				<div class="form_section section_view05">
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
										<li style="margin-top: 15px;" class="col-md-2 title">
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
										<li style="margin-top: 15px;" class="col-md-2 title">
											휴대폰 번호
										</li>
										<li class="col-md-9">
											<input placeholder="숫자만 입력해주세요" type="number" name="phone" id="phone" min="0" step="1" aria-describedby="휴대폰 번호" value="<?php echo $member['mb_hp'] ?>">
										</li>
									</ul>

								</div>
								<hr class="hr">
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
						<a href="#" class="next_section_btn fifth_btn" onclick="prev_section_btn()" style="left:25%; background: #fff;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn end_btn" name="click_et" onclick="doRegistEstimate()">견적신청하기</a>
					</p>
				</div>
				<!--==================================섹션5끝====================================-->

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
						<p class="step_guide_title">철거참고사항</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<div class="step_guide_subtitle">
								철거 항목에 따라서 철거 비용이 변경이 될 수 있습니다. </div>
						</div>
					</div>

				</div>
			</div>



			<div class="section_view02" id="process_text">
				<div class="process_text_flex">
					<div class="step_guide_content">
						<p class="step_guide_title">사진가이드</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<div class="step_guide_subtitle">
								철거하실 장소나 물품의 사진을 찍어주세요.</div>
						</div>
						<div class="img_flex">
							<img style="width:90px; height:120px;" src="/estimate/img/phguide1.png">
							<img style="width:90px; height:120px;" src="/estimate/img/phguide2.png">
							<img style="width:90px; height:120px;" src="/estimate/img/phguide3.png">
						</div>
						<div class="img_flex">
							<img style="width:90px; height:120px;" src="/estimate/img/phguide4.png">
							<img style="width:90px; height:120px;" src="/estimate/img/phguide5.png">
						</div>

					</div>

					<div class="step_guide_content">
						<p class="step_guide_title">참고사항가이드</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">
								철거하실 장소나 물품의 특이사항을 적어주세요.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="section_view03" id="process_text">
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
						<p class="step_guide_title">수집환경입력 가이드</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">
								철거를 진행하시는 파트너님들께서 엘리베이터 유/무에 따라서 견적을 진행하셔서, 꼭 입력해주셔야 합니다.</p>
						</div>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">엘리베이터 유/무에 따라 철거비용이 달라질 수 있습니다.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="section_view04" id="process_text">
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
						<p class="step_guide_title">날짜선택 가이드</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">
								견적 마감이과 철거 요청일은 추후 수정이 가능합니다.</p>
						</div>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">견적 마감일에도 견적이 신청되지 않았을 경우에는 재신청을 하실 수 있습니다.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="section_view05" id="process_text">
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
						<p class="step_guide_title">정산과정안내</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">
								파트너님께서 철거진행, 완료 후에 고객님께서 직접 정산을 해주셔야합니다.</p>
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
			<p class="step_img_subtitle">철거일에 맞춰 파트너님들이 직접 방문하셔서 안전하고 빠르게 철거 완료 후 계좌 또는 현금으로 정산하시면 됩니다!</p>
		</div>
	</div>
</div>

<!-- 사진 등록 가이드 -->
<div class="modal fade guide" id="img_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">가이드</h4>
			</div>
			<div class="modal-body">
				<div>

					<h5>중고가전/가구매입 시</h5>
					<ul class="row">
						<li>
							<img src="/img/estimate/estimate_popup01.png">
							각 물품의 정면 사진
						</li>
						<li>
							<img src="/img/estimate/estimate_popup02.png">
							가전 및 집기 모델명, 제조년식
						</li>
						<li>
							<img src="/img/estimate/estimate_popup03.png">
							물품 상태 (스크래치, 문콕 등)
						</li>
					</ul>

					<h5>가전 모델명&제조년식 확인 하는 곳</h5>
					<img src="/img/estimate/estimate_popup04.png">
					<ul>
						<li>1. 에너지 효율표와 함께 확인 가능</li>
						<li>2. 냉장/냉동고 내부 양옆 벽면</li>
						<li>3. 세탁기 앞면, 윗면, 양 옆면</li>
						<li>4. 벽걸이 에어컨 옆면, 밑면</li>
						<li>5. 그외 각 제품 뒷면</li>
					</ul>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4">
								<a class="line_bg" href="#" data-dismiss="modal">닫기</a>
							</li>
						</ul>
					</div>
					<!-- btn_wrap -->
				</div>
			</div>
			<!-- modal-body -->
		</div>
	</div>
</div>

<!-- 모델명 확인 가이드 -->
<div class="modal fade guide" id="img_guide_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">가이드</h4>
			</div>
			<div class="modal-body">
				<div>
					<h5>가전 모델명&제조년식 확인 하는 곳</h5>
					<img src="/img/estimate/estimate_popup04.png">
					<ul>
						<li>1. 에너지 효율표와 함께 확인 가능</li>
						<li>2. 냉장/냉동고 내부 양옆 벽면</li>
						<li>3. 세탁기 앞면, 윗면, 양 옆면</li>
						<li>4. 벽걸이 에어컨 옆면, 밑면</li>
						<li>5. 그외 각 제품 뒷면</li>
					</ul>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4">
								<a class="line_bg" href="#" data-dismiss="modal">닫기</a>
							</li>
						</ul>
					</div>
					<!-- btn_wrap -->
				</div>
			</div>
			<!-- modal-body -->
		</div>
	</div>
</div>


<script type="text/javascript">
	var imageMaxCnt = 9;
	var estimateCnt = 0;

	var section_toggle = 1;
	var request_parner = 0;

	var request_parner_cnt = 0;

	//다음버튼
	function next_section_btn() {
		if (!doCheckForm(section_toggle))
			return;

		if (section_toggle == 1) {
			$("#two").addClass("active");
			$(".section_view01").css("display", "none");
			$(".section_view02").css("display", "block");
			section_toggle = 2;
		} else if (section_toggle == 2) {
			$("#three").addClass("active");
			$(".section_view02").css("display", "none");
			$(".section_view03").css("display", "block");
			section_toggle = 3;
		} else if (section_toggle == 3) {
			$("#four").addClass("active");
			$(".section_view03").css("display", "none");
			$(".section_view04").css("display", "block");
			section_toggle = 4;
		} else if (section_toggle == 4) {
			$("#five").addClass("active");
			$(".section_view04").css("display", "none");
			$(".section_view05").css("display", "block");
			section_toggle = 5;
		}
	}
	//이전버튼
	function prev_section_btn() {

		if (section_toggle == 2) {
			$("#two").removeClass("active");
			$(".section_view01").css("display", "block");
			$(".section_view02").css("display", "none");
			section_toggle = 1;
		} else if (section_toggle == 3) {
			$("#three").removeClass("active");
			$(".section_view02").css("display", "block");
			$(".section_view03").css("display", "none");
			section_toggle = 2;
		} else if (section_toggle == 4) {
			$("#four").removeClass("active");
			$(".section_view03").css("display", "block");
			$(".section_view04").css("display", "none");
			section_toggle = 3;
		} else if (section_toggle == 5) {
			$("#five").removeClass("active");
			$(".section_view04").css("display", "block");
			$(".section_view05").css("display", "none");
			section_toggle = 4;

		}
	}

	jQuery(document).ready(function() {
		$("#attfile").bind('change', function() {
			$("#attfilename").html(this.files[0].name);
		});

		cfnRemoveItem("divRemoveItem", "", "");
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
		var now = new Date();

		var Year = now.getFullYear();

		var Month = now.getMonth() + 1;
		if (Month < 10) Month = "0" + Month

		var Day = now.getDate();
		if (Day < 10) Day = "0" + Day

		var toDate = Year + "-" + Month + "-" + Day;

		var date = $.datepicker.parseDate("yy-mm-dd", toDate);

		$("#pickup_date").datepicker({
			dateFormat: "yy-mm-dd",
			language: "kr",
			minDate: date
		}).change(function() {

			var t1 = $('#pickup_date').val().split("-");
			var t2 = toDate.split("-"); // 오늘

			var t1_date = new Date(t1[0], t1[1], t1[2]);
			var t2_date = new Date(t2[0], t2[1], t2[2]);

			var diff = t1_date - t2_date;
			var currDay = 24 * 60 * 60 * 1000;

			if (parseInt(diff / currDay) > 29) {
				alert('견적변동이 가능하여 업체견적이 늦을 수도 있습니다.');
			}

		});
		$("#pickup_date_magam").datepicker({
			dateFormat: "yy-mm-dd",
			language: "kr",
			minDate: date
		}).change(function() {

			var t1 = $('#pickup_date_magam').val().split("-");
			var t2 = toDate.split("-"); // 오늘

			var t1_date = new Date(t1[0], t1[1], t1[2]);
			var t2_date = new Date(t2[0], t2[1], t2[2]);

			var diff = t1_date - t2_date;
			var currDay = 24 * 60 * 60 * 1000;

			if (parseInt(diff / currDay) > 29) {
				alert('견적변동이 가능하여 업체견적이 늦을 수도 있습니다.');
			}

		});
		$(document).on("click", ".delete_item", function() {
			$(this).closest("tr").remove();
			estimateCnt--;
		});

		/*
		for(var i=1; i<=imageMaxCnt; i++)
		{
			var vComp    = "photo"+i;
			var vDivComp = "divPhoto"+i;
			var vText    = "사진파일 업로드";

			doInitImage(vComp, vDivComp, vText, "250");

		}
		*/
		doInitImage2("165");

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
		$('#item_cat_dtl_s').change(function() {
			if ($('#item_cat_dtl_s').val() == "기타") {
				$("#item_cat_dtl_etc").show();
			} else {
				$("#item_cat_dtl_etc").hide();
			}
		});

		var pullKinds = cfnGetRemoveItem();
		var vKindHtml = "<option value='' selected>선택</option>";
		for (var i = 0; i < pullKinds.length; i++) {
			vKindHtml += "<option value='" + pullKinds[i] + "' selected>" + pullKinds[i] + "</option>";
		}
		vKindHtml += "<option value='기타' selected>기타</option>";
		$('#pullKind').html(vKindHtml);
		$('#pullKind').change(function() {
			var itemCat = $('#pullKind').val();
			$('#pullFloorBottom').val("");
			$('#pullSpace').val("");
			$('#pullSize').val("");
			doChangePullKind(itemCat);
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
				$('#area2').change(function() {
					doSelectPartner();
				});
			}
		});
	}

	function doSelectPartner() {
		request_parner = 0;
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.partner.php",
			data: {
				"area1": $('#area1').val(),
				"area2": $('#area2').val(),
				"e_type": "2"
			},
			cache: false,
			success: function(data) {
				if (data) {
					request_parner_cnt = 1;
				} else {
					request_parner_cnt = 0;
				}
				$("#recommand_list").html(data);
			}
		});
	}

	function doChangePullKind(itemCat) {
		$("#pullSizeText").html("");
		if (itemCat == "붙박이장") {
			$("#pullSizeText").html("몇자 또는 몇 미터로 작성해 주세요.");
		} else if (itemCat == "가벽철거") {
			$("#pullSizeText").html("넓이(m) x 높이(m) 로 작성해 주세요.");
		} else if (itemCat == "간판철거") {
			$("#pullSizeText").html("가로(m) x 세로(m) 길이로 작성해 주세요.");
		}

		if (itemCat == "붙박이장" || itemCat == "간판철거" || itemCat == "가벽철거") {
			$("#divPullFloorBottom").hide();
			$("#divPullSpace").hide();
			$("#divPullSize").show();
			$("#pullFloorBottomChk").val("0");
			$("#pullSpaceChk").val("0");
			$("#pullSizeChk").val("1");
		} else if (itemCat == "인테리어" || itemCat == "내부철거" || itemCat == "타일철거") {
			$("#divPullFloorBottom").show();
			$("#divPullSpace").show();
			$("#divPullSize").hide();
			$("#pullFloorBottomChk").val("1");
			$("#pullSpaceChk").val("1");
			$("#pullSizeChk").val("0");
		} else if (itemCat == "건물철거" || itemCat == "원상복구") {
			$("#divPullFloorBottom").hide();
			$("#divPullSpace").show();
			$("#divPullSize").hide();
			$("#pullFloorBottomChk").val("0");
			$("#pullSpaceChk").val("1");
			$("#pullSizeChk").val("0");
		} else if (itemCat == "폐기물처리") {
			$("#divPullFloorBottom").hide();
			$("#divPullSpace").show();
			$("#divPullSize").show();
			$("#pullFloorBottomChk").val("0");
			$("#pullSpaceChk").val("1");
			$("#pullSizeChk").val("1");
		} else if (itemCat == "모두철거" || itemCat == "기타") {
			$("#divPullFloorBottom").show();
			$("#divPullSpace").show();
			$("#divPullSize").show();
			$("#pullFloorBottomChk").val("1");
			$("#pullSpaceChk").val("1");
			$("#pullSizeChk").val("1");
		} else {
			$("#divPullFloorBottom").show();
			$("#divPullSpace").show();
			$("#divPullSize").show();
			$("#pullFloorBottomChk").val("1");
			$("#pullSpaceChk").val("1");
			$("#pullSizeChk").val("1");
		}
	}

	function doAddItem() {
		if (estimateCnt == 9) {
			alert("최대 9개까지만 등록하실수 있습니다.");
			return;
		}

		$('#flag').val("I");
		$('#idx').val("");
		$('#pullKind').val("");
		$('#pullFloorBottom').val("");
		$('#pullSpace').val("");
		$('#pullSize').val("");
		doChangePullKind("");

		$("#divAddItem").show();
		$("#divModifyItem").hide();
		$('#modal_regist_item').modal();
	}

	function doSaveItem() {
		if (!cfnNullCheckSelect($('#pullKind').val(), "철거종류")) return;
		if ($("#pullFloorBottomChk").val() == "1") {
			if (!cfnNullCheckSelect($('#pullFloorBottom').val(), "천장/바닥철거")) return;
		}
		if ($("#pullSpaceChk").val() == "1") {
			if (!cfnNullCheckInput($('#pullSpace').val(), "철거평수 ")) return;
		}
		if ($("#pullSizeChk").val() == "1") {
			if (!cfnNullCheckInput($('#pullSize').val(), "철거사이즈")) return;
		}

		var vHtml = "";
		vHtml += "<tr>";
		vHtml += "<input type='hidden' name='pull_kind[]' value='" + cfNvl1($('#pullKind').val()) + "'>";
		vHtml += "<input type='hidden' name='pull_floor_bottom[]' value='" + cfNvl1($('#pullFloorBottom').val()) + "'>";
		vHtml += "<input type='hidden' name='pull_space[]' value='" + cfNvl1($('#pullSpace').val()) + "'>";
		vHtml += "<input type='hidden' name='pull_size[]' value='" + cfNvl1($("#pullSize").val()) + "'>";
		vHtml += "<td>" + cfNvl2($("#pullKind").val(), '-') + "</td>";
		vHtml += "<td>" + cfNvl2($('#pullFloorBottom').val(), '-') + "</td>";
		vHtml += "<td>" + cfNvl2($('#pullSpace').val(), '-') + "</td>";
		vHtml += "<td>" + cfNvl2($("#pullSize").val(), '-') + "</td>";
		vHtml += "<td><a class='form_btn line_bg delete_item' href='javascript:' >삭제</a></td>";
		vHtml += "</tr>";

		$("#multiList").append(vHtml);
		estimateCnt++;
		doAddItem();

	}

	function doCompleteItem() {
		if (!cfnNullCheckSelect($('#pullKind').val(), "철거종류")) return;
		if ($("#pullFloorBottomChk").val() == "1") {
			if (!cfnNullCheckSelect($('#pullFloorBottom').val(), "천장/바닥철거")) return;
		}
		if ($("#pullSpaceChk").val() == "1") {
			if (!cfnNullCheckInput($('#pullSpace').val(), "철거평수 ")) return;
		}
		if ($("#pullSizeChk").val() == "1") {
			if (!cfnNullCheckInput($('#pullSize').val(), "철거사이즈")) return;
		}

		var vHtml = "";
		vHtml += "<tr>";
		vHtml += "<input type='hidden' name='pull_kind[]' value='" + cfNvl1($('#pullKind').val()) + "'>";
		vHtml += "<input type='hidden' name='pull_floor_bottom[]' value='" + cfNvl1($('#pullFloorBottom').val()) + "'>";
		vHtml += "<input type='hidden' name='pull_space[]' value='" + cfNvl1($('#pullSpace').val()) + "'>";
		vHtml += "<input type='hidden' name='pull_size[]' value='" + cfNvl1($("#pullSize").val()) + "'>";
		vHtml += "<td>" + cfNvl2($("#pullKind").val(), '-') + "</td>";
		vHtml += "<td>" + cfNvl2($('#pullFloorBottom').val(), '-') + "</td>";
		vHtml += "<td>" + cfNvl2($('#pullSpace').val(), '-') + "</td>";
		vHtml += "<td>" + cfNvl2($("#pullSize").val(), '-') + "</td>";
		vHtml += "<td><a class='form_btn line_bg delete_item' href='javascript:' >삭제</a></td>";
		vHtml += "</tr>";

		$("#multiList").append(vHtml);
		estimateCnt++;
		$('#modal_regist_item').modal('hide');
	}

	function doSimpleEstimate() {
		$("#simple_content").val("");
		$("#modal_regist_simple").modal();
	}

	function doSaveSimpleEstimate() {
		if (!cfnNullCheckInput($("#simple_nickname").val(), "이름")) return;
		if (!cfnNullCheckInput($("#simple_email").val(), "이메일")) return;
		if (!cfnNullCheckInput($("#simple_phone").val(), "연락처")) return;
		<?php
		if (!$is_member) {
		?>
			if (!validateEmail($("#simple_email").val())) {
				alert("이메일 형식이 잘못되었습니다.");
				return false;
			}

			if (!$("#simple_pbAgree").prop("checked")) {
				alert("이용약관에 동의해주세요!");
				return false;
			}
		<?php
		}
		?>
		if (!cfnNullCheckInput($("#simple_content").val(), "참고사항")) return;

		var f = document.frmsimple;
		f.submit();
	}

	function doCheckForm(vGubun) {
		if (vGubun == "1") {
			var itemCatDtl = $("#item_cat_dtl_s").val();
			if (itemCatDtl == "직접입력") {
				itemCatDtl = $("#item_cat_dtl_etc").val();
			}

			if (!cfnNullCheckInput($("#title").val(), "철거제목")) return false;
			if (!cfnNullCheckInput(itemCatDtl, "철거장소")) return;


		} else if (vGubun == "2") {
			if (photo_count == 0) {
				alert("사진을 등록하십시오.");
				return false;
			}
			if (!cfnNullCheckInput($("#content").val(), "참고사항")) return false;



		} else if (vGubun == "3") {
			if (!cfnNullCheckSelect($("#area1").val(), "시.도")) return false;
			if (!cfnNullCheckSelect($("#area2").val(), "구.군")) return false;
			if (!cfnNullCheckInput($("#area3").val(), "읍.면.동")) return false;
			if ($('input:radio[id=elevator_yn2]').is(':checked')) {
				if (!cfnNullCheckInput($("#floor").val(), "층수"))
					return false;
			}

		} else if (vGubun == "4") {

			if (!cfnNullCheckInput($("#pickup_date_magam").val(), "견적마감일")) return false;
			if (!cfnNullCheckInput($("#pickup_date").val(), "철거요청일")) return false;
			var req_Array = $('#pickup_date').val().split('-');
			var close_Array = $('#pickup_date_magam').val().split('-');

			var date_req = new Date(req_Array[0], req_Array[1], req_Array[2]);
			var date_close = new Date(close_Array[0], close_Array[1], close_Array[2]);

			if (date_req.getTime() < date_close.getTime()) {
				alert('마감일이 철거요청일보다 뒤에 있을 수 없습니다.');
				return false;
			}
		}

		return true;
	}


	function doRegistEstimate() {
		var f = document.frmregister;
		var itemCatDtl = $("#item_cat_dtl_s").val();
		if (itemCatDtl == "직접입력") {
			itemCatDtl = $("#item_cat_dtl_etc").val();
		}

		if (!cfnNullCheckSelect($("#area1").val(), "시.도")) return;
		if (!cfnNullCheckSelect($("#area2").val(), "구.군")) return;
		if (!cfnNullCheckInput($("#area3").val(), "읍.면.동")) return;
		if ($('input:radio[id=elevator_yn2]').is(':checked')) {
			if (!cfnNullCheckInput($("#floor").val(), "층수"))
				return false;
		}
		if (!cfnNullCheckInput($("#pickup_date").val(), "철거요청일")) return;
		if (!cfnNullCheckInput($("#title").val(), "철거제목")) return;
		if (!cfnNullCheckInput(itemCatDtl, "철거장소")) return;
		if (!cfnNullCheckInput($("#content").val(), "참고사항")) return;
		f.item_cat_dtl.value = itemCatDtl;



		if (photo_count == 0) {
			alert("사진을 등록하십시오.");
			return;
		}

		var removeItem = "";
		var removeEtc = "";
		$('input[name="removeItem"]:checked').each(function(index, item) {
			if (index != 0) {
				removeItem += ",";
			}
			removeItem += $(this).val();
		});
		removeEtc = $("#removeEtc").val();

		f.pull_kind.value = removeItem;
		f.pull_kind_etc.value = removeEtc;

		if (!cfnNullCheckInput($("#nickname").val(), "이름")) return;
		if (!cfnNullCheckInput($("#email").val(), "이메일")) return;
		if (!cfnNullCheckInput($("#phone").val(), "연락처")) return;
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
		$(".layer").removeClass("hidden");

		f.submit();
	}

	function doRequsetPartner(idx) {
		var rp_chk = $("#rc_email_chk_" + idx).val();
		if (rp_chk == "N") {
			$("#rc_email_chk_" + idx).val("Y");
			$("#request_" + idx).removeClass("main_bg");
			$("#request_" + idx).addClass("sub_bg");
			$("#request_" + idx).html("문의중");
			request_parner++;
		} else {
			$("#rc_email_chk_" + idx).val("N");
			$("#request_" + idx).removeClass("sub_bg");
			$("#request_" + idx).addClass("main_bg");
			$("#request_" + idx).html("문의하기");
			request_parner--;
		}
	}

	function doReview(rcEmail, score) {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.review.modal.php",
			data: {
				rc_email: rcEmail
			},
			cache: false,
			success: function(data) {
				$("#modal_review_content").html(data);

				$("#modal_review").modal();
			}
		});
	}

	function goMove() {
		location.href = "<?php echo G5_URL; ?>/estimate/estimate_register.php";
	}

	function setDisplay() {
		if ($('input:radio[id=elevator_yn1]').is(':checked')) {
			$('#noneDiv').hide();
		} else {
			$('#noneDiv').show();
		}
	}
</script>

<!-- 파일 다운로드 테스트버전 _20200401 -->
<script>
	$(document).on("change", ".file-input", function() {

		$filename = $(this).val();

		if ($filename == "")
			$filename = "파일을 선택해주세요.";

		$(".filename").text($filename);

	})
</script>



<?php
include_once(G5_PATH . '/tail.php');
?>
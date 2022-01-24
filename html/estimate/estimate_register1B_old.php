<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');
if($member['mb_level'] == '2'){
	alert('업체회원은 이용하실 수 없습니다.');
}
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/estimate.css"/>
<!--GW-전환-견적신청-->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-715468370/chWuCOrEiakBENLclNUC',
      'transaction_id': 'estimate'
  });
</script>
<!--NAVER ADS-전환-견적신청-->
<script type="text/javascript">
var _nasa={};
_nasa["cnv"] = wcs.cnv("4","100000");
</script>

<style type="text/css">
	ul#btm_fixed_bar{display: none}
	@media(max-width: 800px){
		.sub_title{padding-top: 10px;}
		.sub_title h1{font-size: 26px; margin-bottom: 0;}
		.form-group{margin: 0 !important;}
		.btn_cate .col-md-2{width: 25%;}
		.sell_single .section_view01 .box input[type="radio"] + i{padding: 5px;}
		.sell_single .section_view01 .box i p{font-size: 12px;}
		.btn_cate .col-md-2{padding: 0 5px;}
		.form_order{padding: 0 25px;}
		#content{margin-top: 15px;}
		.form-group h2.txt_title{margin-top: 1em;}
	}
</style>
<div class="layer loader_bg hidden"></div>
<div class="layer loader hidden"></div>


<div class="form_estimate">
	<div >
		<div class="sub_title">

			<h1 class="main_co">가전/가구 매입</h1>
			<!-- 워크 플로우 부분 -->
			<ul id="progressbar">
			    <li id="one" class="active">물품 정보</li>
			    <li id="two">지역 선택</li>
			    <li id="three">견적 신청</li>
			</ul>
			<!-- 워크 플로우 부분 끝 -->
		</div><!-- sub_title -->
		
		<div class="request" style="margin-bottom:70px;">
			<div class="form_wrap ">
				<form name="frmregister" action="<?php echo G5_URL; ?>/estimate/estimate_register1B_update.php" method="post" enctype="multipart/form-data" autocomplete="off" class="form_order sell_single">
					<input type="hidden" name="sub_key" value="0">
					<input type="hidden" name="e_type" value="0">
					<input type="hidden" name="simple_yn" value="0">
					<input type="hidden" name="test_type" value="A">
					<input type="hidden" name="type" value="B">
					<input type="hidden" name="title">

					<!--==================================섹션====================================-->
					<div class="form_section section_view01">
						<!--================섹션 - 입력 영역===============-->
						<div class="form_section_value">
							<div class="form-group btn_cate">
								<!-- <a class="guide_estimate" href="#" data-toggle="modal" data-target="#object_guide"><i class="xi-help main_co"></i></a> -->
								<ul>
									<li class="col-md-2 col-xs-3">
										<label class="box">
											<input type="radio" name="item_cat" id="item_cat1" value="가전" checked/><i><div class="img_area"><img src="/img/refrigerator.png"></div><p>가전</p></i></label>
									</li>
									<li class="col-md-2 col-xs-3">
										
										<label class="box">
											<input type="radio" name="item_cat" id="item_cat2" value="주방집기"/><i><div class="img_area"><img src="/img/kitchen.png"></div><p >주방집기</p></i></label>
									</li>
									<li class="col-md-2 col-xs-3">
										
										<label class="box">
											<input type="radio" name="item_cat" id="item_cat3" value="헬스용품"/><i><div class="img_area"><img src="/img/running.png" ></div><p>헬스용품</p></i></label>
									</li>
									<li class="col-md-2 col-xs-3">

										<label class="box">
											<input type="radio" name="item_cat" id="item_cat4" value="가구"/><i><div class="img_area"><img src="/img/bookcase.png" style="width: 100px;"></div><p>가구</p></i></label>
									</li>
								</ul>
								<p class="red_co">- 작동되지 않는 가전과 부서진 가구는 폐기 비용 처리 됩니다.</p>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										세부카테고리
									</li>
									<li class="col-md-9 col-xs-6">
										<input type="hidden" name="item_cat_dtl" id="item_cat_dtl">
										<select name="item_cat_dtl_s" id="item_cat_dtl_s">
										</select>
									</li>
									<li class="col-md-12 col-xs-6" style="margin-top: 15px; ">
										<input type="text" id="item_cat_dtl_etc" name="item_cat_dtl_etc" style="max-width: 86%;display:none;">
									</li>
								</ul>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										제조사
									</li>
									<li class="col-md-9 col-xs-6">
										<input type="hidden" name="manufacturer" id="manufacturer">
										<select name="manufacturer_s" id="manufacturer_s" >
										</select>
									</li>
									<li class="col-md-12 col-xs-6" style="margin-top: 15px; ">
										<input type="text" id="manufacturer_etc" name="manufacturer_etc" style="max-width: 86%;display:none;">
									</li>
								</ul>
							</div>

							<div class="form-group" id="divModelName">
								<ul class="row">
									<li class="col-md-2 title">
										모델명<a style="margin-left: 5px;" shref="#" data-toggle="modal" data-target="#img_guide_model"><i class="xi-help main_co"></i></a>
									</li>
									<li class="col-md-9 col-xs-8">
										<input type="text" id="medel_name" name="medel_name" aria-describedby="ex) 가전 모델명 " placeholder="ex) 가전 모델명 ">
									</li>
								</ul>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										<span id="spanYear">가전 제조년식</span>
									</li>
									<li class="col-md-9 col-xs-6">
										<input type="hidden" id="year" name="year"/>
										<select id="use_year" name="use_year" >
										</select>
									</li>
								</ul>
							</div>
							<div class="form-group">
								<ul>
									<li>
										<textarea id="content" name="content" placeholder="EX. 스크래치, 문콕 등&#13;&#10;물품상태에 대해 상세히 적어주세요&#13;&#10;물품에 대해 상세히 작성해 주시면 좀 더 정확한 견적이 가능합니다. "></textarea>
										<!-- <p class="red_co">*물품에 대해 상세히 작성해 주시면 좀 더 정확한 견적이 가능합니다.</p> -->
									</li>
								</ul>
							</div>
						</div>
						<!--================섹션 - 텍스트영역===============-->
						<!-- <div class="form_section_text">
							<h2>피커스는 어떤 곳인가요?</h2>
							<p>
								가정.사무.업소 등 처치곤란 중고가전/가구 매입부터 철거/원상복구까지<br>
								한번에 쉽고 빠르게 연결해드리는 전문 재활용 매칭 서비스 입니다.<br>
								견적서를 작성하면, 여러 전문 재활용업체서 맞춤 견적서를 보내드려요.
							</p>
							<h2>견적신청 꿀 TIP!</h2>
							<p>
								전문 재활용센터들이 함께하다!<br>
								무겁고 처리하기 힘든 중고 가전/가구 배송비, 안전거래 걱정없이<br>
								전문 지역 재활용센터들을 통해<br>
								쉽고 빠르게 안전거래 가능한 피커스에서 시작하세요!
							</p>

						</div> -->
						<!--================섹션 - 텍스트영역 끝===============-->
						<div class="form_section_value">
							<div class="form-group">
								<a href="#." data-toggle="modal" data-target="#img_guide" class="guide_estimate"><i class="xi-help main_co"></i> 사진 등록 가이드</a>
							</div>
							<div class="form-group">
								<div class="row" id="imageList">
									<!--
									<div class='col-md-4 text-center' id="divPhoto1"></div>
									<div class='col-md-4 text-center' id="divPhoto2"></div>
									<div class='col-md-4 text-center' id="divPhoto3"></div>
									<div class='col-md-4 text-center' id="divPhoto4"></div>
									<div class='col-md-4 text-center' id="divPhoto5"></div>
									<div class='col-md-4 text-center' id="divPhoto6"></div>
									-->
								</div><!-- imageList -->
								<!--
								<input type="hidden" id="photo1" name="photo1">
								<input type="hidden" id="photo2" name="photo2">
								<input type="hidden" id="photo3" name="photo3">
								<input type="hidden" id="photo4" name="photo4">
								<input type="hidden" id="photo5" name="photo5">
								<input type="hidden" id="photo6" name="photo6">
								<input type="hidden" id="photo1_rotate" name="photo1_rotate">
								<input type="hidden" id="photo2_rotate" name="photo2_rotate">
								<input type="hidden" id="photo3_rotate" name="photo3_rotate">
								<input type="hidden" id="photo4_rotate" name="photo4_rotate">
								<input type="hidden" id="photo5_rotate" name="photo5_rotate">
								<input type="hidden" id="photo6_rotate" name="photo6_rotate">
								-->
							</div><!-- 사진업로드 -->
						</div>
						<p class="btng_bottom">
							<a href="#" class="next_section_btn first_btn" onclick="next_section_btn()">다음</a>
						</p>
					</div>
					<!--==================================섹션 끝====================================-->
					<!--==================================섹션====================================-->
					<div class="form_section section_view02">
						<!--===================섹션 - 입력 영역==================-->
						<div class="form_section_value">
							<div class="form-group address">
								<ul class="row">
									<li class="col-md-2 title">기본주소</li>
									<li class="col-md-4 col-xs-6">
										<select id="area1" name="area1">
											<option value="" selected>선택</option>
										</select>
									</li>
									<li class="col-md-4 col-xs-6">
										<select id="area2" name="area2">
											<option value="" selected>선택</option>
										</select>
									</li>
								</ul>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										상세주소
									</li>
									<li class="col-md-9">
										<input type="text" id="area3" name="area3" aria-describedby="상세주소를 입력해 주세요" placeholder="상세주소를 입력해 주세요">
									</li>
								</ul>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										층수
									</li>
									<li class="col-md-9">
										<input type="text" id="floor" name="floor" aria-describedby="ex) 아파트 8층" placeholder="ex) 아파트 8층">
									</li>
									<li class="col-md-2 title" style="margin-top: 15px;">
										엘리베이터
									</li>
									<li class="col-md-9">
										<li class="col-md-2 col-xs-6 btn_check">
											<label class="box"><input type="radio" name="elevator_yn" id="elevator_yn1" value="엘리베이터 있음" checked/><i>유</i></label>
										</li>
										<li class="col-md-2 col-xs-6 btn_check">
											<label class="box"><input type="radio" name="elevator_yn" id="elevator_yn2" value="엘리베이터 없음"/><i>무</i></label>
										</li>
									</li>
								</ul>
							</div>
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
							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										수거요청일
									</li>
									<li class="col-md-9">
										<input type="text" readonly="" id="pickup_date" name="pickup_date" aria-describedby="희망 수거날짜를 입력해 주세요" placeholder="희망 수거날짜를 입력해 주세요">
									</li>
								</ul>
							</div>
							
						</div>
						<!--===================섹션 - 입력 영역 끝==================-->



						<!--===================섹션 - 텍스트영역==================-->
						<!-- <div class="form_section_text">
							<h2>피커스는 어떤 곳인가요?</h2>
							<p>
								가정.사무.업소 등 처치곤란 중고가전/가구 매입부터 철거/원상복구까지<br>
								한번에 쉽고 빠르게 연결해드리는 전문 재활용 매칭 서비스 입니다.<br>
								견적서를 작성하면, 여러 전문 재활용업체서 맞춤 견적서를 보내드려요.
							</p>
							<h2>견적신청 꿀 TIP!</h2>
							<p>
								전문 재활용센터들이 함께하다!<br>
								무겁고 처리하기 힘든 중고 가전/가구 배송비, 안전거래 걱정없이<br>
								전문 지역 재활용센터들을 통해<br>
								쉽고 빠르게 안전거래 가능한 피커스에서 시작하세요!
							</p>
						</div> -->
						<!--===================섹션 - 텍스트영역 끝==================-->
						<p class="btng_bottom">
							<a href="#" class="next_section_btn first_btn" onclick="prev_section_btn()" style="left:25%">이전</a>
							<a href="#" class="next_section_btn third_btn" onclick="next_section_btn()">다음</a>
						</p>
					</div>
					<!--==================================섹션 끝====================================-->
					<!--==================================섹션====================================-->
					<div class="form_section section_view04">
						<!--=================섹션 - 입력 영역===================-->
						<div class="form_section_value">
							<?php
								$readonly = "";
								if($is_member){
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
												<input type="text" name="nickname" id="nickname" aria-describedby="이름" placeholder="이름" value="<?php echo $member['mb_name'] ?>" <?php echo $readonly ?>>
												<p class="input_error error" id="lbl_nickname">8-16자 영문과 숫자를 조합해 주세요</p>
											</li>
										</ul>
									</div>
									<div class="form-group">
										
									</div>

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

									<div class="form-group">
										<ul class="row">
											<li class="col-md-2 title">
												휴대폰 번호
											</li>
											<li class="col-md-9">
												<input placeholder="숫자만 입력해주세요" type="number" name="phone" id="phone" min="0" step="1" aria-describedby="휴대폰 번호" value="<?php echo $member['mb_hp'] ?>">
											</li>
										</ul>
										
									</div>
									<?php
									if(!$is_member){
									?>
									<div class="form-group">
										<label for="pbAgree" style="margin-top: 15px;" name="pbAgree_lbl">
											<input type="checkbox" id="pbAgree" style="display: none;" /><i></i>&nbsp;&nbsp;본인은
											<a class="main_co" href="#" data-toggle="modal" data-target="#terms">이용약관</a> 및
											<a class="main_co" href="#" data-toggle="modal" data-target="#privacy">개인정보보호방침</a>에 대한 내용을 모두 이해하였으며 이에 동의합니다.
										</label>
									</div>
									<?php
									}
									?>
								</div>
							</div><!-- form_wrap -->
						</div>

						<!--==============섹션 - 텍스트부분===============-->
						<!-- <div class="form_section_text">
							<h2>피커스는 어떤 곳인가요?</h2>
							<p>
								가정.사무.업소 등 처치곤란 중고가전/가구 매입부터 철거/원상복구까지<br>
								한번에 쉽고 빠르게 연결해드리는 전문 재활용 매칭 서비스 입니다.<br>
								견적서를 작성하면, 여러 전문 재활용업체서 맞춤 견적서를 보내드려요.
							</p>
							<h2>견적신청 꿀 TIP!</h2>
							<p>
								전문 재활용센터들이 함께하다!<br>
								무겁고 처리하기 힘든 중고 가전/가구 배송비, 안전거래 걱정없이<br>
								전문 지역 재활용센터들을 통해<br>
								쉽고 빠르게 안전거래 가능한 피커스에서 시작하세요!
							</p>

						</div> -->
						<!--==============섹션 - 텍스트부분 끝===============-->
						<div class="btn_wrap btn_posi" style="top:300px;">
							<ul class="row">
								<li class="col-md-4 col-xs-6 col-md-offset-2">
									<input class="main_bg" type="button" value="이전"  onClick="prev_section_btn();">
								</li>
								<li class="col-md-4 col-xs-6">
									<input class="main_bg ad-estimate" type="button" value="견적신청하기"  onClick="doRegistEstimate();">
								</li>
							</ul>
						</div>
					</div>
</div>
<!-- 견적 신청 부분 아래쪽 이미지 부분 -->
					
				</form>
			</div>
		</div>
	</form>
</div>
<div class="modal fade guide" id="object_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						</ul>
					</div><!-- btn_wrap -->
				</div>
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 물품 가이드 -->

<div class="modal fade guide" id="img_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						</ul>
					</div><!-- btn_wrap -->
				</div>
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 사진 가이드 -->
<div class="modal fade guide" id="object_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						</ul>
					</div><!-- btn_wrap -->
				</div>
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 물품 가이드 -->

<div class="modal fade guide" id="img_guide_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						</ul>
					</div><!-- btn_wrap -->
				</div>
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 모델명 가이드 -->
<div class="modal fade" id="modal_review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">이용후기</h4>
			</div>
			<div class="modal-body" id="modal_review_content">
				<div id="board">
					<div class="form-group">
						<p class="text-right" id="reviewTitle">

						</p>
					</div>
					<div id="board">
						<div class="photo_list">
							<table id="reviewList"></table>
						</div>
					</div>

					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						</ul>
					</div><!-- btn_wrap -->

				</div><!-- board -->
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 이용후기 -->
<script type="text/javascript">
var imageMaxCnt = 6;

var section_toggle = 1;
var request_parner = 0;

var request_parner_cnt = 0;
var current_fs, next_fs, previous_fs; 
var left, opacity, scale; 
var animating; 
function next_section_btn()
{
	if(!doCheckForm(section_toggle)) return;

	if( section_toggle == 1 )
	{	
		$("#two").addClass("active");

		$(".section_view01").css("display","none");
		$(".section_view02").css("display","block");
		section_toggle = 2;
	}
	else if( section_toggle == 2 )
	{	
		$("#three").addClass("active");
		$(".section_view02").css("display","none");
		$(".section_view04").css("display","block");
		section_toggle = 3;
	}
	/*else if( section_toggle == 3 )
	{
		$("#four").addClass("active");*/
		/*if(request_parner_cnt > 0){*/
			
		/*	$(".section_view03").css("display","none");
			section_toggle = 4;*/
		/*}else{
			
			$(".section_view03").css("display","none");
			$(".section_view05").css("display","block");
			section_toggle = 5;
		}*/
	/*}*/
}

function prev_section_btn()
{	

	if( section_toggle == 2 )
	{
		$("#two").removeClass("active");
		$(".section_view01").css("display","block");
		$(".section_view02").css("display","none");
		section_toggle = 1;
	}
	else if( section_toggle == 3 )
	{
		$("#three").removeClass("active");
		$(".section_view02").css("display","block");
		$(".section_view04").css("display","none");
		section_toggle = 2;
	}
	/*else if( section_toggle == 4 )
	{
		$("#four").removeClass("active");
		$(".section_view03").css("display","block");
		$(".section_view04").css("display","none");
		section_toggle = 3;
	}*/
}


jQuery(document).ready(function(){
	var now = new Date();

	var Year = now.getFullYear();

	var Month   = now.getMonth()+1;
	if(Month < 10) Month = "0"+Month

	var Day   = now.getDate();
	if(Day < 10) Day = "0"+Day

	var toDate = Year +"-" + Month + "-"+ Day;

	var date = $.datepicker.parseDate( "yy-mm-dd", toDate );

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

	$( "#pickup_date" ).datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr",
		minDate:date
	}).change(function(){

		var t1 = $('#pickup_date').val().split("-");
		var t2 = toDate.split("-"); // 오늘

		var t1_date = new Date(t1[0], t1[1], t1[2]);
		var t2_date = new Date(t2[0], t2[1], t2[2]);

		var diff = t1_date - t2_date;
		var currDay = 24 * 60 * 60 * 1000;

		if(parseInt(diff/currDay) > 29){
			alert('견적변동이 가능하여 업체견적이 늦을 수도 있습니다.');
		}

	});

	$( "#pickup_date_magam" ).datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr",
		minDate:date
	}).change(function(){

		var t1 = $('#pickup_date_magam').val().split("-");
		var t2 = toDate.split("-"); // 오늘

		var t1_date = new Date(t1[0], t1[1], t1[2]);
		var t2_date = new Date(t2[0], t2[1], t2[2]);

		var diff = t1_date - t2_date;
		var currDay = 24 * 60 * 60 * 1000;

		if(parseInt(diff/currDay) > 29){
			alert('견적변동이 가능하여 업체견적이 늦을 수도 있습니다.');
		}

	});

	$("#use_year").html(cfnEstimateYearsCombo("선택"));

	$('#use_year').change(function(){
		$('#year').val($("#use_year option:selected").text());
		var itemCat = $('input[name="item_cat"]:checked').val();
		if(itemCat)
		{
			var vYear = $("#use_year").val();
			if(itemCat == "가구"){
				if(vYear >= 5)
				{
					alert("년식이 오래되어 무료수거 또는 폐기로 처분이 가능할 수 있습니다. ");
				}
			}else{
				if(vYear >= 10)
				{
					alert("년식이 오래되어 무료수거 또는 폐기로 처분이 가능할 수 있습니다. ");
				}
			}

		}
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
	
	doSelectArea1();

	$('input[name="item_cat"]').change(function() {
		doSelectCategory2();

	});

	$('#item_cat_dtl_s').change(function() {
		doSelectCategory3();
	});

	doSelectCategory2();
});

function doSelectArea1()
{
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
            fvHtml="<option value=\"\" selected>선택</option>";
			$("#area2").html(fvHtml);
			$('#area1').change(function(){
				doSelectArea2();
			});
        }
    });
}

function doSelectArea2()
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.area2.php",
        data: {
        	"area1": $('#area1').val()
        },
        cache: false,
        success: function(data) {
            var fvHtml="";
			fvHtml += "<option value=\"\" selected>선택</option>";
			fvHtml += data;
			$("#area2").html(fvHtml);
			$('#area2').change(function(){
				doSelectPartner();
			});

        }
    });
}

function doSelectPartner()
{
	request_parner = 0;
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.partner.php",
        data: {
        	"area1": $('#area1').val(),
        	"area2": $('#area2').val(),
        	"e_type": "0"
        },
        cache: false,
        success: function(data) {
        	if(data){
        		request_parner_cnt = 1;
        	}else{
        		request_parner_cnt = 0;
        	}
            $("#recommand_list").html(data);
        }
    });
}

function doSelectCategory2()
{
	var itemCat = $('input[name="item_cat"]:checked').val();
	if(itemCat == "가구")
	{
		$("#divModelName").hide();
	}else{
		$("#divModelName").show();
	}
	if(itemCat == "가전"){
		$("#spanYear").html("가전 제조년식");
	}else if(itemCat == "가구"){
		$("#spanYear").html("가구 사용년식");
	}else{
		//$("#spanYear").html("");
		$("#spanYear").html(itemCat+" 제조년식");
		$("#spanYear").show();
	}

	$("#manufacturer_s").val("");
	$("#medel_name").val("");
	$("#year").val("");
	$("#use_year").val("");

    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.category2.php",
        data: {
        	category1:$('input[name="item_cat"]:checked').val()
        },
        cache: false,
        success: function(data) {
            $('#item_cat_dtl_etc').hide();
			$('#manufacturer_etc').hide();
			$("#item_cat_dtl_s").html("");
			var fvHtml="<option value=\"\" selected>선택</option>";
			$("#manufacturer_s").html(fvHtml);
			if($('input[name="item_cat"]:checked').val())
			{
				fvHtml += data;

				$("#item_cat_dtl_s").html(fvHtml);
				$('#item_cat_dtl_s').change(function(){
					$('#item_cat_dtl_etc').val("");
					if($(this).val() == "직접입력")
					{
						$('#item_cat_dtl_etc').show();
					}else{
						$('#item_cat_dtl_etc').hide();
					}
				});


			}
			$("#item_cat_dtl_s").html(fvHtml);
        }
    });
}

function doSelectCategory3()
{

    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.category3.php",
        data: {
        	category1:$('input[name="item_cat"]:checked').val(),
			category2:$('#item_cat_dtl_s').val()
        },
        cache: false,
        success: function(data) {
            $('#manufacturer_etc').hide();
			var fvHtml="<option value=\"\" selected>선택</option>";
			if($('#item_cat_dtl_s').val())
			{
				fvHtml += data;
			}
			$("#manufacturer_s").html(fvHtml);

			$('#manufacturer_s').change(function(){
				$('#manufacturer_etc').val("");
				if($(this).val() == "직접입력")
				{
					$('#manufacturer_etc').show();
				}else{
					$('#manufacturer_etc').hide();
				}
			});
        }
    });
}

function doCheckForm(vGubun)
{
	if(vGubun == "1"){
		var itemCatDtl = $("#item_cat_dtl_s").val();
		if(itemCatDtl == "직접입력")
		{
			itemCatDtl = $("#item_cat_dtl_etc").val();
		}

		var manufacturer = $("#manufacturer_s").val();
		if(manufacturer == "직접입력")
		{
			manufacturer = $("#manufacturer_etc").val();
		}


		if(!cfnNullCheckSelect(itemCatDtl, "세부카테고리")) return false;
		if(!cfnNullCheckInput(manufacturer, "제조사")) return false;
		var itemCat = $('input[name="item_cat"]:checked').val();
		if(itemCat != "가구")
		{
			if(!cfnNullCheckInput($("#medel_name").val(), "모델명")) return false;
		}

		if(!cfnNullCheckSelect($("#use_year").val(), "년식")) return false;
		if(!cfnNullCheckInput($("#content").val(), "참고사항")) return false;
		if(photo_count == 0){
			alert("사진을 등록하십시오.");
			return false;
		}
	}else if(vGubun == "2"){
		if(!cfnNullCheckSelect($("#area1").val(), "기본주소")) return false;
		if(!cfnNullCheckSelect($("#area2").val(), "기본주소")) return false;
		if(!cfnNullCheckInput($("#area3").val(), "상세주소")) return false;
		if(!cfnNullCheckInput($("#floor").val(), "층수")) return false;
		if(!cfnNullCheckInput($("#pickup_date").val(), "수거요청일")) return false;
		if(!cfnNullCheckInput($("#pickup_date_magam").val(), "견적마감일")) return false;
		var req_Array = $('#pickup_date').val().split('-');
		var close_Array = $('#pickup_date_magam').val().split('-');

		var date_req = new Date(req_Array[0], req_Array[1], req_Array[2]);
        var date_close = new Date(close_Array[0], close_Array[1], close_Array[2]);

		if(date_req.getTime() < date_close.getTime()){
			alert('마감일이 수거요청일보다 뒤에 있을 수 없습니다.');
			return false;
		}
	}else if(vGubun == "3"){
		/*
		if(request_parner < 3){
			alert("업체문의는 3개업체이상 문의하셔야 합니다.");
			return;
		}
		*/
	}

	return true;
}

function doRegistEstimate()
{
	var f = document.frmregister;
	if(!cfnNullCheckSelect($("#area1").val(), "기본주소")) return;
	if(!cfnNullCheckSelect($("#area2").val(), "기본주소")) return;
	if(!cfnNullCheckInput($("#area3").val(), "상세주소")) return;
	if(!cfnNullCheckInput($("#floor").val(), "층수")) return;
	if(!cfnNullCheckInput($("#pickup_date").val(), "수거요청일")) return;

	var itemCatDtl = $("#item_cat_dtl_s").val();
	if(itemCatDtl == "직접입력")
	{
		itemCatDtl = $("#item_cat_dtl_etc").val();
	}

	var manufacturer = $("#manufacturer_s").val();
	if(manufacturer == "직접입력")
	{
		manufacturer = $("#manufacturer_etc").val();
	}


	if(!cfnNullCheckSelect(itemCatDtl, "세부카테고리")) return;
	if(!cfnNullCheckInput(manufacturer, "제조사")) return;
	f.manufacturer.value = manufacturer;
	f.item_cat_dtl.value = itemCatDtl;
	var itemCat = $('input[name="item_cat"]:checked').val();
	if(itemCat != "가구")
	{
		if(!cfnNullCheckInput($("#medel_name").val(), "모델명")) return;
	}
	f.title.value = itemCat+" "+manufacturer+" "+itemCatDtl;

	if(!cfnNullCheckSelect($("#use_year").val(), "년식")) return;
	if(!cfnNullCheckInput($("#content").val(), "참고사항")) return;

	/*
	var nCnt = 0;
	for(var i=1; i<=imageMaxCnt; i++)
	{
		if($("#input_photo"+i+"_file").val()){
			nCnt++;
		}

	}

	if(nCnt == 0){
		alert("사진을 등록하십시오.");
		return;
	}
	*/

	if(photo_count == 0){
		alert("사진을 등록하십시오.");
		return;
	}
	/*
	if(request_parner < 3){
		alert("업체문의는 3개업체이상 문의하셔야 합니다.");
		return;
	}
	*/
	if(!cfnNullCheckInput($("#nickname").val(), "이름")) return;
	if(!cfnNullCheckInput($("#email").val(), "이메일")) return;
	if(!cfnNullCheckInput($("#phone").val(), "연락처")) return;
<?php
if(!$is_member){
?>
	if(!validateEmail($("#email").val())){
		alert("이메일 형식이 잘못되었습니다.");
		return false;
	}

	if(!$("#pbAgree").prop("checked")){
		alert("이용약관에 동의해주세요!");
		return false;
	}
<?php
}
?>

	$(".layer").removeClass("hidden");

	f.submit();
}
function doRequsetPartner(idx)
{
	var rp_chk = $("#rc_email_chk_"+idx).val();
	if(rp_chk == "N"){
		$("#rc_email_chk_"+idx).val("Y");
		$("#request_"+idx).removeClass("main_bg");
		$("#request_"+idx).addClass("sub_bg");
		$("#request_"+idx).html("문의중");
		request_parner++;
	}else{
		$("#rc_email_chk_"+idx).val("N");
		$("#request_"+idx).removeClass("sub_bg");
		$("#request_"+idx).addClass("main_bg");
		$("#request_"+idx).html("문의하기");
		request_parner--;
	}
}

function doReview(rcEmail, score)
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.review.modal.php",
        data: {
        	rc_email:rcEmail
        },
        cache: false,
        success: function(data) {
			$("#modal_review_content").html(data);

			$("#modal_review").modal();
        }
    });
}
function goMove()
{
	location.href="<?php echo G5_URL; ?>/estimate/estimate_register.php";
}

</script>

<!-- AUTO COMPLETE -->
<script type="text/javascript">
	  $( function() {
	    var ga_availableTags = [
	      "TV",
	      "냉장고",
	      "세탁기",
	      "김치냉장고",
	      "에어컨",
	      "냉동고",
	      "냉온풍기",
	      "전기밥솥",
	      "가스레인지",
	    ];
	    var ma_availableTags = [
	      "삼성전자",
	      "LG전자",
	      "대우전자",
	      "대우루컴즈",
	      "스타리온",
	      "캐리어",
	      "유니크",
	      "우성",
	      "라셀르",
	      "휘센",
	      "센추리"
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

		$( "#item_cat_dtl_s" ).autocomplete({
	      source: ga_availableTags
	    });
	    $( "#manufacturer_s" ).autocomplete({
	      source: ma_availableTags
	    });
		$('input[type=radio][name="item_cat"]').change(function() {
	    	var itemCat = $('input[name="item_cat"]:checked').val();
		    if(itemCat == "가구"){
			    $( "#item_cat_dtl_s" ).autocomplete({
			      source: gu_availableTags
			    });
			    $( "#manufacturer_s" ).autocomplete({
			    	source : ""
			    });
			}else if(itemCat == "가전"){
				$( "#item_cat_dtl_s" ).autocomplete({
			      source: ga_availableTags
			    });
			    $( "#manufacturer_s" ).autocomplete({
			      source: ma_availableTags
			    });
			}
		});
	  } );
</script>
<?php

include_once('./_tail.php');
?>

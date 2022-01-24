<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');
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

<div class="layer loader_bg hidden"></div>
<div class="layer loader hidden"></div>

<div class="sub_title">
	<h1 class="main_co">가전/가구 매입</h1>
</div><!-- sub_title -->
<div class="member com_pd">
	<div class="container">
		<!-- 워크 플로우 부분 -->
		<div class="work_flow">
			<a class="fill_01 " href="#testss1">지역 선택</a>
			<p> > </p>
			<a class="fill_02" href="#testss2">물품 정보</a>
			<p> > </p>
			<a class="fill_03" href="#testss3">사진 등록</a>
			<p> > </p>
			<a class="fill_04" href="#testss4">고객 정보</a>
			<p> > </p>
			<a class="fill_05" href="#testss5">견적 신청</a>
		</div>
		<div class="mob_work_flow">
			<a class="fill_01" href="#testss1">1.지역 선택</a>
			<a class="fill_02" href="#testss2">2.물품 정보</a>
			<a class="fill_03" href="#testss3">3.사진 등록</a>
			<a class="fill_04" href="#testss4">4.고객 정보</a>
			<a class="fill_05" href="#testss5">5.견적 신청</a>
		</div>
		<!-- 워크 플로우 부분 끝 -->
			<div class="form_wrap">
				<form name="frmregister" action="<?php echo G5_URL; ?>/estimate/estimate_register1B_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="sub_key" value="0">
					<input type="hidden" name="e_type" value="0">
					<input type="hidden" name="simple_yn" value="0">
					<input type="hidden" name="test_type" value="A">
					<input type="hidden" name="type" value="B">
					<input type="hidden" name="title">

					<!--==================================섹션====================================-->
					<div id="a_custom" class="form_section section_view01">
						<!--================섹션 - 입력 영역===============-->
						<div class="form_section_value">
							<div class="form-group">
								<h2 class="txt_title"><span>물품정보</span></h2>
								<p class="red_co text-right">* 작동되지 않는 가전과 부서진 가구는 견적이 불가 합니다.</p>
							</div>
							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										품목
									</li>
									<li class="col-md-2 col-xs-3">
										<label class="box"><input type="radio" name="item_cat" id="item_cat1" value="가전" checked/><i>가전</i></label>
									</li>
									<li class="col-md-2 col-xs-3">
										<label class="box"><input type="radio" name="item_cat" id="item_cat2" value="주방집기"/><i>주방집기</i></label>
									</li>
									<li class="col-md-2 col-xs-3">
										<label class="box"><input type="radio" name="item_cat" id="item_cat3" value="헬스용품"/><i>헬스용품</i></label>
									</li>
									<li class="col-md-2 col-xs-3">
										<label class="box"><input type="radio" name="item_cat" id="item_cat4" value="가구"/><i>가구</i></label>
									</li>
								</ul>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										세부카테고리
									</li>
									<li class="col-md-5 col-xs-6">
										<input type="hidden" name="item_cat_dtl" id="item_cat_dtl">
										<select id="item_cat_dtl_s" name="item_cat_dtl_s">
											<option value="" selected>선택</option>
										</select>
									</li>
									<li class="col-md-5 col-xs-6">
										<input type="text" id="item_cat_dtl_etc" name="item_cat_dtl_etc" style="display:none;">
									</li>
								</ul>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										제조사
									</li>
									<li class="col-md-5 col-xs-6">
										<input type="hidden" name="manufacturer" id="manufacturer">
										<select id="manufacturer_s" name="manufacturer_s">
											<option value="" selected>선택</option>
										</select>
									</li>
									<li class="col-md-5 col-xs-6">
										<input type="text" id="manufacturer_etc" name="manufacturer_etc" style="display:none;">
									</li>
								</ul>
							</div>

							<div class="form-group" id="divModelName">
								<ul class="row">
									<li class="col-md-2 title">
										모델명
									</li>
									<li class="col-md-7 col-xs-8">
										<input type="text" id="medel_name" name="medel_name" aria-describedby="ex) 가전 모델명 " placeholder="ex) 가전 모델명 ">
									</li>
									<li class="col-md-3 col-xs-4 title">
										<a href="#" data-toggle="modal" data-target="#object_guide"><i class="xi-help main_co"></i>&nbsp;&nbsp;물품 등록 가이드</a>
									</li>
								</ul>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										연식
									</li>
									<li class="col-md-5 col-xs-6">
										<input type="hidden" id="year" name="year"/>
										<select id="use_year" name="use_year" >
										</select>
									</li>
									<li class="col-md-5 col-xs-6 title">
										<p id="spanYear" name="spanYear" class="red_co">*가전 제조년식을 넣어주세요</p>
									</li>
								</ul>
							</div>
							<div class="form-group">
								<ul>
									<li class="title">
										참고사항
                                        <p class="red_co">*물품에 대해 상세히 작성해 주시면 좀 더 정확한 견적이 가능합니다.</p>
									</li>
									<li>
										<textarea id="content" name="content" placeholder="ex) 스크래치, 문콕 등 물품상태에 대해 상세히 적어주세요"></textarea>
										<!-- <p class="red_co">*물품에 대해 상세히 작성해 주시면 좀 더 정확한 견적이 가능합니다.</p> -->
									</li>
								</ul>
							</div>
						</div>
						<!--================섹션 - 텍스트영역===============-->
						<div id="aa_formtext" class="form_section_text">
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

						</div>
						<!--================섹션 - 텍스트영역 끝===============-->
				
					</div>
					<!--==================================섹션 끝====================================-->

					<!--==================================섹션====================================-->
					<div id="a_custom" class="form_section section_view02 ">
						<div class="form_section_value">
							<div class="form-group">
								<h2 class="txt_title">
									<ul class="row">
										<li class="col-xs-6"><span>사진등록</span></li>
										<li class="col-xs-6 text-right"><a href="#." data-toggle="modal" data-target="#img_guide"><i class="xi-help main_co"></i>&nbsp;&nbsp;사진 등록 가이드</a></li>
									</ul>
								</h2>
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
						<!--====================섹션 텍스트 영역======================-->
					
						<!--===================섹션 - 텍스트영역 끝==============-->
						
					</div>
					<!--==================================섹션 끝====================================-->
					<!--==================================섹션====================================-->
					<div id="a_custom" class="form_section section_view03 ">
						<!--===================섹션 - 입력 영역==================-->
						<div class="form_section_value">
							<div class="form-group">
								<h2 class="txt_title"><span>지역선택</span></h2>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										기본주소
									</li>
									<li class="col-md-5 col-xs-6">
										<select id="area1" name="area1">
											<option value="" selected>선택</option>
										</select>
									</li>
									<li class="col-md-5 col-xs-6">
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
									<li class="col-md-10">
										<input type="text" id="area3" name="area3" aria-describedby="상세주소를 입력해 주세요" placeholder="상세주소를 입력해 주세요">
									</li>
								</ul>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										층수
									</li>
									<li class="col-md-4">
										<input type="text" id="floor" name="floor" aria-describedby="ex) 아파트 8층" placeholder="ex) 아파트 8층">
									</li>
									<li class="col-md-2 title">
										엘리베이터
									</li>
									<li class="col-md-2 col-xs-6">
										<label class="box"><input type="radio" name="elevator_yn" id="elevator_yn1" value="엘리베이터 있음" checked/><i>유</i></label>
									</li>
									<li class="col-md-2 col-xs-6">
										<label class="box"><input type="radio" name="elevator_yn" id="elevator_yn2" value="엘리베이터 없음"/><i>무</i></label>
									</li>
								</ul>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										수거요청일
									</li>
									<li class="col-md-10">
										<input type="text" id="pickup_date" name="pickup_date" aria-describedby="희망 수거날짜를 입력해 주세요" placeholder="희망 수거날짜를 입력해 주세요">
									</li>
								</ul>
							</div>
						</div>
						<!--===================섹션 - 입력 영역 끝==================-->



						<!--===================섹션 - 텍스트영역==================-->
					

					</div>
					<!--==================================섹션 끝====================================-->

					<!--==================================섹션====================================-->
					<div id="a_custom" class="form_section section_view04 ">

						<!--==============섹션 - 입력부분 끝===============-->
						<div class="form_section_value">

							<div class="form-group">
								<h2 class="txt_title"><span>추천 업체</span></h2>
							</div>
							<div id="board" class="form-group">
								<div class="view">
									<ul class="shop_list" id="recommand_list">
									</ul>
								</div>
							</div>
							<div class="form-group">
								<p class="text-right red_co">견적은 2일 이내 확인 및 마감되며, 고객 신청 견적은 1주일까지 유효합니다</p>
							</div>
						</div>

				
                        <!--==============섹션 - 텍스트부분 끝===============-->
                        <div class="btn_wrap btn_posi" style="top">
							<!-- <ul id="aa_row" class="row">
								<li class="col-md-4 col-xs-6">
									<input class="main_bg" type="button" value="견적신청하기" style="top:0px;" onClick="doRegistEstimate();">
								</li>
							</ul> -->
						</div>
					</div>
					</div>
					<!--==================================섹션 끝====================================-->
					<!--==================================섹션====================================-->
					<div id="a_custom" class="form_section section_view05">
						<!--=================섹션 - 입력 영역===================-->
						<div class="form_section_value">
							<div class="form-group">
								<h2 class="txt_title"><span>고객 정보</span></h2>
							</div>
							<?php
								$readonly = "";
								if($is_member){
									$readonly = "readonly";
								}
							?>
							<div class="form_wrap" id="divNotLogin">
								<div>
									<div class="form-group">
										<input type="text" name="nickname" id="nickname" aria-describedby="이름" placeholder="이름" value="<?php echo $member['mb_name'] ?>" <?php echo $readonly ?>>
										<p class="input_error error" id="lbl_nickname">8-16자 영문과 숫자를 조합해 주세요</p>
									</div>

									<div class="form-group">
										<input type="text" name="email" id="email" aria-describedby="이메일" placeholder="이메일" value="<?php echo $member['mb_email'] ?>" <?php echo $readonly ?>>
										<p class="input_error error" id="lbl_email">8-16자 영문과 숫자를 조합해 주세요</p>
									</div>

									<div class="form-group">
										<input type="text" name="phone" id="phone" aria-describedby="휴대폰 번호" placeholder="휴대폰 번호" value="<?php echo $member['mb_hp'] ?>" <?php echo $readonly ?>>
										<p class="input_error error" id="lbl_phone">8-16자 영문과 숫자를 조합해 주세요</p>
									</div>
									<?php
									if(!$is_member){
									?>
									<div class="form-group">
										<label for="pbAgree" name="pbAgree_lbl">
											<input type="checkbox" id="pbAgree"/><i></i>&nbsp;&nbsp;본인은
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

						
						<div class="btn_wrap btn_posi" >
							<ul class="row">
							
								<li class="col-md-4 col-xs-6">
									<input class="main_bg" type="button" value="견적신청하기" style="top:0px;margin-left: 10px;width: 130px;" onClick="doRegistEstimate();">
								</li>
							</ul>
						</div>
					</div>
<!-- 견적 신청 부분 아래쪽 이미지 부분 -->
					<div class="est_main_footer mt5">


						<div class="workflow chap01">
							<img src="/img/estimate/work_flow_img01.png">
							<p>1 STEP</p>
							<p>정보입력</p>
							<p>
								고객 판매 품목 및 사진 또는 철거 내역 정보를 상세히 작성 후 업체 소개를 받으세요
							</p>

						</div>
						<div class="workflow_white"></div>
						<div class="workflow chap02">
							<img src="/img/estimate/work_flow_img02.png">
							<p>2 STEP</p>
							<p>업체견적산출</p>
							<p>
								업체를 통해 견적서를 받아보고 비교해 보세요. 다량 매입 및 철거는 방문 견적 진행이 될 수도 있습니다.
							</p>

						</div>
						<div class="workflow_white"></div>
						<div class="workflow chap03">
							<img src="/img/estimate/work_flow_img03.png">
							<p>3 STEP</p>
							<p>업체선택 및 결제</p>
							<p>
								원하는 업체 선택 후 수거/철거 날짜 조율 합니다. 진행 완료 후에 정산이 완료 됩니다.
							</p>

						</div>
						<div class="workflow_white"></div>
						<div class="workflow chap04">
							<img src="/img/estimate/work_flow_img04.png">
							<p>4 STEP</p>
							<p>후기작성</p>
							<p>
								진행이 잘 마무리 되었다면 서비스에 대한 후기를 남겨주세요.<br>
								감사합니다.
							</p>

						</div>
                    </div>
                    
                    <!--==============섹션 - 텍스트부분===============-->
						<div id="mob-formtext">
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

						</div>
						<!--==============섹션 - 텍스트부분 끝===============-->
					<!-- 모바일 버전 푸터 -->
					<div class="mob_est_main_footer mt5">
						<div class="workflow chap01">
							<div>
								<h1><span>1</span> 정보입력</h1>
								<p>고객 판매 품목 및 사진 또는 철거내역 정보를 상세히 작성 후 업체 소개를 받으세요.</p>
							</div>
							<img src="/img/estimate/mob_work_flow_img01.png">
						</div>

						<div class="workflow chap02">
							<div>
								<h1><span>2</span> 업체견적산출</h1>
								<p>업체를 통해 견적서를 받아보고 비교해 보세요. 다량 매입 및 철거는 방문 견적 진행이 될 수도 있습니다.</p>
							</div>
							<img src="/img/estimate/mob_work_flow_img02.png">
						</div>
						<div class="workflow chap03">
							<div>
								<h1><span>3</span> 업체선택 및 결제</h1>
								<p>원하는 업체 선택 후 수거/철거 날짜 조율 합니다. 진행 완료 후에 정산이 완료 됩니다.</p>
							</div>
							<img src="/img/estimate/mob_work_flow_img03.png">
						</div>
						<div class="workflow chap04">
							<div>
								<h1><span>4</span> 후기 작성</h1>
								<p>진행이 잘 마무리 되었다면 서비스에 대한 후기를 남겨주세요. 감사합니다.</p>
							</div>
							<img src="/img/estimate/mob_work_flow_img04.png">
						</div>
					</div>
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
				<h4 class="modal-title" id="myModalLabel">물품등록 가이드</h4>
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
				<h4 class="modal-title" id="myModalLabel">물품등록 가이드</h4>
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

function next_section_btn()
{
	if(!doCheckForm(section_toggle)) return;

	if( section_toggle == 1 )
	{
		$(".fill_01").removeClass("work_fill");
		$(".fill_03").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");
		$(".fill_05").removeClass("work_fill");
		$(".fill_02").addClass("work_fill");
		$(".section_view01").css("display","none");
		$(".section_view02").css("display","block");
		section_toggle = 2;
	}
	else if( section_toggle == 2 )
	{
		$(".fill_01").removeClass("work_fill");
		$(".fill_02").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");
		$(".fill_05").removeClass("work_fill");
		$(".fill_03").addClass("work_fill");
		$(".section_view02").css("display","none");
		$(".section_view03").css("display","block");
		section_toggle = 3;
	}
	else if( section_toggle == 3 )
	{
		if(request_parner_cnt > 0){
			$(".fill_01").removeClass("work_fill");
			$(".fill_02").removeClass("work_fill");
			$(".fill_03").removeClass("work_fill");
			$(".fill_05").removeClass("work_fill");
			$(".fill_04").addClass("work_fill");
			$(".section_view03").css("display","none");
			$(".section_view04").css("display","block");
			section_toggle = 4;
		}else{
			$(".fill_01").removeClass("work_fill");
			$(".fill_02").removeClass("work_fill");
			$(".fill_03").removeClass("work_fill");
			$(".fill_04").removeClass("work_fill");
			$(".fill_05").addClass("work_fill");
			$(".section_view03").css("display","none");
			$(".section_view05").css("display","block");
			section_toggle = 5;
		}
	}
	else if( section_toggle == 4 )
	{
		$(".fill_01").removeClass("work_fill");
		$(".fill_02").removeClass("work_fill");
		$(".fill_03").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");
		$(".fill_05").addClass("work_fill");
		$(".section_view04").css("display","none");
		$(".section_view05").css("display","block");
		section_toggle = 5;
	}
}

function prev_section_btn()
{
	if( section_toggle == 2 )
	{
		$(".fill_02").removeClass("work_fill");
		$(".fill_03").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");
		$(".fill_05").removeClass("work_fill");
		$(".fill_01").addClass("work_fill");
		$(".section_view01").css("display","block");
		$(".section_view02").css("display","none");
		section_toggle = 1;
	}
	else if( section_toggle == 3 )
	{
		$(".fill_01").removeClass("work_fill");
		$(".fill_03").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");
		$(".fill_05").removeClass("work_fill");
		$(".fill_02").addClass("work_fill");
		$(".section_view02").css("display","block");
		$(".section_view03").css("display","none");
		section_toggle = 2;
	}
	else if( section_toggle == 4 )
	{
		$(".fill_01").removeClass("work_fill");
		$(".fill_02").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");
		$(".fill_05").removeClass("work_fill");
		$(".fill_03").addClass("work_fill");
		$(".section_view03").css("display","block");
		$(".section_view04").css("display","none");
		section_toggle = 3;
	}
	else if( section_toggle == 5 )
	{
		if(request_parner_cnt > 0){
			$(".fill_01").removeClass("work_fill");
			$(".fill_02").removeClass("work_fill");
			$(".fill_03").removeClass("work_fill");
			$(".fill_05").removeClass("work_fill");
			$(".fill_04").addClass("work_fill");
			$(".section_view04").css("display","block");
			$(".section_view05").css("display","none");
			section_toggle = 4;
		}else{
			$(".fill_01").removeClass("work_fill");
			$(".fill_02").removeClass("work_fill");
			$(".fill_04").removeClass("work_fill");
			$(".fill_05").removeClass("work_fill");
			$(".fill_03").addClass("work_fill");
			$(".section_view03").css("display","block");
			$(".section_view05").css("display","none");
			section_toggle = 3;
		}


	}
}

function flow_select(sel)
{
	if( sel == 1 )
	{
		$(".fill_01").addClass("work_fill");
		$(".fill_02").removeClass("work_fill");
		$(".fill_03").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");
		$(".fill_05").removeClass("work_fill");

		$(".section_view01").css("display","block");
		$(".section_view02").css("display","none");
		$(".section_view03").css("display","none");
		$(".section_view04").css("display","none");
		$(".section_view05").css("display","none");
		section_toggle = 1;
	}
	else if( sel == 2 )
	{
		$(".fill_02").addClass("work_fill");
		$(".fill_01").removeClass("work_fill");
		$(".fill_03").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");
		$(".fill_05").removeClass("work_fill");

		$(".section_view02").css("display","block");
		$(".section_view01").css("display","none");
		$(".section_view03").css("display","none");
		$(".section_view04").css("display","none");
		$(".section_view05").css("display","none");
		section_toggle = 2;
	}
	else if( sel == 3 )
	{
		$(".fill_03").addClass("work_fill");
		$(".fill_01").removeClass("work_fill");
		$(".fill_02").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");
		$(".fill_05").removeClass("work_fill");

		$(".section_view03").css("display","block");
		$(".section_view01").css("display","none");
		$(".section_view02").css("display","none");
		$(".section_view04").css("display","none");
		$(".section_view05").css("display","none");
		section_toggle = 3;
	}
	else if( sel == 4 )
	{
		$(".fill_04").addClass("work_fill");
		$(".fill_01").removeClass("work_fill");
		$(".fill_02").removeClass("work_fill");
		$(".fill_03").removeClass("work_fill");
		$(".fill_05").removeClass("work_fill");

		$(".section_view04").css("display","block");
		$(".section_view01").css("display","none");
		$(".section_view02").css("display","none");
		$(".section_view03").css("display","none");
		$(".section_view05").css("display","none");
		section_toggle = 4;
	}
	else
	{
		$(".fill_05").addClass("work_fill");
		$(".fill_01").removeClass("work_fill");
		$(".fill_02").removeClass("work_fill");
		$(".fill_03").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");

		$(".section_view05").css("display","block");
		$(".section_view01").css("display","none");
		$(".section_view02").css("display","none");
		$(".section_view03").css("display","none");
		$(".section_view04").css("display","none");
		section_toggle = 4;
	}
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

	$( "#pickup_date" ).datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr",
		minDate:date
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
					alert("년식이 오래되어 무료수거나 수거 불가 할 수도 있습니다.");
				}
			}else{
				if(vYear >= 10)
				{
					alert("년식이 오래되어 무료수거나 수거 불가 할 수도 있습니다.");
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
		$("#spanYear").html("*가전 제조년식을 넣어주세요");
	}else if(itemCat == "가구"){
		$("#spanYear").html("*가구 사용년식을 넣어주세요");
	}else{
		//$("#spanYear").html("");
		$("#spanYear").html(itemCat+" 제조년식을 넣어주세요");
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
	}else if(vGubun == "2"){
		if(photo_count == 0){
			alert("사진을 등록하십시오.");
			return false;
		}
	}else if(vGubun == "3"){
		if(!cfnNullCheckSelect($("#area1").val(), "기본주소")) return false;
		if(!cfnNullCheckSelect($("#area2").val(), "기본주소")) return false;
		if(!cfnNullCheckInput($("#area3").val(), "상세주소")) return false;
		if(!cfnNullCheckInput($("#floor").val(), "층수")) return false;
		if(!cfnNullCheckInput($("#pickup_date").val(), "수거요청일")) return false;
	}else if(vGubun == "4"){
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

<?php

include_once('./_tail.php');
?>

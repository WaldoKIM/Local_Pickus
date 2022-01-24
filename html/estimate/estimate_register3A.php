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
	<h1 class="main_co">철거/원상 복구</h1>
</div><!-- sub_title -->

<div class="member com_pd">
	<div class="container">
	  	<!-- 워크 플로우 부분 -->
          <div class="work_flow">
			<a class="fill_01 " href="#testss1">맞춤 정보</a>
			<p> > </p>
			<a class="fill_02" href="#testss2">사진 등록</a>
			<p> > </p>
			<a class="fill_03" href="#testss3">지역 선택</a>
			<p> > </p>
			<a class="fill_04" href="#testss4">업체 문의</a>
			<p> > </p>
			<a class="fill_05" href="#testss5">견적 신청</a>
		</div>
		<div class="mob_work_flow">
			<a class="fill_01" href="#testss1">1.맞춤 정보</a>
			<a class="fill_02" href="#testss2">2.사진 등록</a>
			<a class="fill_03" href="#testss3">3.지역 선택</a>
			<a class="fill_04" href="#testss4">4.업체 문의</a>
			<a class="fill_05" href="#testss5">5.견적 신청</a>
		</div>
		<!-- 워크 플로우 부분 끝 -->
      
		<div class="request" style="margin-bottom:70px;">
			<div class="form_wrap">
				<form name="frmregister" action="<?php echo G5_URL; ?>/estimate/estimate_register3B_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="sub_key" value="<?php echo time(); ?>">
					<input type="hidden" name="e_type" value="2">
					<input type="hidden" name="simple_yn" value="0">
					<input type="hidden" name="test_type" value="B">
					<input type="hidden" name="type" value="B">
					<input type="hidden" name="pull_kind" value="">
					<input type="hidden" name="pull_kind_etc" value="">
					<div class="form-group category">
						<ul class="row">
							<li class="col-md-offset-8 col-md-4" style="margin-left:0%;">
								<input class="line_bg" type="button" value="견적 상담 필요 시&nbsp;-&nbsp;간편신청" onClick="doSimpleEstimate();">
							</li>
						</ul>
					</div>
					<!--==================================섹션====================================-->
					<div id="a_custom" class="form_section section_view01">
						<!--==============섹션 - 입력 영역====================-->
						<div class="form_section_value">
							<div class="form-group">
								<h2 class="txt_title"><span>철거내역</span></h2>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										철거제목
									</li>
									<li class="col-md-10">
										<input type="text" class="input_default" id="title" name="title">
									</li>
								</ul>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										철거장소
									</li>
									<li class="col-md-5 col-xs-6">
										<input type="hidden" name="item_cat_dtl" id="item_cat_dtl">
										<select class="input_default" id="item_cat_dtl_s" name="item_cat_dtl_s">
											<option value="가정">가정</option>
											<option value="사무실">사무실</option>
											<option value="카페">카페</option>
											<option value="식당">식당</option>
											<option value="기타">기타</option>
										</select>
									</li>
									<li class="col-md-5 col-xs-6">
										<input type="text" class="input_default" id="item_cat_dtl_etc" name="item_cat_dtl_etc" style="display:none;">
									</li>
								</ul>
							</div>

							<div class="form-group" id="divRemoveItemList" >
								<ul class="row">
									<li class="col-md-2 title">
										철거종류
									</li>
									<li class="col-md-10">
										<div id="divRemoveItem"></div>
									</li>
								</ul>
							</div>
							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										천장/바닥 철거
									</li>
									<li class="col-md-2 col-xs-6">
										<label class="box"><input type="radio" name="pull_floor_bottom" id="pull_floor_bottom1" value="유" checked/><i>유</i></label>
									</li>
									<li class="col-md-2 col-xs-6">
										<label class="box"><input type="radio" name="pull_floor_bottom" id="pull_floor_bottom2" value="무"/><i>무</i></label>
									</li>
								</ul>
							</div>
							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										첨부파일
									</li>
								    <li class="col-md-10">
		                                <div class="box-file-input">
		                                    <label>
		                                        <input type="file" id="attfile" name="attfile" class="file-input" accept="image/*">
		                                    </label>
		                                    <span id="attfilename" class="filename">파일을 선택해주세요.</span>
		                                </div>
									</li>
								</ul>
							</div>
							<div class="form-group">
								<ul>
									<li class="title">
										참고사항
                                        <p class="text-right red_co">*철거내역을 상세히 작성주시면 정확한 업체 연결이 가능합니다.</p>
									</li>
									<li>
										<textarea id="content" name="content" placeholder="예) 철거 내역을 상세히 작성해 주세요"></textarea>
										<!-- <p class="text-right red_co">*물품에 대해 상세히(스크래치, 문콕 등) 작성해 주시면 좀 더 정확한 견적을 받을 수 있습니다.</p> -->
									</li>
								</ul>
							</div>
						</div>
						<!--===================섹션 - 입력영역 끝===================-->
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
								다량매입 전문 재활용센터를 통한다면 어렵지 않아요.<br>
								가정.사무.업소 등 다량으로 처리하기 힘든 가전/가구 힘들게 처리하지 말고<br>
								쉽고 빠르게 전문 재활용센터를 통해 처리하세요.
							</p>

						</div>
						<!--================섹션 - 텍스트영역 끝===============-->
					
					</div>
					<!--==================================섹션 끝====================================-->
					<!--==================================섹션====================================-->
					<div id="a_custom" class="form_section section_view02">
						<!--==============섹션 - 입력 영역====================-->
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
									<div class='col-md-4 text-center' id="divPhoto7"></div>
									<div class='col-md-4 text-center' id="divPhoto8"></div>
									<div class='col-md-4 text-center' id="divPhoto9"></div>
								-->
								</div><!-- imageList -->
								<!--
								<input type="hidden" id="photo1" name="photo1">
								<input type="hidden" id="photo2" name="photo2">
								<input type="hidden" id="photo3" name="photo3">
								<input type="hidden" id="photo4" name="photo4">
								<input type="hidden" id="photo5" name="photo5">
								<input type="hidden" id="photo6" name="photo6">
								<input type="hidden" id="photo7" name="photo7">
								<input type="hidden" id="photo8" name="photo8">
								<input type="hidden" id="photo9" name="photo9">
								<input type="hidden" id="photo1_rotate" name="photo1_rotate">
								<input type="hidden" id="photo2_rotate" name="photo2_rotate">
								<input type="hidden" id="photo3_rotate" name="photo3_rotate">
								<input type="hidden" id="photo4_rotate" name="photo4_rotate">
								<input type="hidden" id="photo5_rotate" name="photo5_rotate">
								<input type="hidden" id="photo6_rotate" name="photo6_rotate">
								<input type="hidden" id="photo7_rotate" name="photo7_rotate">
								<input type="hidden" id="photo8_rotate" name="photo8_rotate">
								<input type="hidden" id="photo9_rotate" name="photo9_rotate">
								-->

							</div><!-- 사진업로드 -->
						</div>
						<!--===================섹션 - 입력영역 끝===================-->
					
					</div>
					<!--==================================섹션 끝====================================-->
					<!--==================================섹션====================================-->
					<div id="a_custom" class="form_section section_view03">
						<!--==============섹션 - 입력 영역====================-->
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
										철거요청일
									</li>
									<li class="col-md-10">
										<input type="text" id="pickup_date" name="pickup_date" aria-describedby="희망 수거날짜를 입력해 주세요" placeholder="희망 수거날짜를 입력해 주세요">
									</li>
								</ul>
							</div>
						</div>
						<!--===================섹션 - 입력영역 끝===================-->
						
					</div>
					<!--==================================섹션 끝====================================-->
					<!--==================================섹션====================================-->
					<div id="a_custom" class="form_section section_view04">
						<!--==============섹션 - 입력 영역====================-->
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
						<!--===================섹션 - 입력영역 끝===================-->
						
					</div>
					<!--==================================섹션 끝====================================-->
					<!--==================================섹션====================================-->
					<div id="a_custom" class="form_section section_view05">
						<!--==============섹션 - 입력 영역====================-->
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
										<input type="number" name="phone" id="phone" aria-describedby="휴대폰 번호" placeholder="휴대폰 번호" value="<?php echo $member['mb_hp'] ?>" <?php echo $readonly ?>>
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
						<!--===================섹션 - 입력영역 끝===================-->

					
						<div class="btn_wrap btn_posi" style="top:280px;">
							<ul class="row">
							
								<li class="col-md-4 col-xs-6">
									<input class="main_bg" type="button" value="견적신청하기"  style="width:130px;" onClick="doRegistEstimate();">
								</li>
							</ul>
						</div>
					</div>
					<!--==================================섹션 끝====================================-->
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
		</div><!-- request -->

	</div><!-- container -->
</div><!-- member -->
<div class="modal fade" id="modal_regist_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">철거내역 추가/수정</h4>
			</div>
			<div class="modal-body">
				<form>

					<div class="form-group">
						<ul class="row">
							<li class="col-xs-3 title">
								철거종류
							</li>
							<li class="col-xs-9">
								<select class="input_default" id="pullKind">

								</select>
								<input type="hidden" id="flag">
								<input type="hidden" id="idx">
							</li>
						</ul>
					</div>

					<div class="form-group" id="divPullFloorBottom">
						<ul class="row">
							<li class="col-xs-3 title">
								천장/바닥철거
							</li>
							<li class="col-xs-9">
								<select class="input_default" id="pullFloorBottom">
									<option value="천장/바닥 둘다안함" selected>천장/바닥 둘다안함</option>
									<option value="천장만 철거">천장만 철거</option>
									<option value="바닥만 철거">바닥만 철거</option>
									<option value="천장/바닥 둘다">천장/바닥 둘다</option>
								</select>
								<input type="hidden" id="pullFloorBottomChk">
							</li>
						</ul>
					</div>

					<div class="form-group" id="divPullSpace">
						<ul class="row">
							<li class="col-xs-3 title">
								철거평수
							</li>
							<li class="col-xs-9">
								<input type="text" class="input_default" id="pullSpace" >
								<input type="hidden" id="pullSpaceChk">
							</li>
						</ul>
					</div>

					<div class="form-group" id="divPullSize">
						<ul class="row">
							<li class="col-xs-3 title">
								철거사이즈
							</li>
							<li class="col-xs-9">
								<input type="text" class="input_default" id="pullSize" >
								<input type="hidden" id="pullSizeChk">
								<p id="pullSizeText"  class="txt_sub_label_03"></p>
							</li>
						</ul>
					</div>
					<div class="btn_wrap" id="divAddItem">
						<ul class="row">
							<li class="col-xs-3 col-xs-offset-3""><input class="line_bg" type="button" value="완료" onClick="doCompleteItem();"></li>
							<li class="col-xs-3"><input class="main_bg" type="button" value="추가" onClick="doSaveItem();"></li>
						</ul>
					</div>
					<div class="btn_wrap" id="divModifyItem">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4"><input class="main_bg" type="button" value="수정완료" onClick="doCompleteItem();"></li>
						</ul>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!-- 이용약관 -->
<div class="modal fade guide" id="img_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">물품등록 가이드</h4>
			</div>
			<div class="modal-body">
				<div>
					<h5>철거/원상복구 시</h5>
					<ul>
						<li>
							<img src="../img/estimate/estimate_popup05.png">
							붙박이장
						</li>
						<li>
							<img src="../img/estimate/estimate_popup06.png">
							가벽철거
						</li>
						<li>
							<img src="../img/estimate/estimate_popup07.png">
							내부철거
						</li>
						<li>
							<img src="../img/estimate/estimate_popup08.png">
							간판철거
						</li>
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
<div class="modal fade" id="modal_regist_simple" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">간편견적신청</h4>
			</div>
			<div class="modal-body">
				<form name="frmsimple" action="<?php echo G5_URL; ?>/estimate/estimate_register_simple_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="sub_key" value="<?php echo time(); ?>">
					<input type="hidden" name="e_type" value="2">
					<input type="hidden" name="simple_yn" value="1">
					<div class="form-group">
						<input type="text" name="nickname" id="simple_nickname" aria-describedby="이름" placeholder="이름" value="<?php echo $member['mb_name'] ?>" <?php echo $readonly ?>>
						<p class="input_error error" id="lbl_nickname">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>

					<div class="form-group">
						<input type="text" name="email" id="simple_email" aria-describedby="이메일" placeholder="이메일" value="<?php echo $member['mb_email'] ?>" <?php echo $readonly ?>>
						<p class="input_error error" id="lbl_email">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>

					<div class="form-group">
						<input type="text" name="phone" id="simple_phone" aria-describedby="휴대폰 번호" placeholder="휴대폰 번호" value="<?php echo $member['mb_hp'] ?>" <?php echo $readonly ?>>
						<p class="input_error error" id="lbl_phone">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>
					<?php
					if(!$is_member){
					?>
					<div class="form-group">
						<label for="simple_pbAgree" name="simple_pbAgree_lbl">
							<input type="checkbox" id="simple_pbAgree"/><i></i>&nbsp;&nbsp;본인은
							<a class="main_co" href="#" data-toggle="modal" data-target="#terms">이용약관</a> 및
							<a class="main_co" href="#" data-toggle="modal" data-target="#privacy">개인정보보호방침</a>에 대한 내용을 모두 이해하였으며 이에 동의합니다.
						</label>
					</div>
					<?php
					}
					?>
					<div class="form-group">
						<ul class="row">
							<li class="col-xs-12">
								<textarea id="simple_content" name="content" placeholder="기타 참고가 가능한 폐기물, 철거/원상복구 내역을 넣어주세요."></textarea>
							</li>
						</ul>
					</div>

					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
							<li class="col-xs-4"><input class="main_bg" type="button" value="간편견적신청" onClick="doSaveSimpleEstimate();" style=""></li>
						</ul>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
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
var imageMaxCnt = 9;
var estimateCnt = 0;

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
	$("#attfile").bind('change', function() {
		$("#attfilename").html(this.files[0].name);
	});
		
	cfnRemoveItem("divRemoveItem","", "");
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
		var vIdx = vId.replace("removeItem","");
		var vSeq = cfnRemoveItemLength();
		if(vIdx == vSeq)
		{
			$("#removeEtc").val("");
			if ($(this).is(':checked')) {
			    $("#removeEtc").show();
			}else{
				$("#removeEtc").hide();
			}
		}

		if ($(this).is(':checked')) {
			if(vValue == "모두철거"){
				$("input:checkbox[name='removeItem']").each(function(){
					this.checked = true;
				});
				$("#removeEtc").val("");
				$("#removeEtc").show();
			}
		}else{
			if(vValue == "모두철거"){
				$("input:checkbox[name='removeItem']").each(function(){
					this.checked = false;
				});
				$("#removeEtc").val("");
				$("#removeEtc").hide();
			}
		}
	});
	$('#item_cat_dtl_s').change(function(){
		if($('#item_cat_dtl_s').val() == "기타")
		{
			$("#item_cat_dtl_etc").show();
		}else{
			$("#item_cat_dtl_etc").hide();
		}
	});

	var pullKinds = cfnGetRemoveItem();
	var vKindHtml = "<option value='' selected>선택</option>";
	for(var i=0; i<pullKinds.length; i++)
	{
		vKindHtml += "<option value='"+pullKinds[i]+"' selected>"+pullKinds[i]+"</option>";
	}
	vKindHtml += "<option value='기타' selected>기타</option>";
	$('#pullKind').html(vKindHtml);
	$('#pullKind').change(function(){
		var itemCat = $('#pullKind').val();
		$('#pullFloorBottom').val("");
		$('#pullSpace').val("");
		$('#pullSize').val("");
		doChangePullKind(itemCat);
	});

	doSelectArea1();

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
        	"e_type": "2"
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
function doChangePullKind(itemCat)
{
	$("#pullSizeText").html("");
	if(itemCat == "붙박이장")
	{
		$("#pullSizeText").html("몇자 또는 몇 미터로 작성해 주세요.");
	}else if(itemCat == "가벽철거"){
		$("#pullSizeText").html("넓이(m) x 높이(m) 로 작성해 주세요.");
	}else if(itemCat == "간판철거"){
		$("#pullSizeText").html("가로(m) x 세로(m) 길이로 작성해 주세요.");
	}

	if(itemCat == "붙박이장" || itemCat == "간판철거" || itemCat == "가벽철거"){
		$("#divPullFloorBottom").hide();
		$("#divPullSpace").hide();
		$("#divPullSize").show();
		$("#pullFloorBottomChk").val("0");
		$("#pullSpaceChk").val("0");
		$("#pullSizeChk").val("1");
	}else if(itemCat == "인테리어" || itemCat == "내부철거" || itemCat == "타일철거"){
		$("#divPullFloorBottom").show();
		$("#divPullSpace").show();
		$("#divPullSize").hide();
		$("#pullFloorBottomChk").val("1");
		$("#pullSpaceChk").val("1");
		$("#pullSizeChk").val("0");
	}else if(itemCat == "건물철거" || itemCat == "원상복구"){
		$("#divPullFloorBottom").hide();
		$("#divPullSpace").show();
		$("#divPullSize").hide();
		$("#pullFloorBottomChk").val("0");
		$("#pullSpaceChk").val("1");
		$("#pullSizeChk").val("0");
	}else if(itemCat == "폐기물처리"){
		$("#divPullFloorBottom").hide();
		$("#divPullSpace").show();
		$("#divPullSize").show();
		$("#pullFloorBottomChk").val("0");
		$("#pullSpaceChk").val("1");
		$("#pullSizeChk").val("1");
	}else if(itemCat == "모두철거" || itemCat == "기타"){
		$("#divPullFloorBottom").show();
		$("#divPullSpace").show();
		$("#divPullSize").show();
		$("#pullFloorBottomChk").val("1");
		$("#pullSpaceChk").val("1");
		$("#pullSizeChk").val("1");
	}else{
		$("#divPullFloorBottom").show();
		$("#divPullSpace").show();
		$("#divPullSize").show();
		$("#pullFloorBottomChk").val("1");
		$("#pullSpaceChk").val("1");
		$("#pullSizeChk").val("1");
	}
}

function doAddItem()
{
	if(estimateCnt == 9){
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

function doSaveItem()
{
	if(!cfnNullCheckSelect($('#pullKind').val(),"철거종류")) return;
	if($("#pullFloorBottomChk").val() == "1"){
		if(!cfnNullCheckSelect($('#pullFloorBottom').val(),"천장/바닥철거")) return;
	}
	if($("#pullSpaceChk").val() == "1"){
		if(!cfnNullCheckInput($('#pullSpace').val(),"철거평수 ")) return;
	}
	if($("#pullSizeChk").val() == "1"){
		if(!cfnNullCheckInput($('#pullSize').val(),"철거사이즈")) return;
	}

	var vHtml = "";
	vHtml += "<tr>";
	vHtml += "<input type='hidden' name='pull_kind[]' value='"+cfNvl1($('#pullKind').val())+"'>";
	vHtml += "<input type='hidden' name='pull_floor_bottom[]' value='"+cfNvl1($('#pullFloorBottom').val())+"'>";
	vHtml += "<input type='hidden' name='pull_space[]' value='"+cfNvl1($('#pullSpace').val())+"'>";
	vHtml += "<input type='hidden' name='pull_size[]' value='"+cfNvl1($("#pullSize").val())+"'>";
	vHtml += "<td>"+cfNvl2($("#pullKind").val(),'-')+"</td>";
	vHtml += "<td>"+cfNvl2($('#pullFloorBottom').val(),'-')+"</td>";
	vHtml += "<td>"+cfNvl2($('#pullSpace').val(),'-')+"</td>";
	vHtml += "<td>"+cfNvl2($("#pullSize").val(),'-')+"</td>";
	vHtml += "<td><a class='form_btn line_bg delete_item' href='javascript:' >삭제</a></td>";
	vHtml += "</tr>";

	$("#multiList").append(vHtml);
	estimateCnt++;
	doAddItem();

}

function doCompleteItem()
{
	if(!cfnNullCheckSelect($('#pullKind').val(),"철거종류")) return;
	if($("#pullFloorBottomChk").val() == "1"){
		if(!cfnNullCheckSelect($('#pullFloorBottom').val(),"천장/바닥철거")) return;
	}
	if($("#pullSpaceChk").val() == "1"){
		if(!cfnNullCheckInput($('#pullSpace').val(),"철거평수 ")) return;
	}
	if($("#pullSizeChk").val() == "1"){
		if(!cfnNullCheckInput($('#pullSize').val(),"철거사이즈")) return;
	}

	var vHtml = "";
	vHtml += "<tr>";
	vHtml += "<input type='hidden' name='pull_kind[]' value='"+cfNvl1($('#pullKind').val())+"'>";
	vHtml += "<input type='hidden' name='pull_floor_bottom[]' value='"+cfNvl1($('#pullFloorBottom').val())+"'>";
	vHtml += "<input type='hidden' name='pull_space[]' value='"+cfNvl1($('#pullSpace').val())+"'>";
	vHtml += "<input type='hidden' name='pull_size[]' value='"+cfNvl1($("#pullSize").val())+"'>";
	vHtml += "<td>"+cfNvl2($("#pullKind").val(),'-')+"</td>";
	vHtml += "<td>"+cfNvl2($('#pullFloorBottom').val(),'-')+"</td>";
	vHtml += "<td>"+cfNvl2($('#pullSpace').val(),'-')+"</td>";
	vHtml += "<td>"+cfNvl2($("#pullSize").val(),'-')+"</td>";
	vHtml += "<td><a class='form_btn line_bg delete_item' href='javascript:' >삭제</a></td>";
	vHtml += "</tr>";

	$("#multiList").append(vHtml);
	estimateCnt++;
	$('#modal_regist_item').modal('hide');
}
function doSimpleEstimate()
{
	$("#simple_content").val("");
	$("#modal_regist_simple").modal();
}

function doSaveSimpleEstimate()
{
	if(!cfnNullCheckInput($("#simple_nickname").val(), "이름")) return;
	if(!cfnNullCheckInput($("#simple_email").val(), "이메일")) return;
	if(!cfnNullCheckInput($("#simple_phone").val(), "연락처")) return;
<?php
if(!$is_member){
?>
	if(!validateEmail($("#simple_email").val())){
		alert("이메일 형식이 잘못되었습니다.");
		return false;
	}

	if(!$("#simple_pbAgree").prop("checked")){
		alert("이용약관에 동의해주세요!");
		return false;
	}
<?php
}
?>
	if(!cfnNullCheckInput($("#simple_content").val(), "참고사항")) return;

	var f = document.frmsimple;
	f.submit();
}

function doCheckForm(vGubun)
{
	if(vGubun == "1"){
		var itemCatDtl = $("#item_cat_dtl_s").val();
		if(itemCatDtl == "직접입력")
		{
			itemCatDtl = $("#item_cat_dtl_etc").val();
		}

		if(!cfnNullCheckInput($("#title").val(), "철거제목")) return false;
		if(!cfnNullCheckInput(itemCatDtl, "철거장소")) return;
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
	var itemCatDtl = $("#item_cat_dtl_s").val();
	if(itemCatDtl == "직접입력")
	{
		itemCatDtl = $("#item_cat_dtl_etc").val();
	}

	if(!cfnNullCheckSelect($("#area1").val(), "기본주소")) return;
	if(!cfnNullCheckSelect($("#area2").val(), "기본주소")) return;
	if(!cfnNullCheckInput($("#area3").val(), "상세주소")) return;
	if(!cfnNullCheckInput($("#floor").val(), "층수")) return;
	if(!cfnNullCheckInput($("#pickup_date").val(), "수거요청일")) return;
	if(!cfnNullCheckInput($("#title").val(), "철거제목")) return;
	if(!cfnNullCheckInput(itemCatDtl, "철거장소")) return;
	if(!cfnNullCheckInput($("#content").val(), "참고사항")) return;
	f.item_cat_dtl.value = itemCatDtl;

	/*
	if(estimateCnt == 0)
	{
		alert("철거종류를 등록하십시오.");
		return;
	}

	*/

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
	var removeItem = "";
	var removeEtc = "";
	$('input[name="removeItem"]:checked').each(function(index,item){
		if(index != 0){
			removeItem += ",";
		}
		removeItem += $(this).val();
	});
	removeEtc = $("#removeEtc").val();

	f.pull_kind.value = removeItem;
	f.pull_kind_etc.value = removeEtc;

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


<!-- 파일 다운로드 테스트버전 _20200401 -->
<script>
$(document).on("change", ".file-input", function(){
	 
     $filename = $(this).val();

     if($filename == "")
         $filename = "파일을 선택해주세요.";

     $(".filename").text($filename);

 })
</script>

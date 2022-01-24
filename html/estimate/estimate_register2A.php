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

<div class="layer loader_bg hidden"></div>
<div class="layer loader hidden"></div>

<div class="sub_title">
	<h1 class="main_co">대량 매입</h1>
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
		<div class="request">
			<div class="form_wrap">

				<form name="frmregister" action="<?php echo G5_URL; ?>/estimate/estimate_register2A_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="sub_key" value="<?php echo time(); ?>">
				<input type="hidden" name="e_type" value="1">
				<input type="hidden" name="simple_yn" value="0">
				<input type="hidden" name="test_type" value="A">
				<input type="hidden" name="type" value="A">
				<div class="form-group category">
					<ul class="row">
						<li class="col-md-offset-8 col-md-4"style="margin-left:0%;">
							<input class="line_bg" type="button" value="견적 상담 필요 시&nbsp;-&nbsp;간편신청"  onClick="doSimpleEstimate();">
						</li>
					</ul>
				</div>


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

					<div class="form-group">
						<h2 class="txt_title"><span>물품정보</span></h2>
						<p class="red_co text-right">* 작동되지 않는 가전과 부서진 가구는 견적이 불가 합니다.</p>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="col-md-2 title">
								견적제목
							</li>
							<li class="col-md-10">
								<input type="text" id="title" name="title" aria-describedby="ex) 이사정리, 집기정리, 사무정리 등" placeholder="ex) 이사정리, 집기정리, 사무정리 등">
							</li>
						</ul>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="col-md-10 col-xs-8 title">
								품목 리스트
							</li>
							<li class="col-md-2 col-xs-4">
								<a class="form_btn main_bg" href="javascript:doAddItem()">물품 추가</a>
							</li>
						</ul>
					</div>

					<div class="form-group">
						<p class="red_co">* 품목 추가는 9개 품목까지 가능합니다.</p>
						<table>
							<colgroup>
								<col style="width: 15%" />
								<col style="width: 15%" />
								<col style="width: 15%" />
								<col style="width: 25%" />
								<col style="width: 15%" />
								<col style="width: 5%" />
								<col style="width: 10%" />
							</colgroup>
							<thead>
								<tr>
									<th>품목</th>
									<th>세부 카테고리</th>
									<th>제조사</th>
									<th>모델명</th>
									<th>년식</th>
									<th>수량</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="multiList"></tbody>
						</table>
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
								<p class="text-right red_co">*물품에 대해 상세히(스크래치, 문콕 등) 작성해 주시면 좀 더 정확한 견적을 받을 수 있습니다.</p>
							</li>
							<li>
								<textarea id="content" name="content" placeholder="ex) 스크래치, 문콕 등 물품상태에 대해 상세히 적어주세요"></textarea>
							</li>
						</ul>
					</div>

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

					<div class="form-group">
						<p class="text-right red_co">견적은 2일 이내 확인 및 마감되며, 고객 신청 견적은 1주일까지 유효합니다</p>
					</div>

					<div class="btn_wrap">
						<ul class="row">
							<li class="col-md-4 col-xs-6 col-md-offset-2">
								<input class="line_bg" type="button" value="견적 상담 필요 시&nbsp;-&nbsp;간편신청" onClick="doSimpleEstimate();">
							</li>
							<li class="col-md-4 col-xs-6">
								<input class="main_bg" type="button" value="견적신청하기" onClick="doRegistEstimate();">
							</li>
						</ul>
					</div>
					<!--================섹션 - 텍스트영역===============-->
					<div class="form_section_text1">
						<h2 style="float:left; overflow:hidden; width:450px;
							color:rgb(19, 121, 205,0.8); font-size:140%; left:20%; padding-bottom:2%;
							font-weight: bold;">피커스는 어떤 곳인가요?</h2>
						<p style=" width:450px;
							color:rgb(19, 121, 205,0.8); font-size:100%; left:20%; margin-top:5%;
							 font-weight:500;">
							처치곤란 중고가전/가구 매입부터 철거/원상복구까지<br>
							한번에 쉽고 빠르게 연결해드리는 전문 재활용 매칭 서비스 입니다.<br>
							견적서를 작성하면, 여러전문 업체서 맞춤 견적서를 보내드려요.
						</p>
					</br>
						<h2 style="float:left; overflow:hidden; width:450px;
							color:rgb(19, 121, 205,0.8); font-size:140%; left:20%; padding-bottom:2%;
							font-weight: bold;">견적신청 꿀 TIP!</h2>
						<p style="width:450px;
							color:rgb(19, 121, 205,0.8); font-size:100%; left:20%;
							 font-weight:500;">
							전문 재활용센터들이 함께하다!<br>
							무겁고 처리하기 힘든 중고 가전/가구 배송비, 안전거래 걱정없이<br>
							전문 지역 재활용센터들을 통해<br>
							쉽고 빠르게 안전거래 가능한 피커스에서 시작하세요!
						</p>

					</div>
					<!--================섹션 - 텍스트영역 끝===============-->

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
								<!-- 견적 신청 부분 아래쪽 이미지 부분 -->
				</form>

			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->

<div class="modal fade" id="modal_regist_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">물품 추가/수정</h4>
			</div>
			<div class="modal-body">
				<form>

					<div class="form-group">
						<ul class="row">
							<li class="col-xs-3 title">
								품목
							</li>
							<li class="col-xs-9">
								<select id="item_cat_s"></select>
							</li>
						</ul>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="col-xs-3 title">
								세부 카테고리
							</li>
							<li class="col-xs-4">
								<select id="item_cat_dtl_s">
									<option value="" selected>선택</option>
								</select>
							</li>
							<li class="col-xs-5">
								<input type="text" id="item_cat_dtl_etc" style="display:none;">
							</li>
						</ul>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="col-xs-3 title">
								제조사
							</li>
							<li class="col-xs-4">
								<select id="manufacturer_s">
									<option value="" selected>선택</option>
								</select>
							</li>
							<li class="col-xs-5">
								<input type="text" id="manufacturer_etc" style="display:none;">
							</li>
						</ul>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="col-xs-3 title">
								년식
							</li>
							<li class="col-xs-9">
								<input type="hidden" id="year"/>
								<select id="use_year" >
								</select>
								<p id="spanYear" style="display:none;" >*가전 제조년식을 넣어주세요</p>
							</li>
						</ul>
					</div>

					<div class="form-group" id="divModelName">
						<ul class="row">
							<li class="col-xs-3 title">
								모델명
							</li>
							<li class="col-xs-9">
								<input type="text" id="medel_name" >
							</li>
						</ul>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="col-xs-3 title">
								수량
							</li>
							<li class="col-xs-9">
								<input type="text" id="item_qty">
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
</div><!-- 물품 추가/수정 -->
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
							<img src="../img/estimate/estimate_popup01.png">
							각 물품의 정면 사진
						</li>
						<li>
							<img src="../img/estimate/estimate_popup02.png">
							가전 및 집기 모델명, 제조년식
						</li>
						<li>
							<img src="../img/estimate/estimate_popup03.png">
							물품 상태 (스크래치, 문콕 등)
						</li>
					</ul>

					<h5>가전 모델명&제조년식 확인 하는 곳</h5>
					<img src="../img/estimate/estimate_popup04.png">
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
					<input type="hidden" name="e_type" value="1">
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
								<textarea id="simple_content" name="content" placeholder="기타 참고가 가능한 매입하실 품목들을 넣어주세요."></textarea>
							</li>
						</ul>
					</div>

					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
							<li class="col-xs-4"><input class="main_bg" type="button" value="간편신청" onClick="doSaveSimpleEstimate();"></li>
						</ul>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var imageMaxCnt = 9;
var estimateCnt = 0;
jQuery(document).ready(function(){

	$("#attfile").bind('change', function() {
		$("#attfilename").html(this.files[0].name);
	});

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

	$("#item_qty").inputFilter(function(value) {
		  return /^\d*$/.test(value);
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

		doInitImage(vComp, vDivComp, vText, "350");

	}
	*/
	doInitImage2("230");

	doSelectArea1();

	$('#item_cat_s').change(function() {
		doSelectCategory2();

	});

	$('#item_cat_dtl_s').change(function() {
		doSelectCategory3();

	});

	doSelectCategory1();

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

        }
    });
}

function doSelectCategory1()
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.category1.php",
        data: {},
        cache: false,
        success: function(data) {
            var fvHtml = "<option value=\"\" selected>선택</option>";
            fvHtml += data;
            $("#item_cat_s").html(fvHtml);
        }
    });
}

function doSelectCategory2()
{
	var itemCat = $('#item_cat_s').val();
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
		//$("#spanYear").html("");.
		if(itemCat){
			$("#spanYear").html(itemCat+" 제조년식을 넣어주세요");
			$("#spanYear").show();
		}else{
			$("#spanYear").hide();
		}
	}

	$("#manufacturer_s").val("");
	$("#medel_name").val("");
	$("#year").val("");
	$("#use_year").val("");

    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.category2.php",
        data: {
        	category1:$('#item_cat_s').val()
        },
        cache: false,
        success: function(data) {
            $('#item_cat_dtl_etc').hide();
			$('#manufacturer_etc').hide();
			$("#item_cat_dtl_s").html("");
			var fvHtml="<option value=\"\" selected>선택</option>";
			$("#manufacturer_s").html(fvHtml);
			if($('#item_cat_s').val())
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
        	category1:$('#item_cat_s').val(),
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

function doAddItem()
{
	if(estimateCnt == 9){
		alert("최대 9개까지만 등록하실수 있습니다.");
		return;
	}
	$('#item_cat_s').val("");
	$('#manufacturer_s').val("");
	$('#manufacturer_etc').val("");
	$('#medel_name').val("");
	$('#item_qty').val("1");
	$('#use_year').val("");
	$('#year').val("");
	doSelectCategory2();
	doSelectCategory3();
	$("#spanYear").hide();
	$("#divAddItem").show();
	$("#divModifyItem").hide();

	$('#modal_regist_item').modal();
}

function doSaveItem()
{
	if(!cfnNullCheckSelect($('#item_cat_s').val(),"품목")) return;
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

	if(!cfnNullCheckInput($('#item_qty').val(),"수량")) return;
	if(!cfnNullCheckInput($('#use_year').val(),"연식")) return;
	var itemCat = $('#item_cat_s').val();
	if(itemCat != "가구")
	{
		//if(!cfnNullCheckInput($("#medel_name").val(), "모델명")) return;
	}

	var vHtml = "";
	vHtml += "<tr>";
	vHtml += "<input type='hidden' name='item_cat[]' value='"+$("#item_cat_s").val()+"'>";
	vHtml += "<input type='hidden' name='item_cat_dtl[]' value='"+itemCatDtl+"'>";
	vHtml += "<input type='hidden' name='manufacturer[]' value='"+manufacturer+"'>";
	vHtml += "<input type='hidden' name='medel_name[]' value='"+$("#medel_name").val()+"'>";
	vHtml += "<input type='hidden' name='year[]' value='"+$("#year").val()+"'>";
	vHtml += "<input type='hidden' name='use_year[]' value='"+$("#use_year").val()+"'>";
	vHtml += "<input type='hidden' name='item_qty[]' value='"+$("#item_qty").val()+"'>";
	vHtml += "<td>"+$("#item_cat_s").val()+"</td>";
	vHtml += "<td>"+itemCatDtl+"</td>";
	vHtml += "<td>"+manufacturer+"</td>";
	vHtml += "<td>"+$("#medel_name").val()+"</td>";
	vHtml += "<td>"+$("#year").val()+"</td>";
	vHtml += "<td>"+$("#item_qty").val()+"</td>";
	vHtml += "<td><a class='form_btn line_bg delete_item' href='javascript:' >삭제</a></td>";
	vHtml += "</tr>";

	$("#multiList").append(vHtml);
	estimateCnt++;
	doAddItem();
}

function doCompleteItem()
{
	if(!cfnNullCheckSelect($('#item_cat_s').val(),"품목")) return;
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

	if(!cfnNullCheckInput($('#item_qty').val(),"수량")) return;
	if(!cfnNullCheckInput($('#use_year').val(),"연식")) return;
	var itemCat = $('#item_cat_s').val();
	if(itemCat != "가구")
	{
		//if(!cfnNullCheckInput($("#medel_name").val(), "모델명")) return;
	}

	var vHtml = "";
	vHtml += "<tr>";
	vHtml += "<input type='hidden' name='item_cat[]' value='"+$("#item_cat_s").val()+"'>";
	vHtml += "<input type='hidden' name='item_cat_dtl[]' value='"+itemCatDtl+"'>";
	vHtml += "<input type='hidden' name='manufacturer[]' value='"+manufacturer+"'>";
	vHtml += "<input type='hidden' name='medel_name[]' value='"+$("#medel_name").val()+"'>";
	vHtml += "<input type='hidden' name='year[]' value='"+$("#year").val()+"'>";
	vHtml += "<input type='hidden' name='use_year[]' value='"+$("#use_year").val()+"'>";
	vHtml += "<input type='hidden' name='item_qty[]' value='"+$("#item_qty").val()+"'>";
	vHtml += "<td>"+$("#item_cat_s").val()+"</td>";
	vHtml += "<td>"+itemCatDtl+"</td>";
	vHtml += "<td>"+manufacturer+"</td>";
	vHtml += "<td>"+$("#medel_name").val()+"</td>";
	vHtml += "<td>"+$("#year").val()+"</td>";
	vHtml += "<td>"+$("#item_qty").val()+"</td>";
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

function doRegistEstimate()
{
	if(!cfnNullCheckSelect($("#area1").val(), "기본주소")) return;
	if(!cfnNullCheckSelect($("#area2").val(), "기본주소")) return;
	if(!cfnNullCheckInput($("#area3").val(), "상세주소")) return;
	if(!cfnNullCheckInput($("#floor").val(), "층수")) return;
	if(!cfnNullCheckInput($("#pickup_date").val(), "수거요청일")) return;
	if(!cfnNullCheckInput($("#title").val(), "견적제목")) return;

	if(!cfnNullCheckInput($("#content").val(), "참고사항")) return;

	if(estimateCnt < 2)
	{
		alert("수량/물품을 2개이상 등록하십시오.");
		return;
	}

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

	var f = document.frmregister;
	f.submit();
}

function goMove()
{
	location.href="<?php echo G5_URL; ?>/estimate/estimate_register.php";
}

</script>
<?php

include_once('./_tail.php');
?>

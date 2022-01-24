<?php
include_once('./_common.php');


$g5['title'] = '중고매칭';
include_once('./_head.php');
?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/estimate.css"/>
<div class="sub_title">
	<h1 class="main_co">중고 매칭</h1>
</div><!-- sub_title -->
<div class="member com_pd">
	<div class="container">
		<!-- 워크 플로우 부분 -->
		<div class="work_flow">
			<a class="fill_01 work_fill" onclick="flow_select(1)">구매정보입력</a>
			<p> > </p>
			<a class="fill_02" onclick="flow_select(2)">사진 및 참고사항</a>
			<p> > </p>
			<a class="fill_03" onclick="flow_select(3)">고객 정보</a>
			<p> > </p>
			<a class="fill_04" onclick="flow_select(4)">견적 신청</a>
		</div>
		<div class="mob_work_flow">
			<a class="fill_01 work_fill" onclick="flow_select(1)">1.맞춤 정보</a>
			<a class="fill_02" onclick="flow_select(2)">2.사진 및 참고사항</a>
			<a class="fill_03" onclick="flow_select(3)">3.고객 정보</a>
			<a class="fill_04" onclick="flow_select(4)">4.견적 신청</a>
		</div>	
		<!-- 워크 플로우 부분 끝 -->		
		<div class="request" style="margin-bottom:70px;">
			<div class="form_wrap">
				<form name="frmregister" action="<?php echo G5_URL; ?>/estimate/my_match_register1A_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="sub_key" value="<?php echo time(); ?>">
					<input type="hidden" name="type" value="A">
					<!--==================================섹션====================================-->
					<div class="form_section section_view01">
						<!--==============섹션 - 입력 영역====================-->
						<div class="form_section_value">
							<div class="form-group">
								<h2 class="txt_title"><span>물품정보</span></h2>
								<p class="red_co text-right">* 작동되지 않는 가전과 부서진 가구는 견적이 불가 합니다.</p>
							</div>

							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										문의제목
									</li>
									<li class="col-md-10">
										<input type="text" id="title" name="title">
									</li>
								</ul>
							</div>
							<div class="form-group">
								<ul class="row">
									<li class="col-md-2 title">
										장소
									</li>
									<li class="col-md-5 col-xs-6">
										<input type="hidden" name="match_area" id="match_area">
										<select class="input_default" id="match_area_s" name="match_area_s">
											<option value="가정">가정</option>
											<option value="사무실">사무실</option>
											<option value="카페">카페</option>
											<option value="식당">식당</option>
											<option value="기타">기타</option>
										</select>
									</li>
									<li class="col-md-5 col-xs-6">
										<input type="text" class="input_default" id="match_area_etc" name="match_area_etc" style="display:none;">
									</li>
								</ul>
							</div>
							<div class="form-group">
								<ul class="row">
									<li class="col-md-10 col-xs-8 title">
										품목 리스트
									</li>
									<li class="col-md-2 col-xs-4">
										<a class="form_btn main_bg" href="javascript:doAddItem()">구매 추가</a>
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
										희망 예산
									</li>
									<li class="col-md-10">
										<input type="text" id="price" name="price" placeholder="원" style="text-align:right;">
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
										<textarea id="content" name="content" placeholder="구매 하고픈 물품에 대해 상세히 작성해 주시면, 원하시는 물품에 맞게 비교확인이 가능합니다.
"></textarea> 
									</li>
								</ul>
							<p style="text-align:right; color:rgb(218, 26, 26);">물품정보와 실사진이 많을 수록 견적가가 좋아집니다.</p>
							</div>
						</div>
						<!--===================섹션 - 입력영역 끝===================-->
						<!--================섹션 - 텍스트영역===============-->
						<div class="form_section_text">
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
						<a class="next_section_btn" onclick="next_section_btn()">다음</a>
					</div>
					<!--==================================섹션 끝====================================-->
					<!--==================================섹션====================================-->
					<div class="form_section section_view02">
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
									<div class='col-md-4 text-center' id="divPhoto1"></div>
									<div class='col-md-4 text-center' id="divPhoto2"></div>
									<div class='col-md-4 text-center' id="divPhoto3"></div>
									<div class='col-md-4 text-center' id="divPhoto4"></div>
									<div class='col-md-4 text-center' id="divPhoto5"></div>
									<div class='col-md-4 text-center' id="divPhoto6"></div>
								</div><!-- imageList -->

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
									
							</div><!-- 사진업로드 -->
						</div>
						<!--===================섹션 - 입력영역 끝===================-->
						<!--================섹션 - 텍스트영역===============-->
						<div class="form_section_text">
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
						<a class="next_section_btn" onclick="next_section_btn()">다음</a>
					</div>
					<!--==================================섹션 끝====================================-->
					<!--==================================섹션====================================-->
					<div class="form_section section_view03">
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
						</div>
						<!--===================섹션 - 입력영역 끝===================-->
						<!--================섹션 - 텍스트영역===============-->
						<div class="form_section_text">
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
						<a class="next_section_btn" onclick="next_section_btn()">다음</a>
					</div>
					<!--==================================섹션 끝====================================-->
					<!--==================================섹션====================================-->
					<div class="form_section section_view04">
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
						<!--===================섹션 - 입력영역 끝===================-->
						<!--================섹션 - 텍스트영역===============-->
						<div class="form_section_text">
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
						<div class="btn_wrap btn_posi">
							<ul class="row">
								<li class="col-md-4 col-xs-6 col-xs-offset-3 col-md-offset-4">
									<input class="main_bg" type="button" value="견적신청하기"  onClick="doRegistEstimate();">
								</li>
							</ul>
						</div>	
					</div>
					<!--==================================섹션 끝====================================-->
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

<script type="text/javascript">
var imageMaxCnt = 6;
var estimateCnt = 0;

var section_toggle = 1;
function next_section_btn()
{
	if( section_toggle == 1 )
	{
		$(".fill_01").removeClass("work_fill");
		$(".fill_03").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");
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
		$(".fill_03").addClass("work_fill");
		$(".section_view02").css("display","none");
		$(".section_view03").css("display","block");
		section_toggle = 3;
	}
	else if( section_toggle == 3 )
	{
		$(".fill_01").removeClass("work_fill");
		$(".fill_02").removeClass("work_fill");
		$(".fill_03").removeClass("work_fill");
		$(".fill_04").addClass("work_fill");
		$(".section_view03").css("display","none");
		$(".section_view04").css("display","block");
		section_toggle = 4;
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

		$(".section_view01").css("display","block");
		$(".section_view02").css("display","none");
		$(".section_view03").css("display","none");
		$(".section_view04").css("display","none");
		section_toggle = 1;
	}
	else if( sel == 2 )
	{
		$(".fill_02").addClass("work_fill");
		$(".fill_01").removeClass("work_fill");
		$(".fill_03").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");

		$(".section_view02").css("display","block");
		$(".section_view01").css("display","none");
		$(".section_view03").css("display","none");
		$(".section_view04").css("display","none");
		section_toggle = 2;
	}
	else if( sel == 3 )
	{
		$(".fill_03").addClass("work_fill");
		$(".fill_01").removeClass("work_fill");
		$(".fill_02").removeClass("work_fill");
		$(".fill_04").removeClass("work_fill");

		$(".section_view03").css("display","block");
		$(".section_view01").css("display","none");
		$(".section_view02").css("display","none");
		$(".section_view04").css("display","none");
		section_toggle = 3;
	}
	else if( sel == 4 )
	{
		$(".fill_04").addClass("work_fill");
		$(".fill_01").removeClass("work_fill");
		$(".fill_02").removeClass("work_fill");
		$(".fill_03").removeClass("work_fill");

		$(".section_view04").css("display","block");
		$(".section_view01").css("display","none");
		$(".section_view02").css("display","none");
		$(".section_view03").css("display","none");
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
	
	$("#item_qty").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});


	$("#price").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});

	$("#use_year").html(cfnEstimateYearsCombo("선택"));

	$('#use_year').change(function(){ 
		$('#year').val($("#use_year option:selected").text()); 
		
	}); 

	$(document).on("click", ".delete_item", function() {
		$(this).closest("tr").remove();
		estimateCnt--;
	});
	for(var i=1; i<=imageMaxCnt; i++)
	{
		var vComp    = "photo"+i;
		var vDivComp = "divPhoto"+i;
		var vText    = "사진파일 업로드";
		
		doInitImage(vComp, vDivComp, vText, "250");

	}

	doSelectArea1();

	$('#match_area_s').change(function(){ 
		if($('#match_area_s').val() == "기타")
		{
			$("#match_area_etc").show();
		}else{
			$("#match_area_etc").hide();
		}
	});

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
		if(!cfnNullCheckInput($("#medel_name").val(), "모델명")) return;
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
		if(!cfnNullCheckInput($("#medel_name").val(), "모델명")) return;
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
	if(!cfnNullCheckInput($("#simple_content").val(), "참고사항")) return;

	var f = document.frmsimple;
	f.submit();
}

function doRegistEstimate()
{
	var f = document.frmregister;

	var match_area = $("#match_area_s").val();
	if(match_area == "직접입력")
	{
		match_area = $("#match_area_etc").val();
	}

	if(!cfnNullCheckSelect($("#area1").val(), "기본주소")) return;
	if(!cfnNullCheckSelect($("#area2").val(), "기본주소")) return;
	if(!cfnNullCheckInput($("#area3").val(), "상세주소")) return;
	if(!cfnNullCheckInput($("#floor").val(), "층수")) return;
	if(!cfnNullCheckInput($("#title").val(), "문의제목")) return;

	if(!cfnNullCheckInput($("#content").val(), "참고사항")) return;
	
	f.match_area.value = match_area;

	if(estimateCnt < 1)
	{
		alert("수량/물품을 1개이상 등록하십시오.");
		return;
	}
	 
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

	if(!cfnNullCheckInput($("#nickname").val(), "이름")) return;
	if(!cfnNullCheckInput($("#email").val(), "이메일")) return;
	if(!cfnNullCheckInput($("#phone").val(), "연락처")) return;
	
	f.submit();
}

</script>
<?php

include_once('./_tail.php');
?>

<?php
include_once('./_common.php');

if (!$is_member || $member['mb_level'] != "2")
	alert("회원만 가능합니다.", G5_URL);

include_once('./_head.php');

$register_action_url = G5_HTTPS_BBS_URL.'/register_form_update.php';
?>
<style type="text/css">
	.mob_back{display: none !important;}
	#fregisterform{max-width: 585px; margin: 0 auto; background-color: #fff; padding: 30px; border-top: 0;} 
	.at-body{background-color: #f4f5f9;}
	input[type="button"]{margin-top: 0;}
	.form-group{border-bottom: 0;}
	.col-xs-4{padding: 0;}
	#divGoodsItem .col-md-2, #divGoodsItem .col-md-4{width: 20%;}
	@media(max-width: 480px){
		.full_mobile,
		.full_mobile p,
		.full_mobile .col-xs-4,
		.full_mobile .text-right{width: 100%}
		#divGoodsItem .col-md-2, #divGoodsItem .col-md-4{width: 100% !important;}
	}
	@media(max-width:1024px){
		.header{
			display:none !important;
		}
	}

	/*마이페이지이동버튼*/
.mypage_btn_header{
	display: none;
}

@media(max-width:1042px){
	.mypage_btn_header{
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		align-items: center;
		padding: 4% 5%;
		border-bottom: 1px solid #ddd;
		color: #666 !important;
		font-family: nanumsquare;
		background: #fff;
	}

	.back_btn{
		position: absolute;
	}

	.back_btn > img{
		width: 25px;
	}

	.title{
		width: 100%;
		font-size: 18px;
		font-weight: bold;
		text-align: center;
	}
	.sub_title{
		display: none;
	}
}
/*마이페이지이동버튼끝*/
</style>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<div class="mypage_btn_header">
    <a href="javascript:history.back();" class="back_btn"><img src="../img/back.png" alt=""></a>
    <div class="title">회원정보</div>
</div>
<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">회원정보</h1>
			<p class="tit_desc">피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</p>
		</div>
		<div class="join_wrap">
			<div class="form_wrap">
				
				<form id="fregisterform" name="fregisterform" action="/bbs/mypage_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="w" value="u">
					<input type="hidden" name="url" value="<?php echo $urlencode ?>">
					<input type="hidden" id="mb_biz_type" name="mb_biz_type" value="<?php echo $member['mb_biz_type'];?>">
					<input type="hidden" id="mb_level" name="mb_level" value="<?php echo $member['mb_level'];?>">		
					<input type="hidden" id="mb_id" name="mb_id" value="<?php echo $member['mb_id'];?>">
					<input type="hidden" id="mb_name" name="mb_name" value="<?php echo $member['mb_name'];?>">					
					<input type="hidden" id="mb_biz_name" name="mb_biz_name" value="<?php echo $member['mb_biz_name'];?>">					
					<input type="hidden" id="mb_email" name="mb_email" value="<?php echo $member['mb_email'];?>">					
					<input type="hidden" id="mb_password" name="mb_password">
					<input type="hidden" id="mb_password_type" name="mb_password_type" value="<?php echo $member['mb_password_type'];?>">			
					<input type="hidden" id="mb_biz_goods_item" name="mb_biz_goods_item" value="<?php echo $member['mb_biz_goods_item'];?>">
					<input type="hidden" id="mb_biz_goods_year" name="mb_biz_goods_year" value="<?php echo $member['mb_biz_goods_year'];?>">
					<input type="hidden" id="mb_biz_remove_item" name="mb_biz_remove_item" value="<?php echo $member['mb_biz_remove_item'];?>">
					<input type="hidden" id="mb_biz_remove_etc" name="mb_biz_remove_etc" value="<?php echo $member['mb_biz_remove_etc'];?>">
					<input type="hidden" id="mb_biz_charge_rate" name="mb_biz_charge_rate" value="<?php echo $member['mb_biz_charge_rate'];?>">
					<div class="form-group">
						<ul class="tab">
							<li class="col-xs-6 on">
								<a href="javascript:">회원정보</a>
							</li>
							
							<li class="col-xs-6">
								<a href="./mypage_review.php">후기내역</a>
							</li>
						</ul>
					</div>

					<div class="form-group">
						<h2 class="txt_title"><span>센터종류</span></h2>
					</div>
					
					<div class="form-group">
						<ul class="way" id="divBizType">
						</ul>
					</div>

					<div class="form-group">
						<h2 class="txt_title"><span>센터정보</span></h2>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="title col-md-2">센터이름</li>
							<li class="title col-md-10"><span id="bizname"></span></li>
						</ul>
					</div><!-- 센터이름 -->
					<div class="form-group">
						<ul class="row">
							<li class="title col-md-2">이메일</li>
							<li class="title col-md-10"><span id="email"></span></li>
						</ul>
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
						<ul class="row">
							<li class="title col-md-2">사업번호</li>
							<li class="title col-md-10"><input type="number" id="mb_biz_num" name="mb_biz_num"  value="<?php echo $member['mb_biz_num'];?>"></li>
						</ul>
					</div><!-- 사업자번호 -->
					<div class="form-group">
						<ul class="row">
							<li class="title col-md-2">은행명</li>
							<li class="title col-md-10"><input type="hidden" name="mb_bank" id="mb_bank" value="NH농협">
						<select id="mb_bank_select">
							<option <?php if($member['mb_bank'] == 'NH농협'): ?> selected='selected'<?php endif ?>value="NH농협">NH농협</option>
							<option <?php if($member['mb_bank'] == '우리은행'): ?> selected='selected'<?php endif ?>value="우리은행">우리은행</option>
							<option <?php if($member['mb_bank'] == '국민은행'): ?> selected='selected'<?php endif ?>value="국민은행">국민은행</option>
							<option <?php if($member['mb_bank'] == '기업은행'): ?> selected='selected'<?php endif ?>value="기업은행">기업은행</option>
							<option <?php if($member['mb_bank'] == '신한은행'): ?> selected='selected'<?php endif ?>value="신한은행">신한은행</option>
							<option <?php if($member['mb_bank'] == '하나은행'): ?> selected='selected'<?php endif ?>value="하나은행">하나은행</option>
							<option <?php if($member['mb_bank'] == 'SC은행'): ?> selected='selected'<?php endif ?>value="SC은행">SC은행</option>
							<option <?php if($member['mb_bank'] == '카카오뱅크'): ?> selected='selected'<?php endif ?>value="카카오뱅크">카카오뱅크</option>
							<option <?php if($member['mb_bank'] == '산업은행'): ?> selected='selected'<?php endif ?>value="산업은행">산업은행</option>
							<option <?php if($member['mb_bank'] == '대구은행'): ?> selected='selected'<?php endif ?>value="대구은행">대구은행</option>
							<option <?php if($member['mb_bank'] == '광주은행'): ?> selected='selected'<?php endif ?>value="광주은행">광주은행</option>
							<option <?php if($member['mb_bank'] == '전북은행'): ?> selected='selected'<?php endif ?>value="전북은행">전북은행</option>
							<option <?php if($member['mb_bank'] == '한국씨티은행'): ?> selected='selected'<?php endif ?>value="한국씨티은행">한국씨티은행</option>
							<option <?php if($member['mb_bank'] == '부산은행'): ?> selected='selected'<?php endif ?>value="부산은행">부산은행</option>
							<option <?php if($member['mb_bank'] == '수협은행'): ?> selected='selected'<?php endif ?>value="수협은행">수협은행</option>
							<option <?php if($member['mb_bank'] == '경남은행'): ?> selected='selected'<?php endif ?>value="경남은행">경남은행</option>
							<option <?php if($member['mb_bank'] != 'NH농협' &&
$member['mb_bank'] != '우리은행' &&
$member['mb_bank'] != '국민은행' &&
$member['mb_bank'] != '기업은행' &&
$member['mb_bank'] != '신한은행' &&
$member['mb_bank'] != '하나은행' &&
$member['mb_bank'] != 'SC은행' &&
$member['mb_bank'] != '카카오뱅크' &&
$member['mb_bank'] != '산업은행' &&
$member['mb_bank'] != '대구은행' &&
$member['mb_bank'] != '광주은행' &&
$member['mb_bank'] != '전북은행' &&
$member['mb_bank'] != '한국씨티은행' &&
$member['mb_bank'] != '부산은행' &&
$member['mb_bank'] != '수협은행' &&
$member['mb_bank'] != '경남은행'): ?> selected='selected'<?php endif ?>value="기타은행입력">기타은행입력</option>
						</select></li>
						</ul>
					</div><!-- 사업자번호 -->
					<div class="form-group" style="display: none"  id="mb_bank_txt_area">
						<ul>
							<li class="title col-md-2"></li>
							<li class="title col-md-10"><input id="mb_bank_txt" type="text" value="<?php echo $member['mb_bank']; ?>" name="mb_bank_txt" placeholder="은행명"></li>
						</ul>
					</div>
					<div class="form-group">
						<ul>
							<li class="title col-md-2">계좌번호</li>
							<li class="title col-md-10">
							<input type="number" id="mb_bank_num" name="mb_bank_num" aria-describedby="계좌번호" placeholder="정산계좌번호" value="<?php echo $member['mb_bank_num'];?>"></li>
						</ul>
					</div>
					

					<div class="form-group">
						<input type="text" id="mb_hp" name="mb_hp" aria-describedby="센터전화번호" placeholder="센터전화번호" value="<?php echo $member['mb_hp'];?>">
						<p class="input_error error" id="lbl_phone">8-16자 영문과 숫자를 조합해 주세요</p>
					</div><!-- 센터전화번호 -->

					<div class="form-group">
						<ul class="row">
							<li class="col-xs-4 col-md-3"><input type="text" id="mb_biz_post" name="mb_biz_post" aria-describedby="우편번호" placeholder="우편번호" readonly value="<?php echo $member['mb_biz_post'];?>"></li>
							<li class="col-xs-5 col-md-6"><input type="text" id="mb_biz_addr1" name="mb_biz_addr1" aria-describedby="센터주소" placeholder="센터주소" readonly value="<?php echo $member['mb_biz_addr1'];?>"></li>
							<li class="col-xs-3 col-md-2">
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
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
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
            onresize : function(size) {
                element_wrap.style.height = size.height+'px';
            },
            width : '100%',
            height : '100%'
        }).embed(element_wrap);

        // iframe을 넣은 element를 보이게 한다.
        element_wrap.style.display = 'block';
    }
</script>								
					</div><!-- 상세주소 -->
					<div class="form-group">
						<input type="text" id="mb_biz_addr2" name="mb_biz_addr2" aria-describedby="상세주소" placeholder="상세주소" value="<?php echo $member['mb_biz_addr2'];?>">
						<p class="input_error error" id="lbl_bizAddr2" style="display:none;">8-16자 영문과 숫자를 조합해 주세요</p>
					</div><!-- 상세주소 -->

					<div class="form-group">
					    <input type="hidden" id="mb_photo" name="mb_photo" value="<?php echo $member['mb_photo'];?>">
					    <input type="hidden" id="mb_photo_rotate" name="mb_photo_rotate" value="<?php echo $member['mb_photo_rotate'];?>">
					    <input type="hidden" id="mb_photo_site" name="mb_photo_site" value="<?php echo $member['mb_photo_site'];?>">
					    <input type="hidden" id="mb_photo_site_rotate" name="mb_photo_site_rotate" value="<?php echo $member['mb_photo_site_rotate'];?>">
					    <input type="hidden" id="mb_photo_bizcard" name="mb_photo_bizcard" value="<?php echo $member['mb_photo_bizcard'];?>">
					    <input type="hidden" id="mb_photo_bizcard_rotate" name="mb_photo_bizcard_rotate" value="<?php echo $member['mb_photo_bizcard_rotate'];?>">
					    <ul class="row">
					    	<li class="col-md-4">
								<div id="divPhotoBizcard">
									<div class="estimate_image_click_bg">
										<img src="/img/common/estimate_icon_image_info.png"/>
										<p>사업자등록증 또는 명함사진</p>
									</div>
								</div>
					    	</li>
					    	<li class="col-md-4">
								<div id="divPhotoSite">
									<div class="estimate_image_click_bg">
										<a href="#none" onClick="doImageSearch('divPhotoSite','photoSite','사업장 정면 또는 내부 사진 업로드');">
											<img src="/img/common/estimate_icon_image_info.png"/>
											<p>사업장 정면 또는 내부 사진 업로드</p>
										</a>
									</div>
								</div>
					    	</li>
					    	<li class="col-md-4">
								<div id="divPhoto">
									<div class="estimate_image_click_bg">
										<a href="#none" onClick="doImageSearch('divPhoto','photo','담당자사진 업로드');">
											<img src="/img/common/estimate_icon_image_info.png"/>
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
						<input type="text" id="mb_biz_worker_name" name="mb_biz_worker_name" aria-describedby="담당자 이름" placeholder="담당자 이름" value="<?php echo $member['mb_biz_worker_name'];?>">
						<p class="input_error" id="lbl_bizWorkerName" style="display:none;">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>

					<div class="form-group">
						<input type="text" id="mb_biz_worker_phone" name="mb_biz_worker_phone" aria-describedby="담당자 휴대전화번호" placeholder="담당자 휴대전화번호" value="<?php echo $member['mb_biz_worker_phone'];?>">
						<p class="input_error" id="lbl_bizWorkerPhone" style="display:none;">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>

					<div class="form-group">
						<textarea id="mb_biz_intro" name="mb_biz_intro" placeholder="업체 소개글 " style="height:270px;"><?php echo $member['mb_biz_intro'];?></textarea>
						<p class="input_error" id="lbl_intro" style="display:none;">8-16자 영문과 숫자를 조합해 주세요</p> 
					</div>

					<div class="form-group">
						<h2 class="txt_title"><span>맞춤 견적 설정</span></h2>
					</div>

					<div id="area" class="form-group">
						
						<div class="row title full_mobile">
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
							<?php
								$sql = " select * from {$g5['member_area_table']} where mb_id = '{$member['mb_id']}' ";

								$member_area = sql_query($sql);
								for ($i=0; $row=sql_fetch_array($member_area); $i++)
								{
									echo "<p class='signup_txt_area'>";
									echo "<input type='hidden' name='mb_area1[]' value='".$row['mb_area1']."'>";
									echo "<input type='hidden' name='mb_area2[]' value='".$row['mb_area2']."'>";
									echo $row['mb_area1']."&nbsp;&nbsp;";
									if($row['mb_area2']){
										echo $row['mb_area2']."&nbsp;&nbsp;";
									}else{
										echo "전체&nbsp;&nbsp;";
									}
									echo "<a href='javascript:' class='remove_area'>";
									echo "<i class='xi-close-min'></i>";
									echo "</a></p>";
								}
							?>
							</div>
						</div>

					</div><!-- 지역 -->

					<div id="divGoodsItemList" class="form-group tab1 tab3 tabcontent current">	
						<div class="row title">
							<div class="col-xs-4 main_co full_mobile">매입품목/년식 설정</div>
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

					<div class="btn_wrap">
						<ul class="row">
							<li class="col-md-3 col-xs-6 col-md-offset-3"><a class="line_bg" href="javascript:doWithdrawal();">회원탈퇴</a></li>
							<li class="col-md-3 col-xs-6"><input class="main_bg" type="button" value="정보수정하기" onClick="fregisterform_submit();"></li>						
						</ul>
					</div>
				</form>

			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->
<script type="text/javascript">
var vEmail;
var vBizType;
jQuery(document).ready(function(){
	if($('#mb_bank_select').val() == '기타은행입력'){
		$('#mb_bank_txt_area').css('display', 'block');
	}
	$('#mb_bank_select').change(function(){
		if($(this).val() == '기타은행입력'){
			$('#mb_bank_txt_area').css('display', 'block');
			$("#mb_bank_txt").val('');
			$("#mb_bank").val('');
		}else{
			$('#mb_bank_txt_area').css('display', 'none');
			$("#mb_bank").val($(this).val());
		}
	});


	vEmail   = $("#mb_email").val();
	vBizType = $("#mb_biz_type").val();
	doSelectArea1();
	
	if(vBizType == "1"){
		$("#divGoodsItemList").show();
		$("#divRemoveItemList").hide();
	}else if(vBizType == "2"){
		$("#divRemoveItemList").show();
		$("#divGoodsItemList").hide();
	}else if(vBizType == "3"){
		$("#divGoodsItemList").show();
		$("#divRemoveItemList").show();
	}

	//alert($("#mb_biz_goods_year").val());divGoodsItem
	//alert($("#mb_biz_goods_item").val());
	//alert($("#mb_biz_remove_item").val());
	cfnBizTypesOnlyOne("divBizType", $("#mb_biz_type").val());
	cfnGoodsItem("divGoodsItem",$("#mb_biz_goods_item").val(),$("#mb_biz_goods_year").val());
	cfnRemoveItem("divRemoveItem",$("#mb_biz_remove_item").val());


	$("#email").html($("#mb_email").val());
	$("#bizname").html($("#mb_biz_name").val());

	// $("#removeEtc").val($("#mb_biz_remove_etc").val());

	doSetImage('divPhoto','mb_photo','담당자사진 업로드');
	doSetImage('divPhotoSite','mb_photo_site','사업장 정면 또는 내부 사진 업로드');
	doSetImage('divPhotoBizcard','mb_photo_bizcard','사업자등록증 업로드');


	$('input[name="goodsItem"]').click(function() {

		var vId = $(this).attr('id');
		var vIdx = vId.replace("goodsItem","");
		var vValue = $(this).val();
		if ($(this).is(':checked')) {
			if(vValue == "모두수거"){
				$("input:checkbox[name='goodsItem']").each(function(){
					this.checked = true;
				});
				for(var i=0; i<cfnGoodsItemLength()-1; i++)
				{
					$("#goodsYear"+i).show();
					$("#goodsYear"+vIdx).val("1");
				}
			}
		    $("#goodsYear"+vIdx).show();
		    $("#goodsYear"+vIdx).val("1");
		}else{
			if(vValue == "모두수거"){
				$("input:checkbox[name='goodsItem']").each(function(){
					this.checked = false;
				});
				for(var i=0; i<cfnGoodsItemLength()-1; i++)
				{
					$("#goodsYear"+i).hide();
				}
			}
			$("#goodsYear"+vIdx).hide();
		}
		
	}); 
	
	$('#goodsYear4').change(function() { 
		var vValue = $(this).val();
		for(var i=0; i<cfnGoodsItemLength()-1; i++)
		{
			$("#goodsYear"+i).val(vValue);
		}
	});
	
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
	$("#phone").inputFilter(function(value) {
		return /^\d*$/.test(value);
	});

	$("#bizWorkerPhone").inputFilter(function(value) {
		 return /^\d*$/.test(value);
	});

	$('.remove_area').click(function() {
		var $el = $(this).closest(".signup_txt_area");
		$el.remove();
	})	
});	

function doSetImage(vDiv, vComp, vTitle)
{
	if($("#"+vComp).val()){
        var vHtml2 = "";
        vHtml2 += "<div class='estimate_image_bg'>";
        vHtml2 += "<div class='estimate_image_del_bg'>";
        vHtml2 += "<a href='#none' onClick='doInitImageAjax(\""+vComp+"\",\""+vDiv+"\",\""+vTitle+"\");'>";
        vHtml2 += "<i class='xi-close-min'></i>";
        vHtml2 += "</a>";
        vHtml2 += "</div>";
        vHtml2 += "<img src='/data/estimate/"+$("#"+vComp).val()+"' style='width:100%;'/>";
        vHtml2 += "</div>";
        $("#"+vDiv).empty().html(vHtml2);
	}else{
		doInitImageAjax(vComp, vDiv, vTitle);
	}
}

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
            var fvHtml = "<option value=\"\" selected>시/도</option>";
            fvHtml += data;
            $("#area1").html(fvHtml);
            fvHtml="<option value=\"\" selected>시/구/군</option>";
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
			if($("#area1").val())
			{
				fvHtml += "<option value=\"\" selected>"+$("#area1").val()+" 전체</option>";
			}else{
				fvHtml += "<option value=\"\" selected>시/도</option>";
			}
			fvHtml += data;
			$("#area2").html(fvHtml);

        }
    });
}

function doSaveArea()
{
	if(!$("#area1").val()){
		alert("시/도를 선택하십시오.");
		return;
	}

	var area1 = $("#area1").val();
	var area2 = $("#area2").val();

	var vHtml = "";
	vHtml += "<p class='signup_txt_area'>";
	vHtml += "<input type='hidden' name='mb_area1[]' value='"+area1+"'>";
	vHtml += "<input type='hidden' name='mb_area2[]' value='"+area2+"'>";
	vHtml += area1+" "+cfNvl2(area2,"전체");
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

function fregisterform_submit(){
	//return false;

	var f = document.fregisterform;
	if(!checkFields())	 return false;

	if(f.password_new.value){
		f.mb_password.value = hex_md5(f.password_new.value);	
	}
	
	var goodsItem = "";
	var goodsYear = "";
	
	if(vBizType == "1" || vBizType == "3")
	{
		$('input[name="goodsItem"]:checked').each(function(index,item){
			if(index != 0){
				goodsItem += ",";
				goodsYear += ",";
			}
			goodsItem += $(this).val();
			
			var vId = $(this).attr('id');
			var vIdx = vId.replace("goodsItem","");
			
			if($("#goodsYear"+vIdx).val())
			{
				goodsYear += $("#goodsYear"+vIdx).val();
			}else{
				goodsYear += "0";
			}
		});		
	}
	
	var removeItem = "";
	var removeEtc = "";
	if(vBizType == "2" || vBizType == "3")
	{
		$('input[name="removeItem"]:checked').each(function(index,item){
			if(index != 0){
				removeItem += ",";
			}
			removeItem += $(this).val();
		});
		removeEtc = ("#removeEtc").val();
	}


	f.mb_biz_goods_item.value = goodsItem;
	f.mb_biz_goods_year.value = goodsYear;
	f.mb_biz_remove_item.value = removeItem;
	f.mb_biz_remove_etc.value = removeEtc;
	
	//return false;
	f.submit();

	
}

function checkFields() {  
	
	if($("#password_new").val()){
		if($("#password_new").val()!=$("#password_new_c").val()){
			alert("비밀번호와 비밀번호확인이 일치하지 않습니다.");
			return false;
		}

		if($("#password_new").val().length  < 8 || $("#password_new").val().length  > 15){
			alert("비밀번호는 8자 이상 15자 이하입니다.");
		}
	}
	if(!cfnNullCheckInput($("#mb_hp").val(), "전화번호")) return false;
	if(!cfnNullCheckInput($("#mb_biz_addr1").val(), "센터주소")) return false;
	if(!cfnNullCheckInput($("#mb_biz_addr2").val(), "센터상세주소")) return false;
	if(!cfnNullCheckInput($("#mb_biz_worker_name").val(), "담당자 이름")) return false;
	if(!cfnNullCheckInput($("#mb_biz_worker_phone").val(), "담당자 휴대전화번호")) return false;
	if(!cfnNullCheckInput($("#mb_biz_intro").val(), "업체 소개글")) return false;

	return true;
}

function doWithdrawal()
{
	if(!confirm("회원을 탈퇴하시겠습니까?"))  return;
	
	location.href = "./member_leave.php";
}
</script>
<?php
include_once('./_tail.php');
?>


<style>
    
    .input_default {margin-bottom: 10px;}
    @media(max-width:991px){
        #divGoodsItemList .col-md-4 {width: auto;}
        #divGoodsItemList .col-xs-8{width: 100%;}
        .btn_wrap .col-md-3{width: 50%;}
    }
</style>
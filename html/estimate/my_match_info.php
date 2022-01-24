<?php
include_once('./_common.php');

if($is_member)
{
	if($member['mb_level'] != "0" && $member['mb_level'] != "8"){
		alert("메인 창으로 이동합니다.",G5_URL);
	}
}


$g5['title'] = '견적현황';
include_once('./_head.php');
?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/estimate.css"/>

<div class="sub_title login">
	<h1>중고구매매칭 신청안내</h1>
	<h5>사고 싶은 중고물품 가격 비교하고 최저가로 구매하자</h5>
</div><!-- sub_title -->

<div class="estimate com_pd">
	<div class="container">

		<ul class="tab">
			<li class="col-xs-6 on">
				<a href="javascript:">신청안내</a>
			</li>
			<li class="col-xs-6">
				<a href="/estimate/my_match_list.php">나의 매칭 리스트</a>
			</li>
		</ul>

		<h1><i class="main_co match_main-title">피커스</i> 중고구매매칭 가이드</h1>
		<p class="match_main-text">피커스 매칭은 중고로 구매 하고싶은 물품에 대한 가격을 비교해주어<br>
        중고물품을 최저가로 구매할 수 있도록 매칭해 드립니다.
        </p>

        <h5 class="match_main-sub">사고 싶은 중고물품 가격 비교하고 &nbsp;<i class="main_co">최저가로 구매하자.</i></h5>


		<div class="line">
			
			<ul class="row">
				<li class="col-md-2 col-xs-4 col-md-offset-5">
					<span class="main_bg">STEP 01</span>
					<img class="mob" src="/img/estimate/estimate_icon_01.png">
				</li>
				<li class="col-md-5 col-xs-8 bg01">
					<h2>구매정보 입력</h2>
				</li>
			</ul>

			<ul class="row">						
				<li class="col-md-5 col-xs-8 bg02">
					<h2>물품 중고구매가격 비교 및 선택 결제</h2>
				</li>
				<li class="col-md-2 col-xs-4">
					<span class="main_bg">STEP 02</span>
					<img class="mob" src="/img/estimate/estimate_icon_02.png">
				</li>
			</ul>

			<ul class="row">
				<li class="col-md-2 col-xs-4 col-md-offset-5">
					<span class="main_bg">STEP 03</span>
					<img class="mob" src="/img/estimate/estimate_icon_03.png">
				</li>
				<li class="col-md-5 col-xs-8 bg03">
					<h2>물품 직배송 및 배송 완료 후 정산</h2>
				</li>
			</ul>
		</div>


<!-- 		
		<div style="overflow:hidden;">
			<div class="match_area_01">
				<h1>Step1. 구매정보 입력</h1>
				<img src="/img/estimate/estimate_icon_01.png">
			</div>
			<div class="match_area_02">
				<h1>Step2. 물품 중고구매가격 비교 및 선택결제</h1>
				<p>*기본 3개월 A/S*</p>
				<img src="/img/estimate/estimate_icon_02.png">
			</div>
			<div class="match_area_03">
				<h1>Step3. 물품 직배송 및 배송 완료 후 정산</h1>
				<img src="/img/estimate/estimate_icon_03.png">
			</div>
		</div> -->



		<div id="board">
			<div class="btn_wrap">
				<ul class="row match_main-btn">
					<li class="col-xs-4 text-center">
						<a class="main_bg match_main-btn-text" href="#none" onclick="doMoveRegist();">중고구매 비교견적받기</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="form_wrap" id="divNotLogin">
			<form>
				<div class="form-group" id="divLoginSelect" style="display:none;">
					<ul class="tab">
						<li class="col-xs-6 main_bg on" data-tab="tab1">
							<a href="#none">
								<span>비회원이세요?</span>
								<h4>본인확인</h4>
							</a>
						</li>
						<li class="col-xs-6" data-tab="tab1">
							<a href="#none" onClick="doMoveLogin();">
								<span>본인확인 없이!</span>
								<h4>로그인</h4>
							</a>
						</li>
					</ul>
				</div>

				<div class="form-group" id="divLoginNickName" style="display:none;">
					<input type="text" id="nickname" aria-describedby="이름" placeholder="이름">
					<p class="input_error error" id="lbl_nickname">8-16자 영문과 숫자를 조합해 주세요</p>
				</div>

				<div class="form-group" id="divLoginEmail" style="display:none;">
					<input type="text" id="email" aria-describedby="이메일" placeholder="이메일">
					<p class="input_error error" id="lbl_email">8-16자 영문과 숫자를 조합해 주세요</p>
				</div>

				<div class="form-group" id="divLoginPhone" style="display:none;">
					<input type="text" id="phone" aria-describedby="휴대폰 번호" placeholder="휴대폰 번호">
					<p class="input_error error" id="lbl_phone">8-16자 영문과 숫자를 조합해 주세요</p>
				</div>
				<div class="form-group" id="divLoginAgree" style="display:none;">
					<label for="pbAgree" name="pbAgree_lbl">
						<input type="checkbox" id="pbAgree"/><i></i>&nbsp;&nbsp;본인은
						<a class="main_co" href="#" data-toggle="modal" data-target="#terms">이용약관</a> 및 
						<a class="main_co" href="#" data-toggle="modal" data-target="#privacy">개인정보보호방침</a>에 대한 내용을 모두 이해하였으며 이에 동의합니다.
					</label>
				</div>
				<div class="form-group" id="divLoginContent" style="display:none;">
					<textarea id=content placeholder="기타 참고가 가능한 매입하실 품목과 폐기물, 철거/원상복구 내역을 넣어주세요." style="height:270px;"></textarea>
					<p class="input_error" id="lbl_intro" style="display:none;">8-16자 영문과 숫자를 조합해 주세요</p> 
				</div>

				<div class="btn_wrap" id="divLoginBtnEstimete"  style="display:none;">
					<ul class="row">
						<!--<li class="col-md-4 col-md-offset-2"><input class="line_bg" type="submit" value="간편신청" onClick="doSignup();"></li>-->
						<li class="col-md-6  col-md-offset-3"><input id="btnSave" class="main_bg" type="button" value="견적신청하기" onClick="doSaveNotLogin();"></li>
					</ul>
				</div>
				
				<div class="btn_wrap" id="divLoginBtnEstimete4"  style="display:none;">
					<ul class="row">
						<!--<li class="col-md-4 col-md-offset-2"><input class="line_bg" type="submit" value="간편신청" onClick="doSignup();"></li>-->
						<li class="col-md-6  col-md-offset-3"><input id="btnSave" class="main_bg" type="button" value="견적신청하기" onClick="doSaveEstimate4();"></li>
					</ul>
				</div>
								
			</form>
		</div><!-- form_wrap -->
	</div><!-- container -->
</div><!-- member -->
<script>
jQuery(document).ready(function(){
	$("#phone").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});
})

function doInit()
{
	$("#divLoginSelect").hide();
	$("#divLoginNickName").hide();
	$("#divLoginEmail").hide();
	$("#divLoginPhone").hide();
	$("#divLoginContent").hide();
	$("#divLoginAgree").hide();
	$("#divLoginBtnEstimete").hide();
	$("#divLoginBtnEstimete4").hide();
	
}

function doMoveRegist()
{
	doInit();
<?php 
	if ($is_member) {
?>
	location.href = "./my_match_register1A.php";
<?php 
	} else {
?>
	//doMoveLogin();
	location.href = "./my_match_register1A.php";
<?php 
	}
?>
}

function doMoveLogin()
{
	location.href="<?php echo G5_BBS_URL;?>/login.php?turnUrl=/estimate/my_match_register_form.php";
}
</script>
<?php
include_once('./_tail.php');
?>

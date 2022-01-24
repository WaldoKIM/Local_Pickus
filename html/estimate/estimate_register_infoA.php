<?php
include_once('./_common.php');


$g5['title'] = '견적신청안내';
include_once('./_head.php');
?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/estimate.css"/>
<div class="sub_title login">
	<h1>신청안내</h1>
	<h5>신속하고 간편한 무료비교견적</h5>
</div><!-- sub_title -->

<div class="estimate com_pd">
	<div class="container">

		<ul class="tab">
			<li class="col-xs-6 on">
				<a href="#none">신청안내</a>
			</li>
			<li class="col-xs-6">
				<a href="./estimate_registerA.php">견적신청</a>
			</li>
		</ul>

		<h1><i class="main_co">피커스</i> 견적 신청절차</h1>
		<div class="line">
			
			<ul class="row">
				<li class="col-md-2 col-xs-4 col-md-offset-5">
					<span class="main_bg">STEP 01</span>
					<img class="mob" src="/img/estimate/estimate_icon_01.png">
				</li>
				<li class="col-md-5 col-xs-8 bg01">
					<h2>철거유형선택</h2>
					<p class="tt_left">
						<i class="sub_co">1. 중고가전가구매입</i>  - 하나의 품목으로 여러업체 견적비교 <br>
						<i class="sub_co">2. 다량매입</i> – 가정,사무,업소 등 다량 일괄 매입 견적비교<br>
						<i class="sub_co">3. 철거/원상복구</i> – 가정,사무,업소 등 철거/원상복구 견적비교<br>
						<i class="sub_co">4. 매입+철거</i> – 기업 이사/정리 시 매입과 철거/원상복구 한번에 비교견적
					</p>
				</li>
			</ul>

			<ul class="row">						
				<li class="col-md-5 col-xs-8 bg02">
					<h2>본인확인</h2>
					<p class="tt_right">비회원도 신청가능합니다.<br><br> 허위매물 견적 방지 및 정확한 고객 견적, 일회성 견적을 위한 비회원 신청도 가능합니다. </p>
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
					<h2>견적정보입력</h2>
					<p class="tt_left">
						<i class="sub_co">물품 판매 시</i> 가전/가구의 제조사, 모델명, 년식의 정보와 사진을 함께 넣어주세요.<br/>
						<i class="sub_co">철거 시</i>에는 각 철거할 부분에 대한 사진과 내역에 대해 상세히 작성해 주세요.
						<br/><br/>
						<a class="main_bg" href="#." data-toggle="modal" data-target="#img_guide">사진등록 가이드</a><br/>
						*수거불가품목*<br/>
						파손, 심각한 생활기스가 있는 물건<br/>
						수리가 필요한 물건<br/>
						6년 이상된 사무용가구<br/><i class="gray_co">(상태 좋으면 무료수거는 가능)</i><br/>
						7년 이상된 가정용가구<br/><i class="gray_co">(상태 좋으면 무료수거는 가능)</i><br/>
						10년 이상된 가전<br/><i class="gray_co">(상태 좋으면 무료수거는 가능)</i>
					</p>
				</li>
			</ul>

			<ul class="row">						
				<li class="col-md-5 col-xs-8 bg04">
					<h2>견적 비교 및 선택</h2>
					<p class="tt_right">고객님의 올려주신 정보를 통해 업체서 최고가 매입과 최저가 철거 견적을 비교하고 업체를 선택해 주세요.</p>
				</li>
				<li class="col-md-2 col-xs-4">
					<span class="main_bg">STEP 04</span>
					<img class="mob" src="/img/estimate/estimate_icon_04.png">
				</li>
			</ul>

			<ul class="row">
				<li class="col-md-2 col-xs-4 col-md-offset-5">
					<span class="main_bg">STEP 05</span>
					<img class="mob" src="/img/estimate/estimate_icon_05.png">
				</li>
				<li class="col-md-5 col-xs-8 bg05">
					<h2>업체 방문 수거 및 철거 완료</h2>
					<p class="tt_left">선택하신 업체서 고객과의 일정 조율 후 방문 수거 및 철거를 진행 합니다.</p>
				</li>
			</ul>

		</div><!-- line -->

		<div id="board">
			<div class="btn_wrap">
				<ul class="row">
					<li class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5" style="margin-left:75px;">
                         <a class="main_bg" href="./estimate_register1A.php" style="width:180px;">가전/가구매입 신청</a>
                         <a class="main_bg" href="./estimate_register2B.php" style="width:180px;">다량매입 신청</a>
                         <a class="main_bg" href="./estimate_register3A.php" style="width:180px;">철거/원상복구 신청</a>
                         <a class="main_bg" href="./estimate_register4.php" style="width:180px;">기업전용 매입철거 신청</a>
					</li>
				</ul>
			</div>
        </div>
                       <!--PC-->
                       <div class="btn_estimate4">
                            <div class="btn_est1"><a href="./estimate_register1A.php">가전/가구매입 신청</a></div>
                            <div class="btn_est1"><a href="./estimate_register2B.php">다량매입 신청</a></div>
                            <div class="btn_est1"><a href="./estimate_register3A.php">철거/원상복구 신청</a></div>
                            <div class="btn_est1"><a href="./estimate_register4.php">기업전용 매입철거 신청</a></div>
                            </div>

                            <!-- <div class="btn_estimate5">
                            <div class="btn_est2"><a href="#">가전/가구매입 신청</a></div>
                            <div class="btn_est2"><a href="#">다량매입 신청</a></div>
                            <div class="btn_est2"><a href="#">철거/원상복구 신청</a></div>
                            <div class="btn_est2"><a href="#">기업전용 매입철거 신청</a></div> -->


	</div><!-- container -->
</div><!-- member -->
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
					<h5>철거/원상복구 시</h5>
					<ul>
						<li>
							<img src="/img/estimate/estimate_popup05.png">
							붙박이장
						</li>
						<li>
							<img src="/img/estimate/estimate_popup06.png">
							가벽철거
						</li>
						<li>
							<img src="/img/estimate/estimate_popup07.png">
							내부철거
						</li>
						<li>
							<img src="/img/estimate/estimate_popup08.png">
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
<script>
	$(".mob_back").hide();
</script>
<?php
include_once('./_tail.php');
?>

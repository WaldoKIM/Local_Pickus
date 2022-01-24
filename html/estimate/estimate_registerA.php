<?php
include_once('./_common.php');


$g5['title'] = '견적신청안내';
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

<div class="sub_title login">
	<h1>견적신청</h1>
	<h5>신속하고 간편한 무료비교견적</h5>
</div><!-- sub_title -->

<div class="choice com_pd">
	<div class="container">

		<ul class="tab">
			<li class="col-xs-6">
				<a href="./estimate_register_infoA.php">신청안내</a>
			</li>
			<li class="col-xs-6 on">
				<a href="javascript:">견적신청</a>
			</li>
		</ul><!-- tab -->

		<div class="box_01">

			<ul class="row">
				<li class="col-md-3">
					<a id="registEstimate1" href="javascript:doMoveRegist('estimate_register1A')">
						<img src="/img/estimate/estimate_img01.jpg">
						<h4 class="main_co">가전/가구 매입<br/><br/><i></i></h4>
						<p>중고 가전/가구, 주방.카페집기 등 <br class="web" />여러 매입가 견적을 <br class="web" />받고 싶어요.</p>
						<span class="main_bg">바로가기</span>
					</a>
				</li>
				<li class="col-md-3">
					<a id="registEstimate2" href="javascript:doMoveRegist('estimate_register2B')">
						<img src="/img/estimate/estimate_img02.jpg">
						<h4 class="main_co">대량 매입<br/><br/><i></i></h4>
						<p>가정집, 사무실, 업소, 학원,등 <br class="web" />일괄품목 매입가 <br class="web" />견적을 받고 싶어요.</p>
						<span class="main_bg">바로가기</span>
					</a>
				</li>
				<li class="col-md-3">
					<a id="registEstimate3" href="javascript:doMoveRegist('estimate_register3A')">
						<img src="/img/estimate/estimate_img03.jpg">
						<h4 class="main_co">철거/원상 복구<br/><br/><i></i></h4>
						<p>가정집, 사무실, 업소, 학원 등 <br class="web" />여러 폐기물 및 철거/원상복구 <br class="web" />견적을 받고 싶어요.</p>
						<span class="main_bg">바로가기</span>
					</a>
				</li>
				<li class="col-md-3">
					<a id="registEstimate4" href="javascript:doMoveRegist('estimate_register4')">
						<img src="/img/estimate/estimate_img04.jpg">
						<h4 class="main_co">원스톱 중고매입+철거<br/>(기업고객전용)<i></i></h4>
						<p>기업 이사/정리 시 <br class="web" />중고매입과 폐기물, 철거/원상복구 <br class="web" />한번에 비교견적 받고 싶어요.</p>
						<span class="main_bg">바로가기</span>
					</a>
				</li>
			</ul>

		</div><!-- box_01 -->

<!-- 견적 신청 부분 아래쪽 이미지 부분 -->
		<div class="est_main_footer mt5">
			<!-- 밑에 선 부분
			<svg style="position: absolute; width:100%; height:50%;">
			  <line x1="10%" y1="52.5%" x2="89%" y2="68%" style="position: absolute; stroke:rgb(0,0,0);stroke-width:1" />
			</svg>
			<svg style="position: absolute; width:100%; height:40%;">
			  <line x1="9.9%" y1="8.1%" x2="9.9%" y2="63.8%"style="position:absolute;stroke:rgb(0,0,0);stroke-width:1" />
			</svg>
			<svg style="position: absolute; width:100%; height:50%; display:none;">
			  <line x1="10%" y1="40%" x2="89%" y2="55.5%" style="position: absolute; stroke:rgb(0,0,0);stroke-width:1" />
			</svg>
			-->

			<div class="workflow chap01">
				<img src="/img/estimate/work_flow_img01.png">
				<p>1 STEP</p>
				<p>정보입력</p>
				<p>
					고객 판매 품목 및 사진 또는 철거 내역 정보를 상세히 작성 후 업체 소개를 받으세요
				</p>
				<!--<p>●</p>-->
			</div>
			<div class="workflow_white"></div>
			<div class="workflow chap02">
				<img src="/img/estimate/work_flow_img02.png">
				<p>2 STEP</p>
				<p>업체견적산출</p>
				<p>
					업체를 통해 견적서를 받아보고 비교해 보세요. 다량 매입 및 철거는 방문 견적 진행이 될 수도 있습니다.
				</p>
				<!--<p>●</p>-->
			</div>
			<div class="workflow_white"></div>
			<div class="workflow chap03">
				<img src="/img/estimate/work_flow_img03.png">
				<p>3 STEP</p>
				<p>업체선택 및 결제</p>
				<p>
					원하는 업체 선택 후 수거/철거 날짜 조율 합니다. 진행 완료 후에 정산이 완료 됩니다.
				</p>
				<!--<p>●</p>-->
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
				<!--<p>●</p>-->
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
	</div><!-- container -->
</div><!-- member -->
<script>
$(".mob_back").hide();
var vUrl = "";

function doMoveRegist(fvFlag)
{
	var vUrl ="<?php echo G5_URL;?>/estimate/"+fvFlag+".php";
<?php 
	if ($is_member) {
?>
	location.href = vUrl;
<?php 
	} else {
?>
	location.href = vUrl;
	//doMoveLogin();
<?php 
	}
?>
}

function doMoveLogin()
{
	location.href="<?php echo G5_BBS_URL;?>/login.php?turnUrl="+vUrl;
}

</script>
<?php

include_once('./_tail.php');
?>

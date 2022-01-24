<?php
include_once('./_common.php');

include_once('./_head.php');

?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<style type="text/css">
	.mob_back{display: none !important;}
	.col-md-9.at-col.at-main{width: 100%;}
	.member div{width: 100%;} 
</style>
<div class="member guide">
	<div class="sub_title" style="background-image: url('/img/bg_guide.png');">
		<h1 class="main_co">중고구매 매칭 가이드</h1>
		<p class="tit_desc">깨끗하게 케어된 제품을 알뜰하게 매칭!<br/>
		검증되어 믿을 수 있는 전문 업체가 추천해드립니다. 
		</p>
	</div>
	<div class="section_1">
		<div class="container">
			<h2>꼭 필요했던 가전/가구
			A/S 걱정 없이 안심하고 구입하길 원할 땐<br/>
			<strong>이젠＇피커스＇에게 맡기세요!</strong>
			</h2>
			<div class="sec_icon">
				<div class="icon_area">
					<img src="/img/gstep1.png">
				</div>
				<div class="icon_area">
					<img src="/img/gstep2.png">
				</div>
				<div class="icon_area">
					<img src="/img/gstep3.png">
				</div>
				<div style="overflow: hidden; width: 100%; display: block; float: unset;">
					<button onclick="window.location.href='/estimate/estimate_match.php'">중고구매 비교견적 받기</button>
					<!-- <button onclick="txt_show()">중고구매 비교견적 받기</button> -->
				</div>
			</div>
			</div>
		</div>
	</div>
</div><!-- member -->
<script type="text/javascript">
	function txt_show(){
		//alert("내일 오픈합니다.");
	}
</script>
<?php
include_once('./_tail.php');
?>


<style>
    
    .input_default {margin-bottom: 10px;}
    @media(max-width:991px){
        #divGoodsItemList .col-md-4 {width: auto;}
    }
</style>
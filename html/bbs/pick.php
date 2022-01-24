<?php
include_once('./_common.php');

include_once('./_head.php');

?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<style type="text/css">
	.member div{width:100%;}
	.mob_back{display: none !important;}
    #fixed_kakao{display: block !important;}
	.at-content h2{text-align: center; padding: 30px 0;}
	.at-main h2{padding-top: 40px; text-align: center; font-size: 36px; color: #232323; padding-bottom: 60px;}
	.at-main h3{margin-top: 10px;}
	#area1{margin-bottom: 10px;}
	.col-md-9.at-col.at-main{width: 100%;}
	.member .sub_title{margin-bottom: 0;}
	.tit_co{color: #fff !important; font-size: 26px !important;}
	.at-main h2{font-size: 26px; text-align: center;}
	.sub_title{height: 300px; margin-bottom: 0;}
	.sub_title h1{padding-top: 93px; margin-bottom: 36px; text-align: center;}
	.sub_title h2,.sub_title p{color: #fff;}
	.sub_title h2{font-size: 35px !important; margin-bottom: 30px;  text-align: center; padding-top: 0; padding-bottom: 0;}
	.sub_title .tit_desc{font-size: 20px !important}
	.section_1{background-color: #f4f5f9;}
	.section_1 h2{text-align: center;}
	.section_1 .icon_area{width: 33.33%; float: left; text-align: center;}
	.section_1 .icon_area h3{padding: 15px 0 20px;}
	.section_1 .icon_area p{color: #878787; line-height: 30px; font-size: 18px;}
	.section_1 .icon_area img{max-width: 210px;}
	.section_1 .sec_icon{ overflow: hidden; padding-bottom: 80px;}
	.section_2{background-color: #fff;}
	.section_2 #img_per{max-width: 700px; margin: 0 auto; display: block;}
	.section_2 .tit_center h2{padding-bottom: 0;}
	.section_2 .tit_center h3{text-align: center; color: #878787; font-size: 26px; margin-top: 0; margin-bottom: 40px;}
	.section_2 .orange_line{text-align: center;}
	.section_2 .orange_line img{max-width: 700px;}
	.section_2 .orange_line .orange_section{padding-bottom: 90px; overflow: hidden;}
	.section_2 .orange_line .orange_set{width: 35%; float: left; }
	.section_2 .orange_line .orange_set:nth-of-type(2){float: right;}
	.section_2 .orange_line .orange_set p{margin-top: 30px; font-size: 20px; color: #878787; line-height: 28px;}
	.section_2 .orange_line .orange_box{ background-color: #fe8e3a; color: #fff; border-radius: 50px; max-width: 430px; padding: 5px 0; text-align: center;margin:0 auto;margin-top: 25px;}
	.section_3{background: url('/img/bg_process.png');}
	.section_3 .step_join{width: 32.3%; float: left;background: url('/img/img_ball.png'); background-repeat: no-repeat; background-position: center; height: 210px;}
	.section_3 .arrow_join{width: 1%; float: left; padding-top: 95px;}
	.section_3 h2{color: #fff;}
	.section_3 .step_join h4{color: #fff; margin-top: 40px; text-align: center; font-size: 21px;}
	.section_3 .step_join h5{font-size: 20px; margin-top: 40px;}
	.section_3 .step_join{text-align: center;}
	.section_3 button{width: 320px; height: 60px; background-color: #1379cd; color: #fff; text-align: center; font-size: 21px; margin: 0 auto;
		display: block; margin-bottom: 40px; margin-top: 50px;}
	.section_4{padding-bottom: 100px;}
	.section_4 .title{font-size: 21px; color: #232323;}
	.section_4 button{width: 320px; height: 60px; background-color: #1379cd; color: #fff; text-align: center; font-size: 21px; margin: 0 auto;
		display: block; margin-bottom: 30px; margin-top: 60px;}

	.img_dda{max-width: 40px; margin-left: 10px; margin-right: 10px; padding: 3px; margin-top: -5px;}
	.form_contact{background-color: #fff; padding: 45px;}
	.form_contact .row li{margin-bottom: 25px;}
	.form_contact .row{max-width: 700px; margin: 0 auto;}
	@media (min-width: 600px){
		.tit_desc br,
		.section_2 br,
		.section_bonus br{display: none;}

	}
	@media (max-width: 768px){
		.at-main h2{font-size: 26px; text-align: center;}
		.at-main h3{font-size: 20px;}
		.at-content h2{text-align: center; padding: 25px 0;font-size: 26px; }
		.orange_box h3{padding: 0 20px; margin-top: 0; font-size: 16px;}
		.sub_title{height: 300px;}
		.sub_title h1{font-size: 25px !important; margin-top: -40px;}
		.sub_title h2{font-size: 28px !important; padding: 10px 0;}
		.sub_title .tit_desc{line-height: 24px;font-size: 18px !important;}
		.section_1 .icon_area p{font-size: 14px; line-height: 24px;}
		.section_2 .tit_center h3{font-size: 18px;}
	}

	@media (max-width: 480px){
		.at-main h3{font-size: 18px;}
		.section_1 .icon_area h3{padding-bottom: 0;}
		.sub_title .tit_desc{padding: 0 20px;}
		.section_1 .icon_area{width: 100%;}
		.section_1 .icon_area p{margin-bottom: 60px;}
		.section_1 .sec_icon{padding-bottom: 50px;}
		.section_2 .orange_line .orange_set p{font-size: 14px; margin-top: 10px; line-height: 20px;}
		.section_2 .orange_line .orange_set p br{display: none;}
		.section_2 .orange_line img{width: 70%;}
		.section_3 .arrow_join{display: none;}
		.section_3 .step_join{width: 100%;}
		.section_4 .title{font-size: 18px;}
		.form_contact{padding: 20px;}
		.form_contact .col-xs-6{width: 100%;}
		.section_4 button{margin: 50px 0; width: 100%; height: 55px; font-size: 19px;}

	}
</style>
<div class="member ">
	<div class="sub_title" style="background-image: url('/img/bg_partner.png');">
		<h1 class="tit_co">피커스 파트너스</h1>
		<h2>고객과 쉽게 만날 수 있는 방법</h2>
		<p class="tit_desc">피커스는 언제나 빠르게<br/> 원하는 고객을 만날 수 있습니다.</p>
	</div>
	<div class="section_1">
		<div class="container">
			<h2>파트너는 어떤 일을 하게 되나요?</h2>
			<div class="sec_icon">
				<div class="icon_area">
					<img src="/img/ico_1.png">
					<h3>중고매입</h3>
					<p>매입 신청내역에<br/>
					비용을 지불하고 운반해 옵니다.</p>
				</div>
				<div class="icon_area">
					<img src="/img/ico_2.png">
					<h3>중고판매</h3>
					<p>물품 등록 및 고객이 원하는<br/>
					물품을 제시하고 판매합니다.</p>
				</div>
				<div class="icon_area">
					<img src="/img/ico_3.png">
					<h3>철거/원상복구</h3>
					<p>철거 신청내역에 대해<br/>
					처리 후 정산이 됩니다.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="section_2">
		<div class="container">
			<h2>파트너에게 제공되는<br/> 서비스는 무엇인가요?</h2>
			<img src="/img/img_per.png" id="img_per">
			<div class="tit_center">
				<h2>마케팅 지원</h2>
				<h3>매입/판매가 잘되도록 마케팅을 지원합니다.</h3>
			</div>
			<div class="orange_line">
				<img src="/img/line_orange.png">
				<div class="orange_section">
					<div class="orange_set">
						<div class="orange_box"><h3>업체 전용 서비스제공</h3>
						</div>
						<p>고객 관리 및 스케줄 관리 빠른 고객문의 및 
						<br/>추천으로 편리하게 진행을 도와 드립니다.</p>
					</div>
					<div class="orange_set">
						<div class="orange_box"><h3>온라인 마켓</h3>
							
						</div>
						<p>쉬운 물품 등록부터, 판매까지 쉽게
							<br/>고객 매칭을 도와 드립니다. </p>
					</div>
				</div>
			</div>
		</div>
	</div><!-- container -->
	<div class="section_bonus">
		<div class="container">
			<h2><img class="img_dda" src="/img/dda_front.png"> 전국에서 함께 일할<br/> 업체 사장님을 모십니다. <img class="img_dda" src="/img/dda_back.png"></h2>
		</div>
	</div>
	<div class="section_3">
		<div class="container">
			<h2> 파트너즈 회원가입 방법</h2>
			<div class="step_join">
				<h4>Step 1</h4>
				<h5>업체 정보, 사업자<br/> 등록 확인</h5>
			</div>
			<span class="arrow_join"><img src="/img/arr_ball.png"></span>
			<div class="step_join">
				<h4>Step 2</h4>
				<h5>활동지역 설정 및 <br/>맞춤견적 설정</h5>
			</div>
			<span class="arrow_join"><img src="/img/arr_ball.png"></span>
			<div class="step_join">
				<h4>Step 3</h4>
				<h5>업체 <br/>승인 후 활동</h5>
			</div>
			<div style="overflow: hidden; width: 100%; display: block; float: unset;">
				<button onclick="location.href='/bbs/register_customer_form.php'">회원가입하기</button>
			</div>
		</div>
	</div>
	<div class="section_4">
		<div class="container">
		<h2><span style="color: #1379cd;">파트너즈</span> 상담문의</h2>
		<form class="form_contact" method="post" action="/bbs/pick_update.php" enctype="multipart/form-data" class="form_order sell_single">
				<div class="form-group">
					<ul class="row">
						<li class="col-md-2 title">업체명</li>
						<li class="col-md-10 col-xs-6">
							<input required="" type="text" name="company">
						</li>
					</ul>
					<ul class="row">
						<li class="col-md-2 title">성함</li>
						<li class="col-md-10 col-xs-6">
							<input required="" type="text" name="name">
						</li>
					</ul>
					<ul class="row">
						<li class="col-md-2 title">전화번호</li>
						<li class="col-md-10 col-xs-6">
							<input required="" type="number" name="phone">
						</li>
					</ul>
					<ul class="row">
						<li class="col-md-2 title">지역</li>
						<li class="col-md-10 col-xs-6">
							<select required="" id="area1" name="area1">
								<option>선택하세요</option>
								<option>서울</option>
								<option>경기</option>
								<option>강원</option>
								<option>경남</option>
								<option>경북</option>
								<option>충남</option>
								<option>충북</option>
								<option>전남</option>
								<option>전북</option>
								<option>제주</option>
							</select>
							<select required="" id="area2" name="area2">
								<option>선택하세요</option>
							</select>
						</li>
					</ul>
					<button>파트너즈 문의하기</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- member -->
<?php
include_once('./_tail.php');
?>

<script type="text/javascript">
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
		doSelectArea1();
		doSelectArea2();
</script>
<style>
    
    .input_default {margin-bottom: 10px;}
    @media(max-width:991px){
        #divGoodsItemList .col-md-4 {width: auto;}
    }
</style>
<?php
include_once('./_common.php');


$g5['title'] = '견적신청안내';
include_once('./_head.php');
?> 
<script src="http://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="/bbs/js/jQuery/jquery-ui.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="http://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/bbs/css/main.css">
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/estimate.css"/>
<div class="sub_title login">
	<h1>견적신청</h1>
	<h5>신속하고 간편한 무료비교견적</h5>
</div><!-- sub_title -->
<style type="text/css">
    #fixed_kakao{display: block !important;}
	#quick li a{color: #fff !important;}
	.row{display: flex;flex-wrap: wrap;}
	#free_estimate{width: 200px; height: 40px; color: #fff !important; margin-top: 15px; background-color: #fe8e3a !important; float: right; border:1px solid #ededed; font-size: 21px; padding: 12px 0; border-radius: 0;}
	/*.ui-widget.ui-widget-content{padding-bottom: 40px;}*/
	.container{max-width: 1200px; margin: 0 auto; position: relative; width: 1200px; padding: 0 !important;}
	ul.container{border:1px solid #ccc;}
	.how > .how_slider > .service> .serv_box > .swiper-slide .swiper_box{
		padding-bottom: 0 !important;
	}
	.options{overflow: hidden; margin-bottom: 60px;}
	.options #star_tit{position: absolute; max-width: 35px;}
	.options ul li{float: left; width: 25%; padding: 40px; text-align: center; transition: all 0.3s; background-color: #fff; border-left: 1px solid #ccc; height: 270px;}
	.options ul li img{width: 75%; max-height: 110px;}
	.options ul li:nth-of-type(1){border-left: 0;}
	.options ul li .options_info{text-align: center; margin: 0 auto;background-color: #fff; padding: 20px;}
	.options ul li:nth-of-type(2) .options_info{margin-top: 13px;}
	.options ul li:nth-of-type(3) img{width: 62%;}
	.options ul li:nth-of-type(4) img{width: 65%;}
	.options ul li .options_info h3{font-size: 22px; font-weight: bold; color: #333; margin-top: 0; font-family: 'NanumBarunGothic'; margin-bottom: 10px;}
	.options ul li:hover{background: linear-gradient(43deg, rgba(230,240,244,1) 50%, rgba(193,221,232,1) 50%);}
	.options.second ul{text-align: center;}
	.options.second ul li{border: 1px solid #ccc !important;}
	.options.second ul li:first-of-type{visibility: hidden;}
	.options.second ul li:nth-of-type(2) .options_info{margin-top: 0;}
	.options.second ul li:last-of-type{visibility: hidden;}
	.options ul li a{transition: all 0.3s;}
	.options h2{color: #fff; margin-bottom: 20px; text-align:center; line-height: 50px; font-size: 28px; }
	.options h2 span{font-weight: bold; font-size: 32px;}
	#tit_op{padding-bottom: 40px;}
	.sub_title{margin-bottom: 30px;}
	.experience_con{padding-top: 80px; background-color:#f7faff; }
	.experience_con .experience_tit{font-size: 32px; margin-bottom: 50px; text-align: center;}
	.experience_con .experience_tit span{color:#1379cd;}
	.experience_box{text-align: center; overflow: hidden; }
	.experience_box img{max-width: 800px;}
	.experience_box h2{font-size: 24px; font-weight: bold;}
	.experience_box h2 span{color: #1379cd; display: inline-block; margin-right: 10px;}
	.experience_box a{position: absolute; width: 200px; height: 40px; right: 30%; bottom: 18%; text-align:center;  font-size: 21px; background-color: #fff; color: #fe8e3a; padding: 12px 0;}

	.experience_box .ex_left{float: left; padding:40px 0; text-align: left;} 
	.experience_box .ex_left h2{margin-bottom: 20px;}
	.experience_box .ex_left ul li{font-size: 16px; line-height: 30px; letter-spacing: 0.5px; list-style: disc; text-indent: 20px;}
	.experience_box .ex_left p{font-size: 16px; line-height: 30px; letter-spacing: 0.5px;}
	.experience_box .ex_left button{width: 100px; padding: 10px 0; height: 40px; letter-spacing: -1px; font-size: 16px !important; color: #1379cd;  border:2px solid #1379cd; margin-top: 15px; cursor: pointer;}
	.experience_box .ex_left .ex_guide{font-weight: bold; font-size: 20px; line-height: 28px; margin-top: 20px;}
	.experience_box .ex_right{float: right; padding-top: 80px;}
	.experience_con .swiper-container{ padding:10px 0 60px; overflow: hidden;}
	.experience_con .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets{top: 10px !important; display: none;}
	.experience_con .swiper-pagination-bullet-active{color: #fff !important; background:#1379cd !important;}
	.experience_con .swiper-pagination-bullet{width: 35px !important; height: 35px !important; line-height: 35px !important; color: #333; opacity: 1; background:#ddd;}
	.experience_con .swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet{margin: 0 8%;}
	.experience_con .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets:before{width: 100%; height: 2px; content: ""; background-color: #ddd; display: block; position: absolute; top: 17px; z-index: -1;}
	.options ul li{position: relative;}
	.options ul li span{position: absolute; top: -5%; left: -16%; font-size: 20px;  background-color: #1379cd; color: #fff; padding: 10px; border-radius: 5px;}
	.options{padding-top: 12px;}
	@media screen and (max-width : 600px) {
		.options{margin-bottom: 0;}
		.options ul li{padding: 15px;}
		.options ul li .options_info{max-height: 130px;}
		.options ul li:nth-of-type(2) .options_info{margin-top: 0;}
		.options ul li:nth-of-type(3), .options ul li:nth-of-type(4){display: none;}
		.options ul li span{left: -24%; }
		.options.second ul li:first-of-type{display: none;}
		.options.second ul li:nth-of-type(3), .only_m ul li:nth-of-type(4){display: block;}
		.experience_con .experience_tit{font-size: 27px;}
		.only_m{display: block !important;}
		.only_m ul li:nth-of-type(2) img{width: 55%;}
		.only_m ul li:nth-of-type(3), .only_m ul li:nth-of-type(4){display: block;}
		.only_m ul li:nth-of-type(4){display: none;}
		.options.second ul li:nth-of-type(2) h3{margin-top: 5px !important;}
		.experience_box a{right: 20%; width: 120px; font-size: 12px; padding: 0; line-height: 28px; height: 30px;}
	}

</style>
<div class="choice com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co" style="color: #000 !important;">전문가를 통한 믿을 수 있는 거래 <span style="color:#1379cd">'피커스'</span></h1>
		</div>
		<div class="options">
			<h3 id="tit_op">원하시는 서비스를 선택해주세요</h3>
			<ul class="container">
				<span></span>
				<li>
					<a href="/estimate/estimate_register1B.php">
						<img src="/img/main_icon_btn1.png">
						<div class="options_info">
							<h3>가전/가구 판매</h3>
							<p>중고 가전/가구 처리<br/>단일품목 처리</p>
						</div>
					</a>
				</li>
				<li>
					<a href="/estimate/estimate_register2D.php">
						<img src="/img/main_icon_btn2.png">
						<div class="options_info">
							<h3>다량판매</h3>
							<p>가정.사무.업소<br/>다량 일괄 처리</p>
						</div>
					</a>
					<span>중고처리</span>
				</li>
				<li>
					<a href="/estimate/estimate_register3B.php">
						<img src="/img/main_icon_btn4.png">
						<div class="options_info">
							<h3>철거/원상복구</h3>
							<p>가정.사무.업소<br/>철거 및 원상복구</p>
						</div>
					</a>
				</li>
				<li>
					<a href="/estimate/estimate_register4.php">
						<img src="/img/main_icon_btn5.png">
						<div class="options_info">
							<h3>기업전용</h3>
							<p>기업 매입 및 철거<br/>한번에 처리</p>
						</div>
					</a>
					<span>공간처리</span>

				</li>
			</ul>
		</div><!-- box_01 -->
		<div class="options second only_m" style="display: none;">
			<ul>
				<li></li>
				<li>
					<a href="/estimate/estimate_register3B.php">
						<img src="/img/main_icon_btn4.png">
						<div class="options_info">
							<h3>철거/원상복구</h3>
							<p>가정.사무.업소<br/>철거 및 원상복구</p>
						</div>
					</a>
				</li>
				<li>
					<a href="/estimate/estimate_register4.php">
						<img src="/img/main_icon_btn5.png">
						<div class="options_info">
							<h3>기업전용</h3>
							<p>기업 매입 및 철거<br/>한번에 처리</p>
						</div>
					</a>
					<span>공간처리</span>

				</li>
				<li></li>
			</ul>
		</div>
<!-- 견적 신청 부분 아래쪽 이미지 부분 -->
		<div class="options second">
			<ul>
				<li></li>
				<li>
					<a href="/bbs/guide.php">
						<img src="/img/main_icon_btn3.png">
						<div class="options_info">
							<h3>구매매칭</h3>
							<p>원하는 물품 업체 매칭<br/>합리적인 가격</p>
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<img src="/img/main_icon_btn6.png">
						<div class="options_info">
							<h3>중고마켓</h3>
							<p>내가 원하는 물품 및 <br/>업체 찾아보기 </p>
						</div>
					</a>
					<span>중고구매</span>
				</li>
				<li></li>
			</ul>
		</div>

	</div><!-- container -->
	
	<div class="experience_con">
		<div class="container">
			<style type="text/css">
				 .how{
  
}
 .how > h2{
  font-size: 50px;
  text-align: center;
  font-weight: bold;
}
 .how > p{
  text-align: center;
  margin: 0;
  line-height: 80px;
  font-size: 20px;
}
 .how > .how_slider{

}
 .how > .how_slider > .service{
  margin: 0 auto;
  position: relative;
}
 .how > .how_slider > .service> .btn{
  position: relative;
  top: 50%;
  display: flex;
  height: 100%;
}
 .how > .how_slider > .service> .btn > a.prev{
  background: url(/bbs/images/how_btn_prev.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 45px;
  height: 100px;
  position: absolute;
  left: 0;
  top: 200px;
}
.swiper-slide {
  padding: 0 5% 0 5%;
  /* margin: 0 !important; */
  box-sizing: border-box;
  border-radius: 25px;
  padding-bottom: 30px;
}
 .how > .how_slider > .service> .btn > a.next{
  background: url(/bbs/images/how_btn_next.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 45px;
  height: 100px;
  position: absolute;
  right: 0;
  top: 200px;
  background-size: 100%;
}
 .how > .how_slider > .service> .serv_box{
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .swiper_box{box-sizing: border-box;box-shadow: 0 5px 30px #d0d0d0;border-radius: 25px;padding-bottom: 50px;}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .tit{
  text-align: center;
  background: #407bff;
  border-radius: 25px 25px 0 0;
  padding: 10px 0;
  color: #fff;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .tit > span{
  font-size: 20px;
  margin: 10px 0;
  display: block;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .tit > h3{
  font-size: 35px;
  font-weight: bold;
  margin: 15px 0;
}

 .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > ul{
  display: flex;
  justify-content: center;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li{
  margin: 30px 1.5%;
  font-weight: 500;
  cursor: pointer;
  position: relative;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li > a > em{
  font-style: normal;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > ul > li span{
  display: inline-block;position: absolute;height: 10px;width: 0; transition: all 0.15s ease-out 0s;bottom: 0;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li a{
  color: #a9a9a9 !important;
  text-align: center;
  display: block;
  transform: translate(0);
  text-decoration: none;
  font-size: 25px;
  width: 100%;
  }
 .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > ul > .ui-state-active a{
  color: #000 !important;
  font-weight: bold;
}

 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > .ui-state-active span{
  width: 100%;bottom: 0;left: 0;
  background: #ffe400;
  font-weight: bold;;
}

 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li:hover span{
  width: 100%;bottom: 0;left: 0;
  background: #ffe400;
  font-weight: bold;;
}

.conbox_txt{
  line-height: 30px;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox{text-align: center;display: flex;justify-content: center;align-items: center;position: relative;line-height: 0px;}
 .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox > span{
  background-size: cover;
  background: url(/bbs/images/how_con01.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 230px;
  height: 150px;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox > p{
  font-size: 22px;
  padding: 0px 30px;
  display: inline-block;
}
.conbox_txt p{
  font-size: 18px;
}
.serv_con {border-bottom-right-radius: 15px; border-bottom-left-radius: 15px;}
 .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox > em{
  font-size: 15px;
  padding:0 10px;
  float: left;
  display: inline-block;
  color: #999;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_02 > span{
  background-size: cover;
  background: url(/bbs/images/how_con02.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_03 > span{
  background: url(/bbs/images/how_con09.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  background-size: 160px;
  height: 150px;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_04 > span{
  background-size: cover;
  background: url(/bbs/images/how_con04.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_05 > span{
  background: url(/bbs/images/how_con03.png)no-repeat center;
  text-indent: -9999px;
  width: 190px;
  background-size: 190px;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_06 > span{
  background: url(/bbs/images/how_con07.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
  background-size: 170px;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_07 > span{
  background: url(/bbs/images/how_con08.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
  background-size: 160px;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_08 > span{
  background: url(/bbs/images/how_con08.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
  background-size: 160px;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_09 > span{
  background: url(/bbs/images/how_con08.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
  background-size: 160px;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_10 > span{
  background-size: cover;
  background: url(/bbs/images/how_con10.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
}
 .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_11 > span{
  background: url(/bbs/images/how_con06.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
  background-size:160px
}

.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active{background-color: transparent !important;}

.tab .on{
	border : none !important;
}

 .how > .how_slider > .service> .serv_box > .swiper-slide > .serv_con > .conbox p{
  padding: 0 2%;
  font-size: 20px;
}
@media(max-width: 1200px){
	.how > .how_slider > .service> .btn > a.prev{
  background: url(../images/how_btn_prev.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 45px;
  height: 100px;
  position: absolute;
  left: 0;
  top: 200px;
}
.swiper-slide {
  padding: 0 8% 0 8%;
  /* margin: 0 !important; */
  box-sizing: border-box;
  border-radius: 25px;
  padding-bottom: 50px;
}
.how > .how_slider > .service> .btn > a.next{
  background: url(../images/how_btn_next.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 45px;
  height: 100px;
  position: absolute;
  right: 0;
  top: 200px;
  background-size: 100%;
}
.how > .how_slider > .service> .serv_box > .swiper-slide  .tit > h3{
  font-size: 35px;
  margin: 15px 0;
}
 
.how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li a{
  font-size: 15px;
  }
.how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > ul >  span{width: 100%;bottom: 0;left: 0;}

.how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > .ui-state-active:hover span,
.how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li:active span{
  width: 100%;bottom: 0;left: 0;
  font-weight: bold;;
}
.how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox{
  display: none;
}
.how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox{
  display: flex;
  justify-content: center;
  align-items: center;
}
.how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox > p{
  font-size: 18px !important;
  padding:0 10px;
  text-align: center;
}
.how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_02 > span{
  background-size: cover;
  background: url(../images/how_con02.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
}
.how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_03 > span{
  background-size: cover;
  background: url(../images/how_con03.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
}
.how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > .conbox_04 > span{
  background-size: cover;
  background: url(../images/how_con04.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
}
.how > .how_slider > .service> .serv_box > .swiper-slide > .serv_con > .conbox_05 > span{
  background-size: cover;
  background: url(../images/how_con05.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
}
.how > .how_slider > .service> .serv_box > .swiper-slide > .serv_con > .conbox_06 > span{
  background-size: cover;
  background: url(../images/how_con06.png)no-repeat center;
  text-indent: -9999px;
  display: inline-block;
  width: 160px;
  height: 150px;
}
.how > .how_slider > .service> .serv_box > .swiper-slide > .serv_con > .conbox p{
  padding: 0 2%;
  font-size: 20px;
}
}
@media(max-width: 1000px){
	 .how > h2{
  font-size: 40px;
  margin: 30px 0;
  }
  .how > p{
    line-height: 30px;
    font-size: 12px;
  }
  .how > .how_slider > .service> .btn > a.prev{
    background: url(../images/how_btn_prev.png)no-repeat center;
    text-indent: -9999px;
    display: inline-block;
    width: 45px;
    height: 100px;
    position: absolute;
    left: 0;
    top: 130px;
    background-size: 30px;
  }
  .how > .how_slider > .service> .serv_box {
    height: 350px;
}
  .swiper-slide {
    padding: 0 12%;
    /* margin: 0 !important; */
    box-sizing: border-box;
    border-radius: 25px;
    padding-bottom: 50px;
  }
  .how > .how_slider > .service> .btn > a.next{
    background: url(../images/how_btn_next.png)no-repeat center;
    text-indent: -9999px;
    display: inline-block;
    width: 45px;
    height: 100px;
    position: absolute;
    right: 0;
    top: 130px;
    background-size: 30px;
  }
  .how > .how_slider > .service> .serv_box > .swiper-slide  .swiper_box{padding-bottom: 10px;}
 
  .how > .how_slider > .service> .serv_box > .swiper-slide  .tit > span{
    font-size: 15px;
  }
  .how > .how_slider > .service> .serv_box > .swiper-slide  .tit > h3{
    font-size: 20px;
    margin: 10px 0;
  }
  
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > ul{
    width: 100%;
    flex-wrap: wrap;
  }
  .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li{
    margin: 30px 0%;
    width: 30.3%;
    margin: 10px 7px;
    display: flex;
  }
  .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li a{
    text-align: center;
    margin: 0 auto;
    }
  .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li:hover span,
  .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li:active span{
    width: 100%;bottom: 0;left: 0;
    font-weight: bold;;
  }
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox{
    display: none;
  }
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox{
    display: block;
    margin: 30px 0;
  }
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox > span,
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox_02 > span,
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox_03 > span,
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox_04 > span,
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox_05 > span,
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox_06 > span,
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox_07 > span,
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox_08_> span,
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox_09 > span,
  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox_10 > span{
  display: none;
  }
  
  .how > .how_slider > .service> .serv_box > .swiper-slide > .serv_con > .conbox p{
    padding: 0 2%;
    font-size: 20px;
  }
}
	.ui-tabs .ui-tabs-nav li{white-space: normal}
.ui-tabs .ui-tabs-nav .ui-tabs-anchor{padding: 0;}
.ui-widget.ui-widget-content{border:0;}
@media(max-width: 768px){
	#free_estimate{width: 150px; height: 35px; color: #fff !important; margin:0 auto;margin-top: 15px; background-color: #fe8e3a !important; border:1px solid #ededed; font-size: 17px; padding: 9px 0; float: none !important; border-radius: 0;}
	#txt_last{width: 80% !important;}
	.how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > ul > li {
    margin: 30px 0%;
    width: calc(50% - 20px);
    margin: 10px 7px;
    display: flex;
  }
}
@media(max-width: 480px){
		.how > h2{
		  font-size: 30px;
		}
		.how > .how_slider > .service> .btn > a.prev{
		    background: url(../images/how_btn_prev.png)no-repeat center;
		    text-indent: -9999px;
		    display: inline-block;
		    width: 45px;
		    height: 100px;
		    position: absolute;
		    left: 0;
		    top: 130px;
		    background-size: 30px;
		}
		.swiper-slide {
		    padding: 0 18% 50px 18%;
		}
		  .how > .how_slider > .service> .btn > a.next{
		    background: url(../images/how_btn_next.png)no-repeat center;
		    text-indent: -9999px;
		    display: inline-block;
		    width: 45px;
		    height: 100px;
		    position: absolute;
		    right: 0;
		    top: 130px;
		    background-size: 30px;
		  }
		  .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li{
		    font-size: 13px;
		    position: relative;
		    margin: 10px 7px;
		  }
		  .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li a{
		    font-size: 13px;
		    }
		   .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > ul > .ui-state-active a{
		    color: #000 !important;
		    font-weight: bold;
		    word-break: keep-all;
		  }
		  
		  .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li:hover span,
		  .how > .how_slider > .service> .serv_box > .swiper-slide  .serv_con > ul > li:active span{
		    width: 100%;bottom: 0;left: 0;
		    font-weight: bold;;
		  }
		  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox{
		    display: none;
		  }
		  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox{
		    display: block;
		    margin: 20px 0;
		  }
		  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox > span{
		  display: none;
		  }
		  .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > .conbox > p{
		    font-size: 12px;
		    padding:0 10px;
		    display: block;
		    text-align: center;
		  }
		  
		  .how > .how_slider > .service> .serv_box > .swiper-slide > .serv_con > .conbox p{
		    padding: 0 2%;
		    font-size: 20px;
		  }
	}
			</style>
      <div style="display: flex; justify-content: center; margin-bottom: 10%;">
      <?include_once('../main_guide.php');?>
      </div>
		<div style="display:none;" class="how">
          <h2>피커스 사용법</h2>
          <p>피커스만의 편리하고 안전한 프로세스를 경험해보세요.</p>
          <div class="how_slider">
            <div class="service swiper-container swiper1 swiper-container-initialized swiper-container-horizontal">
              <div class="btn">
                <a href="" class="prev swiper-button-prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true">이전</a>
                <a href="" class="next swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false">다음</a>
              </div>
              <div class="serv_box swiper-wrapper">
                <div class="swiper-slide swiper-slide-active" style="width: 1200px;">
                  <div class="swiper_box">
                    <div class="tit">
                      <span>STEP 1</span>
                      <h3>서비스 선택</h3>
                    </div>
                    <div class="serv_con tab ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs1">
                      <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                        <li class="on ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true"><span></span><a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-1">중고판매</a></li>
                        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false" aria-expanded="false"><span></span><a href="#tabs-2" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-2">다량판매</a></li>
                        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="false" aria-expanded="false"><span></span><a href="#tabs-3" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-3">철거/원상복구</a></li>
                        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-4" aria-labelledby="ui-id-4" aria-selected="false" aria-expanded="false"><span></span><a href="#tabs-4" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-4">기업 전용(매입+철거)</a></li>
                        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-5" aria-labelledby="ui-id-5" aria-selected="false" aria-expanded="false"><span></span><a href="#tabs-5" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-5">중고 구매 매칭</a></li>
                        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-6" aria-labelledby="ui-id-6" aria-selected="false" aria-expanded="false"><span></span><a href="#tabs-6" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-6">피커스 마켓</a></li>
                      </ul>
                      <div id="tabs-1" class="conbox_01 conbox on ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false">
                        <span>icon</span>
                        <p>가전/가구 매입 연결</p>
                      </div>
                      <div id="tabs-2" class="conbox_02 conbox ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-2" role="tabpanel" aria-hidden="true" style="display: none;">
                        <span>icon</span>
                        <div class="conbox_txt"><p>가정,사무,업소 이사 및 정리 등 다량 매입 업체 연결</p></div>
                      </div>
                        <div id="tabs-3" class="conbox_03 conbox ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                        <span>icon</span>
                        <div class="conbox_txt"><p>가정,사무,업소,철거/원상 복구 업체 연결</p></div>
                      </div>
                      <div id="tabs-4" class="conbox_04 conbox ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-4" role="tabpanel" aria-hidden="true" style="display: none;">
                        <span>icon</span>
                        <div class="conbox_txt"><p>기업 이사 및 정리 시 매입과 철거를 한번에</p>
                     </div> </div>
                      <div id="tabs-5" class="conbox_05 conbox ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-5" role="tabpanel" aria-hidden="true" style="display: none;">
                        <span>icon</span>
                        <div class="conbox_txt"><p>원하는 가전/가구 구매 연결</p></div>
                      </div>
                      <div id="tabs-6" class="conbox_06 conbox ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-6" role="tabpanel" aria-hidden="true" style="display: none;">
                        <span>icon</span>
                        <div class="conbox_txt"> <p>중고 가전/가구 판매몰</p></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide swiper-slide-next" style="width: 1200px;">
                  <div class="swiper_box">
                  <div class="tit">
                    <span>STEP 2</span>
                    <h3>견적 정보 입력</h3>
                  </div>
                  <div class="serv_con tab ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs2">
                    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                      <li class="on ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-7" aria-selected="true" aria-expanded="true"><span></span><a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-7">물품 판매시</a></li>
                      <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-2" aria-labelledby="ui-id-8" aria-selected="false" aria-expanded="false"><span></span><a href="#tabs-2" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-8">물품 구매 시</a></li>
                      <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-3" aria-labelledby="ui-id-9" aria-selected="false" aria-expanded="false"><span></span><a href="#tabs-3" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-9">철거 진행 시</a></li>
                       </ul>
                    <div id="tabs-1" class="conbox_07 conbox on ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-7" role="tabpanel" aria-hidden="false">
                      <span>icon</span>
                      <div class="conbox_txt"><p>가전.가구 제조사, 모델명, 년식 정보와 사진을 함께 넣어주세요.</p>
                    
                    </div>  </div>
                    <div id="tabs-2" class="conbox_08 conbox ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-8" role="tabpanel" aria-hidden="true" style="display: none;">
                      <span>icon</span>
                      <div class="conbox_txt"><p>구매하고자 하는 물품 정보와 예상 비용을 입력해주세요.</p>
                   </div></div>
                    <div id="tabs-3" class="conbox_09 conbox ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-9" role="tabpanel" aria-hidden="true" style="display: none;">
                      <span>icon</span>
                     
                      <div class="conbox_txt"><p>각 철거 내역 사진과 정보에 대해 상세히 작성해주세요.</p>
                      <em>※ 다량 매입 및 철거의 경우 정확한 견적을 위해 업체 방문이 진행 될 수 있습니다.</em></div>
                    </div>
                  </div>
                </div>
                </div>

                <div class="swiper-slide" style="width: 1200px;">
                  <div class="swiper_box">
                  <div class="tit">
                    <span>STEP 3</span>
                    <h3>업체 견적 확인 및 선택</h3>
                  </div>
                  <div class="serv_con tab ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs3">
                    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                      <li id="txt_last" data-id="con1" class="on ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-10" aria-selected="true" aria-expanded="true"><span></span><a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-10">피커스에서는 전문 업체를 통해 내용에 맞는 적정 견적을 안내합니다.</a></li>
                       </ul>
                    <div id="tabs-1" class="conbox_10 conbox on ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-10" role="tabpanel" aria-hidden="false">
                      <span>icon</span>
                      <div class="conbox_txt">
                      <p>고객님께서 전문 업체 견적을 확인하고 선택</p>
                      </div>
                    </div>
                     </div>
                  </div>
                </div>

                <div class="swiper-slide" style="width: 1200px;">
                  <div class="swiper_box">
                  <div class="tit">
                    <span>STEP 4</span>
                    <h3>업체 방문 수거/철거, 배송 완료</h3>
                  </div>
                  <div class="serv_con tab ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs4">
                    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                      <li id="txt_last" data-id="con1" class="on ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-11" aria-selected="true" aria-expanded="true"><span></span><a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-11">선택하신 업체에서 고객님과의 일정 조율 후 방문 수거/철거 및 배송을 진행합니다.</a></li>
                      
                    </ul>
                    <div id="tabs-1" class="conbox_11 conbox on ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-11" role="tabpanel" aria-hidden="false">
                      <span>icon</span>
                      <div class="conbox_txt">
                      <p>선택하신 업체에서 고객님과의 일정 조율 후 방문 수거/철거 및 배송을 진행합니다.</p>
                      <a id="free_estimate" href="/estimate/estimate_register.php" style="">무료로 견적 신청</a>
                    </div>
                    </div>
                    
                  </div>
                </div>
                </div>
              </div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
          </div>
        </div>
	</div>
</div><!-- member -->
<link rel="stylesheet" type="text/css" href="/css/swiper.min.css">
<script type="text/javascript" src="/js/swiper.min.js"></script>
  <!-- Initialize Swiper -->
<script>
	$(function () {
      $( "#tabs1" ).tabs();
      $( "#tabs2" ).tabs();
      $( "#tabs3" ).tabs();
      $( "#tabs4" ).tabs();
		new Swiper('.swiper1', {
		      pagination : { // 페이징 설정
		        el : '.swiper-pagination',
		        clickable : true, // 페이징을 클릭하면 해당 영역으로 이동, 필요시 지정해 줘야 기능 작동
		      },
		      navigation : { // 네비게이션 설정
		        nextEl : '.swiper-button-next', // 다음 버튼 클래스명
		        prevEl : '.swiper-button-prev', // 이번 버튼 클래스명
		      },
		    });
	});

</script>
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

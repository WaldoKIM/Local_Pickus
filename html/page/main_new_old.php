<link rel="stylesheet" type="text/css" href="/css/swiper.min.css">
<style type="text/css">
	strong{font-weight: 600;}
	.at-container{max-width: unset;}
	.col-md-9{width: 100%; padding: 0;}
	.container{max-width: 1200px; margin: 0 auto; position: relative; width: 1200px; padding: 0 !important;}
	a:hover{text-decoration: none;}
	.options{overflow: hidden; background-image: url('/img/bg_main.png'); padding: 50px 0;}
	.options #star_tit{position: absolute; max-width: 35px;}
	.options h2{color: #fff; margin-bottom: 25px; text-align:center; line-height: 25px; font-size: 20px; letter-spacing: 2px; font-weight: 600;}
	.options h2 span{ font-size: 35px; letter-spacing: 0; font-weight: 400;}
	.area_estimate ul li{float: left; width: 33.33%; padding: 40px; text-align: center; transition: all 0.3s; background-color: #fff; height: 270px;}
	.area_estimate ul li img{width: auto; max-height: 110px;}
	.area_estimate ul li .options_info{text-align: center; margin: 0 auto; background-color: #fff; padding: 20px;}
	.area_estimate ul li .options_info h3{font-size: 22px; font-weight: 600; color: #333; margin-top: 0; font-family: 'NanumBarunGothic'; margin-bottom: 10px;}
	
	.area_estimate ul li:hover{background: linear-gradient(43deg, rgba(230,240,244,1) 50%, rgba(193,221,232,1) 50%);}
	.area_estimate ul li:last-child img{margin-bottom: 18px;}
	.area_estimate ul li a{transition: all 0.3s;}
	.titles{text-align: center; margin-bottom: 50px; position: relative; }
	.titles h1{font-size: 34px;}
	.titles .more_view{position: absolute; right: 0; top: 50%; transform: translateY(-50%);}
	.titles .more_view a{font-size: 16px;}
	.titles span{color: #1379cd;}
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
	.swiper-button-prev{left: 155px;}
	.swiper-button-next{right: 155px;}
	.swiper-button-next, .swiper-button-prev{background-size: 90px; width: 90px; height: 90px;}
	.experience_con .swiper-pagination-bullet{width: 35px !important; height: 35px !important; line-height: 35px !important; color: #333; opacity: 1; background:#ddd;}
	.experience_con .swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet{margin: 0 8%;}
	.experience_con .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets:before{width: 100%; height: 2px; content: ""; background-color: #ddd; display: block; position: absolute; top: 17px; z-index: -1;}
	.customer_review_m{display: none; background-color: #fff;}
	.customer_review{padding-top: 80px; padding-bottom: 100px; background-color: #fff;}
	.customer_review .swiper-container{overflow: hidden;}
	.customer_review .swiper-button-next{display: none;}
	.customer_review .swiper-button-prev{display: none;}
	.customer_review .review_box{background-color: #fff; 
		padding: 20px 20px 50px; border:1px solid #d2d2d2;}
	.customer_review .review_box p{display: inline-block; }
	.customer_review .review_box .rating{display: inline-block; float: right;}
	.review_tit{padding-bottom: 10px; border-bottom: 1px solid #d2d2d2; margin-bottom: 10px;}
	.review_tit p{font-size: 16px; font-weight: bold; color: #333;}
	.rating{color: #d20000; font-size: 16px;}
	.review_desc{padding: 20px 0;}
	.review_desc p{font-size: 14px; line-height: 20px;}
	.review_desc:hover p{text-decoration: underline;}
	.pickus_pick{padding-top: 80px; background-color: #efefef; padding-bottom: 100px;}
	.pickus_box{float: left; width: 24.2%; text-align: center;transition: all 0.3s; border: 1px solid #cfcfcf; padding:10px; background-color: #fff;} 

	.pickus_box + .pickus_box{margin-left: 1%;}
	.pickus_box img{width: 100%; max-height: 178px;}
	.pickus_box a{padding-bottom: 30px;}
	.pick_desc{ text-align: left !important; background-color: #fff; padding-bottom: 40px;}
	.pick_desc img{width: 20px; height: 5px;}
	.pick_desc h3{font-size: 18px; font-weight: 600; margin-top: 0; margin-bottom: 0; padding-top: 15px; padding-bottom: 10px; height: 47px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;}
	.pick_desc p {line-height: 20px; }
	.pickus_banner{background-color: #fff;}
	.partners{padding-top: 80px; background-image: url('/img/main_footer_img.png'); background-repeat: no-repeat; padding: 5% 0; background-size: cover; overflow: hidden;}
	.partners h1{padding: 0 0 3% 0; font-weight: 200; color: #fff; font-size: 30px; line-height: 44px;}
	.partners a{display: inline-block; width: 30%; padding: 20px 0; height: 55px; letter-spacing: -1px; font-size: 22px !important; color: #fff; background:#1379cd;}
	.partners .container{width: 50%; float: left;}
	.swiper-button-next{background-image: url('/img/right_nav.png') !important;}
	.swiper-button-prev{background-image: url('/img/left_nav.png') !important;}
	.swiper_pick_m{display: none;}
	.pc_img{display: block;}
	
	@media screen and (max-width : 1200px) {
		.container{padding: 0 15px !important; width: 100%;}
		.options h2 {font-size: 18px; line-height: 20px;}
		.options h2 span{font-size: 25px; margin-bottom: 20px;}
		.area_estimate ul li{width: 50%; }
		.area_estimate ul li img{height: 78px;}
		.area_estimate ul li:last-child img{margin-bottom: 0;}
		.experience_con .swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet{margin: 0 5%;}
		.experience_con .experience_tit{font-size: 28px; text-align: center;}
		.experience_box .ex_right{float: unset; text-align: center;}
		.pickus_box{padding: 0 10px;}
	}

	@media screen and (max-width : 768px) {
		.area_estimate{margin-top: 40px;}
		.area_estimate ul li{width: 50%; padding: 15px; height: 190px;}
		.area_estimate ul li .options_info{padding: 10px 0;}
		.area_estimate ul li .options_info h3{font-size: 16px;}
		.experience_con{margin-top: 20px; padding-top: 20px;}
		.experience_con .experience_tit{font-size: 24px; line-height: 37px; text-align: center; margin-bottom: 10px;}
		.experience_con .swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet{margin: 0 3%;}
		.swiper-button-next, .swiper-button-prev{background-size: 60px; width: 60px; height: 60px; top: auto; bottom: 0;}
		.swiper-button-next{right: 0;}
		.swiper-button-prev{left: 0;}
		.experience_box .ex_left{padding: 0 0 40px;}
		.experience_box h2{font-size: 16px;}
		.experience_box .ex_left p{font-size: 13px; line-height: 24px;}
		.experience_box .ex_left .ex_guide{font-size: 16px;}
		.experience_box .ex_right{float: unset; text-align: center;}
		.experience_box .ex_right img{width: 100%; max-width: 150px;}
		.experience_box a{right: 20%; width: 120px; font-size: 12px; padding: 0; line-height: 28px; height: 30px;}
		.titles h1{font-size: 24px;}
		.titles .more_view a{font-size: 14px;}
		.pickus_pick{margin-top: 80px;}
		.pickus_box{padding-top: 10px; width: 100%; float: unset; margin-bottom: 30px;}
		.pickus_box a{width: 100%;}
		.pickus_box a img{width: 100%;}
		.pick_desc{padding: 0; padding-bottom: 30px;}
		.pick_desc h3{font-size: 16px;}
		.pickus_banner{padding-bottom: 0 !important;}
		.partners h1{font-size: 22px;}
		.partners a{font-size: 16px !important; padding: 16px 0; height: 50px;}
		.partners ul li{width: 48%; padding: 0; margin-right: 4%; margin-bottom: 20px;}
		.partners ul li:nth-of-type(even){margin-right: 0 !important}
		.partners ul li h3{font-size: 15px;}
		.partners ul li p{font-size: 12px;}
		.customer_review_pc{display: none;}
		.customer_review_m{display: block;}
		.pickus_box + .pickus_box{margin-left: 0;}
	}
	@media screen and (max-width : 600px) {
		.pc_img{display: none;}
		.m_img{display: block;}
		.options ul li .options_info{max-height: 130px;}
		.swiper_pick_m{display: block;}
		.pickus_box.pc{display: none;}
		.pickus_box{border-right: 0;}
		.pickus_box:last-of-child{border-right: 1px solid #2d2d2d;}
	}
</style>
<div class="wrap">
	<!-- OPTIONS -->
	<div>
		<div class="options">
			<div class="container">
				<h2><span>우리동네 재활용센터, 피커스</span><br/><br/>중고 전문가를 통한 안심(알뜰)거래부터<br/>
				공간정리까지 한번에
				</h2>
			</div>
		</div>
	</div>
	<!-- OPTIONS -->
	<div class="area_estimate">
		<ul class="container">
			<li>
				<a href="/estimate/estimate_register1B.php">
					<img src="/img/main_box.png">
					<div class="options_info">
						<h3>가전/가구 매입</h3>
						<p>중고가전/가구<br/>단일 품목 처리</p>
					</div>
				</a>
			</li>
			<li>
				<a href="/estimate/estimate_register2D.php">
					<img src="/img/main_buy.png">
					<div class="options_info">
						<h3>다량매입</h3>
						<p>가정.사무.업소<br/>다량 일괄 처리</p>
					</div>
				</a>
			</li>
			<li>
				<a href="/estimate/estimate_register3B.php">
					<img src="/img/main_chul.png">
					<div class="options_info">
						<h3>철거/원상복구</h3>
						<p>가정.사무.업소<br/>철거 및 원상복구</p>
					</div>
				</a>
			</li>
			<li>
				<a href="/estimate/estimate_register4.php">
					<img src="/img/main_comp2.png">
					<div class="options_info">
						<h3>기업전용</h3>
						<p>기업 매입 및 철거<br/>한번에 처리</p>
					</div>
				</a>
			</li>
			<li>
				<a href="/bbs/guide.php">
					<img src="/img/main_match.png">
					<div class="options_info">
						<h3>구매매칭</h3>
						<p>중고 구매 물품<br/>전문 업체 매칭</p>
					</div>
				</a>
			</li>
			<li>
				<a href="#">
					<img src="/img/main_shop.png">
					<div class="options_info">
						<h3>중고마켓</h3>
						<p>내가 원하는 중고 및 업체<br/>찾아보기</p>
					</div>
				</a>
			</li>
		</ul>
	</div>
	<!-- EXPERIENCE -->
	<div class="experience_con">
		<div class="container">
		<h1 class="experience_tit"><strong><span>피커스</span></strong>만의 <strong>편리하고 안전한<br/> 프로세스</strong>를 경험해보세요</h1>
		<div class="swiper-container swiper_ex">
			<div class="swiper-wrapper">
				<div class="experience_box swiper-slide">
					<img src="/img/step1.png">
				</div>
				<div class="experience_box swiper-slide">
					<img src="/img/step2.png">
				</div>
				<div class="experience_box swiper-slide">
					<img src="/img/step3.png">
				</div>
				<div class="experience_box swiper-slide">
					<img src="/img/step4.png">
					<a href="/estimate/estimate_register.php">무료로 견적 신청</a>
				</div>
				<!-- <div class="experience_box swiper-slide">
					<div class="ex_left">
						<h2><span>STEP.5</span>업체 방문 수거 및 철거 완료</h2>
						<h3>다 끝났습니다 !</h3>
						<p>선택하신 업체서 고객과의 일정 조율 후 방문 수거 및 철거를 진행 합니다.</p>
						<button>견적신청</button>
					</div>
					<div class="ex_right">
						<img src="/img/pick5.png">
					</div>
				</div>	 -->
			</div>
				<!-- Add Pagination -->
				<!-- If we need pagination -->
			    <div class="swiper-pagination pagination-bottom"></div>
				<!-- Add Arrows -->
			    <div class="swiper-button-next"></div>
			    <div class="swiper-button-prev"></div>
		</div>
		</div>
	</div>
	<!-- EXPERIENCE -->
	<!-- CUSTOMER REVIEW PC-->
	<div class="customer_review customer_review_pc">
		<div class="container">
			<div class="titles">
				<h1><strong><span>피커스</span></strong> 써 본 사람만 아는 <strong>생생한 후기</strong></h1>
			</div>
			<div class="swiper-container swiper_review">
				<div class="swiper-wrapper">
					<div class="review_box swiper-slide">
						<div class="review_tit"><p>아름***님</p>
							<div class="rating">★★★★★</div>
						</div>
						
						<div class="review_desc">
							<p>많은 말 이름과 어머님, 아무 다 벌써 있습니다. 한 이국 때 마리아 봅니다. 하늘에는 했던 옥 위에 벌써 그리워 별 봅니다. 가을로 우는 별 내린 둘 이런 이름과, 듯합니다. 이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운 피어나듯이 아직 무성할 보고, 이제 까닭입니다. 이네들은 아직 아름다운 마디씩 버리었습니다.</p>
						</div>
					</div>
					<div class="review_box swiper-slide">
						<div class="review_tit"><p>아름***님</p><div class="rating">★★★★★</div></div>
						
						<div class="review_desc">
							<p>많은 말 이름과 어머님, 아무 다 벌써 있습니다. 한 이국 때 마리아 봅니다. 하늘에는 했던 옥 위에 벌써 그리워 별 봅니다. 가을로 우는 별 내린 둘 이런 이름과, 듯합니다. 이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운 피어나듯이 아직 무성할 보고, 이제 까닭입니다. 이네들은 아직 아름다운 마디씩 버리었습니다.</p>
						</div>
					</div>
					<div class="review_box swiper-slide">
						<div class="review_tit"><p>아름***님</p><div class="rating">★★★★★</div></div>
						
						<div class="review_desc">
							<p>많은 말 이름과 어머님, 아무 다 벌써 있습니다. 한 이국 때 마리아 봅니다. 하늘에는 했던 옥 위에 벌써 그리워 별 봅니다. 가을로 우는 별 내린 둘 이런 이름과, 듯합니다. 이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운 피어나듯이 아직 무성할 보고, 이제 까닭입니다. 이네들은 아직 아름다운 마디씩 버리었습니다.</p>
						</div>
					</div>
					<div class="review_box swiper-slide">
						<div class="review_tit"><p>아름***님</p>
						<div class="rating">★★★★★</div></div>
						
						<div class="review_desc">
							<p>많은 말 이름과 어머님, 아무 다 벌써 있습니다. 한 이국 때 마리아 봅니다. 하늘에는 했던 옥 위에 벌써 그리워 별 봅니다. 가을로 우는 별 내린 둘 이런 이름과, 듯합니다. 이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운 피어나듯이 아직 무성할 보고, 이제 까닭입니다. 이네들은 아직 아름다운 마디씩 버리었습니다.</p>
						</div>
					</div>
					<div class="review_box swiper-slide">
						<div class="review_tit"><p>아름***님</p>
						<div class="rating">★★★★★</div></div>
						
						<div class="review_desc">
							<p>많은 말 이름과 어머님, 아무 다 벌써 있습니다. 한 이국 때 마리아 봅니다. 하늘에는 했던 옥 위에 벌써 그리워 별 봅니다. 가을로 우는 별 내린 둘 이런 이름과, 듯합니다. 이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운 피어나듯이 아직 무성할 보고, 이제 까닭입니다. 이네들은 아직 아름다운 마디씩 버리었습니다.</p>
						</div>
					</div>
					<div class="review_box swiper-slide">
						<div class="review_tit"><p>아름***님</p>
						<div class="rating">★★★★★</div></div>
						
						<div class="review_desc">
							<p>많은 말 이름과 어머님, 아무 다 벌써 있습니다. 한 이국 때 마리아 봅니다. 하늘에는 했던 옥 위에 벌써 그리워 별 봅니다. 가을로 우는 별 내린 둘 이런 이름과, 듯합니다. 이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운 피어나듯이 아직 무성할 보고, 이제 까닭입니다. 이네들은 아직 아름다운 마디씩 버리었습니다.</p>
						</div>
					</div>
					
				</div>
				<!-- Add Arrows -->
				    <div class="swiper-button-next"></div>
				    <div class="swiper-button-prev"></div>
			</div>
		</div>
	</div>
	<!-- CUSTOMER REVIEW PC-->

	<!-- CUSTOMER REVIEW MOBILE-->
	<div class="customer_review customer_review_m">
		<div class="container">
			<div class="titles">
				<h1><strong><span>피커스</span></strong> 써 본 사람만 아는 <strong>생생한 후기</strong></h1>
			</div>
			<div class="swiper-container swiper_review_m">
				<div class="swiper-wrapper">
					<div class="review_box swiper-slide">
						<div class="review_tit"><p>아름***님</p></div>
						<div class="rating">★★★★★</div>
						<div class="review_desc">
							<p>많은 말 이름과 어머님, 아무 다 벌써 있습니다. 한 이국 때 마리아 봅니다. 하늘에는 했던 옥 위에 벌써 그리워 별 봅니다. 가을로 우는 별 내린 둘 이런 이름과, 듯합니다. 이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운 피어나듯이 아직 무성할 보고, 이제 까닭입니다. 이네들은 아직 아름다운 마디씩 버리었습니다. 별 많은 동경과 내린 별들을 차 계십니다. 강아지, 너무나 차 벌레는 보고, 듯합니다.</p>
						</div>
					</div>
					<div class="review_box swiper-slide">
						<div class="review_tit"><p>아름***님</p></div>
						<div class="rating">★★★★★</div>
						<div class="review_desc">
							<p>많은 말 이름과 어머님, 아무 다 벌써 있습니다. 한 이국 때 마리아 봅니다. 하늘에는 했던 옥 위에 벌써 그리워 별 봅니다. 가을로 우는 별 내린 둘 이런 이름과, 듯합니다. 이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운 피어나듯이 아직 무성할 보고, 이제 까닭입니다. 이네들은 아직 아름다운 마디씩 버리었습니다. 별 많은 동경과 내린 별들을 차 계십니다. 강아지, 너무나 차 벌레는 보고, 듯합니다.</p>
						</div>
					</div>
					<div class="review_box swiper-slide">
						<div class="review_tit"><p>아름***님</p></div>
						<div class="rating">★★★★★</div>
						<div class="review_desc">
							<p>많은 말 이름과 어머님, 아무 다 벌써 있습니다. 한 이국 때 마리아 봅니다. 하늘에는 했던 옥 위에 벌써 그리워 별 봅니다. 가을로 우는 별 내린 둘 이런 이름과, 듯합니다. 이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운 피어나듯이 아직 무성할 보고, 이제 까닭입니다. 이네들은 아직 아름다운 마디씩 버리었습니다. 별 많은 동경과 내린 별들을 차 계십니다. 강아지, 너무나 차 벌레는 보고, 듯합니다.</p>
						</div>
					</div>
					<div class="review_box swiper-slide">
						<div class="review_tit"><p>아름***님</p></div>
						<div class="rating">★★★★★</div>
						<div class="review_desc">
							<p>많은 말 이름과 어머님, 아무 다 벌써 있습니다. 한 이국 때 마리아 봅니다. 하늘에는 했던 옥 위에 벌써 그리워 별 봅니다. 가을로 우는 별 내린 둘 이런 이름과, 듯합니다. 이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운 피어나듯이 아직 무성할 보고, 이제 까닭입니다. 이네들은 아직 아름다운 마디씩 버리었습니다. 별 많은 동경과 내린 별들을 차 계십니다. 강아지, 너무나 차 벌레는 보고, 듯합니다.</p>
						</div>
					</div>
					<div class="review_box swiper-slide">
						<div class="review_tit"><p>아름***님</p></div>
						<div class="rating">★★★★★</div>
						<div class="review_desc">
							<p>많은 말 이름과 어머님, 아무 다 벌써 있습니다. 한 이국 때 마리아 봅니다. 하늘에는 했던 옥 위에 벌써 그리워 별 봅니다. 가을로 우는 별 내린 둘 이런 이름과, 듯합니다. 이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운 피어나듯이 아직 무성할 보고, 이제 까닭입니다. 이네들은 아직 아름다운 마디씩 버리었습니다. 별 많은 동경과 내린 별들을 차 계십니다. 강아지, 너무나 차 벌레는 보고, 듯합니다.</p>
						</div>
					</div>
					<div class="review_box swiper-slide">
						<div class="review_tit"><p>아름***님</p></div>
						<div class="rating">★★★★★</div>
						<div class="review_desc">
							<p>많은 말 이름과 어머님, 아무 다 벌써 있습니다. 한 이국 때 마리아 봅니다. 하늘에는 했던 옥 위에 벌써 그리워 별 봅니다. 가을로 우는 별 내린 둘 이런 이름과, 듯합니다. 이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운 피어나듯이 아직 무성할 보고, 이제 까닭입니다. 이네들은 아직 아름다운 마디씩 버리었습니다. 별 많은 동경과 내린 별들을 차 계십니다. 강아지, 너무나 차 벌레는 보고, 듯합니다.</p>
						</div>
					</div>
					
				</div>
				<!-- Add Arrows -->
				    <div class="swiper-button-next"></div>
				    <div class="swiper-button-prev"></div>
			</div>
		</div>
	</div>
	<!-- CUSTOMER REVIEW PC-->
	<div class="pickus_banner" style="padding-bottom: 100px;">
		<div class="container">
			<img src="/img/event_banner.jpg" align="휴대폰특가" />
		</div>
	</div>
	<!-- PICKUS PICK -->
	<div class="pickus_pick">
		<div class="container">
			<div class="titles">
				<h1><strong><span>피커스</span> PICK</strong></h1>
			</div>
			<div class="pickus_box pc">
				<a href="#">
					<img src="/img/pick_1.jpg">
				</a>
				<div class="pick_desc">
					<img src="/img/bar_pick.png">
					<h3>[포럼] 하이커넥에서 알려주는 재활용 꿀팁!</h3>
					<p>이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운</p>
				</div>
			</div>
			<div class="pickus_box pc">
				<a href="#">
					<img src="/img/pick_1.jpg">
				</a>
				<div class="pick_desc">
					<img src="/img/bar_pick.png">
					<h3>[포럼] 하이커넥에서 알려주는 재활용 꿀팁!</h3>
					<p>이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운</p>
				</div>
			</div>
			<div class="pickus_box pc">
				<a href="#">
					<img src="/img/pick_2.jpg">
				</a>
				<div class="pick_desc">
					<img src="/img/bar_pick.png">
					<h3>[포럼] 하이커넥에서 알려주는 재활용 꿀팁!</h3>
					<p>이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운</p>
				</div>
			</div>
			<div class="pickus_box pc">
				<a href="#">
					<img src="/img/pick_3.jpg">
				</a>
				<div class="pick_desc">
					<img src="/img/bar_pick.png">
					<h3>[포럼] 하이커넥에서 알려주는 재활용 꿀팁!</h3>
					<p>이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운</p>
				</div>
			</div>
			<div class="swiper-container swiper_pick_m">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="pickus_box">
							<a href="#">
								<img src="/img/pick_3.jpg">
							</a>
							<div class="pick_desc">
								<img src="/img/bar_pick.png">
								<h3>[포럼] 하이커넥에서 알려주는 재활용 꿀팁!</h3>
								<p>이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운</p>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="pickus_box">
							<a href="#">
								<img src="/img/pick_3.jpg">
							</a>
							<div class="pick_desc">
								<img src="/img/bar_pick.png">
								<h3>[포럼] 하이커넥에서 알려주는 재활용 꿀팁!</h3>
								<p>이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운</p>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="pickus_box">
							<a href="#">
								<img src="/img/pick_3.jpg">
							</a>
							<div class="pick_desc">
								<img src="/img/bar_pick.png">
								<h3>[포럼] 하이커넥에서 알려주는 재활용 꿀팁!</h3>
								<p>이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운</p>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="pickus_box">
							<a href="#">
								<img src="/img/pick_3.jpg">
							</a>
							<div class="pick_desc">
								<img src="/img/bar_pick.png">
								<h3>[포럼] 하이커넥에서 알려주는 재활용 꿀팁!</h3>
								<p>이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- PICKUS PICK -->
	<!-- PARTNERS -->
	<div class="partners text-center">
        <div class="container">
            <h1>이젠 돌아다니지 말고,<br/>쉽게 고객을 만나 보세요.</h1>
            <a href="/bbs/partner_service.php">파트너문의</a>
        </div>
    </div>
	<!-- PARTNERS -->
</div>

<script type="text/javascript" src="/js/swiper.min.js"></script>
  <!-- Initialize Swiper -->
  <script>
    new Swiper('.swiper_ex', {
      speed : 1000,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },	
      pagination: {
        el: '.swiper-pagination.pagination-bottom, .swiper-pagination.pagination-top',
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' + (index + 1) + '</span>';
        },
      },
    });
  </script>
  <script>
    new Swiper('.swiper_review', {
      slidesPerView: 3,
      spaceBetween: 20,

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

	  
	new Swiper('.swiper_review_m', {
      	navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      	}
    });

    new Swiper('.swiper_pick_m', {
      	navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      	}
    });

  </script>

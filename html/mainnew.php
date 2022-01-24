<link rel="stylesheet" type="text/css" href="/css/swiper.min.css">
<style type="text/css">
	.at-container{max-width: unset;}
	.col-md-9{width: 100%; padding: 0;}
	.container{max-width: 1200px; margin: 0 auto; position: relative; width: 1200px; padding: 0 !important;}
	a:hover{text-decoration: none;}
	.options{overflow: hidden; background-color: #ddd;}
	.options ul li{float: left; width: 33.33%; padding: 40px 20px; background-color: #ddd; text-align: center;}
	.options ul li img{width: 80%;}
	.options ul li .options_info{text-align: center; margin: 0 auto; max-width: 80%;}
	.options ul li .options_info h3{font-size: 20px; font-weight: bold; color: #333;}
	.titles{text-align: center; margin-bottom: 50px; position: relative;}
	.titles h1{font-size: 34px;}
	.titles .more_view{position: absolute; right: 0; top: 50%; transform: translateY(-50%);}
	.titles .more_view a{font-size: 16px;}
	.experience_con{margin-top: 150px;}
	.experience_con .experience_tit{font-size: 32px; margin-bottom: 50px;}
	.experience_con .experience_tit span{color:#1379cd;}
	.experience_box{box-shadow: 0 2px 8px 0 rgba(0,0,0,0.1); padding: 30px 80px; min-height: 355px; text-align: center; border:1px solid #ededed;} 
	.experience_box h2{font-size: 24px; font-weight: bold;}
	.experience_box h2 span{color: #1379cd; display: inline-block; margin-right: 10px;}
	.experience_box .ex_left{float: left; padding:40px 0; text-align: left;} 
	.experience_box .ex_left h2{margin-bottom: 20px;}
	.experience_box .ex_left p{font-size: 16px; line-height: 34px; letter-spacing: 0.5px;}
	.experience_box .ex_left p span{font-weight: 600; color: #000;}
	.experience_box .ex_left .ex_guide{font-weight: bold; font-size: 20px; line-height: 28px; margin-top: 20px;}
	.experience_box .ex_right{float: right; padding-top: 80px;}
	.experience_con .swiper-container{overflow: hidden; padding:100px 0 60px;}
	.experience_con .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets{top: 10px !important;}
	.experience_con .swiper-pagination-bullet-active{color: #fff !important; background:#1379cd !important;}
	.experience_con .swiper-pagination-bullet{width: 35px !important; height: 35px !important; line-height: 35px !important; color: #333; opacity: 1; background:#ddd;}
	.experience_con .swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet{margin: 0 8%;}
	.experience_con .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets:before{width: 100%; height: 2px; content: ""; background-color: #ddd; display: block; position: absolute; top: 17px; z-index: -1;}
	.customer_review_m{display: none;}
	.customer_review .swiper-container{overflow: hidden;}
	.customer_review .review_box{background-color: #ddd; padding: 20px 20px 50px;}
	.review_tit{padding-bottom: 10px; border-bottom: 1px solid #aaa; margin-bottom: 10px;}
	.review_tit p{font-size: 16px; font-weight: bold; color: #333;}
	.rating{color: #1379cd; font-size: 16px;}
	.review_desc{padding: 20px 0;}
	.review_desc p{font-size: 14px; line-height: 20px;}
	.pickus_pick{margin-top: 150px;}
	.pickus_box{float: left; width: 33.33%; text-align: center;}
	.pick_desc{padding: 0 48px; text-align: left !important;}
	.pick_desc h3{font-size: 14px; font-weight: bold;}
	.pick_desc p {line-height: 20px;}
	.partners{margin-top: 150px;background-image: url('/img/main_footer_img.png'); background-repeat: no-repeat; padding: 5% 0; background-size: cover;}
	.partners h1{padding: 0 0 4% 0; font-weight: 200; color: #fff; }
	.partners a{display: inline-block; width: 30%; padding: 20px 0; height: 60px; letter-spacing: -1px; font-size: 27px !important; color: #fff; background:#1379cd;}
	.swiper-button-next{background-image: url('/img/right_nav.png') !important;}
	.swiper-button-prev{background-image: url('/img/left_nav.png') !important;}



	@media screen and (max-width : 1200px) {
		.container{padding: 0 15px !important; width: 100%;}
		.options ul li{width: 33.33%; border:0;}
		.experience_con .swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet{margin: 0 5%;}
		.experience_con .experience_tit{font-size: 28px; text-align: center;}
		.experience_box .ex_right{float: unset; text-align: center;}
		.pickus_box{padding: 0 10px;}
	}

	@media screen and (max-width : 1024px) {
	
	}
	@media screen and (max-width : 768px) {
		.options ul li{width: 50%; border:0; padding: 15px;}
		.options ul li .options_info h3{font-size: 16px;}
		.options ul li img{width: 100%;}
		.experience_con{margin-top: 80px;}
		.experience_con .experience_tit{font-size: 24px; line-height: 37px; text-align: center;}
		.experience_con .swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet{margin: 0 3%;}
		.experience_box{padding: 15px;}
		.experience_con .swiper-button-next, .experience_con .swiper-button-prev{display: none;}
		.experience_box .ex_left{padding: 0 0 40px;}
		.experience_box h2{font-size: 16px;}
		.experience_box .ex_left p{font-size: 13px; line-height: 24px;}
		.experience_box .ex_left .ex_guide{font-size: 16px;}
		.experience_box .ex_right{float: unset; text-align: center;}
		.experience_box .ex_right img{width: 100%;}
		.titles h1{font-size: 28px;}
		.titles .more_view a{font-size: 14px;}
		.pickus_pick{margin-top: 80px;}
		.pickus_box{width: 100%; float: unset; margin-bottom: 30px;}
		.pickus_box a{width: 100%;}
		.pickus_box a img{width: 100%;}
		.pick_desc{padding: 0;}
		.pick_desc h3{font-size: 16px;}
		.partners{margin-top: 80px; margin-bottom: 0;}
		.partners ul li{width: 48%; padding: 0; margin-right: 4%; margin-bottom: 20px;}
		.partners ul li:nth-of-type(even){margin-right: 0 !important}
		.partners ul li h3{font-size: 15px;}
		.partners ul li p{font-size: 12px;}
		.customer_review_pc{display: none;}
		.customer_review_m{display: block;}

	}
	@media screen and (max-width : 600px) {

	}
</style>
<div class="wrap">
	<!-- OPTIONS -->
	<div>
		<div class="options">
			<ul class="container">
				<li>
					<a href="#">
						<img src="/img/image_sample.png">
						<div class="options_info">
							<h3>기업전용</h3>
							<p>It is a long established fact that a reader will be distracted</p>
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<img src="/img/image_sample.png">
						<div class="options_info">
							<h3>철거/원상복구</h3>
							<p>It is a long established fact that a reader will be distracted</p>
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<img src="/img/image_sample.png">
						<div class="options_info">
							<h3>가전/가구매입</h3>
							<p>It is a long established fact that a reader will be distracted</p>
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<img src="/img/image_sample.png">
						<div class="options_info">
							<h3>대량매입</h3>
							<p>It is a long established fact that a reader will be distracted</p>
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<img src="/img/image_sample.png">
						<div class="options_info">
							<h3>대량매입</h3>
							<p>It is a long established fact that a reader will be distracted</p>
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<img src="/img/image_sample.png">
						<div class="options_info">
							<h3>대량매입</h3>
							<p>It is a long established fact that a reader will be distracted</p>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- OPTIONS -->
	<!-- EXPERIENCE -->
	<div class="experience_con">
		<div class="container">
		<h1 class="experience_tit"><span>피커스</span>만의 편리하고 안전한 프로세스를 경험해보세요</h1>
		<div class="swiper-container swiper_ex">
			<div class="swiper-wrapper">
				<div class="experience_box swiper-slide">
					<div class="ex_left">
						<h2><span>STEP.1</span>철거유형 선택</h2>
						<p><span>1. 중고가전가구매입</span> - 하나의 품목으로 여러업체 견적비교</p>
						<p><span>2. 대량매입</span> - 가정,사무,업소 등 다량 일괄 매입 견적비교</p>
						<p><span>3. 철거/원상복구</span> - 가정,사무,업소 등 철거/원상복구 견적비교</p>
						<p><span>4. 매입+철거</span> - 기업 이사/정리 시 매입과 철거/원상복구 한번에 비교견적</p>
						<div class="ex_guide">
							피커스에서는 28,000여 개의 풍부한 경험을 지닌 전문업체들이<br/>내용에 맞는 적정 견적을 안내합니다.
						</div>
					</div>
					<div class="ex_right">
						<img src="/img/pick1.png">
					</div>
				</div>
				<div class="experience_box swiper-slide">
					<div class="ex_left">
						<h2><span>STEP.2</span>본인확인</h2>
						<h3>비회원도 신청가능합니다.</h3>
						<p>허위매물 견적 방지 및 정확한 고객 견적, <br/>일회성 견적을 위한 비회원 신청도 가능합니다.</p>
					</div>
					<div class="ex_right">
						<img src="/img/pick2.png">
					</div>
				</div>
				<div class="experience_box swiper-slide">
					<div class="ex_left">
						<h2><span>STEP.3</span>견적정보입력</h2>
						<p><span>물품 판매 시</span> 가전/가구의 제조사, 모델명, 년식의 정보와 사진을 함께 넣어주세요.</p>
						<p><span>철거 시</span>에는 각 철거할 부분에 대한 사진과 내역에 대해 상세히 작성해 주세요.</span></p>
					</div>
					<div class="ex_right">
						<img src="/img/pick3.png">
					</div>
				</div>
				<div class="experience_box swiper-slide">
					<div class="ex_left">
						<h2><span>STEP.4</span>견적 비교 및 선택</h2>
						<p>고객님의 올려주신 정보를 통해 업체서 최고가 매입과 최저가 철거 견적을 비교하고 업체를 선택해 주세요.</p>
						<div class="ex_guide">
							피커스에서는 28,000여 개의 풍부한 경험을 지닌 전문업체들이<br/>내용에 맞는 적정 견적을 안내합니다.
						</div>
					</div>
					<div class="ex_right">
						<img src="/img/pick4.png">
					</div>
				</div>
				<div class="experience_box swiper-slide">
					<div class="ex_left">
						<h2><span>STEP.5</span>업체 방문 수거 및 철거 완료</h2>
						<p>선택하신 업체서 고객과의 일정 조율 후 방문 수거 및 철거를 진행 합니다.</p>
					</div>
					<div class="ex_right">
						<img src="/img/pick5.png">
					</div>
				</div>	
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
				<h1>고객 후기</h1>
				<div class="more_view">
					<a href="#">더보기 > </a>
				</div>
			</div>
			<div class="swiper-container swiper_review">
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

	<!-- CUSTOMER REVIEW MOBILE-->
	<div class="customer_review customer_review_m">
		<div class="container">
			<div class="titles">
				<h1>고객 후기</h1>
				<div class="more_view">
					<a href="#">더보기 > </a>
				</div>
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

	<!-- PICKUS PICK -->
	<div class="pickus_pick">
		<div class="container">
			<div class="titles">
				<h1>피커스 pick</h1>
				<div class="more_view">
					<a href="#">더보기 > </a>
				</div>
			</div>
			<div class="pickus_box">
				<a href="#">
					<img src="/img/image_sample.png">
				</a>
				<div class="pick_desc">
					<h3>[포럼] 하이커넥에서 알려주는 재활용 꿀팁!</h3>
					<p>이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운</p>
				</div>
			</div>
			<div class="pickus_box">
				<a href="#">
					<img src="/img/image_sample.png">
				</a>
				<div class="pick_desc">
					<h3>[포럼] 하이커넥에서 알려주는 재활용 꿀팁!</h3>
					<p>이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운</p>
				</div>
			</div>
			<div class="pickus_box">
				<a href="#">
					<img src="/img/image_sample.png">
				</a>
				<div class="pick_desc">
					<h3>[포럼] 하이커넥에서 알려주는 재활용 꿀팁!</h3>
					<p>이런 하나에 가득 아름다운 언덕 헤는 소녀들의 버리었습니다. 별을 이름자를 불러 부끄러운</p>
				</div>
			</div>
		</div>
	</div>
	<!-- PICKUS PICK -->
	<!-- PARTNERS -->
	<div class="partners text-center">
        <div class="container">
            <h1>이젠 돌아다니지 말고, <strong>쉽게 고객을 만나 보세요.</strong></h1>
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

    

  </script>

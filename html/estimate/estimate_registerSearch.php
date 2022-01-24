<?php
include_once('./_common.php');

include_once(G5_PATH . '/head.php');

$g5['title'] = '견적신청';

if ($member['mb_level'] == '2') {
	alert('업체회원은 이용하실 수 없습니다.');
}
?>
<link rel="stylesheet" type="text/css" href="/estimate/css/lg.css">
<div>
	<div class="banner_search_div">
		<div class="banner">
			<picture>
                <source media="(max-width: 321px)" srcset="/bbs/images/search_n1.png">
                <source media="(max-width: 376px)" srcset="/bbs/images/search_n2.png">
                <source media="(max-width: 415px)" srcset="/bbs/images/search_n3.png">
                <img src="/bbs/images/search_webn.png">
              </picture>
		</div>
		<div class="search">
			<input class="search_product" type="text" id="model_code" placeholder="냉장고/에어컨/세탁기 모델명을 입력해주세요.">
			<input id="search_btn" style="display:none;" type="submit" onclick="model_search()">
			<label class="search_btn" for="search_btn"></label>
		</div>
	</div>

	<div id="result" style="display:none;" class="result">
		<div class="result_title_flex">
			<div class="bar_icon"></div>
			<p class="result_title">보상시세조회</p>
		</div>
	<form action="<?php echo G5_URL; ?>/estimate/estimate_registerSearch2.php" method="post">
		<div class="search_result">
			<div class="search_result_flex">
				<div class="search_flex">
					<p class="search_p_font">카테고리</p>
					<input type="hidden" id="search_category2r" name="search_category2r">
					<div class="search_font" id="search_category2" name="search_category2"></div>
				</div>
				<div class="search_flex">
					<p class="search_p_font">모델명</p>
					<input type="hidden" id="search_coder" name="search_coder">
					<div class="search_font" id="search_code" name="search_code"></div>
				</div>
				<div class="search_flex">
					<p class="search_p_font">제조사</p>
					<input type="hidden" id="search_brandr" name="search_brandr">
					<div class="search_font" id="search_brand" name="search_brand"></div>
				</div>
				<div class="search_flex">
					<p class="search_p_font">상품명</p>
					<input type="hidden" id="search_namer" name="search_namer">
					<div class="search_font" id="search_name" name="search_name"></div>
				</div>
				<div class="search_flex">
					<p class="search_p_font">제조년도</p>
					<input type="hidden" id="search_yearr" name="search_yearr ">
					<div class="search_font" id="search_year" name="search_year"></div>
				</div>
			</div>

			<div class="search_price_div">
				<div class="row_price">최저</div>
				<div class="search_price" id="search_price"></div>
				<div class="high_price">최고</div>
				<img src="/estimate/img/price.png" alt="">
			</div>

			<div class="search_price_result_flex">
				<p class="search_price_title">평균 보상가</p>
				<div class="search_price_result" id="search_price1"></div>
				<input style="display:none;" id="estimate_lg" type="submit"><label class="estimate_lg" for="estimate_lg">보상진행하기</label>
			</div>
		</div>
	</form>
	</div>

	<div style="display:none;" id="fail_guide" class="guide">
		<div class="result_title_flex">
			<div class="bar_icon"></div>
			<p class="result_title">모델명 검색실패 가이드</p>
		</div>

		<div class="guide_step">
			<div class="guide_step_flex">
				<div class="guide_step_icon"></div>
				<p class="guide_step_title">Guide</p>
				<p class="guide_step_subtitle">모델명 검색실패</p>
			</div>
			<div class="guide_content_flex">
				<p class="guide_content1">모델명을 정확하게 입력하기</p>
				<p class="guide_content2">* 모델명에 - 이 포함된 경우 같이 입력</p>
				<p class="guide_content1">생산년도가 10년 이상인 경우</p>
				<p class="guide_content2">* 무료수거 및 폐기로 진행됩니다.</p>
			</div>
			<div class="guide_content_flex">
				<a class="estimate_btn" href="https://repickus.com/estimate/estimate_register1B.php">견적신청하기</a>
			</div>
		</div>
	</div>

	<div class="guide">
		<div class="result_title_flex">
			<div class="bar_icon"></div>
			<p class="result_title">진행안내사항</p>
		</div>

		<div class="guide_step">
			<div class="guide_step_flex">
				<div class="guide_step_icon"></div>
				<p class="guide_step_title">Step 1</p>
				<p class="guide_step_subtitle">시세 조회하기</p>
			</div>
			<div class="guide_content_flex">
				<p class="guide_content1">상단의 시세조회 프로그램을 이용하여 시세조회하기</p>
				<p class="guide_content2">* 모델명 안내사항은 위 도움말을 참고</p>
			</div>
		</div>

		<div class="guide_step">
			<div class="guide_step_flex">
				<div class="guide_step_icon"></div>
				<p class="guide_step_title">Step 2</p>
				<p class="guide_step_subtitle">견적 신청하기</p>
			</div>
			<div>
				<div class="guide_content_flex">
					<p class="guide_content">1) 물품정보등록</p>
					<p class="guide_content1">물품의 사진, 참고사항을 등록해주세요.</p>
					<p class="guide_content2">* (사진파일제공), 물품의 흠집, 성능에 대한 설명</p>
					<img src="" alt=""><img src="" alt="">
				</div>

				<div class="guide_content_flex">
					<p class="guide_content">2) 수거환경등록</p>
					<p class="guide_content1">고객님의 수거환경과 원하시는 수거날짜를 입력해주세요.</p>
					<p class="guide_content2">* 집주소, 엘리베이터 유무, 견적마감일, 수거요청일</p>
				</div>

				<div class="guide_content_flex">
					<p class="guide_content">3) 고객정보입력</p>
					<p class="guide_content1">고객님의 정보를 입력해주세요.</p>
					<p class="guide_content2">* 이름, 전화번호, 이메일</p>
				</div>
			</div>
		</div>

		<div class="guide_step">
			<div class="guide_step_flex">
				<div class="guide_step_icon"></div>
				<p class="guide_step_title">Step 3</p>
				<p class="guide_step_subtitle">견적 선택하기</p>
			</div>
			<div class="guide_content_flex">
				<p class="guide_content1">신청하신 견적 중 마음에 드는 견적을 선택해주세요.</p>
				<p class="guide_content2">* 견적리스트에서 견적 금액 확인 후 선택</p>
			</div>
		</div>

		<div class="guide_step">
			<div class="guide_step_flex">
				<div class="guide_step_icon"></div>
				<p class="guide_step_title">Step 4</p>
				<p class="guide_step_subtitle">보상진행 완료</p>
			</div>
			<div class="guide_content_flex">
				<p class="guide_content1">보상완료 후 정산하면 끝</p>
				<p class="guide_content2">* 자세한 내용은 업체에게 문의</p>
			</div>
		</div>

	</div>
	<div class="notice">
		<div class="result_title_flex">
			<div class="bar_icon"></div>
			<p class="result_title">주의사항</p>
		</div>
		<div class="notice_flex">
			<div class="notice_content">
				<p class="notice_title">내 가전 보상될까?</p>
				<p class="notice_content1">7년 미만의 가전으로 고장이나 파손이 되지않은 정상 작동인 가전</p>
			</div>
			<div class="notice_content">
				<p class="notice_title">보상 제외 가전은?</p>
				<p class="notice_content1">1. 보상 및 파손으로 인한 미작동 가전</p>
				<p class="notice_content1">2. 빌트인 가전 (가구와 함께 인테리어된 가전은 불가)</p>
				<p class="notice_content1">3. 7년 이상 지난 가전</p>
			</div>
			<div class="notice_content">
				<p class="notice_title">보상가 감가 사유는?</p>
				<p class="notice_content1">사다리차 이용 및 엘리베이터 유/무에 따른 사유</p>
			</div>
		</div>
	</div>
	
</div>
<div style="display:none;" id="load">
    <p class="loading_font">조회중...</p>
  </div>
<script>
	
	function model_search() {
		if ($('#model_code').val() != "") {
			$.ajax({
				type: "GET",
				url: "<?php echo G5_URL ?>/estimate/ajax.mongo.php",
				data: {
					model_code: $('#model_code').val()
					
				},
				success: function(data) {
					var obj = JSON.parse(JSON.stringify(data));
					var brand = [];
					//var category1 = [];
					var category2 = [];
					var category3 = [];
					var name = [];
					var code = [];
					var year = [];
					var size = [];
					//기존견적가필수
					var count = [];
					var avgPrice = [];
					var maxPrice = [];
					var minPrice = [];
					
					for (var objs of obj) {
						Object.keys(objs).forEach(function(v) {
							if (v == 'model_name') name.push(objs[v]);
							if (v == 'model_code') code.push(objs[v]);
							if (v == 'brand') brand.push(objs[v]);
							//if (v == 'category1') category1.push(objs[v]);
							if (v == 'category2') category2.push(objs[v]);
							if (v == 'category3') category3.push(objs[v]);
							if (v == '등록년월') { year.push(objs[v]); } else if (v == 'year') { year.push(objs[v]); }
							if (v == '전체용량') size.push(objs[v]);
							if (v == 'count') count.push(objs[v]);
							if (v == 'avgPrice') avgPrice.push(objs[v]);
							if (v == 'maxPrice') maxPrice.push(objs[v]);
							if (v == 'minPrice') minPrice.push(objs[v]);
						})
						
						//카테고리
						var category3 = category3[0];
						//연식
						var yearstr = year[0];
						var yearnb = yearstr.substring(0,4);
						//냉장고용량
						var sizesli = size[0];
						
						

						var price = 0; // 총가격
						if(count == ''){
							var obj_len = objs.price.length; // 총갯수
							objs.price.map(val => price = price + val.minPrice); // 가격 더하기
							var x = 1000; //반올림자리수
							var average_price = Math.round((price / obj_len) / x) * x; //평균가격
							var average_price2 = Math.round(((price / obj_len) * 0.3) / x) * x; //평균가격의 30%
						}

						
					}
					
					 if(yearnb >= 2012 && count == ''){

						//냉장고가격
						if(category3 == '냉장고/김치냉장고'){
							
							if(yearnb >= 2017){
								if(size >= 600 || average_price >= 3000000){
									var size = sizesli.slice(0, -1);
									if(yearnb == 2021){
										var RefrigeratorPriceMin = average_price * 0.2 + 50000;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.275 + 50000) / x) * x;
										var RefrigeratorPriceMax = average_price * 0.35 + 50000;
									} else if(yearnb == 2020) {
										var RefrigeratorPriceMin = average_price * 0.2 + 40000;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.275 + 40000) / x) * x;
										var RefrigeratorPriceMax = average_price * 0.35 + 40000;
									} else if(yearnb == 2019) {
										var RefrigeratorPriceMin = average_price * 0.2 + 30000;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.275 + 30000) / x) * x;
										var RefrigeratorPriceMax = average_price * 0.35 + 30000;
									} else if(yearnb == 2018) {
										var RefrigeratorPriceMin = average_price * 0.2 + 20000;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.275 + 20000) /x) * x;
										var RefrigeratorPriceMax = average_price * 0.35 + 20000;
									} else if(yearnb == 2017) {
										var RefrigeratorPriceMin = average_price * 0.2 + 10000;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.275 + 10000) /x) * x;
										var RefrigeratorPriceMax = average_price * 0.35 + 10000;
									} 
								} else {
									if(yearnb == 2021){
										var RefrigeratorPriceMin = average_price * 0.3 + 50000;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.375 + 50000) /x) * x;
										var RefrigeratorPriceMax = average_price * 0.45 + 50000;
									} else if(yearnb == 2020) {
										var RefrigeratorPriceMin = average_price * 0.3 + 40000;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.375 + 40000) /x) * x;
										var RefrigeratorPriceMax = average_price * 0.45 + 40000;
									} else if(yearnb == 2019) {
										var RefrigeratorPriceMin = average_price * 0.3 + 30000;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.375 + 30000) /x) * x;
										var RefrigeratorPriceMax = average_price * 0.45 + 30000;
									} else if(yearnb == 2018) {
										var RefrigeratorPriceMin = average_price * 0.3 + 20000;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.375 + 20000) /x) * x;
										var RefrigeratorPriceMax = average_price * 0.45 + 20000;
									} else if(yearnb == 2017) {
										var RefrigeratorPriceMin = average_price * 0.3 + 10000;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.375 + 10000) /x) * x;
										var RefrigeratorPriceMax = average_price * 0.45 + 10000;
									} 
								}
							} else if(2015 <= yearnb && yearnb <= 2016){
								if(size >= 600 || average_price >= 3000000){
										var size = sizesli.slice(0, -1);
										var RefrigeratorPriceMin = average_price * 0.12;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.195) /x) * x; 
										var RefrigeratorPriceMax = average_price * 0.27;
									} else {
										var RefrigeratorPriceMin = average_price * 0.22;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.295) /x) * x; 
										var RefrigeratorPriceMax = average_price * 0.37;
									}
							} else if (2012 <= yearnb && yearnb <=2014){
								if(size >= 600 || average_price >= 3000000){
										var size = sizesli.slice(0, -1);
										var RefrigeratorPriceMin = average_price * 0.10; 
										var RefrigeratorPriceAvg = Math.round((average_price * 0.175) /x) * x; 
										var RefrigeratorPriceMax = average_price * 0.25;
									} else {
										var RefrigeratorPriceMin = average_price * 0.20;
										var RefrigeratorPriceAvg = Math.round((average_price * 0.275) /x) * x;
										var RefrigeratorPriceMax = average_price * 0.35;
									}
							}
							$('#search_price').text(RefrigeratorPriceAvg + "원");
							
							$('#search_price1').text(RefrigeratorPriceAvg + "원"); 

						} else if(category3 == '세탁기') {
							if(yearnb == 2021){
								var WashingmachinePriceMin = average_price * 0.225 + 50000;
								var WashingmachinePriceAvg = Math.round((average_price * 0.30 + 50000) /x) * x;
								var WashingmachinePriceMax = average_price * 0.375 + 50000;
							} else if(yearnb == 2020) {
								var WashingmachinePriceMin = average_price * 0.225 + 40000;
								var WashingmachinePriceAvg = Math.round((average_price * 0.25 + 40000) /x) * x;
								var WashingmachinePriceMax = average_price * 0.375 + 40000;
							} else if(yearnb == 2019) {
								var WashingmachinePriceMin = average_price * 0.225 + 30000;
								var WashingmachinePriceAvg = Math.round((average_price * 0.20 + 30000) /x) * x;
								var WashingmachinePriceMax = average_price * 0.375 + 30000;
							} else if(yearnb == 2018) {
								var WashingmachinePriceMin = average_price * 0.225 + 20000;
								var WashingmachinePriceAvg = Math.round((average_price * 0.15 + 20000) /x) * x;
								var WashingmachinePriceMax = average_price * 0.375 + 20000;
							} else if(yearnb == 2017) {
								var WashingmachinePriceMin = average_price * 0.125 + 10000;
								var WashingmachinePriceAvg = Math.round((average_price * 0.10 + 10000) /x) * x;
								var WashingmachinePriceMax = average_price * 0.275 + 10000;
							} else if(yearnb == 2016) {
								var WashingmachinePriceMin = average_price * 0.125 + 10000;
								var WashingmachinePriceAvg = Math.round((average_price * 0.10 + 10000) /x) * x;
								var WashingmachinePriceMax = average_price * 0.275 + 10000;
							} else if(yearnb == 2015) {
								var WashingmachinePriceMin = average_price * 0.05 + 10000;
								var WashingmachinePriceAvg = Math.round((average_price * 0.10 + 10000) /x) * x;
								var WashingmachinePriceMax = average_price * 0.15 + 10000;
							} else if(2012 <= yearnb && yearnb <= 2014) {
								var WashingmachinePriceMin = average_price * 0.05 + 10000;
								var WashingmachinePriceAvg = Math.round((average_price * 0.10 + 10000) /x) * x;
								var WashingmachinePriceMax = average_price * 0.15 + 10000;
							} 
							$('#search_price').text(WashingmachinePriceAvg + "원");
							
							$('#search_price1').text(WashingmachinePriceAvg + "원"); 

						} else if(category3 == '에어컨/냉난방기') {
							if(yearnb == 2021){
								var AirconditionalPriceMin = average_price * 0.225 + 50000;
								var AirconditionalPriceAvg = Math.round((average_price * 0.30 + 50000) /x) * x;
								var AirconditionalPriceMax = average_price * 0.375 + 50000;
							} else if(yearnb == 2020) {
								var AirconditionalPriceMin = average_price * 0.225 + 40000;
								var AirconditionalPriceAvg = Math.round((average_price * 0.30 + 40000) /x) * x;
								var AirconditionalPriceMax = average_price * 0.375 + 40000;
							} else if(yearnb == 2019) {
								var AirconditionalPriceMin = average_price * 0.225 + 30000;
								var AirconditionalPriceAvg = Math.round((average_price * 0.30 + 30000) /x) * x;
								var AirconditionalPriceMax = average_price * 0.375 + 30000;
							} else if(yearnb == 2018) {
								var AirconditionalPriceMin = average_price * 0.225 + 20000;
								var AirconditionalPriceAvg = Math.round((average_price * 0.30 + 20000) /x) * x;
								var AirconditionalPriceMax = average_price * 0.375 + 20000;
							} else if(yearnb == 2017) {
								var AirconditionalPriceMin = average_price * 0.125 + 10000;
								var AirconditionalPriceAvg = Math.round((average_price * 0.20 + 10000) /x) * x;
								var AirconditionalPriceMax = average_price * 0.275 + 10000;
							} else if(yearnb == 2016) {
								var AirconditionalPriceMin = average_price * 0.125 + 10000;
								var AirconditionalPriceAvg = Math.round((average_price * 0.20 + 10000) /x) * x;
								var AirconditionalPriceMax = average_price * 0.275 + 10000;
							} else if(yearnb == 2015) {
								var AirconditionalPriceMin = average_price * 0.05 + 10000;
								var AirconditionalPriceAvg = Math.round((average_price * 0.10 + 10000) /x) * x;
								var AirconditionalPriceMax = average_price * 0.15 + 10000;
							} else if(yearnb == 2014) {
								var AirconditionalPriceMin = average_price * 0.05 + 10000;
								var AirconditionalPriceAvg = Math.round((average_price * 0.10 + 10000) /x) * x;
								var AirconditionalPriceMax = average_price * 0.15 + 10000;
							} else if(yearnb == 2013) {
								var AirconditionalPriceMin = average_price * 0.05 + 10000;
								var AirconditionalPriceAvg = Math.round((average_price * 0.10 + 10000) /x) * x;
								var AirconditionalPriceMax = average_price * 0.15 + 10000;
							} else if(yearnb == 2012) {
								var AirconditionalPriceMin = average_price * 0.05 + 10000;
								var AirconditionalPriceAvg = Math.round((average_price * 0.10 + 10000) /x) * x;
								var AirconditionalPriceMax = average_price * 0.15 + 10000;
							}
							$('#search_price').text(AirconditionalPriceAvg + "원");
							
							$('#search_price1').text(AirconditionalPriceAvg + "원"); 

						} 

						
						if(category3 != '냉장고/김치냉장고' && category3 != '에어컨/냉난방기' && category3 != '세탁기') {
							$('#load').show();
							setTimeout(function() {
								$('#result').hide();
								$('#load').hide();
								alert('검색하신 카테고리는 차후 오픈 될 예정입니다.');
								$('#fail_guide').show();
							},3000);
						} else {
							$('#search_name').text(name[0]);
						$('#search_code').text(code[0]);
						$('#search_brand').text(brand[0]);
						//$('#search_category1').text(category1[0]);
						$('#search_category2').text(category2[0] + " " + category3);
						$('#search_year').text(yearnb + "년");
						

						$('#search_namer').val(name[0]);
						$('#search_coder').val(code[0]);
						$('#search_brandr').val(brand[0]);
						$('#search_category2r').val(category2[0] + " " + category3);
						$('#search_yearr').val(yearnb + "년");
						
					
						$('#load').show();
						setTimeout(function() {
							$('#fail_guide').hide();
							$('#load').hide();
							$('#result').show();	
						},3000);
						}
					} else if(count > 0) {
						$('#search_name').text(name[0]);
						$('#search_code').text(code[0]);
						$('#search_brand').text(brand[0]);
						//$('#search_category1').text(category1[0]);
						$('#search_category2').text(category2[0] + " " + category3);
						$('#search_year').text(yearnb + "년");
						

						$('#search_namer').val(name[0]);
						$('#search_coder').val(code[0]);
						$('#search_brandr').val(brand[0]);
						$('#search_category2r').val(category2[0] + " " + category3);
						$('#search_yearr').val(yearnb + "년");

						var x = 1000;
						var estimatePrice = Math.round((avgPrice / count) /x) * x;
						$('#search_price').text(estimatePrice + "원");
						$('#search_price1').text(estimatePrice + "원"); 

						$('#load').show();
						setTimeout(function() {
							$('#fail_guide').hide();
							$('#load').hide();
							$('#result').show();	
						},3000);

					} else if(yearnb < 2012) {
						$('#load').show();
						setTimeout(function() {
							$('#result').hide();
							$('#load').hide();
							alert('10년이상 된 제품은 무료수거 및 폐기로 진행됩니다.');
							$('#fail_guide').show();
						},3000);
					} else {
						$('#load').show();
						setTimeout(function() {
							$('#result').hide();
							$('#load').hide();
							alert('검색하신 모델명이 없습니다.');
							$('#fail_guide').show();
						},3000);	
					}
				},
				error: function(data) {
					//통신 실패시 발생하는 함수(콜백)
					alert('검색하신 상품이 없습니다.');
				}
			});
		} else { 
			alert('모델명을 입력해주세요.');
			}
	}
	
</script>
<?php
include_once(G5_PATH . '/tail.php');
?>


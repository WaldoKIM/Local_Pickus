<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 대표아이디 설정
$wid = 'SMBW';

// 게시판 제목 폰트 설정
$font = 'font-18 en';

// 게시판 제목 하단라인컬러 설정 - red, blue, green, orangered, black, orange, yellow, navy, violet, deepblue, crimson..
$line = 'navy';

?>

<style>
	.widget-index { overflow:hidden; }
	.widget-index .div-title-underbar { margin-bottom:15px; }
	.widget-index .div-title-underbar span { padding-bottom:4px; }
	.widget-index .div-title-underbar span b { font-weight:500; }
	.widget-index h2.div-title-underbar { font-size:22px; text-align:center; margin-bottom:15px; /* 위젯 타이틀 */ }
	.widget-index h2 .div-title-underbar-bold { font-weight:bold; padding-bottom:4px; border-bottom-width:4px; margin-bottom:-3px; }
	.widget-index .widget-box { margin-bottom:40px; }
	.widget-index .widget-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	@media all and (max-width:767px) {
		.responsive .widget-index .widget-box { margin-bottom:30px; }
	}
	.at-container{max-width: inherit !important;}
</style>

<div class="at-container widget-index">
	<div class="h20"></div>
	<?php echo apms_widget('basic-title', $wid.'-wt1', 'height=320px', 'auto=0'); //타이틀 ?>
	<div class="h20"></div>
	<!--메인광고시작-->
	<div class="main_ad">
		<div class="layout_fix">
			<!-- [PC]메인 : 3단 배너 (396 x 114) 무제한 -->
			<div class="triple">
				<ul>
					<li>
						<div class="banner">
							<img src="/thema/Basic/images/main_list1.jpg" alt="전국구 스케일 United">
						</div>
					</li>
					<li>
						<div class="banner">
							<img src="/thema/Basic/images/main_list2.jpg" alt="스마트 초이스 for U">
						</div>
					</li>
					<li>
						<div class="banner">
							<img src="/thema/Basic/images/main_list3.jpg" alt="안심 케어 U smile ">
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!--메인광고 끝-->
	<!--메인추천상품-->
	<div class="main_ctg">
		<div class="layout_fix">
			<div class="main_title">피커스 추천 상품</div>
			<!-- 탭메뉴 / 메뉴 8개부터 if_col8 클래스 추가 -->
			<div class="main_tab if_col1">
				<div class="inner">
					<!-- li 1개씩 롤링 / 뜨리꼬떼처럼 딱딱 롤링되도록 / 앞에 메뉴가 뒤에 채워져서 롤링 -->
					<div class="rolling_box js_best_main_ctg">
						<ul class="js_best_cate_visual">
							<!-- 활성화시 hit클래스 추가 -->
							<li class="js_main_cate_li hit"><a href="#none" class="btn js_main_cate_tab" data-cuid="1"><span class="txt">가구</span></a></li>
						</ul>
					</div>

					<!-- 이전다음버튼 / 이전 또는 다음 롤링 없을때 if_before -->
					<span class="prne prev if_before">
						<a href="#none" onclick="return false;" class="js_best_cate_visual_prev" title="이전">
							<span class="img_btn">
								<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/tab_ar1.gif" alt=""></span>
							</span>
						</a>
					</span>
					<span class="prne next if_before">
						<a href="#none" onclick="return false;" class="js_best_cate_visual_next" title="다음">
							<span class="img_btn">
								<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/tab_ar2.gif" alt=""></span>
							</span>
						</a>
					</span>
				</div>
				<!-- 선택된 탭 전체보기 -->
				<a href="/?pn=product.list&amp;_event=main_category_best&amp;cuid=1" class="btn_more js_main_cate_more"><span class="tx">전체보기 <span class="ic"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/tab_ic.gif" alt=""></span></span></a>
			</div>

			<!-- 하얀박스묶음 -->
	<div class="rolling_wrap js_main_cate_box">
		<div class="rolling_box">
		<!-- ◆ 상품리스트 : 기본 4단 / 3단 if_col3 / 5단 if_col5 -->
		<div class="item_list if_col5">
			<ul class="js_main_best_product_slide_tmp">
				<li>
					<div class="item_box">
						<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A0851-Y4325-F5506" class="upper_link" title="LG전자 갈바닉 이온 부스터"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
						<!-- 상품아이콘 -->
						<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1328031258.gif" alt="BEST"></span>							<!-- 상품이미지 338 * 338 -->
						<div class="thumb">
							<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/724715315.jpg" alt="LG전자 갈바닉 이온 부스터"></div>
							<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="LG전자 갈바닉 이온 부스터"></div>
							<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
							<div class="item_quick">
								<a href="javascript:app_submit_from_list('A0851-Y4325-F5506', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
								<a href="#none" class="btn wish js_wish" data-pcode="A0851-Y4325-F5506" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
								<a href="#none" class="btn view js_quick_view" data-pcode="A0851-Y4325-F5506" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
								<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A0851-Y4325-F5506" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
							</div>
						</div>
						<!-- 상품정보 -->
						<div class="info">
							<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">LG전자 갈바닉 이온 부스터</span></div>
							<div class="price">
								<!-- 중고상품 상태 / 관리자에서 선택 -->
								<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
								<div class="state if_new">거의 새것</div>
								<div class="after"><span class="won">33,000</span><em>원</em></div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item_box">
						<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A1132-Y0020-I9894" class="upper_link" title="네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
						<!-- 상품아이콘 -->
						<!-- 상품이미지 338 * 338 -->
						<div class="thumb">
							<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/1487358745.jpg" alt="네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]"></div>
							<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]"></div>
							<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
							<div class="item_quick">
								<a href="javascript:app_submit_from_list('A1132-Y0020-I9894', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
								<a href="#none" class="btn wish js_wish" data-pcode="A1132-Y0020-I9894" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
								<a href="#none" class="btn view js_quick_view" data-pcode="A1132-Y0020-I9894" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
								<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A1132-Y0020-I9894" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
							</div>
							</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]</span></div>
								<div class="price">
								<!-- 중고상품 상태 / 관리자에서 선택 -->
								<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
								<div class="state if_no">미사용</div>
								<div class="after"><span class="won">8,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A3026-T2024-G1998" class="upper_link" title="SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
														<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
							<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/2567621012.jpg" alt="SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터"></div>
							<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A3026-T2024-G1998', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A3026-T2024-G1998" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A3026-T2024-G1998" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A3026-T2024-G1998" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
							</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit" style="display: inline-block;">SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩... </span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_no">미사용</div>
									<div class="after"><span class="won">320,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A0005-X0863-B7658" class="upper_link" title="[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/2192706113.gif" alt="추천상품"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1328031258.gif" alt="BEST"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
									<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/3790497027.jpg" alt="[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸"></div>
									<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸"></div>
									<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A0005-X0863-B7658', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A0005-X0863-B7658" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A0005-X0863-B7658" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A0005-X0863-B7658" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
							</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit" style="display: inline-block;">[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울... </span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_use">하자있음</div>
									<div class="after"><span class="won">120,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A1561-R7770-B0752" class="upper_link" title="스마트소닉 음파칫솔 프로 2인 커플 세트 + 2"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
														<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
									<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/328187379.jpg" alt="스마트소닉 음파칫솔 프로 2인 커플 세트 + 2"></div>
									<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="스마트소닉 음파칫솔 프로 2인 커플 세트 + 2"></div>
									<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A1561-R7770-B0752', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A1561-R7770-B0752" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A1561-R7770-B0752" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A1561-R7770-B0752" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
							</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">스마트소닉 음파칫솔 프로 2인 커플 세트 + 2</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_no">미사용</div>
									<div class="after"><span class="won">800,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
				</ul>
				<div class="js_main_best_product_slide" style="display: none">
			    <ul>
					<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A0851-Y4325-F5506" class="upper_link" title="LG전자 갈바닉 이온 부스터"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1328031258.gif" alt="BEST"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
								<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/724715315.jpg" alt="LG전자 갈바닉 이온 부스터"></div>
								<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="LG전자 갈바닉 이온 부스터"></div>
									<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
								<div class="item_quick">
									<a href="javascript:app_submit_from_list('A0851-Y4325-F5506', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
									<a href="#none" class="btn wish js_wish" data-pcode="A0851-Y4325-F5506" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
									<a href="#none" class="btn view js_quick_view" data-pcode="A0851-Y4325-F5506" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
									<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A0851-Y4325-F5506" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
								</div>
							</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">LG전자 갈바닉 이온 부스터</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_new">거의 새것</div>
									<div class="after"><span class="won">33,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A1132-Y0020-I9894" class="upper_link" title="네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
														<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
								<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/1487358745.jpg" alt="네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]"></div>
								<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]"></div>
									<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A1132-Y0020-I9894', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A1132-Y0020-I9894" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A1132-Y0020-I9894" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A1132-Y0020-I9894" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
							</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_no">미사용</div>
									<div class="after"><span class="won">8,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A3026-T2024-G1998" class="upper_link" title="SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
								<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/2567621012.jpg" alt="SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터"></div>
								<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터"></div>
									<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A3026-T2024-G1998', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A3026-T2024-G1998" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A3026-T2024-G1998" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A3026-T2024-G1998" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_no">미사용</div>
									<div class="after"><span class="won">320,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A0005-X0863-B7658" class="upper_link" title="[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/2192706113.gif" alt="추천상품"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1328031258.gif" alt="BEST"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
									<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/3790497027.jpg" alt="[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸">
									</div>
									<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸">
									</div>
									<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A0005-X0863-B7658', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A0005-X0863-B7658" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A0005-X0863-B7658" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A0005-X0863-B7658" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
							</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_use">하자있음</div>
									<div class="after"><span class="won">120,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A1561-R7770-B0752" class="upper_link" title="스마트소닉 음파칫솔 프로 2인 커플 세트 + 2"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
							<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/328187379.jpg" alt="스마트소닉 음파칫솔 프로 2인 커플 세트 + 2"></div>
								<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="스마트소닉 음파칫솔 프로 2인 커플 세트 + 2"></div>
									<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A1561-R7770-B0752', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A1561-R7770-B0752" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A1561-R7770-B0752" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=1&amp;pcode=A1561-R7770-B0752" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
							</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">스마트소닉 음파칫솔 프로 2인 커플 세트 + 2</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_no">미사용</div>
									<div class="after"><span class="won">800,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	<!-- / ◆ 상품리스트 -->
	</div>
	</div>
	<!-- / 하얀박스묶음 -->
	</div>
	</div>

	<div class="main_double">
		<div class="layout_fix">
			<div class="double">
				<ul>
					<li>
						<div class="banner">
							<a href="http://www.repickus.com/estimate/registEstimate.do" target="_blank"><img src="//dehuv.onedaynet.co.kr/upfiles/banner/2524685970.jpg" alt="가전/가구 매입"></a>
						</div>
					</li>
					<li>
						<div class="banner">
							<a href="http://www.repickus.com/estimate/registEstimate.do" target="_blank"><img src="//dehuv.onedaynet.co.kr/upfiles/banner/2674902582.jpg" alt="다량 일괄 매입"></a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="main_item">
		<div class="layout_fix">
			<div class="main_title">NEW 새로 등록된 상품</div>
				<!-- 탭메뉴 / 메뉴 8개부터 if_col8 클래스 추가 -->
				<div class="main_tab if_col4">
					<div class="inner">
						<!-- li 1개씩 롤링 / 뜨리꼬떼처럼 딱딱 롤링되도록 / 앞에 메뉴가 뒤에 채워져서 롤링 -->
						<div class="rolling_box js_new_main_ctg_12">
							<ul class="js_new_cate_visual_12">
								<!-- 활성화시 hit클래스 추가 -->
								<li class="js_main_new_li_12 hit"><a href="#none" class="btn js_main_new_tab_12" data-cuid="147"><span class="txt">가전</span></a></li>
								<li class="js_main_new_li_12"><a href="#none" class="btn js_main_new_tab_12" data-cuid="1"><span class="txt">가구</span></a></li>
								<li class="js_main_new_li_12"><a href="#none" class="btn js_main_new_tab_12" data-cuid="2"><span class="txt">주방집기</span></a></li>
								<li class="js_main_new_li_12"><a href="#none" class="btn js_main_new_tab_12" data-cuid="438"><span class="txt">가구/인테리어</span></a></li>
							</ul>
						</div>

						<!-- 이전다음버튼 / 이전 또는 다음 롤링 없을때 if_before -->
						<span class="prne prev if_before">
							<a href="#none" onclick="return false;" class="js_new_cate_visual_12_prev" title="이전">
								<span class="img_btn">
									<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/tab_ar1.gif" alt=""></span>
								</span>
							</a>
						</span>
						<span class="prne next if_before">
							<a href="#none" onclick="return false;" class="js_new_cate_visual_12_next" title="다음">
								<span class="img_btn">
									<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/tab_ar2.gif" alt=""></span>
								</span>
							</a>
						</span>			
					</div>
					<!-- 선택된 탭 전체보기 -->
					<a href="/?pn=product.list&amp;_event=main_product&amp;dmsuid=12&amp;cuid=147" class="btn_more js_main_new_more_12"><span class="tx">전체보기 <span class="ic"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/tab_ic.gif" alt=""></span></span></a>
				</div>

				<!-- 하얀박스묶음 -->
				<div class="rolling_wrap js_main_new_box_12">
					<div class="rolling_box">
				<!-- ◆ 상품리스트 : 기본 4단 / 3단 if_col3 / 5단 if_col5 -->
				<div class="item_list if_col5">		
				<div class="bx-wrapper" style="max-width: 1220px;"><div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 320px;"><div class="js_main_new_product_slide_12" style="width: 2215%; position: absolute; left: -1220px;"><ul style="float: left; list-style: none; position: relative; width: 1220px; margin-right: 20px;" class="bx-clone">					<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A0005-X0863-B7658" class="upper_link" title="[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/2192706113.gif" alt="추천상품"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1328031258.gif" alt="BEST"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
								<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/3790497027.jpg" alt="[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸"></div>
								<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸"></div>
								<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A0005-X0863-B7658', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A0005-X0863-B7658" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A0005-X0863-B7658" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A0005-X0863-B7658" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
							</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_use">하자있음</div>
									<div class="after"><span class="won">120,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A3026-T2024-G1998" class="upper_link" title="SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
														<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/2567621012.jpg" alt="SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A3026-T2024-G1998', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A3026-T2024-G1998" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A3026-T2024-G1998" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A3026-T2024-G1998" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_no">미사용</div>
									<div class="after"><span class="won">320,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A1561-R7770-B0752" class="upper_link" title="스마트소닉 음파칫솔 프로 2인 커플 세트 + 2"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
														<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/328187379.jpg" alt="스마트소닉 음파칫솔 프로 2인 커플 세트 + 2"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="스마트소닉 음파칫솔 프로 2인 커플 세트 + 2"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A1561-R7770-B0752', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A1561-R7770-B0752" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A1561-R7770-B0752" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A1561-R7770-B0752" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">스마트소닉 음파칫솔 프로 2인 커플 세트 + 2</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_no">미사용</div>
									<div class="after"><span class="won">800,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
							</ul>
			<ul style="float: left; list-style: none; position: relative; width: 1220px; margin-right: 20px;">
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=L3638-Q7414-G0908" class="upper_link" title="에어컨"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/2192706113.gif" alt="추천상품"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/auto_s_2478393501.jpg" alt="에어컨"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="에어컨"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('L3638-Q7414-G0908', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="L3638-Q7414-G0908" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="L3638-Q7414-G0908" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=L3638-Q7414-G0908" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">에어컨</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_pro">중고상품</div>
									<div class="after"><span class="won">50,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=U3258-L0092-Y3486" class="upper_link" title="삼성 에어컨"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/2192706113.gif" alt="추천상품"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1328031258.gif" alt="BEST"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1886464017.gif" alt="NEW"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/2461704854.jpg" alt="삼성 에어컨"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="삼성 에어컨"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('U3258-L0092-Y3486', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="U3258-L0092-Y3486" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="U3258-L0092-Y3486" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=U3258-L0092-Y3486" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">삼성 에어컨</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_new">거의 새것</div>
									<div class="after"><span class="won">200,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=L6449-O6676-H5647" class="upper_link" title="삼성 냉장고"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/2192706113.gif" alt="추천상품"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1328031258.gif" alt="BEST"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/1721074458.jpg" alt="삼성 냉장고"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="삼성 냉장고"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('L6449-O6676-H5647', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="L6449-O6676-H5647" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="L6449-O6676-H5647" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=L6449-O6676-H5647" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">삼성 냉장고</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_pro">중고상품</div>
									<div class="after"><span class="won">50,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A0851-Y4325-F5506" class="upper_link" title="LG전자 갈바닉 이온 부스터"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1328031258.gif" alt="BEST"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/724715315.jpg" alt="LG전자 갈바닉 이온 부스터"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="LG전자 갈바닉 이온 부스터"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A0851-Y4325-F5506', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A0851-Y4325-F5506" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A0851-Y4325-F5506" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A0851-Y4325-F5506" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">LG전자 갈바닉 이온 부스터</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_new">거의 새것</div>
									<div class="after"><span class="won">33,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A1132-Y0020-I9894" class="upper_link" title="네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
														<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/1487358745.jpg" alt="네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A1132-Y0020-I9894', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A1132-Y0020-I9894" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A1132-Y0020-I9894" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A1132-Y0020-I9894" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_no">미사용</div>
									<div class="after"><span class="won">8,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
				</ul><ul style="float: left; list-style: none; position: relative; width: 1220px; margin-right: 20px;">					<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A0005-X0863-B7658" class="upper_link" title="[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/2192706113.gif" alt="추천상품"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1328031258.gif" alt="BEST"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/3790497027.jpg" alt="[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A0005-X0863-B7658', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A0005-X0863-B7658" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A0005-X0863-B7658" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A0005-X0863-B7658" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">[밀키웨이]에코 원목 도장 화장대/북유럽풍 디자인/거울 수납/혼수/신혼/원룸</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_use">하자있음</div>
									<div class="after"><span class="won">120,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A3026-T2024-G1998" class="upper_link" title="SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
														<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/2567621012.jpg" alt="SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A3026-T2024-G1998', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A3026-T2024-G1998" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A3026-T2024-G1998" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A3026-T2024-G1998" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">SAMSUNG 삼성전자 LED TV [UN65RU7190FXKR] 네오랩 컨버전스 핑크퐁 빔 프로젝터</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_no">미사용</div>
									<div class="after"><span class="won">320,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A1561-R7770-B0752" class="upper_link" title="스마트소닉 음파칫솔 프로 2인 커플 세트 + 2"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
														<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/328187379.jpg" alt="스마트소닉 음파칫솔 프로 2인 커플 세트 + 2"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="스마트소닉 음파칫솔 프로 2인 커플 세트 + 2"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A1561-R7770-B0752', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A1561-R7770-B0752" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A1561-R7770-B0752" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A1561-R7770-B0752" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">스마트소닉 음파칫솔 프로 2인 커플 세트 + 2</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_no">미사용</div>
									<div class="after"><span class="won">800,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
							</ul>
		<ul style="float: left; list-style: none; position: relative; width: 1220px; margin-right: 20px;" class="bx-clone">
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=L3638-Q7414-G0908" class="upper_link" title="에어컨"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/2192706113.gif" alt="추천상품"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/auto_s_2478393501.jpg" alt="에어컨"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="에어컨"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('L3638-Q7414-G0908', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="L3638-Q7414-G0908" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="L3638-Q7414-G0908" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=L3638-Q7414-G0908" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">에어컨</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_pro">중고상품</div>
									<div class="after"><span class="won">50,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=U3258-L0092-Y3486" class="upper_link" title="삼성 에어컨"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/2192706113.gif" alt="추천상품"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1328031258.gif" alt="BEST"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1886464017.gif" alt="NEW"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/2461704854.jpg" alt="삼성 에어컨"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="삼성 에어컨"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('U3258-L0092-Y3486', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="U3258-L0092-Y3486" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="U3258-L0092-Y3486" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=U3258-L0092-Y3486" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">삼성 에어컨</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_new">거의 새것</div>
									<div class="after"><span class="won">200,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=L6449-O6676-H5647" class="upper_link" title="삼성 냉장고"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/2192706113.gif" alt="추천상품"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1328031258.gif" alt="BEST"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/1721074458.jpg" alt="삼성 냉장고"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="삼성 냉장고"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('L6449-O6676-H5647', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="L6449-O6676-H5647" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="L6449-O6676-H5647" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=L6449-O6676-H5647" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">삼성 냉장고</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_pro">중고상품</div>
									<div class="after"><span class="won">50,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A0851-Y4325-F5506" class="upper_link" title="LG전자 갈바닉 이온 부스터"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
							<span class="upper_icon"><img src="http://dehuv.onedaynet.co.kr/upfiles/icon/1328031258.gif" alt="BEST"></span>							<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/724715315.jpg" alt="LG전자 갈바닉 이온 부스터"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="LG전자 갈바닉 이온 부스터"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A0851-Y4325-F5506', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A0851-Y4325-F5506" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A0851-Y4325-F5506" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A0851-Y4325-F5506" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">LG전자 갈바닉 이온 부스터</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_new">거의 새것</div>
									<div class="after"><span class="won">33,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
									<li>
						<div class="item_box">
							<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A1132-Y0020-I9894" class="upper_link" title="네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
							<!-- 상품아이콘 -->
														<!-- 상품이미지 338 * 338 -->
							<div class="thumb">
																	<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/product/1487358745.jpg" alt="네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]"></div>
																<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/thumb.gif" alt="네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]"></div>
																	<!-- 상품 퀵메뉴 ㅣ 찜하기는 찜되면 hit 취소하면 삭제 title값을 "찜삭제"로 변경 -->
									<div class="item_quick">
										<a href="javascript:app_submit_from_list('A1132-Y0020-I9894', 'cart', 0);" class="btn cart" title="장바구니 담기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_cart.png" alt=""></a>
										<a href="#none" class="btn wish js_wish" data-pcode="A1132-Y0020-I9894" title="찜하기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish.png" alt="" class="off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_wish_on.png" alt="" class="on"></a>
										<a href="#none" class="btn view js_quick_view" data-pcode="A1132-Y0020-I9894" title="간단보기"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_view.png" alt=""></a>
										<a href="/?pn=product.view&amp;cuid=147&amp;pcode=A1132-Y0020-I9894" class="btn blank" title="새창보기" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/iquick_blank.png" alt=""></a>
									</div>
															</div>
							<!-- 상품정보 -->
							<div class="info">
								<div class="item_name ellipsis" style="overflow-wrap: break-word;"><span class="tit">네오랩컨버전스 핑크퐁 빔 프로젝터 [NPP-P102]</span></div>
								<div class="price">
									<!-- 중고상품 상태 / 관리자에서 선택 -->
									<!-- 중고상품 if_pro / 하자있음 if_use / 미사용 if_no / 거의 새것 if_new -->
									<div class="state if_no">미사용</div>
									<div class="after"><span class="won">8,000</span><em>원</em></div>
								</div>
							</div>
						</div>
					</li>
				</ul></div></div><div class="bx-controls"></div></div>
	</div>
	<!-- / ◆ 상품리스트 -->
</div>


	
	<!-- 이전다음버튼 (롤링이 1개일때는 숨김) -->
	<span class="prevnext prev">
		<a href="#none" class="js_main_new_product_slide_12_prev" onclick="return false;" title="이전">
			<span class="img_btn">
				<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/main_pro_pr1.png" alt=""></span>
				<span class="img_over"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/main_pro_pr2.png" alt=""></span>
			</span>
		</a>
	</span>
	<span class="prevnext next">
		<a href="#none" class="js_main_new_product_slide_12_next" onclick="return false;" title="다음">
			<span class="img_btn">
				<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/main_pro_ne1.png" alt=""></span>
				<span class="img_over"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/main_pro_ne2.png" alt=""></span>
			</span>
		</a>
	</span>


	<script type="text/javascript">
		$(function(){
			var MainBestCategorySlideMargin_12 = $('.js_main_new_product_slide_tmp_12').find('.item_box').css('margin-left').replace('px', '')*1;
			var MainBestCategorySlideWidth_12 = $('.js_main_new_product_slide_tmp_12').outerWidth();

			$('.js_main_new_product_slide_tmp_12').remove();
			$('.js_main_new_product_slide_12').show();
			$('.js_main_new_product_slide_12').css('width', MainBestCategorySlideWidth_12+MainBestCategorySlideMargin_12);
			var MainBestCategorySlide_12 = $('.js_main_new_product_slide_12').bxSlider({
				auto: true,
				autoHover: false,
				pagerCustom: '.js_main_new_product_slide_12_pager',
				controls: false,
				useCSS: false,
				minSlides: 1,
				moveSlides: 1,
				slideMargin: MainBestCategorySlideMargin_12,
				slideWidth: MainBestCategorySlideWidth_12,
				holdWidth: MainBestCategorySlideWidth_12, // LDD: 2018-01-09 새롭게 추가된 옵션(자동 크기 변경을 차단하고 지정값으로 강제로 맞춘다)
				onSliderLoad: function() { },
				onSlideBefore: function() { MainBestCategorySlide_12.stopAuto(); },
				onSlideAfter: function() { MainBestCategorySlide_12.startAuto(); }
			});

			$('.js_main_new_product_slide_12_prev').on('click', function(e) {
				e.preventDefault();
				MainBestCategorySlide_12.goToPrevSlide();
			});

			$('.js_main_new_product_slide_12_next').on('click', function(e) {
				e.preventDefault();
				MainBestCategorySlide_12.goToNextSlide();
			});
		});
	</script>
	<script type="text/javascript">
					$(document).on('click', '.js_main_new_tab_12', function(e) {
						e.preventDefault();
						var _cuid = $(this).data('cuid');
						$('.js_main_new_li_12').removeClass('hit');
						$(this).closest('.js_main_new_li_12').addClass('hit');
						$('.js_main_new_more_12').prop('href', '/?pn=product.list&_event=main_product&dmsuid=12&cuid='+_cuid);
						MainNewProduct('12');
					});

				</script>
				<script>
	//$(window).load(MainNewProduct);
	function MainNewProduct(_uid) {
		var _cate = $('.js_main_new_li_'+_uid+'.hit').find('a').data('cuid');
		$.ajax({
			data: {
				dmsuid: _uid,
				cuid: _cate,
				_event: 'main_product',
				_list_type: 'ajax.main_new_product',
			},
			type: 'POST',
			cache: false,
			url: '//dehuv.onedaynet.co.kr/program/product.list.php',
			success: function(data) {
				$('.js_main_new_box_'+_uid).html(data);
				$(function() { $('.js_main_new_box_'+_uid+' .ellipsis').dotdotdot(); });
			}
		});
	}
</script>
			</div>
	<!-- / 하얀박스묶음 -->
		</div>
	</div>


<div class="main_mini">
	<div class="layout_fix">
		<div class="main_title">피커스 추천 업체</div>

					<!-- 메인 공통 탭메뉴 / 관리자에서 미니샵 탭 지정 -->
			<div class="main_tab">
				<div class="inner">
					<div class="rolling_box">
						<ul>
							<!-- 활성화시 hit클래스 추가 -->
															<li class="js_main_shop_li hit"><a href="#none" onclick="return false;" class="btn js_main_shop_tab" data-uid="1"><span class="txt">가전</span></a></li>
															<li class="js_main_shop_li"><a href="#none" onclick="return false;" class="btn js_main_shop_tab" data-uid="4"><span class="txt">가구</span></a></li>
															<li class="js_main_shop_li"><a href="#none" onclick="return false;" class="btn js_main_shop_tab" data-uid="2"><span class="txt">주방집기</span></a></li>
															<li class="js_main_shop_li"><a href="#none" onclick="return false;" class="btn js_main_shop_tab" data-uid="3"><span class="txt">헬스용품</span></a></li>
																				</ul>
					</div>

					<!-- 이전다음버튼 / 이전 또는 다음 롤링 없을때 if_before -->
					<span class="prne prev if_before">
						<a href="#none" class="js_main_visual_prev" title="이전">
							<span class="img_btn">
								<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/tab_ar1.gif" alt=""></span>
							</span>
						</a>
					</span>
					<span class="prne next">
						<a href="#none" class="js_main_visual_next" title="다음">
							<span class="img_btn">
								<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/tab_ar2.gif" alt=""></span>
							</span>
						</a>
					</span>

				</div>
				<!-- 선택된 탭 전체보기 -->
				<!-- <a href="/?pn=mini.list&type=1" class="btn_more js_main_shop_more"><span class="tx">더보기 <span class="ic"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/tab_ic.gif" alt="" /></span></span></a> -->
				<a href="/?pn=mini.list" class="btn_more"><span class="tx">더보기 <span class="ic"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/tab_ic.gif" alt=""></span></span></a>
			</div>

			<script type="text/javascript">
				$(document).on('click', '.js_main_shop_tab', function(e) {
					e.preventDefault();
					var _uid = $(this).data('uid');
					$('.js_main_shop_li').removeClass('hit');
					$(this).closest('.js_main_shop_li').addClass('hit');
					$('.js_main_shop_more').prop('href', '/?pn=mini.list&type='+_uid);
					MainShopList();
				});
				//$(window).load(MainShopList);
				function MainShopList() {
					var _uid = $('.js_main_shop_li.hit').find('a').data('uid');
					$.ajax({
						data: {
							type: _uid,
							listmaxcount: 6,
							_order: 'idx',
							_list_type: 'ajax.mini.list'
						},
						type: 'POST',
						cache: false,
						url: '//dehuv.onedaynet.co.kr/program/mini.list.php',
						success: function(data) {
							$('.js_main_shop_box').html(data);
							$(function() { $('.js_main_shop_box .ellipsis').dotdotdot(); });
						}
					});
				}
			</script>
		
		<!-- 메인에서 6개까지만 노출하고 더보기 클릭 시 목록으로 이동 -->
		<div class="mini_list js_main_shop_box">
			
	<ul>
						<li>
					<div class="mini_box">
						<!-- 미니샵 목록 썸네일 (200 x 200) -->
						<div class="thumb">
							<a href="/?pn=mini.main&amp;shop=moa" class="upper_link"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/blank.gif" alt=""></a>
															<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/company/3602974416.jpg" alt="모아중고알뜰매장"></div>
															<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/mini_fake.gif" alt=""></div>

							<div class="btn_box">
								<ul>
									<li>
										<!-- 관심상점 / 버튼 클릭 시 hit 클래스 추가 -->
										<a href="#none" onclick="return false" class="btn js_com_wish" data-cpid="moa" title="관심상점">
											<span class="img_btn">
												<span class="img_over"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_wish2.png" alt=""></span>
												<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_wish1.png" alt=""></span>
											</span>
										</a>
									</li>
									<li>
										<a href="/?pn=mini.main&amp;shop=moa" class="btn" title="바로가기">
											<span class="img_btn">
												<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_go.gif" alt=""></span>
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<a href="/?pn=mini.main&amp;shop=moa" class="name"><span class="tt">모아중고알뜰매장</span></a>
					</div>
				</li>
						<li>
					<div class="mini_box">
						<!-- 미니샵 목록 썸네일 (200 x 200) -->
						<div class="thumb">
							<a href="/?pn=mini.main&amp;shop=heya8424" class="upper_link"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/blank.gif" alt=""></a>
															<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/company/1452040055.jpg" alt="고양시재활용센터"></div>
															<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/mini_fake.gif" alt=""></div>

							<div class="btn_box">
								<ul>
									<li>
										<!-- 관심상점 / 버튼 클릭 시 hit 클래스 추가 -->
										<a href="#none" onclick="return false" class="btn js_com_wish" data-cpid="heya8424" title="관심상점">
											<span class="img_btn">
												<span class="img_over"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_wish2.png" alt=""></span>
												<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_wish1.png" alt=""></span>
											</span>
										</a>
									</li>
									<li>
										<a href="/?pn=mini.main&amp;shop=heya8424" class="btn" title="바로가기">
											<span class="img_btn">
												<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_go.gif" alt=""></span>
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<a href="/?pn=mini.main&amp;shop=heya8424" class="name"><span class="tt">고양시재활용센터</span></a>
					</div>
				</li>
						<li>
					<div class="mini_box">
						<!-- 미니샵 목록 썸네일 (200 x 200) -->
						<div class="thumb">
							<a href="/?pn=mini.main&amp;shop=reneedesign" class="upper_link"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/blank.gif" alt=""></a>
															<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/company/3054395174.jpg" alt="리사이클파파중고"></div>
															<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/mini_fake.gif" alt=""></div>

							<div class="btn_box">
								<ul>
									<li>
										<!-- 관심상점 / 버튼 클릭 시 hit 클래스 추가 -->
										<a href="#none" onclick="return false" class="btn js_com_wish" data-cpid="reneedesign" title="관심상점">
											<span class="img_btn">
												<span class="img_over"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_wish2.png" alt=""></span>
												<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_wish1.png" alt=""></span>
											</span>
										</a>
									</li>
									<li>
										<a href="/?pn=mini.main&amp;shop=reneedesign" class="btn" title="바로가기">
											<span class="img_btn">
												<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_go.gif" alt=""></span>
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<a href="/?pn=mini.main&amp;shop=reneedesign" class="name"><span class="tt">리사이클파파중고</span></a>
					</div>
				</li>
						<li>
					<div class="mini_box">
						<!-- 미니샵 목록 썸네일 (200 x 200) -->
						<div class="thumb">
							<a href="/?pn=mini.main&amp;shop=aabc2001" class="upper_link"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/blank.gif" alt=""></a>
															<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/company/2664454867.jpg" alt="알뜰중고가전재활용센터"></div>
															<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/mini_fake.gif" alt=""></div>

							<div class="btn_box">
								<ul>
									<li>
										<!-- 관심상점 / 버튼 클릭 시 hit 클래스 추가 -->
										<a href="#none" onclick="return false" class="btn js_com_wish" data-cpid="aabc2001" title="관심상점">
											<span class="img_btn">
												<span class="img_over"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_wish2.png" alt=""></span>
												<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_wish1.png" alt=""></span>
											</span>
										</a>
									</li>
									<li>
										<a href="/?pn=mini.main&amp;shop=aabc2001" class="btn" title="바로가기">
											<span class="img_btn">
												<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_go.gif" alt=""></span>
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<a href="/?pn=mini.main&amp;shop=aabc2001" class="name"><span class="tt">알뜰중고가전재활용센터</span></a>
					</div>
				</li>
						<li>
					<div class="mini_box">
						<!-- 미니샵 목록 썸네일 (200 x 200) -->
						<div class="thumb">
							<a href="/?pn=mini.main&amp;shop=a011296" class="upper_link"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/blank.gif" alt=""></a>
															<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/company/2692406697.jpg" alt="A+중고가전가구"></div>
															<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/mini_fake.gif" alt=""></div>

							<div class="btn_box">
								<ul>
									<li>
										<!-- 관심상점 / 버튼 클릭 시 hit 클래스 추가 -->
										<a href="#none" onclick="return false" class="btn js_com_wish" data-cpid="a011296" title="관심상점">
											<span class="img_btn">
												<span class="img_over"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_wish2.png" alt=""></span>
												<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_wish1.png" alt=""></span>
											</span>
										</a>
									</li>
									<li>
										<a href="/?pn=mini.main&amp;shop=a011296" class="btn" title="바로가기">
											<span class="img_btn">
												<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_go.gif" alt=""></span>
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<a href="/?pn=mini.main&amp;shop=a011296" class="name"><span class="tt">A+중고가전가구</span></a>
					</div>
				</li>
						<li>
					<div class="mini_box">
						<!-- 미니샵 목록 썸네일 (200 x 200) -->
						<div class="thumb">
							<a href="/?pn=mini.main&amp;shop=chjd09" class="upper_link"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/c_img/blank.gif" alt=""></a>
															<div class="real_img"><img src="http://dehuv.onedaynet.co.kr/upfiles/company/3377228674.png" alt="안산시재활용품판매점"></div>
															<div class="fake_img"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/mini_fake.gif" alt=""></div>

							<div class="btn_box">
								<ul>
									<li>
										<!-- 관심상점 / 버튼 클릭 시 hit 클래스 추가 -->
										<a href="#none" onclick="return false" class="btn js_com_wish" data-cpid="chjd09" title="관심상점">
											<span class="img_btn">
												<span class="img_over"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_wish2.png" alt=""></span>
												<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_wish1.png" alt=""></span>
											</span>
										</a>
									</li>
									<li>
										<a href="/?pn=mini.main&amp;shop=chjd09" class="btn" title="바로가기">
											<span class="img_btn">
												<span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/sub/mini_go.gif" alt=""></span>
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<a href="/?pn=mini.main&amp;shop=chjd09" class="name"><span class="tt">안산시재활용품판매점</span></a>
					</div>
				</li>
			</ul>





		</div>
	</div>
</div>











	<div class="row displaynone">
		<div class="col-sm-8">
			<!-- 이벤트 시작 -->
			<div class="div-title-underbar">
				<a href="<?php echo $at_href['event'];?>">
					<span class="pull-right lightgray <?php echo $font;?>">+</span>
					<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
						<b>Event</b>
					</span>
				</a>
			</div>
			<div class="widget-box">
				<?php echo apms_widget('basic-shop-event-slider', $wid.'-we1', 'caption=1 nav=1 item=3 lg=2 md=2 sm=2', 'auto=0'); ?>
			</div>
			<!-- 이벤트 끝 -->	
		</div>
		<div class="col-sm-4">
			<!-- 알림 시작 -->
			<div class="div-title-underbar">
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
					<span class="pull-right lightgray <?php echo $font;?>">+</span>
					<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
						<b>Notice</b>
					</span>
				</a>
			</div>
			<div class="widget-box">
				<?php echo apms_widget('basic-post-list', $wid.'-wp1', 'icon={아이콘:bell} rows=6 date=1 strong=1,2'); ?>
			</div>
			<!-- 알림 끝 -->
		</div>
	</div>

	<!-- 히트 & 베스트 시작 -->
	<h2 class="div-title-underbar displaynone">
		<a href="<?php echo $at_href['itype'];?>?type=1">
			<span class="pull-right lightgray">+</span>
			<span class="div-title-underbar-bold border-<?php echo $line;?>">
				Hit & Best
			</span>
		</a>
	</h2>
	<div class="widget-box displaynone">
		<?php echo apms_widget('basic-shop-item-slider', $wid.'-wm1', 'type1=1 type4=1 auto=0 nav=1 item=5 lg=4', 'auto=0'); ?>
	</div>
	<!-- 히트 & 베스트 끝 -->

	<!-- 추천 & 신상 시작 -->
	<h2 class="div-title-underbar displaynone">
		<a href="<?php echo $at_href['itype'];?>?type=2">
			<span class="pull-right lightgray">+</span>
			<span class="div-title-underbar-bold border-<?php echo $line;?>">
				Cool & New
			</span>
		</a>
	</h2>

	<div class="widget-box displaynone">
		<?php echo apms_widget('basic-shop-item-slider', $wid.'-wm2', 'type2=1 type3=1 auto=0 nav=1 item=5 lg=4', 'auto=0'); ?>
	</div>
	<!-- 추천 & 신상 끝 -->

	<!-- 이미지 배너 시작 -->	
	<div class="widget-box widget-img displaynone">
		<a href="#배너이동주소">
			<img src="<?php echo THEMA_URL;?>/assets/img/banner.jpg">
		</a>
	</div>
	<!-- 이미지 배너 끝 -->	

	<!-- 할인 시작 -->
	<h2 class="div-title-underbar displaynone">
		<a href="<?php echo $at_href['itype'];?>?type=5">
			<span class="pull-right lightgray">+</span>
			<span class="div-title-underbar-bold border-<?php echo $line;?>">
				Discount
			</span>
		</a>
	</h2>

	<div class="widget-box displaynone">
		<?php echo apms_widget('basic-shop-item-slider', $wid.'-wm3', 'type5=1 auto=0 nav=1 item=5 lg=4', 'auto=0'); ?>
	</div>
	<!-- 할인 끝 -->

	<!--<?php echo apms_line('fa', 'fa-cube'); // 라인 ?>-->

	<!-- 상품목록 시작 -->	
	<div class="widget-box displaynone">
		<?php echo apms_widget('basic-shop-item-gallery', $wid.'-wm6', 'rows=10 item=5 lg=4'); ?>
	</div>
	<!-- 상품목록 끝 -->	

	<!-- 이미지 배너 시작 -->	
	<div class="widget-box widget-img displaynone">
		<a href="#배너이동주소">
			<img src="<?php echo THEMA_URL;?>/assets/img/banner.jpg">
		</a>
	</div>
	<!-- 이미지 배너 끝 -->	

	<div class="row displaynone">
		<div class="col-md-6">
			<div class="row">
				<div class="col-sm-6">

					<!-- 후기 시작 -->
					<div class="div-title-underbar">
						<a href="<?php echo $at_href['iuse'];?>">
							<span class="pull-right lightgray <?php echo $font;?>">+</span>
							<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
								<b>Review</b>
							</span>
						</a>
					</div>
					<div class="widget-box">
						<?php echo apms_widget('basic-shop-post', $wid.'-wm9', 'mode=use icon={아이콘:star} star=red rows=4 new=blue strong=1,2'); ?>
					</div>
					<!-- 후기 끝 -->

				</div>
				<div class="col-sm-6">

					<!-- 문의 시작 -->
					<div class="div-title-underbar">
						<a href="<?php echo $at_href['iqa'];?>">
							<span class="pull-right lightgray <?php echo $font;?>">+</span>
							<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
								<b>Q & A</b>
							</span>
						</a>
					</div>
					<div class="widget-box">
						<?php echo apms_widget('basic-shop-post', $wid.'-wm10', 'mode=qa icon={아이콘:user} rows=4 new=green strong=1,2'); ?>
					</div>
					<!-- 문의 끝 -->

				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-sm-6">

					<!-- 댓글 시작 -->
					<div class="div-title-underbar">
						<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
							<b>Comment</b>
						</span>
					</div>
					<div class="widget-box">
						<?php echo apms_widget('basic-shop-post', $wid.'-wm11', 'mode=comment icon={아이콘:comment} rows=4 strong=1'); ?>
					</div>
					<!-- 댓글 끝 -->

				</div>
				<div class="col-sm-6">

					<!-- 아이콘 시작 -->
					<div class="div-title-underbar">
						<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
							<b>Service</b>
						</span>
					</div>

					<div class="widget-box">
						<?php echo apms_widget('basic-shop-icon'); ?>
					</div>
					<!-- 아이콘 끝 -->

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="main_wide">
		<div class="layout_fix">
			<!-- [PC]메인 : 중간 배너 (1200 x 205) 무제한 -->
			<div class="rolling_box js_main_footer">
				<div class="banner">
				 	<img src="//dehuv.onedaynet.co.kr/upfiles/banner/3562391306.jpg" alt="스마트폰 모음전">
				</div>
			</div>

		</div>
	</div>
<div class="main_cs">
	<div class="layout_fix">
		<ul class="ul">
			<li class="li notice_box">
				<div class="title_box">
					<span class="tit ko">공지 &amp; 이벤트</span><a href="/?pn=board.list&amp;_menu=notice" class="btn_more js_main_comm_link">더보기</a>
				</div>
				<div class="notice_tab">
					<ul>
						<!-- 활성화시 hit -->
						<li class="js_main_comm_li hit"><a href="#none" data-board="notice" class="btn js_main_comm_tab">공지사항</a></li>
																			<li class="js_main_comm_li"><a href="#none" data-board="event" class="btn js_main_comm_tab">이벤트</a></li>
											</ul>
					<script type="text/javascript">
						$(document).on('click', '.js_main_comm_tab', function(e) {
							e.preventDefault();
							var board = $(this).data('board');

							// 탭 및 링크변경
							$('.js_main_comm_li').removeClass('hit');
							$(this).closest('.js_main_comm_li').addClass('hit');
							$('.js_main_comm_link').prop('href', '/?pn=board.list&_menu='+board);

							$('.js_main_comm_box').hide();
							$('.js_main_comm_box_'+board).show();
						});
					</script>
				</div>
				<!-- 이벤트 탭은 if_event (날짜를 상태로 변경), li 5개 노출 -->
				<div class="notice_list js_main_comm_box js_main_comm_box_notice">
					<ul>
						<li>
							<div class="posting">
								<a href="/?pn=board.view&amp;_uid=3" class="upper_link" title="공지사항입니다."><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
								<!-- 날짜 -->
								<span class="date">07.12</span>
																		<span class="txt">공지사항입니다.</span>
							</div>
						</li>
					</ul>
				</div>
								<!-- 이벤트 탭은 if_event, li 5개 노출 -->
				<div class="notice_list js_main_comm_box js_main_comm_box_event if_event" style="display:none">
												<!-- 내용없을경우 ul이 없어지고 -->
					<div class="post_none">등록된 내용이 없습니다.</div>
				</div>
							</li>
							<li class="li cs_box">
								<div class="title_box"><span class="tit">SERVICE CENTER</span></div>
								<div class="cs_info">
									<div class="tel">1800-5528</div>
									<div class="email"><a href="mailto:cs@repickus.com" title="이메일 보내기">cs@repickus.com</a></div>
								</div>
								<div class="cs_time">
									평일 : am09:00 ~ pm06:00<br>
									점심 : pm12:00 ~ pm01:00<br>
									휴무 : 주말(토/일) 및 공휴일은 휴무입니다.	
								</div>
								<div class="btn_box">
									<ul>
										<li><a href="/?pn=mypage.inquiry.form" class="btn">1:1 온라인 문의</a></li>
										<li><a href="/?pn=pages.view&amp;type=agree&amp;data=guide" class="btn">쇼핑몰 이용안내</a></li>
									</ul>
								</div>
							</li>
							<li class="li bank_box">
								<div class="title_box"><span class="tit">BANK ACCOUNT</span></div>
								<div class="bank">
									<ul>
										<li class="left_tit">국민</li>
										<li class="right_num">
											<div class="number">123456-67-789874</div>
											<div class="name">(예금주 : 홍길동)</div>
										</li>
									</ul>
								</div>
								<div class="btn_other">
									<a href="/?pn=service.partner.form" class="upper_link" title=""><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/blank.gif" alt=""></a>
									<dl>
										<dt>제휴 및 입점문의</dt>
										<dd>피커스와 함께할 파트너를 찾습니다.</dd>
									</dl>
								</div>
								<div class="btn_box">
									<ul>
										<li><a href="/?pn=mypage.order.list" class="btn">주문배송조회</a></li>
										<li><a href="/?pn=service.guest.order.list" class="btn">비회원 주문조회</a></li>
								    </ul>
								</div>
							</li>
						</ul>
					</div>
				</div>
	</div>
</div>

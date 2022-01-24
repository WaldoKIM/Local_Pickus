<? include('./include/head.inc.php');?>
<div class="site-wrapper" id="box_wrapper">
	<!--상단로고, 가이드메뉴-->
	<? include('./include/top_guide.inc.php');?>
	<!--상단메뉴, 로테이트베너-->
	<? include('./include/top_menu.inc.php');?>
		<!--페이지 위치-->
		<div class="my_location">
			<ol class="breadcrumb titletxt_B">
				<li><a href="index.php" class="titletxt_A">Home</a></li>
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li><i class="fas fa-arrow-left"></i>회원가입</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section join_form_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<h1 class="h_tit">SIGN UP</h1>
					<h3 class="s_tit">환영합니다.</h3>
					<!--********************내용영역 출력 시작********************-->
					<? include('./include/joinform.inc.php');?>
					<!--********************내용영역 출력 끝********************-->

					<div>
						<br>
						### 판매 수수료 부과 안내 ###<br><br>

						1. 서비스 판매 완료<br>
						2. 수수료 15%를 제한 판매대금을 포인트로 적립<br>
						3. 출금 요청<br>
						4. 회원정보에 입력된 입금계좌로 정산(공휴일 제외, 평일 6~8시에 일괄 입금처리)<br>
						<br>
						* 회원정보수정 페이지에서 입금계좌 꼭 기입해주세요.<br>
						<br>
						판매 수수료 사용처<br>
						-플랫폼 유지비(데이터, 호스팅 등)<br>
						-광고/홍보 비<br>
						-회원용 이벤트 진행 비용<br>
						-기타 홈페이지 관련 비용<br>					
					</div>					
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->
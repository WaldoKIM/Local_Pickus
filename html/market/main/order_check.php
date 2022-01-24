<? include('./include/head.inc.php');?>
<?

?>
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
				<li><i class="fas fa-arrow-left"></i>주문내역조회</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section order_check login_check_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************내용영역 출력 시작********************-->
					<!--페이지서브메뉴-->
					<? include('./include/mymenu.inc.php');?>
					<!--페이지서브메뉴-->
					<div class="main">
						<ul class="top_ment">
							<li class="text">저희 쇼핑몰을 이용해 주셔서 감사합니다.</li>
							<li class="text"><span>로그인</span>을 하시면 각종 서비스를 받으실 수 있습니다.</li>
							<li class="btn">
								<a href="../../bbs/login.php?login_go=my_order_list.php" class="btn1">회원으로조회</a>
								<a href="order_guest.php" class="btn2">비회원으로조회</a>
							</li>
						</ul>
						<h3 class="tit2">
							<p class="big"><img src="images/login_check_tit.png"><span><font>회원</font> 가입혜택</span> <img src="images/login_check_tit.png"></p>
							<p class="small">회원만의 특별한 혜택</p>
						</h3>
						<ul class="help_info">
							<li class="one"><p>JOIN</p>회원가입은 무료! 별도의 가입비 없이 회원만의 특혜를 누리실 수 있습니다.</li>
							<li class="two"><p>MEMBERSHIP</p>상품구매시 일부가격을 적립금으로 되돌려 드리며, 차후 구매결제시 현금과 동일하게 사용이 가능합니다.</li>
							<li class="three"><p>USABILITY</p>매번 정보를 입력해야 하는 번거로움이 사라집니다.</li>
							<li class="four"><p>BENEFIT</p>마이페이지에서 내가 이용한 정보들을 한눈에 이용할 수 있어 편리한 쇼핑을 즐기실 수 있습니다.</li>
						</ul>
						<ul class="help_info2">
							<li>
								<span>&nbsp;</span>
								<div>
									아직 회원이 아니세요?<br/>									지금 멤버십 회원가입을 하세요.
								</div>
								<a href="../../bbs/register_customer_form.php?login_go=<?=$_GET[login_go];?>">회원가입</a>
							</li>
							<li>
								<span>&nbsp;</span>
								<div>
									아이디 혹은 비밀번호를<br/>									잊어버리셨나요?
								</div>
								<a href="../../bbs/find_password.php?login_go=<?=$_GET[login_go];?>">아이디 및 비밀번호찾기</a>
							</li>
						</ul>
					</div>
					<!--********************내용영역 출력 끝********************-->
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->
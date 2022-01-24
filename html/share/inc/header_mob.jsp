
<div class="mob">
	<div class="mob_nav">
		<div class="mob_back">
			<i class="xi-angle-left"></i>
		</div>
		<div class="top_logo">
			<a href="../00_main/">
				<img class="main" src="../../img/common/top_logo.png" alt="">
			</a>
		</div>
		<div class="mob_btn">
			<img class="main" src="../../img/common/mob_menu.png" alt="">
		</div>
	</div><!-- mob_nav -->
</div><!-- mob -->

<div id="menu">
	<div onclick="history.back();" class="close">
		<i class="icon xi-close"></i>
	</div>
	
	<div class="my main_bg">
		<h2>로그인 하세요</h2>
		<h2>
			<c:out value="${userInfo.nickname}"/> 님 <br/>안녕하세요.&nbsp;&nbsp;
			<a href="../customer/notify.do">
				알림&nbsp;&nbsp;
				<span class="badge"><c:out value="${notifyInfo.notReadCnt}"/>1</span>
			</a>
		</h2>
	</div><!-- my -->

	<ul class="login row main_bg">
		<li class="col-xs-6"><a class="white_bg" href="#">로그인</a></li>
		<li class="col-xs-6"><a class="line_bg" href="#">회원가입</a></li>
		<li class="col-xs-6"><a class="line_bg" href="#none" onClick="cfnLogout();">로그아웃</a></li>
		<li class="col-xs-6"><a class="white_bg" href="#">마이페이지</a></li>
	</ul><!-- quick_login -->

	<ul class="nav" id="nav-left">
		<li>
			<a href="#">무료 비교견적요청</a>
		</li>
		<li>
			<a href="#">내신청현황</a>
		</li>
		<li>
			<a href="#">파트너 문의</a>
		</li>
		<li class="open_menu" onclick="open_menu(this);">
			<div>고객센터</div>
			<ul class="nav_left_sub_menu">
				<li><a href="#">공지사항</a></li>
				<li><a href="#">1:1문의</a></li>
				<li><a href="#">FAQ</a></li>
			</ul>
		</li>
		<li class="open_menu" onclick="open_menu(this);">
			<div>피커스 마켓</div>
			<ul class="nav_left_sub_menu">
				<li><a href="#">메뉴01</a></li>
				<li><a href="#">메뉴02</a></li>
				<li><a href="#">메뉴03</a></li>
			</ul>
		</li>
	</ul><!-- nav-left -->

	<div class="coll">
		<h2>고객 상담 및 파트너 문의</h2>
		<h1 class="main_co">1800-5528</h1>
		<p>운영시간: 09:00 ~ 18:00</p>
		<p>(일/공휴일 휴무)</p>
	</div>
</div><!-- menu -->
<div onclick="history.back();" class="page_cover"></div>

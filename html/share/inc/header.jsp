<div class="web">
	<div class="gnb">
		<div class="container">
			<ul>
				<c:if test="${userInfo.loginYn != 'Y' }">
					<li><a href="../05_member/login.jsp">로그인</a></li>
					<li><a href="../05_member/join.jsp">회원가입</a></li>
				</c:if>
				<c:if test="${userInfo.loginYn == 'Y' }">
					<c:if test="${userInfo.typeGb == '0' }">
						<li><a href="../customer/myPage.do"><c:out value="${userInfo.nickname}"/> 님</a></li>
						<li><a href="#none" onClick="cfnLogout();">로그아웃</a></li>
						<li><a href="../04_mypage/index.jsp">마이페이지</a></li>
						<c:if test="${notifyInfo.notReadCnt == '0' }">
							<li><a href="../02_customer/alarm.jsp">알림</a></li>
						</c:if>
						<c:if test="${notifyInfo.notReadCnt != '0' }">
							<li><a href="../02_customer/alarm.jsp">알림&nbsp;&nbsp;<span class="badge"><c:out value="${notifyInfo.notReadCnt}"/></span></a></li>
						</c:if>
					</c:if><!-- 
					<c:if test="${userInfo.typeGb == '2' }">
						<li><a href="../customer/myPartnerPage.do"><c:out value="${userInfo.bizname}"/> 님</a></li>
						<li><a href="#none" onClick="cfnLogout();">로그아웃</a></li>
						<li><a href="../customer/myPartnerPage.do">마이페이지</a></li>
						<c:if test="${notifyInfo.notReadCnt == '0' }">
							<li><a href="../customer/notify.do">알림</a></li>
						</c:if>
						<c:if test="${notifyInfo.notReadCnt != '0' }">
							<li><a href="../customer/notify.do">알림<span class="badge"><c:out value="${notifyInfo.notReadCnt}"/></span></a></li>
						</c:if>
					</c:if>
					<c:if test="${userInfo.typeGb == '9' }">
						<li><a href="#none"><c:out value="${userInfo.nickname}"/> 님</a></li>
						<li><a href="#none" onClick="cfnAdminChangePswd();">비밀번호변경</a></li>
						<li><a href="#none" onClick="cfnLogout();">로그아웃</a></li>
					</c:if>
					<c:if test="${userInfo.typeGb == '8' }">
						<li><a href="#none"><c:out value="${userInfo.nickname}"/> 님</a></li>
						<li><a href="#none" onClick="cfnLogout();">로그아웃</a></li>
						<c:if test="${notifyInfo.notReadCnt == '0' }">
							<li><a href="../customer/notify.do">알림</a></li>
						</c:if>
						<c:if test="${notifyInfo.notReadCnt != '0' }">
							<li><a href="../customer/notify.do">알림<span class="badge"><c:out value="${notifyInfo.notReadCnt}"/></span></a></li>
						</c:if>
					</c:if> -->
				</c:if>
			</ul>
		</div><!-- container -->
	</div><!-- gnb -->
	<nav>
		<div class="nav">
			<div class="container">
				<div class="top_logo">
					<a href="../00_main/"><img class="main" src="../../img/common/top_logo.png" alt=""></a>
				</div>
				<ul class="menu">
					<li><a href="../01_estimate/choice.jsp">견적신청</a></li>
					<li><a href="../03_info/partner.jsp">파트너 문의</a></li>
					<li><a href="../02_customer/notice.jsp">고객센터</a></li>
				</ul>
				<div class="market main_co">
					<a href="#">우리동네 중고 마켓 가기</a>
				</div>
			</div><!-- container -->
		</div><!-- nav -->
	</nav>
	<ul id="quick">
		<li><div>Quick<br/>MENU</div></li>
		<li><a href="../01_estimate/choice.jsp">무료<br/>비교견적</a></li>
		<!-- <li><a href="../03_info/index.jsp">서비스<br/>소개</a></li> -->
		<li><a href="#none" onclick="cfnKakaoChat()">톡문의</a></li>
		<li><a href="#">TOP</a></li>
	</ul>
</div><!-- web -->

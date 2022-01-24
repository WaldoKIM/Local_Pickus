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
				<li><i class="fas fa-arrow-left"></i>로그인</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section login_page_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************내용영역 출력 시작********************-->
  					<script language="javascript">
						// 메인 로그인
						function mainLoginSend() {
							var form=document.mail_login_form;
							if(form.userid.value=="") {
								alert("아이디를 입력해 주십시오.");
								form.userid.focus();
							} else if(form.userid.value.length < 4 || form.userid.value.length > 21) {
								alert("회원 아이디는 4~20자로 입력 주세요.");
								form.userid.focus();
							} else if(form.passwd.value=="") {
								alert("패스워드를 입력해 주십시오.");
								form.passwd.focus();
							} else if(form.passwd.value.length < 4 || form.passwd.value.length > 21) {
								alert("패스워드는 4~20자로 입력 주세요.");
								form.passwd.focus();
							} else {
								<?if($SECURITYDOMAIN){?>
								if(form.slogin.checked){
									form.action = "<?=$SECURITYDOMAIN?>/login_ok.php";
								}else{
									form.action = "./login_ok.php";
								}
								<?}else{?>
								form.action = "./login_ok.php";
								<?}?>
								form.submit();
							}
						}
						function mainLoginInputSendit() {
							if(event.keyCode==13) {
								mainLoginSend();
							}
						}
					</script>
					<h1 class="h_tit">LOGIN</h1>
					<h3 class="s_tit">환영합니다.</h3>
					<div class="login_box">
						<!--Login-->
						<div class="user_enter">
							<ul class="i_text">
								<li class="tit">회원로그인</li>
								<li class="text">
									가입하신 아이디와 비밀번호를 입력해주세요.<br/>
							
								</li>
							</ul>
							<form name="mail_login_form" method="post" onsubmit="mainLoginInputSendit();event.returnValue = false;">
								<input type="hidden" name="login" value="1">
								<input type="hidden" name="login_go" value="<?=$_GET[login_go];?>">
								<ul>
									<li><input name="userid" type="text" class="enter" style='ime-mode:disabled;' placeholder="아이디"></li>
									<li><input name="passwd" type="password" class="enter" onKeyDown="mainLoginInputSendit();" style='ime-mode:disabled;' placeholder="비밀번호"></li>
									<li><a href="javascript:mainLoginSend();" class="login_btn">로그인</a></li>
									<li class="security">
										<input type="checkbox" name="slogin" value="1" checked><label>보안접속</label>
										<a href="./idpass.php">ID/PW 찾기</a>
									</li>
								</ul>
							</form>
						</div>
						<!--//Login-->
						<!--SNS&Join-->
						<ul class="sns_join">
							<?/*
							<li class="tit">SNS 로그인</li>
							<li class="text1">SNS 계정으로 간편하게 로그인하실 수 있습니다.</li>
							<li class="sns_btn">
								<a href="#" class="naver"><img src="images/sns_i_naver.gif"/><span>네이버 로그인</span></a>
								<a href="#" class="kakao"><img src="images/sns_i_kakao.gif"/><span>카카오 로그인</span></a>
								<a href="#" class="facebook"><img src="images/sns_i_facebook.gif"/><span>페이스북 로그인</span></a>
								<a href="#" class="google"><img src="images/sns_i_google.gif"/><span>구글 로그인</span></a>
							</li>
							*/?>
							<li>
							<?//include "./include/snslogin.inc.php";?><br>
							</li>
							<li class="tit">회원가입</li>
							<li class="text2">
								아직 회원이 아니세요?<br/>
								지금 멤버십 회원가입을 하세요.
							</li>
							<li class="join_btn"><a href="join.php">회원가입</a></li>
						</ul>
						<!--//SNS&Join-->
					</div>
					<!--AD-->
					<div class="bottom_ad">
						<? include("./include/banner_code1.inc.php");?>
					</div>
					<!--//AD-->
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
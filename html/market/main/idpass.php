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
						<!--********************내용영역 출력 시작********************-->
							<script language="JavaScript">
							<!--
							function sendit() {
								var form=document.idpass_form;
								if(form.name.value=="") {
									alert("회원님의 이름을 입력해 주세요.");
									form.name.focus();
								} else if(form.email.value=="") {
									alert("회원님의 E-Mail를 입력해 주세요.");
									form.email.focus();
								} else {
									form.submit();
								}
							}
							//-->
							</script>
						<table width="100%">
							<tr>
							  <td height='60' class='bbs2' style='text-align:center;line-height:18px;'>아이디 및 비밀번호를 분실 하셨나요?<BR>회원님의 정보를 빠르게 찾아 드립니다.</td>
							</tr>
							<tr>
							  <td bgcolor="#f9f9f9" style='padding:20px;'>
								<table style='margin:0 auto;'>
									<form method="post" action="idpass_ok.php" name="idpass_form">
									<tr>
									  <td height="60">
										<table width="100%">
											<tr>
											  <td width="25%" height="33" style='text-align:right; padding-right:5px;'>이 름:</td>
											  <td height="33"><input name="name" type="text" class="formText"></td>
											</tr>
											<tr>
											  <td width="25%" height="33" style='text-align:right; padding-right:5px;'>이메일:</td>
											  <td height="33"><input name="email" type="text"  style="IME-MODE:disabled" class="formText" onKeyDown="mainLoginInputSendit();"></td>
											</form>
											</tr>
										</table>
									  </td>
									  <td>
										  <table border="0"><tr><td style='padding-left:2px;'><a href="javascript:sendit();" class='oolimbtn-botton5'>SEARCH</a><td><tr>
										  </table>
									  </td>
									</tr>
								</table>
							  </td>
							</tr>
							<tr>
							  <td height="50" style='text-align:center; padding:4px' class='bbs2'>가입하실때 입력하신 이메일 주소로 아이디 ,패스워드를 발송해 드립니다. <br>정확한 이메일 주소가 생각나지 않으신다면 고객센터로 직접문의 바랍니다.</td>
							</tr>
						</table>
						<!--********************내용영역 출력 끝********************-->


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
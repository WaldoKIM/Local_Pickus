<? include('./include/head.inc.php');?>
<?
// 회원체크
if( !$_SESSION[USERID] || !$_SESSION[PASSWD] ) {
// 로그인 상태가 아니면 회원 로그인으로 보낸다
$tools->metaGo('login.php?login_go='.$_SERVER[REQUEST_URI]);
}
?>
<script language="JavaScript">
	<!--
	function sendit() {
		var form=document.exit_form;
		if(form.userid.value=="") {
			alert("회원아이디를 입력해 주세요.");
			form.userid.focus();
		} else if(form.userid.value.length < 4 || form.userid.value.length > 21) {
			alert("회원아이디는 4~20자로 입력 주세요.");
			form.userid.focus();
		} else if(form.passwd.value=="") {
			alert("패스워드를 입력해 주세요.");
			form.passwd.focus();
		} else if(form.passwd.value.length < 4 || form.passwd.value.length > 21) {
			alert("패스워드는 4~20자로 입력 주세요.");
			form.passwd.focus();
		} else if(form.passwd_check.value=="") {
			alert("패스워드확인를 입력해 주세요.");
			form.passwd_check.focus();
		} else if(form.passwd.value != form.passwd_check.value) {
			alert("패스워드가 정확하지 않습니다. 정확히 입력해 주세요.");
			form.passwd_check.focus();
		} else {
			<?if($SECURITYDOMAIN){?>
				form.action = "<?=$SECURITYDOMAIN?>/my_member_exit_ok.php";
			<?}else{?>
				form.action = "my_member_exit_ok.php";
			<?}?>
			form.submit();
		}
	}
	//-->
</script>
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
				<li><i class="fas fa-arrow-left"></i>마이페이지</li>				
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li><i class="fas fa-arrow-left"></i>회원탈퇴신청</li>
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
						<h2 class="tit">회원탈퇴신청</h2>
						<table width="100%" class='joinform_sizeR'>
							<form method=post name="exit_form">
							<tr>
								<td height="2" bgcolor='333333'>
								</td>
								<td height="2" bgcolor='333333'>
								</td>
							</tr>
							<tr>
								<td width="30%" height="35" bgcolor="F8F8F8" class="ordertitleM_ex">
									아이디 :
								</td>
								<td height="35" style="padding-left:10px;">
									<input name="userid" type="text" class="formText formText_lage">
								</td>
							</tr>
							<tr>
								<td height="1" bgcolor='DDDDDD'>
								</td>
								<td height="1" bgcolor='DDDDDD'>
								</td>
							</tr>
							<tr>
								<td width="30%" height="35" bgcolor="F8F8F8" class="ordertitleM_ex">
									비밀번호 :
								</td>
								<td height="35" style="padding-left:10px;">
									<input name="passwd" type="password" class="formText formText_lage">
								</td>
							</tr>
							<tr>
								<td height="1" bgcolor='DDDDDD'>
								</td>
								<td height="1" bgcolor='DDDDDD'>
								</td>
							</tr>
							<tr>
								<td width="30%" height="35" bgcolor="F8F8F8" class="ordertitleM_ex">
									비밀번호확인 :
								</td>
								<td height="35" style="padding-left:10px;">
									<input name="passwd_check" type="password" class="formText formText_lage">
								</td>
							</tr>
							<tr>
								<td height="1" bgcolor='757575'>
								</td>
								<td height="1" bgcolor='757575'>
								</td>
							</tr>
							</form>
						</table>
						<table STYLE='margin:0 auto;'>
							<tr>
								<td STYLE='padding:20px;'><a href="javascript:sendit();" class="oolimbtn-botton2" style="width:180px">회원탈퇴신청</a></td>
							</tr>
						</table>
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
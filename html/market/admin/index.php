<?
/*
$arr_browser = array ("iPhone","iPod","IEMobile","Mobile","lgtelecom","PPC"); 
for($indexi = 0 ; $indexi < count($arr_browser) ; $indexi++) { 
	if(strpos($_SERVER['HTTP_USER_AGENT'],$arr_browser[$indexi]) == true){ 
		header("Location: ./mlogin.php");
		exit; 
	} 
}
*/
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>쇼핑몰 관리자 페이지</title>
</head>
<LINK REL="stylesheet" HREF="css/admin_style.css" TYPE="TEXT/CSS">

<script language="javascript" src="./basic/uView.js"></script>

<script language="javascript">
	<!--
	function resetpass(){
		window.open("resetpass.php","reset","scrollbars=no, left="+(screen.width-350)/2+", top="+(screen.height-250)/2+", width=350, height=300")
	}
	//-->
</script>
<script language="javascript">
<!--
function sendit() {
    var form=document.login_form;
	if(form.admin_userid.value=="") {
	    alert("관리자 아이디를 입력해 주십시오.");
		form.admin_userid.focus();
	} else if(form.admin_passwd.value=="") {
	    alert("관리자 비밀번호를 입력해 주십시오.");
		form.admin_passwd.focus();
	} else {
	    form.submit();
	}
}

function roll_over_on(obj) {
	obj.style.backgroundColor="#FFFFFF";
}
function roll_over_off(obj) {
	obj.style.backgroundColor="#EEEEEE";
}


function inputSendit() {
	if(event.keyCode==13) { 
		sendit();
	}
}
//-->
</script>
<body onload="pageInit();">
<div style='text-align:center; margin:0 auto'>
		<table style='text-align:center; margin:0 auto'>
			<tr>
				<td style='padding-top:20px;text-align:center;color:#ffffff' class='sensL'>관리자 페이지 접속은 PC에서만 가능하며,  모바일 접속은 권장 하지 않습니다.<br>익스플로러 9.0이상 권장하며 이하버젼에서는 일부기능이 제한됩니다.(사용자.관리자페이지 공통)</td>
			</tr>
			<tr>
				<td style='padding-top:150px; text-align:center; '><img src="img/admin_login_title.gif" border="0"></td>
			</tr>
			<tr>
				<td>

					<table class='index_login3'>
						<tr>
							<td class="index_login" style='text-align:center; padding-left:10px;'>
								<!-----------로그인테이블출력--------->                                                            
								<table cellpadding="0" cellspacing="0" width="540" height="160" style="margin-top:10px;border-radius:13px;background:#FFFFFF;">
								<tr>
								  <td width="278" style="padding-left:50px;">
									<table cellpadding="0" cellspacing="0" align="center">
									<form name="login_form" method="post" action="admin_login_ok.php" onSubmit="inputSendit();event.returnValue = false;">
									<tr>
									  <td width="93">
										<p><img src="img/sub5_login_id.gif" width="93" height="36" border="0"></p>
									  </td>
									  <td width="185" background="img/sub5_login_id_bg.gif" style="padding-left:10px;">
										<p><input type="text" name="admin_userid" onMouseOut="roll_over_on(this);" onMouseOver="roll_over_off(this);" value=""></p>
									  </td>
									</tr>
									<tr>
									  <td width="93">
										<p><img src="img/sub5_login_pw.gif" width="93" height="37" border="0"></p>
									  </td>
									  <td width="185" background="img/sub5_login_pw_bg.gif" style="padding-left:10px;">
										<p><input type="password" name="admin_passwd" onMouseOut="roll_over_on(this);" onMouseOver="roll_over_off(this);" onKeyDown="inputSendit();" value=""></p>
									  </td>
									</tr>
									</form>
									</table>
								  </td>
								  <td width="155">
									<a href="javascript:sendit();"><img src="img/sub5_login_icon.gif" width="81" height="55" border="0"></a>
								  </td>
								</tr>
								</table>
								<!-----------로그인테이블출력--------->  
							</td>
						</tr>
						<tr>
							<td height="25"></td>
						</tr>
						<tr>
							<td style='text-align:center;padding-left:15px;'><a href="javascript:resetpass()" class='box-radius'>관리자 아이디와 비밀번호를 분실 하셨습니까?</a></td>
						</tr>
					</table>

				</td>
			</tr>
		</table>

</div>
</body>

</html>

<?
include('../../common.php');
//$_GET=&$HTTP_GET_VARS; //$_POST=&$HTTP_POST_VARS;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<title>메일보내기</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/popup.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/component.css" />

<script language="JavaScript">
<!--
function sendit() {
	var form=document.mail_form;
	if(form.tomail.value=="") {
		alert("받는 사람 이메일을 입력해 주세요.");
		form.tomail.focus();
	} else if(form.title.value=="") {
		alert("보내실 메일의 제목을 입력해 주세요.");
		form.title.focus();
	} else if(form.content.value=="") {
		alert("보내실 메일의 내용을 입력해 주세요.");
		form.content.focus();
	} else {
		form.submit();
	}
}
//-->
</script>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="484">
	<tr>
		<td width="484" height="96"><img src="../images/sendmail.gif" width="484" height="96"></td>
	</tr>
	<tr>
		<td align="center"><br>
			<table width="450">
				<tr>
					<td height="55" align="center" bgcolor="E7E7EF" class="submenu" style="padding-left:20px;">회원들에게 개별적으로 메일을 보내실 수 있습니다</td>
				</tr>
			</table><br>
			<table width="450" style='border-collapse: collapse'>
				<form action="./user_sendmail_ok.php" method="post" name="mail_form"  enctype="multipart/form-data">
				<tr> 
					<td width="120" height="12" align="center" bgcolor="F5F5F5" class='contenM tabletd_all'>받는사람</td>
					<td width="330" height="12" class='contenM tabletd_all'><input name="tomail" type="text" size="30"  class="formText_mo"value="<?=$_GET[user_mail];?>"></td>
				</tr>
				<tr> 
					<td width="120" height="3" align="center" bgcolor="F5F5F5" class='contenM tabletd_all'>제 목</td>
					<td width="330" height="3" class='contenM tabletd_all'><input name="title" type="text" size="50"  class="formText_mo"></td>
				</tr>
				<tr> 
					<td height="7" align="center" bgcolor="F5F5F5" class='contenM tabletd_all'>내 용</td>
					<td width="330" height="7" class='contenM tabletd_all'>
						<table width="320">
							<tr> 
								<td height="20" class="menu"><input type="radio" name="tag" value="0" checked> text <input type="radio" name="tag" value="1"> html</td>
							</tr>
						</table>
						<textarea name="content" cols="30" rows="5"  class="formText_mo"></textarea>
					</td>
				</tr>
				</form>
				<tr> 
					<td height="30" colspan="2" align="center"><a href="javascript:sendit();" class="itemtable_default_bt3">저장하기</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>

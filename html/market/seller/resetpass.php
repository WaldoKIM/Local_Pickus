<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title> 쇼핑몰 관리자 페이지』</title>
</head>
<LINK REL="stylesheet" HREF="css/popup.css" TYPE="TEXT/CSS">

<script language="javascript">
	<!--
	function sendit() {
		var form=document.submitform;
		if(form.host.value=="") {
			alert("디비 호스트정보를 입력해 주십시오.");
			form.host.focus();
		} else if(form.name.value=="") {
			alert("디비 명을 입력해 주십시오.");
			form.name.focus();
		} else if(form.user.value=="") {
			alert("디비 사용자명을 입력해 주십시오.");
			form.user.focus();
		} else if(form.passwd.value=="") {
			alert("디비 비밀번호를 입력해 주십시오.");
			form.passwd.focus();
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
	//-->
</script>

<body>
<table width="100%">
	<tr>
		<td>
		
		<table width="100%">
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td height="30" style='text-align:center;'><b><span style="font-size:12pt;">관리자 아이디.비밀번호 초기화</span></b></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td height="5"></td>
			</tr>
			<tr>
				<td valign="top" style='padding:1em;'>
				<table width='100%'>
					<tr>
						<td>
							<!-----------로그인테이블출력--------->                                                            
							<table width="100%" class="table_all">
							<form name="submitform" method="post" action="resetpass_ok.php" onsubmit="sendit();event.returnValue = false;">
							<tr>
							  <td align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
								DB Host (디비호스트)
							  </td>
							  <td class='sensO tabletd_all'><input type="text" name="host" onMouseOut="roll_over_on(this);" onMouseOver="roll_over_off(this);" class="box_c"></td>
							</tr>
							<tr>
							  <td align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
								DB Name (디비명)
							  </td>
							  <td class='sensO tabletd_all'><input type="text" name="name" onMouseOut="roll_over_on(this);" onMouseOver="roll_over_off(this);" class="box_c"></td>
							</tr>
							<tr>
							  <td align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
								DB User (디비 아이디)
							  </td>
							  <td class='sensO tabletd_all'><input type="text" name="user" onMouseOut="roll_over_on(this);" onMouseOver="roll_over_off(this);" class="box_c"></td>
							</tr>
							<tr>
							  <td align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
								DB Password (디비 비밀번호)
							  </td>
							  <td class='sensO tabletd_all'><input type="password" name="passwd" onMouseOut="roll_over_on(this);" onMouseOver="roll_over_off(this);" class="box_c"></td>
							</tr>
							</table>

							<table cellpadding="3" cellspacing="0" width="100%">
								<tr>
									<td style='text-align:center;'>※디비정보를 모르실 경우에는 <b><font color="FF5F00">호스팅서비스 업체</font></b>에관련정보 요청을 해주십시요.</td>
								</tr>
								<tr>
									<td style='text-align:center;'>※디비정보 입력후 검색버튼을 클릭하시면 아이디(<font color="FF5F00">admin</font>) 비밀번호(<font color="FF5F00">admin</font>)으로 초기화 됩니다.</td>
								</tr>
								<tr>
									<td style='text-align:center;'><input type="image" src="images/adminlost_write_register.gif" border="0"></td>
								</tr>
							</table>
							<!-----------로그인테이블출력--------->  
						</td>
					</tr>
					</form>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</body>

</html>

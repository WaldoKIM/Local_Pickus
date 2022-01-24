<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>쇼핑몰 자동구축솔루션 [라이센스확인 ]</title>
</head>
<LINK REL="stylesheet" HREF="css/admin_style.css" TYPE="TEXT/CSS">
<LINK REL="stylesheet" HREF="../../lib/oolim_button_style.css" TYPE="TEXT/CSS">

<SCRIPT LANGUAGE="JavaScript">
<!--
// 입력폼 체크 자바스크립트
function sendit() {
	var form=document.admin_form;
	if(form.shop_license.value=="") {
		alert("프로그램 등록 코드를 입력해 주세요.");
		form.shop_license.focus();
	}else if(form.trade_code.value=="") {
		alert("주문코드를 입력해 주세요.");
		form.trade_code.focus();
	} else {
		form.submit();
	}
}
//-->
</SCRIPT>

<body>

<div style='text-align:center; margin:0 auto'>
	<table style='text-align:center; margin:0 auto'>
		<tr>
			<td style='padding-top:20px;text-align:center;color:#ffffff' class='sensL'>관리자 페이지 접속은 PC에서만 가능하며,  모바일 접속은 권장 하지 않습니다.<br>익스플로러 9.0이상 권장하며 이하버젼에서는 일부기능이 제한됩니다.(사용자.관리자페이지 공통)</td>
		</tr>
		<tr>
			<td style='padding-top:150px; text-align:center;'></td>
		</tr>
		<tr>
			<td style='text-align:center;color:#ffffff'>

				<form action="license_reg_ok.php" method="post" name="admin_form">
				<input type="hidden" name="admin_userid" value='<?=$admin_userid?>'>
				<input type="hidden" name="admin_passwd" value='<?=$admin_passwd?>'>
				<table width="550">
					<tr>
						<td><img src="img/license_title.gif" width="346" height="84" border="0"></td>
					</tr>
					<tr>
						<td style='text-align:center;'>
							<table width="550" style='text-align:center;margin:0 auto'>
								<tr>
									<td height="10" background="img/license_bg1.gif"></td>
								</tr>
								<tr>
									<td style='text-align:center;'>
										<table width="550" style='text-align:center;margin:0 auto'>
											<tr>
												<td width="10" height="220" background="img/license_bg2.gif"></td>
												<td style='padding:1em'>
													
													<table width="469" style='text-align:center;margin:0 auto'>
														<tr>
															<td style='text-align:center; height:50px;'><a href='http://www.oolim.net/' target='new'class='oolimbtn_bbs_blue'>홈페이지바로가기</a></td>
														</tr>
														<tr>
															<td style='text-align:center;height:100px;border-top:1px solid #9C9C9C;'>
																<table width="90%" style='text-align:center;margin:0 auto'>
																	<tr>
																		<td style='text-align:center;'>
																			<table width="100%" style='text-align:center;margin:0 auto'>
																				<tr>
																					<td style='text-align:right;' class='index_reg_titleL'>라이센스발급번호 : </td>
																					<td style='padding:10px'><input name="shop_license" type="text"  maxlength="10" value="" class='formText'></td>
																				</tr>
																				<tr>
																					<td style='text-align:right;border-top:1px solid #ddd;' class='index_reg_titleL'>주문번호 : </td>
																					<td style='padding:10px;border-top:1px solid #ddd;'><input name="trade_code" type="text"  value="" class='formText'></td>
																				</tr>
																			</table>
																		</td>
																		<td style='padding-left:10px'>
																		<a href="javascript:sendit();"class='box-radius'>등록</a>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
												<td width="10" height="220" background="img/license_bg3.gif"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="10" background="img/license_bg4.gif"></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="10"></td>
					</tr>
					<tr>
						<td style='text-align:center;'><img src="img/license_title3.gif" width="314" height="19" border="0"></td>
					</tr>
				</table>
				</form>
			</td>
		</tr>
	</table>
</div>
</body>

</html>

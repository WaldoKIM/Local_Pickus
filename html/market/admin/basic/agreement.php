<? 
include('../header.php'); 

// 기본 관리자 정보 불러오기.
$admin_stat = $db->object("cs_admin", "");
?>

<script language="javascript">
<!--
// 폼 전송
function sendit() {
	var form=document.admin_form;
	form.agreement.value = myeditor.outputBodyHTML();
	if(form.agreement.value=="") {
		alert("이용약관을 입력해 주세요.");
		form.agreement.focus();
	} else {
		form.submit();
	}
}

//  웹FTP 새창 오픈
function ftpWinOpen() {
	window.open("../webftp.php","","scrollbars=yes, width=500, height=600");
}

//  TEXTAREA 입력 폼 크기 조정
function textarea_resize( formname, size ) {
	if( size=='reset' ){
		formname.rows = 15;
	}else{
		var value = formname.rows + size;
		if(value>16) formname.rows = value;
		else return;
	}
}
//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/sub_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">이용약관설정
				</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#dddddd"></td>
			</tr>
			<tr>
				<td height="25"></td>
			</tr>
			<tr>
				<td class="padding_5">
					<table  width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
								<table width="100%" border="0" align="center">
								<form action="agreement_ok.php" method="post" name="admin_form">
									<tr>
										<td align="center" valign="top" bgcolor="#FFFFFF" class="menu"><br>
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<td>
													<table width="100%">
														<tr>
															<td height="25">
															<table>
																<tr>
																	<td class="sub_titleM"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">이용약관</td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20">
																<!--도움말-->
																	<table width="100%" class='tipbox'>
																		<tr>
																			<td bgcolor="#E9F2F8">
																				<table width="100%">
																					<tr>
																						<td height="20">
																							<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
																						</td>
																					</tr>
																					<tr>
																						<td>회원가입시 보여지는 회원가입약관입니다.</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>
																<!--도움말--->

															</td>
														</tr>
														<tr>
															<td height="5"></td>
														</tr>
													</table>
												</td>
												</tr>
											</table>
											<table width="100%" class="table_all"> 
												<tr> 
													<td width="90%" class='tabletd_all tabletd_small'>
														<table width="100%">
															<tr> 
																<td>&nbsp;
																	<input type="hidden" name="agreement_tag" value="1">
																	<textarea id="agreement" name="agreement" style="display:none"><?=$admin_stat->agreement?></textarea>
																	<!-- 에디터를 화면에 출력합니다. -->
																	<script type="text/javascript" language="javascript">
																		var myeditor = new cheditor();
																		myeditor.config.editorHeight = '500px';             // 에디터 세로폭입니다.
																		myeditor.config.editorWidth = '100%';                // 에디터 가로폭입니다.
																		myeditor.inputForm = 'agreement';                     // 입력 textarea의 ID 이름입니다.
																		myeditor.run();                                     // 에디터를 실행합니다.
																	</script>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table><br>
											<a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a><br><br>
										</td>
									</tr>
								</form>
								</table>
								<!--콘텐츠출력-->
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</article>
	
</div>



<? include('../footer.php'); ?>


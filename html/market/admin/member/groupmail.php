<?
include('../header.php');
$mailing_cnt=$db->cnt("cs_member", "where mailing=1");
$member_cnt=$db->cnt("cs_member", "");
?>

<script language="JavaScript">
<!--
function sendit() {
	var form=document.groupmail_form;
	form.content.value = myeditor.outputBodyHTML();
	if(form.frommail.value=="") {
		alert("보내는 사람 이메일을 입력해 주세요.");
		form.frommail.focus();
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
// 웹FTP 새창 오픈
function ftpWinOpen() {
	window.open("../webftp.php","","scrollbars=yes, width=500, height=600");
}

// TEXTAREA 입력 폼 크기 조정
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
		<?include('inc/member_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">


		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">회원관리</b>
				</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#dddddd"></td>
			</tr>
			<tr>
				<td height="25" bgColor="white"></td>
			</tr>
			<tr>
				<td class="padding_5">
					<table  width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
								<table width="100%" border="0" align="center">
									<tr> 
										<td align="center" valign="top" bgcolor="#FFFFFF"></td>
									</tr>
									<tr> 
										<td height="75" align="center" valign="top" bgcolor="#FFFFFF">
										<table width="100%">
												<tr>
												<td>
													<table width="100%">
														<tr>
															<td height="25">
															<table>
																<tr>
																	<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">그룹메일발송</td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20">
																<!--도움말-->
																	<table width="100%" class='tipbox noneoolim'>
																		<tr>
																			<td bgcolor="#E9F2F8">
																				<table width="100%">
																					<tr>
																						<td height="20">
																							<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
																						</td>
																					</tr>
																					<tr>
																						<td>전체회원과 메일수신허용한 회원들을 따로 분리해서 보내실 수 있습니다</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>
																<!--도움말--->
															</td>
														</tr>
														<tr>
															<td height="5">
															</td>
														</tr>
													</table>
												</td>
												</tr>
											</table> 
											<table width="100%" class="table_all">
												<form method="post" action="groupmail_ok.php" name="groupmail_form">
												<tr bgColor="white"> 
													<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>보내는 사람</td>
													<td class='tabletd_all tabletd_small'><input name="frommail" type="text" class="formText" value="<?=$_SESSION[ADMIN_EMAIL];?>" size="35"></td>
												</tr>
												<tr bgColor="white"> 
													<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>받는 사람</td>
													<td class='tabletd_all tabletd_small'><input type="radio" name="mailing" value="1" checked>수신허용회원 <input type="radio" name="mailing" value="2">전체회원 <span class="menupurple">( 메일 수신 허용 : <?=$mailing_cnt;?> / 전체 : <?=$member_cnt;?> ) 명</span></td>
												</tr>
												<tr bgColor="white"> 
													<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>제 목</td>
													<td class='tabletd_all tabletd_small'><input name="title" type="text" class="formText" size="70"></td>
												</tr>
												<tr bgColor="white"> 
													<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>메일내용</td>
													<td class='tabletd_all tabletd_small'>
														<table width="100%" border="0" height="30">
															<tr> 
																<td height="3" colspan="2"></td>
															</tr>
															<tr  height="25">
																<td align="left">&nbsp;
																	<input type="hidden" name="tag" value="1">
																	<textarea id="content" name="content" style="display:none"></textarea>
																	<!-- 에디터를 화면에 출력합니다. -->
																	<script type="text/javascript" language="javascript">
																		var myeditor = new cheditor();
																		myeditor.config.editorHeight = '300px';             // 에디터 세로폭입니다.
																		myeditor.config.editorWidth = '100%';                // 에디터 가로폭입니다.
																		myeditor.inputForm = 'content';                     // 입력 textarea의 ID 이름입니다.
																		myeditor.run();                                     // 에디터를 실행합니다.
																	</script>
																</td>
															</tr>
															</form>
														</table>
													</td>
												</tr>
											</table>
											<table style='margin:0 auto;' class=' noneoolim'>
												<tr>
													<td height='70' style='text-align:center'><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<table style='margin:0 auto;' class='none_space_mobile03'>
									<tr>
										<td height='70' style='text-align:center'><h2>해당 페이지는 모바일에서는 사용이 불가능 합니다. PC에서 이용을 해주시기 바랍니다.</h2></td>
									</tr>
								</table>
								<!--콘텐츠출력-->
							</td>
						</tr>
						<tr>
							<td height="30"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</article>
	
</div>



<? include('../footer.php'); ?>


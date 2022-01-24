<?
include('../header.php');
include($ROOT_DIR.'/lib/style_class.php');
//$_GET=&$HTTP_GET_VARS; 
$row = $db->object("cs_page", " where idx='$_GET[idx]'"); 
?>

<script language="JavaScript">
<!--
function sendit() {
	var form=document.page_form;
	form.content.value = myeditor.outputBodyHTML();
	if(form.page_index.value=="") {
		alert("페이지 INDEX를 입력해 주세요.");
		form.page_index.focus();
	} else if(form.title.value=="") {
		alert("페이지 타이틀을 입력해 주세요.");
		form.title.focus();
	} else if(form.content.value=="") {
		alert("페이지 내용을 입력해 주세요.");
		form.content.focus();
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
		formname.rows = 10;
	}else{
		var value = formname.rows + size;
		if(value>11) formname.rows = value;
		else return;
	}
}
//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/category_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">Html페이지관리
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
									<form action="page_edit_ok.php" method="post" name="page_form" enctype="multipart/form-data">
									<input type="hidden" name="idx" value="<?=$_GET[idx];?>">
									<tr> 
										<td height="70" align="center" valign="top" bgcolor="#FFFFFF" class="menu">			
										<table width="100%">
												<tr>
												<td>
													<table width="100%">
														<tr>
															<td height="25">
															<table>
																	<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">사용자정의페이지수정</td>
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
																						<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																					</tr>
																					<tr>
																						<td>페이지 INDEX : 생성한 페이지의 링크경로값을 가져올 때 사용합니다.<br>
																							(ex. 페이지 INDEX의 값이 info일때 a href=”pageview.php?url=info”)<br>
																							페이지 이미지와 내용을 모두 입력할 경우에는 이미지가 우선 노출되며, 그 아래로 HTML이 노출됩니다.<br>
																							고정메뉴의 경우 명칭만 변경 가능합니다.
																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>
																<!--도움말-->
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
												<tr bgColor="white" <?if($row->fixed==1){?>style="display:none"<?}?>> 
													<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>페이지 INDEX</td>
													<td height="25" class='tabletd_all tabletd_small'><input name="page_index" type="text" class="formText" maxlength="40" <?=$style->strCheck(2);?> value="<?=$row->page_index;?>"> 페이지의 일련번호(영문 or 숫자 작성)</td> 
												</tr>
												<tr bgColor="white"> 
													<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>페이지 타이틀</td>
													<td height="25" class='tabletd_all tabletd_small'><input name="title" type="text" class="formText" value="<?=$row->title;?>"> 간단한 설명</td>
												</tr>
												<tr bgColor="white" <?if($row->fixed==1){?>style="display:none"<?}?>> 
													<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>페이지 이미지</td>
													<td height="25" class='tabletd_all tabletd_small'>
														<table>
															<tr>
																<td height="28"><input name="title_img" type="file" class="formText"> 이미지 파일을 이용하여 주세요.</td>
															</tr>
															<tr>
																<td>
																	<?
																	if($row->title_img){
																		$logo_img="<br><img src='../../data/designImages/".$row->title_img."' border='0' align='absmiddle'>";
																	}
																	?>
																	<?if($row->title_img){?>
																		<input type="checkbox" value="1" name="title_img_del">삭제시 선택하여주세요[삭제우선]!<br><?=$logo_img?>
																	<?}?>
																
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr bgColor="white" <?if($row->fixed==1){?>style="display:none"<?}?>> 
													<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>링크경로</td>
													<td height="25" class='tabletd_all tabletd_small'> 생성한 페이지의 링크경로는 <span class="menupurple">a href=&quot;pageview.php?url=페이지 INDEX&quot</span>로 작성해 주시기 바랍니다. </td>
												</tr>
												<tr bgColor="white" <?if($row->fixed==1){?>style="display:none"<?}?>> 
													<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>내용입력</td>
													<td height="25" class='tabletd_all tabletd_small'>
														<table width="100%" border="0" height="30">
															<tr> 
																<td height="3" colspan="2"></td>
															</tr>
															<tr  height="25">
																<td align="left" class="menu">&nbsp;
																	<textarea id="content" name="content" style="display:none"><?=$row->content?></textarea>
																	<!-- 에디터를 화면에 출력합니다. -->
																	<script type="text/javascript" language="javascript">
																		var myeditor = new cheditor();
																		myeditor.config.editorHeight = '400px';             // 에디터 세로폭입니다.
																		myeditor.config.editorWidth = '100%';                // 에디터 가로폭입니다.
																		myeditor.inputForm = 'content';                     // 입력 textarea의 ID 이름입니다.
																		myeditor.run();                                     // 에디터를 실행합니다.
																	</script>
																</td>
															</tr>
															<tr> 
																<td height="3" colspan="2"></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<table width="100%">
												<tr> 
													<td height="55" align="center"><a href="javascript:sendit();" class='oolimbtn-botton1'>수정완료</a></td>
												</tr>
											</table>
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

<?
include('../header.php');
include($ROOT_DIR.'/lib/style_class.php');
?>

<script language="JavaScript">
<!--
function sendit() {
	var form=document.popup_form;
	form.content.value = myeditor.outputBodyHTML();
	if(form.width.value=="") {
		alert("가로 사이즈를 입력해 주세요.");
		form.width.focus();
	} else if(form.height.value=="") {
		alert("세로 사이즈를 입력해 주세요.");
		form.height.focus();
	} else if(form.title_bar.value=="") {
		alert("브라우즈 타이틀바를 입력해 주세요.");
		form.title_bar.focus();
	} else if(form.display[0].checked==true && form.content.value=="") {
		alert("팝업창 내용을 입력해 주세요.");
		form.content.focus();
	} else {
		form.submit();
	}
}

////  웹FTP 새창 오픈  시작 ///////////////////////////////////////////////////////////////////////////////
function ftpWinOpen() {
	window.open("../webftp.php","","scrollbars=yes, width=500, height=600");
}
////  웹FTP 새창 오픈  종료 /////////////////////////////////////////////////////////////////////////////////

////  TEXTAREA 입력 폼 크기 조정 시작 //////////////////////////////////////////////////////////////////
function textarea_resize( formname, size ) {
	if( size=='reset' ){
		formname.rows = 10;
	}else{
		var value = formname.rows + size;
		if(value>11) formname.rows = value;
		else return;
	}
}
////  TEXTAREA 입력 폼 크기 조정 종료 //////////////////////////////////////////////////////////////////

function popupReg() {
	var form=document.popup_form;
	if( form.display[0].checked ) {
		document.all.popup_view[0].style.display="none"; 
		document.all.popup_view[1].style.display="none"; 
		document.all.popup_view[2].style.display=""; 
		document.all.popup_view[3].style.display="none"; 
	} else if( form.display[1].checked ) {
		document.all.popup_view[0].style.display=""; 
		document.all.popup_view[1].style.display=""; 
		document.all.popup_view[2].style.display="none"; 
		document.all.popup_view[3].style.display=""; 
	}
}
//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/design_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
									<table width="100%">
										<tr>
											<td height="20" class='sub_titleL'>
												<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">팝업창등록
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
												<table width="100%">
													<tr>
														<td>
															<!--콘텐츠출력-->
<table width="100%" border="0" align="center">
	<form action="popup_add_ok.php" method="post" name="popup_form" enctype="multipart/form-data">
	<tr> 
		<td align="center" valign="top" bgcolor="#FFFFFF" class="menu">
			<table width="100%">
				<tr>
				<td>
					<table width="100%">
						<tr>
							<td height="25">
							<table>
								<tr>
									<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">팝업창등록</td>
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
														<td>형태 선택 : HTML태그를 이용하는 방법과 단일 이미지를 선택합니다.<br>시작일/종료일 
														: 시작일(기본값-현재일)과 종료일을 선택합니다.<br>팝업창 사이즈 : 팝업창의 
														가로 세로 사이즈를 입력합니다. 단일 이미지일경우 이미지사이즈에 맞추세요.<br>브라우져 
														타이틀바 : 팝업창 타이틀에 출력될 타이틀내용을 입력합니다.<br>쿠키설정 
														: 조건에 맞는 항목을 선택하세요.<br>링크URL : 단일이미지일경우 클릭 시 
														이동할 URL주소를 입력합니다.<br>출력내용(HTML) : HTML로 출력할 내용을 
														입력합니다.</td>
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
					<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>모바일사용여부</td>
					<td height="25" class='tabletd_all tabletd_small'><input type="checkbox" name="popup_display" value="1"  <? if( $row->popup_display == 1 ) { echo("checked");}?>> 모바일 같이 사용시 선택하여 주세요. <br><font color="red">체크가 없을 경우 PC형태에서만 노출됩니다.</font> </td>
				</tr>
				<tr> 
					<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>형태 선택</td>
					<td class='tabletd_all tabletd_small'><input type="radio" name="display" value="0" checked onClick="popupReg()"> HTML <input type="radio" name="display" value="1" onClick="popupReg()"> 단일 이미지 </td>
				</tr>
				<tr> 
					<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>시작일/종료일</td>
					<td class='tabletd_all tabletd_small'>
						<select name="start_year"><? for($i=date('Y');$i<date('Y')+2;$i++){	$today_y=date("Y");?><option value="<?=$i?>" <?if($i==$today_y) echo("selected");?>><?=$i?></option><?}?></select>&nbsp;년&nbsp;&nbsp;
						<select name="start_mon"><? for($i=1;$i<13;$i++){if(strlen($i)==1)$i="0".$i; $today_m=date("m");?><option value="<?=$i?>" <?if($i==$today_m) echo("selected");?>><?=$i?></option><?}?></select>&nbsp;월&nbsp;&nbsp; 
						<select name="start_day"><? for($i=1;$i<32;$i++){if(strlen($i)==1)$i="0".$i; $today_d=date("d");?><option value="<?=$i?>" <?if($i==$today_d) echo("selected");?>><?=$i?></option><?}?></select>&nbsp;일&nbsp;~&nbsp;
						<select name="end_year"><? for($i=date('Y');$i<date('Y')+2;$i++){	$today_y=date("Y", mktime()+259200);?><option value="<?=$i?>" <?if($i==$today_y) echo("selected");?>><?=$i?></option><?}?></select>&nbsp;년&nbsp;&nbsp;
						<select name="end_mon"><? for($i=1;$i<13;$i++){if(strlen($i)==1)$i="0".$i; $today_m=date("m", mktime()+604800);?><option value="<?=$i?>" <?if($i==$today_m) echo("selected");?>><?=$i?></option><?}?></select>&nbsp;월&nbsp;&nbsp; 
						<select name="end_day"><? for($i=1;$i<32;$i++){if(strlen($i)==1)$i="0".$i; $today_d=date("d", mktime()+604800);?><option value="<?=$i?>" <?if($i==$today_d) echo("selected");?>><?=$i?></option><?}?></select>&nbsp;일
					</td>
				</tr>
				<tr> 
					<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>팝업창 사이즈</td>
					<td class='tabletd_all tabletd_small'><input name="width" type="text" class="formText" size="3" <?=$style->colorAlign("#000000", 0);?> <?=$style->strCheck(0);?>> 가로 X <input name="height" type="text" class="formText" size="3" <?=$style->colorAlign("#000000", 0);?> <?=$style->strCheck(0);?>> 세로 &nbsp;&nbsp;&nbsp;(새로운 창의 크기를 설정해주세요)<br>
					*입력된 사이즈는 PC에서만 사용되며, 모바일에서는 100% 고정입니다.</td>
				</tr>
				<tr> 
					<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>팝업창 위치</td>
					<td class='tabletd_all tabletd_small'><input name="top" type="text" class="formText" size="3" <?=$style->colorAlign("#000000", 0);?> <?=$style->strCheck(0);?>>TOP <input name="lefts" type="text" class="formText" size="3" <?=$style->colorAlign("#000000", 0);?> <?=$style->strCheck(0);?>> LEFT &nbsp;&nbsp;&nbsp;<br>
					*입력된 위치값은 PC에서만 사용되며, 모바일에서는 세로상단, 가로센터 고정입니다.</td>
				</tr>
				<tr> 
					<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>팝업테두리 색상</td>
					<td class='tabletd_all tabletd_small'><input name="layercolor" type="text" class="formText" size="12" value="<?=$row->layercolor?>"> &nbsp;&nbsp;&nbsp;(팝업레이어의 테두리 색상코드[예:#FFFFFF]를 삽입해주세요.)</td>
				</tr>
				<tr> 
					<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>팝업배경 색상</td>
					<td class='tabletd_all tabletd_small'><input name="layerbccolor" type="text" class="formText" size="12" value="<?=$row->bgcolor?>"> &nbsp;&nbsp;&nbsp;(팝업레이어의 배경 색상코드[예:#FFFFFF]를 삽입해주세요.)</td>
				</tr>
				<tr> 
					<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>브라우져 타이틀바</td>
					<td class='tabletd_all tabletd_small'><input name="title_bar" type="text" class="formText formText_subject"> &nbsp;간단한 설명</td>
				</tr>
				<tr> 
					<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>쿠키 설정</td>
					<td class='tabletd_all tabletd_small'><input type="radio" name="live" value="0" checked>※ 오늘은 이창을 다시 띄우지 않음 &nbsp;<input type="radio" name="live" value="1">※ 이창은 다시는 띄우지 않음</td>
				</tr>
				<tr id="popup_view" style="display:none;"> 
					<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>링크URL</td>
					<td class='tabletd_all tabletd_small'>HTTP://<input name="link_url" type="text" class="formText formText_subject"></td>
				</tr>
				<tr id="popup_view" style="display:none;"> 
					<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>출력 이미지</td>
					<td class='tabletd_all tabletd_small'><input name="popup_images" type="file" class="formText" size="30"> 출력할 이미지를 등록해 주세요</td>
				</tr>
				<tr id="popup_view" style="display:none;"> 
					<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>출력 내용[HTML]</td>
					<td class='tabletd_all tabletd_small'>
						<table width="100%" border="0" height="30">
							<tr> 
								<td height="3" colspan="2"></td>
							</tr>
							<tr  height="25">
								<td align="left" class="menu">&nbsp;
									<textarea id="content" name="content" style="display:none"></textarea>
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
								<td height="5" colspan="2"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table width="100%">
				<tr id="popup_view" style="display:none;"> 
					<td height="35" align="center" class='contenM tabletd_all'><img src="../images/arrow.gif" width="3" height="5"> 단일이미지 업로드시 링크URL 을 입력하시면 이미지를 클릭할 경우 해당페이지로 이동시킵니다. </td>
				</tr>
			</table><br>
			<table width="100%">
				<tr> 
					<td height="55" align="center"><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
				</tr>
			</table>
		</td>
	</tr>
	</form>
</table>
<script language="JavaScript">
<!--
var form=document.popup_form;
if( form.display[0].checked ) {
	document.all.popup_view[0].style.display="none"; 
	document.all.popup_view[1].style.display="none"; 
	document.all.popup_view[2].style.display=""; 
	document.all.popup_view[3].style.display="none"; 
} else if( form.display[1].checked ) {
	document.all.popup_view[0].style.display=""; 
	document.all.popup_view[1].style.display=""; 
	document.all.popup_view[2].style.display="none"; 
	document.all.popup_view[3].style.display=""; 
}
//-->
</script>
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

<? include('../header.php');?>

<script language="javascript">
	<!--
	function sendit() {
		var form=document.banner_form;
		form.content.value = myeditor.outputBodyHTML();
		if(form.title.value=="") {
			alert("배너명을 입력해 주세요.");
			form.title.focus();
		} else if(form.type[0].checked==true && form.content.value=="") {
			alert("팝업창 내용을 입력해 주세요.");
			form.content.focus();
		} else {
			form.submit();
		}
	}
	
	function bannerReg() {
		var form=document.banner_form;
		if( form.type[0].checked ) {
			document.all.banner_view[0].style.display="none";
			document.all.banner_view[1].style.display="none";
			document.all.banner_view[2].style.display="none";
			document.all.banner_view[3].style.display="";
			document.all.banner_view[4].style.display="none";
		} else if( form.type[1].checked ) {
			document.all.banner_view[0].style.display="";
			document.all.banner_view[1].style.display="";
			document.all.banner_view[2].style.display="";
			document.all.banner_view[3].style.display="none";
			document.all.banner_view[4].style.display="";
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
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">배너등록
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
	<form action="banner_add_ok.php" method="post" name="banner_form" enctype="multipart/form-data">
	<tr>
		</td>
		<td height="70" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
			<table width="100%">
				<tr>
				<td>
					<table width="100%">
						<tr>
							<td height="25">
							<table>
								<tr>
									<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">배너관리</td>
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
														<td>현재 등록되어있는 배너목록이 나타납니다.<br>
														등록을 하실려면 상단 우측의 배너추가 버튼을 누르시면 등록페이지로 이동합니다.<br>
														※배너의 위치는 스킨마다 다르게 출력될 수 있습니다. 사용자 화면을 보면서 위치를 확인하신 후 입력해주세요.<br><br><br>
														
														<span style="font-size:11pt;">[배너 페이지 정보]</span><br>
														배너의 위치는 스킨에 따라 위치가 틀립니다.<br>
														솔루션 설치후 사용자페이지의 배너영역에 각각의 배너코드가 설명되어 있으니 참고하시 해당 코드별로 배너를 등록하시면 되겠습니다.<br><br><br>

														http://사용자도매인/스킨명/include/banner_header_top.inc.php<br>
														http://사용자도매인/스킨명/include/banner_main_mid.inc.php<br><br>

														※배너의 진열형태는 직접 해당 소스를 열어서 가로 또는 세로의 형태를 설정할 수 있으며, 배너의 갯수 또한 소스에서 직접 수정할 수 있습니다.<br>
														기본적으로 설정되어 있는 배너위치 이외에 사용자가 직접 원하는 위치에 배너를 추가하실 경우에는 배너코드파일을 원하시는 위치에 include 시켜주시면 되겠습니다.</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								<!--도움말--->

							</td>
						</tr>
						<tr>
							<td height="25"></td>
						</tr>
					</table>
				</td>
				</tr>
			</table>
			<table width="100%" class="table_all"> 
				<form action="banner_add_ok.php" method="post" name="banner_form" enctype="multipart/form-data">
				<input type="hidden" name="code" value="<?=$_GET[code]?>">
				<tr>
					<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>
						베너타입
					</td>
					<td height="25" class='tabletd_all tabletd_small'>
						&nbsp;<input type="radio" name="type" value="1" onclick="bannerReg();"> HTML <input type="radio" name="type" value="2" onclick="bannerReg();" checked> 이미지(gif, jpg)
					</td>
				</tr>
				<tr>
					<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>
						위치 선택
					</td>
					<td class='tabletd_all tabletd_small'>
						<input type="radio" name="status" value="banner_code1"<? if( $row->status == "banner_code1" ) { echo("checked");}?>> banner_code1 <br>
						<input type="radio" name="status" value="banner_code2"<? if( $row->status == "banner_code2" ) { echo("checked");}?>> banner_code2 <br>
						<input type="radio" name="status" value="banner_code3"<? if( $row->status == "banner_code3" ) { echo("checked");}?>> banner_code3 <br>
						<input type="radio" name="status" value="banner_code4"<? if( $row->status == "banner_code4" ) { echo("checked");}?>> banner_code4 <br>
						<input type="radio" name="status" value="banner_code5"<? if( $row->status == "banner_code5" ) { echo("checked");}?>> banner_code5 <br>
						<input type="radio" name="status" value="banner_code6"<? if( $row->status == "banner_code6" ) { echo("checked");}?>> banner_code6 <br>
						<input type="radio" name="status" value="banner_code7"<? if( $row->status == "banner_code7" ) { echo("checked");}?>> banner_code7 <br>
						<input type="radio" name="status" value="banner_code8"<? if( $row->status == "banner_code8" ) { echo("checked");}?>> banner_code8 <br>
						<input type="radio" name="status" value="banner_code9"<? if( $row->status == "banner_code9" ) { echo("checked");}?>> banner_code9 <br>
						<input type="radio" name="status" value="0"<? if( $row->status == "0" ) { echo("checked");}?>> 미사용<br>
						<br>
						베너의 위치는 include/베너명.inc.php 파일을 직접 이동하여 위치를 선정하실수 있습니다.
					</td>
				</tr>
				<tr>
					<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>
						배너명
					</td>
					<td class='tabletd_all tabletd_small'>
						<input name="title" type="text" class="formText" class="formText"> (간단한 설명)
					</td>
				</tr>
				<tr id="banner_view" style="display:none;">
					<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>
						배너 링크URL
					</td>
					<td class='tabletd_all tabletd_small'>
						HTTP://<input name="link_url" type="text" class="formText formText_subject">
					</td>
				</tr>
				<tr id="banner_view" style="display:none;">
					<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>
						링크URL 타겟
					</td>
					<td class='tabletd_all tabletd_small'>
						<input type="radio" name="target" value="0" checked> 새창 <input type="radio" name="target" value="1"> 현재창
					</td>
				</tr>
				<tr id="banner_view" style="display:none;">
					<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>
						배너이미지파일
					</td>
					<td class='tabletd_all tabletd_small'>
						<input name="banner_images" type="file" class="formText"">
					</td>
				</tr>
				<tr id="banner_view" style="display:none;">
					<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>
						배너 출력 내용
					</td>
					<td class='tabletd_all tabletd_small'>
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
				<tr id="banner_view" style="display:none;">
					<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>
						배너크기
					</td>
					<td class='tabletd_all tabletd_small'>
						<input name="img_width" type="text" class="formText" size="3">가로 <input name="img_height" type="text" class="formText" size="3">세로
					</td>
				</tr>
				<tr align="center">
					<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all' colspan="2">
						<img src="../images/arrow2.gif" width="7" height="7"> 등록하신 배너는 스킨에 따라 사용자화면에 다르게 출력되는 경우도 있습니다.
					</td>
				</tr>
				</form>
			</table>
			<br> 
			<table width="100%" class="menu">
				<tr>
					<td height="50" align="center"><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
				</tr>
			</table>
		</td>
		</td>
	</tr>
	</form>
</table>
<script language="JavaScript">
	<!--
	var form=document.banner_form;
	if( form.type[0].checked ) {
		document.all.banner_view[0].style.display="none";
		document.all.banner_view[1].style.display="none";
		document.all.banner_view[2].style.display="none";
		document.all.banner_view[3].style.display="";
		document.all.banner_view[4].style.display="none";
	} else if( form.type[1].checked ) {
		document.all.banner_view[0].style.display="";
		document.all.banner_view[1].style.display="";
		document.all.banner_view[2].style.display="";
		document.all.banner_view[3].style.display="none";
		document.all.banner_view[4].style.display="";
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


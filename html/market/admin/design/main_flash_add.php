<? include('../header.php');?>

<script language="javascript">
	<!--
	function sendit() {
		var form=document.banner_form;
		form.content.value = myeditor.outputBodyHTML();
		if(form.subject.value=="") {
			alert("이벤트 명을 입력해 주세요.");
			form.subject.focus();
		} else {
			form.submit();
		}
	}

	function urlchoice(value){
		if(value=="none"){
			alert("하위 메뉴가 있을 경우 선택이 불가능합니다.");
			document.banner_form.urlselect.value="";
		}else{
			document.banner_form.url.value = value;
		}
	}

	function txt_type(){
		var form=document.banner_form;
		if( form.txttype[0].checked ) {
			document.getElementById('txt2').style.display="none"; 
			document.getElementById('txt3').style.display="none"; 
			document.getElementById('img1').style.display=""; 
		} else if( form.txttype[1].checked ) {
			document.getElementById('txt2').style.display=""; 
			document.getElementById('txt3').style.display=""; 
			document.getElementById('img1').style.display="none"; 
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
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">이벤트 등록
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
									<tr>
										<td height="70" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
											<table width="100%">
											<tr>
												<td>
													<table width="100%">
													<tr>
														<td height="25">
															<table>
															<tr>
																<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">이벤트 등록</td>
															</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="20">
															<!--도움말-->
																	<table width="100%">
																		<tr>
																			<td bgcolor="#E9F2F8" class='tipbox'>
																				<img src="../img/tip_icon.gif" width="28" height="11"><br><p class='noneoolim'><img src="../images/rotation_help_title.jpg"></p>메인페이지(첫화면)의 큰 로테이터 이미지영역에 노출되는 이미지관리페이지 입니다.<BR>로테이트베너 관리에서는 이미지 파일만 활용가능합니다.(jpg, png, gif등)<br>베너등록갯수 : 제한을 두지는 않으나 메인노출은 최대5개 까지설정하시기 바랍니다.<BR><BR><font color='blue'>※로테이트베너는 배너문장 3개, 배너링크 버튼, 배너이미지 총2가지 항목이 출력됩니다.<br>링크입력을 하시면 버튼은 자동으로 활성화 되게 됩니다.<br>리스트이미지는 이벤트 목록에서 노출됩니다.</font><br><br><font color='red'>※배경이미지의 권장 크기는 1920픽셀x900픽셀이나(이미지포함) 메인에서 실제 출력되는 부분은 100%정확하게 출력이 안될수 있습니다(아래위,좌우사진이 짤려나옴) 이 부분은 비율이 사진원본과 배너간에 비율이 맞지않아 그럴수 있습니다. 참고하시기 바랍니다.</font>
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
											<form action="main_flash_add_ok.php" method="post" name="banner_form" enctype="multipart/form-data">
											<tr bgColor="white">
												<td width="25%" height="25" align="center" height="35" bgcolor="#F0E8E8" class='contenM tabletd_all'>
													메인 텍스트문구 형태
												</td>
												<td height="35" class='sensP tabletd_all'>
													<input type="radio" name="txttype" value="1" onclick="txt_type()"> 이미지  <input type="radio" name="txttype" value="2" onclick="txt_type()"> 텍스트<br>
													<font style='color:#5286D9'>※로테이트 베너 속에 출력되는 광고문장 설정입니다.<br></font>
													<font style='color:#7BA7EF'>1.이미지 : 광고문장을 포토샵에서 작업한 이미지(text)로 출력합니다.<br>
													2.텍스트 : 광고문장을 아래에서 입력한 텍스트로 출력합니다.</font>
												</td>
											</tr>
											<tr bgColor="white">
												<td width="15%" height="25" align="center" bgcolor="#F0E8E8" class='contenM tabletd_all'>
													제목 및<br>첫번째 텍스트문구
												</td>
												<td class='tabletd_all sensP'>
													<input name="subject" type="text" class="formText formText_subject"> (간단한 설명)
													<br>
													<input name="title_color" id="title_color" type="text" class="formText" size="10" class="formText">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=title_color" data-modal-title="색상코드">색상코드</a>
												</td>
											</tr>
											<tr bgColor="white" id="txt2" style="display:none">
												<td width="25%" height="25" align="center" height="35" bgcolor="#F0E8E8" class='contenM tabletd_all'>
													두번재 텍스트문구
												</td>
												<td height="35" class='sensP tabletd_all'>
													<input name="title2" type="text" class="formText formText_subject" >&nbsp;<br>
													<input name="title2_color" id="title2_color" type="text" class="formText" size="10" class="formText">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=title2_color" data-modal-title="색상코드">색상코드</a>
												</td>
											</tr>
											<tr bgColor="white" id="txt3" style="display:none">
												<td width="25%" height="25" align="center" height="35" bgcolor="#F0E8E8" class='contenM tabletd_all'>
													세번재 텍스트문구
												</td>
												<td height="35" class='sensP tabletd_all'>
													<input name="title3" type="text" class="formText formText_subject">&nbsp;<br>
													<input name="title3_color" id="title3_color" type="text" class="formText" size="10" class="formText">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=title3_color" data-modal-title="색상코드">색상코드</a>
												</td>
											</tr>
											<tr bgColor="white" id="img1" style="display:none">
												<td width="25%" height="25" align="center" height="35" bgcolor="#F0E8E8" class='contenM tabletd_all'>
													<font color='#E84C4B'>텍스트 문구 이미지 등록</font>
												</td>
												<td height="35" class='sensP tabletd_all'>
													<input name="txtimg" type="file" class="file_text" size="60"> 
												</td>
											</tr>
											<tr bgColor="white">
												<td width="15%" height="25" align="center" bgcolor="EDFEFF" class='contenM tabletd_all'>
													메인노출여부
												</td>
												<td class='tabletd_all sensP'>
													<input name="main" type="checkbox" value="1"> 선택하실 경우 메인에 노출됩니다. 그외 항목은 목록에서 링크가 가능합니다.
												</td>
											</tr>
											<tr bgColor="white">
												<td width="25%" height="25" align="center" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>
													버튼설정 [버튼명]
												</td>
												<td height="35" class='sensP tabletd_all'>
													<input name="linktitle" type="text" class="formText" placeholder="예) 바로가기">
												</td>
											</tr>
											<tr bgColor="white">
												<td width="25%" height="25" align="center" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>
													버튼설정 [URL]
												</td>
												<td height="35" class='sensP tabletd_all'>
													<input name="url" type="text" class="formText">
													<select size="1" name="urlselect" onclick="urlchoice(this.value)" class='formSelect'>
														<option value="">메뉴 선택</option>
														<option value="event_view.php?idx=">이벤트상세보기</option>
														<option value="" disabled>홈메뉴 선택</option>
														<?
														$navresult	= $db->select("cs_navigation", "where open=1 order by ranking asc" );
														while( $navrow = mysqli_fetch_object($navresult)) {
															if($navrow->tablename){
																if($navrow->tablename=="cs_page"){
																	if($db->cnt("cs_page", "order by idx desc" )){
																		$result1	= $db->select("cs_page", "order by idx desc" );
																		while( $navrow1 = mysqli_fetch_object($result1)) {
																		?>
																		<option value="pageview.php?url=<?=$navrow1->page_index;?>">&nbsp;&nbsp;&nbsp;└--<?=$navrow1->title?></option>
																		<?}?>
																	<?}?>
																<?}else if($navrow->tablename=="cs_bbs"){?>
																	<option value="customer.php">고객센터</option>
																<?
																	$result1	= $db->select("cs_bbs", "order by code asc" );
																	while( $navrow1 = mysqli_fetch_object($result1)) {
																	?>
																		<option value="bbs_list.php?code=<?=$navrow1->code;?>">&nbsp;&nbsp;&nbsp;└--<?=$navrow1->name?></option>
																	<?}?>
																<?}else if($navrow->tablename=="cs_part_fixed"){?>
																	<option value="product_list.php">쇼핑하기</option>
																	<?
																	$result1	= $db->select("cs_part_fixed", "where part_display_check=1 and part_index=1 order by idx asc" );
																	while( $navrow1 = mysqli_fetch_object($result1)) {
																		$lowcnt = "";
																		if($navrow1->part_index==1){
																			$lowcnt = $db->cnt("cs_part_fixed", "where part_index=2 and part1_code=$navrow1->idx");
																		}
																		?>
																		<option value="<?=$navrow1->urllink?>">&nbsp;&nbsp;&nbsp;└--<?=$navrow1->part_name?></option>
																		<?
																		if($lowcnt){
																		?>
																				<?
																				$result2	= $db->select("cs_part_fixed", "where part_display_check=1 and part_index=2 and part1_code=$navrow1->idx order by idx asc" );
																				while( $navrow2 = mysqli_fetch_object($result2)) {
																				?>
																					<option value="<?=$navrow2->urllink?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└--<?=$navrow2->part_name?></option>
																				<?}?>
																		<?}?>
																	<?}?>
																<?}?>
															<?}else{?>
															<option value="<?=$navrow->url?>"><?=$navrow->title?></option>
															<?}?>
														<?}?>
													</select>

													<br><font color='red'>※외부(새창)링크시 http://를 포함한 절대경로값을 입력함.</font> <br>입력하지 않을 경우 별도 링크는 활성화 되지 않습니다. 이벤트상세페이지 설정시 현재 등록되는 상세내용으로 이동됩니다.
												</td>
											</tr>
											<tr bgColor="white">
												<td width="25%" height="25" align="center" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>
													버튼설정 [URL 타겟]
												</td>
												<td height="35" class='sensP tabletd_all'>
													<input type="radio" name="target" value="0"> 새창 <input type="radio" name="target" value="1" checked> 현재창
												</td>
											</tr>
											<tr bgColor="white">
												<td width="25%" height="25" align="center" height="35" bgcolor="#EBF1D9" class='contenM tabletd_all'>
													<font color='#E84C4B'>액센트 이미지</font>
												</td>
												<td height="35" class='sensP tabletd_all'>
													<input name="main_img" type="file" class="file_text" size="60"> <br><br>가로 1000픽셀이하 세로 700픽셀 이하로 등록하시기 바랍니다.<br>
													배경위에 애니메이션 효과로 나타나는 이미지로써 배경이 투명하게 처리해야만 합니다.(PNG 포맷으로 등록하시기 바랍니다.)
												</td>
											</tr>
											<tr bgColor="white">
												<td width="25%" height="25" align="center" height="35" bgcolor="#EBF1D9" class='contenM tabletd_all'>
													<font color='#E84C4B'>배경 이미지</font>
												</td>
												<td height="35" class='sensP tabletd_all'>
													<input name="bgimg" type="file" class="file_text" size="60"> <br><br>가로 1920픽셀 세로 1200픽셀 권장.<br>
													배경이 되는 이미지입니다.
												</td>
											</tr>
											<tr bgColor="white">
												<td width="15%" height="25" align="center" bgcolor="#EBF1D9" class='contenM tabletd_all'>
													리스트용 작은이미지
												</td>
												<td class='tabletd_all sensP'>
													<input name="list_img" type="file" class="file_text">
													<br>이벤트페이지의  리스트화면에 노출되는 이미지입니다. 사이즈는 483x153픽셀 사이즈가 가장 깔끔하게 노출이 됩니다.<br><font color='EF5858'>※이미지를 등록하지 않을시에는 위에서 등록한 <font color='5394EC'>이벤트 명</font>이 노출됩니다.</font>
												</td>
											</tr>
											<tr bgColor="white">
												<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>
													이벤트내용입력
												</td>
												<td class='tabletd_all sensP'>
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
											<tr align="center">
												<td height="25" align="center" bgcolor="E4E7EF" colspan="2" class='contenM tabletd_all'>등록하신 이벤트는 스킨에 따라 사용자화면에 다르게 출력되는 경우도 있습니다.</td>
											</tr>
											</form>
											</table>
											<br>
											<table width="100%" class="menu">
											<tr>
												<td height="50" align="center"><a href="javascript:sendit();"" class='oolimbtn-botton1'>등록</a></td>
											</tr>
											</table>
										</td>
									</tr>
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

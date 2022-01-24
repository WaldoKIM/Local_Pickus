<?
include('../header.php');
$design_stat = $db->object("cs_design", "");
?>

<script language="JavaScript">
<!--
// 사용자 화면 출력
function displaySendit() {
	var form=document.display_form;
	form.submit();
}

// 아이콘 파일 업로드
function bgcheck() {
	var form=document.display_form;
	if(form.footerbg[0].checked==true){
		document.getElementById('color').style.display="";
		document.getElementById('img').style.display="none";
	}else{
		document.getElementById('color').style.display="none";
		document.getElementById('img').style.display="";
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
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">하단 카피라이터 배경설정
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
									<form action="footerbg_ok.php" method="post" name="display_form" enctype="multipart/form-data">
									<tr> 
										<td align="center" valign="top" bgcolor="#FFFFFF" class="menu">
											
												<table width="100%">
													<tr>
														<td>
															<table width="100%">
																<tr>
																<td>
																	<table width="100%">
																		<tr>
																			<td height="25">
																			<table>
																				<tr>
																					<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" style='vertical-align:-5%'>카피라이터 배경설정</td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		<tr>
																			<td height="20" class='noneoolim'>
																			<!--도움말-->
																				<table width="100%">
																					<tr>
																						<td bgcolor="#E9F2F8" class='tipbox'>
																							<img src="../img/tip_icon.gif" width="28" height="11"><br>
																							<font color='#FC6E51'>하단카피라이터 부분에 배경을 색상코드나 배경이미지로 변경하실수 있습니다.</font><br>
																							- 배경색상 : 단색으로 색상코드표를 참고하셔서 등록해 주시기 바랍니다.<br>
																							- 배경이미지 : 배경등록시 패턴으로써 반복해서 적용됩니다.<br>

																							<font color='#FC6E51'><b>주의 - 색상 및 이미지로 배경을 변경하실 경우에는 노출되는 텍스트가 잘 보일수 있도록 배색을 선택하시기 바랍니다.</b></font><br>
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
														</td>
													</tr>
													<tr>
														<td>
															<table width="100%" class="table_all">
																<tr>
																	<td width="15%" height="30" bgcolor="E4E7EF" class='contenM tabletd_all'>배경형태</td>
																	<td class='tabletd_all tabletd_small'><input name="footerbg" type="radio" value="1" <?if($design_stat->footerbg==1){?>checked<?}?> onclick="bgcheck()">배경색상&nbsp;<input name="footerbg" type="radio" value="2" <?if($design_stat->footerbg==2){?>checked<?}?> onclick="bgcheck()">배경이미지</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height='30'></td>
													</tr>
													<tr style="display:<?if($design_stat->footerbg==2){?>none<?}?>" id="color">
														<td>
															<table width="100%" class="table_all">
																<tr>
																	<td width="15%" bgcolor="E4E7EF" class='contenM tabletd_all'>배경색</td>
																	<td class='tabletd_all tabletd_small'><input name="footerbg_color" type="text" class="formText" value="<?=$design_stat->footerbg_color;?>" maxlength="6">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=footerbg_color" data-modal-title="색상코드">색상코드</a></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr style="display:<?if($design_stat->footerbg==1){?>none<?}?>" id="img">
														<td>
															<table width="100%" class="table_all">
																<tr>
																	<td width="15%" bgcolor="E4E7EF" class='contenM tabletd_all'>이미지</td>
																	<td class='tabletd_all tabletd_small'><input name="footerbg_img" type="file" class="formText" maxlength="30" size="39">
																		<?if($design_stat->footerbg_img){
																		$view_img = @getimagesize("../../data/designImages/".$design_stat->footerbg_img);
																		if(  $view_img[0] > 300 ) {$wsize = "width=300"; } else {$wsize = $view_img[0];}
																		?>
																		<br><br>&nbsp;<a href="../../data/designImages/<?=$design_stat->footerbg_img?>" rel="lightbox"><img src="../../data/designImages/<?=$design_stat->footerbg_img?>" <?=$wsize?>></a>
																		<?}?>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height='70'><a href="javascript:displaySendit();" class='oolimbtn-botton1'>등록</a></td>
													</tr>
												</table>

											</td>
									</tr>
								</form>
									
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

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
function iconSendit() {
	var form=document.icon_form;
	form.submit();
}
//-->

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
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/category_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">메뉴 디자인 관리
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
										<form action="menudesign_ok.php" method="post" name="display_form">
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
																						<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">가이드메뉴 및 상단배경 설정</td>
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
																										<td><p><img src="../images/menudesign_help01.png"></p>
																											<font color='#FC6E51'>로고가 위치한 배경색상과 우측위치의 가이드메뉴 색상을 설정합니다. 배경색상의 경우 PC모드에서 Shop by Category 의 상단 배경색상과 함께 적용됩니다.<br>
																										</td>
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
															</td>
														</tr>
														<tr>
															<td>
																<table width="100%" class="table_all">
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>가이드메뉴 배경색①</td>
																		<td class='tabletd_all tabletd_small'><input name="guide_bg_color" id="guide_bg_color" type="text" class="formText" value="<?=$design_stat->guide_bg_color;?>"> &nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=guide_bg_color" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>가이드메뉴 TEXT  기본색상②</td>
																		<td class='tabletd_all tabletd_small'><input name="guide_text_color" id="guide_text_color" type="text" class="formText" value="<?=$design_stat->guide_text_color;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=guide_text_color" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>가이드메뉴 TEXT 롤오버 색상③</td>
																		<td class='tabletd_all tabletd_small'><input name="guide_text_color_hover" id="guide_text_color_hover" type="text" class="formText" value="<?=$design_stat->guide_text_color_hover;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=guide_text_color_hover" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>Shop by Category 텍스트변경④</td>
																		<td class='tabletd_all tabletd_small'><input name="word_text" id="word_text" type="text" class="formText" value="<?=$design_stat->word_text;?>">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>Shop by Category 색상④</td>
																		<td class='tabletd_all tabletd_small'><input name="word_text_color" id="word_text_color" type="text" class="formText" value="<?=$design_stat->word_text_color;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=word_text_color" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>토글버튼 기본색상⑤</td>
																		<td class='tabletd_all tabletd_small'><input name="toggle_menu_color1" id="toggle_menu_color1" type="text" class="formText" value="<?=$design_stat->toggle_menu_color1;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=toggle_menu_color1" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>토글버튼 룰오버색상⑥</td>
																		<td class='tabletd_all tabletd_small'><input name="toggle_menu_color2" id="toggle_menu_color2" type="text" class="formText" value="<?=$design_stat->toggle_menu_color2;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=toggle_menu_color2" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>토글버튼 3줄 아이콘색상⑦</td>
																		<td class='tabletd_all tabletd_small'><input name="toggle_menu_color3" id="toggle_menu_color3" type="text" class="formText" value="<?=$design_stat->toggle_menu_color3;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=toggle_menu_color3" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>모바일토글버튼 닫기 배경색상⑧</td>
																		<td class='tabletd_all tabletd_small'><input name="toggle_mmenu_color1" id="toggle_mmenu_color1" type="text" class="formText" value="<?=$design_stat->toggle_mmenu_color1;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=toggle_mmenu_color1" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>모바일토글버튼 닫기 아이콘색상⑨</td>
																		<td class='tabletd_all tabletd_small'><input name="toggle_mmenu_color2" id="toggle_mmenu_color2" type="text" class="formText" value="<?=$design_stat->toggle_mmenu_color2;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=toggle_mmenu_color2" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>검색폼 배경⑩</td>
																		<td class='tabletd_all tabletd_small'><input name="search_bg_color" id="search_bg_color" type="text" class="formText" value="<?=$design_stat->search_bg_color;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=search_bg_color" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																</table>
															</td>
														</tr>
														<tr>
															<td height='70'><a href="javascript:displaySendit();" class='oolimbtn-botton1'>등록</a></td>
														</tr>
													</table>

													<br>
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
																						<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">주메뉴 디자인</td>
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
																										<td><p><img src="../images/menudesign_help02.png"></p>
																											<font color='#FC6E51'>주메뉴에 CSS기반의 그라데이션 효과로 디자인이 되어 있습니다. 그라데이션 효과의 좌측에서 우측으로의 색상을 관리하실수 잇습니다.</font><br>
																											- 메뉴 배경색 설정 #1 : 주메뉴 배경 그라데이션효과에서 좌측색상 코드<br>
																											- 메뉴 배경색 설정 #2 : 주메뉴 배경 그라데이션효과에서 우측측색상 코드<br>※배경색을 각각 다르게 설정하면 그라데이션 효과를 냅니다. 그라데이션효과를 내지 않을때는 #1,#2에 같은 색상코드를 입력하시면 됩니다.<br><br><br>

																											<font color='#FC6E51'>주메뉴의 기본 색상 과 마우스 롤오버시 메뉴 색상을 설정합니다.</font><br>
																											- 주메뉴 TEXT 기본색상 : 주메뉴 기본색상 코드<br>
																											- 주메뉴 TEXT 롤오버 색상 : 주메뉴 롤오버 색상 코드<br><br>
																											
																											<font color='#FC6E51'>메뉴간 간격 설정 (메뉴와 메뉴사이의 좌측 우측 여백을 조절하여 메뉴사이의 간격을 조절합니다.)</font><br>
																											- 주메뉴 좌측간격 : 주메뉴 좌측 간격(padding-left)<br>
																											- 주메뉴 우측간격 : 주메뉴 우측 간격(padding-right)<br>
																										</td>
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
															</td>
														</tr>
														<tr>
															<td>
																<table width="100%" class="table_all">
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>주메뉴 배경색 설정 #1</td>
																		<td class='tabletd_all tabletd_small'><input name="menu_bg_color1" type="text" class="formText" value="<?=$design_stat->menu_bg_color1;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=menu_bg_color1" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>주메뉴 배경색 설정 #2</td>
																		<td class='tabletd_all tabletd_small'><input name="menu_bg_color2" type="text" class="formText" value="<?=$design_stat->menu_bg_color2;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=menu_bg_color2" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>주메뉴 TEXT 기본색상</td>
																		<td class='tabletd_all tabletd_small'><input name="menu_text_color" type="text" class="formText" value="<?=$design_stat->menu_text_color;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=menu_text_color" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>주메뉴 TEXT 롤오버 색상</td>
																		<td class='tabletd_all tabletd_small'><input name="menu_text_color_hover" type="text" class="formText" value="<?=$design_stat->menu_text_color_hover;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=menu_text_color_hover" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>주메뉴 좌측간격</td>
																		<td class='tabletd_all tabletd_small'><input name="menu_padding_left" type="text" class="formText" value="<?=$design_stat->menu_padding_left;?>"  onKeyPress='if( (event.keyCode<48) || (event.keyCode>57) ){ if(event.preventDefault){ event.preventDefault(); } else { event.returnValue = false; }}'></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>주메뉴 우측간격</td>
																		<td class='tabletd_all tabletd_small'><input name="menu_padding_right" type="text" class="formText" value="<?=$design_stat->menu_padding_right;?>" onKeyPress='if( (event.keyCode<48) || (event.keyCode>57) ){ if(event.preventDefault){ event.preventDefault(); } else { event.returnValue = false; }}'></td>
																	</tr>
																</table>
															</td>
														</tr>
														<tr>
															<td height='70'><a href="javascript:displaySendit();" class='oolimbtn-botton1'>등록</a></td>
														</tr>
													</table>

													<br>

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
																						<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">서브메뉴 설정</td>
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
																										<td><p><img src="../images/menudesign_help03.png"></p>
																											<font color='#FC6E51'>서브메뉴 레이어 배경과 테두리색상을 관리 합니다.</font><br>
																											배경색 : 서브메뉴 레이어 배경 색상 코드<br>
																											서브메뉴 배경 테두리 : 서브메뉴 테두리 색상 코드<br><br>
																											
																											<font color='#FC6E51'>서브메뉴 기본 색상 과 마우스 롤오버시 메뉴 색상을 설정합니다.</font><br>
																											서브메뉴 TEXT 기본색상 : 서브메뉴 기본색상 코드<br>
																											서브메뉴 TEXT 롤오버 색상 : 서브메뉴 롤오버 색상 코드<br>
																										</td>
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
															</td>
														</tr>
														<tr>
															<td>
																<table width="100%" class="table_all">
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>서브메뉴 배경색</td>
																		<td class='tabletd_all tabletd_small'><input name="submenu_bg_color" id="submenu_bg_color" type="text" class="formText" value="<?=$design_stat->submenu_bg_color;?>"> &nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=submenu_bg_color" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>서브메뉴 롤오버배경</td>
																		<td class='tabletd_all tabletd_small'><input name="submenu_over_color" id="submenu_over_color" type="text" class="formText" value="<?=$design_stat->submenu_over_color;?>"> &nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=submenu_over_color" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>서브메뉴 배경 테두리</td>
																		<td class='tabletd_all tabletd_small'><input name="submenu_line_color" id="submenu_line_color" type="text" class="formText" value="<?=$design_stat->submenu_line_color;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=submenu_line_color" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>서브메뉴 TEXT  기본색상</td>
																		<td class='tabletd_all tabletd_small'><input name="submenu_text_color" id="submenu_text_color" type="text" class="formText" value="<?=$design_stat->submenu_text_color;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=submenu_text_color" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																	<tr>
																		<td width="20%" bgcolor="E4E7EF" class='contenM tabletd_all'>서브메뉴 TEXT 롤오버 색상</td>
																		<td class='tabletd_all tabletd_small'><input name="submenu_text_color_hover" id="submenu_text_color_hover" type="text" class="formText" value="<?=$design_stat->submenu_text_color_hover;?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=submenu_text_color_hover" data-modal-title="색상코드">색상코드</a></td>
																	</tr>
																</table>
															</td>
														</tr>
														<tr>
															<td height='70'><a href="javascript:displaySendit();" class='oolimbtn-botton1'>등록</a></td>
														</tr>
													</table>

													<br>


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

													<br>
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

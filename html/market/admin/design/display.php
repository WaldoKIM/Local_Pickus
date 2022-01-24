<?
include('../header.php');
$design_stat = $db->object("cs_design", "");
?>

<script language="JavaScript">
<!--
// 사용자 화면 출력
function displaySendit() {
	var form=document.display_form;
	if(form.title_bar.value=="") {
		alert('윈도우 타이틀 바 이름을 적어주세요');
		form.title_bar.focus();
	} else if(form.status_bar.value=="") {
		alert('윈도우 상태바 이름을 적어주세요');
		form.status_bar.focus();
	} else {
		form.submit();
	}
}

// 아이콘 파일 업로드
function iconSendit() {
	var form=document.icon_form;
	form.submit();
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
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">웹브라우저 타이틀 관리
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
									<form action="display_ok.php" method="post" name="display_form">
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
																					<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">웹브라우저 타이틀 관리</td>
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
																									<td>title, Keyword, description는 게시판이나 상품소개 페이지 외에 노출할 메타태그정보입니다. 검색엔진최적화에 이용되고 있으니 적절한 키워드를 이용하여 등록하시기 바랍니다.</td>
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
																	<td width="15%" bgcolor="E4E7EF" class='contenM tabletd_all'>title</td>
																	<td class='tabletd_all tabletd_small'><input name="title_bar" type="text" class="formText formText_subject" value="<?=$design_stat->title_bar;?>"></td>
																</tr>
																<tr>
																	<td width="15%" bgcolor="E4E7EF" class='contenM tabletd_all'>Keyword</td>
																	<td class='tabletd_all tabletd_small'><input name="status_bar" type="text" class="formText formText_subject" value="<?=$design_stat->status_bar;?>"></td>
																</tr>
																<tr>
																	<td width="15%" bgcolor="E4E7EF" class='contenM tabletd_all'>description</td>
																	<td class='tabletd_all tabletd_small'>
																		
																		<div id="comment">
																		<fieldset>
																			<table>
																				<colgroup><col width="*" /><col width="131" /></colgroup>
																				<tbody>
																					<tr>
																						<td><div class="box" style='height:300px'><textarea name="meta_title" style='height:300px'><?=$design_stat->meta_title;?></textarea></div></td>
																					</tr>
																				</tbody>
																			</table>
																		</fieldset>
																		</div>

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
					</table>
				</td>
			</tr>
		</table>
	</article>
	
</div>



<? include('../footer.php'); ?>


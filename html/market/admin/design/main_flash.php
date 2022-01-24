<? include('../header.php');
$info = $db->object("cs_design", "");

?>
<script language="JavaScript">
	<!--
	// 수정
	function bannerEdit( idx ) {
		var choose = confirm( '수정 하시겠습니까?');
		if(choose) {	location.href='main_flash_edit.php?idx='+idx; }
		else { return; }
	}
	
	// 삭제
	function bannerDel( idx ) {
		var choose = confirm( '삭제 하시겠습니까?');
		if(choose) {	location.href='main_flash_del_ok.php?idx='+idx; }
		else { return; }
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
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">이벤트 관리
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
									<table width="100%">
										<tr>
											<td>
												<table width="100%">
													<tr>
														<td>
															<table width="100%">
																<tr>
																	<td height='30'></td>
																</tr>
																<tr>
																	<td>
																		<table>
																			<tr>
																				<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">이벤트 등록및 관리</font></p></td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td>
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
											</td>
										</tr>
										<tr>
											<td height="45" align='right'><a href="main_flash_add.php" class='oolimbtn-botton1'>등록</a></td>
										</tr>
									</table>
									<table width="100%" class="table_all">
										<tr>
											<td height='35' bgcolor="#E4E7EF" class='contenM tabletd_all'>이벤트명</td>
											<td bgcolor="#E4E7EF" class='contenM tabletd_all'>페이지 INDEX</td>
											<td bgcolor="#E4E7EF" class='contenM tabletd_all noneoolim'>이벤트URL</td>
											<td bgcolor="#E4E7EF" width="120" class='contenM tabletd_all'>관리</td>
										</tr>
										<?
											$list_check = $totalCnt	= $db->cnt("cs_main_flash", "" );
											$result	= $db->select( "cs_main_flash", "order by idx desc" );
											while( $row = mysqli_fetch_object($result)) {
											?>
										<tr bgcolor="white">
											<td height="25" class='tabletd_all tabletd_Lmall'>
												<?=$row->subject;?><?if($row->main==1){?><span class='menusmall_btn1'>ON</span><?}else{?> <span class='menusmall_btn4'>OFF</span><?}?>
											</td>
											<td height="25" class='tabletd_all tabletd_Lmall'>
												event_view.php?idx=<?=$row->idx;?>
											</td>
											<td width="120" height="25" class='tabletd_all tabletd_Lmall noneoolim'>
												<?=$row->url?>
											</td>
											<td width="100" height="25" class='tabletd_all tabletd_Lmall'>
												<a href="javascript:bannerEdit(<?=$row->idx;?>)" class="menusmall_btn3">수정</a></a><a href="javascript:bannerDel(<?=$row->idx;?>)" class="menusmall_btn4">삭제</a>
											</td>
										</tr>
										<?
											$totalCnt--;
										}
										?>
										
										<? if( !$list_check ) {?>
										<tr align="center">
											<td height="100" colspan="7" class='tabletd_all tabletd_Lmall'>
												등록된 이벤트 목록이 없습니다.
											</td>
										</tr>
										<?}?>
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


<? include('../header.php');?>

<script language="JavaScript">
<!--
// 카테고리 수정
function popupEdit( idx ) {
    var choose = confirm( '수정 하시겠습니까?');
	if(choose) {	location.href='popup_edit.php?idx='+idx; }
	else { return; }
}

// 카테고리 삭제
function popupDel( idx ) {
    var choose = confirm( '삭제 하시겠습니까?');
	if(choose) {	location.href='popup_del_ok.php?idx='+idx; }
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
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">팝업창관리
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
											<td valign="top" bgcolor="#FFFFFF" class="menu">
												<table width="100%">
													<tr>
													<td>
														<table width="100%">
															<tr>
																<td height="25">
																<table>
																	<tr>
																		<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">팝업창관리</td>
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
																							<td><p>형태 선택 : HTML태그를 이용하는 방법과 단일 이미지를 선택합니다.<br>시작일/종료일 
																							: 시작일(기본값-현재일)과 종료일을 선택합니다.<br>팝업창 사이즈 : 팝업창의 
																							가로 세로 사이즈를 입력합니다. 단일 이미지일경우 이미지사이즈에 맞추세요.<br>브라우져 
																							타이틀바 : 팝업창 타이틀에 출력될 타이틀내용을 입력합니다.<br>쿠키설정 
																							: 조건에 맞는 항목을 선택하세요.<br>링크URL : 단일이미지일경우 클릭 시 
																							이동할 URL주소를 입력합니다.<br>출력내용(HTML) : HTML로 출력할 내용을 
																							입력합니다.</p></td>
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
												<table width="100%">
													<tr> 
														<td height="65" align="right"><a href="popup_add.php" class='oolimbtn-botton1'>팝업창 신규생성</a></td>
													</tr>
												</table>
												<table width="100%" class="table_all">
													<tr bgcolor="E4E7EF"> 
														<td width="5%" height="35" class='contenM tabletd_all noneoolim'>No</td>
														<td height="25" class='contenM tabletd_all noneoolim'>출력 형태</td>
														<td height="25" class='contenM tabletd_all'>브라우져 타이틀바</td>
														<td height="25" class='contenM tabletd_all noneoolim'>시작일</td>
														<td height="25" class='contenM tabletd_all noneoolim'>종료일</td>
														<td height="25" class='contenM tabletd_all'>팝업상태</td>
														<td height="25" class='contenM tabletd_all'>모바일</td>
														<td width="20%" height="25" class='contenM tabletd_all'>관리</td>
													</tr>
													<?
													$table = "cs_popup";
													$list_check = $totalCnt	= $db->cnt( $table, "" );
													$result	= $db->select( $table, "order by idx desc" );
													while( $row = mysqli_fetch_object($result)) {
													?>
													<tr bgColor="white"> 
														<td height="25" class='tabletd_all tabletd_Lmall noneoolim'><?=$totalCnt;?></td>
														<td height="25" class='tabletd_all tabletd_Lmall noneoolim'><? if( $row->display==0 ) { echo('HTML');} else if( $row->display==1 ) { echo('IMAGES');}?></td>
														<td height="25" class='tabletd_all tabletd_Lmall'><?=$row->title_bar;?></td>
														<td height="25" class='tabletd_all tabletd_Lmall noneoolim'><?=date("Y-m-d", $row->start_day);?></td>
														<td height="25" class='tabletd_all tabletd_Lmall noneoolim'><?=date("Y-m-d", $row->end_day);?></td>
														<td height="25" class='tabletd_all tabletd_Lmall'><? if($row->end_day < time()) { echo "종료"; } else if(($row->start_day < time()) && ($row->end_day > time())) { echo "사용중";} else if($row->start_day > time()) { echo "미사용";}?></td>
														<td height="25" class='tabletd_all tabletd_Lmall'><? if($row->popup_display==1) { echo "사용"; } else { echo "미사용";} ?></td>
														<td height="25" class='tabletd_all tabletd_Lmall'><a href="javascript:popupEdit(<?=$row->idx;?>)" class="menusmall_btn3">수정</a><a href="javascript:popupDel(<?=$row->idx;?>)" class="menusmall_btn4">삭제</a></td>
													</tr>
													<? 
														$totalCnt--;
													}
													?>
													
													<? if( !$list_check ) {?>
													<tr bgColor="white"> 
														<td height="100" colspan="7"> 등록된 팝업내역이 없습니다.</td>
													</tr>
													<?}?>
												</table><br>
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

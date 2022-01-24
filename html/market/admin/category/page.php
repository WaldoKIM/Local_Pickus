<? include('../header.php'); ?>

<script language="JavaScript">
<!--
// 카테고리 수정
function pageEdit( idx ) {
    var choose = confirm( '수정 하시겠습니까?');
	if(choose) {	location.href='page_edit.php?idx='+idx; }
	else { return; }
}

// 카테고리 삭제
function pageDel( idx ) {
    var choose = confirm( '삭제 하시겠습니까?');
	if(choose) {	location.href='page_del_ok.php?idx='+idx; }
	else { return; }
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
																							<td>
																							페이지 INDEX : 생성한 페이지의 링크경로값을 가져올 때 사용합니다.<br>(ex. 페이지 INDEX의 값이 info일때 a href=”pageview.php?url=info”)<br><br>
																							생성한 페이지는 쇼핑몰 카테고리관리 메뉴에서 상단/하단 및 미설정으로 설정이 가능합니다.<br>
																							상단 : 상품카테고리와 동일한 위치에 해당메뉴가 생성됩니다.<br>
																							하단 : 카피라이터 위쪽의 안내링크로 사용가능합니다.<br>
																							상.하단 : 상단 카테고리와 카피라이터 위쪽의 안내링크 모두 사용가능합니다.<br>
																							미설정 : 노출은 되지 않으며, 베너나 사용자코딩시 해당 URL을 이용하여 링크설정이 가능합니다.
																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>													
																		</table>
																	<!--도움말-->

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
														<td height="55"><a href="page_add.php" class='oolimbtn-botton1'>신규페이지 추가</a></td>
													</tr>
												</table>
												<table width="100%" class="table_all">
													<tr bgcolor="E4E7EF"> 
														<td width="30" height="35" align="center" class='contenM tabletd_all'>No</td>
														<td width="30" height="35" align="center" class='contenM tabletd_all'>순위</td>
														<td height="35" align="center" class='contenM tabletd_all'>페이지 INDEX</td>
														<td height="35" align="center" class='contenM tabletd_all'>페이지 타이틀</td>
														<td width="70" height="35" align="center" class='contenM tabletd_all'>작성형태</td>
														<td width="100" height="35" align="center" class='contenM tabletd_all'>관리</td>
													</tr>
													<?
													$table = "cs_page";
													$list_check = $totalCnt	= $db->cnt( $table, "" );
													$result	= $db->select( $table, "order by idx desc" );
													while( $row = mysqli_fetch_object($result)) {
														$upidx = $db->object("cs_page", "where idx > $row->idx order by idx asc limit 1", "idx");
														$downidx = $db->object("cs_page", "where idx < $row->idx order by idx desc limit 1", "idx");
													?>
													<tr <?if($row->fixed==1){?>bgColor="#EFEFEF"<?}else{?>bgColor="white"<?}?> > 
														<td height="25"  class='tabletd_all tabletd_Lmall'>
														<?=$totalCnt;?>
														</td>
														<td  class='tabletd_all tabletd_Lmall'>
															<table style='margin:0 auto'>
																<tr><td><a href="<?if($upidx->idx){?>sort.php?changeidx=<?=$upidx->idx?>&idx=<?=$row->idx?><?}else{?>javascript:alert('최상위 입니다.')<?}?>" class='searchD' title='한칸 위'><img src="../images/top_arrow.png"  border=0></a></td></tr>
																<tr><td><a href="<?if($downidx->idx){?>sort.php?changeidx=<?=$downidx->idx?>&idx=<?=$row->idx?><?}else{?>javascript:alert('최하위 입니다.')<?}?>" class='searchD' title='한칸 아래'><img src="../images/bottom_arrow.png" border=0></a></td></tr>
															</table>						
														</td>
														<td height="25" class='tabletd_all tabletd_Lmall'><?if($row->fixed==1){?>mail_to_admin.php <font color="red">[고정메뉴]</font><?}else{?>pageview.php?url=<?=$row->page_index;?><?}?></td>
														<td height="25" class='tabletd_all tabletd_Lmall'><?=$row->title;?></td>
														<td height="25" class='tabletd_all tabletd_Lmall'><? if( $row->tag==0 ) { echo('TEXT');} else if( $row->tag==1 ) { echo('HTML');}?></td>          
														<td height="25" class='tabletd_all tabletd_Lmall'><a href="javascript:pageEdit(<?=$row->idx;?>)" class="menusmall_btn3">수정</a>&nbsp;<?if($row->fixed!=1){?><a href="javascript:pageDel(<?=$row->idx;?>)" class="menusmall_btn4">삭제</a><?}?></td>
													</tr>
													<?
														$totalCnt--;
													}
													?>
													
													<? if( !$list_check ) {?>
													<tr bgColor="white"> 
														<td height="100" colspan="7" class='tabletd_all tabletd_Lmall' style='text-align:center'> 등록된 베너 목록이 없습니다.</td>
													</tr>
													<?}?>
												</table><br>
											</td>
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


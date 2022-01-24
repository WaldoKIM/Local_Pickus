<? include('../header.php');
// 정보변경

//echo $_POST[part_name2];
//exit;

if($_POST[hidden_idx]==12){
	$result1_cnt	= $db->cnt("cs_part_fixed", "where 1 order by part_ranking asc" );
	$result1	= $db->select("cs_part_fixed", "where 1 order by part_ranking asc" );
	while( $row1 = mysqli_fetch_object($result1)) {
		//$part_name = $part_display_check = "";
		//$part_name = ${"part_name".$row1->idx};
		$part_name = $_POST[part_name.$row1->idx];
		//$part_display_check = ${"part_display_check".$row1->idx};
		$part_display_check = $_POST[part_display_check.$row1->idx];		
		$db->update("cs_part_fixed", "part_name='$part_name', part_display_check='$part_display_check' where idx='$row1->idx'");		
	}
}else{
	if( $_POST[hidden_idx]) { $db->update("cs_navigation", "ranking='$_POST[ranking]', title='$_POST[title]', open='$_POST[open]', openg='$_POST[openg]', openf='$_POST[openf]', url='$_POST[url]' where idx='$_POST[hidden_idx]'");}
}
?>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/category_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">

		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">주메뉴관리
				</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#dddddd"></td>
			</tr>
			<tr>
				<td height="35" bgColor="white"></td>
			</tr>
			<tr>
				<td class="padding_5">
					<table  width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
								<table width="100%">
									<tr> 
										<td align="center" valign="top" bgcolor="#FFFFFF" class="menu">
										<table width="100%">
												<tr>
												<td>
													<table width="100%">
														<tr>
															<td height="35">
															<table>
																<tr>
																	<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">주메뉴관리</td>
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
																						<p><img src="../images/navigation_help.png" class='noneoolim'></p>
																						생성한 페이지는 쇼핑몰 카테고리관리 메뉴에서 주메뉴/가이드메뉴/하단메뉴로 설정이 가능합니다.<br>
																						주메뉴 : 상단 주메뉴 구성되며 페이지URL에 셀렉트로 하위메뉴가 있는 경우에는 2차메뉴로 구성됩니다.<br>
																						가이드메뉴 : PC형일경우 우측상단, 모바일환경일 경우 로고아래에 위치하는 메뉴를 구성하실수 있습니다.<br>
																						하단메뉴 : 카피라이터 위쪽의 안내링크로 사용가능합니다. HTML페이지관리의 경우는 주메뉴는 2차메뉴로 구성되지만, 하단메뉴 에서는 하위메뉴없이 진열됩니다.<br>
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
											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF"> 
													<td width="30" height="35" align="center" class='contenM tabletd_all'>순위</td>
													<td width="30%" height="35" align="center" class='contenM tabletd_all'>페이지명</td>
													<td height="35" align="center" class='contenM tabletd_all'>페이지 URL</td>
													<td width="8%" height="35" align="center" class='contenM tabletd_all noneoolim'>주메뉴</td>
													<td width="8%" height="35" align="center" class='contenM tabletd_all noneoolim'>가이드메뉴</td>
													<td width="8%" height="35" align="center" class='contenM tabletd_all noneoolim'>하단메뉴</td>
													<td width="10%" height="35" align="center" class='contenM tabletd_all'>관리</td>
												</tr>
											<script language="javascript">
											<!--
											function sendit(form_data) {
												if(form_data.ranking.value==""){
													alert('순위를 설정해 주세요.');
													form_data.ranking.focus();
												}else if(form_data.title.value==""){
													alert('제목을 입력해 주세요.');
													form_data.title.focus();
												}else{
													form_data.submit();
												}
											}
											//-->
											</script>



												<?
												$table = "cs_navigation";
												$list_check = $totalCnt	= $db->cnt( $table, "" );
												$result	= $db->select( $table, "order by ranking asc" );
												while( $row = mysqli_fetch_object($result)) {
													$upidx = $db->object("cs_navigation", "where ranking > $row->ranking order by ranking asc limit 1", "ranking");
													$downidx = $db->object("cs_navigation", "where ranking < $row->ranking order by ranking desc limit 1", "ranking");
													$form_name++; // 폼네임변경 숫자증가
												?>
												<form name="form_<?=$form_name?>" method="POST" action="<?=$_SERVER[PHP_SELF];?>">
												<input type="hidden" name="hidden_idx" value="<?=$row->idx;?>">
												<tr> 
													<td  class='tabletd_all tabletd_Lmall'>
														<input type="text" name="ranking" value="<?=$row->ranking;?>" size="3" class="formText" <?if($row->idx==1){?>disabled<?}?>>
													</td>
													<td style='height:35px; text-align:left' class='tabletd_all tabletd_Lmall'>
														<?if($row->tablename=="cs_part_fixed"){
														$result1_cnt	= $db->cnt("cs_part_fixed", "where 1 order by part_ranking asc" );
														$result1	= $db->select("cs_part_fixed", "where 1 order by part_ranking asc" );
														while( $row1 = mysqli_fetch_object($result1)) {
															$J++;
														?>
														 <input type="text" value="<?=$row1->part_name?>" name="part_name<?=$row1->idx?>" class="formText textDomin">
														 <?if($row->idx!=1){?>
														<?if($row->onoff==1 || $row->onoff==3 || $row->onoff==5 || $row->onoff==7){?><input type="checkbox" name="part_display_check<?=$row1->idx?>" value="1" <?if($row1->part_display_check==1){?>checked<?}?>>노출<?}}?>
														 <br>
														 <?if($J==1){?><hr><?}?>
														<?}
														}else{
														?>
														<input type="text" name="title" value="<?=$row->title;?>" class="formText textDomin"  <?if($row->idx==1){?>disabled<?}?>>
														<?}?>
													 <a href="#" class='modal searchC noneoolim' data-modal-height="500" data-modal-width="600" data-modal-iframe="bgimg.php?idx=<?=$row->idx?>" data-modal-title="배경관리">배경관리</a>
													</td>
													<td height="35" class='tabletd_all tabletd_Lmall '>
													<?if($row->idx!=1){?><p style='text-align:left;'><span class="noneoolim"><?if($row->tablename=="cs_part_fixed"){?>이벤트상품목록 : 노출하지 않을 경우 모든 이벤트상품 목록이 노출되지 않게 되며,<br>상세한 설정이 필요하실 경우 아래의 관리 버튼을 이용하여 스패셜카테고리목록으로 이동하셔서 설정하실수 있습니다.<br><?}else{?>페이지 URL :<?}?> </span><?if($row->tablename){?>
															<?
															if($row->tablename=="cs_page"){
															echo "<select name='url'>";
																$result1	= $db->select("cs_page", "order by idx desc" );
																while( $row1 = mysqli_fetch_object($result1)) {
																?>
																<option value="pageview.php?url=<?=$row1->page_index;?>" <? if( $row->url == "pageview.php?url=".$row1->page_index ) { echo("selected");} ?>><?=$row1->title?></option>
																<?}
															echo "</select>";
															}else if($row->tablename=="cs_bbs"){?>
															<select name='url'>
																<option value="customer.php" <? if( $row->url == "customer.php" ) { echo("selected");} ?>>고객센터</option>
																<?

																$result1	= $db->select("cs_bbs", "order by code asc" );
																while( $row1 = mysqli_fetch_object($result1)) {
																?>
																<option value="bbs_list.php?code=<?=$row1->code;?>" <? if( $row->url == "bbs_list.php?code=".$row1->code ) { echo("selected");} ?>><?=$row1->name?></option>
																<?}?>
															</select>
															<?}else if($row->tablename=="cs_part_fixed"){
															}?>

														<?if($row->adminurl){?><a href="<?=$row->adminurl?>" class="menusmall_btn3">관리</a><?}?>
														<?if($row->tablename=="cs_page"){?>
														<br>주메뉴 : 페이지명 아래로 하위메뉴로 구성이됩니다.<br>하단메뉴 : HTML페이지관리 항목이 모두 노출됩니다.
														<?}?>
													<?}else{?>
														<input type="hidden" name="url" value="<?=$row->url;?>">
														<?=$row->url;?>
													<?}?>
													</p>
													<?}?>
													</td>
													<td height="35" class='tabletd_all tabletd_Lmall noneoolim'>
													<?if($row->idx!=1 && $row->idx!=12){?>
													<?if($row->onoff==1 || $row->onoff==3 || $row->onoff==5 || $row->onoff==7){?><input type="checkbox" name="open" value="1" <?if($row->open==1){?>checked<?}?>>노출<?}}?></td>          
													<td height="35" class='tabletd_all tabletd_Lmall noneoolim'>
													<?if($row->idx!=1){?>
													<?if($row->onoff==2 || $row->onoff==3 || $row->onoff==6 || $row->onoff==7){?><input type="checkbox" name="openg" value="1" <?if($row->openg==1){?>checked<?}?>>노출<?}}?></td>   
													<td height="35" class='tabletd_all tabletd_Lmall noneoolim'>
													<?if($row->idx!=1){?>
													<?if($row->onoff==4 || $row->onoff==5 || $row->onoff==6 || $row->onoff==7){?><input type="checkbox" name="openf" value="1" <?if($row->openf==1){?>checked<?}?>>노출<?}}?></td>          
													<td height="35" class='tabletd_all tabletd_Lmall'>
													<?if($row->idx!=1){?>
													<a href="javascript:sendit(document.form_<?=$form_name?>)" class="menusmall_btn3">저장</a><?}?></td>
												</tr>
												</form>
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

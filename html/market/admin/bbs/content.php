<? include('../header.php');?>
<script language="JavaScript">
	<!--
	// 수정
	function bannerEdit( idx ) {
		var choose = confirm( '수정 하시겠습니까?');
		if(choose) {	location.href='content_edit.php?idx='+idx; }
		else { return; }
	}
	
	// 삭제
	function bannerDel( idx ) {
		var choose = confirm( '삭제 하시겠습니까?');
		if(choose) {	location.href='content_del_ok.php?idx='+idx; }
		else { return; }
	}

	// 순위변경
	function ranking() {
		var form=document.rankform;
		form.submit();
	}
	//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/bbs_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
									<table width="100%">
										<tr>
											<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">게시판 SNS 설정</td>
										</tr>
										<tr>
											<td height="1" bgcolor="#666666"></td>
										</tr>
										<tr>
											<td height="25"></td>
										</tr>
										<tr>
											<td height="5" class="padding_5">
								<table width="100%">
									<tr>
										<td class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0"><a name="2">게시판 SNS 설정</a>
										</td>
									</tr>
									<tr>
										<td height="10">
										</td>
									</tr>
									<tr>
										<td>
										<!--도움말-->
											<table width="100%" class='tipbox'>
												<tr>
													<td bgcolor="#E9F2F8">

														<table width="100%">
															<tr>
																<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
															</tr>
															<tr>
																<td><ul>게시판에 이용될 SNS를 관리합니다. </ul>
																<ul>아이콘선택에 확인되지 않는 아이콘은 아이콘등록 메뉴에서 등록하셔서 이용하시기 바랍니다. <a href="../design/icon_list.php"class='searchB'>SNS 아이콘관리 이동하기</a></ul>
																페이스북의 경우 APPID 발급을 받아서 이용하시기 바랍니다. <a href="http://e-sens.co.kr/infolink.php?pageName=<?=urlencode("bbs_view.php?bbs_data=aWR4PTIyMjMyJnN0YXJ0UGFnZT0wJmxpc3RObz0yNyZ0YWJsZT1jc19iYnNfZGF0YSZjb2RlPXRpcCZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||")?>" target="_new" class='searchB'>도움말</a>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										<!--//도움말-->
										</td>
									</tr>
								</table>
								</td>
							</tr>
							
							<tr>
								<td height="10"></td>
							</tr>
							<tr>
								<td>
								<table width="100%">
									<tr>
										<td valign="top" class="padding_5" height='45'><a href="content_add.php" class="oolimbtn-botton1">SNS버튼 추가하기</a></td>
									</tr>
									<tr>
										<td>
										<table width="100%" class="table_all">
											<tr>
												<td width="200" bgcolor="#E4E7EF" class='contenM tabletd_all' align="center" height="30">관리명</td>
												<td bgcolor="#E4E7EF" class='contenM tabletd_all' align="center">아이콘</td>
												<!--<td bgcolor="#E4E7EF" class='contenM tabletd_all' align="center">노출여부</td>-->
												<td bgcolor="#E4E7EF" class='contenM tabletd_all' align="center" width="120">관리</td>
											</tr>
											<form name="rankform" method="POST" action="content_ranking.php">
											<?
											$result	= $db->select( "cs_bbs_sns", "order by ranking asc" );
											while( $row = mysqli_fetch_object($result)) {
											?>
											<tr bgcolor="white">
												<td class='sensO tabletd_all' style="padding-left:15px; text-align:left">
												<input type="text" size="2" maxlength="11" name="ranking[]" value="<?=$row->ranking?>" class="formText" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;"><input type="hidden" class="formText" name="idx[]" value="<?=$row->idx;?>"> <?=$row->name;?>
												</td>
												<td class='sensO tabletd_all' align="center">
												<?$info = $db->object("cs_mobile_icon", "where idx='$row->icon'");?>
												<?if($row->noedit!=1){?>
												<img src="../../data/designImages/<?=$info->icon?>"><br><?=$row->linkurl;?>
												<?}else{?>
												<img src="../images/facebookicon.PNG"><br><?=$row->linkurl;?>
												<?}?>
												</td>
												<!--
												<td class='sensO tabletd_all' align="center">
												<?if($row->open==1){?>노출<?}else{?>숨김<?}?>
												</td>
												-->
												<td class='sensO tabletd_all' align="center"><a href="javascript:bannerEdit(<?=$row->idx;?>)" class="menusmall_btn3">수정</a>&nbsp;<?if($row->noedit!=1){?><a href="javascript:bannerDel(<?=$row->idx;?>)" class="menusmall_btn4">삭제</a><?}?>
												</td>
											</tr>
											<?
												$totalCnt--;
											}
											?>
											</form>
										</table><br>
										<a href="javascript:ranking()" class='oolimbtn-botton1'>순위변경</a>위 빈칸에 숫자로 순위변경이 가능합니다.<BR>숫자가 낮을수록 우선순위 입니다.
										</td>
									</tr>
								</table>
								</td>
							</tr>
						</table>
	</article>
	
</div>



<? include('../footer.php'); ?>

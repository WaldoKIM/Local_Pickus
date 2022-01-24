<?
include('../header.php'); 
include($ROOT_DIR.'/lib/style_class.php'); 
// 관리자 정보 불러오기.
//$_GET=&$HTTP_GET_VARS;
if($_GET[idx]){
	$idx_value = $db->object("cs_sms_text", "where idx=$_GET[idx]"); 
	$idx = $idx_value->idx;
	$code = $idx_value->code;
	$content_admin = $idx_value->content_admin;
	$content_member = $idx_value->content_member;
	$smsa = $idx_value->smsa;
	$smsm = $idx_value->smsm;
	$smsinfo = $idx_value->smsinfo;
}
?>

<script language="JavaScript">
<!--
// 폼 전송
function sendit() {
	var form=document.admin_form;
	if (form.name.value=="")
	{
		alert ("사용자 이름을 입력하여 주십시요.");
		form.name.focus();
		return;
	}
	form.submit();
}
function new_(){
	location.href="?";
}
//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/sub_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">SMS문구관리
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
								 <table width="100%" bgcolor="white">
									<tr>
										<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">SMS문구관리</td>
									</tr>
									<tr>
										<td>
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
																	<td>아래 리스트에서 수정버튼을 클릭하시면 해당 코드별로 수정하실수 있으며, <br>필요한 SMS문구에 체크하시면 SMS가 전송됩니다.</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											<!--도움말--->

										</td>
									</tr>				
									<tr>
										<td height="10">
										</td>
									</tr>
									<tr>
										<td valign="top">
											<?if($idx){?>
											<table width="100%" class="table_all">
												<form action="sms_list_proc.php" method="post" name="admin_form">
													<input type="hidden" name="mode" value="edit">
													<input type="hidden" name="idx" value="<?=$idx?>">
													<tr> 
														<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>구분코드</td>
														<td height="35" class='tabletd_all tabletd_small'>&nbsp;<input type="text" name="code" class="formText" value=<?=$code?> readonly></td>
													</tr>
													<tr> 
														<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>SMS 대상</td>
														<td height="35" class='tabletd_all tabletd_small'>&nbsp;<input type="checkbox" name="smsa" value="1" <?if($smsa){?>checked<?}?>> 관리자  <input type="checkbox" name="smsm" value="1" <?if($smsm){?>checked<?}?>> 회원 </td>
													</tr>
													<tr> 
														<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>SMS 문구[관리자]</td>
														<td height="35" class='tabletd_all tabletd_small'>
																<div id="comment">
																<fieldset>
																	<table>
																		<colgroup><col width="*" /><col width="131" /></colgroup>
																		<tbody>
																			<tr>
																				<td><div class="box" style='height:100px'><textarea name="content_admin" style='height:100px'><?=$content_admin?></textarea></div></td>
																			</tr>
																		</tbody>
																	</table>
																</fieldset>
																</div>
														</td>
													</tr>
													<tr> 
														<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>SMS 문구[회원]</td>
														<td height="35" class='tabletd_all tabletd_small'>
																<div id="comment">
																<fieldset>
																	<table>
																		<colgroup><col width="*" /><col width="131" /></colgroup>
																		<tbody>
																			<tr>
																				<td><div class="box" style='height:100px'><textarea name="content_member" style='height:100px'><?=$content_member?></textarea></div></td>
																			</tr>
																		</tbody>
																	</table>
																</fieldset>
																</div>
														</td>
													</tr>
													<tr> 
														<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>설명</td>
														<td height="35" class='tabletd_all tabletd_small'>
																<div id="comment">
																<fieldset>
																	<table>
																		<colgroup><col width="*" /><col width="131" /></colgroup>
																		<tbody>
																			<tr>
																				<td><div class="box" style='height:100px'><textarea name="smsinfo" style='height:100px'><?=$smsinfo?></textarea></div></td>
																			</tr>
																		</tbody>
																	</table>
																</fieldset>
																</div>
														</td>
													</tr>
													</form>
												</table><br>
												<table width="100%" cellpadding="8" cellspacing="1" bgcolor="#CCCCCC">
													<tr>
														<td align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>문구작성시 치환코드 : 회원명 __{MEMBER}__ / 주문코드 __{TRADECODE}__ / 사이트주소 __{URL}__ / 상호 __{COMPANY}__</td>
													</tr>
												</table>
												<table width="100%" cellpadding="3" cellspacing="1">
													<tr>
														<td height="10"></td>
													</tr>
												</table>
												<table width="100%" cellpadding="3" cellspacing="1">
													<tr>
														<td align="center" height="30"><a href="javascript:sendit()" class="search_bbs">수정</a> <a href="javascript:new_()" class="search_bbs1">삭제</a></td>
													</tr>
												</table>
												<br><br><br><br>
												<?}?>
												
												<table width="100%" class="table_all"> 
													<tr align="center" bgcolor="E4E7EF"> 
														<td width="5%"  height="25" class='contenM tabletd_all'>코드</td>
														<td height="25" class='contenM tabletd_all noneoolim'>관리자</td>
														<td height="25" class='contenM tabletd_all noneoolim'>회원</td>
														<td height="25" class='contenM tabletd_all'>SMS 문구[관리자]</td>
														<td height="25" class='contenM tabletd_all'>SMS 문구[회원]</td>
														<td height="25" class='contenM tabletd_all noneoolim'>안내</td>
														<td width="18%" class='contenM tabletd_all'>수정</td>
													</tr>


													<?
													$table				= "cs_sms_text";
													$notice_result		= $db->select( $table, "order by idx asc" );
													$i=1;
													while( $row = mysqli_fetch_object($notice_result) ) {

													?>
													<tr> 
														<td height="35" class='tabletd_all tabletd_Lmall'><?=$row->code?></td>
														<td height="35" class='tabletd_all tabletd_Lmall noneoolim'><?if($row->smsa==1){?>O<?}else{?>X<?}?></td>
														<td height="35" class='tabletd_all tabletd_Lmall noneoolim'><?if($row->smsm==1){?>O<?}else{?>X<?}?></td>
														<td height="35" class='tabletd_all tabletd_Lmall'><?=$row->content_admin?></td>
														<td height="35" class='tabletd_all tabletd_Lmall'><?=$row->content_member?></td>
														<td height="35" class='tabletd_all tabletd_Lmall noneoolim'><?=$row->smsinfo?></td>
														<td height="35" class='tabletd_all tabletd_Lmall'><a href="?idx=<?=$row->idx?>" class='menusmall_btn3'>수정</a><!--/<a href="user_list_proc.php?idx=<?=$row->idx?>&mode=del">삭제</a>--></td>
													</tr>
													<?
													$i++;
													}
													?>
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

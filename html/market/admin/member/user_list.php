<?
include('../header.php');
include($ROOT_DIR.'/lib/style_class.php'); 
// 관리자 정보 불러오기.
//$_GET=&$HTTP_GET_VARS;
if($_GET[idx]){
	$idx_value = $db->object("cs_user_list", "where idx=$_GET[idx]"); 
	$idx = $idx_value->idx;
	$name = $idx_value->name;
	$content = $idx_value->content;
	$direct = $idx_value->direct;
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
		<?include('inc/member_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">

		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">회원관리</b>
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
								<table width="100%">
									<tr>
										<td align="center" valign="top" bgcolor="#FFFFFF" class="menu">
										</td>
									</tr>
									<tr>
										<td height="75" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
											<table width="100%">
												<tr>
													<td>
														<table width="100%">
															<tr>
																<td height="25">
																	<table>
																		<tr>
																			<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">회원등급관리</td>
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
																						<td>기본 9개의 등급이 설정되어 있으며, 회원등급명은 변경가능합니다.<BR>관리자페이지 기본설정>기타설정에서 회원등급별로 특별할인율설정 하실수 있습니다.</td>
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
											
											<?if($idx){?>
											<table width="100%" class="table_all">
												<form action="user_list_proc.php" method="post" name="admin_form">
												<input type="hidden" name="mode" value="edit">
												<input type="hidden" name="idx" value="<?=$idx?>">
												<tr bgColor="white">
													<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>사용자이름</td>
													<td class='tabletd_all tabletd_small'>
														&nbsp;<input type="text" size="20" maxlength="20" name="name" class="formText" value=<?=$name?>>
													</td>
												</tr>
												<tr bgColor="white">
													<td height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>분류종류</td>
													<td class='tabletd_all tabletd_small'>
														&nbsp; 현재 설정에 명칭변경은 가능하나 회원등급을 추가로 생성하실때는 커스터마이징을 받으셔야 합니다.<br> 
																		
														<div id="comment">
														<fieldset>
															<table>
																<colgroup><col width="*" /><col width="131" /></colgroup>
																<tbody>
																	<tr>
																		<td><div class="box" style='height:100px'><textarea name="content" style='height:100px'><?=$content?></textarea></div></td>
																	</tr>
																</tbody>
															</table>
														</fieldset>
														</div>

													</td>
												</tr>
												</form>
											</table><br>
											<a href="javascript:sendit();" class="menusmall_btn3">수정</a>
											<a href="javascript:new_();" class="menusmall_btn4">삭제</a>
											<br><br><br>
											<?}?>
											
											<table width="100%" class="table_all">
												<tr>
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>번호</td>
													<td height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>사용자 이름</td>
													<td height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>내 용</td>
													<td width="60" bgcolor="E4E7EF" class='contenM tabletd_all'>수정</td>
												</tr>
												
												
												<?
													$table				= "cs_user_list";
													$notice_result		= $db->select( $table, "order by idx asc" );
													$i=1;
													while( $row = mysqli_fetch_object($notice_result) ) {
														
													?>
												<tr align="center" bgcolor="white">
													<td height="25" class='tabletd_all tabletd_Lmall'>
														<?=$row->idx?>
													</td>
													<td class='tabletd_all tabletd_Lmall'>
														<?=$row->name?>
													</td>
													<td class='tabletd_all tabletd_Lmall'>
														<?=$row->content?>
													</td>
													<td class='tabletd_all tabletd_Lmall'>
														<a href="?idx=<?=$row->idx?>" class="menusmall_btn3">수정</a><!--/<a href="user_list_proc.php?idx=<?=$row->idx?>&mode=del">삭제</a>-->
													</td>
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



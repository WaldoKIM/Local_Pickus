<?
include('../header.php'); 
include($ROOT_DIR.'/lib/style_class.php'); 
// 관리자 정보 불러오기.
//$_GET=&$HTTP_GET_VARS;
if($_GET[idx]){
	$idx_value = $db->object("cs_mobile_icon", "where idx=$_GET[idx]"); 
	$idx = $idx_value->idx;
	$name = $idx_value->name;
	$icon = $idx_value->icon;
}
?>

<script language="JavaScript">
<!--
// 폼 전송
function sendit() {
	var form=document.admin_form;
	if (form.icon.value=="")
	{
		alert ("파일을 등록하여 주십시요.");
		form.icon.focus();
		return;
	}
	form.submit();
}
function new_(){
	location.href="?";
}

function imgdel(idx){
	var choose = confirm( '삭제 하시겠습니까?');
	if(choose) {	location.href='icon_list_proc.php?idx='+idx+'&mode=del'; }
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
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">SNS  아이콘 등록및 관리</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#666666"></td>
			</tr>
			<tr>
				<td height="25"></td>
			</tr>
			<tr>
				<td height="5" class="padding_5">
					 <table width="100%" bgcolor="white">
						<tr>
							<td class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0"><a name="2">아이콘 관리</a>
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
													<td><ul>SNS 목록에 이용하실 아이콘을 등록하신후 SNS설정 및 게시판 SNS설정에서 이용하시기 바랍니다.
													<br><font color="blue">※직접 제작한 아이콘(gif,jpg,png)을 등록하여 이용할수도 있습니다. <u>아이콘제작시 배경이 없는 png파일을 권장합니다.</u></font>
													</li>
													</ul></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							<!--//도움말-->

							</td>
						</tr>				
						<tr>
							<td height="5" colspan="3"></td>
						</tr>
						<tr>
							<td valign="top" class="padding_5">
								<table width="100%">
									<tr>
										<td bgcolor="white">
											<table width="100%" class="table_all">
												<form action="icon_list_proc.php" method="post" name="admin_form" enctype="multipart/form-data">
													<?if($idx){?>
													<input type="hidden" name="mode" value="edit">
													<input type="hidden" name="idx" value="<?=$idx?>">
													<?}else{?>
													<input type="hidden" name="mode" value="add">
													<?}?>
													<tr> 
														<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>아이콘등록</td>
														<td class='sensP tabletd_all' height="25">&nbsp;<?if($icon){?><br>&nbsp;<a href="#" onclick="Control.Modal.openDialog(this, event, '../../data/designImages/<?=$icon;?>');"><img src="../images/bt_view.gif" border="0" align="absmiddle"></a><?}?> <input type="file" size="20" maxlength="20" name="icon" class="file_text"></td>
													</tr>
													</form>
												</table><br>

												<?if($idx){?>
												<a href="javascript:sendit();" class='search_bbs'>수정</a><a href="javascript:new_();" class='search_bbs1'>취소</a>
												<br><br>
												<?}else{?>
												<a href="javascript:sendit();" class='search_bbs'>등록</a><a href="javascript:new_();" class='search_bbs1'>취소</a>
												<?}?>
												</td>
											</tr>
										</table>
										<table width="100%">
											<tr>
												<td height="70"></td>
											</tr>
										</table>


										<table width="100%">
											<tr>
												<td class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0"><a name="2">아이콘 리스트</a>
											</tr>
											<tr>
												<td height="10"></td>
											</tr>
											<tr>
												<td>

													
												<div id="oolimbox-grid-table-box"> 
												
														<?
														$table				= "cs_mobile_icon";
														$notice_result		= $db->select( $table, "order by idx desc" );
														$i=1;
														$new_cnt = 0; $new_tr = 0; $td_width = 4 ; // 가로리스트 수
														while( $row = mysqli_fetch_object($notice_result) ) {
															$new_cnt++;

														?>
															<div class='oolimbox-grid-table-box01'><img src="../../data/designImages/<?=$row->icon?>" border="0"><br><a href="javascript:imgdel('<?=$row->idx?>')"><img src="../img/mobile_del.gif" border="0" alt='삭제'></a></div>
														<? if (($new_cnt % $td_width) == 0) { $new_tr++;?>
													
															<?}}?>
															<? $new_td = $td_width - ($new_cnt%$td_width);	for($i=0; $i<$new_td; $i++) { if( $new_cnt != $td_width * $new_tr) {?>
															<!-- 반복 생성 -->
															<div width="<? $width_td = 100/$td_width; echo($width_td."%");?>" class="oolimbox-grid-table-box01">&nbsp;
															</div>
															<?}}?>
													</div>

										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</article>
	
</div>



<? include('../footer.php'); ?>

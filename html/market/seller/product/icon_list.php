<?
include('../header.php'); 
include($ROOT_DIR.'/lib/style_class.php'); 
// 관리자 정보 불러오기.
//$_GET=&$HTTP_GET_VARS;
if(!$code) $code = 1;
if($_GET[idx]){
	$idx_value = $db->object("cs_icon_list", "where code=$code and idx=$_GET[idx]"); 
	$idx = $idx_value->idx;
	$name = $idx_value->name;
	$icon = $idx_value->icon;
}

if($code==1){
	$txt = "상품아이콘관리";
	$ltxt = "상품 제목옆에 나타나는 베스트,히트,신상품 등의 아이콘을 설정합니다. 사용자가 만드신 아이콘을 등록 하여 나타나게도 가능합니다.<br>등록된 아이콘은 제품관리 > 제품등록,수정시 등록한 아이콘을 선택할 수 있습니다.";
}else{
	$txt = "가격대체아이콘";
	$ltxt = "가격표기대신 설정할 아이콘을 등록하여 이용하시기 바랍니다. 예)전화문의, 입고예정...";
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
		<?include('inc/product_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
	

		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5"><?=$txt?></td>
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
							<td class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0"><a name="2">아이콘 관리 (모바일 기기용)</a>
							</td>
						</tr>
						<tr>
							<td>
							




									<div class="customertable_divcenter_1">
										<table width="100%" class="table_all table_all_moA">
											<tr> 
												<td height="35" bgcolor="B9C1D3" class='contenM tabletd_all'>신규아이콘 등록</td>
											</tr>
											<tr>
												<td style='padding:5px;'>
													<table width="100%" bgcolor="#759B00">
														<form action="icon_list_proc.php" method="post" name="admin_form" enctype="multipart/form-data">
															<?if($idx){?>
															<input type="hidden" name="mode" value="edit">
															<input type="hidden" name="idx" value="<?=$idx?>">
															<?}else{?>
															<input type="hidden" name="mode" value="add">
															<?}?>
															<input type="hidden" name="code" value="<?=$code?>">
															<tr> 
																<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>제목</td>
																<td height="25" bgcolor="white" class='tabletd_all'><input type="text" name="name" class="formText" value=<?=$name?>></td>
															</tr>
															<tr> 
																<td width="15%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>아이콘</td>
																<td height="25" bgcolor="white" class='tabletd_all'><?if($icon){?><br>&nbsp;<a href="../../data/designImages/<?=$icon;?>" rel="lightbox" class='menusmall_btn3'>미리보기</a><?}?> <input type="file" name="icon" class="formText"> 별도로 리사이징 되지 않습니다.</tr>
															</form>
														</table><br>
														<?if($idx){?>
														<div style='widh:100%;text-align:center;padding-bottom:1em;'>
														<a href='javascript:' onClick="sendit()" class='item_default_bt1'>수 정</a> <a href='javascript:' onClick="new_()" class='item_default_bt2'>취 소</a>
														</div>														
														<br><br>
														<?}else{?>
														<div style='widh:100%;text-align:center;padding-bottom:1em;'>
														<a href='javascript:' onClick="sendit()" class='item_default_bt1'>등 록</a> <a href='javascript:' onClick="new_()" class='item_default_bt2'>취 소</a>
														</div>
														<?}?>
													</td>
												</tr>
										</table>
									</div>

									
									<table width="100%" class="table_all" style='margin-top:3em;'>
										<tr>
											<td height="25" bgcolor="C4CADB" class='contenM tabletd_all'>번호</td>
											<td height="25" bgcolor="C4CADB" class='contenM tabletd_all'>제목</td>
											<td height="25" bgcolor="C4CADB" class='contenM tabletd_all'>아이콘</td>
											<td height="25" bgcolor="C4CADB" class='contenM tabletd_all'>수정</td>
										</tr>


										<?
											$table				= "cs_icon_list";
											$notice_result		= $db->select( $table, "where code=$code order by idx asc" );
											$i=1;
											while( $row = mysqli_fetch_object($notice_result) ) {

										?>
											<tr id='calendar_list_tableTD_on'> 
												<td height="25" class='sensO tabletd_all'><?=$row->idx?></td>
												<td align="center" class='sensO tabletd_all'><?=$row->name?></td>
												<td width="" class='sensO tabletd_all'><img src="../../data/designImages/<?=$row->icon?>" border="0"></td>
												<td class='sensO tabletd_all'>
													<a href='?idx=<?=$row->idx?>&code=<?=$code?>' class='item_default_bt1'>수정</a>
													<a href='icon_list_proc.php?idx=<?=$row->idx?>&mode=del&code=<?=$code?>' class='item_default_bt2'>삭제</a>
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
					</td>
				</tr>
			</table>
	</article>
	
</div>



<? include('../footer.php'); ?>

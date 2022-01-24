<? include('../header.php');?>
<?
//$_GET=&$HTTP_GET_VARS;
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function sendit() {
	var form=document.part_form;

	if(form.name.value=="") {
		alert("관리명을 입력해 주세요.");
		form.name.focus();
	}else if(form.sub_list_img1.value==""){
		alert("노출아이콘을 선택하여 주세요.");
	} else {
		form.submit();
	}
}

function msgbox(){
	document.getElementById("msgDiv").style.display = "block";
}

function layerClose(){
	document.getElementById("msgDiv").style.display = "none";
}

function iconcheck(idx, file) {
	document.viewicon.src = "../../data/designImages/"+file;
	part_form.sub_list_img1.value = idx;
	document.getElementById("msgDiv").style.display = "none";
}
//-->
</SCRIPT>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/design_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">SNS 설정</td>
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
						<td height="25" colspan="3">
						<table width="100%">
							<tr>
								<td class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">SNS 설정</p></td>
							</tr>
						</table>
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
												<td><ul>메인에 형성될 컨텐츠를 관리합니다. </ul>
												<ul>아이콘관리는 좌측 아이콘 관리 메뉴에서 등록하셔서 이용하시기 바랍니다. <a href="icon_list.php"class='searchB'>SNS 아이콘관리 이동하기</a></ul></td>
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
					<?$row = $db->object("cs_mobile_main", " where idx='$_GET[idx]'");?>
					<tr>
						<td valign="top" class="padding_5">
						<table width="100%" class="table_all">
							<form action="content_edit_ok.php" method="post" name="part_form" enctype="multipart/form-data">
							<input type="hidden" name="idx" value="<?=$_GET[idx];?>">
							<tr>
								<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>관리명</td>
								<td class='sensp tabletd_all'><input name="name" type="text" class="formText" value="<?=$row->name?>"> (간단한 설명)</td>
							</tr>
							<tr>
								<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>노출여부</td>
								<td class='sensp tabletd_all'>&nbsp;<input type="checkbox" name="open" value="1" <?if($row->open==1){?>checked<?}?>> 노출 [체크를 풀어두시면 메인에서 노출되지 않습니다.]</td>
							</tr>
							<tr>
								<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>목록 아이콘</td>
								<td class='sensO tabletd_all'>
									<input type="hidden" name="sub_list_img1" value="<?=$row->icon?>">
									<table width="100%" class="menu">
										<tr>
											<td>
												<?if($row->icon){
												$info = $db->object("cs_mobile_icon", "where idx='$row->icon'");
												?>
												<img src="../../data/designImages/<?=$info->icon?>" align="left" name="viewicon">
												<?}else{?>
												<img src="../images/no_icon.gif" align="left" name="viewicon">
												<?}?><img src="../img/arrow_new.gif" border="0" align='absmiddle'><U>현재 사용중인 아이콘입니다.</U> <br>다른 이미지로 변경시 아이콘선택하기 버튼을 클릭하여 사용하실 이미지로 변경해 주세요.<br><a href="#" class='modal searchC_icon_sns' data-modal-height="600" data-modal-width="720" data-modal-iframe="../select_icon.iframe.php" data-modal-title="아이콘선택_"><img src="../images/iconselect.gif" border="0" alt="아이콘선택_../images/iconselect.gif" style="cursor:pointer;"></a>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>링크설정</td>
								<td class='sensp tabletd_all'><input name="linkurl" type="text" class="formText formText_subject" value="<?=$row->linkurl?>"></td>
							</tr>
							</form>
						</table>
						<br>
						<table border="0" cellpadding="0" align="center" cellspacing="0" class="menu">
							<tr>
								<td height="50"><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
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

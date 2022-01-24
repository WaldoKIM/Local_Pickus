<? 
include('../header.php');
include($ROOT_DIR.'/lib/style_class.php');
//$_GET=&$HTTP_GET_VARS; //$_POST=&$HTTP_POST_VARS;
$info = $db->object("cs_design", "");
?>

<script language="javascript">
<!--
function sendit() {
	form.submit();
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
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">로고관리</td>
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
							<td class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0"><a name="2">아이콘 관리 (모바일 기기용)</a>
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
													<td>
													<table>
													<tr>
														<td>북마크 아이콘은 모바일 기기의 바탕화면에 등록되는 로고입니다.<BR>아이콘[<font color="red">사파리에서는 홈화면에 추가시, 안드로이드에서는 북마크된 내용을 홈화면에 추가시 이용됩니다.</font>]<br>ICO파일관리 [<font color="red">ICO파일은 안드로이드전용으로 URL앞에 아이콘을 추출합니다.</font>]</td>
														<td></td>
													</tr>
													</table>
													
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							<!--//도움말-->
							</td>
						</tr>
						<tr>
							<td height="5"></td>
						</tr>
						<script language="JavaScript">
						<!--
						function sendit() {
						var form=document.admin_form;
						form.submit();
						}
						//-->
						</script>
						<form action="title_ok.php" method="post" name="admin_form" enctype="multipart/form-data">
						<tr>
							<td height="5">

								<table width="100%" class="table_all">
									<tr>
										<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
											북마크 아이콘
										</td>
										<td class='sensP tabletd_all' height="25" colspan="3">
											&nbsp;<input name="bookmarkicon" type="file" class="file_text">
											<?
											if($info->bookmarkicon){
											$bookmarkicon="<img src='../../data/designImages/".$info->bookmarkicon."' border='0' align='absmiddle'>";
											}
											?>
											<?if($info->bookmarkicon){?>
											<br /><input type="checkbox" value="1" name="del_bookmarkicon">삭제시 선택하여주세요[삭제우선]!<br>&nbsp;<?=$bookmarkicon?>
											<?}?>
										</td>
									</tr>
									<tr>
										<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
											ICO 설정
										</td>
										<td class='sensP tabletd_all' height="25" colspan="3">
											&nbsp;<input name="icoicon" type="file" class="file_text">
											<?
											if($info->icoicon){
											$icoicon="<img src='../../data/designImages/".$info->icoicon."' border='0' align='absmiddle'>";
											}
											?>
											<?if($info->icoicon){?>
											<br /><input type="checkbox" value="1" name="del_icoicon">삭제시 선택하여주세요[삭제우선]!<br>&nbsp;<?=$icoicon?>
											<?}?>
										</td>
									</tr>
								</table>
								<br>
								<a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a>

							</td>
						</tr>
						</form>
					</table>
				</td>
			</tr>
			<tr>
				<td height="100"></td>
			</tr>
			<tr>
				<td height="5" class="padding_5">

					<table width="100%">
						<tr>
							<td class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0"><a name="2">홈페이지 로고 관리</a>
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
													<td>홈페이지에 노출되는 로고 아이콘이며,등록시 이미지만 사용가능합니다.(PNG, JPG, GIF)<BR>PC용 로고와 모바일용 로고를 각각 등록합니다.</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							<!--//도움말-->
							</td>
						</tr>
						<tr>
							<td height="5"></td>
						</tr>


						<script language="JavaScript">
						<!--
						function sendit3() {
						var form=document.logo_form;
						form.submit();
						}
						//-->
						</script>
						<form action="title_logo_ok.php" method="post" name="logo_form" enctype="multipart/form-data">
						<tr>
							<td height="5">
								<table width="100%" class="table_all">
									<tr>
										<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
											PC홈페이지용 로고
										</td>
										<td class='sensP tabletd_all' height="25" colspan="3" style='line-height:20px;'>
											&nbsp;<input name="title_logo" type="file" class="file_text"> <br />※로고크기 가로:240픽셀(고정) 세로:80픽셀 이하를 권장합니다.
											<?
											if($info->title_logo){
											$logo_img="<img src='../../data/designImages/".$info->title_logo."' border='0' align='absmiddle'>";
											}
											?>
											<?if($info->title_logo){?>
											<br><input type="checkbox" value="1" name="del_top_logo">삭제시 선택하여주세요[삭제우선]!<br><br>&nbsp;<?=$logo_img?>
											<?}?>
										</td>
									</tr>
									<tr>
										<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
											모바일용 로고
										</td>
										<td class='sensP tabletd_all' height="25" colspan="3" style='line-height:20px;'>
											&nbsp;<input name="title_mobile_logo" type="file" class="file_text"><br /> ※로고크기 가로:200픽셀(고정) 세로:80이하 픽셀을 권장합니다.
											<?
											$logo_img = "";
											if($info->title_mobile_logo){
											$logo_img="<img src='../../data/designImages/".$info->title_mobile_logo."' border='0' align='absmiddle'>";
											}
											?>
											<?if($info->title_mobile_logo){?>
											<br><input type="checkbox" value="1" name="del_top_mobile_logo">삭제시 선택하여주세요[삭제우선]!<br><br>&nbsp;<?=$logo_img?>
											<?}?>
										</td>
									</tr>
									<tr>
										<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all' style='line-height:20px;'>
											하단사이트 로고
										</td>
										<td class='sensP tabletd_all' height="25" colspan="3">
											&nbsp;<input name="title_logo2" type="file" class="file_text">
											<?
												if($info->title_logo2){
													$logo_img2="<img src='../../data/designImages/".$info->title_logo2."' border='0' align='absmiddle'>";
												}
											?>
											<?if($info->title_logo2){?>
											<br><input type="checkbox" value="1" name="del_buttom_logo">삭제시 선택하여주세요[삭제우선]!<br>&nbsp;<?=$logo_img2?>
											<?}?>
										</td>
									</tr>
								</table>
								<br>
								<a href="javascript:sendit3();" class='oolimbtn-botton1'>등록</a>
								<br><br>
								<!--------페이지정보출력--------->
								</form>
								<!--------페이지정보출력--------->

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


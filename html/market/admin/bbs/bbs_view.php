<?
include("../header.php");
//$_GET=&$HTTP_GET_VARS;
$mv_data	= $_GET[bbs_data];
$bbs_data	= $tools->decode( $_GET[bbs_data] );
$idx = $bbs_data[idx];
$code = $bbs_data[code];

// 조회수 증가
$db->update("cs_bbs_data", "read_cnt=read_cnt+1 where idx=$idx");
$bbs_stat			= $db->object("cs_bbs_data", "where idx=$idx");
$bbs_admin_stat	= $db->object("cs_bbs", "where code='$bbs_stat->code'", "view, bbs_coment, bbs_pds, header, footer");
$name			= $bbs_stat->name;
$email			= $bbs_stat->email;
$reg_date	= $tools->strDateCut($bbs_stat->reg_date, 6);
$subject		= $db->stripSlash($bbs_stat->subject);

// 내용 출력 방식
$content		= $bbs_stat->content;
?>
<script language="javascript">
	<!--
	function board_del(value) {
		var choose = confirm( '영구히 삭제 하시겠습니까?');
		if(choose) {	location.href='bbs_view_del.php?bbs_data='+value }
		else { return; }
	}

	function img_view(value, number) {
		window.open("../view_img.php?board_data="+value+"&imgNum="+number, "","scrollbars=no, width=500, height=450");
	}
	function ComentDel( value ) {
		var choose = confirm( '삭제 하시겠습니까?');
		if(choose) {	location.href='bbs_coment_ok.php?coment_del=1&coment_idx='+value+'&bbs_data=<?=$mv_data;?>'; }
		else { return; }
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
								<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5"><?=$bbs_admin_stat->name;?> 게시판관리
								</td>
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
										<td height="35" class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0"><?=$bbs_admin_stat->name;?> 게시판리스트
										</td>
									</tr>
									<tr>
										<td height="10" colspan="3">
									<!--도움말-->
										<table width="100%" class='tipbox'>
											<tr>
												<td bgcolor="#E9F2F8">
													<table width="100%">
														<tr>
															<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
														</tr>
														<tr>
															<td><?=$bbs_admin_stat->name;?> 게시판에 등록된 게시물을 관리 하실 수 있습니다.<br>FAQ게시판 글등록 : FAQ게시판글동록시 글제목은 질문글이되고, 내용글은 답변글이 됩니다. 이점 유의 하시기 바랍니다.</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									<!--//도움말-->
										</td>
									</tr>
									<tr>
										<td height="25" colspan="3"></td>
									</tr>
									<tr>
										<td valign="top" class="padding_5">
										<table width="100%">
											<tr>
												<td height="25" colspan="2" align="center">
													<table border="0" cellpadding="5" cellspacing="1" width="100%" class="table_all">
														<tr>
															<td width="100" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
																이름
															</td>
															<td height='40' class='sensP tabletd_all'>
															<?=$name;?>
															<? if( $email != "NULL") { ?><a href="mailto:<?=$email?>" onMouseOver="javascript:window.status='메일';return true;"><img src="../images/icon_mail.gif" width="20" height="18" border="0" align="absmiddle"></a><?}?>
															</td>
															<td width="100" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
																작성일
															</td>
															<td height='40' class='sensP tabletd_all'>
															<?=$reg_date;?>
															</td>
														</tr>
														<tr>
															<td width="100" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
																첨부파일
															</td>
															<td height='40' colspan="3" bgcolor="white" class='sensP tabletd_all'>
															<!-- 자료실시작-->
															<? if( $bbs_admin_stat->bbs_pds && $bbs_stat->bbs_file != "none" )  { $bbs_file = explode( "&&", $bbs_stat->bbs_file ); ?>
															<a href="bbs_download.php?bbs_data=<?=$mv_data;?>&download=1"><span style="font-size:11px;"><?=$bbs_file[1];?></span></a>
															<?}?>
															<?
															$bbs_file = "";
															if( $bbs_admin_stat->bbs_pds && $bbs_stat->add_file1 != "none" )  { $bbs_file = explode( "&&", $bbs_stat->add_file1 ); ?>
															, <a href="bbs_download.php?bbs_data=<?=$mv_data;?>&download=1&add=1"><span style="font-size:11px;"><?=$bbs_file[1];?></span></a>
															<? }?>
															<?
																$bbs_file = "";
															if( $bbs_admin_stat->bbs_pds && $bbs_stat->add_file2 != "none" )  { $bbs_file = explode( "&&", $bbs_stat->add_file2 ); ?>
															, <a href="bbs_download.php?bbs_data=<?=$mv_data;?>&download=1&add=2"><span style="font-size:11px;"><?=$bbs_file[1];?></span></a>
															<? }?>
															<?
															$bbs_file = "";
															if( $bbs_admin_stat->bbs_pds && $bbs_stat->add_file3 != "none" )  { $bbs_file = explode( "&&", $bbs_stat->add_file3 ); ?>
															, <a href="bbs_download.php?bbs_data=<?=$mv_data;?>&download=1&add=3"><span style="font-size:11px;"><?=$bbs_file[1];?></span></a>
															<? }?>
															<?
																$bbs_file = "";
															if( $bbs_admin_stat->bbs_pds && $bbs_stat->add_file4 != "none" )  { $bbs_file = explode( "&&", $bbs_stat->add_file4 ); ?>
															, <a href="bbs_download.php?bbs_data=<?=$mv_data;?>&download=1&add=4"><span style="font-size:11px;"><?=$bbs_file[1];?></span></a>
															<? }?>
															<?
															$bbs_file = "";
															if( $bbs_admin_stat->bbs_pds && $bbs_stat->add_file5 != "none" )  { $bbs_file = explode( "&&", $bbs_stat->add_file5 ); ?>
															, <a href="bbs_download.php?bbs_data=<?=$mv_data;?>&download=1&add=5"><span style="font-size:11px;"><?=$bbs_file[1];?></span></a>
															<? }?>
															<!-- 자료실끝-->
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td width="100%">
												<table width="100%">
													<tr>
														<td width="100%" height="50" align="center">
														<table width="100%">
															<tr>
																<td class='contenM' style='text-align:left'><span class='searchB'>제목</span><?=$subject;?>
																</td>
															</tr>
														</table>
														</td>
													</tr>
													<!-- 파일이 그림일 경우 출력(gif/jpg) -->
													<?
														$add_file = explode( ".", $bbs_stat->bbs_file );
														if( strtolower($add_file[count($add_file)-1]) == "gif" || strtolower($add_file[count($add_file)-1]) == "jpg"|| strtolower($add_file[count($add_file)-1]) == "png" ) {
															$view_img = @getimagesize("../../data/bbsData/".$bbs_stat->bbs_file);
															if(  $view_img[0] > 500 ) {$view_img_width	= "width=600"; }
														?>
													<tr>
														<td height="25" align="center">
														<a href="../../data/bbsData/<?=$bbs_stat->bbs_file;?>" rel="lightbox"><img src="../../data/bbsData/<?=$bbs_stat->bbs_file;?>" <?=$view_img_width;?>></a>
														</td>
													</tr>
													<tr>
														<td height="25" align="center">
														</td>
													</tr>
													<?}?>
													<!-- 파일이 그림일 경우 출력(gif/jpg) 1-->
													<?
													$add_file = "";
													$add_file = explode( ".", $bbs_stat->add_file1 );
													if( strtolower($add_file[count($add_file)-1]) == "gif" || strtolower($add_file[count($add_file)-1]) == "jpg" || strtolower($add_file[count($add_file)-1]) == "png" ) {
													$view_img = @getimagesize("../../data/bbsData/".$bbs_stat->add_file1);
													if(  $view_img[0] > 600 ) {$view_img_width	= "width=600"; }
													?>
													<tr>
														<td height="25" align="center">
														<a href="../../data/bbsData/<?=$bbs_stat->add_file1;?>" rel="lightbox"><img src="../../data/bbsData/<?=$bbs_stat->add_file1;?>" <?=$view_img_width;?>></a>
														</td>
													</tr>
													<tr>
														<td height="25" align="center">
														</td>
													</tr>
													<?}?>
													<!-- 파일이 그림일 경우 출력(gif/jpg) 2-->
													<?
														$add_file = "";
														$add_file = explode( ".", $bbs_stat->add_file2 );
														if( strtolower($add_file[count($add_file)-1]) == "gif" || strtolower($add_file[count($add_file)-1]) == "jpg"|| strtolower($add_file[count($add_file)-1]) == "png" ) {
															$view_img = @getimagesize("../../data/bbsData/".$bbs_stat->add_file2);
															if(  $view_img[0] > 500 ) {$view_img_width	= "width=600"; }
														?>
													<tr>
														<td height="25" align="center">
														<a href="../../data/bbsData/<?=$bbs_stat->add_file2;?>" rel="lightbox"><img src="../../data/bbsData/<?=$bbs_stat->add_file2;?>" <?=$view_img_width;?>></a>
														</td>
													</tr>
													<tr>
														<td height="25" align="center">
														</td>
													</tr>
													<?}?>
													<!-- 파일이 그림일 경우 출력(gif/jpg) 3-->
													<?
													$add_file = "";
													$add_file = explode( ".", $bbs_stat->add_file3 );
													if( strtolower($add_file[count($add_file)-1]) == "gif" || strtolower($add_file[count($add_file)-1]) == "jpg"|| strtolower($add_file[count($add_file)-1]) == "png" ) {
													$view_img = @getimagesize("../../data/bbsData/".$bbs_stat->add_file3);
													if(  $view_img[0] > 500 ) {$view_img_width	= "width=600"; }
													?>
													<tr>
														<td height="25" align="center">
														<a href="../../data/bbsData/<?=$bbs_stat->add_file3;?>" rel="lightbox"><img src="../../data/bbsData/<?=$bbs_stat->add_file3;?>" <?=$view_img_width;?>></a>
														</td>
													</tr>
													<tr>
														<td height="25" align="center">
														</td>
													</tr>
													<?}?>
													<!-- 파일이 그림일 경우 출력(gif/jpg) 4-->
													<?
														$add_file = "";
														$add_file = explode( ".", $bbs_stat->add_file4 );
														if( strtolower($add_file[count($add_file)-1]) == "gif" || strtolower($add_file[count($add_file)-1]) == "jpg"|| strtolower($add_file[count($add_file)-1]) == "png" ) {
															$view_img = @getimagesize("../../data/bbsData/".$bbs_stat->add_file4);
															if(  $view_img[0] > 500 ) {$view_img_width	= "width=600"; }
														?>
													<tr>
														<td height="25" align="center">
														<a href="../../data/bbsData/<?=$bbs_stat->add_file4;?>" rel="lightbox"><img src="../../data/bbsData/<?=$bbs_stat->add_file4;?>" <?=$view_img_width;?>></a>
														</td>
													</tr>
													<tr>
														<td height="25" align="center">
														</td>
													</tr>
													<?}?>
													<!-- 파일이 그림일 경우 출력(gif/jpg) 5-->
													<?
													$add_file = "";
													$add_file = explode( ".", $bbs_stat->add_file5 );
													if( strtolower($add_file[count($add_file)-1]) == "gif" || strtolower($add_file[count($add_file)-1]) == "jpg"|| strtolower($add_file[count($add_file)-1]) == "png" ) {
													$view_img = @getimagesize("../../data/bbsData/".$bbs_stat->add_file5);
													if(  $view_img[0] > 500 ) {$view_img_width	= "width=600"; }
													?>
													<tr>
														<td height="25" align="center">
														<a href="../../data/bbsData/<?=$bbs_stat->add_file5;?>" rel="lightbox"><img src="../../data/bbsData/<?=$bbs_stat->add_file5;?>" <?=$view_img_width;?>></a>
														</td>
													</tr>
													<tr>
														<td height="25" align="center">
														</td>
													</tr>
													<?}?>
													<tr>
														<td width="100%" align="center">
														<table width="100%">
															<tr>
																<td>
																<?=$content;?>
																</td>
															</tr>
														</table><br>
														</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td height="1" colspan="2" bgcolor='dddddd'>
												</td>
											</tr>
										</table>
										<br>
										
										<!-- 코멘트 시작 -->
										<? if( $bbs_admin_stat->bbs_coment ) { ?>
										<script language="javascript">
											<!--
											function comentSendit() {
												var form=document.bbs_coment_form;
												if(form.name.value=="") {
													alert("이름을 입력해 주십시오.");
													form.name.focus();
												} else if(form.pwd.value=="") {
													alert("패스워드를 입력해 주십시오.");
													form.pwd.focus();
												} else if(form.coment.value=="") {
													alert("코멘트를 입력해 주십시오.");
													form.coment.focus();
												} else {
													form.submit();
												}
											}
											
											
											//-->
										</script>
										<table width="100%">
											<tr>
												<td height="60" class='sub_titleL'>사용자 댓글</td>
											</tr>
											<tr>
												<td height="2"  bgcolor='333333'></td>
											</tr>
											<tr>
												<td height="20"></td>
											</tr>
										</table>
										<table width="100%" height="25">
											<?
												$co_result = $db->select( "cs_bbs_coment", "where link=$bbs_stat->idx");
												while( $co_row = @mysqli_fetch_object($co_result)) {
													$co_idx			= $co_row->idx;
													$co_name		= htmlspecialchars($co_row->name);
													$co_coment		= htmlspecialchars($co_row->coment);
													$co_coment		= str_replace("\n","<br>", $co_coment);
													$co_coment		= stripslashes($co_coment);
													$co_reg_date	= $tools->strDateCut($co_row->reg_date);
												?>
											<tr>
												<td width="100" align="center" height="25">
												<?=$co_name;?>
												</td>
												<td width="" height="25">
												<?=$co_coment;?>
												</td>
												<td width="80" height="25" align="center">
												<?=$co_reg_date;?>
												</td>
												<td width="70" height="25" align="center">
												<a href="javascript:ComentDel('<?=$co_idx;?>')"class='btn_guide1'>삭제</a>
												</td>
											</tr>
											<tr height=1>
												<td colspan=4 height=1 bgcolor='dddddd'>
												</td>
											</tr>
											<?} ?>
										</table>
										<br>
										
										<table width="100%" class="table_all">
											<form name="bbs_coment_form" action="bbs_coment_ok.php?bbs_data=<?=$mv_data;?>" method="post">
											<input type="hidden" name="coment_reg" value="1">
											<tr>
												<td width="100" align="center" bgcolor="#E4E7EF" class='contenM'>
												코멘트등록
												</td>
												<td width="*" bgcolor="ffffff" class='tabletd_all'>
												<table cellspacing=0 border=0>
													<tr>
														<td width=180 class='contenM' style='text-align:right'>
														이 름&nbsp;<input type="text" name="name" size="15" class="formText"><br>비밀번호&nbsp;<input type="password" name="pwd" size="15"  class="formText">
														</td>
														<td>
														<textarea name="coment" cols="100" rows="4" class="formText"></textarea>
														</td>
														<td>														
														<a href="javascript:comentSendit();" class='oolimbtn-botton5'>등록</a>
														</td>
													</tr>
												</table>
												</td>
											</tr>
											</form>
										</table>
										<br>
										<? }?>
										<!--// 코멘트 종료 -->
										
										<table align="center" height="35">
											<tr>
												<td align="center"><a href="bbs_write.php?reWrite=1&bbs_data=<?=$mv_data;?>" class='oolimbtn_bbs_bt1'>답변</a>&nbsp;<a href="javascript:board_del('<?=$mv_data;?>');" class='oolimbtn_bbs_bt2'>삭제</a>&nbsp;<a href="bbs_edit.php?bbs_data=<?=$mv_data;?>" class='oolimbtn_bbs_bt3'>수정</a>&nbsp;<a href="bbs_list.php?bbs_data=<?=$mv_data;?>" class='oolimbtn_bbs_bt4'>목록</a></td>
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

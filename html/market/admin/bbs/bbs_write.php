<?
	include("../header.php");
	//$_GET=&$HTTP_GET_VARS;
	$mv_data	= $_GET[bbs_data];
	$bbs_data	= $tools->decode( $_GET[bbs_data] );
	$idx = $bbs_data[idx];
	$code = $bbs_data[code];
	
	// 게시판 환경
	$bbs_admin_stat	= $db->object("cs_bbs", "where code='$code'");
	if( $_GET[reWrite] ) {
		$view_row		= $db->object("cs_bbs_data", "where idx=$idx");
		$subject			= $db->stripSlash($view_row->subject);
		$content			= $db->stripSlash($view_row->content);
		$content			= "$view_row->name 님 쓰신글\n\n"."제목 : ".$subject."\n".$content."\n\n"."[답변] ";
	}
?>
<script language="javascript">
	<!--
	// 폼전송
	function writeSendit() {
		var form=document.bbs_write_form;
		form.content.value = myeditor.outputBodyHTML();
		if(form.name.value=="") {
			alert("이름을 입력해 주십시오.");
			form.name.focus();
		} else if( form.pwd.value=="") {
			alert("패스워드를 입력해 주십시오.");
			form.pwd.focus();
		} else if( form.subject.value=="") {
			alert("제목을 입력해 주십시오.");
			form.subject.focus();
		<?if($bbs_admin_stat->category){?>
		}else if(form.category.value=="none"){
			alert("카테고리를 선택하여 주세요.");
			form.category.focus();
		<?}?>
		} else {
			form.submit();
		}
	}
	
	// 웹FTP 새창 오픈한다
	function ftpWinOpen() {
		window.open("../webftp.php","","scrollbars=yes, width=500, height=600");
	}
	
	var add_cnt = 0;
	function add_file() {
		if( add_cnt < 5 ) {
			document.getElementsByName("add_view")[add_cnt].style.display="";
			add_cnt++;
		} else {
			alert('추가파일은 5개까지 등록 할 수 있습니다');
		}
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
											<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5"><?=$bbs_stat->name;?> 게시판관리
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
														<td height="35" class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0"><?=$bbs_stat->name;?> 게시판리스트</p>
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
																				<td><?=$bbs_stat->name;?> 게시판에 등록된 게시물을 관리 하실 수 있습니다.<br><font color='red'>FAQ게시판 글등록 : FAQ게시판글동록시 글제목은 질문글이되고, 내용글은 답변글이 됩니다. 이점 유의 하시기 바랍니다.</font></td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														<!--//도움말-->
														</td>
													</tr>
													<tr>
														<td height="5" colspan="3">
															
														</td>
													</tr>
													<form name="bbs_write_form" action="bbs_write_ok.php" method="post" enctype="multipart/form-data">
													<input type="hidden" name="bbs_data" value="<?=$mv_data;?>">
													<input type="hidden" name="ref" value="<?=$view_row->ref;?>">
													<input type="hidden" name="re_step" value="<?=$view_row->re_step;?>">
													<input type="hidden" name="re_level" value="<?=$view_row->re_level;?>">
													<tr>
														<td valign="top" class="padding_5">
															<table width="100%" border="0" cellspacing="3" cellpadding="0" class="table_all">
																<tr>
																	<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
																		이 름
																	</td>
																	<td class='sensP tabletd_all'>
																		&nbsp;<input type="text" name="name" class="formText" value="<?=$_SESSION[ADMIN_NAME];?>"> (예 : 홍길동)
																	</td>
																</tr>
																<tr>
																	<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
																		비밀번호
																	</td>
																	<td class='sensP tabletd_all'>
																		&nbsp;<input type="password" name="pwd" class="formText" value="<?=$_SESSION[ADMIN_PASSWD];?>"> (수정 및 삭제시 필요합니다)
																	</td>
																</tr>

																<tr>
																	<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
																		이메일
																	</td>
																	<td class='sensP tabletd_all'>
																		&nbsp;<input type="text" name="email" class="formText" size="40" value="<?=$_SESSION[ADMIN_EMAIL];?>"> (예 : mail@mail.co.kr)
																	</td>
																</tr>

																<tr>
																	<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
																		제 목
																	</td>
																	<td class='sensP tabletd_all'>
																		&nbsp;<input type="text" name="subject" class="formText" size="70">
																	</td>
																</tr>
															<?if($bbs_admin_stat->category){?>
																<tr>
																	<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
																		카테고리
																	</td>
																	<td class='sensP tabletd_all'>
																		<select name='category' size='1'>
																			<option value="none">&nbsp;선택</option>
																			<?
																				$B = explode("&&",$bbs_admin_stat->category);
																				for($i=0;$i<count($B)-1;$i++){
																				?>																														
																				<option value="<?=$B[$i]?>">&nbsp;<?=$B[$i]?></option>
																			<?}?>
																		</select>
																	</td>
																</tr>
																<?}?>
																<?if($bbs_admin_stat->hold==1){?>								<tr>
																	<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
																		비밀글
																	</td>
																	<td class='sensP tabletd_all'>
																		&nbsp;<input type="checkbox" name="hold" value="1">설정&nbsp;&nbsp;비밀글이 설정될경우 게시물은 관리자 및 자기자신만 보기 권한이 주어집니다.
																	</td>
																</tr>
																<?}?>

																<?if($bbs_admin_stat->bbs_type=="1"){?><? if(!$_GET[reWrite]) {?>
																<tr>
																	<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
																		
																		공지기능
																	</td>
																	<td class='sensP tabletd_all'><input type="radio" name="notice" value="1">&nbsp;yes&nbsp;<input type="radio" name="notice" value="0" checked>&nbsp;no
																	
																	</td>
																</tr>
																<? }else{ ?>
																	<input type="hidden" name="notice" value="0">
																<?}?>
																<?}?>

																<tr>
																	<td width="120" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
																		내 용
																	</td>
																	<td>
																	<textarea id="content" name="content" style="display:none"></textarea>
																	<!-- 에디터를 화면에 출력합니다. -->
																	<script type="text/javascript" language="javascript">
																		var myeditor = new cheditor();
																		myeditor.config.editorHeight = '200px';             // 에디터 세로폭입니다.
																		myeditor.config.editorWidth = '100%';                // 에디터 가로폭입니다.
																		myeditor.inputForm = 'content';                     // 입력 textarea의 ID 이름입니다.
																		myeditor.run();                                     // 에디터를 실행합니다.
																	</script>
																	</td>
																</tr>

																<? if( $bbs_admin_stat->bbs_pds ) { ?>
																<tr>
																	<td height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
																		파 일
																	</td>
																	<td class='sensP tabletd_all'>
																		&nbsp;<input type="file" name="bbs_file" class="file_text">
																	</td>
																</tr>

																<? if( $bbs_admin_stat->bbs_type==3 ) {?>
																<tr name="add_view" id="add_view" style="display:none;">
																	<td colspan="2" style='padding:5px'>
																		<table width="100%">
																			<tr>
																				<td height="25" align="center"  bgcolor="BDC3D3" class='contenM tabletd_all'>
																					파 일1
																				</td>
																				<td class='sensP tabletd_all'>
																					&nbsp;<input type="file" name="add_file1" class="file_text">
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr name="add_view" id="add_view" style="display:none;">
																	<td colspan="2" style='padding:5px'>
																		<table width="100%">
																			<tr>
																				<td height="25" align="center"  bgcolor="BDC3D3" class='contenM tabletd_all'>
																					파 일2
																				</td>
																				<td class='sensP tabletd_all'>
																					&nbsp;<input type="file" name="add_file2" class="file_text">
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr name="add_view" id="add_view" style="display:none;">
																	<td colspan="2" style='padding:5px'>
																		<table width="100%">
																			<tr>
																				<td height="25" align="center"  bgcolor="BDC3D3" class='contenM tabletd_all'>
																					파 일3
																				</td>
																				<td class='sensP tabletd_all'>
																					&nbsp;<input type="file" name="add_file3" class="file_text">
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr name="add_view" id="add_view" style="display:none;">
																	<td colspan="2" style='padding:5px'>
																		<table width="100%">
																			<tr>
																				<td height="25" align="center"  bgcolor="BDC3D3" class='contenM tabletd_all'>
																					파 일4
																				</td>
																				<td class='sensP tabletd_all'>
																					&nbsp;<input type="file" name="add_file4" class="file_text">
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr name="add_view" id="add_view" style="display:none;">
																	<td colspan="2" style='padding:5px'>
																		<table width="100%">
																			<tr>
																				<td height="25" align="center"  bgcolor="BDC3D3" class='contenM tabletd_all'>
																					파 일5
																				</td>
																				<td class='sensP tabletd_all'>
																					&nbsp;<input type="file" name="add_file5" class="file_text">
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td height="25" align="center" bgcolor="#E4E7EF"class='contenM tabletd_all'>
																		파일추가하기
																	</td>
																	<td height="25" class='sensP tabletd_all'>
																		&nbsp;<a href="javascript:add_file();" claSS='search_bbs'>파일추가하기</A> : 파일추가는 5개까지 가능합니다.
																	</td>
																</tr>
																<?}}?>
															</table>

															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										
										<table width="100%">
											<tr>
												<td height="20"></td>
											</tr>
											<tr>
												<td>
													<table>
														<tr>
															<td style='right:40%; height:55px;'>
																<a href="javascript:writeSendit();" class='oolimbtn-botton1'>등록</a> <a href=javascript:history.go(-1); class='oolimbtn-botton1_1'>취소</a>
															</td>
														</tr>
													</table>												
												</td>
											</tr>
											<tr>
												<td height="60"></td>
											</tr>
										</table>
										
	</article>
	
</div>



<? include('../footer.php'); ?>

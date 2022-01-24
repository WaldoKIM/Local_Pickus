<?
	include("../header.php");
	//$_GET=&$HTTP_GET_VARS;
	//$_POST=&$HTTP_POST_VARS;
	$mv_data	= $_GET[bbs_data];
	$bbs_data	= $tools->decode( $_GET[bbs_data] );
	$idx = $bbs_data[idx];
	$code = $bbs_data[code];
	
	// 게시판 환경
	$bbs_admin_stat	= $db->object("cs_bbs", "where code='$code'");
	
	// 수정 정보 체크
	if($idx ) {
		$bbs_stat	= $db->object("cs_bbs_data", "where idx=$idx");
	} else {
		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
	}
	
	//추가된 파일의 갯수를 구한다.
	if($bbs_stat->add_file1 != "none"){
		$add_cnt = 1;
	}
	if($bbs_stat->add_file2 != "none"){
		$add_cnt = 2;
	}
	if($bbs_stat->add_file3 != "none"){
		$add_cnt = 3;
	}
	if($bbs_stat->add_file4 != "none"){
		$add_cnt = 4;
	}
	if($bbs_stat->add_file5 != "none"){
		$add_cnt = 5;
	}
	if(!$add_cnt){
		$add_cnt = 0;
	}
	
?>

<script language="javascript">
	<!--
	// 폼 전송
	function writeSendit() {
		var form=document.bbs_write_form;
		form.content.value = myeditor.outputBodyHTML();
		if(form.name.value=="") {
			alert("이름을 입력해 주십시오.");
			form.name.focus();
		/*} else if( form.pwd.value=="") {
			alert("패스워드를 입력해 주십시오.");
			form.pwd.focus();*/
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
	
	var add_cnt = <?=$add_cnt?>;
	function add_file() {
		if( add_cnt < 5 ) {
			document.getElementsByName("add_view")[add_cnt].style.display="";
			add_cnt++;
		} else {
			alert('추가파일은 5개까지 등록 할 수 있습니다');
		}
	}
	
	//  TEXTAREA 입력 폼 크기 조정
	function textarea_resize( formname, size ) {
		if( size=='reset' ){
			formname.rows = 10;
		}else{
			var value = formname.rows + size;
			if(value>11) formname.rows = value;
			else return;
		}
	}
	//-->
</script>
<script type="text/javascript" src="../../lib/img/prototype_v1511.js"></script>
<script type="text/javascript" src="../../lib/img/Control.js"></script>
<script type="text/javascript" src="../../lib/img/Control.ImgModal.js?ver=1.004"></script>
<link type="text/css" rel="stylesheet" href="../../lib/img/imgFulllayer.css?ver=1.000" media="screen" />

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
																	<td><?=$bbs_stat->name;?> 게시판에 등록된 게시물을 관리 하실 수 있습니다.<br>FAQ게시판 글등록 : FAQ게시판글동록시 글제목은 질문글이되고, 내용글은 답변글이 됩니다. 이점 유의 하시기 바랍니다.</td>
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
											<form name="bbs_write_form" action="bbs_edit_ok.php" method="post" enctype="multipart/form-data">
											<input type="hidden" name="bbs_data" value="<?=$mv_data;?>">
											<tr>
												<td valign="top">
												<table width="100%" border="0" cellspacing="3" cellpadding="0" class="table_all">
													<tr>
														<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
														이 름
														</td>
														<td class='sensP tabletd_all'>
														&nbsp;<input type="text" name="name" class="formText"value="<?=$bbs_stat->name;?>">
														</td>
													</tr>

													<tr>
														<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
														비밀번호
														</td>
														<td height="40"class='sensP tabletd_all'>
														&nbsp;<input type="password" name="pwd" class="formText">
														</td>
													</tr>

													<tr>
														<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
														이메일
														</td>
														<td height="40"class='sensP tabletd_all'>
														&nbsp;<input type="text" name="email" class="formText" size="40" value="<? if( $bbs_stat->email != "NULL" ) echo $bbs_stat->email;?>">
														</td>
													</tr>

													<tr>
														<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
														제 목
														</td>
														<td height="40"class='sensP tabletd_all'>
														&nbsp;<input type="text" name="subject" class="formText"size="70" value="<?=$bbs_stat->subject?>">
														</td>
													</tr>
													<?if($bbs_admin_stat->category){?>
													<tr>
														<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
														카테고리
														</td>
														<td height="40" class='sensP tabletd_all'>
														<select name='category' size='1'>
															<option value="none">&nbsp;선택</option>
															<?
																$B = explode("&&",$bbs_admin_stat->category);
																for($i=0;$i<count($B)-1;$i++){
																?>
															<option value="<?=$B[$i]?>"  <?if($bbs_stat->category==$B[$i]){?>selected<?}?>
															>&nbsp;<?=$B[$i]?>
															</option>
															<?}?>
														</select>
														</td>
													</tr>
													<?}?>
													<?if($bbs_admin_stat->hold==1){?>
													<tr>
														<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
														비밀글
														</td>
														<td height="40"class='sensP tabletd_all'>
														&nbsp;<input type="checkbox" name="hold" value="1" <?if($bbs_stat->hold==1){?>checked<?}?>>설정&nbsp;&nbsp;비밀글이 설정될경우 게시물은 관리자 및 자기자신만 보기 권한이 주어집니다.
														</td>
													</tr>
													<?}?>
													<?if($bbs_admin_stat->bbs_type=="1"){?>
													<tr>
														<td width="15%" height="25" align="center"  bgcolor="#E4E7EF" class='contenM tabletd_all'>공지기능</td>
														<td class='sensP tabletd_all'><input type="radio" name="notice" value="1" <? if( $bbs_stat->notice==1 ) echo("checked"); ?>>&nbsp;사용&nbsp; <input type="radio" name="notice" value="0" <? if( $bbs_stat->notice==0 ) echo("checked"); ?>>&nbsp;미사용
														</td>
													</tr>

													<?}?>
													<tr>
														<td width="15%" align=center  bgcolor="#E4E7EF" class='contenM tabletd_all'>
														내 용
														</td>
														<td height="40" class='sensP tabletd_all'>
														<textarea id="content" name="content" style="display:none"><?=$bbs_stat->content;?></textarea>
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
														<td height="40" class='sensP tabletd_all'>
														&nbsp;<input type="file" name="bbs_file" class="file_text"><?if($bbs_stat->bbs_file != "none"){?><br><br><a href="../../data/bbsData/<?=$bbs_stat->bbs_file;?>" rel="lightbox" class='btn_guide1'>미리보기</a><input type="checkbox" value="1" name="del_bbs_file">삭제시 선택하여주세요[삭제우선]!<?}?>
														</td>
													</tr>

													<? if( $bbs_admin_stat->bbs_type==3 ) {?>
													<tr name="add_view" id="add_view" style="display:<?if($bbs_stat->add_file1 != "none"){?><?}else{?>none<?}?>">
														<td colspan="2" style='padding:5px'>
														<table width="100%">
															<tr>
																<td height="25" width="120" align="center"  bgcolor="BDC3D3" class='contenM tabletd_all'>
																파 일1
																</td>
																<td height="40"class='sensP tabletd_all'>
																&nbsp;<input type="file" name="add_file1" class="file_text">
																<?if($bbs_stat->add_file1 != "none"){?><br><br><a href="../../data/bbsData/<?=$bbs_stat->add_file1;?>" rel="lightbox" class='btn_guide1'>미리보기</a><input type="checkbox" value="1" name="del_add_file1">삭제시 선택하여주세요[삭제우선]!<?}?>
																</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr name="add_view" id="add_view" style="display:<?if($bbs_stat->add_file2 != "none"){?><?}else{?>none<?}?>;">
														<td colspan="2" style='padding:5px'>
														<table width="100%">
															<tr>
																<td height="25" width="120" align="center"  bgcolor="BDC3D3" class='contenM tabletd_all'>
																파 일2
																</td>
																<td height="40"class='sensP tabletd_all'>
																&nbsp;<input type="file" name="add_file2" class="file_text"><?if($bbs_stat->add_file2 != "none"){?><br><br><a href="../../data/bbsData/<?=$bbs_stat->add_file2;?>" rel="lightbox" class='btn_guide1'>미리보기</a><input type="checkbox" value="1" name="del_add_file2">삭제시 선택하여주세요[삭제우선]!<?}?>
																</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr name="add_view" id="add_view" style="display:<?if($bbs_stat->add_file3 != "none"){?><?}else{?>none<?}?>;">
														<td colspan="2" style='padding:5px'>
														<table width="100%">
															<tr>
																<td height="25" width="120" align="center"  bgcolor="BDC3D3" class='contenM tabletd_all'>
																파 일3
																</td>
																<td height="40"class='sensP tabletd_all'>
																&nbsp;<input type="file" name="add_file3" class="file_text"><?if($bbs_stat->add_file3 != "none"){?><br><br><a href="../../data/bbsData/<?=$bbs_stat->add_file3;?>" rel="lightbox" class='btn_guide1'>미리보기</a><input type="checkbox" value="1" name="del_add_file3">삭제시 선택하여주세요[삭제우선]!<?}?>
																</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr name="add_view" id="add_view" style="display:<?if($bbs_stat->add_file4 != "none"){?><?}else{?>none<?}?>;">
														<td colspan="2" style='padding:5px'>
														<table width="100%">
															<tr>
																<td height="25" width="120" align="center"  bgcolor="BDC3D3" class='contenM tabletd_all'>
																파 일4
																</td>
																<td height="40"class='sensP tabletd_all'>
																&nbsp;<input type="file" name="add_file4" class="file_text"><?if($bbs_stat->add_file4 != "none"){?><br><br><a href="../../data/bbsData/<?=$bbs_stat->add_file4;?>" rel="lightbox" class='btn_guide1'>미리보기</a><input type="checkbox" value="1" name="del_add_file4">삭제시 선택하여주세요[삭제우선]!<?}?>
																</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr name="add_view" id="add_view" style="display:<?if($bbs_stat->add_file5 != "none"){?><?}else{?>none<?}?>;">
														<td colspan="2" style='padding:5px'>
														<table width="100%">
															<tr>
																<td height="25" width="120" align="center"  bgcolor="BDC3D3" class='contenM tabletd_all'>
																파 일5
																</td>
																<td height="40"class='sensP tabletd_all'>
																&nbsp;<input type="file" name="add_file5" class="file_text"><?if($bbs_stat->add_file5 != "none"){?><br><br><a href="../../data/bbsData/<?=$bbs_stat->add_file5;?>" rel="lightbox" class='btn_guide1'>미리보기</a><input type="checkbox" value="1" name="del_add_file5">삭제시 선택하여주세요[삭제우선]!<?}?>
																</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr>
														<td height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
														파일추가하기
														</td>
														<td height="25" class='sensP tabletd_all'>
														&nbsp;<a href="javascript:add_file();" claSS='search_bbs'>파일추가하기</A> : 파일추가는 5개까지 가능합니다.
														</td>
													</tr>
													<?}}?>
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
																		<a href="javascript:writeSendit();" class='oolimbtn-botton1'>등록</a> <a href=javascript:history.go(-2); class='oolimbtn-botton1_1'>취소</a>
																	</td>
																</tr>
															</table>												
														</td>
													</tr>
													<tr>
														<td height="60"></td>
													</tr>
												</table>
												</td>
											</tr>
											</form>
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

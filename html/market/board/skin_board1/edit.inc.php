<?
	// 수정 정보 체크
	if( $_POST[pwd] && !$_SESSION[USERID] ) {
		$bbs_stat	= $db->object("cs_bbs_data", "where idx=$idx");
		if(!$db->cnt("cs_bbs_data", "where idx='$idx' and pwd=PASSWORD('$_POST[pwd]')")){
			$tools->alertJavaGo("패스워드가 올바르지 않습니다.", "?boardT=v&board_data=".$MV_DATA."&search_items=".$MV_SEARCH_ITEM);
		}
	}else if( $_POST[pwd] && $_SESSION[USERID]) {
		$bbs_stat	= $db->object("cs_bbs_data", "where idx=$idx");
		if(!$db->cnt("cs_bbs_data", "where idx='$idx' and pwd=PASSWORD('$_POST[pwd]')")){
			$tools->alertJavaGo("패스워드가 올바르지 않습니다.", "?boardT=v&board_data=".$MV_DATA."&search_items=".$MV_SEARCH_ITEM);
		}
	}else if(!$db->cnt("cs_bbs_data", "where idx='$idx' and pwd=PASSWORD('$_POST[pwd]')")) {
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
	}else{
		$add_cnt = 0;
	}
?>
<script language="javascript">
	<!--
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
	
	var add_cnt = <?=$add_cnt?>;
	function add_file() {
		if( add_cnt < 5 ) {
			document.all.add_view[add_cnt].style.display="";
			add_cnt++;
		} else {
			alert('추가파일은 5개까지 등록 할 수 있습니다');
		}
	}
	
	//-->
</script>
<div id="prev-next-links" style='width:100px;float:right;margin-top:70px;margin-bottom:20px'><a id="link-previous-product" href='javascript:history.back()'></a></div>
<div class='spaceline02'></div>


<table width="100%">
	<form name="bbs_write_form" action="edit_ok.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="board_data" value="<?=$MV_DATA;?>">
	<input type="hidden" name="search_items" value="<?=$MV_SEARCH_ITEM;?>">
	<tr>
		<td valign="top">
			<table width="100%" style='border-collapse: collapse'>
				<tr>
					<td width="7" colspan="2" height="2" bgColor='#333333'></td>
				</tr>
				<?if($bbs_admin_stat->category){?>
				<tr>
					<td width='15%' height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>카테고리</td>
					<td height="45" style="padding-left:3px" align="left">
						<select name='category' id="sel_01">
						<option value="none">&nbsp;선택</option>
						<?
							$B = explode("&&",$bbs_admin_stat->category);
							for($i=0;$i<count($B)-1;$i++){
							?>
						<option value="<?=$B[$i]?>" <?if($bbs_stat->category==$B[$i]){?>selected<?}?>>&nbsp;<?=$B[$i]?></option>
						<?}?>
						</select> (등록 하고자 하는 해당 카테고리를 선택해 주세요.)
					</td>
				</tr>
				<tr>
					<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<?}?>
				<tr <?if($_SESSION[USERID]){?>style="display:none;"<?}?>>
					<td width='15%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>
						이 름
					</td>
					<td height="45" style="padding-left:3px" align="left">
						<input type="text" name="name" class="formText"  value="<?=$bbs_stat->name;?>">
					</td>
				</tr>
				<tr <?if($_SESSION[USERID]){?>style="display:none;"<?}?>>
					<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<tr <?if($_SESSION[USERID]){?>style="display:none;"<?}?>>
					<td width='15%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>
						비밀번호
					</td>
					<td height="45" style="padding-left:3px" align="left">
						<input type="password" name="pwd" class="formText"  value="<?=$_SESSION[PASSWD];?>">
					</td>
				</tr>
				<tr <?if($_SESSION[USERID]){?>style="display:none;"<?}?>>
					<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<tr <?if($_SESSION[USERID]){?>style="display:none;"<?}?>>
					<td width='15%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>
						이메일
					</td>
					<td height="45" style="padding-left:3px" align="left" class='email'>
						<input type="text" name="email" maxlength="50" style="IME-MODE:disabled" class="formText email" value="<? if( $bbs_stat->email != "NULL" ) echo $bbs_stat->email;?>">
					</td>
				</tr>
				<tr <?if($_SESSION[USERID]){?>style="display:none;"<?}?>>
					<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<tr>
					<td width='15%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>
						제 목
					</td>
					<td height="45" style="padding-left:3px" align="left" class='email'>
						<input type="text" name="subject" class="formText formText_subject" maxlength="50" value="<?=$bbs_stat->subject?>">
					</td>
				</tr>
				<tr>
					<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<?if($bbs_admin_stat->hold==1){?>
				<tr>
					<td width='15%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>
						비밀글
					</td>
					<td height="45" style="padding-left:3px" align="left">
						<input type="checkbox" name="hold" value="1" <?if($bbs_stat->hold==1){?>checked<?}?> class='bbs_input'><img src="images/key_icon2.gif" border="0">
					</td>
				</tr>
				<tr>
					<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<?}?>
				<tr>
					<td colspan="2" height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>내 용</td>
				</tr>
				<tr>
					<td colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<tr>
					<td colspan="2" align="center" style="padding:10px 0;">
						<textarea id="content" name="content" style="display:none"><?=$bbs_stat->content;?></textarea>
						<!-- 에디터를 화면에 출력합니다. -->
						<script type="text/javascript" language="javascript">
							var myeditor = new cheditor();
							myeditor.config.editorHeight = '400px';             // 에디터 세로폭입니다.
							myeditor.config.editorWidth = '100%';                // 에디터 가로폭입니다.
							myeditor.inputForm = 'content';                     // 입력 textarea의 ID 이름입니다.
							myeditor.run();                                     // 에디터를 실행합니다.
							window.onresize = function(){
								if(document.documentElement.offsetWidth < 959) myeditor.cheditor.toolbarWrapper.style.display = 'none';
								else myeditor.cheditor.toolbarWrapper.style.display = '';
							}
						</script>
					</td>
				</tr>
				<tr>
					<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<? if( $bbs_admin_stat->bbs_pds) { ?>
				<tr>
					<td height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>
						파 일
					</td>
					<td height="45" style="padding:5px" align="left">
						<input type="file" class='file_text' maxlength="15" name="bbs_file"><?if($bbs_stat->bbs_file != "none"){?>&nbsp;<a href="../data/bbsData/<?=$bbs_stat->bbs_file;?>" rel="lightbox" class="smallBtn07" style="width:60px">미리보기</a>&nbsp;<input type="checkbox" value="1" name="del_bbs_file">삭제시 선택하여주세요[삭제우선]!<?}?>
					</td>
				</tr>
				<tr>
					<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<? } ?>
			</table>

			<div class='spaceline01'></div>

			<table style='margin:0 auto;'>
				<tr>
					<td style='text-align:center;'>
						<a href="javascript:writeSendit();" class='oolimbtn-botton1'>글쓰기</a>
						<a href="javascript:history.go(-1);" class='oolimbtn-botton1'>취소</a>
					</td>
				</tr>
			</table>

		</td>
	</tr>
	</form>
</table>

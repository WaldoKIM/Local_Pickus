<?
// 게시판 접근 권한 설정
$level_name = $db->object("cs_user_list", "where idx='$bbs_admin_stat->bbs_write'", "*");

if( $bbs_admin_stat->bbs_write > $_SESSION[LEVEL] ) {
	$tools->errMsg($write_name->name.' 회원이상 쓰기권한이 있습니다.');
}

if( $boardT=="rw" ) {
  	$view_row		= $db->object("cs_bbs_data", "where idx=$idx");
	$subject			= $db->stripSlash($view_row->subject);
	$content			= $db->stripSlash($view_row->content);
	$content			= "$view_row->name 님 쓰신글\n\n"."제목 : ".$subject."\n".$content."\n\n"."[답변] ";
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
	<?if($bbs_admin_stat->signcheck==1){?>
	} else if( form.imagecode.value=="") {
		alert("보안코드를 입력해 주십시오.");
		form.imagecode.focus();
	<?}?>
	} else {
		form.submit();			
	}
}

var add_cnt = 0;
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
	<form name="bbs_write_form" action="write_ok.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="board_data" value="<?=$MV_DATA;?>">
	<input type="hidden" name="search_items" value="<?=$MV_SEARCH_ITEM;?>">
	<input type="hidden" name="ref" value="<?=$view_row->ref;?>">
	<input type="hidden" name="re_step" value="<?=$view_row->re_step;?>">
	<input type="hidden" name="re_level" value="<?=$view_row->re_level;?>">
	<input type="hidden" name="userid" value="<?=$_SESSION[USERID];?>">
	<input type="hidden" name="signok">
	<tr>
		<td valign="top">
			<table width="100%">
				<tr>
					<td colspan="2" height="2" bgColor='#333333'></td>
				</tr>
				<?if($bbs_admin_stat->category){?>	
				<tr> 
					<td width=20% height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>카테고리</td>
					<td height="45" style="padding-left:3px" align="left">
						<select name='category' id="sel_01">
						<option value="none">&nbsp;선택</option>
						<?
					$B = explode("&&",$bbs_admin_stat->category);
					for($i=0;$i<count($B)-1;$i++){
						?>																											
						<option value="<?=$B[$i]?>">&nbsp;<?=$B[$i]?>
						</option>
						<?}?>
						</select>(카테고리를 선택해 주세요.)
					</td>
				</tr>
				<tr>
					<td colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<?}?>
				<tr <?if($_SESSION[USERID]){?>style="display:none;"<?}?>> 
					<td width=20% height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>이 름</td>
					<td height="45" style="padding-left:3px" align="left"><input type="text" name="name" class="formText" maxlength="15" value="<?=$_SESSION[NAME];?>"></td>
				</tr>
				<tr <?if($_SESSION[USERID]){?>style="display:none;"<?}?>>
					<td colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<tr <?if($_SESSION[USERID]){?>style="display:none;"<?}?>> 
					<td width=20% height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>비밀번호</td>
					<td height="45" style="padding-left:3px" align="left"><input type="password" name="pwd" class="formText" value="<?=$_SESSION[PASSWD];?>"></td>
				</tr>
				<tr>
					<td colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<tr> 
					<td width=20% height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>제 목</td>
					<td height="45" style="padding-left:3px" align="left" class='email'><input type="text" name="subject" class="formText formText_subject" maxlength="50"></td>
				</tr>
				<tr>
					<td colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>	
				<tr <?if($_SESSION[USERID]){?>style="display:none;"<?}?>> 
					<td width=20% height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>이메일</td>
					<td height="45" style="padding-left:3px" align="left" class='email'><input type="text" name="email" maxlength="50" style="IME-MODE:disabled" class="formText email" value="<?=$_SESSION[EMAIL];?>"></td>
				</tr>
				<tr <?if($_SESSION[USERID]){?>style="display:none;"<?}?>>
					<td colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<?if($bbs_admin_stat->hold==1){?>							
				<tr> 
					<td width=20% height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>비밀글</td>
					<td height="45" style="padding-left:3px" align="left" class='oolimmobilemenuM'><input type="checkbox" name="hold" value="1" class='bbs_input'> 비밀글로 등록시 체크</td>
				</tr>
				<tr>
					<td colspan="2" height="1" bgColor='#dddddd'></td>
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
							<textarea id="content" name="content" style="display:none"></textarea>
							<!-- 에디터를 화면에 출력합니다. -->
							<script type="text/javascript" language="javascript">
								var myeditor = new cheditor();
								myeditor.config.editorHeight = '400px';             // 에디터 세로폭입니다.
								myeditor.config.editorWidth = '100%';                // 에디터 가로폭입니다.
								myeditor.inputForm = 'content';                     // 입력 textarea의 ID 이름입니다.
								myeditor.run();                                     // 에디터를 실행합니다.

								window.onresize = function(){
									if(document.documentElement.offsetWidth < 479) myeditor.cheditor.toolbarWrapper.style.display = 'none';
									else myeditor.cheditor.toolbarWrapper.style.display = '';
								}
							</script>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<? if( $bbs_admin_stat->bbs_pds) {?>							
				<tr> 
					<td height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>파 일</td>
					<td style="padding:10px 3px" align="left"><input type="file" name="bbs_file" >파일이름이 한글일 경우 영문으로 변경한 후 업로드해 주세요.</td>
				</tr>
				<tr>
					<td colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<?}?>
				<?/*
				<?if($bbs_admin_stat->signcheck==1z){?>
				<tr> 
					<td colspan="2">
						<table width="100%">
							<tr>
								<td width="20%" height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>보안문자</td>
								<td height="45" align="left"><img src="../chsignup.php?<?=SID?>" align="absmiddle">&nbsp;<input type="text" class="formText" maxlength="15" name="imagecode"><br>&nbsp;위 보안문자를 입력해 주세요.</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="1" bgColor='#dddddd'></td>
				</tr>
				<?}?>
				*/?>
				<tr style="display:none;"> 
					<td colspan="2">
						<table width="100%">
							<tr>
								<td width="20%" height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>소셜연동</td>
								<td>
									<table>
										<tr>
											<td><a href="#"><img src="skin_img/social_icon4.png" border="0" title="패이스북"></a></td>
											<td><a href="#"><img src="skin_img/social_icon5.png" border="0" title="트위트"></a></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="display:none;">
					<td colspan="2" height="1" bgColor='#333333'></td>
				</tr>
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

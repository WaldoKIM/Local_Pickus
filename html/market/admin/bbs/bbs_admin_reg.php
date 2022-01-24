<?
	include("../header.php");
	include($ROOT_DIR.'/lib/style_class.php');
	
	$user_result = $db->select( "cs_user_list", " order by idx asc");
	$user_list = "<option value='0' selected>비회원</option>";
	if($admin_info->member_check==1){
		while( $user_row = @mysqli_fetch_object($user_result) ) {
			$user_list .= "<option value='$user_row->idx'>$user_row->name</option>";
		}
	}
	$user_list .= "<option value='99'>비공개</option>";
	
?>
<script id="dynamic"></script> <!-- 이거 빼먹지 말것 -->
<script language="JavaScript">
	<!--
	// 폼 전송
	function bbsSendit() {
		var form=document.bbs_reg_form;
		dataInput(); // 카테고리 데이타체크
		if(form.name.value=="") {
			alert("게시판 제목을 입력해 주십시오.");
			form.name.focus();
		} else if( form.code.value=="") {
			alert("게시판 코드를 입력해 주십시오.");
			form.code.focus();
		} else if(form.bbs_type[0].checked==false && form.bbs_type[1].checked==false && form.bbs_type[2].checked==false){
			alert("게시판 타입을 선택해 주십시오.");
			form.bbs_type[0].focus();
		} else {
			form.submit();
		}
	}
	
	//주소록 카테고리 등록
	function optionInput(){
		var len,obj_input, obj_name, obj_part;
		obj_input = document.bbs_reg_form.option1_input;
		obj_name =	document.bbs_reg_form.option1_name;
		obj_part = document.bbs_reg_form.option1_part;
		
		if(obj_input.value.length < 1) { alert("옵션내용을 입력하여야 합니다."); obj_input.focus(); return; }
		len = obj_part.length;
		obj_part.length = len+1;
		obj_part.options[len].value = obj_input.value;
		obj_part.options[len].text = obj_input.value;
		obj_input.value="";
		obj_input.focus();
	}
	// 주소록 카테고리 수정
	function optionEdit(){
		var len,obj_input, obj_name, obj_part;

		obj_input = document.bbs_reg_form.option1_input;
		obj_part = document.bbs_reg_form.option1_part;


		if(obj_part.selectedIndex < 0){
			alert("수정할 대상을 선택하여 주세요.");
		}else{
			if(obj_input.value.length < 1) { alert("옵션내용을 입력하여야 합니다."); obj_input.focus(); return; }
			len = obj_part.length;

			thisIndex = obj_part.selectedIndex;
			obj_part.options[thisIndex].value = obj_input.value;
			obj_part.options[thisIndex].text = obj_input.value;
			obj_input.value="";
			obj_input.focus();
		}
	}
	function targettxt(value){
		document.bbs_reg_form.option1_input.value = value;
	}


	//주소록 카테고리 삭제
	function optionDel(n){
		var len,obj_input, obj_name, obj_part;
		obj_part = document.bbs_reg_form.option1_part;
		var obj_now = obj_part.selectedIndex;//현재 리스트 객체
		if (obj_now==-1){
			alert("삭제할 옵션내용을 선택하세요.");
			return;
		}
		obj_part.options[obj_part.selectedIndex] = null;
	}
	//카테고리값 확인
	function dataInput() {
		var form=document.bbs_reg_form;
		var data_cnt=0;
		form.hidden_option1_data.value="";
		for( data_cnt=0; data_cnt < form.option1_part.length; data_cnt ++) {
			form.hidden_option1_data.value =form.hidden_option1_data.value + form.option1_part.options[data_cnt].value;
			form.hidden_option1_data.value= form.hidden_option1_data.value + "&&";
		}
	}
	
	
	// 뉴 마크
	function newCheck() {
		var form=document.bbs_reg_form;
		if(form.new_check.checked  == true ) {
			form.new_mark.disabled = false;
		} else {
			form.new_mark.disabled = true;
		}
	}

	//옵션변경설정 다이렉트 프로세서
	function codeCheck(value) {
		dynamic.src = "dir.codecheck.php?code="+value;
	}

	// 쿨 마크
	function coolCheck() {
		var form=document.bbs_reg_form;
		if(form.cool_check.checked  == true ) {
			form.cool_mark.disabled = false;
		} else {
			form.cool_mark.disabled = true;
		}
	}
	
	// 순위 변경 ( up or down )
	function move(index,to) {
		var list = index;
		var total = list.length-1;
		var index = list.selectedIndex;
		
		if (to == +1 && index == total) return false;
		if (to == -1 && index == 0) return false;
		
		var items = new Array;
		var values = new Array;
		
		for (i = total; i >= 0; i--) {
			items[i] = list.options[i].text;
			values[i] = list.options[i].value;
		}
		
		for (i = total; i >= 0; i--) {
			if (index == i) {
				
				alert
				list.options[i + to] = new Option(items[i],values[i], 0, 1);
				list.options[i] = new Option(items[i + to], values[i + to]);
				i--;
			}
			else
			{
				list.options[i] = new Option(items[i], values[i]);
			}
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
								<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">게시판관리
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
										<td height="35" class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">게시판등록</td>
									</tr>
									<tr>
										<td>
											<!----------도움말------------>
												<table width="100%" class='tipbox'>
													<tr>
														<td bgcolor="#E9F2F8">
															<table width="100%">
																<tr>
																	<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																</tr>
																<tr>
																	<td>권한을 통하여 회원의 등급별 읽기, 쓰기, 삭제 권한을 부여하실 수 있습니다. <br>비회원제일경우 비밀번호를 통하여 게시물 권한이 부여됩니다.&nbsp;<br><font color='red'>※ 신규 게시판생성후 메뉴종합관리에서 해당 게시판메뉴를 만들어 줍니다.</font><br><font color='red'><u>※ 게시판생성 완료후 사용자페이지에 보여지게 하기위해서는</font> <font color='blue'>메뉴종합관리 > 메뉴등록(수정) > 링크설정 > 프로그램링크를 선택</font><font color='red'>하여 해당 게시판을 링크해주세요.</u></font>
																	<br><br>
																	※ 회사전경게시판은 전용게시판으로 글쓰기/수정/삭제는 관리자 페이지에서만 가능하합니다.<font color='red'>(사용자페이지에서 상세페이지 이동은 없습니다. 아래 권한설정은 무시됩니다.)</font></td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											<!----------도움말------------>
										</td>
									</tr>
									<tr>
										<td height="25"></td>
									</tr>
									<tr>
										<td valign="top" class="padding_5">
										<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table_all">
											<form name="bbs_reg_form" action="bbs_admin_reg_ok.php" method="post">
											<input type="hidden" name="bbs_admin_reg" value="true">
											<input type="hidden" name="hidden_option1_data">

											<tr>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>게시판명</td>
												<td height="40" class='sensW tabletd_all'> <input name="name" type="text" class="formText"></td>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>게시판코드</td>
												<td height="40" class='sensW tabletd_all'> <input name="code" type="text" class="formText" onmouseout="codeCheck(this.value)"></td>
											</tr>

											<tr>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>자료실사용</td>
												<td height="40" class='sensW tabletd_all'> <input type="radio" name="bbs_pds" value="1"> 사용함 <input type="radio" name="bbs_pds" value="0" checked> 사용안함</td>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>코멘트기능</td>
												<td height="40" class='sensW tabletd_all'> <input type="radio" name="bbs_coment" value="1"> 사용함 <input type="radio" name="bbs_coment" value="0" checked> 사용안함	</td>
											</tr>

											<tr>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>접근권한</td>
												<td height="40" class='sensW tabletd_all'>
												<select name="bbs_access">
													<?=$user_list?>
												</select>
												</td>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>읽기권한
												<td height="40" class='sensW tabletd_all'>
												<select name="bbs_read">
													<?=$user_list?>
												</select>
												</td>
											</tr>

											<tr>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>쓰기권한</td>
												<td height="40" class='sensW tabletd_all'>
												<select name="bbs_write">
													<?=$user_list?>
												</select>
												 <div class='sensC'>※공시사항 게시판일 경우는 쓰기권한을 비공개로 선택합니다. </div>
												</td>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'><?/*보안코드사용*/?></td>
												<td height="40" class='sensW tabletd_all'>
													<p style="display:none">
													<input name="signcheck" type="checkbox" value="1"> 이미지로된 특수글자를 입력하여야만 글 등록이 가능합니다.
													</p>
												</td>
											</tr>

											<tr>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>리스트수</td>
												<td height="40" class='sensW tabletd_all'> <input name="list_height" type="text" size="10" class="formText" value="15" style="text-align: center">줄(갤러리는 개수)</td>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>페이지수</td>
												<td height="40" class='sensW tabletd_all'> <input name="list_page" type="text" size="10" class="formText" value="10" style="text-align: center">페이지</td>
											</tr>

											<tr>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>New 마크</td>
												<td height="40" class='sensW tabletd_all'> <input type="checkbox" name="new_check" value="1" checked onClick="newCheck()"> 사용 <input name="new_mark" type="text" size="5" class="formText" style="text-align: center" value="24"> 시간 이내</td>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>Cool 마크</td>
												<td height="40" class='sensW tabletd_all'> <input type="checkbox" name="cool_check" value="1" checked onClick="coolCheck()"> 사용 <input name="cool_mark" type="text" size="5" class="formText"  style="text-align: center" value="100"> 번 이상</td>
											</tr>

											<tr>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>스킨선택</td>
												<td height="40" class='sensW tabletd_all'>
												<select name="skin">
													<?
														$dir    = '../../board';
														$dh  = opendir($dir);
														$skin_cnt = 0;
														$notSkin = array(" ", ".", "..");
														while (false !== ($filename = readdir($dh))) {
															$temp = array_search($filename, $notSkin);
															if($temp==""){
															?>
													<option value="<?=$filename?>"><?=$filename?></option>
													<?}}?>
												</select>
												<br><a href="#" class='modal btn_guide1' data-modal-height="600" data-modal-width="720" data-modal-iframe="../img/help/5.gif" data-modal-title="도움말">도움말</a><div class='sensC'>※ 도움말을 참고 하여 성격에 맞는 게시판 스킨을 선택해 주세요.</div></td>
												<td width="15%" height="40" bgcolor="#E4E7EF" class='contenM tabletd_all'>비밀글설정</td>
												<td height="40" class='sensW tabletd_all'> <input type="checkbox" name="hold" value="1"> 사용</td>
											</tr>
											<tr bgColor="white">
												<td align="center" height="25" bgcolor="#E4E7EF" class='contenM tabletd_all''>
													&nbsp;&nbsp;카테고리 입력
												</td>
												<td width="600" height="25" colspan="4" align="left" valign="top" bgColor="white" class='sensP tabletd_all'>
													<div class="oolimbox-wrapper">
													
														<article class="oolimbox-grid-bbsbox01">
															<input name="option1_input" type="text" class="formText formText_subject">
														</article>
													
														<article class="oolimbox-grid-bbsbox02">
															<a href="javascript:optionInput(1);" class='btn_guide2'>등록</a><a href="javascript:optionEdit();" class='btn_guide1'>수정</a>
														</article>
													
														<article class="oolimbox-grid-bbsbox03">
															<select name="option1_part" size="5" multiple  class='formSelect' align='absmiddle' onclick="targettxt(this.value)">
															</select>	
														</article>
													
														<article class="oolimbox-grid-bbsbox04">
															<a href="javascript:move(bbs_reg_form.option1_part,-1)" class='searchD'><img src="../images/top_arrow.png"  border=0></a><br>
															<a href="javascript:move(bbs_reg_form.option1_part,+1)" class='searchD'><img src="../images/bottom_arrow.png" border=0></a>
														</article>

														<article class="oolimbox-grid-bbsbox05">
															<a href="javascript:optionDel(1);" class='oolimbtn-botton5'>선택카테고리삭제</a>
														</article>

													</div>

												</td>
											</tr>

											<tr>
												<td height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>게시판타입</td>
												<td height="40" class='sensW tabletd_all' colspan="3"> <input type="radio" name="bbs_type" value="1"> 일반형 <input type="radio" name="bbs_type" value="2"> 이벤트형 <input type="radio" name="bbs_type" value="3"> 갤러리형	<br><br><br><span style="font-size:11px;"><font color='red'>일반형</font> : 일반게시판형태의 타입<br><font color='red'>이벤트형</font> : 가로 한개씩 이미지가 출력되는 타입(이벤트게시판참고)<br><font color='red'>겔러리형</font> : 리스트에 사진이 출력되는 타입(일반사진게시판참고)</span></td>
											</tr>
											<tr>
												<td height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>SNS 설정</td>
												<td height="40" class='sensW tabletd_all' colspan="3"> 
												<?
												$opt_result		= $db->select( "cs_bbs_sns", "where 1 order by ranking asc");
												while( $opt_row = mysqli_fetch_object($opt_result)) {
													if($opt_row->noedit==1){
												?>
												<input type="checkbox" name="snslist[]" value="<?=$opt_row->idx?>"> <img src="../images/facebookicon.PNG" border="0">
												<?}else{?>
												<input type="checkbox" name="snslist[]" value="<?=$opt_row->idx?>"><?$info = $db->object("cs_mobile_icon", "where idx='$opt_row->icon'");?>
												<img src="../../data/designImages/<?=$info->icon?>" title="<?=$opt_row->name?>">
												<?}}?>
												</td>
											</tr>

											<tr>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'> 카테고리 가로목록수</td>
												<td height="40" class='sensW tabletd_all' colspan="3"><input type="text" name="catewidth"  class="formText" value="5"> 카테고리 목록 가로수</td>
											</tr>

											<tr>
												<td width="15%" height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>header</td>
												<td class='sensW tabletd_all' colspan="3">

													<div id="comment">
													<fieldset>
														<table>
															<colgroup><col width="*" /><col width="131" /></colgroup>
															<tbody>
																<tr>
																	<td><div class="box" style='height:300px'><textarea name="header" style='height:300px'></textarea></div></td>
																</tr>
															</tbody>
														</table>
													</fieldset>
													</div>

												</td>
											</tr>
											</form>
										</table>
										</td>
									</tr>
									<tr>
										<td height="20"></td>
									</tr>
									<tr>
										<td style=' left:50%; height:55px;'><a href="javascript:bbsSendit();" class='oolimbtn-botton1'>등록</a></td>
									</tr>
								</table>
								</td>
							</tr>
						</table>
						
	</article>
	
</div>



<? include('../footer.php'); ?>

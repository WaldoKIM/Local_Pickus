<? include('./include/head.inc.php');?>
<?
$tools->metaGo("../../bbs/mypage.php");
// 회원체크
if( !$_SESSION[USERID] || !$_SESSION[PASSWD] ) {
// 로그인 상태가 아니면 회원 로그인으로 보낸다
$tools->metaGo('login.php?login_go='.$_SERVER[REQUEST_URI]);
}
?>
<div id="layer" style="position:fixed !important;bottom:1px;left: 0px; width: 250px; height: 395px; z-index: 50001; left:40%;top:50%;margin:-190px 0 0 -125px; overflow: hidden;-webkit-overflow-scrolling:touch;display:none;">
<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:2px;top:2px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
</div>
<?if(!$_SERVER[HTTPS]){?>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<?}else{?>
<script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
<?}?>
<script>
    // 우편번호 찾기 화면을 넣을 element
    var element_layer = document.getElementById('layer');
    function closeDaumPostcode() {
        // iframe을 넣은 element를 안보이게 한다.
        element_layer.style.display = 'none';
    }
    function sample2_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = data.address; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수
                // 기본 주소가 도로명 타입일때 조합한다.
                if(data.addressType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }
                // 우편번호와 주소 정보를 해당 필드에 넣는다.
				document.getElementById('zip').value = data.zonecode;
				document.getElementById('add1').value = fullAddr;
                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_layer.style.display = 'none';
            },
            width : '100%',
            height : '100%'
        }).embed(element_layer);
        // iframe을 넣은 element를 보이게 한다.
        element_layer.style.display = 'block';
        // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
        initLayerPosition();
    }
    // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
    // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
    // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
    function initLayerPosition(){
        var width = 300; //우편번호서비스가 들어갈 element의 width
        var height = 460; //우편번호서비스가 들어갈 element의 height
        var borderWidth = 5; //샘플에서 사용하는 border의 두께
        // 위에서 선언한 값들을 실제 element에 넣는다.
        element_layer.style.width = width + 'px';
        element_layer.style.height = height + 'px';
        element_layer.style.border = borderWidth + 'px solid';
        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
       // element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
       // element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
    }
</script>
<div class="site-wrapper" id="box_wrapper">
	<!--상단로고, 가이드메뉴-->
	<? include('./include/top_guide.inc.php');?>
	<!--상단메뉴, 로테이트베너-->
	<? include('./include/top_menu.inc.php');?>
		<!--페이지 위치-->
		<div class="my_location">
			<ol class="breadcrumb titletxt_B">
				<li><a href="index.php" class="titletxt_A">Home</a></li>
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li><i class="fas fa-arrow-left"></i>마이페이지</li>				
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li><i class="fas fa-arrow-left"></i>회원정보수정</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section order_check login_check_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************내용영역 출력 시작********************-->
					<!--페이지서브메뉴-->
					<? include('./include/mymenu.inc.php');?>
					<!--페이지서브메뉴-->
					<div class="main">
						<h2 class="tit">회원정보수정</h2>
						<script language="javascript">
							<!--
							// 우편번호찾기
							function postWinOpen(data) {
								window.open("post_search.php?method="+data, "","scrollbars=yes, width=500, height=400");
							}
							function sendit() {
								var form=document.join_form;
								if(form.email.value=="") {
									alert("회원님의 E-Mail를 입력해 주세요.");
									form.email.focus();
								<?if($admin_stat->member_birth==1 && $admin_stat->member_birth_use==1){?>
								} else if(form.birthm.value=="" || form.birthy.value=="" || form.birthd.value=="") {
									alert("회원님의 생년월일을 선택해 주세요.");
									form.birthm.focus();
								<?}?>
								<?if($admin_stat->member_tel==1 && $admin_stat->member_tel_use==1){?>
								} else if(form.tel1.value=="") {
									alert("회원님의 전화번호를 입력해 주세요.");
									form.tel1.focus();
								} else if(form.tel2.value=="") {
									alert("회원님의 전화번호를 입력해 주세요.");
									form.tel2.focus();
								} else if(form.tel3.value=="") {
									alert("회원님의 전화번호를 입력해 주세요.");
									form.tel3.focus();
								<?}?>
								<?if($admin_stat->member_phone==1 && $admin_stat->member_phone_use==1){?>
								} else if(form.phone1.value=="" || form.phone2.value=="" || form.phone3.value=="") {
									alert("회원님의휴대번호를 입력해 주세요.");
									form.phone1.focus();
								<?}?>
								<?if($admin_stat->member_addr==1 && $admin_stat->member_addr_use==1){?>
								} else if(form.zip.value=="") {
									alert("회원님의 우편번호를 입력해 주세요.");
									form.zip.focus();
								} else if(form.zip.value.length != 5) {
									alert("회원님의 우편번호 5자리를 입력해 주세요.");
									form.zip.focus();
								} else if(form.add1.value=="") {
									alert("회원님의 주소를 입력해 주세요.");
									form.add1.focus();
								} else if(form.add2.value=="") {
									alert("회원님의 상세주소(번지)를 입력해 주세요.");
									form.add2.focus();
								<?}?>
								} else {
									<?if($SECURITYDOMAIN){?>
										form.action = "<?=$SECURITYDOMAIN?>/my_member_edit_ok.php";
									<?}else{?>
										form.action = "my_member_edit_ok.php";
									<?}?>
									form.submit();
								}
							}
							//-->
						</script>
						<? $mem_row = $db->object("cs_member", "where userid='$_SESSION[USERID]' and passwd='$_SESSION[PASSWD]'");?>
						<table width="100%" class="jointable_all">
							<form method="post" name="join_form" enctype="multipart/form-data">
							<tr>
								<td width="20%" bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">
									아이디
								</td>
								<td align='left' style='padding-left:10px' class='jointable_td'>
									<?=$mem_row->userid;?>
								</td>
							</tr>
							<tr>
								<td width="20%" bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">
									비밀번호
								</td>
								<td align='left' style='padding-left:10px' class='jointable_td'>
									<input name="passwd" type="password" class="formText" maxlength="20" size="20">
								</td>
							</tr>
							<tr>
								<td width="20%" bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">
									이름
								</td>
								<td align='left' style='padding-left:10px' class='jointable_td'>
									<?=$mem_row->name;?>
								</td>
							</tr>
							<tr>
								<td width="20%" bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">
									이메일
								</td>
								<td height="50" class="jointable_td email" style="padding-left:10px;">
									<input name="email" type="text" style="IME-MODE:disabled" maxlength="40" class="formText email"  value="<?=$mem_row->email;?>">
								</td>
							</tr>
							<?if($admin_stat->member_birth==1){?>
							<tr>
								<td bgcolor="F3F3F3"  style='text-align:center' class='oolimmobilemenuM jointable_td'>생년월일</td>
								<td align='left' style='padding-left:10px' class='jointable_td' class="textphone">
									<select name="birthy" size="1" class="formSelect" style='width:60px;'>
										<option value="">선택</option>
										<?for($i=date("Y")-70;$i<=date("Y");$i++){?>
										<option value="<?=$i?>" <?if($mem_row->birthy==$i){?>selected<?}?>><?=$i?></option>
										<?}?>
									</select>
									년&nbsp;
									<select name="birthm" size="1" class="formSelect" style='width:60px;'>
										<option value="">선택</option>
										<?for($i=1;$i<=12;$i++){?>
										<option value="<?=$i?>" <?if($mem_row->birthm==$i){?>selected<?}?>><?=$i?></option>
										<?}?>
									</select>
									월&nbsp;
									<select name="birthd" size="1" class="formSelect" style='width:60px;'>
										<option value="">선택</option>
										<?for($i=1;$i<=31;$i++){?>
										<option value="<?=$i?>" <?if($mem_row->birthd==$i){?>selected<?}?>><?=$i?></option>
										<?}?>
									</select>
									일
								</td>
							</tr>
							<?}?>
							<?if($admin_stat->member_tel==1){?>
							<tr>
								<td bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">전화번호</td>
								<td align='left' style='padding-left:10px' class='jointable_td'><input name="tel1" type="text"  class="formText textphone" maxlength="4" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$mem_row->tel1;?>"> - <input name="tel2" type="text" class="formText textphone" maxlength="4" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$mem_row->tel2;?>"> - <input name="tel3" type="text" class="formText textphone" maxlength="4"style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$mem_row->tel3;?>"></td>
							</tr>
							<?}?>
							<?if($admin_stat->member_phone==1){?>
							<tr>
								<td bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">휴대폰</td>
								<td align='left' style='padding-left:10px' class='jointable_td'><input name="phone1" type="text" class="formText textphone" maxlength="4" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$mem_row->phone1;?>"> - <input name="phone2" type="text" class="formText textphone" maxlength="4" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$mem_row->phone2;?>"> - <input name="phone3" type="text" class="formText textphone" maxlength="4" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$mem_row->phone3;?>"></td>
							</tr>
							<?}?>
							<?if($admin_stat->member_addr==1){?>
							<tr>
								<td bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">우편번호</td>
								<td align='left' style='padding-left:10px' class='jointable_td'>
								<input name="zip" id="zip" type="text"  class="formText textPost" maxlength="5" readonly style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$mem_row->zip;?>">
								 &nbsp;<a href="javascript:sample2_execDaumPostcode()" class="smallBtn07" title="우편번호검색">우편번호검색</a></td>
							</tr>
							<tr>
								<td bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM">주 소</td>
								<td align='left' style='padding-left:10px' class='addr02'><input name="add1" id="add1" type="text" class="formText textAddr01" value="<?=$mem_row->add1;?>"></td>
							</tr>
							<tr>
								<td bgcolor="F3F3F3" class='jointable_td'>&nbsp;</td>
								<td style='padding-left:10px' class='jointable_td addr02'><input name="add2" type="text"class="formText textAddr01" value="<?=$mem_row->add2;?>"></td>
							</tr>
							<?}?>
							<? if( $admin_row->member_check ) {?>
							<tr>
								<td bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">
									&nbsp;&nbsp;&nbsp;&nbsp;추천인 아이디
								</td>
								<td align='left' style='padding-left:10px' class='jointable_td'>
									<? if($mem_row->recomid) { echo($mem_row->recomid);} else { echo('추천인이 없습니다.');}?>
								</td>
							</tr>
							<? }?>
							<tr>
								<td bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">
									인사말
								</td>
								<td align='left' style='padding-left:10px' class='jointable_td'>
									<div id="comment">
									<fieldset>
										<table>
											<colgroup><col width="*" /><col width="131" /></colgroup>
											<tbody>
												<tr>
													<td><div class="box"><textarea name="content"  class="formText box"><?=$db->stripSlash($mem_row->content);?></textarea></div></td>
												</tr>
											</tbody>
										</table>
									</fieldset>
									</div>
								</td>
							</tr>
							<tr>
								<td bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">
									메일링 서비스
								</td>
								<td align='left' style='padding-left:10px' class='jointable_td'>
									<input name="mailing" type="radio" value="1" <? if($mem_row->mailing==1) { echo('checked');}?> style='vertical-align: -1%;'>받아보겠습니다.&nbsp;<input name="mailing" type="radio" value="0" <? if($mem_row->mailing==0) { echo('checked');}?> style='vertical-align: -1%;padding-left:1em;'>안 받아보겠습니다.
								</td>
							</tr>
							<tr>
								<td  bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">입금계좌</td>
								<td align='left' style='padding:10px;' class='jointable_td'>
									판매대금 입금, 구매대금 환불 등에 필요합니다. <br>
									<span style="display:inline-block">은행 <input name="bank" type="text"  class="formText" style="text-align: center; min-width:150px;" value="<?=$mem_row->bank;?>"></span>
									<span style="display:inline-block">계좌번호 <input name="account_num" type="text"  class="formText" style="text-align: center; min-width:150px;"  value="<?=$mem_row->account_num;?>"></span>
									<span style="display:inline-block">예금주 <input name="account_name" type="text"  class="formText" style="text-align: center; min-width:150px;"  value="<?=$mem_row->account_name;?>"></span>
								</td>
							</tr>							
							</form>
						</table>
						<table STYLE='margin:0 auto;'>
							<tr>
								<td STYLE='padding:20px;'><a href="javascript:sendit();" class="oolimbtn-botton1" style="width:140px">회원정보수정</a>
								</td>
							</tr>
						</table>
					</div>
					<!--********************내용영역 출력 끝********************-->
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->
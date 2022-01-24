<?if($_POST[realname]){	$name = $_POST[realname];	//가입여부 확인	if($db->cnt("cs_member", "where dupinfo='$_POST[dupinfo]' and coinfo1='$_POST[coinfo1]' and coinfo2='$_POST[coinfo2]'"))  $tools->errMsg('이미 회원가입이 되어 있습니다. 확인 후 다시 이용하여 주세요.');}?><div id="layer" style="position:fixed !important;bottom:1px;left: 0px; width: 250px; height: 395px; z-index: 50001; left:40%;top:50%;margin:-190px 0 0 -125px; overflow: hidden;-webkit-overflow-scrolling:touch;display:none;"><img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:2px;top:2px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼"></div><?if(!$_SERVER[HTTPS]){?><script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script><?}else{?><script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script><?}?><script>    // 우편번호 찾기 화면을 넣을 element    var element_layer = document.getElementById('layer');    function closeDaumPostcode() {        // iframe을 넣은 element를 안보이게 한다.        element_layer.style.display = 'none';    }    function sample2_execDaumPostcode() {        new daum.Postcode({            oncomplete: function(data) {                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.                // 각 주소의 노출 규칙에 따라 주소를 조합한다.                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.                var fullAddr = data.address; // 최종 주소 변수                var extraAddr = ''; // 조합형 주소 변수                // 기본 주소가 도로명 타입일때 조합한다.                if(data.addressType === 'R'){                    //법정동명이 있을 경우 추가한다.                    if(data.bname !== ''){                        extraAddr += data.bname;                    }                    // 건물명이 있을 경우 추가한다.                    if(data.buildingName !== ''){                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);                    }                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');                }                // 우편번호와 주소 정보를 해당 필드에 넣는다.				document.getElementById('zip').value = data.zonecode;				document.getElementById('add1').value = fullAddr;
                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)                element_layer.style.display = 'none';            },
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
    function initLayerPosition(){        var width = 300; //우편번호서비스가 들어갈 element의 width        var height = 460; //우편번호서비스가 들어갈 element의 height        var borderWidth = 5; //샘플에서 사용하는 border의 두께        // 위에서 선언한 값들을 실제 element에 넣는다.
        element_layer.style.width = width + 'px';
        element_layer.style.height = height + 'px';
        element_layer.style.border = borderWidth + 'px solid';
        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
       // element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
       // element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
    }
</script>
<script language="javascript">
<!--
// 아이디중복검색	 && 추천인 아이디 검색function idWinOpen(data) {	var form=document.join_form;	if( data == 1 ) {		if(form.userid.value=="") {			document.getElementById('email_page_msg').innerHTML = '회원 아이디를 입력해 주세요.';			form.userid.focus();		} else if(form.userid.value.length < 4 || form.userid.value.length > 21) {			document.getElementById('email_page_msg').innerHTML = '회원 아이디는 4~20자로 입력 주세요.';			form.userid.focus();		} else {			hidden_target.location.href="check_id.iframe.php?userid="+form.userid.value+"&method="+data;		}	} else if( data == 2) {		if(form.recomid.value=="") {			document.getElementById('email_page_msg2').innerHTML = '회원 아이디를 입력해 주세요.';			form.recomid.focus();		} else if(form.recomid.value.length < 4 || form.recomid.value.length > 21) {			document.getElementById('email_page_msg2').innerHTML = '회원 아이디는 4~20자로 입력 주세요.';			form.recomid.focus();		} else {			hidden_target.location.href="check_id.iframe.php?userid="+form.recomid.value+"&method="+data;		}	}}
// 우편번호찾기function postWinOpen(data) {	window.open("post_search.php?method="+data, "","scrollbars=yes, width=500, height=400");}
function sendit() {	var form=document.join_form;	if(form.idch.value=="1") {		alert("아이디 중복체크가 필요합니다.");		form.userid.focus();	} else if(form.userid.value=="") {		alert("회원아이디를 입력해 주세요.");		form.userid.focus();	} else if(form.userid.value.length < 4 || form.userid.value.length > 21) {		alert("회원아이디는 4~20자로 입력 주세요.");		form.userid.focus();	} else if(form.passwd.value=="") {		alert("패스워드를 입력해 주세요.");		form.passwd.focus();	} else if(form.passwd.value.length < 4 || form.passwd.value.length > 21) {		alert("패스워드는 4~20자로 입력 주세요.");		form.passwd.focus();	} else if(form.passwd_check.value=="") {		alert("패스워드확인를 입력해 주세요.");		form.passwd_check.focus();	} else if(form.passwd.value != form.passwd_check.value) {		alert("패스워드가 정확하지 않습니다. 정확히 입력해 주세요.");		form.passwd_check.focus();	} else if(form.name.value=="") {		alert("회원님의 이름을 입력해 주세요.");		form.name.focus();	} else if(form.email.value=="") {		alert("회원님의 E-Mail를 입력해 주세요.");		form.email.focus();	<?if($admin_stat->member_birth==1 && $admin_stat->member_birth_use==1){?>	} else if(form.birthm.value=="" || form.birthy.value=="" || form.birthd.value=="") {		alert("회원님의 생년월일을 선택해 주세요.");		form.birthm.focus();	<?}?>	<?if($admin_stat->member_tel==1 && $admin_stat->member_tel_use==1){?>	} else if(form.tel1.value=="") {		alert("회원님의 전화번호를 입력해 주세요.");		form.tel1.focus();	} else if(form.tel2.value=="") {		alert("회원님의 전화번호를 입력해 주세요.");		form.tel2.focus();	} else if(form.tel3.value=="") {		alert("회원님의 전화번호를 입력해 주세요.");		form.tel3.focus();	<?}?>	<?if($admin_stat->member_phone==1 && $admin_stat->member_phone_use==1){?>	} else if(form.phone1.value=="" || form.phone2.value=="" || form.phone3.value=="") {		alert("회원님의휴대번호를 입력해 주세요.");		form.phone1.focus();	<?}?>
	<?if($admin_stat->member_addr==1 && $admin_stat->member_addr_use==1){?>	} else if(form.zip.value=="") {		alert("회원님의 우편번호를 입력해 주세요.");		form.zip.focus();	} else if(form.zip.value.length != 5) {		alert("회원님의 우편번호 5자리를 입력해 주세요.");		form.zip.focus();	} else if(form.add1.value=="") {		alert("회원님의 주소를 입력해 주세요.");		form.add1.focus();	} else if(form.add2.value=="") {		alert("회원님의 상세주소(번지)를 입력해 주세요.");		form.add2.focus();	<?}?>	} else {		<?if($SECURITYDOMAIN){?>		form.action = "<?=$SECURITYDOMAIN?>/joinform_ok.php?CACHE=1";		<?}else{?>		form.action = "joinform_ok.php?CACHE=1";		<?}?>		form.submit();	}}//--></script><script type="text/javascript">	$(document).ready(function () {		$('ul.necessary input.enter').click(function () {
        $(this).next('span.message').hide();
		});
	});
</script>
<form class="join_form" method="post" name="join_form" enctype="multipart/form-data">	<fieldset>		<input type="hidden" name="dupinfo"  value="<?=$_POST[dupinfo]?>">
		<input type="hidden" name="coinfo1"  value="<?=$_POST[coinfo1]?>">
		<input type="hidden" name="coinfo2"  value="<?=$_POST[coinfo2]?>">
		<input type="hidden" name="ciupdate"  value="<?=$_POST[ciupdate]?>">
		<input type="hidden" name="checktype" value="<?=$_POST[checktype]?>">
		<input type="hidden" name="idch" value="1">		<ul class="necessary">			<li class="tit">필수항목</li>			<!--			<li class='jointable_tdS'></li>
			<li class='jointable_tdS'></li>
			-->
			<li class="user_enter u_id">				<div>					<input name="userid" type="text" class="enter" placeholder="이메일" maxlength="20" onKeyPress="if( ((event.keyCode<48)  && ((event.keyCode<97) || (event.keyCode>123)) ) event.returnValue=false;">					<span class="message">이메일 주소를 입력해 주세요.</span>				</div>				<span class="form_btn" onclick="idWinOpen(1)">중복확인</span>
				<span class="info_text2">이메일 주소를 입력해 주세요.</span>
				<span id="email_page_msg" name="email_page_msg" class="info_text">이메일 주소를 입력후 중복체크해 주세요.</span>
			</li>
			<li class="user_enter u_pw">				<div>					<input name="passwd" type="password" class="enter" maxlength="20" placeholder="비밀번호">					<span class="message">8~16자의 영문/숫자를 조합하여 입력</span>				</div>			</li>
			<li class="user_enter u_pw_check">				<div>					<input name="passwd_check" type="password" class="enter" maxlength="20" placeholder="비밀번호 확인">				</div>			</li>
			<li class="user_enter u_name">				<div>					<input name="name" type="text" class="enter" maxlength="10" placeholder="이름" <?if($admin_stat->realname==2){?>value="<?=$name?>" readonly<?}?>>					<span class="message">한글 15자, 영문 30자까지 가능합니다.</span>				</div>			</li>
			<li class="user_enter u_email">				<div>					<input name="email" type="text" maxlength="40" placeholder="이메일"  style="IME-MODE:disabled" class="email enter" <?if($admin_stat->realname==2){?>value="<?=$email?>" <?}?>>				</div>				<div class="info_text">					이메일을 통해 다양한 정보를 받아보겠습니다. <span><input name="mailing" type="radio" value="1" checked><label>예</label><input name="mailing" type="radio" value="0"><label>아니오</label></span>				</div>			</li>
			<?if($admin_stat->member_tel==1){?>			<li class="user_enter u_phone">				<div>					<input name="tel1" type="text" class="enter textphone" maxlength="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" placeholder="전화번호">					<span class="hyphen">-</span>					<input name="tel2" type="text" class="enter textphone" maxlength="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">					<span class="hyphen">-</span>					<input name="tel3" type="text" class="enter textphone" maxlength="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">				</div>
			</li>			<?}?>
			<?if($admin_stat->member_phone==1){?>
			<li class="user_enter u_phone">
				<div>
					<input name="phone1" type="text" class="enter textphone" maxlength="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" placeholder="휴대폰">
					<span class="hyphen">-</span>
					<input name="phone2" type="text" class="enter textphone" maxlength="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">
					<span class="hyphen">-</span>
					<input name="phone3" type="text" class="enter textphone" maxlength="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">
				</div>
			</li>
			<?}?>
			<li class="user_enter u_addr">
				<div>
					<input name="zip" id="zip" type="text" class="enter textPost" maxlength="5" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" placeholder="주소(우편번호)">
				</div>
				<a href="javascript:sample2_execDaumPostcode()" class="form_btn" title="우편번호검색">우편번호검색</a>
				<div style="width:100%;margin-top:5px">
					<input name="add1" id="add1" type="text" class="enter textAddr01" placeholder="주소">
				</div>				<div style="width:100%;margin-top:5px">					<input name="add2" id="add2" type="text" class="enter textAddr02" placeholder="상세주소">				</div>
			</li>
		</ul>
		<hr/>
		<div class="user_sel">
			<h3>선택항목</h3>
			<dl class="bir">
				<dt>생년월일</dt>
				<dd>
					<select name="birthy" size="1" class="formSelect">
						<option value="">년도 선택</option>
						<?for($i=date("Y")-70;$i<=date("Y");$i++){?>
						<option value="<?=$i?>"><?=$i?></option>
						<?}?>
					</select>
					<select name="birthm" size="1" class="formSelect">
						<option value="">월 선택</option>
						<?for($i=1;$i<=12;$i++){?>
						<option value="<?=$i?>"><?=$i?></option>
						<?}?>
					</select>
					<select name="birthd" size="1" class="formSelect">
						<option value="">일 선택</option>
						<?for($i=1;$i<=31;$i++){?>
						<option value="<?=$i?>"><?=$i?></option>
						<?}?>
					</select>
				</dd>
			</dl>			<dl class="sex">				<dt>성별</dt>				<dd>					<input type="radio" name="sex" checked><label>남</label>					<input type="radio" name="sex"><label>여</label>				</dd>			</dl>			<?/*			<dl class="interlock">				<dt>SNS 연동</dt>				<dd>					<a href="#" class="naver"><img src="images/sns_i_naver.gif"/><span>네이버 로그인</span></a>					<a href="#" class="kakao"><img src="images/sns_i_kakao.gif"/><span>카카오 계정 로그인</span></a>					<a href="#" class="facebook"><img src="images/sns_i_facebook.gif"/><span>페이스북 로그인</span></a>					<a href="#" class="google"><img src="images/sns_i_google.gif"/><span>구글 로그인</span></a>				</dd>			</dl>			*/?>		</div>		<hr/>		<div class="join_bottom_btn">			<a href="javascript:sendit();" class="btn1">가입하기</a>			<a href="index.php" class="btn2">취소</a>		</div>	</fieldset></form>
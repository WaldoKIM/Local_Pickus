<script type="text/javascript">
function payOrder(mode) {
	if(mode=='Y') {
		document.getElementById("mootong1").style.display="block";
		document.getElementById("mootong2").style.display="none";
	} else if(mode=='N') {
		document.getElementById("mootong1").style.display="none";
		document.getElementById("mootong2").style.display="block";
	} 
}
function isForeign(mode) {
	if(mode=='Y') {
		document.getElementById("foreign1").style.display="block";
		document.getElementById("foreign2").style.display="none";
	} else if(mode=='N') {
		document.getElementById("foreign1").style.display="none";
		document.getElementById("foreign2").style.display="block";
	} 
}

function certKCBIpin(){
	var form=document.namecheck;
	<?if($admin_stat->sirenid){?>
	if(document.all.agreecheck[0].checked!=true){
		alert("이용약관에 동의하여 주세요.");
		return;
	}else if(document.all.useragreecheck[0].checked!=true){
		alert("개인정보취급방침에 동의하여 주세요.");
		return;
	} else {
		var popupWindow = window.open( "", "kcbPop", "left=200, top=100, status=0, width=450, height=550" );
		document.kcbInForm.target = "kcbPop";

		//KCB 테스트서버를 호출할 경우
		<?if($IPINMODE=="T"){?>
		document.kcbInForm.action = "https://tipin.ok-name.co.kr:8443/tis/ti/POTI01A_LoginRP.jsp";
		<?}else{?>
		//KCB 운영서버를 호출할 경우
		document.kcbInForm.action = "https://ipin.ok-name.co.kr/tis/ti/POTI01A_LoginRP.jsp";
		<?}?>
		
		document.kcbInForm.submit();
		popupWindow.focus();	
		return;	
	}
	<?}else{?>
		alert("실명관련 및 아이핀 설정이 되어 있지 않습니다.");
	<?}?>
}
function agreeSendit() {
	var form=document.namecheck;
	<?if($admin_stat->sirenid){?>
	if(document.all.agreecheck[0].checked!=true){
		alert("이용약관에 동의하여 주세요.");
		return;
	}else if(document.all.useragreecheck[0].checked!=true){
		alert("개인정보취급방침에 동의하여 주세요.");
		return;
	}else if(form.name1.value=="" && form.name2.value==""){
		alert("실명확인을 위한 이름을 남겨 주세요.");
		return;
	}else if(form.qryKndCd[0].checked==true && (form.ssni1.value=="" || form.ssni2.value=="")){
		alert("실명확인을 위한 주민번호를 남겨 주세요.");
		return;
	}else if(form.qryKndCd[1].checked==true && (form.ssno1.value=="" || form.ssno2.value=="")){
		alert("실명확인을 위한 외국인등록번호를 남겨 주세요.");
		return;
	} else {
		form.submit();			
	}
	<?}else{?>
		alert("실명관련 및 아이핀 설정이 되어 있지 않습니다.");
	<?}?>
}

</script>	
<?
	if($IPINMODE=="T"){
		$idpUrl    = "https://tipin.ok-name.co.kr:8443/tis/ti/POTI90B_SendCertInfo.jsp";
	}else{
		$idpUrl    = "https://ipin.ok-name.co.kr/tis/ti/POTI90B_SendCertInfo.jsp";		//실서버 운영시
	}
	$returnUrl = "http://".$_SERVER["SERVER_NAME"].$trueSubDir."/ipin/ipin_step1.php";		// 아이핀 인증을 마치고 돌아올 페이지 주소

	//KCB 운영서버를 호출할 경우
	//$idpUrl    = "https://ipin.ok-name.co.kr/tis/ti/POTI90B_SendCertInfo.jsp";
	//$returnUrl = "http://test.ok-name.co.kr:9080/tis/test/return_case.jsp";

	$idpCode   = "V";					// 고정값. KCB기관코드
	if($IPINMODE=="T"){
		$cpCode = "P00000000000";
	}else{
		$cpCode = $admin_stat->sirenid;            // *** 회원사코드
	}

	$exe = $ROOT_DIR."/ipin/okname";	// 모듈 위치
	$keypath = $ROOT_DIR."/ipin/key/okname.key";			// 키파일이 생성될 위치. 웹서버에 해당파일을 생성할 권한 필요.
	$memid = $cpCode;			// 회원사코드
	$reserved1 = "0";			//reserved1
	$reserved2 = "0";			//reserved2
	if($IPINMODE=="T"){
		$EndPointURL = "http://tallcredit.kcb4u.com:9088/KcbWebService/OkNameService";//EndPointURL, 테스트 서버
	}else{
		$EndPointURL = "http://www.allcredit.co.kr/KcbWebService/OkNameService";// 운영 서버
	}
	$logpath = $ROOT_DIR."/ipin/log";					// 로그파일을 남기는 경우 로그파일이 생성될 경로
	$option = "CL";// Option

	// 명령어
	$cmd = "$exe $keypath $memid \"{$reserved1}\" \"{$reserved2}\" $EndPointURL $logpath $option";
	// 실행
	exec($cmd, $out, $ret);
	
	$pubkey = "";
	$sig = "";
	$curtime = "";
	
	$pubkey=$out[0];
	$sig=$out[1];
	$curtime=$out[2];
?>
<form name="kcbInForm" method="post" >
  <input type="hidden" name="IDPCODE" value="<?=$idpCode?>" />
  <input type="hidden" name="IDPURL" value="<?=$idpUrl?>" />
  <input type="hidden" name="CPCODE" value="<?=$cpCode?>" />
  <input type="hidden" name="CPREQUESTNUM" value="<?=$curtime?>" />
  <input type="hidden" name="RETURNURL" value="<?=$returnUrl?>" />
  <input type="hidden" name="WEBPUBKEY" value="<?=$pubkey?>" />
  <input type="hidden" name="WEBSIGNATURE" value="<?=$sig?>" />
</form>
<form name="kcbOutForm" method="post">
  <input type="hidden" name="encPsnlInfo" />
  <input type="hidden" name="virtualno" />
  <input type="hidden" name="dupinfo" />
  <input type="hidden" name="realname" />
  <input type="hidden" name="cprequestnumber" />
  <input type="hidden" name="age" />
  <input type="hidden" name="sex" />
  <input type="hidden" name="nationalinfo" />
  <input type="hidden" name="birthdate" />
  <input type="hidden" name="coinfo1" />
  <input type="hidden" name="coinfo2" />
  <input type="hidden" name="ciupdate" />
  <input type="hidden" name="cpcode" />
  <input type="hidden" name="authinfo" />
  <input type="hidden" name="checktype" value="2">
</form>
<form name="namecheckOk" method="post" action="joinform.php">
  <input type="hidden" name="name">
  <input type="hidden" name="checktype" value="1">
</form>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<!-- width 값 조절-->
<tr>
	<td>
		<!--실명,아이핀 라디오버튼 시작 -->
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#333333" style="padding:0 0 0 10" >
		<tr>
			<td height="35" bgcolor="#696969" >
				<?if($admin_stat->realname==1 || $admin_stat->realname==3){?>
				<input name="isNormal" type="radio" value="1" onClick="payOrder('Y')"  checked="checked"  >
				<span style="font-size:12pt;"><b><font color='ffffff'>실명확인</font></b></span>
				<?}?>
				<?if($admin_stat->realname==2 || $admin_stat->realname==3){?>
				<input name="isNormal" type="radio" value="2" onClick="payOrder('N')"  checked="checked" >
				<span style="font-size:12pt;"><b><font color='ffffff'>아이핀인증</font></b></span>
				<?}?>
			</td>
		</tr>
		</table>
		<!--실명,아이핀 라디오버튼 끝 -->
	</td>
</tr>
<tr>
	<td>
		<!--국적라디오버튼-->
		<div id="mootong1">
			<form name="namecheck" method="post" target="hidden_frame" action="../ipin/okname.php">
			<table cellpadding="0" cellspacing="0" border="0" style="padding:10 0 5 0" align="center">
			<tr>
				<td width="100">
					<input name="qryKndCd" type="radio" value="1" onClick="isForeign('Y')"  checked="checked" >
					<img src="../ipin/img/text_member.gif" align="middle">
				</td>
				<td width="100">
					<input name="qryKndCd" type="radio" value="2" onClick="isForeign('N')" >
					<img src="../ipin/img/text_foreigner.gif" align="middle">
				</td>
			</tr>
			</table>
			<!--국적라디오버튼끝-->
			<!--일반회원-->
			<!--input영역-->
			<div id="foreign1">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td width="5px"><img src="../ipin/img/left_bg.gif" border="0"></td>
					<td background="../ipin/img/box_bg.gif">
						<table cellpadding="0" cellspacing="0" border="0" align="center">
						<tr>
							<td><img src="../ipin/img/text_name.gif" align="middle"></td>
							<td><input name="name1" type="text"></td>
						</tr>
						<tr>
							<td colspan="2" height="7"></td>
						</tr>
						<tr>
							<td style="padding:0 20 0 0"><img src="../ipin/img/text_inhabitants.gif" align="middle"></td>
							<td>
								<input name="ssni1" type="text">
								-
								<input name="ssni2" type="password">
							</td>
						</tr>
						</table>
					</td>
					<td width="5px"><img src="../ipin/img/right_bg.gif" border="0"></td>
				</tr>
				</table>
				<!--input영역끝-->
				<!--버튼-->
				<table cellpadding="20" cellspacing="0" border="0" width="100%">
				<tr>
					<td align="center"><a href="javascript:agreeSendit()" onFocus="this.blur()"><img src="../ipin/img/btn.gif" border="0"></a></td>
				</tr>
				</table>
				<!--버튼끝-->
				<!--text-->
				<table cellspacing="0" border="0" width="100%">
				<tr>
					<td valign="top" width="18"><img src="../ipin/img/icon.gif" border="0"></td>
					<td align="left" style="padding:0 0 5 0">
						<font style="font-size:11px; color:#777777; font-family:돋움;letter-spacing:-1px; line-height:150%;">회원가입을
						하시는 분의 정확한 성명과 주민등록번호를 입력해 주세요. <br>
						본 서비스는 신용평가회사인 KCB가 제공합니다. <a href="http://www.ok-name.co.kr/acs/on/personreg/reg_personServiceIntro.jsp?menu_id=1&submenu_id=1" onFocus="this.blur()" target="_blank"><font color="#3366cc">
						실명오류 시 바로가기</font></a></font>
					</td>
				</tr>
				<tr>
					<td></td>
					<td align="left">
						<font style="font-size:11px; color:#777777; font-family:돋움;letter-spacing:-1px; line-height:150%;">2006년
						9월 25일부터 개정된 '주민등록법'에 의해 타인의 주민등록번호를 도용하여 온라인 회원가입을 하는 등 <br>
						다른 사람의 주민등록번호를 부정사용하는자는 3년 이하의 징역 또는 1천만원 이하의 벌금이 부과될 수<br>
						있습니다.</font>
					</td>
				</tr>
				</table>
			</div>
			<!--text-->
			<!--일반회원끝-->


			<!--외국안회원-->
			<!--input영역-->
			<div id="foreign2" style="display:none">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td width="5px"><img src="../ipin/img/left_bg.gif" border="0"></td>
					<td background="../ipin/img/box_bg.gif">
						<table cellpadding="0" cellspacing="0" border="0" align="center">
						<tr>
							<td><img src="../ipin/img/text_name.gif" align="middle"></td>
							<td><input name="name2" type="text"></td>
						</tr>
						<tr>
							<td colspan="2" height="7"></td>
						</tr>
						<tr>
							<td style="padding:0 20 0 0"><img src="../ipin/img/text_inhabitants02.gif" align="middle"></td>
							<td>
								<input name="ssno1" type="text">
								-
								<input name="ssno2" type="password">
							</td>
						</tr>
						</table>
					</td>
					<td width="5px"><img src="../ipin/img/right_bg.gif" border="0"></td>
				</tr>
				</table>
				<!--input영역끝-->
				<!--주석-->
				<table cellspacing="0" border="0" width="100%">
				<tr>
					<td height="5" colspan="2"></td>
				</tr>
				<tr>
					<td width="10" style="padding:0 0 0 7"><img src="../ipin/img/star.gif" border="0" align="middle"></td>
					<td><font style="font-size:11px; color:#777777; font-family:돋움;letter-spacing:-1px; line-height:150%;">한글/영문 대문자로 입력하세요.</font></td>
				</tr>
				</table>
				<!--주석-->
				<!--버튼-->
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td align="center" style="padding:0 0 20 0"><a href="javascript:agreeSendit()" onFocus="this.blur()"><img src="../ipin/img/btn.gif" border="0"></a></td>
				</tr>
				</table>
				<!--버튼끝-->
				<!--text-->
				<table cellspacing="0" border="0" width="100%">
				<tr>
					<td valign="top" width="18"><img src="../ipin/img/icon.gif" border="0"></td>
					<td align="left" style="padding:0 0 5 0">
						<font style="font-size:11px; color:#777777; font-family:돋움;letter-spacing:-1px; line-height:150%;">대한민국에서
						발급한 외국인등록증에 명시된 ‘성명’과 ‘외국인등록번호’를 정확하게 입력해 주세요. <br>
						성명 입력 시 외국인등록증에 쓰여진 순서대로 띄어쓰기를 포함하여 동일하게 입력해 주기기 바랍니다.</font>
					</td>
				</tr>
				</table>
				</form>
				<!--text-->
			</div>
			<!--외국안회원끝-->
		</div>


		<!-- I-Pin인증 시작-->
		<div id="mootong2" style="display:none;">
			<table cellpadding="0" cellspacing="0" border="0" width="100%"  style="margin-top:15px;">
			<tr>
				<td width="5px"><img src="../ipin/img/left_bg.gif" border="0"></td>
				<td background="../ipin/img/box_bg.gif">
					<table cellspacing="0" border="0" width="100%">
					<tr>
						<td width="13" valign="top" style="padding:0 0 0 7"><img src="../ipin/img/star.gif" alt="" border="0" align="top"></td>
						<td width="538" align="left" style="padding:0 0 5 0"><font style="font-size:11px; color:#777777; font-family:돋움;letter-spacing:-1px; line-height:150%;">아이핀이란 주민등록번호 대체수단으로 인터넷 사이트에 주민등록번호를 입력하지 않고 회원가입을 할 수 있도록<br> 지원합니다.&nbsp;&nbsp;<a href="http://www.ok-name.co.kr/acs/on/companyipin/ipin_companyRegForm.jsp?menu_id=4&sebmenu_id=5" onFocus="this.blur()" target="_blank"><font color="#3366cc">아이핀 발급 받기</font></a></font></td>
					</tr>
					<tr>
						<td width="13" valign="top" style="padding:0 0 0 7"><img src="../ipin/img/star.gif" alt="" border="0" align="top"></td>
						<td align="left" style="padding:0 0 5 0">
							<font style="font-size:11px; color:#777777; font-family:돋움;letter-spacing:-1px; line-height:150%;">아이핀 인증으로 가입 시 아이핀 인증기관을 통해 실명인증을 받게 되므로 회원님의 주민등록번호가 저장되지 않습니다. </font>
						</td>
					</tr>
					</table>
				</td>
				<td width="5px"><img src="../ipin/img/right_bg.gif" border="0"></td>
			</tr>
			</table>
			<!--버튼-->
			<table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-top:15px;">
			<tr>
				<td align="center" style="padding:0 0 20 0"><a href="javascript:certKCBIpin()" onFocus="this.blur()"><img src="../ipin/img/btn_ipin.gif" border="0"></a></td>
			</tr>
			</table>
			<!--버튼끝-->
		</div>
		<!-- I-Pin인증 끝-->
	</td>
</tr>
</table>
<iframe src='' name='hidden_frame' style="display:none"></iframe>
<?
if($admin_stat->realname==1 || $admin_stat->realname==3) echo "<script language='javascript'> payOrder('Y') </script>";
else if($admin_stat->realname==2)  echo "<script language='javascript'> payOrder('N') </script>";
?>

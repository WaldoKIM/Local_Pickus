<?
	include('../common.php');
	//아이핀팝업에서 조회한 PERSONALINFO이다.
	@$encPsnlInfo = $_POST["encPsnlInfo"];
	
	//KCB서버 공개키
	@$WEBPUBKEY = trim($_POST["WEBPUBKEY"]);
	//KCB서버 서명값
	@$WEBSIGNATURE = trim($_POST["WEBSIGNATURE"]);
  
	/*
	echo "$encPsnlInfo<br>";
	echo "$WEBPUBKEY<br>";
	echo "$WEBSIGNATURE<br>";
	*/
  
	//아이핀 서버와 통신을 위한 키파일 생성
	// 파라미터 정의
	$exe = $ROOT_DIR."/ipin/okname";
	$keypath = $ROOT_DIR."/ipin/key/okname.key";
	if($IPINMODE=="T"){
		$cpCode = "P00000000000";
	}else{
		$cpCode    = $admin_stat->sirenid;			//중복가입확인정보 생성을 위한 사이트 식별번호(회원사아이디를 사용)
	}

	if($IPINMODE=="T"){
		$EndPointURL = "http://tallcredit.kcb4u.com:9088/KcbWebService/OkNameService";//EndPointURL, 테스트 서버
	}else{
		$EndPointURL = "http://www.allcredit.co.kr/KcbWebService/OkNameService";// 운영 서버
	}
	$cpubkey = $WEBPUBKEY;       //server publickey
	$csig = $WEBSIGNATURE;    //server signature
	$encdata = $encPsnlInfo;     //PERSONALINFO
	$logpath = $ROOT_DIR."/ipin/log";
	$option = "SL";
		
	// 명령어
	$cmd = "$exe $keypath $cpCode $EndPointURL $cpubkey $csig $encdata $logpath $option";
	
	// (I모드의 경우, K모드로 암호화 한 경우만 사용)
	//$exe = "d:\\okname\\bin\\win32\\exe\\okname";
	//$keypath = "d:\\okname\\src\\okname.key";
	//$cpubkey = $WEBPUBKEY;       //server publickey
	//$csig = $WEBSIGNATURE;    //server signature
	//$encdata = $encPsnlInfo;     //PERSONALINFO
	//$logpath = "d:\\okname\\src\\";
	//$option = "IL";	
	//$cmd = "$exe $keypath $cpubkey $csig $encdata $logpath $option"; // I모드일 경우
	
	
	// 실행
	exec($cmd, $out, $ret);
	
	// 결과라인에서 값을 추출
	foreach($out as $a => $b) {
		if($a < 13) {
			$field[$a] = $b;
		}
	}
/*
	$field_name_IPIN_DEC = array(
		"dupInfo        ",	// 0
		"coinfo1        ",	// 1
		"coinfo2        ",	// 2
		"ciupdate       ",	// 3
		"virtualNo      ",	// 4
		"cpCode         ",	// 5
		"realName       ",	// 6
		"cpRequestNumber",	// 7
		"age            ",	// 8
		"sex            ",	// 9
		"nationalInfo   ",	// 10
		"birthDate      ",	// 11
		"authInfo       ",	// 12
	);
	
echo "encPsnlInfo=$encPsnlInfo<br>";	
	// 추출된 값 프린트
foreach($field as $a => $b) {
	echo $field_name_IPIN_DEC[$a].": ".$field[$a]."<br>";
}
*/

?>
<html>
<head>
<script language="JavaScript">
function fncOpenerSubmit() {
	opener.document.kcbOutForm.encPsnlInfo.value = document.dForm.encPsnlInfo.value;
	opener.document.kcbOutForm.dupinfo.value = document.dForm.dupinfo.value;
	opener.document.kcbOutForm.coinfo1.value = document.dForm.coinfo1.value;
	opener.document.kcbOutForm.coinfo2.value = document.dForm.coinfo2.value;
	opener.document.kcbOutForm.ciupdate.value = document.dForm.ciupdate.value;
	opener.document.kcbOutForm.virtualno.value = document.dForm.virtualno.value;
	opener.document.kcbOutForm.cpcode.value = document.dForm.cpcode.value;
	opener.document.kcbOutForm.realname.value = document.dForm.realname.value;
	opener.document.kcbOutForm.cprequestnumber.value=document.dForm.cprequestnumber.value;
	opener.document.kcbOutForm.age.value = document.dForm.age.value;
	opener.document.kcbOutForm.sex.value = document.dForm.sex.value;
	opener.document.kcbOutForm.nationalinfo.value = document.dForm.nationalinfo.value;
	opener.document.kcbOutForm.birthdate.value = document.dForm.birthdate.value;
	opener.document.kcbOutForm.authinfo.value = document.dForm.authinfo.value;
	opener.document.kcbOutForm.action = "joinform.php";
	opener.document.kcbOutForm.submit();
	self.close();
}
</script>
</head>
<body onLoad="javascript:fncOpenerSubmit();">
<form name="dForm" method="post">
  <input type="hidden" name="encPsnlInfo" 	value ="<?=$encPsnlInfo ?>" />
  <input type="hidden" name="dupinfo" 		value="<?=$field[0]?>" />
  <input type="hidden" name="coinfo1" 		value="<?=$field[1]?>" />
  <input type="hidden" name="coinfo2" 		value="<?=$field[2]?>" />
  <input type="hidden" name="ciupdate" 		value="<?=$field[3]?>" />
  <input type="hidden" name="virtualno"  	value="<?=$field[4]?>" />
  <input type="hidden" name="cpcode"        value="<?=$field[5]?>" />
  <input type="hidden" name="realname" 		value="<?=$field[6]?>" />
  <input type="hidden" name="cprequestnumber"	 value="<?=$field[7]?>" />
  <input type="hidden" name="age" 			value="<?=$field[8]?>" />
  <input type="hidden" name="sex" 			value="<?=$field[9]?>" />
  <input type="hidden" name="nationalinfo" 	value="<?=$field[10]?>" />
  <input type="hidden" name="birthdate" 	value="<?=$field[11]?>" />
  <input type="hidden" name="authinfo"      value="<?=$field[12]?>" />
</form>
</body>
</html>

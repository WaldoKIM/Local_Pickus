<?
	include('../common.php');

	$_POST=&$HTTP_POST_VARS;
	if($_POST[qryKndCd]==1){
		$name = $_POST[name1];                     // *** 성명
		$ssn = $_POST[ssni1].$_POST[ssni2];               // *** 주민번호 (숫자만)
	}else{
		$name = $_POST[name2];                     // *** 성명
		$ssn = $_POST[ssno1].$_POST[ssno2];               // *** 주민번호 (숫자만)
	}

	if($IPINMODE=="T"){
		$memid = "P00000000000";
	}else{
		$memid = $admin_stat->sirenid;            // *** 회원사코드
	}
    $qryBrcCd = "x"; 
    $qryBrcNm = "x"; 
    $qryId = "u1234";                   // 쿼리ID, 고정값 
    $qryKndCd = $_POST[qryKndCd];                    // 요청구분  내국인,주민등록번호 : 1, 외국인,외국인등록번호 : 2 
    $qryRsnCd = "01";                   // 조회사유  회원가입 : 01, 회원정보수정 : 02, 회원탈회 : 03, 성인인증 : 04, 기타 : 05
    $qryIP = "x";                       // *** 회원사 IP,   $_SERVER["SERVER_ADDR"] 사용가능.
    $qryDomain = $_SERVER["SERVER_NAME"];          // *** 회원사 도메인, $_SERVER["SERVER_NAME"] 사용가능.
    //** 서버의 환경변수는 설정에 따라 작동하지 않을 수 있습니다. 테스트후 사용바랍니다. **/
    $qryDt = date("Ymd");               // 현재일자 20101101 과 같이 숫자8자리 입력되어야함.
    if($IPINMODE=="T"){
		$EndPointURL  = "http://tallcredit.kcb4u.com:9088/KcbWebService/OkNameService"; 
	}else{
		$EndPointURL  = "http://www.okname.co.kr/KcbWebService/OkNameService"; // *** (운영계적용시) 
	}
    $Option = "D";                      // utf-8인경우는 U추가, D: debug mode, L: log 기록.
    
    // ***절대경로*를 포함한 모듈명. 리눅스,유닉스계열은 확장자가 붙지 않습니다. 모듈에 실행권한 추가할 것.
	$exe = $ROOT_DIR."/ipin/okname";
    
    // 모듈호출명령어
    $cmd="{$exe} \"{$name}\" \"{$ssn}\" $memid $qryBrcCd $qryBrcNm $qryId $qryKndCd $qryRsnCd $qryIP $qryDomain $qryDt $EndPointURL $Option";

    
    exec($cmd, $out, $ret);
    
    if($ret <=200)
        $result=sprintf("B%03d", $ret);
    else
        $result=sprintf("S%03d", $ret);
    


    if( $result=='B000'){
        // 정상적으로 인증이 완료된 경우의 처리
       echo "<script language='javascript'>alert('실명인증이 완료되었습니다.');\n parent.document.namecheckOk.name.value='$name';\n parent.document.namecheckOk.submit(); </script>";
        
    }else if( $result=='B001' ){        
        // 주민등록번호가 존재하지 않는 경우. ok-name.co.kr 에서 실명등록을 할 수 있게함.
        // 주민번호가 없어 인증이 되지 않은 것으로 인증실패로 처리해야 합니다.
        // 스크립트와 해당 페이지를 복사해서 사용하셔도 됩니다. 해당 페이지는 메뉴얼에 포함되어있습니다.
?>
        <script src="http://www.ok-name.co.kr/member/js/okname.js" type="text/javascript" language="javascript1.5" ></script>
        <script>
         KCB_okNameGuide();
        </script>
<?php  
    }else if( $result=='B016' ){        
        // 명의보호서비스에 가입된 경우 인증창으로 유도합니다.(준비중)        
?>    
        <script src="http://www.ok-name.co.kr/member/js/okname.js" type="text/javascript" language="javascript1.5" ></script>
        <script>
            KCB_BlockedName();
        </script>
<?php  
    }else{
        // 정상적으로 인증이 되지 않은 경우의 처리.
       echo "<script language='javascript'>alert('정확한 실명과 주민번호를 이용하여 주세요.'); </script>";
	}
?>
</body>
</html>

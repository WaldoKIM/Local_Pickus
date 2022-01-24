<?
	include('../../common.php');
	
	//$_POST=&$HTTP_POST_VARS;
	
	// 디비입력 쿼리
	$sql="smsid='$_POST[smsid]', smspw='$_POST[smspw]', smsnumber='$_POST[smsnumber]', smsinputnumber='$_POST[smsinputnumber]'";
	
	// 디비입력
	if($db->update("cs_sms_setup", $sql) ) {
		$tools->alertJavaGo("저장 완료 되었습니다.", "smspage.php");
	}else{
		$tools->errMsg('비상적으로 입력 되었습니다.');
	}
?>

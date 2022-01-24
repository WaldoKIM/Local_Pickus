<?
	include('../../common.php');
	
	//$_POST=&$HTTP_POST_VARS;
	
	// 디비입력 쿼리
	$sql="securityuse='$_POST[securityuse]', securityport='$_POST[securityport]'";
	
	// 디비입력
	if($db->update("cs_security_setup", $sql) ) {
		if($_POST[securityuse]==1) $db->update("cs_admin","frametype=0");
		$tools->alertJavaGo("저장 완료 되었습니다.", "securitypage.php");
	}else{
		$tools->errMsg('비상적으로 입력 되었습니다.');
	}
?>

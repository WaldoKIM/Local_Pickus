<?
	include('../../common.php');
	
	//$_POST=&$HTTP_POST_VARS;
	if($_GET[del]==1){
		if($db->delete("cs_zip_over", "where idx='$_GET[idx]'")) $tools->javaGo("overexpress.iframe.php");
	}else{
		if($db->cnt("cs_zip_over", "where zip='$_POST[zip]'")) $tools->alertJavaGo("우편번호가 존재합니다. 다시확인후 등록하세요.", "overexpress.iframe.php");
		// 디비입력 쿼리
		$sql="zip='$_POST[zip]', content='$_POST[content]'";
		
		// 디비입력
		$db->insert("cs_zip_over", $sql) ;
		$tools->javaGo("overexpress.iframe.php");
	}
?>

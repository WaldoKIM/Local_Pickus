<?
include('../../common.php'); 
if($_GET["mode"] )					{ $mode = $_GET["mode"]; }									else { $mode = $_POST["mode"]; }

if($mode=="I"){
	// 디비입력 쿼리
	$sql="bank_name='$_POST[bank_name]', bank_account='$_POST[bank_account]', name='$_POST[name]', main_marking='$_POST[main_marking]'";
	if( $db->insert("cs_banklist", $sql) ) {
		$tools->alertJavaGo("저장 완료 되었습니다.", "account_page.php?#bank"); 
	} else {
		$tools->errMsg('비상적으로 입력 되었습니다.'); 
	}
}else if($mode=="E"){
	// 디비수정 쿼리
	$sql="bank_name='$_POST[bank_name]', bank_account='$_POST[bank_account]', name='$_POST[name]', main_marking='$_POST[main_marking]' where idx='$_POST[bankIdx]'";
	if( $db->update("cs_banklist", $sql) ) {
		$tools->alertJavaGo("수정 완료 되었습니다.", "account_page.php?#bank");
	} else {
		$tools->errMsg('비상적으로 입력 되었습니다.'); 
	}
}else if($mode=="D"){
	if( $db->delete("cs_banklist", "where idx='$_GET[bankIdx]'") ) {
		$tools->alertJavaGo("삭제 완료 되었습니다.", "account_page.php?#bank");
	} else {
		$tools->errMsg('비상적으로 입력 되었습니다.'); 
	}
}
// 디비입력
?>

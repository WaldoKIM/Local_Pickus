<?
include('../../common.php'); 
//if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}
//$_POST=&$HTTP_POST_VARS;
//$_GET=&$HTTP_GET_VARS;


if($_POST[mode]=="add"){
	$sql = "name='$_POST[name]', content='$_POST[content]', direct='$_POST[direct]'";
	// 디비 입력
	If( $db->insert("cs_user_list", $sql)) { $tools->alertJavaGo("저장 완료 되었습니다.", "user_list.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }
}elseif($_POST[mode]=="edit"){
	$sql = "name='$_POST[name]', content='$_POST[content]', direct='$_POST[direct]' where idx='$_POST[idx]'";
	// 디비 입력
	If( $db->update("cs_user_list", $sql)) { $tools->alertJavaGo("수정 완료 되었습니다.", "user_list.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }
}else{
	$sql = "where idx='$_GET[idx]'";
	// 디비 입력
	If( $db->delete("cs_user_list", $sql)) { $tools->alertJavaGo("삭제 완료 되었습니다.", "user_list.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }
}
?>

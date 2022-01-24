<?
include('../../common.php'); 
// with KJS dance
//if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}

//$_POST=&$HTTP_POST_VARS;
	
	// 디비입력 쿼리
	$sql="member_tel='$_POST[member_tel]', member_phone='$_POST[member_phone]', member_addr='$_POST[member_addr]', member_birth='$_POST[member_birth]', member_tel_use='$_POST[member_tel_use]', member_phone_use='$_POST[member_phone_use]', member_addr_use='$_POST[member_addr_use]', member_birth_use='$_POST[member_birth_use]', badid='$_POST[badid]', realname='$_POST[realname]', sirenid='$_POST[sirenid]'";

	// 디비입력
	if( $db->update("cs_admin", $sql) ) {
		$tools->alertJavaGo("저장 완료 되었습니다.", "basic_setup_member.php");
	} else {
		$tools->errMsg('비상적으로 입력 되었습니다.'); 
	}
?>

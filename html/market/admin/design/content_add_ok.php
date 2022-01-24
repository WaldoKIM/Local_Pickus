<?
include('../../common.php'); 
//admin 접근제어
//if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$_FILES=&$HTTP_POST_FILES;

if( $_POST[name] ) {	
	//순위
	$rank = $db->object("cs_mobile_main", "", "max(ranking)as ranking");
	if(!$rank->ranking) $rankNum = 1; else $rankNum = $rank->ranking + 1;

	// 디비 입력
	$sql="
	name='$_POST[name]', 
	linkurl='$_POST[linkurl]', 
	open='$_POST[open]', 
	ranking='$rankNum', 
	icon='$_POST[sub_list_img1]'
	";

	if( $db->insert("cs_mobile_main", $sql) ) {
		$tools->alertJavaGo('등록 되었습니다.', 'content.php'); 
	} else {
		$tools->errMsg('비상적으로 입력 되었습니다.');
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;

if( $_POST[title] ) {	
	$_POST[title] = $db->stripSlash ( $_POST[title] );
	//$_POST[content] = $db->stripSlash ( $_POST[content] );
	$_POST[title] = $db->addSlash ( $_POST[title] );
	//$_POST[content] = $db->addSlash ( $_POST[content] );
	// 디비 입력
	if( $db->update("cs_mailform", "title='$_POST[title]', tag='$_POST[tag]', content='$_POST[content]' where item='$_POST[item]'")) { $tools->javaGo('mailform.php?item='.$_POST[item]); } else { $tools->errMsg('메일 폼 등록에러');}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

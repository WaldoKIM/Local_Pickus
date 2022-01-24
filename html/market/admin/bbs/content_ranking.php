<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$_FILES=&$HTTP_POST_FILES;

//분류정리
for($j=0;$j<sizeof($_POST[ranking]);$j++) {
	$db->update("cs_bbs_sns", "ranking='".$_POST[ranking][$j]."' where idx='".$_POST[idx][$j]."'");
} 
$tools->javaGo("content.php");
?>

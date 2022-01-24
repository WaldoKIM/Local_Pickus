<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

//분류정리
for($j=0;$j<sizeof($_POST[part_ranking]);$j++) {
	$db->update("cs_part_fixed", "part_ranking='".$_POST[part_ranking][$j]."' where idx='".$_POST[idx][$j]."'");
} 
$tools->javaGo("specialcate.php");
?>

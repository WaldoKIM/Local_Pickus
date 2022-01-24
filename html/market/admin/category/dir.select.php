<?
//$_GET=&$HTTP_GET_VARS;
include('../../common.php');
$db->update("cs_page", "position=$_GET[value] where idx=$_GET[idx]");
?>

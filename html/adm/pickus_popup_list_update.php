<?php
$sub_menu = "300150";
include_once("./_common.php");


$qstr = '';
$qstr .= 'page=' . urlencode($page);
$sql = " update {$g5['popup_table']} set state = '$state' where idx= '".$idx."' ";
sql_query($sql);
//echo $sql;
$msg = "대기하였습니다.";
if($state){
	$msg = "게시하였습니다.";
}
alert($msg,"./pickus_popup_list.php?".$qstr);
?>

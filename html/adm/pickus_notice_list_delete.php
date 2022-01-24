<?php
$sub_menu = "300110";
include_once("./_common.php");


$qstr = '';
$qstr .= 'page=' . urlencode($page);
$sql = " delete from {$g5['notice_table']} where idx= '".$idx."' ";
sql_query($sql);
//echo $sql;
alert("삭제하였습니다.","./pickus_notice_list.php?".$qstr);
?>

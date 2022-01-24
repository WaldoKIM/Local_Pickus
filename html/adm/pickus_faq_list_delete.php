<?php
$sub_menu = "300130";
include_once("./_common.php");


$qstr = '';
$qstr .= 'page=' . urlencode($page);
$sql = " delete from {$g5['faq_table']} where fa_id= '".$fa_id."' ";
sql_query($sql);
//echo $sql;
alert("삭제하였습니다.","./pickus_faq_list.php?".$qstr);
?>

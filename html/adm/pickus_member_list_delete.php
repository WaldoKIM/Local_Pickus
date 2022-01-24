<?php
$sub_menu = "200110";
include_once("./_common.php");


$qstr = '';
$qstr .= 'sme=' . urlencode($sme);
$qstr .= '&amp;snn=' . urlencode($snn);
$qstr .= '&amp;shp=' . urlencode($shp);
$qstr .= '&amp;sfd=' . urlencode($sfd);
$qstr .= '&amp;std=' . urlencode($std);
$qstr .= '&amp;sml=' . urlencode($sml);
$qstr .= '&amp;sms=' . urlencode($sms);
$qstr .= '&amp;page=' . urlencode($page);
$sql = " delete from {$g5['member_table']} where mb_id= '".$mb_id."' ";
sql_query($sql);
//echo $sql;
alert("삭제하였습니다.","./pickus_member_list".$gubun.".php?".$qstr);
?>

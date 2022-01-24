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
$sql = " update {$g5['member_table']} set mb_level = '2' where mb_id= '" . $mb_id . "' ";
$sql2 = " update cs_member set level = '5' where userid= '" . $mb_id . "' ";
sql_query($sql);
sql_query($sql2);

$sql = " select * from {$g5['member_table']} where mb_id= '" . $mb_id . "' ";
$mm = sql_fetch($sql);

insert_notify($mm['mb_email'], '40', $mm['mb_biz_name'] . ' 가입 승인 되었습니다.', '', '', '', 'p1');

kakaotalk_send($mm['mb_hp'], 'SJT_041563',  '');

//echo $sql;
alert("승인하였습니다.", "./pickus_member_list3.php?" . $qstr);

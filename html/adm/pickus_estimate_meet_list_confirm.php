<?php
$sub_menu = "400220";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$qstr = '';
$qstr .= 'set=' . urlencode($set);
$qstr .= '&amp;sme=' . urlencode($sme);
$qstr .= '&amp;snn=' . urlencode($snn);
$qstr .= '&amp;shp=' . urlencode($shp);
$qstr .= '&amp;sa1=' . urlencode($sa1);
$qstr .= '&amp;sa2=' . urlencode($sa2);
$qstr .= '&amp;stl=' . urlencode($stl);
$qstr .= '&amp;swf=' . urlencode($swf);
$qstr .= '&amp;swt=' . urlencode($swt);
$qstr .= '&amp;spf=' . urlencode($spf);
$qstr .= '&amp;spt=' . urlencode($spt);
$qstr .= '&amp;page=' . urlencode($page);

$sql = " select * from {$g5['estimate_propose']} where idx = '$sub_idx' ";
$estimate_propose = sql_fetch($sql);

$sql = " select * from {$g5['estimate_list']} where idx = '{$estimate_propose['estimate_idx']}' ";
$estimate = sql_fetch($sql);

$sql = " update {$g5['estimate_propose']} set meet_confirm = '1' where idx = '$sub_idx' ";
//echo $sql;
sql_query($sql);

$sql = " update {$g5['estimate_propose']} set meet_date = CURDATE() where idx = '$sub_idx' ";
//echo $sql;
sql_query($sql);

insert_notify($estimate['email'], '11', $estimate['title'].' 업체 방문견적이 진행 됩니다.','',$estimate['idx'], '','cp8');

insert_notify($estimate_propose['rc_email'], '22', $estimate['title'].' 방문 견적 승인 되었습니다. ','',$estimate['idx'], '','p9');

alert("승인하였습니다.","./pickus_estimate_meet_list.php?".$qstr);
?>

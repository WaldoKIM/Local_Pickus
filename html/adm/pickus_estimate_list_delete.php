<?php
$sub_menu = "400210";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql = " select * from {$g5['estimate_list']} where idx = '$idx' ";
$estimate = sql_fetch($sql);

$sql = " delete from {$g5['estimate_propose_detail']} where estimate_idx = '$idx' ";
sql_query($sql);
$sql = " delete from {$g5['estimate_propose']} where estimate_idx = '$idx' ";
sql_query($sql);
$sql = " delete from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
sql_query($sql);
$sql = " delete from {$g5['estimate_list_multi']} where idx = '{$estimate['sub_key']}' ";
sql_query($sql);
$sql = " delete from {$g5['estimate_list']} where idx = '$idx' ";
sql_query($sql);


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
$qstr .= '&amp;scf=' . urlencode($scf);
$qstr .= '&amp;sct=' . urlencode($sct);
$qstr .= '&amp;sta=' . urlencode($sta);
$qstr .= '&amp;smp=' . urlencode($smp);
$qstr .= '&amp;page=' . urlencode($page);

alert("삭제하였습니다.","./pickus_estimate_list.php?".$qstr);
?>

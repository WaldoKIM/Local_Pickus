<?php
include_once('./_common.php');

$sql = " delete from {$g5['match_propose']} where idx = '$idx' ";
sql_query($sql);

alert('견적에 취소하였습니다.', G5_URL.'/estimate/partner_match_list2.php');
?>
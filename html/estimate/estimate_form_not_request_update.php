<?php
include_once('./_common.php');

$sql = " update {$g5['estimate_request']} set estimate_yn = '1' where estimate_idx = '$idx' and rc_email = '{$member['mb_email']}' ";

sql_query($sql);

alert('수거불가하였습니다.', G5_URL.'/estimate/estimate_list2.php');
?>
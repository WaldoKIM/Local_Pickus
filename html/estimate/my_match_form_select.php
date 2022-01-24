<?php
include_once('./_common.php');

$sql = " update {$g5['match_propose']} set selected = '1' where idx = '$sub_idx' ";
sql_query($sql);

$sql = " update {$g5['match_list']} set state = '2' where idx = '$idx' ";
sql_query($sql);

alert("업체를 선택하셨습니다.","./my_match_list.php?page=$page");
?>

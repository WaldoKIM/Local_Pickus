<?php
$sub_menu = "300120";
include_once("./_common.php");

auth_check($auth[$sub_menu], 'w');

$qstr = '';
$qstr .= 'page=' . urlencode($page);

$idx            = trim($_POST['idx']);
$ret_content    = trim($_POST['ret_content']);

$sql = " update {$g5['qna_table']} set 
                ret_content = '$ret_content',
                updatetime = now()
          where idx = '$idx' ";
sql_query($sql);

goto_url('./pickus_qna_list.php?'.$qstr, false);
?>
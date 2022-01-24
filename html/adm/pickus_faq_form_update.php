<?php
$sub_menu = "300130";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$qstr = '';
$qstr .= 'page=' . urlencode($page);

$sqlcommon = "  fa_subject = '{$_POST['fa_subject']}',
                 fa_content = '{$fa_content}' ";


if ($w == '') {
    $sql = " insert into {$g5['faq_table']} set 
                     {$sqlcommon} ,
                     fm_id = '1' ";
    sql_query($sql);
} else if ($w == 'u') {

    $sql = " update {$g5['faq_table']} set 
                    {$sqlcommon}
              where fa_id = '$fa_id' ";

    //echo $sql;

    sql_query($sql);
}

goto_url('./pickus_faq_list.php?'.$qstr, false);
?>
<?php
$sub_menu = "300140";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$qstr = '';
$qstr .= 'page=' . urlencode($page);

$sqlcommon = "  category1 = '{$_POST['category1']}',
                 category2 = '{$_POST['category2']}' ";


if ($w == '') {
    $sql = " insert into {$g5['estimate_category2']} set 
                     {$sqlcommon} ";
    sql_query($sql);
} else if ($w == 'u') {

    $sql = " update {$g5['estimate_category2']} set 
                    {$sqlcommon}
              where idx = '$idx' ";

    //echo $sql;

    sql_query($sql);
}

goto_url('./pickus_category_list.php', false);
?>
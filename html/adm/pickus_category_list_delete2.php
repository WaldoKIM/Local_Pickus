<?php
$sub_menu = "300140";
include_once("./_common.php");


$sql = " delete from {$g5['estimate_category2']} where idx= '".$idx."' ";
sql_query($sql);
//echo $sql;
alert("삭제하였습니다.","./pickus_category_list.php");
?>

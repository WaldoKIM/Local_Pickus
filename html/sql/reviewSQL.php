<?php
include_once('./_common.php');
include_once('./_head.php');
$sql = " select
mb_photo_site 
from 
g5_member
where 
mb_email = '{$member['mb_email']}'"
;

$resultx = sql_query($sql);
$resultz = $resultx['mb_photo_site'];
echo "거래후기 <span class='main_co'>".$resultz."</span> / 5.0";
?>
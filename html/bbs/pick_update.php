<?php
include_once('./_common.php');

$sql = "insert into g5_partner_estimate (company, name, phone, area1, area2) VALUES( '$company' , '$name' , '$phone' , '$area1', '$area2' )";

sql_query($sql);

alert('상담 진행 도와 드리겠습니다. 감사합니다.');

$result_url = G5_BBS_URL."/pick.php";

    
goto_url($result_url);
?>

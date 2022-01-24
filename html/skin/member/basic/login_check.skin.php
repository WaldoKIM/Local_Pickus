<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 자신만의 코드를 넣어주세요.
    if($member["mb_level"]=="2"){
     header('Location: /estimate/partner_estimate_list.php');
     exit;
    }
?>

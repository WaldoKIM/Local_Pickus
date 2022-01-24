<?php
$sub_menu = "200110";
include_once('./_common.php');

set_session('ss_mb_id', $mb_id);

set_session('ss_mb_reg', $mb_id);
            
goto_url(G5_URL."/estimate/estimate_list2.php");
?>

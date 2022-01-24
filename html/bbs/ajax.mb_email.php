<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/register.lib.php');


$mb_email = trim($_POST['mb_email']);

set_session('ss_check_mb_email', '');

if ($msg = exist_mb_email($mb_email)) die($msg);

set_session('ss_check_mb_email', $mb_email);
?>


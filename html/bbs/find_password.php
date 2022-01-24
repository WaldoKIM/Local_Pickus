<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

if ($is_member) {
    alert("이미 로그인중입니다.");
}

$g5['title'] = '회원정보 찾기';
include_once('./_head.php');
$action_url = G5_HTTPS_BBS_URL."/find_password_update.php";
include_once($member_skin_path.'/find_password.skin.php');

include_once('./_tail.php');
?>
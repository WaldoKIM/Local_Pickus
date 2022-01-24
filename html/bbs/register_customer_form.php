<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');

run_event('register_form_before');

// 불법접근을 막도록 토큰생성
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);
set_session("ss_cert_no",   "");
set_session("ss_cert_hash", "");
set_session("ss_cert_type", "");

if( $provider && function_exists('social_nonce_is_valid') ){   //모바일로 소셜 연결을 했다면
    if( social_nonce_is_valid(get_session("social_link_token"), $provider) ){  //토큰값이 유효한지 체크
        $w = 'u';   //회원 수정으로 처리
        $_POST['mb_id'] = $member['mb_id'];
    }
}
$w == "";
if ($is_admin == 'super')
    alert('관리자의 회원정보는 관리자 화면에서 수정해 주십시오.', G5_URL);
if ($is_member)
    $w = "u";

include_once('./_head.php');

$register_action_url = G5_HTTPS_BBS_URL.'/register_form_update.php';
$required = ($w=='') ? 'required' : '';
$readonly = ($w=='u') ? 'readonly' : '';

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
if ($config['cf_use_addr'])
    add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

include_once($member_skin_path.'/register_customer_form.skin.php');



include_once('./_tail.php');
?>

<!--GW-전환-회원가입-->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-715468370/97ovCJ_7lakBENLclNUC'});
</script>

<!--NAVER ADS-회원가입-->
<script type="text/javascript">
var _nasa={};
_nasa["cnv"] = wcs.cnv("2","100000");
</script>
<style type="text/css">
    #fixed_kakao{display: block !important;}
</style>
<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

if ($is_member) {
    alert_close('이미 로그인중입니다.', G5_URL);
}

$email = trim($_POST['srchEmail']);

$sql = " select * from {$g5['member_table']} where mb_email = '$email' ";

$mb = sql_fetch($sql);

if (!$mb['mb_id'] || $mb['mb_leave_date'])
    alert('회원 정보가 없습니다.');

if ($mb['mb_level'] != "0" && $mb['mb_level'] != "2")
{
	if($mb['mb_level'] == "8"){
		alert('비회원으로 진행하여 주십시오.', G5_BBS_URL.'/login.php');
	}else{
		alert('회원 정보가 없습니다.');
	}
}
// 임시비밀번호 발급
$temp_password = rand(100000, 999999);
$change_password = md5($temp_password);

// 임시비밀번호와 난수를 mb_lost_certify 필드에 저장
$sql = " update {$g5['member_table']} set mb_password = '$change_password', mb_password_type='md5' where mb_id = '{$mb['mb_id']}' ";
sql_query($sql);

// 인증 링크 생성
$href = G5_BBS_URL.'/password_lost_certify.php?mb_no='.$mb['mb_no'].'&amp;mb_nonce='.$mb_nonce;

$subject = "[PickUS]임시 비밀번호입니다.";

/*$content = $temp_password;*/

$content .= '<div style="max-width: 950px; margin: 0 auto; font-weight: 800;">';
$content .= '	<div>';
$content .= '		<img class="main" src="http://www.repickus.com/img/common/top_logo.png" alt="">';
$content .= '	</div>';
$content .= '	<h1 style="padding: 10px 0; line-height: 1.5em;">회원님께 임시 비밀번호가<br/><span style="color: #1379cd;">발송 되었습니다.</span></h1>';
$content .= '	<div style="font-size: 20px; padding: 10px 0; text-align: center;">';
$content .= '		회원님! 안녕하세요.<br/>';
$content .= '		<span style="color: #1379cd;">회원님의 임시 비밀번호를 안내해 드립니다.</span>';
$content .= '	</div>';
$content .= '	<table style="max-width: 500px; margin: 0 auto; padding: 20px 0; font-size: 18px; font-weight: 800; ">';
$content .= '		<colgroup>';
$content .= '			<col style="width: 40%">';
$content .= '			<col style="width: 60%">';
$content .= '		</colgroup>';
$content .= '		<tr>';
$content .= '			<td style="padding:10px; text-align: left; color: #1379cd; border-bottom: 1px solid #e5e5e5;">로그인 아이디 </td>';
$content .= '			<td style="padding:10px; text-align: left; border-bottom: 1px solid #e5e5e5;">'.$mb['mb_email'].'</td>';
$content .= '		</tr>';
$content .= '		<tr>';
$content .= '			<td style="padding:10px; text-align: left; color: #1379cd; border-bottom: 1px solid #e5e5e5;">임시 비밀번호 </td>';
$content .= '			<td style="padding:10px; text-align: left; border-bottom: 1px solid #e5e5e5;">'.$temp_password.'</td>';
$content .= '		</tr>';
$content .= '	</table>';
$content .= '	<div style="font-size: 18px; text-align: center; color:#969696;">';
$content .= '		비밀번호 변경은<br/>';
$content .= '		<span style="color: #1379cd;">로그인 후 마이페이지에서 설정 가능합니다.</span>';
$content .= '	</div>';
$content .= '	<div style="padding: 20px 0; text-align: center; font-size: 20px; line-height: 1.5em;">항상 피커스를 사랑해주시는 고객님께 감사드리며, <br/>보다 나은 피커스가 되기 위해 최선을 다하겠습니다.<br/><span style="color: #1379cd;">피커스 드림</span></div>';
$content .= '	<div style="padding: 30px 0; overflow: hidden;">';
$content .= '		<div style="float: left; width: 50%; text-align: left; ">';
$content .= '			<a href="http://www.repickus.com/" target="_black"><img class="main" src="http://www.repickus.com/img/etc/app_icon.png" alt=""></a>';
$content .= '		</div>';
$content .= '		<div style="float: left; width: 50%;  text-align: right;">';
$content .= '				<h1 style="color: #6faee4;">1800-5528</h1>';
$content .= '				월-금,공휴일 09:00~18:00 / 일요일 휴무<br/>';
$content .= '				고객센터 및 제휴문의 : cs@repickus.com';
$content .= '		</div>';
$content .= '	</div>';
$content .= '	<div style="padding:20px 10px; color:#969696; border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;">';
$content .= '		본 이메일은 cs@repickus.com에게 발송되었으며, 비밀번호 변경을 위해 필수적이기 때문에 비밀번호 변경 요청시 이메일이 발송됩니다. 비밀번호 변경 신청을 한 경우가 없는데 본 이메일을 수신하신 경우 cs@repickus.com로 연락주시기 바랍니다.';
$content .= '	</div>';
$content .= '</div>';

try {
	mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $mb['mb_email'], $subject, $content, 1);

	run_event('password_lost2_after', $mb, $mb_nonce, $mb_lost_certify);

	alert('이메일로 임시 비밀번호가 전송되었습니다.', G5_BBS_URL.'/login.php');	
} catch (Exception $e) {
	print_r($e);
}

?>

<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH . '/captcha.lib.php');
include_once(G5_LIB_PATH . '/register.lib.php');
include_once(G5_LIB_PATH . '/mailer.lib.php');
include_once(G5_LIB_PATH . '/thumbnail.lib.php');

// 리퍼러 체크
referer_check();

if (!($w == '' || $w == 'u')) {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}

if ($w == 'u')
    $mb_id = isset($_SESSION['ss_mb_id']) ? trim($_SESSION['ss_mb_id']) : '';
else if ($w == '')
    $mb_id = trim($_POST['mb_id']);
else
    alert('잘못된 접근입니다', G5_URL);

if (!$mb_id)
    alert('회원아이디 값이 없습니다. 올바른 방법으로 이용해 주십시오.');

$sql = " select count(*) as cnt from `{$g5['member_table']}` where mb_email = '$mb_email' ";
$row = sql_fetch($sql);



$mb_password    = trim($_POST['mb_password']);
$mb_password_re = trim($_POST['mb_password_re']);
$mb_password_type    = trim($_POST['mb_password_type']);

$mb_name        = trim($_POST['mb_name']);
$mb_email       = trim($_POST['mb_email']);
$mb_homepage    = isset($_POST['mb_homepage'])      ? trim($_POST['mb_homepage'])    : "";
$mb_level       = isset($_POST['mb_level'])         ? trim($_POST['mb_level'])    : "";

$mb_sex         = isset($_POST['mb_sex'])           ? trim($_POST['mb_sex'])         : "";
$mb_birth       = isset($_POST['mb_birth'])         ? trim($_POST['mb_birth'])       : "";

$mb_tel         = isset($_POST['mb_tel'])           ? trim($_POST['mb_tel'])         : "";
$mb_hp          = isset($_POST['mb_hp'])            ? trim($_POST['mb_hp'])          : "";

$mb_zip1        = isset($_POST['mb_zip'])           ? substr(trim($_POST['mb_zip']), 0, 3) : "";
$mb_zip2        = isset($_POST['mb_zip'])           ? substr(trim($_POST['mb_zip']), 3)    : "";

$mb_addr1       = isset($_POST['mb_addr1'])         ? trim($_POST['mb_addr1'])       : "";
$mb_addr2       = isset($_POST['mb_addr2'])         ? trim($_POST['mb_addr2'])       : "";
$mb_addr3       = isset($_POST['mb_addr3'])         ? trim($_POST['mb_addr3'])       : "";
$mb_addr_jibeon = isset($_POST['mb_addr_jibeon'])   ? trim($_POST['mb_addr_jibeon']) : "";

$mb_signature   = isset($_POST['mb_signature'])     ? trim($_POST['mb_signature'])   : "";
$mb_profile     = isset($_POST['mb_profile'])       ? trim($_POST['mb_profile'])     : "";
$mb_recommend   = isset($_POST['mb_recommend'])     ? trim($_POST['mb_recommend'])   : "";
$mb_mailling    = isset($_POST['mb_mailling'])      ? trim($_POST['mb_mailling'])    : "";
$mb_sms         = isset($_POST['mb_sms'])           ? trim($_POST['mb_sms'])         : "";
$mb_1           = isset($_POST['mb_1'])             ? trim($_POST['mb_1'])           : "";
$mb_2           = isset($_POST['mb_2'])             ? trim($_POST['mb_2'])           : "";
$mb_3           = isset($_POST['mb_3'])             ? trim($_POST['mb_3'])           : "";
$mb_4           = isset($_POST['mb_4'])             ? trim($_POST['mb_4'])           : "";
$mb_5           = isset($_POST['mb_5'])             ? trim($_POST['mb_5'])           : "";
$mb_6           = isset($_POST['mb_6'])             ? trim($_POST['mb_6'])           : "";
$mb_7           = isset($_POST['mb_7'])             ? trim($_POST['mb_7'])           : "";
$mb_8           = isset($_POST['mb_8'])             ? trim($_POST['mb_8'])           : "";
$mb_9           = isset($_POST['mb_9'])             ? trim($_POST['mb_9'])           : "";
$mb_10          = isset($_POST['mb_10'])            ? trim($_POST['mb_10'])          : "";

$mb_photo                  = isset($_POST['mb_photo'])                    ? trim($_POST['mb_photo'])                  : "";
$mb_photo_rotate           = isset($_POST['mb_photo_rotate'])             ? trim($_POST['mb_photo_rotate'])           : "";
$mb_photo_site             = isset($_POST['mb_photo_site'])               ? trim($_POST['mb_photo_site'])             : "";
$mb_photo_site_rotate      = isset($_POST['mb_photo_site_rotate'])        ? trim($_POST['mb_photo_site_rotate'])      : "";
$mb_photo_bizcard          = isset($_POST['mb_photo_bizcard'])            ? trim($_POST['mb_photo_bizcard'])          : "";
$mb_photo_bizcard_rotate   = isset($_POST['mb_photo_bizcard_rotate'])     ? trim($_POST['mb_photo_bizcard_rotate'])   : "";
$mb_biz_num                = isset($_POST['mb_biz_num'])             ? trim($_POST['mb_biz_num'])           : "";
$mb_biz_name           = isset($_POST['mb_biz_name'])             ? trim($_POST['mb_biz_name'])           : "";
$mb_biz_type           = isset($_POST['mb_biz_type'])             ? trim($_POST['mb_biz_type'])           : "";
$mb_biz_post           = isset($_POST['mb_biz_post'])             ? trim($_POST['mb_biz_post'])           : "";
$mb_biz_addr1          = isset($_POST['mb_biz_addr1'])            ? trim($_POST['mb_biz_addr1'])          : "";
$mb_biz_addr2          = isset($_POST['mb_biz_addr2'])            ? trim($_POST['mb_biz_addr2'])          : "";
$mb_biz_intro          = isset($_POST['mb_biz_intro'])            ? trim($_POST['mb_biz_intro'])          : "";

$mb_biz_worker_name         = isset($_POST['mb_biz_worker_name'])       ? trim($_POST['mb_biz_worker_name'])         : "";
$mb_biz_worker_phone        = isset($_POST['mb_biz_worker_phone'])      ? trim($_POST['mb_biz_worker_phone'])        : "";
$mb_biz_goods_item          = isset($_POST['mb_biz_goods_item'])        ? trim($_POST['mb_biz_goods_item'])          : "";
$mb_biz_goods_year          = isset($_POST['mb_biz_goods_year'])        ? trim($_POST['mb_biz_goods_year'])          : "";
$mb_biz_remove_item         = isset($_POST['mb_biz_remove_item'])       ? trim($_POST['mb_biz_remove_item'])         : "";
$mb_biz_remove_etc          = isset($_POST['mb_biz_remove_etc'])        ? trim($_POST['mb_biz_remove_etc'])          : "";
$mb_biz_charge_rate         = isset($_POST['mb_biz_charge_rate'])       ? trim($_POST['mb_biz_charge_rate'])         : "";
$mb_biz_score               = isset($_POST['mb_biz_score'])             ? trim($_POST['mb_biz_score'])               : "";

$matchAgree = $_POST['matchAgree'];

if ($_POST['mb_bank'] == '') {
    $mb_bank = $_POST['mb_bank_txt'];
} else {
    $mb_bank = $_POST['mb_bank'];
}

$mb_bank_num = $_POST['mb_bank_num'];
$mb_bank_name = $_POST['mb_bank_name'];

$mb_name        = clean_xss_tags($mb_name);
$mb_email       = get_email_address($mb_email);
$mb_homepage    = clean_xss_tags($mb_homepage);
$mb_tel         = clean_xss_tags($mb_tel);
$mb_zip1        = preg_replace('/[^0-9]/', '', $mb_zip1);
$mb_zip2        = preg_replace('/[^0-9]/', '', $mb_zip2);
$mb_addr1       = clean_xss_tags($mb_addr1);
$mb_addr2       = clean_xss_tags($mb_addr2);
$mb_addr3       = clean_xss_tags($mb_addr3);
$mb_addr_jibeon = preg_match("/^(N|R)$/", $mb_addr_jibeon) ? $mb_addr_jibeon : '';

if (!$mb_name) {
    $mb_name = $mb_biz_name;
}
//회원별 지역을 추가한다.
$sql = " delete from {$g5['member_area_table']} where mb_id = '$mb_id' ";
sql_query($sql);
$area_count = (isset($_POST['mb_area1']) && is_array($_POST['mb_area1'])) ? count($_POST['mb_area1']) : 0;
if ($area_count) {
    for ($i = 0; $i < $area_count; $i++) {
        $area1     = $_POST['mb_area1'][$i];
        $area2     = $_POST['mb_area2'][$i];
        $sql = " insert into {$g5['member_area_table']} set mb_id = '$mb_id', mb_area1='$area1', mb_area2='$area2' ";
        sql_query($sql);
    }
}


$sqlcommon = "       mb_name = '{$mb_name}',
                     mb_email = '{$mb_email}',
                     mb_homepage = '{$mb_homepage}',
                     mb_tel = '{$mb_tel}',
                     mb_hp = '{$mb_hp}',
                     mb_zip1 = '{$mb_zip1}',
                     mb_zip2 = '{$mb_zip2}',
                     mb_addr1 = '{$mb_addr1}',
                     mb_addr2 = '{$mb_addr2}',
                     mb_addr3 = '{$mb_addr3}',
                     mb_addr_jibeon = '{$mb_addr_jibeon}',
                     mb_signature = '{$mb_signature}',
                     mb_profile = '{$mb_profile}',
                     mb_today_login = '" . G5_TIME_YMDHIS . "',
                     mb_datetime = '" . G5_TIME_YMDHIS . "',
                     mb_ip = '{$_SERVER['REMOTE_ADDR']}',
                     mb_level = '{$mb_level}',
                     mb_recommend = '{$mb_recommend}',
                     mb_login_ip = '{$_SERVER['REMOTE_ADDR']}',
                     mb_mailling = '{$mb_mailling}',
                     mb_sms = '{$mb_sms}',
                     mb_open = '{$mb_open}',
                     mb_open_date = '" . G5_TIME_YMD . "',
                     mb_1 = '{$mb_1}',
                     mb_2 = '{$mb_2}',
                     mb_3 = '{$mb_3}',
                     mb_4 = '{$mb_4}',
                     mb_5 = '{$mb_5}',
                     mb_6 = '{$mb_6}',
                     mb_7 = '{$mb_7}',
                     mb_8 = '{$mb_8}',
                     mb_9 = '{$mb_9}',
                     mb_10 = '{$mb_10}',
                     mb_photo = '{$mb_photo}',
                     mb_photo_rotate = '{$mb_photo_rotate}',
                     mb_photo_site = '{$mb_photo_site}',
                     mb_photo_site_rotate = '{$mb_photo_site_rotate}',
                     mb_biz_num = '{$mb_biz_num}',
                     mb_photo_bizcard_rotate = '{$mb_photo_bizcard_rotate}',
                     mb_biz_name = '{$mb_biz_name}',
                     mb_biz_type = '{$mb_biz_type}',
                     mb_biz_post = '{$mb_biz_post}',
                     mb_biz_addr1 = '{$mb_biz_addr1}',
                     mb_biz_addr2 = '{$mb_biz_addr2}',
                     mb_biz_intro = '{$mb_biz_intro}',
                     mb_biz_worker_name = '{$mb_biz_worker_name}',
                     mb_biz_worker_phone = '{$mb_biz_worker_phone}',
                     mb_biz_goods_item = '{$mb_biz_goods_item}',
                     mb_biz_goods_year = '{$mb_biz_goods_year}',
                     mb_biz_remove_item = '{$mb_biz_remove_item}',
                     mb_biz_remove_etc = '{$mb_biz_remove_etc}',
                     mb_match = '{$matchAgree}',
                     mb_bank = '{$mb_bank}',
                     mb_bank_num = '{$mb_bank_num}',
                     mb_bank_name = '{$mb_bank_name}'
                      ";

if ($w == '') {
    $sql = " insert into {$g5['member_table']} set mb_id = '{$mb_id}',
                     mb_password = '$mb_password',
                     mb_password_type = '$mb_password_type',
                     mb_biz_charge_rate = '10',
                     {$sqlcommon} ";

    //쇼핑몰 회원 Table 에 추가 입력 2021-07-29 sinn@oolim.net
    $sql2 = " insert into cs_member set userid = '{$mb_id}',
                    passwd = '$mb_password',
					email= '{$mb_email}', 
					name= '{$mb_name}',
					tel1 = '{$mb_tel}',
                    phone1= '{$mb_hp}',
					add1 = '{$mb_addr1}',
                    add2 = '{$mb_addr2}',
					register = '" . G5_TIME_YMDHIS . "',
					bank = '{$mb_bank}',					
                    account_num = '{$mb_bank_num}'					
			";
    sql_query($sql2);

    //쇼핑몰 회원 Table 에 추가 입력 END/////////////

    sql_query($sql);

    if ($mb_level == "0") {
        set_session('ss_mb_id', $mb_id);

        set_session('ss_mb_reg', $mb_id);

        echo "
            <!-- NAVER SCRIPT -->
            <script type='text/javascript' src='//wcs.naver.net/wcslog.js'></script> 
            <script type='text/javascript'> 
            if (!wcs_add) var wcs_add={};
            wcs_add['wa'] = 's_4e5aa7de4638';
            if (!_nasa) var _nasa={};
            _nasa['cnv'] = wcs.cnv('2','1'); //전환유형, 전환가치
            wcs_do(_nasa);
            </script>
            <!-- NAVER SCRIPT END -->
            ";

        alert('회원 가입이 완료되었습니다!', G5_URL);
    } else {
        alert('회원 가입 완료 되었으며,\\n관리자 승인 후 이용이 가능합니다.', G5_URL);
    }
} else if ($w == 'u') {
    if (!trim($_SESSION['ss_mb_id']))
        alert('로그인 되어 있지 않습니다.');

    if (trim($_POST['mb_id']) != $mb_id)
        alert("로그인된 정보와 수정하려는 정보가 틀리므로 수정할 수 없습니다.\\n만약 올바르지 않은 방법을 사용하신다면 바로 중지하여 주십시오.");

    $sql_password = "";
    if ($mb_password)
        $sql_password = " , mb_password = '" . $mb_password . "', mb_password_type = '" . $mb_password_type . "' ";

    $sql = " update {$g5['member_table']} set 
                    {$sqlcommon}
                    {$sql_password}
              where mb_id = '$mb_id' ";
    sql_query($sql);

    alert('수정하였습니다.', G5_URL);
}

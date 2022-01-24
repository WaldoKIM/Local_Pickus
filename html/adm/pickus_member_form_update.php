<?php
$sub_menu = "200110";
include_once("./_common.php");
include_once(G5_LIB_PATH . '/shop.lib.php');    // URL 함수 파일
auth_check($auth[$sub_menu], 'w');

$qstr = '';
$qstr .= 'set=' . urlencode($set);
$qstr .= '&amp;sme=' . urlencode($sme);
$qstr .= '&amp;snn=' . urlencode($snn);
$qstr .= '&amp;shp=' . urlencode($shp);
$qstr .= '&amp;sa1=' . urlencode($sa1);
$qstr .= '&amp;sa2=' . urlencode($sa2);
$qstr .= '&amp;stl=' . urlencode($stl);
$qstr .= '&amp;swf=' . urlencode($swf);
$qstr .= '&amp;swt=' . urlencode($swt);
$qstr .= '&amp;spf=' . urlencode($spf);
$qstr .= '&amp;spt=' . urlencode($spt);
$qstr .= '&amp;scf=' . urlencode($scf);
$qstr .= '&amp;sct=' . urlencode($sct);
$qstr .= '&amp;sta=' . urlencode($sta);
$qstr .= '&amp;smp=' . urlencode($smp);


$mb_password    = trim($_POST['mb_password']);
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
$mb_biz_num           = isset($_POST['mb_biz_num'])             ? trim($_POST['mb_biz_num'])           : "";

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

if (!$mb_id) $mb_id = $mb_email;

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
                     mb_biz_num = '{$mb_biz_num}',
                     mb_biz_name = '{$mb_biz_name}',
                     mb_biz_type = '{$mb_biz_type}',
                     mb_show_type = '{$mb_show_type}',
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
                     mb_biz_charge_rate = '{$mb_biz_charge_rate}',
                     mb_biz_score = '{$mb_biz_score}',
					 mb_intro_center = '{$mb_intro_center}' ";



//사진을 등록한다.
$datetime = G5_TIME_YMD;
$cur_year = date("Y", strtotime($datetime));
$cur_month = date("m", strtotime($datetime));
$cur_day = date("d", strtotime($datetime));

$img_dir_year = G5_DATA_PATH . '/estimate/' . $cur_year;
@mkdir($img_dir_year, G5_DIR_PERMISSION);
@chmod($img_dir_year, G5_DIR_PERMISSION);

$img_dir_month = $img_dir_year . '/' . $cur_month;
@mkdir($img_dir_month, G5_DIR_PERMISSION);
@chmod($img_dir_month, G5_DIR_PERMISSION);

$img_dir = $img_dir_month . '/' . $cur_day;
@mkdir($img_dir, G5_DIR_PERMISSION);
@chmod($img_dir, G5_DIR_PERMISSION);

if ($_FILES['mb_photo']['name']) {
    $mb_photo = estimate_img_upload($_FILES['mb_photo']['tmp_name'], $_FILES['mb_photo']['name'], $img_dir);
    $sqlcommon .= " , mb_photo = '$mb_photo' ";
}

if ($_FILES['mb_photo_site']['name']) {
    $mb_photo_site = estimate_img_upload($_FILES['mb_photo_site']['tmp_name'], $_FILES['mb_photo_site']['name'], $img_dir);
    $sqlcommon .= " , mb_photo_site = '$mb_photo_site' ";
}

if ($_FILES['mb_photo_bizcard']['name']) {
    $mb_photo_bizcard = estimate_img_upload($_FILES['mb_photo_bizcard']['tmp_name'], $_FILES['mb_photo_bizcard']['name'], $img_dir);
    $sqlcommon .= " , mb_photo_bizcard = '$mb_photo_bizcard' ";
}

if ($mb_password) {
    $sqlcommon .= " , mb_password = '$mb_password', mb_password_type = '$mb_password_type' ";
}
if ($w == '') {
    $sql = " insert into {$g5['member_table']} set mb_id = '{$mb_email}' , 
                     {$sqlcommon} ";
    sql_query($sql);
} else if ($w == 'u') {

    $sql = " update {$g5['member_table']} set 
                    {$sqlcommon}
              where mb_id = '$mb_id' ";
    sql_query($sql);
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

//쇼핑몰 회원 Table 에 추가 입력 2021-07-29 sinn@oolim.net
if ($mb_level == 2) {
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
                    account_num = '{$mb_bank_num}',
                    level = '5'					
			";
    sql_query($sql2);
} else {
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
}
//쇼핑몰 회원 Table 에 추가 입력 END/////////////

if ($mb_type) {
    goto_url('./pickus_member_list' . $mb_type . '.php?' . $qstr, false);
} else {
    goto_url('./pickus_member_list3.php', false);
}

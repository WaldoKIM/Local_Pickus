<?php
include_once('./_common.php');
//include_once('../bbs/do_fcm.php');

$sql = " select * from {$g5['member_table']} where mb_email = '$email' ";
$mm = sql_fetch($sql);
$price = (string)$price;

$sql_match = "insert into g5_estimate_match set
			no_estimate = '$no_estimate',
			title = '$title',
			jangso = '$jangso_ori',
			cate = '',
			price = '$price',
			area1 = '$area1',
			area2 = '$area2',
			place = '$place',
			elevator_yn = '$elevator_yn',
			floor = '$floor',
			date_close = '$date_close',
			date_req = '$date_req',
			etc_req = '$etc_req',
			name = '$name',
			email = '$email',
			number = '$phone',
			nickname = '{$member['mb_name']}'";
sql_query($sql_match);

$option_count = (isset($_POST['qty']) && is_array($_POST['qty'])) ? count($_POST['qty']) : array();
if ($option_count) {
	for ($i = 0; $i < $option_count; $i++) {

		$item_cat_dtl_s = $_POST['item_cat_dtl_s'][$i];
		$item_qty     = $_POST['qty'][$i];
		$cate     = $_POST['cate'][$i];

		$sql_info = "insert into g5_estimate_match_info set
					no_estimate = '$no_estimate',
					item_cat_dtl_s = '$item_cat_dtl_s',
					qty = $item_qty,
					cate = '$cate',
					email = '$email' ";
		sql_query($sql_info);
	}
}


$url = "./my_estimate_form_match_sa.php?no_estimate=" . $no_estimate;

if (!$is_member) {
	$sql = " select * from {$g5['member_table']} where mb_email = '$email' ";
	$mm = sql_fetch($sql);
	if (!$mm) {
		$sql = " insert into {$g5['member_table']} set 
	    				mb_id = '$email',
	                    mb_password_type = 'md5',
	                    mb_name = '$name',
	                    mb_email = '$email',
	                    mb_level = '8',
	                    mb_hp = '$phone',
	                    mb_datetime = now(),
	                    mb_email_certify = now(),
	                    mb_open = '1' ";
		sql_query($sql);

		set_session('ss_mb_id', $email);

		set_session('ss_mb_reg', $email);
	} else {
		if ($mm['mb_level'] == "8") {
			set_session('ss_mb_id', $email);

			set_session('ss_mb_reg', $email);
		} else {
			$url = G5_URL;
		}
	}
}

insert_notify($email, '11', $title . ' 견적신청이 되었습니다.', '', $no_estimate, '', 'cm1');

//kakaotalk_send($phone, 'SJT_058638',  $name .'|'. $email .'|'. '중고 구매');  //마지막 폼에서 받은 값을 대입

/*
$msg = $title.' 견적신청이 되었습니다.';


$sql = " select * from {$g5['member_token_table']} where mb_email = '{$member['mb_id']}' order by idx desc";
$row = sql_fetch($sql);
//토큰
$token = $row['token'];
app_push($token,$msg);
*/

alert("견적이 신청되었습니다.", $url);

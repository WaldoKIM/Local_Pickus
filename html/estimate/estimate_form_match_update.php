<?php
include_once('./_common.php');

$rc_email = $member['mb_email'];

$sql = " select * from {$g5['estimate_match_propose']} where no_estimate = '$no_estimate' and rc_email = '$rc_email' ";
$ep = sql_fetch($sql);

if($ep){
	alert('이미 참여한 견적입니다.', G5_URL.'/estimate/partner_estimate_list.php?gubun=4');
}


$datetime = G5_TIME_YMD;
$cur_year = date("Y", strtotime($datetime));
$cur_month = date("m", strtotime($datetime));
$cur_day = date("d", strtotime($datetime));

$img_dir_year = G5_DATA_PATH.'/estimate/'.$cur_year;
@mkdir($img_dir_year, G5_DIR_PERMISSION);
@chmod($img_dir_year, G5_DIR_PERMISSION);

$img_dir_month = $img_dir_year.'/'.$cur_month;
@mkdir($img_dir_month, G5_DIR_PERMISSION);
@chmod($img_dir_month, G5_DIR_PERMISSION);

$img_dir = $img_dir_month.'/'.$cur_day;
@mkdir($img_dir, G5_DIR_PERMISSION);
@chmod($img_dir, G5_DIR_PERMISSION);


$sql = " select * from {$g5['estimate_match']} where no_estimate = '$no_estimate' ";
$estimate = sql_fetch($sql);

$sql = " insert into {$g5['estimate_match_propose']} (
			no_estimate,
			rc_email,
			rc_nickname,
			nickname,
			price,
			selected,
			shipping,
			pro_as,
			proposetime,
			month_as,
			content
		) values (
			'$no_estimate',
			'{$member['mb_email']}',
			'{$member['mb_biz_name']}',
			'{$estimate['nickname']}',
			'0',
			'0',
			'$shipping_pro',
	 		'$as_pro',
			now(),
			'$month_as',
			'$match_desc'
		) ";

sql_query($sql);

$option_count = (isset($_POST['pro_name']) && is_array($_POST['pro_name'])) ? 
count($_POST['pro_name']) : array();
$sql = "insert into {$g5['estimate_match_propose_detail']} set ";
	$sql .= "no_estimate = '$no_estimate', ";
	$sql .= "rc_email = '{$member['mb_email']}', ";


for ($i=0; $i<$option_count; $i++){

	$item = $_POST['pro_name'][$i];
	$amt  = $_POST['pro_price'][$i];

	
	$sql .= "item".$i." = '$item', ";
	$sql .= "amt".$i." = '$amt', ";
	

}
$sql .= "updatetime = now()";
sql_query($sql);

$photo_count = count($_FILES['photo']['name']);
for ($i=0; $i<$photo_count; $i++) {
	if ($_FILES['photo']['name'][$i]) {
		$photo = estimate_img_upload($_FILES['photo']['tmp_name'][$i], $_FILES['photo']['name'][$i], $img_dir);
	    $sql = " insert into g5_estimate_list_photo_match set 
	    				no_estimate = '$no_estimate',
	    				rc_email = '{$member['mb_email']}',
	                    photo = '$photo',
	                    photo_rotate = '',
	                    writetime = now()";	
	    sql_query($sql);

	}
}

insert_notify($estimate['email'], '11', $estimate['title'].' 업체 견적이 들어왔습니다.','',$estimate['no_estimate'], '','cm2');

$sql = "select count(*) as cnt from {$g5['estimate_match_propose']} where no_estimate = '$no_estimate' ";
$cnt = sql_fetch($sql);

if($cnt['cnt'] == 1){   //견적 최초 한번만 날림
	kakaotalk_send($estimate['number'], 'SJT_058802', $estimate['title']);  //업체에서 견적 들어왔을시, 소비자에게 날리는 톡
}

alert('견적에 참여하였습니다.', G5_URL.'/estimate/partner_estimate_list.php?gubun=4');
?>
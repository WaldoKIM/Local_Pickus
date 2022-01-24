<?php
include_once('./_common.php');

$rc_email = $member['mb_email'];

$sql = " select * from {$g5['estimate_propose']} where estimate_idx = '$idx' and rc_email = '$rc_email' ";
$ep = sql_fetch($sql);

if($ep){
	alert('이미 참여한 견적입니다.', G5_URL.'/estimate/partner_estimate_list.php');
}


$attach_file = "";
if ($_FILES['attfile']['name']) {
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

	$attach_file = estimate_file_upload($_FILES['attfile']['tmp_name'], $_FILES['attfile']['name'], $img_dir);
}


$sql = " select * from {$g5['estimate_list']} where idx = '$idx' ";
$estimate = sql_fetch($sql);

$sql = " insert into {$g5['estimate_propose']} (
			estimate_idx,
			rc_email,
			rc_nickname,
			email,
			nickname,
			price,
			content,
			selected,
			attach_file,
			proposetime
		) values (
			'$idx',
			'{$member['mb_email']}',
			'{$member['mb_biz_name']}',
			'{$estimate['email']}',
			'{$estimate['nickname']}',
			'$total_amt',
			'$content',
			'0',
			'$attach_file',
			now()
		) ";

sql_query($sql);
$sql = " insert into {$g5['estimate_propose_detail']} set ";
$sql .= " estimate_idx = '$idx', ";
$sql .= " rc_email = '{$member['mb_email']}', ";
$sql .= " total_amt = '$total_amt', ";
for ($i=1; $i<=11; $i++){
	if($i < 10){
		$vId = '0'.$i;
	}else{
		$vId = ''.$i;
	}

	$item = $_POST['item'.$vId];
	$desc = $_POST['desc'.$vId];
	$amt  = $_POST['amt'.$vId];
	$vat  = $_POST['vat'.$vId];

	$sql .= " item".$vId." = '$item', ";
	$sql .= " desc".$vId." = '$desc', ";
	$sql .= " amt".$vId."  = '$amt', ";
	$sql .= " vat".$vId."  = '$vat', ";
}
$sql .= " content = '$content', ";
$sql .= " discout_content = '$discout_content', ";
$sql .= " updatetime = now() ";

sql_query($sql);

insert_notify($estimate['email'], '11', $estimate['title'].' 업체 견적이 들어왔습니다.','',$estimate['idx'], '','cp2');

$sql = "select count(*) as cnt from {$g5['estimate_propose']} where estimate_idx = '$idx'";
$cnt = sql_fetch($sql);

$sql = " select * from {$g5['estimate_list']} where idx = '$idx'";
$list = sql_fetch($sql);

if($cnt['cnt'] == 1){
	kakaotalk_send($list['phone'], 'SJT_058802',  $estimate['title']);
}

alert('견적에 참여하였습니다.', G5_URL.'/estimate/partner_estimate_form.php?idx='.$idx);
?>
<?php
include_once('./_common.php');

$sql = " select * from  {$g5['estimate_propose']}
		where
			estimate_idx = '$idx'
			and rc_email = '{$member['mb_email']}' ";

$ep = sql_fetch($sql);
$meet = $ep['meet'];
$sql_common = "";
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
	$sql_common .= " attach_file = '$attach_file', ";
}

$sql = " update {$g5['estimate_propose']} set
			{$sql_common}
			price = '$total_amt',
			content = '$content',
			meet = '0'
		where
			estimate_idx = '$idx'
			and rc_email = '{$member['mb_email']}' ";

sql_query($sql);
//echo $sql.'<br>';

$sql = " update {$g5['estimate_propose_detail']} set ";
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
$sql .= " where ";
$sql .= " estimate_idx = '$idx' ";
$sql .= " and rc_email = '{$member['mb_email']}' ";

//echo $sql.'<br>';
sql_query($sql);

$sql = "select * from {$g5['estimate_list']} where idx = '$idx'";
$list = sql_fetch($sql);

insert_notify($list['email'], '11', $list['title'].' 업체 견적이 수정되었습니다.','',$idx, '','cp5');


alert('완료하였습니다.', G5_URL.'/estimate/partner_estimate_form.php?idx='.$idx);

?>
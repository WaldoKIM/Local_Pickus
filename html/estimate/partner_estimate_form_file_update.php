<?php
include_once('./_common.php');

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


$sql = " update {$g5['estimate_propose']} set
			attach_file = '$attach_file'
		where
			idx = '$sub_idx' ";

sql_query($sql);

alert('업로드 완료하였습니다.', G5_URL.'/estimate/partner_estimate_form.php?idx='.$idx);

?>
<?php
include_once('./_common.php');




$sql = " select * from  {$g5['estimate_match_propose']}
		where
			no_estimate = '$no_estimate'
			and rc_email = '{$member['mb_email']}' ";

$sql_common = "";
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


$sql = " update {$g5['estimate_match_propose']} set
			{$sql_common}
			price = '$price',
			shipping = '$shipping_pro',
			pro_as = '$as_pro',
			month_as = '$month_as',
			proposetime = now(),
			content = '$match_desc'
		where
			no_estimate = '$no_estimate' AND rc_email = '$rc_email' ";


sql_query($sql);

$sql_delete = "DELETE FROM {$g5['estimate_match_propose_detail']} WHERE "; 
$sql_delete .="no_estimate = '$no_estimate' AND ";
$sql_delete .="rc_email = '{$member['mb_email']}'";

sql_query($sql_delete);

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

/*
$sql_delete = "DELETE FROM g5_estimate_list_photo_match WHERE "; 
$sql_delete .="no_estimate = '$no_estimate' AND ";
$sql_delete .="rc_email = '{$member['mb_email']}'";

sql_query($sql_delete);
*/
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

$sql = "select * from {$g5['estimate_match']} where no_estimate = '$no_estimate'";
$list = sql_fetch($sql);
insert_notify($list['email'], '11', $list['title'].' 업체 견적이 수정되었습니다.','',$no_estimate, '','cm5');

//kakaotalk_send($list['number'], 'SJT_058641', $list['title']);    //업체서 견적 수정시. 알림톡미 템플릿이 없음

alert('견적을 수정하였습니다.', G5_URL.'/estimate/partner_estimate_match_form.php?no_estimate='.$no_estimate);

?>
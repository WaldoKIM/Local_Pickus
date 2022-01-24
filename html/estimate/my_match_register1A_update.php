<?php
include_once('./_common.php');

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

$photo1 = "";
if ($_FILES['input_photo1_file']['name']) {
	$photo1 = estimate_img_upload($_FILES['input_photo1_file']['tmp_name'], $_FILES['input_photo1_file']['name'], $img_dir);
}

$photo2 = "";
if ($_FILES['input_photo2_file']['name']) {
	$photo2 = estimate_img_upload($_FILES['input_photo2_file']['tmp_name'], $_FILES['input_photo2_file']['name'], $img_dir);
}

$photo3 = "";
if ($_FILES['input_photo3_file']['name']) {
	$photo3 = estimate_img_upload($_FILES['input_photo3_file']['tmp_name'], $_FILES['input_photo3_file']['name'], $img_dir);
}

$photo4 = "";
if ($_FILES['input_photo4_file']['name']) {
	$photo4 = estimate_img_upload($_FILES['input_photo4_file']['tmp_name'], $_FILES['input_photo4_file']['name'], $img_dir);
}

$photo5 = "";
if ($_FILES['input_photo5_file']['name']) {
	$photo5 = estimate_img_upload($_FILES['input_photo5_file']['tmp_name'], $_FILES['input_photo5_file']['name'], $img_dir);
}

$photo6 = "";
if ($_FILES['input_photo6_file']['name']) {
	$photo6 = estimate_img_upload($_FILES['input_photo6_file']['tmp_name'], $_FILES['input_photo6_file']['name'], $img_dir);
}



$sql = " insert into {$g5['match_list']} set
			sub_key = '$sub_key',
			email = '$email',
			nickname = '$nickname',
			phone = '$phone',
			title = '$title',
			match_area = '$match_area',
			price = '$price',
			content = '$content',
			area1 = '$area1',
			area2 = '$area2', 
			area3 = '$area3',
			floor = '$floor',
			elevator_yn = '$elevator_yn',
			photo1 = '$photo1', 
			photo2 = '$photo2',
			photo3 = '$photo3',
			photo4 = '$photo4',
			photo5 = '$photo5',
			photo6 = '$photo6',
			photo1_rotate = '$photo1_rotate', 
			photo2_rotate = '$photo2_rotate',
			photo3_rotate = '$photo3_rotate',
			photo4_rotate = '$photo4_rotate',
			photo5_rotate = '$photo5_rotate',
			photo6_rotate = '$photo6_rotate',
			state = '0',
			type = '$type',
			writetime = now() ";

sql_query($sql);

$option_count = (isset($_POST['item_cat']) && is_array($_POST['item_cat'])) ? count($_POST['item_cat']) : array();
if($option_count) {
	for($i=0; $i<$option_count; $i++) {
		$item_cat     = $_POST['item_cat'][$i];
		$item_cat_dtl = $_POST['item_cat_dtl'][$i];
		$manufacturer = $_POST['manufacturer'][$i];
		$medel_name   = $_POST['medel_name'][$i];
		$year         = $_POST['year'][$i];
		$use_year     = $_POST['use_year'][$i];
		$item_qty     = $_POST['item_qty'][$i];
		$sql = " insert into {$g5['match_list_multi']} set
					sub_key = '$sub_key',
					item_cat = '$item_cat',
					item_cat_dtl = '$item_cat_dtl',
					manufacturer = '$manufacturer',
					medel_name = '$medel_name',
					year = '$year',
					use_year = '$use_year',
					item_qty = '$item_qty',
					writetime = now() ";
					
		sql_query($sql);
	}

}

if (!$is_member) {
	$sql = " select * from {$g5['member_table']} where mb_email = '$email' ";
	$mm = sql_fetch($sql);
	if(!$mm){
	    $sql = " insert into {$g5['member_table']} set 
	    				mb_id = '$email',
	                    mb_password_type = 'md5',
	                    mb_name = '$nickname',
	                    mb_email = '$email',
	                    mb_level = '8',
	                    mb_hp = '$phone',
	                    mb_datetime = now(),
	                    mb_email_certify = now(),
	                    mb_open = '1' ";	
	    sql_query($sql);	

        set_session('ss_mb_id', $email);

        set_session('ss_mb_reg', $email);
        	    
	}
}
alert("중고매칭이 신청되었습니다.","./my_match_list.php");
?> 

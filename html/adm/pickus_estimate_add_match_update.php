<?php
$sub_menu = "400210";
include_once('./_common.php');
include_once(G5_LIB_PATH.'/shop.lib.php');    // URL 함수 파일
auth_check($auth[$sub_menu], 'r');

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

$sql_common = "";

if($e_type == "0"){
	$title = $item_cat.' '.$manufacturer.' '.$item_cat_dtl;
}
$sql_common .= " email = '$email',
				 name = '$nickname',
				 title = '$title',
				 area1 = '$area1',
				 area2 = '$area2',
				 place = '$area3',
				 jangso = '$jangso',
				 etc_req = '$content',
				 cate = '$item_cat',
				 date_close = '$deadline',
				 date_req = '$date_req',
				 no_estimate = '$no_estimate'";

$sql = " insert into {$g5['estimate_match']} set {$sql_common} ";

sql_query($sql);

$option_count = (isset($_POST['cate_name']) && is_array($_POST['cate_name'])) ? count($_POST['cate_name']) : array();
if($option_count) {
	for($i=0; $i<$option_count; $i++) {
		$item_cat     = $_POST['cate_name'][$i];
		$item_qty     = $_POST['qty'][$i];

		$sql_info = "insert into g5_estimate_match_info set
					no_estimate = '$no_estimate',
					cate_name = '$item_cat',
					qty = $item_qty,
					email = '$email' ";
		sql_query($sql_info);
	}

}

goto_url("./pickus_estimate_list_match.php");

?> 

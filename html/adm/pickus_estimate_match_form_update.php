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
				 date_req = '$pickup_date',
				 area1 = '$area1',
				 area2 = '$area2',
				 place = '$area3',
				 etc_req = '$content',
				 date_close = '$deadline',
				 date_req = '$date_req'";
if($w == "u"){
	$sql .= " update {$g5['estimate_match']} set {$sql_common} where no_estimate = '$no_estimate' ";
}else{
	$sql .= " insert into {$g5['estimate_match']} set {$sql_common} ";
}

//echo $sql.'<br>';
sql_query($sql);

if($w == ""){
	$sql = " select max(no_estimate) as no_estimate from {$g5['estimate_match']} where email = '$email' ";
	$estimate = sql_fetch($sql);
	$no_estimate = $estimate['no_estimate'];
	echo $sql.'<br>';	
}



$sql = " delete from {$g5['estimate_list_multi']} where sub_key = '$sub_key' ";
sql_query($sql);
//echo $sql.'<br>';
$option_count = (isset($_POST['item_cat_m']) && is_array($_POST['item_cat_m'])) ? count($_POST['item_cat_m']) : array();
if($option_count) {
	for($i=0; $i<$option_count; $i++) {
		$item_cat     = $_POST['item_cat_m'][$i];
		$item_cat_dtl = $_POST['item_cat_dtl_m'][$i];
		$manufacturer = $_POST['manufacturer_m'][$i];
		$medel_name   = $_POST['medel_name_m'][$i];
		$year         = $_POST['year_m'][$i];
		$use_year     = $_POST['use_year_m'][$i];
		$item_qty     = $_POST['item_qty_m'][$i];
		$sql = " insert into {$g5['estimate_list_multi']} set
					sub_key = '$sub_key',
					item_cat = '$item_cat',
					item_cat_dtl = '$item_cat_dtl',
					manufacturer = '$manufacturer',
					medel_name = '$medel_name',
					year = '$year',
					use_year = '$use_year',
					item_qty = '$item_qty' ";
		//echo $sql.'<br>';		
		sql_query($sql);
	}

}

$qstr = '';
$qstr .= '?set=' . urlencode($set);
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
$qstr .= '&amp;page=' . urlencode($page);

goto_url("./pickus_estimate_list_match.php".$qstr);

?> 

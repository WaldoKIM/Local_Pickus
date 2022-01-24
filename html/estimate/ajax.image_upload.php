<?php
include_once("./_common.php");

$datetime = G5_TIME_YMD;
$cur_year = date("Y", strtotime($datetime));
$cur_month = date("m", strtotime($datetime));
$cur_day = date("d", strtotime($datetime));

$img_dir_year = G5_DATA_PATH.'/estimate/'.$cur_year;
@mkdir($img_dir_year, G5_DIR_PERMISSION, true);
@chmod($img_dir_year, G5_DIR_PERMISSION);

$img_dir_month = $img_dir_year.'/'.$cur_month;
@mkdir($img_dir_month, G5_DIR_PERMISSION, true);
@chmod($img_dir_month, G5_DIR_PERMISSION);

$img_dir = $img_dir_month.'/'.$cur_day;
@mkdir($img_dir, G5_DIR_PERMISSION, true);
@chmod($img_dir, G5_DIR_PERMISSION);

if ($_FILES['et_img']['name']) {
	$et_img = estimate_img_upload($_FILES['et_img']['tmp_name'], $_FILES['et_img']['name'], $img_dir);

	$file = G5_DATA_PATH.'/estimate/'.$et_img;
  	$filename = basename($file);
    $filepath = dirname($file);

    $thumb_width = 350;
    $thumb_height = 350;
    $thumb_img = thumbnail($filename, $filepath, $filepath, $thumb_width, $thumb_height, false, true, 'center', true, $um_value='80/0.5/3');

    printf($et_img.','.$cur_year.'/'.$cur_month.'/'.$cur_day.'/'.$thumb_img);

    //printf($et_img.','.$et_img);
}





?>
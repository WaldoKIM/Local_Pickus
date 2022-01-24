<?php
$sub_menu = "300150";
include_once("./_common.php");
include_once(G5_LIB_PATH.'/shop.lib.php');    // URL 함수 파일
$qstr = '';
$qstr .= 'page=' . urlencode($page);

$sqlcommon = " ";


//사진을 등록한다.
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
$photo = "";
if ($_FILES['photo']['name']) {
    $photo = estimate_img_upload($_FILES['photo']['tmp_name'], $_FILES['photo']['name'], $img_dir);
}else{
    alert("이미지를 등록하십시오.");
}

$sql = " insert into {$g5['popup_table']} set 
                 photo = '$photo',
                 state = '$state',
                 updatetime = now() ";
sql_query($sql);

goto_url('./pickus_popup_list.php?'.$qstr, false);
?>
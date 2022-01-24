<?php
$sub_menu = "300135";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_LIB_PATH.'/shop.lib.php');    // URL 함수 파일
$qstr = '';
$qstr .= 'page=' . urlencode($page);

$sqlcommon = "  title = '{$_POST['title']}',
                 content = '{$content}' ";


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

if ($_FILES['photo1']['name']) {
    $photo1 = estimate_img_upload($_FILES['photo1']['tmp_name'], $_FILES['photo1']['name'], $img_dir);
    $sqlcommon .= " , photo1 = '$photo1' ";
}

if ($_FILES['photo2']['name']) {
    $photo2 = estimate_img_upload($_FILES['photo2']['tmp_name'], $_FILES['photo2']['name'], $img_dir);
    $sqlcommon .= " , photo2 = '$photo2' ";
}

if ($_FILES['photo3']['name']) {
    $photo3 = estimate_img_upload($_FILES['photo3']['tmp_name'], $_FILES['photo3']['name'], $img_dir);
    $sqlcommon .= " , photo3 = '$photo3' ";
}

if ($w == '') {
    $sql = " insert into {$g5['forum_table']} set 
                     {$sqlcommon}
                     , hit = 0
                     , updatetime = now() ";
    sql_query($sql);
} else if ($w == 'u') {

    $sql = " update {$g5['forum_table']} set 
                    {$sqlcommon}
              where idx = '$idx' ";

    //echo $sql;

    sql_query($sql);
}

goto_url('./pickus_forum_list.php?'.$qstr, false);
?>
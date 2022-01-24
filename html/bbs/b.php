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

if($_FILES['upload_file']['name']){
	$file_name = $_FILES['upload_file']['name'];
	$tmp_file= $_FILES['upload_file']['tmp_name'];

	$file_path = $img_dir.'/'.$file_name;

	if (move_uploaded_file($tmp_file, $file_path)) {
	  echo "파일이 존재하고, 성공적으로 업로드 되었습니다.";
	  echo "추가 디버깅 정보입니다:\n";
	  print_r($_FILES);
	} else {
	  echo "파일 업로드 공격의 가능성이 있습니다! 디버깅 정보입니다:\n";
	  print_r($_FILES);
	  echo $file_path;
	}
}else{
	echo '파일없음';
	echo "file error:".$_FILES['upload_file']['error'];
	//************ 오류 코드 ***************************
	// 0 : 성공
	// 1 : php.ini 의 upload_max_filesize 보다 큽니다.
	// 2 : html 폼에서 지정한  max file size 보다 큽니다.
	// 3 : 파일이 일부분만 전송되었습니다.
	// 4 : 파일이 전송되지 않았습니다.
	// 6 : 임시 폴더가 없습니다.
	// 7 : 디스크에 파일 쓰기를 실패하였습니다.
	// 8 : 확장에 의해 파일 업로드가 중지되었습니다.
	//************ 오류 코드 ***************************
	print_r($_FILES);
}


?>
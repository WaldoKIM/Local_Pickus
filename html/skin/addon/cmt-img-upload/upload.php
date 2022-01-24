<?php
include_once('./_common.php');
@include_once(G5_LIB_PATH.'/json.lib.php');

// 결과전송
function print_result($error, $success, $name='') {
	echo '{ "error": "' . $error . '", "success": "' . $success . '", "name": "' . $name . '" }';
	exit;
}

// 초기값
$error = $success = $name = '';

if(!$wname) {
	$error = '값이 제대로 넘어오지 않았습니다.';
	print_result($error, $success);
}

// 경로설정
$widget_path = G5_SKIN_PATH.'/addon/'.$wname;
if(is_file($widget_path.'/_api.php')) {
	include_once($widget_path.'/_api.php');
} else {
	$error = '올바른 방법으로 이용해 주십시오.';
	print_result($error, $success);
}

// 존재체크
if($bo_table) {
	if(!$board['bo_table']) {
		$error = '올바른 방법으로 이용해 주십시오.';
		print_result($error, $success);
	}
} else if($it_id) {
	$it = apms_id($it_id);
	if(!$it['it_id']) {
		$error = '올바른 방법으로 이용해 주십시오.';
		print_result($error, $success);
	}
} else {
	$error = '값이 제대로 넘어오지 않았습니다.';
	print_result($error, $success);
}

// 등록권한
$is_comment_write = '';
if($bo_table) {
	if($is_guest && !$is_guest_upload) {
		$is_comment_write = '로그인한 회원만 등록가능합니다.';
	} else if ($member['mb_level'] >= $board['bo_comment_level']) {
		;
	} else {
		$is_comment_write = ($is_guest) ? '로그인한 회원만 등록가능합니다.' : '이미지를 등록할 권한이 없습니다.';
	}
} else if($it_id && $is_guest) {
	$is_comment_write = '로그인한 회원만 등록가능합니다.';
}

if($is_comment_write) {
	print_result($is_comment_write, $success);
}

// 정리
$attach = $_FILES['img_upload'];

$tmpfile = $attach['tmp_name'];
$filesize  = $attach['size'];
$filename  = $attach['name'];
$filename  = get_safe_filename($filename);

if(!$filename) {
	$error = '올바른 파일명이 아니거나 파일이 정상적으로 업로드 되지 않았습니다.';
	print_result($error, $success);
}

$upload_max_filesize = ini_get('upload_max_filesize');
$max_filesize = $is_max_upload * 1024 * 1024;

if(!$filesize) {
	$error = '0 byte 파일은 업로드 할 수 없습니다.';
	print_result($error, $success);
} else if($filesize > $max_filesize) {
	$error = $is_max_upload.'MB이내 파일만 업로드 할 수 있습니다.';
	print_result($error, $success);

}

if ($attach['error'] == 1) {
	$error = '파일의 용량이 서버에 설정('.ini_get('upload_max_filesize').')된 값보다 크므로 업로드 할 수 없습니다.';
	print_result($error, $success);
}

$is_imgfile = false;
if (preg_match("/(jpg|gif|png)$/i", apms_get_ext(basename($filename)))) { 
	$is_imgfile = true;
}

if($is_img_upload && !$is_imgfile) {
	$error = '이미지(JPG/GIF/PNG)파일만 업로드 할 수 있습니다.';
	print_result($error, $success);
} else {
	// 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
	$filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
}

// Imgur
if($is_imgfile && $is_imgur_upload) {

	if(!$imgur_client_id) {
		$error = 'Imgur Client ID를 _api.php 파일에 등록해 주세요.';
		print_result($error, $success);
	}

	$handle = fopen($tmpfile, "r");
	$data = fread($handle, filesize($tmpfile));
	$pvars   = array('image' => base64_encode($data));

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $imgur_client_id));
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$out = curl_exec($curl);
	curl_close ($curl);
	$pms = json_decode($out,true);

	$url = $pms['data']['link'];

	if($url){
		print_result($error, $url);
	} else {
		$error = ($pms['data']['error']) ? $pms['data']['error'] : '파일 업로드 중 오류가 발생하였습니다.';
		print_result($pms['data']['error'], $success);
	}

} else {

	if(is_uploaded_file($tmpfile)) {

		$ym = date('ym', G5_SERVER_TIME);

		$data_dir = G5_DATA_PATH.'/editor/'.$ym;
		$data_url = G5_DATA_URL.'/editor/'.$ym;

		@mkdir($data_dir, G5_DIR_PERMISSION);
		@chmod($data_dir, G5_DIR_PERMISSION);

		$filename = basename($filename);

		$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
		shuffle($chars_array);
		$shuffle = implode('', $chars_array);
		$file_head = ($is_imgfile) ? 'img' : 'file';
		$file_name = $file_head.'_'.abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);
		$save_dir = sprintf('%s/%s', $data_dir, $file_name);
		$save_url = sprintf('%s/%s', $data_url, $file_name);
		
		@move_uploaded_file($tmpfile, $save_dir);

		@chmod($save_dir, G5_FILE_PERMISSION);

		if($is_imgfile) {
			$success = $save_url;
		} else {
			$name = $filename;
			$success = sprintf('%s/%s', str_replace(G5_DATA_PATH.'/editor/', '', $data_dir), $file_name);
		}
	} else {
		// refer to error code : http://www.php.net/manual/en/features.file-upload.errors.php
		$error = $attach['error'];
		if(!$error) $error = 'err';
	}

	// Result
	if($success) {
		print_result($error, $success, $name);
	} else {
		switch($error) {
			case '1'	: $error = '업로드 용량 제한에 걸렸습니다.'; break; 
			case '2'	: $error = '업로드 용량 제한에 걸렸습니다.'; break;
			case '3'	: $error = '파일이 일부분만 전송되었습니다.'; break;
			case '4'	: $error = '파일이 전송되지 않았습니다.'; break;
			case '6'	: $error = '임시 폴더가 없어 업로드 할 수 없습니다.'; break;
			case '7'	: $error = '파일 쓰기에 실패했습니다.'; break;
			case '8'	: $error = '알수 없는 오류입니다.'; break;
			default		: $error = '오류가 발생하였습니다.'; break;
		}
		print_result($error, $success);
	}
}
?>
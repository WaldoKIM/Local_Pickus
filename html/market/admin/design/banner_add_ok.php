<?
include('../../common.php'); 
//if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;

if( $_POST[title] ) {	
	$_POST[title] = $db->stripSlash ( $_POST[title] );
	$_POST[title] = $db->addSlash ( $_POST[title] );
	if( $_POST[type] == 1 ) {
		//$_POST[content] = $db->stripSlash ( $_POST[content] );
		//$_POST[content] = $db->addSlash ( $_POST[content] );
		$_POST[link_url] = "";
		$_POST[banner_images] = "";
	} else {
		$_POST[content] = "";
		if( $_FILES[banner_images][size] > 0 ) {
			if( $_FILES[banner_images][size] > 1024*1024*4) { $tools->errMsg('업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다'); }
			$banner_images = 'BANNER_'.time();
			if( !@move_uploaded_file( $_FILES[banner_images][tmp_name], "../../data/designImages/".$banner_images )) { $tools->errMsg('파일 업로드 에러'); } else { @unlink($_FILES[banner_images][tmp_name]); } 
		} else {
			$tools->errMsg('이미지를 등록해 주세요');
		}
	}

	// 디비 입력
	$sql="type='$_POST[type]', status='$_POST[status]', title='$_POST[title]', link_url='$_POST[link_url]', target='$_POST[target]', banner_images='$banner_images', img_width='$_POST[img_width]', img_height='$_POST[img_height]', content='$_POST[content]'";
	if( $db->insert("cs_banner", $sql) ) { $tools->alertJavaGo('베너 등록 되었습니다.', 'banner.php?code='.$_POST[code]); } else { @unlink("../../data/designImages/".$banner_images); $tools->errMsg('비상적으로 입력 되었습니다.');}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

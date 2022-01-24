<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;

if( $_POST[title_bar] ) {	
	$_POST[title_bar] = $db->addSlash ( $_POST[title_bar] );
	$start_day = mktime( 0, 0, 0, $_POST[start_mon], $_POST[start_day], $_POST[start_year] );
	$end_day = mktime( 0, 0, 0, $_POST[end_mon], $_POST[end_day], $_POST[end_year] );
	if( $start_day >= $end_day ) {	$tools->errMsg('팝업창 시작일과 종료일이 \n\n같은일이나 이전일 경우 등록 되지 않습니다.');}
	if( $_POST[display] == 0 ) {
		//$_POST[content] = $db->addSlash ( $_POST[content] );
		$_POST[link_url] = "";
		$_POST[popup_images] = "";
	} else if( $_POST[display] == 1 ) {
		if( $_FILES[popup_images][size] > 0 ) {
			if( !strstr($_FILES[popup_images][type], 'image')) { $tools->errMsg('이미지 파일만 등록 가능합니다.'); }
			if( $_FILES[popup_images][size] > 1024*1024*4) { $tools->errMsg('업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다'); }
			$popup_images = 'POPUP_'.time();
			if( !@move_uploaded_file( $_FILES[popup_images][tmp_name], "../../data/designImages/".$popup_images )) { $tools->errMsg('파일 업로드 에러'); } else { @unlink($_FILES[popup_images][tmp_name]); } 
		} else {
			$tools->errMsg('이미지를 등록해 주세요');
		}
		$_POST[content] = "";
	}

	// 디비 입력
	$sql="display='$_POST[display]', start_day='$start_day', end_day='$end_day', width='$_POST[width]', height='$_POST[height]',  top='$_POST[top]', lefts='$_POST[lefts]', live='$_POST[live]', title_bar='$_POST[title_bar]', link_url='$_POST[link_url]', popup_images='$popup_images', content='$_POST[content]', popup_display='$_POST[popup_display]', layercolor='$_POST[layercolor]', bgcolor='$_POST[layerbccolor]'";
	if( $db->insert("cs_popup", $sql) ) { $tools->alertJavaGo('팝업창을 등록 되었습니다.', 'popup.php'); } else { @unlink("../../data/designImages/".$popup_images); $tools->errMsg('비상적으로 입력 되었습니다.');}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

if( $_POST[page_index] ) {	
	// 중복 검색
	if( $db->cnt("cs_page", "where page_index='$_POST[page_index]'")) { $tools->errMsg('등록된 PAGE INDEX 존재합니다\n\n다른 이름으로 등록해 주세요');}
	//$_POST[title] = $db->addSlash ( $_POST[title] );
	//$_POST[content] = $db->addSlash ( $_POST[content] );
	// 디비 입력
	
	if( $_FILES[title_img][size] > 0 ) {
		//등록한 확장자 가져오기
		$TempExt = explode(".",$_FILES[title_img][name]); 
		if( $_FILES[title_img][size] > 1024*1024*1) { $tools->errMsg("업로드 용량 초과입니다\\n\\n1메가 까지 업로드 가능합니다"); exit(); }
		$title_img = 'title_img_'.time().".".$TempExt[count($TempExt)-1];
		if( !@move_uploaded_file( $_FILES[title_img][tmp_name], "../../data/designImages/".$title_img )) {
			$tools->errMsg("파일 업로드 에러"); 
		} else {
			//원본삭제
			@unlink("../../data/designImages/".$info->title_img); 
			//임시파일삭제
			@unlink($_FILES[title_img][tmp_name]); 
		} 
	}
	
	$sql="page_index='$_POST[page_index]', title='$_POST[title]', title_img='$title_img', width='$_POST[width]', height='$_POST[height]', tag='$_POST[tag]', content='$_POST[content]'";
	if( $db->insert("cs_page", $sql) ) { $tools->alertJavaGo('페이지가 추가 되었습니다.', 'page.php'); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

if( $_POST[page_index] ) {	
	$_POST[title] = $db->stripSlash ( $_POST[title] );
	//$_POST[content] = $db->stripSlash ( $_POST[content] );
	$_POST[title] = $db->addSlash ( $_POST[title] );
	//$_POST[content] = $db->addSlash ( $_POST[content] );
	$info = $db->object("cs_page", "where idx='$_POST[idx]'");

	if($_POST[title_img_del]){
		@unlink("../../data/designImages/".$info->title_img); 
		$title_img = "";
		$_POST[width] = "";
		$_POST[height] = "";
	}else{
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
		}else{
			$title_img = $info->title_img;
			$_POST[width] = $info->width;
			$_POST[height] = $info->height;
		}
	}

	$_POST[content] = preg_replace('/\'/','`',$_POST[content]);

	// 디비 입력
	$sql="page_index='$_POST[page_index]', title='$_POST[title]', title_img='$title_img', width='$_POST[width]', height='$_POST[height]', tag='$_POST[tag]', content='$_POST[content]' where idx='$_POST[idx]'";
	if( $db->update("cs_page", $sql)) { $tools->alertJavaGo('페이지가 수정 되었습니다.', 'page.php'); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

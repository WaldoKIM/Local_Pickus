<?
include('../../common.php'); 
//admin 접근제어
$info = $db->object("cs_design", "");

//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

if($_POST[del_bookmarkicon]){
	@unlink("../../data/designImages/".$info->bookmarkicon); 
	$bookmarkicon_img = "";
}else{
	if( $_FILES[bookmarkicon][size] > 0 ) {
		//등록한 확장자 가져오기
		$TempExt = explode(".",$_FILES[bookmarkicon][name]); 
		if( $_FILES[bookmarkicon][size] > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n$MAXFILESIZE메가 까지 업로드 가능합니다"); exit(); }
		$bookmarkicon_img = 'TITLE_BOOKMARK_'.time().".".$TempExt[count($TempExt)-1];
		if( !@move_uploaded_file( $_FILES[bookmarkicon][tmp_name], "../../data/designImages/".$bookmarkicon_img )) {
			$tools->errMsg("파일 업로드 에러"); 
		} else {
			//원본삭제
			@unlink("../../data/designImages/".$info->bookmarkicon); 
			//임시파일삭제
			@unlink($_FILES[bookmarkicon][tmp_name]); 
		} 
	}else{
		$bookmarkicon_img = $info->bookmarkicon;
	}
}

if($_POST[del_icoicon]){
	@unlink("../../data/designImages/".$info->icoicon); 
	$icoicon_img = "";
}else{
	if( $_FILES[icoicon][size] > 0 ) {
		//등록한 확장자 가져오기
		$TempExt = explode(".",$_FILES[icoicon][name]); 
		if( $_FILES[icoicon][size] > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n$MAXFILESIZE메가 까지 업로드 가능합니다"); exit(); }
		$icoicon_img = 'TITLE_ICO_'.time().".".$TempExt[count($TempExt)-1];
		if( !@move_uploaded_file( $_FILES[icoicon][tmp_name], "../../data/designImages/".$icoicon_img )) {
			$tools->errMsg("파일 업로드 에러"); 
		} else {
			//원본삭제
			@unlink("../../data/designImages/".$info->icoicon); 
			//임시파일삭제
			@unlink($_FILES[icoicon][tmp_name]); 
		} 
	}else{
		$icoicon_img = $info->icoicon;
	}
}

// 디비 입력
$sql="bookmarkicon='$bookmarkicon_img', icoicon='$icoicon_img'";
if( $db->update("cs_design", $sql) ) { $tools->alertMetaGo("브라우저 정보가 변경 되었습니다.", "design.php"); } else {$tools->errMsg('비상적으로 입력 되었습니다.');}
?>

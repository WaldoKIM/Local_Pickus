<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;
$info = $db->object("cs_design", "");

	if($_POST[del_top_logo]){
		@unlink("../../data/designImages/".$info->title_logo); 
		$title_logo_img = "";
	}else{
		if( $_FILES[title_logo][size] > 0 ) {
			//등록한 확장자 가져오기
			$TempExt = explode(".",$_FILES[title_logo][name]); 
			if( $_FILES[title_logo][size] > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n$MAXFILESIZE메가 까지 업로드 가능합니다"); exit(); }
			$title_logo_img = 'TITLE_LOGO_'.time().".".$TempExt[count($TempExt)-1];
			if( !@move_uploaded_file( $_FILES[title_logo][tmp_name], "../../data/designImages/".$title_logo_img )) {
				$tools->errMsg("파일 업로드 에러"); 
			} else {
				//원본삭제
				@unlink("../../data/designImages/".$info->title_logo); 
				//임시파일삭제
				@unlink($_FILES[title_logo][tmp_name]); 
			} 
		}else{
			$title_logo_img = $info->title_logo;
		}
	}

	if($_POST[del_top_mobile_logo]){
		@unlink("../../data/designImages/".$info->title_mobile_logo); 
		$title_mobile_logo_img = "";
	}else{
		if( $_FILES[title_mobile_logo][size] > 0 ) {
			//등록한 확장자 가져오기
			$TempExt = explode(".",$_FILES[title_mobile_logo][name]); 
			if( $_FILES[title_mobile_logo][size] > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n$MAXFILESIZE메가 까지 업로드 가능합니다"); exit(); }
			$title_mobile_logo_img = 'TITLE_MOBILE_LOGO_'.time().".".$TempExt[count($TempExt)-1];
			if( !@move_uploaded_file( $_FILES[title_mobile_logo][tmp_name], "../../data/designImages/".$title_mobile_logo_img )) {
				$tools->errMsg("파일 업로드 에러"); 
			} else {
				//원본삭제
				@unlink("../../data/designImages/".$info->title_mobile_logo); 
				//임시파일삭제
				@unlink($_FILES[title_mobile_logo][tmp_name]); 
			} 
		}else{
			$title_mobile_logo_img = $info->title_mobile_logo;
		}
	}
	if($_POST[del_buttom_logo]){
		@unlink("../../data/designImages/".$info->title_logo2); 
		$title_logo2_img = "";
	}else{
		if( $_FILES[title_logo2][size] > 0 ) {
			//등록한 확장자 가져오기
			$TempExt = explode(".",$_FILES[title_logo2][name]); 
			if( $_FILES[title_logo2][size] > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n1메가 까지 업로드 가능합니다"); exit(); }
			$title_logo2_img = 'TITLE_logo2_'.time().".".$TempExt[count($TempExt)-1];
			if( !@move_uploaded_file( $_FILES[title_logo2][tmp_name], "../../data/designImages/".$title_logo2_img )) {
				$tools->errMsg("파일 업로드 에러"); 
			} else {
				//원본삭제
				@unlink("../../data/designImages/".$info->title_logo2); 
				//임시파일삭제
				@unlink($_FILES[title_logo2][tmp_name]); 
			} 
		}else{
			$title_logo2_img = $info->title_logo2;
		}
	}

	// 디비 입력
$sql="title_logo='$title_logo_img', title_mobile_logo='$title_mobile_logo_img', title_logo2='$title_logo2_img'";
if( $db->update("cs_design", $sql) ) { $tools->alertMetaGo("타이틀 로고가 변경되었습니다.", "design.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}
?>

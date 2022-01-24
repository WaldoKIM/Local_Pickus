<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
$info = $db->object("cs_design", "");

// 디비 입력
if( $_FILES[footerbg_img][size] > 0 ) {
	$TempExt = explode(".",$_FILES[footerbg_img][name]); 
	if( $_FILES[footerbg_img][size] > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n1메가 까지 업로드 가능합니다"); exit(); }
	$footerbg_img_img = 'footerbg_img_'.time().".".$TempExt[count($TempExt)-1];
	if( !@move_uploaded_file( $_FILES[footerbg_img][tmp_name], "../../data/designImages/".$footerbg_img_img )) {
		$tools->errMsg("파일 업로드 에러"); 
	} else {
		//원본삭제
		@unlink("../../data/designImages/".$info->footerbg_img); 
		//임시파일삭제
		@unlink($_FILES[footerbg_img][tmp_name]); 
	} 
}else{
	$footerbg_img_img = $info->footerbg_img;
}

$sql = "
	footerbg='$_POST[footerbg]',
	footerbg_color='$_POST[footerbg_color]',
	footerbg_img='$footerbg_img_img'
";
if( $db->update("cs_design", $sql) ) { $tools->alertJavaGo('수정 되었습니다.', 'footerbg.php'); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}
?>

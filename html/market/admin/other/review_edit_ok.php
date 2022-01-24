<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
$mv_data	= $_POST[review_data];
$review_data	= $tools->decode( $_POST[review_data] );
$idx = $review_data[idx];
$Info = $db->object("cs_goods_review", "where idx='$idx'");

// 디비에 입력
if($_POST[del_bbs_file]){
	 @unlink("../../data/bbsData/".$Info->bbs_file);
	$file_name	= "none";
}else{
	if( $_FILES[bbs_file][size] > 0 ) {
		@unlink( "../../data/bbsData/".$Info->bbs_file );
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[bbs_file][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[bbs_file][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n$MAXFILESIZE 메가 까지 업로드 가능합니다"); exit(); }
		$file_name	= time()."&&BBS_FILE".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[bbs_file][tmp_name], "../../data/bbsData/".$file_name) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[bbs_file][tmp_name]);	} 
	} else {
		$file_name 	= $Info->bbs_file;
	}
}

if( $db->update("cs_goods_review", "title='$_POST[title]',bbs_file='$file_name', content='$_POST[content]' where idx=$idx") ) { $tools->alertJavaGo("수정 하였습니다.", "review.php?review_data=$mv_data"); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}
?>

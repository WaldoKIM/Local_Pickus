<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
//$_GET=&$HTTP_GET_VARS;

if($_POST[mode]=="add"){

	if( $_FILES[icon][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[icon][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[icon][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$iconImg	= time()."&&icon.".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[icon][tmp_name], "../../data/designImages/".$iconImg) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[icon][tmp_name]);	} 
	} else {
		$iconImg 	= "";
	}
	$sql = "name='$_POST[name]',code='$_POST[code]', icon='$iconImg'";
	// 디비 입력
	If( $db->insert("cs_icon_list", $sql)) { $tools->alertJavaGo("저장 완료 되었습니다.", "icon_list.php?code=".$_POST[code]); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }

}elseif($_POST[mode]=="edit"){

	$info = $db->object("cs_icon_list", "where idx=$_POST[idx]");
	if( $_FILES[icon][size] > 0 ) {
		@unlink( "../../data/designImages/".$info->icon);
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[icon][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[icon][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$iconImg	= time()."&&icon.".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[icon][tmp_name], "../../data/designImages/".$iconImg) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[icon][tmp_name]);	} 
	} else {
		$iconImg 	= $info->icon;
	}
	$sql = "name='$_POST[name]', icon='$iconImg' where idx='$_POST[idx]'";
	// 디비 입력
	If( $db->update("cs_icon_list", $sql)) { $tools->alertJavaGo("수정 완료 되었습니다.", "icon_list.php?code=".$_POST[code]); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }

}else{
	$info = $db->object("cs_icon_list", "where idx=$_GET[idx]");
	@unlink( "../../data/designImages/".$info->icon);
	$sql = "where idx='$_GET[idx]'";
	// 디비 입력
	If( $db->delete("cs_icon_list", $sql)) { $tools->alertJavaGo("삭제 완료 되었습니다.", "icon_list.php?code=".$_GET[code]); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }
}
?>

<?
include('../common.php');
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;
$MV_DATA	= $_POST["board_data"];
$bbs_data	= $tools->decode( $_POST["board_data"] );
$idx = $bbs_data["idx"];

$MV_SEARCH_ITEM	= $_POST["search_items"];
$SEARCH_ITEM	= $tools->decode( $_POST["search_items"] );

$code = $SEARCH_ITEM["code"];
$bbs_admin_stat		=	$db->object("cs_bbs", "where code='$code'");

if($bbs_admin_stat->signcheck==1){
	if($_SESSION["text"] != $_POST["imagecode"])$tools->errMsg('보안코드값이 정확하지 않습니다. 다시 입력하여 주세요.');
}

// 이메일 중복 검색
//if( $_POST[email] ) { if(!$tools->chkMail($_POST[email], 1)) { $tools->errMsg('정확한 이메일주소를 입력해주세요.');}}

if( $_POST["name"] ) {
	//-------------------------------------------------------------//
	if($_POST["subject"])		{$_POST["subject"]	= $db->addSlash( $_POST["subject"] );}
	if($_POST["name"])		{$_POST["name"]		= $db->addSlash( $_POST["name"] );}
	if($_POST["email"])		{$_POST["email"]		= $db->addSlash( $_POST["email"] );}
	if($_POST["content"]) 	{$_POST["content"]	= $db->addSlash( $_POST["content"] );}
	//-------------------------------------------------------------//

	// 답변
	if( $_POST["ref"] ) {
		$db->update("cs_bbs_data", "re_step=re_step+1 where ref=$_POST[ref] and re_step > $_POST[re_step]");
		$_POST["re_step"]++;
		$_POST["re_level"]++;
	} else {		// 쓰기
		$_POST["re_step"]	= 0;
		$_POST["re_level"]= 0;
	}
	
	// 파일업로드 
	if( $_FILES[add_file1][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[add_file1][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[add_file1][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$add_file1	= time()."&&ADD_FILE1".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[add_file1][tmp_name], "../data/bbsData/".$add_file1) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file1][tmp_name]);	} 
	} else {
		$add_file1 	= "none";
	}

	// 파일업로드 
	if( $_FILES[add_file2][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[add_file2][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[add_file2][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$add_file2	= time()."&&ADD_FILE2".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[add_file2][tmp_name], "../data/bbsData/".$add_file2) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file2][tmp_name]);	} 
	} else {
		$add_file2 	= "none";
	}
	// 파일업로드 
	if( $_FILES[add_file3][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[add_file3][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[add_file3][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$add_file3	= time()."&&ADD_FILE3".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[add_file3][tmp_name], "../data/bbsData/".$add_file3) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file3][tmp_name]);	} 
	} else {
		$add_file3 	= "none";
	}
	// 파일업로드 
	if( $_FILES[add_file4][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[add_file4][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[add_file4][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$add_file4	= time()."&&ADD_FILE4".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[add_file4][tmp_name], "../data/bbsData/".$add_file4) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file4][tmp_name]);	} 
	} else {
		$add_file4 	= "none";
	}
	// 파일업로드 
	if( $_FILES[add_file5][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[add_file5][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[add_file5][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$add_file5	= time()."&&ADD_FILE5".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[add_file5][tmp_name], "../data/bbsData/".$add_file5) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file5][tmp_name]);	} 
	} else {
		$add_file5 	= "none";
	}

	// 파일업로드 
	if( $_FILES[bbs_file][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[bbs_file][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[bbs_file][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$file_name	= time()."&&BBS_FILE".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[bbs_file][tmp_name], "../data/bbsData/".$file_name) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[bbs_file][tmp_name]);	} 
	} else {
		$file_name 	= "none";
	}

	// 디비에 입력
	if( $db->insert("cs_bbs_data", "userid='$_POST[userid]', homepage='$_POST[homepage]', code='$code', hold='$_POST[hold]', category='$_POST[category]', subject='$_POST[subject]', name='$_POST[name]', pwd=PASSWORD('$_POST[pwd]'), email='$_POST[email]', read_cnt=0, reg_date=now(), content='$_POST[content]', tag='$_POST[tag]', notice='', ref='$_POST[ref]', re_level=$_POST[re_level], re_step=$_POST[re_step], bbs_file='$file_name', add_file1='$add_file1', add_file2='$add_file2', add_file3='$add_file3', add_file4='$add_file4', add_file5='$add_file5'") ) {
		if( !$_POST[ref] ) {
			//정확한 ref값 가져오기
			$refInfo = mysqli_insert_id();
			$db->update("cs_bbs_data", "ref='$refInfo' where idx='$refInfo'");
		}

		$tools->alertJavaGo("등록 하였습니다.", "bbs_list.php?board_data=".$MV_DATA."&search_items=".$MV_SEARCH_ITEM); 
	} else {
		@unlink($ROOT_DIR."/data/bbsData/".$file_name); $tools->errMsg('비상적으로 입력 되었습니다.');
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
//NO_ENGINE_SUBSTITUTION
//ONLY_FULL_GROUP_BY,​STRICT_TRANS_TABLES,​NO_ZERO_IN_DATE,​NO_ZERO_DATE,​ERROR_FOR_DIVISION_BY_ZERO,​NO_AUTO_CREATE_USER,​NO_ENGINE_SUBSTITUTION
?>

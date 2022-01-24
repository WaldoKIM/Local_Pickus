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

if( $_POST[subject] ) {
	//-------------------------------------------------------------//
	if($_POST["subject"])		{$_POST"[subject"]	= $db->stripSlash( $_POST["subject"] );}
	if($_POST["name"])		{$_POST["name"]		= $db->stripSlash( $_POST["name"] );}
	if($_POST["email"])		{$_POST["email"]		= $db->stripSlash( $_POST["email"] );}
	if($_POST["content"]) 	{$_POST["content"]	= $db->stripSlash( $_POST["content"] );}

	if($_POST["subject"])		{$_POST["subject"]	= $db->addSlash( $_POST["subject"] );}
	if($_POST["name"])		{$_POST["name"]		= $db->addSlash( $_POST["name"] );}
	if($_POST["email"])		{$_POST["email"]		= $db->addSlash( $_POST["email"] );}
	if($_POST["content"]) 	{$_POST["content"]	= $db->addSlash( $_POST["content"] );}
	//-------------------------------------------------------------//

	// 파일업로드 
	$bbs_data_stat = $db->object("cs_bbs_data", "where idx=$idx");
	if($_POST[del_add_file1]){
		 @unlink("../data/bbsData/".$bbs_data_stat->add_file1);
		$add_file1	= "none";
	}else{
		if( $_FILES[add_file1][size] > 0 ) {
			@unlink( "../data/bbsData/".$bbs_data_stat->add_file1 );
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
			if( $EXT_TMP = explode( ".", $_FILES[add_file1][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[add_file1][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
			$add_file1	= time()."&&ADD_FILE1".$code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@move_uploaded_file($_FILES[add_file1][tmp_name], "../data/bbsData/".$add_file1) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file1][tmp_name]);	} 
		} else {
			$add_file1 	= $bbs_data_stat->add_file1;
		}
	}

	if($_POST[del_add_file2]){
		 @unlink("../data/bbsData/".$bbs_data_stat->add_file2);
		$add_file2	= "none";
	}else{
		if( $_FILES[add_file2][size] > 0 ) {
			@unlink( "../data/bbsData/".$bbs_data_stat->add_file2 );
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
			if( $EXT_TMP = explode( ".", $_FILES[add_file2][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[add_file2][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
			$add_file2	= time()."&&ADD_FILE2".$code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@move_uploaded_file($_FILES[add_file2][tmp_name], "../data/bbsData/".$add_file2) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file2][tmp_name]);	} 
		} else {
			$add_file2 	= $bbs_data_stat->add_file2;
		}
	}

	if($_POST[del_add_file3]){
		 @unlink("../data/bbsData/".$bbs_data_stat->add_file3);
		$add_file3	= "none";
	}else{
		if( $_FILES[add_file3][size] > 0 ) {
			@unlink( "../data/bbsData/".$bbs_data_stat->add_file3 );
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
			if( $EXT_TMP = explode( ".", $_FILES[add_file3][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[add_file3][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
			$add_file3	= time()."&&ADD_FILE3".$code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@move_uploaded_file($_FILES[add_file3][tmp_name], "../data/bbsData/".$add_file3) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file3][tmp_name]);	} 
		} else {
			$add_file3 	= $bbs_data_stat->add_file3;
		}
	}

	if($_POST[del_add_file4]){
		 @unlink("../data/bbsData/".$bbs_data_stat->add_file4);
		$add_file4	= "none";
	}else{
		if( $_FILES[add_file4][size] > 0 ) {
			@unlink( "../data/bbsData/".$bbs_data_stat->add_file4 );
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
			if( $EXT_TMP = explode( ".", $_FILES[add_file4][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[add_file4][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
			$add_file4	= time()."&&ADD_FILE4".$code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@move_uploaded_file($_FILES[add_file4][tmp_name], "../data/bbsData/".$add_file4) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file4][tmp_name]);	} 
		} else {
			$add_file4 	= $bbs_data_stat->add_file4;
		}
	}


	if($_POST[del_add_file5]){
		 @unlink("../data/bbsData/".$bbs_data_stat->add_file5);
		$add_file5	= "none";
	}else{
		if( $_FILES[add_file5][size] > 0 ) {
			@unlink( "../data/bbsData/".$bbs_data_stat->add_file5 );
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
			if( $EXT_TMP = explode( ".", $_FILES[add_file5][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[add_file5][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
			$add_file5	= time()."&&ADD_FILE5".$code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@move_uploaded_file($_FILES[add_file5][tmp_name], "../data/bbsData/".$add_file5) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file5][tmp_name]);	} 
		} else {
			$add_file5 	= $bbs_data_stat->add_file5;
		}
	}

	if($_POST[del_bbs_file]){
		 @unlink("../data/bbsData/".$bbs_data_stat->bbs_file);
		$file_name	= "none";
	}else{
		if( $_FILES[bbs_file][size] > 0 ) {
			@unlink( "../data/bbsData/".$bbs_data_stat->bbs_file );
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
			if( $EXT_TMP = explode( ".", $_FILES[bbs_file][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[bbs_file][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
			$file_name	= time()."&&BBS_FILE".$code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@move_uploaded_file($_FILES[bbs_file][tmp_name], "../data/bbsData/".$file_name) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[bbs_file][tmp_name]);	} 
		} else {
			$file_name 	= $bbs_data_stat->bbs_file;
		}
	}

	// 디비에 입력
	if( $db->update("cs_bbs_data", "category='$_POST[category]', homepage='$_POST[homepage]', hold='$_POST[hold]', subject='$_POST[subject]', name='$_POST[name]', pwd=PASSWORD('$_POST[pwd]'), email='$_POST[email]', tag='$_POST[tag]', content='$_POST[content]', bbs_file='$file_name', add_file1='$add_file1', add_file2='$add_file2', add_file3='$add_file3', add_file4='$add_file4', add_file5='$add_file5' where idx=$idx") ) { $tools->alertJavaGo("수정 하였습니다.", "bbs_list.php?board_data=".$MV_DATA."&search_items=".$MV_SEARCH_ITEM); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

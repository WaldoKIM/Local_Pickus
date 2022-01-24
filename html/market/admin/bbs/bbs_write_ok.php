<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
$_FILES=&$HTTP_POST_FILES;
$mv_data	= $_POST[bbs_data];
$bbs_data	= $tools->decode( $_POST[bbs_data] );
$idx = $bbs_data[idx];
$code = $bbs_data[code];

		$_POST[content] = preg_replace('/\'/','`',$_POST[content]);
		
// 이메일 유무 검색
if( $_POST[email] ) { if(!$tools->chkMail($_POST[email], 1)) { $tools->errMsg('정확한 이메일주소를 입력해주세요.');}}

if( $_POST[name] ) {
	//-------------------------------------------------------------//
	if($_POST[subject])		{$_POST[subject]	= $db->addSlash( $_POST[subject] );}
	if($_POST[name])		{$_POST[name]		= $db->addSlash( $_POST[name] );}
	if($_POST[email])		{$_POST[email]		= $db->addSlash( $_POST[email] );}
	//-------------------------------------------------------------//

	// 답변
	if( $_POST[ref] ) {
		$stat = $db->object("cs_bbs_data", "where code='$code' and ref=$_POST[ref] and re_step=0 and re_level=0");
		$db->update("cs_bbs_data", "re_step=re_step+1 where ref=$_POST[ref] and re_step > $_POST[re_step]");

		//답변글이 경우 원글에 대한 체크 필요 회원이등 비회원이든 원글에 대한 비밀번호를 등록하여 이용자들이 확인가능하도록 설정
		if($_POST[hold]==1){
			$refInfo = $db->object("cs_bbs_data", "where ref='$_POST[ref]' and code='$code'");
			$_POST[pwd] = $refInfo->pwd;
		}
		$_POST[re_step]++;
		$_POST[re_level]++;
	} else {		// 쓰기
		$_POST[re_step]	= 0;
		$_POST[re_level]= 0;
	}
	
// 파일업로드 
	if( $_FILES[add_file1][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[add_file1][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[add_file1][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$add_file1	= time()."&&ADD_FILE1".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[add_file1][tmp_name], "../../data//bbsData/".$add_file1) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file1][tmp_name]);	} 
	} else {
		$add_file1 	= "none";
	}

	// 파일업로드 
	if( $_FILES[add_file2][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[add_file2][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[add_file2][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$add_file2	= time()."&&ADD_FILE2".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[add_file2][tmp_name], "../../data//bbsData/".$add_file2) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file2][tmp_name]);	} 
	} else {
		$add_file2 	= "none";
	}
	// 파일업로드 
	if( $_FILES[add_file3][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[add_file3][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[add_file3][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$add_file3	= time()."&&ADD_FILE3".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[add_file3][tmp_name], "../../data//bbsData/".$add_file3) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file3][tmp_name]);	} 
	} else {
		$add_file3 	= "none";
	}
	// 파일업로드 
	if( $_FILES[add_file4][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[add_file4][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[add_file4][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$add_file4	= time()."&&ADD_FILE4".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[add_file4][tmp_name], "../../data//bbsData/".$add_file4) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file4][tmp_name]);	} 
	} else {
		$add_file4 	= "none";
	}
	// 파일업로드 
	if( $_FILES[add_file5][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[add_file5][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[add_file5][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$add_file5	= time()."&&ADD_FILE5".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[add_file5][tmp_name], "../../data//bbsData/".$add_file5) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_file5][tmp_name]);	} 
	} else {
		$add_file5 	= "none";
	}
	// 파일업로드 
	if( $_FILES[bbs_file][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[bbs_file][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[bbs_file][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
		$file_name	= time()."&&BBSFILE".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[bbs_file][tmp_name], "../../data/bbsData/".$file_name) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[bbs_file][tmp_name]);	} 
	} else {
		$file_name 	= "none";
	}

	// 디비입력
	if($_POST[hold]==1){
		if( $db->insert("cs_bbs_data", "code='$code', homepage='$_POST[homepage]', hold='$_POST[hold]', category='$_POST[category]', subject='$_POST[subject]', name='$_POST[name]', pwd=PASSWORD('$_POST[pwd]'), email='$_POST[email]', read_cnt=0, reg_date=now(), content='$_POST[content]', notice='$_POST[notice]', ref='$_POST[ref]', re_level=$_POST[re_level], re_step=$_POST[re_step], bbs_file='$file_name', add_file1='$add_file1', add_file2='$add_file2', add_file3='$add_file3', add_file4='$add_file4', add_file5='$add_file5'") ) {
			//if( !$_POST[ref] ) {
			//	//정확한 ref값 가져오기
			//	$refInfo = mysql_insert_id();
			//	$db->update("cs_bbs_data", "ref='$refInfo' where idx='$refInfo'");
			//}
			$tools->alertJavaGo("등록 하였습니다.", "bbs_list.php?bbs_data=$mv_data"); 
		} else {
			@unlink($ROOT_DIR."/data/bbsData/".$file_name); $tools->errMsg('비상적으로 입력 되었습니다.');
		}
	}else{

		if( $db->insert("cs_bbs_data", "code='$code', homepage='$_POST[homepage]', hold='$_POST[hold]', category='$_POST[category]', subject='$_POST[subject]', name='$_POST[name]', pwd=PASSWORD('$_POST[pwd]'), email='$_POST[email]', read_cnt=0, reg_date=now(), content='$_POST[content]', notice='$_POST[notice]', ref='$_POST[ref]', re_level=$_POST[re_level], re_step=$_POST[re_step], bbs_file='$file_name', add_file1='$add_file1', add_file2='$add_file2', add_file3='$add_file3', add_file4='$add_file4', add_file5='$add_file5'") ) {
			//if( !$_POST[ref] ) {
			//	//정확한 ref값 가져오기
			//	$refInfo = mysql_insert_id();
			//	$db->update("cs_bbs_data", "ref='$refInfo' where idx='$refInfo'");
			//}
			$tools->alertJavaGo("등록 하였습니다.", "bbs_list.php?bbs_data=$mv_data"); 
		} else {
			@unlink($ROOT_DIR."/data/bbsData/".$file_name); $tools->errMsg('비상적으로 입력 되었습니다.');
		}
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

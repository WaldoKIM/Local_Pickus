<?
	include('../../common.php');

	//$_GET=&$HTTP_GET_VARS;
	//$_POST=&$HTTP_POST_VARS;
	$mv_data	= $_GET[bbs_data];
	$bbs_data	= $tools->decode( $_GET[bbs_data] );
	if( $_GET[idx] )			{ $idx = $_GET[idx]; } else { $idx = $bbs_data[idx]; }
	if( $_GET[code] )			{ $code = $_GET[code]; } else { $code = $bbs_data[code]; }
	
	if( $idx ) {
		$row = $db->object("cs_bbs_data", "where idx = $idx");
		// 자료실 삭제
		if( $row->bbs_file != "none" ) { @unlink("../../data/bbsData/".$row->bbs_file); }
		// 추가파일 삭제
		if( $row->add_file1 != "none" ) { @unlink("../../data/bbsData/".$row->add_file1); }
		if( $row->add_file2 != "none" ) { @unlink("../../data/bbsData/".$row->add_file2); }
		if( $row->add_file3 != "none" ) { @unlink("../../data/bbsData/".$row->add_file3); }
		if( $row->add_file4 != "none" ) { @unlink("../../data/bbsData/".$row->add_file4); }
		if( $row->add_file5 != "none" ) { @unlink("../../data/bbsData/".$row->add_file5); }
		// 코멘트 삭제
		$db->delete("cs_bbs_coment", "where link = $idx");
		// 작성글 삭제
		$db->delete("cs_bbs_data", "where idx = $idx");
		$tools->alertJavaGo("삭제 하였습니다.", "bbs_list.php?bbs_data=$mv_data");
	} else {
		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
	}
?>

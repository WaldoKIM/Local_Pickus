<?
include('../common.php');
$_GET=&$HTTP_GET_VARS;
$_POST=&$HTTP_POST_VARS;
$MV_DATA	= $_GET[board_data];
$bbs_data	= $tools->decode( $_GET[board_data] );
$idx = $bbs_data[idx];
$MV_SEARCH_ITEM	= $_GET[search_items];
$SEARCH_ITEM	= $tools->decode( $_GET[search_items] );
$code = $SEARCH_ITEM[code];
if($idx) {
	$bbs_stat = $db->object("cs_bbs_data", "where idx = $idx");
	if(!$_SESSION[USERID]){
		if( $bbs_stat->pwd != $_POST[pwd] ) {
			$tools->errMsg("패스워드가 올바르지 않습니다.");
		}
	}
	// 자료실 삭제
	if( $bbs_stat->bbs_file != "none" ) { @unlink("../data/bbsData/".$bbs_stat->bbs_file); }
	// 추가파일 삭제
	if( $bbs_stat->add_file1 != "none" ) { @unlink("../data/bbsData/".$bbs_stat->add_file1); }
	if( $bbs_stat->add_file2 != "none" ) { @unlink("../data/bbsData/".$bbs_stat->add_file2); }
	if( $bbs_stat->add_file3 != "none" ) { @unlink("../data/bbsData/".$bbs_stat->add_file3); }
	if( $bbs_stat->add_file4 != "none" ) { @unlink("../data/bbsData/".$bbs_stat->add_file4); }
	if( $bbs_stat->add_file5 != "none" ) { @unlink("../data/bbsData/".$bbs_stat->add_file5); }
	// 코멘트 삭제
	$db->delete("cs_bbs_coment", "where link = $idx");
	// 작성글 삭제
	$db->delete("cs_bbs_data", "where idx = $idx");
	$tools->alertJavaGo("삭제 하였습니다.", "my_bbs_list.php?board_data=".$MV_DATA."&search_items=".$MV_SEARCH_ITEM);
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$mv_data	= $_GET[bbs_data];
$bbs_data	= $tools->decode( $_GET[bbs_data] );
$idx = $bbs_data[idx];
$code = $bbs_data[code];

if( $_POST[coment_reg] ) {	
	// 코멘트 등록
	$_POST[name]	= $db->addSlash( $_POST[name] );		
	$_POST[coment]	= $db->addSlash( $_POST[coment] );		
	$db->insert("cs_bbs_coment", "link = $idx, coment = '$_POST[coment]', name = '$_POST[name]', pwd = '$_POST[pwd]', reg_date = now()");
	$tools->alertJavaGo("등록 하였습니다.", "bbs_view.php?bbs_data=$mv_data");
} else if( $_GET[coment_del] ) {
	// 코멘트 삭제
	$co_row	= $db->object("cs_bbs_coment", "where idx=$_GET[coment_idx]", "pwd");
	$db->delete("cs_bbs_coment", "where idx = $_GET[coment_idx]");
	$tools->alertJavaGo("삭제 하였습니다.", "bbs_view.php?bbs_data=$mv_data");
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

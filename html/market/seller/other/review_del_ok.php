<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$mv_data	= $_GET[review_data];
$review_data	= $tools->decode( $_GET[review_data] );

$Info = $db->object("cs_goods_review", "where idx='$review_data[idx]'");

if($review_data[idx]) {
	if( $db->delete("cs_goods_review", "where idx=$review_data[idx]") ) {
		if( $Info->bbs_file != "none" ) { @unlink("../../data/bbsData/".$Info->bbs_file); }
		$tools->javaGo("review.php?review_data=$mv_data"); 
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

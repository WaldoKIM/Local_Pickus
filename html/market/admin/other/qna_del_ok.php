<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$mv_data	= $_GET[review_data];
$review_data	= $tools->decode( $_GET[review_data] );
if($review_data[idx]) {
	if( $db->delete("cs_goods_qna", "where idx=$review_data[idx]") ) { $tools->javaGo("qna.php?review_data=$mv_data"); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

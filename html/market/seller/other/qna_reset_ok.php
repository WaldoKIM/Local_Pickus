<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$mv_data	= $_GET[review_data];
$review_data	= $tools->decode( $_GET[review_data] );
if($review_data[idx]) {
	if( $db->update("cs_goods_qna", "coment='', coment_check=0 where idx=$review_data[idx]") ) { $tools->javaGo("qna_view.php?review_data=$mv_data"); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

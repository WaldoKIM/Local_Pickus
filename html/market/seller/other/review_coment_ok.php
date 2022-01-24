<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$mv_data	= $_POST[review_data];
$review_data	= $tools->decode( $_POST[review_data] );
if($review_data[idx]) {
	if( $db->update("cs_goods_review", "coment='$_POST[coment]', coment_check=1 where idx=$review_data[idx]") ) { $tools->javaGo("review.php?review_data=$mv_data"); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

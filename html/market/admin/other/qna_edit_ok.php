<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
$mv_data	= $_POST[review_data];
$review_data	= $tools->decode( $_POST[review_data] );
$idx = $review_data[idx];

// 디비에 입력
if( $db->update("cs_goods_qna", "title='$_POST[title]', content='$_POST[content]' where idx=$idx") ) { $tools->alertJavaGo("수정 하였습니다.", "qna.php?review_data=$mv_data"); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}
?>

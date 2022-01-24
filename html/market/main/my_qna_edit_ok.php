<?
include('../common.php');
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

$MV_DATA	= $_POST[board_data];
$bbs_data	= $tools->decode( $_POST[board_data] );
$idx = $bbs_data[idx];

$MV_SEARCH_ITEM	= $_POST[search_items];
$SEARCH_ITEM	= $tools->decode( $_POST[search_items] );

$Info = $db->object("cs_goods_qna", "where idx='$idx'");

if( $_POST[title] ) {
	if( $db->update("cs_goods_qna",  " name='$_POST[name]', title='$_POST[title]', hold='$_POST[hold]', content='$_POST[content]' where idx='$idx'") ) {
		 $tools->msg('상품문의가 수정 되었습니다.'); 
		 $tools->javaGo('my_qna.php?board_data='.$MV_DATA.'&search_items='.$MV_SEARCH_ITEM); 
	} else {
		$tools->errMsg('비상적으로 입력 되었습니다.');
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

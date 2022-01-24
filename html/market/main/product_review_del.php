<?
include('../common.php');


$MV_DATA	= $_GET[board_data];
$bbs_data	= $tools->decode( $_GET[board_data] );
$idx = $bbs_data[idx];
$MV_SEARCH_ITEM	= $_GET[search_items];
$SEARCH_ITEM	= $tools->decode( $_GET[search_items] );
if($_SESSION[USERID]){
	$Info = $db->object("cs_goods_review", "where idx='$idx'");
	if( $db->delete("cs_goods_review",  "where idx='$idx'") ) {
		// 자료실 삭제
		if( $Info->bbs_file != "none" ) { @unlink("../data/bbsData/".$Info->bbs_file); }
		$tools->msg('상품문의글이 삭제 되었습니다.');
		$tools->javaGo('product_review.iframe.php?goods_idx='.$Info->goods_idx);
	} else {
		$tools->errMsg('비상적으로 입력 되었습니다.');
	}
}else{
	if(!$db->cnt("cs_goods_review", "where idx='$idx' and pwd=PASSWORD('$_POST[pwd]')")){
		$tools->errMsg('비밀번호가 일치하지 않습니다.');
	}else{
		$Info = $db->object("cs_goods_review", "where idx='$idx'");
		// 자료실 삭제
		if( $Info->bbs_file != "none" ) { @unlink("../data/bbsData/".$Info->bbs_file); }
		if( $db->delete("cs_goods_review", "where idx='$idx'") ) {
			$tools->msg('상품문의글이 삭제 되었습니다.');
		$tools->javaGo('product_review.iframe.php?goods_idx='.$Info->goods_idx);
		} else {
			$tools->errMsg('비상적으로 입력 되었습니다.');
		}
	}
}
?>
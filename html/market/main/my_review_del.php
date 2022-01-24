<?
include('../common.php');
$_GET=&$HTTP_GET_VARS;
$_POST=&$HTTP_POST_VARS;
//게시판에 필요한 값들
$MV_DATA	= $_GET[board_data];
$BOARD_DATA	= $tools->decode( $_GET[board_data] );
if($_GET[idx] )					{ $idx = $_GET[idx]; }					else { $idx = $BOARD_DATA[idx]; }
if($_GET[listNo] )				{ $listNo = $_GET[listNo]; }			else { $listNo = $BOARD_DATA[listNo]; }
if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }		else { $startPage	= $BOARD_DATA[startPage]; }
if($_GET[totalList] )			{ $totalList = $_GET[totalList]; }		else { $totalList	= $BOARD_DATA[totalList]; }
$MV_SEARCH_ITEM	= $_GET[search_items];
$SEARCH_ITEM	= $tools->decode( $_GET[search_items] );
if($_GET[code] )			{ $code = $_GET[code]; }		else { $code = $SEARCH_ITEM[code]; }
if($_GET[search_item] )			{ $search_item = $_GET[search_item]; }		else { $search_item	= $SEARCH_ITEM[search_item]; }
if($_GET[search_order] )			{ $search_order = $_GET[search_order]; }		else { $search_order	= urldecode($SEARCH_ITEM[search_order]); }
if($_GET[boardT] )			{ $boardT = $_GET[boardT]; }		else { $boardT = $_POST[boardT]; }
if($_GET[goods_idx] )			{ $goods_idx = $_GET[goods_idx]; }		else { $goods_idx = $SEARCH_ITEM[goods_idx]; }
if($idx) {
	$Info = $db->object("cs_goods_review", "where idx='$idx'");
	if( $Info->bbs_file != "none" ) { @unlink("../data/bbsData/".$Info->bbs_file); }
	if( $db->delete("cs_goods_review", "where idx=$idx") ) { $tools->javaGo('my_review.php?board_data='.$MV_DATA.'&search_items='.$MV_SEARCH_ITEM);  }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
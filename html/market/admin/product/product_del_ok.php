<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$mv_data=$_GET[board_data];
$MV_SEARCH_ITEM	= $_GET[search_items];

if($_GET[returnurl]){
	$returnurl = $_GET[returnurl];
}else{
	$returnurl = "product_list.php";
}
if($_GET[board_data]) {
	$mv_data	= $_GET[board_data];
	$board_data	= $tools->decode( $_GET[board_data] );

	// 넘어온 idx 로 삭제 레코드를 검색한다.
	$goods_stat = $db->object("cs_goods", "where idx=$board_data[idx]");

	// 상품 리뷰 삭제
	$db->delete("cs_goods_review", "where goods_idx='$goods_stat->idx'");

	// 기본 이미지 삭제
	if( $goods_stat->images1) { @unlink("../../data/goodsImages/".$goods_stat->images1); }
	if( $goods_stat->images2) { @unlink("../../data/goodsImages/".$goods_stat->images2); }
	if( $goods_stat->add_images1) { @unlink("../../data/goodsImages/".$goods_stat->add_images1); }
	if( $goods_stat->add_images2) { @unlink("../../data/goodsImages/".$goods_stat->add_images2); }
	if( $goods_stat->add_images3) { @unlink("../../data/goodsImages/".$goods_stat->add_images3); }
	if( $goods_stat->add_images4) { @unlink("../../data/goodsImages/".$goods_stat->add_images4); }
	if( $goods_stat->add_images5) { @unlink("../../data/goodsImages/".$goods_stat->add_images5); }
	if( $goods_stat->goods_file) { unlink("../../data/goodsImages/".$goods_stat->goods_file); }
	if( $goods_stat->goods_file2) { unlink("../../data/goodsImages/".$goods_stat->goods_file2); }
	if( $goods_stat->goods_file3) { unlink("../../data/goodsImages/".$goods_stat->goods_file3); }
	if( $db->delete("cs_goods", "where idx=$board_data[idx]") ) { $tools->javaGo($returnurl."?board_data=$mv_data&search_items=$MV_SEARCH_ITE"); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

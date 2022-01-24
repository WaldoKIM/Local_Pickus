<?
include('../common.php');
//$_POST=&$HTTP_POST_VARS;
$goods_stat = $db->object("cs_goods", "where idx=$_POST[goods_idx]");

$goods_data = $tools->encode("idx=".$goods_stat->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&page_idx=".$page_idx."&search_item=".$search_item);
if( $_POST["title"] ) {	
	if( $db->insert("cs_goods_qna",  "goods_name='$goods_stat->name', name='$_POST[name]', pwd=PASSWORD('$_POST[pwd]'), title='$_POST[title]', hold='$_POST[hold]', content='$_POST[content]', userid='$_SESSION[USERID]', goods_idx='$_POST[goods_idx]', seller='$goods_stat->seller', register=now()") ) {
		 $tools->msg('상품문의가 등록 되었습니다.');
		 $tools->javaGo('product_qna.iframe.php?goods_idx='.$_POST[goods_idx]); 
	} else {
		$tools->errMsg('비상적으로 입력 되었습니다.');
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

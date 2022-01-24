<?
include('../common.php');
//$_POST=&$HTTP_POST_VARS;
$goods_stat = $db->object("cs_goods", "where idx=$_POST[goods_idx]");

$goods_data = $tools->encode("idx=".$goods_stat->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&page_idx=".$page_idx."&search_item=".$search_item);
if( $_POST[title] ) {	
	// 파일업로드 
	if( $_FILES[bbs_file][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl", "inc");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[bbs_file][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[bbs_file][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n$MAXFILESIZE 메가 까지 업로드 가능합니다"); exit(); }
		$file_name	= time()."&&BBS_FILE".$code.".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file($_FILES[bbs_file][tmp_name], "../data/bbsData/".$file_name) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[bbs_file][tmp_name]);	} 
	} else {
		$file_name 	= "none";
	}

	if( $db->insert("cs_goods_review",  "goods_name='$goods_stat->name', name='$_POST[name]', pwd=PASSWORD('$_POST[pwd]'), title='$_POST[title]', hold='$_POST[hold]', content='$_POST[content]', userid='$_SESSION[USERID]', goods_idx='$_POST[goods_idx]', star='$_POST[star]', bbs_file='$file_name', seller='$goods_stat->seller', register=now()") ) {
		$db->insert("g5_notify", "email='$goods_stat->seller', title='$goods_stat->name 새로운 후기가 작성되었습니다.', category='rv', noti_type='22', updatetime=now() "); 
		$tools->msg('상품평이 등록 되었습니다.');
		 $tools->javaGo('product_review.iframe.php?goods_idx='.$_POST[goods_idx]); 
	} else {
		$tools->errMsg('비상적으로 입력 되었습니다.');
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>


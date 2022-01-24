<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;

if($_POST[hidden_goods_idx] ) {
	
	// 넘어온 상품 정보 쿼리
	$row=$db->object("cs_goods", "where idx='$_POST[hidden_goods_idx]'");



	if( $_FILES["itemimg"][size] > 0 ) {
		if( $_FILES["itemimg"][size] > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n$MAXFILESIZE 메가 까지 업로드 가능합니다"); exit(); }
		$EXT_TMP = explode( ".", $_FILES["itemimg"][name]);
		$itemimg = 'GOODS1_'.time().".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file( $_FILES["itemimg"][tmp_name], "../../data/goodsImages/".$itemimg )) {
			$tools->errMsg("파일 업로드 에러"); 
		} else {
			@unlink($_FILES["itemimg"][tmp_name]); 
			@unlink( "../../data/goodsImages/".$row->images1);
		} 
	}else{
		$itemimg = $row->images1;
	}

	$sql = "images1='$itemimg' where idx=$_POST[hidden_goods_idx]";

	if( $db->update("cs_goods", $sql) ) { 
	?>
	<script language="javascript">
		parent.document.getElementById('img<?=$_POST[hidden_goods_idx]?>').src="../../data/goodsImages/<?=$itemimg?>";
		parent.document.form_<?=$_POST[form_data]?>.itemimg.value="";
	</script>
	<?
	} else { $tools->errMsg('비상적으로 입력 되었습니다.');}

} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

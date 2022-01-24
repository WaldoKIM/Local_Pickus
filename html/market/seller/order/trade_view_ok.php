<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

$mv_data	= $_GET[trade_data];
$trade_data	= $tools->decode( $_GET[trade_data] );
if($_GET[idx] )	{ $idx = $_GET[idx]; }	else { $idx = $trade_data[idx]; }
if($_POST[order_name] && $_SESSION[USERID]) {
	// 배송예약일
	$deliv_pree_day=$_POST[deliv_year]."-".$_POST[deliv_mon]."-".$_POST[deliv_day];
	// 주문시 요청사항변경
	if($_POST[deliv_content]) { $_POST[deliv_content]=$db->addSlash ( $_POST[deliv_content] );} else { $_POST[deliv_content]='';}
	
	$db->update("cs_trade_goods", "deliv_num='$_POST[trade_number]' where idx=$idx");
	$tools->javaGo("trade_view.php?trade_data=$mv_data");
} else if($_POST[mode] == "comment_reg"){
	if(!$_POST["content"]){
		$tools->errMsg('내용을 입력해 주세요.');
	} else if( $_POST["trade_goods_idx"] ) {	
		if( $_FILES[upfile][size] > 0 ) {
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
			if( $EXT_TMP = explode( ".", $_FILES[upfile][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[upfile][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n".$MAXFILESIZE."메가 까지 업로드 가능합니다"); exit(); }
			$upfile	= time()."&&".$_FILES[upfile][name];
			if( !@move_uploaded_file($_FILES[upfile][tmp_name], "../../data/trade_data/".$upfile) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[upfile][tmp_name]);	} 
		} else {
			$upfile 	= "none";
		}
		
		$_POST["content"]	= $db->addSlash( $_POST["content"] );		
		$db->insert("cs_trade_comment", "content = '$_POST[content]', trade_goods_idx='$_POST[trade_goods_idx]', userid = '$_SESSION[USERID]', name='$_SESSION[NAME]', upfile='$upfile', reg_date = now()");
		$tools->javaGo("trade_view.php?trade_data=$mv_data");
	} else {
		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다1.');
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다2.');
}
?>

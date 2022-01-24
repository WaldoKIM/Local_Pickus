<?
include('../../common.php'); 
$idx	= $_POST[idx];
$mv_data	= $_GET[trade_data];
$trade_data	= $tools->decode( $_GET[trade_data] );

if($_POST[idx] && $_SESSION[USERID]) {
	// 파일업로드 
	$trade_data_stat = $db->object("cs_trade_goods", "where idx=$idx");
	if($_POST[del_upfile]){
		@unlink("../../data/trade_data/".$trade_data_stat->upfile);
		$upfile	= "none";
	}else{
		if( $_FILES[upfile][size] > 0 ) {
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
			if( $EXT_TMP = explode( ".", $_FILES[upfile][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[upfile][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n".$MAXFILESIZE."메가 까지 업로드 가능합니다"); exit(); }
			$upfile	= time()."&&".$_FILES[upfile][name];
			if( !@move_uploaded_file($_FILES[upfile][tmp_name], "../../data/trade_data/".$upfile) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[upfile][tmp_name]);	} 
		} else {
			$upfile 	= "none";
		}
	}
	
	if(!$upfile){
		$upfile = $trade_data_stat->upfile;
	}
	
	$trade_stat = $db->object("cs_trade","where trade_code='$trade_data->trade_code' ");
	
	if($trade_stat->trade_stat < 4){
		$db->update("cs_trade", "trade_stat=3, trade_start_day=now() where idx='$trade_data[idx]'");
		$db->update("cs_trade_goods", "trade_stat=3, upfile='$upfile', deliv_day=now()  where idx=$idx");
	}

	$tools->javaGo("trade_view.php?trade_data=$mv_data");
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

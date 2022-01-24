<?
include('../common.php');

$trade_check = $db->cnt("cs_trade", "where idx=$_GET[trade_idx] and trade_stat=4");
if( $_GET[trade_idx] && $_GET[trade_goods_idx] && $trade_check ) {
	$trade_stat = $db->object("cs_trade", "where idx=$_GET[trade_idx] and trade_stat=4");
	$goods_stat = $db->object( "cs_goods", "where idx=$_GET[trade_goods_idx]", "goods_file" );
	$goods_file = explode( "&&", $goods_stat->goods_file );
	$file_dir = "../data/goodsImages";
//	$ftype = "file/unknown";
    $ftype = "application/octet-stream";
	if(preg_match("/(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)/", $HTTP_USER_AGENT)){
		Header("Content-type: $ftype");
		Header("Content-Length: ".filesize("$file_dir/$goods_stat->goods_file"));
		Header("Content-Disposition: attachment;  filename=$goods_file[1]");
		Header("Content-Transfer-Encoding: binary");
		Header("Pragma: no-cache");
		Header("Expires: 0");
	} else {
		Header("Content-type: file/unknown");
		Header("Content-Length: ".filesize("$file_dir/$goods_stat->goods_file"));
		Header("Content-Disposition: attachment;  filename=$goods_file[1]");
		Header("Content-Description: PHP3 Generated Data");
		Header("Pragma: no-cache");
		Header("Expires: 0");
	}
	  if ($fp = fopen("$file_dir/$goods_stat->goods_file", "rb")) {
		  if (!fpassthru($fp)) fclose($fp);
		  exit();
	  }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
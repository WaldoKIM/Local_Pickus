<?
include('../common.php');

if(strstr($_SERVER[HTTP_REFERER],"bbs_audio.php")==false && strstr($_SERVER[HTTP_REFERER],"product_view.php")==false){
exit;	
}

$goods_data	= $tools->decode( $_GET[goods_data] );
$idx = $goods_data[idx];

if( $_GET[download] ) {
	$goods_stat	= $db->object( "cs_goods", "where idx=$idx");


	if($_GET[audio] ==1){
		$audio = $goods_stat->goods_file;
	}else if($_GET[audio] ==2){
		$audio = $goods_stat->goods_file2;
	}else if($_GET[audio] ==3){
		$audio = $goods_stat->goods_file3;
	}

	$file_dir = "../data/goodsImages";
	
		$goods_file = explode( "&&", $audio );

		//$down = $bbs_stat->bbs_file;
		//$bbs_file = explode( "&&", $bbs_stat->bbs_file );

    $ftype = "application/octet-stream";
	if(preg_match("/(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)/", $HTTP_USER_AGENT)){
		Header("Content-type: $ftype");
		Header("Content-Length: ".filesize("$file_dir/$audio"));
		Header("Content-Disposition: attachment;  filename=$goods_file[1]");
		Header("Content-Transfer-Encoding: binary");
		Header("Pragma: no-cache");
		Header("Expires: 0");
	} else {
		Header("Content-type: file/unknown");
		Header("Content-Length: ".filesize("$file_dir/$audio"));
		Header("Content-Disposition: attachment;  filename=$goods_file[1]");
		Header("Content-Description: PHP3 Generated Data");
		Header("Pragma: no-cache");
		Header("Expires: 0");
	}
	  if ($fp = fopen("$file_dir/$audio", "rb")) {
		  if (!fpassthru($fp)) fclose($fp);
		  exit();
	  }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}

?>

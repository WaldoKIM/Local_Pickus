<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;

$idx = $_GET[idx];

if( $_GET[idx] ) {
	if($_GET[mode] == "comment"){
		$trade_stat	= $db->object( "cs_trade_comment", "where idx=$idx");
	}else{
		$trade_stat	= $db->object( "cs_trade_goods", "where idx=$idx");
	}
	$file_dir = "../../data/trade_data";	
		$down = $trade_stat->upfile;
		$trade_file = explode( "&&", $trade_stat->upfile );
//	$ftype = "file/unknown"; 
    $ftype = "application/octet-stream";
	//if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)){ 
	if(preg_match("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)){ 
		Header("Content-type: $ftype"); 
		Header("Content-Length: ".filesize("$file_dir/$down"));     
		Header("Content-Disposition: attachment;  filename=$trade_file[1]");   
		Header("Content-Transfer-Encoding: binary");   
		Header("Pragma: no-cache");   
		Header("Expires: 0");   
	} else { 
		Header("Content-type: file/unknown");     
		Header("Content-Length: ".filesize("$file_dir/$down"));     
		Header("Content-Disposition: attachment;  filename=$trade_file[1]");   
		Header("Content-Description: PHP3 Generated Data"); 
		Header("Pragma: no-cache"); 
		Header("Expires: 0"); 
	} 
	  
	  if ($fp = fopen("$file_dir/$down", "rb")) { 
		  if (!fpassthru($fp)) fclose($fp); 
		  exit(); 
	  }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;

$mv_data	= $_GET[bbs_data];
$bbs_data	= $tools->decode( $_GET[bbs_data] );
$idx = $bbs_data[idx];
$code = $bbs_data[code];

if( $_GET[download] ) {
	$bbs_stat	= $db->object( "cs_bbs_data", "where idx=$idx");
	$file_dir = "../../data/bbsData";
	if($_GET[add]==1){
		$down = $bbs_stat->add_file1;
		$bbs_file = explode( "&&", $bbs_stat->add_file1 );
	}else if($_GET[add]==2){
		$down = $bbs_stat->add_file2;
		$bbs_file = explode( "&&", $bbs_stat->add_file2 );
	}else if($_GET[add]==3){
		$down = $bbs_stat->add_file3;
		$bbs_file = explode( "&&", $bbs_stat->add_file3 );
	}else if($_GET[add]==4){
		$down = $bbs_stat->add_file4;
		$bbs_file = explode( "&&", $bbs_stat->add_file4 );
	}else if($_GET[add]==5){
		$down = $bbs_stat->add_file5;
		$bbs_file = explode( "&&", $bbs_stat->add_file5 );
	}else{
		$down = $bbs_stat->bbs_file;
		$bbs_file = explode( "&&", $bbs_stat->bbs_file );
	}
//	$ftype = "file/unknown"; 
    $ftype = "application/octet-stream";
	//if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)){ 
	if(preg_match("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)){ 
		Header("Content-type: $ftype"); 
		Header("Content-Length: ".filesize("$file_dir/$down"));     
		Header("Content-Disposition: attachment;  filename=$bbs_file[1]");   
		Header("Content-Transfer-Encoding: binary");   
		Header("Pragma: no-cache");   
		Header("Expires: 0");   
	} else { 
		Header("Content-type: file/unknown");     
		Header("Content-Length: ".filesize("$file_dir/$down"));     
		Header("Content-Disposition: attachment;  filename=$bbs_file[1]");   
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

<?php
// ---------------------------------------------------------------------------
@include("../../config.php");
@include($ROOT_DIR.'/lib/basic_class.php');
$db = new dbConnect($DB_HOST, $DB_NAME, $DB_USER, $DB_PWD);
$tools = new tools();
$admin_stat = $db->object("cs_admin", "");

# 이미지가 저장될 디렉토리의 전체 경로를 설정합니다.
# 끝에 슬래쉬(/)는 붙이지 않습니다.
# 주의: 이 경로의 접근 권한은 쓰기, 읽기가 가능하도록 설정해 주십시오.
define("SAVE_DIR", $ROOT_DIR."cheditor/attach");

$admin_stat->shop_domain = $_SERVER['SERVER_NAME'];

# 위에서 설정한 'SAVE_DIR'의 URL을 설정합니다.
# 끝에 슬래쉬(/)는 붙이지 않습니다.
# 설정에서 www 를 붙인경우와 없을경우 그리고 접속시 붙은경우와 안붙은경우 그리고 하위폴더에 설치를 했는지 여부 shop_domain 마지막에 "/" 가 없어야 정상작동
if(array_search('www', explode(".",".".$admin_stat->shop_domain)) && array_search('www', explode(".",".".$_SERVER['HTTP_HOST']))){
	$DOMAIN = $_SERVER['HTTP_HOST'].str_replace($_SERVER['HTTP_HOST'],'', $admin_stat->shop_domain);
	define("SAVE_URL", "http://".$DOMAIN."/market/cheditor/attach");
}else if(array_search('www', explode(".",".".$admin_stat->shop_domain)) && !array_search('www', explode(".",".".$_SERVER['HTTP_HOST']))){
	$DOMAIN = $_SERVER['HTTP_HOST'].str_replace('www.'.$_SERVER['HTTP_HOST'],'', $admin_stat->shop_domain);
	define("SAVE_URL", "http://".$DOMAIN."/market/cheditor/attach");
}else if(!array_search('www', explode(".",".".$admin_stat->shop_domain)) && array_search('www', explode(".",".".$_SERVER['HTTP_HOST']))){
	$DOMAIN = $_SERVER['HTTP_HOST'].str_replace($_SERVER['HTTP_HOST'],'', 'www.'.$admin_stat->shop_domain);
	define("SAVE_URL", "http://".$DOMAIN."/market/cheditor/attach");
}else{
	$DOMAIN = $_SERVER['HTTP_HOST'].str_replace($_SERVER['HTTP_HOST'],'', $admin_stat->shop_domain);
	define("SAVE_URL", "http://".$DOMAIN."/market/cheditor/attach");
}
// ---------------------------------------------------------------------------
?>

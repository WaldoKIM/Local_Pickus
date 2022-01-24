<?
include('../../common.php'); 
//admin 접근제어
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

if($_GET[idx] && $_GET[changeidx]) {
	//순위변경 프로세서 적용 autoincreament값의 경우 0은 적용이 되나 자동으로 입력시 1부터 시자되므로 0을 TEMP값으로 설정한다. 
	if(!$db->update("cs_page", "idx=0 where idx='$_GET[idx]'")){
		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
	}
	if(!$db->update("cs_page", "idx='$_GET[idx]' where idx='$_GET[changeidx]'")){
		$db->update("cs_page", "idx=$_GET[idx] where idx=0");
		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
	}
	if(!$db->update("cs_page", "idx='$_GET[changeidx]' where idx=0")){
		$db->update("cs_page", "idx=$_GET[changeidx] where idx=$_GET[idx]");
		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
	}
	$tools->javaGo("page.php");
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

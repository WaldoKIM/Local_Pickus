<?
include('../../common.php'); 
//if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}
//$_GET=&$HTTP_GET_VARS;
$code = $_GET[code];
if($_GET['arr_del_list']) {
	$arr_idx = explode('@',$_GET['arr_del_list']);
	if(sizeof($arr_idx)) {
		foreach($arr_idx as $key=>$val) {
			if($val && $val!="on") {
				$db->update("cs_bbs_data", "code='".$_GET[ccode]."' where idx=".$val);
			}
		}
	}
	$tools->alertJavaGo("이동 하였습니다.", "bbs_list.php?code=$code");
}else{
	$tools->errMsg("잘못된 접근입니다.");
}
?>

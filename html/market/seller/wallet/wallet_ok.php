<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;

$mv_data	= $_GET[point_data];

// 숫자 체크
if($_POST[mode] == "bank"){
	if($db->update("cs_member","bank='$_POST[bank]', account_num='$_POST[account_num]', account_name='$_POST[account_name]' where userid='$_SESSION[USERID]' ")){
		$tools->metaGo("wallet.php?point_data=$mv_data"); 
	}else { $tools->errMsg('등록에러');}
}else if( $_POST[use_point] && $_POST[code]) {	
	$title = "출금, 거래번호 : ".$_POST[code];
	$point = "-".$_POST[use_point];
	$member_stat = $db->object("cs_member","where userid = '$_SESSION[USERID]' ");
	
	// 디비 입력
	if( $db->insert("cs_wallet_log", "code='$_POST[code]', userid='$_SESSION[USERID]', user_name='$member_stat->name', use_point='$_POST[use_point]', 
		bank='$member_stat->bank', account_num='$member_stat->account_num', account_name='$member_stat->account_name',  register=now()")) { 
		} else { $tools->errMsg('등록에러');}
	if( $db->insert("cs_cash", "userid='$_SESSION[USERID]', title='$title ', point='$point', cash=1, register=now()")) { $tools->metaGo("wallet.php?point_data=$mv_data"); } else { $tools->errMsg('등록에러');}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

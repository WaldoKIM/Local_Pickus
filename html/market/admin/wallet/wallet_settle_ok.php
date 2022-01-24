<?
include('../../common.php');
include('../admin.check.php');

$admin_stat = $db->object("cs_admin", "");
$mv_data	= $_GET[wallet_data];
$wallet_data	= $tools->decode( $_GET[wallet_data] );
if($_GET[idx] )	{ $idx = $_GET[idx]; }	else { $idx = $wallet_data[idx]; }

if($_POST[confirm_stat] && $_POST[hidden_wallet_idx]) {
	// 거래 정보 불러오기
	//$confirm_stat = $db->object("cs_wallet_log", "where idx=$idx");
	// 결제완료
	if( $_POST[confirm_stat] == 1 ){
		$db->update("cs_wallet_log", "confirm=1, confirm_day=now() where idx=$idx");
	} else if( $_POST[confirm_stat] =="2" ){
		$db->update("cs_wallet_log", "confirm='', confirm_day=now() where idx=$idx");
	}
	//$tools->javaGo("wallet_settle.php?wallet_data=$mv_data");
	$tools->alertJavaGo('출금 상태가 변경 되었습니다.', 'wallet_settle.php?wallet_data=$mv_data');
	
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

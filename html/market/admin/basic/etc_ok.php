<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
// 관리자 기타 정보 설정
$sql = "register_member='$_POST[register_member]', register_admin='$_POST[register_admin]', order_member ='$_POST[order_member]', order_admin ='$_POST[order_admin]', account_member ='$_POST[account_member]', account_admin ='$_POST[account_admin]', delivery_member ='$_POST[delivery_member]', delivery_admin ='$_POST[delivery_admin]', dc0 ='$_POST[dc0]', dc1 ='$_POST[dc1]', dc2 ='$_POST[dc2]', dc3 ='$_POST[dc3]', dc4 ='$_POST[dc4]', dc5 ='$_POST[dc5]', dc6 ='$_POST[dc6]', dc7 ='$_POST[dc7]', dc8 ='$_POST[dc8]', dc9 ='$_POST[dc9]', nomember_old_price=$_POST[nomember_old_price], nomember_shop_price=$_POST[nomember_shop_price], member_old_price=$_POST[member_old_price], member_shop_price=$_POST[member_shop_price]";
// 디비 입력
if( $db->cnt("cs_admin", "")) {If( $db->update("cs_admin", $sql)) { $tools->alertJavaGo("저장 완료 되었습니다.", "etc.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }}
else { if( $db->insert("cs_admin",  $sql)) { $tools->alertJavaGo("저장 완료 되었습니다.", "etc.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }}
?>

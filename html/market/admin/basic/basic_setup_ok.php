<?
include('../../common.php'); 
$admin_stat = $db->object("cs_admin", "");


// 배송비
if( $_POST["express_check"] == 0 ) {
	$_POST["express_money"] = 0;
	$_POST["express_box_money"] = 0;
	$_POST["express_free"] = 0;
} else if( $_POST["express_check"] == 1) {
	$_POST["express_box_money"] = 0;
} else if( $_POST["express_check"] == 2) {
	$_POST["express_money"] = 0;		
}

// 추천회원제
if( $_POST["member_check"] == 0 ) {
	$_POST["member_invite"] ="0";
	$_POST["member_register"] ="0";
}

// 디비입력 쿼리
$sql="admin_userid='$_POST[admin_userid]', admin_passwd='$_POST[admin_passwd]',express_check='$_POST[express_check]', hostingname='$_POST[hostingname]', hostingurl='$_POST[hostingurl]', express_money='$_POST[express_money]',  express_box_money='$_POST[express_box_money]', express_free='$_POST[express_free]', express_over='$_POST[express_over]', point_basic='$_POST[point_basic]', point_register='$_POST[point_register]', point_use='$_POST[point_use]', member_check='$_POST[member_check]', member_invite='$_POST[member_invite]', member_register='$_POST[member_register]', frametype='$_POST[frametype]', shop_domain='$_POST[shop_domain]', shop_url='$_POST[shop_url]', shop_name='$_POST[shop_name]', shop_ceo='$_POST[shop_ceo]', shop_num='$_POST[shop_num]', shop_address='$_POST[shop_address]', shop_license='$_POST[shop_license]', shop_email='$_POST[shop_email]', safeguard_admin='$_POST[safeguard_admin]', shop_status='$_POST[shop_status]', shop_item='$_POST[shop_item]', shop_tel1='$_POST[shop_tel1]', shop_tel2='$_POST[shop_tel2]', shop_fax='$_POST[shop_fax]', shop_phone='$_POST[shop_phone]', kakao_chnl='$_POST[kakao_chnl]', kakao_id='$_POST[kakao_id]',  week='$_POST[week]', fee_rate='$_POST[fee_rate]'";
// 디비입력
if( $db->cnt("cs_admin", "")) {
	if( $db->update("cs_admin", $sql) ) {
		$tools->alertJavaGo("저장 완료 되었습니다.", "basic_setup.php");
	} else {
		$tools->errMsg('비상적으로 입력 되었습니다.'); 
	}
} else { if( $db->insert("cs_admin", $sql) ) { $tools->alertJavaGo("저장 완료 되었습니다.", "basic_setup.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }}

?>

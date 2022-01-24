<?
include('../common.php');


$admin_stat = $db->object("cs_admin", "");
$arr_B = explode(",",$admin_stat->badid);
// 회원 아이디
if( $_POST[userid] ) { $userid = $_POST[userid]; } else if( $_GET[userid] ) { $userid = $_GET[userid];}
// 중복 검색 및 추천아이디 검색 메소드
if( $_POST[method] ) { $method = $_POST[method]; } else if( $_GET[method] ) { $method = $_GET[method];}
if( $method == 1) {
	$userid_check=$db->cnt("cs_member", "where userid='$userid'");
	if(strlen(array_search(trim($userid), $arr_B)) > 0){
		echo "<script language='javascript'>parent.document.getElementById('email_page_msg').innerHTML = '<font color=red>사용 금지된 아이디 입니다..</font>';parent.document.join_form.userid.value='';parent.document.join_form.idch.value='1';</script>";
	}
	if( $userid_check ) {
		echo "<script language='javascript'>parent.document.getElementById('email_page_msg').innerHTML = '<font color=red>이미 사용중인 아이디 입니다.</font>';parent.document.join_form.userid.value='';parent.document.join_form.idch.value='1';</script>";
	}else{
		echo "<script language='javascript'>parent.document.getElementById('email_page_msg').innerHTML = '사용 가능한 아이디 입니다.';parent.document.join_form.idch.value='2';</script>";
	}
}else{
	$userid_check=$db->cnt("cs_member", "where userid='$userid'");
	if(!$userid_check ) {
		echo "<script language='javascript'>parent.document.getElementById('email_page_msg2').innerHTML = '<font color=red>존재하지 않는 아이디 입니다.</font>';parent.document.join_form.userid.value='';</script>";
	}else{
		echo "<script language='javascript'>parent.document.getElementById('email_page_msg2').innerHTML = '추천 가능한 아이디 입니다.';</script>";
	}
}
?>
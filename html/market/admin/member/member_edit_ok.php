<?
include('../../common.php');
//$_GET=&$HTTP_GET_VARS; //$_POST=&$HTTP_POST_VARS;
$mv_data	= $_POST[mem_data];
$mem_data	= $tools->decode( $_POST[mem_data] );

// 이메일 중복 검색
if( !$tools->chkMail($_POST[email], 1)) { $tools->errMsg('정확한 이메일주소를 입력해주세요.');}
if($_POST[email])	{$_POST[email]		= $db->addSlash( $_POST[email] );}
if($_POST[add1])	{$_POST[add1]		= $db->addSlash( $_POST[add1] );}
if($_POST[add2])	{$_POST[add2]		= $db->addSlash( $_POST[add2] );}
	
// 회원 디비 입력
if($_POST[passwd]){
	if( $db->update("cs_member", "passwd=PASSWORD('$_POST[passwd]'),birthy='$_POST[birthy]', birthm='$_POST[birthm]', birthd='$_POST[birthd]', level='$_POST[level]', email='$_POST[email]', tel1='$_POST[tel1]', tel2='$_POST[tel2]', tel3='$_POST[tel3]', phone1='$_POST[phone1]', phone2='$_POST[phone2]', phone3='$_POST[phone3]', zip='$_POST[zip]', add1='$_POST[add1]', add2='$_POST[add2]', mailing='$_POST[mailing]' where idx='$mem_data[idx]'")) { $tools->alertJavaGo('회원정보 변경이 되었습니다.', 'member_view.php?mem_data='.$mv_data);}
}else{
	if( $db->update("cs_member", "level='$_POST[level]',birthy='$_POST[birthy]', birthm='$_POST[birthm]', birthd='$_POST[birthd]', email='$_POST[email]', tel1='$_POST[tel1]', tel2='$_POST[tel2]', tel3='$_POST[tel3]', phone1='$_POST[phone1]', phone2='$_POST[phone2]', phone3='$_POST[phone3]', zip='$_POST[zip]', add1='$_POST[add1]', add2='$_POST[add2]', mailing='$_POST[mailing]' where idx='$mem_data[idx]'")) { $tools->alertJavaGo('회원정보 변경이 되었습니다.', 'member_view.php?mem_data='.$mv_data);}
}
?>

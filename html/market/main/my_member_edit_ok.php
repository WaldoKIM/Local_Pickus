<?
include('../common.php');
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$_FILES=&$HTTP_POST_FILES;

// 이메일 중복 검색
if( !$tools->chkMail($_POST[email], 1)) { $tools->errMsg('정확한 이메일주소를 입력해주세요.');}
if( $_SESSION[USERID] && $_SESSION[PASSWD]) {	
	if($_POST[email])	{$_POST[email]		= $db->addSlash( $_POST[email] );}
	if($_POST[add1])	{$_POST[add1]		= $db->addSlash( $_POST[add1] );}
	if($_POST[add2])	{$_POST[add2]		= $db->addSlash( $_POST[add2] );}
	if($_POST[content]) { $_POST[content] = $db->addSlash( $_POST[content] );}
	
	// 회원 디비 입력
	// 회원 디비 입력
	if($_POST[passwd]){
		if( $db->update("cs_member", "passwd=PASSWORD('$_POST[passwd]'), birthy='$_POST[birthy]', birthm='$_POST[birthm]', birthd='$_POST[birthd]', email='$_POST[email]', tel1='$_POST[tel1]', tel2='$_POST[tel2]', 
		tel3='$_POST[tel3]', phone1='$_POST[phone1]', phone2='$_POST[phone2]', phone3='$_POST[phone3]', zip='$_POST[zip]', add1='$_POST[add1]', add2='$_POST[add2]', content='$_POST[content]', 
		bank='$_POST[bank]', account_num='$_POST[account_num]', account_name='$_POST[account_name]', 
		mailing='$_POST[mailing]' where userid='$_SESSION[USERID]' and passwd='$_SESSION[PASSWD]'")) { $tools->alertJavaGo('회원정보 변경이 되었습니다.', 'login_ok.php?relogin=1&userid='.$_SESSION[USERID]); }
	}else{
		if( $db->update("cs_member", "email='$_POST[email]', birthy='$_POST[birthy]', birthm='$_POST[birthm]', birthd='$_POST[birthd]', tel1='$_POST[tel1]', tel2='$_POST[tel2]', tel3='$_POST[tel3]', 
		phone1='$_POST[phone1]', phone2='$_POST[phone2]', phone3='$_POST[phone3]', zip='$_POST[zip]', add1='$_POST[add1]', add2='$_POST[add2]', content='$_POST[content]', 
		bank='$_POST[bank]', account_num='$_POST[account_num]', account_name='$_POST[account_name]', 
		mailing='$_POST[mailing]' where userid='$_SESSION[USERID]' and passwd='$_SESSION[PASSWD]'")) { $tools->alertJavaGo('회원정보 변경이 되었습니다.', 'login_ok.php?relogin=1&userid='.$_SESSION[USERID]); }
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

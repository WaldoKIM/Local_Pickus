<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;

if( $_POST[bbs_admin_edit] ) {
	// New 표시 기능
	if( empty($_POST[new_check]) )	{ $_POST[new_check] =	0; $_POST[new_mark]	=	0;}
	// Cool 표시 기능
	if( empty($_POST[cool_check]) )	{ $_POST[cool_check] =	0; $_POST[cool_mark]		=	0;}
	// 갤러리 리스트 개수
	if( empty($_POST[list_width]) )	 	{ $_POST[list_width	]	=	0; }
	// 게시판 리스트 개수
	if( empty($_POST[list_height]) )		{ $_POST[list_height]	=	15; }
	// 게시판 페이지 리스트 개수
	if( empty($_POST[list_page]) )		{ $_POST[list_page]	=	5; }
	// Header 미지정
	if( empty($_POST[header]) )			{ $_POST[header]		=	"NULL"; }
	// Footer 미지정
	if( empty($_POST[footer]) )			{ $_POST[footer]		=	"NULL"; }
	// Skin 미지정
	if( empty($_POST[skin]) )				{ $_POST[skin]			=	"NULL"; }
	// Memo 미지정
	if( empty($_POST[memo]) )			{ $_POST[memo]			=	"NULL"; }
	for($i=0;$i<sizeof($_POST[snslist]);$i++) {
		$sns .= $_POST[snslist][$i].'^';
	}

	$db->update("cs_bbs", "name='$_POST[name]', code='$_POST[code]', signcheck='$_POST[signcheck]', bbs_type='$_POST[bbs_type]', bbs_pds=$_POST[bbs_pds], bbs_coment=$_POST[bbs_coment], bbs_access=$_POST[bbs_access], bbs_read=$_POST[bbs_read], bbs_write=$_POST[bbs_write], list_height=$_POST[list_height], list_page=$_POST[list_page], new_check=$_POST[new_check], new_mark=$_POST[new_mark], cool_check=$_POST[cool_check], cool_mark=$_POST[cool_mark], mouse_over='$_POST[mouse_over]', view='$_POST[view]', list_line1='$_POST[list_line1]', list_line2='$_POST[list_line2]', header='$_POST[header]', skin='$_POST[skin]', siren='$_POST[siren]', hold='$_POST[hold]', category='$_POST[hidden_option1_data]', catewidth='$_POST[catewidth]', snslist='$sns' where idx=$_POST[idx]");
	$tools->alertJavaGo("게시판 수정완료", "bbs_admin.php");
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

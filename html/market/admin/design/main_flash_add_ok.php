<?
include('../../common.php'); 
if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;

if( $_POST[subject] ) {	
	//이미지
	if( $_FILES[main_img][size] > 0 ) {
		if( $_FILES[main_img][size] > 1024*1024*4) { $tools->errMsg('업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다'); }
		$EXT_TMP = explode( ".", $_FILES[main_img][name]);
		$main_img = 'EVENT_'.time().".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file( $_FILES[main_img][tmp_name], "../../data/designImages/".$main_img )) { $tools->errMsg('파일 업로드 에러'); } else { @unlink($_FILES[main_img][tmp_name]); } 
	} else {
		$tools->errMsg('이미지를 등록해 주세요');
	}

	if( $_FILES[bgimg][size] > 0 ) {
		if( $_FILES[bgimg][size] > 1024*1024*4) { $tools->errMsg('업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다'); }
		$EXT_TMP = explode( ".", $_FILES[bgimg][name]);
		$bgimg = 'EVENT_BG_'.time().".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file( $_FILES[bgimg][tmp_name], "../../data/designImages/".$bgimg )) { $tools->errMsg('파일 업로드 에러'); } else { @unlink($_FILES[bgimg][tmp_name]); } 
	} else {
		$tools->errMsg('이미지를 등록해 주세요');
	}

	//이미지
	if( $_FILES[list_img][size] > 0 ) {
		if( $_FILES[list_img][size] > 1024*1024*4) { $tools->errMsg('업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다'); }
		$EXT_TMP = explode( ".", $_FILES[list_img][name]);
		$list_img = 'EVENT_LIST_'.time().".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file( $_FILES[list_img][tmp_name], "../../data/designImages/".$list_img )) { $tools->errMsg('파일 업로드 에러'); } else { @unlink($_FILES[list_img][tmp_name]); } 
	} else {
		$list_img = "";
	}
	
	//문구이미지
	if( $_FILES[txtimg][size] > 0 ) {
		if( $_FILES[txtimg][size] > 1024*1024*4) { $tools->errMsg('업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다'); }
		$EXT_TMP = explode( ".", $_FILES[txtimg][name]);
		$txtimg = 'EVENT_TXT_'.time().".".$EXT_TMP[count($EXT_TMP)-1];
		if( !@move_uploaded_file( $_FILES[txtimg][tmp_name], "../../data/designImages/".$txtimg )) { $tools->errMsg('파일 업로드 에러'); } else { @unlink($_FILES[txtimg][tmp_name]); } 
	} else {
		//$tools->errMsg('이미지를 등록해 주세요');
	}


	// 디비 입력
	$sql="
	txttype='$_POST[txttype]',
	title2='$_POST[title2]',
	title3='$_POST[title3]',
	title_color='$_POST[title_color]',
	title2_color='$_POST[title2_color]',
	title3_color='$_POST[title3_color]',
	target='$_POST[target]',
	linktitle='$_POST[linktitle]',
	bgimg='$bgimg',
	txtimg='$txtimg',
	subject='$_POST[subject]', 
	main='$_POST[main]', 
	url='$_POST[url]', 
	main_img='$main_img', 
	list_img='$list_img', 
	content='$_POST[content]', 
	reg_date=now(), 
	mo_date=now()";
	if( $db->insert("cs_main_flash", $sql) ) {
		$ref_stat=$db->object("cs_main_flash","ORDER BY idx DESC LIMIT 1");
		//$refInfo = mysql_insert_id();
		$refInfo = $ref_stat->idx;
		if($_POST[url]=="event_view.php?idx="){
			$url = "event_view.php?idx=".$refInfo;
			$db->update("cs_main_flash", "url='$url' where idx='$refInfo'");
		}
		$tools->alertJavaGo('이벤트 등록 되었습니다.', 'main_flash.php'); 
	} else {
		@unlink("../../data/designImages/".$main_img);
		@unlink("../../data/designImages/".$list_img); 
		@unlink("../../data/designImages/".$bgimg); 
		$tools->errMsg('비상적으로 입력 되었습니다.');
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

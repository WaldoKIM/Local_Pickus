<?
include('../../common.php'); 
if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;

if( $_POST[subject] ) {	
	// 넘어온 상품 정보 쿼리
	$row=$db->object("cs_main_flash", "where idx='$_POST[idx]'");

	if($_POST[del_bgimg]){
		@unlink("../../data/designImages/".$row->bgimg);
		$bgimg	= "";
	}else{

		if( $_FILES[bgimg][size] > 0 ) {
			@unlink("../../data/designImages/".$row->bgimg); $bgimg="";
			if( $_FILES[bgimg][size] > 1024*1024*4) { $tools->errMsg('업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다'); }
			$EXT_TMP = explode( ".", $_FILES[bgimg][name]);
			$bgimg = 'ROTATION_'.time().".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@move_uploaded_file( $_FILES[bgimg][tmp_name], "../../data/designImages/".$bgimg )) { $tools->errMsg('파일 업로드 에러'); } else { @unlink($_FILES[bgimg][tmp_name]); } 
		} else {
			$bgimg=$row->bgimg;
		}
	}

	//이미지
	if($_POST[main_img_del]){
		@unlink("../../data/designImages/".$row->main_img);
		$main_img = "";
	}else{
		if( $_FILES[main_img][size] > 0 ) {
			if( $_FILES[main_img][size] > 1024*1024*4) { $tools->errMsg('업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다'); }
			$main_img = 'EVENT_'.time();
			if( !@move_uploaded_file( $_FILES[main_img][tmp_name], "../../data/designImages/".$main_img )) {
				$tools->errMsg('파일 업로드 에러'); 
			} else {
				@unlink($_FILES[main_img][tmp_name]); 
				@unlink("../../data/designImages/".$row->main_img);
			} 
		} else {
			$main_img = $row->main_img;
		}
	}

	//이미지
	if($_POST[list_img_del]){
		@unlink("../../data/designImages/".$row->list_img);
		$list_img = "";
	}else{
		if( $_FILES[list_img][size] > 0 ) {
			if( $_FILES[list_img][size] > 1024*1024*4) { $tools->errMsg('업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다'); }
			$list_img = 'EVENT_LIST_'.time();
			if( !@move_uploaded_file( $_FILES[list_img][tmp_name], "../../data/designImages/".$list_img )) {
				$tools->errMsg('파일 업로드 에러'); 
			} else {
				@unlink($_FILES[list_img][tmp_name]); 
				@unlink("../../data/designImages/".$row->list_img);
			} 
		} else {
			$list_img = $row->list_img;
		}
	}

	if($_POST[del_txtimg]){
		@unlink("../../data/designImages/".$row->txtimg);
		$txtimg	= "";
	}else{

		if( $_FILES[txtimg][size] > 0 ) {
			@unlink("../../data/designImages/".$row->txtimg); $txtimg="";
			if( $_FILES[txtimg][size] > 1024*1024*4) { $tools->errMsg('업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다'); }
			$EXT_TMP = explode( ".", $_FILES[txtimg][name]);
			$txtimg = 'ROTATION_'.time().".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@move_uploaded_file( $_FILES[txtimg][tmp_name], "../../data/designImages/".$txtimg )) { $tools->errMsg('파일 업로드 에러'); } else { @unlink($_FILES[txtimg][tmp_name]); } 
		} else {
			$txtimg=$row->txtimg;
		}
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
	content='$_POST[content]' 
	where idx=$_POST[idx]";
	if( $db->update("cs_main_flash", $sql) ) { $tools->alertJavaGo('이벤트 수정 되었습니다.', 'main_flash.php'); } else { @unlink("../../data/designImages/".$main_img);  @unlink("../../data/designImages/".$bgimg); @unlink("../../data/designImages/".$list_img); $tools->errMsg('비상적으로 입력 되었습니다.');}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

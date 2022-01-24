<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
$info = $db->object("cs_design", "");

// 디비 입력
if( $_FILES[footerbg_img][size] > 0 ) {
	$TempExt = explode(".",$_FILES[footerbg_img][name]); 
	if( $_FILES[footerbg_img][size] > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n1메가 까지 업로드 가능합니다"); exit(); }
	$footerbg_img_img = 'footerbg_img_'.time().".".$TempExt[count($TempExt)-1];
	if( !@move_uploaded_file( $_FILES[footerbg_img][tmp_name], "../../data/designImages/".$footerbg_img_img )) {
		$tools->errMsg("파일 업로드 에러"); 
	} else {
		//원본삭제
		@unlink("../../data/designImages/".$info->footerbg_img); 
		//임시파일삭제
		@unlink($_FILES[footerbg_img][tmp_name]); 
	} 
}else{
	$footerbg_img_img = $info->footerbg_img;
}
// 디비 입력
$sql = "
	menu_bg_color1='$_POST[menu_bg_color1]',
	menu_bg_color2='$_POST[menu_bg_color2]',
	menu_text_color='$_POST[menu_text_color]',
	menu_text_color_hover='$_POST[menu_text_color_hover]',
	menu_padding_left='$_POST[menu_padding_left]',
	menu_padding_right='$_POST[menu_padding_right]',
	guide_bg_color='$_POST[guide_bg_color]',
	guide_text_color='$_POST[guide_text_color]',
	guide_text_color_hover='$_POST[guide_text_color_hover]',
	word_text='$_POST[word_text]',
	word_text_color='$_POST[word_text_color]',
	toggle_menu_color1='$_POST[toggle_menu_color1]',
	toggle_menu_color2='$_POST[toggle_menu_color2]',
	toggle_menu_color3='$_POST[toggle_menu_color3]',
	toggle_mmenu_color1='$_POST[toggle_mmenu_color1]',
	toggle_mmenu_color2='$_POST[toggle_mmenu_color2]',
	search_bg_color='$_POST[search_bg_color]',
	submenu_bg_color='$_POST[submenu_bg_color]',
	submenu_over_color='$_POST[submenu_over_color]',
	submenu_line_color='$_POST[submenu_line_color]',
	submenu_text_color='$_POST[submenu_text_color]',
	submenu_text_color_hover='$_POST[submenu_text_color_hover]',
	footerbg='$_POST[footerbg]',
	footerbg_color='$_POST[footerbg_color]',
	footerbg_img='$footerbg_img_img'
";
if( $db->update("cs_design", $sql) ) { $tools->alertJavaGo('수정 되었습니다.', 'menudesign.php'); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}
?>

<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$_FILES=&$HTTP_POST_FILES;

if( $_POST[part1_code] && $_POST[part2_code] ) {	

	// 따음표 체크
	if($_POST[part_name]) { $_POST[part_name] = $db->addSlash ( $_POST[part_name] );}
	if($_POST[part1_code]) { $_POST[part1_code]= $db->addSlash ( $_POST[part1_code] );}
	if($_POST[part2_code]) { $_POST[part2_code]= $db->addSlash ( $_POST[part2_code] );}


	$fielddata = "";
	//추가필드 정리
	for($j=0;$j<sizeof($_POST[fieldname]);$j++) {
		if($_POST[fieldname][$j]){
			$fielddata .= $_POST[fieldname][$j]."^||^".$_POST[fielddata][$j]."@";
		}
	}

	$sql="part_name='$_POST[part_name]', goods_cnt='$_POST[goods_cnt]',list_base_sort='$_POST[list_base_sort]', part_display_check='$_POST[part_display_check]', part_low_check='$_POST[part_low_check]', url='$_POST[url]', fieldlist='$fielddata' where idx='$_POST[idx]'";
	if( $db->update("cs_part", $sql) ) { $tools->alertMetaGo("2차 카테고리 수정 되었습니다.", "category_list.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

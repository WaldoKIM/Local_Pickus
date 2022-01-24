<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$_FILES=&$HTTP_POST_FILES;

if( $_POST[part1_code] && $_POST[part2_code]  && $_POST[part3_code] ) {	
	
	// 카테고리 순위 설정
	$part3_row = $db->row("cs_part", "where part_index = '$_POST[hidden_part_index]'", "max(part_ranking)");
	if( $part3_row[0] ) {	$part_ranking = $part3_row[0] +1; } else { $part_ranking = 1; }

	// 따음표 체크
	if($_POST[part_name]) { $_POST[part_name] = $db->addSlash ( $_POST[part_name] );}
	if($_POST[part1_code]) { $_POST[part1_code]= $db->addSlash ( $_POST[part1_code] );}
	if($_POST[part2_code]) { $_POST[part2_code]= $db->addSlash ( $_POST[part2_code] );}
	if($_POST[part3_code]) { $_POST[part3_code]= $db->addSlash ( $_POST[part3_code] );}
	//if($_POST[title_html_code]) { $_POST[title_html_code] = $db->addSlash ( $_POST[title_html_code] );}


	$fielddata = "";
	//추가필드 정리
	for($j=0;$j<sizeof($_POST[fieldname]);$j++) {
		if($_POST[fieldname][$j]){
			$fielddata .= $_POST[fieldname][$j]."^||^".$_POST[fielddata][$j]."@";
		}
	}

	// 디비 입력
	$sql="part_name='$_POST[part_name]', part1_code='$_POST[part1_code]', part2_code='$_POST[part2_code]', part3_code='$_POST[part3_code]', part_index='$_POST[hidden_part_index]', part_ranking='$part_ranking', goods_cnt='$_POST[goods_cnt]', list_base_sort='$_POST[list_base_sort]', part_display_check='$_POST[part_display_check]', url='$_POST[url]', fieldlist='$fielddata'";
	if( $db->insert("cs_part", $sql) ) { $tools->alertMetaGo("3차 카테고리 등록 되었습니다.", "category_list.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;

if($_POST[part1_code] ) {	

	// 따음표 체크
	if($_POST[part_name]) { $_POST[part_name] = $db->addSlash ( $_POST[part_name] );}
	if($_POST[part1_code]) { $_POST[part1_code]= $db->addSlash ( $_POST[part1_code] );}
	//if($_POST[title_html_code]) { $_POST[title_html_code] = $db->addSlash ( $_POST[title_html_code] );}

	// 카테고리 목록 출력 방식( TEXT = 0, IMAGES = 1, IMAGES ON OFF = 2 )
	if( $_POST[list_display_check] == 1 ) {
		if( $_FILES[list_display_images1][size] > 0 ) {
			if( !strstr($_FILES[list_display_images1][type], 'image') ) { $tools->errMsg("이미지 파일만 등록 가능합니다.");  }
			if( $_FILES[list_display_images1][size] > 1024*1024*1) { $tools->errMsg("업로드 용량 초과입니다\\n\\n1메가 까지 업로드 가능합니다");  }
			$list_display_images1 = 'PART1_'.$_POST[part1_code];
			if( !@move_uploaded_file( $_FILES[list_display_images1][tmp_name], "../../data/designImages/".$list_display_images1 )) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[list_display_images1][tmp_name]); } 
			$list_display_images2 = "";
			$images_sql="list_display_images1='$list_display_images1', ";
		} else {
			$images_sql="list_display_images2='',";
		}
	} else if( $_POST[list_display_check] == 2 ) {
		// list_display_images1, list_display_images2 이미지를 모두 변경시
		if( $_FILES[list_display_images1][size] > 0 && $_FILES[list_display_images2][size] > 0 ) {
			if( !strstr($_FILES[list_display_images1][type], 'image') || !strstr($_FILES[list_display_images2][type], 'image') ) { $tools->errMsg("이미지 파일만 등록 가능합니다.");  }
			if( $_FILES[list_display_images1][size] > 1024*1024*1) { $tools->errMsg("업로드 용량 초과입니다\\n\\n1메가 까지 업로드 가능합니다");  }
			$list_display_images1 = 'PART1_'.$_POST[part1_code];
			if( !@move_uploaded_file( $_FILES[list_display_images1][tmp_name], "../../data/designImages/".$list_display_images1 )) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[list_display_images1][tmp_name]); } 
			if( $_FILES[list_display_images2][size] > 1024*1024*1) { $tools->errMsg("업로드 용량 초과입니다\\n\\n1메가 까지 업로드 가능합니다");  }
			$list_display_images2 = 'PART2_'.$_POST[part1_code];
			if( !@move_uploaded_file( $_FILES[list_display_images2][tmp_name], "../../data/designImages/".$list_display_images2 )) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[list_display_images2][tmp_name]); } 
			$images_sql="list_display_images1='$list_display_images1', list_display_images2='$list_display_images2',";
		// list_display_images1 이미지를 변경시
		} else if( $_FILES[list_display_images1][size] > 0 ) {
			if( !strstr($_FILES[list_display_images1][type], 'image') ) { $tools->errMsg("이미지 파일만 등록 가능합니다.");  }
			if( $_FILES[list_display_images1][size] > 1024*1024*1) { $tools->errMsg("업로드 용량 초과입니다\\n\\n1메가 까지 업로드 가능합니다");  }
			$list_display_images1 = 'PART1_'.$_POST[part1_code];
			if( !@move_uploaded_file( $_FILES[list_display_images1][tmp_name], "../../data/designImages/".$list_display_images1 )) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[list_display_images1][tmp_name]); } 
			$images_sql="list_display_images1='$list_display_images1', ";
		// list_display_images2 이미지를 변경시
		} else if( $_FILES[list_display_images2][size] > 0 ) {
			if( !strstr($_FILES[list_display_images2][type], 'image') ) { $tools->errMsg("이미지 파일만 등록 가능합니다.");  }
			if( $_FILES[list_display_images2][size] > 1024*1024*1) { $tools->errMsg("업로드 용량 초과입니다\\n\\n1메가 까지 업로드 가능합니다");  }
			$list_display_images2 = 'PART2_'.$_POST[part1_code];
			if( !@move_uploaded_file( $_FILES[list_display_images2][tmp_name], "../../data/designImages/".$list_display_images2 )) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[list_display_images2][tmp_name]); } 
			$images_sql="list_display_images2='$list_display_images2',";
		// 이미지를 변경하지 않을 경우
		} else {
			$images_sql="";
		}
	} else if( $_POST[list_display_check] == 0 ) { $list_display_images1 = ""; $list_display_images2 = ""; $images_sql="list_display_images1='$list_display_images1', list_display_images2='$list_display_images2',"; }


	//$sql="part_name='$_POST[part_name]',part_ename='$_POST[part_ename]', corner_name='$_POST[corner_name]', short_content='$_POST[short_content]', corner_color='$_POST[corner_color]', goods_cnt='$_POST[goods_cnt]', goods_main_cnt='$_POST[goods_main_cnt]', itemsort='$_POST[itemsort]', display_type='$_POST[display_type]', part_display_check='$_POST[part_display_check]', part_low_check='$_POST[part_low_check]' where idx=$_POST[idx]";
	$sql="part_name='$_POST[part_name]' ,part_ename='$_POST[part_ename]', corner_name='$_POST[corner_name]', short_content='$_POST[short_content]' , corner_color='$_POST[corner_color]', goods_cnt='$_POST[goods_cnt]', goods_main_cnt='$_POST[goods_main_cnt]' , itemsort='$_POST[itemsort]', display_type='$_POST[display_type]', part_display_check='$_POST[part_display_check]', part_low_check='$_POST[part_low_check]'  where idx=$_POST[idx]";

	//echo $sql;
	//exit;
	
	if( $db->update("cs_part_fixed", $sql) ) { $tools->alertMetaGo("1차 카테고리 수정 되었습니다.", "specialcate.php"); } else { @unlink("../../data/designImages/".$list_display_images1); @unlink("../../data/designImages/".$list_display_images2);  @unlink("../../data/designImages/".$title_display_images); $tools->errMsg('비상적으로 입력 되었습니다.');}

} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

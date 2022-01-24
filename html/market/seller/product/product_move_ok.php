<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;

if( $_POST[to_hidden_move_copy]==1 && $_POST[to_hidden_part_code] && $_POST[to_hidden_elements] ) {
	if($_POST[to_hidden_part_code]) { $part_row=$db->object("cs_part", "where part1_code='$_POST[to_hidden_part_code]' or part2_code='$_POST[to_hidden_part_code]' or part3_code='$_POST[to_hidden_part_code]'", "idx");}
	$elements_data = explode("&&", $_POST[to_hidden_elements] );
	for( $i=0; $i < count($elements_data)-1; $i++ ) { $db->update("cs_goods", "part_idx=$part_row->idx where idx=$elements_data[$i]");}
	$tools->javaGo("product_move.php?hidden_part_code=$_POST[to_hidden_part_code]");
} else if( $_POST[to_hidden_move_copy]==2 && $_POST[to_hidden_part_code] && $_POST[to_hidden_elements] ) {
	if($_POST[to_hidden_part_code]) { $part_row=$db->object("cs_part", "where part1_code='$_POST[to_hidden_part_code]' or part2_code='$_POST[to_hidden_part_code]' or part3_code='$_POST[to_hidden_part_code]'", "idx");}
	$elements_data = explode("&&", $_POST[to_hidden_elements] );
	$new_goods_code=time();
	for( $i=0; $i < count($elements_data)-1; $i++ ) {
		$new_goods_code++; 
		$goods_stat = $db->object("cs_goods", "where idx=$elements_data[$i]");

		// 이미지 이름 초기화한다.
		$images1=""; $images2=""; $add_images1=""; $add_images2=""; $add_images3=""; $add_images4=""; $add_images5=""; $goods_file_name="";
		// 파일를 복사한다.
		if( $goods_stat->images1 ) {
			$EXT_TMP = explode( ".", $goods_stat->images1);
			$images1 = 'GOODS1_'.$new_goods_code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@copy( "../../data/goodsImages/".$goods_stat->images1, "../../data/goodsImages/".$images1 )) { $tools->errMsg("파일 카피 에러"); }
		}
		if( $goods_stat->images2 ) {
			$EXT_TMP = explode( ".", $goods_stat->images2);
			$images2 = 'GOODS2_'.$new_goods_code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@copy( "../../data/goodsImages/".$goods_stat->images2, "../../data/goodsImages/".$images2 )) { $tools->errMsg("파일 카피 에러"); }
		}
		if( $goods_stat->images3 ) {
			$EXT_TMP = explode( ".", $goods_stat->images3);
			$images3 = 'GOODS3_'.$new_goods_code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@copy( "../../data/goodsImages/".$goods_stat->images3, "../../data/goodsImages/".$images3 )) { $tools->errMsg("파일 카피 에러"); }
		}
		if( $goods_stat->add_images1 ) {
			$EXT_TMP = explode( ".", $goods_stat->add_images1);
			$add_images1 = 'ADD_GOODS1_'.$new_goods_code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@copy( "../../data/goodsImages/".$goods_stat->add_images1, "../../data/goodsImages/".$add_images1 )) { $tools->errMsg("파일 카피 에러"); }
		}
		if( $goods_stat->add_images2 ) {
			$EXT_TMP = explode( ".", $goods_stat->add_images2);
			$add_images2 = 'ADD_GOODS2_'.$new_goods_code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@copy( "../../data/goodsImages/".$goods_stat->add_images2, "../../data/goodsImages/".$add_images2 )) { $tools->errMsg("파일 카피 에러"); }
		}
		if( $goods_stat->add_images3 ) { 
			$EXT_TMP = explode( ".", $goods_stat->add_images3);
			$add_images3 = 'ADD_GOODS3_'.$new_goods_code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@copy( "../../data/goodsImages/".$goods_stat->add_images3, "../../data/goodsImages/".$add_images3 )) { $tools->errMsg("파일 카피 에러"); }
		}
		if( $goods_stat->add_images4 ) { 
			$EXT_TMP = explode( ".", $goods_stat->add_images4);
			$add_images4 = 'ADD_GOODS4_'.$new_goods_code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@copy( "../../data/goodsImages/".$goods_stat->add_images4, "../../data/goodsImages/".$add_images4 )) { $tools->errMsg("파일 카피 에러"); }
		} 
		if( $goods_stat->add_images5 ) { 
			$EXT_TMP = explode( ".", $goods_stat->add_images5);
			$add_images5 = 'ADD_GOODS5_'.$new_goods_code.".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@copy( "../../data/goodsImages/".$goods_stat->add_images5, "../../data/goodsImages/".$add_images5 )) { $tools->errMsg("파일 카피 에러"); }
		}
		if( $goods_stat->goods_file ) { $goods_file_arr = explode("&&", $goods_stat->goods_file ); $goods_file_name	= time()."&&".$goods_file_arr[1]; if( !@copy( "../../data/goodsImages/".$goods_stat->images1, "../../data/goodsImages/".$goods_file_name) ) { $tools->errMsg("파일 카피 에러"); }}

		$goods_stat->name				= $db->addSlash ( $goods_stat->name );
		$goods_stat->company			= $db->addSlash ( $goods_stat->company );

		$result = $db->object("cs_goods","order by ranking desc limit 1");
		$ranking = $result->ranking+1;	
		$db->insert("cs_goods", "part_idx='$part_row->idx', display='$goods_stat->display', subitem='$goods_stat->subitem', subitemtarget='$goods_stat->subitemtarget', itemlist='$goods_stat->itemlist',  tag='$goods_stat->tag', description='$goods_stat->description', code='$new_goods_code', subst='$goods_stat->subst', substtxt='$goods_stat->substtxt', resize='$goods_stat->resize', substimg='$goods_stat->substimg', iconidx='$goods_stat->iconidx', mincnt='$goods_stat->mincnt', name='$goods_stat->name', company='$goods_stat->company', old_price='$goods_stat->old_price', shop_price='$goods_stat->shop_price', unlimit='$goods_stat->unlimit', number='$goods_stat->number', point='$goods_stat->point', box='$goods_stat->box', option_check='$goods_stat->option_check', opt_data='$goods_stat->opt_data', images1='$images1', images2='$images2', images3='$images3', add_images1='$add_images1', add_images2='$add_images2', add_images3='$add_images3', add_images4='$add_images4', add_images5='$add_images5', goods_file='$goods_file_name', content='$goods_stat->content', register=now(), ranking = $ranking, fieldname1='$goods_stat->fieldname1', fielddata1='$goods_stat->fielddata1', fieldname2='$goods_stat->fieldname2', fielddata2='$goods_stat->fielddata2', fieldname3='$goods_stat->fieldname3', fielddata3='$goods_stat->fielddata3', fieldname4='$goods_stat->fieldname4', fielddata4='$goods_stat->fielddata4', fieldname5='$goods_stat->fieldname5', fielddata5='$goods_stat->fielddata5', fieldname6='$goods_stat->fieldname6', fielddata6='$goods_stat->fielddata6', fieldname7='$goods_stat->fieldname7', fielddata7='$goods_stat->fielddata7', fieldname8='$goods_stat->fieldname8', fielddata8='$goods_stat->fielddata8', fieldname9='$goods_stat->fieldname9', fielddata9='$goods_stat->fielddata9', fieldname10='$goods_stat->fieldname10', fielddata10='$goods_stat->fielddata10', fieldname11='$goods_stat->fieldname11', fielddata11='$goods_stat->fielddata11', fieldname12='$goods_stat->fieldname12', fielddata12='$goods_stat->fielddata12', fieldname13='$goods_stat->fieldname13', fielddata13='$goods_stat->fielddata13',  fieldname14='$goods_stat->fieldname14', fielddata14='$goods_stat->fielddata14', fieldname15='$goods_stat->fieldname15', fielddata15='$goods_stat->fielddata15'");
	}
	$tools->javaGo("product_move.php?hidden_part_code=$_POST[to_hidden_part_code]");
} else if( $_POST[to_hidden_move_copy]==3 && $_POST[to_hidden_elements] ) {
	if($_POST[to_hidden_part_code]) { $part_row=$db->object("cs_part", "where part1_code='$_POST[to_hidden_part_code]' or part2_code='$_POST[to_hidden_part_code]' or part3_code='$_POST[to_hidden_part_code]'", "idx");}
	$elements_data = explode("&&", $_POST[to_hidden_elements] );
	for( $i=0; $i < count($elements_data)-1; $i++ ) {
		// 넘어온 idx 로 삭제 레코드를 검색한다.
		$row = $db->object("cs_goods", "where idx=$elements_data[$i]");
		// 기본 이미지 삭제
		if( $row->images1) { @unlink("../../data/goodsImages/".$row->images1); } 
		if( $row->images2) { @unlink("../../data/goodsImages/".$row->images2); } 
		if( $row->images3) { @unlink("../../data/goodsImages/".$row->images3); } 
		if( $row->add_images1) { @unlink("../../data/goodsImages/".$row->add_images1); } 
		if( $row->add_images2) { @unlink("../../data/goodsImages/".$row->add_images2); } 
		if( $row->add_images3) { @unlink("../../data/goodsImages/".$row->add_images3); } 
		if( $row->add_images4) { @unlink("../../data/goodsImages/".$row->add_images4); } 
		if( $row->add_images5) { @unlink("../../data/goodsImages/".$row->add_images5); } 
		// 상품 파일 삭제
		if( $row->goods_file) { @unlink("../../data/goodsImages/".$row->goods_file); }
		$db->delete("cs_goods", "where idx=$elements_data[$i]");
	}
	$tools->javaGo("product_move.php");
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>

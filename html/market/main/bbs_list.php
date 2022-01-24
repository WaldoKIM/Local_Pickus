<? include('./include/head.inc.php');?>
<? include($ROOT_DIR."/lib/page_class.php");?>
<?
	//게시판에 필요한 값들
	$MV_DATA	= $_GET[board_data];
	$BOARD_DATA	= $tools->decode( $_GET[board_data] );
	if($_GET[idx] )					{ $idx = $_GET[idx]; }					else { $idx = $BOARD_DATA[idx]; }
	if($_GET[listNo] )				{ $listNo = $_GET[listNo]; }			else { $listNo = $BOARD_DATA[listNo]; }
	if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }		else { $startPage	= $BOARD_DATA[startPage]; }
	if($_GET[totalList] )			{ $totalList = $_GET[totalList]; }		else { $totalList	= $BOARD_DATA[totalList]; }
	$MV_SEARCH_ITEM	= $_GET[search_items];
	$SEARCH_ITEM	= $tools->decode( $_GET[search_items] );
	if($_GET[code] )			{ $code = $_GET[code]; }		else { $code = $SEARCH_ITEM[code]; }
	if($_GET[search_item] )			{ $search_item = $_GET[search_item]; }		else { $search_item	= $SEARCH_ITEM[search_item]; }
	if($_GET[search_order] )			{ $search_order = $_GET[search_order]; }		else { $search_order	= urldecode($SEARCH_ITEM[search_order]); }
	if($_POST[pwd] )			{ $_POST[pwd] = $_POST[pwd]; }		else { $_POST[pwd]	= $SEARCH_ITEM[pwd]; }
	if($_GET[boardT] )			{ $boardT = $_GET[boardT]; }		else { $boardT = $_POST[boardT]; }
	if($_GET[linkopt] )			{ $linkopt = $_GET[linkopt]; }		else { $linkopt = $SEARCH_ITEM[linkopt]; }
	if($_GET[cate]=='null' )		{
		$cate="";
	}else{
		if($_GET[cate]){ $cate = $_GET[cate]; }		else { $cate	= $SEARCH_ITEM[cate]; }
	}
	if($cate){
		$cate_query = " and category='$cate'";
	}
	$SEARCH_DATA = $tools->encode("code=".$code."&search_item=".$search_item."&search_order=".urlencode($search_order)."&unsingcode1=".$unsingcode1."&unsingcode2=".$unsingcode2."&unsingcode3=".$unsingcode3."&cate=".urlencode($cate)."&pwd=".$_POST[pwd]."&linkopt=".$linkopt);
	$SEARCH_DATA2 = $tools->encode("code=".$code."&search_item=".$search_item."&search_order=".urlencode($search_order)."&unsingcode1=".$unsingcode1."&unsingcode2=".$unsingcode2."&unsingcode3=".$unsingcode3."&pwd=".$_POST[pwd]."&linkopt=".$linkopt);
	$SEARCH_DATA3 = $tools->encode("code=".$code."&search_item=&search_order=&unsingcode1=".$unsingcode1."&unsingcode2=".$unsingcode2."&unsingcode3=".$unsingcode3."&pwd=".$_POST[pwd]."&linkopt=".$linkopt);
	if(!$_SESSION[LEVEL]) $_SESSION[LEVEL]=0;
	if(!$code) { $tools->errMsg("잘못된 접근입니다");}
	$bbs_admin_stat		=	$db->object("cs_bbs", "where code='$code'");
	//페이지 권한설정======================
	$pageAccess = $db->object("cs_user_list", "where idx='$page_info->viewlevel'", "*");
	if($page_info->viewlevel > $_SESSION[LEVEL] ) {
		$tools->errMsg($pageAccess->name.' 이상 접근권한이 있습니다.');
	}
	//1:1게시판 로그인시만 적용
	if($bbs_admin_stat->private && $_SESSION[LEVEL] <= 0) {
		$tools->errMsg('로그인 후 이용하여 주세요.');
	}
	if($bbs_admin_stat->filter){
		$arr_filter = explode(",", $bbs_admin_stat->filter);
		for($i=0;$i<count($arr_filter);$i++){
			$script_value .= "\"".$arr_filter[$i]."\"";
			if(count($arr_filter)-1>$i){
				$script_value .= ",";
			}
			$Array_count = $i;
		}
	}
	$access_name = $db->object("cs_user_list", "where idx='$bbs_admin_stat->bbs_access'", "*");
	$read_name = $db->object("cs_user_list", "where idx='$bbs_admin_stat->bbs_read'", "*");
	$write_name = $db->object("cs_user_list", "where idx='$bbs_admin_stat->bbs_write'", "*");
	// 게시판 접근 권한 설정
	if( $bbs_admin_stat->bbs_access > $_SESSION[LEVEL] ) {
		$tools->errMsg($access_name->name.' 회원이상 접근권한이 있습니다.');
	}
	//SNS설정
	$snstemp = explode("^","^".$bbs_admin_stat->snslist);
	$bbs_data = $tools->encode("idx=&startPage=".$startPage."&listNo=".$listNo);
	if(!$mv_data) $mv_data = $bbs_data;
?>
<div class="site-wrapper" id="box_wrapper">
	<!--상단로고, 가이드메뉴-->
	<? include('./include/top_guide.inc.php');?>
	<!--상단메뉴, 로테이트베너-->
	<? include('./include/top_menu.inc.php');?>
	<!--페이지 위치-->
	<div class="my_location">
		<ol class="breadcrumb titletxt_B">
			<li><a href="index.php" class="titletxt_A">Home</a></li>
			<li class="arrow"><i class="fas fa-angle-right"></i></li>
			<li><i class="fas fa-arrow-left"></i><?=$bbs_admin_stat->name?></li>
		</ol>
	</div>
	<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section bbs_sub_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--페이지서브메뉴-->
					<? include('./include/bbssub_menu.inc.php');?>
					<!--페이지서브메뉴-->
					<div class="bbs_data_area">
						<!--게시판출력 시작-->
						<?if(!$boardT){
						include('../board/'.$bbs_admin_stat->skin.'/list.inc.php');
						}else if($boardT=="w" || $boardT=="rw"){
						include('../board/'.$bbs_admin_stat->skin.'/write.inc.php');
						}else if($boardT=="v"){
						include('../board/'.$bbs_admin_stat->skin.'/view.inc.php');
						}else if($boardT=="pe" || $boardT=="pd" || $boardT=="pv"){
						include('../board/'.$bbs_admin_stat->skin.'/passwd.inc.php');
						}else if($boardT=="e"){
						include('../board/'.$bbs_admin_stat->skin.'/edit.inc.php');
						}?>
						<!--게시판출력 End-->
					</div>
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력1 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div>
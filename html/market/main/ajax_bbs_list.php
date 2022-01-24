<?
include('../common.php');
include($ROOT_DIR."/lib/page_class.php");
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
if($_GET[unsingcode1] )			{ $unsingcode1 = $_GET[unsingcode1]; }		else { $unsingcode1	= $SEARCH_ITEM[unsingcode1]; }
if($_GET[unsingcode2] )			{ $unsingcode2 = $_GET[unsingcode2]; }		else { $unsingcode2	= $SEARCH_ITEM[unsingcode2]; }
if($_GET[unsingcode3] )				{ $unsingcode3 = $_GET[unsingcode3]; }			else { $unsingcode3	= $SEARCH_ITEM[unsingcode3]; }
if($_POST[pwd] )			{ $_POST[pwd] = $_POST[pwd]; }		else { $_POST[pwd]	= $SEARCH_ITEM[pwd]; }
if($_GET[boardT] )			{ $boardT = $_GET[boardT]; }		else { $boardT = $_POST[boardT]; }
if($_GET[cate]=='null' )		{
	$cate="";
}else{
	if($_GET[cate]){ $cate = $_GET[cate]; }		else { $cate	= urldecode($SEARCH_ITEM[cate]); }
}
$searchSQL .= " and code='$code'";
$Arr_search_item = array();
if($search_item){
	$searchSQL .= " and concat($search_item) like '%$search_order%'";
	$Arr_search_item = explode(",",",".$search_item);
}
if($cate){
	$cate_query = " and category='$cate'";
}
$bbs_admin_stat		=	$db->object("cs_bbs", "where code='$code'");
	$SEARCH_DATA = $tools->encode("code=".$code."&search_item=".$search_item."&search_order=".urlencode($search_order)."&unsingcode1=".$unsingcode1."&unsingcode2=".$unsingcode2."&unsingcode3=".$unsingcode3."&cate=".urlencode($cate)."&pwd=".$_POST[pwd]."&linkopt=".$linkopt);
?>
        <section id="least_gallery_oolim">
            <ul class="least-gallery_oolim" style='margin-top:1em;'>
<?
$table				= "cs_bbs_data";
// 리스트갯수
$listScale			=	$bbs_admin_stat->list_height;
// 페이지 갯수
$pageScale		=	$bbs_admin_stat->list_page;
// 스타트 페이지
if( !$startPage ) { $startPage = 0; }
// 토탈페이지
$totalPage = floor($startPage / ($listScale * $pageScale));
// 검색
				if( empty($search_item) || $search_item == 0 ) {
					$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query" );
					$result		= $db->select( $table, "where code='$code'  and notice < 1 $cate_query order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
				} else if( $search_item == 1 ) {
					$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and subject like '%$search_order%'" );
					$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and subject like '%$search_order%' order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
				} else if( $search_item == 2 ) {
					$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and content like '%$search_order%'" );
					$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and content like '%$search_order%' order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
				} else if( $search_item == 4 ) {
					$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and name like '%$search_order%'" );
					$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and name like '%$search_order%' order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
				} else if( $search_item == 3 ) {
					$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (subject like '%$search_order%' or content like '%$search_order%')" );
					$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (subject like '%$search_order%' or content like '%$search_order%') order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
				} else if( $search_item == 6 ) {
					$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%')" );
					$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%') order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
				} else if( $search_item == 5 ) {
					$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (name like '%$search_order%' or subject like '%$search_order%')" );
					$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (name like '%$search_order%' or subject like '%$search_order%') order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
				} else if( $search_item == 7 ) {
					$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%' or subject like '%$search_order%')" );
					$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%' or subject like '%$search_order%') order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
				}
// 페이지넘버
if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
// 루프 시작
$new_cnt = 0; $new_tr = 0; $td_width = $WIDTHCNT ; // 가로리스트 수
while( $bbs_row = mysqli_fetch_object($result)) {
	$new_cnt++;
	$subject				=		$tools->strCut($bbs_row->subject, 20);
	$name					=		$bbs_row->name;
	$read_cnt			=		$bbs_row->read_cnt;
	$reg_date			=		$tools->strDateCut( $bbs_row->reg_date );
	$coment_cnt		=		$db->cnt("cs_bbs_coment", "where link=$bbs_row->idx");
	$ThumbEncode = $tools->encode("idx=".$bbs_row->idx."&table=cs_bbs_data&img=bbs_file&dire=bbsData&w=240&h=240");
	$bbs_data = $tools->encode("idx=".$bbs_row->idx."&startPage=".$startPage."&listNo=".$listNo);
	//비밀글
	$hold_img="";
	$link_direct = "";
	if($bbs_row->hold==1){
		$hold_img = "<img src='images/key_icon.gif' hspace='5' border='0'  style='vertical-align:middle;'>";
		if($_SESSION[USERID]==$bbs_row->userid && $_SESSION[USERID]!=""){$link_direct = "1";}
		if(!$_SESSION[USERID] && !$bbs_row->userid){ $link_direct = "2";}
	}else{
		$link_direct = "1";
	}
	$new_check			=		$bbs_admin_stat->new_check;
	$new_img = "";
	if( $new_check ) {	$new_img			=		$page->bbsNewImg( $bbs_row->reg_date, $bbs_admin_stat->new_mark, "1" ); }
	?>
	<li>
		<?if($new_img==1){?>
		<div class='angle-sensblock_bg1'><div class='angle-sensblock_font1'>NEW</div></div>
		<?}?>
		<?if($bbs_row->bbs_file!="none"){?>
			<a href="<?if($link_direct=="1"){?>?boardT=v&board_data=<?=$bbs_data;?>&search_items=<?=$SEARCH_DATA?><?}else if($link_direct=="2"){?>?boardT=pv&board_data=<?=$bbs_data;?>&search_items=<?=$SEARCH_DATA?><?}else{?>javascript:alert('권한이 없습니다.')<?}?>"  title="<?=$db->stripSlash($subject);?>" data-subtitle="[ <?=$name?> ]&nbsp;&nbsp;[ <?=$reg_date?> ]"><img src="thumbnail.img.php?ThumbEncode=<?=$ThumbEncode?>"></a>
		<?}else{?>
			<a href="<?if($link_direct=="1"){?>?boardT=v&board_data=<?=$bbs_data;?>&search_items=<?=$SEARCH_DATA?><?}else if($link_direct=="2"){?>?boardT=pv&board_data=<?=$bbs_data;?>&search_items=<?=$SEARCH_DATA?><?}else{?>javascript:alert('권한이 없습니다.')<?}?>"><img src="images/noimage_photo.png" border="0"></a>
		<?}?>
		<div class='bbs_default' style='width:90%; margin-bottom:1em;'><?=$db->stripSlash($subject);?></div>
	</li>
<?}?>
	</ul>
</section>
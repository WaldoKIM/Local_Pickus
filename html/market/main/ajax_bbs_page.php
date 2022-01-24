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
$SEARCH_DATA = $tools->encode("code=".$code."&_&search_item=".$search_item."&_&search_order=".urlencode($search_order)."&_&unsingcode1=".$unsingcode1."&_&unsingcode2=".$unsingcode2."&_&unsingcode3=".$unsingcode3."&_&cate=".urlencode($cate)."&_&pwd=".$_POST[pwd]);
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
$totalList	= $db->cnt( $table, "where 1 and notice < 1 $searchSQL $cate_query" );
$result		= $db->select( $table, "where 1 and notice < 1 $searchSQL $cate_query order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
// 페이지넘버
if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
// 루프 시작
$new_cnt = 0; $new_tr = 0; $td_width = $WIDTHCNT ; // 가로리스트 수
while( $bbs_row = mysqli_fetch_object($result)) {
	$bbs_data = $tools->encode("idx=".$bbs_row->idx."&startPage=".$startPage."&listNo=".$listNo);
}
$nextPage = $startPage + $bbs_admin_stat->list_height;
$next_data = $tools->encode("idx=&startPage=".$nextPage."&listNo=".$listNo);
?>
<?if($totalList > $nextPage){?>
<div class='gallery-item-more' id="nextpagebtn"><span onclick="ajaxitem('<?=$next_data;?>', '<?=$SEARCH_DATA?>')" style="cursor:pointer;">제품 더 보기 <i class='fa-chevron-circle-down fa-chevron-circle-down_font'></i></span></div>
<?}?>
<hr/>
<table width="100%">
	<tr>
		<td height="55" align="center" class="enbold">
		<? $page->board( $totalPage, $totalList, $listScale, $pageScale, $startPage, "", "", "", "", $SEARCH_DATA, $_GET[pagename]);?>
		</td>
	</tr>
</table>
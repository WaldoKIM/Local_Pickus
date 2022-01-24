<?
include('../common.php');
include($ROOT_DIR."/lib/page_class.php");
 
$mv_data	= $_GET[goods_data];
$goods_data	= $tools->decode( $_GET[goods_data] );
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $goods_data[idx]; }
if($_GET[part_idx] )			{ $part_idx = $_GET[part_idx]; }						else { $part_idx = $goods_data[part_idx]; }
if($_GET[listNo] )					{ $listNo = $_GET[listNo]; }									else { $listNo = $goods_data[listNo]; }
if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $goods_data[startPage]; }
if($_GET[search_item] )		{ $search_item = $_GET[search_item]; }			else { $search_item	= $goods_data[search_item]; }
if($_GET[search_order] )			{ $search_order = $_GET[search_order]; }		else { $search_order	= urldecode($goods_data[search_order]); }
if($_GET[position] )		{ $position = $_GET[position]; }			else { $position	= urldecode($goods_data[position]); }
//상품아이콘배열화
$iconRe		= $db->select("cs_icon_list", "order by idx asc" );
$arrPicon = array();
$item_array = array();
while( $iconRow = mysqli_fetch_object($iconRe) ) {
	$arrPicon[$iconRow->idx] = $iconRow->icon;
}
if($_GET[pagename]=="brand_list.php"){
	if($position){
		$item_array = explode("^","^".$position."^");
		for($i=1;$i<count($item_array)-1;$i++){
			if($i==1) $txtlist = "'".$item_array[$i]."'";
			else $txtlist .= ",'".$item_array[$i]."'";
		}
		$brandSearch .= " and company IN($txtlist)";
	}
	//브랜드
	if($search_order){
		$brandSearch .= " and concat(name, content, tag) like '%$search_order%'";
	}
}else{
	//이벤트상품
	if($position){
		$brandSearch .= " and main_position='$position'";
	}
}
// 카테고리 정보
if($part_idx) {
	$part_stat = $db->object("cs_part", "where idx=$part_idx");
	for($i=1;$i<=$part_stat->part_index;$i++){
		$part_query .= " and part".$i."_code='".$part_stat->{"part".$i."_code"}."'";
	}
	//상위 카테고리에 속해있는 하위 카테고리 정보 가져오기
	$partQuery = $db->select("cs_part", "where idx > 0 $part_query and part_display_check=1");
	$N=0;
	while( $partRow = mysqli_fetch_object($partQuery)) {
		$N++;
		if($N==1){
			$subList .= $partRow->idx;
		}else{
			$subList .= ", ".$partRow->idx;
		}
	}
	$subList = " and part_idx IN($subList)";
	if(!$search_item) $search_item = $part_stat->list_base_sort;
}else{
	//미사용 카테고리 처리, 미사용카테고리에서 상품이 검색되는 부분
	// 1차 카테고리 분류
	$outPart = "";
	$part1_result = $db->select( "cs_part", "where part_index=1 order by part_ranking asc");
	while( $part1_row = @mysqli_fetch_object($part1_result) ) {
		if($part1_row->part_display_check==0) $outPart .= ",".$part1_row->idx;
		$part2_result = $db->select( "cs_part", "where part_index=2 and part1_code='$part1_row->part1_code' order by part_ranking asc");
		while( $part2_row = @mysqli_fetch_object($part2_result) ) {
			if($part2_row->part_display_check==0 || $part1_row->part_display_check==0) $outPart .= ",".$part2_row->idx;
			$part3_result = $db->select( "cs_part", "where part_index=3 and part2_code='$part2_row->part2_code' and part1_code='$part2_row->part1_code'  order by part_ranking asc");
			while( $part3_row = @mysqli_fetch_object($part3_result) ) {
				if($part3_row->part_display_check==0 || $part2_row->part_display_check==0 || $part1_row->part_display_check==0) $outPart .= ",".$part3_row->idx;
			}
		}
	}
	if($outPart) $outPart = " and part_idx NOT IN(".$outPart.")";
	$part_stat->part_display_item = 0;
	$part_stat->goods_cnt = 20;
	if(!$search_item) $search_item = $design_stat->item_all_sort;
}
//카테고리에 대한 상품 총수량
$total_goods=$db->cnt( "cs_goods", "where display=1 $subList $brandSearch $outPart" );
$goods_data = $tools->encode("idx=&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$part_idx."&search_item=".$search_item."&search_order=".$search_order);
if( $search_item == 1 ) {//이름순
	$sort = " order by name asc";
} else if( $search_item == 2 ) {//가격낮은수
	$sort = " order by shop_price asc";
} else if( $search_item == 3 ) {//가격높은수
	$sort = " order by shop_price desc";
} else if( $search_item == 4 ) {//인기순
	$sort = " order by register desc";
} else {//등록순
	$sort = " order by click desc";
}
$table				= "cs_goods";
$listScale			=	$part_stat->goods_cnt;// 출력 상품수
$pageScale		=	10;		// 페이지 수
if( !$startPage ) { $startPage = 0; }// 스타트 페이지
$totalPage = floor($startPage / ($listScale * $pageScale));// 토탈페이지
$totalList	= $db->cnt( $table, "where display=1 $subList $brandSearch $outPart" );
$result		= $db->select( $table, "where display=1 $subList $brandSearch $outPart $sort LIMIT $startPage, $listScale" );
if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }// 페이지넘버
while( $row = mysqli_fetch_object($result)) {
	$goods_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$row->part_idx."&search_item=".$search_item."&position=".$position."&search_order=".$search_order);
	$ThumbEncode = $tools->encode("idx=".$row->idx."&table=cs_goods&img=images1&dire=goodsImages&w=230&h=230");
	$arrIcon = explode(",",",".$row->iconidx);
	$arrIcon2 = explode(",",",".$row->substimg);
?>
<ul>
	<li class="prd_img"><a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>"><?if($row->resize==1){?><img src="../data/goodsImages/<?=$row->images1?>" border="0"  alt="<?=$row->name?>" class='gallery_box_img'><?}else{?><img src="../data/goodsImages/<?=$row->images1?>" border="0"  alt="<?=$row->name?>" class='gallery_box_img'><?}?></a></li>
	<li class="prd_name">
		<a href='product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>'>
		<p class="product_list_name"><?=$tools->strCut($row->name,45);?></p>
		<p class="product_list_mdname"><?=$tools->strCut($row->content,20);?></p>
	</a></li>
	 <!--아래 가격표시 대신에 들어가는 아이콘 (관리자등록)-->
	<?if($row->subst==1){?>
		<?if($row->substtxt){?><?=$row->substtxt?><?}?>
		<?for($i=1;$i<count($arrIcon2);$i++){
			if($arrIcon2[$i] > 0){
		?>
		<li class="prd_price"><img src="/data/designImages/<?=$arrPicon[$arrIcon2[$i]]?>" align="absmiddle"></li><?}}?>
	<?}else{?>
		<li class="prd_price">
			<p style="max-width:230px;" class="product_list_price">
		<!--시중가-->
		<? if( !$_SESSION[USERID] && $admin_stat->nomember_old_price ) {?><span class='new_price_old'><?=number_format($row->old_price);?>원</span><?} else if( $_SESSION[USERID] && $admin_stat->member_old_price ) {?></span><span class='new_price_old'><?=number_format($row->old_price);?>원</span><?}?>
		<!--판매가-->
		<? if( !$_SESSION[USERID] && $admin_stat->nomember_shop_price ) {?><span class='new_price'><?=number_format($row->shop_price);?>원</span><?} else if( $_SESSION[USERID] && $admin_stat->member_shop_price ) {?><span class='new_price'><?=number_format($row->shop_price);?>원</span><?}?>
			</p>
		</li>
	<?}?>
	<!--베스트,신상,히트 등 아이콘 (관리자등록)-->
	<li class="prd_icon">
		<?for($i=1;$i<count($arrIcon);$i++){
		if($arrIcon[$i] > 0){
		?><span class='gallery_content_icon'><img src="../data/designImages/<?=$arrPicon[$arrIcon[$i]]?>"></span><?}else{?><br><?}}?></span>
	</li>
</ul>
<?}?>
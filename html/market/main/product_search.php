<? include('./include/head.inc.php');?>
<? include($ROOT_DIR.'/lib/page_class.php');?>
<?
	 
	$mv_data	= $_GET[goods_data];
	$goods_data	= $tools->decode( $_GET[goods_data] );
	if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $goods_data[idx]; }
	if($_GET[part_idx] )			{ $part_idx = $_GET[part_idx]; }						else { $part_idx = $goods_data[part_idx]; }
	if($_GET[listNo] )					{ $listNo = $_GET[listNo]; }									else { $listNo = $goods_data[listNo]; }
	if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $goods_data[startPage]; }
	if($_GET[search_item] )		{ $search_item = $_GET[search_item]; }			else { $search_item	= $goods_data[search_item]; }
	if($_POST[search])	{ $_POST[search]=$_POST[search]; } else if($_GET[search]){ $_POST[search]=$_GET[search]; } else { $_POST[search]=$goods_data[search_order];}
	if(!$search_item) $search_item = 4;
	//미사용 카테고리 처리, 미사용카테고리에서 상품이 검색되는 부분
	// 1차 카테고리 분류
	$outPart = "0";
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
	$outPart = " and part_idx NOT IN(".$outPart.")";
	if( $search_item == 1 ) {			//이름순
		$sort = " order by name asc";
	} else if( $search_item == 2 ) {	//가격낮은수
		$sort = " order by shop_price asc";
	} else if( $search_item == 3 ) {	//가격높은수
		$sort = " order by shop_price desc";
	} else if( $search_item == 4 ) {	//인기순
		$sort = " order by register desc";
	} else {							//등록순
		$sort = " order by click desc";
	}
	//카테고리에 대한 상품 총수량
	$total_goods=$db->cnt( "cs_goods", "where (name like '%$_POST[search]%' or content like '%$_POST[search]%' or tag like '%$_POST[search]%' or code like '%$_POST[search]%') and display=1 $outPart " );
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
			<li>상품검색</li>
		</ol>
	</div>
	<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section product_search_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************콘텐츠 시작********************-->
							<div class="search_result_area">
								<span class="s_name">'<?=$_POST[search]?>'</span>에 대한 <span class="num"><?=$total_goods;?></span>개의 검색 결과입니다.
							</div>
							<!--출력형태 버튼 -->
							<div class="filter_btn_area">
								<!--*****순서정렬 버튼 PC용*****-->
								<div class="cbp-vm-options_pc">
									<a href="?part_idx=<?=$part_idx;?>&search_item=1" class="<?if($search_item==1){?> select<?}?>"><span></span>이름순</a>
									<a href="?part_idx=<?=$part_idx;?>&search_item=2" class="<?if($search_item==2){?> select<?}?>"><span></span>가격낮은순</a>
									<a href="?part_idx=<?=$part_idx;?>&search_item=3" class="<?if($search_item==3){?> select<?}?>"><span></span>가격높은순</a>
									<a href="?part_idx=<?=$part_idx;?>&search_item=4" class="<?if($search_item==4){?> select<?}?>"><span></span>등록순</a>
									<a href="?part_idx=<?=$part_idx;?>&search_item=5" class="<?if($search_item==5){?> select<?}?>"><span></span>인기순</a>
								</div>
								<!--*****순서정렬 버튼 모바일용*****-->
								<div class="cbp-vm-options_mobile">
									<a href="?part_idx=<?=$part_idx;?>&search_item=1" class="<?if($search_item==1){?> select<?}?>"><span></span>이름순</a>
									<a href="?part_idx=<?=$part_idx;?>&search_item=2" class="<?if($search_item==2){?> select<?}?>"><span></span>가격낮은순</a>
									<a href="?part_idx=<?=$part_idx;?>&search_item=3" class="<?if($search_item==3){?> select<?}?>"><span></span>가격높은순</a>
									<a href="?part_idx=<?=$part_idx;?>&search_item=4" class="<?if($search_item==4){?> select<?}?>"><span></span>등록순</a>
									<a href="?part_idx=<?=$part_idx;?>&search_item=5" class="<?if($search_item==5){?> select<?}?>"><span></span>인기순</a>
								</div>
							</div>
							<!--출력형태 버튼 END-->
							<div class='spacelin10'></div>
							<div id="isotope_container2" class="masonry-layout" style='margin:0 auto;width:100%;'>
							<?
							$table				= "cs_goods";
							$listScale			=	24;		// 출력 상품수
							$pageScale		=	10;		// 페이지 수
							if( !$startPage ) { $startPage = 0; }		// 스타트 페이지
							$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
							$totalList	= $db->cnt( $table, "where ((name like '%$_POST[search]%' or content like '%$_POST[search]%'  or tag like '%$_POST[search]%' or code like '%$_POST[search]%')) and display=1 $sort" );
							$result		= $db->select( $table, "where (name like '%$_POST[search]%' or content like '%$_POST[search]%' or tag like '%$_POST[search]%' or code like '%$_POST[search]%') and display=1 $sort LIMIT $startPage, $listScale" );
							if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }		// 페이지넘버
							while( $row = mysqli_fetch_object($result)) {
								$goods_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$row->part_idx."&search_item=".$search_item."&position=".$position);
								$ThumbEncode = $tools->encode("idx=".$row->idx."&table=cs_goods&img=images1&dire=goodsImages&w=230&h=230");
								$arrIcon = explode(",",",".$row->iconidx);
								$arrIcon2 = explode(",",",".$row->substimg);
							?>
							<div class="gallery-item col-lg-3" style='margin:0 auto;display:inline-block;vertical-align: top;'>
								<div style="text-align:left;" class='gallery-image gallery_box_img_list'>
									<div class='gallery-image_front'>
										<?/*
										<div class='gallery-image-box'><a href="#" rel="product_zoom.php?goods_data=<?=$goods_data;?>" class='quick-view'><i class='  fa-search-plus fa-search-plus-box' title='미리보기'></i></a><a href="#" rel='dir.itemevent.php?type=1&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fa-shopping-cart fa-shopping-cart-box' title='장바구니담기'></i></a><a href="#" rel='dir.itemevent.php?type=2&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fa-credit-card fa-credit-card-box' title='바로구매'></i></a><a href="#" rel='dir.itemevent.php?type=3&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fa-gratipay fa-gratipay-box' title='관심상품'></i></a></div>
										*/?>
										<!--제품이미지-->
										<a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>"><?if($row->resize==1){?><img src="../data/goodsImages/<?=$row->images1?>" border="0"  alt="<?=$row->name?>" class='gallery_box_img'><?}else{?><img src="../data/goodsImages/<?=$row->images1?>" border="0"  alt="<?=$row->name?>" class='gallery_box_img' style='margin-bottom:10px;'><?}?></a>
									</div>	<!--gallery-image-->
									<!--제품명-->
									<span class='oolimmobilemenuL' style='display:inline-block;padding:0 0 0;'>
									<a href='product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>'>
										<p class="product_list_name"><?=$tools->strCut($row->name,45);?></p>
										<p class="product_list_mdname"><?=$tools->strCut($row->content,20);?></p>
									</a>
									<!--베스트,신상,히트 등 아이콘 (관리자등록)-->
									<?for($i=1;$i<count($arrIcon);$i++){
									if($arrIcon[$i] > 0){
									?><span class='gallery_content_icon'><img src="../data/designImages/<?=$arrPicon[$arrIcon[$i]]?>"></span><?}}?></span>
									<?if($row->subst==1){?> <!--아래 가격표시 대신에 들어가는 아이콘 (관리자등록)-->
										<?if($row->substtxt){?><?=$row->substtxt?><?}?>
										<?for($i=1;$i<count($arrIcon2);$i++){
											if($arrIcon2[$i] > 0){
										?>
										<img src="/data/designImages/<?=$arrPicon[$arrIcon2[$i]]?>" align="absmiddle"><?}}?>
									<?}else{?>
										<p class="product_list_price" style='display:inline-block;'><!--시중가--><? if( !$_SESSION[USERID] && $admin_stat->nomember_old_price ) {?><span class='new_price_old'><?=number_format($row->old_price);?></span><span class='new_price_won_old'>원</span><?} else if( $_SESSION[USERID] && $admin_stat->member_old_price ) {?></span><span class='new_price_old'><?=number_format($row->old_price);?></span><span class='new_price_won_old'>원</span><?}?>
										<!--판매가--><? if( !$_SESSION[USERID] && $admin_stat->nomember_shop_price ) {?><span ><?=number_format($row->shop_price);?></span><span >원</span><?} else if( $_SESSION[USERID] && $admin_stat->member_shop_price ) {?><span ><?=number_format($row->shop_price);?></span><span >원</span><?}?></p>
									<?}?>
								</div><!--gallery_box-->
							</div><!--isotope-item-->
							<?}?>
							</div>
							<!--isotope_container2-->
						<div class='spacelin11'></div>
						<!--*******************상품 리스트출력 출력 ENd*******************-->
						<table width="100%" style='margin:0 auto;'>
							<tr>
								<td height="70" style='text-align:center;'>
								<? $page->goods( $part_stat->idx, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, "", "", "", "", $search_item, $search_order, "", "");?>
								</td>
							</tr>
						</table>
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->
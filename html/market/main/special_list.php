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
	if($_GET[search_order] )			{ $search_order = $_GET[search_order]; }		else { $search_order	= $goods_data[search_order]; }
	if($_GET[position] )		{ $position = $_GET[position]; }			else { $position	= $goods_data[position]; }
	// 카테고리 정보
	if(!$position) {$tools->errMsg('비정상적으로 접속 하였습니다');}
	//카테고리에 대한 상품 총수량
	$total_goods=$db->cnt( "cs_goods", "where main_position=$position" );
	if(!$search_item) $search_item = 4;
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
	//현재 스페셜페이지 정보
	$part_stat = $db->object("cs_part_fixed", "where event_code=$position");
	$specialView = $part_stat->part_name;
	if(!$mv_data) $mv_data = $tools->encode("idx=&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$part_idx."&search_item=".$search_item."&search_order=".$search_order."&position=".$position);
?>
<script type="text/javascript">
function ajaxitem(goods_data){
	ajaxitemlist(goods_data);
	ajaxitempage(goods_data);
}
function ajaxitemlist(goods_data){
	$.ajax({
		type: "GET",
		url: "ajax_product_list.php",
		data: "goods_data="+ goods_data,
		cache: false,
		success: function(html)
		{
			$("div#isotope_container2").append(html);
		}
	});
}
function ajaxitempage(goods_data){
	$.ajax({
		type: "GET",
		url: "ajax_product_page.php",
		data: "pagename=special_list.php&goods_data="+ goods_data,
		cache: false,
		success: function(html)
		{
			$("div#isotope_container3").html(html);
		}
	});
}
window.onload = function () {
	ajaxitem('<?=$mv_data?>');
}
</script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=0.25, user-scalable=yes, target-densitydpi=device-dpi">
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
				<li><i class="fas fa-arrow-left"></i><?=$part_stat->part_name?></li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section prd_list_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate" style='width:90%;margin:0 auto;max-width:1200px'>
				<!--<h3 class="tit"><?=$part_stat->part_name?></h3>-->
				<!--********************콘텐츠 시작********************-->
					<div class="main">
						<?
						$itemcnt = $subeventitemquery = "";
						if($part_stat->part_index==2) $subeventitemquery .=" and cs_part.part2_code='$part_stat->part2_code'";
						if($part_stat->part_index==3) $subeventitemquery .=" and cs_part.part2_code='$part_stat->part2_code' and cs_part.part3_code='$part_stat->part3_code'";
						$result		= $db->result( "select cs_goods.*, cs_part.part1_code from cs_goods, cs_part where cs_goods.part_idx=cs_part.idx and cs_part.part1_code='$part_stat->part1_code' $subeventitemquery and cs_goods.sub_position=1 order by sub_ranking asc" );
						while( $row = mysqli_fetch_object($result)) {
							$itemcnt++;
						}
						if($itemcnt){
						?>
						<hr/>
						<?}?>
						<?
						$itemcnt = "";
						$result		= $db->result( "select cs_goods.*, cs_part.part1_code from cs_goods, cs_part where cs_goods.part_idx=cs_part.idx and cs_part.part1_code='$part_stat->part1_code' $subeventitemquery and cs_goods.sub_position=2 order by sub_ranking asc" );
						while( $row = mysqli_fetch_object($result)) {
							$itemcnt++;
						}
						if($itemcnt){
						?>
						<?}?>
						<?if($itemcnt){?><hr/><?}?>
						<!--*******************상품 리스트출력 시작*******************-->
						<div class="cbp-vm-titleL">							<span style='color:#000000;font-weight:bold'><?=$part_stat->part_name?></span> 상품 <span style='color:#F26522'><?=number_format($total_goods);?></span>개						</div>
						<!--출력형태 버튼 -->						<div class="filter_btn_area">							<!--*****순서정렬 버튼 PC용*****-->							<div class="cbp-vm-options_pc">								<a href="?part_idx=<?=$part_idx;?>&search_item=1&position=<?=$position;?>" class="<?if($search_item==1){?> select<?}?>"><span></span>이름순</a>
								<a href="?part_idx=<?=$part_idx;?>&search_item=2&position=<?=$position;?>" class="<?if($search_item==2){?> select<?}?>"><span></span>가격낮은순</a>
								<a href="?part_idx=<?=$part_idx;?>&search_item=3&position=<?=$position;?>" class="<?if($search_item==3){?> select<?}?>"><span></span>가격높은순</a>
								<a href="?part_idx=<?=$part_idx;?>&search_item=4&position=<?=$position;?>" class="<?if($search_item==4){?> select<?}?>"><span></span>등록순</a>
								<a href="?part_idx=<?=$part_idx;?>&search_item=5&position=<?=$position;?>" class="<?if($search_item==5){?> select<?}?>"><span></span>인기순</a>
							</div>
							<!--*****순서정렬 버튼 모바일용*****-->
							<div class="cbp-vm-options_mobile">
								<span class="now_select">이름순</span>
								<div class="drop_list">
									<a href="?part_idx=<?=$part_idx;?>&search_item=1" class="<?if($search_item==1){?> select<?}?>">이름순</a>									<a href="?part_idx=<?=$part_idx;?>&search_item=2" class="<?if($search_item==2){?> select<?}?>">가격낮은순</a>									<a href="?part_idx=<?=$part_idx;?>&search_item=3" class="<?if($search_item==3){?> select<?}?>">가격높은순</a>									<a href="?part_idx=<?=$part_idx;?>&search_item=4" class="<?if($search_item==4){?> select<?}?>">등록순</a>									<a href="?part_idx=<?=$part_idx;?>&search_item=5" class="<?if($search_item==5){?> select<?}?>">인기순</a>
								</div>
							</div>
						</div>
						<!--출력형태 버튼 END-->
							<div class='spacelin10'></div>
							<div id="isotope_container2" class="masonry-layout prd_list_data" style='margin:0 auto;width:100%;'>
								<!-- 아작내용 출력 -->
							</div>
							<!--isotope_container-->
							<div class='spacelin11'></div>
							<!-- 더보기 및 페이징 출력 -->
							<div id="isotope_container3" style='margin:0 auto;width:100%;'></div>
					</div>
					 <span class="brand_default_width" style="display: none; visibility: hidden;"></span>
					<!--********************콘텐츠 End********************-->
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->
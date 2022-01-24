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
	// 카테고리 정보
	if($part_idx) {
		$part_stat = $db->object("cs_part", "where idx=$part_idx");
		for($i=1;$i<=$part_stat->part_index;$i++){
			$part_query .= " and part".$i."_code='".$part_stat->{"part".$i."_code"}."'";
		}
		//상위 카테고리에 속해있는 하위 카테고리 정보 가져오기
		$partQuery = $db->select("cs_part", "where idx > 0 $part_query");
		$N=0;
		while( $partRow = mysqli_fetch_object($partQuery)) {
			$N++;
			if($N==1){
				$subList .= $partRow->idx;
			}else{
				$subList .= ", ".$partRow->idx;
			}
		}
		if(!$search_item) $search_item = $part_stat->list_base_sort;
		//브랜드
		if($search_order){
			$brandSearch = " and company='$search_order'";
		}
		$subList = " and part_idx IN($subList)";
	}else{
		$part_stat->part_display_item = 0;
		$part_stat->goods_cnt = 20;
		if(!$search_item) $search_item = $design_stat->item_all_sort;
	}
	if(!$mv_data) $mv_data = $tools->encode("idx=&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$part_idx."&search_item=".$search_item."&search_order=".$search_order);
	$total_goods=$db->cnt( "cs_goods", "where display=1 $subList $brandSearch $outPart" );
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
		data: "pagename=product_list.php&goods_data="+ goods_data, 
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
<script language="javascript">
	<!--
	function eventitem(value){
		if(value==1){
			document.bestimg.src="skinimage/sub_best_title_on.gif";
			document.hitimg.src="skinimage/sub_recommend_title_off.gif";
			document.all.bestitemlist.style.display='';
			document.all.hititemlist.style.display='none';
		}else{
			document.bestimg.src="skinimage/sub_best_title_off.gif";
			document.hitimg.src="skinimage/sub_recommend_title_on.gif";
			document.all.bestitemlist.style.display='none';
			document.all.hititemlist.style.display='';
		}
	}
	//-->
</script>
<script type="text/javascript">
	
</script>
	<!--상단로고, 가이드메뉴-->
	<? include('./include/top_guide.inc.php');?>
	<!--상단메뉴, 로테이트베너-->
	<? include('./include/top_menu.inc.php');?>
	<?
	if($part_idx) {
	if( $part_stat->part_index == 1 ) {
		$part_name_result = $db->select("cs_part", "where part1_code='$part_stat->part1_code' && part_index=1 order by idx asc", "idx, part_name");
		} else if( $part_stat->part_index == 2 ) {
		$part_name_result = $db->select("cs_part", "where (part1_code='$part_stat->part1_code' && part_index=1) || (part2_code ='$part_stat->part2_code' && part_index=2) order by idx asc", "idx,part_name");
		} else if( $part_stat->part_index == 3 ) {
		$part_name_result = $db->select("cs_part", "where (part1_code='$part_stat->part1_code' && part_index=1) || (part2_code ='$part_stat->part2_code' && part_index=2) || (part3_code='$part_stat->part3_code' && part_index=3) order by idx asc", "idx, part_name");
		}
	}
	?>
	<!--제품목록(페이지 위치)-->
	<div class="my_location">
		<ol class="breadcrumb titletxt_B">
			<li><a href="index.php" class="titletxt_A">Home</a></li>
			<? $i=0; while( $part_name_stat_row = @mysqli_fetch_object( $part_name_result )) {	++$i;?>
			<? if( $i==1 && $part_stat->part_index == 3) { $part_name_idx=$part_name_stat_row->idx;}?>
			<? if( $i==2 && $part_stat->part_index == 3) {?>
			<li class="arrow"><i class="fas fa-angle-right"></i></li>
			<li><a href="product_list.php?part_idx=<?=$part_name_idx;?>" class="titletxt_A"><?=$part_name_stat_row->part_name;?></a></li>
			<?} else {?>
			<li class="arrow"><i class="fas fa-angle-right"></i></li>
			<li><i class="fas fa-arrow-left"></i><?=$part_name_stat_row->part_name;?></li>
			<?}?><?
			if($i==1) $cate1_name = $part_name_stat_row->part_name;
			if($i==2) $cate2_name = $part_name_stat_row->part_name;
			if($i==3) $cate3_name = $part_name_stat_row->part_name;
			}?>
		</ol>
	</div>
	<!--//제품목록(페이지 위치)-->
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section prd_list_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate" style='width:90%;margin:0 auto; min-height:20em; padding:0 0;max-width:1200px'>
					<!--********************콘텐츠 시작********************-->
					<div class="main">
						<!--메뉴&Best-->
						<div class="lm-best_prd">
						<?/*
							<!--Left Menu-->
							<div class="left_menu">
								<h3><span><?=$cate1_name?><?if($cate2_name){?><br><font size="2"><?=$cate2_name?><?}if($cate3_name){?> > <?=$cate3_name?><?}?></font></span></span></h3>								
								<ul>				
								<?include "shopcate_l.inc.php"; //왼쪽 카테고리 ?>
								<div class='spaceline02'></div>
								<?include("./include/banner_code2.inc.php");//왼쪽 배너?>
							<!-------제품리스트 카테고리출력------>	
								</ul> 
							</div>			
							<!--//Left Menu-->
						*/?>	
							<!--// 서브 카테고리 -->
							<div class="prd_list_flex prd_list_best">			
							<?
							$part2_index_cnt=$db->cnt("cs_part", "where part_index=2 and part1_code='$part_stat->part1_code'");
							$part3_index_cnt=$db->cnt("cs_part", "where part_index=3 and part1_code='$part_stat->part1_code'");
							?>
							<?
							if($part_stat->part1_code && !$part_stat->part2_code && !$part_stat->part3_code){
								$part_list_result=$db->select("cs_part", "where part_index=2 and part1_code='$part_stat->part1_code' and part_display_check=1 order by part_ranking asc");
								while($part_list_row=@mysqli_fetch_object($part_list_result)) {
									if($part_idx == $part_list_row->idx ){
											$font_color="color:#A754D3;";
										}else{
											$font_color="";
										}
								?>	
									<span style="padding-right:30px;white-space:nowrap">							
										<a href="product_list.php?part_idx=<?=$part_list_row->idx;?>" style="<?=$font_color;?>"><?=$part_list_row->part_name;?>
											<? if($part_list_goods_cnt=$db->cnt("cs_goods", "where part_idx=$part_list_row->idx")) {?>(<?=$part_list_goods_cnt;?>)<?} else {?><?}?>
										</a>
									</span>
								<?}
							}else if($part_stat->part1_code && $part_stat->part2_code && !$part_stat->part3_code){	
								if($part3_index_cnt ==0){
									$part_list_result=$db->select("cs_part", "where part_index=2 and part1_code='$part_stat->part1_code' and part_display_check=1 order by part_ranking asc");
								}else{
									$part_list_result=$db->select("cs_part", "where part_index=3 and part2_code='$part_stat->part2_code' and part_display_check=1 order by part_ranking asc");
								}
								while($part_list_row=@mysqli_fetch_object($part_list_result)) {
									if($part_idx == $part_list_row->idx ){
											$font_color="color:#A754D3;";
										}else{
											$font_color="";
										}
								?>	
									<span style="padding-right:30px;white-space:nowrap">							
										<a href="product_list.php?part_idx=<?=$part_list_row->idx;?>" style="<?=$font_color;?>"><?=$part_list_row->part_name;?>
											<? if($part_list_goods_cnt=$db->cnt("cs_goods", "where part_idx=$part_list_row->idx")) {?>(<?=$part_list_goods_cnt;?>)<?} else {?><?}?>
										</a>
									</span>
								<?}
							}else{
								if( $part3_index_cnt!=0) {?>
									<?
									$part_list_result=$db->select("cs_part", "where part_index=3 and part2_code='$part_stat->part2_code' and part_display_check=1 order by part_ranking asc");
									while($part_list_row=@mysqli_fetch_object($part_list_result)) {
										if($part_idx == $part_list_row->idx ){
												$font_color="color:#A754D3;";
											}else{
												$font_color="";
											}
									?>	<span style="padding-right:30px;">							
											<a href="product_list.php?part_idx=<?=$part_list_row->idx;?>" style="<?=$font_color;?>"><?=$part_list_row->part_name;?>
												<? if($part_list_goods_cnt=$db->cnt("cs_goods", "where part_idx=$part_list_row->idx")) {?>(<?=$part_list_goods_cnt;?>)<?} else {?>(0)<?}?>
											</a>
										</span>
									<?}
								}
							}
							?>
							<?//=$part_stat->part1_code?> <?//=$part_stat->part2_code?> <?//=$part_stat->part3_code?>
							</div>
							<!--// 서브 카테고리 //-->							
							
							<?//include('include/prd_list_bestitem.inc.php');?>							
							<!--//메뉴&Best-->
							<!--//상단-->
							<!--*******************상품 리스트출력 시작*******************-->
						
							<div class="prd_list_best" style="max-height:100%">
								<div class="cbp-vm-titleL">
									<span style='color:#000000;font-weight:bold'><?=$part_stat->part_name?></span> 상품 <span style='color:#F26522'><?=number_format($total_goods);?></span>개
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
										<span class="now_select">이름순</span>
										<div class="drop_list">
											<a href="?part_idx=<?=$part_idx;?>&search_item=1" class="<?if($search_item==1){?> select<?}?>">이름순</a>
											<a href="?part_idx=<?=$part_idx;?>&search_item=2" class="<?if($search_item==2){?> select<?}?>">가격낮은순</a>
											<a href="?part_idx=<?=$part_idx;?>&search_item=3" class="<?if($search_item==3){?> select<?}?>">가격높은순</a>
											<a href="?part_idx=<?=$part_idx;?>&search_item=4" class="<?if($search_item==4){?> select<?}?>">등록순</a>
											<a href="?part_idx=<?=$part_idx;?>&search_item=5" class="<?if($search_item==5){?> select<?}?>">인기순</a>
										</div>
									</div>
								</div>
								<!--출력형태 버튼 END-->
								<div id="isotope_container2" class="prd_list_data">
									<!-- 아작내용 출력 -->
								</div>
								<!--isotope_container-->
								<!-- 더보기 및 페이징 출력 -->
							</div>						
						</div>						
					</div>

						<div id="isotope_container3" style='margin:0 auto;width:100%;'></div>
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
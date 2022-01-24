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
	if($_GET[search_order] )			{ $search_order = $_GET[search_order]; }		else { $search_order	= urldecode($goods_data[search_order]); }
	if($_GET[position] )		{ $position = $_GET[position]; }			else { $position	= urldecode($goods_data[position]); }
	if(!$search_item) $search_item = 4;
	$item_array = array();
	if($position){
		$item_array = explode("^","^".$position);
		for($i=1;$i<count($item_array)-1;$i++){
			if($i==1) $txtlist = "'".$item_array[$i]."'";
			else $txtlist .= ",'".$item_array[$i]."'";
		}
		$brandSearch .= " and company IN($txtlist)";
	}
	//브랜드
	if($search_order){
		$brandSearch .= " and concat(name, content) like '%$search_order%'";
	}
	//상품아이콘배열화
	$iconRe		= $db->select("cs_icon_list", "order by idx asc" );
	$arrPicon = array();
	while( $iconRow = mysqli_fetch_object($iconRe) ) {
		$arrPicon[$iconRow->idx] = $iconRow->icon;
	}
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
	//브랜드에 대한 상품 총수량
	$total_goods=$db->cnt( "cs_goods", "where display=1 $brandSearch $outPart" );
	if(!$search_item) $search_item = $design_stat->item_all_sort;
	if(!$mv_data) $mv_data = $tools->encode("idx=&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$part_idx."&search_item=".$search_item."&search_order=".$search_order."&position=".$position);
	$part_stat = $db->object("cs_part_fixed", "where idx=1");
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
		data: "pagename=brand_list.php&goods_data="+ goods_data,
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
		data: "pagename=brand_list.php&goods_data="+ goods_data,
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
	<? include('./include/pagetitle.inc.php');?>
		<div class="container" style='width:100%; text-align:center;'>
			<div class="row">
				<div class="col-sm-12 text-center">
					<h2 class="titletxt_B"><?=$part_stat->part_name?></h2>
					<ol class="breadcrumb titletxt_B"><li><a href="index.php" class="titletxt_A">Home</a><i class='fa-angle-right' style='padding:0 5px;'></i>브랜드별 상품매장
					<!--
					<i class='fa-angle-right' style='padding:0 5px;'></i>
					<select name="search_order" class="formSelect" id="sel_01" onchange="brandChange(this.value)" style='max-width:150px;'>
						<option value="0" <? if($search_order == "") echo('selected');?>>브랜드별 상품검색</option>
						<?
						$result_area = $db->result("select distinct company from cs_goods where display=1 $subList order by company asc");
						while($row_area = @mysqli_fetch_object( $result_area )) {
						?>
						<option value="<?=$row_area->company;?>" <? if($search_order == $row_area->company) echo('selected');?>><?=$row_area->company;?></option>
						<?}?>
					</select>
					-->
					</li></ol>
				</div>
			</div>
		</div>
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate" style='width:90%;margin:0 auto; min-height:20em; padding:2em 0;'>
						<!--*******************상품 리스트출력 시작*******************-->
						<script language="javascript">
						<!--
						// 메인 로그인
						function brandsearch() {
							var form=document.search_brand;
							elementsSendit();
							if(form.position.value==""){
								alert("하나 이상의 브랜드를 선택하여 주세요.");
							} else {
								form.submit();
							}
						}
						function searchInputSendit2() {
							if(event.keyCode==0) {
								brandsearch();
							}
						}
						// 배열화 하여 전송
						function elementsSendit(){
							var form=document.search_brand;
							form.position.value="";
							for(i=0; i < form.search_item_list.length; i++){
								if(form.search_item_list[i].checked  == true) {
									form.position.value =form.position.value + form.search_item_list[i].value;
									form.position.value= form.position.value + "^";
								}
							}
						}
						//-->
						</script>
						<div id="blandlayer-01">
							<div class='layer-item-boxbold'>
								<table width="100%" style='background:#ffffff;'>
									<form name="search_brand" method="get" action="brand_list.php"  onsubmit="searchInputSendit2();event.returnValue = false;">
									<input type="hidden" name="position">
									<input type="checkbox" name="search_item_list" style="display:none">
									<tr>
									<?
									$new_cnt = 0; $new_tr = 0; $td_width = 5 ; // 가로리스트 수
									$result_area = $db->result("select distinct company from cs_goods where display=1 order by company asc");
									while($row_area = @mysqli_fetch_object( $result_area )) {
										$new_cnt++;
									?>
										<td class='tabletd_all' width="<? $width_td = 100/$td_width; echo($width_td."%");?>" style='text-align:center;'>
											<input type="checkbox" name="search_item_list" value="<?=$row_area->company;?>" <?if(array_search($row_area->company, $item_array)){?>checked<?}?> onclick="elementsSendit()"><?=$row_area->company;?>
										</td>
										<? if (($new_cnt % $td_width) == 0) { $new_tr++;?>
									</tr>
									<tr>
										<?}}?>
										<? $new_td = $td_width - ($new_cnt%$td_width);	for($i=0; $i<$new_td; $i++) { if( $new_cnt != $td_width * $new_tr) {?>
										<!-- 반복 생성 -->
										<td class='tabletd_all' style='text-align:center;' width="<? $width_td = 100/$td_width; echo($width_td."%");?>" align="center">&nbsp;</td>
										<?}}?>
									</tr>
								</table>
								<br>
								<table style='margin:0 auto'>
									<tr>
									  <td>
										<input name="search_order" id="search_order" type="text" class='formText formText_subject' placeholder='*브랜드내 상품검색'></td>
									  <td><a href="javascript:brandsearch();"  style='width:60px;font-size:11pt; line-height:34px;' class='btn-add'>검색</a></td>
									</tr>
									</form>
								</table>
							</div>
						</div>
						<div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
							<!--출력형태 버튼 -->
							<div class="">
								<table width='100%'>
									<tr>
										<td style='text-align:center;'>
										<!--*****순서정렬 버튼 PC용*****-->
										<div class="cbp-vm-options_pc">
											<a href="?search_item=1" class="button_oolim_buttonL gray_oolim_buttonL<?if($search_item==1){?> button_oolim_buttonOverL<?}?>">이름순</a>
											<a href="?search_item=2" class="button_oolim_buttonL gray_oolim_buttonL<?if($search_item==2){?> button_oolim_buttonOverL<?}?>">가격낮은순</a>
											<a href="?search_item=3" class="button_oolim_buttonL gray_oolim_buttonL<?if($search_item==3){?> button_oolim_buttonOverL<?}?>">가격높은순</a>
											<a href="?search_item=4" class="button_oolim_buttonL gray_oolim_buttonL<?if($search_item==4){?> button_oolim_buttonOverL<?}?>">등록순</a>
											<a href="?search_item=5" class="button_oolim_buttonL gray_oolim_buttonL<?if($search_item==5){?> button_oolim_buttonOverL<?}?>">인기순</a></div>
										<!--*****순서정렬 버튼 모바일용*****-->
										<div class="cbp-vm-options_mobile">
											<a href="?search_item=1" class="button_oolim_buttonL gray_oolim_buttonL<?if($search_item==1){?> button_oolim_buttonOverL<?}?>">이름순</a>
											<a href="?search_item=2" class="button_oolim_buttonL gray_oolim_buttonL<?if($search_item==2){?> button_oolim_buttonOverL<?}?>">가격낮은순</a>
											<a href="?search_item=3" class="button_oolim_buttonL gray_oolim_buttonL<?if($search_item==3){?> button_oolim_buttonOverL<?}?>">가격높은순</a>
											<a href="?search_item=4" class="button_oolim_buttonL gray_oolim_buttonL<?if($search_item==4){?> button_oolim_buttonOverL<?}?>">등록순</a>
											<a href="?search_item=5" class="button_oolim_buttonL gray_oolim_buttonL<?if($search_item==5){?> button_oolim_buttonOverL<?}?>">인기순</a></div>
										</td>
									</tr>
								</table>
							</div>
							<div class='spacelin11'></div>
							<!--출력형태 버튼 END-->
							<div class="cbp-vm-titleL" style='text-align:center;'><span style='color:#000000'><?=$specialView?></span> 카테고리내에 총 (<span style='color:#F26522'><?=number_format($total_goods);?></span>)개의 상품이 있습니다.</div>
							<div class='spacelin10'></div>
							<div class='spacelin10'></div>
							<div id="isotope_container2" class="masonry-layout" style='margin:0 auto;width:100%;'>
								<!-- 아작내용 출력 -->
							</div>
							<!--isotope_container-->
							<div class='spacelin11'></div>
							<!-- 더보기 및 페이징 출력 -->
							<div id="isotope_container3" style='margin:0 auto;width:100%;'>
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
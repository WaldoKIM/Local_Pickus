<?php
$result = $db->result( "select cs_goods.*, cs_part.part1_code from cs_goods, cs_part where cs_goods.part_idx=cs_part.idx and cs_part.part1_code='$part_stat->part1_code' $subeventitemquery and cs_goods.sub_position=2 order by sub_ranking asc" );
$best_cnt =  @mysqli_fetch_row($result);
if($best_cnt){
?>
<script type="text/javascript">
$(document).ready(function () {
    //Slide
    $('.prd_list_best').flexslider({
        animation: "",
        pauseOnAction: false,
        pauseOnHover: true,
        controlNav: true,
        slideshow: false,
        directionNav:false,
        animationSpeed: 1000,
        slideshowSpeed: 5000,
    });
});
</script>
<?$styletxt = array("feature_product", "featured-products", "featured-carousel", "featured_default_width");?>
<div class="prd_list_best">
	<h3>BEST PICK</h3>
		<ul class="slides">
		<?
		while( $row = mysqli_fetch_object($result)) {
			$goods_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$row->part_idx."&search_item=".$search_item);
			$ThumbEncode = $tools->encode("idx=".$row->idx."&table=cs_goods&img=images1&dire=goodsImages&w=260&h=260");
			$arrIcon = explode(",",",".$row->iconidx);
			$arrIcon2 = explode(",",",".$row->substimg);
		?>
		<li class="list_data">
			<ol>
				<li class="prd_img"><a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>" title="#" class="product-image"><?if($row->resize==1){?><img src="../data/goodsImages/<?=$row->images1?>" alt="<?=$row->name?>"  class='gallery_box_img'><?}else{?><img src="../data/goodsImages/<?=$row->images1?>" border="0"  alt="<?=$row->name?>"  class='gallery_box_img'><?}?></li>
				<li class="prd_name"><a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>"><?=$tools->strCut($row->name,45);?></a></li>
					<?if($row->subst==1){?>
					<?if($row->substtxt){?><?=$row->substtxt?><?}?>
					<?for($i=1;$i<count($arrIcon2);$i++){
						if($arrIcon2[$i] > 0){
					?><li class="prd_price"><img src="../data/designImages/<?=$arrPicon[$arrIcon[$i]]?>" align="absmiddle"></li>
					<?}}?>
					<?}else{?>
						<li class="prd_price">
						<span class="price old-price"><? if( !$_SESSION[USERID] && $admin_stat->nomember_old_price ) {?><?=number_format($row->old_price);?>원<?} else if( $_SESSION[USERID] && $admin_stat->member_old_price ) {?><?=number_format($row->old_price);?>원<?}?></span>
						<span class="price special-price"><? if( !$_SESSION[USERID] && $admin_stat->nomember_shop_price ) {?><?=number_format($row->shop_price);?>원<?} else if( $_SESSION[USERID] && $admin_stat->member_shop_price ) {?><?=number_format($row->shop_price);?>원<?}?></span>
						</li>
					<?}?>
				<li class="prd_icon">
					<?for($i=1;$i<count($arrIcon);$i++){
						if($arrIcon[$i] > 0){
					?>
					<span class='gallery_content_icon'><img src="/data/designImages/<?=$arrPicon[$arrIcon[$i]]?>" align="absmiddle" class='noneoolim'></span>
					<?}}?>
				</li>
			</ol>
		</li>
		<?}?>
	</ul>
	<span style="display:none; visibility:hidden" class="<?=$styletxt[3]?>"></span>
 </div>
<?}?>
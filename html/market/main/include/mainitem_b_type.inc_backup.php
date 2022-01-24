<style type="text/css">
.new_mainitem_typeB *{box-sizing:border-box}
.new_mainitem_typeB .item{min-height:320px}
.new_mainitem_typeB .gallery-image{width:100%;display:inline-block;padding:0 3%}
.new_mainitem_typeB .gallery-image .thumbnail_area img{border:1px solid #f0f0f0}
.new_mainitem_typeB .gallery-image:hover .thumbnail_area img{opacity:1}
.new_mainitem_typeB .thumbnail_area{position:relative;display:inline-block;margin:0 auto}
.new_mainitem_typeB .thumbnail_area a.thum_img{display:inline-block}
.new_mainitem_typeB .icon-image-box{width:100%;position:absolute;bottom:11px;left:0;background:rgba(255,255,255,0.8);border-left:1px solid #f0f0f0;border-right:1px solid #f0f0f0;display:none}
.new_mainitem_typeB .icon-image-box a{width:15%;display:inline-block;line-height:1em;padding:10px 0;color:#222;opacity:0.7}
.new_mainitem_typeB .icon-image-box a:hover{opacity:1}
.new_mainitem_typeB .thumbnail_area:hover .icon-image-box{display:inline-block}
.new_mainitem_typeB .prd_name{min-height:65px;padding:20px 4% 0 4%;width:100%;display:block}
.new_mainitem_typeB .prd_name a{width:100%;display:block;font-size:14px;line-height:20px;color:#222}
.new_mainitem_typeB .prd_name a:hover{text-decoration:underline}
.new_mainitem_typeB .price-box{padding:0 4%;height:47px;box-sizing:border-box}
.new_mainitem_typeB .price-box .old-price{width:100%;display:inline-block;color:#7b7b7b!important;font-size:12px!important;line-height:12px}
.new_mainitem_typeB .price-box .special-price{width:100%;display:inline-block;color:#222!important;font-size:14px!important;padding:0;line-height:14px}
.new_mainitem_typeB .gallery_content_icon{width:100%;display:inline-block}
.new_mainitem_typeB .gallery_content_icon span{display:inline-block}
</style>
<!--메인 추천상품 출력 시작-->
<div id="cbp-vm">
	<div class="subitem-title1">
		<h1 style='color:#333'><?=$db->stripSlash($eventpart->part_ename)?></h1> 
		<h2><?if($eventpart->short_content){?><?=$db->stripSlash($eventpart->short_content)?><?}else{?><?=$db->stripSlash($eventpart->part_name)?><?}?></h2>
		<ul class="b_type_flex">
			<?
			$part1_result = $db->select( "cs_part", "where part_index=1 and part_display_check=1 order by part_ranking asc");
			// 주메뉴
			while( $part1_row = @mysqli_fetch_object($part1_result) ) {
			$depth2_cnt = $db->cnt("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code'");
			if(!$depth2_cnt){
			?>
			<li>
				<a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>special_list.php?position=<?=$main_position?>&&part_idx=<?=$part1_row->idx;?><?}?>" >
				<?if($part1_row->list_display_check==1) {?><img src="<?=$P1_images;?>">
				<?}else if($part1_row->list_display_check==2){?><a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>special_list.php?position=<?=$main_position?>&&part_idx=<?=$part1_row->idx;?><?}?>" onMouseOver='rollover<?=$part1_row->idx?>.src="<?=$P2_images;?>"' onMouseOut='rollover<?=$part1_row->idx?>.src="<?=$P1_images;?>"'><img src="<?=$P1_images;?>" name="rollover<?=$part1_row->idx?>" >
				<?}else{?><?=$part1_row->part_name;?><?}?>
				</a>
			</li>
			<?}else{?>
			<li>
			<a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>special_list.php?position=<?=$main_position?>&&part_idx=<?=$part1_row->idx;?><?}?>" >
			<?if($part1_row->list_display_check==1) {?><img src="<?=$P1_images;?>">
			<?}else if($part1_row->list_display_check==2){?><a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>special_list.php?position=<?=$main_position?>&&part_idx=<?=$part1_row->idx;?><?}?>" onMouseOver='rollover<?=$part1_row->idx?>.src="<?=$P2_images;?>"' onMouseOut='rollover<?=$part1_row->idx?>.src="<?=$P1_images;?>"'><img src="<?=$P1_images;?>" name="rollover<?=$part1_row->idx?>">
			<?}else{?><?=$part1_row->part_name;?><?}?>
			</a>
			</li>
			<?}}?>
		</ul>
	</div>
	<ul class="b_type_item_flex">
		<?
		$listScale			=	$eventpart->goods_main_cnt; 		// 출력 상품수
		if($eventpart->itemsort==1) $sort = " order by rand() LIMIT ".$listScale;
		else $sort = " order by idx desc LIMIT ".$listScale;
		$result		= $db->select( "cs_goods", "where main_position=$main_position and display=1 $sort" );
		while( $row = mysqli_fetch_object($result)) {
			$goods_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$row->part_idx."&search_item=".$search_item);
			$ThumbEncode = $tools->encode("idx=".$row->idx."&table=cs_goods&img=images1&dire=goodsImages&w=260&h=260");
			$arrIcon = explode(",",",".$row->iconidx);
			$arrIcon2 = explode(",",",".$row->substimg);
		?>
		<li style="height:auto !important;" class="item slider-item">
			<div class='gallery-image'>
				<div class="thumbnail_area">
					<a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>" title="" class="thum_img"><?if($row->resize==1){?>
						<img src="../data/goodsImages/<?=$row->images1?>" alt="<?=$row->name?>">
						<?}else{?>
						<img src="../data/goodsImages/<?=$row->images1?>" border="0"  alt="<?=$row->name?>">
						<?}?>
					</a>
					<!--Icon-->
					<!-- <div class="icon-image-box">
						<a href="#" rel="product_zoom.php?goods_data=<?=$goods_data;?>" class='quick-view'><i class='far fa-search-plus' title='미리보기'></i></a>
						<a href="#" rel='dir.itemevent.php?type=1&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fas fa-shopping-cart' title='장바구니담기'></i></a>
						<a href="#" rel='dir.itemevent.php?type=2&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fas fa-credit-card' title='바로구매'></i></a>
						<a href="#" rel='dir.itemevent.php?type=3&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fas fa-eye' title='관심상품'></i></a>
					</div> -->
					<!--Icon-->
				</div>
				<div class="prd_name">
					<a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>" class='sens_body'>
						<p class="product_list_name"><?=$tools->strCut($row->name,45);?></p>
						<p class="product_list_mdname"><?=$tools->strCut($row->content,20);?></p>
					</a>
				</div>
				<div>
					<a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>" class='sens_body'>
					<?if($row->subst==1){?>
					<?if($row->substtxt){?><?=$row->substtxt?><?}?>
					<?for($i=1;$i<count($arrIcon2);$i++){
						if($arrIcon2[$i] > 0){
					?><img src="../data/designImages/<?=$arrPicon[$arrIcon[$i]]?>" align="absmiddle">
					<?}}?>
					<?}else{?>
						<span style="display:none;" class="price old-price"><? if( !$_SESSION[USERID] && $admin_stat->nomember_old_price ) {?><?=number_format($row->old_price);?>원<?} else if( $_SESSION[USERID] && $admin_stat->member_old_price ) {?><?=number_format($row->old_price);?>원<?}?></span>
						<span class="price special-price"><p class="product_list_price"><? if( !$_SESSION[USERID] && $admin_stat->nomember_shop_price ) {?><?=number_format($row->shop_price);?>원<?} else if( $_SESSION[USERID] && $admin_stat->member_shop_price ) {?><?=number_format($row->shop_price);?>원<?}?></p></span>
					<?}?>
					</a>
				</div>
				<div class='gallery_content_icon'>
				<?for($i=1;$i<count($arrIcon);$i++){
					if($arrIcon[$i] > 0){
				?>
					<span><img src="/data/designImages/<?=$arrPicon[$arrIcon[$i]]?>" align="absmiddle" class='noneoolim'></span>
				<?}}?>
				</div>
			</div>
		</li>
		<?}?>
	</ul>
	<a class="more_btn" href="special_list.php?position=<?=$main_position?>">더보기<img src="./img/go.png" alt=""></a>
</div>
<style type="text/css">
.new_mainitem_typeA .product-block-inner{}
.new_mainitem_typeA .gallery-image{width:100%;display:inline-block}
.new_mainitem_typeA .gallery-image a.product-image{width:100%;display:block;border-bottom:1px solid #fff;padding:20px;box-sizing:border-box}
.new_mainitem_typeA .gallery-image a.product-image img{border:none;width:100%!important}
.new_mainitem_typeA .gallery-image .oolimmobilemenuL{padding:0 20px;width:100%;display:block;box-sizing:border-box}
.new_mainitem_typeA .gallery-image .oolimmobilemenuL a{width:100%;display:block;font-size:14px;line-height:20px;color:#222}
.new_mainitem_typeA .gallery-image .oolimmobilemenuL a:hover{text-decoration:underline}
.new_mainitem_typeA .product-block:hover{border:none}
/* .new_mainitem_typeA .product-block:hover a.product-image{border-bottom:1px solid #000} */
.new_mainitem_typeA .product-block:hover a.product-image img{border:none;opacity:initial}
/* .new_mainitem_typeA .product-block:hover .oolimmobilemenuL{border-top:1px solid #000} */
.new_mainitem_typeA .product-block-inner .best-label{display:none}
.new_mainitem_typeA .product-block-inner .price-box{padding:0 20px;height:47px;box-sizing:border-box}
.new_mainitem_typeA .product-block-inner .price-box .old-price{width:100%;display:inline-block;color:#7b7b7b!important;font-size:12px!important;line-height:12px}
.new_mainitem_typeA .product-block-inner .price-box .special-price{width:100%;display:inline-block;color:#222!important;font-size:14px!important;line-height:14px}
/* .new_mainitem_typeA .first_item_tm a.product-image{border-bottom:1px solid #000} */
/* .new_mainitem_typeA .first_item_tm .oolimmobilemenuL{border-top:1px solid #000} */
.new_mainitem_typeA .icon-image-box{width:100%;display:inline-block;margin:15px 0}
.new_mainitem_typeA .icon-image-box a{width:30px;height:30px;border:1px solid #d6d6d6;color:#929292;display:inline-block;text-align:center;line-height:30px;border-radius:3px}
.new_mainitem_typeA .icon-image-box a i{vertical-align:middle}
.new_mainitem_typeA .icon-image-box a:hover{background:#d6d6d6;color:#fff}
.new_mainitem_typeA .gallery_content_icon{display:none}
</style>
<div class="<?=$styletxt[0]?> new_mainitem_typeA"> 
	<div class="<?=$styletxt[1]?>">
	<div class="subitem-title1">
		<h1 style='color:#333'><?=$db->stripSlash($eventpart->part_ename)?></h1> 
		<h2><?if($eventpart->short_content){?><?=$db->stripSlash($eventpart->short_content)?><?}else{?><?=$db->stripSlash($eventpart->part_name)?><?}?></h2>
		
		<ul>
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
	<!--이전다음 아이콘-->
	<div class="customNavigation">
		<a class="btn prev" title='이전'>&nbsp;</a>
		<a class="btn next" title='다음'>&nbsp;</a>
	</div>	
		<ul class="product-carousel" id="<?=$styletxt[2]?>">
		<?
			$table				= "cs_goods";
			$listScale			=	$eventpart->goods_main_cnt; 		// 출력 상품수
			if($eventpart->itemsort==1) $sort = " order by rand() LIMIT ".$listScale;
			else $sort = " order by idx desc LIMIT ".$listScale;
			$result		= $db->select( "cs_goods", "where main_position=$main_position and display=1 $sort" );
			while( $row = mysqli_fetch_object($result)) {
				$goods_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$row->part_idx."&search_item=".$search_item);
				$ThumbEncode = $tools->encode("idx=".$row->idx."&table=cs_goods&img=images1&dire=goodsImages&w=230&h=230");
				$arrIcon = explode(",",",".$row->iconidx);
				$arrIcon2 = explode(",",",".$row->substimg);
			?>
		  <li style="height:auto !important;"class="item slider-item">
			<div class="product-block">
				<div class="product-block-inner">
					 <div class="best-label" style="background-color: #<?=$eventpart->corner_color?>;">
						<?=$eventpart->corner_name?>
					 </div>
					<div class='gallery-image'>				
						<a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>" title="" class="product-image"><?if($row->resize==1){?><img src="../data/goodsImages/<?=$row->images1?>" alt="<?=$row->name?>" class='gallery_box_img' /><?}else{?><img src="../data/goodsImages/<?=$row->images1?>" border="0"  alt="<?=$row->name?>" class='gallery_box_img' style='margin-bottom:10px;'><?}?></a>
						<span class='oolimmobilemenuL' style='display:inline-block'><a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>" class='sens_body'>
						<p class="product_list_name"><?=$tools->strCut($row->name,45);?></p>
						<p class="product_list_mdname"><?=$tools->strCut($row->content,20);?></p>
						</a>
						
						</span>
						<div class="price-box">
							<?if($row->subst==1){?>
							<?if($row->substtxt){?><?=$row->substtxt?><?}?>
							<?for($i=1;$i<count($arrIcon2);$i++){
								if($arrIcon2[$i] > 0){
							?><img src="../data/designImages/<?=$arrPicon[$arrIcon2[$i]]?>" align="absmiddle">
							<?}}?>
							<?}else{?>
							<span style="display:none;" class="price old-price"><? if( !$_SESSION[USERID] && $admin_stat->nomember_old_price ) {?><?=number_format($row->old_price);?>원<?} else if( $_SESSION[USERID] && $admin_stat->member_old_price ) {?><?=number_format($row->old_price);?>원><?}?></span>
							<span class="price special-price"><p class="product_list_price"><? if( !$_SESSION[USERID] && $admin_stat->nomember_shop_price ) {?><?=number_format($row->shop_price);?>원<?} else if( $_SESSION[USERID] && $admin_stat->member_shop_price ) {?><?=number_format($row->shop_price);?>원<?}?></p></span>
							<?}?>
						</div>
						<?/*
						<div class='icon-image-box'>
							<a href="#" rel="product_zoom.php?goods_data=<?=$goods_data;?>" class='quick-view'>
								<i class='far fa-search-plus' title='미리보기'></i>
							</a>
							<a href="#" rel='dir.itemevent.php?type=1&goods_data=<?=$goods_data;?>' class='quick-view'>
								<i class='fas fa-shopping-cart' title='장바구니담기'></i>
							</a>
							<a href="#" rel='dir.itemevent.php?type=2&goods_data=<?=$goods_data;?>' class='quick-view'>
								<i class='fas fa-credit-card' title='바로구매'></i>
							</a>
							<a href="#" rel='dir.itemevent.php?type=3&goods_data=<?=$goods_data;?>' class='quick-view'>
								<i class='fas fa-eye' title='관심상품'></i>
							</a>
						</div>
						*/?>
						<?for($i=1;$i<count($arrIcon);$i++){
							if($arrIcon[$i] > 0){
						?>
						<span class='gallery_content_icon'><img src="/data/designImages/<?=$arrPicon[$arrIcon[$i]]?>" align="absmiddle" class='noneoolim'></span>
						<?}}?>
					</div><!--gallery-image-->
				</div>											
			</div>
		   </li>
		   <?}?>
		</ul>
		<a class="more_btn" href="special_list.php?position=<?=$main_position?>">더보기<img src="./img/go.png" alt=""></a>
	</div>
	<span style="display:none; visibility:hidden" class="<?=$styletxt[3]?>"></span>
 </div>

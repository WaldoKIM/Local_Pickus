<?$styletxt = array("new_product", "new-products", "newproduct-carousel", "newproduct_default_width");?>
<div class="<?=$styletxt[0]?>">
	<div class="<?=$styletxt[1]?>">
	<div class="subitem-title1"><h2>추천상품</h2> <h1 style='color:#5F82E5'>Recommend Item</h1></div>
	<!--이전다음 아이콘-->
	<div class="customNavigation">
		<a class="btn prev" title='이전'>&nbsp;</a>
		<a class="btn next" title='다음'>&nbsp;</a>
	</div>
	<div class='spacelin11'></div>
		<ul class="product-carousel" id="<?=$styletxt[2]?>">
		<?
			$result		= $db->result( "select cs_goods.*, cs_part.part1_code from cs_goods, cs_part where cs_goods.part_idx=cs_part.idx and cs_part.part1_code='$part_stat->part1_code' $subeventitemquery and cs_goods.sub_position=1 order by sub_ranking asc" );
			while( $row = mysqli_fetch_object($result)) {
				$goods_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$row->part_idx."&search_item=".$search_item);
				$ThumbEncode = $tools->encode("idx=".$row->idx."&table=cs_goods&img=images1&dire=goodsImages&w=250&h=250");
				$arrIcon = explode(",",",".$row->iconidx);
				$arrIcon2 = explode(",",",".$row->substimg);
			?>
		  <li class="item slider-item">
			<div class="product-block">
				<div class="product-block-inner">
						<div class='gallery-image'>
									<div class='gallery-image-box'><a href="#" rel="product_zoom.php?goods_data=<?=$goods_data;?>" class='quick-view'><i class='  fa-search-plus fa-search-plus-box' title='미리보기'></i></a><a href="#" rel='dir.itemevent.php?type=1&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fa-shopping-cart fa-shopping-cart-box' title='장바구니담기'></i></a><a href="#" rel='dir.itemevent.php?type=2&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fa-credit-card fa-credit-card-box' title='바로구매'></i></a><a href="#" rel='dir.itemevent.php?type=3&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fa-gratipay fa-gratipay-box' title='관심상품'></i></a></div>
										<a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>" class="product-image"><?if($row->resize==1){?><img src="thumbnail.img.php?ThumbEncode=<?=$ThumbEncode?>" alt="<?=$row->name?>" class='gallery_box_img' style='margin-bottom:10px;'><?}else{?><img src="../data/goodsImages/<?=$row->images1?>" border="0"  alt="<?=$row->name?>" class='gallery_box_img' style='margin-bottom:10px;'><?}?></a>
										<span class='oolimmobilemenuL' style='display:inline-block;padding:0 0 0;'><a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>" class='sens_body'>
										<?=$tools->strCut($row->name,45);?>
										</a>
										<?for($i=1;$i<count($arrIcon);$i++){
											if($arrIcon[$i] > 0){
										?><span class='gallery_content_icon'><img src="/data/designImages/<?=$arrPicon[$arrIcon[$i]]?>" align="absmiddle" class='noneoolim'></span>
										<?}}?></span>
									<div class="price-box">
										<?if($row->subst==1){?>
											<?if($row->substtxt){?><?=$row->substtxt?><?}?>
											<?for($i=1;$i<count($arrIcon2);$i++){
												if($arrIcon2[$i] > 0){
											?>
												<img src="../data/designImages/<?=$arrPicon[$arrIcon2[$i]]?>" align="absmiddle">
											<?}}?>
										<?}else{?>
											<span class="price old-price"><? if( !$_SESSION[USERID] && $admin_stat->nomember_old_price ) {?><?=number_format($row->old_price);?><font style='font-size:10pt;'>원</font><?} else if( $_SESSION[USERID] && $admin_stat->member_old_price ) {?><?=number_format($row->old_price);?> <font style='font-size:10pt;'>원</font><?}?></span>
											<br />
											<span class="price special-price"><? if( !$_SESSION[USERID] && $admin_stat->nomember_shop_price ) {?><?=number_format($row->shop_price);?><font style='font-size:10pt;'>원</font><?} else if( $_SESSION[USERID] && $admin_stat->member_shop_price ) {?><?=number_format($row->shop_price);?> <font style='font-size:10pt;'>원</font><?}?></span>
										<?}?>
									</div>
							</div><!--gallery_box-->
					</div>
				</div>
		   </li>
		   <?}?>
		</ul>
	</div>
	<span style="display:none; visibility:hidden" class="<?=$styletxt[3]?>"></span>
 </div>
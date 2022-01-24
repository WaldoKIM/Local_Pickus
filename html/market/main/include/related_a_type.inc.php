<div class="new_product">
	<div class="new-products">
	<div class="subitem-title1" style='display:inline-block;'><h2>관련상품</h2> <h1 style='color:#FF6A5F'>Related  product</h1></div>
	<!--이전다음 아이콘-->
	<div class="customNavigation">
		<a class="btn prev" title='이전'>&nbsp;</a>
		<a class="btn next" title='다음'>&nbsp;</a>
	</div>
	<div class='spacelin11'></div>
		<ul class="product-carousel" id="newproduct-carousel">
		<?
		if($goods_stat->subitemtarget==1){
			$result_item		= $db->select("cs_goods", "where part_idx=$goods_stat->part_idx order by rand() limit 10" );
		}else{
			if($goods_stat->itemlist){
				$arrTemp = explode(",", $goods_stat->itemlist);
				$orderBy = "order by case idx";
				foreach($arrTemp as $key=>$val) {
					$orderBy .= " when $val then $key ";
				}
				$orderBy .= "end";
				$result_item		= $db->select("cs_goods", "where idx IN(".$goods_stat->itemlist.") $orderBy" );
			}else{
				$result_item		= $db->select("cs_goods", "where idx < 0" );
			}
		}
		while( $row = mysqli_fetch_object($result_item)) {
			$goods_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$row->part_idx."&search_item=".$search_item);
			$ThumbEncode = $tools->encode("idx=".$row->idx."&table=cs_goods&img=images1&dire=goodsImages&w=230&h=230");
			$arrIcon = explode(",",",".$row->iconidx);
			$arrIcon2 = explode(",",",".$row->substimg);
		?>
		  <li class="item slider-item">
			<div class="product-block">
				<div class="product-block-inner">
					 <div class="best-label" style="background-color: #<?=$eventpart->corner_color?>;"><?=$eventpart->corner_name?></div>
						<div class='gallery-image'>
							<div class='gallery-image-box'>
								<a href="#" rel="product_zoom.php?goods_data=<?=$goods_data;?>" class='quick-view'><i class='  fa-search-plus fa-search-plus-box' title='미리보기'></i></a><a href="#" rel='dir.itemevent.php?type=1&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fa-shopping-cart fa-shopping-cart-box' title='장바구니담기'></i></a><a href="#" rel='dir.itemevent.php?type=2&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fa-credit-card fa-credit-card-box' title='바로구매'></i></a><a href="#" rel='dir.itemevent.php?type=3&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fa-gratipay fa-gratipay-box' title='관심상품'></i></a>
							</div>
							<a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>" title="#" class="product-image"><?if($row->resize==1){?><img src="../data/goodsImages/<?=$row->images1?>" alt="<?=$row->name?>"  class='gallery_box_img' style='margin-bottom:10px;'><?}else{?><img src="../data/goodsImages/<?=$row->images1?>" border="0"  alt="<?=$row->name?>"  class='gallery_box_img' style='margin-bottom:10px;'><?}?></a>
							<span class='oolimmobilemenuL' style='display:inline-block;padding:0 0 0;'><a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>" title="#" class='sens_body'>
							<?=$tools->strCut($row->name,45);?>
							</a>
							<?for($i=1;$i<count($arrIcon);$i++){
							if($arrIcon[$i] > 0){
							?><span class='gallery_content_icon'><img src="../data/designImages/<?=$arrPicon[$arrIcon[$i]]?>" align="absmiddle" class='noneoolim'></span>
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
									<span class="price old-price" id="old-price-38-new"><? if( !$_SESSION[USERID] && $admin_stat->nomember_old_price ) {?><?=number_format($row->old_price);?>원<?} else if( $_SESSION[USERID] && $admin_stat->member_old_price ) {?><?=number_format($row->old_price);?>원<?}?></span><br /><span class="price special-price" id="product-price-38-new"><? if( !$_SESSION[USERID] && $admin_stat->nomember_shop_price ) {?><?=number_format($row->shop_price);?>원<?} else if( $_SESSION[USERID] && $admin_stat->member_shop_price ) {?><?=number_format($row->shop_price);?>원<?}?></span>
								<?}?>
							</div>
						</div><!--gallery-image-->
					</div>
				</div>
		   </li>
		   <?}?>
		</ul>
	</div>
	<span style="display:none; visibility:hidden" class="newproduct_default_width"></span>
 </div>
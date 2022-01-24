<!--메인 추천상품 출력 시작-->
<div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
	
	<div class="subitem-title1">
		<h2>판매자의 다른 상품</h2> 
		<h1 style='display:none; color:#FF6A5F'>
		<?
		$seller_stat = $db->object("cs_member","where userid='$goods_stat->seller'");
		$seller_stat2 = $db->object("g5_member","where mb_id='$goods_stat->seller'");										
		?>
		판매자 : <?=mb_substr($seller_stat2->mb_name, 0, 1, 'utf-8');?>전문가님 <?//=$seller_stat->tel1;?></h1> 
		<p class="seller_market_go"><a class="seller_market_go" href="./seller_info.php?search=<?=$goods_stat->seller;?>" style="width:auto !important;"><?=mb_substr($seller_stat2->mb_name, 0, 1, 'utf-8');?> 전문가님의 다른 상품 > </a></p> 
	</div>
	<ul>
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
		$result_item		= $db->select("cs_goods", "where seller='$goods_stat->seller' order by rand() limit 10" );
		while( $row = mysqli_fetch_object($result_item)) {
			$goods_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$row->part_idx."&search_item=".$search_item);
			$ThumbEncode = $tools->encode("idx=".$row->idx."&table=cs_goods&img=images1&dire=goodsImages&w=260&h=260");
			$arrIcon = explode(",",",".$row->iconidx);
			$arrIcon2 = explode(",",",".$row->substimg);
		?>
		  <li class="item slider-item">
			<div class="product-block">
				<div class="product-block-inner">
						<div class='gallery-image'>
							<div style="display:none;" class='gallery-image-box'><a href="#" rel="product_zoom.php?goods_data=<?=$goods_data;?>" class='quick-view'><i class='  fa-search-plus fa-search-plus-box' title='미리보기'></i></a><a href="#" rel='dir.itemevent.php?type=1&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fa-shopping-cart fa-shopping-cart-box' title='장바구니담기'></i></a><a href="#" rel='dir.itemevent.php?type=2&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fa-credit-card fa-credit-card-box' title='바로구매'></i></a><a href="#" rel='dir.itemevent.php?type=3&goods_data=<?=$goods_data;?>' class='quick-view'><i class='fa-gratipay fa-gratipay-box' title='관심상품'></i></a></div>
							<a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>" title="#" class="product-image"><?if($row->resize==1){?><img src="../data/goodsImages/<?=$row->images1?>"  class='gallery_box_img' style='margin-bottom:10px;'><?}else{?><img src="../data/goodsImages/<?=$row->images1?>" border="0"  alt="<?=$row->name?>"  class='gallery_box_img' style='margin-bottom:10px;'><?}?></a>
							<span class='oolimmobilemenuL' style='display:inline-block;padding: 0px 9px;'><a href="product_view.php?part_idx=<?=$row->part_idx;?>&goods_data=<?=$goods_data;?>" class='sens_body'>
							<p class="product_list_name"><?=$tools->strCut($row->name,45);?></p>
							<p class="product_list_mdname"><?=$tools->strCut($row->content,20);?></p>
							</a>

							</span>
							<div class="price-box">
								<?if($row->subst==1){?>
								<?if($row->substtxt){?><?=$row->substtxt?><?}?>
								<?for($i=1;$i<count($arrIcon2);$i++){
									if($arrIcon2[$i] > 0){
								?><img src="../data/designImages/<?=$arrPicon[$arrIcon[$i]]?>" align="absmiddle">
								<?}}?>
								<?}else{?>
									<span style="display:none;" class="price old-price"><? if( !$_SESSION[USERID] && $admin_stat->nomember_old_price ) {?><?=number_format($row->old_price);?><font style='font-size:10pt;'>원</font><?} else if( $_SESSION[USERID] && $admin_stat->member_old_price ) {?><?=number_format($row->old_price);?> <font style='font-size:10pt;'>원</font><?}?></span>
									<span class="price special-price"><p class="product_list_price"><? if( !$_SESSION[USERID] && $admin_stat->nomember_shop_price ) {?><?=number_format($row->shop_price);?><font style='font-size:10pt;'>원</font><?} else if( $_SESSION[USERID] && $admin_stat->member_shop_price ) {?><?=number_format($row->shop_price);?> <font style='font-size:10pt;'>원</font><?}?></p></span>
								<?}?>
							</div>
							<?for($i=1;$i<count($arrIcon);$i++){
								if($arrIcon[$i] > 0){
							?><span class='gallery_content_icon'><img src="../data/designImages/<?=$arrPicon[$arrIcon[$i]]?>" align="absmiddle" class='noneoolim'></span>
							<?}}?>
						</div><!--gallery_box-->

					</div>
				</div>
		   </li>
		  <?}?>
	</ul>
</div>
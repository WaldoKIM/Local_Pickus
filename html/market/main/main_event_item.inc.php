<?
$eventpart = $db->object("cs_part_fixed", "where event_code=$main_position");
if($main_position==1){
	$styletxt = array("feature_product", "featured-products", "featured-carousel", "featured_default_width");
}
if($main_position==2){
	$styletxt = array("new_product", "new-products", "newproduct-carousel", "newproduct_default_width");
}
if($main_position==3){
	$styletxt = array("crosssell_product", "crosssell-products", "crosssell-carousel", "crosssell_default_width");
}
if($main_position==4){
	$styletxt = array("upsell_product", "upsell-products", "upsell-carousel", "upsell_default_width");
}
if($eventpart->part_display_check==1){
	if($eventpart->display_type==1){
		include('./include/mainitem_a_type.inc.php');
	}else{
		include('./include/mainitem_b_type.inc.php');
	}
	//echo "<div class='spaceline07'></div>";
}
?>
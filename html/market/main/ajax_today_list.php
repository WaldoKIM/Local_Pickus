<? include('../common.php');
$show_cookie_name = $_SESSION["VIEW_LIST"];
$show_arr = explode("&&", $_COOKIE[$show_cookie_name]);
$show_cnt = 6;
if($show_cnt > count($show_arr)-1){
	$view_cnt = count($show_arr)-1;
}else{
	$view_cnt = $show_cnt;
}
if($_COOKIE[$show_cookie_name]){
	for($i=0;$i<$view_cnt;$i++){
		$todaycnt++;
		$goods_info=$db->object("cs_goods", "where idx='$show_arr[$i]'");
		$quick_data = $tools->encode("idx=".$goods_info->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$goods_info->part_idx."&search_item=".$search_item);
		$ThumbEncode = $tools->encode("idx=".$goods_info->idx."&table=cs_goods&img=images1&dire=goodsImages&w=60&h=60");
	?>
<li style="height:100px">
	<a href='product_view.php?part_idx=<?=$goods_info->part_idx;?>&goods_data=<?=$quick_data;?>'><img src="../data/goodsImages/<?=$goods_info->images1?>" style="width:60px;" border='0'></a>
	<p><?=$tools->strCut($goods_info->name,12);?></p>
</li>
<?}}?>		
<?if(!$todaycnt){?>
<li>
</li>
<?}?>

<!--고정메뉴-->
<?
$part1_result = $db->select( "cs_part_fixed", "where part_index=1 and part_display_check=1 order by part_ranking asc");
// 주메뉴
while( $part1_row = @mysqli_fetch_object($part1_result) ) {
$depth2_cnt = $db->cnt("cs_part_fixed", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code'");
// 카테고리 이미지 출력
if( $part1_row->list_display_check == 1 ) {	$P1_images = "../data/designImages/".$part1_row->list_display_images1; }
// 카테고리 목록이미지 출력(마우스 롤오버)
if( $part1_row->list_display_check == 2 ) {	$P1_images = "../data/designImages/".$part1_row->list_display_images1; $P2_images = "../data/designImages/".$part1_row->list_display_images2; }
if(!$depth2_cnt){
?>
<li>
	<a href="<?=$part1_row->urllink;?>" class='sf-menu_link'><?=$part1_row->part_name;?></a>
</li>
<?}else{?>
<li>
<a href="<?=$part1_row->urllink;?>" class="sf-menu_link"><?=$part1_row->part_name;?></a>
<ul class="sub-menu">
	<?
	//중분류 정보
	$part2_result = $db->select("cs_part_fixed", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code' order by part_ranking asc");
	while($part2_row = mysqli_fetch_object($part2_result)){?>
		<li><a href="<?=$part2_row->urllink;?>"><?=$part2_row->part_name;?></a></li>
	<?}?>
</ul>
</li>
<?}}?>
<!--고정메뉴-->
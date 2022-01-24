<?
include('../common.php');
include($ROOT_DIR."/lib/page_class.php");
//게시판에 필요한 값들
if($_GET[start] )					{ $start = $_GET[start]; }
if($_GET[end] )				{ $end = $_GET[end]; }

$start = 0;
$den = 20;
$totalcnt = $db->cnt( "cs_part", "where part_index=1 and part_display_check=1");
$part1_result = $db->select( "cs_part", "where part_index=1 and part_display_check=1 order by part_ranking asc limit $start, $end");
// 주메뉴
while( $part1_row = @mysqli_fetch_object($part1_result) ) {
$depth2_cnt = $db->cnt("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code'");
?>
<li>
	<a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>"><?=$part1_row->part_name;?></a>
		<?if($depth2_cnt){?>
		<ul style='float: right; width:180px; margin-left:200px;'>
		<?
		//중분류 정보
		$part2_result = $db->select("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code' order by part_ranking asc");
		while($part2_row = mysqli_fetch_object($part2_result)){
			$depth3_cnt = $db->cnt("cs_part", "where part_index=3 and part_display_check=1 and part1_code='$part1_row->part1_code' and part2_code='$part2_row->part2_code'");
			if(!$depth3_cnt){
		?>
				<li><a href="<?if($part2_row->url){?><?=$part2_row->url?><?}else{?>product_list.php?part_idx=<?=$part2_row->idx;?><?}?>"><?=$part2_row->part_name;?></a>
				</li>
			<?}else{?>
				<li><a href="<?if($part2_row->url){?><?=$part2_row->url?><?}else{?>product_list.php?part_idx=<?=$part2_row->idx;?><?}?>"><?=$part2_row->part_name;?></a>
					<ul class="nav-dropdown menu" style="margin-top:0.45em;">
						<?
						//세세분류 정보
						$part3_result = $db->select("cs_part", "where part_index=3 and part_display_check=1 and part1_code='$part1_row->part1_code' and part2_code='$part2_row->part2_code' order by part_ranking asc");
						while($part3_row = mysqli_fetch_object($part3_result)){
						?>
						<li class="menu-item"><a href="<?if($part3_row->url){?><?=$part3_row->url?><?}else{?>product_list.php?part_idx=<?=$part3_row->idx;?><?}?>" class="menu-link2"><?=$part3_row->part_name;?></a></li>
						<?}?>
					</ul>
				</li>			
			<?}?>
		<?}?>
		</ul>
	<?}?>
</li>
	<?/*
	<?if($_GET[part_idx] == $part1_row->idx){?>
		<div style="background-color:#EFEFEF; padding-left:10px; width:210px;line-height:30px;">
		<?
		$part2_result = $db->select("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code' order by part_ranking asc");
		while($part2_row = mysqli_fetch_object($part2_result)){
		?>			
			<a href="<?if($part2_row->url){?><?=$part2_row->url?><?}else{?>product_list.php?part_idx=<?=$part2_row->idx;?><?}?>"><?=$part2_row->part_name;?></a>
		<?}?>
		</div>
	<?}?>
	*/?>
<?}?>


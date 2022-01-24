<div id="blandlayer-01" class="tiny-layer-hide">
	<div class='layer-item-boxbold'>
		<table width="100%" style='background:#ffffff;'>
			<tr>
			<?
			$new_cnt = 0; $new_tr = 0; $td_width = 5 ; // 가로리스트 수
			$result_area = $db->result("select distinct company from cs_goods where display=1 order by company asc");
			while($row_area = @mysqli_fetch_object( $result_area )) {
				$new_cnt++;
			?>
				<td class='tabletd_all' width="<? $width_td = 100/$td_width; echo($width_td."%");?>" style='text-align:center;'>
					<a href="brand_list.php?search_order=<?=$row_area->company;?>"><?=$row_area->company;?></a>
				</td>
				<? if (($new_cnt % $td_width) == 0) { $new_tr++;?>
			</tr>
			<tr>
				<?}}?>
				<? $new_td = $td_width - ($new_cnt%$td_width);	for($i=0; $i<$new_td; $i++) { if( $new_cnt != $td_width * $new_tr) {?>
				<!-- 반복 생성 -->
				<td class='tabletd_all' style='text-align:center;' width="<? $width_td = 100/$td_width; echo($width_td."%");?>" align="center">&nbsp;</td>
				<?}}?>
			</tr>
		</table>
	</div>
</div>
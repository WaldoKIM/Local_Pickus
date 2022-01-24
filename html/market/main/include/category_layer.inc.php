<div id="blandlayer-02" class="tiny-layer-hide">
	<div class='layer-item-boxbold'>
		<table width="100%" style='background:#ffffff;text-align:center;'>
				<?
				$part1_result = $db->select( "cs_part", "where part_index=1 and part_display_check=1 order by part_ranking asc");
				while( $part1_row = @mysqli_fetch_object($part1_result) ) {
					$sub_cnt2 .= $db->cnt("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code'");
				}
				$part1_result = $db->select( "cs_part", "where part_index=1 and part_display_check=1 order by part_ranking asc");
				// 주메뉴
				if($sub_cnt2==0){
				echo "<tr>";
				$new_cnt = 0;
				$new_tr = 0;
				$td_width = 6;
				while( $part1_row = @mysqli_fetch_object($part1_result) ) {
					$itemcnt = $db->cnt("cs_goods", "where part_idx=$part1_row->idx and display=1");
				$new_cnt++;
				?>
					<td class="category_list_1th_in" width="<? $width_td = 100/$td_width; echo($width_td."%");?>"><a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>"><?=$part1_row->part_name;?></a></td>
				<? if (($new_cnt % $td_width) == 0) { $new_tr++;?>
				</tr>
				<tr>
				<?}}?>
				<? $new_td = $td_width - ($new_cnt%$td_width);	for($i=0; $i<$new_td; $i++) { if( $new_cnt != $td_width * $new_tr) {?>
					<!-- 반복 생성 -->
					<td width="<? $width_td = 100/$td_width; echo($width_td."%");?>" class="category_list_1th_in">
						&nbsp;
					</td>
				<?}}
				}else{
				while( $part1_row = @mysqli_fetch_object($part1_result) ) {
				//1차/2차 메뉴
				$part2_result = $db->select( "cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code' order by part_ranking asc");
				$sub_cnt2 = $db->cnt("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code'");
				$depth3_cnt2 = $db->cnt("cs_part", "where part_index=3 and part_display_check=1 and part1_code='$part1_row->part1_code'");
				$new1_cnt = 0;
				$new1_tr = 0;
				$td1_width = 5;
				if(!$depth3_cnt2){
				$itemcnt = $db->cnt("cs_goods", "where part_idx=$part1_row->idx and display=1");
				?>
				<tr>
					<td class='category_list_1th' width="15%"><a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>"><?=$part1_row->part_name;?> <?if($itemcnt){?>(<font color='FC6E51'><?=$itemcnt?></font>)<?}?></a><?if($sub_cnt2){?><?}?></td>
					<td class='category_list_1th_in' colspan="2">
						<?if($sub_cnt2){?>
						<table width="100%">
							<tr>
								<?
								while( $part2_row = @mysqli_fetch_object($part2_result) ) {
								$new1_cnt++;
								$itemcnt = $db->cnt("cs_goods", "where part_idx=$part2_row->idx and display=1");
								?>
								<td height="20" class='category_list_2th_in1' width="<?echo(100/$td1_width."%");?>"><a href="<?if($part2_row->url){?><?=$part2_row->url?><?}else{?>product_list.php?part_idx=<?=$part2_row->idx;?><?}?>"><?=$part2_row->part_name;?> <?if($itemcnt){?>(<font color='FC6E51'><?=$itemcnt?></font>)<?}?></a></td>
								<? if (($new1_cnt % $td1_width) == 0) { $new1_tr++;?>
							</tr>
							<tr>
								<?}}?>
								<? $new1_td = $td1_width - ($new1_cnt%$td1_width);	for($i=0; $i<$new1_td; $i++) { if( $new1_cnt != $td1_width * $new1_tr) {?>
								<!-- 반복 생성 -->
								<td width="<? $width1_td = 100/$td1_width; echo($width1_td."%");?>" class='category_list_3th_in' align="center">
									&nbsp;
								</td>
								<?}}?>
							</tr>
						</table>
						<?}else{?>
						<table width="100%">
							<tr>
								<?for($i=0; $i<$td1_width; $i++) { ?>
								<!-- 반복 생성 -->
								<td class='category_list_3th_in_space' width="<?echo(100/$td1_width."%");?>" align="center">
									&nbsp;
								</td>
								<?}?>
							</tr>
						</table>
						<?}?>
					</td>
				</tr>
				<?
				}
				else{
				while( $part2_row = @mysqli_fetch_object($part2_result) ) {
					$rowcnt++;
				?>
				<tr>
					<?if($rowcnt==1){?>
					<td class='category_list_1th' width="<?echo(100/$td_width."%");?>" rowspan="<?=$sub_cnt2?>"><a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>"><?=$part1_row->part_name;?></a></td>
					<?}?>
					<td class='category_list_1th_in' width="<?echo(((100/$td1_width)-3)."%");?>"><a href="<?if($part2_row->url){?><?=$part2_row->url?><?}else{?>product_list.php?part_idx=<?=$part2_row->idx;?><?}?>"><?=$part2_row->part_name;?></a></td>
					<td class='category_list_1th_in'>
						<!--3차메뉴시작-->
						<?
						$part3_cnt = $db->cnt( "cs_part", "where part_index=3 and part_display_check=1 and part1_code='$part1_row->part1_code' and part2_code='$part2_row->part2_code'");
						if($part3_cnt){?>
						<table width="100%">
							<tr>
								<?
								//3차 서브메뉴
								$part3_result = $db->select( "cs_part", "where part_index=3 and part_display_check=1 and part1_code='$part1_row->part1_code' and part2_code='$part2_row->part2_code' order by part_ranking asc");
								$new2_cnt = 0;
								$new2_tr = 0;
								$td2_width = 4;
								while( $part3_row = @mysqli_fetch_object($part3_result) ) {
								$new2_cnt++;
								$itemcnt = $db->cnt("cs_goods", "where part_idx=$part3_row->idx and display=1");
								?>
								<td class='category_list_3th_in' width="<?echo(100/$td2_width."%");?>"><a href="<?if($part3_row->url){?><?=$part3_row->url?><?}else{?>product_list.php?part_idx=<?=$part3_row->idx;?><?}?>"><?=$part3_row->part_name;?> <?if($itemcnt){?>(<font color='FC6E51'><?=$itemcnt?></font>)<?}?></a></td>
								<? if (($new2_cnt % $td2_width) == 0) { $new2_tr++;?>
							</tr>
							<tr>
								<?}}?>
								<? $new2_td = $td2_width - ($new2_cnt%$td2_width);	for($i=0; $i<$new2_td; $i++) { if( $new2_cnt != $td2_width * $new2_tr) {?>
								<!-- 반복 생성 -->
								<td class='category_list_3th_in_space2' width="<? $width2_td = 100/$td2_width; echo($width2_td."%");?>" align="center">
									&nbsp;
								</td>
								<?}}?>
							</tr>
						</table>
						<?}else{?>
						<table width="100%">
							<tr>
								<?for($i=0; $i<$td2_width; $i++) { ?>
								<!-- 반복 생성 -->
								<td class='category_list_3th_in_space' width="<?echo(100/$td2_width."%");?>" align="center">
									&nbsp;
								</td>
								<?}?>
							</tr>
						</table>
						<?}?>
					</td>
				</tr>
				<?} $rowcnt=0; ?>
				<?}?>
				<!--2차메뉴끝-->
				<?}?>
				<?}?>
		</table>
	</div>
</div>
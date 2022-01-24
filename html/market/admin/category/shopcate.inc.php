
<table width="100%">
	<tr> 
		<td>

			<div class="oolimbox-wrapper">
				<div class="oolimbox-col_2dan-1">
					<span class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0"><font color='3AB231'>쇼핑 카테고리 목록</font> &nbsp; <?if($u){?><a href="menusort.proc.php?menusort=<?=$u?>" class="menusmall_btn3">위로</a><?}?> <?if($d){?><a href="menusort.proc.php?menusort=<?=$d?>" class="menusmall_btn4">아래</a><?}?></span>
				</div>
				<div class="oolimbox-col_2dan-2" style='text-align:right;'>
					제품리스트 정렬(전체상품정렬형태) : 
					<select name="item_all_sort" onchange="location.href='itemsort.proc.php?item_all_sort='+this.value">
						<option value="1" <? if(1==$design_stat->item_all_sort) echo('selected');?>>이름순</option>
						<option value="2" <? if(2==$design_stat->item_all_sort) echo('selected');?>>가격낮은순</option>
						<option value="3" <? if(3==$design_stat->item_all_sort) echo('selected');?>>가격높은순</option>
						<option value="4" <? if(4==$design_stat->item_all_sort) echo('selected');?>>등록순</option>
						<option value="5" <? if(5==$design_stat->item_all_sort) echo('selected');?>>인기순</option>
					</select>
				</div>
			</div>

			<table width="100%">
				<tr> 
					<td style='float:right;height:50px;padding-top:10px;'><a href="category_add1.php" class='oolimbtn-botton1'>1차 카테고리 생성</a></td>
				</tr>
			</table>

			<table width="100%" class="table_all_B">
				<tr align="center" bgcolor="E4E7EF"> 
					<td width="20%" class='contenM tabletd_all'>카테고리</td>
					<td width="20%" class='contenM tabletd_all noneoolim'>카테고리 URL</td>
					<td width="7%" class='contenM tabletd_all'>카테고리 사용 유무</td>
					<td width="8%" class='contenM tabletd_all'>관리</td>
					<td width="17%" class='contenM tabletd_all'>카테고리등록</td>
				</tr>
				<?
				// 1차 카테고리 분류
				$part1_result = $db->select( "cs_part", "where part_index=1 order by part_ranking asc");
				while( $part1_row = @mysqli_fetch_object($part1_result) ) {
					// 카테고리 이미지 출력
					if( $part1_row->list_display_check == 1 ) {	$P1_images = "../../data/designImages/".$part1_row->list_display_images1; }
					// 카테고리 목록이미지 출력(마우스 롤오버)
					if( $part1_row->list_display_check == 2 ) {	$P1_images = "../../data/designImages/".$part1_row->list_display_images1; $P2_images = "../../data/designImages/".$part1_row->list_display_images2; }
					// 카테고리 목록 출력 유무
					if( $part1_row->part_display_check )  {	$part1_display_check_images = "<span class='btn_guide4' style='text-align:center;'>사용</span>"; } else { $part1_display_check_images = "<span class='btn_guide5' style='text-align:center;'>미사용</span>"; }
					// 2차 카테고리 등록이미지 출력
					if( $part1_row->part_low_check )  {	$part2_register_images = "<img src='../images/bt_category_add2.gif' border='0' alt='2차카테고리등록' align='absmiddle'>"; } else { $part2_register_images = ""; }
					// 등록된 상품수
					if($part1_total_goods=$db->cnt("cs_goods", "where part_idx='$part1_row->idx'")) { $part1_total_goods="(<font color='#E84C4B'>".$part1_total_goods."</font>)";} else { $part1_total_goods="";}
				?>		
				<tr  id='calendar_list_tableTD_on'>
					<td class='tabletd_all tabletd_smallT'><span class='item_category_icon1'>1차</span><?=$part1_row->part_name;?> <?=$part1_total_goods;?></td>
					<td class='tabletd_all tabletd_small noneoolim' align="center"><a href="http://<?=$admin_stat->shop_url?>/product_list.php?part_idx=<?=$part1_row->idx?>" target="_new">product_list.php?part_idx=<?=$part1_row->idx?></a> </td>
					<td class='tabletd_all tabletd_Lmall' style='text-align:center;'><?=$part1_display_check_images;?></td>
					<td class='tabletd_all tabletd_Lmall' align="center"><a href="javascript:partEdit( 1, '<?=$part1_row->idx;?>' );" class="menusmall_btn3">수정</a>&nbsp;<a href="javascript:partDel( 1,'<?=$part1_row->idx;?>' );" class="menusmall_btn4">삭제</a></td>
					<td class='tabletd_all tabletd_Lmall' align="center"><a href="javascript:partReg2('<?=$part1_row->idx;?>');" class='category_bt2'>2차카테고리등록<a/></td>
				</tr>
					<?
					// 2차 카테고리 분류
					$part2_result = $db->select( "cs_part", "where part_index=2 and part1_code='$part1_row->part1_code' order by part_ranking asc");
					while( $part2_row = @mysqli_fetch_object($part2_result) ) {
						// 카테고리 목록 출력 유무
						if( $part2_row->part_display_check )  {	$part2_display_check_images = "<span class='btn_guide4'>사용</span>"; } else { $part2_display_check_images = "<span class='btn_guide5'>미사용</span>"; }
						// 2차 카테고리 등록이미지 출력
						if( $part2_row->part_low_check )  {	$part3_register_images = "<img src='../images/bt_category_add3.gif' border='0' alt='3차카테고리등록' align='absmiddle'>"; } else { $part3_register_images = ""; }
						// 등록된 상품수
						if( $part2_total_goods=$db->cnt("cs_goods", "where part_idx='$part2_row->idx'")) { $part2_total_goods="(<font color='#E84C4B'>".$part2_total_goods."</font>)";} else { $part2_total_goods="";}
					?>		
					<tr  id='calendar_list_tableTD_on'> 
						<td class='tabletd_all tabletd_smallT'><span class='item_category_icon2'>2차</span><?=$part2_row->part_name;?> <?= $part2_total_goods;?></td>
						<td class='tabletd_all tabletd_smallT noneoolim' align="center"><a href="http://<?=$admin_stat->shop_url?>/product_list.php?part_idx=<?=$part2_row->idx?>" target="_new">product_list.php?part_idx=<?=$part2_row->idx?></a></td>
						<td class='tabletd_all tabletd_Lmall' style='text-align:center;'><?=$part2_display_check_images;?></td>
						<td class='tabletd_all tabletd_Lmall' align="center"><a href="javascript:partEdit( 2, '<?=$part2_row->idx;?>' );" class="menusmall_btn3">수정</a>&nbsp;<a href="javascript:partDel( 2, '<?=$part2_row->idx;?>' );" class="menusmall_btn4">삭제</a></td>
						<td class='tabletd_all tabletd_Lmall' align="center"><a href="javascript:partReg3('<?=$part2_row->idx;?>');" class='category_bt3'>3차카테고리등록<a/></td>
					</tr>
						<?
						$part3_result = $db->select( "cs_part", "where part_index=3 and part2_code='$part2_row->part2_code' and part1_code='$part2_row->part1_code'  order by part_ranking asc");
						while( $part3_row = @mysqli_fetch_object($part3_result) ) {
							// 카테고리 목록 출력 유무
							if( $part3_row->part_display_check )  {	$part3_display_check_images = "<span class='btn_guide4'>사용</span>"; } else { $part3_display_check_images = "<span class='btn_guide5'>미사용</span>"; }
							// 등록된 상품수
							if( $part3_total_goods=$db->cnt("cs_goods", "where part_idx='$part3_row->idx'")) { $part3_total_goods="(<font color='#E84C4B'>".$part3_total_goods."</font>)";} else { $part3_total_goods="";}
						?>		
						<tr  id='calendar_list_tableTD_on'>
							<td class='tabletd_all tabletd_smallT'><span class='item_category_icon3'>3차</span><?=$part3_row->part_name;?> <?= $part3_total_goods;?></td>
							<td class='tabletd_all tabletd_smallT noneoolim' align="center"><a href="http://<?=$admin_stat->shop_url?>/product_list.php?part_idx=<?=$part3_row->idx?>" target="_new">product_list.php?part_idx=<?=$part3_row->idx?></a></td>
							<td class='tabletd_all tabletd_Lmall' style='text-align:center;'><?=$part3_display_check_images;?></td>
							<td class='tabletd_all tabletd_Lmall' align="center"><a href="javascript:partEdit( 3, '<?=$part3_row->idx;?>' );" class="menusmall_btn3">수정</a>&nbsp;<a href="javascript:partDel( 3, '<?=$part3_row->idx;?>' );" class="menusmall_btn4">삭제</a></td>
							<td class='tabletd_all tabletd_Lmall' align="center"></td>
						</tr>
						<? 
						} // 3차 카테고리
					} // 2차 카테고리 
					$P1_images = ""; $P2_images = ""; 
				} // 1차 카테고리 
				?>
				
				<? if( !$db->cnt("cs_part", "")) {?>
				<tr bgColor="white">
					<td height="100" colspan="5" align="center"> 등록된 카테고리가 없습니다.</td>
				</tr>
				<?}?>
			</table><br>
		</td>
	</tr>
	<tr>
		<td height='30'></td>
	</tr>
	<tr>
		<td bgcolor='#dddddd' height='1'></td>
	</tr>
	<tr>
		<td height='30'></td>
	</tr>
</table>

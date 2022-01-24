<? include('../header.php');?>

<script language="JavaScript">
<!--
// 카테고리 등록
function partReg2( data ) {	 location.href='category_add2.php?idx='+data; }
function partReg3( data ) { location.href='category_add3.php?idx='+data; }

// 카테고리 수정
function partEdit( index, data ) {
    var choose = confirm( index+'차 카테고리를 수정 하시겠습니까?');
	if(choose) {	location.href='category_check.php?idx='+data+'&part_index='+index; }
	else { return; }
}

// 카테고리 삭제
function partDel( index, data ) {
    var choose = confirm( index+'차 카테고리를 삭제 하시겠습니까?');
	if(choose) {	location.href='category_del_ok.php?idx='+data; }
	else { return; }
}

function positionchange(idx, value){
	dynamic.location.href = "dir.select.php?idx="+idx+"&value="+value;
}

//-->
</script>
<iframe src='' name='dynamic' style="display:none"></iframe>



<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/category_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">

		<table   width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">카테고리등록 및 목록</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#dddddd"></td>
			</tr>
			<tr>
				<td height="25" bgColor="white"></td>
			</tr>
			<tr>
				<td>
				<!--도움말-->
					<table width="100%" class='tipbox noneoolim'>
						<tr>
							<td bgcolor="#E9F2F8">
								<table width="100%">
									<tr>
										<td height="20">
											<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
										</td>
									</tr>
									<tr>
										<td>제품리스트 정렬(전체상품정렬형태) 설정은 특정카테고리가 지정되지않은 상태로, 전체 상품 정렬을 설정하실 수 있습니다.</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				<!--도움말--->
				</td>
			</tr>
			<tr>
				<td height="25" bgColor="white"></td>
			</tr>
			<tr>
				<td class="padding_5">
					<table  width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
								<table width="100%">
									<tr> 
										<td>

											<div class="oolimbox-wrapper">
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
								<!--콘텐츠출력-->
							</td>
						</tr>
						<tr>
							<td height="30"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</article>
	
</div>



<? include('../footer.php'); ?>

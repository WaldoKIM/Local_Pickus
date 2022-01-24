<? include('../header.php');?>

<iframe src='' name='dynamic' style="display:none"></iframe>


<script language="JavaScript">
	<!--
	// 수정
	// 순위변경
	function ranking() {
		var form=document.rankform;
		form.submit();
	}
	//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/category_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">

		<table   width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">스패셜상품 카테고리 목록</td>
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
									<tr CLASS='noneoolim'>
										<td><img src="../images/category_list_sp1_title.png" border="0"></td>
									</tr>
									<tr>
										<td style="padding-top:10px">위의 샘플예제 처럼 메인상품 및 서브페이지 상품 리스트에 특정 상품에 모서리(대각선)효과를 등록 및 관리를 할수 있으며, 상단 주메뉴에 스패셜 메뉴항목 노출여부등을 관리 할 수 있습니다.</td>
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

							<table width="100%">
								<tr> 
									<td>
										<table width="100%" class="table_all_A">
											<form name="rankform" method="POST" action="specialcate_ranking.php">
											<tr align="center" bgcolor="E4E7EF"> 
												<td width="30%" class='contenM tabletd_all'>카테고리</td>
												<td class='contenM tabletd_all noneoolim'>카테고리 URL</td>
												<td width="20%" class='contenM tabletd_all'>카테고리 사용 유무</td>
												<td width="20%" class='contenM tabletd_all'>관리</td>
											</tr>
											<?
											// 1차 카테고리 분류
											$part1_result = $db->select( "cs_part_fixed", "where part_index=1 order by part_ranking asc");
											while( $part1_row = @mysqli_fetch_object($part1_result) ) {
												// 카테고리 목록 출력 유무
												if( $part1_row->part_display_check )  {	$part1_display_check_images = "<span class='btn_guide4' style='text-align:center;'>사용</span>"; } else { $part1_display_check_images = "<span class='btn_guide5' style='text-align:center;'>미사용</span>"; }
											?>
											<input type="hidden" name="idx[]" value="<?=$part1_row->idx;?>">
											<tr id='calendar_list_tableTD_on'>
												<td class='tabletd_all tabletd_smallT'><input type="text" name="part_ranking[]" value="<?=$part1_row->part_ranking;?>" size="3" class="formText"> <?=$part1_row->part_name;?></td>
												<td class='tabletd_all tabletd_small noneoolim' align="center"><?if($part1_row->idx==1){?><a href="http://<?=$admin_stat->shop_url?>/brand_list.php" target="_new">brand_list.php</a><?}else{?><a href="http://<?=$admin_stat->shop_url?>/special_list.php?position=<?=$part1_row->event_code?>" target="_new">special_list.php?position=<?=$part1_row->event_code?></a><?}?></td>
												<td class='tabletd_all tabletd_Lmall' style='text-align:center;'><?=$part1_display_check_images;?></td>
												<td class='tabletd_all tabletd_Lmall' align="center"><a href="fixed_edit1.php?idx=<?=$part1_row->idx;?>" class="menusmall_btn3">수정</a></td>
											</tr>
											<?
											} // 1차 카테고리 
											?>
											</form>
										</table>
										<a href="javascript:ranking()" class="searchC">순위변경</a>
										<br>
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

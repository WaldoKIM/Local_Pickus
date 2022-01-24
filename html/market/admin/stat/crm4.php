<? include('../header.php');?>
<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/stat_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">

		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">쇼핑몰통계</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#dddddd"></td>
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
									<table width="100%" border="0" align="center">
										<tr> 
											<td height="150" align="center" valign="top" bgcolor="#FFFFFF">
											<table width="100%">
													<tr>
													<td>
														<table width="100%">
															<tr>
																<td height="25">
																<table>
																	<tr>
																		<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">지역별 매출통계</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td height="20">
																		<!--도움말-->
																			<table width="100%" class='tipbox'>
																				<tr>
																					<td bgcolor="#E9F2F8">
																						<table width="100%">
																							<tr>
																								<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																							</tr>
																							<tr>
																								<td>전국의 지역별(시,도)로 매출현황이 출력됩니다.</td>
																							</tr>
																						</table>
																					</td>
																				</tr>
																			</table>
																		<!--//도움말-->
																</td>
															</tr>
															<tr>
																<td height="5">
																</td>
															</tr>
														</table>
													</td>
													</tr>
												</table> 
												<table width="100%" class="table_all">
													<tr bgcolor="E4E7EF"> 
														<td height="35" class='contenM tabletd_all'>지역</td>
														<td class='contenM tabletd_all'>판매량</td>
														<td class='contenM tabletd_all'>판매금액</td>
														<td width="300" class='contenM tabletd_all noneoolimmoL'>그래프(가격대비)</td>
													</tr>
													<?
													$arrArea=Array("서울","부산","대구","인천","광주","대전","울산","경기","강원","충북","충남","경북","경남","전북","전남","제주");
													$strArrArea=Array("서 울","부 산","대 구","인 천","광 주","대 전","울 산","경 기","강 원","충 북","충 남","경 북","경 남","전 북","전 남","제 주");
													$total_trade_price=$db->sum("cs_trade", "where trade_stat=4", "trade_price");
													$total_trade_cnt=0;
													for($i=0;$i<count($arrArea);$i++) {
														$trade_cnt=0;
														$trade_price=0;
														$result=$db->result("select trade_price from cs_trade where trade_stat=4 and deliv_add1 like '$arrArea[$i]%'");
														while($area_row=@mysqli_fetch_array($result)) {
															$trade_cnt++;
															$trade_price+=$area_row[0];
														}
														$total_trade_cnt+=$trade_cnt;
														if($total_trade_price==0) { $wid=2;	} else { $wid=abs($trade_price/$total_trade_price)*400; if($wid==0) $wid=0;}
														
													?>
													<tr id='calendar_list_tableTD_on'>
														<td height="25" class='sensO tabletd_all'><b><?=$strArrArea[$i];?></b></td>
														<td class='sensO tabletd_all'><?=number_format($trade_cnt);?> 건</td>
														<td class='sensO tabletd_all'><?=number_format($trade_price);?> 원</td>
														<td width="300" class='tabletd_small tabletd_all noneoolimmoL'><img src="../images/graph1.gif" style="height:22;width:<?=$wid;?>"></td>
													</tr>
													<?
													}
													?>
													<tr bgcolor="#f5f5f5">
														<td height="30" colspan="4" class='sensO tabletd_all'><b>총 : <font size="3" color="#FF0000"><?=number_format($total_trade_cnt)?></font> 건에  &nbsp;합 계 : <font size="3" color="#FF0000"><?=number_format($total_trade_price)?></font> 원입니다.</b></td>
													</tr>
												</table>
												<table width="100%" height="55">
													<tr> 
														<td height="25" style='text-align:center'><a href="crm4_download.php" class='search_bbs1'>액셀판일 다운로드 (*.CSV)</a></td>
													</tr>
												</table>
											</td>
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

<? include('../header.php');
	include($ROOT_DIR."/lib/page_class.php");
	
	//$_GET=&$HTTP_GET_VARS;
	
	$mv_data	= $_GET[bbs_data];
	$bbs_data	= $tools->decode( $_GET[bbs_data] );
	if( $_GET[idx] )					{ $idx = $_GET[idx]; }											else { $idx = $bbs_data[idx]; }
	if( $_GET[date] )					{ $date = $_GET[date]; }									else { $date = $bbs_data[date]; }
	if( $_GET[listNo] )				{ $listNo = $_GET[listNo]; }									else { $listNo = $bbs_data[listNo]; }
	if( $_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $bbs_data[startPage]; }
	
?>
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
																			<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">상품별매출통계</td>
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
																							<td>판매금액이 높은 상품순으로 출력됩니다.</td>
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
													<td height="35" class='contenM tabletd_all noneoolimmoL'>
														No
													</td>
													<td width="30%" height="25" class='contenM tabletd_all'>
														제품명
													</td>
													<td height="25" class='contenM tabletd_all noneoolimmoL'>
														제품번호
													</td>
													<td height="25" class='contenM tabletd_all'>
														판매가격
													</td>
													<td height="25" class='contenM tabletd_all'>
														판매수량
													</td>
													<td height="25" class='contenM tabletd_all'>
														판매금액
													</td>
													<td height="25" class='contenM tabletd_all noneoolimmoL'>
														그래프(%)
													</td>
												</tr>
												<?
													// 리스트갯수
													$listScale			=	20;
													// 페이지 갯수
													$pageScale		=	5;
													// 검색
													// 스타트 페이지
													if( !$startPage ) { $startPage = 0; }
													// 토탈페이지
													$totalPage = floor($startPage / ($listScale * $pageScale));
													// 검색
													$totalList=0;
													$cntResut	= $db->result( "select (sum(goods_cnt)*goods_price), goods_price,  sum(goods_cnt), goods_name, goods_code from cs_trade_goods inner join cs_trade USING(trade_code) where cs_trade.trade_stat=4 group by goods_code order by 1 desc" );
													while( $row = @mysqli_fetch_array($cntResut)) {
														$totalList++;
													}
													
													$total_price = $db->sum("cs_trade_goods inner join cs_trade USING(trade_code)", "where cs_trade.trade_stat=4", "(cs_trade_goods.goods_price*cs_trade_goods.goods_cnt)");
													$result		    = $db->result( "select (sum(goods_cnt)*goods_price), goods_price,  sum(goods_cnt), goods_name, goods_code from cs_trade_goods inner join cs_trade USING(trade_code) where cs_trade.trade_stat=4 group by goods_code order by 1 desc LIMIT $startPage, $listScale" );
													// 페이지넘버
													if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
													
													while( $row = @mysqli_fetch_array($result)) {
														$percent = intval(($row[0] / $total_price) * 10000 ) / 100;
													?>
												<tr id='calendar_list_tableTD_on'>
													<td class='sensO tabletd_all noneoolimmoL'>
														<?=++$listNo;?>
													</td>
													<td width="30%" class='sensO tabletd_all'>
														<?=$tools->strHtmlNo($row[3]);?>
													</td>
													<td class='sensO tabletd_all noneoolimmoL'>
														<?=$tools->strHtmlNo($row[4]);?>
													</td>
													<td class='sensO tabletd_all'>
														<?=number_format($row[1]);?>
													</td>
													<td class='sensO tabletd_all'>
														<?=number_format($row[2]);?>
													</td>
													<td class='sensO tabletd_all'>
														<?=number_format($row[0]);?>
													</td>
													<td height="25" class='tabletd_all tabletd_small noneoolimmoL'>
														<table width="80" height="17" class="menupurple">
															<tr>
																<td width="<?=$percent;?>" background="../images/graph.gif">
																</td>
																<td align="center">
																	&nbsp;<?=round($percent);?>% 
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<?
												}
												?>
											</table>
											<table width="90%">
												<tr>
													<td height="50" style='text-align:center'>
														<? $page->logList($totalPage, $totalList, $listScale, $pageScale, $startPage, "", "",  "", "", $date, $year, $mon, $day );?>
													</td>
												</tr>
											</table>
											<table width="100%" height="55">
												<tr>
													<td height="25" style='text-align:center'>
														<a href="crm1_download.php" class='search_bbs1'>액셀판일 다운로드 (*.CSV)</a>
													</td>
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

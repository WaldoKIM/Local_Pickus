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
																			<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">우수고객</td>
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
																							<td>회원들의 구매순위를 나타냅니다. 각 회원의 매출금액과 접속수, 포인트현황 등을 나타냅니다.</td>
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
													<td height="25" class='contenM tabletd_all'>
														회원아이디
													</td>
													<td height="25" class='contenM tabletd_all'>
														이름
													</td>
													<td height="25" class='contenM tabletd_all'>
														구매횟수
													</td>
													<td height="25" class='contenM tabletd_all'>
														구매금액
													</td>
													<td height="25" class='contenM tabletd_all noneoolimmoL'>
														사용포인트
													</td>
													<td height="25" class='contenM tabletd_all noneoolimmoL'>
														적립포인트
													</td>
													<td height="25" class='contenM tabletd_all'>
														접속수
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
													
													$sql="select sum(t.trade_price), t.order_userid, t.order_name, count(*), m.connect, sum(t.trade_use_point), sum(t.trade_save_point) from cs_member m left join cs_trade t on t.order_userid=m.userid where order_userid!='' group by userid,order_name order by 1 desc";
													$cntResut	= $db->result($sql);
													while( $row = @mysqli_fetch_array($cntResut)) {
														$totalList++;
													}
													
													$sql .= " LIMIT $startPage, $listScale";
													$result=$db->result($sql);

													$listNo = ($startPage);
													while($row=mysqli_fetch_array($result)) {
													?>
												<tr id='calendar_list_tableTD_on'>
													<td class='sensO tabletd_all noneoolimmoL'>
														<?=++$listNo;?>
													</td>
													<td class='sensO tabletd_all'>
														<? if($row[1]) echo $row[1]; else echo "<font color='#DF5544'>비회원</font>"; ?>
													</td>
													<td class='sensO tabletd_all'>
														<?=$row[2] ?>
													</td>
													<td class='sensO tabletd_all'>
														<?=number_format($row[3]);?>
													</td>
													<td class='sensO tabletd_all'>
														<?=number_format($row[0]);?>
													</td>
													<td class='sensO tabletd_all noneoolimmoL'>
														<?=number_format($row[5]);?>
													</td>
													<td class='sensO tabletd_all noneoolimmoL'>
														<?=number_format($row[6]);?>
													</td>
													<td class='sensO tabletd_all'>
														<?=number_format($row[4]);?>
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
														<a href="crm3_download.php" class='search_bbs1'>액셀판일 다운로드 (*.CSV)</a>
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

<?
include('../header.php');
//$_GET=&$HTTP_GET_VARS;
if(!$_GET[date]) { $_GET[date] =1;}

$year_max= $db->row("cs_trade", "", "max(left(trade_day, 4))");
$year_min= $db->row("cs_trade", "", "min(left(trade_day, 4))");

?>
<script language="javascript">
<!--
function sendit() {
	var form=document.search_form;
	form.submit();
}

function showMon(){
	var form=document.search_form;
	if(form.year.selectedIndex >0) {
		form.mon.style.display="";
	} else {
		form.mon.style.display="none";
		form.mon.selectedIndex=0;
	}
}
//-->
</script>
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
									<table width="100%">
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
																		<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">기간별매출통계</td>
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
																								<td>기간별(연, 월, 일, 요일별)로 매출통계가 출력되며 회원과 비회원을 구매 상태를 확인하실 수 있습니다.</td>
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
												<table width="100%">
													<form method=get action="<?=$_SERVER[PHP_SELF];?>" name="search_form">
													<input type="hidden" name="date" value="5">						
													<tr> 
														<td height="35">
															<b>검색기간선택 :</b>
															<select name="year" onChange="javascript:showMon();" class='input'>
															<option value="0" selected>연도별</option>
															<? for($year_go=$year_min[0]; $year_go<=$year_max[0]; $year_go++){?>
															<option value="<?=$year_go?>" <? if($_GET[year] == $year_go) echo('selected');?>><?=$year_go?>년</option>
															<?}?>
															</select>
															<select name="mon" id="mon" style="display:none" class='input'>
															<option value="0" selected>월별</option>
															<? for($mon_go=1;$mon_go<13;$mon_go++){?>
															<option value="<?=$mon_go?>" <? if($_GET[mon] == $mon_go) echo('selected');?>><?=$mon_go?>월</option>
															<?}?>
															</select>
															<a href="javascript:sendit();" class='search_bbs'>검색</a>&nbsp;&nbsp;&nbsp;<a href="<?=$_SERVER[PHP_SELF];?>?date=4"class='search_bbs3'>요일별</a>
														</td>
													</tr>
													</form>
												</table>
												
												<?
												// 판매완료한 총 구매수
												$total_trade_cnt=$db->cnt("cs_trade", "where trade_stat=4");
												// 판매완료한 총 구입금액
												$total_trade_price=$db->sum("cs_trade", "where trade_stat=4", "trade_price");
												?>
												<?
												if($_GET[date]==1) {
													$result=$db->result("select left(trade_day, 4), count(idx), sum(trade_price) from cs_trade where trade_stat=4 group by left(trade_day, 4)");
													$u_cnt = $db->cnt("cs_trade", "where order_userid!='' and trade_stat=4 group by left(trade_day, 4)");
													$no_cnt = $db->cnt("cs_trade", "where order_userid='' and trade_stat=4 group by left(trade_day, 4)");
													
												?>
												<table width="100%" class="table_all">
													<tr bgcolor='E4E7EF'> 
														<td height="25" class='contenM tabletd_all'>연도</td>
														<td height="25" class='contenM tabletd_all'>판매수</td>
														<td height="25" class='contenM tabletd_all'>구매금액</td>
														<td height="25" class='contenM tabletd_all'>구매자정보</td>
														<td width="30%" height="25" align="center" bgcolor='E4E7EF' class='contenM tabletd_all noneoolimmoL'>판매수/구매금액 그래프</td>
													</tr>
													<?
													while($row = @mysqli_fetch_array( $result )) {
													?>
													<tr id='calendar_list_tableTD_on'> 
														<td class='sensO tabletd_all'><?=$row[0];?></td>
														<td class='sensO tabletd_all'><?=number_format($row[1]);?></td>
														<td class='sensO tabletd_all'><?=number_format($row[2]);?></td>
														<td class='sensO tabletd_all'>회원(<?=number_format($u_cnt);?>), 비회원(<?=number_format($no_cnt);?>)</td>
														<td width="30%" class='tabletd_small tabletd_all noneoolimmoL'>
															<table width="" height="25" class="menupurple">
																<tr> 
																	<td height="12"><img src="../images/graph2.gif" height="11" width="<?= abs( $row[1] / $total_trade_cnt * 10000 ) / 100*3;?>"></td>
																</tr>
																<tr> 
																	<td height="12"><img src="../images/graph1.gif" height="11" width="<?= abs( $row[2] / $total_trade_price * 10000 ) / 100*3;?>"></td>
																</tr>
															</table>
														</td>
													</tr>
													<?
													}
													?>
												</table>
												
												<?
												} else if($_GET[date]==2) {
													$result=$db->result("select substring(trade_day, 6, 2), count(idx), sum(trade_price) from cs_trade where trade_stat=4 group by substring(trade_day, 6, 2)");
													$u_cnt = $db->cnt("cs_trade", "where order_userid!='' and trade_stat=4 group by left(trade_day, 6, 2)");
													$no_cnt = $db->cnt("cs_trade", "where order_userid='' and trade_stat=4 group by left(trade_day, 6, 2)");
												?>
												<table width="100%" class="table_all">
													<tr bgcolor='E4E7EF'> 
														<td height="25" class='contenM tabletd_all'>월별</td>
														<td height="25" class='contenM tabletd_all'>판매수</td>
														<td height="25" class='contenM tabletd_all'>구매금액</td>
														<td height="25" class='contenM tabletd_all'>구매자정보</td>
														<td width="30%" height="25" align="center" bgcolor='E4E7EF' class='contenM tabletd_all' class='contenM'>판매수/구매금액 그래프</td>
													</tr>
													<?
													while( $row = @mysqli_fetch_array( $result )) {
													?>
													<tr id='calendar_list_tableTD_on'> 
														<td class='sensO tabletd_all'><?=$row[0];?></td>
														<td class='sensO tabletd_all'><?=number_format($row[1]);?></td>
														<td class='sensO tabletd_all'><?=number_format($row[2]);?></td>
														<td class='sensO tabletd_all'>회원(<?=number_format($u_cnt);?>), 비회원(<?=number_format($no_cnt);?>)</td>
														<td width="30%" class='tabletd_small tabletd_all noneoolimmoL'>
															<table width="" height="25" class="menupurple">
																<tr> 
																	<td height="12"><img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_trade_cnt * 10000 ) / 100*3;?>"></td>
																</tr>
																<tr> 
																	<td height="12"><img src="../images/graph1.gif" height="11" width="<?= intval( $row[2] / $total_trade_price * 10000 ) / 100*3;?>"></td>
																</tr>
															</table>
														</td>
													</tr>
													<?
													}
													?>
												</table>
												
												<?
												} else if($_GET[date]==3) {
													$result=$db->result("select substring(trade_day, 9, 2), count(idx), sum(trade_price), count(order_userid) from cs_trade where trade_stat=4 group by substring(trade_day, 9, 2)");
													$u_cnt = $db->cnt("cs_trade", "where order_userid!='' and trade_stat=4 group by left(trade_day, 9, 2)");
													$no_cnt = $db->cnt("cs_trade", "where order_userid='' and trade_stat=4 group by left(trade_day, 9, 2)");
												?>
												<table width="100%" class="table_all">
													<tr bgcolor='E4E7EF'> 
														<td height="25" class='contenM tabletd_all'>일별</td>
														<td height="25" class='contenM tabletd_all'>판매수</td>
														<td height="25" class='contenM tabletd_all'>구매금액</td>
														<td height="25" class='contenM tabletd_all'>구매자정보</td>
														<td width="30%" height="25" align="center" bgcolor='E4E7EF' class='contenM tabletd_all noneoolimmoL'>판매수/구매금액 그래프</td>
													</tr>
													<?
													while( $row = @mysqli_fetch_array( $result )) {
														$no_cnt=$row[1]-$row[3];
													?>
													<tr id='calendar_list_tableTD_on'> 
														<td class='sensO tabletd_all'><?=$row[0];?></td>
														<td class='sensO tabletd_all'><?=number_format($row[1]);?></td>
														<td class='sensO tabletd_all'><?=number_format($row[2]);?></td>
														<td class='sensO tabletd_all'>회원(<?=number_format($u_cnt);?>), 비회원(<?=number_format($no_cnt);?>)</td>
														<td width="30%" class='tabletd_small tabletd_all noneoolimmoL'>
															<table width="" height="25" class="menupurple">
																<tr> 
																	<td height="12"><img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_trade_cnt * 10000 ) / 100*3;?>"></td>
																</tr>
																<tr> 
																	<td height="12"><img src="../images/graph1.gif" height="11" width="<?= intval( $row[2] / $total_trade_price * 10000 ) / 100*3;?>"></td>
																</tr>
															</table>
														</td>
													</tr>
													<?
													}
													?>
												</table>
												
												<?
												} else if($_GET[date]==4) {
													$result=$db->result("select DAYNAME(left(trade_day, 10)), count(idx), sum(trade_price), count(order_userid) from cs_trade where trade_stat=4 group by DAYNAME(left(trade_day, 10))");
												?>
												<table width="100%" class="table_all">
													<tr bgcolor='E4E7EF'> 
														<td height="25" class='contenM tabletd_all'>요일별</td>
														<td height="25" class='contenM tabletd_all'>판매수</td>
														<td height="25" class='contenM tabletd_all'>구매금액</td>
														<td height="25" class='contenM tabletd_all'>구매자정보</td>
														<td width="30%" height="25" align="center" bgcolor='E4E7EF' class='contenM tabletd_all noneoolimmoL'>판매수/구매금액 그래프</td>
													</tr>
													<?
													while( $row = @mysqli_fetch_array( $result )) {
													$u_cnt = $db->cnt("cs_trade", "where order_userid!='' and trade_stat=4 and DAYNAME(left(trade_day, 10))='$row[0]'");
													$no_cnt = $db->cnt("cs_trade", "where order_userid='' and trade_stat=4 and DAYNAME(left(trade_day, 10))='$row[0]'");
													?>
													<tr id='calendar_list_tableTD_on'> 
														<td class='sensO tabletd_all'><?=$row[0];?></td>
														<td class='sensO tabletd_all'><?=number_format($row[1]);?></td>
														<td class='sensO tabletd_all'><?=number_format($row[2]);?></td>
														<td class='sensO tabletd_all'>회원(<?=number_format($u_cnt);?>), 비회원(<?=number_format($no_cnt);?>)</td>
														<td width="30%" class='tabletd_small tabletd_all noneoolimmoL'>
															<table width="" height="25" class="menupurple">
																<tr> 
																	<td height="12"><img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_trade_cnt * 10000 ) / 100*3;?>"></td>
																</tr>
																<tr> 
																	<td height="12"><img src="../images/graph1.gif" height="11" width="<?= intval( $row[2] / $total_trade_price * 10000 ) / 100*3;?>"></td>
																</tr>
															</table>
														</td>
													</tr>
													<?
													}
													?>
												</table>
												<?
												} else if($_GET[date]==5 && $_GET[year]==0 && $_GET[mon]==0) {
													$result=$db->result("select left(trade_day, 4), count(idx), sum(trade_price), count(order_userid) from cs_trade where trade_stat=4 group by left(trade_day, 4)");	
													$u_cnt = $db->cnt("cs_trade", "where order_userid!='' and trade_stat=4 group by left(trade_day, 4)");
													$no_cnt = $db->cnt("cs_trade", "where order_userid='' and trade_stat=4 group by left(trade_day, 4)");
												?>
												<table width="100%" class="table_all">
													<tr bgcolor='E4E7EF'> 
														<td height="25" class='contenM tabletd_all'>연도</td>
														<td height="25" class='contenM tabletd_all'>판매수</td>
														<td height="25" class='contenM tabletd_all'>구매금액</td>
														<td height="25" class='contenM tabletd_all'>구매자정보</td>
														<td width="30%" height="25" align="center" bgcolor='E4E7EF' class='contenM tabletd_all noneoolimmoL'>판매수/구매금액 그래프</td>
													</tr>
													<?
													while($row = @mysqli_fetch_array( $result )) {
														$no_cnt=$row[1]-$row[3]; 
													?>
													<tr id='calendar_list_tableTD_on'> 
														<td class='sensO tabletd_all'><?=$row[0];?></td>
														<td class='sensO tabletd_all'><?=number_format($row[1]);?></td>
														<td class='sensO tabletd_all'><?=number_format($row[2]);?></td>
														<td class='sensO tabletd_all'>회원(<?=number_format($u_cnt);?>), 비회원(<?=number_format($no_cnt);?>)</td>
														<td width="30%" class='tabletd_small tabletd_all noneoolimmoL'>
															<table width="" height="25" class="menupurple">
																<tr> 
																	<td height="12"><img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_trade_cnt * 10000 ) / 100*3;?>"></td>
																</tr>
																<tr> 
																	<td height="12"><img src="../images/graph1.gif" height="11" width="<?= intval( $row[2] / $total_trade_price * 10000 ) / 100*3;?>"></td>
																</tr>
															</table>
														</td>
													</tr>
													<?
													}
													?>
												</table>
												<?
												} else if($_GET[date]==5 && $_GET[year] && $_GET[mon]==0) {
													// 판매완료한 총 구매수
													$total_trade_cnt=$db->cnt("cs_trade", "where left(trade_day, 4)='$_GET[year]' and trade_stat=4");
													// 판매완료한 총 구입금액
													$total_trade_price=$db->sum("cs_trade", "where left(trade_day, 4)='$_GET[year]' and trade_stat=4", "trade_price");
													$result=$db->result("select substring(trade_day, 6, 2), count(idx), sum(trade_price), count(order_userid) from cs_trade where left(trade_day, 4)='$_GET[year]' and trade_stat=4 group by substring(trade_day, 6, 2)");

												?>
												<table width="100%" class="table_all">
													<tr bgcolor='E4E7EF'> 
														<td height="25" class='contenM tabletd_all'>월별</td>
														<td height="25" class='contenM tabletd_all'>판매수</td>
														<td height="25" class='contenM tabletd_all'>구매금액</td>
														<td height="25" class='contenM tabletd_all'>구매자정보</td>
														<td width="30%" height="25" align="center" bgcolor='E4E7EF' class='contenM tabletd_all noneoolimmoL'>판매수/구매금액 그래프</td>
													</tr>
													<?
													while( $row = @mysqli_fetch_array( $result )) {
														$u_cnt = $db->cnt("cs_trade", "where order_userid!='' and trade_stat=4 and left(trade_day, 7)='$_GET[year]-$row[0]'");
														$no_cnt = $db->cnt("cs_trade", "where order_userid='' and trade_stat=4 and left(trade_day, 7)='$_GET[year]-$row[0]'");
													?>
													<tr id='calendar_list_tableTD_on'> 
														<td class='sensO tabletd_all'><?=$row[0];?></td>
														<td class='sensO tabletd_all'><?=number_format($row[1]);?></td>
														<td class='sensO tabletd_all'><?=number_format($row[2]);?></td>
														<td class='sensO tabletd_all'>회원(<?=number_format($u_cnt);?>), 비회원(<?=number_format($no_cnt);?>)</td>
														<td width="30%" class='tabletd_small tabletd_all noneoolimmoL'>
															<table width="" height="25" class="menupurple">
																<tr> 
																	<td height="12"><img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_trade_cnt * 10000 ) / 100*3;?>"></td>
																</tr>
																<tr> 
																	<td height="12"><img src="../images/graph1.gif" height="11" width="<?= intval( $row[2] / $total_trade_price * 10000 ) / 100*3;?>"></td>
																</tr>
															</table>
														</td>
													</tr>
													<?
													}
													?>
												</table>
												<?
												} else if($_GET[date]==5 && $_GET[year] && $_GET[mon]) {
													// 판매완료한 총 구매수
													$total_trade_cnt=$db->cnt("cs_trade", "where left(trade_day, 4)='$_GET[year]' and substring(trade_day, 6, 2)=$_GET[mon] and trade_stat=4");
													// 판매완료한 총 구입금액
													$total_trade_price=$db->sum("cs_trade", "where left(trade_day, 4)='$_GET[year]' and substring(trade_day, 6, 2)=$_GET[mon] and trade_stat=4", "trade_price");
													$result=$db->result("select substring(trade_day, 9, 2), count(idx), sum(trade_price), count(order_userid) from cs_trade where left(trade_day, 4)='$_GET[year]' and substring(trade_day, 6, 2)=$_GET[mon] and trade_stat=4 group by substring(trade_day, 9, 2)");
												?>
												<table width="100%" class="table_all">
													<tr bgcolor='E4E7EF'> 
														<td height="25" class='contenM tabletd_all'>일별</td>
														<td height="25" class='contenM tabletd_all'>판매수</td>
														<td height="25" class='contenM tabletd_all'>구매금액</td>
														<td height="25" class='contenM tabletd_all'>구매자정보</td>
														<td width="30%" height="25" align="center" bgcolor='E4E7EF' class='contenM tabletd_all noneoolimmoL'>판매수/구매금액 그래프</td>
													</tr>
													<?
													while( $row = @mysqli_fetch_array( $result )) {
														$u_cnt = $db->cnt("cs_trade", "where order_userid!='' and trade_stat=4 and left(trade_day, 10)='$_GET[year]-".sprintf('%02d',$_GET[mon])."-$row[0]'");
														$no_cnt = $db->cnt("cs_trade", "where order_userid='' and trade_stat=4 and left(trade_day, 10)='$_GET[year]-".sprintf('%02d',$_GET[mon])."-$row[0]'");
													?>
													<tr id='calendar_list_tableTD_on'> 
														<td class='sensO tabletd_all'><?=$row[0];?></td>
														<td class='sensO tabletd_all'><?=number_format($row[1]);?></td>
														<td class='sensO tabletd_all'><?=number_format($row[2]);?></td>
														<td class='sensO tabletd_all'>회원(<?=number_format($u_cnt);?>), 비회원(<?=number_format($no_cnt);?>)</td>
														<td width="30%" class='tabletd_small tabletd_all noneoolimmoL'>
															<table width="" height="25" class="menupurple">
																<tr> 
																	<td height="12"><img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_trade_cnt * 10000 ) / 100*3;?>"></td>
																</tr>
																<tr> 
																	<td height="12"><img src="../images/graph1.gif" height="11" width="<?= intval( $row[2] / $total_trade_price * 10000 ) / 100*3;?>"></td>
																</tr>
															</table>
														</td>
													</tr>
													<?
													}
													?>
												</table>

												<?}?>
												
												<table width="100%" height="55">
													<tr> 
														<td height="25" style='text-align:center'><a href="crm2_download.php?date=<?=$_GET[date];?>&year=<?=$_GET[year];?>&mon=<?=$_GET[mon];?>" class='search_bbs1'>액셀판일 다운로드 (*.CSV)</a></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<script language="JavaScript">
									<!--
									showMon();
									//-->
									</script>
									<!---------내용출력끝----------->
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


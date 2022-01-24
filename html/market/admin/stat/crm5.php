<?
	include('../header.php');
	include($ROOT_DIR."/lib/page_class.php");
	
	//$_GET=&$HTTP_GET_VARS;
	
	$mv_data	= $_GET[bbs_data];
	$bbs_data	= $tools->decode( $_GET[bbs_data] );
	if( $_GET[idx] )					{ $idx = $_GET[idx]; }											else { $idx = $bbs_data[idx]; }
	if( $_GET[date] )					{ $date = $_GET[date]; }									else { $date = $bbs_data[date]; }
	if( $_GET[listNo] )				{ $listNo = $_GET[listNo]; }									else { $listNo = $bbs_data[listNo]; }
	if( $_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $bbs_data[startPage]; }
	if( $_GET[year] )	{ $year = $_GET[year]; }			else { $year	= $bbs_data[year]; }
	if( $_GET[mon] )	{ $mon = $_GET[mon]; }		else { $mon	= $bbs_data[mon]; }
	if( $_GET[day] )	{ $day = $_GET[day]; }		else { $day	= $bbs_data[day]; }
	
	if(!$date) { $date = 1;}
	$bbs_data = $tools->encode("startPage=".$startPage."&listNo=".$listNo."&date=".$date."&year=".$year."&mon=".$mon."&day=".$day);
	
	// 전체 접속자 수
	$total_connect_cnt=$db->cnt("cs_connect", "");
	
	$year_max= $db->row("cs_connect", "", "max(left(register, 4))");
	$year_min= $db->row("cs_connect", "", "min(left(register, 4))");
	
	
	// 리스트갯수
	$listScale			=	20;
	// 페이지 갯수
	$pageScale		=	5;
	// 스타트 페이지
	if( !$startPage ) { $startPage = 0; }
	// 토탈페이지
	$totalPage = floor($startPage / ($listScale * $pageScale));
	// 검색
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
		
		if(form.mon.selectedIndex >0) {
			form.day.style.display="";
		} else {
			form.day.style.display="none";
			form.day.selectedIndex=0;
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
																			<td>
																				<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">접속로그분석</td>
																			</td>
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
																							<td>쇼핑몰 접속현황을 연, 월, 일, 요일, IP별로 나타냅니다.<br>
																							접속경로를 클릭하면 아래와 같이 쇼핑몰을 접속하기 전의 경로를 나타냅니다.<br>
																							이는 배너광고나 기타 마케팅계획을 세울 때 아주 유용한 자료가 됩니다.</td>
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
											<div class='oolimbox-wrapper'>
												<form method=get action="<?=$_SERVER[PHP_SELF];?>" name="search_form">
												<input type="hidden" name="date" value="7">
												<div class='oolimbox-col_2dan-1'>
														검색기간선택 :
														<select name="year" onChange="javascript:showMon();" class='input'>
														<option value="0" selected>연도별</option>
														<? for($year_go=$year_min[0]; $year_go<=$year_max[0]; $year_go++){?>
														<option value="<?=$year_go?>" <? if($year == $year_go) echo('selected');?>><?=$year_go?>년</option>
														<?}?>
														</select>
														<select name="mon" id="mon" style="display:none" onChange="javascript:showMon();" class='input'>
														<option value="0" selected>월별</option>
														<? for($mon_go=1;$mon_go<13;$mon_go++){?>
														<option value="<?=$mon_go?>" <? if($mon == $mon_go) echo('selected');?>><?=$mon_go?>월</option>
														<?}?>
														</select>
														<select name="day" id="day" style="display:none" class='input'>
														<option value="0" selected>일별</option>
														<? for($day_go=1;$day_go<32;$day_go++){?>
														<option value="<?=$day_go?>" <? if($day == $day_go) echo('selected');?>><?=$day_go?>일</option>
														<?}?>
														</select>
														<a href="javascript:sendit();" class='search_bbs'>검색</a><a href="<?=$_SERVER[PHP_SELF];?>?date=4" class='search_bbs1'>요일별</a><a href="<?=$_SERVER[PHP_SELF];?>?date=5" class='search_bbs2'>IP별검색</a><a href="<?=$_SERVER[PHP_SELF];?>?date=6" class='search_bbs3'>접속경로보기</a>
													
													</div>
													<div class='oolimbox-col_2dan-2'>
														전체 접속자 : <?=$total_connect_cnt;?> 
													</div>
												</div>
												
												</form>
											
											<?
												if($date==1) {
													// 전체 접속자 수
													$total_connect_cnt=$db->cnt("cs_connect", "");
													$result=$db->result("select left(register, 4), count(DISTINCT ip) from cs_connect group by left(register, 4)");
												?>
											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF">
													<td height="35" class='contenM tabletd_all'>
														연도
													</td>
													<td height="25" class='contenM tabletd_all'>
														접속수
													</td>
													<td width="25%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>
														접속수 그래프
													</td>
												</tr>
												<?
													while( $row = @mysqli_fetch_array( $result )) {
													?>
												<tr bgColor="white">
													<td height="25" class='sensO tabletd_all'>
														<?=$row[0];?>
													</td>
													<td height="25" class='sensO tabletd_all'>
														<?=number_format($row[1]);?>
													</td>
													<td width="25%" height="25" class='sensO tabletd_all noneoolimmoL'>
														<table>
															<tr>
																<td height="11">
																	<img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100*3;?>"> <?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100;?>%
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<?
												}
												?>
											</table>
											
											<?
											} else if($date==2) {
												// 전체 접속자 수
												$total_connect_cnt=$db->cnt("cs_connect", "");
												$result=$db->result("select substring(register, 6, 2), count(DISTINCT ip) from cs_connect group by substring(register, 6, 2)");
											?>
											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF">
													<td height="35" class='contenM tabletd_all'>
														월별
													</td>
													<td height="25" class='contenM tabletd_all'>
														접속수
													</td>
													<td width="25%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>
														접속수 그래프
													</td>
												</tr>
												<?
													while( $row = @mysqli_fetch_array( $result )) {
													?>
												<tr bgColor="white">
													<td height="25" class='sensO tabletd_all'>
														<?=$row[0];?>
													</td>
													<td height="25" class='sensO tabletd_all'>
														<?=number_format($row[1]);?>
													</td>
													<td width="25%" height="25" class='sensO tabletd_all noneoolimmoL'>
														<table>
															<tr>
																<td height="11">
																	<img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100*3;?>"> <?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100;?>%
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<?
												}
												?>
											</table>
											
											<?
											} else if($date==3) {
												// 전체 접속자 수
												$total_connect_cnt=$db->cnt("cs_connect", "");
												$result=$db->result("select substring(register, 9, 2), count(DISTINCT ip) from cs_connect group by substring(register, 9, 2)");
											?>
											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF">
													<td height="35" class='contenM tabletd_all'>
														일별
													</td>
													<td height="25" class='contenM tabletd_all'>
														접속수
													</td>
													<td width="25%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>
														접속수 그래프
													</td>
												</tr>
												<?
													while( $row = @mysqli_fetch_array( $result )) {
													?>
												<tr bgColor="white">
													<td height="25" class='sensO tabletd_all'>
														<?=$row[0];?>
													</td>
													<td height="25" class='sensO tabletd_all'>
														<?=number_format($row[1]);?>
													</td>
													<td width="25%" height="25" class='sensO tabletd_all noneoolimmoL'>
														<table>
															<tr>
																<td height="11">
																	<img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100*3;?>"> <?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100;?>%
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<?
												}
												?>
											</table>
											<?
											} else if($date==4) {
												// 전체 접속자 수
												$total_connect_cnt=$db->cnt("cs_connect", "");
												$result=$db->result("select WEEKDAY(left(register, 10)), count(DISTINCT ip) from cs_connect group by WEEKDAY(left(register, 10))");
											?>
											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF">
													<td height="35" class='contenM tabletd_all'>
														요일별
													</td>
													<td height="25" class='contenM tabletd_all'>
														접속자
													</td>
													<td width="25%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>
														접속수 그래프
													</td>
												</tr>
												<?
													while( $row = @mysqli_fetch_array( $result )) {
													?>
												<tr bgColor="white">
													<td height="25" class='sensO tabletd_all'>
														<?=$tools->strDateWeek($row[0]);?>
													</td>
													<td height="25" class='sensO tabletd_all'>
														<?=number_format($row[1]);?>
													</td>
													<td width="25%" height="25" class='sensO tabletd_all noneoolimmoL'>
														<table>
															<tr>
																<td height="11">
																	<img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100*3;?>"> <?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100;?>%
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<?
												}
												?>
											</table>
											
											<?
											} else if($date==5) {
												// 스타트 페이지
												if( !$startPage ) { $startPage = 0; }
												// 토탈페이지
												$totalPage = floor($startPage / ($listScale * $pageScale));
												// 검색
												// 전체 접속자 수
												$total_connect_cnt=$db->cnt("cs_connect", "");
												$result=$db->result("select count(ip) as CNT, ip from cs_connect group by ip order by CNT desc LIMIT $startPage, $listScale");
												$total_result	= $db->select("cs_connect", "group by ip");
												while( $bbs_row = mysqli_fetch_object($total_result)) {
													$i++;
												}
												
												$totalList = $i;
												$i = 0;
												// 페이지넘버
												if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
											?>
											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF">
													<td height="35" class='contenM tabletd_all'>
														접속 IP
													</td>
													<td height="25" class='contenM tabletd_all'>
														접속수
													</td>
													<td width="25%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>
														접속 그래프
													</td>
												</tr>
												<?
												while( $row = @mysqli_fetch_array( $result )) {
												?>
												<tr bgColor="white">
													<td height="25" class='sensO tabletd_all'>
														<?=$row[1];?>
													</td>
													<td height="25" class='sensO tabletd_all'>
														<?=$row[0];?>
													</td>
													<td width="25%" height="25" class='sensO tabletd_all noneoolimmoL'>
														<table>
															<tr>
																<td height="11">
																	<img src="../images/graph2.gif" height="11" width="<?= intval( $row[0] / $total_connect_cnt * 10000 ) / 100*3;?>"> <?= intval( $row[0] / $total_connect_cnt * 10000 ) / 100;?>%
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<?
												}
												?>
											</table>
											
											<?
											} else if($date==6) {
												// 스타트 페이지
												if( !$startPage ) { $startPage = 0; }
												// 토탈페이지
												$totalPage = floor($startPage / ($listScale * $pageScale));
												// 검색
												// 전체 접속자 수
												$total_connect_cnt=$db->cnt("cs_connect", "");
												$result=$db->result("select count(url) as CNT, url from cs_connect group by url order by CNT desc LIMIT $startPage, $listScale");
												$total_result	= $db->select("cs_connect", "group by url");
												while( $bbs_row = mysqli_fetch_object($total_result)) {
													$i++;
												}
												
												$totalList = $i;
												$i = 0;
												// 페이지넘버
												if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
											?>
											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF">
													<td height="35" class='contenM tabletd_all'>
														접속수
													</td>
													<td height="25" class='contenM tabletd_all'>
														접속URL
													</td>
													<td width="150" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>
														접속수 그래프
													</td>
												</tr>
												<?
												while( $row = @mysqli_fetch_array( $result )) {
												?>
												<tr bgColor="white">
													<td height="25" class='sensO tabletd_all'>
														<?=$row[0];?>
													</td>
													<td height="25" class='sensO tabletd_all'>
														<? if($row[1]) {?> <a href="<?=$row[1];?>" target="_blank"><?=$tools->strCut($row[1], 80);?></a> <?} else {?> 즐겨찾기나 URL 주소 직접입력으로 방문 <?}?>
													</td>
													<td width="150" class='sensO tabletd_all noneoolimmoL' height="25">
														<table>
															<tr>
																<td height="11">
																	<img src="../images/graph2.gif" height="11" width="<?= intval( $row[0] / $total_connect_cnt * 10000 ) / 100*1;?>"> <?= intval( $row[0] / $total_connect_cnt * 10000 ) / 100;?>%
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<?
												}
												?>
											</table>
											<?
											} else if($date==7 && $year==0 && $mon==0 && $day==0) {
												// 전체 접속자 수
												$total_connect_cnt=$db->cnt("cs_connect", "");
												$result=$db->result("select left(register, 4), count(DISTINCT ip) from cs_connect group by left(register, 4)");
												
											?>
											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF">
													<td height="35" class='contenM tabletd_all'>
														연도
													</td>
													<td height="25" class='contenM tabletd_all'>
														접속수
													</td>
													<td width="25%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>
														접속수 그래프
													</td>
												</tr>
												<?
													while( $row = @mysqli_fetch_array( $result )) {
													?>
												<tr bgColor="white">
													<td height="25" class='sensO tabletd_all'>
														<?=$row[0];?>
													</td>
													<td height="25" class='sensO tabletd_all'>
														<?=number_format($row[1]);?>
													</td>
													<td width="25%" height="25" class='sensO tabletd_all noneoolimmoL'>
														<table>
															<tr>
																<td height="11">
																	<img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100*3;?>"> <?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100;?>%
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<?
												}
												?>
											</table>
											<?
											} else if($date==7 && $year && $mon==0 && $day==0) {
												// 전체 접속자 수
												$total_connect_cnt=$db->cnt("cs_connect", "where left(register, 4)='$year'");
												$result=$db->result("select substring(register, 6, 2), count(DISTINCT ip) from cs_connect where left(register, 4)='$year' group by substring(register, 6, 2)");
											?>
											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF">
													<td height="35" class='contenM tabletd_all'>
														월별
													</td>
													<td height="25" class='contenM tabletd_all'>
														접속수
													</td>
													<td width="25%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>
														접속수 그래프
													</td>
												</tr>
												<?
													while( $row = @mysqli_fetch_array( $result )) {
													?>
												<tr bgColor="white">
													<td height="25" class='sensO tabletd_all'>
														<?=$row[0];?>
													</td>
													<td height="25" class='sensO tabletd_all'>
														<?=number_format($row[1]);?>
													</td>
													<td width="25%" height="25" class='sensO tabletd_all noneoolimmoL'>
														<table>
															<tr>
																<td height="11">
																	<img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100*3;?>"> <?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100;?>%
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<?
												}
												?>
											</table>
											<?
											} else if($date==7 && $year && $mon && $day==0) {
												// 전체 접속자 수
												$total_connect_cnt=$db->cnt("cs_connect", "where left(register, 4)='$year' and substring(register, 6, 2)=$mon");
												$result=$db->result("select substring(register, 9, 2), count(DISTINCT ip) from cs_connect where left(register, 4)='$year' and substring(register, 6, 2)=$mon group by substring(register, 9, 2)");
											?>
											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF">
													<td height="35" class='contenM tabletd_all'>
														일별
													</td>
													<td height="25" class='contenM tabletd_all'>
														접속수
													</td>
													<td width="25%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>
														접속수 그래프
													</td>
												</tr>
												<?
												while( $row = @mysql_fetch_array( $result )) {
												?>
												<tr bgColor="white">
													<td height="25" class='sensO tabletd_all'>
														<?=$row[0];?>
													</td>
													<td height="25" class='sensO tabletd_all'>
														<?=number_format($row[1]);?>
													</td>
													<td width="25%" height="25" class='sensO tabletd_all noneoolimmoL'>
														<table>
															<tr>
																<td height="11">
																	<img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100*3;?>"> <?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100;?>%
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<?
												}
												?>
											</table>
											
											<?
											} else if($date==7 && $year && $mon && $day) {
												// 전체 접속자 수
												$total_connect_cnt=$db->cnt("cs_connect", "where left(register, 4)='$year' and substring(register, 6, 2)=$mon and substring(register, 9, 2)=$day");
												$result=$db->result("select substring(register, 12, 2), count(DISTINCT ip) from cs_connect where left(register, 4)='$year' and substring(register, 6, 2)=$mon and substring(register, 9, 2)=$day group by substring(register, 12, 2)");
											?>
											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF">
													<td height="35" class='contenM tabletd_all'>
														시간별
													</td>
													<td height="25" class='contenM tabletd_all'>
														접속수
													</td>
													<td width="25%" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>
														접속수 그래프
													</td>
												</tr>
												<?
												while( $row = @mysql_fetch_array( $result )) {
												?>
												<tr id='calendar_list_tableTD_on'>
													<td height="25" class='sensO tabletd_all'>
														<?=$row[0];?>
													</td>
													<td height="25" class='sensO tabletd_all'>
														<?=number_format($row[1]);?>
													</td>
													<td width="25%" height="25" class='sensO tabletd_all noneoolimmoL'>
														<table>
															<tr>
																<td height="11">
																	<img src="../images/graph2.gif" height="11" width="<?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100*3;?>"> <?= intval( $row[1] / $total_connect_cnt * 10000 ) / 100;?>%
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<?
												}
												?>
											</table>
											<?}?>
											<table width="90%">
												<tr>
													<td height="85" style='text-align:center'>
														<? $page->logList($totalPage, $totalList, $listScale, $pageScale, $startPage, "", "",  "", "", $date, $year, $mon, $day );?>
													</td>
												</tr>
											</table>
											<table width="100%" height="55">
												<tr>
													<td height="25"></td>
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


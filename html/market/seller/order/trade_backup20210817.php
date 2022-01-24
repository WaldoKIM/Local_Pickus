<?
include('../header.php');
include($ROOT_DIR . "/lib/page_class.php");
//$_GET=&$HTTP_GET_VARS; $_GET=&$HTTP_GET_VARS;

// 거래 정보 수정
$mv_data	= $_GET[trade_data];
$trade_data	= $tools->decode($_GET[trade_data]);
if ($_GET[idx]) {
	$idx = $_GET[idx];
} else {
	$idx = $trade_data[idx];
}
if ($_GET[trade_stat]) {
	$trade_stat = $_GET[trade_stat];
} else {
	$trade_stat = $trade_data[trade_stat];
}
if ($_GET[listNo]) {
	$listNo = $_GET[listNo];
} else {
	$listNo = $trade_data[listNo];
}
if ($_GET[startPage]) {
	$startPage = $_GET[startPage];
} else {
	$startPage	= $trade_data[startPage];
}
//검색
if ($_GET[search_item_chk]) {
	$search_item_chk = $_GET[search_item_chk];
} else {
	$search_item_chk	= $trade_data[search_item_chk];
}
if ($_GET[search_mem_item]) {
	$search_mem_item = $_GET[search_mem_item];
} else {
	$search_mem_item	= $trade_data[search_mem_item];
}
if ($_GET[search_trade_item]) {
	$search_trade_item = $_GET[search_trade_item];
} else {
	$search_trade_item	= $trade_data[search_trade_item];
}
if ($_GET[search_order]) {
	$search_order = $_GET[search_order];
} else {
	$search_order	= $trade_data[search_order];
}

if ($_GET[search_day]) {
	$search_day = $_GET[search_day];
} else {
	$search_day	= $trade_data[search_day];
}
if ($_GET[search_day_str]) {
	$search_day_str = $_GET[search_day_str];
} else {
	$search_day_str	= $trade_data[search_day_str];
}
// 상세정보를 저장
if ($_GET[search_day] == 5 &&  $_GET[start_year] && $_GET[start_mon] && $_GET[start_day] && $_GET[end_year] && $_GET[end_mon] && $_GET[end_day]) {
	$search_day_str = $_GET[start_year] . "+" . $_GET[start_mon] . "+" . $_GET[start_day] . "+" . $_GET[end_year] . "+" . $_GET[end_mon] . "+" . $_GET[end_day];
	$search_day_array = explode("+", $search_day_str);
} else {
	$search_day_array = explode("+", $search_day_str);
}

$year_max = $db->row("cs_trade", "", "max(left(trade_day, 4))");
$year_min = $db->row("cs_trade", "", "min(left(trade_day, 4))");
if (!$year_max[0]) $year_max = date('Y') + 1;
else $year_max = $year_max[0];
if (!$year_min[0]) $year_min = date('Y');
else $year_min = $year_min[0];

$trade_data = $tools->encode("trade_stat=" . $trade_stat . "&startPage=" . $startPage . "&listNo=" . $listNo . "&table=" . $table . "&search_item_chk=" . $search_item_chk . "&search_mem_item=" . $search_mem_item . "&search_trade_item=" . $search_trade_item . "&search_order=" . $search_order . "&search_day=" . $search_day . "&search_day_str=" . $search_day_str . "&start_year=" . $start_year . "&start_mon=" . $start_mon . "&start_day=" . $start_day . "&end_year=" . $end_year . "&end_mon=" . $end_mon . "&end_day=" . $end_day);

?>

<script language="JavaScript">
	<!--
	// 검색기능
	function search() {
		var form = document.trade_form;

		form.submit();
	}

	// 거래상태 변경
	function tradeChange(form_data) {
		if (form_data.trade_stat.value == 3) {
			var choose = confirm('거래중으로 변경 하시겠습니까?');
			if (choose) {
				form_data.submit();
			}
		} else if (form_data.trade_stat.value == 5) {
			var choose = confirm('주문 취소를 하시겠습니까?\n\n거래내역이 삭제됩니다.');
			if (choose) {
				form_data.submit();
			}
		}
	}

	// 거래정보보기
	function tradeView(mv_data) {
		location.href = 'trade_view.php?trade_data=' + mv_data;
	}

	////  송장번호 입력 ///////////////////////////////////////////////////////////////////////////////
	function invoiceWinOpen(data, form_data) {
		if (form_data.trade_stat.value < 2) {
			alert('결제확인 상태에서만 송장번호 입력가능합니다.');
		} else {
			window.open("invoice.php?trade_idx=" + data, "", "scrollbars=no, width=400, height=165");
		}
	}

	////  회원에게 메일 보내기 ///////////////////////////////////////////////////////////////////////////////

	function showSearch() {
		var form = document.trade_form;
		if (form.search_item_chk.selectedIndex < 1) {
			form.search_trade_item.style.display = "none";
			form.search_mem_item.style.display = "";
			form.search_order.style.display = "";
		} else {
			form.search_trade_item.style.display = "";
			form.search_mem_item.style.display = "none";
			form.search_order.style.display = "none";
		}
	}

	function allCheck() {
		var f = document.forms['listform'];
		if (typeof(f.del_list) == 'object') {
			if (f.allchk.checked) {
				if (f.del_list.length)
					for (var i = 0; i < f.del_list.length; i++) f.del_list[i].checked = true;
				else f.del_list.checked = true
			} else {
				if (f.del_list.length)
					for (var i = 0; i < f.del_list.length; i++) f.del_list[i].checked = false;
				else f.del_list.checked = false;
			}
		} else {
			if (f.allchk.checked) {
				alert('선택할 글이 없습니다.');
				f.allchk.checked = false;
				return;
			} else return;
		}
	}

	function actSelect() {
		var f = document.forms['listform'];
		var arr_del_list = new Array();
		var i, j;
		if (typeof(f.del_list) == 'object') {
			if (f.del_list.length) {
				for (i = 0, j = 0; i < f.del_list.length; i++) {
					if (f.del_list[i].checked) {
						arr_del_list[i] = f.del_list[i].value;
						j++;
					}
				}
				if (!j) {
					alert('선택된 항목이 없습니다.');
					return;
				} else f.arr_del_list.value = arr_del_list.join('@');
			} else {
				if (!f.del_list.checked) {
					alert('선택된 항목이 없습니다.');
					return;
				}
			}
			if (j == 1) f.arr_del_list.value = '';
			if (confirm('발송처리를 하시겠습니까?')) f.submit();
		} else {
			alert('선택할 항목이 없습니다.');
			return;
		}
	}

	// 취소 사유 입력창
	function View_memo(d) {
		if (document.getElementById("View_memo" + d).style.display == "") document.getElementById("View_memo" + d).style.display = "none"
		else document.getElementById("View_memo" + d).style.display = ""
	}

	function stateChange(form_data) {
		var choice = confirm('거래 취소 요청을 하시겠습니까?');
		if (choice) {
			if (form_data.refund_remark.value == "") {
				alert("취소사유를 입력해 주세요");
			} else {
				form_data.submit();
			}
		}
	}
	//
	-->
	//-->
</script>


<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<? include('inc/order_menu_inc.php'); ?>
	</article>

	<article class="oolimbox-grid-box02">

		<table border="0" width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">주문관리</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#dddddd"></td>
			</tr>
			<tr>
				<td height="25" bgColor="white"></td>
			</tr>
			<tr>
				<td class="padding_5">
					<table width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
								<table width="100%" border="0" align="center">
									<tr>
										<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu"><br>
											<?
											if ($trade_stat == 1) {
												$trade_title = "결제대기";
											} else if ($trade_stat == 2) {
												$trade_title = "결제확인";
											} else if ($trade_stat == 3) {
												$trade_title = "배송중";
											} else if ($trade_stat == 4) {
												$trade_title = "판매완료";
											} else if ($trade_stat == 5) {
												$trade_title = "취소요청중";
											} else if ($trade_stat == 51) {
												$trade_title = "환불대기중";
											} else if ($trade_stat == 51) {
												$trade_title = "환불완료";
											} else {
												$trade_title = "전체검색";
											}
											?>
											<table width="100%">
												<tr>
													<td>
														<table border="0" width="100%">
															<tr>
																<td height="25">
																	<table>
																		<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0"><?= $trade_title; ?></td>
																	</table>
																</td>
															</tr>
															<tr>
																<td height="20">
																	<!--도움말-->
																	<table width="100%" class='tipbox noneoolimmoL'>
																		<tr>
																			<td bgcolor="#E9F2F8">
																				<table width="100%">
																					<tr>
																						<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																					</tr>
																					<tr>
																						<td>1. 주문조회 : 검색조건을 설정하고 검색하면 해당 주문 리스트가 나옵니다.<br></p>

																							<p>3. 거래상태설정 : 최초주문시부터 판매완료까지의 거래상태를 나타냅니다. </p>
																						</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>
																	<!--//도움말-->

																</td>
															</tr>
															<tr>
																<td height="5"></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<br>

											<table width="100%" class="table_all">
												<form action="<?= $_SERVER[PHP_SELF]; ?>" method="get" name="trade_form">
													<input type="hidden" name="trade_stat" value="<?= $trade_stat; ?>">
													<tr bgColor="white">
														<td width="80" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>검색조건</td>
														<td colspan="2" class='tabletd_all'>
															<table style='width:100%;'>
																<tr>
																	<td class='sensbody'>
																		<div class='oolimbox-wrapper'>
																			<div class='oolimbox-col_2dan-1'>
																				<input type="radio" name="search_day" value="1" <? if ($search_day == 1 || empty($search_day)) {
																																	echo ('checked');
																																} ?>>오늘주문 <input type="radio" name="search_day" value="2" <? if ($search_day == 2) {
																																																echo ('checked');
																																															} ?>>최근1주간 <input type="radio" name="search_day" value="3" <? if ($search_day == 3) {
																																																																															echo ('checked');
																																																																														} ?>>최근한달간 <input type="radio" name="search_day" value="4" <? if ($search_day == 4) {
																																																																																																								echo ('checked');
																																																																																																							} ?>>최근1년간 <input type="radio" name="search_day" value="5" <? if ($search_day == 5) {
																																																																																																																																	echo ('checked');
																																																																																																																																} ?>>상세검색
																			</div>
																		</div>

																	</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr bgColor="white">
														<td align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>기간 지정</td>
														<td class='tabletd_all' style='padding:5px'>

															<div id="customertable_divcont">
																<div id="customertable_divLeft">
																	<div class="customertable_divLeft">

																		<div id="customertable_divcont">
																			<div id="customertable_divLeft">
																				<div class="customertable_divLeft">
																					<select name="start_year" class="input">
																						<option value="0">선택</option>
																						<? for ($i = $year_min; $i <= $year_max; $i++) {
																							$today_year = date("Y"); ?>
																							<option value="<?= $i ?>" <? if ($i == $search_day_array[0]) echo ("selected"); ?>> <?= $i ?> </option>
																						<? } ?>
																					</select>년
																					<select name="start_mon" class="input">
																						<option value="0">선택</option>
																						<? for ($i = 1; $i < 13; $i++) {
																							if (strlen($i) == 1) $i = "0" . $i;
																							$today_mon = date("m"); ?>
																							<option value="<?= $i ?>" <? if ($i == $search_day_array[1]) echo ("selected"); ?>> <?= $i ?> </option>
																						<? } ?>
																					</select>월
																					<select name="start_day" class="input">
																						<option value="0">선택</option>
																						<? for ($i = 1; $i < 32; $i++) {
																							if (strlen($i) == 1) $i = "0" . $i;
																							$today_day = date("d"); ?>
																							<option value="<?= $i ?>" <? if ($i == $search_day_array[2]) echo ("selected"); ?>> <?= $i ?> </option>
																						<? } ?>
																					</select>일 부터
																				</div>
																			</div>
																			<div id="customertable_divcenter_1">
																				<div class="customertable_divcenter_1">
																					<select name="end_year" class="input">
																						<option value="0">선택</option>
																						<? for ($i = $year_min; $i <= $year_max; $i++) {
																							$today_year = date("Y"); ?>
																							<option value="<?= $i ?>" <? if ($i == $search_day_array[3]) echo ("selected"); ?>> <?= $i ?> </option>
																						<? } ?>
																					</select>년
																					<select name="end_mon" class="input">
																						<option value="0">선택</option>
																						<? for ($i = 1; $i < 13; $i++) {
																							if (strlen($i) == 1) $i = "0" . $i;
																							$today_mon = date("m"); ?>
																							<option value="<?= $i ?>" <? if ($i == $search_day_array[4]) echo ("selected"); ?>> <?= $i ?> </option>
																						<? } ?>
																					</select>월
																					<select name="end_day" class="input">
																						<option value="0">선택</option>
																						<? for ($i = 1; $i < 32; $i++) {
																							if (strlen($i) == 1) $i = "0" . $i;
																							$today_day = date("d"); ?>
																							<option value="<?= $i ?>" <? if ($i == $search_day_array[5]) echo ("selected"); ?>> <?= $i ?> </option>
																						<? } ?>
																					</select>일 까지
																				</div>
																			</div>
																		</div>

																	</div>
																</div>
																<div id="customertable_divcenter_1">
																	<div class="customertable_divcenter_1bbs">
																		<a href="javascript:search();" class='itemtable_default_bt1'>검색결과조회</a>
																	</div>
																</div>
															</div>

														</td>
													</tr>
												</form>
											</table><br>

											<?/*
										<form method="POST" action="trade_ok.php" name="listform">											
											<input type="hidden" name="arr_del_list">
											<input type="checkbox"  name="del_list" style="display:none;">
										
											<table>
												<tr>
													<td class='oolimbtn-botton2'>
														전체선택 : <input type="checkbox" name="allchk" onClick="allCheck();this.blur()">
													</td>
													<td>
														<a href="javascript:actSelect()" class='oolimbtn-botton3'>발송처리</a>
													</td>
												</tr>
											</table>
										*/ ?>

											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF">
													<td style="display:none;" height="35" class='contenM tabletd_all'>선택</td>
													<td height="35" class='contenM tabletd_all noneoolimmoL'>No</td>
													<td height="35" class='contenM tabletd_all noneoolim'>주문번호</td>
													<td height="35" class='contenM tabletd_all'>주문자</td>
													<td height="35" class='contenM tabletd_all noneoolimmoL'>상품</td>
													<td height="35" class='contenM tabletd_all noneoolimmoL'>단가</td>
													<td height="35" class='contenM tabletd_all noneoolimmoL'>수량</td>
													<td height="35" class='contenM tabletd_all noneoolimmoL'>합계금액</td>
													<td height="35" class='contenM tabletd_all noneoolimmoL'>배송비</td>
													<td height="35" class='contenM tabletd_all noneoolimmoL'>전화번호</td>
													<td height="35" class='contenM tabletd_all noneoolimmoL'>주문일</td>
													<td height="35" class='contenM tabletd_all'>거래상태</td>
													<? if ($trade_stat > 1) { ?>
														<td height="35" class='contenM tabletd_all'>송장번호</td>
													<? } ?>
													<td height="35" class='contenM tabletd_all'>거래관리</td>
													<td height="35" class='contenM tabletd_all'>거래취소</td>
												</tr>
												<?
												$table				= "cs_trade_goods";
												$listScale			=	20; 		// 리스트갯수
												$pageScale		=	10;		// 페이지 갯수
												if (!$startPage) {
													$startPage = 0;
												}		// 스타트 페이지
												$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지


												// 상태 검색
												if (empty($trade_stat)) {
													$trade_stat_sql = "";
												} else if ($trade_stat == 1) {
													$trade_stat_noand_sql = "where (trade_stat=1 OR trade_stat=0)";
													$trade_stat_sql = "and (trade_stat=1 OR trade_stat=0) ";
												} else if ($trade_stat == 2) {
													$trade_stat_noand_sql = "where trade_stat=2";
													$trade_stat_sql = "and trade_stat=2";
												} else if ($trade_stat == 3) {
													$trade_stat_noand_sql = "where trade_stat=3";
													$trade_stat_sql = "and trade_stat=3";
												} else if ($trade_stat == 4) {
													$trade_stat_noand_sql = "where trade_stat=4";
													$trade_stat_sql = "and trade_stat=4";
												} else if ($trade_stat == 5) {
													$trade_stat_noand_sql = "where trade_stat=5";
													$trade_stat_sql = "and trade_stat=5";
												} else if ($trade_stat == 51) {
													$trade_stat_noand_sql = "where trade_stat=51";
													$trade_stat_sql = "and trade_stat=51";
												} else if ($trade_stat == 52) {
													$trade_stat_noand_sql = "where trade_stat=52";
													$trade_stat_sql = "and trade_stat=52";
												}

												// 날자 검색
												if ($search_day == 1) {
													// 오늘 주문검색
													$trade_day_sql = "where TO_DAYS(trade_day)=TO_DAYS(NOW()) $trade_stat_sql";
												} else if ($search_day == 2) {
													// 최근 일주일 주문검색
													$trade_day_sql = "where TO_DAYS(NOW())-TO_DAYS(trade_day)<=7 $trade_stat_sql";
												} else if ($search_day == 3) {
													// 최근 한달 주문검색
													$trade_day_sql = "where TO_DAYS(NOW())-TO_DAYS(trade_day)<=30 $trade_stat_sql";
												} else if ($search_day == 4) {
													// 최근 1년 주문검색
													$trade_day_sql = "where TO_DAYS(NOW())-TO_DAYS(trade_day)<=365 $trade_stat_sql";
												} else if ($search_day == 5) {
													// 상세 주문검색
													$trade_day_sql = "where DATE_FORMAT(trade_day,'%Y-%m-%d')>='$search_day_array[0]-$search_day_array[1]-$search_day_array[2]' and DATE_FORMAT(trade_day,'%Y-%m-%d')<='$search_day_array[3]-$search_day_array[4]-$search_day_array[5]' $trade_stat_sql";
												} else {
													// 주문검색
													$trade_day_sql = $trade_stat_noand_sql;
												}

												if (!$trade_day_sql && !$search_item_sql) {
													$seller_sql = "where seller='$_SESSION[USERID]' ";
												} else {
													$seller_sql = "and seller='$_SESSION[USERID]' ";
												}

												$totalList	= $db->cnt($table, "$trade_day_sql $search_item_sql $seller_sql");
												$result		= $db->select($table, "$trade_day_sql $search_item_sql $seller_sql order by idx desc LIMIT $startPage, $listScale");


												$form_name = 0; // 폼리스트 변수
												if ($startPage) {
													$listNo = $totalList - $startPage;
												} else {
													$listNo = $totalList;
												}		// 페이지넘버
												while ($row = mysqli_fetch_object($result)) {
													$form_name++; // 폼네임변경 숫자증가
													$order_stat = $db->object("cs_trade", "where trade_code='$row->trade_code'");
													$trade_data = $tools->encode("idx=" . $order_stat->idx . "&trade_stat=" . $trade_stat . "&startPage=" . $startPage . "&listNo=" . $listNo . "&table=" . $table . "&search_item_chk=" . $search_item_chk . "&search_mem_item=" . $search_mem_item . "&search_trade_item=" . $search_trade_item . "&search_order=" . $search_order . "&search_day=" . $search_day . "&search_day_str=" . $search_day_str . "&start_year=" . $start_year . "&start_mon=" . $start_mon . "&start_day=" . $start_day . "&end_year=" . $end_year . "&end_mon=" . $end_mon . "&end_day=" . $end_day);
												?>
													<?/*
												<form name="form_<?=$form_name?>" method="post" action="trade_ok.php?trade_data=<?=$trade_data;?>">
												<input type="hidden" name="hidden_trade_idx" value="<?=$row->idx;?>">	
												*/ ?>
													<tr id='calendar_list_tableTD_on'>
														<td style="display:none;" width="5%" class='sensO mmenu1 tabletd_all'>
															<input type="checkbox" name="del_list" value="<?= $row->idx; ?>">
														</td>

														<td width="5%" class='sensO mmenu1 tabletd_all noneoolimmoL'><?= $listNo; ?></td>

														<td width="10%" class='sensO mmenu1 tabletd_all noneoolim'>
															<font color='FA8080'><?= $row->trade_code; ?></font>
														</td>

														<td class='sensO mmenu1 tabletd_all'><a href="javascript:userSendmailWinOpen('<?= $order_stat->order_email; ?>');"><span class='itemorder_font'><?= $order_stat->order_name; ?></span></a>

															<span class='main_titleM noneoolimmoL_on' style='text-align:center;'>
																<hr />
																주문코드<br>
																<font color='FA8080'><?= $row->trade_code; ?></font>
																<hr />

																전화<br>
																<?= $order_stat->order_tel1; ?><?= $order_stat->order_tel2; ?><?= $order_stat->order_tel3; ?>
															</span>
														</td>

														<td class='sensO mmenu1 tabletd_all noneoolimmoL'><?= $row->goods_name; ?></td>
														<td class='sensO mmenu1 tabletd_all noneoolimmoL' align="center">
															<font color="#FF0000"><?= number_format($row->goods_price); ?>원</font>
														</td>
														<td class='sensO mmenu1 tabletd_all noneoolimmoL'>
															<font color="#FF0000"><?= number_format($row->goods_cnt); ?> 개</font>
														</td>
														<td class='sensO mmenu1 tabletd_all noneoolimmoL' align="center">
															<font color="#FF0000"><?= number_format($row->goods_price * $row->goods_cnt); ?>원</font>
														</td>
														<td class='sensO mmenu1 tabletd_all noneoolimmoL' align="center">
															<font color="#FF0000"><?= number_format($row->trade_deliv_price); ?>원</font>
														</td>
														<td class='sensO mmenu1 tabletd_all noneoolimmoL'><?= $order_stat->order_tel1; ?><?= $order_stat->order_tel2; ?><?= $order_stat->order_tel3; ?></td>

														<td class='sensO mmenu1 tabletd_all noneoolimmoL'><?= $tools->strDateCut($row->trade_day, 1); ?></td>
														<td class='sensO mmenu1 tabletd_all'>
															<? if ($row->trade_stat < 2) {
																echo ("결제대기중");
															} ?>
															<? if ($row->trade_stat == 2) {
																echo ("결제완료됨");
															} ?>
															<? if ($row->trade_stat == 3) {
																echo ("배송중");
															} ?>
															<? if ($row->trade_stat == 4) {
																echo ("판매완료됨");
															} ?>
															<? if ($row->trade_stat == 5) {
																echo ("주문취소 요청중");
															} ?>
															<? if ($row->trade_stat == 51) {
																echo ("환불 대기중");
															} ?>
															<? if ($row->trade_stat == 52) {
																echo ("취소/환불 완료");
															} ?>
															<? if ($row->trade_stat == 6) {
																echo ("삭제");
															} ?>

															<span class='noneoolimmoL_on' style='text-align:center'>
																<hr />
																<span class='table_all_marginO'>단가<br>
																	<font color="#FF0000" class='itemorder_font'><?= number_format($row->goods_price); ?>원</font>
																</span>
																<hr />
																<span class='table_all_marginO'>수량<br>
																	<font color="#FF0000" class='itemorder_font'><?= number_format($row->goods_cnt); ?>개</font>
																</span>
																<hr />
																<span class='table_all_marginO'>합계<br>
																	<font color="#FF0000" class='itemorder_font'><?= number_format($row->goods_price * $row->goods_cnt); ?>원</font>
																</span>
																<hr />

																주문일<br>
																<?= $tools->strDateCut($row->trade_day, 1); ?><br>
														</td>
														<? if ($trade_stat > 1) { ?>
															<td width="5%" class='sensO mmenu1 tabletd_all'>
																<?/*<input type="text" name="deliv_number[<?=$row->idx;?>]" value="<?=$row->deliv_number;?>">*/ ?>
																<?= $row->deliv_number; ?>
															</td>
														<? } ?>
														<td width="10%" class='sensO mmenu1 tabletd_all'>
															<div id="customertable_divcenterM">
																<div class="customertable_divcenter_1bbs">
																	<form name="form_invoice<?= $row->idx ?>" method="POST" action="trade_ok.php?trade_data=<?= $trade_data; ?>">
																		<input type="hidden" name="trade_stat" value="<?= $trade_stat; ?>">
																		<? if ($row->trade_stat >= 2) { ?>
																			<a href="#" class='modal itemtable_default_bt3 noneoolim' data-modal-height="300" data-modal-width="400" data-modal-iframe="invoice.php?trade_idx=<?= $row->idx; ?>" data-modal-title="송장관리">송장관리</a>
																		<? } else { ?>
																			<a href="javascript:invoiceWinOpen(<?= $row->idx; ?>, document.form_invoice<?= $row->idx ?>)" class="itemtable_default_bt3 noneoolim"> 송장관리 </a>
																		<? } ?>
																		<a href="javascript:tradeView('<?= $trade_data; ?>');" class="itemtable_default_bt4">상세보기</a>
																	</form>
																</div>
															</div>
														</td>
														<td width="80px" class='sensO mmenu1 tabletd_all'>
															<div id="customertable_divcenterM" style="line-height:30px;">
																<div class="customertable_divcenter_1bbs">
																	<? if ($row->trade_stat < 3) { ?>
																		<a href="javascript:View_memo('<?= $row->idx ?>')" class="itemtable_default_bt3">거래취소</a>
																	<? } ?>

																	<?= $row->refund_type; ?><br>
																	<? if ($row->trade_stat > 4) { ?>
																		<a href="#" class='modal itemtable_default_bt4 noneoolim' data-modal-height="500" data-modal-width="450" data-modal-iframe="refund_detail.php?trade_idx=<?= $row->idx; ?>" data-modal-title="거래취소 상세정보">상세정보</a>
																	<? } ?>

																	<? if ($row->trade_stat == 5) { ?>
																		<form name="refund_form_<?= $row->idx ?>" method="POST" action="./refund_ok.php?trade_data=<?= $mv_data; ?>" enctype="multipart/form-data">
																			<input type="hidden" name="idx" value="<?= $row->idx ?>">
																			<input type="hidden" name="state" value="51">
																			<input type="hidden" name="refund_remark" value="판매자 동의">
																			<a href="javascript:stateChange(document.refund_form_<?= $row->idx ?>);" class='itemtable_default_bt3'>거래취소승인</a>
																		</form>
																	<? } ?>

																</div>
															</div>
														</td>
													</tr>
													<!-- 취소사유 입력 -->
													<tr id='View_memo<?= $row->idx ?>' style="display:none;">
														<form name="form_<?= $row->idx ?>" method="POST" action="./refund_ok.php?trade_data=<?= $mv_data; ?>" enctype="multipart/form-data">
															<input type="hidden" name="idx" value="<?= $row->idx ?>">
															<input type="hidden" name="state" value="51">
															<td height="45" colspan="11" style="padding:5px 5px 5px 10px;">
																<textarea name="refund_remark" style="width:90%; height:100px; padding:10px;" placeholder="취소사유를 입력해 주세요."><?= strip_tags($row->refund_remark); ?></textarea>
															</td>
															<td height="45" colspan="2" style="padding-left:30px">
																<a href="javascript:View_memo('<?= $row->idx ?>')" class='itemtable_default_bt2'>닫기</a>
																<a href="javascript:stateChange(document.form_<?= $row->idx ?>);" class='itemtable_default_bt3'>취소요청</a>
															</td>
														</form>
													</tr>
													<!-- 취소사유 입력 종료 //-->

													<?/*
												</form>
												*/ ?>
												<?
													$listNo--;
												}
												?>


												<? if (!$totalList) {
													switch ($trade_stat) {
														case 1:
															$colspan = "14";
															break;
														default:
															$colspan = "15";
													}
												?>
													<tr>
														<td height="100" colspan="<?= $colspan; ?>" class='sensO mmenu1 tabletd_all'> 거래 내역이 없습니다.</td>
													</tr>
												<? } ?>
											</table>
											<?/*	
										</form>
										*/ ?>

											<table width="100%" border="0" class="submenu">
												<tr>
													<td class='sensO mmenu1' height='80'><? $page->trade($trade_stat, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, "<img src='../images/prev.gif' border='0'>", "<img src='../images/next.gif' border='0'>", $search_item_chk, $search_mem_item, $search_trade_item, $search_order, $search_day, $search_day_str); ?></td>
												</tr>
											</table><br>
										</td>
									</tr>
								</table>
								<script language="JavaScript">
									<!--
									showSearch();
									//
									-->
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
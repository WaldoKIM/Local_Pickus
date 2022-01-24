<?
include('../header.php');
include($ROOT_DIR . "/lib/page_class.php");

// 거래 정보 수정
$mv_data	= $_GET[wallet_data];

if ($_GET[trade_data]) {
	$wallet_data = $tools->decode($_GET[trade_data]);
} else {
	$wallet_data = $tools->decode($_GET[wallet_data]);
}

if ($_GET[idx]) {
	$idx = $_GET[idx];
} else {
	$idx = $wallet_data[idx];
}
if ($_GET[trade_stat]) {
	$trade_stat = $_GET[trade_stat];
} else {
	$trade_stat = $wallet_data[trade_stat];
}
if ($_GET[listNo]) {
	$listNo = $_GET[listNo];
} else {
	$listNo = $wallet_data[listNo];
}
if ($_GET[startPage]) {
	$startPage = $_GET[startPage];
} else {
	$startPage	= $wallet_data[startPage];
}

if ($_GET[search_mem_item]) {
	$search_mem_item = $_GET[search_mem_item];
} else {
	$search_mem_item	= $wallet_data[search_mem_item];
}
if ($_GET[search_trade_item]) {
	$search_trade_item = $_GET[search_trade_item];
} else {
	$search_trade_item	= $wallet_data[search_trade_item];
}
if ($_GET[search_order]) {
	$search_order = $_GET[search_order];
} else {
	$search_order	= $wallet_data[search_order];
}

if ($_GET[search_day]) {
	$search_day = $_GET[search_day];
} else {
	$search_day	= $wallet_data[search_day];
}
if ($_GET[search_day_str]) {
	$search_day_str = $_GET[search_day_str];
} else {
	$search_day_str	= $wallet_data[search_day_str];
}

// 상세정보를 저장
if ($_GET[search_day] == 5 &&  $_GET[start_year] && $_GET[start_mon] && $_GET[start_day] && $_GET[end_year] && $_GET[end_mon] && $_GET[end_day]) {
	$search_day_str = $_GET[start_year] . "+" . $_GET[start_mon] . "+" . $_GET[start_day] . "+" . $_GET[end_year] . "+" . $_GET[end_mon] . "+" . $_GET[end_day];
	$search_day_array = explode("+", $search_day_str);
}

//결제정보
$pginfo = $db->object("cs_pgsetup", "");
$year_max = $db->row("cs_wallet_log", "", "max(left(register, 4))");
$year_min = $db->row("cs_wallet_log", "", "min(left(register, 4))");
if (!$year_max) $year_max = date("Y");
if (!$year_min) $year_min = date("Y");
?>

<script language="JavaScript">
	function snsOpen(){
      $('#load').show();
	}

	function snsClose(){
      $('#load').hide();
	}

	$(function (){
		$("#btn_toggle2").click(function (){
		$("#Toggle").toggle();
		});
	});

	<!--
	// 검색기능
	function search() {
		var form = document.deposit_form;
		form.submit();
	}

	// 거래상태 변경
	function confirmChange(form_data) {
		if (form_data.confirm_stat.value == 1) {
			var choose = confirm('승인 하시겠습니까?');
			if (choose) {
				form_data.submit();
			}
		} else if (form_data.confirm_stat.value == 2) {
			var choose = confirm('승인을 취소 하시겠습니까?');
			if (choose) {
				form_data.submit();
			}
		}
	}

	//
	-->

	
</script>
<div class="mypage_btn_header">
    <a href="javascript:history.back();" class="back_btn"><img src="../img/back.png" alt=""></a>
    <div class="title">출금신청내역</div>
	<a href="#" id="btn_toggle" onclick="snsOpen();"><img class="product_view_icon" src="../img/guide_btn.png" alt=""></a>
</div>
<div id="load">
	<div class="sns_content">
		<div class="sns_flex">
			<p>출금신청내역 가이드</p>
			<a href="#" onclick="snsClose();">X</a>
		</div>
		<div class="sns-go">
			<img class="sns_img" src="../img/wallet_export_guide.png" alt="">
		</div>
	</div>
</div>
<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<? include('inc/wallet_menu_inc.php'); ?>
	</article>

	<article class="oolimbox-grid-box02">

		<table border="0" width="100%">
			<tr>
				<td class="padding_5">

					<!--콘텐츠출력-->
					<table width="100%">
						<tr>
							<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
								<table width="100%">
									<tr>
										<td>
											<table width="100%">
												<tr height="20">
													<a id="btn_toggle2">출금신청내역 가이드</a>
												</tr>
												<tr>
													<td>
														<!--도움말-->
														<table width="100%" style="display:none;" id="Toggle" class='tipbox noneoolimmoL'>
															<tr>
																<td>
																	<div>
																		### 판매 수수료 부과 안내 ###<br><br>

																		1. 서비스 판매 완료<br>
																		2. 수수료를 제한 판매대금을 포인트로 적립<br>
																		3. 출금 요청<br>
																		4. 회원정보에 입력된 입금계좌로 정산(공휴일 제외, 평일 6~8시에 일괄 입금처리)<br>
																		<br>
																		* 회원정보수정 페이지에서 입금계좌 꼭 기입해주세요.<br>
																		<br>
																		판매 수수료 사용처<br>
																		-플랫폼 유지비(데이터, 호스팅 등)<br>
																		-광고/홍보 비<br>
																		-회원용 이벤트 진행 비용<br>
																		-기타 홈페이지 관련 비용<br>
																	</div>
																</td>
															</tr>
														</table>
														<!--도움말-->
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>


								<!---------내용출력----------->
								<table width="100%" border="0" align="center">
									<tr>
										<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">

											<table width="100%" class="table_all border_none">
												<form action="<?= $_SERVER[PHP_SELF]; ?>" method="get" name="deposit_form">
													<input type="hidden" name="trade_stat" value="<?= $trade_stat; ?>">
													<tr bgColor="white">
														<td style="display:none;" width="80" height="25" align="center" bgcolor="#178cdb" style="color:#fff;" class='contenM tabletd_all'>검색조건</td>
														<td colspan="2" class='border_none tabletd_all'>
															<table style="width:100%;">
																<tr style="display:none;">
																	<td class="link_btn_flex">
																		<a class="link_btn" href="https://repickus.com/market/seller/wallet/wallet.php">수익금관리GO</a>
																		<a style="color:#fff !important; background:#1379cd;" class="link_btn" href="https://repickus.com/market/seller/wallet/wallet_settle.php">출금신청내역GO</a>
																	</td>
																</tr>
																<tr>
																	<td class="link_btn_flex">
																		<select name="trade_stat" class="src_select">
																			<option value="">승인상태선택</option>
																			<option value="2" <? if ($trade_stat == "2") echo ('selected'); ?>>대기</option>
																			<option value="1" <? if ($trade_stat == "1") echo ('selected'); ?>>승인</option>
																		</select>
																	</td>
																</tr>
																<tr>
																	<td class='sensbody'>

																		<div class='oolimbox-wrapper'>
																				
																			<div class='src_label_flex oolimbox-col_2dan-1'>
																				<input class="src_radio" style="display:none;" id="src_label1" type="radio" name="search_day" value="1" <? if ($search_day == 1 || empty($search_day)) {echo ('checked');} ?>>
																				<label class="src_label" for="src_label1">오늘</label> 
																				
																				<input class="src_radio" style="display:none;" id="src_label2" type="radio" name="search_day" value="2" <? if ($search_day == 2) {echo ('checked');} ?>>
																				<label style="display:none;" class="src_label" for="src_label2">최근1주</label> 		

																				<input class="src_radio" style="display:none;" id="src_label3" type="radio" name="search_day" value="3" <? if ($search_day == 3) {echo ('checked');} ?>> 
																				<label class="src_label" for="src_label3">최근한달</label> 	
																				
																				<input class="src_radio" style="display:none;" id="src_label4" type="radio" name="search_day" value="4" <? if ($search_day == 4) {echo ('checked');} ?>>
																				<label style="display:none;" class="src_label" for="src_label4">최근1년</label> 

																				<input class="src_radio" style="display:none;" id="src_label5" onclick="onsrcform()" type="radio" id="src_label5" name="search_day" value="5" <? if ($search_day == 5) {echo ('checked');} ?>>
																				<label class="src_label" for="src_label5">상세검색</label> 
																				
																				<a href="javascript:search();" class='date_search src_btn src_label'>검색</a>
																			</div>
																			
																		</div>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr class="border_none" bgColor="white">
														<td style="display:none;" align="center" bgcolor="#178cdb" style="color:#fff;" class='contenM tabletd_all'>기간 지정</td>
														<td class='tabletd_all border_none' style='padding:5px'>

															<div id="customertable_divcont">
																<div style="width:100%;" id="customertable_divLeft">
																	<div class="customertable_divLeft">


																		<div style="display:none;" class="src_form" id="customertable_divcont">
																			<div style="width:100%;" id="customertable_divLeft">
																				<div class="src_select_flex customertable_divLeft">
																					<select name="start_year" class="src_select input">
																						<option value="0">년</option>
																						<? for ($year_go = $year_min[0]; $year_go <= $year_max[0]; $year_go++) { ?>
																							<option value="<?= $year_go ?>" <? if ($_GET[start_year] == $year_go) echo ('selected'); ?>><?= $year_go ?></option>
																						<? } ?>
																					</select>
																					
																					<select name="start_mon" class="src_select input">
																						<option value="0">월</option>
																						<? for ($i = 1; $i < 13; $i++) {
																							if (strlen($i) == 1) $i = "0" . $i;
																							$today_mon = date("m"); ?>
																							<option value="<?= $i ?>" <? if ($i == $search_day_array[1]) echo ("selected"); ?>> <?= $i ?> </option>
																						<? } ?>
																					</select>
																					
																					<select name="start_day" class="src_select input">
																						<option value="0">일</option>
																						<? for ($i = 1; $i < 32; $i++) {
																							if (strlen($i) == 1) $i = "0" . $i;
																							$today_day = date("d"); ?>
																							<option value="<?= $i ?>" <? if ($i == $search_day_array[2]) echo ("selected"); ?>> <?= $i ?> </option>
																						<? } ?>
																					</select>
																					부터
																				</div>
																			</div>

																			<div style="width:100%;" id="customertable_divcenter_1">
																				<div class="src_select_flex customertable_divcenter_1">
																					<select name="end_year" class="src_select input">
																						<option value="0">년</option>
																						<? for ($year_go = $year_min[0]; $year_go <= $year_max[0]; $year_go++) { ?>
																							<option value="<?= $year_go ?>" <? if ($_GET[end_year] == $year_go) echo ('selected'); ?>><?= $year_go ?></option>
																						<? } ?>
																					</select>
																					
																					<select name="end_mon" class="src_select input">
																						<option value="0">월</option>
																						<? for ($i = 1; $i < 13; $i++) {
																							if (strlen($i) == 1) $i = "0" . $i;
																							$today_mon = date("m"); ?>
																							<option value="<?= $i ?>" <? if ($i == $search_day_array[4]) echo ("selected"); ?>> <?= $i ?> </option>
																						<? } ?>
																					</select>
																					
																					<select name="end_day" class="src_select input">
																						<option value="0">일</option>
																						<? for ($i = 1; $i < 32; $i++) {
																							if (strlen($i) == 1) $i = "0" . $i;
																							$today_day = date("d"); ?>
																							<option value="<?= $i ?>" <? if ($i == $search_day_array[5]) echo ("selected"); ?>> <?= $i ?> </option>
																						<? } ?>
																					</select>
																					까지
																				</div>
																			</div>
																		</div>

																	</div>
																</div>										
															</div>
														</td>
													</tr>
													<tr class="border_none" bgcolor="white">
														<td class="border_none tabletd_all" style="padding:5px">
															<div style="width:100%;" id="customertable_divcenter_1">
																<div style="display: flex; justify-content: center;" class="customertable_divcenter_1bbs">
																	<? $csv_data = $tools->encode("trade_stat=" . $trade_stat . "&startPage=" . $startPage . "&listNo=" . $listNo . "&table=" . $table . "&search_trade_item=" . $search_trade_item . "&search_order=" . $search_order . "&search_day=" . $search_day . "&search_day_str=" . $search_day_str); ?>
																	
																</div>
															</div>
														</td>
													</tr>
												</form>
											</table>

											<table width="100%">
												<tr>
													<td height='20px'></td>
												</tr>
											</table>

											<table width="100%" class="table_all wallet_settle_table_flex">
												<tr style="display:none;" bgcolor="#178cdb">
													<td style="color:#fff;" class='contenM tabletd_all noneoolimmoL'>No</td>
													<td style="color:#fff;" class='contenM tabletd_all'>거래번호</td>
													<td style="color:#fff;" class='contenM tabletd_all noneoolimmoL'>요청일</td>
													<td style="color:#fff;" class='contenM tabletd_all'>출금액</td>
													<td style="color:#fff;" height='40' class='contenM tabletd_all'>은행</td>
													<td style="color:#fff;" class='contenM tabletd_all noneoolimmoL'>계좌번호</td>
													<td style="color:#fff;" class='contenM tabletd_all noneoolimmoL'>예금주</td>
													<td style="color:#fff;" class='contenM tabletd_all'>수정일</td>
													<td style="color:#fff;" class='contenM tabletd_all'>상태</td>
												</tr>
												<?
												$table				= "cs_wallet_log";
												$listScale			=	20; 		// 리스트갯수
												$pageScale		=	10;		// 페이지 갯수
												if (!$startPage) {
													$startPage = 0;
												}
												// 스타트 페이지
												$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지


												// 상태 검색
												if (empty($trade_stat)) {
													$trade_stat_sql = "and userid='$_SESSION[USERID]'  and userid='$_SESSION[USERID]'  ";
												} else if ($trade_stat == 1) {
													$trade_stat_noand_sql = "where confirm=1  and userid='$_SESSION[USERID]' ";
													$trade_stat_sql = "and confirm=1  and userid='$_SESSION[USERID]' ";
												} else if ($trade_stat == 2) {
													$trade_stat_noand_sql = "where confirm = ''  and userid='$_SESSION[USERID]' ";
													$trade_stat_sql = "and confirm = ''  and userid='$_SESSION[USERID]' ";
												} else {
													$trade_stat_sql = "where userid='$_SESSION[USERID]' ";
												}


												// 날자 검색
												if ($search_day == 1) {
													// 오늘 주문검색
													$register_sql = "where TO_DAYS(register)=TO_DAYS(NOW()) $trade_stat_sql";
												} else if ($search_day == 2) {
													// 최근 일주일 주문검색
													$register_sql = "where TO_DAYS(NOW())-TO_DAYS(register)<=7 $trade_stat_sql";
												} else if ($search_day == 3) {
													// 최근 한달 주문검색
													$register_sql = "where TO_DAYS(NOW())-TO_DAYS(register)<=30 $trade_stat_sql";
												} else if ($search_day == 4) {
													// 최근 1년 주문검색
													$register_sql = "where TO_DAYS(NOW())-TO_DAYS(register)<=365 $trade_stat_sql";
												} else if ($search_day == 5) {
													// 상세 주문검색
													$register_sql = "where DATE_FORMAT(register,'%Y-%m-%d')>='$search_day_array[0]-$search_day_array[1]-$search_day_array[2]' and DATE_FORMAT(register,'%Y-%m-%d')<='$search_day_array[3]-$search_day_array[4]-$search_day_array[5]' $trade_stat_sql";
												} else {
													// 주문검색
													$register_sql = "where userid='$_SESSION[USERID]'";
												}

												if (!$register_sql) {
													$register_sql = $trade_stat_sql;
												}
												$totalList	= $db->cnt($table, "$register_sql ");
												$result		= $db->select($table, "$register_sql order by idx desc LIMIT $startPage, $listScale");


												//echo $register_sql;

												$form_name = 0; // 폼리스트 변수
												if ($startPage) {
													$listNo = $totalList - $startPage;
												} else {
													$listNo = $totalList;
												}
												// 페이지넘버
												while ($row = mysqli_fetch_object($result)) {
													$form_name++; // 폼네임변경 숫자증가
													$wallet_data = $tools->encode("idx=" . $row->idx . "&trade_stat=" . $trade_stat . "&startPage=" . $startPage . "&listNo=" . $listNo . "&table=" . $table . "&search_trade_item=" . $search_trade_item . "&search_order=" . $search_order . "&search_day=" . $search_day . "&search_day_str=" . $search_day_str);
													$member_stat = $db->object("cs_member", "where userid='$row->order_userid'");
													$use_price = number_format($row->use_price);


												?>
													<form name="form_<?= $form_name ?>" method="post" action="deposit_ok.php?wallet_data=<?= $wallet_data; ?>">
														<input type="hidden" name="hidden_deposit_idx" value="<?= $row->idx; ?>">
														<tr id='calendar_list_tableTD_on' class="wallet_settle_flex">
															<td style="display:none;" class='sensO mmenu1 tabletd_all noneoolimmoL wallet_settle_border'><?=$listNo;?></td>
															<td style="display:none;" class='sensO mmenu1 tabletd_all wallet_settle_border'>
																<div style="display:none;">거래번호<?=$row->code;?></div>
																<span class='main_titleM noneoolimmoL_on' style='text-align:center;'>
																	<div class="wallet_settle_font">신청일</div><div class="wallet_settle_font2"><?=$tools->strDateCut($row->register,1);?></div>
																</span>													
															</td>
															<td class='sensO mmenu1 tabletd_all wallet_settle_border'><div class="wallet_settle_font">신청일</div><div class="wallet_settle_font2"><?=$tools->strDateCut($row->register,1);?></div></td>
															<td class='sensO mmenu1 tabletd_all wallet_settle_border'><div class="wallet_settle_font">출금액</div><div class="wallet_settle_font2"><?=number_format($row->use_point)?>원</div></td>
															<td class='sensO mmenu1 tabletd_all wallet_settle_border'<?if($row->bank_type < 5){?><?}?>>
																<div class="wallet_settle_font">은행</div><div class="wallet_settle_font2"><?=$row->bank;?></div>
															</td>
															<td class='sensO mmenu1 tabletd_all wallet_settle_border'>
																<div class="wallet_settle_font">계좌번호</div><div class="wallet_settle_font2"><?=$row->account_num;?></div>
															</td>
															<td class='sensO mmenu1 tabletd_all wallet_settle_border'>
																<div class="wallet_settle_font">예금주</div><div class="wallet_settle_font2"><?=$row->account_name;?></div>
															</td>
															<td style="display:none;" class='sensO mmenu1 tabletd_all wallet_settle_border'>수정일<?=$tools->strDateCut($row->confirm_day,1);?></td>										
															<td class='sensO mmenu1 tabletd_all wallet_settle_border'>
															<div class="wallet_settle_font">상태</div><div class="wallet_settle_font2"><?if($row->invoice_num || $row->bank=="관리자 등록"){?>
																승인
															<?}else{?>
																	<?if($row->confirm){?>승인<?}else{?>대기<?}?>
															<?}?>
															</div>
															</td>
														</tr>
													</form>
												<?
													$listNo--;
												}
												?>


												<? if (!$totalList) { ?>
													<tr bgColor="white" align="center">
														<td class="border_none" height="100" colspan="14" style='text-align:center'>출금 요청 내역이 없습니다.</td>
													</tr>
												<? } ?>
											</table>

											<table width="100%">
												<tr>
													<td style='text-align:center' height='60'><? $page->wallet($trade_stat, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, "", "", "", "", $search_item_chk, $search_mem_item, $search_trade_item, $search_order, $search_day, $search_day_str, $search_item_unit); ?></td>
												</tr>
											</table>
											<table width="100%">
												<tr>
													<td style='text-align:center' height='70'></td>
												</tr>
											</table>				

										</td>
									</tr>
								</table>
								<script language="JavaScript">

									function onsrcform(){
										$('.src_form').show();
										
									}
									
									function offsrcform(){
										$('.src_form').hide();
									}
								</script>
								<!---------내용출력끝----------->
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</article>

</div>



<? include('../footer.php'); ?>
<? include('../seller_fixbar.php'); ?>
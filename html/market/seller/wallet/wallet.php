<?
include('../header.php');
include($ROOT_DIR . "/lib/page_class.php");
//$_GET=&$HTTP_GET_VARS; 
//$_POST=&$HTTP_POST_VARS;

// 상품리뷰레벨 수정(level) 변수
if ($_POST[hidden_level_idx]) {
	$db->update("cs_goods_qna", "coment_check='$_POST[admin_auth]' where idx='$_POST[hidden_level_idx]'");
}
$mv_data	= $_GET[point_data];
$wallet_data	= $tools->decode($_GET[point_data]);
if ($_GET[idx]) {
	$idx = $_GET[idx];
} else {
	$idx = $wallet_data[idx];
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

mt_srand((float)microtime() * 1000000);
$TRADE_CODE = chr(mt_rand(65, 90));
$TRADE_CODE .= chr(mt_rand(65, 90));
$TRADE_CODE .= chr(mt_rand(65, 90));
$TRADE_CODE .= chr(mt_rand(65, 90));
$TRADE_CODE .= chr(mt_rand(65, 90));
$TRADE_CODE .= time();

$member_stat = $db->object("cs_member", "where userid = '$_SESSION[USERID]' ");

?>

<script language="JavaScript">
	//토글
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
	//토글끝
	// 검색기능
	function search() {
		var form = document.review_form;
		if (form.search_order.value == "") {
			alert("검색할 내용을 입력해 주십시오.");
			form.search_order.focus();
		} else {
			form.submit();
		}
	}

	//출금요청
	function point_out() {
		var return_value = confirm('출금요청을 하시겠습니까?');
		if (return_value) {
			document.point_out_form.submit();
		}
	}
</script>
<div class="mypage_btn_header">
    <a href="javascript:history.back();" class="back_btn"><img src="../img/back.png" alt=""></a>
    <div class="title">수익금관리</div>
	<a href="#" id="btn_toggle" onclick="snsOpen();"><img class="product_view_icon" src="../img/guide_btn.png" alt=""></a>
</div>
<div id="load">
	<div class="sns_content">
		<div class="sns_flex">
			<p>수익금관리 가이드</p>
			<a href="#" onclick="snsClose();">X</a>
		</div>
		<div class="sns-go">
			<img class="sns_img" src="../img/wallet_guide.png" alt="">
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
					<table width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
								<table width="100%">
									<tr>
										<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
											<table width="100%">
												<tr>
													<td>
														<table width="100%">
															<tr height="20">
																<a id="btn_toggle2">수익금관리 가이드</a>
															</tr>	
														
														<tr id="Toggle" style="display: none;">
															<td>
																<!--도움말-->
																	<table width="100%" class='tipbox'>
																		<tr>
																			<td bgcolor="#E9F2F8">
																				<table width="100%">
																					<tr>
																						<td>
																							고객께 배송 완료 후 고객님이 구매확정 시 나의 수익금 잔액이 충전됩니다.</br>
																							고객님이 구매확정을 안누를시 배송완료 후 14일 이내에 자동 확정되어 수익금이 충전됩니다.</br>
																							1. 정산 받으실 계좌정보를 등록해주세요.</br>
																							2. 출금 요청 시 당일 확인 후 입금해드립니다.</br>

																						</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>
																	<!--도움말-->
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
												<tr style="display:none;">
													
													<td class="link_btn_flex">
														<a style="color:#fff !important; background:#1379cd;" class="link_btn" href="https://repickus.com/market/seller/wallet/wallet.php">수익금관리GO</a>
														<a class="link_btn" href="https://repickus.com/market/seller/wallet/wallet_settle.php">출금신청내역GO</a>
													</td>
													
												</tr>
												
												<tr>
													<td>
														<form action="./wallet_ok.php?point_data=<?= $mv_data; ?>" method="post" name="bank_form">
															<div class="trade_font_bold">
																내 계좌 정보<input type="hidden" name="mode" value="bank">
															</div>
															<div class="bank_form">
																<div class="bank_form_input bank_form_font">
																	<div>은행 </div> 
																	<input type="text" name="bank" style="font-size:16px !important" class="" value="<?= $member_stat->bank; ?>">
																</div>
																<div class="bank_form_input bank_form_font">
																	<div>계좌번호 </div> 
																	<input type="text" name="account_num" style="font-size:16px !important" class="" value="<?= $member_stat->account_num; ?>">
																</div>
																<div class="bank_form_input bank_form_font">
																	<div>예금주 </div> 
																	<input type="text" name="account_name" style="font-size:16px !important" class="" value="<?= $member_stat->account_name; ?>">
																</div>
																<a href="javascript:document.bank_form.submit();" class="wallet_bank_add_btn">등록</a>
															</div>
														</form>
														<div>
															<form class="wallet_export_form trade_font_bold" action="./wallet_ok.php?point_data=<?= $mv_data; ?>" method="post" name="point_out_form">
															<?
															$total_point = $db->sum("cs_cash", "where userid='$_SESSION[USERID]'", "point");
															?>
															<input type="hidden" name="use_point" value="<?= $total_point; ?>">
															<input type="hidden" name="code" value="<?= $TRADE_CODE; ?>">
															나의 수익금 <font color='FF7800'><?= number_format($total_point); ?></font>&nbsp;원
															<? if ($member_stat->bank && $member_stat->account_num && $member_stat->account_name) { ?>
																<a href="javascript:point_out();" class="wallet_export_btn">출금 요청</a>
															<? } else { ?>
																<span style="color:red">(입금계좌 등록 후 출금요청이 가능합니다.)</span>
															<? } ?>
														</form>
														</div>
													</td>
												</tr>
												<!-- <tr>
													<td class="ordertitle">
														<form class="wallet_export_form trade_font_bold" action="./wallet_ok.php?point_data=<?= $mv_data; ?>" method="post" name="point_out_form">
															<?
															$total_point = $db->sum("cs_cash", "where userid='$_SESSION[USERID]'", "point");
															?>
															<input type="hidden" name="use_point" value="<?= $total_point; ?>">
															<input type="hidden" name="code" value="<?= $TRADE_CODE; ?>">
															나의 수익금 <font color='FF7800'><?= number_format($total_point); ?></font>&nbsp;원
															<? if ($member_stat->bank && $member_stat->account_num && $member_stat->account_name) { ?>
																<a href="javascript:point_out();" class="wallet_export_btn">출금 요청</a>
															<? } else { ?>
																<span style="color:red">(입금계좌 등록 후 출금요청이 가능합니다.)</span>
															<? } ?>
														</form>
													</td>
												</tr> -->
											</table>
					<table width="100%" class="table_all wallet_table_flex">
						
						<?
						$listScale			=	10; 		// 리스트갯수
						$pageScale		=	10;		// 페이지 갯수
						if (!$startPage) {
							$startPage = 0;
						}		// 스타트 페이지
						$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
						$totalList	= $db->cnt("cs_cash", "where userid='$_SESSION[USERID]'");
						$result	= $db->select("cs_cash", "where userid='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale");
						if ($startPage) {
							$listNo = $totalList - $startPage;
						} else {
							$listNo = $totalList;
						}		// 페이지넘버
						while ($row = mysqli_fetch_object($result)) {
							$export = mb_substr($row->title,0,2,'utf-8');
						?>
							<tr class="wallet_flex" bgColor="white" align="center" height="25">
								<?if($export != '출금') { ?>
								<td class='wallet_row tabletd_all tabletd_Lmall wallet_border'>
									<p class="wallet_con_font0">수익금 내역</p>
								</td>
								<td class='wallet_row tabletd_all tabletd_Lmall wallet_border'>
									<p class="wallet_con_font1">주문번호</p><p class="wallet_con_font2"><?=$row->fee_trade_code;?></p>
								</td>
								<td class='wallet_row tabletd_all tabletd_Lmall wallet_border'>
									<p class="wallet_con_font1">판매가격</p><p class="wallet_con_font2"><?= $row->fee_goods_price; ?>원</p>
								</td>
								<td class='wallet_row tabletd_all tabletd_Lmall wallet_border'>
									<p class="wallet_con_font1">수수료</p><p class="wallet_con_font2"><?= $row->fee_rate; ?>%</p>
								</td>
								<? } else {?>
								<td class='wallet_row tabletd_all tabletd_Lmall wallet_border'>
									<p class="wallet_con_font0">수익금 출금 신청내역</p>
								</td>
								<? } ?>
								<td class='wallet_row tabletd_all tabletd_Lmall wallet_border'>
									<!-- 포인를 사용한 경우 색상변경 -->
									<p class="wallet_con_font1">수익금</p><p class="wallet_con_font2"><? if ($row->point < 0) { ?><font color="#FF7800"><?= number_format($row->point); ?></font><? } else { ?><font color="#3A73BF"><?= number_format($row->point); ?><? } ?></font> 원</p>
								</td>
								<td class='wallet_row tabletd_all tabletd_Lmall wallet_border'>
									<p class="wallet_con_font1">확정일자</p><p class="wallet_con_font2"><?= $tools->strDateCut($row->register, 1); ?></p>
								</td>
								
								<?if($export == '출금'){?>
									<td class='wallet_row tabletd_all tabletd_Lmall wallet_border'>
										<p style="color:#fff;" class="wallet_con_font1">&nbsp;</p>
									</td>
									<td class='wallet_row tabletd_all tabletd_Lmall wallet_border'>
										<p style="color:#fff;" class="wallet_con_font1">&nbsp;</p>
									</td>
									<td class='wallet_row tabletd_all tabletd_Lmall wallet_border'>
										<p style="color:#fff;" class="wallet_con_font1">&nbsp;</p>
									</td>
								<?}?>
							</tr>
						<?
							$listNo--;
						}
						?>
						<? if (!$totalList) { ?>
							<tr bgColor="white" align="center">
								<td class="border_none" height="100" colspan="14" style='text-align:center'>수익금 내역이 없습니다.</td>
							</tr>
						<? } ?>
					</table>
					<table width="100%" class="submenu">
						<tr>
							<td height="60" style='text-align:center' valign="middle">
								<? $page->my_point($totalPage, $totalList, $listScale, $pageScale, $startPage, "", "", "", ""); ?>
							</td>
						</tr>
						<tr>
							<td height="70" style='text-align:center' valign="middle">
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
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
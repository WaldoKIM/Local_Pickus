<?php
//include('../header.php');
include('/var/www/html/market/seller/headermin.php');
include($ROOT_DIR . "/lib/page_class.php");
//$_GET=&$HTTP_GET_VARS; 
//$_POST=&$HTTP_POST_VARS;

// 상품리뷰레벨 수정(level) 변수
if ($_POST[hidden_level_idx]) {
	$db->update("cs_goods_qna", "coment_check='$_POST[admin_auth]' where idx='$_POST[hidden_level_idx]'");
}
$mv_data	= $_GET[review_data];
$review_data	= $tools->decode($_GET[review_data]);
if ($_GET[idx]) {
	$idx = $_GET[idx];
} else {
	$idx = $review_data[idx];
}
if ($_GET[listNo]) {
	$listNo = $_GET[listNo];
} else {
	$listNo = $review_data[listNo];
}
if ($_GET[startPage]) {
	$startPage = $_GET[startPage];
} else {
	$startPage	= $review_data[startPage];
}
if ($_POST[search_item]) {
	$search_item = $_POST[search_item];
} else {
	$search_item	= $review_data[search_item];
}
if ($_POST[search_order]) {
	$search_order = $_POST[search_order];
} else {
	$search_order	= $review_data[search_order];
}
?>

<script language="JavaScript">
	<!--
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

	// 상품리뷰레벨수정
	function authChange(form_data) {
		form_data.submit();
	}

	// 상품리뷰정보 수정
	function reviewView(mv_data) {
		location.href = 'qna_view.php?review_data=' + mv_data;
	}

	// 상품리뷰정보 삭제
	function reviewDel(mv_data) {
		var choose = confirm('영구히 삭제 하시겠습니까?');
		if (choose) {
			location.href = 'qna_del_ok.php?review_data=' + mv_data;
		} else {
			return;
		}
	}
	////  회원에게 메일 보내기 ///////////////////////////////////////////////////////////////////////////////
	function userSendmailWinOpen(data) {
		window.open("../member/user_sendmail.php?user_mail=" + data, "", "scrollbars=no, width=484, height=500");
	}
	//
	-->
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
</script>



<div id="load">
	<div class="sns_content">
		<div class="sns_flex">
			<p>문의관리 가이드</p>
			<a href="#" onclick="snsClose();">X</a>
		</div>
		<div class="sns-go">
			<img class="sns_img" src="../img/qna_guide.png" alt="">
		</div>
	</div>
</div>
<div class="oolimbox-wrapper oolimbox-grid2">

	
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
														
															<tr height='20'>
																<a id="btn_toggle2">상품관리 가이드</a>
															</tr>
															
														
														<tr id="Toggle" style="display: none;">
															<td height="20">
																<!--도움말-->
																	<table width="100%" class='tipbox'>
																		<tr>
																			<td bgcolor="#E9F2F8">
																				<table width="100%">
																					<tr>
																						<td>
																							1. 문의 확인 후 답변을 작성해주세요.</br>
																						</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>
																<!--//도움말-->
															</td>
														</tr>
														
													</table>
													</td>
												</tr>
												<tr style="display:none;">
													<td class="link_btn_flex">
														<a style="color:#fff !important; background:#1379cd;" class="link_btn" href="https://repickus.com/market/seller/other/qna.php">상품문의GO</a>
														<a class="link_btn" href="https://repickus.com/market/seller/other/review.php">구매후기GO</a>
													</td>
												</tr>
											</table>
											<table width="100%">
												<form action="<?= $_SERVER[PHP_SELF]; ?>" method="post" name="review_form">
													<tr class="product_list_tr_flex">
														<td  class="product_list_stop_btn keyword_flex">
															<select name="search_item" class="src_select">
																<option value="1">상품이름</option>
																<option value="2">상품코드</option>
																<option value="3">리뷰제목</option>
																<option value="4"> 아 이 디</option>
															</select>
														</td>
													</tr>
													<tr class="product_list_tr_flex">
														<td class="product_list_stop_btn keyword_flex">
															<div class="search_form_search">
																<input class="search_input" name="search_order" type="text" class="formText" size="20" value="<?= $review_stat->title; ?>"> 
																<a href="javascript:search();" class='search_btn'><img src="/market/seller/img/search.png" alt=""></a>
															</div>
														</td>
														<td height="25" align="right"></td>
													</tr>
												</form>
											</table><br>
											<table width="100%" class="table_all qna_table_flex">
												<?
												$listScale			=	15; 		// 리스트갯수
												$pageScale		=	15;		// 페이지 갯수
												if (!$startPage) {
													$startPage = 0;
												}		// 스타트 페이지
												$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
												if ($search_item == 1) {
													$totalList	= $db->cnt("cs_goods_qna", "where goods_name like '%$search_order%' and seller='$_SESSION[USERID]'");
													$result		= $db->select("cs_goods_qna", "where goods_name like '%$search_order%' and seller='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale");
												} else if ($search_item == 2) {
													$totalList	= $db->cnt("cs_goods_qna", "where goods_code like '$search_order' and seller='$_SESSION[USERID]'");
													$result		= $db->select("cs_goods_qna", "where goods_code like '$search_order' and seller='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale");
												} else if ($search_item == 3) {
													$totalList	= $db->cnt("cs_goods_qna", "where title like '%$search_order%' and seller='$_SESSION[USERID]'");
													$result		= $db->select("cs_goods_qna", "where title like '%$search_order%' and seller='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale");
												} else if ($search_item == 4) {
													$totalList	= $db->cnt("cs_goods_qna", "where userid like '$search_order' and seller='$_SESSION[USERID]'");
													$result		= $db->select("cs_goods_qna", "where userid like '$search_order' and seller='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale");
												} else {
													$totalList	= $db->cnt("cs_goods_qna", "where seller='$_SESSION[USERID]'");
													$result		= $db->select("cs_goods_qna", "where seller='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale");
												}

												$form_name = 0; // 폼리스트 변수
												if ($startPage) {
													$listNo = $totalList - $startPage;
												} else {
													$listNo = $totalList;
												}		// 페이지넘버
												while ($row = mysqli_fetch_object($result)) {
													$form_name++; // 폼네임변경 숫자증가
													$member_stat = $db->object("cs_member", "where userid='$row->userid'", "email");
													$goods_stat = $db->object("cs_goods", "where idx='$row->goods_idx'");
													$review_data = $tools->encode("idx=" . $row->idx . "&startPage=" . $startPage . "&listNo=" . $listNo . "&search_item=" . $search_item . "&search_order=" . $search_order);
													$goods_data = $tools->encode("idx=" . $goods_stat->idx . "&part_idx=" . $goods_stat->part_idx);
													$order_img = $db->object("cs_goods", "where idx='$row->goods_idx'");
												?>
													<form name="form_<?= $form_name ?>" method="post" action="<?= $_SERVER[PHP_SELF]; ?>?review_data=<?= $review_data; ?>">
														<input type="hidden" name="hidden_level_idx" value="<?= $row->idx; ?>">
														<tr class="order_border">
															<td class='order_form'>
																<div class="product_list_form">
																	<img src="../../data/goodsImages/<?=$order_img->images1 ?>" border="0" class='resize_itemS' id='img<?= $row->idx; ?>' style='margin:5px auto;'>
																	<div class="product_list_content">
																		<p class="trade_font_bold"><?= $goods_stat->name; ?></p>
																		<p class="trade_font_nomal"><?= $row->title; ?></p>
																		<p class="trade_font_nomal"><?= $row->userid; ?></p>
																		<p class="trade_font_nomal"><?= $tools->strDateCut($row->register, 1); ?></p>

																		<select name="admin_auth" class="input input_design category_select" onChange="javascript:authChange(document.form_<?= $form_name ?>);">
																			<option value="1" <? if ($row->coment_check == 1) {
																									echo ("selected");
																								} ?>>답변완료</option>
																			<option value="0" <? if ($row->coment_check == 0) {
																									echo ("selected");
																								} ?>>미답변</option>
																		</select>
																	</div>
																</div>
																<div class="product_list_btn_form">
																	<a href="javascript:reviewView('<?= $review_data; ?>');" class="btn_guide2">답글달기</a>
																</div>
															</td>
														</tr>
													</form>
												<?
													$listNo--;
												}
												?>

												<? if (!$totalList) { ?>
													<tr bgColor="white">
														<td class="border_none" height="100" colspan="7" style='text-align:center'> 등록한 질문이 없습니다.</td>
													</tr>
												<? } ?>
											</table>
											<table width="100%" class="submenu">
												<tr>
													<td height="60" style='text-align:center' valign="middle"><? $page->review($totalPage, $totalList, $listScale, $pageScale, $startPage, "<img src='../images/prev.gif' border='0'>", "<img src='../images/next.gif' border='0'>", $search_item, $search_order); ?></td>
												</tr>
											</table>
											
											<table width="100%" class="submenu">
												<tr>
													<td height="60" style='text-align:center' valign="middle"></td>
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
	

</div>



<? include('../footer.php'); ?>
<? include('../seller_fixbar.php'); ?>
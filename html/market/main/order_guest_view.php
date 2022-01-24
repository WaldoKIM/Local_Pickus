<? include('./include/head.inc.php');?>
<?

if( !$_POST[order_name] || !$_POST[order_email] || !$_POST[trade_code]) { $tools->errMsg('올바른 정보를 입력해 주세요');}
if( !$db->cnt("cs_trade", "where order_name='$_POST[order_name]' and order_email='$_POST[order_email]' and trade_code='$_POST[trade_code]'")) { $tools->errMsg('주문내역이 없습니다\n\n다시 입력해 주세요');}
$trade_stat=$db->object("cs_trade", "where order_name='$_POST[order_name]' and order_email='$_POST[order_email]' and trade_code='$_POST[trade_code]'");
?>
<script language="javascript">
	function receiptView(tno)
	{
		receiptWin = "http://admin.kcp.co.kr/Modules/Sale/Card/ADSA_CARD_BILL_Receipt.jsp?c_trade_no=" + tno
		window.open(receiptWin , "" , "width=420, height=670")
	}
</script>
<div class="site-wrapper" id="box_wrapper">
	<!--상단로고, 가이드메뉴-->
	<? include('./include/top_guide.inc.php');?>
	<!--상단메뉴, 로테이트베너-->
	<? include('./include/top_menu.inc.php');?>
		<!--페이지 위치-->
		<div class="my_location">
			<ol class="breadcrumb titletxt_B">
				<li><a href="index.php" class="titletxt_A">Home</a></li>
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li>비회원 주문내역조회</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section order_check check_detail">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************내용영역 출력 시작********************-->
					<!--페이지서브메뉴-->
					<? include('./include/mymenu.inc.php');?>
					<!--페이지서브메뉴-->
					<div class="detail_list_area">
						<div class="list_data">
							<table class="area_tb">
								<!--타이틀-->
								<tr>
									<td class="top_tit">
										<?=$trade_stat->order_name;?>(님)으로<br/>
										<span>주문하신 내역</span>입니다.
									</td>
								</tr>
								<!--//타이틀-->
								<tr>
									<td height="35px"></td>
								</tr>
								<tr>
									<td height="1px" bgcolor="#ccc"></td>
								</tr>
								<tr>
									<td height="35px"></td>
								</tr>
								<!--상단정보-->
								<tr>
									<td class="top_info">
										<table>
											<tr>
												<th>고객명</th>
												<td><?=$trade_stat->order_name;?></td>
											</tr>
											<tr>
												<th>주문번호</th>
												<td><span><?=$trade_stat->trade_code;?></span></td>
											</tr>
											<tr>
												<th>주문일자</th>
												<td><?=$trade_stat->trade_day;?></td>
											</tr>
										</table>
									</td>
								</tr>
								<!--//상단정보-->
								<tr>
									<td height="35px"></td>
								</tr>
								<!--결제정보-->
								<tr>
									<td class="payment_info">
										<table>
											<tr>
												<th colspan="2">결제정보</th>
											</tr>
											<tr>
												<td colspan="2" height="2" bgcolor="#222"></td>
											</tr>
											<tr>
												<td colspan="2" height="20px"></td>
											</tr>
											<tr>
												<td class="left">총 주문금액</td>
												<td class="right"><?=number_format($trade_stat->trade_total_price);?>원</td>
											</tr>
											<tr>
												<td class="left">배송비</td>
												<td class="right"><?=number_format($trade_stat->trade_deliv_price);?>원</td>
											</tr>
											<tr>
												<td class="left" style="padding-bottom:20px">결제수단</td>
												<td class="right" style="padding-bottom:20px">
													<? if($trade_stat->trade_method==1){;?>카드결제
													<?if($trade_stat->tno != ""){?>
													&nbsp;&nbsp;<input type="button" name="receiptView" value="영수증 확인" class="box" onClick="javascript:receiptView('<?=$trade_stat->tno?>')">
													<?}?>
													<?} else if($trade_stat->trade_method==2){;?>계좌이체<?} else if($trade_stat->trade_method==3){;?>휴대폰결제
													<?} else if($trade_stat->trade_method==4){;?>가상계좌 : <?=$trade_stat->trade_method_info;?><?} else if($trade_stat->trade_method==5){;?>무통장입금<?} else if($trade_stat->trade_method==6){;?>포인트결제<?}?>
												</td>
											</tr>
											<tr class="total">
												<td class="left">최종결제금액</td>
												<td class="right"><?=number_format($trade_stat->trade_price);?>원</td>
											</tr>
										</table>
									</td>
								</tr>
								<!--//결제정보-->
								<tr>
									<td height="35px"></td>
								</tr>
								<!--배송정보-->
								<tr>
									<td class="delivery_info">
										<table>
											<tr>
												<th>배송정보</th>
											</tr>
											<tr>
												<td height="2" bgcolor="#222"></td>
											</tr>
											<tr>
												<td height="20px"></td>
											</tr>
											<tr>
												<td>
													<table>
														<tr>
															<td class="cell_h">수령인</td>
															<td><?=$trade_stat->deliv_name;?></td>
														</tr>
														<tr>
															<td class="cell_h">연락처</td>
															<td><?=$trade_stat->deliv_tel1;?>-<?=$trade_stat->deliv_tel2;?>-<?=$trade_stat->deliv_tel3;?></td>
														</tr>
														<tr>
															<td class="cell_h">휴대폰</td>
															<td><? if($trade_stat->deliv_phone1){?><?=$trade_stat->deliv_phone1;?>-<?=$trade_stat->deliv_phone2;?>-<?=$trade_stat->deliv_phone3;?><?}?></td>
														</tr>
														<tr>
															<td class="cell_h" style="vertical-align:top">배송지</td>
															<td style="line-height:1.2em">
																(<?=$trade_stat->deliv_zip;?>)<br/>
																<?=$trade_stat->deliv_add1;?><br/>
																<?=$trade_stat->deliv_add2;?>
															</td>
														</tr>
														<tr>
															<td class="cell_h">주문 사항</td>
															<td><?=$trade_stat->deliv_content;?></td>
														</tr>
														<tr>
															<td class="cell_h">배송예약일</td>
															<td><? if($trade_stat->deliv_pree_day!='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_stat->deliv_pree_day, 5);?><?}?></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td height="20px"></td>
											</tr>
											<tr>
												<td height="1" bgcolor="#ccc"></td>
											</tr>
										</table>
									</td>
								</tr>
								<!--//배송정보-->
								<tr>
									<td height="35px"></td>
								</tr>
								<!--주문상품-->
								<tr>
									<td class="prd_info">
										<table>
											<tr>
												<th colspan="2">주문상품</th>
											</tr>
											<tr>
												<td colspan="2" height="2" bgcolor="#222"></td>
											</tr>
											<!--주문상품 목록-->
											<tr>
												<td colspan="2" class="order_list">
													<?
													$trade_goods_result=$db->select("cs_trade_goods", "where trade_code='$trade_stat->trade_code' order by idx asc");
													while( $trade_goods_row=@mysqli_fetch_object( $trade_goods_result)) {
														$goods_stat=$db->object("cs_goods", "where idx=$trade_goods_row->goods_idx", "goods_file");
														$goods_data = $tools->encode("idx=".$trade_goods_row->goods_idx."&part_idx=".$goods_stat->part_idx);
													?>
													<ul>
														<li class="name">
															<a href="product_view.php?part_idx=<?=$trade_goods_row->part_idx;?>&goods_data=<?=$goods_data;?>" target="_blank"><?=$db->stripSlash($trade_goods_row->goods_name);?></a>&nbsp;
															<? if( $goods_stat->goods_file && $trade_stat->trade_stat==4) {?>
															<a href="goods_download.php?trade_idx=<?=$trade_stat->idx;?>&trade_goods_idx=<?=$trade_goods_row->goods_idx;?>" target="_blank"><img src="images/bt_file.gif" border="0" align="absmiddle"></a>
															<?} else if( $goods_stat->goods_file  ){?>
															<img src="images/bt_file.gif" border="0" align="absmiddle">
															<?}?>
														</li>
														<li class="price_each">
															<table>
																<tr>
																	<td class="left">금액</td>
																	<td class="right"><?=number_format($trade_goods_row->goods_price);?>원</td>
																</tr>
																<tr>
																	<td class="left">수량</td>
																	<td class="right"><?=number_format($trade_goods_row->goods_cnt);?>개</td>
																</tr>
															</table>
														</li>
													</ul>
													<?}?>
												</td>
											</tr>
											<!--//주문상품 목록-->
											<tr class="final_payment">
												<td class="text1">최종결제금액</td>
												<td class="text2"><span><?=number_format($trade_stat->trade_price);?></span>원</td>
											</tr>
										</table>
									</td>
								</tr>
								<!--//주문상품-->
							</table>
						</div>
						<table style='margin:0 auto;' class="bottom_btn">
							<tr>
								<td style='text-align:center;' height="75"><a href="order_guest.php" class="oolimbtn-botton1" style="width:150px">다른상품조회</a></td>
							</tr>
						</table>
					</div>
					<!--********************내용영역 출력 끝********************-->
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->
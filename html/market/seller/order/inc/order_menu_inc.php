<table width="180">
	<tr>
		<td>

			<table width="180">
				<tr>
					<td class='table_border1'>
						<!----------메뉴시작------->
						<table width="100%">
							<tr class='table_border1'>
								<td class='table_padding1 table_border2'>
									<table border="0" width="96%">
										<?
										$totalCnt1	= $db->cnt(cs_trade_goods, "where (trade_stat=1 OR trade_stat=0) and seller='$_SESSION[USERID]' ");
										$totalCnt2	= $db->cnt(cs_trade_goods, "where trade_stat=2 and seller='$_SESSION[USERID]' ");
										$totalCnt3	= $db->cnt(cs_trade_goods, "where trade_stat=3 and seller='$_SESSION[USERID]' ");
										$totalCnt4	= $db->cnt(cs_trade_goods, "where trade_stat=4 and seller='$_SESSION[USERID]' ");
										$totalCnt5	= $db->cnt(cs_trade_goods, "where trade_stat=5 and seller='$_SESSION[USERID]' ");
										$totalCnt51	= $db->cnt(cs_trade_goods, "where trade_stat=51 and seller='$_SESSION[USERID]' ");
										$totalCnt52	= $db->cnt(cs_trade_goods, "where trade_stat=52 and seller='$_SESSION[USERID]' ");
										$totalCnt	= $db->cnt(cs_trade_goods, "where seller='$_SESSION[USERID]'");
										?>
										<tr>
											<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=1">결제대기</a>(<span style="font-size:20px; color:#ffffff;"><?= $totalCnt1; ?></span>)</td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="1" bgcolor='C9CED1'></td>
										</tr>
										<tr>
											<td height="1" bgcolor='F5F5F5'></td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=2">결제확인</a>(<span style="font-size:20px; color:#ffffff;"><?= $totalCnt2; ?></span>)</td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="1" bgcolor='C9CED1'></td>
										</tr>
										<tr>
											<td height="1" bgcolor='F5F5F5'></td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=3">배송상태</a>(<span style="font-size:20px; color:#ffffff;"><?= $totalCnt3; ?></span>)</td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="1" bgcolor='C9CED1'></td>
										</tr>
										<tr>
											<td height="1" bgcolor='F5F5F5'></td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=4">판매완료</a>(<span style="font-size:20px; color:#ffffff;"><?= $totalCnt4; ?></span>)</td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="1" bgcolor='C9CED1'></td>
										</tr>
										<tr>
											<td height="1" bgcolor='F5F5F5'></td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=5">취소요청</a>(<span style="font-size:20px; color:#ffffff;"><?= $totalCnt5; ?></span>)</td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="1" bgcolor='C9CED1'></td>
										</tr>
										<tr>
											<td height="1" bgcolor='F5F5F5'></td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=51">환불대기</a>(<span style="font-size:20px; color:#ffffff;"><?= $totalCnt51; ?></span>)</td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="1" bgcolor='C9CED1'></td>
										</tr>
										<tr>
											<td height="1" bgcolor='F5F5F5'></td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=52">환불완료</a>(<span style="font-size:20px; color:#ffffff;"><?= $totalCnt52; ?></span>)</td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="1" bgcolor='C9CED1'></td>
										</tr>
										<tr>
											<td height="1" bgcolor='F5F5F5'></td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
										<tr>
											<td height="17" class='leftmenu_icon1'><a href="../order/trade.php">전체검색</a>(<span style="font-size:20px; color:#ffffff;"><?= $totalCnt; ?></span>)</td>
										</tr>
										<tr>
											<td height="3"></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>

						<!----------메뉴끝------->
					</td>
				</tr>
			</table>


		</td>
	</tr>
	<tr>
		<td height="17"></td>
	</tr>
	<tr>
		<td><? include('../lefttable.php'); ?></td>
	</tr>
	<tr>
		<td height="17"></td>
	</tr>
</table>
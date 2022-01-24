<? 
include('../header.php');
include($ROOT_DIR."/lib/page_class.php");

$today_cnt = $db->row("cs_connect", "where DATE_FORMAT(register,'%Y-%m-%d')=CURDATE()", "count(DISTINCT ip)");
$total_cnt = $db->row("cs_connect", "", "count(DISTINCT ip)");
//디비 용량체크
$qry       = $db->result("show table status");
while($fet = mysqli_fetch_array($qry)){
	$table_num      += 1;
	$record_num     += $fet['Rows'];
	$avg_record_num += $fet['Avg_row_length'];
	$data_num       += $fet['Data_length'];
	$index_num      += $fet['Index_length'];
}


//계정사용량 체크
@$data = shell_exec( "du -k $ROOT_DIR" );
$o_list = explode( "\n", trim($data) );
$length = sizeof($o_list);

$data = explode( "..", $o_list[$length-1] );
$total = $data[0];

?>

<!--한영전환 패치-->
<script>
//	swfRunner("./han_eng_change.swf", "han_eng_change", "0", "0");
</script>
<!--한영전환 패치-->

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td height="15"></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="180" valign="top" class='noneoolim'>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td>
						<?include('inc/sub_menu_inc.php');?>
					</td>
				</tr>
			</table>
		</td>
		<td width="30" class='noneoolim'></td>
		<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td valign="top" style="padding:10;">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td height="20" class='sub_titleL'>
												<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5"><b>관리자메인페이지</b>
											</td>
										</tr>
										<tr>
											<td height="1" bgcolor="#dddddd"></td>
										</tr>
										<tr>
											<td height="25"></td>
										</tr>
										<tr>
											<td height="60" style='text-align:center;'>고객님이 현재 <!--사용하고 있는 총 용량은 <b><font color="#FF6600"><?=round($total/1024,1);?> M</font></b>&nbsp;이며,&nbsp;&nbsp;-->사용하고 있는 DB 용량은 <b><font color="#FF6600"><?=$tools->check_bytes($data_num,0);?></font></b>&nbsp;입니다.  </td>
										</tr>
										<tr>
											<td class="padding_5">
												<table cellpadding="0" cellspacing="0" width="100%">
													<tr>
														<td>
															<!--콘텐츠출력-->
															<table width="100%" style='text-align:center; margin:0 auto' class='noneoolimmo'>
																<tr>
																	<td valign='top'>

																			<div id="customertable_divcont">
																				<div id="customertable_divLeft_view1">
																					<div class="customertable_divLeft  customertable_padding1">
																						<table cellpadding="0" cellspacing="0" width="100%">
																							<tr>
																								<td bgcolor="495164" style='border-radius:5px; height:40px; padding-left:20px;' class='main_titleL'>많이 사용하는 설정 항목</td>
																							</tr>
																							<tr>
																								<td>
																									<table style='text-align:center; margin:0 auto'>
																										<tr style='padding-top:10px;'>
																											<td class='f08' style='padding:1px;padding-top:10px;text-align:center;'><a href="../category/category_list.php"><img src="../img/main_quicklink1.png" border="0" class='resizeS'><br>카테고리관리</a></td>
																											<td class='f08'  style='padding:1px;padding-top:10px;text-align:center;'><a href="../design/main_flash.php"><img src="../img/main_quicklink2.png" border="0" class='resizeS'><br>기획전관리</a></td>
																											<td class='f08'  style='padding:1px;padding-top:10px;text-align:center;'><a href="../design/banner.php"><img src="../img/main_quicklink3.png" border="0" class='resizeS'><br>베너관리</a></td>
																											<td class='f08'  style='padding:1px;padding-top:10px;text-align:center;'><a href="../category/page.php"><img src="../img/main_quicklink4.png" border="0" class='resizeS'><br>HTML페이지관리</a></td>
																											<td class='f08'  style='padding:1px;padding-top:10px;text-align:center;'><a href="../bbs/bbs_admin.php"><img src="../img/main_quicklink5.png" border="0" class='resizeS'><br>게시판종합관리</a></td>

																											<td class='f08'  style='padding:1px;padding-top:10px;text-align:center;'><a href="../member/member.php"><img src="../img/main_quicklink6.png" border="0" class='resizeS'><br>회원관리</a></td>
																											<td class='f08'  style='padding:1px;padding-top:10px;text-align:center;'><a href="../design/popup.php"><img src="../img/main_quicklink7.png" border="0" class='resizeS'><br>팝업창설정</a></td>
																											<td class='f08'  style='padding:1px;padding-top:10px;text-align:center;'><a href="../basic/basic_setup.php"><img src="../img/main_quicklink8.png" border="0" class='resizeS'><br>기본설정</a></td>
																											<td class='f08'  style='padding:1px;padding-top:10px;text-align:center;'><a href="../order/trade.php"><img src="../img/main_quicklink9.png" border="0" class='resizeS'><br>주문관리</a></td>
																											<td class='f08'  style='padding:1px;padding-top:10px;text-align:center;'><a href="../product/product_list.php"><img src="../img/main_quicklink10.png" border="0" class='resizeS'><br>제품관리</a></td>
																										</tr>
																									</table>
																								</td>
																							</tr>
																						</table>

																					</div> 
																				</div> 

																			</div> 
																			
																	</td>
																</tr>
																<tr>
																	<td height="30"></td>
																</tr>
															</table>
															<!--콘텐츠출력1-->

																		<?
																		// 주문건수
																		$trade_today=$db->cnt("cs_trade", "where DATE_FORMAT(trade_day,'%Y-%m-%d')=CURDATE()");
																		$trade_total=$db->cnt("cs_trade", ""); 
																		?>

																		<table style='text-align:center; margin:0 auto' width="100%">
																			<tr>
																				<td height="28"  class='main_titleL' bgcolor="495164" style='border-radius:5px; height:40px; padding-left:20px;'>
																				<table width="100%">
																				<tr>
																					<td class='main_titleO'>오늘의 주문리스트&nbsp;&nbsp;( today <?=$trade_today;?> / total <?=$trade_total;?> )</td>
																					<td class='main_titleO'  style='border-radius:5px; height:40px; padding-right:20px;text-align:right; '><a href='../order/trade.php?trade_stat=1'  class='searchB_more'>전체보기</td>
																				</tr>
																				</table>
																				</td>
																			</tr>
																		</table>

																		<table cellpadding="0" cellspacing="0" width="100%">
																			<tr>
																				<td height="10">
																				</td>
																			</tr>
																		</table>

																		<table style='text-align:center; margin:0 auto' width="100%">
																			<tr align="center" bgcolor="E4E7EF"> 
																				<td height="35" class='contenM'>주문번호</td>
																				<td height="" class='contenM'>주문자</td>
																				<td height="35" class='contenM'>전화번호</td>
																				<td  height="35" class='contenM'>결제방법</td>
																				<td height="" class='contenM'>결제금액</td>
																				<td height="" class='contenM'>거래상태</td>
																				<td class='contenM'>주문날짜</td>
																			</tr>
																			<?
																			// 오늘의 주문 목록
																			$trade_result=$db->select("cs_trade", "where DATE_FORMAT(trade_day,'%Y-%m-%d')=CURDATE() order by idx desc");
																			while($trade_row=@mysqli_fetch_object( $trade_result )) {
																			?>
																			<tr align="center"> 
																				<td height="30" class='contenM'><?=$trade_row->trade_code;?></td>
																				<td height="30" class='contenM'><?=$trade_row->order_name;?></td>
																				<td height="30" class='contenM'><?=$trade_row->order_tel1;?> - <?=$trade_row->order_tel2;?> - <?=$trade_row->order_tel3;?></td>
																				<td height="30" class='contenM'><? if($trade_row->trade_method==1){;?>카드결제<?} else if($trade_row->trade_method==2){;?>계좌이체<?} else if($trade_row->trade_method==3){;?>휴대폰결제<?} else if($trade_row->trade_method==4){;?>가상계좌<?} else if($trade_row->trade_method==5){;?>무통장입금<?} else if($trade_row->trade_method==6){;?>포인트결제<?}?></td>
																				<td height="30" class='contenM'><?=$trade_row->trade_price;?></td>
																				<td height="30" class='contenM'><? if($trade_row->trade_stat==1) {?>결제대기중<?} else if($trade_row->trade_stat==2){?>결제확인됨<?} else if($trade_row->trade_stat==3){?>상품배송중<?} else if($trade_row->trade_stat==4){?>판매완료됨<?}?></td>
																				<td height="30" class='contenM'><?=$tools->strDateCut($trade_row->trade_day, 6);?></td>
																			</tr>
																			<?}?>
																		
																			<? if(!$trade_today) {?>
																			<!-- 주문이 없을경우 -->
																			<tr> 
																				<td height="100" colspan="7" style='text-align:center;'>금일 주문내역이 없습니다.</td>
																			</tr>
																			<?}?>
																		</table>
															<!--콘텐츠출력1-->

															<!--콘텐츠출력2-->												
															<div id="customertable_divcont">
																	<div id="customertable_divLeft_view">
																		<div class="customertable_divLeft  customertable_padding1">
																			<!-- 최고인기상품 -->
																			<table style='text-align:center; margin:0 auto' width="100%">
																				<tr>
																					<td bgcolor="495164" style='border-radius:5px; height:40px; padding-left:20px;'  class='main_titleL'>최고인기상품 Best15</td>
																				</tr>
																			</table>
																			<table cellpadding="0" cellspacing="0" width="100%">
																				<tr>
																					<td height="10">
																					</td>
																				</tr>
																			</table>
																			<table width="100%" style='text-align:center; margin:0 auto'>
																				<tr bgcolor="898F98"> 
																					<td width="50" height="30" class="tmb"><font color='ffffff'>순위</font></td>
																					<td height="30" class="tmb"><font color='ffffff'>제품명</font></td>
																					<td width="80" height="30" class="tmb"><font color='ffffff'>판매가격</font></td>
																					<td width="50" class="tmb"><font color='ffffff'>조회수</font></td>
																				</tr>
																				<?
																				$best_goods_result=$db->select("cs_goods", "order by click desc limit 15");
																				while($best_goods_row=@mysqli_fetch_object( $best_goods_result )) {
																					if($best_goods_no%2) { $bg_color="FFFFFF";	} else {	$bg_color="F8F0E6";}
																				?>
																				<tr bgcolor="<?=$bg_color;?>"> 
																					<td width="50" height="30" class="tmb"><?=++$best_goods_no;?></td>
																					<td height="30"  class="tmb"><?=$tools->strCut($best_goods_row->name, 45);?></td>
																					<td width="80" height="30" class="tmb"><?=number_format($best_goods_row->shop_price);?></td>
																					<td width="50" class="tmb menublue"><?=number_format($best_goods_row->click);?></td>
																				</tr>
																				<?}?>
																			</table>
																		</div> 
																	</div> 

																	<div id="customertable_divcenter_1_view">
																		<div class="customertable_divcenter_1">
																			<table style='text-align:center; margin:0 auto' width="100%">
																				<tr>
																					<td bgcolor="495164" style='border-radius:5px; height:40px; padding-left:20px;' class='main_titleL'>최다판매상품 Best15</td>
																					</td>
																				</tr>
																			</table>
																			<table cellpadding="0" cellspacing="0" width="100%">
																				<tr>
																					<td height="10">
																					</td>
																				</tr>
																			</table>
																			<table width="100%" style='text-align:center; margin:0 auto'>
																				<tr bgcolor="898F98"> 
																					<td width="50" height="30" class="tmb"><font color='ffffff'>순위</font></td>
																					<td height="30" class="tmb"><font color='ffffff'>제품명</font></td>
																					<td width="80" height="30" class="tmb"><font color='ffffff'>판매가격</font></td>
																					<td width="50" class="tmb"><font color='ffffff'>매수</font></td>
																				</tr>
																				<?
																				$trade_goods_result=$db->result("select sum(goods_cnt), goods_code, goods_price, goods_name from cs_trade_goods  group by goods_code order by 1 desc limit 15");
																				while($trade_goods_row=@mysqli_fetch_array( $trade_goods_result )) {
																					if($trade_goods_no%2) { $bg_color="FFFFFF";} else { $bg_color="E8F1DF";}
																				?>
																				<tr bgcolor="<?=$bg_color;?>"> 
																					<td width="50" height="30" class="tmb"><?=++$trade_goods_no;?></td>
																					<td height="30" class="tmb"><?=$tools->strCut($trade_goods_row[3], 45);?></td>
																					<td width="80" height="30" class="tmb"><?=number_format($trade_goods_row[2]);?></td>
																					<td width="50" class="tmb menublue"><?=number_format($trade_goods_row[0]);?></td>
																				</tr>
																				<?}?>
																			</table>
																		</div>
																	</div>
																</div> 
															<!--콘텐츠출력2-->

															<!--콘텐츠출력3-->
															
															<table width="100%" style='text-align:center; margin:0 auto'>
																<tr>
																	<td height='30'></td>
																</tr>
																<tr>
																	<td><img src="../img/customizing_img.png" width="397" border='0' class='resizeS customizing_img'></td>
																	<td>
																	<table>
																		<tr>
																			<td class='sub_titleO'>프로그램 추가및 수정이 필요하세요?</td>
																		</tr>
																		<tr>
																			<td class='sub_titleS'>내가 구매한 솔루션에 새로운 기능이 필요하신 경우<br>(주)우림아이에스와 상담해 보세요. 원하는 기능들을 빠른시간내에 작업해 드립니다.</td>
																		</tr>
																		<tr>
																			<td>기타 자세한 문의는 <b>(주)우림아이에스 고객센터 02-338-0384</b>으로 상담해 주시기 바랍니다.<br>솔루션 기능 추가 관련 상담은 오전 11시부터 가능합니다.</td>
																		</tr>
																	</table>
																	</td>
																</tr>
															</table>
															

															<!--콘텐츠출력3-->
														</td>
													</tr>
													<tr>
														<td height="30"></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<? include('../footer.php'); ?>

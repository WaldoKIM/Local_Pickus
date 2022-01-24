<? include('./include/head.inc.php');?>
<?
// 회원체크
if( !$_SESSION[USERID] || !$_SESSION[PASSWD] ) {
	// 로그인 상태가 아니면 회원 로그인으로 보낸다
	//$tools->javaGo('login.php?login_go='.$_SERVER[REQUEST_URI]);
	$tools->metaGo('../../bbs/login.php?login_go=mypage.php');
}
	// 거래 정보 수정
	$mv_data	= $_GET[trade_data];
	$trade_data	= $tools->decode( $_GET[trade_data] );
	if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $trade_data[idx]; }
	if($_GET[listNo] )					{ $listNo = $_GET[listNo]; }									else { $listNo = $trade_data[listNo]; }
	if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $trade_data[startPage]; }
?>
<script language="JavaScript">
	<!--
	// 거래정보보기
	function tradeView( mv_data ) {
		location.href='my_order_view.php?trade_data='+mv_data;
	}
	//-->
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
				<li><i class="fas fa-arrow-left"></i>마이페이지</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section order_check login_check_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************내용영역 출력 시작********************-->
					<!--페이지서브메뉴-->
					<? include('./include/mymenu.inc.php');?>
					<!--페이지서브메뉴-->
					<div class="main" style="text-align:left;">
						<h2 class="tit"  style="text-align:center;">마이페이지</h2>
						<span class="product-viewboxM"><i class='fa-certificate_color fa-chevron-circle-right'></i>회원정보</span>
						<!---------회원정보출력------------->
						<div class='my_orderview_pc'>
							<table width="100%">
								<tr>
									<td align="center">
										<table width="100%" class="jointable_all">
											<tr>
												<td align="center">
													<? $mem_row = $db->object("cs_member", "where userid='$_SESSION[USERID]' and passwd='$_SESSION[PASSWD]'");?>
													<table width="100%">
														<tr class='jointable_td'>
															<?/*
															<td width="80" style='text-align:center;' bgcolor='efefef' class='oolimmobilemenuM'>주소</td>
															<td style='padding-left:10px;'>
															<?=$mem_row->add1;?> <?=$mem_row->add2;?>
															</td>
															<td width="80" style='text-align:center;' bgcolor='efefef' class='oolimmobilemenuM'>전화</td>
															
															<td style='padding-left:10px;'><?=$mem_row->tel1;?>-<?=$mem_row->tel2;?>-<?=$mem_row->tel3;?></td>
															*/?>
															<td width="80" bgcolor='efefef' style='text-align:center;' class='oolimmobilemenuM'>휴대폰</td>
															<td colspan="3" style='padding-left:10px;'><?=$mem_row->phone1;?> <?=$mem_row->phone2;?> <?=$mem_row->phone3;?></td>
														</tr>
														<tr class='jointable_td'>
															<td width="80" style='text-align:center;' bgcolor='efefef' class='oolimmobilemenuM'>이메일</td>
															<td style='padding-left:10px;'><?=$mem_row->email;?></td>
															<td width="80" style='text-align:center;' bgcolor='efefef' class='oolimmobilemenuM'>적립금</td>
															<td style='padding-left:10px;'><? $total_point = $db->sum("cs_point", "where userid='$_SESSION[USERID]'", "point"); echo(number_format($total_point));?>원
															</td>
															<td></td><td></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="1" bgcolor='333333'></td>
								</tr>
							</table>
						</div>
						<div class='my_orderview_mobile'>
							<table width="100%">
								<tr>
									<td>
										<table width="100%" class="jointable_all">
											<? $mem_row = $db->object("cs_member", "where userid='$_SESSION[USERID]' and passwd='$_SESSION[PASSWD]'");?>
											<?/*
											<tr>
												<td class="order-viewboxIcon jointable_td_border4">주소 : <?=$mem_row->add1;?> <?=$mem_row->add2;?></td>
											</tr>
											<tr>
												<td class="order-viewboxIcon jointable_td_border4">전화 : <?=$mem_row->tel1;?>-<?=$mem_row->tel2;?>-<?=$mem_row->tel3;?></td>
											</tr>
											*/?>
											<tr>
												<td class="order-viewboxIcon jointable_td_border4">휴대폰 : <?=$mem_row->phone1;?>-<?=$mem_row->phone2;?>-<?=$mem_row->phone3;?></td>
											</tr>
											<tr>
												<td class="order-viewboxIcon jointable_td_border4">이메일 : <?=$mem_row->email;?></td>
											</tr>
											<tr>
												<td class="order-viewboxIcon jointable_td_border4"'>적립금 : <? $total_point = $db->sum("cs_point", "where userid='$_SESSION[USERID]'", "point"); echo(number_format($total_point));?>원</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="1" bgcolor='333333'></td>
								</tr>
							</table>
						</div>
						<!---------회원정보출력------------->
					  </td>
					</tr>
					<tr>
					  <td valign="top" height="60">
					  </td>
					</tr>
					<tr>
					  <td valign="top">
						<div class='spaceline01'></div>
						<span class="product-viewboxM"><i class='fa-certificate_color fa-chevron-circle-right'></i>최근주문내역</span>
						<!-------주문내역조회--------->
						<table width="100%">
							<tr>
								<td>
									<table width="100%" class="jointable_all">
										<tr align="center" height="37">
											<td bgcolor="F3F3F3" style='text-align:center' height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB noneoolim_del'>
												No
											</td>
											<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB noneoolim_del'>
												주문번호
											</td>
											<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB noneoolim_del2'>
												주문일자
											</td>
											<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>
												서비스
											</td>
											<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB noneoolim_del2'>
												결제금액
											</td>
											<td width='15%' height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>
												진행상태<span class='noneoolim_del3'>주문일자</span>
											</td>
										</tr>
										<?
										$table				= "cs_trade_goods";
										$listScale			=	5; 		// 리스트갯수
										$pageScale		=	10;		// 페이지 갯수
										if( !$startPage ) {
										$startPage = 0;
										}
										// 스타트 페이지
										$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
										$totalList	= $db->cnt( $table, "where order_userid='$_SESSION[USERID]'" );
										$result		= $db->select( $table, "where order_userid='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale" );
										if( $startPage ) {
										$listNo = $totalList - $startPage;
										}
										else {
										$listNo = $totalList;
										}
										// 페이지넘버
										for($i=$startPage; $i<$startPage+$listScale; $i++) {
										// 루프 시작
										if( $i < $totalList ) {
										$my_trade_row = mysqli_fetch_object($result);
										$trade_data = $tools->encode("idx=".$my_trade_row->idx."&startPage=".$startPage."&listNo=".$listNo);
										?>
										<tr id='calendar_list_tableTD_on'>
											<td width="55" class='calendar_list_tableTD_bg noneoolim_del' style='text-align:center;'>
												<?=$listNo;?>
											</td>
											<td height="45" class='calendar_list_tableTD_bg noneoolim_del' style='text-align:center;'>
												<a href="javascript:tradeView('<?=$trade_data;?>');"><?=$my_trade_row->trade_code;?></a>
											</td>
											<td height="45" style='text-align:center;padding:3px;' class='calendar_list_tableTD_bg noneoolim_del2'>
												<?=$tools->strDateCut($my_trade_row->trade_day, 1);?>
											</td>
											<td height="45" style='text-align:center;padding:3px;' class='calendar_list_tableTD_bg'>
												<?
												$itemN="";
												$trade_goods_result=$db->select("cs_trade_goods", "where trade_code='$my_trade_row->trade_code' order by idx asc");
												while( $trade_goods_row=@mysqli_fetch_object( $trade_goods_result)) {
												$goods_stat=$db->object("cs_goods", "where idx=$trade_goods_row->goods_idx", "goods_file");
												$goods_data = $tools->encode("idx=".$trade_goods_row->goods_idx."&part_idx=".$goods_stat->part_idx);
												$itemN++;
												if($itemN > 1) echo "<div class='spaceline07'></div>";
												?>
												<a href="javascript:tradeView('<?=$trade_data;?>');"><?=$tools->strCut($db->stripSlash($trade_goods_row->goods_name), 100);?></a>&nbsp;<a href="product_view.php?part_idx=<?=$trade_goods_row->part_idx;?>&goods_data=<?=$goods_data;?>" class='Btn_orderlist5'>상품평작성</a>
												<?}?>
											</td>
											<td height="45" style='text-align:center;padding:3px;' class='calendar_list_tableTD_bg price noneoolim_del2'><?=number_format($my_trade_row->trade_price);?>원</td>
											<td height="45" style='text-align:center;padding:3px;' class='calendar_list_tableTD_bgright'>
												<span class='bbs1_1 noneoolim_del3'><?=$tools->strDateCut($my_trade_row->trade_day, 1);?></span>
												<span class='item_list_block noneoolim_del3'><?=number_format($my_trade_row->trade_price);?>원</span>
												<? if($my_trade_row->trade_stat==1) {?><span class='Btn_orderlist1'>결제대기</span>
												<?} else if($my_trade_row->trade_stat==2){?><span class='Btn_orderlist2'>결제확인</span>
												<?} else if($my_trade_row->trade_stat==3){?><span class='Btn_orderlist3'>배송중</span>
												<?} else if($my_trade_row->trade_stat==4){?><span class='Btn_orderlist4'>판매완료</span>
												<?} else if($my_trade_row->trade_stat==5){?><span class='Btn_orderlist3'>취소요청중</span>
												<?} else if($my_trade_row->trade_stat==51){?><span class='Btn_orderlist4'>환불대기중</span>
												<?} else if($my_trade_row->trade_stat==52){?><span class='Btn_orderlist4'>취소/환불완료</span>
												<?}?>
											</td>
										</tr>
										<?
										}
										$listNo--;
										}
										?>
										<? if( !$totalList ) { ?>
										<tr>
											<td height="100" colspan="11" align="center">거래 내역이 없습니다.</td>
										</tr>
										<? }?>
									</table>
								</td>
							</tr>
						</table>
						<!-------주문내역조회--------->
					  </td>
					</tr>
					<tr>
					  <td valign="top" height="60">
					  </td>
					</tr>
					<tr>
					  <td valign="top">
						<div class='spaceline01'></div>
						<span class="product-viewboxM"><i class='fa-certificate_color fa-chevron-circle-right'></i>내가찜한상품</span>
						<!-------내가찜한상품--------->
						<table width="100%">
							<tr>
							  <td align="center">
								<table width="100%" class="jointable_all">
									<tr>
										<td bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td noneoolim_del">
											No
										</td>
										<td bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">
											상품명
										</td>
										<td bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">
											가격
										</td>
										<td bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td noneoolim_del">
											포인트
										</td>
										<td bgcolor="F3F3F3" style='text-align:center' class="oolimmobilemenuM jointable_td">
											합 계
										</td>
									</tr>
									<?
										$wishlist_result=$db->select("cs_wishlist", "where userid='$_SESSION[USERID]' and userid is not null order by idx asc");
										$total_goods_price=0;  // 총금액
										$total_goods_point=0;  // 총포인트
										$form_cnt=0;
										while($wishlist_row=@mysqli_fetch_object($wishlist_result)) {
											$form_cnt++;
											// 총금액
											$total_goods_price+=$wishlist_row->goods_price*$wishlist_row->goods_cnt;
											// 총포인트
											$total_goods_point+=$wishlist_row->goods_price*$wishlist_row->goods_cnt*$wishlist_row->goods_point*0.01;
											// 따음표나 공백 복원
											$goods_name=stripslashes($wishlist_row->goods_name);
											$option1_select=stripslashes($wishlist_row->option1_select);
											$option2_select=stripslashes($wishlist_row->option2_select);
											// 기본 데이타 엔코딩
											$goods_data = $tools->encode("idx=".$wishlist_row->goods_idx."&part_idx=".$wishlist_row->part_idx);
											// 옵션 레이어 설정
											$LAYER_TOP=5;    //레이어 높이 설정
											$LAYER_TR= 27;		// 레이어의 출력 간격 * 줄과 같이 출력할경우는 $form_cnt 를 곱한다.
											$layer_top= $LAYER_TOP + ($LAYER_TR*$form_cnt);
										?>
									<form name="form_<?=$form_cnt;?>">
									<tr>
										<td width="15" height="45" style='text-align:center;padding:3px;' class='jointable_td noneoolim_del'><?=$form_cnt;?></td>
										<td height="45" style='text-align:center;padding:3px;' class='jointable_td'><a href="product_view.php?goods_data=<?=$goods_data;?>"><?=$goods_name;?></a><br>
											<table class='subject'>
												<? if($wishlist_row->option1_part) {?>
												<tr height="18">
													<td class="subject" style="padding-top:4px;">
														<?=$wishlist_row->option1_name;?>:&nbsp;
													</td>
													<td class="subject" style="padding-top:4px;">
														<?=$wishlist_row->option1_part;?>&nbsp;
													</td>
												<? }?>
												<? if($wishlist_row->option2_part) {?>
													<td class="subject" style="padding-top:4px;">
													/
													</td>
													<td class="subject" style="padding-top:4px;">
														<?=$wishlist_row->option2_name;?>:&nbsp;
													</td>
													<td class="subject" style="padding-top:4px;">
														<?=$wishlist_row->option2_part;?>&nbsp;
													</td>
												</tr>
												<? }?>
											</table>
										</td>
										<td height="45" style='text-align:center;padding:3px;' class='jointable_td price item_list_block'>
											<?=number_format($wishlist_row->goods_price);?>원
										</td>
										<td height="45" style='text-align:center;padding:3px;' class='jointable_td noneoolim_del'>
											<?=number_format($wishlist_row->goods_price*$wishlist_row->goods_point*0.01);?>원
										</td>
										<td height="45" style='text-align:center;padding:3px;' class='jointable_td new_price_mpage'>
											<?=number_format($wishlist_row->goods_price*$wishlist_row->goods_cnt);?>원
										</td>
									</tr>
									</form>
									<? }?>
									<? if($form_cnt==0) {?>
									<tr height="40" align="center">
										<td height="100" colspan="11" class="menu" align="center">장바구니에 담겨진 상품이 없습니다.</td>
									</tr>
									<? }?>
								</table>
								</td>
							</tr>
						</table>
						<!-------내가찜한상품--------->
					</div>
					<!--********************내용영역 출력 끝********************-->
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<br>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->
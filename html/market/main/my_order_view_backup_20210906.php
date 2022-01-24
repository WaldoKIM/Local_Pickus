<? include('./include/head.inc.php');?>
<?  ?>
<?
	// 회원체크
	if( !$_SESSION[USERID] || !$_SESSION[PASSWD] ) {
		// 로그인 상태가 아니면 회원 로그인으로 보낸다
		$tools->metaGo('login.php?login_go='.$_SERVER[REQUEST_URI]);
	}
	$mv_data	= $_GET[trade_data];
	$trade_data	= $tools->decode( $_GET[trade_data] );
	if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $trade_data[idx]; }
	$trade_goods_stat = $db->object("cs_trade_goods", "where idx=$idx");
	$trade_stat = $db->object("cs_trade", "where trade_code='$trade_goods_stat->trade_code'");
	
	
	function alink($data) {
		// http 
		$data = preg_replace("/http:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"http://\\1\" target='_blank'>http://\\1", $data);
		$data = preg_replace("/https:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"https://\\1\" target='_blank'>https://\\1", $data);
		// ftp 
		$data = preg_replace("/ftp:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"ftp://\\1\" target='_blank'>ftp://\\1", $data);
		// email
		$data = preg_replace("/([_0-9a-z-]+(\.[_0-9a-z-]+)*)@([0-9a-z-]+(\.[0-9a-z-]+)*)/i", "<a href=\"mailto:\\1@\\3\">\\1@\\3", $data);

		return $data;
	}	
?>
<script language="javascript">
	function receiptView(tno)
	{
		receiptWin = "http://admin.kcp.co.kr/Modules/Sale/Card/ADSA_CARD_BILL_Receipt.jsp?c_trade_no=" + tno
		window.open(receiptWin , "" , "width=420, height=670")
	}
	
	function send_state(){
		var return_value = confirm('구매확정 후에는 구매대금이 판매자에게 전달되며 되돌릴수 없습니다. 구매를 결정하시겠습니까?');
		if(return_value){
			location.href="./my_order_view_ok.php?trade_data=<?=$mv_data;?>&state=4";
		}
	}

	function view_memo(d) {
		if(document.getElementById("View_memo"+d).style.display == "") document.getElementById("View_memo"+d).style.display = "none"
		else  document.getElementById("View_memo"+d).style.display = ""
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
				<li><i class="fas fa-arrow-left"></i>마이페이지</li>				
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li><i class="fas fa-arrow-left"></i>주문내역조회</li>
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
					<div class="main">
						<h2 class="tit">주문내역조회</h2>
						<!--페이지서브메뉴-->
						<!--주문 기본정보-->
							<div class='my_orderview_pc'>
								<table width="100%" class='jointable_all'>
									<tr>
										<td width="" height="45" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border2 jointable_td_border1">
											주문번호
										</td>
										<td width="" align="center" class='code jointable_td_border1' bgcolor='ffffff'>
											<?=$trade_stat->trade_code;?>
										</td>
										<td width="" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1">
											주문접수일
										</td>
										<td width="" align="center" class='code jointable_td_border1' bgcolor='ffffff'>
											<?=$trade_stat->trade_day;?>
										</td>
										<td width="" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1">
											거래상태
										</td>
										<td align="center" class="menupurple jointable_td_border1" bgcolor='ffffff'>
											<? if($trade_stat->trade_stat==1) {?><span class='Btn_orderlist1'>결제대기</span>
											<?} else if($trade_goods_stat->trade_stat==2){?><span class='Btn_orderlist2'>결제확인</span>
											<?} else if($trade_goods_stat->trade_stat==3){?><span class='Btn_orderlist3'>배송중</span>
											<?} else if($trade_goods_stat->trade_stat==4){?><span class='Btn_orderlist4'>판매완료</span>
											<?} else if($trade_goods_stat->trade_stat==5){?><span class='Btn_orderlist4'>거래취소요청중</span>
											<?} else if($trade_goods_stat->trade_stat==51){?><span class='Btn_orderlist4'>환불 대기중</span>
											<?} else if($trade_goods_stat->trade_stat==52){?><span class='Btn_orderlist4'>거래취소/환불완료</span>
											<?}?>
											<? if($trade_goods_stat->trade_stat == 3){?>
												<a href="javascript:send_state();" class='Btn_orderlist5'>구매확정</a>
											<?}?>
										</td>
									</tr>
								</table><br>
							</div>
							
							<? if($trade_goods_stat->trade_stat==5 OR $trade_goods_stat->trade_stat==51 OR $trade_goods_stat->trade_stat==52 ){?>
							<div>
								<table width="100%" class='jointable_all' style="padding:10px;">
									<tr class='jointable_td_border5'>
										<td width="150" height="45" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border2 jointable_td_border1" style="padding:10px;">
											거래취소 사유<br>(<?=$trade_goods_stat->refund_type;?>)
										</td>
										<td width="" align="left" class='code jointable_td_border1' bgcolor='ffffff' style="padding:10px;">
											<?=$trade_goods_stat->refund_remark;?>
										</td>
									</tr>
									<tr class='jointable_td_border5'>
										<td colspan="2" align="left" class='code jointable_td_border1 jointable_td_border2' bgcolor='ffffff' style="padding:10px;">
											취소 요청일 : <?=$trade_goods_stat->refund_start;?><br>
											취소 승인일 : <?=$trade_goods_stat->refund_ok;?><br>
											환불 완료일 : <?=$trade_goods_stat->refund_end;?><br>
											환불 계좌 : <?=$trade_goods_stat->refund_bank;?>
										</td>
									</tr>							
								</table><br>
							
							</div>
							<?}?>
							
						<!--결제방법및 배송정보-->
							<div class='my_orderview_pc'>
								<table width="100%" class='jointable_all'>
									<tr class='jointable_td_border5'>
										<td height="45" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border2 jointable_td_border1">
											결제방법
										</td>
										<td class="subject jointable_td_border1" align="center">
											<? if($trade_stat->trade_method==1){;?>카드결제
											<?if($trade_stat->tno != ""){?>
											&nbsp;&nbsp;<input type="button" name="receiptView" value="영수증 확인" class="box" onClick="javascript:receiptView('<?=$trade_stat->tno?>')">
											<?}?>
											<?} else if($trade_stat->trade_method==2){;?>계좌이체<?} else if($trade_stat->trade_method==3){;?>휴대폰결제
											<?} else if($trade_stat->trade_method==4){;?>가상계좌 : <?=$trade_stat->trade_method_info;?><?} else if($trade_stat->trade_method==5){;?>무통장입금 : <?=$trade_stat->trade_method_info;?><?} else if($trade_stat->trade_method==6){;?>적립금결제<?}?>
										</td>
										<td align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1 jointable_td_border2">
											결제 확인일
										</td>
										<td class="jointable_td_border1" align="center">
											<? if($trade_stat->trade_money_ok !='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_stat->trade_money_ok, 5);?><?} else {?><? if($trade_stat->trade_stat==1) {?><span class='Btn_orderlist1'>결제대기</span><?} else if($trade_goods_stat->trade_stat==2){?><span class='Btn_orderlist2'>결제확인</span><?} else if($trade_goods_stat->trade_stat==3){?><span class='Btn_orderlist3'>배송중</span><?} else if($trade_goods_stat->trade_stat==4){?><span class='Btn_orderlist4'>판매완료</span><?}?><?}?>
										</td>
										<td align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1">
											판매 완료일
										</td>
										<td class="jointable_td_border1" align="center">
											<? if($trade_goods_stat->trade_end_day !='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_goods_stat->trade_end_day, 5);?><?} else {?><? if($trade_stat->trade_stat==1) {?><span class='Btn_orderlist1'>결제대기</span><?} else if($trade_goods_stat->trade_stat==2){?><span class='Btn_orderlist2'>결제확인</span><?} else if($trade_goods_stat->trade_stat==3){?><span class='Btn_orderlist3'>배송중</span><?} else if($trade_goods_stat->trade_stat==4){?><span class='Btn_orderlist4'>판매완료</span><?}?><?}?>
										</td>
									</tr>
								</table>
							</div>
							
							<div class='my_orderview_mobile'  style="text-align:left;">
								<div class='oolimmobilemenuD'><i class='fa-certificate_color fa-chevron-circle-right'></i>결제 및 배송정보</div>
								<table width="100%" style='border:2px solid #333333;margin:2px;'>
									<tr>
										<td style="background-color:#F2F2F2" class="order-viewboxIcon jointable_td_border4">
											결제방법 : <? if($trade_stat->trade_method==1){;?>카드결제
											<?if($trade_stat->tno != ""){?>
											&nbsp;&nbsp;<input type="button" name="receiptView" value="영수증 확인" class="box" onClick="javascript:receiptView('<?=$trade_stat->tno?>')">
											<?}?>
											<?} else if($trade_stat->trade_method==2){;?>계좌이체<?} else if($trade_stat->trade_method==3){;?>휴대폰결제
											<?} else if($trade_stat->trade_method==4){;?>가상계좌 : <?=$trade_stat->trade_method_info;?><?} else if($trade_stat->trade_method==5){;?>무통장입금 : <?=$trade_stat->trade_method_info;?><?} else if($trade_stat->trade_method==6){;?>적립금결제<?}?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											결제 확인일 : <? if($trade_stat->trade_money_ok !='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_stat->trade_money_ok, 5);?><?} else {?><? if($trade_stat->trade_stat==1) {?><span class='Btn_orderlist1'>결제대기</span><?} else if($trade_goods_stat->trade_stat==2){?><span class='Btn_orderlist2'>결제확인</span><?} else if($trade_goods_stat->trade_stat==3){?><span class='Btn_orderlist3'>배송중</span><?} else if($trade_goods_stat->trade_stat==4){?><span class='Btn_orderlist4'>판매완료</span><?}?><?}?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border6">
											판매 완료일 : <? if($trade_goods_stat->trade_end_day !='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_goods_stat->trade_end_day, 5);?><?} else {?><? if($trade_stat->trade_stat==1) {?><span class='Btn_orderlist1'>결제대기</span><?} else if($trade_goods_stat->trade_stat==2){?><span class='Btn_orderlist2'>결제확인</span><?} else if($trade_goods_stat->trade_stat==3){?><span class='Btn_orderlist3'>배송중</span><?} else if($trade_goods_stat->trade_stat==4){?><span class='Btn_orderlist4'>판매완료</span><?}?><?}?>
										</td>
									</tr>
								</table>
							</div>
						<!--결제방법및 배송정보 End-->
							<br>
							<div class='my_orderview_mobile'  style="text-align:left;">
								<div class='oolimmobilemenuD'><i class='fa-certificate_color fa-chevron-circle-right'></i>주문번호 및 거래상태</div>
								<table width="100%" style='border:2px solid #333333;margin:2px;'>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4" style="background-color:#F2F2F2">
											주문번호 : <?=$trade_stat->trade_code;?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											주문접수일 : <?=$trade_stat->trade_day;?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border6">
											거래상태 : <? if($trade_stat->trade_stat==1) {?><span class='Btn_orderlist1'>결제대기</span><?} else if($trade_goods_stat->trade_stat==2){?><span class='Btn_orderlist2'>결제확인</span><?} else if($trade_goods_stat->trade_stat==3){?><span class='Btn_orderlist3'>배송중</span><?} else if($trade_goods_stat->trade_stat==4){?><span class='Btn_orderlist4'>판매완료</span><?}?>
											<? if($trade_goods_stat->trade_stat == 3){?>
												<a href="javascript:send_state();" class='Btn_orderlist5'>구매확정</a>
											<?}?>
										</td>
									</tr>
								</table>
							</div>
						<!--주문 기본정보 End-->
						
						<!--결제정보 End-->
							<div class='my_orderview_pc'>
								<table width="100%" class='jointable_all'>
									<tr bgcolor='ffffff' class='jointable_td_border5'>
										<td height="45" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border2 jointable_td_border1">
											적립금
										</td>
										<td align="center" class="jointable_td_border2 jointable_td_border1">
											<? if($trade_goods_stat->trade_stat==4) {?> <?=number_format($trade_stat->trade_save_point);?> 원 <span class='Btn_orderlist2'>적립완료</span><?} else {?><?=number_format($trade_stat->trade_save_point);?> 원 <span class='Btn_orderlist1'>적립예정</span><?}?>
										</td>
										<td align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1">
											구매금액
										</td>
										<td align="center" class="jointable_td_border1">
											<span class="new_price_mpage2"><?=number_format($trade_stat->trade_total_price);?> 원</span>
										</td>
										<td align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1">
											사용적립금
										</td>
										<td align="center" class="jointable_td_border1">
											<?=number_format($trade_stat->trade_use_point);?> 원
										</td>
										<td align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1">
											배송비
										</td>
										<td align="center" class="jointable_td_border1">
											<?=number_format($trade_stat->trade_deliv_price);?> 원
										</td>
									</tr>
									<tr>
										<td height="35" colspan="3" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border2 jointable_td_border1">
											<? if($trade_stat->order_userid) {?>회원할인율  : <?=number_format($trade_stat->trade_member_dc);?> 원<?}?>
										</td>
										<td height="35" colspan="5" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1">
											결제금액  : <span class='col-2C_priceA'><?=number_format($trade_stat->trade_price);?></span> 원
										</td>
									</tr>
								</table>								
							</div>
							<div class='my_orderview_mobile'  style="text-align:left;">
								<div class='oolimmobilemenuD'>주문금액 및 적립금 정보</div>
								<table width="100%" style='border:2px solid #333333;margin:2px;'>
									<tr>
										<td style="background-color:#F2F2F2" class="order-viewboxIcon jointable_td_border4">
											적립적립금 : <? if($trade_goods_stat->trade_stat==4) {?> <?=number_format($trade_stat->trade_save_point);?> 원 <span class='Btn_orderlist2'>적립완료</span><?} else {?><?=number_format($trade_stat->trade_save_point);?> 원 <span class='Btn_orderlist1'>적립예정</span><?}?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											구매금액 : <?=number_format($trade_stat->trade_total_price);?> 원
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											사용적립금 : <?=number_format($trade_stat->trade_use_point);?> 원
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											배송비 : <?=number_format($trade_stat->trade_deliv_price);?> 원
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											<? if($trade_stat->order_userid) {?>회원할인율  : <?=number_format($trade_stat->trade_member_dc);?> 원<?}?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border6">
											결제금액  : <span class='col-2C_priceA'><?=number_format($trade_stat->trade_price);?></span> 원
										</td>
									</tr>
								</table>
							</div>
						<!--결제정보 End-->
						<br>

						
						<!--상품정보-->
							<div class='my_orderview_pc'>
								<table width="100%" class='jointable_all'>
									<tr align="center" bgcolor="F3F3F3" class='jointable_td_border5'>
										<td height="45" class="oolimmobilemenuM jointable_td_border2 jointable_td_border1">
											제품코드
										</td>
										<td width="300" height="45" class="oolimmobilemenuM jointable_td_border1">
											상품/옵션
										</td>
										<td height="45" class="oolimmobilemenuM jointable_td_border1">
											가격
										</td>
										<td height="45" class="oolimmobilemenuM jointable_td_border1">
											수량
										</td>
										<td height="45" class="oolimmobilemenuM jointable_td_border1">
											구매금액<br>(결제금액)
										</td>
										<td height="45" class="oolimmobilemenuM jointable_td_border1">
											배송정보
										</td>
										<td height="45" class="oolimmobilemenuM jointable_td_border1">
											판매자에게 문의
										</td>
									</tr>
								<?
									$trade_goods_result=$db->select("cs_trade_goods", "where trade_code='$trade_stat->trade_code' order by idx asc");
									$frm_num=1;
									while( $trade_goods_row=@mysqli_fetch_object( $trade_goods_result)) {
										$goods_stat=$db->object("cs_goods", "where idx=$trade_goods_row->goods_idx", "goods_file");
										$goods_data = $tools->encode("idx=".$trade_goods_row->goods_idx."&part_idx=".$goods_stat->part_idx);
									?>
									<tr align="center" bgcolor='ffffff' class='calendar_list_tableTD_bgright' style="border-bottom:1px solid #000;">
										<td height="45" class='code  jointable_td_border2  jointable_td_border1'><?=$trade_goods_row->goods_code;?></td>
										<td width="300" height="45" class='subject jointable_td_border1'>
											 <?=$db->stripSlash($trade_goods_row->goods_name);?>&nbsp;
											 <?/*
											<? if( $goods_stat->goods_file && $trade_stat->trade_stat==4) {?>
											<a href="goods_download.php?trade_idx=<?=$trade_stat->idx;?>&trade_goods_idx=<?=$trade_goods_row->goods_idx;?>"><img src="images/bt_file.gif" border="0" align="absmiddle"></a>
											<?} else if( $goods_stat->goods_file  ){?>
											<img src="images/bt_file.gif" border="0" align="absmiddle">
											<?}?>
											*/?>
											<a href="product_view.php?part_idx=<?=$trade_goods_row->part_idx;?>&goods_data=<?=$goods_data;?>"  class='Btn_orderlist5'>상품평작성</a>
											<hr>
																						<?
											$optArr = explode("/^CUT/^", $trade_goods_row->opt_data);
											for($i=0;$i<count($optArr)-1;$i++){
												$optRec = explode("/^/^", $optArr[$i]);
											?>
											<?=$optRec[0];?>:&nbsp;<span class="new_price_mpage"><?=$optRec[1];?></span>원<br>
											<?}?>
										</td>
										<td height="45" align="center" class="price jointable_td_border1">
											<span class="new_price_mpage2"><?=number_format($trade_goods_row->goods_price);?></span>원
										</td>
										<td height="45" class="jointable_td_border1">
											 <?=number_format($trade_goods_row->goods_cnt);?>
										</td>
										<td height="45" class="price jointable_td_border1">
											 <span class="new_price_mpage3"><?=number_format($trade_goods_row->goods_price*$trade_goods_row->goods_cnt);?>원</span><br>
											 <span class="new_price_mpage2">(<?=number_format($trade_goods_row->trade_price*$trade_goods_row->goods_cnt);?>원)</span>
										</td>
										<td height="45" class="jointable_td_border1">
											 <?=$tools->strDateCut($trade_goods_row->trade_start_day);?><br>
											 <?=$trade_goods_row->deliv_number;?>
										</td>
										<td height="45" class="price jointable_td_border1">
											<?/*
											<?$trade_file = explode( "&&", $trade_goods_row->upfile );?>
											<?if($trade_goods_row->upfile !="" && $trade_goods_row->upfile !="none"){?>
											 <a href="my_order_view_download.php?idx=<?=$trade_goods_row->idx;?>" class="Btn_orderlist5"><?=$trade_file[1];?></a>
											<?}else{?>
											 <span class="Btn_orderlist5">등록전</span>
											<?}?>
											*/?>
											<span class="Btn_orderlist5" onclick="view_memo(<?=$frm_num;?>)">보기</span>
										</td>
									</tr>
									<style>
										.table_comm td{
											padding:5px; border-right: 1px solid #ccc; text-align:center;
										}
										.table_comm .contenM td{
											text-align:center;
										}
									</style>
									<tr id="View_memo<?=$frm_num;?>" align="center" bgcolor='ffffff' class='calendar_list_tableTD_bgright' style="display:none;">
										<td colspan="7">
											<br>
											<table width="100%" class='jointable_all table_comm'>
												<tr align="center"  bgcolor="E4E7EF" style="border:1px solid #333; height:30px;"> 
													<td width="150" >
														작성일
													</td>
													<td>
														내용
													</td>
													<td>
														작성자
													</td>
													<?/*
													<td>
														첨부파일
													</td>
													*/?>
												</tr>
											<?
											$trade_comment_result=$db->select("cs_trade_comment", "where trade_goods_idx='$trade_goods_row->idx' order by idx asc");
												while( $trade_comment_row=@mysqli_fetch_object( $trade_comment_result)) {
													$goods_data = $tools->encode("idx=".$trade_goods_row->goods_idx."&part_idx=".$goods_stat->part_idx);
												?>
												<tr style="border:1px solid #ccc; height:30px; background-color:<?if($trade_stat->order_userid == $trade_comment_row->userid){?>#F1D7FF<?}?>">
													<td>
														<?=$trade_comment_row->reg_date;?>
													</td>
													<td style="text-align:left; width:70%;" >
														<?=alink(nl2br(htmlspecialchars($trade_comment_row->content)));?>
													</td>
													<td>
														<?=$trade_comment_row->name;?>
													</td>
													<?/*
													<td>
														<?$comment_file = explode( "&&", $trade_comment_row->upfile );?>
														<?if($trade_comment_row->upfile !="" && $trade_comment_row->upfile !="none"){?>
															<a href="my_order_view_download.php?idx=<?=$trade_comment_row->idx;?>&mode=comment"><?=$comment_file[1];?></a>
														<?}?>
													</td>
													*/?>
													
												</tr>
												<?
											}?>
											</table>
											<? if($trade_stat->trade_stat < 4){?>
											<table width="100%">
												<form name="write_<?=$frm_num;?>_form" action="my_order_view_ok.php?trade_data=<?=$mv_data;?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="trade_goods_idx" value="<?=$trade_goods_row->idx;?>">
												<tr>
													<td style="text-align:center;">
														<textarea name="content" style="width:95%;height:50px;padding:10px;" placeholder="등록된 글은 수정, 삭제가 되지 않습니다."></textarea>	
														<?/*														
														<p style="padding:10px;">
															<input type="file" name="upfile" class="formfile" style="max-width:500px;">
														</p>
														*/?>														
													</td>
													<td width="100" height="100" style="padding-bottom:10px; " >
														<a href="javascript:document.write_<?=$frm_num;?>_form.submit();"   style="">
														<p style="width:100%; text-align: center; background-color:#000; line-height:60px; color:#FFF; font-weight:600; " >
															등록
														</p>
														</a>
													</td>
												</tr>
												</form>
											</table>
											<?}?>
										</td>
									</tr>
								<?$frm_num++;}?>
								</table>
							</div>
							<div class='my_orderview_mobile'  style="text-align:left;">
								<div class='oolimmobilemenuD'><i class='fa-certificate_color fa-chevron-circle-right'></i>상품정보</div>
									<?
										$trade_goods_result=$db->select("cs_trade_goods", "where trade_code='$trade_stat->trade_code' order by idx asc");
										$frm_num=1;
										while( $trade_goods_row=@mysqli_fetch_object( $trade_goods_result)) {
											$goods_stat=$db->object("cs_goods", "where idx=$trade_goods_row->goods_idx", "goods_file");
											$goods_data = $tools->encode("idx=".$trade_goods_row->goods_idx."&part_idx=".$goods_stat->part_idx);
										?>
									<table width="100%" style='border:2px solid #333333;margin:2px;'>
										<tr>
											<td style="background-color:#F2F2F2" class="order-viewboxIcon jointable_td_border4">
												상품코드 : <?=$trade_goods_row->goods_code;?>
											</td>
										</tr>
										<tr>
											<td class="order-viewboxIcon jointable_td_border4">
												<span class='my_order_title'><?=$db->stripSlash($trade_goods_row->goods_name);?></span>&nbsp;
												<?/*
												<? if( $goods_stat->goods_file && $trade_stat->trade_stat==4) {?>
												<a href="goods_download.php?trade_idx=<?=$trade_stat->idx;?>&trade_goods_idx=<?=$trade_goods_row->goods_idx;?>"><img src="images/bt_file.gif" border="0" align="absmiddle"></a>
												<?} else if( $goods_stat->goods_file  ){?>
												<img src="images/bt_file.gif" border="0" align="absmiddle">
												<?}?>*/?>
												<a href="product_view.php?part_idx=<?=$trade_goods_row->part_idx;?>&goods_data=<?=$goods_data;?>"  class='Btn_orderlist5'>상품평작성</a>
											</td>
										</tr>
										<tr>
											<td class="order-viewboxIcon jointable_td_border4">
												옵션 : <?
												$optArr = explode("/^CUT/^", $trade_goods_row->opt_data);
												for($i=0;$i<count($optArr)-1;$i++){
													$optRec = explode("/^/^", $optArr[$i]);
												?>
												<?=$optRec[0];?>:&nbsp;<?=$optRec[1];?>원<br>
												<?}?>
											</td>
										</tr>
										<tr>
											<td class="order-viewboxIcon jointable_td_border4">
												가격 :  <?=number_format($trade_goods_row->goods_price);?> 원
											</td>
										</tr>
										<tr>
											<td class="order-viewboxIcon jointable_td_border4">
												수량 : <?=number_format($trade_goods_row->goods_cnt);?> 개
											</td>
										</tr>
										<tr>
											<td class="order-viewboxIcon jointable_td_border6">
												구매금액 : <?=number_format($trade_goods_row->goods_price*$trade_goods_row->goods_cnt);?> 원
											</td>
										</tr>
										<tr>
											<td class="order-viewboxIcon jointable_td_border6">												
											<?if($trade_goods_row->deliv_number){?>
												배송정보 : <?=$trade_goods_row->deliv_number;?>(<?=$tools->strDateCut($trade_goods_row->trade_start_day);?> )
											<?}?>											
											</td>
										</tr>
										
										
									</table>
											<? if($trade_stat->trade_stat < 4){?>
											문의 하기
											<table width="100%">
												<form name="mwrite_<?=$frm_num;?>_form" action="my_order_view_ok.php?trade_data=<?=$mv_data;?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="trade_goods_idx" value="<?=$trade_goods_row->idx;?>">
												<tr>
													<td style="text-align:center;">
														<textarea name="content" style="width:95%;height:50px;padding:10px;" placeholder="등록된 글은 수정, 삭제가 되지 않습니다."></textarea>
														<?if($trade_goods_row->upfile != "" && $trade_goods_row->upfile != "none"){
															$trade_file = explode( "&&", $trade_goods_row->upfile );
															?>
															<p style="padding:10px;">
																<input type="file" name="upfile" class="formfile" style="max-width:500px;">
															</p>
														<?}?>														
													</td>
													<td width="100" height="100" style="padding-bottom:10px; " >
														<a href="javascript:document.mwrite_<?=$frm_num;?>_form.submit();"   style="">
														<p style="width:100%; height:100%; text-align: center; background-color:#000; line-height:100px; color:#FFF; font-weight:600; " >
															등록
														</p>
														</a>
													</td>
												</tr>
												</form>
											</table>
											<?}?>
											<br>
											<table width="100%" class='jointable_all table_comm'>
												<tr align="center"  bgcolor="E4E7EF" style="border:1px solid #333; height:30px;"> 
													<td width="150" class="noneoolim" >
														작성일
													</td>
													<td>
														내용
													</td>
													<td>
														작성자
													</td>
													<?/*
													<td>
														첨부파일
													</td>
													*/?>
												</tr>
											<?
											$trade_comment_result=$db->select("cs_trade_comment", "where trade_goods_idx='$trade_goods_row->idx' order by idx asc");
												while( $trade_comment_row=@mysqli_fetch_object( $trade_comment_result)) {
													$goods_data = $tools->encode("idx=".$trade_goods_row->goods_idx."&part_idx=".$goods_stat->part_idx);
												?>
												<tr style="border:1px solid #ccc; height:30px; background-color:<?if($trade_stat->order_userid == $trade_comment_row->userid){?>#F1D7FF<?}?>">
													<td class="noneoolim">
														<?=$trade_comment_row->reg_date;?>
													</td>
													<td style="text-align:left; width:50%;" >
														<?=alink(nl2br(htmlspecialchars($trade_comment_row->content)));?>
													</td>
													<td>
														<?=$trade_comment_row->name;?>
													</td>
													<?/*
													<td>
														<?$comment_file = explode( "&&", $trade_comment_row->upfile );?>
														<?if($trade_comment_row->upfile !="" && $trade_comment_row->upfile !="none"){?>
															<a href="my_order_view_download.php?idx=<?=$trade_comment_row->idx;?>&mode=comment"><?=$comment_file[1];?></a>
														<?}?>
													</td>
													*/?>													
												</tr>
												<?
											}?>
											</table>
											<br>									
									<?$frm_num++;}?>
							</div>
						<!--상품정보 End-->

						<div class='spaceline14'></div>	
						
						<!--고객정보-->
							<div class='my_orderview_pc'>
								<table width="100%" class='jointable_all'>
									<tr align="center">
										<td height="45" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border2 jointable_td_border1">
											고객이름
										</td>
										<td height="45" class="jointable_td_border1">
											<?=$trade_stat->order_name;?>
										</td>
										<td height="45" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1">
											연락처
										</td>
										<td height="45" class="jointable_td_border1">
											<?=$trade_stat->order_tel1;?><?=$trade_stat->order_tel2;?><?=$trade_stat->order_tel3;?>
										</td>
										<td height="45" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1">
											이메일
										</td>
										<td height="45" class="jointable_td_border1">
											<?=$trade_stat->order_email;?>
										</td>
									</tr>
								</table><br>
							</div>
							<div class='my_orderview_mobile'  style="text-align:left;">
								<div class='oolimmobilemenuD'><i class='fa-certificate_color fa-chevron-circle-right'></i>고객기본정보</div>
								<table width="100%" style='border:2px solid #333333;margin:2px;'>
									<tr>
										<td style="background-color:#F2F2F2" class="order-viewboxIcon jointable_td_border4">
											고객이름 :<?=$trade_stat->order_name;?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											연락처 : <?=$trade_stat->order_tel1;?><?=$trade_stat->order_tel2;?><?=$trade_stat->order_tel3;?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border6">
											이메일 : <?=$trade_stat->order_email;?>
										</td>
									</tr>
								</table>
							</div>
						<!--고객정보 End-->
						<!--주문자정보-->
							<div class='my_orderview_pc'>
								<table width="100%" class='jointable_all'>
									<tr class='jointable_td_border5'>
										<td height="45" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border2 jointable_td_border1">
											수령자
										</td>
										<td  height="45" class="jointable_td_border1" style='text-align:left;padding:5px;'>
											<?=$trade_stat->deliv_name;?>
										</td>
										<td height="45" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1">
											이메일
										</td>
										<td height="45" class="jointable_td_border1" style='text-align:left;padding:5px;'>
											<?=$trade_stat->deliv_email;?>
										</td>
									</tr>
									<tr class='jointable_td_border5'>
										<td height="45" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1 jointable_td_border2">
											전 화
										</td>
										<td height="45" class="code jointable_td_border1" style='text-align:left;padding:5px;'>
											<?=$trade_stat->deliv_tel1;?><?=$trade_stat->deliv_tel2;?><?=$trade_stat->deliv_tel3;?>
										</td>
										<td height="45" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1 jointable_td_border2">
											핸드폰
										</td>
										<td height="45" class="code jointable_td_border1" style='text-align:left;padding:5px;'>
											<? if($trade_stat->deliv_phone1) 	{?><?=$trade_stat->deliv_phone1;?><?=$trade_stat->deliv_phone2;?><?=$trade_stat->deliv_phone3;?><?}?>
										</td>
									</tr>
									<tr class='jointable_td_border5'>
										<td height="45" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1 jointable_td_border2">
											주 소
										</td>
										<td height="45" colspan="3" class="jointable_td_border1" style='text-align:left;padding:5px;'>
											(<?=$trade_stat->deliv_zip;?>) &nbsp;<?=$trade_stat->deliv_add1;?> <?=$trade_stat->deliv_add2;?>
										</td>
									</tr>
									<tr class='jointable_td_border5'>
										<td height="45" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1 jointable_td_border2">
											주문시 요청 사항
										</td>
										<td height="45" colspan="3" class="jointable_td_border1" style='text-align:left;padding:5px;'>
											<?=$trade_stat->deliv_content;?>
										</td>
									</tr>
									<tr class='jointable_td_border5'>
										<td height="45" align="center" bgcolor="F3F3F3" class="oolimmobilemenuM jointable_td_border1 jointable_td_border2">
											배송예약일
										</td>
										<td height="45" colspan="3" class="code jointable_td_border1" style='text-align:left;padding:5px;'>
											<? if($trade_stat->deliv_pree_day!='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_stat->deliv_pree_day, 5);?><?}?>
										</td>
									</tr>
								</table><br>
							</div>
							<div class='my_orderview_mobile'  style="text-align:left;">
								<div class='oolimmobilemenuD'><i class='fa-certificate_color fa-chevron-circle-right'></i>주문자정보</div>
								<table width="100%" style='border:2px solid #333333;margin:2px;'>
									<tr>
										<td style="background-color:#F2F2F2" class="order-viewboxIcon jointable_td_border4">
											수령자 : <?=$trade_stat->deliv_name;?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											이메일 : <?=$trade_stat->deliv_email;?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											전 화 : <?=$trade_stat->deliv_tel1;?><?=$trade_stat->deliv_tel2;?><?=$trade_stat->deliv_tel3;?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											핸드폰 : <? if($trade_stat->deliv_phone1) 	{?><?=$trade_stat->deliv_phone1;?><?=$trade_stat->deliv_phone2;?><?=$trade_stat->deliv_phone3;?><?}?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											주 소 : (<?=$trade_stat->deliv_zip1;?>-<?=$trade_stat->deliv_zip2;?>) &nbsp;<?=$trade_stat->deliv_add1;?> <?=$trade_stat->deliv_add2;?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											주문시 요청 사항 : <?=$trade_stat->deliv_content;?>
										</td>
									</tr>
									<tr>
										<td class="order-viewboxIcon jointable_td_border4">
											배송예약일 : <? if($trade_stat->deliv_pree_day!='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_stat->deliv_pree_day, 5);?><?}?>
										</td>
									</tr>
								</table>
							</div>
						<!--주문자정보 End-->						


								<table width="100%">
									<tr>
										<td height="100" align="CENTER"><a href="my_order_list.php?trade_data=<?=$mv_data;?>" class="btn-type2" style="width:180px">주문리스트</a></a></td>
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
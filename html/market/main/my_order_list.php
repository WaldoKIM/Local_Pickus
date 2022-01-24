<? include('./include/head.inc.php');?>
<? include($ROOT_DIR."/lib/page_class.php");?>
<?
	 
	// 회원체크
	if( !$_SESSION[USERID] || !$_SESSION[PASSWD] ) {
		// 로그인 상태가 아니면 회원 로그인으로 보낸다
		$tools->metaGo('order_check.php?login_go='.$_SERVER[REQUEST_URI]);
		//$tools->metaGo('../../bbs/login.php?login_go='.$_SERVER[REQUEST_URI]);
	}
	// 거래 정보 수정
	$mv_data	= $_GET[trade_data];
	$trade_data	= $tools->decode( $_GET[trade_data] );
	if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $trade_data[idx]; }
	if($_GET[listNo] )					{ $listNo = $_GET[listNo]; }									else { $listNo = $trade_data[listNo]; }
	if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $trade_data[startPage]; }
		
?>
<script language="JavaScript">
	function send_state( mv_data ){
		var return_value = confirm('구매확정 후에는 구매대금이 판매자에게 전달되며 되돌릴수 없습니다. 구매를 결정하시겠습니까?');
		if(return_value){
			location.href="./my_order_view_ok.php?state=4&trade_data="+mv_data;
		}
	}
	<!--
	// 거래정보보기
	function tradeView( mv_data ) {
		location.href='my_order_view.php?trade_data='+mv_data;
	}
	
	// 취소 사유 입력창
	function View_memo(d) {
		if(document.getElementById("View_memo"+d).style.display == "") document.getElementById("View_memo"+d).style.display = "none"
		else  document.getElementById("View_memo"+d).style.display = ""
	}

	function stateChange(form_data){
		var choice = confirm( '거래 취소 요청을 하시겠습니까?');
		if(choice) {
			if(form_data.refund_remark.value == ""){
				alert("취소사유를 입력해 주세요");
			}else{
				form_data.submit();
			}
		}
	}

	function stateCancel(form_data){
		var choice = confirm( '결제 취소 요청을 하시겠습니까?');
		if(choice) {
			form_data.submit();
		}
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
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td height='50' style='text-align:right' class="oolimmobilemenuM">※ 주문상세내역 확인은 아래 주문번호를 클릭해 주세요.</td>
						</tr>
						</table>
						<table width="100%" class="my_order_list_flex mypage_border jointable_all">
							<tr style="display:none;" align="center" height="37">
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
									상품
								</td>
								<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB noneoolim_del2'>
									결제금액
								</td>
								<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>
									진행상태<span class='noneoolim_del3'>주문일자</span>
								</td>
								<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>
									취소요청
								</td>								
							</tr>
							<?
								$table				= "cs_trade_goods";
								$listScale			=	10; 		// 리스트갯수
								$pageScale		=	10;		// 페이지 갯수
								if( !$startPage ) { $startPage = 0; }		// 스타트 페이지
								$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
								$totalList	= $db->cnt( $table, "where order_userid='$_SESSION[USERID]'" );
								$result		= $db->select( $table, "where order_userid='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale" );
								if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }		// 페이지넘버
								for($i=$startPage; $i<$startPage+$listScale; $i++) {		// 루프 시작
									if( $i < $totalList ) {
										$my_trade_row = mysqli_fetch_object($result);

										//결제취소로우
										$cancel = $db->select("cs_trade", "where trade_code ='$my_trade_row->trade_code'");
										$cancel_row = mysqli_fetch_object($cancel);

										//$trade_stat=$db->object("ce_trade","where trade_code='$my_trade_row->trade_code'");
										$trade_data = $tools->encode("idx=".$my_trade_row->idx."&startPage=".$startPage."&listNo=".$listNo);
										$goods_data = $tools->encode("idx=".$my_trade_row->goods_idx."&part_idx=".$my_trade_row->part_idx);
									?>
							<tr class="my_order_list_tr mypage_design">
								<td class='mypage_border calendar_list_tableTD_bg noneoolim_del' style='text-align:center;'>
									<div class="mypage_design_font">No</div><?=$listNo;?>
								</td>
								<td class='mypage_border calendar_list_tableTD_bg noneoolim_del' style='text-align:center;'>
									<div class="mypage_design_font">주문번호</div><a href="javascript:tradeView('<?=$trade_data;?>');"><span class='code'><?=$my_trade_row->trade_code;?></span></a>
								</td>
								<td style='text-align:center;padding:3px;' class='mypage_border calendar_list_tableTD_bg noneoolim_del2'>
									<div class="mypage_design_font">주문일자</div><?=$tools->strDateCut($my_trade_row->trade_day, 1);?>
								</td>
								<td class='mypage_border calendar_list_tableTD_bg' style='height: 100%; text-align:center;'>
								<div class="mypage_design_font">상품명</div><a href="javascript:tradeView('<?=$trade_data;?>');"><?=$tools->strCut($db->stripSlash($my_trade_row->goods_name), 100);?></a>
								</td>
								<td style='text-align:center;padding:3px;' class='mypage_border calendar_list_tableTD_bg price noneoolim_del2'><div class="mypage_design_font">결제금액</div><?=number_format($my_trade_row->trade_price*$my_trade_row->goods_cnt);?>원</td>
								
								<td style='text-align:center;padding:3px; justify-content: center;' class='mypage_border calendar_list_tableTD_bgright'>
									<? if($my_trade_row->trade_stat==1) {?><span style="width: auto;" class='Btn_orderlist1'>결제대기</span>
									<?} else if($my_trade_row->trade_stat==2){?><span style="width: auto;" class='Btn_orderlist2'>결제확인</span>
									<?} else if($my_trade_row->trade_stat==3 && $my_trade_row->invoice_stat == 0){?><span style="width: auto;" class='Btn_orderlist3'>배송중</span>
									<?} else if($my_trade_row->trade_stat==3 && $my_trade_row->invoice_stat == 1){?><span style="width: auto;" class='Btn_orderlist3'>배송완료</span>
									<?} else if($my_trade_row->trade_stat==4){?><span style="width: auto;" class='Btn_orderlist4'>판매완료</span>
									<?} else if($my_trade_row->trade_stat==5){?><span style="width: auto;" class='Btn_orderlist3'>취소요청중</span>
									<?} else if($my_trade_row->trade_stat==51){?><span style="width: auto;" class='Btn_orderlist4'>환불대기중</span>
									<?} else if($my_trade_row->trade_stat==52){?><span style="width: auto;" class='Btn_orderlist4'>취소/환불완료</span>
									<?}?>
									<? if($my_trade_row->trade_stat==4){ ?>
									<a style="display:none;" href="product_view.php?part_idx=<?=$my_trade_row->part_idx;?>&goods_data=<?=$goods_data;?>" class='Btn_orderlist5'>상품평작성</a>
									<? } ?>
									<? if($my_trade_row->trade_stat == 3){?>
										<a href="javascript:send_state('<?=$trade_data;?>');" class='Btn_orderlist5'>구매확정</a>
									<?}?>	
									<?
										$trade_cnt = $db->cnt("cs_trade_goods","where trade_code='$my_trade_row->trade_code' and trade_stat > 2 ");//배송중인 상품 체크
										//if($my_trade_row->trade_stat < 3 && !$trade_cnt){//배송 중 취소금지
										if($my_trade_row->trade_stat <= 2 && !$trade_cnt){//입금 후 취소 금지
										?>
										<a style="display:none;" href="javascript:View_memo('<?=$my_trade_row->idx?>')" class='Btn_orderlist5'>구매취소</a>
										<form name="formc_<?=$my_trade_row->idx?>" method="POST" action="pp_ax_hub_cancel.php" enctype="multipart/form-data">
											<input type="hidden" name="idx" value="<?=$my_trade_row->idx;?>">
											<input type="hidden" name="state" value="5">  
											<input type="hidden" name="trade_code" value="<?=$my_trade_row->trade_code;?>">
											<input type="hidden" name="req_tx" value="mod">
											<input type="hidden" name="tno" value="<?=$cancel_row->tno?>">
											<input type="hidden" name="mod_type" value="STSC">
											<input type="hidden" name="mod_desc" value="고객변심">
											<a href="javascript:stateCancel(document.formc_<?=$my_trade_row->idx?>);" class='Btn_orderlist5'>결제취소</a>
										</form>
									<?}?>
									<?if($my_trade_row->trade_stat == 5 OR $my_trade_row->trade_stat == 51 OR $my_trade_row->trade_stat == 52){?>
										<span class='Btn_orderlist4'><?=$my_trade_row->refund_type;?></span>
									<?}?>
									<?=$row->refund_type;?>
									<?if($order_stat->trade_stat > 4){?>
									<?}?>									
								</td>
								<!-- 취소사유 입력 -->
								<form name="form_<?=$my_trade_row->idx?>" method="POST" action="my_order_list_ok.php?trade_data=<?=$mv_data;?>" enctype="multipart/form-data">
								<input type="hidden" name="idx" value="<?=$my_trade_row->idx;?>">
								<input type="hidden" name="state" value="5">
								<input type="hidden" name="trade_code" value="<?=$my_trade_row->trade_code;?>">
								<td id='View_memo<?=$my_trade_row->idx?>' style="display:none;">
								<div height="45"  colspan="5" style="padding:5px 5px 5px 10px;">
									거래 상태가 입금완료, 배송중인 상태에서는 판매자의 동의가 있어야 취소승인이 진행됩니다.<br>
									취소완료 후 고객님의 입금계좌로 구매금액을 환불해 드리니 반드시 회원정보에서 환불 계좌를 등록해 주세요.
									<textarea name="refund_remark" style="width:90%; height:100px; padding:10px;" placeholder="취소사유를 입력해 주세요."><?=strip_tags($my_trade_row->remark);?></textarea>
									<a href="javascript:View_memo('<?=$my_trade_row->idx?>')" class='company_smallBtn02'>닫기</a>
									<a href="javascript:stateChange(document.form_<?=$my_trade_row->idx?>);" class='company_smallBtn03'>취소요청</a>	
								</div>
								
								</td>
								</form>
								<!-- 취소사유 입력 종료 //-->			
							</tr>
							
							<?
							}
								$listNo--;
							}
							?>
							<? if( !$totalList ) { ?>
							<tr align="center">
								<td height="100" colspan="11" align="center">
									거래 내역이 없습니다.
								</td>
							</tr>
							<? }?>
						</table>
						<table STYLE='margin:0 auto; width:100%;text-align:center;'>
							<tr>
								<td STYLE='padding:20px;'>
									<? $page->my_trade( $table, $totalPage, $totalList, $listScale, $pageScale, $startPage,  "", "", "", "");?>
								</td>
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
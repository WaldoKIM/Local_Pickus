<?
include('../header.php');
include($ROOT_DIR.'/lib/style_class.php');

$mv_data	= $_GET[trade_data];
$trade_data	= $tools->decode( $_GET[trade_data] );
if($_GET[idx] )	{ $idx = $_GET[idx]; } else { $idx = $trade_data[idx]; }

$trade_stat = $db->object("cs_trade", "where idx=$idx");

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
<script language="JavaScript">
<!--
function sendit(){
	var choose = confirm('주문정보를 수정 하시겠습니까?');
	if(choose) {	document.trade_form.submit(); }
}

function openOderprint() {
	window.open("trade_view_print.php?trade_data=<?=$mv_data;?>", "","scrollbars=yes, width=720, height=600");
}
function view_memo(d) {
	if(document.getElementById("View_memo"+d).style.display == "") document.getElementById("View_memo"+d).style.display = "none"
	else  document.getElementById("View_memo"+d).style.display = ""
}
//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/order_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table border="0"  width="100%">
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
					<table  width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
									<table width="100%" border="0" align="center">
										<tr> 
											<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
													<table border="0" width="100%">
															<tr>
																<td height="35">
																<table>
																	<tr>
																		<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">결제상세정보</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td height="5">
																</td>
															</tr>
														</table>


														<div id="customertable_divcont">
															<div id="customertable_divLeft_view">
																<div class="customertable_divLeft">
																	<table width="100%" class="table_all" >
																		<tr bgColor="white"> 
																			<td width="20%" height="35"  bgcolor="E4E7EF" class='contenM tabletd_all'>주문번호</td>
																			<td class='tabletd_all tabletd_Lmall'><?=$trade_stat->trade_code;?></td>
																			<td width="20%"  bgcolor="E4E7EF" class='contenM tabletd_all'>주문접수일</td>
																			<td class='tabletd_all tabletd_Lmall'><?=$trade_stat->trade_day;?></td>
																		</tr>
																	</table>
																</div> 
															</div> 
															
															<div id="customertable_divcenter_1_view">
																<div class="customertable_divcenter_1">
																	<table width="100%" class="table_all table_all_moA">
																		<tr bgColor="white"> 
																			<td width="20%" height="35"  bgcolor="E4E7EF" class='contenM tabletd_all'>회원아이디</td>
																			<td class='tabletd_all tabletd_Lmall'><? if($trade_stat->order_userid) {?><font color="#FF0000"><?=$trade_stat->order_userid;?></font><?} else {?><font color="#FF9933">비회원</font><?}?></td>
																			<td width="20%"  bgcolor="E4E7EF" class='contenM tabletd_all'>결제상태</td>
																			<td class='tabletd_all tabletd_Lmall'><? if($trade_stat->trade_stat==1) {?>결제대기중<?} else if($trade_stat->trade_stat==2){?>결제확인됨<?} else if($trade_stat->trade_stat==3){?>결제확인됨<?} else if($trade_stat->trade_stat==4){?>결제확인됨<?}?></td>
																		</tr>
																	</table>
																</div>
															</div>
														</div> 

														<br>
														
														<table border="0" width="100%">
															<tr>
																<td height="25"></td>
															</tr>
															<tr>
																<td height="35">
																<table>
																	<tr>
																		<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">주문내역</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td height="5"></td>
															</tr>
														</table>

														<table width="100%" class="table_all">
															<tr align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'> 
																<td height="35" class='contenM tabletd_all'>제품코드</td>
																<td height="35" class='contenM tabletd_all'>제품명</td>
																<td height="35" class='contenM tabletd_all'>옵 션</td>
																<td height="35" class='contenM tabletd_all noneoolimmoL'>가 격</td>
																<td height="35" class='contenM tabletd_all noneoolimmoL'>수 량</td>
																<td height="35" class='contenM tabletd_all noneoolimmoL'>구매금액</td>
																<td height="35" class='contenM tabletd_all noneoolimmoL'>배송비</td>																
																<td height="35" class='contenM tabletd_all noneoolimmoL'>문의내역</td>
																<td height="35" class='contenM tabletd_all noneoolimmoL'>배송정보</td>
																<td height="35" class='contenM tabletd_all noneoolimmoL'>거래상태</td>
															</tr>
															<?
															$trade_goods_result=$db->select("cs_trade_goods", "where trade_code='$trade_stat->trade_code' order by idx asc");
															$frm_num=1;
															while( $trade_goods_row=@mysqli_fetch_object( $trade_goods_result)) {
															?>
															<tr align="center" bgColor="white"> 
																<td height="35" class='tabletd_all tabletd_Lmall'><?=$trade_goods_row->goods_code;?> </td>
																<td height="35" class='tabletd_all tabletd_Lmall'>
																<?=$db->stripSlash($trade_goods_row->goods_name);?>
																<span class='noneoolimmoL_on' style='text-align:center'>
																	<span class='font1'>가격 : <?=number_format($trade_goods_row->goods_price);?> 원</span><br>
																	<span class='font4'>수량 : <?=number_format($trade_goods_row->goods_cnt);?>개</span><br>
																	<span class='font3'>구매금액 : <?=number_format($trade_goods_row->goods_price*$trade_goods_row->goods_cnt);?> 원</span><br>
																	<span class='font2'>배송정보 : <?=$trade_goods_row->deliv_number;?></span>
																</span>
																</td>


																<td height="35" class='tabletd_all tabletd_Lmall'>
																	<?
																	$optArr = explode("/^CUT/^", $trade_goods_row->opt_data);
																	for($i=0;$i<count($optArr)-1;$i++){
																		$optRec = explode("/^/^", $optArr[$i]);
																	?>
																	<?=$optRec[0];?>:&nbsp;<?=$optRec[1];?><br>
																	<?}?>
																</td>
																<td height="35" class='tabletd_all tabletd_Lmall noneoolimmoL'> <?=number_format($trade_goods_row->goods_price);?> 원</td>
																<td height="35" class='tabletd_all tabletd_Lmall noneoolimmoL'> <?=number_format($trade_goods_row->goods_cnt);?> </td>
																<td height="35" class='tabletd_all tabletd_Lmall noneoolimmoL'> <?=number_format($trade_goods_row->goods_price*$trade_goods_row->goods_cnt);?> 원</td>
																<td height="35" class='tabletd_all tabletd_Lmall noneoolimmoL'> <?=number_format($trade_goods_row->trade_deliv_price);?> 원</td>
																<td height="35" class='tabletd_all tabletd_Lmall noneoolimmoL' style="text-align:left;">
																	<a href="javascript:view_memo(<?=$frm_num;?>);" class="btn_guide1">보기</a>
																</td>
																<td height="35" class='tabletd_all tabletd_Lmall noneoolimmoL' style="text-align:left;">
																	<?=$trade_goods_row->deliv_number;?>
																</td>
																<td height="35" class='tabletd_all tabletd_Lmall noneoolimmoL'>
																		<? if( $trade_goods_row->trade_stat < 2) {?>결제대기중<?}?>
																		<? if( $trade_goods_row->trade_stat == 2 ){?>결제완료됨<?}?>
																		<? if( $trade_goods_row->trade_stat == 3 ){?>배송중<?}?>
																		<? if( $trade_goods_row->trade_stat == 4 ){?>판매완료됨<?}?>
																		<? if( $trade_goods_row->trade_stat == 5 ){?>거래취소요청<?}?>
																		<? if( $trade_goods_row->trade_stat == 51 ){?>환불대기중<?}?>
																		<? if( $trade_goods_row->trade_stat == 52 ){?>취소/환불완료<?}?>
																</td>																	
															</tr>
															<tr id="View_memo<?=$frm_num;?>" align="center" bgColor="white" style="display:none">
																<td colspan="9" style="padding:30px;">	
																	<br>
																	<style>
																		.table_comm td{
																			padding:5px; border-right: 1px solid #ccc; text-align:center;
																		}
																		.table_comm .contenM td{
																			text-align:center;
																		}
																	</style>
																	<table  width="95%" class="table_comm" style="margin: 0 auto; border:1px solid #333;">
																		<tr align="center"  bgcolor="E4E7EF" class='contenM tabletd_all' style="border:1px solid #333; height:30px;"> 
																			<td width="150" >
																				작성일
																			</td>
																			<td>
																				내용
																			</td>
																			<td>
																				작성자
																			</td>
																			<!--td>
																				첨부파일
																			</td-->
																			<?if($_SESSION["ADMIN_USERID"] == $admin_stat->admin_userid){?>
																			<td>
																				삭제
																			</td>
																			<?}?>
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
																			<td style="text-align:left;width:50%;" >
																				<?=alink(nl2br(htmlspecialchars($trade_comment_row->content)));?>
																			</td>
																			<td>
																				<?=$trade_comment_row->name;?>
																			</td>
																			<!--td>
																				<?$comment_file = explode( "&&", $trade_comment_row->upfile );?>
																				<?if($trade_comment_row->upfile !="" && $trade_comment_row->upfile !="none"){?>
																					<a href="trade_view_download.php?idx=<?=$trade_comment_row->idx;?>&mode=comment"><?=$comment_file[1];?></a>
																				<?}?>
																			</td-->
																			<?if($_SESSION["ADMIN_USERID"] == $admin_stat->admin_userid){?>
																			<td>
																				<a href="./trade_view_ok.php?mode=comment_del&idx=<?=$trade_comment_row->idx;?>" class="btn_guide1">확인</a>
																			</td>	
																			<?}?>
																		</tr>
																		<?
																	}?>
																	</table>
																<? if($trade_stat->trade_stat < 4){?>
																	<table width="95%" style="margin: 0 auto;">
																		<form name="write_<?=$frm_num;?>_form" action="trade_view_ok.php?trade_data=<?=$mv_data;?>" method="post" enctype="multipart/form-data">
																			<input type="hidden" name="mode" value="comment_reg">
																			<input type="hidden" name="trade_goods_idx" value="<?=$trade_goods_row->idx;?>">
																		<tr>
																			<td style="text-align:center;">
																				<textarea name="content" style="width:95%;height:50px;padding:10px;" placeholder="등록된 글은 수정, 삭제가 되지 않습니다."></textarea>
																				<!-- 
																				<p style="padding:0 0 0 30px;" >
																					<input type="file" name="upfile" class="formfile" style="max-width:500px;">
																				</p>
																				-->																				
																			</td>
																			<td width="100" height="100" style="padding-bottom:10px; " >
																				<a href="javascript:document.write_<?=$frm_num;?>_form.submit();"   style="">
																				<p style="width:100%; height:60px; text-align: center; background-color:#000; line-height:60px; color:#FFF; font-weight:600; " >
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
														
														<table border="0" width="100%">
															<tr>
																<td height="35">
																<table>
																	<tr>
																		<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">주문자정보</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td height="5">
																</td>
															</tr>
														</table>

														<table width="100%" class="table_all">
															<form name="trade_form" method="post" action="trade_view_ok.php?trade_data=<?=$mv_data;?>">
															<tr align="center" bgColor="white"> 
																<td width="20%" height="35"  bgcolor="E4E7EF" class='contenM tabletd_all'>고객이름</td>
																<td height="35" class='tabletd_all tabletd_small'><?=$trade_stat->order_name;?></td>
															</tr>
															<tr>
																<td width="20%" height="35"  bgcolor="E4E7EF" class='contenM tabletd_all'>연락처</td>
																<td height="35" class='tabletd_all tabletd_small'><?=$trade_stat->order_tel1;?>-<?=$trade_stat->order_tel2;?>-<?=$trade_stat->order_tel3;?></td>
															</tr>															
															<tr>
																<td width="20%" height="35"  bgcolor="E4E7EF" class='contenM tabletd_all'>이메일</td>
																<td height="35" class='tabletd_all tabletd_small'><input type="text" name="order_email" class="formText email" value="<?=$trade_stat->order_email;?>"></td>
															</tr>															
														</table>
														<br>
														
														<table border="0" width="100%">
															<tr>
																<td height="35">
																<table>
																	<tr>
																		<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">배송지정보</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td height="5">
																</td>
															</tr>
														</table>
														
														<table width="100%" class="table_all">
															
															<tr bgColor="white"> 
																<td width="20%" height="35" align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>수령자</td>
																<td height="35" class='tabletd_all tabletd_small'><?=$trade_stat->deliv_name;?></td>
															</tr>
															<tr bgColor="white"> 
																<td align="center"  bgcolor="E4E7EF" class='contenM tabletd_all '>이메일</td>
																<td class='tabletd_all tabletd_small'><input type="text" name="deliv_email" class="formText email" value="<?=$trade_stat->deliv_email;?>"></td>
															</tr>
															<tr bgColor="white"> 
																<td height="35" align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>전 화</td>
																<td height="35" class='tabletd_all tabletd_small'><?=$trade_stat->deliv_tel1;?>-<?=$trade_stat->deliv_tel2;?>-<?=$trade_stat->deliv_tel3;?></td>
															</tr>
															<tr bgColor="white"> 
																<td align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>핸드폰</td>
																<td class='tabletd_all tabletd_small'><?=$trade_stat->deliv_phone1;?>-<?=$trade_stat->deliv_phone2;?>-<?=$trade_stat->deliv_phone3;?></td>
															</tr>
															<tr bgColor="white"> 
																<td height="35" align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>주 소</td>
																<td height="35" class='tabletd_all tabletd_small'>
																우편번호 : <?=$trade_stat->deliv_zip;?><br>
																<?=$trade_stat->deliv_add1;?><br>
																<?=$trade_stat->deliv_add2;?>
																</td>
															</tr>															
															
															<tr bgColor="white">
																<td height="35" align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>주문시 요청사항</td>
																<td height="35" class='tabletd_all tabletd_small'>
																	<div id="comment">
																		<?=$db->stripSlash($trade_stat->deliv_content);?>
																	</div>
																</td>
															</tr>															
															<tr bgColor="white">
																<td height="35" align="center"  bgcolor="E4E7EF" class='contenM tabletd_all' >배송예약일</td>
																<td height="35" class='tabletd_all tabletd_small'>
																	<? if($trade_stat->deliv_pree_day!='0000-00-00 00:00:00') {$year=substr($trade_stat->deliv_pree_day,0,4);?>
																	<select name="deliv_year"><? for($i=date("Y")-3;$i<date("Y")+3;$i++){	$today_year=date("Y", $trade_stat->deliv_pree_day);?>
																		<option value="<?=$i?>" <?if($i==$year) echo("selected");?>><?=$i?></option><?}?>
																	</select>&nbsp;년&nbsp;&nbsp;
																	<select name="deliv_mon"><?for($i=1;$i<13;$i++){if(strlen($i)==1)$i="0".$i; $mon=substr($trade_stat->deliv_pree_day,5,2);?>
																		<option value="<?=$i?>" <?if($i==$mon) echo("selected");?>><?=$i?></option><?}?>
																	</select>&nbsp;월&nbsp;&nbsp;
																	<select name="deliv_day"><?for($i=1;$i<32;$i++){if(strlen($i)==1)$i="0".$i; $day=substr($trade_stat->deliv_pree_day,8,2);?>
																		<option value="<?=$i?>" <?if($i==$day) echo("selected");?>><?=$i?></option><?}?>
																	</select>&nbsp;일<?} else {?> 예약 배송일 없음<?}?></td>
															</tr>
															
															<?/* 오픈마켓에서는 사용안함, 판매자별 상품별로 별도 등록됨
															<tr bgColor="white">
																<td height="35" align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>배송장번호</td>
																<td height="35" class='tabletd_all tabletd_small'><input type="text" name="trade_number" size="30" class="formText" value="<?=$trade_stat->trade_number;?>"></td>
															</tr>
															*/?>
															
															
														</table>
														<br>
														
														<table border="0" width="100%">
															<tr>
																<td height="35">
																<table>
																	<tr>
																		<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">기타정보</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td height="5">
																</td>
															</tr>
														</table>
												<table width="100%" class="table_all">
													
													<tr bgColor="white"> 
														<td height="35" align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>결제방법</td>
														<td height="35" class='tabletd_all tabletd_Lmall'><? if($trade_stat->trade_method==1){;?>카드결제<?} else if($trade_stat->trade_method==2){;?>계좌이체<?} else if($trade_stat->trade_method==3){;?>휴대폰결제<?} else if($trade_stat->trade_method==4){;?>가상계좌 : <?=$trade_stat->trade_method_info;?><?} else if($trade_stat->trade_method==5){;?>무통장입금 : <?=$trade_stat->trade_method_info;?><?} else if($trade_stat->trade_method==6){;?>포인트결제<?}?></td>
													</tr>
													
													<tr>
														<td align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>결제 확인일</td>
														<td class='tabletd_all tabletd_Lmall'><? if($trade_stat->trade_money_ok !='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_stat->trade_money_ok, 5);?><?} else {?><? if($trade_stat->trade_stat==1) {?>결제대기중<?} else if($trade_stat->trade_stat==2){?>결제확인됨<?} else if($trade_stat->trade_stat==3){?>배송중<?} else if($trade_stat->trade_stat==4){?>판매완료됨<?}?><?}?></td>
													</tr>
													<?/* 오픈마켓에서는 사용안함, 판매자별 상품별로 별도 등록됨
													<tr bgColor="white"> 
														<td height="35" align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>발송일</td>
														<td height="35" class='tabletd_all tabletd_Lmall'><? if($trade_stat->trade_start_day !='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_stat->trade_start_day, 5);?><?} else {?><? if($trade_stat->trade_stat==1) {?>결제대기중<?} else if($trade_stat->trade_stat==2){?>결제확인됨<?} else if($trade_stat->trade_stat==3){?>배송중<?} else if($trade_stat->trade_stat==4){?>판매완료됨<?}?><?}?></td>
													</tr>
													<tr>
														<td align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>판매 완료일</td>
														<td  class='tabletd_all tabletd_Lmall'><? if($trade_stat->trade_end_day !='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_stat->trade_end_day, 5);?><?} else {?><? if($trade_stat->trade_stat==1) {?>결제대기중<?} else if($trade_stat->trade_stat==2){?>결제확인됨<?} else if($trade_stat->trade_stat==3){?>배송중<?} else if($trade_stat->trade_stat==4){?>판매완료됨<?}?><?}?></td>
													</tr>
													*/?>
												</table>
															</form>
												

										

												<table style='margin:0 auto;'>
													<tr>
														<td height='70'>
														<a href="javascript:sendit();" class='oolimbtn_bbs_bt2'>등록</a>&nbsp;&nbsp;<a href="trade.php?trade_data=<?=$mv_data;?>" class='oolimbtn_bbs_bt1'>목록으로</a>&nbsp;&nbsp;<a href="#" class='modal oolimbtn_bbs_bt4 noneoolim' data-modal-height="600" data-modal-width="720" data-modal-iframe="trade_view_print.php?trade_data=<?=$mv_data;?>" data-modal-title="프린트하기">프린트하기</a></td>
													</tr>
												</table>
												<br>
											</td>
										</tr>
									</table>
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

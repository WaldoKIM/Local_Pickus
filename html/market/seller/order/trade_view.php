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
<style>
	.table_comm td{
	padding:5px; border-right: 1px solid #ccc; text-align:center;
	}
	.table_comm .contenM td{
	text-align:center;
	}
</style>

<div class="mypage_btn_header">
    <a href="javascript:history.back();" class="back_btn"><img src="../img/back.png" alt=""></a>
    <div class="title">주문 상세보기</div>
</div>
<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/order_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
					
	<!--콘텐츠출력-->
		<table id="list_flex" class="table_all"width="100%" border="0" align="center">
			<tr class="order_border"> 
				<td width="100%" class="trade_view_column">
							
								<?
								$trade_goods_result=$db->select("cs_trade_goods", "where trade_code='$trade_stat->trade_code' and seller='$_SESSION[USERID]' order by idx asc");
								$frm_num=1;
								while( $trade_goods_row=@mysqli_fetch_object( $trade_goods_result)) {
								?>
								
										<div class="trade_view_row">
											<p class="trade_view_con_font1">거래상태</p>
											<p class="trade_view_con_font2">
												<? if( $trade_goods_row->trade_stat < 2) {?>결제대기중<?}?>
												<? if( $trade_goods_row->trade_stat == 2 ){?>결제완료됨<?}?>
												<? if( $trade_goods_row->trade_stat == 3 && $trade_goods_row->invoice_stat == 0){?>배송중<?}?>
												<? if( $trade_goods_row->trade_stat == 3 && $trade_goods_row->invoice_stat == 1){?>배송완료<?}?>
												<? if( $trade_goods_row->trade_stat == 4 ){?>판매완료됨<?}?>
												<? if( $trade_goods_row->trade_stat == 5 ){?>거래취소요청<?}?>
												<? if( $trade_goods_row->trade_stat == 51 ){?>환불대기중<?}?>
												<? if( $trade_goods_row->trade_stat == 52 ){?>취소/환불완료<?}?>
											</p>
										</div>
										</br>
										<div>
											<div class="trade_view_row"><p class="trade_view_con_font1">주문번호</p><p class="trade_view_con_font2"><?=$trade_stat->trade_code;?></p></div>
											<div class="trade_view_row"><p class="trade_view_con_font1">주문접수일</p><p class="trade_view_con_font2"><?=$trade_stat->trade_day;?></p></div>
											<div class="trade_view_row"><p class="trade_view_con_font1">회원아이디</p><p class="trade_view_con_font2"><? if($trade_stat->order_userid) {?><?=$trade_stat->order_userid;?><?} else {?>비회원<?}?></p></div>
											<div class="trade_view_row"><p class="trade_view_con_font1">결제상태</p><p class="trade_view_con_font2"><? if($trade_stat->trade_stat==1) {?>결제대기중<?} else if($trade_stat->trade_stat==2){?>결제확인됨<?} else if($trade_stat->trade_stat==3){?>배송중<?} else if($trade_stat->trade_stat==4){?>판매완료됨<?} else if( $trade_stat->trade_stat == 52 ) {?>결제취소<?}?></p></div>
											<div class="trade_view_row"><p class="trade_view_con_font1">제품명</p><p class="trade_view_con_font2"><?=$trade_goods_row->goods_name;?></p></div>
											<div class="trade_view_row"><p class="trade_view_con_font1">수량</p><p class="trade_view_con_font2"><?=number_format($trade_goods_row->goods_cnt);?> 개</p></div>
											<div class="trade_view_row"><p class="trade_view_con_font1">물품가격</p><p class="trade_view_con_font2"><?=number_format($trade_goods_row->goods_price);?> 원</p></div>
											<div class="trade_view_row"><p class="trade_view_con_font1">배송비</p><p class="trade_view_con_font2"><?=number_format($trade_goods_row->trade_deliv_price);?> 원</p></div>
											<div class="trade_view_row"><p class="trade_view_con_font1">결제금액</p><p class="trade_view_con_font2"><?=number_format($trade_goods_row->goods_price*$trade_goods_row->goods_cnt+$trade_goods_row->trade_deliv_price);?> 원</p></div>
											
											<p style="display:none;" style="text-align:left;">
												<a href="javascript:view_memo(<?=$frm_num;?>);" class="btn_guide1">보기</a>
											</p>
											<!-- <p>
												<?
												$optArr = explode("/^CUT/^", $trade_goods_row->opt_data);
												for($i=0;$i<count($optArr)-1;$i++){
													$optRec = explode("/^/^", $optArr[$i]);
												?>
												옵션<?=$optRec[0];?>:&nbsp;<?=$optRec[1];?><br>
												<?}?>
											</p> -->
										</div>
										</br>
										<div>
											<form name="trade_form" method="post" action="trade_view_ok.php?trade_data=<?=$mv_data;?>">
												<div>
													<div class="trade_view_row"><p class="trade_view_con_font1">주문자</p><p class="trade_view_con_font2"><?=$trade_stat->order_name;?></p></div>
													<div class="trade_view_row"><p class="trade_view_con_font1">연락처</p><p class="trade_view_con_font2"><?=$trade_stat->order_tel1;?></p></div>
													<div class="trade_view_row"><p class="trade_view_con_font1">이메일</p><p class="trade_view_con_font2"><?=$trade_stat->order_email?></p></div>
												</div>
												</br>	
												<div>
													<div class="trade_view_row"><p class="trade_view_con_font1">수령인</p><p class="trade_view_con_font2"><?=$trade_stat->deliv_name;?></p></div>
												
													<div class="trade_view_row"><p class="trade_view_con_font1">이메일</p><p class="trade_view_con_font2"><?=$trade_stat->deliv_email;?></p></div>
												
													<div class="trade_view_row"><p class="trade_view_con_font1">전화번호</p><p class="trade_view_con_font2"><?=$trade_stat->deliv_tel1;?><?=$trade_stat->deliv_tel2;?><?=$trade_stat->deliv_tel3;?></p></div>
												
													<div class="trade_view_row"><p class="trade_view_con_font1">핸드폰</p><p class="trade_view_con_font2"><?=$trade_stat->deliv_phone1;?><?=$trade_stat->deliv_phone2;?><?=$trade_stat->deliv_phone3;?></p></div>
												
													<div>
														<div class="trade_view_row"><p class="trade_view_con_font1">우편번호</p><p class="trade_view_con_font2"><?=$trade_stat->deliv_zip;?></p></div>
														<div class="trade_view_row"><p class="trade_view_con_font1">주소</p><p class="trade_view_con_font2"><?=$trade_stat->deliv_add1;?></p></div>
														<div class="trade_view_row"><p class="trade_view_con_font1">상세주소</p><p class="trade_view_con_font2"><?=$trade_stat->deliv_add2;?></p></div>
													</div>
														
													<div class="trade_view_row"><p class="trade_view_con_font1">요청사항</p><p class="trade_view_con_font2"><?=$db->stripSlash($trade_stat->deliv_content);?></p></div>
													<div class="trade_view_row">	
														<p class="trade_view_con_font1">희망배송일</p>
														<p class="trade_view_con_font2">
															<? if($trade_stat->deliv_pree_day!='0000-00-00 00:00:00') {$year=substr($trade_stat->deliv_pree_day,0,4);?>
															<select name="deliv_year"><? for($i=date("Y")-3;$i<date("Y")+3;$i++){	$today_year=date("Y", $trade_stat->deliv_pree_day);?>
																<option value="<?=$i?>" <?if($i==$year) echo("selected");?>><?=$i?></option><?}?>
															</select>&nbsp;년&nbsp;&nbsp;
															<select name="deliv_mon"><?for($i=1;$i<13;$i++){if(strlen($i)==1)$i="0".$i; $mon=substr($trade_stat->deliv_pree_day,5,2);?>
																<option value="<?=$i?>" <?if($i==$mon) echo("selected");?>><?=$i?></option><?}?>
															</select>&nbsp;월&nbsp;&nbsp;
															<select name="deliv_day"><?for($i=1;$i<32;$i++){if(strlen($i)==1)$i="0".$i; $day=substr($trade_stat->deliv_pree_day,8,2);?>
																<option value="<?=$i?>" <?if($i==$day) echo("selected");?>><?=$i?></option><?}?>
															</select>&nbsp;일<?} else {?> 예약 배송일 없음<?}?>
														</p>
													</div>
													<div class="trade_view_row"><p class="trade_view_con_font1">결제방법</p><p class="trade_view_con_font2"><? if($trade_stat->trade_method==1){;?>카드결제<?} else if($trade_stat->trade_method==2){;?>계좌이체<?} else if($trade_stat->trade_method==3){;?>휴대폰결제<?} else if($trade_stat->trade_method==4){;?>가상계좌 : <?=$trade_stat->trade_method_info;?><?} else if($trade_stat->trade_method==5){;?>무통장입금 : <?=$trade_stat->trade_method_info;?><?} else if($trade_stat->trade_method==6){;?>포인트결제<?}?></p></div>
												
													<div class="trade_view_row"><p class="trade_view_con_font1">결제일</p><p class="trade_view_con_font2"><? if($trade_stat->trade_money_ok !='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_stat->trade_money_ok, 5);?><?} else {?><? if($trade_stat->trade_stat==1) {?>결제대기중<?} else if($trade_stat->trade_stat==2){?>결제확인됨<?} else if($trade_stat->trade_stat==3){?>배송중<?} else if($trade_stat->trade_stat==4){?>판매완료됨<?}?><?}?></p></div>
												</div>
											</form>	
										</div>
									

								<tr id="View_memo<?=$frm_num;?>" align="center" bgColor="white" style="display:none">
									<td colspan="7" style="padding:30px;">	
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
				</td>
			</tr>
			
		</table>
		<table style="margin:auto;">
			<tr>
				<td>
					<div style='margin:0 auto;'>
						<a style="display:none;" href="javascript:sendit();" class='oolimbtn_bbs_bt2'>등록</a>&nbsp;&nbsp;<a href="trade.php?trade_data=<?=$mv_data;?>" class='oolimbtn_bbs_bt1'>목록으로</a>&nbsp;&nbsp;<a href="#" style="display:none;" class='modal oolimbtn_bbs_bt4 noneoolim' data-modal-height="600" data-modal-width="720" data-modal-iframe="trade_view_print.php?trade_data=<?=$mv_data;?>" data-modal-title="프린트하기">프린트하기</a>
					</div>					
				</td>
			</tr>
		</table>
	<!--콘텐츠출력-->

				
	</article>
	
</div>



<? include('../footer.php'); ?>

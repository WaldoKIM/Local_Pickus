<?
include('../header.php');
include($ROOT_DIR."/lib/style_class.php");
////$_GET=&$HTTP_GET_VARS; //$_POST=&$HTTP_POST_VARS;
$mv_data	= $_GET[mem_data];
$mem_data	= $tools->decode( $_GET[mem_data] );
$row = $db->object("cs_member", "where idx='$mem_data[idx]'");
$total_point = $db->sum("cs_point", "where userid='$row->userid'", "point");
$buy_goods_cnt = $db->cnt("cs_trade", "where order_userid='$row->userid' and trade_stat=4");
$level_view = $db->object("cs_user_list", "where idx='$row->level'");
?>
<script language="JavaScript">
<!--
// 거래정보보기
function tradeView( mv_data ) {
	location.href='../order/trade_view.php?trade_data='+mv_data;
}

////  회원에게 메일 보내기 ///////////////////////////////////////////////////////////////////////////////
function userSendmailWinOpen(data) {
	window.open("../member/user_sendmail.php?user_mail="+data,"","scrollbars=no, width=484, height=500");
}

//-->
</script>
<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/member_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">

		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">회원관리</b>
				</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#dddddd"></td>
			</tr>
			<tr>
				<td height="25"></td>
			</tr>
			<tr>
				<td class="padding_5">
					<table  width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
								<table width="100%">
									<tr> 
										<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">

											<table width="100%">
												<tr> 
													<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">회원정보수정</td>
												</tr>
											</table>
											<table width="100%" class="table_all">
												<tr>
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;아이디</td>
													<td class='tabletd_all tabletd_small'><?=$row->userid;?></td>
												</tr>
												<tr> 
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;비밀번호</td>
													<td class='tabletd_all tabletd_small'>*************</td>
												</tr>
												<tr> 
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;이 름</td>
													<td class='tabletd_all tabletd_small'><?=$row->name;?></td>
												</tr>
												<tr> 
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;이메일</td>
													<td class='tabletd_all tabletd_small' class="menu"><?=$row->email;?></td>
												</tr>
												<?if($admin_stat->member_birth==1){?>
												<tr bgColor="white"> 
													<td width="20%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;생년월일</td>
													<td height="35" class='sensP tabletd_all'><?=$row->birthy;?>-<?=$row->birthm;?>-<?=$row->birthd;?></td>
												</tr>
												<?}?>
												<?if($admin_stat->member_tel==1){?>
												<tr bgColor="white"> 
													<td width="20%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;전화번호</td>
													<td height="35" class='sensP tabletd_all'><?=$row->tel1;?>-<?=$row->tel2;?>-<?=$row->tel3;?></td>
												</tr>
												<?}?>
												<?if($admin_stat->member_phone==1){?>
												<tr bgColor="white"> 
													<td width="20%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;휴대폰</td>
													<td height="35" class='sensP tabletd_all'><?=$row->phone1;?>-<?=$row->phone2;?>-<?=$row->phone3;?></td>
												</tr>
												<?}?>
												<?if($admin_stat->member_addr==1){?>
												<tr bgColor="white"> 
													<td width="20%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;우편번호</td>
													<td height="35" class='sensP tabletd_all'><?=$row->zip;?></td>
												</tr>
												<tr bgColor="white"> 
													<td width="20%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;주 소</td>
													<td height="35" class='sensP tabletd_all'><?=$row->add1;?>&nbsp;<?=$row->add2;?></td>
												</tr>
												<?}?>
												<tr> 
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;회원 레벨</td>
													<td class='tabletd_all tabletd_small'><?=$level_view->name?></td>
												</tr>
												<tr> 
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;포인트</td>
													<td class='tabletd_all tabletd_small'><? if($total_point) { echo(number_format($total_point)." 점");} else { echo("누적 포인트가 없습니다.");}?></td>
												</tr>
												<tr> 
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;구매횟수</td>
													<td class='tabletd_all tabletd_small'><?=number_format($buy_goods_cnt);?>&nbsp;번</td>
												</tr>
												<tr> 
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;로그인접속수</td>
													<td class='tabletd_all tabletd_small'><?=number_format($row->connect);?>&nbsp;번</td>
												</tr>
												<? if( $admin_stat->member_check ) {?>
												<tr> 
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;추천인아이디</td>
													<td class='tabletd_all tabletd_small'><? if($row->recomid) { echo($row->recomid);} else { echo("추천인이 없습니다.");}?></td>
												</tr>
												<?}?>
												<tr> 
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;인사말</td>
													<td class='tabletd_all tabletd_small'><?=$tools->strHtmlNo($row->content);?></td>
												</tr>
												<tr> 
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;메일링서비스</td>
													<td class='tabletd_all tabletd_small'><? if( $row->mailing == 1 ) { echo("메일링서비스를 받습니다.");} else  if( $row->mailing == 0 ) { echo("메일링서비스를 받지 않습니다.");} ?></td>
												</tr>
											</table><br>

											<table style='margin:0 auto;'>
											<tr>
												<td><a href="javascript:history.back()" class='oolimbtn-botton1_1'>목록으로</a><a href="member_edit.php?mem_data=<?=$mv_data;?>" class='oolimbtn-botton1'>회원정보 수정하기</a></td>
											</tr>
											</table>

											<table>
											<tr>
												<td height='40'></td>
											</tr>
											</table>
											<table width="100%">
												<tr> 
													<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">회원주문내역</td>
												</tr>
											</table>
											<table width="100%" class="table_all">
												<tr align="center" bgcolor="f5f5f5"> 
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>No</td>
													<td bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>주문번호</td>
													<td bgcolor="E4E7EF" class='contenM tabletd_all'>주문자</td>
													<td bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>적립포인트</td>
													<td bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>결제금액</td>
													<td bgcolor="E4E7EF" class='contenM tabletd_all'>결제방법</td>
													<td bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>전화번호</td>
													<td bgcolor="E4E7EF" class='contenM tabletd_all'>주문일</td>
													<td bgcolor="E4E7EF" class='contenM tabletd_all'>거래상태</td>
													<td bgcolor="E4E7EF" class='contenM tabletd_all'>거래관리</td>
												</tr>
												<?
												$table				= "cs_trade";
												$result		= $db->select( $table, "where order_userid='$row->userid' order by trade_day desc" );
												while( $trade_row = mysqli_fetch_object($result)) {
													$form_name++; // 폼네임변경 숫자증가
													$trade_data = $tools->encode("idx=".$trade_row->idx."&trade_stat=".$trade_row->trade_stat."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&search_day=".$search_day."&search_day_str=".$search_day_str);
												?>
												<tr align="center">
													
													<td class='tabletd_all tabletd_Lmall noneoolimmoL'><?=++$listNo;?></td>
													
													<td class='tabletd_all tabletd_Lmall noneoolimmoL'><?=$trade_row->trade_code;?></td>
													
													<td class='tabletd_all tabletd_Lmall'><a href="javascript:userSendmailWinOpen('<?=$trade_row->order_email;?>');"><?=$trade_row->order_name;?></a></td>
													
													<td class='tabletd_all tabletd_Lmall noneoolimmoL' align="right"><? if($trade_row->order_userid) {?><? if($trade_row->trade_stat==4) {?> <?=number_format($trade_row->trade_save_point);?> ⓟ 적립<?} else {?><?=number_format($trade_row->trade_save_point);?> ⓟ 예정<?}?><?} else {?><font color="#FF9933">비회원</font><?}?></font></td>
													
													<td class='tabletd_all tabletd_Lmall noneoolimmoL' align="right"><font color="#FF0000"><?=number_format($trade_row->trade_price);?>원</font></td>
													
													<td class='tabletd_all tabletd_Lmall'>
													<span class='noneoolimmoL_on' style='text-align:center;'>결제금액<br>
													<font color="#FF0000"><?=number_format($trade_row->trade_price);?>원</font><hr /></span>
													
													<? if($trade_row->trade_method==1){;?>카드결제<?} else if($trade_row->trade_method==2){;?>계좌이체<?} else if($trade_row->trade_method==3){;?>휴대폰결제<?} else if($trade_row->trade_method==4){;?>가상계좌<?} else if($trade_row->trade_method==5){;?>무통장입금<?} else if($trade_row->trade_method==6){;?>포인트결제<?}?>
													
													<span class='noneoolimmoL_on' style='text-align:center;'><hr />적립포인트<br>
													<? if($trade_row->order_userid) {?><? if($trade_row->trade_stat==4) {?> <?=number_format($trade_row->trade_save_point);?> ⓟ 적립<?} else {?><?=number_format($trade_row->trade_save_point);?> ⓟ 예정<?}?><?} else {?><font color="#FF9933">비회원</font><?}?></font></span>
													</td>
													
													<td class='tabletd_all tabletd_Lmall noneoolimmoL'><?=$trade_row->order_tel1;?>-<?=$trade_row->order_tel2;?>-<?=$trade_row->order_tel3;?></td>
													
													<td class='tabletd_all tabletd_Lmall'><?=$tools->strDateCut($trade_row->trade_day,1);?></td>
													
													<td class='tabletd_all tabletd_Lmall'><? if($trade_row->trade_stat==1) {?><font color="#999999">결제대기중</font><?} else if($trade_row->trade_stat==2){?><font color="#666666">결제확인됨</font><?} else if($trade_row->trade_stat==3){?><font color="#FF5A00">상품배송중</font><?} else if($trade_row->trade_stat==4){?><font color="#FF0000">판매완료됨</font><?}?>
													</td>
													
													<td width='50' class='tabletd_all tabletd_Lmall'><a href="javascript:tradeView('<?=$trade_data;?>');" class="menusmall_btn3">보기</a></td>
												</tr>
												</form>
												<?
												}
												?>
											</table><br><br>
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


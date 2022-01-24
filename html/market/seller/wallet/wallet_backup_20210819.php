<?
include('../header.php');
include($ROOT_DIR."/lib/page_class.php");
//$_GET=&$HTTP_GET_VARS; 
//$_POST=&$HTTP_POST_VARS;

// 상품리뷰레벨 수정(level) 변수
if($_POST[hidden_level_idx]) { $db->update("cs_goods_qna", "coment_check='$_POST[admin_auth]' where idx='$_POST[hidden_level_idx]'");}
$mv_data	= $_GET[point_data];
$wallet_data	= $tools->decode( $_GET[point_data] );
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $wallet_data[idx]; }
if($_GET[listNo] )					{ $listNo = $_GET[listNo]; }									else { $listNo = $wallet_data[listNo]; }
if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $wallet_data[startPage]; }

mt_srand((double)microtime()*1000000);
$TRADE_CODE=chr(mt_rand(65, 90));
$TRADE_CODE.=chr(mt_rand(65, 90));
$TRADE_CODE.=chr(mt_rand(65, 90));
$TRADE_CODE.=chr(mt_rand(65, 90));
$TRADE_CODE.=chr(mt_rand(65, 90));
$TRADE_CODE.=time();

$member_stat = $db->object("cs_member","where userid = '$_SESSION[USERID]' ");

?>

<script language="JavaScript">
<!--
// 검색기능
function search(){
	var form=document.review_form;
	if(form.search_order.value=="")	{
		alert("검색할 내용을 입력해 주십시오.");
		form.search_order.focus();
	} else {
		form.submit();
	}
}

//출금요청
function point_out(){
	var return_value = confirm('출금요청을 하시겠습니까?');
	if(return_value){
			document.point_out_form.submit();
	}
}
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/wallet_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">

		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">수익금 관리
				</td>
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
								<table width="100%">
									<tr> 
										<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
										<table width="100%">
												<tr>
												<td>
													<table width="100%">
														<tr>
															<td height="25">
															<table>
																<tr>
																	<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">수익금 관리</td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20">
																<!--도움말-->
																	<table width="100%" class='tipbox noneoolim'>
																		<tr>
																			<td bgcolor="#E9F2F8">
																				<table width="100%">
																					<tr>
																						<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																					</tr>
																					<tr>
																						<td class='sensbody'>수익금 내역과 출금 신청을 할수 있습니다.</td>	
																					</tr>
																				</table>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div>
																					<br>
																					### 판매 수수료 부과 안내 ###<br><br>

																					1. 서비스 판매 완료<br>
																					2. 수수료 15%를 제한 판매대금을 포인트로 적립<br>
																					3. 출금 요청시 <br>
																					4. 회원정보에 입력된 입금계좌로 정산(공휴일 제외, 평일 3시 이후 입금 처리)<br>
																					<br>			
																				</div>																							
																			</td>
																		</tr>																		
																	</table>
																<!--도움말-->
															</td>
														</tr>
														<tr>
															<td height="5">
															</td>
														</tr>
													</table>
												</td>
												</tr>
											</table>
											<table width="90%">
												<tr>
													<td>
														<form action="./wallet_ok.php?point_data=<?=$mv_data;?>" method="post" name="bank_form">
															입금계좌 : 
															<input type="hidden" name="mode" value="bank">
															은행 <input type="text" name="bank" class="formText" value="<?=$member_stat->bank;?>"> 
															계좌번호 <input type="text" name="account_num" class="formText"  value="<?=$member_stat->account_num;?>">
															예금주 <input type="text" name="account_name" class="formText"  value="<?=$member_stat->account_name;?>">
															<a href="javascript:document.bank_form.submit();" class="btn_guide1">등록</a>
														</form>
													</td>
												</tr>
												</tr>
													<td style='text-align:right' class='ordertitle' height="45">														
														<form action="./wallet_ok.php?point_data=<?=$mv_data;?>" method="post" name="point_out_form">
															<?
																$total_point = $db->sum("cs_cash", "where userid='$_SESSION[USERID]'", "point"); 
															?>
															<input type="hidden" name="use_point" value="<?=$total_point;?>">
															<input type="hidden" name="code" value="<?=$TRADE_CODE;?>">
																현재  나의 수익금 잔액 : <font color='FF7800'><?=number_format($total_point);?></font>&nbsp;원
															<?if($member_stat->bank && $member_stat->account_num && $member_stat->account_name){?>
																<a href="javascript:point_out();" class="btn_guide1">출금 요청</a>
															<?}else{?>
																<span style="color:red">(입금계좌 등록 후 출금요청이 가능합니다.)</span>
															<?}?>
														</form>
													</td>
												</tr>
											</table>											
											<table width="100%" class="table_all">
												<tr height='40'> 
													<td bgcolor="E4E7EF" class='contenM tabletd_all revbox_none'>No</td>
													<td bgcolor="E4E7EF" class='contenM tabletd_all'>거래내역</td>
													<td bgcolor="E4E7EF" class='contenM tabletd_all'>수익금</td>													
													<td width="95" bgcolor="E4E7EF" class='contenM tabletd_all'>거래일자</td>
												</tr>
												<?
													$listScale			=	10; 		// 리스트갯수
													$pageScale		=	10;		// 페이지 갯수
													if( !$startPage ) { $startPage = 0; }		// 스타트 페이지
													$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
													$totalList	= $db->cnt( "cs_cash", "where userid='$_SESSION[USERID]'" );
													$result	= $db->select("cs_cash", "where userid='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale" );
													if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }		// 페이지넘버
													while( $row = mysqli_fetch_object($result)) {
													?>
												<tr bgColor="white" align="center" height="25"> 
													<td class='tabletd_all tabletd_Lmall revbox_none'>
														<?=$listNo;?>
													</td>
													<td class='tabletd_all tabletd_Lmall'>
														<?=$row->title;?>
													</td>
													<td class='tabletd_all tabletd_Lmall'>
														<!-- 포인를 사용한 경우 색상변경 -->
														<? if($row->point < 0) {?><font color="#FF7800"><?=number_format($row->point);?></font><?} else {?><font color="#3A73BF"><?=number_format($row->point);?><?}?></font> 원														
													</td>
													<td width="95" class='tabletd_all tabletd_Lmall'>
														<?=$tools->strDateCut($row->register, 1);?>
													</td>
												</tr>
												<?
													$listNo--;	
												}
												?>
											</table>
											<table width="100%" class="submenu">
												<tr> 
													<td height="60" style='text-align:center' valign="middle">
														<? $page->my_point( $totalPage, $totalList, $listScale, $pageScale, $startPage, "", "", "", "");?>
													</td>
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
	</article>
	
</div>



<? include('../footer.php'); ?>

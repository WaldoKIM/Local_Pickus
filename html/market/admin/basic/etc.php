<?
include('../header.php'); 
include($ROOT_DIR.'/lib/style_class.php'); 
// 관리자 정보 불러오기.
$admin_stat = $db->object("cs_admin", "");
?>

<script language="JavaScript">
<!--
// 폼 전송
function sendit() {
	var form=document.admin_form;
	form.submit();
}
//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/sub_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">기타설정
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
									<table width="100%" border="0" align="center">
									<form action="etc_ok.php" method="post" name="admin_form">
										<tr> 
											<td align="center" valign="top" bgcolor="#FFFFFF" class="menu">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
													<td>
														<table width="100%">
															<tr>
																<td height="25">
																<table>
																	<tr>
																		<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">메일발송관리</td>
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
																							<td height="20">
																								<img src="../img/tip_icon.gif" width="28" height="11" border="0">
																							</td>
																						</tr>
																						<tr>
																							<td class='sensbody'>메일설정 : 구매자의 진행상황(회원가입, 주문, 결제, 배송)에 따른 메일설정<br>(모두 
																						체크를 하시면 사용자, 관리자 모두에게 메일이 보내집니다.)</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		</table>
																	<!--도움말--->
																</td>
															</tr>
															<tr>
																<td height="5"></td>
															</tr>
														</table>
													</td>
													</tr>
												</table>
												<table width="100%" class="table_all">
													<tr> 
														<td height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>회원가입</td>
														<td height="25" bgColor="white" class='tabletd_all tabletd_small'>&nbsp; <input type="checkbox" name="register_member" value="1" <? if( $admin_stat->register_member) { echo("checked");}?>>사용자 <input type="checkbox" name="register_admin" value="1" <? if( $admin_stat->register_admin) { echo("checked");}?>>관리자</td>
														<td height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>주문메일</td>
														<td height="25" bgColor="white" class='tabletd_all tabletd_small'>&nbsp; <input type="checkbox" name="order_member" value="1" <? if( $admin_stat->order_member) { echo("checked");}?>>사용자 <input type="checkbox" name="order_admin" value="1" <? if( $admin_stat->order_admin) { echo("checked");}?>>관리자</td>
													</tr>
													<tr> 
														<td height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>결제완료</td>
														<td height="25" bgColor="white" class='tabletd_all tabletd_small'>&nbsp; <input type="checkbox" name="account_member" value="1" <? if( $admin_stat->account_member) { echo("checked");}?>>사용자 <input type="checkbox" name="account_admin" value="1" <? if( $admin_stat->account_admin) { echo("checked");}?>>관리자</td>
														<td height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>배송메일</td>
														<td height="25" bgColor="white" class='tabletd_all tabletd_small'>&nbsp; <input type="checkbox" name="delivery_member" value="1" <? if( $admin_stat->delivery_member) { echo("checked");}?>>사용자 <input type="checkbox" name="delivery_admin" value="1" <? if( $admin_stat->delivery_admin) { echo("checked");}?>>관리자</td>
													</tr>
												</table><br>
											</td>
										</tr>
										<tr> 
											<td height="20"></td>
										</tr>
										<tr> 
											<td height="150" align="center" bgcolor="#FFFFFF" class="menu"><br>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
													<td>
														<table width="100%">
															<tr>
																<td height="25">
																<table>
																	<tr>
																		<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">가격표시기능</td>
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
																							<td height="20">
																								<img src="../img/tip_icon.gif" width="28" height="11" border="0">
																							</td>
																						</tr>
																						<tr>
																							<td class='sensbody'>가격표시기능 : 회원 및 비회원에게 노츨권한을 설정하실수 있습니다.</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		</table>
																	<!--도움말--->
																</td>
															</tr>
															<tr>
																<td height="5"></td>
															</tr>
														</table>
													</td>
													</tr>
												</table>
												<table width="100%" class="table_all">
													<tr> 
														<td height="25" align="center" rowspan="2" bgcolor="C7CEDE" class='contenM tabletd_all'>가격표시기능</td>
														<td height="25" align="center" bgcolor="C7CEDE" class='contenM tabletd_all'>비회원</td>
														<td height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>소비자가격</td>
														<td height="25" bgcolor="white" class='tabletd_all tabletd_small'>&nbsp; <input type="radio" name="nomember_old_price" value="1" <? if( $admin_stat->nomember_old_price==1) { echo("checked");}?>>표시함 <input type="radio" name="nomember_old_price" value="0" <? if( $admin_stat->nomember_old_price==0) { echo("checked");}?>>표시안함</td>
														<td height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>판매가격</td>
														<td height="25" bgcolor="white" class='tabletd_all tabletd_small'>&nbsp; <input type="radio" name="nomember_shop_price" value="1" <? if( $admin_stat->nomember_shop_price==1) { echo("checked");}?>>표시함 <input type="radio" name="nomember_shop_price" value="0" <? if( $admin_stat->nomember_shop_price==0) { echo("checked");}?>>표시안함</td>
													</tr>
													<tr> 
														<td height="25" align="center" bgcolor="C7CEDE" class='contenM tabletd_all'>회 원</td>
														<td height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>소비자가격</td>
														<td height="25" bgcolor="white" class='tabletd_all tabletd_small'>&nbsp; <input type="radio" name="member_old_price" value="1" <? if( $admin_stat->member_old_price==1) { echo("checked");}?>>표시함 <input type="radio" name="member_old_price" value="0" <? if( $admin_stat->member_old_price==0) { echo("checked");}?>>표시안함</td>
														<td height="25" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>판매가격</td>
														<td height="25" bgcolor="white" class='tabletd_all tabletd_small'>&nbsp; <input type="radio" name="member_shop_price" value="1" <? if( $admin_stat->member_shop_price==1) { echo("checked");}?>>표시함 <input type="radio" name="member_shop_price" value="0" <? if( $admin_stat->member_shop_price==0) { echo("checked");}?>>표시안함</td>
													</tr>
												</table><br>
											</td>
										</tr>
										<tr> 
											<td height="20"></td>
										</tr>
										<tr> 
											<td height="75" align="center" valign="top" bgcolor="#FFFFFF" class="menu"><br> 
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
													<td>
														<table width="100%">
															<tr>
																<td height="25">
																<table>
																	<tr>
																		<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">특별할인율설정</td>
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
																							<td height="20">
																								<img src="../img/tip_icon.gif" width="28" height="11" border="0">
																							</td>
																						</tr>
																						<tr>
																							<td class='sensbody'>상품구입시 레벨별로 상품을 할인해 주는 할인율 설정</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		</table>
																	<!--도움말--->
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

												<table width="100%" class="table_all"> 
													<tr> 
														<td height="22" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>특별할인율</td>
														<td height="25" bgColor="white" class='tabletd_all tabletd_small'>
															<table width="100%">
																<tr>
																	<td height="25" width="20%" class='sensbody' style='border-bottom: 1px solid #ddd;'>
																	비회원&nbsp;:
																	</td>
																<td height="25" style='border-bottom: 1px solid #ddd;'>
																	<input name="dc0" type="text" class="formText" maxlength="3" size="3" value="<?=$admin_stat->dc0;?>" <?=$style->align(0);?>
																	<?=$style->strCheck(1);?>> %
																	</td>
																</tr>
																	<?
																	$user_result = $db->select( "cs_user_list", " order by idx asc"); 
																	while( $user_row = @mysqli_fetch_object($user_result) ) {?>
																<tr>
																	<td height="25" class='sensbody' style='border-bottom: 1px solid #ddd;'>
																	<?=$user_row->name?>&nbsp;:
																	</td>
																	<td height="25" class='sensbody' style='border-bottom: 1px solid #ddd;'>
																	<input name="dc<?=$user_row->idx?>" type="text" class="formText" maxlength="3" size="3" value="<?=$admin_stat->{"dc".$user_row->idx};?>" <?=$style->align(0);?> <?=$style->strCheck(1);?>> %
																	<?}?>&nbsp;로 할인율 적용됩니다.&nbsp;(퍼센트[10,20,50] 입력)
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr> 
											<td height="20"></td>
										</tr>
										<tr> 
											<td height="75" align="center" valign="top" bgcolor="#FFFFFF" class="menu"><br> 
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
													<td>
														<table width="100%">
															<tr>
																<td height="25">
																<table>
																	<tr>
																		<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">임시정보삭제</td>
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
																							<td height="20">
																								<img src="../img/tip_icon.gif" width="28" height="11" border="0">
																							</td>
																						</tr>
																						<tr>
																							<td class='sensbody'>DB에 저장된 임시정보들을 삭제합니다. (금일 이전의 정보들만 삭제되니 참고하세요.)</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		</table>
																	<!--도움말--->

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
												<!--임시 정보 삭제 자바스크립트-->			
												<script language="JavaScript">
												<!--
												function tmpDel() {
													var choose = confirm( '임시 정보를 삭제 하시겠습니까?');
													if(choose) {	location.href='etc_tmp_ok.php?tmp=1'; }
													else { return; }
												}
												//-->
												</script>
												<!--임시 정보 삭제 자바스크립트-->
												<table width="100%" class="table_all">
													<tr> 
														<td height="35" colspan="2" align="center" bgcolor="F8F0E6" class='contenM tabletd_all'>
															장바구니 및 거래정보 임시 정보 삭제 : &nbsp;&nbsp;<a href="javascript:tmpDel();" class='searchB'>임시정보삭제</a>
															<br><br>
															배송 후 15일 이상 경과된 상품을 판매완료로 일괄 변경  : &nbsp;&nbsp;<a href="trade_stat_4_ok.php" class='searchB'>일괄 변경</a>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr> 
											<td height="60">
												<table style='margin:0 auto;'>
													<tr>
														<td height='70'><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
													</tr>
												</table>
											</td>
										</tr>
									</form>
									</table>
								<!--콘텐츠출력-->
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</article>
	
</div>



<? include('../footer.php'); ?>

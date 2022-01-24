<?
include('../header.php');
// 관리자 정보 불러오기.
$admin_stat = $db->object("cs_admin", "");
?>
<script language="javascript">
<!--
// 폼 전송
function sendit() {
	var form=document.admin_form;
	form.delivery.value = myeditor.outputBodyHTML();
	if(form.delivery.value=="") {
		alert("배송정보를 입력해 주세요.");
		form.delivery.focus();
	} else {
		form.submit();
	}
}

// 웹FTP 새창 오픈
function ftpWinOpen() {
	window.open("../webftp.php","","scrollbars=yes, width=500, height=600");
}

// TEXTAREA 입력 폼 크기 조정
function textarea_resize( formname, size ) {
	if( size=='reset' ){
		formname.rows = 15;
	}else{
		var value = formname.rows + size;
		if(value>16) formname.rows = value;
		else return;
	}
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
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">배송설정
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
								<form action="delivery_ok.php" method="post" name="admin_form">
									<tr>
										<td align="center" valign="top" bgcolor="#FFFFFF" class="menu">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<td>
													<table border="0"  width="100%">
														<tr>
															<td height="25">
															<table width="100%">
																<tr>
																	<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">배송설정</td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20">
																<!--도움말-->
																	<table width="100%" class='tipbox'>
																		<tr>
																			<td bgcolor="#E9F2F8">
																				<table width="100%">
																					<tr>
																						<td height="20">
																							<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
																						</td>
																					</tr>
																					<tr>
																						<td><p>제품상세보기 페이지에 보여지는 배송관련 내용을 입력 해주세요.</p></td>
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
													<td width="15%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>배송업체</td>
													<td height="25" class='tabletd_all tabletd_small'>&nbsp;<input name="delivery_company" type="text" class="formText" value="<?=$admin_stat->delivery_company;?>"> (예 : 한진택배)&nbsp;&nbsp;</td>
												</tr>
												<tr>
													<td width="15%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>송장확인URL</td>
													<td height="25" class='tabletd_all tabletd_small' style='letter-spacing: -0.01em;'>&nbsp;<input name="delivery_url" type="text" class="formText formText_subject" value="<?=$admin_stat->delivery_url;?>"><br>
													<font color="red">치환코드 : __EXPRESS_NUM__</font><br>
													<span class='noneoolim'>송장확인 URL주소에서 송장코드 부분을 치환코드(__EXPRESS_NUM__)로 변경하여 입력하여 주세요.<br><br>
													ex)<br>
													우체국 : http://service.epost.go.kr/trace.RetrieveRegiPrclDeliv.postal?sid1=__EXPRESS_NUM__<br><br>
													로젠택배 : http://d2d.ilogen.com/d2d/delivery/invoice_tracesearch_quick.jsp?slipno=__EXPRESS_NUM__<br><br>
													KGB택배 : http://www.kgbls.co.kr/sub5/trace.asp?f_slipno=__EXPRESS_NUM__<br><br>
													CJ택배 : http://www.cjgls.co.kr/kor/service/service02_01.asp?slipno=__EXPRESS_NUM__<br><br>
													옐로우캡 : http://www.yellowcap.co.kr/custom/inquiry_result.asp?INVOICE_NO=__EXPRESS_NUM__<br><br>
													한진택배 : http://www.hanjin.co.kr/Delivery_html/inquiry/result_waybill.jsp?wbl_num=__EXPRESS_NUM__<br><br>
													현대택배 : http://www.hlc.co.kr/hydex/jsp/tracking/trackingViewCus.jsp?InvNo=__EXPRESS_NUM__<br><br>
													대신택배 : http://home.daesinlogistics.co.kr/daesin/jsp/d_freight_chase/d_general_process2.jsp?billno1=__EXPRESS_NUM__<br><br>
													천일택배 : http://www.cyber1001.co.kr/kor/taekbae/HTrace.jsp?transNo=__EXPRESS_NUM__<br><br>

													위의 예제와 같이 택배사 조회 URL을 입력하시면 사용자 페이지 주문상세정보에서 자동으로 __EXPRESS_NUM__코드가 운송장번호로 치환되어 조회가 가능하게 됩니다.<br>
													택배사 배송조회 시스템이 빈번하게 URL정보가 변경이 발생하고 있으니 운송장조회가 되지 않을 경우에는 거래 택배사에 연락하셔서 관련 URL 정보를 다시 제공받아 수정하시기 바랍니다.<br>
													</span>

													</td>
												</tr>
												<tr> 
													<td width="15%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>배송 내용</td>
													<td height="25" class='tabletd_all tabletd_small'>
														<table width="100%" border="0" height="30">
															<tr> 
																<td height="3" colspan="2"></td>
															</tr>
															<tr> 
																<td colspan="2">&nbsp;
																	<input type="hidden" name="delivery_tag" value="1">
																	<textarea id="delivery" name="delivery" style="display:none"><?=$admin_stat->delivery?></textarea>
																	<!-- 에디터를 화면에 출력합니다. -->
																	<script type="text/javascript" language="javascript">
																		var myeditor = new cheditor();
																		myeditor.config.editorHeight = '500px';             // 에디터 세로폭입니다.
																		myeditor.config.editorWidth = '100%';                // 에디터 가로폭입니다.
																		myeditor.inputForm = 'delivery';                     // 입력 textarea의 ID 이름입니다.
																		myeditor.run();                                     // 에디터를 실행합니다.
																	</script>
																</td>
															</tr>
															<tr> 
																<td height="5" colspan="2"></td>
															</tr>
														</table>
													</td>
												</tr>
											</table><br>
											<a href="javascript:sendit();" class="oolimbtn-botton1">등록</a><br><br>
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


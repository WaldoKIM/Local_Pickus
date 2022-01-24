<?
	include('../header.php');
	include($ROOT_DIR.'/lib/style_class.php'); 
	$securityinfo = $db->object("cs_security_setup", "");
	// 기본 관리자 정보 불러오기.
?>

<script language="javascript">
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
		<table width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">보안서버관리
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
					<table width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
						<table width="100%">
							<form action="securitypage_ok.php" method="post" name="admin_form">
							<!-- 한단락 -->
							<tr>
								<td height="5" bgcolor="#F6F6F6" class="padding_5">
												<table width="100%" bgcolor="white">
														<td valign="top" align="right" class="padding_5">
															<table width="100%">
																<tr>
																	<td class="sub_titleM" height="35"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">보안서버 사용여부</td>
																</tr>
																<tr>
																	<td height="10">
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
																								<td>* 보안서버 적용시 선택하시기 바랍니다. 신청후 별도의 포트번호가 발급이 된다면 포트번호도 입력하여 주세요.
																								<br>보안서버 적용의 경우 전체 사이트를 적용하지 않으며 필요한 부분에 적용됩니다. <br>
																								예)로그인, 회원가입, 주문시 주문자 정보 입력등 개인정보가 필요한 경우 적용됩니다.</td>
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
																<tr>
																	<td height="5">
																		<table width="100%" bgcolor="white">
																			<tr>
																				<td valign="top" align="right" class="padding_5">
																					<table width="100%" class="table_all">
																						<tr>
																							<td width="15%" height="25" align="center" bgcolor="#F0F6DF" class='contenM tabletd_all'>
																								사용유무
																							</td>
																							<td height="25"  class='tabletd_all tabletd_small'>
																								&nbsp;<input name="securityuse" type="checkbox" value="1" <?if($securityinfo->securityuse==1){?>checked<?}?>> 사용시 체크를 선택하여 주세요.<br>
																								사이트접속시 프레임을 사용할경우 보안서버적용에 문제가 될수 있으니 사용에 주의하시기 바랍니다.
																							</td>
																						</tr>
																						<tr>
																							<td width="15%" height="25" align="center" bgcolor="#F0F6DF" class='contenM tabletd_all'>
																								전용포트
																							</td>
																							<td height="25" class='tabletd_all tabletd_small'>
																								&nbsp;<input name="securityport" type="text" class="formText" maxlength="5" size="5" value="<?=$securityinfo->securityport;?>"> 전용포트가 있을 경우 입력하시기 바랍니다.
																							</td>
																						</tr>
																						<tr>
																							<td width="15%" height="25" align="center" bgcolor="#FFEFEF"  class='contenM tabletd_all'>
																								신규가입<br>갱신/재발급<br>신청 문의
																							</td>
																							<td height="55" bgcolor="#FFEFEF" class='tabletd_all tabletd_small'>
																								&nbsp; <a href="http://www.oolim.net" target="_new">www.oolim.net</a> / 02-338-0384
																							</td>
																						</tr>
																					</table><br>
																					<div align='center'><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></div>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td>
																	</td>
																</tr>
															</table><br><br>

															<table width="100%" class="table_all" border="0" align="center">
																<tr>
																	<td bgcolor="#FFDFDF" height='40' style='text-align:center'>
																		<font color="red">SSL(보안서버), 보안인증서를 설치함으로써</font>
																	</td>
																</tr>
																<tr>
																	<td height='1' bgcolor="#555555"></td>
																</tr>
																<tr>
																	<td bgcolor="white" style="padding-left:15px;">
																	스니핑툴(sniffing) - 학교, PC방, 회사 등의 공용 네트워크를 사용하는 PC에서 SSL이 설치되지 않은 사이트로 접속할 경우, 개인정보가 타인에게 노출될 가능성이 매우 높습니다.
																	스니핑툴(sniffing)은 P2P사이트 등에서도 간단히 구할 수 있는 프로그램으로 이를 공용네트워크에서 사용할 경우 다른 사람의 개인정보(ID /PW /이메일/주소/주민번호/전화번호 등)를 손쉽게 얻을 수 있기 때문입니다
																	<br><br>
																	피싱(phising)공격- SSL웹서버 인증서가 적용된 웹사이트를 대상으로 피싱(phising)공격을 시도하기가 어렵습니다.
																	해커 등의 제 3자가 아무리 유사사이트를 만들어 피싱을 시도하더라도 SSL 보안서버 인증서가 웹사이트의 실체성을 인정받았음을 의미하기 때문에 피싱으로 인한 피해를 방지할 수 있습니다.
																	<br><br>
																	데이터 변조방지- 사용자의 웹 브라우저로부터 웹 서버까지 전달되는 데이터의 전송 결과가 제 3자의 악의적인 개입으로 임의로 변조될 수 있습니다.
																	- 각종 통신환경을 이용하여, 컴퓨터 내의 정보 또는 데이터의 전송결과를 임의로 변조하는 범죄의 일종으로서 제 3자의 악의적인 개입으로 인하여 데이터 값이 변조될 가능성이 상당히 큽니다. 직장 내 급여의 변경, 온라인 이체 시 금액변조, 학생의 성적 기록 변조 등이 있는데 이러한 악의적인 데이터의 변조를 SSL보안 암호화 통신을 통해서 봉쇄할 수 있습니다. 
																	<br><br>

																	개인정보유출을 사전에 방지할 수 있으며 개인정보 등의 데이터가 노출이 되었더라도 데이터들이 암호화되어 있어 노출되지 않습니다. 또한 SSL(보안서버)설치로 인해 사이트이용 고객들에게 안전함과 신뢰감을 심어줄 수 있으며, 특히 쇼핑과 같이 돈거래가 오가는 고객들에게는 긍정적인 이미지를 줄 수 있습니다.
																	</td>
																</tr>
															</table>
														</td>
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

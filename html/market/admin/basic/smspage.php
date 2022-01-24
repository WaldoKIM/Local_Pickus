<?
	include('../header.php');
	include($ROOT_DIR.'/lib/style_class.php'); 
	$smsinfo = $db->object("cs_sms_setup", "");
	// 기본 관리자 정보 불러오기.
?>

<script language="javascript">
	<!--
	// 폼 전송
	function sendit() {
		var form=document.admin_form;
		if(form.smsid.value=="") {
			alert("icode에 가입하신 아이디를 입력해 주세요.");
			form.smsid.focus();
		}else if(form.smspw.value==""){
			alert("icode에 가입하신 패스워드를 입력해 주세요.");
			form.smspw.focus();
		} else {
			form.submit();
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
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">SMS관리
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
										<td height="20" class='pagemap_title'>
											<table>
												<tr>
													<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">SMS관리</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td height="10"></td>
									</tr>
									<form action="smspage_ok.php" method="post" name="admin_form">
									<tr>
										<td height="5" class="padding_5">
											<table width="100%">
												<tr>
													<td>
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
																				<td>아이코드 SMS모듈이 탑제가 되어있습니다.<br>sms 모듈을 사용하기 위해서는 아래 가입신청 url을 클릭하셔서 가입하시고, 가입시 작성하신 아이디를 아이디입력란에 입력해 주시면 바로 사용가능 합니다.<br><br><br>아이코드코리아의 SMS를 이용하실 수 있는 아이디와 패스워드를 관리할 수 있습니다.</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														<!--도움말--->

													</td>
												</tr>
												<tr>
													<td height="35"></td>
												</tr>
												<tr>
													<td>
														<table width="100%" class="table_all"> 
															<tr>
																<td width="15%" height="35" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
																	아이코드코리아 아이디
																</td>
																<td height="35" class='tabletd_all tabletd_small'>
																	&nbsp;<input name="smsid" type="text" class="formText"" value="<?=$smsinfo->smsid;?>">
																</td>
															</tr>
															<tr>
																<td width="15%" height="35" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
																	아이코드코리아 비밀번호
																</td>
																<td height="35" class='tabletd_all tabletd_small'>
																	&nbsp;<input name="smspw" type="text" class="formText"" value="<?=$smsinfo->smspw;?>">
																</td>
															</tr>
															<tr>
																<td width="15%" height="35" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
																	발송 전화번호
																</td>
																<td height="35" class='tabletd_all tabletd_small'>
																	&nbsp;<input name="smsinputnumber" type="text" class="formText"" value="<?=$smsinfo->smsinputnumber;?>" <?=$style->strCheck(0);?>><br>&nbsp;"-"없이 번호만 넣어주세요.
																</td>
															</tr>
															<tr>
																<td width="15%" height="35" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
																	받을 전화번호
																</td>
																<td height="35" class='tabletd_all tabletd_small'>
																	&nbsp;<input name="smsnumber" type="text" class="formText"" value="<?=$smsinfo->smsnumber;?>" <?=$style->strCheck(0);?>><br>&nbsp;"-"없이 번호만 넣어주세요.
																</td>
															</tr>
															<?if($smsinfo->smsid && $smsinfo->smspw){?>
															<tr class=' noneoolim'>
																<td width="15%" height="45" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
																	SMS 가입하기 및<br>충전하기<br><font color='58AA00'>(신규입자용)</font>
																</td>
																<td height="35" class='tabletd_all tabletd_small'>
																	&nbsp;<a href="http://www.icodekorea.com/?ctl=user_sign_on&act=agree&type=A&sellid=" target="_new">http://www.icodekorea.com/?ctl=user_sign_on&act=agree&type=A&sellid=</a>
																</td>
															</tr>
															<tr class=' noneoolim'>
																<td width="15%" height="45" align="center" bgcolor="#E4E7EF" class='contenM tabletd_all'>
																	SMS충전하기<br><font color='0069CA'>(기존사용자용)</font>
																</td>
																<td height="35" class='tabletd_all tabletd_small'>
																	&nbsp;<a href="http://icodekorea.com/company/credit_card_input.php?icode_id=<?=$smsinfo->smsid?>&icode_passwd=<?=$smsinfo->smspw?>" target="_new">http://icodekorea.com/company/credit_card_input.php?icode_id=<?=$smsinfo->smsid?>&icode_passwd=<?=$smsinfo->smspw?></a>
																</td>
															</tr>
															<?}?>
														</table><br>
														<table width="100%" bgcolor="white">
															<tr>
																<td align="center"><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
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


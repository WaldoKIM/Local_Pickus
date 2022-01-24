<?
	include('../header.php');
	include($ROOT_DIR.'/lib/style_class.php');
	// 기본 관리자 정보 불러오기
?>
<SCRIPT LANGUAGE="JavaScript">
	<!--
	// 입력폼 체크 자바스크립트
	function sendit() {
		var form=document.admin_form;
		form.submit();
	}
	//-->
</SCRIPT>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/sub_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">회원가입폼설정
				</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#666666"></td>
			</tr>
			<tr>
				<td height="25"></td>
			</tr>
			<tr>
				<td class="padding_5">
				</td>
			</tr>
			<form action="basic_setup_member_ok.php" method="post" name="admin_form">
			<!-- 한단락 -->
			<tr>
				<td height="5" class="padding_5">

					<table width="100%">
						<tr>
							<td height="25" class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">회원가입폼설정</td>
						</tr>
						<tr>
							<td>
							<!----------도움말------------>
								<table width="100%" class='tipbox'>
									<tr>
										<td>
											<table width="100%">
												<tr>
													<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
												</tr>
												<tr>
													<td>회원가입시 필요한 양식을 선택하시기 바랍니다.<br><br>
											<font color="#FF6600">주소 : </font>
											주소는 다음(daum.net)에서 제공하는 주소API를 이용하여 연동되었습니다.
											<br>
											<font color="#FF6600">필수항목 : </font>
											필수항목으로 설정하실 경우에는 반드시 입력해야만 회원가입이 가능하도록 하고 있으니 사이트 성격에 맞게 설정하여 이용하여 주세요.<br>
											</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							<!----------도움말------------>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>
			<tr>
				<td height="5" class="padding_5">
					<table width="100%">
						<tr>
							<td height="5">
								<table width="100%" bgcolor="white">
									<tr>
										<td valign="top" align="right" class="padding_5">
											<table cellSpacing="1" cellPadding="3" width="100%" class="table_all" border="0" align="center">
												<tr bgColor="white">
													<td height="30" width="20%" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														일반전화 사용유무
													</td>
													<td height="25" class='tabletd_all'>
														&nbsp;<input name="member_tel" type="checkbox" value="1" <? if( $admin_stat->member_tel ==1 ) { echo("checked"); }?>>&nbsp;사용함 / &nbsp;<input name="member_tel_use" type="checkbox" value="1" <? if( $admin_stat->member_tel_use ==1 ) { echo("checked"); }?>>&nbsp;필수항목으로 적용
													</td>
												</tr>
												<tr bgColor="white">
													<td height="30" width="20%" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														휴대번호 사용유무
													</td>
													<td height="25" class='tabletd_all'>
														&nbsp;<input name="member_phone" type="checkbox" value="1" <? if( $admin_stat->member_phone ==1 ) { echo("checked"); }?>>&nbsp;사용함 / &nbsp;<input name="member_phone_use" type="checkbox" value="1" <? if( $admin_stat->member_phone_use ==1 ) { echo("checked"); }?>>&nbsp;필수항목으로 적용
													</td>
												</tr>
												<tr bgColor="white">
													<td height="30" width="20%" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														주소 사용유무
													</td>
													<td height="25" class='tabletd_all'>
														&nbsp;<input name="member_addr" type="checkbox" value="1" <? if( $admin_stat->member_addr ==1 ) { echo("checked"); }?>>&nbsp;사용함 / &nbsp;<input name="member_addr_use" type="checkbox" value="1" <? if( $admin_stat->member_addr_use ==1 ) { echo("checked"); }?>>&nbsp;필수항목으로 적용
													</td>
												</tr>
												<tr bgColor="white">
													<td height="30" width="20%" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														생년월일 사용유무
													</td>
													<td height="25" class='tabletd_all'>
														&nbsp;<input name="member_birth" type="checkbox" value="1" <? if( $admin_stat->member_birth ==1 ) { echo("checked"); }?>>&nbsp;사용함 / &nbsp;<input name="member_birth_use" type="checkbox" value="1" <? if( $admin_stat->member_birth_use ==1 ) { echo("checked"); }?>>&nbsp;필수항목으로 적용
													</td>
												</tr>
												<tr bgColor="white">
													<td height="30" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														가입불가 ID
													</td>
													<td height="25" class='tabletd_all'>
														<div id="comment">
														<fieldset>
															<table>
																<colgroup><col width="*" /><col width="131" /></colgroup>
																<tbody>
																	<tr>
																		<td><div class="box" style='height:100px'><textarea name="badid" style='height:100px'><?=$admin_stat->badid?></textarea></div></td>
																	</tr>
																</tbody>
															</table>
														</fieldset>
														</div>


														&nbsp;회원가입을 제한할 ID를 입력하세요, 컴마로 구분합니다. 공백이 있을시 오류가 날 수 있으니 공백을 잘 확인하여 주세요<br>
														&nbsp;<font color="#3366CC">주요 제한 ID</font> : admin, administration, administrator, master, webmaster, manage, manager
													</td>
												</tr>

												<tr bgColor="white">
													<td height="30" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														실명인증
													</td>
													<td height="25" class='tabletd_all'>
														&nbsp;<input type="radio"  name="realname" value="0"  <?if($admin_stat->realname==0){?>checked<?}?>>미사용 <input type="radio" name="realname" value="2" <?if($admin_stat->realname==2){?>checked<?}?>>아이핀<br>회원사코드 <input type="text" name="sirenid" class="formText" value="<?=$admin_stat->sirenid?>">KCB에서 발급받은 코드를 넣으세요<br><br>
														<p>실명인증서비스업체인 KCB 모듈이 기본적으로 탑재되어 있습니다. <br>아래 링크를 통하여 신청절차를 따라 주시기 바랍니다.<br>
														&nbsp;<a href="http://www.allcredit.co.kr" target="_blank"class='searchC'>실명인증서비스업체 바로가기</a>
														<br></p>
														<p>아이핀이란? 인터넷상에서 주민등록번호를 대신하여 본인임을 확인 받을 수 있도록 만들어진 식별번호입니다. <br>
														용어는 인터넷 개인 식별번호(Internet Personal Identification Number)의 영문 머리글자를 따서 만들어졌으며, <br>
														주민등록번호를 검증된 제3의 인증기관(KCB)에 통합·보관하고 개인에게 발급된 번호를 대조하는 방식으로 이루어지게 됩니다.<br>
														인터넷의 웹사이트에서 주민등록번호의 대규모 유출, 주민등록번호의 도용 및 각종 범죄에의 악용 등의 부작용을<br>
														해결하기 위해 2006년 10월 정보통신부(현재 지식경제부)와 한국정보보호진흥원(현재 한국인터넷진흥원)에서 도입한 제도입니다.<br>
														KCB올크레딧과 연계하여 아이핀 모듈을 탑재하고 있습니다.</p>
													</td>
												</tr>
											</table><br>
											<a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
					</table>
				</td>
			</tr>
			</form>
		</table>
	</article>
	
</div>



<? include('../footer.php'); ?>

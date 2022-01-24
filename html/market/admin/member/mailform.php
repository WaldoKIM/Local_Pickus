<?
include('../header.php');
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

// $_GET[item] 값이 없을 경우 
if(!$_GET[item]) { $_GET[item]=1;}

// 메일 폼 값들 불려 오기
$mailform_stat=$db->object("cs_mailform", "where item='$_GET[item]'");
?>
<script language="javascript">
<!--
function formCheck(chk) {
	var form=document.mail_check_form;
	form.action="<?=$_SERVER[PHP_SELF];?>?item="+chk;
	form.submit();
}

function sendit() {
	var form=document.mail_form;
	form.content.value = myeditor.outputBodyHTML();
	if(form.title.value=="") {
		alert("메일 제목을 입력해 주세요.");
		form.title.focus();
	} else if(form.content.value=="") {
		alert("메일 내용을 입력해 주세요.");
		form.content.focus();
	} else {
		form.target="";
		form.action="mailform_ok.php";
		form.submit();
	}
}

// 메일폼 새창 오픈
function newmir() {
	var form=document.mail_form;
	if(form.title.value=="") {
		alert("메일 제목을 입력해 주세요.");
		form.title.focus();
	} else if(form.content.value=="") {
		alert("메일 내용을 입력해 주세요.");
		form.content.focus();
	} else {
		form.target="mailform_mir";
		form.action="mailform_mir.php";
		form.submit();
	}
}

function opentarget(){
	setTimeout("newmir()", 500);
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
										<td align="center" valign="top" bgcolor="#FFFFFF"></td>
									</tr>
									<tr> 
										<td height="75" align="center" valign="top" bgcolor="#FFFFFF">
										<table width="100%">
												<tr>
												<td>
													<table width="100%">
														<tr>
															<td height="25">
															<table>
																<tr>
																	<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">메일폼설정</td>
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
																						<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																					</tr>
																					<tr>
																						<td><b>분류선택</b> : 각 항목별로 메일폼을 설정하실 수 있습니다. <br><b>치환 
																						코드</b> : 제공되는 치환코드를 사용하여 메일을 작성할 수 있습니다.<br>(ex, __USER_NAME__ 
																						님 주문에 감사드립니다. 회원님의 주문자 아이디는 __USER_ID__ 입니다.)</p>
																						<p><b>메일제목</b> : 보내는 메일제목을 입력합니다.<br><b>메일내용</b> : 각 항목별 
																						메일내용을 입력합니다.<br>미리보기버튼을 클릭하시면 보내질 메일내용을 미리볼 
																						수 있습니다.</td>	
																					</tr>
																				</table>
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
											<table width="100%" class="table_all">
												<tr bgColor="white"> 
													<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>분류선택</td>
													<td class='tabletd_all tabletd_Lmall' style='padding:1em'>
														
														<div class='oolimbox-wrapper oolimbox-grid5'>
															<form method="post" name="mail_check_form">
															<div class='oolimbox-col_5dan' style='text-align:left'>
																<input name="mailform" type="radio" value="1" onclick="formCheck(1);" <? if($_GET[item]==1) { echo('checked');}?>>회원가입(회원)
															</div>
															<div class='oolimbox-col_5dan' style='text-align:left'>
																<input name="mailform" type="radio" value="2" onclick="formCheck(2);" <? if($_GET[item]==2) { echo('checked');}?>>주문메일(회원)
															</div>
															<div class='oolimbox-col_5dan' style='text-align:left'>
																<input name="mailform" type="radio" value="3" onclick="formCheck(3);" <? if($_GET[item]==3) { echo('checked');}?>>결제완료(회원)
															</div>
															<div class='oolimbox-col_5dan' style='text-align:left'>
																<input name="mailform" type="radio" value="4" onclick="formCheck(4);" <? if($_GET[item]==4) { echo('checked');}?>>배송메일(회원)
															</div>
															<div class='oolimbox-col_5dan' style='text-align:left'>
																<input name="mailform" type="radio" value="5" onclick="formCheck(5);" <? if($_GET[item]==5) { echo('checked');}?>>회원가입(관리자)
															</div>
															<div class='oolimbox-col_5dan' style='text-align:left'>
																<input name="mailform" type="radio" value="6" onclick="formCheck(6);" <? if($_GET[item]==6) { echo('checked');}?>>주문메일(관리자)
															</div>
															<div class='oolimbox-col_5dan' style='text-align:left'>
																<input name="mailform" type="radio" value="7" onclick="formCheck(7);" <? if($_GET[item]==7) { echo('checked');}?>>결제완료(관리자)
															</div>
															<div class='oolimbox-col_5dan' style='text-align:left'>
																<input name="mailform" type="radio" value="8" onclick="formCheck(8);" <? if($_GET[item]==8) { echo('checked');}?>>배송메일(관리자)
															</div>
															<div class='oolimbox-col_5dan' style='text-align:left'>
																<input name="mailform" type="radio" value="9" onclick="formCheck(9);" <? if($_GET[item]==9) { echo('checked');}?>>상품 추천메일
															</div>
															<div class='oolimbox-col_5dan' style='text-align:left'>
																<input name="mailform" type="radio" value="10" onclick="formCheck(10);" <? if($_GET[item]==10) { echo('checked');}?>>아이디 패스워드 찾기
															</div>
															<!--div class='oolimbox-col_5dan' style='text-align:left'>
																<input name="mailform" type="radio" value="11" onclick="formCheck(11);" <? if($_GET[item]==11) { echo('checked');}?>>인증메일
															</div-->
															</form>
														</div>
																												
															
													</td>
												</tr>
												<tr bgColor="white"> 
													<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>사용자 정보<br>치환 코드</td>
													<td class='tabletd_all tabletd_Lmall'>
														<? if($_GET[item]==1) {?>
														<table width="100%" border="1" bordercolor='#BDBEBD' style='border-collapse: collapse'>
															<tr>
																<td bgcolor="#FEFDD8">__USER_NAME__: 이름(회원명), __USER_ID__: 회원 아이디, __USER_PASSWD__: 회원패스워드,<br>__USER_JUMIN__: 회원주민번호, __USER_EMAIL__: 회원이메일, __USER_TEL__: 회원전화번호,<br>__USER_ADDRESS__: 회원주소</td>
															</tr>
														</table>
														<?} else if($_GET[item]==2) {?>
														<table width="100%" border="1" bordercolor='#BDBEBD' style='border-collapse: collapse'>
															<tr>
																<td bgcolor="#FEFDD8">__ORDER_NAME__: 주문자이름,  __TRADE_CODE__: 주문코드, __TRADE_METHOD__: 결제방법, __TRADE_METHOD_INFO__: 결제정보, __TRADE_PRICE__: 결제금액, __TRADE_DAY__: 주문일, __TRADE_MONEY_OK__: 결제완료, __TRADE_COMPANY__: 배송회사, __TRADE_NUMBER__: 배송번호, __DELIV_NAME__: 받을 사람, __DELIV_TEL__: 받을 연락처, __DELIV_ADDRESS__: 받을 주소, __TRADE_START_DAY__: 배송일</td>
															</tr>
														</table>
														<?} else if($_GET[item]==3) {?>
														<table width="100%" border="1" bordercolor='#BDBEBD' style='border-collapse: collapse'>
															<tr>
																<td bgcolor="#FEFDD8">__ORDER_NAME__: 주문자이름,  __TRADE_CODE__: 주문코드, __TRADE_METHOD__: 결제방법, __TRADE_METHOD_INFO__: 결제정보, __TRADE_PRICE__: 결제금액, __TRADE_DAY__: 주문일, __TRADE_MONEY_OK__: 결제완료, __TRADE_COMPANY__: 배송회사, __TRADE_NUMBER__: 배송번호, __DELIV_NAME__: 받을 사람, __DELIV_TEL__: 받을 연락처, __DELIV_ADDRESS__: 받을 주소, __TRADE_START_DAY__: 배송일</td>
															</tr>
														</table>
														<?} else if($_GET[item]==4) {?>
														<table width="100%" border="1" bordercolor='#BDBEBD' style='border-collapse: collapse'>
															<tr>
																<td bgcolor="#FEFDD8">__ORDER_NAME__: 주문자이름,  __TRADE_CODE__: 주문코드, __TRADE_METHOD__: 결제방법, __TRADE_METHOD_INFO__: 결제정보, __TRADE_PRICE__: 결제금액, __TRADE_DAY__: 주문일, __TRADE_MONEY_OK__: 결제완료, __TRADE_COMPANY__: 배송회사, __TRADE_NUMBER__: 배송번호, __DELIV_NAME__: 받을 사람, __DELIV_TEL__: 받을 연락처, __DELIV_ADDRESS__: 받을 주소, __TRADE_START_DAY__: 배송일</td>
															</tr>
														</table>
														<?} else if($_GET[item]==5) {?>
														<table width="100%" border="1" bordercolor='#BDBEBD' style='border-collapse: collapse'>
															<tr>
																<td bgcolor="#FEFDD8">__USER_NAME__: 이름(회원명), __USER_ID__: 회원 아이디, __USER_PASSWD__: 회원패스워드,<br>__USER_JUMIN__: 회원주민번호, __USER_EMAIL__: 회원이메일, __USER_TEL__: 회원전화번호,<br>__USER_ADDRESS__: 회원주소</td>
															</tr>
														</table>
														<?} else if($_GET[item]==6) {?>
														<table width="100%" border="1" bordercolor='#BDBEBD' style='border-collapse: collapse'>
															<tr>
																<td bgcolor="#FEFDD8">__ORDER_NAME__: 주문자이름,  __TRADE_CODE__: 주문코드, __TRADE_METHOD__: 결제방법, __TRADE_METHOD_INFO__: 결제정보, __TRADE_PRICE__: 결제금액, __TRADE_DAY__: 주문일, __TRADE_MONEY_OK__: 결제완료, __TRADE_COMPANY__: 배송회사, __TRADE_NUMBER__: 배송번호, __DELIV_NAME__: 받을 사람, __DELIV_TEL__: 받을 연락처, __DELIV_ADDRESS__: 받을 주소, __TRADE_START_DAY__: 배송일</td>
															</tr>
														</table>
														<?} else if($_GET[item]==7) {?>
														<table width="100%" border="1" bordercolor='#BDBEBD' style='border-collapse: collapse'>
															<tr>
																<td bgcolor="#FEFDD8">__ORDER_NAME__: 주문자이름,  __TRADE_CODE__: 주문코드, __TRADE_METHOD__: 결제방법, __TRADE_METHOD_INFO__: 결제정보, __TRADE_PRICE__: 결제금액, __TRADE_DAY__: 주문일, __TRADE_MONEY_OK__: 결제완료, __TRADE_COMPANY__: 배송회사, __TRADE_NUMBER__: 배송번호, __DELIV_NAME__: 받을 사람, __DELIV_TEL__: 받을 연락처, __DELIV_ADDRESS__: 받을 주소, __TRADE_START_DAY__: 배송일</td>
															</tr>
														</table>
														<?} else if($_GET[item]==8) {?>
														<table width="100%" border="1" bordercolor='#BDBEBD' style='border-collapse: collapse'>
															<tr>
																<td bgcolor="#FEFDD8">__ORDER_NAME__: 주문자이름,  __TRADE_CODE__: 주문코드, __TRADE_METHOD__: 결제방법, __TRADE_METHOD_INFO__: 결제정보, __TRADE_PRICE__: 결제금액, __TRADE_DAY__: 주문일, __TRADE_MONEY_OK__: 결제완료, __TRADE_COMPANY__: 배송회사, __TRADE_NUMBER__: 배송번호, __DELIV_NAME__: 받을 사람, __DELIV_TEL__: 받을 연락처, __DELIV_ADDRESS__: 받을 주소, __TRADE_START_DAY__: 배송일</td>
															</tr>
														</table>
														<?} else if($_GET[item]==9) {?>
														<table width="100%" border="1" bordercolor='#BDBEBD' style='border-collapse: collapse'>
															<tr>
																<td bgcolor="#FEFDD8">__MAIL_FROM_USER__: 메일보낸사람,  __MAIL_TITLE__: 보낸사람이 작성한 메일제목, __MAIL_CONTENT__: 보낸사람이 작성한 메일내용, __GOODS_NAME__: 추천상품명, __GOODS_CONTENT__: 추천상품설명, __GOODS_270_IMAGE__: 270사이즈 이미지</td>
															</tr>
														</table>
														<?} else if($_GET[item]==10) {?>
														<table width="100%" border="1" bordercolor='#BDBEBD' style='border-collapse: collapse'>
															<tr>
																<td bgcolor="#FEFDD8">__USER_NAME__: 이름(회원명), __USER_ID__: 회원 아이디, __USER_PASSWD__: 회원패스워드,<br>__USER_JUMIN__: 회원주민번호, __USER_EMAIL__: 회원이메일, __USER_TEL__: 회원전화번호,<br>__USER_ADDRESS__: 회원주소</td>
															</tr>
														</table>
														<?}?>
													</td>
												</tr>
												<tr bgColor="white"> 
													<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>쇼핑몰 정보<br>치환 코드</td>
													<td class='tabletd_all tabletd_Lmall'>
														<table width="100%" border="1" bordercolor='#BDBEBD' style='border-collapse: collapse'>
															<tr>
																<td bgcolor="#FEFDD8">__SHOP_NAME__: 쇼핑몰 상호, __SHOP_DOMAIN__: 쇼핑몰 도메인, __SHOP_CEO__: 쇼핑몰 대표자, __SHOP_TEL__: 쇼핑몰 전화번호, __SHOP_EMAIL__: 쇼핑몰 이메일, __SHOP_ADDRESS__: 쇼핑몰 주소, __MAILFORM_IMAGES_URL__: 기본 이미지 경로(스킨/mailform)</td>
															</tr>
														</table>
													</td>
												</tr>
												<form method="post" action="mailform_ok.php" name="mail_form">
												<input type="hidden" name="item" value="<?=$_GET[item];?>">
												<tr bgColor="white"> 
													<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>메일제목</td>
													<td class='tabletd_all tabletd_small'><input name="title" type="text" class="formText formText_subject" value="<?=$mailform_stat->title;?>"></td>
												</tr>
												<tr bgColor="white"> 
													<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>메일내용</td>
													<td class='tabletd_all tabletd_Lmall'>
														<table width="100%" border="0" height="30">
															<tr> 
																<td height="3" colspan="2"></td>
															</tr>
															<tr  height="25">
																<td align="left">&nbsp;
																	<input type="hidden" name="tag" value="1">
																	<textarea id="content" name="content" style="display:none"><?=$mailform_stat->content;?></textarea>
																	<!-- 에디터를 화면에 출력합니다. -->
																	<script type="text/javascript" language="javascript">
																		var myeditor = new cheditor();
																		myeditor.config.editorHeight = '500px';             // 에디터 세로폭입니다.
																		myeditor.config.editorWidth = '100%';                // 에디터 가로폭입니다.
																		myeditor.inputForm = 'content';                     // 입력 textarea의 ID 이름입니다.
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
												</form>
											</table>
										</td>
									</tr>
									<tr> 
										<td style='text-align:center; height:70px;'><br>
										<a href="#" class='modal oolimbtn-botton1_1' data-modal-height="650" data-modal-width="600" data-modal-iframe="mailform_mir.php" data-modal-title="미리보기" onclick="opentarget()">미리보기</a>&nbsp;<a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a><br><br> </td>
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


<? 
include('../header.php');
include($ROOT_DIR.'/lib/style_class.php');
// 기본 관리자 정보 불러오기
$admin_stat = $db->object("cs_admin", "");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
// 입력폼 체크 자바스크립트
function sendit() {
	var form=document.admin_form;

	if(form.admin_userid.value=="") {
		alert("관리자 아이디를 입력해 주세요.");
		form.admin_userid.focus();
	} else if(form.admin_passwd.value=="") {
		alert("관리자 패스워드를 입력해 주세요.");
		form.admin_passwd.focus();
	} else if(form.admin_userid.value=="0" || form.admin_passwd.value=="0"){
		alert("아이디 패스워드는 '0'으로 이용하지 말아주세요. ");
		form.admin_userid.focus();
	/*
	} else if(form.shop_email.value=="") {
		alert("이메일을 입력해 주세요.");
		form.shop_email.focus();
	} else if(form.safeguard_admin.value=="") {
		alert("개인정보관리자를 주세요.");
		form.safeguard_admin.focus();
	} else if(form.shop_domain.value=="") {
		alert("쇼핑몰 도메인 입력해 주세요.");
		form.shop_domain.focus();
	} else if(form.shop_url.value=="") {
		alert("쇼핑몰 설치 경로 입력해 주세요.");
		form.shop_url.focus();
	} else if(form.shop_name.value=="") {
		alert("쇼핑몰 상호 입력해 주세요.");
		form.shop_name.focus();
	} else if(form.shop_num.value=="") {
		alert("사업자 번호를 입력해 주세요.");
		form.shop_num.focus();
	} else if(form.shop_ceo.value=="") {
		alert("대표자 이름을 입력해 주세요.");
		form.shop_ceo.focus();
//	} else if(form.shop_license.value=="") {
//			alert("전자상거래 허가번호 입력해 주세요.");
//		form.shop_license.focus();
//	} else if(form.shop_status.value=="") {
//		alert("사업자의 업테를 입력해 주세요.");
//		form.shop_status.focus();
//	} else if(form.shop_item.value=="") {
//		alert("사업자의 업종을 입력해 주세요.");
//		form.shop_item.focus();
	} else if(form.shop_tel1.value=="") {
		alert("전화번호 (1)를 입력해 주세요.");
		form.shop_tel1.focus();
//	} else if(form.shop_tel2.value=="") {
//		alert("전화번호 (2)를 입력해 주세요.");
//		form.shop_tel1.focus();
//	} else if(form.shop_phone.value=="") {
//		alert("휴대 전화번호를 입력해 주세요.");
//		form.shop_phone.focus();
//	} else if(form.shop_fax.value=="") {
//		alert("팩스번호를 입력해 주세요.");
//		form.shop_fax.focus();
	} else if(form.shop_address.value=="") {
		alert("사업장 주소를 입력해 주세요");
		form.shop_address.focus();
	*/
	} else if(form.express_check[1].checked && form.express_money.value=="" ) {
		alert("일반배송비 금액을 입력해 주세요");
		form.express_money.focus();
	} else if(form.express_check[1].checked && form.express_free.value=="" ) {
		alert("배송비 무료적용 금액을 입력해 주세요");
		form.express_free.focus();
	} else if(form.express_check[2].checked && form.express_box_money.value=="" ) {
		alert("1박스에 대한 배송비 금액을 입력해 주세요");
		form.express_box_money.focus();
	} else if(form.express_check[2].checked && form.express_free.value=="" ) {
		alert("배송비 무료적용 금액을 입력해 주세요");
		form.express_free.focus();
	} else if(form.point_basic.value=="") {
		alert("상품에 대한 기본 포인트를 입력해 주세요");
		form.point_basic.focus();
	} else if(form.point_register.value=="") {
		alert("회원가입시 축하 포인트를 입력해 주세요");
		form.point_register.focus();
	} else if(form.point_use.value=="") {
		alert("이용 가능한 포인트 점수를 입력해 주세요");
		form.point_use.focus();
	} else if(form.point_basic.value=="") {
		alert("상품에 대한 기본 적립 포인트를 입력해 주세요");
		form.point_basic.focus();
	} else if(form.point_register.value=="") {
		alert("회원가입시 적립 포인트를 입력해 주세요");
		form.point_register.focus();
	} else if(form.point_use.value=="") {
		alert("결제 가능한 적립 포인트를 입력해 주세요");
		form.point_use.focus();
	} else if(form.member_check[0].checked && form.member_invite.value=="") {
		alert("추천한 회원에게 적립되는 포인트를 입력해 주세요");
		form.member_invite.focus();
	} else if(form.member_check[0].checked && form.member_register.value=="") {
		alert("가입회원에게 적립되는 포인트를 입력해 주세요");
		form.member_register.focus();
	} else {
		form.submit();
	}
}

// 추천회원제 자바스크립트 
function memShow() {
	var form=document.admin_form;
	if( form.member_check[0].checked ) {
		document.all.member_view[0].style.display=""; 
		document.all.member_view[1].style.display=""; 
	} else {
		document.all.member_view[0].style.display="none"; 
		document.all.member_view[1].style.display="none"; 
	}
}

// 배송 관련 자바스크립트
function expressShow() {
	var form=document.admin_form;
	if( form.express_check[1].checked ) {
		document.all.express_view.style.display="";
		form.express_money.disabled = false;
		form.express_box_money.value = "";
		form.express_box_money.disabled = true;
	} else if( form.express_check[2].checked ) {
		document.all.express_view.style.display="";
		form.express_box_money.disabled = false;
		form.express_money.value = "";
		form.express_money.disabled = true;
	} else {
		document.all.express_view.style.display="none"; 
		form.express_money.value = "";
		form.express_box_money.value = "";
		form.express_money.disabled = true;
		form.express_box_money.disabled = true;
	}
}

//-->
</SCRIPT>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td height="15"></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="180" valign="top" class='noneoolim'>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td>
						<?include('inc/sub_menu_inc.php');?>
					</td>
				</tr>
			</table>
		</td>
		<td width="30" class='noneoolim'></td>
		<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td valign="top" style="padding:10;">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td height="20" class='sub_titleL'>
												<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5"><b>쇼핑몰 기본설정</b>
											</td>
										</tr>
										<tr>
											<td height="1" bgcolor="#dddddd"></td>
										</tr>
										<tr>
											<td height="25"></td>
										</tr>
										<tr>
											<td class="padding_5 ">
												<table cellpadding="0" cellspacing="0" width="100%">
													<tr>
														<td height="70" class='noneoolim'>
															<!-----------페이지 탭메뉴----------->
															<table width="100%" class="table_all">
																<tr>
																	<td>
																		<table width="100%">
																			<tr height='35'>
																				<td align="center" bgcolor="#F9E6E6" class='contenM tabletd_all'><a href='#teb01'>관리자정보설정</a></td>
																				<td align="center" bgcolor="#F9E6E6" class='contenM tabletd_all'><a href='#teb02'>쇼핑몰 기본 정보</a></td>
																				<td align="center" bgcolor="#F9E6E6" class='contenM tabletd_all'><a href='#teb03'>배송정보</a></td>
																				<td align="center" bgcolor="#F9E6E6" class='contenM tabletd_all'><a href='#teb04'>포인트설정</a></td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
															<!-----------페이지 탭메뉴----------->
														</td>
													</tr>
													<tr>
														<td>
															<!--콘텐츠출력-->
															
								<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								<form action="basic_setup_ok.php" method="post" name="admin_form">
								<input type="hidden" name="hidden_bank_cnt" value="">
									<tr>
										<td align="center" valign="top" bgcolor="#FFFFFF" class="menu">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<td>
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td height="25">
															<table cellpadding="0" cellspacing="0">
																<tr>
																	<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">관리자정보설정</td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20">
																<!--도움말-->
																	<table cellpadding="0" cellspacing="0" width="100%" class='tipbox noneoolim'>
																		<tr>
																			<td>
																				<table cellpadding="0" cellspacing="0" width="100%">
																					<tr>
																						<td height="20">
																							<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
																						</td>
																					</tr>
																					<tr>
																						<td><p>관리자 페이지 접속가능한 아이디와 패스워드를 관리할 수 있습니다.<br>
																						
																						</p></td>
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
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>관리자 아이디</td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="admin_userid" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->admin_userid;?>"></td>
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>관리자 비밀번호</td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="admin_passwd" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->admin_passwd;?>"></td>
												</tr>
												<tr>
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>호스팅업체명</td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="hostingname" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->hostingname;?>"></td>
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>호스팅업체URL</td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="hostingurl" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->hostingurl;?>"><br> http:// 포함한 주소입력</td>
												</tr>
											</table>
											<table style='margin:0 auto'>
												<tr>
													<td height='70'><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td height="150" align="" bgcolor="#FFFFFF" class="menu noneoolim"><br>
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<td>
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td height="25">
															<table cellpadding="0" cellspacing="0">
																<tr>
																	<td class="sub_titleM"><a name="teb02"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">쇼핑몰 기본 정보</td>
																	<td></td>
																	<td>
																	</td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20">
																<!--도움말-->
																	<table cellpadding="0" cellspacing="0" width="100%" class='tipbox noneoolim'>
																		<tr>
																			<td>
																				<table cellpadding="0" cellspacing="0" width="100%">
																					<tr>
																						<td height="20">
																							<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
																						</td>
																					</tr>
																					<tr>
																						<td><p><font color="red">도메인 : http:// 제외한 URL주소만 입력</font>하여 주세요.<br>
																						사용자 스킨 URL : http://제외한 URL주소와 사용하시는 스킨 경로를 입력하여 주세요. <font color="red">기본형일 경우 "URL/skin_default" 입력</font>하시기 바랍니다.<br>
																						홈페이지 하단에 카피라이트 부분에 표기될 홈페이지 기본정보에 대한 내용을 등록가능합니다.</p></td>
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
											
											<!-- 기본정보 -->
			<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor='#BDBEBD' class="menu" style='border-collapse: collapse'>
				<tr>
					<td class='contenM tabletd_all' width="120" height="25" align="center" bgcolor="#E4E7EF">도메인</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;HTTP://<input name="shop_domain" type="text" class="formText_mo" maxlength="200" size="31" value="<?=$admin_stat->shop_domain;?>"></td>
					<td class='contenM tabletd_all' width="120" height="25" align="center" bgcolor="#E4E7EF">사용자 스킨 URL</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;HTTP://<input name="shop_url" type="text" class="formText_mo" maxlength="200" size="31" value="<?=$admin_stat->shop_url;?>"></td>
				</tr>
				<tr>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">쇼핑몰 상호</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="shop_name" type="text" class="formText_mo" maxlength="100" size="39" value="<?=$admin_stat->shop_name;?>"></td>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">사업자번호</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="shop_num" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->shop_num;?>"></td>
				</tr>
				<tr>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">대표자명</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="shop_ceo" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->shop_ceo;?>"></td>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">통신판매업허가번호</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="shop_license" type="text" class="formText_mo" maxlength="100" size="39" value="<?=$admin_stat->shop_license;?>"></td>
				</tr>
				<tr>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">이메일</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="shop_email" type="text" class="formText_mo" maxlength="100" size="39" value="<?=$admin_stat->shop_email;?>"></td>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">개인정보관리책임자</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="safeguard_admin" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->safeguard_admin;?>"></td>
				</tr>
				<tr>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">업 태</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="shop_status" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->shop_status;?>"></td>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">종 목</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="shop_item" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->shop_item;?>"></td>
				</tr>
				<tr>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">전화번호</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="shop_tel1" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->shop_tel1;?>"></td>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">전화번호2</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="shop_tel2" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->shop_tel2;?>"></td>
				</tr>
				<tr>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">휴대폰</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="shop_phone" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->shop_phone;?>"></td>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">팩 스</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="shop_fax" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->shop_fax;?>"></td>
				</tr>
				<tr>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">카카오톡 채널</td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;HTTP://<input name="kakao_chnl" type="text" class="formText_mo" maxlength="50" size="39" value="<?=$admin_stat->kakao_chnl;?>"></td>
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">카카오톡채널 아이디 </td>
					<td class='tabletd_all tabletd_small' height="25">&nbsp;<input name="kakao_id" type="text" class="formText_mo" maxlength="30" size="39" value="<?=$admin_stat->kakao_id;?>"></td>
				</tr>				
				<tr>	
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">사업장 주소</td>
					<td class='tabletd_all tabletd_small' height="25" colspan="3">&nbsp;<input name="shop_address" type="text" class="formText_mo" maxlength="200" size="90" value="<?=$admin_stat->shop_address;?>"></td>
				</tr>
				<tr>	
					<td class='contenM tabletd_all' height="25" align="center" bgcolor="#E4E7EF">업무시간안내</td>
					<td class='tabletd_all tabletd_small' height="25" colspan="3">&nbsp;<textarea name="week" class="input" rows="6" cols="50"><?=$admin_stat->week;?></textarea><br>
					&nbsp;<img src="../img/tip_icon.gif" width="28" height="11" border="0">쇼핑몰좌측 고객센터 테이블에 출력됩니다. (Html로 출력가능합니다.)
					</td>
				</tr>
			</table><br>																							
											
											<!-- //기본정보 -->
											
											
											
										</td>
									</tr>
									<tr>
										<td height="20"></td>
									</tr>
									<tr>
										<td height="19" align="center" valign="top" bgcolor="#FFFFFF" class="menu"><br>
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<td>
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td height="25">
															<table cellpadding="0" cellspacing="0">
																<tr>
																	<td class="sub_titleM"><a name="teb03"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">배송정보</td>
																	<td></td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20">
																<!--도움말-->
																	<table cellpadding="0" cellspacing="0" width="100%" class='tipbox noneoolimmo'>
																		<tr>
																			<td>
																				<table cellpadding="0" cellspacing="0" width="100%">
																					<tr>
																						<td height="20">
																							<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
																						</td>
																					</tr>
																					<tr>
																						<td><p><b>완전무료배송</b> : 쇼핑몰에 등록된 모든 제품에 대하여 배송비 무료<br><b>일반배송비 
																						기능</b> : 쇼핑몰에 등록된 모든 제품에 대하여 일괄된 배송비<br><b>제품별 배송가중치기능</b> 
																						: 각 제품에 설정된 배송가중치로 배송비를 연산하여 책정 주문된 제품에 따라 책정된 
																						<br>제품에 따라 배송비가 각각 다릅니다.<br>(주문제품의 배송가중치 합계 * 설정된 
																						1박스당 배송가격=현주문의 배송비)</p>
																						<p><b>배송가중치란 ?</b><br>배송가중치는 1부터 100까지의 값을 가집니다. 그 값이 
																						100이하 일 경우에 1박스(BOX)로 책정되고 <br>100초과 200이하이면 2박스(BOX)로 
																						책정됩니다. 제품의 크기 또는 무게에 따라 임의로 관리자가 정해야 합니다. <br>따라서 
																						장바구니에 담긴 모든 상품들의 배송치가 합산되어 배송비용을 책정하게 됩니다.</p>
																						<p>예) A라는 책은 20권을 묶으면 1박스(BOX) 가량 된다고 하고, B라는 책은 10권을 
																						묶으면 <br>1박스(BOX)가량 된다고 가정할 때, A책은 20권이 1박스(BOX)이므로 5100(한 
																						박스에 대한 가중치) &nbsp;<br>20 = 5라는 배송치를 가지며, B책은 10개가 1박스(BOX)이므로 
																						10100(한 박스에 대한 가중치) &nbsp;<br>10 = 10라는 배송치를 가집니다. 고객의 
																						주문 배송비는 아래와 같이 계산이 됩니다.</p></td>
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
													<td height="25" rowspan="3" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>배송비 기능 설정</td>
														<td height="25" width="280" class='tabletd_all tabletd_small'>&nbsp;<input type="radio" name="express_check" value="0" onclick="javascript:expressShow();" <? if( $admin_stat->express_check == 0 ) { echo("checked"); } ?>> 완전 무료 배송 </td>
														<td class='tabletd_all tabletd_small'>&nbsp; 모든 주문에 대해서 완전 무료 배송을 합니다.</td>
													</tr>
												<tr>
													<td class='tabletd_all tabletd_small'>&nbsp;<input type="radio" name="express_check" value="1" onclick="javascript:expressShow();" <? if( $admin_stat->express_check == 1 ) { echo("checked"); } ?>> 일반배송비 기능</td>
													<td height="25" class='tabletd_all tabletd_small'>&nbsp;<input name="express_money" type="text" class="formText" maxlength="11"<?=$style->strCheck();?> <?=$style->colorAlign("#FF0000", 2);?> value="<? if( $admin_stat->express_check == 1 ) { echo($admin_stat->express_money); }?>"> 원 (모든 주문에 대해서 공통 적용) </td>
												</tr>
												<tr>
													<td class='tabletd_all tabletd_small'>&nbsp;<input type="radio" name="express_check" value="2" onclick="javascript:expressShow();" <? if( $admin_stat->express_check == 2 ) { echo("checked"); } ?>> 제품별 배송가중치기능</td>
													<td height="25" class='tabletd_all tabletd_small'>&nbsp;<input name="express_box_money" type="text" class="formText" maxlength="11" <?=$style->strCheck();?> <?=$style->colorAlign("#FF0000", 2);?> value="<?if ( $admin_stat->express_check == 2 ) { echo($admin_stat->express_box_money); }?>"> 원 /BOX (1박스에 대한 배송비)</td>
												</tr>
												<tr id="express_view" style="display;">
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>무료 배송</td>
													<td height="25" colspan="2" bgColor="white" class='tabletd_all tabletd_small'>&nbsp;<input name="express_free" type="text" class="formText" maxlength="11" <?=$style->strCheck();?> <?=$style->colorAlign("#FF0000", 2);?> value="<? if( $admin_stat->express_check != 0 ) { echo($admin_stat->express_free); }?>"> 원 일정금액 이상이 될 경우 배송비 무료적용 </td>
												</tr>
												<tr>
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>추가배송비</td>
													<td height="25" colspan="2" bgColor="white">&nbsp;&nbsp;<input name="express_over" type="text" class="formText" maxlength="11" <?=$style->strCheck();?> <?=$style->colorAlign("#FF0000", 2);?> value="<?=$admin_stat->express_over?>"> 원 도서산간지방의 추가배송비를 설정하시기 바랍니다. <br>기본배송비 및 배송가중치에만 적용되며 기본배송비에 + 추가배송비가 적용됩니다. <br>무료배송비 적용조건에서도 추가배송비는 추가됩니다.<br><a href="overexpress.php"  class='searchE'><u>도서산간지역 항목 등록하기</u></a><br>※도서산간지역으로 우편번호를 등록하시면 위에 입력한 추가금액만큼 배송비가 추가됩니다. </td>
												</tr>
											</table><br>
										</td>
									</tr>
									<tr height="20">
										<td></td>
									</tr>
									<tr>
										<td height="10" align="center" valign="top" bgcolor="#FFFFFF" class="menu"><br>
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<td>
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td height="25">
															<table cellpadding="0" cellspacing="0">
																<tr>
																	<td class="sub_titleM"><a name="teb04"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">포인트설정</td>
																	<td></td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20">
																<!--도움말-->
																	<table cellpadding="0" cellspacing="0" width="100%" class='tipbox noneoolim'>
																		<tr>
																			<td>
																				<table cellpadding="0" cellspacing="0" width="100%">
																					<tr>
																						<td height="20">
																							<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
																						</td>
																					</tr>
																					<tr>
																						<td><p><b>사용가능포인트</b> : 구매자가 포인트를 사용하여 구매를 할 경우 사용가능 포인트로 지정한
																						 포인트 이상 적립되어야만 사용하실 수 있습니다.<br>
																						 <b>추천회원제</b> : 추천회원제를 통하여 자신을 추천한 회원에게 추천포인트가 적용되며, 추가로 자신에게도 축하포인트 + 추천포인트가 적용됩니다.
																						 </p></td>
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
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>판매 수수료율 </td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="fee_rate" type="text" class="formText" maxlength="2" <?=$style->strCheck(1);?> <?=$style->colorAlign("#FF0000", 2);?> value="<?=$admin_stat->fee_rate;?>">%<br>
													</td>
												</tr>											
												<tr>
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>기본 포인트 </td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="point_basic" type="text" class="formText" maxlength="11" <?=$style->strCheck(1);?> <?=$style->colorAlign("#FF0000", 2);?> value="<?=$admin_stat->point_basic;?>">&nbsp;&nbsp;% 개별상품등록에서 적립포인트 %를 변경이 가능합니다. (예 0.5, 1, 1,5 소수점 가능)<br> 상품등록시 별도로 적립포인트를 등록하지 않을 경우 설정한 포인트가 적용됩니다. <br>
													이미 등록된 상품의 경우에는 해당 상품수정에 들어가셔서 적립포인트 변경하시기 바랍니다.
													</td>
												</tr>
												<tr>
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>축하 포인트</td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="point_register" type="text" class="formText" maxlength="11" <?=$style->strCheck();?> <?=$style->colorAlign("#FF0000", 2);?> value="<?=$admin_stat->point_register;?>">&nbsp;Point&nbsp;[가입시 적립되는 포인트]</td>
												</tr>
												<tr>
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'> 사용가능포인트<br></td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="point_use" type="text" class="formText" maxlength="11" <?=$style->strCheck();?> <?=$style->colorAlign("#FF0000", 2);?> value="<?=$admin_stat->point_use;?>">&nbsp;Point&nbsp;[일정 포인트 이상이 될 경우에만 결제시 사용가능]</td>
												</tr>
												<tr>
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>추천 회원제</td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="member_check" type="radio" value="1" onclick="javascript:memShow();" <? if( $admin_stat->member_check ==1 ) { echo("checked"); }?>>&nbsp;사용&nbsp;&nbsp;<input name="member_check" type="radio" value="0" onclick="javascript:memShow();" <? if( $admin_stat->member_check ==0 ) { echo("checked"); }?>>사용안함&nbsp;&nbsp;&nbsp;&nbsp;가입회원을 추천한 회원에게 적립되는 기능입니다</td>
												</tr>
												<tr  id="member_view" style="display;">
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>추천 회원</td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="member_invite" type="text" class="formText" maxlength="11" <?=$style->strCheck();?> <?=$style->colorAlign("#FF0000", 2);?> value="<?=$admin_stat->member_invite;?>">&nbsp;Point&nbsp;[가입회원을 추천한 회원에게 적립되는 포인트]</td>
												</tr>
												<tr  id="member_view" style="display;">
													<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>가입 회원</td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="member_register" type="text" class="formText" maxlength="11" <?=$style->strCheck();?> <?=$style->colorAlign("#FF0000", 2);?> value="<?=$admin_stat->member_register;?>">&nbsp;Point&nbsp;[가입회원이 추천회원을 입력한 경우 가입회원에게 적립되는 포인트]</td>
												</tr>
											</table><br><br><br><br>
												<table border="0" cellpadding="0" cellspacing="0" width="100%" style="display:none">
													<tr>
													<td class="sub_titleM"><a name="teb06"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">사이트 프레임설정</td>
													</tr>
													<tr>
														<td>
															<!--도움말-->
																<table cellpadding="0" cellspacing="0" width="100%" class='tipbox'>
																	<tr>
																		<td>
																			<table cellpadding="0" cellspacing="0" width="100%">
																				<tr>
																					<td height="20">
																						<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
																					</td>
																				</tr>
																				<tr>
																					<td><p>사이트주소부분에 프레임을 이용하여 주소표기부분을 감출수 있습니다.<br>단 보안서버 이용하실 경우에는 무조건 프레임을 사용하지 않음으로 변경됩니다.</p></td>
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
														<table width="100%" class="table_all">
															<tr>
																<td height="25" align="center" bgcolor="#E4E7EF"  class='contenM tabletd_all'>프레임사용</td>
																<td class='tabletd_all tabletd_small'>
																<?if($securityInfo->securityuse){?>
																<input type="radio" name="frametype" value="0" checked style="display:none"><b>보안서버 이용시 프레임 사용하지 않음으로 기본설정됩니다.</b>
																<?}else{?>
																<input type="radio" name="frametype" value="1" <?if($admin_stat->frametype==1){?>checked<?}?>>사용 <input type="radio"  name="frametype" value="0"  <?if($admin_stat->frametype=="0"){?>checked<?}?>>미사용
																<?}?>
																<br>사용하실 경우에는 사이트 접속시 <font color="red">http://<?=$_SERVER["SERVER_NAME"]?></font> 로만 표기가 됩니다.<br>사용하지 않는 경우에는 해당 페이지주소 및 변수 모두 표시가 됩니다.																				
																</td>
															</tr>			
														</table>
														</td>
													</tr>
												</table>

												<table style='margin:0 auto'>
													<tr>
														<td><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
													</tr>
												</table>
											</td>
										</tr>
									</form>
									</table>

									<!-- 계좌번호 입력폼 과 추천회원제폼 숨기기 자바스크립트 -->
									<SCRIPT LANGUAGE="JavaScript">
									<!--
									var form=document.admin_form;

									if( form.member_check[0].checked ) {
										document.all.member_view[0].style.display=""; 
										document.all.member_view[1].style.display=""; 
									} else {
										document.all.member_view[0].style.display="none"; 
										document.all.member_view[1].style.display="none"; 
									}

									if( form.express_check[1].checked ) {
										document.all.express_view.style.display="";
									} else if( form.express_check[2].checked ) {
										document.all.express_view.style.display="";
									} else {
										document.all.express_view.style.display="none"; 
									}
									//-->
									</SCRIPT>
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
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<? include('../footer.php'); ?>

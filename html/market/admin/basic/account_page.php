<?
	include('../header.php');
	include($ROOT_DIR.'/lib/style_class.php');
	// 기본 관리자 정보 불러오기
	if(!is_null($_GET['changepg'])){
		if(!$db->cnt("cs_pgsetup","")){
			$db->insert("cs_pgsetup","pgcompany=$_GET[changepg]");
		}else{
			$db->update("cs_pgsetup","pgcompany=$_GET[changepg]");
		}
	}
	$pgInfo = $db->object("cs_pgsetup", "");
?>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/sub_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">결제정보
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
						<tr>
							<td class="sub_titleM" height="35"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">결제모듈 관리</td>
						</tr>
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
														<td><p>PG사는 기본으로 <font color="red">KCP</font>가 기본으로 적용이 되어 있습니다. 타 PG사를 적용하실 경우 아래 신규이용안내부분 참고 바랍니다.</td>
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
						<tr>
							<td height="5">
								<SCRIPT LANGUAGE="JavaScript">
									<!--
									// PG사 변경
									function changepg(value) {
										location.href="?changepg="+value;
									}
									//-->
								</SCRIPT>
							
								<table width="100%" class="table_all">
									<tr>
										<td class='tabletd_all tabletd_small' class="padding_5" bgcolor="#FFEFEF" >
											<SELECT NAME="pgcompany" onchange="changepg(this.value)" class='formSelect'>
												<OPTION VALUE="0" SELECTED>PG사를 선택하세요.</OPTION>
												<OPTION VALUE="1" <?if($pgInfo->pgcompany=="1"){?>selected<?}?>>KCP</OPTION>
											</SELECT> 사용할 PG사를 먼저 선택하여 주세요. 선택된 PG사가 없을경우 무통장 입금으로만 결제가 이뤄집니다.
										</td>
									</tr>
								</table>
								<br>


								<?if($pgInfo->pgcompany=="1"){?>
								<table width="100%" bgcolor="white">
									<tr>
										<td>
											<table width="100%" class="table_all">
												<SCRIPT LANGUAGE="JavaScript">
													<!--
													// 입력폼 체크 자바스크립트
													function acc_sendit() {
														var form=document.account_form;
														
														if(form.pg_true.checked==true && form.pg_code.value=="") {
															alert("PG사에서 발급받은 코드를 입력해 주세요.");
															form.pg_code.focus();
														} else if(form.pg_true.checked==true && form.pg_key.value=="") {
															alert("PG사에서 발급받은 키값을 입력해 주세요.");
															form.pg_key.focus();
															<?if(!$pgInfo->pg_logo){?>
														} else if(form.pg_logo_option[2].checked==true && form.pg_logo.value=="") {
															alert("로고로 사용될 이미지를 등록해 주세요.");
															form.pg_logo.focus();
															<?}?>
														} else {
															form.submit();
														}
													}
													//-->
												</SCRIPT>
												<form action="account_page_ok.php" method="post" name="account_form" enctype="multipart/form-data">
												<tr>
													<td width="120" height="25" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														PG 실사용 설정
													</td>
													<td height="25" class='tabletd_all tabletd_small'>
														&nbsp;<input type="checkbox" name="pg_true" value="1" <?if($pgInfo->pg_true==1){?>checked<?}?>> PG사 실제 사용시 선택하여 주세요. 체크가 없을경우 테스트 계정으로 테스트결제 가능합니다.
													</td>
												</tr>
												<tr>
													<td width="120" height="25" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														PG 결제모듈 선택
													</td>
													<td height="25" class='tabletd_all tabletd_small'>
														&nbsp;<input type="checkbox" name="pg_card" value="1" <?if($pgInfo->pg_card==1){?>checked<?}?>> 카드결제<br>&nbsp;<input type="checkbox" name="pg_ich" value="1" <?if($pgInfo->pg_ich==1){?>checked<?}?>> 계좌이체[<input type="checkbox" name="pg_ich_escr" value="1" <?if($pgInfo->pg_ich_escr==1){?>checked<?}?>> 에스크로 적용]<br>&nbsp;<input type="checkbox" name="pg_vich" value="1" <?if($pgInfo->pg_vich==1){?>checked<?}?>> 가상계좌[<input type="checkbox" name="pg_vich_escr" value="1" <?if($pgInfo->pg_vich_escr==1){?>checked<?}?>> 에스크로 적용]<br>&nbsp;<input type="checkbox" name="pg_phone" value="1" <?if($pgInfo->pg_phone==1){?>checked<?}?>> 휴대폰결제<br>&nbsp;
														PG사와 계약한 건에 대한 결제모듈을 선택하여주세요. 에스크로의 경우 적용할 모듈에만 적용하여 주시고 설정은 KCP관리자 페이지의 설정에 따릅니다.
													</td>
												</tr>
												<tr>
													<td width="120" height="25" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														사이트 코드
													</td>
													<td height="25" class='tabletd_all tabletd_small'>
														&nbsp;<input name="pg_code" type="text" class="formText" value="<?=$pgInfo->pg_code;?>">
													</td>
												</tr>
												<tr>
													<td width="120" height="25" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														사이트 키
													</td>
													<td height="25" class='tabletd_all tabletd_small'>
														&nbsp;<input name="pg_key" type="text" class="formText" value="<?=$pgInfo->pg_key;?>">
													</td>
												</tr>
												<tr>
													<td width="120" height="25" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														사이트 로고 옵션
													</td>
													<td height="25" class='tabletd_all tabletd_small'>
														&nbsp;<input type="radio" value="0" name="pg_logo_option" onclick="document.all.pgLogo.style.display='none'" <?if(!$pgInfo->pg_logo_option){?>checked<?}?>>없음&nbsp;&nbsp;<input type="radio" value="1" name="pg_logo_option" onclick="document.all.pgLogo.style.display='none'" <?if($pgInfo->pg_logo_option==1){?>checked<?}?>>사이트로고&nbsp;&nbsp;<input type="radio" value="2" name="pg_logo_option" onclick="document.all.pgLogo.style.display=''" <?if($pgInfo->pg_logo_option==2){?>checked<?}?>>별도등록 &nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>※결제 팝업창에 나타나는 로고설정 입니다.</font>
													</td>
												</tr>
												<tr id="pgLogo" style="display:<?if($pgInfo->pg_logo_option!=2){?>none<?}?>;">
													<td width="120" height="25" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														PG 로고
													</td>
													<td height="25" class='tabletd_all tabletd_small'>
														&nbsp;<input type="file" name="pg_logo" class="formText">
														<?if($pgInfo->pg_logo){
																$logo_img="<img src='../../data/designImages/".$pgInfo->pg_logo."' border='0' align='absmiddle'>";
															?>
														<input type="checkbox" value="1" name="del_pg_logo">삭제시 선택하여주세요[삭제우선]!<br>&nbsp;<?=$logo_img?>
														<?}?>
													</td>
												</tr>
												<tr>
													<td width="120" height="25" bgcolor="#E4E7EF"  class='contenM tabletd_all'>
														에스크로 로고
													</td>
													<td height="25" class='tabletd_all tabletd_small' bgcolor="#ffffff">
														&nbsp;<input type="file" name="escicon" class="formText">
														<?if($pgInfo->escicon){
																$es_img="<img src='../../data/designImages/".$pgInfo->escicon."' border='0' align='absmiddle'>";
															?>
														<input type="checkbox" value="1" name="del_escicon">삭제시 선택하여주세요[삭제우선]!<br>&nbsp;<?=$es_img?>
														<?}else{?>
														<table>
															<tr>
																<td align="center" bgcolor="black">
																	<img src="../../<?=$skin_url?>/images/es_foot_sample.png" border="0" align="left">
																</td>
																<td valign="top">
																  별도로 마크를 등록하지 않으실 경우에는 기본 에스크로 로고가 적용됩니다.
																</td>
															</tr>
														</table>
														<?}?>
													</td>
												</tr>
												<tr>
													<td width="120" height="25" align="center" bgcolor="#FFEFEF"  class='contenM tabletd_all'>KCP 가입하기
													</td>
													<td height="25" bgcolor="#FFEFEF"  class='tabletd_all'><a href="https://www.kcp.co.kr/service.payment.request.do" target="_new" class='searchB'>바로가기</a>
													</td>
												</tr>
												<tr>
													<td width="120" height="25" align="center" bgcolor="#FFF8DD"  class='contenM tabletd_all'>
														PG사 관리자 페이지
													</td>
													<td height="25" bgcolor="#FFF8DD"  class='tabletd_all'><a href="https://admin.kcp.co.kr/Modules/Login/Login.jsp" target="_new" class='searchB'>바로가기</a>
													</td>
												</tr>
												</form>
											</table><br>
											<table width="100%">
												<tr>
													<td align="center"><a href="javascript:acc_sendit();" class='oolimbtn-botton1'>등록</a></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<?}?>
							</td>
						</tr>
						<tr>
							<td>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<!-- 한단락 -->
			<!-- 한단락 -->
			<tr>
				<td height="45"></td>
			</tr>
			<tr>
				<td height="5" class="padding_5">
					<table width="100%">
						<tr>
							<td class="sub_titleM" height="35"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">무통장 계좌 관리</td>
						</tr>
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
													<td><p>PG사의 가상계좌를 사용하지 않거나, PG사를 사용하지 않고 무통장으로만 거래가 가능합니다.</p></td>
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
						<tr>
							<td height="5">
								<table width="100%" bgcolor="white">
									<tr>
										<td>
											<table width="100%" class="table_all">
												<tr align="center">
													<td height="35" bgcolor="#E4E7EF" class='contenM tabletd_all noneoolimmoL'>
														은행명
													</td>
													<td height="35" bgcolor="#E4E7EF" class='contenM tabletd_all noneoolimmoL'>
														계좌번호
													</td>
													<td height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>
														예금주
													</td>
													<td height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>
														메인노출
													</td>
													<td width="100" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>
														비고
													</td>
												</tr>
												<?
												$result		= $db->select( "cs_banklist", "order by ranking asc" );
												while( $row = mysqli_fetch_object($result) ) {
												$bankList++;
												?>
												<tr>
													<td width="20%" height="25" class='tabletd_all tabletd_Lmall noneoolimmoL'>
														<?=$row->bank_name?>
													</td>
													<td width="20%" height="25" class='tabletd_all tabletd_Lmall noneoolimmoL'>
														<?=$row->bank_account?>
													</td>
													<td height="25" class='tabletd_all tabletd_Lmall'>
														<span class='noneoolimmoL_on' style='text-align:center;'>은행명<br><?=$row->bank_name?><hr>
														계좌번호<br><?=$row->bank_account?><hr></span>
														예금주<br><?=$row->name?>
													</td>
													<td height="25" class='tabletd_all tabletd_Lmall'>
														<? if($row->main_marking==1) {echo("노출");}?>
													</td>
													<td height="25" class='tabletd_all tabletd_Lmall'>
														<a href="?bankIdx=<?=$row->idx?>" class="menusmall_btn3">수정</a> <a href="javascript:bankDel('<?=$row->idx?>')" class="menusmall_btn4">삭제</a>
													</td>
												</tr>
												<?}?>
												<?if(!$bankList){?>
												<tr align="center">
													<td colspan="5" height="25" class='tabletd_all tabletd_small'>
														등록된 은행계좌가 없습니다. 
													</td>
												</tr>
												<?}?>
											</table>
											<hr>

											<table width="100%" class="table_all">
												<SCRIPT LANGUAGE="JavaScript">
													<!--
													// 입력폼 체크 자바스크립트
													function bank_sendit() {
														var form=document.bank_form;
														
														if(form.bank_name.value=="") {
															alert("은행명을 입력해 주세요.");
															form.bank_name.focus();
														} else if(form.bank_account.value=="") {
															alert("은행계좌 번호를 입력해 주세요.");
															form.bank_account.focus();
														} else if(form.name.value=="") {
															alert("명의자 명을 입력해 주세요.");
															form.name.focus();
														} else {
															form.submit();
														}
													}

													function bankDel( idx ) {
														var choose = confirm( '삭제 하시겠습니까?');
														if(choose) {	location.href='account_bank_ok.php?mode=D&bankIdx='+idx; }
														else { return; }
													}
													//-->
												</SCRIPT>
												<form action="account_bank_ok.php" method="post" name="bank_form">
												<?if($_GET['bankIdx']){
												$bankInfo = $db->object("cs_banklist", "where idx='$_GET[bankIdx]'");	
												?>
												<input type="hidden" name="mode" value="E">
												<input type="hidden" name="bankIdx" value="<?=$bankInfo->idx?>">
												<?}else{?>
												<input type="hidden" name="mode" value="I">
												<?}?>
												<tr align="center" bgColor="#F9F6E6">
													<td height="30" class='contenM tabletd_all noneoolimmoL'>
														은행명<br><input name="bank_name" type="text" class="formText textDomin" <?=$style->align(0);?> value="<?=$bankInfo->bank_name?>">
													</td>
													<td class='contenM tabletd_all noneoolimmoL'>
														계좌번호<br><input name="bank_account" type="text" class="formText textDomin" <?=$style->align(0);?> value="<?=$bankInfo->bank_account?>">
													</td>
													<td class='contenM tabletd_all'>
														예금주<br><input name="name" type="text" class="formText textDomin" <?=$style->align(0);?> value="<?=$bankInfo->name?>">
													</td>
													<td width='15%' class='contenM tabletd_all'>
														메인노출 : 
														<select name="main_marking">
															<option value="0" <?if($bankInfo->main_marking==0){?>selected<?}?>>메인노출 X</option>
															<option value="1" <?if($bankInfo->main_marking==1){?>selected<?}?>>메인노출 O</option>
														</select>
													</td>
													<td width='15%' style='text-align:center;'>
														<a href="javascript:bank_sendit();" class="searchC">등록</a>
													</td>
												</tr>
												</form>
											</table><br>

											<table width="100%" class="table_all" border="0" align="center">
												<tr>
													<td bgcolor="#FFDFDF" height='40' style='text-align:center'>
														<font color="red">카드결제사(PG) 신청 및 사용안내</font>
													</td>
												</tr>
												<tr>
													<td height='1' bgcolor="#555555"></td>
												</tr>
												<tr>
													<td bgcolor="#DFF0FF" style="padding-left:15px;" height='40'>
														<p><font color="blue">KCP 기존사용자안내</font></p>
													</td>
												</tr>
												<tr>
													<td height='1' bgcolor="#555555"></td>
												</tr>
												<tr>
													<td bgcolor="white" style="padding-left:15px;">
														<p>기본으로 탑재되어 있는 PG사는 KCP입니다.<br>업체에서 부여받은 상점ID및 키값을 
														위 라이센스키 입력란에 입력해 주시면 됩니다.</p>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
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


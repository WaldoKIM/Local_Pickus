<?
include('../header.php');
include($ROOT_DIR."/lib/style_class.php");
//$_GET=&$HTTP_GET_VARS; //$_POST=&$HTTP_POST_VARS;
$mv_data	= $_GET[mem_data];
$mem_data	= $tools->decode( $_GET[mem_data] );
$row = $db->object("cs_member", "where idx='$mem_data[idx]'");
$total_point = $db->sum("cs_point", "where userid='$row->userid'", "point");
$buy_goods_cnt = $db->cnt("cs_trade", "where order_userid='$row->userid' and trade_stat=4");

$skin_url = str_replace($admin_stat->shop_domain,'', $admin_stat->shop_url);
?>

<script language="JavaScript">
<!--
// 우편번호찾기
function postWinOpen(data) {
	window.open("../..<?=$skin_url;?>/post_search.php?method="+data, "","scrollbars=yes, width=500, height=400");
}

function sendit() {
	var form=document.join_form;
	if(form.email.value=="") {
		alert("회원님의 E-Mail를 입력해 주세요.");
		form.email.focus();
	<?if($admin_stat->member_birth==1 && $admin_stat->member_birth_use==1){?>
	} else if(form.birthm.value=="" || form.birthy.value=="" || form.birthd.value=="") {
		alert("회원님의 생년월일을 선택해 주세요.");
		form.birthm.focus();
	<?}?>
	<?if($admin_stat->member_tel==1 && $admin_stat->member_tel_use==1){?>
	} else if(form.tel1.value=="") {
		alert("회원님의 전화번호를 입력해 주세요.");
		form.tel1.focus();
	} else if(form.tel2.value=="") {
		alert("회원님의 전화번호를 입력해 주세요.");
		form.tel2.focus();
	} else if(form.tel3.value=="") {
		alert("회원님의 전화번호를 입력해 주세요.");
		form.tel3.focus();
	<?}?>
	<?if($admin_stat->member_phone==1 && $admin_stat->member_phone_use==1){?>
	} else if(form.phone1.value=="" || form.phone2.value=="" || form.phone3.value=="") {
		alert("회원님의휴대번호를 입력해 주세요.");
		form.phone1.focus();
	<?}?>
	<?if($admin_stat->member_addr==1 && $admin_stat->member_addr_use==1){?>
	} else if(form.zip.value=="") {
		alert("회원님의 우편번호를 입력해 주세요.");
		form.zip.focus();
	} else if(form.zip.value.length != 5) {
		alert("회원님의 우편번호 5자리를 입력해 주세요.");
		form.zip.focus();
	} else if(form.add1.value=="") {
		alert("회원님의 주소를 입력해 주세요.");
		form.add1.focus();
	} else if(form.add2.value=="") {
		alert("회원님의 상세주소(번지)를 입력해 주세요.");
		form.add2.focus();
	<?}?>
	} else {
		form.submit();
	}
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
									<table width="100%">
										<tr> 
											<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
												<table width="100%">
													<tr> 
														<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">회원정보수정</td>
													</tr>
												</table>
												<table width="100%" class="table_all">
													<form action="member_edit_ok.php" method="post" name="join_form">
													<input type="hidden" name="mem_data" value="<?=$mv_data;?>">
													<tr bgColor="white">
														<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>아이디</td>
														<td class='tabletd_all tabletd_small'><?=$row->userid;?></td>
													</tr>
													<tr bgColor="white"> 
														<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>비밀번호</td>
														<td class='tabletd_all tabletd_small'><input type="password" name="passwd" size="15" class="formText"></td>
													</tr>
													<tr bgColor="white"> 
														<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>이 름</td>
														<td class='tabletd_all tabletd_small'><?=$row->name;?></td>
													</tr>
													<tr bgColor="white"> 
														<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>이메일</td>
														<td height="25" class='tabletd_all tabletd_small'><input type="text" name="email" size="40" class="formText email" value="<?=$row->email;?>">&nbsp;&nbsp;&nbsp;* 한메일은 주문시 메일발송이 비정상적으로 될수 있습니다.</td>
													</tr>
													<?if($admin_stat->member_birth==1){?>
													<tr bgColor="white"> 
														<td  width="15%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;생년월일</td>
														<td height="35" class='sensP tabletd_all'>
															<select name="birthy" size="1">
																<option value="">선택</option>
																<?for($i=date("Y")-70;$i<=date("Y");$i++){?>
																<option value="<?=$i?>" <?if($row->birthy==$i){?>selected<?}?>><?=$i?></option>
																<?}?>
															</select>
															년&nbsp;
															<select name="birthm" size="1">
																<option value="">선택</option>
																<?for($i=1;$i<=12;$i++){?>
																<option value="<?=$i?>" <?if($row->birthm==$i){?>selected<?}?>><?=$i?></option>
																<?}?>
															</select>
															월&nbsp;
															<select name="birthd" size="1">
																<option value="">선택</option>
																<?for($i=1;$i<=31;$i++){?>
																<option value="<?=$i?>" <?if($row->birthd==$i){?>selected<?}?>><?=$i?></option>
																<?}?>
															</select>
															일</td>
													</tr>
													<?}?>
													<?if($admin_stat->member_tel==1){?>
													<tr bgColor="white"> 
														<td  width="15%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;전화번호</td>
														<td height="35" class='sensP tabletd_all'><input name="tel1" type="text" class="formText textphone" maxlength="4" size="4" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$row->tel1;?>"> - <input name="tel2" type="text" class="formText textphone" maxlength="4" size="4" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$row->tel2;?>"> - <input name="tel3" type="text" class="formText textphone" maxlength="4" size="4" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$row->tel3;?>"></td>
													</tr>
													<?}?>
													<?if($admin_stat->member_phone==1){?>
													<tr bgColor="white"> 
														<td  width="15%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;휴대폰</td>
														<td height="35" class='sensP tabletd_all'><input name="phone1" type="text" class="formText textphone" maxlength="4" size="4" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$row->phone1;?>"> - <input name="phone2" type="text" class="formText textphone" maxlength="4" size="4" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$row->phone2;?>"> - <input name="phone3" type="text" class="formText textphone" maxlength="4" size="4" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$row->phone3;?>"></td>
													</tr>
													<?}?>
													<?if($admin_stat->member_addr==1){?>
													<tr bgColor="white"> 
														<td  width="15%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;우편번호</td>
														<td height="35" class='sensP tabletd_all'>
														<input name="zip" type="text" class="formText" maxlength="5" size="5" style="text-align: center;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" value="<?=$row->zip;?>">
														</td>
													</tr>
													<tr bgColor="white"> 
														<td  width="15%" height="35" bgcolor="#E4E7EF" class='contenM tabletd_all'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;주 소</td>
														<td height="35" class='sensP tabletd_all'><input name="add1" type="text" class="formText textAddr01" value="<?=$row->add1;?>"><br><input name="add2" type="text" class="formText textAddr01" value="<?=$row->add2;?>"> 상세정보(번지)</td>
													</tr>
													<?}?>
													<tr bgColor="white"> 
														<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>회원 레벨</td>
														<td class='tabletd_all tabletd_small'><select name="level" class="menu">
															<?
															$user_result = $db->select( "cs_user_list", " order by idx asc"); 
															while( $user_row = @mysqli_fetch_object($user_result) ) { 
																if($user_row->idx==$row->level){
																?>																					
																<option value="<?=$user_row->idx?>" selected><?=$user_row->name?>
																</option>
																<?
																}else{
																?>																					
																<option value="<?=$user_row->idx?>"><?=$user_row->name?>
																</option>
																<?
																}
															}
															?>																					
														</select></td>
													</tr>
													<tr bgColor="white"> 
														<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>포인트</td>
														<td class='tabletd_all tabletd_small'><? if($total_point) { echo(number_format($total_point)." 점");} else { echo("누적 포인트가 없습니다.");}?>&nbsp;&nbsp;&nbsp;포인트 추가삭제는 회원리스트에서 변경</td>
													</tr>
													<tr bgColor="white"> 
														<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>구매횟수</td>
														<td class='tabletd_all tabletd_small'><?=number_format($buy_goods_cnt);?>&nbsp;번</td>
													</tr>
													<tr bgColor="white"> 
														<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>로그인접속수</td>
														<td class='tabletd_all tabletd_small'><?=number_format($row->connect);?>&nbsp;번</td>
													</tr>
													<? if( $admin_stat->member_check ) {?>
													<tr bgColor="white"> 
														<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>추천인아이디</td>
														<td class='tabletd_all tabletd_small'><? if($row->recomid) { echo($row->recomid);} else { echo("추천인이 없습니다.");}?></td>
													</tr>
													<?}?>
													<tr bgColor="white"> 
														<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>인사말</td>
														<td class='tabletd_all tabletd_small'><?=$tools->strHtmlNo($row->content);?></td>
													</tr>
													<tr bgColor="white"> 
														<td width="15%" height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>메일링서비스</td>
														<td class='tabletd_all tabletd_small'><input name="mailing" type="radio" value="1" <? if($row->mailing==1) { echo('checked');}?>>받아보겠습니다.&nbsp;<input name="mailing" type="radio" value="0" <? if($row->mailing==0) { echo('checked');}?>>안 받아보겠습니다.</td>
													</tr>
													</form>
												</table>

												<table style='margin:0 auto;'>
													<tr>
														<td height='70'><a href="member.php?mem_data=<?=$mv_data;?>" class='oolimbtn-botton1_1'>뒤로</a>&nbsp;<a href="javascript:sendit();" class='oolimbtn-botton1'>수정완료</a></td>
													</tr>
												</table>			

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



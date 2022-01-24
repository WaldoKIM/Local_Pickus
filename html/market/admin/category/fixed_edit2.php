<?
include('../header.php');
include($ROOT_DIR.'/lib/style_class.php');
//$_GET=&$HTTP_GET_VARS; $edit_row = $db->object("cs_part_fixed", "where idx='$_GET[idx]'");

$fieldArr = explode("@", $edit_row->fieldlist);
?>

<script language="JavaScript">
<!--
function sendit() {
	var form=document.part_form;
	if(form.part_name.value=="") {
		alert("카테고리 이름을 입력해 주십시오.");
		form.part_name.focus();
	} else {
		form.submit();
	}
}

//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/category_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">

		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">카테고리설정</td>
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
								<form action="fixed_edit2_ok.php" method="post" name="part_form" enctype="multipart/form-data">
								<input type="hidden" name="hidden_part_index" value="2">
								<input type="hidden" name="idx" value="<?=$edit_row->idx;?>">
								<tr> 
									<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">

									<table width="100%">
											<tr>
											<td>
												<table width="100%">
													<tr>
														<td height="35">
														<table>
															<tr>
																<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">2차카테고리수정</td>
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
																					<td>Category Display : 이벤트 메뉴 사용유무를 선택하며, 사용하지 않을 경우에는 주메뉴(상단메뉴) 및 메인진열상품역시 노출되지 않습니다.
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
															<!--//도움말-->
														</td>
													</tr>
													<tr>
														<td height="35"></td>
													</tr>
												</table>
											</td>
											</tr>
										</table>
										<table width="100%" class="table_all">
											<tr bgColor="white"> 
												<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>카테고리 상태</td>	
												<td class='tabletd_all tabletd_small'>&nbsp;&nbsp;<font color="#FF0000">2차 카테고리 수정</font></td>
											</tr>
											<tr bgColor="white"> 
												<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>카테고리 이름</td>
												<td class='tabletd_all tabletd_small'>
													&nbsp;한글 : <input name="part_name" type="text" class='formText' maxlength="100" size="30" value="<?=$tools->strHtmlNo($edit_row->part_name);?>">&nbsp;&nbsp;이벤트명을 적어주세요(예:베스트상품)<br>
													 <? if( $edit_row->idx != 7 ) {?>&nbsp;영문 : <input name="part_ename" type="text" class='formText' maxlength="100" size="30" value="<?=$tools->strHtmlNo($edit_row->part_ename);?>">&nbsp;&nbsp;영문이벤트명을 적어주세요(예:Best Products)<br><?}?>
												</td>
											</tr>
											<tr bgColor="white"> 
												<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>간략한 문구</td>
												<td class='tabletd_all tabletd_small'>
													&nbsp;<input name="short_content" type="text" class='formText' maxlength="100" size="30" value="<?=$tools->strHtmlNo($edit_row->short_content);?>">&nbsp;&nbsp;예)변하지 않은 마음으로 최고의 품질을 약속합니다.
												</td>
											</tr>
											<tr bgColor="white" style="display:none"> 
												<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>카테고리 코드</td>
												<td class='tabletd_all tabletd_small'>&nbsp;1차 코드&nbsp;<input name="part1_code" type="text" class='formText' maxlength="20" size="10" value="<?=$edit_row->part1_code;?>" readonly <? $style->colorAlign('#666666', 0);?>>&nbsp;2차 코드&nbsp;<input name="part2_code" type="text" class='formText' maxlength="20" size="10" value="<?=$edit_row->part2_code;?>" readonly <? $style->colorAlign('#666666', 0);?>>&nbsp;&nbsp;카테고리 코드는 수정할수 없습니다.</td>
											</tr>
											<tr bgColor="white"> 
												<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>Category Display </td>
												<td class='tabletd_all tabletd_small'>&nbsp;<input type="radio" name="part_display_check" value="0" <? if( $edit_row->part_display_check == 0 ) { echo( 'checked' ); }?>>&nbsp;미사용&nbsp;&nbsp;<input type="radio" name="part_display_check" value="1" <? if( $edit_row->part_display_check == 1 ) { echo( 'checked' ); }?>>&nbsp;사용&nbsp;&nbsp;&nbsp;(사용자 화면에 Display 유무 설정)</td>
											</tr>
											<tr bgColor="white" style="display:none"> 
												<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>하위 카테고리 설정</td>
												<td class='tabletd_all tabletd_small'>&nbsp;<input type="radio" name="part_low_check" value="0" <? if( $edit_row->part_low_check == 0 ) { echo( 'checked' ); }?>>&nbsp;미사용&nbsp;&nbsp;<input type="radio" name="part_low_check" value="1" <? if( $edit_row->part_low_check == 1 ) { echo( 'checked' ); }?>>&nbsp;사용&nbsp;&nbsp;&nbsp;(3차 카테고리를 등록 유무 설정)</td>
											</tr>
											<tr bgColor="white" <? if( $edit_row->idx == 7 ) {?>style="display:none"<?}?>> 
												<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>상품 메인 출력수량</td>
												<td class='tabletd_all tabletd_small'>&nbsp;
													<select name="goods_main_cnt" class='formText'>
														<? for($i=1; $i < 51; $i++) {?>
														<option value="<?=$i;?>" <? if($i==$edit_row->goods_main_cnt) echo('selected');?>><?=$i;?></option>
														<? }?>
													</select> ◁ 메인에 노출될 상품의 수량을 설정가능합니다.
												</td>
											</tr>
											<tr bgColor="white" <? if( $edit_row->idx == 7 ) {?>style="display:none"<?}?>> 
												<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>상품 메인정렬형태</td>
												<td class='tabletd_all tabletd_small'>&nbsp;
													<select name="itemsort" class='formText'>
														<option value="1" <? if(1==$edit_row->itemsort) echo('selected');?>>랜덤</option>
														<option value="2" <? if(2==$edit_row->itemsort) echo('selected');?>>등록순</option>
													</select><br>
													랜덤 : 이벤트상품으로 등록된 상품에서 무작위로 메인노출수량만큼 진열됩니다.<br>
													등록순 : 최근에 등록한 사품이 가장먼저 노출됩니다..<br>
												</td>
											</tr>
											<tr bgColor="white" <? if( $edit_row->idx == 7 ) {?>style="display:none"<?}?>> 
												<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>상품 메인진열형태</td>
												<td class='tabletd_all tabletd_small'>&nbsp;
													<select name="display_type" class='formText'>
														<option value="1" <? if(1==$edit_row->display_type) echo('selected');?>>A형태</option>
														<option value="2" <? if(2==$edit_row->display_type) echo('selected');?>>B형태</option>
													</select><br>
													A형태 : 한줄 진열되며, 좌우로 자동 스크롤 되는 형태입니다.<br>
													B형태 : 노출수량만큼 메인에 모두 진열됩니다.
												</td>
											</tr>
											<tr bgColor="white" <? if( $edit_row->idx == 7 ) {?>style="display:none"<?}?>> 
												<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>모서리 명칭 및 배경색상</td>
												<td class='tabletd_all tabletd_small'>
													&nbsp;명칭 : <input name="corner_name" type="text" class='formText' maxlength="5" size="5" value="<?=$edit_row->corner_name;?>">&nbsp;예)Best, New, 할인, 추천....(영어표기 : 6글자이하/ 한글표기: 4글자이하)&nbsp;<br>
													&nbsp;색상 : <input name="corner_color" type="text" class='formText' maxlength="6" size="7" value="<?=$edit_row->corner_color;?>">&nbsp;예)000000, FF6A5F 등 웹색상표로 등록하시기 바랍니다.&nbsp;<br>
													<font color="Red">상품 메인진열형태</font>가 A형태일 경우 상품사진 우측상단에 간략한 안내문구를 관리하실수 있습니다.
												</td>
											</tr>
											<tr bgColor="white"> 
												<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>상품 출력수량</td>
												<td class='tabletd_all tabletd_small'>&nbsp;
													<select name="goods_cnt" class='formText'>
														<? for($i=1; $i < 51; $i++) {?>
														<option value="<?=$i;?>" <? if($i==$edit_row->goods_cnt) echo('selected');?>><?=$i;?></option>
														<? }?>
													</select> ◁ 페이지당 상품출력 개수
												</td>
											</tr>
											</table>
										<table width="100%">
											<tr> 
												<td height="55" align="center"><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
											</tr>
										</table>
									</td>
								</tr>
								</form>
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

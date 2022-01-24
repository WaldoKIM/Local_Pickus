<?
	include('../header.php');
	include($ROOT_DIR.'/lib/style_class.php'); 
	$securityinfo = $db->object("cs_security_setup", "");
	// 기본 관리자 정보 불러오기.
?>


<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/sub_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">



		<table width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">도서산간지역
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
													<td class="sub_titleM" height="35"><img src="../img/left_menu_2013icon4.gif" style='vertical-align:-5%'>도서산간지역</td>
												</tr>
												<tr>
													<td height="10">
														<!--도움말-->
															<table width="100%">
																<tr>
																	<td bgcolor="#E9F2F8" class='tipbox'>
																	<img src="../img/tip_icon.gif" width="28" height="11"><br>* 도서산간지역으로 우편번호를 등록하시면 <u><font color="red">기본설정 > 배송정보</font></u> 에서 설정한 추가배송비만큼 배송비가 추가됩니다.<a href="basic_setup.php?#teb03"  class='searchE'><u>배송정보관리 바로이동</u></a> <br>* 추가배송비의 경우 배송비 설정이 무료일 경우에도 추가되오니 완전무료배송을 지정하실 경우에는 추가배송비를 "0"으로 설정하시기 바랍니다
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


														<div class='oolimbox-wrapper'>
															<div class='oolimbox-col_2dan-1'>


																	<script language="javascript">
																		<!--
																		// 폼 전송
																		function sendit() {
																			var form=document.admin_form;
																			if(form.zip.value==""){
																				alert("우편번호를 입력해 주세요.");
																			}else{
																				form.submit();
																				resize_frame();
																			}
																		}
																			
																		function resize_frame(){
																			frame_box.height = searchframe.document.body.scrollHeight;
																			frame_box.width = searchframe.document.body.scrollWidth;
																		}
																		//-->
																	</script>

																	<table width="100%" class="table_all">
																		<form action="overexpress_ok.php" method="post" name="admin_form" target="searchframe">
																		<tr>
																			<td width="120" height="25" align="center" bgcolor="#F0F6DF" class='contenM tabletd_all'>
																				우편번호 및 설명
																			</td>
																			<td height="25" valign="top" class='tabletd_all tabletd_small'>
																				우편번호:<input name="zip" id="zip" type="text" class="formText" maxlength="6" size="7"> 검색후 등록<br>
																				설&nbsp; &nbsp;명&nbsp; :&nbsp; <input name="content" id="content" type="text" class="formText">

																			</td>
																		</tr>
																		</form>
																	</table><br>
																	<div align='center'><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></div>
																	<br><br>
																	<table width="100%">
																		<tr>
																			<td id='frame_box'>
																				<iframe src='overexpress.iframe.php' name='searchframe' width='100%' height='100%' marginwidth='0' marginheight='0' frameborder='no' scrolling='no' onload='resize_frame()'></iframe>
																			</td>
																		</tr>
																	</table>
																	
																</div>
																<div class='oolimbox-col_2dan-2'>
																


																	우편번호 검색후 선택하여 주세요.
																	<div id="wrap" style="display:none;border:1px solid;width:95%;height:450px;margin:5px 0;position:relative;-webkit-overflow-scrolling:touch;">
																	</div>
																	<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
																	<script>
																		// 우편번호 찾기 찾기 화면을 넣을 element
																		var element_wrap = document.getElementById('wrap');

																		function sample3_execDaumPostcode() {
																			// 현재 scroll 위치를 저장해놓는다.
																			var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
																			new daum.Postcode({
																				oncomplete: function(data) {
																					// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

																					// 각 주소의 노출 규칙에 따라 주소를 조합한다.
																					// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
																					var fullAddr = data.address; // 최종 주소 변수
																					var extraAddr = ''; // 조합형 주소 변수

																					// 기본 주소가 도로명 타입일때 조합한다.
																					if(data.addressType === 'R'){
																						//법정동명이 있을 경우 추가한다.
																						if(data.bname !== ''){
																							extraAddr += data.bname;
																						}
																						// 건물명이 있을 경우 추가한다.
																						if(data.buildingName !== ''){
																							extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
																						}
																						// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
																						fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
																					}

																					// 우편번호와 주소 및 영문주소 정보를 해당 필드에 넣는다.
																					document.getElementById('zip').value = data.zonecode;
																					document.getElementById('content').focus();


																					// 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
																					//document.body.scrollTop = currentScroll;
																					sample3_execDaumPostcode();
																				},
																				// 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
																				onresize : function(size) {
																					element_wrap.style.height = size.height+"px";
																				},
																				width : '100%',
																				height : '100%'
																			}).embed(element_wrap);

																			// iframe을 넣은 element를 보이게 한다.
																			element_wrap.style.display = 'block';
																		}
																		sample3_execDaumPostcode();
																	</script>   
																</div>
															</div>
																
													</td>
												</tr>
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

<?	// 게시판 접근 권한 설정
	if( $bbs_admin_stat->bbs_read  > $_SESSION[LEVEL] ) {
		$tools->errMsg($read_name->name.' 회원이상 읽기권한이 있습니다.');
	}
	$bbs_stat			= $db->object("cs_bbs_data", "where idx=$idx");


	if($bbs_stat->hold==1){
		if($_SESSION[USERID]){
			if($_SESSION[USERID]!=$bbs_stat->userid){
				if(!$db->cnt("cs_bbs_data", "where idx='$idx' and pwd=PASSWORD('$_POST[pwd]')")){
					$tools->errMsg(' 비밀글 읽기권한이 없습니다.');
				}
			}
		}else{
			if(!$db->cnt("cs_bbs_data", "where idx='$idx' and pwd=PASSWORD('$_POST[pwd]')")){
				$tools->errMsg(' 비밀글 읽기권한이 없습니다.');
			}
		}
	}
	$db->update("cs_bbs_data", "read_cnt=read_cnt+1 where idx=$idx");

	$name			= $bbs_stat->name;
	$email			= $bbs_stat->email;
	$reg_date	= $tools->strDateCut($bbs_stat->reg_date, 4);
	$subject		= $bbs_stat->subject;

	// 내용 출력 방식
	$content		= $bbs_stat->content;
	$url = "http://".$admin_stat->shop_domain."/".$skin_url."/".$TARGETFILENAME."?page_idx=".$_GET[page_idx]."&idx=".$idx."&code=".$code."&boardT=v";
?>

<div id="prev-next-links" style='width:100px;float:right;margin-top:70px;'><a id="link-previous-product" href='javascript:history.back()'></a></div>


<table width="100%">
	<tr>
		<td align="center" bgcolor="#FFFFFF">
			<table width="100%">
				<tr>
					<td valign="top">
						<!--게시판뷰상단콘텐츠-->
						<table width="100%">
							<tr>
								<td>

									<table width="100%">
										<tr>
											<td height="20"></td>
										</tr>
										<tr>
											<td height="2" bgcolor="#333333"></td>
										</tr>

										<tr>
											<td height="40" align="left" bgcolor="#f9f9f9" class="bbs_newsA jointable_td_border4"><b><?=$db->stripSlash($subject);?></td>
										</tr>

										<tr>
											<td height="40" class='jointable_td_border4'>
												<table>
													<tr>
														<td height="40" align="left" class="bbs1" style='padding-right:20px'><span class='smallBtn07' style="width:50px;">작성일</span>&nbsp;<span class="bbs3"><?=$reg_date;?></span></td>
														<td align="left" class="bbs1"><span class='smallBtn07' style="width:40px;">이름</span>&nbsp;<font color='959595'><?=$name;?></font> <? if( $email != "NULL") { ?><a href="mailto:<?=$email?>" onMouseOver="javascript:window.status='메일';return true;"><img src="images/icon_mail.gif" border="0" style='vertical-align:middle;'></a><?}?>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>

								</td>
							</tr>
							<? if($bbs_admin_stat->bbs_pds==1 && $bbs_stat->bbs_file != "none") {?>
							<tr>
								<td align="left" bgcolor="#f9f9f9" height="40" class='jointable_td_border4'>
									<!-- 자료실시작-->
									<? if( $bbs_admin_stat->bbs_pds && $bbs_stat->bbs_file != "none" )  { $bbs_file = explode( "&&", $bbs_stat->bbs_file ); ?>
									<span class='smallBtn07' style="width:50px;letter-spacing:0em;">FILE</span>&nbsp;<a href="bbs_download.php?board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>&download=1"><span class="bbs1"><?=$bbs_file[1];?></span></a>
									<?}?>
									<?
									$bbs_file = "";
									if( $bbs_admin_stat->bbs_pds && $bbs_stat->add_file1 != "none" )  { $bbs_file = explode( "&&", $bbs_stat->add_file1 ); ?>
									&nbsp;/&nbsp;<a href="bbs_download.php?board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>&download=1&add=1"><span class="bbs1"><?=$bbs_file[1];?></span></a>
									<? }?>
									<?
									$bbs_file = "";
									if( $bbs_admin_stat->bbs_pds && $bbs_stat->add_file2 != "none" )  { $bbs_file = explode( "&&", $bbs_stat->add_file2 ); ?>
									&nbsp;/&nbsp;<a href="bbs_download.php?board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>&download=1&add=2"><span class="bbs1"><?=$bbs_file[1];?></span></a>
									<? }?>
									<?
									$bbs_file = "";
									if( $bbs_admin_stat->bbs_pds && $bbs_stat->add_file3 != "none" )  { $bbs_file = explode( "&&", $bbs_stat->add_file3 ); ?>
									&nbsp;/&nbsp;<a href="bbs_download.php?board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>&download=1&add=3"><span class="bbs1"><?=$bbs_file[1];?></span></a>
									<? }?>
									<?
									$bbs_file = "";
									if( $bbs_admin_stat->bbs_pds && $bbs_stat->add_file4 != "none" )  { $bbs_file = explode( "&&", $bbs_stat->add_file4 ); ?>
									&nbsp;/&nbsp;<a href="bbs_download.php?board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>&download=1&add=4"><span class="bbs1"><?=$bbs_file[1];?></span></a>
									<? }?>
									<?
									$bbs_file = "";
									if( $bbs_admin_stat->bbs_pds && $bbs_stat->add_file5 != "none" )  { $bbs_file = explode( "&&", $bbs_stat->add_file5 ); ?>
									&nbsp;/&nbsp;<a href="bbs_download.php?board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>&download=1&add=5"><span class="bbs1"><?=$bbs_file[1];?></span></a>
									<? }?>

								</td>
							</tr>
								<?}?>
							</table>
							<!--게시판뷰상단콘텐츠-->
						</td>
					</tr>
					<tr>
						<td height='30'></td>
					</tr>
					<tr>
						<td>
							<table width="100%">
								<!-- 파일이 그림일 경우 출력(gif/jpg) -->
								<?
								$add_file = explode( ".", $bbs_stat->bbs_file );
								if( strtolower($add_file[1]) == "gif" || strtolower($add_file[1]) == "jpg" || strtolower($add_file[1]) == "png" || strtolower($add_file[1]) == "bmp" ) {
								?>
								<tr>
									<td height="25" align="center">
										<div id="item_img_content"><img src="../data/bbsData/<?=$bbs_stat->bbs_file;?>" border='0' ></div>
									</td>
								</tr>
								<tr>
									<td height="25" align="center"></td>
								</tr>
								<?}?>
								<!-- 파일이 그림일 경우 출력(gif/jpg) 1-->
								<?
								for($i=1;$i<=5;$i++){
									$add_file = "";
									$add_file = explode( ".", $bbs_stat->{"add_file".$i} );
									if( strtolower($add_file[1]) == "gif" || strtolower($add_file[1]) == "jpg" || strtolower($add_file[1]) == "png" || strtolower($add_file[1]) == "bmp" ) {
								?>
								<tr>
									<td height="25" align="center">
										<div id="item_img_content"><img src="../data/bbsData/<?=$bbs_stat->{"add_file".$i};?>" border='0' ></div>
									</td>
								</tr>
								<tr>
									<td height="25" align="center"></td>
								</tr>
								<?}}?>

								<tr>
									<td style="padding-top:10px; padding-bottom:10px;">
										<table align="center" width="100%">
											<tr>
												<td height="35" style="padding-right:10px;">
												  <!--폰트사이즈조절-->
													<table cellpadding="0" cellspacing="3" align="right">
														<tr>
															<td style='padding-right:2px;'><a href="javascript:fontSz('+','fontSzArea');"><img src='images/new_news_fontzoom1.png' border='0' alt='폰트확대'></a></td>
															<td><a href="javascript:fontSz('-','fontSzArea');"><img src='images/new_news_fontzoom2.png' border='0' alt='폰트축소'></a></td>
														</tr>
													</table>
												<!--폰트사이즈조절 끝-->
												</td>
											</tr>
											<tr>
												<td height="10"></td>
											</tr>
											<tr>
												<td height="1" bgcolor='efefef'></td>
											</tr>
											</tr>
											<tr>
												<td height="10"></td>
											</tr>
											<tr height='200' valign='top'>
												<td align="left" id="fontSzArea">
													<?=$db->stripSlash($content);?>
												</td>
											</tr>
											<tr>
												<td align="left" height='40'>
													<table>
														<tr>
															<?
															$sns_result		= $db->select("cs_bbs_sns", "where open=1 order by ranking asc" );
															$i=1;
															while( $snsrow = mysqli_fetch_object($sns_result) ) {
																if(array_search($snsrow->idx,$snstemp)){
																$iconinfo = $db->object("cs_mobile_icon", "where idx='$snsrow->icon'");
																$iconsize = @getimagesize("../data/designImages/".$iconinfo->icon);
																$snsusbject = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $subject);
																if($snsrow->noedit==1){
																?>
															<td  style='padding-left:3px;'>
															<div id="fb-root"></div>
															<script>(function(d, s, id) {
															  var js, fjs = d.getElementsByTagName(s)[0];
															  if (d.getElementById(id)) return;
															  js = d.createElement(s); js.id = id;
															  js.src = "//connect.facebook.net/ko_KR/sdk.js#xfbml=1&appId=<?=$snsrow->linkurl?>&version=v2.0";
															  fjs.parentNode.insertBefore(js, fjs);
															}(document, 'script', 'facebook-jssdk'));

															</script>
															<div class="fb-like" data-href="<?=$_SERVER['REQUEST_URI']?>" data-layout="button" data-action="recommend" data-show-faces="false" data-share="true"></div>	
															</td>
																<?}else{?>
															<td style='padding-left:3px;'>
																<script language="javascript">
																document.write("<td style='padding-left:2px;'>");
																var content = "<?=$snsrow->linkurl?>";
																content = content.replace('__{SNSTITLE}__', encodeURIComponent("<?=addslashes(strip_tags($snsusbject))?>"));
																content = content.replace('__{SNSURL}__', encodeURIComponent('http://<?=$admin_stat->shop_domain?>/<?=$skin_url?>/<?=$TARGETFILENAME?>?page_idx=<?=$_GET[page_idx]?>&idx=<?=$idx?>&code=<?=$code?>&boardT=v'));
																document.write("<a href='"+content+"' target='_new'><img src='../data/designImages/<?=$iconinfo->icon?>' border='0' alt='<?=$snsrow->name?>' style='vertical-align:middle;'></a>")
																document.write("</td>");
																</script>
															</td>
															<?}}}?>
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
					<tr>
						<td colspan="2" height="20">
						</td>
					</tr>
					<tr>
						<td colspan="2" height="2" bgcolor="#333333">
						</td>
					</tr>
				</table>
				<!-- 코멘트 시작 -->
				<script language="javascript">
				<!--
					function board_del() {
						var choose = confirm( '영구히 삭제 하시겠습니까?');
						if(choose) {	location.href='view_del.php?board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>' }
						else { return; }
					}
				//-->
				</script>

				<? if( $bbs_admin_stat->bbs_coment ) { ?>
				<script language="javascript">
				<!--
					function comentSendit() {
						var form=document.bbs_coment_form;
						if(form.name.value=="") {
							alert("이름을 입력해 주십시오.");
							form.name.focus();
						} else if(form.pwd.value=="") {
							alert("패스워드를 입력해 주십시오.");
							form.pwd.focus();
						} else if(form.coment.value=="") {
							alert("코멘트를 입력해 주십시오.");
							form.coment.focus();
						<?if($COMENTSIGN==1){?>
						} else if( form.imagecode.value=="") {
							alert("보안코드란을 입력해 주십시오.");
							form.imagecode.focus();
						<?}?>
						} else {
							form.submit();			
						}
					}

					function board_del() {
						var choose = confirm( '영구히 삭제 하시겠습니까?');
						if(choose) {	location.href='view_del.php?board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>' }
						else { return; }
					}
				//-->
				</script>
				<table width="100%" border="0" align="center">
					<tr>
						<td bgcolor='f9f9f9' colspan='4' height='20'></td>
					</tr>
					<tr>
						<td bgcolor='f9f9f9' colspan='4' height='30' class='bbsC' align="center">
							<table width="100%">
								<tr>
									<td width="50%" align="right">댓글</td>
									<td width="50%" align="right" style="padding-right:10px;">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor='f9f9f9' colspan='4' height='20'></td>
					</tr>
					<tr>
						<td colspan='4' height='1' bgcolor='dddddd'></td>
					</tr>
					<tr>
						<td colspan='4' height='20'></td>
					</tr>
					<tr>
						<td id="fontSzArea2">
							<table width="100%">
								<?
								$co_result = $db->select( "cs_bbs_coment", "where link=$bbs_stat->idx");
								while( $co_row = @mysqli_fetch_object($co_result)) {
								$co_idx			= $co_row->idx;
								$co_name		= htmlspecialchars($co_row->name);
								$co_coment		= htmlspecialchars($co_row->coment);
								$co_coment		= str_replace("\n","<br>", $co_coment);
								$co_coment		= stripslashes($co_coment);
								$co_reg_date	= $tools->strDateCut($co_row->reg_date);
								?>
								<tr>
									<td height="25" style="border-right-width:5px;" align='center'>
										<table width="98%">
											<tr>
												<td align="left" height='40'><span class='oolimmobilemenuM'><?=$co_name;?></span>&nbsp;&nbsp; · &nbsp;&nbsp;<font color='FF8282'><?=$co_reg_date;?></font>  <a href="?boardT=pd&T2=c&coment_idx=<?=$co_idx;?>&board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>" class="searchWi">삭제</a></td>
											</tr>
											<tr>
												<td align="left"><?=$co_coment;?></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height='10'></td>
								</tr>
								<tr height=1>
									<td colspan='4' height='1' bgcolor='dddddd'></td>
								</tr>
								<?} ?>
							</table>
						</td>
					</tr>
				</table>
				<table width="100%" border="0">
					<tr>
						<td>
							<table width="100%">
								<tr>
									<td bgcolor='ffffff'>

										<table width="100%" border="0">
											<tr>
												<td height='30'></td>
											</tr>
											<tr>
												<td height='1' bgcolor='#555555'></td>
											</tr>
											<form name="bbs_coment_form" action="bbs_coment_ok.php?board_data=<?=$MV_DATA;?>&search_items=<?=$SEARCH_DATA;?>" method="post">
											<input type="hidden" name="coment_reg" value="1">
											<tr>
												<td width='100%' align='center' height='45' bgcolor='f9f9f9' class='oolimmobilemenuM'>짧은 답글일수록 더욱 신중하게, 서로에 대한 배려는 네티켓의 기본입니다.</td>
											</tr>
											<tr>
												<td width='100%' align='center' bgcolor='ffffff'>
													<table width='100%'>
														<tr>
															<td colspan="2" align='center'>
																<div id="comment">
																<fieldset>
																	<table>
																		<colgroup><col width="*" /><col width="131" /></colgroup>
																		<tbody>
																			<tr>
																				<td><div class="box"><textarea name="coment"></textarea></textarea></div></td>
																			</tr>
																		</tbody>
																	</table>
																</fieldset>
																</div>
															</td>
														</tr>
														<?if($COMENTSIGN==1){?>
														<tr>
															<td align='center' style="padding-top:5px;"><img src="../chsignup.php?<?=SID?>" align="absmiddle">&nbsp;<input type="text" class="formText"  placeholder='*보안문자 입력' name="imagecode"></td>
														</tr>
														<?}?>
													</table>
													<table>
														<tr>
															<td>
																<table>
																	<tr>
																		<td height='30' align="right">ID :&nbsp;&nbsp;</td>
																		<td  height='30'align="left"><input type="text" name="name" class="formText formText_login" maxlength="15"><br></td>
																	</tr>
																	<tr>
																		<td height='30' align="right">PW :&nbsp;&nbsp;</td>
																		<td height='30' align="left"> <input type="password" name="pwd" class="formText formText_login" maxlength="15"></td>
																	</tr>
																</table>
															</td>
															<td style="padding-left:5px; width:100px;">
																<a href="javascript:comentSendit();" class='oolimbtn-botton4'>댓글등록</a>
															</td>
														</tr>
													</table>

												</td>
											</tr>
											</form>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="10" bgcolor='ffffff'></td>
					</tr>
				</table>
				<table width='100%' border="0" align='center'>
					<tr>
						<td height="1" bgcolor='#333333'></td>
					</tr>
					<tr>
						<td height="10"></td>
					</tr>
				</table>
				<? }?>
				<!-- 코멘트 종료-->
				<table width='100%' border="0" align='center'>
					<tr>
						<td height="20"></td>
					</tr>
				</table>
				<table border="0">
					<tr>
						<td height="20"></td>
					</tr>
					<tr>
						<td align='center'>
						<? if($bbs_admin_stat->bbs_write<=$_SESSION[LEVEL]) {?><a href="?boardT=rw&board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>" class='oolimbtn-botton1'>답글달기</a>

						<a href="<?if($_SESSION[USERID]==$bbs_stat->userid && $_SESSION[USERID]!=""){?>javascript:board_del()<?}else{?>?boardT=pd&T2=b&board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?><?}?>" class='oolimbtn-botton1'>삭제</a>

						<a href="<?if($_SESSION[USERID]==$bbs_stat->userid && $_SESSION[USERID]!=""){?>?boardT=e&board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?><?}else{?>?boardT=pe&T2=b&board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?><?}?>" class='oolimbtn-botton1'>글수정</a>
						<?}?>
						<?if($MV_DATA){?>
						<a href="?board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>" class='oolimbtn-botton1'>글목록</a>
						<?}else{?>
						<a href="?code=<?=$code;?>&page_idx=<?=$_GET[page_idx];?>" class='oolimbtn-botton1'>글목록</a>
						<?}?>
					</tr>
				</table>
		</td>
	</tr>
	<tr>
		<td height="30"></td>
	</tr>
</table>

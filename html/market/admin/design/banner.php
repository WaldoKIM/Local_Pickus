<? include('../header.php');?>
<script language="JavaScript">
	<!--
	// 수정
	function bannerEdit( idx ) {
		var choose = confirm( '수정 하시겠습니까?');
		if(choose) {	location.href='banner_edit.php?code=<?=$_GET[code]?>&idx='+idx; }
		else { return; }
	}
	
	// 삭제
	function bannerDel( idx ) {
		var choose = confirm( '삭제 하시겠습니까?');
		if(choose) {	location.href='banner_del_ok.php?code=<?=$_GET[code]?>&idx='+idx; }
		else { return; }
	}

	function select_code(value){
		location.href="?code="+value;
	}
	//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/design_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">배너관리
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
		<td>
			<table width="100%">
				<tr>
					<td height="35">
						<table width="100%">
							<tr>
							<td>
								<table width="100%">
									<tr>
										<td height="20">

											<!--도움말-->
												<table width="100%" class='tipbox noneoolim'>
													<tr>
														<td bgcolor="#E9F2F8">
															<table width="100%">
																<tr>
																	<td height="20">
																		<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
																	</td>
																</tr>
																<tr>
																	<td>현재 등록되어있는 배너목록이 나타납니다.<br>
																	등록을 하실려면 상단 우측의 배너추가 버튼을 누르시면 등록페이지로 이동합니다.<br>
																	※배너의 위치는 스킨마다 다르게 출력될 수 있습니다. 사용자 화면을 보면서 위치를 확인하신 후 입력해주세요.<br><br><br>
																	
																	<span style="font-size:11pt;">[배너 페이지 정보]</span><br>
																	배너의 위치는 스킨에 따라 위치가 틀립니다.<br>
																	솔루션 설치후 사용자페이지의 배너영역에 각각의 배너코드가 설명되어 있으니 참고하시 해당 코드별로 배너를 등록하시면 되겠습니다.<br><br><br>

																	http://사용자도매인/스킨명/include/banner_header_top.inc.php<br>
																	http://사용자도매인/스킨명/include/banner_main_mid.inc.php<br><br>

																	※배너의 진열형태는 직접 해당 소스를 열어서 가로 또는 세로의 형태를 설정할 수 있으며, 배너의 갯수 또한 소스에서 직접 수정할 수 있습니다.<br>
																	기본적으로 설정되어 있는 배너위치 이외에 사용자가 직접 원하는 위치에 배너를 추가하실 경우에는 배너코드파일을 원하시는 위치에 include 시켜주시면 되겠습니다.</td>
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
								</table>
							</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%">
							<tr>
								<td height="45">
									<a href="banner_add.php?code=<?=$_GET[code]?>" class='oolimbtn-botton1'>등록</a>
								</td>
								<td height="45" style='text-align:right'>
									<select size="1" name="code" onchange="select_code(this.value)">
									<option value="">베너코드전체 목록</option>
									<?for($i=1;$i<=9;$i++){
										$cnt = $db->cnt("cs_banner", "where status='banner_code$i'");
									?>
										<option value="banner_code<?=$i?>" <?if($_GET[code]=="banner_code".$i){?>selected<?}?>>banner_code<?=$i?><?if($cnt){?>[<?=$cnt?>]<?}?></option>
									<?}?>
									</select>
								</td>
							</t>
						</table>
					</td>
				</tr>
			</table>
			<table width="100%" class="table_all">
				<tr height='35'>
					<td bgcolor="E4E7EF" class='contenM tabletd_all'>
						베너명
					</td>
					<td bgcolor="E4E7EF" class='contenM tabletd_all'>
						출력타입
					</td>
					<td bgcolor="E4E7EF" class='contenM tabletd_all'>
						베너위치
					</td>
					<td bgcolor="E4E7EF" class='contenM tabletd_all'>
						이미지
					</td>
					<td bgcolor="E4E7EF" class='contenM tabletd_all'>
						관리
					</td>
				</tr>
				<?
					if($_GET[code]) $query = " and status='$_GET[code]'";
					$list_check = $totalCnt	= $db->cnt("cs_banner", "where 1 $query" );
					$result	= $db->select( "cs_banner", "where 1 $query order by status asc" );
					while( $row = mysqli_fetch_object($result)) {
					?>
				<tr>
					<td width="15%" height="35" class='tabletd_all tabletd_Lmall'>
						<?=$row->title;?>
					</td>
					<td height="35" class='tabletd_all tabletd_Lmall'>
						<? if( $row->type==1 ) { echo('HTML');} else if( $row->type==2 ) { echo('IMAGES');}?>
					</td>
					<td width="15%" height="35" class='tabletd_all tabletd_Lmall'>
						<?=$row->status?>
					</td>
					<td height="35" class='tabletd_all tabletd_Lmall'>
						<?if( $row->type==2 ) {?><img src="../../data/designImages/<?=$row->banner_images;?>" class='resize-banner'><?}?>
					</td>
					<td width="10%" height="35" class='tabletd_all tabletd_Lmall'>
						<a href="javascript:bannerEdit(<?=$row->idx;?>)" class="menusmall_btn3">수정</a><a href="javascript:bannerDel(<?=$row->idx;?>)" class="menusmall_btn4">삭제</a>
					</td>
				</tr>
				<?
					$totalCnt--;
				}
				?>
				
				<? if( !$list_check ) {?>
				<tr align="center">
					<td height="100" colspan="7" align="center" bgcolor="white">
						 등록된 베너 목록이 없습니다.
					</td>
				</tr>
				<?}?>
			</table>
		</td>
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

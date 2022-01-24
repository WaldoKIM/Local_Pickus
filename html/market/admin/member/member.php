<?
include('../header.php');
include($ROOT_DIR."/lib/page_class.php");
//$_GET=&$HTTP_GET_VARS; //$_GET=&$HTTP_GET_VARS;
$user_result = $db->select( "cs_user_list", " order by idx asc"); 
while( $user_row = @mysqli_fetch_object($user_result) ) { 
	$user_list .= "<option value='$user_row->idx'>$user_row->name</option>";
}

// 회원레벨 수정(level) 변수
if($_GET[level] && $_GET[hidden_level_idx]) { $db->update("cs_member", "level='$_GET[level]' where idx='$_GET[hidden_level_idx]'");}
$mv_data	= $_GET[mem_data];
$mem_data	= $tools->decode( $_GET[mem_data] );
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $mem_data[idx]; }
if($_GET[listNo] )					{ $listNo = $_GET[listNo]; }									else { $listNo = $mem_data[listNo]; }
if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $mem_data[startPage]; }
if($_GET[search_item] )		{ $search_item = $_GET[search_item]; }			else { $search_item	= $mem_data[search_item]; }
if($_GET[search_order] )	{ $search_order = $_GET[search_order]; }		else { $search_order	= $mem_data[search_order]; }
if($_GET[order_chk] )			{ $order_chk = $_GET[order_chk]; }					else { $order_chk	= $mem_data[order_chk]; }
if($_GET[order_list] )			{ $order_list = $_GET[order_list]; }					else { $order_list	= $mem_data[order_list]; }
if($_GET[search_01] )			{ $search_01 = $_GET[search_01]; }					else { $search_01	= $mem_data[search_01]; }
if($_GET[search_02] )			{ $search_02 = $_GET[search_02]; }					else { $search_02	= $mem_data[search_02]; }
if($_GET[search_03] )			{ $search_03 = $_GET[search_03]; }					else { $search_03	= $mem_data[search_03]; }

$user_search_view = str_replace("value='$search_01'", "value='$search_01' selected", $user_list);
?>
<script language="JavaScript">
<!--
// 검색기능
function search(){
	var form=document.mem_form;
	if(form.search_item.value < 4 && form.search_order.value=="")	{
		alert("검색할 내용을 입력해 주십시오.");
		form.search_order.focus();
	} else {
		form.submit();
	}
}

// 통합 정렬 검색
function orderSearch() {
	var form=document.form_search_total;
	if(form.order_chk.value=="0")	{
		alert("통합검색의 옵션을 선택해주세요.");
	} else if(form.order_chk.value=="1" && form.order_list.value=="0")	{
		alert("정렬방식을 선택해주세요.");
	} else if(form.order_chk.value=="2" && form.search_01.value=="0")	{
		alert("회원등급을 선택해주세요.");
	} else if(form.order_chk.value=="4" && form.search_03.value=="0")	{
		alert("지역을 선택해주세요.");
	} else {
		form.submit();
	}
}

// 회원레벨수정
function levelChange(form_data){
	form_data.submit();
}

// 회원정보 수정
function memView( mv_data ) {
	location.href='member_view.php?mem_data='+mv_data;
}

// 회원정보 삭제
function memDel( mv_data ) {
    var choose = confirm( '영구히 삭제 하시겠습니까?');
	if(choose) {	location.href='member_del_ok.php?mem_data='+mv_data; }
	else { return; }
}

// 포인트 설정창 오픈
function pointWinOpen(data) {
	window.open("point.php?userid="+data,"","scrollbars=yes, width=418, height=300");
}

// 회원에게 메일 보내기
function userSendmailWinOpen(data) {
	window.open("user_sendmail.php?user_mail="+data,"","scrollbars=no, width=484, height=500");
}

// 검색부분
function showSearch(){
	var form=document.form_search_total;
	if(form.order_chk.value== 1) {
		form.order_list.style.display="";
		form.search_01.style.display="none";
		form.search_02.style.display="none";
		form.search_03.style.display="none";
	} else if(form.order_chk.value ==2) {
		form.order_list.style.display="none";
		form.search_01.style.display="";
		form.search_02.style.display="none";
		form.search_03.style.display="none";
	} else if(form.order_chk.value ==3) {
		form.order_list.style.display="none";
		form.search_01.style.display="none";
		form.search_02.style.display="";
		form.search_03.style.display="none";
	} else if(form.order_chk.value ==4) {
		form.order_list.style.display="none";
		form.search_01.style.display="none";
		form.search_02.style.display="none";
		form.search_03.style.display="";
	} else {
		form.order_list.style.display="none";
		form.search_01.style.display="none";
		form.search_02.style.display="none";
		form.search_03.style.display="none";
	}
}
//-->
</script>
<?
$listScale			=	15; 		// 리스트갯수
$pageScale		=	15;		// 페이지 갯수
if( !$startPage ) { $startPage = 0; }		// 스타트 페이지
$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
if( $search_item == 1 ) {
	$totalList	= $db->cnt( "cs_member", "where userid like '$search_order%'" );
	$result		= $db->select( "cs_member", "where userid like '$search_order%' order by idx desc LIMIT $startPage, $listScale" );
} else if( $search_item == 2 ) {
	$totalList	= $db->cnt( "cs_member", "where name like '$search_order%'" );
	$result		= $db->select( "cs_member", "where name like '$search_order%' order by idx desc LIMIT $startPage, $listScale" );
} else if( $search_item == 3 ) {
	$totalList	= $db->cnt( "cs_member", "where email like '$search_order%'" );
	$result		= $db->select( "cs_member", "where email like '$search_order%' order by idx desc LIMIT $startPage, $listScale" );
} else if( $order_chk == 2 ) {
	$totalList	= $db->cnt( "cs_member", "where level =$search_01" );
	$result		= $db->select( "cs_member", "where level =$search_01 order by idx desc LIMIT $startPage, $listScale" );
} else if( $order_chk == 3 ) {
	if(!$search_02) { $search_02 =0;}
	$totalList	= $db->cnt( "cs_member", "where mailing=$search_02" );
	$result		= $db->select( "cs_member", "where mailing=$search_02 order by idx desc LIMIT $startPage, $listScale" );
} else if( $order_chk == 4 ) {
	$totalList	= $db->cnt( "cs_member", "where add1 like '%$search_03%'" );
	$result		= $db->select( "cs_member", "where add1 like '%$search_03%' order by idx desc LIMIT $startPage, $listScale" );
} else { 
	// 정렬방식 1:이름, 2:아이디, 3:가입일, 4:포인트, 5:구매금액, 6:구매횟수
	if($order_list ==1) {
		$totalList	= $db->cnt( "cs_member", "" );
		$result		= $db->select( "cs_member", "order by name asc LIMIT $startPage, $listScale" );
	} else if($order_list==2) {
		$totalList	= $db->cnt( "cs_member", "" );
		$result		= $db->select( "cs_member", "order by userid asc LIMIT $startPage, $listScale" );
	} else if($order_list==3) {
		$totalList	= $db->cnt( "cs_member", "" );
		$result		= $db->select( "cs_member", "order by register desc LIMIT $startPage, $listScale" );
	} else {
		$totalList	= $db->cnt( "cs_member", "" );
		$result		= $db->select( "cs_member", "order by idx desc LIMIT $startPage, $listScale" );
	}
}
?>
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
										<td height="150" align="center" valign="top" bgcolor="#FFFFFF">

										<table width="100%">
												<tr>
												<td>
													<table width="100%">
														<tr>
															<td height="25">
															<table>
																<tr>
																	<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">회원목록</td>
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
																						<td height="20">
																							<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
																						</td>
																					</tr>
																					<tr>
																						<td>현재 등록된 회원들의 목록이 출력됩니다.<br>우측의 상세버튼을 누르시면 해당 
																					회원의 상세 정보를 보실 수 있습니다.<br>하단의 엑셀파일로 저장버튼을 누르시면 
																					회원리스트를 바로 엑셀파일로 저장됩니다.</p>
																					<p><b>포인트관리</b> : 관리자가 임의로 특정회원에게 포인트를 추가, 삭제할 수 
																					있습니다.</td>
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
											<table width="100%">
											<form name="form_search_total" method="get" action="<?=$_SERVER[PHP_SELF];?>?mem_data=<?=$mem_data;?>">
												<tr> 
													<td height="35"></td>  
													<td height="35" align="right">
													전체 회원 : <font color="#FF0000"><?=number_format($totalList);?></font> 명&nbsp;&nbsp;
													<select name="order_chk" class="input" onChange="javascript:showSearch();">
														<option value="0" <? if($order_chk == 0) echo('selected');?>>통합검색</option>
														<option value="1" <? if($order_chk == 1) echo('selected');?>>정렬방식</option>
														<option value="2" <? if($order_chk == 2) echo('selected');?>>회원등급</option>
														<option value="3" <? if($order_chk == 3) echo('selected');?>>메일링</option>
													</select><select name="order_list" class="input" style="display:none" >
														<option value="0" <? if($order_list == 0) echo('selected');?>>정렬방식</option>
														<option value="1" <? if($order_list == 1) echo('selected');?>>이름</option>
														<option value="2" <? if($order_list == 2) echo('selected');?>>아이디</option>
														<option value="3" <? if($order_list == 3) echo('selected');?>>가입일</option>
													</select><select name="search_01" class="input" style="display:none" >
														<option value="0" <? if($search_01 == 0) echo('selected');?>>회원등급</option>
														<?=$user_search_view?>
													</select><select name="search_02" class="input" style="display:none" >
														<option value="0" <? if($search_02 == 0) echo('selected');?>>메일거부</option>
														<option value="1" <? if($search_02 == 1) echo('selected');?>>메일수신</option>
													</select><a href="javascript:orderSearch();" class='search_bbs'>검색</td>
												</tr>
											</form>
											</table>
											<table width="100%" class="table_all">
												<tr> 
													<td height="35" bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>No</td>
													<td bgcolor="E4E7EF" class='contenM tabletd_all'>아이디</td>
													<td height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>이 름</td>
													<td height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>등급</td>
													<td height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>전화번호</td>
													<td height="25" bgcolor="E4E7EF" class='contenM tabletd_all noneoolim'>수익금</td>
													<td height="25" bgcolor="E4E7EF" class='contenM tabletd_all noneoolim'>포인트</td>
													<td height="25" bgcolor="E4E7EF" class='contenM tabletd_all noneoolimmoL'>가입일자</td>
													<td height="25" bgcolor="E4E7EF" class='contenM tabletd_all noneoolim'>접속수</td>
													<td height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>구매수</td>
													<td height="25" bgcolor="E4E7EF" class='contenM tabletd_all'>관리</td>
												</tr>
												<?
												$form_name=0; // 폼리스트 변수
												if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }		// 페이지넘버
												while( $row = mysqli_fetch_object($result)) {
													$form_name++; // 폼네임변경 숫자증가
													$buy_goods_cnt = $db->cnt("cs_trade", "where order_userid='$row->userid' and trade_stat=4");
													$mem_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&order_chk=".$order_chk."&order_list=".$order_list."&search_01=".$search_01."&search_02=".$search_02."&search_03=".$search_03);
													$user_list_view = str_replace("value='$row->level'", "value='$row->level' selected", $user_list);
												?>
												<form name="form_<?=$form_name?>" method="get" action="<?=$_SERVER[PHP_SELF];?>?mem_data=<?=$mem_data;?>">
												<input type="hidden" name="hidden_level_idx" value="<?=$row->idx;?>">
												<tr align="center" bgColor="white"> 
													<td class='tabletd_all tabletd_Lmall noneoolimmoL'><?=$listNo;?></td>
													<td class='tabletd_all tabletd_Lmall'><?=$row->userid;?></td>
													<td class='tabletd_all tabletd_Lmall'><a href="javascript:userSendmailWinOpen('<?=$row->email;?>');"><?=$row->name;?></a></td>
													<td class='tabletd_all tabletd_Lmall'>
														<select name="level" onChange="javascript:levelChange(document.form_<?=$form_name?>);">
															<?=$user_list_view?>
														</select>
													</td>
													<td class='tabletd_all tabletd_Lmall'><?=$row->phone1;?><?=$row->tel2;?><?=$row->tel3;?></td>
													<td class='tabletd_all tabletd_Lmall noneoolim'><a href="#" class='modal itemtable_default_bt2' data-modal-height="400" data-modal-width="618" data-modal-iframe="../member/cash.php?userid=<?=$row->userid;?>" data-modal-title="수익금관리">수익금관리</a></td>													
													<td class='tabletd_all tabletd_Lmall noneoolim'><a href="#" class='modal itemtable_default_bt3' data-modal-height="400" data-modal-width="618" data-modal-iframe="../member/point.php?userid=<?=$row->userid;?>" data-modal-title="포인트관리">포인트관리</a></td>
													<td class='tabletd_all tabletd_Lmall noneoolimmoL'><?=$tools->strDateCut($row->register,1);?></td>
													<td class='tabletd_all tabletd_Lmall noneoolim'><?=number_format($row->connect);?></td>
													<td class='tabletd_all tabletd_Lmall'><?=number_format($buy_goods_cnt);?></td>
													<td width="85" class='tabletd_all tabletd_Lmall'><a href="javascript:memView('<?=$mem_data;?>');" class="menusmall_btn3">보기</a><a href="javascript:memDel('<?=$mem_data;?>');" class="menusmall_btn4">삭제</a></td>
												</tr>
												</form>
												<?
													$listNo--;	
												}
												?>
												
												<? if(!$totalList) {?>
												<tr> 
													<td height="100" colspan="11" class='tabletd_all tabletd_Lmall' style='text-align:center'> 가입한 회원이 없습니다.</td>
												</tr>
												<?}?>
											</table>

											<table width="100%">
												<tr> 
													<td height="85" style='text-align:center;'><? $page->member( $totalPage, $totalList, $listScale, $pageScale, $startPage, "<img src='../images/prev.gif' border='0'>", "<img src='../images/next.gif' border='0'>", $search_item, $search_order, $order_chk, $order_list, $search_01, $search_02, $search_03 );?></td>
												</tr>
											</table>
											
											<table width="100%">
												<form action="<?=$_SERVER[PHP_SELF];?>" method="get" name="mem_form">
												<tr> 
													<td height="25">
														<select name="search_item" class="input">
															<option value="1">아이디</option>
															<option value="2">이 름</option>
															<option value="3">메 일</option>
														</select><input name="search_order" type="text" class="formText"> <a href="javascript:search();" class='search_bbs'>검색</a>
													</td>
													<td height="25" align="right">
													<a href="member_download.php" class='search_bbs1 noneoolim'>액셀파일 다운로드 (*.CSV)</a>
													</td>
												</tr>
												</form>
											</table><br>
										</td>
									</tr>
								</table>
								<script language="JavaScript">
								<!--
								showSearch();
								//-->
								</script>
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



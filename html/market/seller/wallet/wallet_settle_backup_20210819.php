<?
include('../header.php');
include($ROOT_DIR."/lib/page_class.php");

// 거래 정보 수정
$mv_data	= $_GET[wallet_data];

if($_GET[trade_data]){
	$wallet_data = $tools->decode( $_GET[trade_data] );
}else{
	$wallet_data = $tools->decode( $_GET[wallet_data] );
}

if($_GET[idx] )						{	$idx = $_GET[idx];}else {	$idx = $wallet_data[idx];}
if($_GET[trade_stat] )			{	$trade_stat = $_GET[trade_stat];}else {	$trade_stat = $wallet_data[trade_stat];}
if($_GET[listNo] )					{	$listNo = $_GET[listNo];}else {	$listNo = $wallet_data[listNo];}
if($_GET[startPage] )			{	$startPage = $_GET[startPage];}else {	$startPage	= $wallet_data[startPage];}

if($_GET[search_mem_item] )		{	$search_mem_item = $_GET[search_mem_item];}else {	$search_mem_item	= $wallet_data[search_mem_item];}
if($_GET[search_trade_item] )	{	$search_trade_item = $_GET[search_trade_item];}else {	$search_trade_item	= $wallet_data[search_trade_item];}
if($_GET[search_order] )	{	$search_order = $_GET[search_order];}else {	$search_order	= $wallet_data[search_order];}

if($_GET[search_day] )	 	{	$search_day = $_GET[search_day];}else {	$search_day	= $wallet_data[search_day];}
if($_GET[search_day_str] )	 {	$search_day_str = $_GET[search_day_str];}else {	$search_day_str	= $wallet_data[search_day_str];}

// 상세정보를 저장
if($_GET[search_day] == 5 &&  $_GET[start_year] && $_GET[start_mon] && $_GET[start_day] && $_GET[end_year] && $_GET[end_mon] && $_GET[end_day] ) {
	$search_day_str = $_GET[start_year]."+".$_GET[start_mon]."+".$_GET[start_day]."+".$_GET[end_year]."+".$_GET[end_mon]."+".$_GET[end_day];
	$search_day_array = explode("+", $search_day_str );
}

//결제정보
$pginfo = $db->object("cs_pgsetup","");
$year_max= $db->row("cs_wallet_log", "", "max(left(register, 4))");
$year_min= $db->row("cs_wallet_log", "", "min(left(register, 4))");
if(!$year_max) $year_max = date("Y");
if(!$year_min) $year_min = date("Y");
?>

<script language="JavaScript">
<!--
// 검색기능
function search(){
	var form=document.deposit_form;
	form.submit();
}

// 거래상태 변경
function confirmChange(form_data){
	if(form_data.confirm_stat.value==1) {
		var choose = confirm( '승인 하시겠습니까?');
		if(choose) {
			form_data.submit();
		}
	}
	else if(form_data.confirm_stat.value==2) {
		var choose = confirm( '승인을 취소 하시겠습니까?');
		if(choose) {
			form_data.submit();
		}
	}
}

	//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/wallet_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">

		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">출금 신청 내역
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

					<!--콘텐츠출력-->
					<table width="100%">
						<tr> 
							<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
							<table width="100%">
									<tr>
									<td>
										<table width="100%">
											<tr>
												<td height="25">
												<table>
													<tr>
														<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">출금 신청 내역</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td height="20">
													<!--도움말-->
														<table width="100%" class='tipbox noneoolim'>
															<tr>
																<td>
																	<div>
																		### 판매 수수료 부과 안내 ###<br><br>

																		1. 서비스 판매 완료<br>
																		2. 수수료 15%를 제한 판매대금을 포인트로 적립<br>
																		3. 출금 요청<br>
																		4. 회원정보에 입력된 입금계좌로 정산(공휴일 제외, 평일 6~8시에 일괄 입금처리)<br>
																		<br>
																		* 회원정보수정 페이지에서 입금계좌 꼭 기입해주세요.<br>
																		<br>
																		판매 수수료 사용처<br>
																		-플랫폼 유지비(데이터, 호스팅 등)<br>
																		-광고/홍보 비<br>
																		-회원용 이벤트 진행 비용<br>
																		-기타 홈페이지 관련 비용<br>					
																	</div>																							
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
								
																			
								<!---------내용출력----------->
								<table width="100%" border="0" align="center">
									<tr>
										<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
										
											<table width="100%" class="table_all">
												<form action="<?=$_SERVER[PHP_SELF];?>" method="get" name="deposit_form">
												<input type="hidden" name="trade_stat" value="<?=$trade_stat;?>">
												<tr bgColor="white"> 
													<td width="80" height="25" align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>검색조건</td>
													<td colspan="2" class='tabletd_all'>
														<table>
															<tr>
																<td class='sensbody'>

																	<div id="customertable_divcont">
																		<div id="customertable_divLeft">
																			<div class="customertable_divLeft">
																				<span>
																					<input type="radio" name="search_day" value="1" <? if($search_day == 1 || empty($search_day)) { echo('checked');}?>>오늘 <input type="radio" name="search_day" value="2" <? if($search_day == 2) { echo('checked');}?>>최근1주간 <input type="radio" name="search_day" value="3" <? if($search_day == 3) { echo('checked');}?>>최근한달간 <input type="radio" name="search_day" value="4" <? if($search_day == 4) { echo('checked');}?>>최근1년간 <input type="radio" name="search_day" value="5" <? if($search_day == 5) { echo('checked');}?>>상세검색
																				</span>
																				<span style="padding-left:40px;">
																					승인 상태
																					<select name="trade_stat" class="input">
																						<option value="">선택</option>
																						<option value="2" <? if($trade_stat == "2") echo('selected');?>>대기</option>
																						<option value="1" <? if($trade_stat == "1") echo('selected');?>>승인</option>
																					</select>
																				</span>
																			</div>											
																		</div> 
																		<div id="customertable_divcenter_1" style="padding:5px;">

																		</div>										
																	</div>								
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr bgColor="white"> 
													<td align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>기간 지정</td>
													<td  class='tabletd_all' style='padding:5px'>

														<div id="customertable_divcont">
															<div id="customertable_divLeft">
																<div class="customertable_divLeft">


																	<div id="customertable_divcont">
																		<div id="customertable_divLeft">
																			<div class="customertable_divLeft">
																				<select name="start_year" class="input">
																				<option value="0">선택</option>
																				<? for($year_go=$year_min[0]; $year_go<=$year_max[0]; $year_go++){?>
																				<option value="<?=$year_go?>" <? if($_GET[start_year] == $year_go) echo('selected');?>><?=$year_go?></option>
																				<?}?>
																				</select>
																				년
																				<select name="start_mon" class="input">
																				<option value="0">선택</option>
																				<?for($i=1;$i<13;$i++){if(strlen($i)==1)$i="0".$i; $today_mon=date("m");?>
																				<option value="<?=$i?>" <?if($i==$search_day_array[1]) echo("selected");?>> <?=$i?> </option>
																				<?}?>
																				</select>
																				월
																				<select name="start_day" class="input">
																				<option value="0">선택</option>
																				<?for($i=1;$i<32;$i++){if(strlen($i)==1)$i="0".$i; $today_day=date("d");?>
																				<option value="<?=$i?>" <?if($i==$search_day_array[2]) echo("selected");?>> <?=$i?> </option>
																				<?}?>
																				</select>
																				일 부터
																			</div> 
																		</div> 

																		<div id="customertable_divcenter_1">
																			<div class="customertable_divcenter_1">
																				<select name="end_year" class="input">
																				<option value="0">선택</option>
																				<? for($year_go=$year_min[0]; $year_go<=$year_max[0]; $year_go++){?>
																				<option value="<?=$year_go?>" <? if($_GET[end_year] == $year_go) echo('selected');?>><?=$year_go?></option>
																				<?}?>
																				</select>
																				년
																				<select name="end_mon" class="input">
																				<option value="0">선택</option>
																				<?for($i=1;$i<13;$i++){if(strlen($i)==1)$i="0".$i; $today_mon=date("m");?>
																				<option value="<?=$i?>" <?if($i==$search_day_array[4]) echo("selected");?>> <?=$i?> </option>
																				<?}?>
																				</select>
																				월
																				<select name="end_day" class="input">
																				<option value="0">선택</option>
																				<?for($i=1;$i<32;$i++){if(strlen($i)==1)$i="0".$i; $today_day=date("d");?>
																				<option value="<?=$i?>" <?if($i==$search_day_array[5]) echo("selected");?>> <?=$i?> </option>
																				<?}?>
																				</select>
																				일 까지
																			</div>
																		</div>
																	</div> 
																			
																</div> 
															</div> 

															<div id="customertable_divcenter_1">
																<div class="customertable_divcenter_1bbs">
																	<?$csv_data = $tools->encode("trade_stat=".$trade_stat."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&search_trade_item=".$search_trade_item."&search_order=".$search_order."&search_day=".$search_day."&search_day_str=".$search_day_str);?>
																	<a href="javascript:search();" class='itemtable_default_bt1'>검색</a>
																</div>
															</div>
														</div> 


													</td>
												</tr>
												</form>
											</table>

											<table width="100%">
												<tr>
													<td height='20px'></td>
												</tr>
											</table>

											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF"> 
													<td class='contenM tabletd_all noneoolimmoL'>No</td>
													<td class='contenM tabletd_all'>거래번호</td>
													<td class='contenM tabletd_all'>요청일</td>
													<td class='contenM tabletd_all'>출금액</td>
													<td height='40' class='contenM tabletd_all'>은행</td>										
													<td class='contenM tabletd_all'>계좌번호</td>
													<td class='contenM tabletd_all'>예금주</td>
													<td class='contenM tabletd_all'>수정일</td>
													<td class='contenM tabletd_all'>상태</td>
												</tr>
												<?
												$table				= "cs_wallet_log";
												$listScale			=	20; 		// 리스트갯수
												$pageScale		=	10;		// 페이지 갯수
												if( !$startPage ) {
													$startPage = 0;
												}
												// 스타트 페이지
												$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지


												// 상태 검색
												if(empty($trade_stat)) {
													$trade_stat_sql="and userid='$_SESSION[USERID]'  and userid='$_SESSION[USERID]'  ";
												}
												else if($trade_stat==1) {
													$trade_stat_noand_sql="where confirm=1  and userid='$_SESSION[USERID]' ";
													$trade_stat_sql="and confirm=1  and userid='$_SESSION[USERID]' ";
												}
												else if($trade_stat==2) {
													$trade_stat_noand_sql="where confirm = ''  and userid='$_SESSION[USERID]' ";
													$trade_stat_sql="and confirm = ''  and userid='$_SESSION[USERID]' ";
												}else{
													$trade_stat_sql="where userid='$_SESSION[USERID]' ";
												}
												

												// 날자 검색
												if($search_day==1) {
													// 오늘 주문검색
													$register_sql = "where TO_DAYS(register)=TO_DAYS(NOW()) $trade_stat_sql";
												}
												else if($search_day==2) {
													// 최근 일주일 주문검색
													$register_sql = "where TO_DAYS(NOW())-TO_DAYS(register)<=7 $trade_stat_sql";
												}
												else if($search_day==3) {
													// 최근 한달 주문검색
													$register_sql = "where TO_DAYS(NOW())-TO_DAYS(register)<=30 $trade_stat_sql";
												}
												else if($search_day==4) {
													// 최근 1년 주문검색
													$register_sql = "where TO_DAYS(NOW())-TO_DAYS(register)<=365 $trade_stat_sql";
												}
												else if($search_day==5) {
													// 상세 주문검색
													$register_sql = "where DATE_FORMAT(register,'%Y-%m-%d')>='$search_day_array[0]-$search_day_array[1]-$search_day_array[2]' and DATE_FORMAT(register,'%Y-%m-%d')<='$search_day_array[3]-$search_day_array[4]-$search_day_array[5]' $trade_stat_sql";
												}
												else {
													// 주문검색
													$register_sql = "where userid='$_SESSION[USERID]'";
												}			

												if(!$register_sql){
													$register_sql = $trade_stat_sql;
												}
												$totalList	= $db->cnt( $table, "$register_sql " );
												$result		= $db->select( $table, "$register_sql order by idx desc LIMIT $startPage, $listScale" );

												
												//echo $register_sql;
												
												$form_name=0; // 폼리스트 변수
												if( $startPage ) {
													$listNo = $totalList - $startPage;
												}
												else {
													$listNo = $totalList;
												}
												// 페이지넘버
												while( $row = mysqli_fetch_object($result)) {
													$form_name++; // 폼네임변경 숫자증가
													$wallet_data = $tools->encode("idx=".$row->idx."&trade_stat=".$trade_stat."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&search_trade_item=".$search_trade_item."&search_order=".$search_order."&search_day=".$search_day."&search_day_str=".$search_day_str);
													$member_stat = $db->object("cs_member","where userid='$row->order_userid'");
													$use_price=number_format($row->use_price);

													
												?>
												<form name="form_<?=$form_name?>" method="post" action="deposit_ok.php?wallet_data=<?=$wallet_data;?>">
												<input type="hidden" name="hidden_deposit_idx" value="<?=$row->idx;?>">
												<tr id='calendar_list_tableTD_on'>
													<td class='sensO mmenu1 tabletd_all noneoolimmoL'><?=$listNo;?></td>
													<td class='sensO mmenu1 tabletd_all'><?=$row->code;?></td>
													<td class='sensO mmenu1 tabletd_all'><?=$tools->strDateCut($row->register,1);?></td>
													<td class='sensO mmenu1 tabletd_all'><?=number_format($row->use_point)?></td>
													<td class='sensO mmenu1 tabletd_all'<?if($row->bank_type < 5){?>style="color:red"<?}?>><?=$row->bank;?></td>
													<td class='sensO mmenu1 tabletd_all'><?=$row->account_num;?></td>
													<td class='sensO mmenu1 tabletd_all'><?=$row->account_name;?></td>
													<td class='sensO mmenu1 tabletd_all'><?=$tools->strDateCut($row->confirm_day,1);?></td>										
													<td width="95" class='sensO mmenu1 tabletd_all'>
													<?if($row->invoice_num || $row->bank=="관리자 등록"){?>
														승인
													<?}else{?>
															<?if($row->confirm){?>승인<?}else{?>대기<?}?>
													<?}?>
													</td>
												</tr>
												</form>
												<?
													$listNo--;
												}
												?>


												<? if( !$totalList ) { ?>
												<tr bgColor="white" align="center">
													<td height="100" colspan="14" style='text-align:center'>출금 요청 내역이 없습니다.</td>
												</tr>
												<?}?>
											</table>

											<table width="100%">
												<tr>
													<td style='text-align:center' height='60'><? $page->wallet( $trade_stat, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, "", "", "", "", $search_item_chk, $search_mem_item, $search_trade_item, $search_order, $search_day, $search_day_str, $search_item_unit) ;?></td>
												</tr>
											</table>


										</td>
									</tr>
								</table>
								<!---------내용출력끝----------->
							</td>
						</tr>
					</table>
				</td>
			</tr>													
		</table>
	</article>
	
</div>



<? include('../footer.php'); ?>

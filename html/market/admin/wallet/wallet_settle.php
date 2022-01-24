<?
include('../header.php');
include($ROOT_DIR."/lib/page_class.php");

// 거래 정보 수정
$mv_data	= $_GET[wallet_data];

if($_GET[wallet_data]){
	$wallet_data = $tools->decode( $_GET[wallet_data] );
}

if($_GET[idx] )						{	$idx = $_GET[idx];}else {	$idx = $wallet_data[idx];}
if($_GET[trade_stat] )			{	$trade_stat = $_GET[trade_stat];}else {	$trade_stat = $wallet_data[trade_stat];}
if($_GET[listNo] )					{	$listNo = $_GET[listNo];}else {	$listNo = $wallet_data[listNo];}
if($_GET[startPage] )			{	$startPage = $_GET[startPage];}else {	$startPage	= $wallet_data[startPage];}

if($_GET[search_item_chk] )		{	$search_item_chk = $_GET[search_item_chk];}else {	$search_item_chk	= $wallet_data[search_item_chk];}
if($_GET[search_item_unit] )		{	$search_item_unit = $_GET[search_item_unit];}else {	$search_item_unit	= $wallet_data[search_item_unit];}
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
	var form=document.wallet_form;
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
<table width="100%">
<tr>
	<td height="15"></td>
</tr>
</table>

<table width="100%">
	<tr>
		<td width="180" valign="top" class='noneesens'>
			<table width="100%">
				<tr>
					<td>
						<?include('inc/wallet_menu_inc.php');?>
					</td>
				</tr>
			</table>
		</td>
		<td width="30" class='noneesens'></td>
		<td valign="top">
			<!--내용시작-->
			<table width="100%">
				<tr>
					<td>
						<table width="100%">
							<tr>
								<td height="630" valign="top" style="padding:10;">
									<table width="100%">
										<tr>
											<td height="20" class='sub_titleL'>
												<img src="../img/icon01.gif" align="absmiddle" border="0" hspace="5">출금 신청 내역
											</td>
										</tr>
										<tr>
											<td height="1" bgcolor="#666666">
											</td>
										</tr>
										<tr>
											<td height="25">
											</td>
										</tr>
										<tr>
											<td class="padding_5">
												<table width="100%">
													<tr>
														<td>
															<!---------내용출력----------->
															<table width="100%" border="0" align="center">
																<tr>
																	<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
																	
																		<table width="100%" class="table_all">
																			<form action="<?=$_SERVER[PHP_SELF];?>" method="get" name="wallet_form">
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
																											<input type="radio" name="search_day" value="1" <? if($search_day == 1 || empty($search_day)) { echo('checked');}?>>오늘주문 <input type="radio" name="search_day" value="2" <? if($search_day == 2) { echo('checked');}?>>최근1주간 <input type="radio" name="search_day" value="3" <? if($search_day == 3) { echo('checked');}?>>최근한달간 <input type="radio" name="search_day" value="4" <? if($search_day == 4) { echo('checked');}?>>최근1년간 <input type="radio" name="search_day" value="5" <? if($search_day == 5) { echo('checked');}?>>상세검색
																										</div> 
																									</div> 
																									<div id="customertable_divcenter_1" style="padding-left:40px;">
																										<div class="customertable_divcenter_1">																											
																											<select name="search_mem_item" class="input">
																											<option value="1" <? if($search_mem_item == 1) echo('selected');?>>아이디</option>
																											<option value="2" <? if($search_mem_item == 2) echo('selected');?>>이 름</option>
																											<option value="3" <? if($search_mem_item == 3) echo('selected');?>>거래번호</option>
																											</select><input name="search_order" type="text" size="15" value="<?=$search_order;?>" class='formText'>
																										</div>
																									</div>
																									<div id="customertable_divcenter_1" style="padding:5px;">
																										<div class="customertable_divcenter_1">
																											승인 상태
																											<select name="trade_stat" class="input">
																												<option value="">선택</option>
																												<option value="2" <? if($trade_stat == "2") echo('selected');?>>대기</option>
																												<option value="1" <? if($trade_stat == "1") echo('selected');?>>승인</option>
																											</select>
																										</div>
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
																				<td class='contenM tabletd_all noneesens'>No</td>
																				<td class='contenM tabletd_all'>거래번호</td>
																				<td class='contenM tabletd_all'>요청일</td>
																				<td class='contenM tabletd_all'>회원ID</td>
																				<td class='contenM tabletd_all'>회원이름</td>
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
																				$trade_stat_sql="";
																			}
																			else if($trade_stat==1) {
																				$trade_stat_noand_sql="where confirm=1 ";
																				$trade_stat_sql="and confirm=1 ";
																			}
																			else if($trade_stat==2) {
																				$trade_stat_noand_sql="where confirm = ''";
																				$trade_stat_sql="and confirm = ''";
																			}else{
																				$trade_stat_sql="";
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
																				$register_sql = $trade_stat_noand_sql;
																			}	

																			// 정보 검색
																			
																			if($search_mem_item ==1) {
																				$search_item_sql = "and userid like '%$search_order%'";
																			}else if($search_mem_item ==2) {
																				$search_item_sql = "and user_name like '%$search_order%'";
																			}else if($search_mem_item ==3) {
																				$search_item_sql = "and code = '$search_order'";
																			}																	
																																					

																			$totalList	= $db->cnt( $table, "$register_sql $search_item_sql " );
																			$result		= $db->select( $table, "$register_sql $search_item_sql order by idx desc LIMIT $startPage, $listScale" );


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
																				$wallet_data = $tools->encode("idx=".$row->idx."&trade_stat=".$trade_stat."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&search_item_chk=".$search_item."&search_mem_item=".$search_mem_item."&search_trade_item=".$search_trade_item."&search_order=".$search_order."&search_day=".$search_day."&search_day_str=".$search_day_str);
																				$member_stat = $db->object("cs_member","where userid='$row->order_userid'");
																				$use_point=number_format($row->use_point);

																				
																			?>
																			<form name="form_<?=$form_name?>" method="post" action="wallet_settle_ok.php?wallet_data=<?=$wallet_data;?>">
																			<input type="hidden" name="hidden_wallet_idx" value="<?=$row->idx;?>">
																			<tr id='calendar_list_tableTD_on'>
																				<td class='sensO mmenu1 tabletd_all noneesens'><?=$listNo;?></td>
																				<td class='sensO mmenu1 tabletd_all'><?=$row->code;?></td>
																				<td class='sensO mmenu1 tabletd_all'><?=$tools->strDateCut($row->register,1);?></td>
																				<td class='sensO mmenu1 tabletd_all'><?=$row->userid?></td>
																				<td class='sensO mmenu1 tabletd_all'><?=$row->user_name?></td>
																				<td class='sensO mmenu1 tabletd_all'><?=$use_point?></td>
																				<td class='sensO mmenu1 tabletd_all'<?if($row->bank_type < 5){?>style="color:red"<?}?>><?=$row->bank;?></td>
																				<td class='sensO mmenu1 tabletd_all'><?=$row->account_num;?></td>
																				<td class='sensO mmenu1 tabletd_all'><?=$row->account_name;?></td>
																				<td class='sensO mmenu1 tabletd_all'><?=$tools->strDateCut($row->confirm_day,1);?></td>										
																				<td width="95" class='sensO mmenu1 tabletd_all'>
																					<select name="confirm_stat" class="input" onChange="javascript:confirmChange(document.form_<?=$form_name?>);">
																						<option value="2" <? if( !$row->confirm ) { echo("selected");} ?>>대기</option>
																						<option value="1" <? if( $row->confirm ) { echo("selected");} ?>>승인</option>
																					</select>
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
													<tr>
														<td height="10">
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

			<!--내용 끝-->
		</td>
	</tr>
</table>
<? include('../footer.php');?>

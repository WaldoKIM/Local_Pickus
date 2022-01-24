<?
include('../header.php');
include($ROOT_DIR."/lib/page_class.php");
//$_GET=&$HTTP_GET_VARS; //$_POST=&$HTTP_POST_VARS;
//if($_POST[part_code]) { $part_row=$db->object("cs_part", "where part1_code='$_POST[part_code]' or part2_code='$_POST[part_code]' or part3_code='$_POST[part_code]'", "idx"); $_GET[part_idx]=$part_row->idx;} 

// 상품정보변경
if( $_GET[hidden_goods_idx]) { $db->update("cs_goods", "display='$_GET[display]', main_position='$_GET[main_position]', sub_position='$_GET[sub_position]' where idx='$_GET[hidden_goods_idx]'");}

//게시판에 필요한 값들
$MV_DATA	= $_GET[board_data];
$BOARD_DATA	= $tools->decode( $_GET[board_data] );
if($_GET[idx] )					{ $idx = $_GET[idx]; }					else { $idx = $BOARD_DATA[idx]; }
if($_GET[listNo] )				{ $listNo = $_GET[listNo]; }			else { $listNo = $BOARD_DATA[listNo]; }
if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }		else { $startPage	= $BOARD_DATA[startPage]; }
if($_GET[totalList] )			{ $totalList = $_GET[totalList]; }		else { $totalList	= $BOARD_DATA[totalList]; }

$MV_SEARCH_ITEM	= $_GET[search_items];
$SEARCH_ITEM	= $tools->decode( $_GET[search_items] );
if($_GET[part_idx] )			{ $part_idx = $_GET[part_idx]; }				else { $part_idx = $SEARCH_ITEM[part_idx]; }
if($_GET[search_item] )			{ $search_item = $_GET[search_item]; }			else { $search_item	= $SEARCH_ITEM[search_item]; }
if($_GET[search_order] )		{ $search_order = $_GET[search_order]; }		else { $search_order	= urldecode($SEARCH_ITEM[search_order]); }
if($_GET[part_code1] )			{ $part_code1 = $_GET[part_code1]; }			else { $part_code1 = $SEARCH_ITEM[part_code1]; }
if($_GET[part_code2] )			{ $part_code2 = $_GET[part_code2]; }			else { $part_code2 = $SEARCH_ITEM[part_code2]; }
if($_GET[part_code3] )			{ $part_code3 = $_GET[part_code3]; }			else { $part_code3 = $SEARCH_ITEM[part_code3]; }
if($_GET[search_name] )			{ $search_name = $_GET[search_name]; }			else { $search_name = $SEARCH_ITEM[search_name]; }
if($_GET[search_media] )		{ $search_media = $_GET[search_media]; }		else { $search_media = $SEARCH_ITEM[search_media]; }
if($_GET[search_code] )			{ $search_code = $_GET[search_code]; }			else { $search_code = $SEARCH_ITEM[search_code]; }
if($_GET[search_content] )		{ $search_content = $_GET[search_content]; }	else { $search_content = $SEARCH_ITEM[search_content]; }
if($_GET[search_keyword] )		{ $search_keyword = $_GET[search_keyword]; }	else { $search_keyword = $SEARCH_ITEM[search_keyword]; }
if($_GET[addsearch] )			{ $addsearch = $_GET[addsearch]; }				else { $addsearch = $SEARCH_ITEM[addsearch]; }
if($_GET[position_main] )			{ $position_main = $_GET[position_main]; }				else { $position_main = $SEARCH_ITEM[position_main]; }
if($_GET[position_sub] )			{ $position_sub = $_GET[position_sub]; }				else { $position_sub = $SEARCH_ITEM[position_sub]; }

$SEARCH_DATA = $tools->encode("part_idx=".$part_idx."&search_item=".$search_item."&search_order=".urlencode($search_order)."&part_code1=".$part_code1."&part_code2=".$part_code2."&part_code3=".$part_code3."&search_name=".$search_name."&search_media=".$search_media."&search_code=".$search_code."&search_content=".$search_content."&search_keyword=".$search_keyword."&addsearch=".$addsearch."&position_main=&position_sub=");
$SEARCH_DATA2 = $tools->encode("part_idx=".$part_idx."&search_item=".$search_item."&search_order=".urlencode($search_order)."&part_code1=".$part_code1."&part_code2=".$part_code2."&part_code3=".$part_code3."&search_name=".$search_name."&search_media=".$search_media."&search_code=".$search_code."&search_content=".$search_content."&search_keyword=".$search_keyword."&addsearch=".$addsearch."&position_main=".$position_main."&position_sub=");
$SEARCH_DATA3 = $tools->encode("part_idx=".$part_idx."&search_item=".$search_item."&search_order=".urlencode($search_order)."&part_code1=".$part_code1."&part_code2=".$part_code2."&part_code3=".$part_code3."&search_name=".$search_name."&search_media=".$search_media."&search_code=".$search_code."&search_content=".$search_content."&search_keyword=".$search_keyword."&addsearch=".$addsearch."&position_main=&position_sub=".$position_sub);

$iconRe		= $db->select("cs_icon_list", "order by idx asc" );
$arrPicon = array();
while( $iconRow = mysqli_fetch_object($iconRe) ) {
	$arrPicon[$iconRow->idx] = $iconRow->icon;
}
?>

<script language="javascript">
<!--
function sendit() {
	var form=document.goods_form;
	form.submit();
}

function part_value_auto(){
	var form=document.goods_form;
	if(form.addsearch.checked==true){
		form.part_code1.value = form.hidden_part_code1.value;
		form.part_code2.value = form.hidden_part_code2.value;
		form.part_code3.value = form.hidden_part_code3.value;
	}else{
		form.part_code1.value = "";
		form.part_code2.value = "";
		form.part_code3.value = "";
	}
}
// 상품이미지 갱신
function itemimgChange(form_data){
	form_data.method="post";
	form_data.action="dir.itemimg.php";
	form_data.target="dynamic";
	form_data.submit();
}

// 상품정보변경(display, position)
function goodsChange(form_data){
	form_data.display.value = form_data.display1.value;
    var choice = confirm( '상품정보변경을 하시겠습니까?');
	if(choice) {form_data.submit();}
}

// 상품정보변경(display, position) 모바일일때
function goodsChange2(form_data){
	form_data.display.value = form_data.display2.value;
    var choice = confirm( '상품정보변경을 하시겠습니까?');
	if(choice) {form_data.submit();}
}


// 카테고리 수정
function goodsEdit( mv_data ) {
    var choice = confirm( '상품를 수정 하시겠습니까?');
	if(choice) {	location.href='product_edit.php?search_items=<?=$SEARCH_DATA?>&board_data='+mv_data; }
	else { return; }
}

// 카테고리 삭제
function goodsDel( mv_data ) {
    var choice = confirm( '상품를 삭제 하시겠습니까?');
	if(choice) {	location.href='product_del_ok.php?search_items=<?=$SEARCH_DATA?>&board_data='+mv_data; }
	else { return; }
}


////  카테고리 선택 폼 설정 시작 //////////////////////////////////////////////////////////////////////////
// 배열 선언
depth1 = new Array(); // 리스트1 출력용
depth2 = new Array(); // 리스트2 출력용
depth3 = new Array(); // 리스트3 출력용

depth1_value = new Array(); // 리스트1 값
depth2_value = new Array(); // 리스트2 값
depth3_value = new Array(); // 리스트3 값

var depth1_size = 3;
var depth2_size = 3;
var depth3_size = 3;
var sep = "$$";
// 배열 초기화

i = 0;
// depth1 의 배열 초기화
<?
$part1_result = $db->select( "cs_part", "where part_index=1 order by part_ranking asc");
while( $part1_row = mysqli_fetch_object($part1_result) ) {
?>
	depth1[i] = "<?=$part1_row->part_name;?>";
	depth1_value[i] = "<?=$part1_row->part1_code;?>";
	
	j = 0;

	// depth2 의 배열 초기화
	<?
	$part2_result = $db->select( "cs_part", "where part1_code='$part1_row->part1_code' and part_index=2 order by part_ranking asc");
	while( $part2_row = mysqli_fetch_object($part2_result) ) 
	{
	?>
		if ( j == 0 )
		{
			depth2[i] = new Array(); 
			depth2_value[i] = new Array();
			depth3[i] = new Array();
			depth3_value[i] = new Array();
		}

		depth2[i][j] = "<?=$part2_row->part_name;?>" ;
		depth2_value[i][j] = "<?=$part2_row->part2_code;?>";
		
		k = 0;
		<?
		$part3_result = $db->select( "cs_part", "where part2_code='$part2_row->part2_code' and part1_code='$part1_row->part1_code' and part_index=3 order by part_ranking asc");
		while( $part3_row = mysqli_fetch_object($part3_result) ) 
		{
		?>
			if ( k == 0 )
			{
				depth3[i][j] = new Array();
				depth3_value[i][j] = new Array();
			}
			depth3[i][j][k] = '<?=$part3_row->part_name?>' ;
			depth3_value[i][j][k] = '<?=$part3_row->part3_code?>' ;
		k += 1;
	    <?}?>
	 j += 1;
	<?}?>	
i += 1;		
<? }?>

// 선택되었을때 다음 단계 카테고리 출력
function change(depth, index, target)
{

	f = document.goods_form;   // 선택된 Form;
	goods_form.search_keyword.value = '';
	goods_form.search_code.value = '';
	goods_form.addsearch.checked = false;
	goods_form.search_name.checked = false;
	if ( depth == 1 && index != -1)  // 대분류 선택 시
	{
		sp_value = f.select1[index].value;
		sp_value = sp_value.split(sep);
		sp_value2 = sp_value[1];
		
		for ( i = f.select2.length; i >= 0; i-- ) {
			f.select2[i] = null; 
		}
		goods_form.part_code1.value = depth1_value[sp_value2];
		goods_form.part_code2.value = '';
		goods_form.part_code3.value = '';
		if ( depth2[sp_value2] != null )
		{
	
			for ( i = 0 ; i <= depth2[sp_value2].length -1 ; i++ )
			{
				f.select2.options[i] = new Option(depth2[sp_value2][i],depth2_value[sp_value2][i] + sep + sp_value2 + sep + i );
				
			}
		}
		else
		{
//			alert("2차 카테고리는 없습니다.");
			goods_form.part_code1.value = depth1_value[sp_value2];
			//alert("카테고리 선택 완료");
			sendit();
		}


		// 카테고리 2를 초기화 되면 카테로기 3은 모두 삭제한다.
		for ( i = f.select3.length; i >= 0; i-- ) {
			f.select3[i] = null; 
		}
	}
	else if ( depth == 2 && index != -1 )   // 중분류 선택 시 
	{
		sp_value = f.select2[index].value;
		sp_value = sp_value.split(sep);
		sp_value2 = sp_value[1];
		sp_value3 = sp_value[2];
		
		
		for ( i = f.select3.length; i >= 0; i-- ) {
			f.select3[i] = null; 
		}
		goods_form.part_code2.value = depth2_value[sp_value2][sp_value3];
		goods_form.part_code3.value = '';
		if ( depth3[sp_value2][sp_value3] != null )
		{

			for ( i = 0 ; i <= depth3[sp_value2][sp_value3].length -1 ; i++ )
			{
				f.select3.options[i] = new Option(depth3[sp_value2][sp_value3][i],depth3_value[sp_value2][sp_value3][i]);
			}
		}
		else
		{
//			alert("3차 카테고리는 없습니다.");
			goods_form.part_code2.value = depth2_value[sp_value2][sp_value3];
			//alert("카테고리 선택 완료");
			sendit();
		}
	}
	else if ( depth == 3 && index != -1 )
	{
		goods_form.part_code3.value = f.select3[index].value;
		//alert("카테고리 선택 완료");
		sendit();
	}
}
////  카테고리 선택 폼 설정 종료 //////////////////////////////////////////////////////////////////////////

function product_search_go(){
	f  = document.goods_form;
	//if(!f.select1.value){
	//	alert('1차 카테고리를 선택하세요');
	//}
	sendit();
}

function check_item_number(){
	f  = document.goods_form;
	if(f.search_name.checked==true){
		goods_form.search_code.value = '';
	}
}

function jsView(d) {
	if(document.getElementById("faq"+d).style.display == "block") document.getElementById("faq"+d).style.display = "none"
	else  document.getElementById("faq"+d).style.display = "block"
}

function mainevent(value){
	if(value=="0") location.href="?search_items=<?=$SEARCH_DATA?>&position_main="; 
	else location.href="?search_items=<?=$SEARCH_DATA2?>&position_main="+value;
}

function subevent(value){
	if(value=="0") location.href="?search_items=<?=$SEARCH_DATA?>&position_sub=";
	else location.href="?search_items=<?=$SEARCH_DATA3?>&position_sub="+value;
}

//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/product_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table   width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">상품관리</td>
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
										<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
										<table width="100%" border="0">
												<tr>
												<td>
													<table  width="100%">
														<tr>
															<td height="25">
															<table>
																<tr>
																	<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">상품목록</td>
																</tr>
															</table>

															</td>
														</tr>
														<tr>
															<td>
																<!--도움말-->
																	<table width="100%" class='tipbox noneoolimmoL'>
																		<tr>
																			<td bgcolor="#E9F2F8">
																				<table width="100%">
																					<tr>
																						<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																					</tr>
																					<tr>
																						<td><font color="red">메인위치 우선순위</font>는 메인에 이벤트상품 위치 및 주메뉴 카테고리에 스페셜상품코너에 반영됩니다.</td>
																					</tr>
																					<tr>
																						<td><font color="red">서브위치</font>는 해당 상품 카테고리 내에서 신상품, 베스트상품으로 노출됩니다.</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>
																<!--//도움말-->

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
											<table width="100%" height="25" class="menu" style='border-collapse: collapse'>
												<form action="<?=$_SERVER[PHP_SELF];?>" method="get" name="goods_form">
												<input type="hidden" name="part_code1" value="<?if($addsearch){?><?=$part_code1;?><?}?>">
												<input type="hidden" name="part_code2" value="<?if($addsearch){?><?=$part_code2;?><?}?>">
												<input type="hidden" name="part_code3" value="<?if($addsearch){?><?=$part_code3;?><?}?>">
												<input type="hidden" name="hidden_part_code1" value="<?=$part_code1;?>">
												<input type="hidden" name="hidden_part_code2" value="<?=$part_code2;?>">
												<input type="hidden" name="hidden_part_code3" value="<?=$part_code3;?>">
												<tr> 
													<td>
															<div id="customertable_divcont">
																<div id="customertable_divLeft_view">
																	<div class="customertable_divLeft">
																		<table width="100%" class="table_all">
																			<tr> 
																				<td height="35" bgcolor="B9C1D3" class='contenM tabletd_all'>카테고리별 검색</td>
																			</tr>
																			<tr>
																				<td style='padding:5px;'>
																					<!--도움말-->
																						<table width="100%" class='tipbox noneoolimmoL'>
																							<tr>
																								<td bgcolor="#E9F2F8">
																									<table width="100%">
																										<tr>
																											<td height="20">
																												<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
																											</td>
																										</tr>
																										<tr>
																											<td class='sensbody'>카테고리를 선택하시면(1차 → 2차 → 3차)<br>아래와 같이 해당 카테고리에 등록된 상품 목록이 나오게 됩니다.</td>
																										</tr>
																									</table>
																								</td>
																							</tr>
																						</table>
																					<!--도움말--->
																					
																						<div class='oolimbox-wrapper oolimbox-grid3'>
																							<div class='oolimbox-col_3dan' style='text-align:center;'>
																								<span style='font-size:11pt;'>1차카테고리</span>

																								<select name="select1" size="7" class='itemSelect' style="width:98%;" onClick='change(1, this.form.select1.selectedIndex, this.form)'>
																									<script language = "javascript">
																									for ( i = 0 ; i <= depth1.length -1 ; i++ ){	
																										document.write ("<option value='"+ depth1_value[i] + sep + i + "'>" + depth1[i] + "</option>");	
																									}
																									</script>
																								</select>
																							</div>
																							<div class='oolimbox-col_3dan' style='text-align:center;'>
																								<span style='font-size:11pt;'>2차카테고리</span>

																								<select name="select2" size="7" class='itemSelect' style="width:98%;"  onclick='change(2, this.form.select2.selectedIndex, this.form)'>
																								</select>
																							</div>
																							<div class='oolimbox-col_3dan' style='text-align:center;'>
																								<span style='font-size:11pt;'>3차카테고리</span>

																								<select name="select3" size="7" class='itemSelect' style="width:98%;" onclick='change(3, this.form.select3.selectedIndex, this.form)'>
																								</select>
																							</div>
																						</div>
																				</td>
																			</tr>
																		</table>
																	</div> 
																</div> 
															<div id="customertable_divcenter_1_view">
																<div class="customertable_divcenter_1">
																		<table width="100%" class="table_all table_all_moA">
																			<tr> 
																				<td height="35" bgcolor="B9C1D3" class='contenM tabletd_all'>키워드 검색</td>
																			</tr>
																			<tr>
																				<td style='padding:5px;'>
																					<!--도움말-->
																						<table width="100%" class='tipbox noneoolimmoL'>
																							<tr>
																								<td bgcolor="#E9F2F8">
																									<table width="100%">
																										<tr>
																											<td height="20">
																												<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
																											</td>
																										</tr>
																										<tr>
																											<td class='sensbody'>카테고리 검색이후 해당 카테고리 내에서 키워드 검색을 이용을 하시려면 <br><font color="red">카테고리내 검색</font>을 선택하신 검색을 이용하시기 바랍니다.<br>
																											카테고리내 검색을 이용하지 않을 경우에는 전체 상품를 기준으로 검색됩니다.<br><font color="red">중지상품 검색</font>은 중지된 상품내에서만 검색됩니다.</td>
																										</tr>
																									</table>
																								</td>
																							</tr>
																						</table>
																					<!--도움말--->
																					<table>
																						<?if($part_code1 || $part_code2 || $part_code3){?>
																						<tr>
																							<td class='sensbody'>
																								<?  //카테고리 명을 표기 위한 쿼리들
																									if($part_code1){
																										$part_code1_row = $db->object("cs_part", "where part1_code='$part_code1' and part_index=1");						
																										$part_name.="1차 카테고리 : <font color='#FF0000'>".$part_code1_row->part_name."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
																									}
																									if($part_code2){
																										$part_code2_row = $db->object("cs_part", "where part2_code='$part_code2' and part_index=2");
																										$part_name.="2차 카테고리 : <font color='#FF0000'>".$part_code2_row->part_name."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
																									}
																									if($part_code3){
																										$part_code3_row = $db->object("cs_part", "where part3_code='$part_code3' and part_index=3");
																										$part_name.="3차 카테고리 : <font color='#FF0000'>".$part_code3_row->part_name."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
																									}
																								?>
																								<?=$part_name;?>
																							</td>
																						</tr>
																						<?}?>
																						<tr>
																							<td class='contenL sensbody' height='40'>
																							<input type="checkbox" value="1" name="addsearch" <?if($addsearch==1){?>checked<?}?> onclick="part_value_auto()"> 카테고리내 검색 <input type="checkbox" value="1" name="search_name" <?if($search_name==1){?>checked<?}?> onclick="check_item_number()"> 중지상품 검색
																							</td>
																						</tr>
																						<tr>
																							<td class='sensbody'>
																							<input type="text" name="search_code" class="formText" value='<?=$search_code?>' onclick="document.goods_form.search_name.checked=false"> <font color='000000'>수량검색</font>-입력한 수량과 같거나 이하일경우 검색되며 <font color="red">중지상품 및 무제한설정은 제외</font>됩니다.
																							</td>
																						</tr>
																						<tr>
																							<td>
																									<div id="itemtable_default1">
																										<div class="itemtable_default1">
																											<select name="search_item">
																												<option value="1" <?if($search_item == '1'){?>selected<?}?>>통합검색</option>
																												<option value="2" <?if($search_item == '2'){?>selected<?}?>>상품명</option>
																												<option value="3" <?if($search_item == '3'){?>selected<?}?>>상품코드</option>
																												<option value="4" <?if($search_item == '4'){?>selected<?}?>>제조회사</option>
																											</select><input type='text' name='search_keyword' value='<?=$search_keyword?>' class="formText juminsmall_size"><a href='javascript:' onClick="product_search_go()" class='item_default_bt1'>검색</a>
																										</div> 
																									</div> 
																																		

																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		</table>
																	</div>
																</div>
															</div> 
												</tr>
												</form>
											</table>
											<table>
												<tr>
													<td height='50'></td>
												</tr>
											</table>
												<?
												$table				= "cs_goods a inner join cs_part b on a.part_idx = b.idx";
												$listScale			=	15; 		// 리스트 수
												$pageScale		=	15;		// 페이지 수
												if( !$startPage ) { $startPage = 0; }		// 스타트 페이지
												$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
												
												if($addsearch==1 && $search_keyword){		//카테고리내에서 검색시
													//검색키워드 합치기.
													if($part_code1) $isWhere .= " and b.part1_code = '$part_code1'";
													if($part_code2) $isWhere .= " and b.part2_code = '$part_code2'";
													if($part_code3) $isWhere .= " and b.part3_code = '$part_code3'";
												}else if($addsearch=="" && $search_keyword){
													//카테고리 검색
												}else{
													//카테고리 검색
													if($part_code1) $isWhere .= " and b.part1_code = '$part_code1'";
													if($part_code2) $isWhere .= " and b.part2_code = '$part_code2'";
													if($part_code3) $isWhere .= " and b.part3_code = '$part_code3'";
												}


												 if($search_keyword){
													//조건절
													if($search_item == 2){
														$isWhere .= " and (a.name like '%$search_keyword%') ";
													}else if($search_item == 3){
														$isWhere .= " and (a.code like '%$search_keyword%') ";	
													}else if($search_item == 4){
														$isWhere .= " and (a.company like '%$search_keyword%') ";					
													}else{
														$isWhere .= " and (a.name like '%$search_keyword%' or a.code like '%$search_keyword%' or a.content like '%$search_keyword%' or a.company like '%$search_keyword%') ";
													}					
												}

												if($search_name) $isWhere .= " and (a.unlimit!=1 and a.number = 0) ";

												if($search_code && !$search_name) $isWhere .= " and (a.number <= $search_code and a.unlimit!=1 and a.number != 0) ";
												
												if($position_main) $isWhere .= " and a.main_position=$position_main";
												if($position_sub) $isWhere .= " and a.sub_position=$position_sub";

												$totalList	= $db->object( $table, "where 1 $isWhere and seller='$_SESSION[USERID]' ","count(b.idx ) t_cnt");				
												$totalList = $totalList->t_cnt;		
												$result		= $db->select( $table, "where 1 $isWhere and seller='$_SESSION[USERID]' order by part_idx desc, idx desc LIMIT $startPage, $listScale","a.*,b.part1_code,b.part2_code,part3_code" );
												?>
												<?/*
												<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF">
													<td height="35" class='contenM tabletd_all'>상품 위치별 검색</td>
												</tr>
												<tr>
													<td style='text-align:center' height='50'>
													
																<div class='oolimbox-wrapper'>
																	<div class='oolimbox-col_2dan-1'>
																		메인위치 : 
																		<select name="main_position" class="input" onChange="javascript:mainevent(this.value);">
																			<option value="0" <? if( $position_main == 0 ) { echo("selected");} ?>>선 택</option>
																			<?
																			$fresult		= $db->select("cs_part_fixed", "where event_code>0 order by event_code asc" );
																			while( $frow = mysqli_fetch_object($fresult) ) {
																			?>
																			<option value="<?=$frow->event_code?>" <? if( $position_main == $frow->event_code ) { echo("selected");} ?>><?=$frow->part_name?></option>
																			<?}?>
																		</select>
																	</div>
																	<div class='oolimbox-col_2dan-2'>
															
																		서브위치 : 
																		<select name="sub_position" class="input" onChange="javascript:subevent(this.value);">
																			<option value="0" <? if( $position_sub == 0 ) { echo("selected");} ?>>선 택</option>
																			<option value="1" <? if( $position_sub == 1 ) { echo("selected");} ?>>추천상품</option>
																			<option value="2" <? if( $position_sub == 2 ) { echo("selected");} ?>>베스트상품</option>
																		</select>
																	</div>
																</div>
																

													</td>
												</tr>
												</table>
												*/?>
												<table>
													<tr>
														<td height='50'></td>
													</tr>
												</table>
												<?
												$form_name=0; // 폼리스트 변수
												// 페이지넘버
												if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
												$partCheck = "";
												while( $row = mysqli_fetch_object($result)) {
														if(!$partCheck){
															$newPart=1;
															$partCheck = $row->part_idx;
														}else{
															if($partCheck!=$row->part_idx){
																$newPart=1;
																$partCheck = $row->part_idx;
															}else $newPart=0;
														}
														$form_name++; // 폼네임변경 숫자증가
														$board_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo);
														$ThumbEncode = $tools->encode("idx=".$row->idx."&table=cs_goods&img=images1&dire=goodsImages&w=70&h=70");
														//new IMG
														$new_img=""; $hit_img="";
														if($admin_stat->new_mark && $row->new_mark) { $new_img = $page->newImg( $row->register, $admin_stat->new_mark, $row->new_mark );}
														if($new_img) $new_img = str_replace("./images/", "../images/", $new_img);
														// hit IMG
														if($admin_stat->hit_mark && $row->hit_mark) { $hit_img = $page->hitImg( $admin_stat->hit_mark, $row->click, $row->hit_mark );}
														if($hit_img) $hit_img = str_replace("./images/", "../images/", $hit_img);

														$optArr = explode("/^CUT/^", $row->opt_data);
														$arrIcon = explode(",",",".$row->iconidx);
														$arrIcon2 = explode(",",",".$row->substimg);
												?>
											<?if($form_name > 1 && $newPart==1){?></tr></table><table width="100%" border="0"><tr><td height="10"></td></tr></table><?}?>
											<?if($newPart==1){?>
											<table width="100%" class="table_all" border=1>
												<tr bgcolor="E4E7EF"> 
													<td height="35" colspan="7" align="left" style="padding-left:10px;">
													<?
													$part_name = "";
													if($row->part1_code){
														$part_code1_row = $db->object("cs_part", "where part1_code='$row->part1_code' and part_index=1");						
														$part_name.="1차 카테고리 : <font color='#FF0000'>".$part_code1_row->part_name."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
													}
													if($row->part2_code){
														$part_code2_row = $db->object("cs_part", "where part2_code='$row->part2_code' and part_index=2");
														$part_name.="2차 카테고리 : <font color='#FF0000'>".$part_code2_row->part_name."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
													}
													if($row->part3_code){
														$part_code3_row = $db->object("cs_part", "where part3_code='$row->part3_code' and part_index=3");
														$part_name.="3차 카테고리 : <font color='#FF0000'>".$part_code3_row->part_name."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
													}
													?>
													<?=$part_name;?>
													</td>
												</tr>
												<tr>
													<td height="25" bgcolor="C4CADB" class='contenM tabletd_all noneoolimmoL'>NO</td>
													<td height="25" bgcolor="C4CADB" class='contenM tabletd_all'>사진</td>
													<td height="25" bgcolor="C4CADB" class='contenM tabletd_all noneoolimmoL'>판매설정</td>
													<td height="25" bgcolor="C4CADB" class='contenM tabletd_all noneoolimmoL'>상품명</td>
													<td height="25" bgcolor="C4CADB" class='contenM tabletd_all noneoolim'>금액</td>
													<?/*
													<td height="25" bgcolor="C4CADB" class='contenM tabletd_all'>메인/서브위치</td>
													*/?>
													<td height="25" bgcolor="C4CADB" class='contenM tabletd_all'>관리</td>
												</tr>
											<?}?>

												<form name="form_<?=$form_name?>" method="get" action="<?=$_SERVER[PHP_SELF];?>" enctype="multipart/form-data">
												<input type="hidden" name="board_data" value="<?=$board_data;?>">
												<input type="hidden" name="search_items" value="<?=$SEARCH_DATA;?>">
												<input type="hidden" name="hidden_goods_idx" value="<?=$row->idx;?>">
												<input type="hidden" name="form_data" value="<?=$form_name;?>">
												<input type="hidden" name="display">
												<tr id='calendar_list_tableTD_on'>
													<td width="3%" height="25" class='sensO tabletd_all noneoolimmoL'><?=$listNo;?></td>
													
													<td width="20%" height="25" class='sensO tabletd_all' style='text-align:center;'>
													<img src="../../data/goodsImages/<?=$row->images1?>" border="0" class='resize_itemS' id='img<?=$row->idx;?>' style='margin:5px auto;'><br>
													<?/*
													<img src="../thumbnail.img.php?ThumbEncode=<?=$ThumbEncode?>" border="0" class='resize_itemS' id='img<?=$row->idx;?>' style='margin:5px auto;'><br>
													*/?>
													<span class='noneoolimmoM_on'><?=$db->stripSlash($row->name);?></span>
													<input type="file" size='1' name="itemimg" onChange="javascript:itemimgChange(document.form_<?=$form_name?>);" class='file_text'>
													</td>
													
													<td width="10%" height="25" class='sensO tabletd_all noneoolimmoL'>
														<select name="display1" class="input" onChange="javascript:goodsChange(document.form_<?=$form_name?>);">
															<option value="0" <? if( $row->display == 0 ) { echo("selected");} ?>>준비중</option>
															<option value="1" <? if( $row->display == 1 ) { echo("selected");} ?>>판매중</option>
														</select><br /><?=$row->code;?>
													</td>
													
													<td width="30%" height="25" class='tabletd_all tabletd_small noneoolimmoL'>
													&nbsp;<span class='noneoolim'><img src="../img/product_list_2013icon2.gif" alt="재고" align="absmiddle" border="0"><?if($row->unlimit==1){?><font color='4876E5'>무제한</font><?}else{?><font color='4876E5'><?=$row->number?><?}?></font>&nbsp;<?=$hit_img;?>&nbsp;<?=$new_img;?><br>&nbsp;<font color="A7A7A7">제조회사 : <?=$row->company?></font><br></span>
													&nbsp;<?=$db->stripSlash($row->name);?> 
													<?for($i=1;$i<count($arrIcon);$i++){
														if($arrIcon[$i] > 0){
													?>
														<img src="../../data/designImages/<?=$arrPicon[$arrIcon[$i]]?>" align="absmiddle">
													<?}}?>
													<?if($row->opt_data){?> <a href="javascript:jsView('<?=$row->idx?>')" class='search_bbs2'>옵션확인</a><?}?></font><br>
													
														<table width="100%" id="faq<?=$row->idx?>" style="display:none" class='table_all_margin'>
															<? for($i=0;$i<count($optArr)-1;$i++){
																$optRec = explode("/^/^", $optArr[$i]);
															?>
															<tr>
																<td class='tabletd_allnew1 sensX' bgcolor='F8E7E7'><?=$optRec[0];?></td>
																<td class='tabletd_allnew1 sensX'>
																<?
																	$option1_arr = explode("&&", $optRec[1] );
																	for( $ot1=0; $ot1 < count($option1_arr)-1; $ot1++ ) {
																		$optView = "";
																		$optView = explode(":", $option1_arr[$ot1] );

																	?>
																<?=$option1_arr[$ot1]?> / 
																<? }?>
																</td>
															</tr>
															<? }?>						
														</table>
													</td>
													<td width="15%" height="25" class='sensO mmenu1 tabletd_all noneoolim'>
													<?if($row->subst==1){?>
														<?if($row->substtxt){?><?=$row->substtxt?><?}?>
														<?for($i=1;$i<count($arrIcon2);$i++){
															if($arrIcon2[$i] > 0){
														?>
															<img src="../../data/designImages/<?=$arrPicon[$arrIcon2[$i]]?>" align="absmiddle">
														<?}}?>
													<?}?>
													<font color='8BA5E6'><?=number_format($row->old_price);?>&nbsp;원</font><br><font color='E44141'><?=number_format($row->shop_price);?>&nbsp;원</font></td>
													<?/*
													<td  height="25" class='sensO tabletd_all'>
														<span class='noneoolimmoL_on' style='text-align:center'>판매설정<br>
														<select name="display2" class="input" onChange="javascript:goodsChange2(document.form_<?=$form_name?>);"><option value="0" <? if( $row->display == 0 ) { echo("selected");} ?>>준비중</option><option value="1" <? if( $row->display == 1 ) { echo("selected");} ?>>판매중</option></select></span><hr />
														<?/*
														메인위치설정<br>
														<select name="main_position" class="input" onChange="javascript:goodsChange(document.form_<?=$form_name?>);">
															<option value="0" <? if( $row->main_position == 0 ) { echo("selected");} ?>>선 택</option>
															<?
															$fresult		= $db->select("cs_part_fixed", "where event_code>0 order by event_code asc" );
															while( $frow = mysqli_fetch_object($fresult) ) {
															?>
															<option value="<?=$frow->event_code?>" <? if( $row->main_position == $frow->event_code ) { echo("selected");} ?>><?=$frow->part_name?></option>
															<?}?>
														</select><br><hr />

														서브위치설정<br>
														<select name="sub_position" class="input" onChange="javascript:goodsChange(document.form_<?=$form_name?>);">
															<option value="0" <? if( $row->sub_position == 0 ) { echo("selected");} ?>>선 택</option>
															<option value="1" <? if( $row->sub_position == 1 ) { echo("selected");} ?>>추천상품</option>
															<option value="2" <? if( $row->sub_position == 2 ) { echo("selected");} ?>>베스트상품</option>
														</select>	
													</td>
													*/?>
													<td width="100" height="25" class='tabletd_Lmall tabletd_all'><a href="javascript:goodsEdit('<?=$board_data;?>');" class='btn_guide2'>수정</a>&nbsp;<a href="javascript:goodsDel('<?=$board_data;?>');" class='btn_guide1'>삭제</a></td>
												</tr>
												</form>
												<?
													$listNo--;	
												}
												?>
												
												
												<? if( !$totalList ) { ?>
												<tr align="center" bgColor="white"> 
													<td height="100" colspan="8" align="center"> 등록된 상품이 없습니다.</td>
												</tr>
												<?}?>
											</table>
											
											<table width="100%">
												<tr> 
													<td height="50" style='text-align:center'>
													<? $page->board( $totalPage, $totalList, $listScale, $pageScale, $startPage, "", "<img src='../images/prev.gif' border='0'>", "<img src='../images/next.gif' border='0'>", "", $SEARCH_DATA);?></td>
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

<?
include('../header.php');
include($ROOT_DIR."/lib/page_class.php");
//$_GET=&$HTTP_GET_VARS;

// 상품정보변경
if( $_GET[hidden_goods_idx]) { $db->update("cs_goods", "shop_price='$_GET[shop_price]',display='$_GET[display]', main_position='$_GET[main_position]', sub_position='$_GET[sub_position]' where idx='$_GET[hidden_goods_idx]'");}

$mv_data	= $_GET[goods_data];
$goods_data	= $tools->decode( $_GET[goods_data] );
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $goods_data[idx]; }
if($_GET[part_idx] )			{ $part_idx = $_GET[part_idx]; }						else { $part_idx = $goods_data[part_idx]; }
if($_GET[listNo] )					{ $listNo = $_GET[listNo]; }									else { $listNo = $goods_data[listNo]; }
if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $goods_data[startPage]; }
if($_GET[search_item] )		{ $search_item = $_GET[search_item]; }			else { $search_item	= $goods_data[search_item]; }
if($_GET[search_order] )	{ $search_order = $_GET[search_order]; }		else { $search_order	= $goods_data[search_order]; }


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

$SEARCH_DATA = $tools->encode("part_idx=".$part_idx."&search_item=".$search_item."&search_order=".urlencode($search_order));
?>
<script language="javascript">
<!--

// 검색기능
function search(){
	var form=document.goods_search_form;
	if(form.search_order.value=="")	{
		alert("검색할 내용을 입력해 주십시오.");
		form.search_order.focus();
	} else {
		form.submit();
	}
}

// 상품금액수정
function goodsPrice(form_data){
    var choice = confirm( '금액수정을 하시겠습니까?');
	if(choice) {form_data.submit();}
}

// 상품정보변경(display, position)
function goodsChange(form_data){
    var choice = confirm( '상품정보변경을 하시겠습니까?');
	if(choice) {form_data.submit();}
}


// 상품을 수정
function goodsEdit( mv_data ) {
    var choice = confirm( '상품을 수정 하시겠습니까?');
	if(choice) {	location.href='product_edit.php?returnurl=product_total.php&search_items=<?=$SEARCH_DATA?>&board_data='+mv_data; }
	else { return; }
}

// 상품을 삭제
function goodsDel( mv_data ) {
    var choice = confirm( '상품을 삭제 하시겠습니까?');
	if(choice) {	location.href='product_del_ok.php?returnurl=product_total.php&search_items=<?=$SEARCH_DATA?>&board_data='+mv_data; }
	else { return; }
}

function goodsRanking(part_idx){
	var winleft = (screen.width - 400) / 2;
	var wintop = (screen.height - 500) / 2;
	window.open("product_ranking.php?part_idx="+part_idx,"","scrollbars=no, width=400, height=500, top="+wintop+", left="+winleft+"");
}
//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/product_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">상품관리</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#dddddd"></td>
			</tr>
			<tr>
				<td height="25"></td>
			</tr>
			<tr>
				<td class="padding_5">
					<table  width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
								<table width="100%">
									<tr> 
										<td align="center" valign="top" bgcolor="#FFFFFF">
										<table width="100%">
												<tr>
												<td>
													<table width="100%">
														<tr>
															<td height="25">
															<table>
																<tr>
																	<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">상품통합관리</td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20">

																<!--도움말-->
																	<table width="100%" class='tipbox noneoolim'>
																		<tr>
																			<td bgcolor="#E9F2F8">
																				<table width="100%">
																					<tr>
																						<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																					</tr>
																					<tr>
																						<td>상품순위 : 상품등록후 해당상품의 순위를 설정할수 있습니다. [<font color="red">등록순 정렬에 반영됩니다.</font>]<br>
																						모든상품의 수정을 쉽게 할수 있습니다.<br>특정상품을 메인노출 설정하실수 있습니다.</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>
																<!--//도움말-->
															</td>
														</tr>
														<tr>
															<td height="5"></td>
														</tr>
													</table>
												</td>
												</tr>
											</table> 
											<table width="100%">
												<tr> 
													<td height="25"></td>
													<td align="right">총 <font color="#FF0000"><?=$db->cnt("cs_goods", "");?></font>개의 상품이 등록되어 있습니다.</td>
												</tr>
											</table>
											<table width="100%" class="table_all">
												<?
												// 1차 카테고리 분류
												$part1_result = $db->select( "cs_part", "where part_index=1 order by part_ranking asc");
												while( $part1_row = @mysqli_fetch_object($part1_result) ) {
													// 카테고리 이미지 출력
													if( $part1_row->list_display_check == 1 ) {	$P1_images = "../../data/designImages/".$part1_row->list_display_images1; }
													// 카테고리 목록이미지 출력(마우스 롤오버)
													if( $part1_row->list_display_check == 2 ) {	$P1_images = "../../data/designImages/".$part1_row->list_display_images1; $P2_images = "../../data/designImages/".$part1_row->list_display_images2; }
													// 카테고리 목록 출력 유무
													if( $part1_row->part_display_check )  {	$part1_display_check_images = "<img src='../images/part_use.gif' border='0' alt='사용' align='absmiddle'>"; } else { $part1_display_check_images = "<img src='../images/part_nouse.gif' alt='미사용' align='absmiddle'>"; }
													// 2차 카테고리 등록이미지 출력
													if( $part1_row->part_low_check )  {	$part2_register_images = "<img src='../images/bt_category_add2.gif' border='0' alt='2차카테고리등록' align='absmiddle'>"; } else { $part2_register_images = ""; }
													// 등록된 상품수
													if($part1_total_goods=$db->cnt("cs_goods", "where part_idx='$part1_row->idx'")) { $part1_total_goods="(".$part1_total_goods.")";} else { $part1_total_goods="";}
												?>		
												<tr> 
													<td bgcolor="B9C1D3" class='contenM tabletd_all'>

														<table width="100%">
															<tr>
																<td><? if(!empty($part1_total_goods)) {?><a href="?part_idx=<?=$part1_row->idx;?>"><?}?><span class='item_category_icon1'>1차</span><?=$part1_row->part_name;?> <?=$part1_total_goods;?></a></td>
																<td style='text-align:right;'><? if(!empty($part1_total_goods)) {?><a href="javascript:goodsRanking(<?=$part1_row->idx;?>)" class='search_bbs2'>상품순위설정</a>&nbsp;&nbsp;<?}?></td>
															</tr>
														</table>

													</td>
												</tr>
													<? if(!empty($part1_total_goods) && $part_idx==$part1_row->idx) {?>
													<tr>
														<td bgcolor="ffffff" class='contenM tabletd_all'>
														
																<table width="100%">
																		<?
																		//$part_idx= $part1_row->idx;
																		$part_idx= $part_idx;
																		if( $search_item == 1 ) {
																			$result		= $db->select( "cs_goods", "where part_idx=$part_idx and name like '%$search_order%' order by ranking asc" );
																		} else if( $search_item == 2 ) {
																			$result		= $db->select( "cs_goods", "where part_idx=$part_idx and code like '$search_order' order by ranking asc" );
																		} else if( $search_item == 3 ) {
																			$result		= $db->select( "cs_goods", "where part_idx=$part_idx and company like '$search_order' order by ranking asc" );
																		} else { 
																			$result		= $db->select( "cs_goods", "where part_idx=$part_idx order by ranking asc" );
																		}
															
																		$form=0; // 폼리스트 변수
																		while( $row = mysqli_fetch_object($result)) {
																			$form++; // 폼네임변경 숫자증가
																			if($form%2) $bgColor="#E8F1DF"; else $bgColor="#FFFFFF";
																			$board_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo);
																			$ThumbEncode = $tools->encode("idx=".$row->idx."&table=cs_goods&img=images1&dire=goodsImages&w=43&h=43");
																		?>
																		<form name="form_<?=$part_idx;?>_<?=$form?>" method="get" action="<?=$_SERVER[PHP_SELF];?>?board_data=<?=$board_data;?>&search_items=<?=$SEARCH_DATA;?>">
																		<input type="hidden" name="hidden_goods_idx" value="<?=$row->idx;?>">
																		<input type="hidden" name="part_idx" value="<?=$row->part_idx;?>">
																		<tr align="center" bgcolor="<?=$bgColor?>" style="padding-left: 0; padding-top: 10px; padding-bottom: 10px" onMouseOver=this.style.backgroundColor="#E8F1DF"  onMouseOut=this.style.backgroundColor="">
																			<td class='noneoolim'></td>
																			
																			<td width="8%" style='text-align:center'><img src="../thumbnail.img.php?ThumbEncode=<?=$ThumbEncode?>" border="0"></td>
																			
																			<td style='padding-left:20px; padding-top:20px; padding-bottom:20px;'><select name="display"onChange="javascript:goodsChange(document.form_<?=$part_idx;?>_<?=$form?>);"><option value="0" <? if( $row->display == 0 ) { echo("selected");} ?>>준비중</option><option value="1" <? if( $row->display == 1 ) { echo("selected");} ?>>판매중</option></select>
																			<br>				
																			<font color="#"><?=$db->stripSlash($row->name);?></font>
																			
																			<br><span class='itemwon_noneoolim'><input type="text" name="shop_price" value="<?=$row->shop_price;?>" class="formText textphone" style="text-align:center;"><a href="javascript:goodsPrice(document.form_<?=$part_idx;?>_<?=$form?>);" class="btn_guide1">금액수정</a></span>
																			</td>
																			
																			<td width="20%" style='text-align:center' class='noneoolim'><input type="text" name="shop_price" value="<?=$row->shop_price;?>" class="formText textphone" style="text-align:center;"><a href="javascript:goodsPrice(document.form_<?=$part_idx;?>_<?=$form?>);" class="btn_guide1">금액수정</a></td>
																			
																			<td width="30%" style='text-align:center;'>
																				
																				메인 :
																					<select name="main_position" onChange="javascript:goodsChange(document.form_<?=$part_idx;?>_<?=$form?>);" style="width:65">
																					<option value="0" <? if( $row->main_position == 0 ) { echo("selected");} ?>>선 택</option>
																					<?
																					$fresult		= $db->select("cs_part_fixed", "where event_code>0 order by event_code asc" );
																					while( $frow = mysqli_fetch_object($fresult) ) {
																					?>
																					<option value="<?=$frow->event_code?>" <? if( $row->main_position == $frow->event_code ) { echo("selected");} ?>><?=$frow->part_name?></option>
																					<?}?>
																					</select>
																				<br>
																				
																				서브 :					
																					<select name="sub_position" onChange="javascript:goodsChange(document.form_<?=$part_idx;?>_<?=$form?>);" style="width:65">
																					<option value="0" <? if( $row->sub_position == 0 ) { echo("selected");} ?>>선 택</option>
																					<option value="1" <? if( $row->sub_position == 1 ) { echo("selected");} ?>>추천상품</option>
																					<option value="2" <? if( $row->sub_position == 2 ) { echo("selected");} ?>>베스트상품</option>
																					</select>
																						
																			</td>

																			<td width="20%" style='text-align:center;'><a href="javascript:goodsEdit('<?=$board_data;?>');" class="btn_guide1">수정</a><a href="javascript:goodsDel('<?=$board_data;?>');" class="btn_guide2">삭제</a></td>
																		</tr>
																		</form>
																		<?}?>
																	<? if(!$form) {?>
																		<tr>
																			<td width="80" height="25"></td>
																			<td height="20" colspan="6">검색한 상품이 없습니다.</td>
																		</tr>
																	<?}?>
																	</table>
															
															</td>
													</tr>
													<?}?>
													<?
													// 2차 카테고리 분류
													$part2_result = $db->select( "cs_part", "where part_index=2 and part1_code='$part1_row->part1_code' order by part_ranking asc");
													while( $part2_row = @mysqli_fetch_object($part2_result) ) {
														// 카테고리 목록 출력 유무
														if( $part2_row->part_display_check )  {	$part2_display_check_images = "<img src='../images/part_use.gif' border='0' alt='사용' align='absmiddle'>"; } else { $part2_display_check_images = "<img src='../images/part_nouse.gif' alt='미사용' align='absmiddle'>"; }
														// 2차 카테고리 등록이미지 출력
														if( $part2_row->part_low_check )  {	$part3_register_images = "<img src='../images/bt_category_add3.gif' border='0' alt='3차카테고리등록' align='absmiddle'>"; } else { $part3_register_images = ""; }
														// 등록된 상품수
														if( $part2_total_goods=$db->cnt("cs_goods", "where part_idx='$part2_row->idx'")) { $part2_total_goods="(".$part2_total_goods.")";} else { $part2_total_goods="";}
													?>		
													<tr>
														<td bgcolor="DFE5F2" class='contenM tabletd_all'>
															
															<table width="100%">
																<tr>
																	<td><? if(!empty($part2_total_goods)) {?><a href="?part_idx=<?=$part2_row->idx;?>"><?}?><span class='item_category_icon2'>2차</span><?=$part2_row->part_name;?> <?= $part2_total_goods;?></a></td>
																	<td style='text-align:right;'><? if(!empty($part2_total_goods)) {?><a href="javascript:goodsRanking(<?=$part2_row->idx;?>)"><font size="2" class='search_bbs2'>상품순위설정</font></a>&nbsp;&nbsp;<?}?></td>
																</tr>
															</table>

														</td>
													</tr>
													<? if(!empty($part2_total_goods) && $part_idx==$part2_row->idx) {?>
													<tr>
														<td bgcolor="ffffff" class='contenM tabletd_all'>
														
																<table width="100%">
																		<?
																		$part_idx= $part_idx;
																		if( $search_item == 1 ) {
																			$result		= $db->select( "cs_goods", "where part_idx=$part_idx and name like '%$search_order%' order by ranking asc" );
																		} else if( $search_item == 2 ) {
																			$result		= $db->select( "cs_goods", "where part_idx=$part_idx and code like '$search_order' order by ranking asc" );
																		} else if( $search_item == 3 ) {
																			$result		= $db->select( "cs_goods", "where part_idx=$part_idx and company like '$search_order' order by ranking asc" );
																		} else { 
																			$result		= $db->select( "cs_goods", "where part_idx=$part_idx order by ranking asc" );
																		}
															
																		$form=0; // 폼리스트 변수
																		while( $row = mysqli_fetch_object($result)) {
																			$form++; // 폼네임변경 숫자증가
																			if($form%2) $bgColor="#E8F1DF"; else $bgColor="#FFFFFF";
																			$board_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo);
																			$ThumbEncode = $tools->encode("idx=".$row->idx."&table=cs_goods&img=images1&dire=goodsImages&w=43&h=43");
																		?>
																		<form name="form_<?=$part_idx;?>_<?=$form?>" method="get" action="<?=$_SERVER[PHP_SELF];?>?goods_data=<?=$goods_data;?>">
																		<input type="hidden" name="hidden_goods_idx" value="<?=$row->idx;?>">
																		<input type="hidden" name="part_idx" value="<?=$row->part_idx;?>">
																		<tr align="center" bgcolor="<?=$bgColor?>" style="padding-left: 0; padding-top: 10px; padding-bottom: 10px" onMouseOver=this.style.backgroundColor="#E8F1DF"  onMouseOut=this.style.backgroundColor=""> 
																			<td class='noneoolim'></td>
																			
																			<td width="8%" style='text-align:center'><img src="../thumbnail.img.php?ThumbEncode=<?=$ThumbEncode?>" border="0"></td>
																			
																			<td style='padding-left:20px;padding-top:20px; padding-bottom:20px;'><select name="display" onChange="javascript:goodsChange(document.form_<?=$part_idx;?>_<?=$form?>);"><option value="0" <? if( $row->display == 0 ) { echo("selected");} ?>>준비중</option><option value="1" <? if( $row->display == 1 ) { echo("selected");} ?>>판매중</option></select>

																			<br><font color="#"><?=$db->stripSlash($row->name);?></font>
																			
																			<br><span class='itemwon_noneoolim'><input type="text" name="shop_price" value="<?=$row->shop_price;?>" class="formText textphone" style="text-align:center;"><a href="javascript:goodsPrice(document.form_<?=$part_idx;?>_<?=$form?>);" class="btn_guide1">금액수정</a></span>
																			</td>
																			
																			<td width="20%" style='text-align:center' class='noneoolim'><input type="text" name="shop_price" value="<?=$row->shop_price;?>" class="formText textphone" style="text-align:center;"><a href="javascript:goodsPrice(document.form_<?=$part_idx;?>_<?=$form?>);" class="btn_guide1">금액수정</a></td>
																			
																			<td width="30%"  style='padding-top:20px; padding-bottom:20px;text-align:center;'>
																				
																				메인 :
																					<select name="main_position" onChange="javascript:goodsChange(document.form_<?=$part_idx;?>_<?=$form?>);" style="width:65">
																					<option value="0" <? if( $row->main_position == 0 ) { echo("selected");} ?>>선 택</option>
																					<?
																					$fresult		= $db->select("cs_part_fixed", "where event_code>0 order by event_code asc" );
																					while( $frow = mysqli_fetch_object($fresult) ) {
																					?>
																					<option value="<?=$frow->event_code?>" <? if( $row->main_position == $frow->event_code ) { echo("selected");} ?>><?=$frow->part_name?></option>
																					<?}?>
																					</select>
																				<br>
																				서브 :
																					<select name="sub_position" onChange="javascript:goodsChange(document.form_<?=$part_idx;?>_<?=$form?>);" style="width:65">
																					<option value="0" <? if( $row->sub_position == 0 ) { echo("selected");} ?>>선 택</option>
																					<option value="1" <? if( $row->sub_position == 1 ) { echo("selected");} ?>>추천상품</option>
																					<option value="2" <? if( $row->sub_position == 2 ) { echo("selected");} ?>>베스트상품</option>
																					</select>
																			</td>

																			<td width="20%" style='text-align:center;'><a href="javascript:goodsEdit('<?=$board_data;?>');" class="btn_guide1">수정</a><a href="javascript:goodsDel('<?=$board_data;?>');" class="btn_guide2">삭제</a></td>
																		</tr>
																		</form>
																		<?}?>
																	<? if(!$form) {?>
																		<tr>
																			<td width="80" height="25"></td>
																			<td height="20" colspan="6">검색한 상품이 없습니다.</td>
																		</tr>
																	<?}?>
																	</table>
														</td>
													</tr>
													<?}?>
													<?
													$part3_result = $db->select( "cs_part", "where part_index=3 and part2_code='$part2_row->part2_code' and part1_code='$part2_row->part1_code'  order by part_ranking asc");
													while( $part3_row = @mysqli_fetch_object($part3_result) ) {
														// 카테고리 목록 출력 유무
														if( $part3_row->part_display_check )  {	$part3_display_check_images = "<img src='../images/part_use.gif' border='0' alt='사용' align='absmiddle'>"; } else { $part3_display_check_images = "<img src='../images/part_nouse.gif' alt='미사용' align='absmiddle'>"; }
														// 등록된 상품수
														if( $part3_total_goods=$db->cnt("cs_goods", "where part_idx='$part3_row->idx'")) { $part3_total_goods="(".$part3_total_goods.")";} else { $part3_total_goods="";}
													?>		
													<tr> 
														<td bgcolor="ffffff" class='contenM tabletd_all'>
															
															<table width="100%">
																<tr>
																	<td><? if(!empty($part3_total_goods)) {?><a href="?part_idx=<?=$part3_row->idx;?>"><?}?><span class='item_category_icon3'>3차</span><?=$part3_row->part_name;?> <?= $part3_total_goods;?></a></td>
																	<td style='text-align:right;'><? if(!empty($part3_total_goods)) {?><a href="javascript:goodsRanking(<?=$part3_row->idx;?>)"><font size="2" class='search_bbs2'>상품순위설정</font></a>&nbsp;&nbsp;<?}?></td>
																</tr>
															</table>

														</td>
													</tr>
													<? if(!empty($part3_total_goods)  && $part_idx==$part3_row->idx) {?>
													<tr>
														<td bgcolor="ffffff" class='contenM tabletd_all'>
																<table width="100%">
																		<?
																		$part_idx= $part_idx;
																		if( $search_item == 1 ) {
																			$result		= $db->select( "cs_goods", "where part_idx=$part_idx and name like '%$search_order%' order by ranking asc" );
																		} else if( $search_item == 2 ) {
																			$result		= $db->select( "cs_goods", "where part_idx=$part_idx and code like '$search_order' order by ranking asc" );
																		} else if( $search_item == 3 ) {
																			$result		= $db->select( "cs_goods", "where part_idx=$part_idx and company like '$search_order' order by ranking asc" );
																		} else { 
																			$result		= $db->select( "cs_goods", "where part_idx=$part_idx order by ranking asc" );
																		}
															
																		$form=0; // 폼리스트 변수
																		while( $row = mysqli_fetch_object($result)) {
																			$form++; // 폼네임변경 숫자증가
																			if($form%2) $bgColor="#EFEFEF"; else $bgColor="#FFFFFF";
																			$board_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo);

																			$ThumbEncode = $tools->encode("idx=".$row->idx."&table=cs_goods&img=images1&dire=goodsImages&w=43&h=43");
																		?>
																		<form name="form_<?=$part_idx;?>_<?=$form?>" method="get" action="<?=$_SERVER[PHP_SELF];?>?goods_data=<?=$goods_data;?>">
																		<input type="hidden" name="hidden_goods_idx" value="<?=$row->idx;?>">
																		<input type="hidden" name="part_idx" value="<?=$row->part_idx;?>">
																		<tr align="center" bgcolor="<?=$bgColor?>" style="padding-left: 0; padding-top: 10px; padding-bottom: 10px" onMouseOver=this.style.backgroundColor="#F8F0E6"  onMouseOut=this.style.backgroundColor=""> 
																			<td class='noneoolim'></td>
																			
																			<td width="8%" style='text-align:center'><img src="../thumbnail.img.php?ThumbEncode=<?=$ThumbEncode?>" border="0"></td>
																			
																			<td style='padding-left:20px;padding-top:20px; padding-bottom:20px;;'><select name="display" onChange="javascript:goodsChange(document.form_<?=$part_idx;?>_<?=$form?>);"><option value="0" <? if( $row->display == 0 ) { echo("selected");} ?>>준비중</option><option value="1" <? if( $row->display == 1 ) { echo("selected");} ?>>판매중</option></select><br>
																			<font color="#"><?=$db->stripSlash($row->name);?></font>
																			
																			<br><span class='itemwon_noneoolim'><input type="text" name="shop_price" value="<?=$row->shop_price;?>" class="formText textphone" style="text-align:center;"><a href="javascript:goodsPrice(document.form_<?=$part_idx;?>_<?=$form?>);" class="btn_guide1">금액수정</a></span></td>
																			
																			<td width="20%" style='text-align:center' class='noneoolim'><input type="text" name="shop_price" value="<?=$row->shop_price;?>" class="formText textphone" style="text-align:center;"><a href="javascript:goodsPrice(document.form_<?=$part_idx;?>_<?=$form?>);" class="btn_guide1">금액수정</a></td>
																			
																			<td width="30%" height="25" style='text-align:center;'>
																			
																				메인 :
																					<select name="main_position" onChange="javascript:goodsChange(document.form_<?=$part_idx;?>_<?=$form?>);" style="width:65">
																					<option value="0" <? if( $row->main_position == 0 ) { echo("selected");} ?>>선 택</option>
																					<?
																					$fresult		= $db->select("cs_part_fixed", "where event_code>0 order by event_code asc" );
																					while( $frow = mysqli_fetch_object($fresult) ) {
																					?>
																					<option value="<?=$frow->event_code?>" <? if( $row->main_position == $frow->event_code ) { echo("selected");} ?>><?=$frow->part_name?></option>
																					<?}?>
																					</select>
																				<br>
																				서브 :
																					<select name="sub_position" onChange="javascript:goodsChange(document.form_<?=$part_idx;?>_<?=$form?>);" style="width:65">
																					<option value="0" <? if( $row->sub_position == 0 ) { echo("selected");} ?>>선 택</option>
																					<option value="1" <? if( $row->sub_position == 1 ) { echo("selected");} ?>>추천상품</option>
																					<option value="2" <? if( $row->sub_position == 2 ) { echo("selected");} ?>>베스트상품</option>
																					</select>
																						
																			</td>
																			<td width="15%" height="25"><a href="javascript:goodsEdit('<?=$board_data;?>');" class="btn_guide1">수정</a><a href="javascript:goodsDel('<?=$board_data;?>');" class="btn_guide2">삭제</a></td>
																		</tr>
																		</form>
																		<?}?>
																	<? if(!$form) {?>
																		<tr>
																			<td width="80" height="25"></td>
																			<td height="20" colspan="6">검색한 상품이 없습니다.</td>
																		</tr>
																	<?}?>
																	</table>
														</td>
													</tr>
													<?}?>

													<? 
														} // 3차 카테고리
													} // 2차 카테고리 
													$P1_images = ""; $P2_images = ""; 
												} // 1차 카테고리 
												?>
												<? if( !$db->cnt("cs_part", "")) {?>
												<tr>
													<td height="100" align="center"> 등록된 카테고리가 없습니다.</td>
												</tr>
												<?}?>
											</table><br>
											<table width="100%" style="display:none;">
												<form method="get" name="goods_search_form" action="<?=$_SERVER[PHP_SELF];?>">
												<tr> 
													<td height="25" align='center'>
														<select name="search_item" class="formText">
															<option value="1">상품명</option>
															<option value="2">상품번호</option>
															<option value="3">제조사</option>
														</select> 
														<input name="search_order" type="text" class="formText"> <a href="javascript:search();"><img src="../images/bt_search.gif" align="absmiddle" border="0"></a>
													</td>
												</tr>
												</form>
											</table><br>
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

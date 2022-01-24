<?
include('../header.php');
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
if( $_POST[part1_list] ) { $part_check_row = $db->object("cs_part", "where idx='$_POST[part1_list]'");} else if( $_POST[part2_list] ) { $part_check_row = $db->object("cs_part", "where idx='$_POST[part2_list]'");}
?>

<script language="JavaScript">
<!--
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

// 순위 변경 ( up or down )
function move(index,to) {
	var list = index;
	var total = list.length-1;
	var index = list.selectedIndex;
	
	if (to == +1 && index == total) return false;
	if (to == -1 && index == 0) return false;
	
	var items = new Array;
	var values = new Array;
	
	for (i = total; i >= 0; i--) {
		items[i] = list.options[i].text;
		values[i] = list.options[i].value;
	}
		
	for (i = total; i >= 0; i--) {
		if (index == i) {

			alert
			list.options[i + to] = new Option(items[i],values[i], 0, 1);
			list.options[i] = new Option(items[i + to], values[i + to]);
			i--;
		}
		else
		{
			list.options[i] = new Option(items[i], values[i]);
    }
  }
}

// 전송전에 리스트의 값들을 원래의 형식대로 변경한다.
function send_form(f)
{
	if ( f.select1.length != 0 )
	{
		for ( i = 0 ; i < f.select1.length; i++ )
		{
				value_1 = f.select1[i].value; 
				value_2 = value_1.split(sep);
				f.select1.options[i].value = value_2[0];
		}
	}

	if ( f.select2.length != 0 )
	{
		for ( i = 0 ; i < f.select2.length; i++ )
		{
				value_1 = f.select2[i].value; 
				value_2 = value_1.split(sep);
				f.select2.options[i].value = value_2[0];
		}
	}

	for ( i = 0; i <= f.select1.length-1; i++ ) {
		if ( f.select1.options[i].value != "undefined"  )
		{
			if ( i != 0 )
				f.list1.value = f.list1.value + "&&";
			f.list1.value =  f.list1.value + f.select1.options[i].value;
		}
	}

	for ( i = 0; i <= f.select2.length-1; i++ ) {
		if ( f.select2.options[i].value != "undefined"  )
		{
			if ( i != 0 )
				f.list2.value = f.list2.value + "&&";
			f.list2.value =  f.list2.value + f.select2.options[i].value;
		}
	}

	for ( i = 0; i <= f.select3.length-1; i++ ) {
		if ( f.select3.options[i].value != "undefined"  )
		{
			if ( i != 0 )
				f.list3.value = f.list3.value + "&&";
			f.list3.value =  f.list3.value + f.select3.options[i].value;
		}
	}

	//전송하기 전에 select1, select2, select3 의 리스트를  
	//모두붙여서 전송하는 코드가 필요할 거 같은데.. 
	
	f.select_value1.value = f.select1.value;
	f.select_value2.value = f.select2.value;

	f.submit();
}



// 선택되었을때 다음 단계 카테고리 출력
function change(depth, index, target)
{
	f = form;   // 선택된 Form;
	
	if ( depth == 1 && index != -1)  // 대분류 선택 시
	{
		sp_value = f.select1[index].value;
		sp_value = sp_value.split(sep);
		sp_value2 = sp_value[1];
		
		for ( i = f.select2.length; i >= 0; i-- ) {
			f.select2[i] = null; 
		}

		if ( depth2[sp_value2] != null )
		{
	
			for ( i = 0 ; i <= depth2[sp_value2].length -1 ; i++ )
			{
				f.select2.options[i] = new Option(depth2[sp_value2][i],depth2_value[sp_value2][i] + sep + sp_value2 + sep + i );
			}
		}
/*		else
		{
			alert("하부 카테고리가 정해지지 않았습니다");
		}*/


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

		if ( depth3[sp_value2][sp_value3] != null )
		{

			for ( i = 0 ; i <= depth3[sp_value2][sp_value3].length -1 ; i++ )
			{
				f.select3.options[i] = new Option(depth3[sp_value2][sp_value3][i],depth3_value[sp_value2][sp_value3][i]);
			}
		}
/*		else
		{
			alert("하부 카테고리가 정해지지 않았습니다");
		}*/
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
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">카테고리순위설정</td>
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
												<td>
													<table border="0" width="100%">
														<tr>
															<td height="25">
															<table>
																<tr>
																	<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">카테고리순위설정</td>
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
																						<td>각 카테고리별 우측의 상하 버튼으로 순위를 설정할 수 있습니다.<BR>
																							2, 3차 카테고리가 등록되지 않으면 화면에 1차 카테고리만 나타납니다.<BR>
																							정해진 순위는 쇼핑몰 메인 카테고리에 적용됩니다.</td>
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
												<form name="form" method="post" action="category_ranking_ok.php">
												<input type=hidden name=list1>
												<input type=hidden name=list2>
												<input type=hidden name=list3>
												<input type=hidden name=select_value1>
												<input type=hidden name=select_value2>
												<tr>
													<td>

														<div class='oolimbox-wrapper oolimbox-grid3'>
															<div class='oolimbox-col_3dan' style='text-align:center;'>
																<span style='font-size:12pt;'>1차카테고리</span>
																<table style='width:100%;'>
																	<tr>
																		<td style='width:90%;'>
																			<select name="select1" size="15" style="width:100%;" onclick='change(1, this.form.select1.selectedIndex, this.form)'  class='itemSelect'>
																				<script language = "javascript">
																					for ( i = 0 ; i <= depth1.length -1 ; i++ ){	document.write ("<option value='"+ depth1_value[i] + sep + i + "' >" + depth1[i] + "</option>");}
																				</script>
																			</select>
																		</td>
																		<td width="10%">
																			<table width="100%" class="menu">
																				<tr>
																					<td><A HREF="#" onClick="move(form.select1,-1)" class='searchD'><img src="../images/top_arrow.png"  border=0></a></td>
																				</tr>
																				<tr>
																					<td height="25"><A HREF="#" onClick="move(form.select1,+1)" class='searchD'><img src="../images/bottom_arrow.png" border=0></a></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>

															</div>
															<div class='oolimbox-col_3dan' style='text-align:center;'>
																<span style='font-size:12pt;'>2차카테고리</span>
																<table style='width:100%;'>
																	<tr>
																		<td style='width:90%;'>
																			<select name="select2" size="15" style="width:100%;"  onclick='change(2, this.form.select2.selectedIndex, this.form)' class='itemSelect'>
																			</select>
																		</td>
																		<td width="10%">
																			<table width="100%">
																				<tr>
																					<td><a href="#" onclick="move(form.select2,-1)" class='searchD'><img src="../images/top_arrow.png"  border=0></a></td>
																				</tr>
																				<tr>
																					<td height="25"><a href="#" onclick="move(form.select2,+1)" class='searchD'><img src="../images/bottom_arrow.png" border=0></a></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>

															</div>
															<div class='oolimbox-col_3dan' style='text-align:center;'>
																<span style='font-size:12pt;'>3차카테고리</span>
																<table style='width:100%;'>
																	<tr>
																		<td style='width:90%;'>
																			<select name="select3" size="15" style="width:100%;" class='itemSelect'>
																			</select>
																		</td>
																		<td width="10%">
																			<table width="100%">
																				<tr>
																					<td><a href="#" onclick="move(form.select3,-1)" class='searchD'><img src="../images/top_arrow.png"  border=0></a></td>
																				</tr>
																				<tr>
																					<td height="25"><a href="#" onclick="move(form.select3,+1)" class='searchD'><img src="../images/bottom_arrow.png" border=0></a></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>

															</div>
														</div>


														<table width="100%">
															<tr>
																<td height="70"><a href="javascript:send_form(this.form)" class='oolimbtn-botton1'>등록</a></td>
															</tr>
														</table>	
													</td>
												</tr>
												</form>
											</table>
										</td>
									</tr>
								</table>
								<script language = "javascript">
								<?
								if ( $_GET[select_value1] != "" ){
								?>
									var buf_1;
									for ( i = 0; i <= form.select1.length-1; i++ ) {
										buf_of = form.select1[i].value.split(sep);
										if ( buf_of[0] == "<?=$_GET[select_value1];?>")
											buf_1 = i;
										buf_of = null;
									}
									if (buf_1 != null)
										change(1, buf_1,"");
								<?}?>

								<?
								if ( $_GET[select_value2] != "" ){
								?>
									var buf_2;
									for ( i = 0; i <= form.select2.length-1; i++ ) {
										buf_of = form.select2[i].value.split(sep);
										if ( buf_of[0] == "<?=$_GET[select_value2];?>")
											buf_2 = i;
										buf_of = null;
									}
									if (buf_2 != null)
										change(2, buf_2,"");
								<?}?>
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

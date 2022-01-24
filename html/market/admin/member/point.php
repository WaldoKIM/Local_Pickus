<? 
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS; 
// 넘겨받은 데이타
if($_GET[userid]) { $userid =$_GET[userid];} else if($_POST[userid]) { $userid =$_POST[userid];}
if(!$userid) { $tools->errMsg('아이디가 정상적으로 입력되지 않았습니다');}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<title>포인트관리</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/popup.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/component.css" />

</head>
<script language="JavaScript">
<!--
function sendit() {
	var form=document.point_form;
	if(form.title.value=="") {
		alert("거래내역 입력해 주세요.");
		form.title.focus();
	} else if(form.point.value=="") {
		alert("포인트를 입력해 주세요.");
		form.point.focus();
	} else {
		form.submit();
	}
}

function pointDel( idx, userid ) {
    var choose = confirm( '포인트를 삭제 하시겠습니까?');
	if(choose) {	location.href='point_del_ok.php?idx='+idx+'&userid='+userid; }
	else { return; }
}
//-->
</script>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="400">
	<tr>
		<td align="center"><br>
			<table width="400">
				<tr>
					<td height="60" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">포인트관리</td>
				</tr>
			</table>
			<table width="400" class="table_all">
				<form action="point_ok.php" method="post" name="point_form">
				<input type="hidden" name="userid" value="<?=$userid;?>">
				<tr>
					<td bgcolor="E4E7EF" width="100" align="right" class='contenM tabletd_all'>거래내역</td>
					<td bgcolor="E4E7EF" class='contenM tabletd_all'><input name="title" type="text" class="formText_mo" size="30" maxlength="200"></td>
				</tr>
				<tr>
					<td width="100" align="right" class='contenM tabletd_all'>포인트</td>
					<td class='contenM tabletd_all'><select name="sum" class="formText_mo">
							<option value="+">+</option>
							<option value="-">-</option>
							</select> <input name="point" type="text" class="formText_mo" size="11" maxlength="11" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" style='text-align: right;'>
							<a href="javascript:sendit();" class="itemtable_default_bt3">저장하기</a>
					</td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center" height='30'>
			<table width="350">
				<tr>
					<td class="tmb">Total : <font color="#FF0000">	<? $total_point = $db->sum("cs_point", "where userid='$userid'", "point"); echo(number_format($total_point));?></font> 원</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table width="350" class="table_all">
				<tr align="center" bgcolor="E4E7EF">
					<td height="25" class='contenM tabletd_all'>거래내역정보</td>
					<td height="25" width="50" class='contenM tabletd_all'>포인트</td>
					<td height="25" width="65" class='contenM tabletd_all'>거래일</td>
					<td height="25" width="46" class='contenM tabletd_all'>관리</td>
				</tr>
				<?
				$result	= $db->select("cs_point", "where userid='$userid' order by idx desc" );
				while( $row = mysqli_fetch_object($result)) {
				?>
				<tr align="center">
					<td height="25" class='contenM tabletd_all'><?=$row->title;?></td>
					<td height="25" width="50" class='contenM tabletd_all'><?=$row->point;?></td>
					<td height="25" width="65" class='contenM tabletd_all'><?=$tools->strDateCut($row->register, 1);?></td>
					<td height="25" width="46" class='contenM tabletd_all'><a href="javascript:pointDel('<?=$row->idx;?>', '<?=$userid;?>');" class='menusmall_btn4'>삭제</a></td>
				</tr>
				<?}?>		
			</table>
		</td>
	</tr>
</table>
<br>
</body>
</html>

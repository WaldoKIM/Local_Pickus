<? 
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS; 
// 넘겨받은 데이타
if($_GET[trade_idx]) { $trade_idx =$_GET[trade_idx];} else if($_POST[trade_idx]) { $trade_idx =$_POST[trade_idx];}

$trade_goods_stat = $db->object("cs_trade_goods","where idx=$trade_idx");
if($_POST[trade_number]) {
	if($trade_goods_stat->trade_stat < 3){
		$db->update("cs_trade_goods", "deliv_number='$_POST[trade_number]', trade_start_day= trade_stat='3', trade_start_day=now()  where idx=$trade_idx");
	}else{
		$db->update("cs_trade_goods", "deliv_number='$_POST[trade_number]', trade_start_day=now()  where idx=$trade_idx");
	}
	$tools->msg('송장번호 입력완료');
	?>
	<script>
		parent.location.reload();
		parent.$.RiModal.get('self').close();
	 </script>
	<?
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<title>택배송장번호</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/popup.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/component.css" />
</head>
<script language="JavaScript">
<!--
function sendit() {
	var form=document.invoice_form;
	form.submit();
}

//-->
</script>
<body>
<table border="0"  width="400">
	<tr>
		<td height="60" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">주문관리</td>
	</tr>
	<tr> 
		<td style="text-align:center;">송장번호 등록시 거래상태가 배송중으로 변경됩니다.
			<table width="95%"  class="table_all">
				<form action="<?=$_SERVER[PHP_SELF];?>" method="post" name="invoice_form">
				<input type="hidden" name="trade_idx" value="<?=$trade_idx;?>">
				<tr> 
					<td width="100" class='contenM tabletd_all'>송장번호</td>
					<td class='contenM tabletd_all'>
						<input name="trade_number" type="text" class="formText_mo" size="30" maxlength="50" value="<?=$trade_goods_stat->deliv_number;?>"> &nbsp;
					</td>
				</tr>
				<tr> 
					<td class='contenM tabletd_all' height="35" colspan="2"><a href="javascript:sendit();" class="itemtable_default_bt3">송장번호등록</a></td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
	<tr> 
		<td align="center">&nbsp;</td>
	</tr>
</table>
</body>
</html>

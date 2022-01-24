<? 
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS; 
// 넘겨받은 데이타
if($_GET[trade_idx]) { $trade_idx =$_GET[trade_idx];} else if($_POST[trade_idx]) { $trade_idx =$_POST[trade_idx];}


$order_stat = $db->object("cs_trade_goods", "where idx='$trade_idx'");
if($order_stat->trade_stat == 5){
	$refund_title = "거래 취소 요청중";
}else if($order_stat->trade_stat == 51){
	$refund_title = "환불 대기중";
}else if($order_stat->trade_stat == 52){
	$refund_title = "취소/환불완료";
}

/*
if($order_stat->refund_bank==""){
	$member_stat = $db->object("cs_member","where userid='$order_stat->order_userid' ");
	if($member_stat->bank && $member_stat->account_num && $member_stat->account_name){
		$refund_bank = $member_stat->bank."/".$member_stat->account_num."/".$member_stat->account_name;
	}else{
		$refund_bank="";
	}
}else{
	$refund_bank=$order_stat->refund_bank;
}
*/
$refund_bank=$order_stat->refund_bank;

if($_POST[refund_bank]) {
	$db->update("cs_trade", "refund_bank='$_POST[refund_bank]' where idx=$trade_idx");
	$tools->msg('환불계좌 입력완료');
	?>
	<script>
		parent.$.RiModal.get('self').close();
	 </script>
	<?
}

?>
<!DOCTYPE html>
<html lang="ko">
<head>
<title>거래 취소 및 환불정보</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/popup.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/component.css" />
</head>
<script language="JavaScript">
<!--
function sendit() {
	var form=document.refund_form;
	form.submit();
}

//-->
</script>
<body>
<table border="0"  width="450">
	<tr>
		<td height="60" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">주문관리</td>
	</tr>
	<tr> 
		<td>
			<table width="95%"  class="table_all">
				<tr> 
					<td width="100" class='contenM tabletd_all'>상태</td>
					<td class='contenM tabletd_all'><?=$refund_title;?>(<?=$order_stat->refund_type;?>)</td>
				</tr>
				<tr> 
					<td width="100" class='contenM tabletd_all'>취소 사유</td>
					<td class='contenM tabletd_all'><?=$tools->strHtmlBr($order_stat->refund_remark);?></td>
				</tr>				
				<tr> 
					<td width="100" class='contenM tabletd_all'>취소요청일</td>
					<td class='contenM tabletd_all'><?=$order_stat->refund_start;?></td>
				</tr>
				<tr> 
					<td width="100" class='contenM tabletd_all'>취소승인일</td>
					<td class='contenM tabletd_all'><?=$order_stat->refund_ok;?></td>
				</tr>
				<tr> 
					<td width="100" class='contenM tabletd_all'>환불완료일</td>
					<td class='contenM tabletd_all'><?=$order_stat->refund_end;?></td>
				</tr>				
				<form action="<?=$_SERVER[PHP_SELF];?>" method="post" name="refund_form">
				<input type="hidden" name="trade_idx" value="<?=$trade_idx;?>">
				<tr> 
					<td width="100" class='contenM tabletd_all'>환불계좌</td>
					<td class='contenM tabletd_all'><?=$refund_bank;?></td>
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

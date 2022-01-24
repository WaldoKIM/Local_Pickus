<?include('../../common.php');?>
<!DOCTYPE html>
<html lang="ko">
<head>
<title>『 <?=$shop_link->shop_name;?> 주문상세내역』</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/popup.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/component.css" />
<?

include($ROOT_DIR.'/lib/style_class.php');
$_GET=&$HTTP_GET_VARS; $_POST=&$HTTP_POST_VARS;
$mv_data	= $_GET[trade_data];
$trade_data	= $tools->decode( $_GET[trade_data] );
if($_GET[idx] )	{ $idx = $_GET[idx]; } else { $idx = $trade_data[idx]; }

$trade_stat = $db->object("cs_trade", "where idx=$idx");
?>
</head>
<body marginwidth='0' marginheight='0' topmargin='0' leftmargin='0' bgcolor='#ffffff'>
<table width="630">
	<tr> 
		<td width="1" rowspan="8" bgcolor="BDBEBD"></td>
		<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu"><br>
			<table width="630">
				<tr> 
					<td height="25"><img src="../images/bar_trade_info.gif" width="70" height="17"></td>
				</tr>
			</table>
			<table width="630" class="menu" bordercolor='#BDBEBD' style='border-collapse: collapse'>
				<tr> 
					<td width="100" height="25" align="center" bgcolor="F2F2F2">주문번호</td>
					<td width="215" align="center"><?=$trade_stat->trade_code;?></td>
					<td width="100" align="center" bgcolor="F2F2F2">주문접수일</td>
					<td width="215" align="center"><?=$trade_stat->trade_day;?></td>
				</tr>
					<td width="100" align="center" bgcolor="F2F2F2">회원아이디</td>
					<td width="215" align="center"><? if($trade_stat->order_userid) {?><font color="#FF0000"><?=$trade_stat->order_userid;?></font><?} else {?><font color="#FF9933">비회원</font><?}?></td>
					<td width="100" align="center" bgcolor="F2F2F2">거래상태</td>
					<td align="center" class="menupurple"><? if($trade_stat->trade_stat==1) {?>결제대기중<?} else if($trade_stat->trade_stat==2){?>결제확인됨<?} else if($trade_stat->trade_stat==3){?>배송중<?} else if($trade_stat->trade_stat==4){?>판매완료됨<?} else if($trade_stat->trade_stat==5){?>상품교환중<?} else if($trade_stat->trade_stat==6){?>반품취소됨<?}?></td>
				</tr>
			</table><br>
			<table width="630">
				<tr> 
					<td height="25"><img src="../images/bar_trade_info2.gif" width="70" height="17"></td>
				</tr>
			</table>
			<table width="630" bordercolor='#BDBEBD' style='border-collapse: collapse'>
				<tr align="center" bgcolor="F2F2F2"> 
					<td height="25">제품코드</td>
					<td height="25">제품명</td>
					<td height="25">옵 션</td>
					<td height="25">가 격</td>
					<td height="25">수 량</td>
					<td height="25">구매금액</td>
				</tr>
				<?
				$trade_goods_result=$db->select("cs_trade_goods", "where trade_code='$trade_stat->trade_code' and seller='$_SESSION[USERID]'order by idx asc");
				while( $trade_goods_row=@mysqli_fetch_object( $trade_goods_result)) {
					$my_price+=$trade_goods_row->goods_price*$trade_goods_row->goods_cnt*$trade_goods_row->goods_myprice/100;
				?>
				<tr align="center"> 
					<td height="25"> <?=$trade_goods_row->goods_code;?> </td>
					<td height="25"> <?=$db->stripSlash($trade_goods_row->goods_name);?></td>
					<td height="25">
						<?
						$optArr = explode("/^CUT/^", $trade_goods_row->opt_data);
						for($i=0;$i<count($optArr)-1;$i++){
							$optRec = explode("/^/^", $optArr[$i]);
						?>
						<?=$optRec[0];?>:&nbsp;<?=$optRec[1];?><br>
						<?}?>
					</td>
					<td height="25" align="center"> <?=number_format($trade_goods_row->goods_price);?> 원</td>
					<td height="25"> <?=number_format($trade_goods_row->goods_cnt);?> </td>
					<td height="25"> <?=number_format($trade_goods_row->goods_price*$trade_goods_row->goods_cnt);?> 원</td>
				</tr>
				<?}?>
			</table><br>			

			<table width="630">
				<tr> 
					<td height="25"><img src="../images/bar_trade_info3.gif" width="87" height="17"></td>
				</tr>
			</table> 
			<table width="630" bordercolor='#BDBEBD' style='border-collapse: collapse'>
				<form name="trade_form" method="post" action="trade_view_ok.php?trade_data=<?=$mv_data;?>">
				<tr> 
					<td width='100' height="25" bgcolor="F2F2F2" align="center">고객이름</td>
					<td width="215" height="25"><?=$trade_stat->order_name;?></td>
					<td width='100' height="25" bgcolor="F2F2F2" align="center">전화번호</td>
					<td width="215" height="25"><?=$trade_stat->order_tel1;?>-<?=$trade_stat->order_tel2;?>-<?=$trade_stat->order_tel3;?></td>
				</tr>
				<tr> 
					<td height="25" bgcolor="F2F2F2" align="center">이메일</td>
					<td width="" height="25"><?=$trade_stat->order_email;?></td>
					<td height="25" bgcolor="F2F2F2" align="center">휴대전화</td>
					<td width="" height="25"><?=$trade_stat->order_phone1;?>-<?=$trade_stat->order_phone2;?>-<?=$trade_stat->order_phone3;?></td>
				</tr>
			</table><br>
			<table width="630">
				<tr> 
					<td height="25"><img src="../images/bar_trade_info4.gif" width="86" height="17"></td>
				</tr>
			</table>
			<table width="630" bordercolor='#BDBEBD' style='border-collapse: collapse'>
				<tr> 
					<td width="100" height="25" align="center" bgcolor="F2F2F2">수령자</td>
					<td width="215" height="25"><?=$trade_stat->deliv_name;?></td>
					<td width="100" align="center" bgcolor="F2F2F2">이메일</td>
					<td width="215"><?=$trade_stat->deliv_email;?></td>
				</tr>
				<tr> 
					<td height="25" align="center" bgcolor="F2F2F2">전 화</td>
					<td width="215" height="25"><?=$trade_stat->deliv_tel1;?>-<?=$trade_stat->deliv_tel2;?>-<?=$trade_stat->deliv_tel3;?></td>
					<td align="center" bgcolor="F2F2F2">핸드폰</td>
					<td width="215"><?=$trade_stat->deliv_phone1;?>-<?=$trade_stat->deliv_phone2;?>-<?=$trade_stat->deliv_phone3;?></td>
				</tr>
				<tr> 
					<td height="25" align="center" bgcolor="F2F2F2">주 소</td>
					<td height="25" colspan="3">
					(<?=$trade_stat->deliv_zip;?>) &nbsp;<?=$trade_stat->deliv_add1;?>&nbsp;<?=$trade_stat->deliv_add2;?>
					</td>
				</tr>
				<tr>
					<td height="25" align="center" bgcolor="F2F2F2">주문시 요청사항</td>
					<td height="25" colspan="3"><?=$db->stripSlash($trade_stat->deliv_content);?></td>
				</tr>
				<tr>
					<td height="25" align="center" bgcolor="F2F2F2">배송예약일</td>
					<td height="25" colspan="3">
						<? if($trade_stat->deliv_pree_day!='0000-00-00 00:00:00') {$year=substr($trade_stat->deliv_pree_day,0,4);?>
						<? for($i=date("Y")-3;$i<date("Y")+3;$i++){	$today_year=date("Y", $trade_stat->deliv_pree_day);?>
						<?if($i==$year){?><?=$i?><?}}?>&nbsp;년&nbsp;&nbsp;
						<?for($i=1;$i<13;$i++){if(strlen($i)==1)$i="0".$i; $mon=substr($trade_stat->deliv_pree_day,5,2);?>
						<?if($i==$mon){?><?=$i?><?}}?></select>&nbsp;월&nbsp;&nbsp;
						<?for($i=1;$i<32;$i++){if(strlen($i)==1)$i="0".$i; $day=substr($trade_stat->deliv_pree_day,8,2);?>
						<?if($i==$day){?><?=$i?><?}}?>&nbsp;일<?} else {?> 예약 배송일 없음<?}?></td>
				</tr>
				<tr>
					<td height="25" align="center" bgcolor="F2F2F2">배송장번호</td>
					<td height="25" colspan="3"><?=$trade_stat->trade_number;?></td>
				</tr>
			</table><br>
			<table width="630">
				<tr> 
					<td height="25"><img src="../images/bar_trade_info5.gif" width="74" height="17"></td>
				</tr>
			</table>
			<table width="630" bordercolor='#BDBEBD' style='border-collapse: collapse'>
				<tr> 
					<td width="100" align="center" bgcolor="F2F2F2">결제 확인일</td>
					<td width="100"><? if($trade_stat->trade_money_ok !='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_stat->trade_money_ok, 5);?><?} else {?><? if($trade_stat->trade_stat==1) {?>결제대기중<?} else if($trade_stat->trade_stat==2){?>결제확인됨<?} else if($trade_stat->trade_stat==3){?>배송중<?} else if($trade_stat->trade_stat==4){?>판매완료됨<?} else if($trade_stat->trade_stat==5){?>상품교환중<?} else if($trade_stat->trade_stat==6){?>반품취소됨<?}?><?}?></td>
					<td height="25" align="center" bgcolor="F2F2F2">상품 발송일</td>
					<td width="100" height="25"><? if($trade_stat->trade_start_day !='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_stat->trade_start_day, 5);?><?} else {?><? if($trade_stat->trade_stat==1) {?>결제대기중<?} else if($trade_stat->trade_stat==2){?>결제확인됨<?} else if($trade_stat->trade_stat==3){?>배송중<?} else if($trade_stat->trade_stat==4){?>판매완료됨<?}?><?}?></td>
					<td align="center" bgcolor="F2F2F2">판매 완료일</td>
					<td width="100"><? if($trade_stat->trade_end_day !='0000-00-00 00:00:00') {?><?=$tools->strDateCut($trade_stat->trade_end_day, 5);?><?} else {?><? if($trade_stat->trade_stat==1) {?>결제대기중<?} else if($trade_stat->trade_stat==2){?>결제확인됨<?} else if($trade_stat->trade_stat==3){?>배송중<?} else if($trade_stat->trade_stat==4){?>판매완료됨<?} else if($trade_stat->trade_stat==5){?>상품교환중<?} else if($trade_stat->trade_stat==6){?>반품취소됨<?}?><?}?></td>
				</tr>
			</table><br>
			<a href="trade.php?trade_data=<?=$mv_data;?>"><a href="javascript:print();"><img src="../images/bt_print.gif" border="0"></a>&nbsp;&nbsp;<a href="javascript:parent.$.RiModal.get('self').close();"><img src="../images/bt_close.gif" border="0"></a><br><br>
		</td>
		<td width="1" rowspan="8" bgcolor="BDBEBD"></td>
	</tr>
</table>

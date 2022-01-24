<?
	include('../common.php');
	$admin_stat = $db->object("cs_admin", "");
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>포인트조회</title>
</head>
<link rel="stylesheet" type="text/css" href="css/popup.css">
<link rel="stylesheet" type="text/css" media="all" href="css/joinform_layout.css" media="screen and (max-width:980px)">
<link rel="stylesheet" type="text/css" media="all" href="css/joinform_style.css">
<body style='padding:2em;'>
<table width="100%">
	<tr>
		<td style="padding-right:10px;" class="pagemap_title"> 포인트 조회</td>
	</tr>
</table>
<table width="98%">
	<tr>
		<td style=''>
			<hr />
			포인트가 <font color="#FF0000"><?=number_format($admin_stat->point_use);?>점</font>이상일때 사용이 가능합니다.
			현재 고객님의 포인트는 Total : <font color="#FF0000">	<? $total_point = $db->sum("cs_point", "where userid='$_SESSION[USERID]'", "point"); echo(number_format($total_point));?>점</font> 입니다.
			<hr />
		</td>
	</tr>
	<tr>
		<td>
			<table style='width:100%;text-align:center;'>
				<tr class='bar_button_review'>
					<td height="35" class="bbs2">거래내역정보</td>
					<td height="35" width="20%" class="bbs2">포인트</td>
					<td height="35" width="20%" class="bbs2">거래일</td>
				</tr>
				<?
					$result	= $db->select("cs_point", "where userid='$_SESSION[USERID]' order by idx desc" );
					while( $row = mysqli_fetch_object($result)) {
				?>
				<tr style='border-bottom: 1px solid rgba(0,0,0,0.1);'>
					<td height="35"><?=$row->title;?></td>
					<td height="35"><?=number_format($row->point);?></td>
					<td height="35"><?=$tools->strDateCut($row->register, 1);?></td>
				</tr>
				<? }?>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
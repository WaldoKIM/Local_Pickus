<? include('../common.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>회원이용약관</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="codeshop.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%">
	<tr>
		<td>
		<?
		$row = $db->object("cs_admin", "", "agreement_tag, agreement");
		echo $row->agreement;
		?>
		</td>
	</tr>
</table>
</body>
</html>
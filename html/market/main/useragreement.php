<? include('../common.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>개인정보취급방침</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="codeshop.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%">
	<tr>
		<td class="menu">
		<?
		$pageview_stat = $db->object("cs_page", "where page_index='safeguard'");
		echo $pageview_stat->content;
		?>
		</td>
	</tr>
</table>
</body>
</html>
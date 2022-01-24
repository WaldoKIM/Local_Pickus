<?
include('../../common.php'); 
?>

<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/admin_iframe_style.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" class="table_all"> 
	<tr align="center" bgcolor="E4E7EF"> 
		<td height="25" class='contenM tabletd_all'>우편번호</td>
		<td height="25" class='contenM tabletd_all'>설명</td>
		<td height="25" class='contenM tabletd_all'>삭제</td>
	</tr>
	<?
	$table				= "cs_zip_over";
	$notice_result		= $db->select( $table, "order by idx desc" );
	$i=1;
	while( $row = mysqli_fetch_object($notice_result) ) {
	?>
	<tr> 
		<td height="35" class='tabletd_all tabletd_Lmall'><?=$row->zip?></td>
		<td height="35" class='tabletd_all tabletd_Lmall'><?=$row->content?></td>
		<td height="35" class='tabletd_all tabletd_Lmall'><a href="overexpress_ok.php?del=1&idx=<?=$row->idx?>" class='search_bbs1'>삭제</a></td>
	</tr>
	<?
	$i++;
	}
	?>
</table>
</body>
</html>

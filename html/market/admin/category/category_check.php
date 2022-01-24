<?
	//$_GET=&$HTTP_GET_VARS;

	if( $_GET[part_index] == 1 ) {
		echo "<meta http-equiv='refresh' content='0;url=category_edit1.php?idx=$_GET[idx]&part_index=$_GET[part_index]'>";
	} else if( $_GET[part_index] == 2 ) {
		echo "<meta http-equiv='refresh' content='0;url=category_edit2.php?idx=$_GET[idx]&part_index=$_GET[part_index]'>";
	} else if( $_GET[part_index] == 3 ) {
		echo "<meta http-equiv='refresh' content='0;url=category_edit3.php?idx=$_GET[idx]&part_index=$_GET[part_index]'>";
	} else {
		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
	}
?>

<?php
include_once("./_common.php");

$sql = " select area1 from {$g5['estimate_area1']} order by idx ";

$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++){
	echo '<option value="'.$row['area1'].'">'.$row['area1'].'</option>';
}

?>
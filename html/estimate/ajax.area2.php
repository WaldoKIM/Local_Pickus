<?php
include_once("./_common.php");

$sql = " select area2 from {$g5['estimate_area2']} where area1='$area1' order by idx ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++){
	echo '<option value="'.$row['area2'].'">'.$row['area2'].'</option>';
} 
?>
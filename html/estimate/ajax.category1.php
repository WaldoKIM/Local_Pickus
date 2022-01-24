<?php
include_once("./_common.php");

$sql = " select * from g5_estimate_category1 order by idx ";

$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++){
	echo '<option value="'.$row['category1'].'">'.$row['category1'].'</option>';
}

?>
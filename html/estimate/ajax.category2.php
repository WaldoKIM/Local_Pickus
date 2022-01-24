<?php
include_once("./_common.php");

$sql = " select * from g5_estimate_category2 where category1='$category1' order by idx ";

$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++){
	echo '<option value="'.$row['category2'].'">'.$row['category2'].'</option>';
}

?>
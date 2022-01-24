<?php
include_once("./_common.php");

$sql = " select * from g5_estimate_category3 where category1='$category1' and category2='$category2' order by idx ";

$result = sql_query($sql);
echo $sql;
for ($i=0; $row=sql_fetch_array($result); $i++){
	echo '<option value="'.$row['category3'].'">'.$row['category3'].'</option>';
}

?>
<?php
include_once('./_common.php');

$test = var_dump($_REQUEST);

echo $test;

$sql_delete = "DELETE FROM g5_estimate_list_photo_match WHERE no_estimate = '$no_estimate'"; 
sql_query($sql_delete);

for($i=0; $i<count($test1); $i++){

	$photo_n1 = $test1[$i];

	$photo_n2 = 15;

	$photo_n3 = substr($photo_n1,$photo_n2);

//	$sql_photo = "insert into g5_estimate_list_photo_match (no_estimate, rc_email, photo, photo_rotate, writetime) value('$no_estimate', '$rc_email', '$photo_n3', '', now())";
//	$sql_photo = "insert into g5_estimate_list_photo_match (no_estimate,rc_email, photo) value('$no_estimate','$rc_email', '$photo_n3')";
	$sql_photo = "insert into g5_estimate_list_photo_match (no_estimate,rc_email, photo, photo_rotate, writetime) value('$no_estimate','$rc_email', '$photo_n3', '',now())";
	sql_query($sql_photo);

	//$sql_photo = "update g5_estimate_list_photo_match set rc_email = '$rc_email' where od_id = '$no_estimate'";			
	//sql_query($sql_photo);
}

?>
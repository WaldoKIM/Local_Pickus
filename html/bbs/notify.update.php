<?php
include_once('./_common.php');
// with KJS dance
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = " update {$g5['notify_table'] } set read_gb = '1' where idx = '$idx' ";

sql_query($sql);


if($category == 'p11'){ // 수거/철거 취소하면 링크 진입못하기에

	$url = G5_URL."/bbs/notify.php";

}else if($idx != 0){
	if($category == 'cm1' || $category == 'cm2' || $category == 'cm3' || $category == 'cm4' || $category == 'cm5' || $category == 'cm6' || $category == 'cm7' || $category == 'cm8' || $category == 'cm9' || $category == 'cm10'){
		$url = G5_URL."/estimate/my_estimate_form_match_sa.php?no_estimate=".$estimate_idx;
	}else{
		if($noti_type == "11"){
			$url = G5_URL."/estimate/my_estimate_form.php?idx=".$estimate_idx;
		}else if($noti_type == "12"){
			$url = G5_URL."/estimate/my_estimate_form.php?idx=".$estimate_idx;
		}else if($noti_type == "13"){
			$url = G5_URL."/estimate/my_estimate_form.php?idx=".$estimate_idx;
		}else if($noti_type == "14"){
			$url = G5_URL."/estimate/my_estimate_form.php?idx=".$estimate_idx;
		}else if($noti_type == "15"){
			$url = G5_URL."/estimate/my_estimate_form.php?idx=".$estimate_idx;
		}else if($noti_type == "21"){
			$url = G5_URL."/estimate/estimate_list2.php";
		}else if($noti_type == "22"){
			$url = G5_URL."/estimate/partner_estimate_form.php?idx=".$estimate_idx;
		}else if($noti_type == "23"){
			$url = G5_URL."/estimate/partner_estimate_form.php?idx=".$estimate_idx;
		}else if($noti_type == "24"){
			$url = G5_URL."/estimate/partner_estimate_form.php?idx=".$estimate_idx;
		}else if($noti_type == "25"){
			$url = G5_URL."/estimate/partner_estimate_form.php?idx=".$estimate_idx;
		}else if($noti_type == "26"){
			$url = G5_URL."/estimate/partner_estimate_form.php?idx=".$estimate_idx;
		}
	}

} 


goto_url($url);

?>
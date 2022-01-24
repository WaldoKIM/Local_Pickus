<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$sql = " select a.price as price_client, a.*, b.*, c.*, d.*  from
			{$g5['estimate_match']} a
			left join {$g5['estimate_match_propose']} b  on a.no_estimate = b.no_estimate and b.rc_email = '{$member['mb_email']}' 
			left join {$g5['estimate_match_propose_detail']} c on a.no_estimate = c.no_estimate and c.rc_email = '{$member['mb_email']}' 
			left join (
				select no_estimate, count(*) as cnt from {$g5['estimate_match_propose']} group by no_estimate
			) d on a.no_estimate = d.no_estimate				
		where
			a.no_estimate =  '$no_estimate'	 ";
$master = sql_fetch($sql);

$sql = " 		select
					* 
				from 
					{$g5['estimate_match_propose']} a
					join {$g5['estimate_match']} b on a.no_estimate = b.no_estimate
				where 
					a.no_estimate = '$no_estimate'
					and ifnull(a.review,'') !=  '' ";

$propose_review = sql_fetch($sql);

$sql_info = "select * from g5_estimate_match_propose_detail where 
			no_estimate = '$no_estimate' and
	    	rc_email = '{$member['mb_email']}'";

$propose_detail = sql_fetch($sql_info);

$sql_match = "select *
				from
					g5_estimate_match_info a
				where
					a.no_estimate = '$no_estimate'";
$info = sql_query($sql_match);

$state    = $master['state'];
$selected = $master['selected'];
$req_pay = $master['req_payment'];

if($state == "3" && $master['remain_amt'] > 0){
	include_once('./partner_estimate_form_not_point.skin.php');
}else{
	include_once('./partner_estimate_match_form.skin.php');
}

?> 
<?php

include_once('./_tail.php');
?>
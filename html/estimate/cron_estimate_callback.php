<?php
	include_once("./_common.php");

	$timestamp1 = strtotime("-7 days");
	$search_date1 = date('Y-m-d', $timestamp1);

	$timestamp2 = strtotime("-1 days");
	$search_date2 = date('Y-m-d', $timestamp2);

	$timestamp3 = strtotime("+1 days");
	$search_date3 = date('Y-m-d', $timestamp3);

	$sql = "select * from g5_estimate_propose where completetime = '".$search_date3."'";
	$info5 = sql_query($sql);

	for ($i=0; $row_info=sql_fetch_array($info5); $i++) {
		$sqluser = " select * from g5_member where mb_email = '$row_info['rc_email']' ";
		$user = sql_fetch($sqluser);

		$sqlinfo = "select * from g5_estimate_list where idx = '$row_info[estimate_idx]";
		$idxinfo = sql_query($sqlinfo);

		$idxtitle = $idxinfo['title'];
		$end_date = $row_info['completetime'];
		$phone = $user['mb_hp'];
		$rc = $user['rc_email'];

		echo $row_info['no']." ".$end_date."<br />";

		insert_notify($row_info['rc_email'], '11',$idxtitle.' 수거 예정일이 지났습니다. 수거완료 및 수거취소를 확정해 주세요.','',$row_info['no_estimate'], '','es0');
		
		kakaotalk_send($user['mb_hp'], 'SJT_066087',  $idxtitle);
//		
	}


	$sql = "select * from g5_estimate_match where date_close = '".$search_date1."'";
	$info1 = sql_query($sql);

	for ($i=0; $row_info=sql_fetch_array($info1); $i++) {
		$end_date = $row_info['date_close'];

		echo $row_info['no']." ".$end_date."<br />";

		insert_notify($row_info['email'], '11',$row_info['title'].' 견적 유효기간이 곧 만료되어 취소가 됩니다. 진행을 원할 시 업체를 선택해 주세요.','',$row_info['no_estimate'], '','cm11');

//		kakaotalk_send($user['mb_hp'], 'SJT_059836',  $list['title'].'|'.$estimate['name'].'|'.$saletitle.'|'.$price_last.'원');    //match_propose에 고객이름이 없을 수 있을까봐 
	}

	$sql = "select * from g5_estimate_match where date_close = '".$search_date2."'";
	$info2 = sql_query($sql);	

	for ($i=0; $row_info=sql_fetch_array($info2); $i++) {
		$end_date = $row_info['date_close'];

		echo $row_info['no']." ".$end_date."<br />";

		insert_notify($row_info['email'], '11',$row_info['title'].' 견적이 마감되었습니다. 진행 원할 시 업체를 선택해 주세요.','',$row_info['no_estimate'], '','cm4');

//		kakaotalk_send($user['mb_hp'], 'SJT_059836',  $list['title'].'|'.$estimate['name'].'|'.$saletitle.'|'.$price_last.'원');    //match_propose에 고객이름이 없을 수 있을까봐 
	}

	$sql = " select * from g5_estimate_match_propose where completetime = '".$search_date2."'";
    $info3 = sql_query($sql);

	for ($i=0; $row_info=sql_fetch_array($info3); $i++) {
		$end_date = $row_info['completetime'];

		echo $row_info['no']." ".$end_date."<br />";

		insert_notify($row_info['email'], '11',$row_info['content'].' 배송 전날 알림 드립니다.','',$row_info['no_estimate'], '','p7');

//		kakaotalk_send($user['mb_hp'], 'SJT_059836',  $list['title'].'|'.$estimate['name'].'|'.$saletitle.'|'.$price_last.'원');    //match_propose에 고객이름이 없을 수 있을까봐 
	}

	//echo var_dump($info);

	$sql = " select * from g5_estimate_propose where meet_date = '".$search_date2."' and meet = '1' and meet_confirm = '1' ";
    $info4 = sql_query($sql);

	for ($i=0; $row_info=sql_fetch_array($info4); $i++) {
		$end_date = $row_info['meet_date'];

		echo $row_info['idx']." ".$end_date."<br />";

		$estimate_idx = $row_info['estimate_idx'];
		$email = $row_info['email'];

		//echo $estimate_idx;
		//echo $email;

		$sql = " select * from g5_estimate_list where idx = '".$estimate_idx."' and email = '".$email."' ";
		$meet = sql_fetch($sql);
		
		//echo $meet['title'];
		
		insert_notify($meet['email'], '11',$meet['title'].' 방문진행 후 견적 부탁드립니다.','',$meet['idx'], '','p10');

//		kakaotalk_send($user['mb_hp'], 'SJT_059836',  $meet['title'].'|'.$estimate['name'].'|'.$saletitle.'|'.$price_last.'원');    //match_propose에 고객이름이 없을 수 있을까봐 
	}
?>
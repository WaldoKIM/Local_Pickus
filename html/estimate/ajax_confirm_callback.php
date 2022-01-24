<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/iamport.php");
	include_once("/var/www/html/bbs/_common.php");
	error_reporting( E_ALL );ini_set( "display_errors", 1 );

	$iamport = new Iamport('8390891052477507', 'UGu5oaPfxMkqKruiHY4ru7bSyajamDFgjalIlbYSYjjIKN1rM5Tgd49LesWA5BRpLd87p60oqj7a78CT');

	$sql = " select * from g5_shop_order where od_shop_memo = 'ready' and od_settle_case = '가상계좌'";
	$result = sql_query($sql);
	while ($row=sql_fetch_array($result)) {
		$imp_uid =  $row['od_tno'];

		$no_estimate =  $row['od_id'];
		$email =  $row['mb_id'];

		//imp_uid 로 주문정보 찾기(아임포트에서 생성된 거래고유번호)
		$result = $iamport->findByImpUID($imp_uid); //IamportResult 를 반환(success, data, error)

		
		if($result->data->status === 'paid'){
			$sql_match = "update g5_shop_order set od_misu = '0' where od_tno = '$imp_uid'";
				
			sql_query($sql_match);

			$sql_match = "update g5_shop_order set od_receipt_price = '0' where od_tno = '$imp_uid'";
				
			sql_query($sql_match);

			$sql_match = "update g5_shop_order set od_shop_memo = 'paid' where od_tno = '$imp_uid'";
				
			sql_query($sql_match);

			$sql_match = "update g5_shop_order set od_status = '완료' where od_tno = '$imp_uid'";
				
			sql_query($sql_match);

			$now = date('Y-m-d');
			$sql = "update g5_estimate_match set pay_confirm = 1, state = 8, pay_date = '$now' WHERE no_estimate = $no_estimate ";
			sql_query($sql);

			$sql = "select * from g5_estimate_match where no_estimate = '$no_estimate'";
			$list = sql_fetch($sql);
			$sql = "select * from g5_estimate_match_propose where no_estimate = '$no_estimate'";
			$propose = sql_fetch($sql);

			$saletitle = "판매매칭";
			$sql = "select mb_hp from g5_member where mb_email = '{$propose['rc_email']}'";
			$member = sql_fetch($sql);

			$sql = "select * from g5_estimate_match_propose_detail where no_estimate = '$no_estimate'";
			$propose_detail = sql_fetch($sql);

			$list_item = array($propose_detail['item0'], $propose_detail['item1'], $propose_detail['item2'], $propose_detail['item3'], $propose_detail['item4'], $propose_detail['item5'], $propose_detail['item6'], $propose_detail['item7'], $propose_detail['item8'], $propose_detail['item9'], $propose_detail['item10']);
			$list_item = array_values(array_filter(array_map('trim',$list_item)));
			$list_item = implode( ',', $list_item );
			
			$price_last = $propose_detail['amt0'] + $propose_detail['amt1'] + $propose_detail['amt2'] + $propose_detail['amt3'] + $propose_detail['amt4'] + $propose_detail['amt5'] + $propose_detail['amt6'] + $propose_detail['amt7'] + $propose_detail['amt8'] + $propose_detail['amt9'] + $propose_detail['amt10'] + $propose['shipping'];

			kakaotalk_send($list['number'], 'SJT_058642', $list['title'].'|'.$propose['rc_nickname'].'|'.$list_item.'|'.$propose['shipping'].'|'.$as.'|'.$price_last);  //결제완료후 고객에게 날림

			kakaotalk_send($member['mb_hp'], 'SJT_059837', $list['title'].'|'.$list['name'].'|'.$saletitle.'|'.$price_last);  //결제완료후 업체에게 날림
			
			insert_notify($list['email'], '8', $propose['rc_nickname'].' 물품이 결제 되었습니다.업체서 고객님게 곧 연락드려 배송이 진행 됩니다.','',$no_estimate, '','cm8'); //고객 노티

			insert_notify($list['rc_email'], '4', '(판매) '.$list['title'].' 물품이 결제 되었습니다.업체서 고객님게 곧 연락드려 배송이 진행 됩니다.','',$no_estimate, '','p4'); //고객 노티
			
		}

		//echo $row['od_shop_memo'];
		//print_r($row);
	}
        
//$sql = "insert into g5_member_token set mb_email = 'aaa@aaa.com', token = 'aaaaa'";
//sql_query($sql, false);

?>
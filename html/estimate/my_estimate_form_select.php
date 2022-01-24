<?php
include_once('./_common.php');

$sql = " select a.* from {$g5['estimate_propose']} a where a.idx = '$sub_idx' ";
$propose = sql_fetch($sql);

$sql = " select * from {$g5['member_table']} where mb_email = '{$propose['rc_email']}' ";
$user = sql_fetch($sql);

if($_POST['mb_bank']){
	
	if($_POST['mb_bank'] == ''){
    	$mb_bank = $_POST['mb_bank_txt'];
	}else{
	    $mb_bank = $_POST['mb_bank'];
	}

	$mb_bank_num = $_POST['mb_bank_num'];
	$sql = " update {$g5['member_table']} set mb_bank = '{$mb_bank}',
                     mb_bank_num = '{$mb_bank_num}', mb_bank_name = '{$mb_bank_name}' where mb_email = '{$member['mb_email']}' ";
	sql_query($sql);
}



$sql = " update {$g5['estimate_propose']} set selected = '1', charge_rate = '{$user['mb_biz_charge_rate']}', charge_amt = round(price/100*{$user['mb_biz_charge_rate']},0) where idx = '$sub_idx' ";
sql_query($sql);

$sql = " update {$g5['estimate_propose']} set requesttime = '$requesttime' where idx = '$sub_idx' ";
sql_query($sql);

$sql = " select
			a.idx,
			a.estimate_idx,
			a.rc_email,
			a.rc_nickname,
			a.email,
			a.nickname,
			a.price,
			a.price_minus,
			a.charge_rate,
			a.charge_amt,
			a.remain_amt,
			a.selected,
			a.proposetime,
			b.title,
			b.e_type,
                        b.phone
		from 
			{$g5['estimate_propose']} a
			join {$g5['estimate_list']} b on a.estimate_idx = b.idx
		where
			a.idx = '$sub_idx' ";
$propose = sql_fetch($sql);

/*$userPoint = $user['mb_point'];
$chargePoint = $propose['charge_amt'];
if($userPoint > $chargePoint){
	$calcPoint = $chargePoint;
	$remainPoint = 0;
}else{
	$calcPoint = $userPoint;
	$remainPoint = $chargePoint - $userPoint;
}*/

//포인트를 정리한다.
/*if($calcPoint > 0)
{
	insert_point($propose['rc_email'], $calcPoint*-1, G5_TIME_YMD.'포인트 사용', '@estimate', $sub_idx, G5_TIME_YMD);
}*/
$sql = " update {$g5['estimate_propose']} set remain_amt = '$remainPoint' where idx = '$sub_idx' ";
sql_query($sql);

$sql = " update {$g5['estimate_list']} set state = '3', selecttime = DATE(now()) where idx = '$idx' ";
sql_query($sql);

$sql ="select * from {$g5['estimate_list']} where idx = '$idx' ";
$list = sql_fetch($sql);

insert_notify($list['email'], '11', $propose['rc_nickname'].'가 선택 되었습니다.','',$idx, '','cp6');

insert_notify($propose['rc_email'], '22', $propose['title'].' 견적 선택 되었습니다.','',$idx, '','p3');

//$saletitle = "판매매칭";
//kakaotalk_send($user['mb_hp'], 'SJT_059837', $propose['title'] .'|'. $propose['nickname'] .'|'. $saletitle .'|'. $propose['price'].'원' );   //고객이 업체 선택 시 -> 업체발송 (구매매칭)


$sql = "select * from {$g5['estimate_list']} where idx = '$idx'";
$master = sql_fetch($sql);

if($propose['price'] > 0 && $propose['price_minus'] == 0){
	kakaotalk_send($user['mb_hp'], 'SJT_058645',  $propose['title'].'|'.$propose['nickname'] .'|'. get_etype($propose['e_type']) .'| 매입 '.  $propose['price'] . '원 보상' );
	echo '<p>W : '.$propose['price_minus'].'</p>';

}else if($propose['price_minus'] > 0 && $propose['price'] == 0 ){
	kakaotalk_send($user['mb_hp'], 'SJT_058645',  $propose['title'].'|'.$propose['nickname'] .'|'. get_etype($propose['e_type']) .'| 폐기 ' . $propose['price_minus'] . '원 결제' );
}else if($propose['price_minus'] == 0 && $propose['price'] == 0) {
	kakaotalk_send($user['mb_hp'], 'SJT_058645',  $propose['title'].'|'.$propose['nickname'] .'|'. get_etype($propose['e_type']) .'| 무료수거' );
}else{
	kakaotalk_send($user['mb_hp'], 'SJT_058645',  $propose['title'].'|'.$propose['nickname'] .'|'. get_etype($propose['e_type']) .'| 매입 '.  $propose['price'] . '원 보상, ' . '폐기 ' . $propose['price_minus'] . '원 결제' );

}

$msg =  $propose['title'].' 가 선택 되었습니다. 업체서 고객님께 곧 연락드릴 예정 입니다.';

alert("선택 완료했습니다. 곧 연락예정입니다.","./my_estimate_form.php?idx=$idx&&page=$page");
?>

<script>
	$(document).ready(function(){
		$.ajax({
			url : "ajax_do_fcm.php",
			type : "post",
			dataType : "json",
			data : 
			{
				message : <?php echo($msg); ?>
			},
			error:function(request,status,error){
				alert("code = "+ request.status + 
					" message = " + request.responseText + 
					" error = " + error); // 실패 시 처리
			},

		}).done(function(data) {
			if(data.ret == true){
				//alert(data.msg);
			}else{
				//alert(data.msg);
			}
		});
	})
</script>

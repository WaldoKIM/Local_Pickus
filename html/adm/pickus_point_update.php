<?php
$sub_menu = "200200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$mb_id = strip_tags($_POST['mb_id']);
$po_point = strip_tags($_POST['po_point']);
$po_content = strip_tags($_POST['po_content']);
$expire = preg_replace('/[^0-9]/', '', $_POST['po_expire_term']);

$mb = get_member($mb_id);

if (!$mb['mb_id'])
    alert('존재하는 회원아이디가 아닙니다.', './pickus_point_list.php?'.$qstr);

if (($po_point < 0) && ($po_point * (-1) > $mb['mb_point']))
    alert('포인트를 깎는 경우 현재 포인트보다 작으면 안됩니다.', './pickus_point_list.php?'.$qstr);

insert_point($mb_id, $po_point, $po_content, '@passive', $mb_id, $member['mb_id'].'-'.uniqid(''), $expire);
if($po_point > 0)
{
	$sql = " select * from {$g5['estimate_propose']} where selected = 1 and remain_amt > 0 and rc_email = '$mb_id' ";
	$result = sql_query($sql);
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$user_point = get_point_sum($mb_id);
		
		if(!$user_point) break;

		$remain_amt = $row['remain_amt'];
		if($user_point > $remain_amt){
			$sql = " update {$g5['estimate_propose']} set remain_amt = 0 where idx = '{$row['idx']}' ";
			sql_query($sql);
			insert_point($propose['rc_email'], $remain_amt*-1, G5_TIME_YMD.'포인트 사용', '@estimate', $row['estimate_idx'], G5_TIME_YMD);
		}else{
			$calc_amt = $remain_amt - $user_point;
			$sql = " update {$g5['estimate_propose']} set remain_amt = '$calc_amt' where idx = '{$row['idx']}' ";
			sql_query($sql);
			insert_point($propose['rc_email'], $user_point*-1, G5_TIME_YMD.'포인트 사용', '@estimate', $row['estimate_idx'], G5_TIME_YMD);
		}
	}
	

}

goto_url('./pickus_point_list.php?'.$qstr);
?>

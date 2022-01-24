<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$sql = " select
			a.idx,
			ifnull(b.idx,0) as sub_idx,
			a.sub_key,
			a.email,
			a.nickname,
			concat(substr(a.nickname,1,1),'**') as nickname1,
			a.title,
			concat('<p>',replace(a.content,'\n','</p><p>'),'</p>') as content,
			case when ifnull(a.phone,'') = '' then '-' else a.phone end as phone,
			a.item_cat,
			a.item_cat_dtl,
			a.manufacturer,
			a.floor,
			a.elevator_yn,
			a.pickup_date,
			a.medel_name,
			a.year,
			a.use_year,
			a.goods_state,
			a.item_qty,
			a.area_total,
			a.area1,
			a.area2,
			a.area3,
			a.photo1, 
			a.photo2,
			a.photo3,
			a.photo4,
			a.photo5,
			a.photo6,
			a.photo7,
			a.photo8,
			a.photo9,	
			a.photo1_rotate, 
			a.photo2_rotate,
			a.photo3_rotate,
			a.photo4_rotate,
			a.photo5_rotate,
			a.photo6_rotate,
			a.photo7_rotate,
			a.photo8_rotate,
			a.photo9_rotate,			
			a.state,
			a.e_type,
			a.simple_yn,
			a.writetime,
			a.deadline,
			a.pull_kind,
			a.pull_kind_etc,
			a.pull_floor_bottom,
			a.test_type,			
			b.price,
			b.price_minus,
			b.charge_rate,
			b.charge_amt,
			b.remain_amt,	
			a.attach_file,
			b.attach_file as attach_file1,		
			ifnull(b.selected,'0') as selected,
			b.meet,
			b.meet_confirm,
			b.free,
			b.rc_email,
			date_format(ifnull(b.requesttime, ''), '%Y-%m-%d') as requesttime,
			date_format(ifnull(b.completetime,''), '%Y-%m-%d') as completetime,
			date_format(now(),'%Y-%m-%d') as completedate,
			d.*
		from
			{$g5['estimate_list']} a
			left join {$g5['estimate_propose']} b  on a.idx = b.estimate_idx and b.rc_email = '{$member['mb_email']}' 
			left join {$g5['estimate_propose_detail']} c on a.idx = c.estimate_idx and c.rc_email = '{$member['mb_email']}' 
			left join (
				select estimate_idx, count(*) as cnt from {$g5['estimate_propose']} group by estimate_idx
			) d on a.idx = d.estimate_idx
					
		where
			a.idx =  '$idx'	 ";
$master = sql_fetch($sql);

$sql = "select * from g5_member a
		left join {$g5['estimate_list']} b on a.mb_email = b.email where a.mb_email = '{$master['email']}'";
$cli_info = sql_fetch($sql);

$sql = "select * from g5_member where mb_email = '{$member['mb_email']}'";
$cli_biz_info = sql_fetch($sql);

if ($master['sub_key'] != '0') {
	$sql = " select count(*) as cnt from {$g5['estimate_list_multi']} where sub_key = '{$master['sub_key']}'  ";
	$detail_cnt = sql_fetch($sql);
	$detailCnt = $detail_cnt['cnt'];
	$sql = " select * from {$g5['estimate_list_multi']} where sub_key = '{$master['sub_key']}'  ";
	if ($detail_cnt['cnt'] == 1 && $master['e_type'] == "2") {
		$detail = sql_fetch($sql);
	} else {
		$detail = sql_query($sql);
	}
}

$sql = "select * from g5_estimate_propose where selected = '1' AND estimate_idx = '$idx'";
$success = sql_fetch($sql);

$sql = " 		select
					a.idx,
					a.estimate_idx,
					a.photo1,
					b.photo1_rotate,
					b.e_type,
					b.item_cat,
					concat(substr(a.nickname,1,1),'**') AS nickname,
					b.area1,
					b.area2,
					a.score,
					b.goods_state,
					case when length(b.title) <= 20 then b.title else concat(substr(b.title,1,10),'...') end as title,
					a.review,
					date_format(a.updatetime,'%y.%m.%d') as updatetime,
					date_format(a.completetime,'%y.%m.%d') as completetime,
					case when ifnull(a.review,'') !=  ''  then 'Y' else 'N' end as review_yn
				from 
					{$g5['estimate_propose']} a
					join {$g5['estimate_list']} b on a.estimate_idx = b.idx
				where 
					a.estimate_idx = '$idx'
					and ifnull(a.review,'') !=  '' ";

$propose_review = sql_fetch($sql);


$state    = $master['state'];
$e_type   = $master['e_type'];
$selected = $master['selected'];
$pickdate = $master['pickup_date'];
$title = $master['title'];
if ($state == "3" && $master['remain_amt'] > 0) {
	include_once('./partner_estimate_form_not_point.skin.php');
} else {
	include_once('./partner_estimate_form.skin.php');
}

?>

<?php
$sql = " select * from {$g5['member_table']} where mb_email = '{$master['rc_email']}' ";
$user = sql_fetch($sql);
?>


<!--알림톡미 수거완료,수거취소 확정 알림-->
<!-- <?php
		$now = date('Y-m-d');
		$today = date('H:i:s');
		$phone = $user['mb_hp'];
		$rc = $master['rc_email'];
		$sendday = floor(intval(strtotime($pickdate) - strtotime($now)) / 86400);

		if ($today == '10:11:00' && $master['selected'] == '1' && $master['completetime'] == null && $sendday == '-2') {
			kakaotalk_send($user['mb_hp'], 'SJT_066087',  $title);
		}
		?> -->
<!--알림톡미 끝-->

<?php
include_once('./_tail.php');
?>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql_common  = " from ";
$sql_common .= " 	{$g5['estimate_list']} a ";
$sql_common .= " 	join {$g5['estimate_propose']} b on a.idx = b.estimate_idx and b.rc_email = '{$member['mb_email']}' and b.selected = '0' ";
$sql_common .= " 	left join ( ";
$sql_common .= " 		select estimate_idx, count(*) as cnt from {$g5['estimate_propose']} group by estimate_idx ";
$sql_common .= " 	) c on a.idx = c.estimate_idx ";
$sql_common .= " where ";
$sql_common .= " 	a.state in ('0', '1') AND a.deadline >= DATE_FORMAT(now(), '%Y-%m-%d') ";

$sql = " select count(*) as cnt " . $sql_common;

$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select
			a.*,
			b.idx as sub_idx,
			date_format(a.writetime, '%Y.%m.%d') as writetime,
			a.e_type as e_type,
			a.title,
			b.price,
			b.meet,
			a.state as state,
			a.simple_yn as simple_yn ";
$sql .= $sql_common;
$sql .= " order by a.idx desc ";
$sql .= " limit $from_record, $rows ";

$result = sql_query($sql);
?>
<style type="text/css">
	.title_req{padding: 10px 0;}
	.partner_li li{border-bottom: 1px solid #ddd; font-size: 20px; padding: 10px 0;}
	.partner_li li a{width: 100%;}
	.partner_li li span{float: right; color: #999;}
	.req_list{width: 49%; float: left; overflow: hidden; box-shadow: 2px 3px 5px #ccc; border-radius: 20px; margin: 2% 0; padding: 15px;}
	.req_list + .req_list:nth-of-type(2n){margin-left: 2%;}
	.status_req{width: 80px; text-align: center; border-radius: 20px; background-color: #1379cd; color: #fff; font-size: 14px; padding: 5px 0;}
	.thumb_area{width: 20%; float: left;}
	.info_area{width: 76%; float: left; margin-left: 4%;}
	.end_req{color: #fe8e3a; font-weight: 600; font-size: 14px; margin-bottom: 5px;}
	.ea_req{line-height: 21px; font-size: 16px;}
	.btn_req{text-align: center; overflow: hidden; width: 100%; font-size: 18px; margin-top: 20px;}
	.btn_req a{background-color:#1379cd; color: #fff; text-align: center; max-width: 450px; margin: 0 auto; display: block; padding: 10px;margin-top: 20px; border-radius: 10px;}
	#board .subject{padding: 10px 0;}
	@media(max-width: 768px){
		.req_list{width: 100%; margin-left: 0 !important;} 
		.top_list{display: none;}
		.sub_tt{font-size: 10px; padding-bottom: 0;}
	}
</style>
<!-- <div class="tab_area">
	<div class="tab">
		<ul class="row">
			<li id="patiGubun1" class="col-xs-6 on">
				<a href="/estimate/partner_estimate_list.php?gubun=1">참여현황</a>
			</li>
			<li id="patiGubun1" class="col-xs-6">
				<a href="/estimate/partner_estimate_list.php?gubun=3">문의현황</a>
			</li>
		</ul>
	</div>
</div> -->
<div class="list esti_list" id="tableList">
	<?php
		for ($i=0; $row=sql_fetch_array($result); $i++)
		{
			$state = $row['state'];
			$e_type1 = $row['e_type'];
			$img_path = estimate_img($row['idx']);
		?>
			<div class='req_list'>
				<a href="javascript:doDetail(<?php echo $row['idx'] ?>);">
					<div class='status_req'>
						<div class='sub_tt white'><?php echo get_estimate_state($state); ?></div>
					</div>
					<h4 class='title_req subject'><?php echo $row['title'] ?></h4>
					<div class="thumb_area">
					<?php echo estimate_img_thumbnail($img_path, 350, 350); ?>
					</div>
					<div class="info_area">
					<div class="end_req">견적마감일 : <?php echo date( 'Y-m-d', strtotime( $row['deadline'] )); ?></div>
					<div class='info_req'>
						<div class="ea_req">지역 : <?php echo $row['area1'] . ' '. $row['area2'] ?></div>
						<div class="ea_req">분류 : <?php echo get_etype($e_type1); ?></div>
						<!-- <div class='date'>작성자 : <?php echo $row['nickname']; ?> ㅣ 등록일 : <?php echo $row['writetime'] ?></div> -->
					</div>
					</div>
				</a>
			</div>
		<?php }
		if($i==0){
			echo "<p class='nolistatallx'> 조건에 맞는 견적 내역이 없습니다.</p>";
		}
	?>		
</div><!-- list -->

<div id="page">
	<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?gubun=1&&page="); ?>
</div><!-- page -->

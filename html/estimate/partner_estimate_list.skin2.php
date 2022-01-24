<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql_common  = " from ";
$sql_common .= " 	{$g5['estimate_list']} a ";
$sql_common .= " 	join {$g5['estimate_propose']} b on a.idx = b.estimate_idx ";
$sql_common .= " 	left join ( ";
$sql_common .= " 		select estimate_idx, count(*) as cnt from {$g5['estimate_propose']} group by estimate_idx ";
$sql_common .= " 	) c on a.idx = c.estimate_idx ";
$sql_common .= " where ";
$sql_common .= " 	b.rc_email = '{$member['mb_email']}' ";
$sql_common .= " 	and b.selected = '1' ";

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
			date_format(a.writetime, '%y.%m.%d') as writetime,
			case when b.requesttime is null then '-' else date_format(b.requesttime, '%y.%m.%d') end as requesttime,
			case when a.selecttime is null then '-' else date_format(a.selecttime, '%Y-%m-%d') end as selecttime,
			case when b.completetime is null then '-' else date_format(b.completetime, '%Y-%m-%d') end as completetime,	
			a.e_type as e_type,
			a.title,
			b.meet,
			b.price,
			a.state as state,
			a.simple_yn as simple_yn ";
$sql .= $sql_common;
$sql .= " order by a.idx desc ";
$sql .= " limit $from_record, $rows ";

$result = sql_query($sql);



?>
<style type="text/css">
	.status_req{font-size: 12px;}
	#board .subject{padding: 10px 0;}
</style>
<div class="list esti_list" id="tableList">
		<?php
		for ($i=0; $row=sql_fetch_array($result); $i++)
		{
			$state = $row['state'];
			$e_type1 = $row['e_type'];
			$img_path = estimate_img($row['idx']);
		?>
			<div class='req_list'>
				<a class="" href='javascript:doDetail(<?php echo $row['idx'] ?>);'> 
					<div class='status_req'>
						<div class='sub_tt white'><?php 
						if($e_type1==2 && $state == 4){
							echo '철거중';
						}else if($e_type1==2 && $state == 5){
							echo '철거완료';
						}else{
							echo get_estimate_state($state);
						}?></div>
					</div>
					<h4 class='title_req subject'><?php echo $row['title'] ?></h4>
					<div class="thumb_area">
						<?php echo estimate_img_thumbnail($img_path, 350, 350); ?>
					</div>
					
					<div class="info_area">
						<?php if($row['completetime']!== '-'){ ?>
							<div class="end_req">수거완료일 : <?php 
								echo $row['completetime'];
								?>
							</div>
						<?php }else{ ?>
							<div class="end_req">견적선택일 : <?php 
								echo $row['selecttime'];
								?>
							</div>
						<?php } ?>
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
			echo '<p>견적 내역이 없습니다</p>';
		}
	?>		
</div><!-- list -->

<div id="page">
	<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?gubun=2&&page="); ?>
</div><!-- page -->
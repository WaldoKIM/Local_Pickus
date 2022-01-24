<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql_common  = " from ";
$sql_common .= " 	g5_estimate_match a ";
$sql_common .= " 	join g5_estimate_match_propose b on a.no_estimate = b.no_estimate ";
$sql_common .= " 	left join ( ";
$sql_common .= " 		select no_estimate, count(*) as cnt from g5_estimate_match_propose group by no_estimate ";
$sql_common .= " 	) c on a.no_estimate = c.no_estimate ";
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
			* ";
$sql .= $sql_common;
$sql .= " order by a.no_estimate desc ";
$sql .= " limit $from_record, $rows ";

$result = sql_query($sql);

?>
<style type="text/css">
	#board .subject{padding: 8px 0;}
</style>
<div class="list esti_list" id="tableList">
		
	<?php
		for ($i=0; $row=sql_fetch_array($result); $i++)
		{ 
			$state = $row['state'];
			?>
			<div class='req_list'>
				<div class='status_req'>
					
					<div class='sub_tt white'><?php echo get_estimate_state_match($state); ?></div>
				</div>
					<a class="subject" href='javascript:doDetail_match(<?php echo $row['no_estimate'] ?>);'> <h4 class='title_req'><?php echo $row['title'] ?></h4></a>
					<div class="end_req">견적마감일 : <?php echo date( 'Y-m-d', strtotime( $row['date_close'] )); ?></div>
					<div class='info_req'>
						<div class="ea_req">지역 : <?php echo $row['area1'] . ' '. $row['area2'] ?></div>
						<div class="ea_req">장소 : <?php echo $row['jangso']; ?></div>
						<!-- <div class="ea_req">분류 : <?php echo $row['cate']; ?></div> -->
				</div>
			</div>
		<?php 
		}
		if($i == 0){
			echo '<p>견적 내역이 없습니다</p>';
		}
	?>
</div><!-- list -->

<div id="page">
	<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?gubun=2&&page="); ?>
</div><!-- page -->
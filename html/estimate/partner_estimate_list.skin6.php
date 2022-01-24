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
$sql .= " limit 2";

$result = sql_query($sql);

$sql_common  = " from ";
$sql_common .= " 	{$g5['estimate_match']} a ";
$sql_common .= " 	join {$g5['estimate_match_propose']} b on a.no_estimate = b.no_estimate and b.rc_email = '{$member['mb_email']}' and (b.selected = '0' OR b.selected = '2') ";
$sql_common .= " 	left join ( ";
$sql_common .= " 		select no_estimate, count(*) as cnt from {$g5['estimate_match_propose']} group by no_estimate ";
$sql_common .= " 	) c on a.no_estimate = c.no_estimate ";

$sql  = " select * ";
$sql .= $sql_common;
$sql .= " order by a.no_estimate desc ";
$sql .= " limit 2 ";

$result_list = sql_query($sql);

$sql_where  = " where state = '1'";
//$sql_where .= " where 1=1 ";
$sql_where .= " and no_estimate not in ( select no_estimate from {$g5['estimate_match_propose']} where rc_email = '{$member['mb_email']}' ) ";
$sql_where .= " and date_close  > now() ";

$sql  = " select 
			no_estimate, 
			concat(substr(name,1,1),'**') as nickname, 
			case when length(title) <= 20 then title else concat(substr(title,1,10),'...') end as title, 
			area1,
			area2,
			state,
			apply_date as writetime,
			date_close,
			jangso,
			cate
		  from {$g5['estimate_match']} ";
$sql .= $sql_where;
$sql .= " order by no desc ";
$sql .= " limit 2";


$result_match = sql_query($sql);

$sql_noti_req = "select count(*) as cnt from g5_notify where category = 'p22' AND email = '{$member['mb_email']}' AND read_gb = '0'";
$sql_noti_choice = "select count(*) as cnt from g5_notify where category = 'p23' AND email = '{$member['mb_email']}' AND read_gb = '0'";

$fet_noti_req = sql_fetch($sql_noti_req);
$fet_noti_choice = sql_fetch($sql_noti_choice);

?>
<style type="text/css">
	.is-pc .at-body{min-height: inherit;}
	.top_list{display: none;}
	.btn_show_more{width: 100%; max-width: 150px; background-color: #1379cd; padding: 15px; color: #fff;}
	.member{margin-top: 20px; width: 100%;}
	.esti_list .req_list{margin:2% 0;}
	.req_list + .req_list:nth-of-type(2n){margin-left: 2%;}
	.req_lists{width:100%; display: block; overflow: hidden;}
	.title_req{padding: 10px 0;}
	.btn_show_more{display: none}
	.member p {display: none;}
		#tableList h3{border:1px solid #ededed; border-radius: 5px; padding: 10px 15px; font-size: 20px; width: 100%; }
		.req_list{display: none;} 
		.list_0{display: none;}
		.list_1{display: none;}

</style>
<div class="modal fade guide" id="esti_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">견적참여 가이드</h4>
			</div>
			<div class="modal-body">
				<div>
					<ul class="row">
						<img class="web" src="/img/p_web.png">
						<img class="mobile" src="/img/p_mobile.png">
					</ul>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						</ul>
					</div><!-- btn_wrap -->
				</div>
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 견적 가이드 -->
<a href="#." data-toggle="modal" data-target="#esti_guide" class="guide_estimate"><i class="xi-help main_co"></i> 견적참여 가이드</a>
<div class="list esti_list" id="tableList">
	<!-- kjs div요소 리스트로 *수정필요 20220120  -->
	<div class="member">
		<h3><a href="/estimate/estimate_list3.php">판매 고객리스트</a></h3>
		
	</div>
	<div class="member">
		<h3><a href="/estimate/partner_estimate_list.php?gubun=4">참여 견적</a></h3>
	</div>
	<div class="member">
		<h3><a href="/estimate/partner_estimate_list.php?gubun=7">문의현황</a><?php echo '<span style="float : right; padding:5px;background-color:red; color:#fff;">' .$fet_noti_req['cnt'] . '<span>'; ?></h3>
	</div>
	<div class="member">
		<h3><a href="/estimate/partner_estimate_list.php?gubun=5">배송내역</a><?php echo '<span style="float : right; padding:5px; background-color:red; color:#fff;">' . $fet_noti_choice['cnt'] . '</span>'; ?></h3>
	</div>
</div><!-- list -->

<div id="page">
	<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?gubun=2&&page="); ?>
</div><!-- page -->
<script type="text/javascript">
	function doDetailEstimate(no_estimate)
{
	location.href = "estimate_form_match.php?no_estimate="+no_estimate;
}	
</script>
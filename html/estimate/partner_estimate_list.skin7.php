<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// 중고매칭 업체 문의
$sql_common  = " from {$g5['estimate_match']} a join g5_estimate_request_match b on a.no_estimate = b.no_estimate and b.rc_email = '{$member['mb_email']}'
				where
					a.no_estimate not in (
						select no_estimate from g5_estimate_match_propose where rc_email = '{$member['mb_email']}'
					)
					and state in ('1','2') and a.date_close >= NOW()";

$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select 
			a.*, 
			b.*,
			concat(substr(a.name,1,1),'**') as nickname, 
			case when length(a.title) <= 20 then title else concat(substr(a.title,1,10),'...') end as title, 
			date_format(a.apply_date, '%Y.%m.%d') as writetime  ";
$sql .= $sql_common;
$sql .= " order by a.no_estimate desc ";
$sql .= " limit $from_record, $rows ";

$result = sql_query($sql);

?>

<style type="text/css">
	@media(max-width: 768px){
		.top_list{display: none;}
		.sub_tt{font-size: 10px; padding-bottom: 0;}
	}
	#board .subject{padding: 10px 0;}
</style>
<!-- <div class="tab_area">
	<div class="tab">
		<ul class="row">
			<li id="patiGubun1" class="col-xs-6">
				<a href="/estimate/partner_estimate_list.php?gubun=4">참여현황</a>
			</li>
			<li id="patiGubun1" class="col-xs-6 on">
				<a href="/estimate/partner_estimate_list.php?gubun=7">문의현황</a>
			</li>
		</ul>
	</div>
</div> -->
<div class="list esti_list" id="tableList">
<h2 class='req_form msubtitle'> 바로 판매 문의 관리 </h2>
	<h2 class='src_form msubtitle' style='display:none'; > 바로 판매 고객 후기 관리</h2>
		<?php
			for ($i=0; $row=sql_fetch_array($result); $i++)
			{
				$state = $row['state'];
				$e_type = $row['e_type'];
		?>
				<div class='req_list req_form'>
				<div class='status_req'>
					<div class='sub_tt white'><?php
						echo get_estimate_state($state);
					?></div>
					</div>
					<a class="subject" href='javascript:doDetailEstimate(<?php echo $row['no_estimate'] ?>);'> <h4 class='title_req'><?php echo $row['title'] ?></h4></a>
					<div class="end_req">견적마감일 : <?php 
						if(intval(strtotime($row['date_close'])-strtotime(date("Y-m-d"))) <= 0){
							echo $row['date_close'];
						}else{
							echo 'D-' . intval(strtotime($row['date_close'])-strtotime(date("Y-m-d"))) / 86400;
						} ?></div>
					<div class='info_req'>
						<div class="ea_req">지역 : <?php echo $row['area1'] . ' '. $row['area2'] ?></div>
						<div class="ea_req">분류 : <?php echo get_etype($e_type1); ?></div>
						<div class='date'>작성자 : <?php echo $row['nickname']; ?> ㅣ 등록일 : <?php echo $row['writetime'] ?></div>
					</div>
				</div>
			<?php }
			if($i==0){

				echo "<div class='req_list req_form'>";
				echo '<p>견적 내역이 없습니다.<br/>문의사항 견적이 사라진 경우, 견적이 이미 선택 됐거나 취소가 됐을때 확인이 안될 수 있습니다.<br/>알림에서 정보를 확인해주시기 바랍니다.</p>';
				echo "</div>";
			}
		?>
</div><!-- esti_list -->
<div style="display:none;" class="src_form">
<?php
include_once('../bbs/mypage_review_bottom.php');
?>			
</div>
<div id="page">
	<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?gubun=3&&area1=$area1&&area2=$area2&&e_type=$e_type&&item_cat=$item_cat&&page="); ?>
</div><!-- page -->
<script type="text/javascript">
function doDetailEstimate(idx)
{
	location.href = "estimate_form_match.php?no_estimate="+idx;
}

</script>
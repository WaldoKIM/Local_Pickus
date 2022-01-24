<?php
include_once('./_common.php');


if($member['mb_level'] != "0" && $member['mb_level'] != "8"){
	alert("메인 창으로 이동합니다.",G5_URL);
}


$g5['title'] = '견적현황';
include_once('./_head.php');

$sql_common = " from
			{$g5['match_list']} a
			left join (
				select
					match_idx,
					count(*) as match_cnt
				from
					{$g5['match_propose']}
				group by match_idx
			) b on a.idx = b.match_idx
		where
			a.email = '{$member['mb_email']}' ";

$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select
			a.*,
			date_format(a.writetime,'%Y-%m-%d') as writedate,
			ifnull(b.match_cnt,0) as match_cnt
           $sql_common
           order by a.idx desc	
           limit $from_record, $rows ";
$result = sql_query($sql);

?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>

<div class="sub_title login">
	<h5>내신청현황</h5>
	<h1>피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</h1>
</div><!-- sub_title -->

<div class="member com_pd">
	<div class="container">
		<ul class="tab">
			<li class="col-xs-6">
				<a href="/estimate/my_match_info.php">신청안내</a>
			</li>
			<li class="col-xs-6 on">
				<a href="javascript:">나의 매칭 리스트</a>
			</li>
		</ul>		
		<div id="board">
			<div class="list">
				<table>
					<colgroup class="web_col">
						<col style="width: 20%" />
						<col style="width: 50%" />
						<col style="width: 10%" />
						<col style="width: 10%" />
						<col style="width: 10%" />
					</colgroup>
					<colgroup class="mob_col">
						<col style="width: 20%" />
						<col style="width: 50%" />
						<col style="width: 10%" />
						<col style="width: 10%" />
						<col style="width: 10%" />
					</colgroup>
					<thead>
						<tr>
							<th>작성일</th>
							<th>제목</th>
							<th>참여업체</th>
							<th>진행상태</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody id="tableList">
					<?php
    				for ($i=0; $row=sql_fetch_array($result); $i++)
    				{
    					$state = $row['state'];
    				?>
    					<tr onClick="doMatch('<?php echo $row['idx'];?>')">
    						<td><?php echo $row['writedate'];?></td>
    						<td><?php echo $row['title'];?></td>
    						<td><?php echo $row['match_cnt'];?></td>
    						<td><?php echo get_match_state($state);?></td>
							<td></td>   						
    					</tr>
    				<?php
    				}
    				if($i == 0){
    					echo '<tr><td colspan="4">중고 매칭 내역이 없습니다</td></tr>';
    				}
    				?>
					</tbody>					
				</table>

			</div><!-- list -->

			<div id="page">
				<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?page="); ?>
			</div><!-- page -->

		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
<form name="frmcancel" action="<?php echo G5_URL; ?>/estimate/my_estimate_list_update.php">
	<input type="hidden" id="page" name="page" vaule="<?php echo $page; ?>">
	<input type="hidden" id="idx" name="idx" vaule="idx">
	<input type="hidden" id="state" name="state" vaule="6">
</form>
<script type="text/javascript">
function doMatch(idx)
{
	location.href="./my_match_form.php?idx="+idx+"&&page=<?php echo $page; ?>";
}	
</script>
<?php
include_once('./_tail.php');
?>
<?php
include_once('./_common.php');

if (!$is_member)
	alert("회원만 가능합니다.", G5_URL);

include_once('./_head.php');

$sql_common = " from
					{$g5['notify_table'] }
				where
					email = '{$member['mb_email']}'
					and read_gb = '0' ";

$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select
			idx,
			email,
			noti_type,
			title,
			content,
			read_gb,
			estimate_idx,
			market_idx,
			category,
			date_format(updatetime, '%Y.%m.%d %T') as updatetime ";
$sql .= $sql_common;
$sql .= " order by idx desc ";
$sql .= " limit $from_record, $rows ";

$result = sql_query($sql);
?>
<style type="text/css">
	.mob_back{display: none !important;}
	
</style>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<div class="sub_title login">
	<h5>알림</h5>
	<h1>피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</h1>
</div><!-- sub_title -->

<div class="member com_pd">
	<div class="container">
		
		<div id="board">

			<div class="list">
				<table>
					<colgroup class="web_col">
						<col style="width: 60%" />
						<col style="width: 15%" />
						<col style="width: 15%" />
						<col style="width: 10%" />
					</colgroup>
					<colgroup class="mob_col">
						<col style="width: 55%" />
						<col style="width: 20%" />
						<col style="width: 25%" />
					</colgroup>
					<thead>
						<tr>
							<th>제목</th>
							<th>작성일자</th>
							<th class="web_td">읽음여부</th>
							<th>이동</th>
						</tr>
					</thead>
					<tbody id="tableList">
					<?php
	    				for ($i=0; $row=sql_fetch_array($result); $i++)
	    				{
	    					$state = $row['state'];
	    					$e_type = $row['e_type'];
	    					
	    					echo "<tr>";
	    					echo "<td class='tt_left'>".$row['title']."</td>";
	    					echo "<td>".$row['updatetime']."</td>";
	    					if($row['read_gb']){
	    						echo "<td class='web_td'><span class='end'>읽음</span></td>";
	    					}else{
	    						echo "<td class='web_td'><span class='ready'>읽지않음</span></td>";
	    					}
	    					echo "<td>";
	    					echo "<a class='btn main_bg' href='javascript:doMoveNotify(\"".$row['idx']."\",\"".$row['noti_type']."\",\"".$row['estimate_idx']."\",\"".$row['category']."\")'>이동</a>";
	    					echo "</td>";
	    					echo "</tr>";
	    				}
	    				if($i==0){
	    					echo "<tr class='no_data'><td colspan='4'>알림이 없습니다.</td></tr>";
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
<form name="frmmove" action="<?php echo G5_URL; ?>/bbs/notify.update.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="idx"  name="idx">
	<input type="hidden" id="noti_type" name="noti_type">
	<input type="hidden" id="estimate_idx" name="estimate_idx">
	<input type="hidden" id="category" name="category">
</form>
<script type="text/javascript">
function doMoveNotify(idx, noti_type, estimate_idx, category)
{
	var f = document.frmmove;
	f.idx.value = idx;
	f.noti_type.value = noti_type;
	f.estimate_idx.value = estimate_idx;
	f.category.value = category;

	f.submit();
}
</script>
<?php
include_once('./_tail.php');
?>
<?php
include_once('./_common.php');

$g5['title'] = "포럼";

include_once('./_head.php');

$sql_common = " from {$g5['forum_table']} ";

$sql_order = " order by idx desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select
			idx,
			title,
			content,
			hit,
			photo1,
			photo2,
			photo3,
			date_format(updatetime, '%Y.%m.%d') as updatetime
		{$sql_common} {$sql_order} limit {$from_record}, {$rows} ";

$result = sql_query($sql);

?>

<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<div class="sub_title notice_bg">
	<h1>포럼</h1>
	<h5>피커스의 소식을 전해드립니다.</h5>
</div><!-- sub_title -->

<div class="member com_pd">
	<div class="container">
		
		<div id="board">

			<div class="list">
				<table>
					<colgroup class="web_col">
						<col style="width: 10%" />
						<col style="width: 60%" />
						<col style="width: 15%" />
						<col style="width: 15%" />
					</colgroup>
					<colgroup class="mob_col">
						<col style="width: 10%" />
						<col style="width: 75%" />
						<col style="width: 15%" />
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th class="web_td">작성일자</th>
							<th>조회수</th>
						</tr>
					</thead>
					<tbody>
    				<?php
    				for ($i=0; $row=sql_fetch_array($result); $i++) {
    					echo '<tr>';
    					echo '<td>'.$row['idx'].'</td>';
    					echo '<td><a class="subject" href="./forum_detail.php?page='.$page.'&&idx='.$row['idx'].'">'.$row['title'].'</a></td>';
    					echo '<td class="web_td">'.$row['updatetime'].'</td>';
    					echo '<td>'.$row['hit'].'</td>';
    					echo '</tr>';
    				}

    				if($i==0){
    					echo '<tr><td colspan="4">등록된 포럼이 없습니다.</td></tr>';
    				}
    				?>					
					</tbody>
				</table>
			</div><!-- list -->

			<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->

<?php
include_once('./_tail.php');
?>

<?php
include_once('./_common.php');

$g5['title'] = "공지사항";

include_once('./_head.php');

$sql = " update {$g5['notice_table']} set hit = hit + 1 where idx = '$idx' ";
sql_query($sql);

$sql = " select
			idx,
			title,
			content,
			hit,
			photo1,
			photo2,
			photo3,
			date_format(updatetime, '%Y.%m.%d') as updatetime
		from
			{$g5['notice_table']}
		where
			idx = '$idx'	  ";
		
$row = sql_fetch($sql);

?>

<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<div class="sub_title notice_bg">
	<h1>공지사항</h1>
	<h5>피커스의 소식을 전해드립니다.</h5>
</div><!-- sub_title -->

<div class="member com_pd">
	<div class="container">

		<div>
			<ul class="tab">
				<li class="col-xs-4 on">
					<a href="#none">공지사항</a>
				</li>
				<li class="col-xs-4">
					<a href="./qna.php">1:1문의</a>
				</li>
				<li class="col-xs-4">
					<a href="./faq.php">FAQ</a>
				</li>
			</ul>
		</div>
		
		<div id="board">
			<div class="view">
				<table>
					<tr>
						<th>
							<h6><?php echo $row['title']; ?><c:out value="${noticeDetail.title}" escapeXml="false"/></h6>
							<p><?php echo $row['updatetime']; ?></p>
						</th>
					</tr>
					<tr>
						<td class="con">
							<?php echo $row['content']; ?>
							<?php
								if($row['photo1']){
									echo '<img src="'.G5_DATA_URL.'/estimate/'.$row['photo1'].'">';
								}
								if($row['photo2']){
									echo '<img src="'.G5_DATA_URL.'/estimate/'.$row['photo2'].'">';
								}
								if($row['photo3']){
									echo '<img src="'.G5_DATA_URL.'/estimate/'.$row['photo3'].'">';
								}
							?>
						</td>
					</tr>
				</table>
			</div><!-- list -->
	
			<div class="btn_wrap">
				<ul class="row">
					<li class="col-xs-3 col-xs-offset-9 col-md-1 col-md-offset-11">
						<a class="main_bg" href="./notice.php?page=<?php echo $page; ?>">리스트</a>
					</li>
				</ul>
			</div>
		</div><!-- board -->		

	</div><!-- container -->
</div><!-- member -->

<?php
include_once('./_tail.php');
?>

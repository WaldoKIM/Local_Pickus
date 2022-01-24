<?php
include_once('./_common.php');

$g5['title'] = "Q&A";

include_once('./_head.php');

$sql = " select
			idx,
			nickname,
			email,
			phone,
			res_type,
			title,
			concat('<p>',replace(res_content,'\n','</p><p>'),'</p>') as res_content,
			concat('<p>',replace(ret_content,'\n','</p><p>'),'</p>') as ret_content,
			case when ifnull(ret_content,'') = '' then 'N' else 'Y' end as ret_yn,
			date_format(updatetime, '%Y.%m.%d') as updatetime,
			date_format(updatetime, '%Y.%m.%d') as completetime
		from
			{$g5['qna_table']}
		where
			idx = '$idx'	  ";
		
$row = sql_fetch($sql);

?>

<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>

<div class="sub_title notice_bg">
	<h1>1:1문의</h1>
	<h5>무엇이 궁금하세요?</h5>
</div><!-- sub_title -->

<div class="member com_pd">
	<div class="container">

		<div>
			<ul class="tab">
				<li class="col-xs-4" style="display: none;">
					<a href="./notice.php">공지사항</a>
				</li>
				<li class="col-xs-6 on">
					<a href="#none">1:1문의</a>
				</li>
				<li class="col-xs-6">
					<a href="./faq.php">FAQ</a>
				</li>
			</ul>
		</div>
		
		<div id="board">
			<div class="view_qna">
				<ul>
					<li class="col-xs-6"><?php echo $row['res_type']; ?></li>
					<li class="col-xs-6">등록일자 : <?php echo $row['updatetime']; ?></li>
				</ul>
				<table>
					<colgroup>
						<col style="width: 20%" />
						<col style="width: 80%" />
					</colgroup>
					<tr>
						<th>문의제목</th>
						<td><?php echo $row['title']; ?></td>
					</tr>
					<tr>
						<th>문의내역</th>
						<td><?php echo $row['res_content']; ?></td>
					</tr>
					<tr>
						<th>답변내역</th>
						<td><?php echo $row['ret_content']; ?></td>
					</tr>
				</table>
			</div><!-- list -->

			<div class="btn_wrap">
				<ul class="row">
					<li class="col-xs-3 col-xs-offset-9 col-md-1 col-md-offset-11">
						<a class="main_bg" href="./qna.php">리스트</a>
					</li>
				</ul>
			</div>
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->

<?php
include_once('./_tail.php');
?>

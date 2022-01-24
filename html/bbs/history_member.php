<?php
	include_once('./_common.php');

	/*if (!$is_member || $member['mb_level'] != "0")
		alert("회원만 가능합니다.", G5_URL);*/

	include_once('./_head.php');
	$email = $member['mb_id'];
	$sql = "select * from g5_estimate_list AS a JOIN g5_estimate_propose AS b ON a.idx = b.estimate_idx WHERE a.email = '$email' AND b.selected = 1 order by a.idx desc";
	$result = sql_query($sql);
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<style type="text/css">
	.mob_back{display: none !important;}
	.requst_list{margin: 0 auto; background-color: #fff; padding: 30px;}  
	.at-body{background-color:#f4f5f9; }
	input[type=text], input[type=password], input[type=search], input[type=email], input[type=number], input[type=tel]:focus{border:0 !important;}
	.col-md-2{width: 30%;}
	.col-md-10{width: 70%;}
	.tab li{border-bottom: 3px solid #ccc !important;}
	.tab li.on a h4{color: #fff !important;}
	.tab_area{margin-bottom: 40px;}
	.tab_area .tab li{border-bottom: 1px solid #ececec; border-radius: 18px;}
	.tab_area .tab{max-width: 800px; margin: 0 auto;}
	.tab_area .tab .main_bg.on h4{color: #fff;}
	.tab_area .tab .on{background-color: #1379cd; }
	.tab_area .tab .on a{color: #fff;}
</style>

<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">정산내역</h1>
			<p class="tit_desc">정산내역을 확인하실 수 있습니다.</p>
		</div>
		<div class="tab_area">
			<ul class="tab">
				<li class="col-xs-6  main_bg on"  style="border-bottom: 1px solid #ececec  !important;">
					<a href="./history_member.php">
						<h4>매입/철거</h4>
					</a>
				</li>
				<li class="col-xs-6" style="border-bottom: 1px solid #ececec  !important;">
					<a href="./history_member_match.php">
						<h4>판매</h4>
					</a>
				</li>
			</ul>
		</div>
		<div class="join_wrap" id="board">
			<div class="view">
				<table class="requst_list">
					<thead>
						<tr>
							<th>내역</th>
							<th>매입가(철거비용)</th>
							<th>폐기가</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						for ($i=0; $row=sql_fetch_array($result); $i++) {
							echo "<tr>";
							echo "<td style='text-align:center'>".$row['title']."</td>";
							echo "<td style='text-align:center'>".number_format($row['price'])."원</td>";
							echo "<td style='text-align:center'>".number_format($row['price_minus'])."원</td>";
							if(!empty($row['completetime'])){
								echo "<td style='text-align:center'>".date('Y-m-d',strtotime($row['completetime']))."</td>";
							}else{
								echo "<td style='text-align:center'>".date('Y-m-d' , strtotime($row['selecttime']))."</td>";
							}
							echo "</tr>";
						} ?>
					</tbody>
				</table>
			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->

<?php
include_once('./_tail.php');
?>

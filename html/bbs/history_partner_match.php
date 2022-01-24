<?php
	include_once('./_common.php');

	/*if (!$is_member || $member['mb_level'] != "0")
		alert("회원만 가능합니다.", G5_URL);*/

	include_once('./_head.php');
	$email = $member['mb_id'];
	$sql = "select * from {$g5['estimate_match']} as a JOIN {$g5['estimate_match_propose']} AS b ON a.no_estimate = b.no_estimate JOIN g5_estimate_match_propose_detail AS c ON b.no_estimate = c.no_estimate WHERE b.rc_email = '$email' AND a.pay_confirm = 1 AND b.selected = 1 AND a.pay_confirm = 1 order by a.no_estimate desc";
	$result = sql_query($sql);

	$sql = " select
			a.rc_email as rc_email,
			count(*) as pati_qty,
			sum(case when a.selected = '1' then 1 else 0 end) as pati_selected_sty,
			sum(case when b.state = '5' and a.selected = '1' then 1 else 0 end) as pati_complete_qty,
			c.mb_biz_score,
			format(ifnull(c.mb_point,0),0) as mb_point
		from
			{$g5['estimate_match_propose']} a
			join {$g5['estimate_match']} b on a.no_estimate = b.no_estimate
			join {$g5['member_table']} c on a.rc_email = c.mb_email
		where
			a.rc_email = '{$member['mb_email']}'
		group by a.rc_email	 ";

	$userInfo_match = sql_fetch($sql);

	$sql = " select
			a.rc_email,
			round(avg(a.score),1) as score,
			round(avg(a.score)/5 * 100,0) as rate,
			count(*) as cnt
			from 
			g5_estimate_propose a
			join g5_estimate_list b on a.estimate_idx = b.idx
			where 
			ifnull(a.review,'') !=  '' 
			and a.rc_email = '{$member['mb_email']}'
			group by a.rc_email ";

			$score_row = sql_fetch($sql);

			$review_cnt = $score_row['cnt'];
			$score = $score_row['score'];
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/historypartner.css"/>


<div class="member com_pd">
	<div class="container">
		
		<div class="sub_title">
			<h1 class="main_co">정산내역</h1>
			<p class="tit_desc">정산내역을 확인하실 수 있습니다.</p>
		</div>
		<div class="tab_area">
		<ul class="tab mb-5">
				<li class="col-lg-3 col-xs-4 m025050"  style="border-bottom: 1px solid #ececec  !important;">
					<a href="./history_partner.php">
						<h4>매입/철거</h4>
					</a>
				</li>
				<li class="col-lg-3 col-xs-4 main_bg on m025025" style="border-bottom: 1px solid #ececec  !important;">
					<a href="./history_partner_match.php">
						<h4>구매</h4>
					</a>
				</li>
				<li class="col-lg-3 col-xs-4 m050025" style="border-bottom: 1px solid #ececec  !important;">
					<a href="./history_partner_market.php">
						<h4>마켓</h4>
					</a>
				</li>
			</ul>
			<a href="#." data-toggle="modal" data-target="#esti_guide" class="guide_estimate"><i class="xi-help main_co"></i> 정산 가이드</a>
			<table class="top_list">
			<colgroup>
				<col style="width: 25%" />
				<col style="width: 25%" />
				<col style="width: 25%" />
				<col style="width: 25%" />
			</colgroup>
			<tr>
				<th>넣은 견적수</th>
				<th>견적 선택수</th>
				<th>견적 완료수</th>
				<th>평점별표</th>
			</tr>
			<tr>
				<td><?php echo $userInfo_match['pati_qty']; ?></td>
				<td><?php echo $userInfo_match['pati_selected_sty']; ?></td>
				<td><?php echo $userInfo_match['pati_complete_qty']; ?></td>
				<td>
				<?php
					//mb_biz_score가 실제 평점인지, 매입 평점인지 구매 평점인지 모름
					//echo $userInfo_match['mb_biz_score']; ?>
					<?php echo "<span class='icon_star'>";
						if($score < 1){
							echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 2){
							echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 3){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 4){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 5){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
						}else{
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
						}
						echo '</span>';
						echo'</br>';
						echo "평점 <span class='main_co'>".$score."</span> / 5.0";
						echo'</br>';
						?>	
				</td>
			</tr>
			</table>
		</div>
		
		<div class="join_wrap" id="board">
			<div class="view">
				<table class="requst_list">
					<thead>
						<tr>
							<th>내역</th>
							<th>결제금액</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						for ($i=0; $row=sql_fetch_array($result); $i++) {
							$price_total = $row['amt0'] + $row['amt1'] + $row['amt2'] + $row['amt3'] + $row['amt4']  + $row['amt5'] + $row['amt6'] + $row['amt7'] + $row['amt8'] + $row['amt9'] + $row['amt10'] + $row['shipping'];
							echo "<tr>";
							echo "<td style='text-align:center'>".$row['title']."</td>";
							echo "<td style='text-align:center'>".$price_total."</td>";
							echo "<td style='text-align:center'>".$row['pay_date']."</td>";
							echo "</tr>";
						} ?>
					</tbody>
				</table>
			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->
<div class="modal fade guide" id="esti_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">정산 가이드</h4>
			</div>
			<div class="modal-body">
				<div>
					<ul class="row">
						<img class="web" src="/images/pc_history.png">
						<img class="mobile" src="/images/m_history.png">
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
<?php
include_once('./_tail.php');
?>

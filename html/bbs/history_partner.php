<?php
	include_once('./_common.php');

	/*if (!$is_member || $member['mb_level'] != "0")
		alert("회원만 가능합니다.", G5_URL);*/

	include_once('./_head.php');
	$email = $member['mb_id'];
	$sql = "select * from g5_estimate_list AS a JOIN g5_estimate_propose AS b ON a.idx = b.estimate_idx WHERE b.rc_email = '$email' AND b.selected = 1 order by a.idx desc";
	$result = sql_query($sql);

	$sql = " select
			a.rc_email as rc_email,
			count(*) as pati_qty,
			sum(case when a.selected = '1' then 1 else 0 end) as pati_selected_sty,
			sum(case when b.state = '5' and a.selected = '1' then 1 else 0 end) as pati_complete_qty,
			c.mb_biz_score,
			format(ifnull(c.mb_point,0),0) as mb_point
		from
			{$g5['estimate_propose']} a
			join {$g5['estimate_list']} b on a.estimate_idx = b.idx
			join {$g5['member_table']} c on a.rc_email = c.mb_email
		where
			a.rc_email = '{$member['mb_email']}'
		group by a.rc_email	 ";

	$userInfo = sql_fetch($sql);

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

	$sql = "select * from g5_member where mb_email = '{$member['mb_email']}'";
	$cli_biz_info = sql_fetch($sql);

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
				<li class="col-lg-3 col-xs-4 main_bg on m025050"  style="border-bottom: 1px solid #ececec  !important;">
					<a href="./history_partner.php">
						<h4>매입/철거</h4>
					</a>
				</li>
				<li class="col-lg-3 col-xs-4 m025025" style="border-bottom: 1px solid #ececec  !important;">
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
				<th>평점 별표</th>
			</tr>
			<tr>
				<td><?php echo $userInfo['pati_qty']; ?></td>
				<td><?php echo $userInfo['pati_selected_sty']; ?></td>
				<td><?php echo $userInfo['pati_complete_qty']; ?></td>
				<td>
					<?php
					//mb_biz_score가 실제 평점인지, 매입 평점인지 구매 평점인지 모름
					//echo $userInfo['mb_biz_score']; ?>
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
		
		<div class="join_wrap esti_list" id="board">
			<div class="view">
				<?php
					for ($i=0; $row=sql_fetch_array($result); $i++)
					{
					?>
						<div class='req_list'>
							<?php 
								if(!empty($row['completetime'])){
									$day = date('Y-m-d',strtotime($row['completetime']));
									$week = array("&#40;일&#41;" , "&#40;월&#41;"  , "&#40;화&#41;" , "&#40;수&#41;" , "&#40;목&#41;" , "&#40;금&#41;" ,"&#40;토&#41;") ;
									$weekday = $week[ date('w'  , strtotime($day)  ) ] ;																		
									echo "<p>".date('Y-m-d',strtotime($row['completetime'])).$weekday."</p>";
								}else if(!empty($row['selecttime'])){
									$day = date('Y-m-d',strtotime($row['selecttime']));
									$week = array("&#40;일&#41;" , "&#40;월&#41;"  , "&#40;화&#41;" , "&#40;수&#41;" , "&#40;목&#41;" , "&#40;금&#41;" ,"&#40;토&#41;") ;
									$weekday = $week[ date('w'  , strtotime($day)  ) ] ;																		
									echo "<p >".date('Y-m-d' , strtotime($row['selecttime'])).$weekday."</p>";
								}else{
									echo "<p>-</p>";
								}
							?>
							<!-- <h4 class='title_req subject'><?php echo $row['title'] ?></h4> -->
							<div>
								<table>
									<tr>
										<th>내역</th>
										<th>견적가</th>
										<th>업체입금가</th>
										<th>피커스지급가</th>
									</tr>
									<tr>
										<td><?php echo '매입(철거)'; ?></td>
										<td><?php echo number_format($row['price'])."원"; ?></td>
										<td><span class="main_co" style="font-weight: bold;"><?php
											if($cli_biz_info['mb_biz_charge_rate'] != 0){
												$price_amt = $row['price'] * ($cli_biz_info['mb_biz_charge_rate'] / 100);
												$last_price = $price_amt + ($price_amt / 10);
											}else{
												$last_price = $row['price'];
											}

											if($last_price == 0){
											 echo '무료수거';
											}else{
											 echo number_format(floor($last_price)) . '원';
											}
											?>
										</span></td>
										<td><?php echo '-' ?></td>
									</tr>
									<tr>
										<td><?php echo '폐기'; ?></td>
										<td><?php echo number_format($row['price_minus'])."원"; ?></td>
										<td><span class="main_co" style="font-weight: bold;">
										<?php if($cli_biz_info['mb_biz_charge_rate'] != 0){
										$price_amt = $row['price_minus'] * ($cli_biz_info['mb_biz_charge_rate'] / 100);
										$last_price = $price_amt + ($price_amt / 10);
									}else{
										$last_price = $row['price_minus'];
									}
									 echo number_format(floor($last_price)) . '원<br/>';
									?></span></td>
									<td><?php echo '-' ?></td>
									</tr>
								</table>
							</div>
						</div>
					<?php }
					if($i==0){
						echo '<p>정산 내역이 없습니다</p>';
					}
				?>
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

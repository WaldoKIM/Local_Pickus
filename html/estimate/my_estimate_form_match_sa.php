<?php
include_once('./_common.php');
require_once('../libs/INIStdPayUtil.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$sql = " select * from {$g5['member_table']} where mb_email = '$email' ";
$mm = sql_fetch($sql);

if ($mm) {
	if ($mm['mb_level'] == 2) {
		alert("업체 회원은 접근할 수 없습니다.", G5_URL);
	}
}

$sql = " select
			*
		from
			g5_estimate_match a
		where
			a.no_estimate =  '$no_estimate'";
$master = sql_fetch($sql);

$sql = " select
			*
		from
			g5_shop_order
		where
			od_id = '$no_estimate'";
$shop = sql_fetch($sql);

$sql = " 		select *
				from
					g5_estimate_match_info
				where
					no_estimate = '$no_estimate'";
$info = sql_query($sql);

$sql = " select count(*) as cnt from g5_estimate_match_propose where no_estimate = '$no_estimate' ";
$propose_cnt = sql_fetch($sql);
$centerCnt = $propose_cnt['cnt'];

$sql = " 		select
					a.*,b.*,c.*
				from
					g5_estimate_match_propose a
					join {$g5['member_table']} b on a.rc_email = b.mb_email
					join g5_estimate_match_propose_detail c on c.no_estimate = a.no_estimate AND c.rc_email = a.rc_email AND a.selected = 0
				where
					a.no_estimate = '$no_estimate'";
$propose_process = sql_query($sql);
$sql = " 		select
					*
				from
					g5_estimate_match_propose a
					join {$g5['member_table']} b on a.rc_email = b.mb_email
					join g5_estimate_match_propose_detail c on c.no_estimate = a.no_estimate AND c.rc_email = a.rc_email
				where
					a.no_estimate = '$no_estimate'
					and a.selected = '1'";
$propose_select = sql_fetch($sql);
$sql = " 		select
					*
				from
					g5_estimate_match_propose a
					join {$g5['estimate_match']} b on a.no_estimate = b.no_estimate
				where
					a.no_estimate = '$no_estimate'
					and ifnull(a.review,'') !=  '' ";

$propose_review = sql_fetch($sql);



$sql_info = "select * 
			from
				g5_estimate_match_propose_detail a
				join {$g5['member_table']} b on a.rc_email = b.mb_email
			where a.no_estimate = '$no_estimate'";

$propose_detail = sql_fetch($sql_info);

if ($master['state'] == "7") {
	alert("취소된 견적입니다.");
}

$price = 0;
if ($propose_success) {
	$price = $propose_success['price'];
}

?>
<link rel="stylesheet" type="text/css" href="/css/board.css" />
<link rel="stylesheet" type="text/css" href="/css/member.css" />
<link rel="stylesheet" type="text/css" href="/css/swiper.min.css" />
<link rel="stylesheet" type="text/css" href="/share/css/jquery.bxslider.css" />

<form name="frmrequest" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_request_match_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="no_estimate">
	<input type="hidden" name="email">
</form>
<div class="member com_pd">
	<div class="sub_title">
		<h1 class="main_co">내 구매현황</h1>
		<p id="data_result"></p>
	</div><!-- sub_title -->
	<div class="container">
		<div id="board">
			<div class="view">
				<div class="mob">
					<div class="mob_slider">
						<div class="text" id="mobileEtype">중고매칭</div>
					</div>
					<div class="text-center mob_ing" id="mobileStatus">
						<?php if ($propose_select['completetime']) {
							echo '<h1 class="main_co">물품구매확정</h1>';
						} else {
							echo get_estimate_mobile_state_tag_match($master['state']);
						} ?>
					</div>
					<ul class="row mob_info" id="mobileInfo1">
						<?php
						echo "<li class='col-xs-4'>";
						echo "<p class='text-center main_co'><i class='xi-calendar-check'></i> 견적마감일</p>";
						echo "<p class='text-center'>" . $master['date_close'] . "</p>";


						echo "</li>";
						echo "<li class='col-xs-4'>";
						echo "<p class='text-center main_co'><i class='xi-emoticon'></i> 참여수</p>";

						echo "<p class='text-center'>" . $centerCnt . "명</p>";

						echo "</li>";
						echo "<li class='col-xs-4'>";
						echo "<p class='text-center main_co'><i class='xi-calendar-check'></i> 배송요청일</p>";
						echo "<p class='text-center'>" . $master['date_req'] . "</p>";
						echo "</li>";
						?>
					</ul>

					<div class="customer">
						<dl class="row" id="mobileInfo2">
							<dt class='col-xs-1 main_co'>제목</dt>
							<dd class='col-xs-11'><?php echo $master['title']; ?></dd>
						</dl>
						<dl class="row" id="mobileInfo2">
							<dt class='col-xs-1 main_co'>지역</dt>
							<dd class='col-xs-11'><?php echo $master['area1'] . " " . $master['area2'] . " " . $master['place']; ?></dd>
						</dl>
						<dl class="row" id="mobileInfo2">
							<dt class='col-xs-1 main_co'>층수</dt>
							<dd class='col-xs-11'><?php echo $master['elevator_yn'] . " / " . $master['floor'] . "층" ?></dd>
						</dl>
						<dl class="row" id="mobileInfo2">
							<dt class='col-xs-1 main_co'>예산</dt>
							<dd class='col-xs-11'><?php echo number_format($master['price']) . '원'; ?></dd>
						</dl>
						<?php if ($propose_select['completetime']) { ?>
							<dl class="row" id="mobileInfo2">
								<dt class='col-xs-1 main_co'>배송확정</dt>
								<dd class='col-xs-11'><?php echo $propose_select['completetime']; ?></dd>
							</dl>
						<?php } ?>
					</div>
					<div class="warning" id="mobileWaring">
						<?php
						if ($master['state'] == "2") {
							echo "<h1 class='text-center main_co'>견적이 완료되었습니다.업체를 선택해주세요</h1>";
						} else if ($master['state'] == "3") {
							echo "<h1 class='text-center main_co'>업체서 물품 확정 후 결제가 진행 됩니다.</h1>";
						}
						?>
					</div>

					<div class="customer">
						<dl class="row" id="mobileButton">
							<?php
							if ($master['state'] == "0" || $master['state'] == "1") {
								echo "<ul class='row'>";
								echo "<li class='col-xs-6'></li>";
								echo "<li class='col-xs-6'>";
								echo "<a class='main_bg' href='javascript:doCancel()'>견적취소</a>";
								echo "</li>";
								echo "</ul>";
							}
							?>
						</dl>
					</div>
				</div>

				<table class="web">
					<tr>
						<td class="info" id="mainTitle">
							<h1><?php echo $master['title']; ?></h1>
							<dl>

								<?php

								$state    = $master['state'];
								$selected = $master['selected'];

								if ($state == "0" || $state == "1" || $state == "6") {
									if ($master['price_qty'] > 0) {
										echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>" . $centerCnt . "명</dd>";
										echo "<dt class='col-xs-3'>최저가적</dt><dd class='col-xs-9'>" . display_estimate_price($master['price']) . "</dd>";

										echo "<dt class='col-xs-3'>최고견적</dt><dd class='col-xs-9'>" . display_estimate_price($master['price']) . "</dd>";
									} else {
										if ($e_type == "2") {
											echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>- 명</dd>";
											echo "<dt class='col-xs-3'>최저가적</dt><dd class='col-xs-9'>- 원</dd>";
											echo "<dt class='col-xs-3'>최고견적</dt><dd class='col-xs-9'>- 원</dd>";
										}
									}
								} else if ($state == "2") {
									echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>" . $master['price_qty'] . "명</dd>";
									if ($e_type == "2") {
										echo "<dt class='col-xs-3'>최저견적</dt><dd class='col-xs-9'>" . display_estimate_price($master['price']) . "</dd>";
									} else {
										echo "<dt class='col-xs-3'>최고견적</dt><dd class='col-xs-9'>" . display_estimate_price($master['price']) . "</dd>";
									}
								} else if ($state == "3") {
									echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>" . $centerCnt . "명</dd>";
								} else {
									echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>" . $centerCnt . "명</dd>";
								}

								?>

								<dt class="col-xs-3">지역</dt>
								<dd class="col-xs-9"><?php echo $master['area1']; ?> <?php echo $master['area2']; ?> <?php echo $master['place']; ?></dd>
								<dt class="col-xs-3">층수</dt>
								<dd class="col-xs-9"><?php echo $master['elevator_yn'] . " / " . $master['floor'] . "층" ?></dd>
								<dt class="col-xs-3">예산</dt>
								<dd class="col-xs-9"><?php echo number_format($master['price']) . '원'; ?></dd>

								<?php
								if ($propose_select['selected'] != '1') {
									echo "<dt class='col-xs-3'>견적마감일</dt>"; ?>
									<dd class='col-xs-9'>
										<?php
										if (intval(strtotime($master['date_close']) - strtotime(date("Y-m-d")) / 86400) == 0) {
											echo $master['date_close'];
										} else {
											echo 'D-' . intval(strtotime($master['date_close']) - strtotime(date("Y-m-d"))) / 86400;
										}
										?>
									</dd>
								<?php
									echo "<dt class='col-xs-3'>배송요청일</dt><dd class='col-xs-9'>" . $master['date_req'] . "</dd>";
								} else {
									if ($propose_select['completetime']) {

										echo "<dt class='col-xs-3'>배송확정일</dt><dd class='col-xs-9'>" . $propose_select['completetime'] . "</dd>";
									} else {

										echo "<dt class='col-xs-3'>배송요청일</dt><dd class='col-xs-9'>" . $master['date_req'] . "</dd>";
									}
								}
								?>
							</dl>
							<?php
							if ($master['attach_file']) {
								echo "<dt class='col-xs-3'>첨부파일</dt><dd class='col-xs-9'><a href='" . G5_DATA_URL . '/estimate/' . $master['attach_file'] . "' style='height:23px;line-height:25px;'>다운로드</a></dd>";
							}
							?>
							<?php
							if ($state == "0" || $state == "1") {
								echo "<ul class='row'>";
								echo "<li class='col-xs-6'></li>";
								echo "<li class='col-xs-6'>";
								echo "<a class='main_bg' href='javascript:doCancel()'>";
								echo "견적취소";
								echo "</a>";
								echo "</li>";
								echo "</ul>";
							}
							?>
						</td>
					</tr>
				</table>
				<div class="web">
					<div class="warning" id="divWaring">
						<?php
						if ($state == "2") {
							echo "<h1 class='text-center main_co'>견적이 완료되었습니다.업체를 선택해주세요</h1>";;
						} else if ($state == "3") {
							if (!$propose_select['completetime']) {
								echo "<h1 class='text-center main_co '>업체서 물품 확정 후 결제가 진행 됩니다.</h1>";
							} else {
							}
						}
						?>
					</div>

				</div>
				<div class="form-group">
					<ul class="tab">
						<li class="col-xs-3" id="selectGubun1">
							<a href="javascript:doChangeSelect('1')">
								<h4>업체선택</h4>
							</a>

						</li>
						<?php if ($state == "1" || $state == "2") { ?>
							<li class="col-xs-3" id="selectGubun2">
								<a href="javascript:doChangeSelect('2')">
									<h4>추천업체</h4>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
				<ul class="shop_list" id="proposeList">
					<?php
					if ($centerCnt > 0) {
						if ($state == "3" || $state == "4" || $state == "5" || $state == "8" || $state == "9") {
							$sql = " select
										a.*,
										round(avg(a.score),1) as score,
										round(avg(a.score)/5 * 100,0) as rate,
										count(*) as cnt
									from
										g5_estimate_match_propose a
										join g5_estimate_match b on a.no_estimate = b.no_estimate
									where
										ifnull(a.review,'') !=  ''
										and a.rc_email = '{$propose_success['rc_email']}'
									group by a.rc_email ";

							$score_row = sql_fetch($sql);

							$score = $score_row['score'];
							echo "<li>";
							echo "<div>";
							echo "<div class='img'><img src = '/data/estimate/" . $propose_select['mb_photo_site'] . "' ><p id='partner_show' onclick='show_partner_detail(\"" . $propose_select['rc_email'] . "\")'>업체소개</p></div>";
							echo "<div class='text'>";
							if ($score > 0 && $score_row['cnt'] > 0) {
								if ($score < 1) {
									echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
								} else if ($score < 2) {
									echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
								} else if ($score < 3) {
									echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
								} else if ($score < 4) {
									echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
								} else if ($score < 5) {
									echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
								} else {
									echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
								}
								echo "<a class='re_btn' href='javascript:doReview(\"" . $propose_success['rc_email'] . "\",\"" . $propose_success['score'] . "\")'>후기보기 <i class='xi-angle-right-min'></i></a>";
							}

							echo "<h4>" . $propose_select['mb_name'] . "</h4>";
							echo "</div>";
							echo "<div class='btn_list'>";
							echo "<ul class='row'>";
							echo "<li class='col-xs-11'>";
							echo "<p style='margin-bottom:10px;' class='main_co'>업체 판매가 " . number_format($propose_select['amt0'] + $propose_select['amt1'] + $propose_select['amt2'] + $propose_select['amt3'] + $propose_select['amt4'] + $propose_select['amt5'] + $propose_select['amt6'] + $propose_select['amt7'] + $propose_select['amt8'] + $propose_select['amt9'] + $propose_select['amt10'] + $propose_select['shipping']) . "원</p>";
							echo "</li>";

							echo "<li class='col-xs-11'>";
							echo "<a class='line_bg' href='javascript:doPriceDetails(\"" . $propose_select['no_estimate'] . "\",\"" . $propose_select['rc_email'] . "\")'>상세견적</a>";
							echo "<a class='sub_bg' href='javascript:'>선택완료</a>";
							echo "</li>";
							echo "</ul>";
							echo "</div>";
							echo "</div>";
							echo "</li>";
						} else if ($state == "1" || $state == "2") {
							for ($i = 0; $row = sql_fetch_array($propose_process); $i++) {
								$sql = " select
											a.rc_email,
											round(avg(a.score),1) as score,
											round(avg(a.score)/5 * 100,0) as rate,
											count(*) as cnt
										from
											g5_estimate_match_propose a
											join g5_estimate_match b on a.no_estimate = b.no_estimate
										where
											ifnull(a.review,'') !=  ''
											and a.rc_email = '{$row['rc_email']}'
										group by a.rc_email ";

								$score_row = sql_fetch($sql);

								$score = $score_row['score'];

								echo "<li>";
								echo "<div>";
								echo "<div class='img'><img src = '/data/estimate/" . $row['mb_photo_site'] . "' ><p id='partner_show' onclick='show_partner_detail(\"" . $row['rc_email'] . "\")'>업체소개</p></div>";

								echo "<div class='text'>";
								if ($score > 0 && $score_row['cnt'] > 0) {
									if ($score < 1) {
										echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
									} else if ($score < 2) {
										echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
									} else if ($score < 3) {
										echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
									} else if ($score < 4) {
										echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
									} else if ($score < 5) {
										echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
									} else {
										echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
									}
									echo "<a class='re_btn' href='javascript:doReview(\"" . $row['rc_email'] . "\",\"" . $row['score'] . "\")'>후기보기 <i class='xi-angle-right-min'></i></a>";
								}
								echo "<h4>" . $row['mb_name'] . "</h4>";

								echo "</div>";
								echo "<div class='btn_list'>";
								echo "<ul class='row'>";
								echo "<li class='col-xs-11'>";
								echo "<p style='margin-bottom:10px;' class='main_co'>업체 판매가 " . number_format($row['amt0'] + $row['amt1'] + $row['amt2'] + $row['amt3'] + $row['amt4'] + $row['amt5'] + $row['amt6'] + $row['amt7'] + $row['amt8'] + $row['amt9'] + $row['amt10'] + $row['shipping']) . "원</p>";
								echo "</li>";
								echo "<li class='col-xs-11'>";

								echo "<a class='line_bg' href='javascript:doPriceDetail(\"" . $row['no_estimate'] . "\",\"" . $row['rc_email'] . "\")'>상세견적</a>";

								echo "</li>";
								echo "<li class='col-xs-11'>";

								echo "<a class='main_bg' href='javascript:doSelect(\"" . $row['mb_name'] . "\",\"" . $row['no_estimate'] . "\")'>업체선택</a>";
								echo "</li>";
								echo "</ul>";
								echo "</div>";
								echo "</div>";
								echo "</li>";
							}
						}
					} else {
						echo "<li class='no_data'><div><i class='xi-error-o'></i>업체 견적이 들어오지 않았습니다.</div></li>";
					}
					?>

				</ul><!-- shop_list -->
				<ul class="shop_list" id="selectList">
					<?php
					if ($state == "1" || $state == "2") {
					?>
						<?php
						$sql = " select a.*, case when b.rc_email is not null then 'Y' else 'N' end as request_yn, b.estimate_yn from {$g5['member_table']} a left join g5_estimate_request_match b on a.mb_email = b.rc_email and b.no_estimate = '$no_estimate ' ";

						$area1 = $master['area1'];
						$area2 = $master['area2'];
						$sql .= "where mb_show_type = 1 and mb_match = 1 and mb_id in ( select mb_id from {$g5['member_area_table']} where 1=1 and ( ( mb_area1 = '$area1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$area1' and mb_area2 = '$area2'))) ";
						$sql .= " and mb_email not in ( select rc_email from g5_estimate_match_propose where no_estimate = '$no_estimate ') ";
						$sql .= " order by mb_biz_score desc limit 8";

						$request_list = sql_query($sql);
						for ($i = 0; $row = sql_fetch_array($request_list); $i++) {
							$sql = " select
										a.rc_email,
										round(avg(a.score),1) as score,
										round(avg(a.score)/5 * 100,0) as rate,
										count(*) as cnt
									from
										g5_estimate_match_propose a
										join g5_estimate_match b on a.no_estimate = b.no_estimate
									where
										ifnull(a.review,'') !=  ''
										and a.rc_email = '{$row['mb_email']}'
									group by a.rc_email ";

							$score_row = sql_fetch($sql);

							$score = $score_row['score'];
							echo "<li>";
							echo "<div>";
							echo "<div class='img'><img src = '/data/estimate/" . $row['mb_photo_site'] . "' ><p id='partner_show' onclick='show_partner_detail(\"" . $row['mb_email'] . "\")'>업체소개</p></div>";
							echo "<div class='text'>";
							if ($score > 0 && $score_row['cnt'] > 0) {
								if ($score < 1) {
									echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
								} else if ($score < 2) {
									echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
								} else if ($score < 3) {
									echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
								} else if ($score < 4) {
									echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
								} else if ($score < 5) {
									echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
								} else {
									echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
								}
								echo "<a class='re_btn' href='javascript:doReview(\"" . $row['mb_email'] . "\",\"" . $row['mb_biz_score'] . "\")'>후기보기 <i class='xi-angle-right-min'></i></a>";
							}
							echo "<h4>" . $row['mb_name'] . "</h4>";
							echo "</div>";
							echo "<div class='btn_list'>";
							echo "<ul class='row'>";

							if ($row['estimate_yn']) {
								echo "<a class='sub_bg' href='javascript:' style='background:#da1a1a !important; color:#fff;'>배송불가</a>";
							} else {
								if ($row['request_yn'] == "Y") {
									echo "<a class='sub_bg' href='javascript:'>문의중</a>";
								} else {
									echo "<a class='main_bg' href='javascript:doRequest(\"" . $no_estimate . "\",\"" . $row['mb_email'] . "\")'>문의하기</a>";
								}
							}
							echo "</ul>";
							echo "</div>";
							echo "</div>";
							echo "</li>";
						}
						?>
					<?php
					}
					?>
				</ul>
				<?php
				if ($state == "3" || $state == "4" || $state == "5" || $state == "8" || $state == "9") {
					if ($master['req_payment'] != '1') {

				?>

						<ul class="row web">
							<li class="co1-10">
								<a style="width: 100%; padding: 10px 0px; text-align: center; font-size: 18px; display: block; background-color: #ccc;" href='#'>물품 결제</a> <!-- 0403 전화하기 추가-->
							</li>
						</ul>
						<div id="btn_test" class="btn_wrap">
							<ul class="row">
								<!-- <li class="co1-10">
                				<a class='sub_bg_call' href='javascript:doTel("<?php echo $propose_select['mb_hp'] ?>")'>선택업체 전화하기</a> 
                			</li> -->
								<li class="co1-10">
									<a style="background-color: #ccc;" href='#'>물품 결제</a> <!-- 0403 전화하기 추가-->
								</li>
							</ul>
						</div>
					<?php
					} else {
						$price_total = $propose_select['amt0'] + $propose_select['amt1'] + $propose_select['amt2'] + $propose_select['amt3'] + $propose_select['amt4'] + $propose_select['amt5'] + $propose_select['amt6'] + $propose_select['amt7'] + $propose_select['amt8'] + $propose_select['amt9'] + $propose_select['amt10'] + $propose_select['shipping'];
					?>
						<script language="javascript" type="text/javascript" src="https://stdpay.inicis.com/stdjs/INIStdPay.js" charset="UTF-8"></script>

						<ul class="row web">
							<li class="co1-10">
								<!-- <button class="main_bg web" onclick="INIStdPay.pay('SendPayForm_id')" style="padding:10px; margin-left:10%">결제요청</button> -->
								<?php if ($master['pay_confirm'] == '0') { ?>
									<input class="main_bg mobile pay_now" type="button" value="물품 결제">
								<?php } else if ($master['pay_confirm'] == '2') { ?>
									<input class="main_bg mobile" type="button" value="<?php echo '입금계좌 : ' . $shop['od_cash_no']; ?>">
									<input class="main_bg mobile" type="button" value="<?php echo $shop['od_cash_info']; ?>">
									<input class="main_bg mobile vbank_refund" type="button" value="환불계좌를 선택해주세요.">
									<!--
								  <input class="main_bg mobile" type="button" value="환불은행을 선택해주세요." >
								  <select id="vbank_name" name="vbank_name" style="margin-top:1.5rem;">
									<option value="03">기업은행</option>
									<option value="07">수협은행</option>
									<option value="11">NH농협은행</option>
									<option value="20">우리은행</option>
									<option value="23">SC은행</option>
									<option value="31">대구은행</option>
									<option value="32">부산은행</option>
									<option value="34">광주은행</option>
									<option value="37">전북은행</option>
									<option value="39">경남은행</option>
									<option value="53">한국씨티은행</option>
									<option value="71">우체국</option>
									<option value="81">하나은행</option>
									<option value="88">신한은행</option>
									<option value="89">케이은행</option>
								  </select>

								  <input class="main_bg mobile" type="button" value="환불계좌를 작성해주세요." >
								  <input type="number" id="refund_account" name="refund_account" style="margin-top:1.5rem;">
								  <input class="main_bg mobile" id="write_complete" type="button" value="작성완료">
								  -->
								<?php } else if ($master['pay_confirm'] == '3') { ?>
									<input class="main_bg mobile" type="button" value="입금대기중">
									<input class="main_bg mobile" type="button" value="<?php echo '입금계좌 : ' . $shop['od_cash_no']; ?>">
									<input class="main_bg mobile" type="button" value="<?php echo $shop['od_cash_info']; ?>">
								<?php } else { ?>
									<input class="main_bg mobile" type="button" value="물품결제완료">
								<?php } ?>
								<!-- <a class="main_bg" style="width: 100%; padding: 10px 0px; text-align: center; font-size: 18px; display: block;" href='#'>물품 결제</a> -->
								<!-- 0403 전화하기 추가-->
							</li>
						</ul>
						<!--<div id="btn_test" class="btn_wrap">-->
						<ul class="row mob">
							<!-- <li class="co1-10">
                				<a class='sub_bg_call' href='javascript:doTel("<?php echo $propose_select['mb_hp'] ?>")'>선택업체 전화하기</a> 
                			</li> -->
							<li class="co1-10">
								<?php if ($master['pay_confirm'] == '0') { ?>
									<input class="main_bg mobile pay_now" type="button" value="물품 결제">
								<?php } else if ($master['pay_confirm'] == '2') { ?>
									<input class="main_bg mobile" type="button" value="<?php echo $shop['od_cash_no']; ?>">
									<input class="main_bg mobile" type="button" value="<?php echo $shop['od_cash_info']; ?>">
									<input class="main_bg mobile vbank_refund" type="button" value="환불계좌를 선택해주세요.">
								<?php } else if ($master['pay_confirm'] == '3') { ?>
									<input class="main_bg mobile" type="button" value="입금대기중">
									<input class="main_bg mobile" type="button" value="<?php echo '입금계좌 : ' . $shop['od_cash_no']; ?>">
									<input class="main_bg mobile" type="button" value="<?php echo $shop['od_cash_info']; ?>">
								<?php } else { ?>
									<input class="main_bg mobile" type="button" value="물품결제완료">
								<?php } ?>
								<!--<a class="main_bg mobile pay_now" href='#'>물품 결제</a>-->
								<!-- 0403 전화하기 추가-->
							</li>
						</ul>
						<!--</div>-->
				<?php }
				}
				?>

				<h1 class="tt" id="detailTitle">상세정보</h1>
				<table class="requst_list02" id="subList">
					<?php

					echo "<tr>";
					echo "<th>카테고리</th>";
					echo "<th>품목</th>";
					echo "<th>수량</th>";
					echo "</tr>";

					for ($i = 0; $row_info = sql_fetch_array($info); $i++) {
						echo "<tr>";
						echo "<td>" . $row_info['cate'] . "</td>";
						echo "<td>" . $row_info['item_cat_dtl_s'] . $row_info['cate_name'] . "</td>";
						echo "<td>" . $row_info['qty'] . "</td>";
						echo "</tr>";
					}
					/*echo "<tr>";
					echo "<th>참고사항</th>";
					echo "<td class='web_td' colspan='5'>".$master['content']."</td>";
					echo "<td class='mob_td' colspan='4'>".$master['content']."</td>";
					echo "</tr>";*/

					?>
				</table>

				<?php
				$sql = " select count(*) as cnt from g5_estimate_match_propose where no_estimate = '$no_estimate' and ifnull(content,'') != '' ";
				$request_cnt = sql_fetch($sql);
				if ($request_cnt['cnt'] > 0) {
					$sql = " select * from g5_estimate_match_propose where no_estimate = '$no_estimate ' and ifnull(content,'') != '' ";
					$request_list = sql_query($sql);
					echo '<div class="text_note" id="partnerNote" style="margin-top:30px;">';
					echo '<h1>업체 견적 참고사항</h1>';
					for ($i = 0; $row = sql_fetch_array($request_list); $i++) {
						echo '<p>' . $row['rc_nickname'] . ' - ' . $row['content'] . '</p>';
					}
					echo '</div>';
				}
				?>

				<div id="divRreview">
					<?php
					if ($state == "5") {
						if ($propose_select['score'] == 0) {
							echo "<h1 class='tt'>고객후기 <a class='main_bg' href='javascript:doAddReview();'>후기작성</a></h1>";
						} else {
							$score = $propose_review['score'];
							echo "<h1 class='tt'>고객후기</h1>";
							echo "<table class='re_view'>";
							echo "<colgroup class='web_col'>";
							/*echo "<col style='width: 15%' />";*/
							echo "<col style='width: 85%' />";
							echo "</colgroup>";
							echo "<tr>";
							// if($propose_review['photo1']){
							// 	echo "<th>".estimate_img_thumbnail($propose_review['photo1'], 100, 100)."</th>";
							// }else{
							// 		echo "<th>".estimate_img_thumbnail($photo['photo'], 100, 100)."</th>";
							// }
							echo "<td>";
							echo "<div class='sub_tt'>" . $propose_review['title'] . "</div>";
							echo "<div class='con'>" . $propose_review['review'] . "</div>";
							echo "<div class='icon'>";
							if ($score < 1) {
								echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
							} else if ($score < 2) {
								echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
							} else if ($score < 3) {
								echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
							} else if ($score < 4) {
								echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
							} else if ($score < 5) {
								echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
							} else {
								echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
							}
							echo "</div>";
							echo "<div class='date'>작성자 : " . $propose_review['nickname'] . " ㅣ 등록일 : " . $propose_review['updatetime'] . "</div>";
							echo "</td>";
							echo "</tr>";
							echo "</table>";
						}
					}
					?>
				</div>

			</div><!-- view -->

			<div class="btn_wrap">
				<ul class="row">
					<li class="col-xs-3 col-xs-offset-9 col-md-1 col-md-offset-11">
						<a class="main_bg" href="./my_estimate_list.php?page=<?php echo $page; ?>">리스트</a>
					</li>
				</ul>
			</div>

		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->

<div class="modal fade" id="modal_review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">이용후기</h4>
			</div>
			<div class="modal-body" id="modal_review_content">
				<div id="board">
					<div class="form-group">
						<p class="text-right" id="reviewTitle">

						</p>
					</div>
					<div id="board">
						<div class="photo_list">
							<table id="reviewList"></table>
						</div>
					</div>

					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						</ul>
					</div><!-- btn_wrap -->

				</div><!-- board -->
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 이용후기 -->

<div class="modal fade" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">업체 소개</h4>
			</div>
			<div class="modal-body" id="modal_info_content">
				<div id="board">
					<div class="form-group">
						<p class="text-right" id="reviewTitle">

						</p>
					</div>
					<div id="board">
						<div class="photo_list">
							<table id="reviewList"></table>
						</div>
					</div>

					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						</ul>
					</div><!-- btn_wrap -->

				</div><!-- board -->
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 이용후기 -->

<div class="modal fade" id="modal_select" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<form name="frmselect" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_select_match.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" id="no_estimate" name="no_estimate" value="<?php echo $master['no_estimate']; ?>">
					<div class="text-center">
						<i class="xi-error-o"></i>
						<p id="selectBiz">재활용센터 선택하시겠습니까?</p>
						<input type="hidden" id="rc_nickname" name="rc_nickname" value="">
						<input type="hidden" id="requesttime" name="requesttime" value="<?php echo $master['pickup_date']; ?>">
					</div>
				</form>
				<div class="btn_wrap">
					<ul class="row">
						<li class="col-xs-3 col-xs-offset-3"><a class="line_bg" href="#." data-dismiss="modal">닫기</a></li>
						<li class="col-xs-3"><a class="main_bg" href="javascript:doSelectComplete();">확인</a></li>
					</ul>
				</div>

			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 선택 -->

<div class="modal fade" id="modal_select_complete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				<div class="text-center">
					<i class="xi-error-o"></i>
					<p id="selectCompleteBiz"></p>
					<p>선택 완료했습니다<br />곧 연락예정입니다</p>
				</div>

				<div class="btn_wrap">
					<ul class="row">
						<li class="col-xs-4 col-xs-offset-4"><a class="main_bg" href="#." onClick="doSelectCompleteEnd();">확인</a></li>
					</ul>
				</div>

			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 선택 -->

<div class="modal fade" id="modal_add_review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">후기작성</h4>
			</div>
			<div class="modal-body">
				<div id="board">
					<form name="frmreview" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_review_update_match.php" method="post" enctype="multipart/form-data" autocomplete="off">
						<input type="hidden" id="no_estimate" name="no_estimate" value="<?php echo $master['no_estimate']; ?>">
						<div class="write">
							<table>
								<colgroup>
									<col style="width: 20%" />
									<col style="width: 80%" />
								</colgroup>
								<tr>
									<th>평점</th>
									<td>
										<select class="input_default" id="score" name="score">
											<option value="5">5.0/5.0</option>
											<option value="4">4.0/5.0</option>
											<option value="3">3.0/5.0</option>
											<option value="2">2.0/5.0</option>
											<option value="1">1.0/5.0</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>후기내역</th>
									<td>
										<textarea id="review" name="review" placeholder="내용을 작성해주세요" style="height:200px;"></textarea>
									</td>
								</tr>
							</table>
						</div>
					</form>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-3 col-xs-offset-3"><a class="line_bg" href="javascript:doCloseReview()" data-dismiss="modal">닫기</a></li>
							<li class="col-xs-3"><a class="main_bg" href="javascript:doSaveReview()">확인</a></li>
						</ul>
					</div><!-- btn_wrap -->

				</div><!-- board -->
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 이용후기 -->

<div class="modal fade modal_table" id="modal_price_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">상세견적서</h4>
			</div>
			<div class="modal-body">
				<form id="frmPrice">


				</form>
			</div>
		</div>
	</div>
</div><!-- 견적 -->
<div class="modal fade modal_table" id="modal_payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="margin-top:20rem;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">결제</h4>
			</div>
			<div class="modal-body" style="padding-top:0;">
				<div class="form-group one_line" style="border:0 !important; padding-bottom:0; margin-top:3rem;">
					<ul class="row text-center">
						<li class="col-xs-12" style="margin-bottom:2rem;">
							<!--
							<label style="width: 50%;" class="box">
							<input type="button" id="card"  value="card" ><i><p>카드</p></i></label>
							-->
							<button class="btn btn-primary" id="card" value="card" style="width:15rem; height:5rem; font-size:2rem;">카드</button>
						</li>
						<li class="col-xs-12" style="margin-bottom:2rem;">
							<button class="btn btn-success" id="vbank" value="vbank" style="width:15rem; height:5rem; font-size:2rem;">가상계좌</button>
						</li>
					</ul>

				</div>
			</div>
		</div>
	</div>
</div><!-- 견적 -->

<div class="modal fade modal_table" id="modal_refund" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="margin-top:20rem;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">환불계좌</h4>
			</div>
			<div class="modal-body" style="padding-top:0;">
				<div class="form-group one_line" style="border:0 !important; padding-bottom:0; margin-top:3rem;">
					<div class="text-center" id="area_after">
						<div class="form-group">
							<input type="hidden" name="mb_bank" id="mb_bank" value="NH농협">
							<select id="vbank_name">
								<option value="03">기업은행</option>
								<option value="07">수협은행</option>
								<option value="11">NH농협은행</option>
								<option value="20">우리은행</option>
								<option value="23">SC은행</option>
								<option value="31">대구은행</option>
								<option value="32">부산은행</option>
								<option value="34">광주은행</option>
								<option value="37">전북은행</option>
								<option value="39">경남은행</option>
								<option value="53">한국씨티은행</option>
								<option value="71">우체국</option>
								<option value="81">하나은행</option>
								<option value="88">신한은행</option>
								<option value="89">케이은행</option>
							</select>
							<input id="mb_bank_txt" style="display: none; margin-top: 15px;" type="text" name="mb_bank_txt" placeholder="은행명">
						</div>
						<div class="form-group">
							<input type="number" id="refund_account" name="mb_bank_num" aria-describedby="계좌번호" placeholder="정산계좌번호">
						</div>
						<div class="form-group">
							<input type="text" id="refund_name" name="mb_bank_name" aria-describedby="예금주명" placeholder="예금주명">
						</div>
						<p>작성해주신 이름과 같아야 합니다. </p>
					</div>
				</div>
				<div class="btn_wrap">
					<ul class="row">
						<li class="col-xs-3 col-xs-offset-3"><a class="line_bg" href="#." data-dismiss="modal">닫기</a></li>
						<li class="col-xs-3" id="confirm_before"><a class="main_bg" id="write_complete" href="#none">확인</a></li>
						<li class="col-xs-3" id="confirm_after" style="display: none;"><a class="main_bg" href="javascript:doSelectComplete();">확인</a></li>
					</ul>
				</div>

			</div>
		</div>
	</div>
</div>
</div><!-- 견적 -->

<form name="frmpay" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_pay.php" method="post" enctype="multipart/form-data" autocomplete="off" class="frmpay">
	<input type="hidden" name="receipt_id" id="receipt_id">
	<input type="hidden" name="price_pay" id="price_pay">
	<input type="hidden" name="card_no" id="card_no">
	<input type="hidden" name="card_code" id="card_code">
	<input type="hidden" name="card_name" id="card_name">
	<input type="hidden" name="item_name" id="item_name">
	<input type="hidden" name="method" id="method">
	<input type="hidden" name="method_name" id="method_name">
	<input type="hidden" name="requested_at" id="requested_at">
	<input type="hidden" name="purchased_at" id="purchased_at">
	<input type="hidden" name="status" id="status">
</form>

<form name="frmcancel" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_cancel.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="no_estimate" name="no_estimate" value="<?php echo $master['no_estimate']; ?>">
	<input type="hidden" id="state" name="state" value="6">
	<input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
</form>
<form name="frmpay_confirm" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_match_pay.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="no_estimate" name="no_estimate" value="<?php echo $master['no_estimate']; ?>">
</form>
<?php
if (!$select_gubun) {
	$select_gubun = "1";
}

$order_id = "pay_" . $no_estimate;
$username = $mm["mb_name"];
$email = $mm["mb_id"];
$phone = $mm["mb_hp"];
?>
<?php
$sql = " select * from g5_estimate_match where no_estimate = '$no_estimate' ";
$user_infomation = sql_fetch($sql);

$money = number_format($propose_select['amt0'] + $propose_select['amt1'] + $propose_select['amt2'] + $propose_select['amt3'] + $propose_select['amt4'] + $propose_select['amt5'] + $propose_select['amt6'] + $propose_select['amt7'] + $propose_select['amt8'] + $propose_select['amt9'] + $propose_select['amt10'] + $propose_select['shipping']);



$money_items = $propose_select['item0'] . "`" . $propose_select['item1'] . "`" . $propose_select['item2'] . "`" . $propose_select['item3'] . "`" . $propose_select['item4'] . "`" . $propose_select['item5'] . "`" . $propose_select['item6'] . "`" . $propose_select['item7'] . "`" . $propose_select['item8'] . "`" . $propose_select['item9'] . "`" . $propose_select['item10'];



?>
<div>
	<!--아이템 고유정보-->
	<input type="hidden" id="pay_no_estimate1" value="<?php echo $user_infomation['no_estimate']; ?>">
	<!--유저이름-->
	<input type="hidden" id="pay_no_estimate2" value="<?php echo $user_infomation['name']; ?>">
	<!--전화번호-->
	<input type="hidden" id="pay_no_estimate3" value="<?php echo $user_infomation['number']; ?>">
	<!--이메일-->
	<input type="hidden" id="pay_no_estimate4" value="<?php echo $user_infomation['email']; ?>">
	<!--제목-->
	<input type="hidden" id="pay_no_estimate5" value="<?php echo $user_infomation['title']; ?>">
	<!--금액-->
	<input type="hidden" id="pay_no_estimate6" value="<?php echo $money; ?>">
	<!--주문 상품 개수-->
	<input type="hidden" id="pay_no_estimate7" value="<?php echo $money_items; ?>">
	<!--업체명-->
	<input type="hidden" id="pay_no_estimate8" value="<?php echo $propose_select['rc_email']; ?>">
</div>
<script type="text/javascript" src="/share/js/jquery.bxslider.js"></script>
<script src="https://cdn.bootpay.co.kr/js/bootpay-3.3.1.min.js" type="application/javascript"></script>
<!-- iamport.payment.js -->
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>

<script>
	var IMP = window.IMP; // 생략해도 괜찮습니다.
	IMP.init("imp03915712"); // "imp00000000" 대신 발급받은 "가맹점 식별코드"를 사용합니다.
	jQuery(document).ready(function() {
		/*
	$(".pay_now").click(function(){
		BootPay.request({
		price: '<?php echo $price_total; ?>', //실제 결제되는 가격
		application_id: "604e08cad8c1bd0024f4c045",
		name: '<?php echo $master["title"] ?>', //결제창에서 보여질 이름
		pg: 'inicis',
		show_agree_window: 0, // 부트페이 정보 동의 창 보이기 여부
		user_info: {
			username: '<?php echo $username ?>',
			email: '<?php echo $email ?>',
			phone: '<?php echo $phone ?>',
		},
		order_id: '<?php echo "pay_" . $no_estimate; ?>', //고유 주문번호로, 생성하신 값을 보내주셔야 합니다.
		params: {callback1: '그대로 콜백받을 변수 1', callback2: '그대로 콜백받을 변수 2', customvar1234: '변수명도 마음대로'},
		account_expire_at: '2021-03-20', // 가상계좌 입금기간 제한 ( yyyy-mm-dd 포멧으로 입력해주세요. 가상계좌만 적용됩니다. )
		extra: {
			end_at: '2022-05-10', // 정기결제 만료일 -  기간 없음 - 무제한
	        vbank_result: 1, // 가상계좌 사용시 사용, 가상계좌 결과창을 볼지(1), 말지(0), 미설정시 봄(1)
	        quota: '0,2,3', // 결제금액이 5만원 이상시 할부개월 허용범위를 설정할 수 있음, [0(일시불), 2개월, 3개월] 허용, 미설정시 12개월까지 허용,
			theme: 'purple', // [ red, purple(기본), custom ]
			custom_background: '#00a086', // [ theme가 custom 일 때 background 색상 지정 가능 ]
			custom_font_color: '#ffffff' // [ theme가 custom 일 때 font color 색상 지정 가능 ]
		}
	}).error(function (data) {
		//결제 진행시 에러가 발생하면 수행됩니다.
		
		console.log(data);
		
	}).cancel(function (data) {
		//결제 고유번호
		var no_estimate = $('#pay_no_estimate1').val();

		//결제유저
		var name = $('#pay_no_estimate2').val();

		//전화번호
		var number = $('#pay_no_estimate3').val();

		//이메일
		var email = $('#pay_no_estimate4').val();
		
		//제목
		var title = $('#pay_no_estimate5').val();

		//금액
		var money = $('#pay_no_estimate6').val();

		//상품수
		var money_items = $('#pay_no_estimate7').val();
		money_items = money_items.split('`');

		var items_count = 0;
		for(i=0; i<11; i++){
			if(money_items[i] != ""){
				items_count++;
			}
		}

		//업체명
		var company = $('#pay_no_estimate8').val();
		
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.pyment.cancel.php",
			data: {
				no_estimate:no_estimate,
				name:name,
				number:number,
				email:email,
				title:title,
				money:money,
				items_count:items_count,
				company:company
			},
			cache: false,
			success: function(data) {
				console.log('성공');	
			}
		});
		//결제가 취소되면 수행됩니다.
		console.log(data);
	}).ready(function (data) {
		// 가상계좌 입금 계좌번호가 발급되면 호출되는 함수입니다.
		console.log(data);
	}).confirm(function (data) {
		//결제가 실행되기 전에 수행되며, 주로 재고를 확인하는 로직이 들어갑니다.
		//주의 - 카드 수기결제일 경우 이 부분이 실행되지 않습니다.
		console.log(data);
		var enable = true; // 재고 수량 관리 로직 혹은 다른 처리
		if (enable) {
			BootPay.transactionConfirm(data); // 조건이 맞으면 승인 처리를 한다.
		} else {
			BootPay.removePaymentWindow(); // 조건이 맞지 않으면 결제 창을 닫고 결제를 승인하지 않는다.
		}
	}).close(function (data) {

		var obj = $.parseJSON(data);

		console.log(obj);
	    console.log(obj.price);

	}).done(function (data) {

		var values = Object.keys(data).map(function(i) { 
			return data[i]; 
		});

		console.log(data);
		document.frmpay_confirm.submit();

		//결제 고유번호
		var no_estimate = $('#pay_no_estimate1').val();

		//결제유저
		var name = $('#pay_no_estimate2').val();

		//전화번호
		var number = $('#pay_no_estimate3').val();

		//이메일
		var email = $('#pay_no_estimate4').val();

		//제목
		var title = $('#pay_no_estimate5').val();

		//금액
		var money = $('#pay_no_estimate6').val();

		//상품수
		var money_items = $('#pay_no_estimate7').val();
		money_items = money_items.split('`');

		var items_count = 0;
		for(i=0; i<11; i++){
			if(money_items[i] != ""){
				items_count++;
			}
		}

		//업체명
		var company = $('#pay_no_estimate8').val();
		
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.pyment.success.php",
			data: {
				no_estimate:no_estimate,
				name:name,
				number:number,
				email:email,
				title:title,
				money:money,
				items_count:items_count,
				company:company
			},
			cache: false,
			success: function(data) {
				console.log('성공');	
			}
		});

		});
	});	
*/

		$(".pay_now").click(function() {
			$("#modal_payment").modal("show");
			//imp();
		});

		$("#card").click(function() {

			//결제수단
			var p_method = 'card';

			//주문번호
			var p_uid = $('#pay_no_estimate1').val();

			//제목
			var p_name = $('#pay_no_estimate5').val();

			//금액
			var price = $('#pay_no_estimate6').val();

			//이메일
			var uemail = $('#pay_no_estimate4').val();

			//전화번호
			var umobile = $('#pay_no_estimate3').val();

			//결제유저
			var uname = $('#pay_no_estimate2').val();

			//상품수
			var money_items = $('#pay_no_estimate7').val();
			money_items = money_items.split('`');

			var items_count = 0;
			for (i = 0; i < 11; i++) {
				if (money_items[i] != "") {
					items_count++;
				}
			}

			//업체명
			var company = $('#pay_no_estimate8').val();

			imp(p_method, p_uid, p_name, price, uemail, umobile, uname, items_count, company);
		});

		$(".vbank_refund").click(function() {
			$("#modal_refund").modal("show");
		});

		$("#vbank").click(function() {

			//결제수단
			var p_method = 'vbank';

			//주문번호
			var p_uid = $('#pay_no_estimate1').val();

			//제목
			var p_name = $('#pay_no_estimate5').val();

			//금액
			var price = $('#pay_no_estimate6').val();

			//이메일
			var uemail = $('#pay_no_estimate4').val();

			//전화번호
			var umobile = $('#pay_no_estimate3').val();

			//결제유저
			var uname = $('#pay_no_estimate2').val();

			//상품수
			var money_items = $('#pay_no_estimate7').val();
			money_items = money_items.split('`');

			var items_count = 0;
			for (i = 0; i < 11; i++) {
				if (money_items[i] != "") {
					items_count++;
				}
			}

			//업체명
			var company = $('#pay_no_estimate8').val();

			imp(p_method, p_uid, p_name, price, uemail, umobile, uname, items_count, company);
		});

		$("#write_complete").click(function() {
			//주문번호
			var p_uid = $('#pay_no_estimate1').val();

			//이메일
			var uemail = $('#pay_no_estimate4').val();

			//환불은행
			var vbank_name = $("#vbank_name").val();

			//환불계좌
			var refund_account = $("#refund_account").val();

			//환불이름
			var refund_name = $("#refund_name").val();

			$.ajax({
				url: "ajax_confirm_refund.php",
				type: "post",
				dataType: "json",
				data: {
					p_uid: p_uid,
					uemail: uemail,
					vbank_name: vbank_name,
					refund_account: refund_account,
					refund_name: refund_name
				},
				error: function(request, status, error) {
					alert("code = " + request.status +
						" message = " + request.responseText +
						" error = " + error); // 실패 시 처리
				},

			}).done(function(data) {
				if (data.ret == true) {
					alert(data.msg);
					location.reload();
				} else {
					alert(data.msg);
				}
			});
		});

		function imp(p_method, p_uid, p_name, price, uemail, umobile, uname, items_count, company) {

			IMP.init('imp34946134'); //iamport 대신 자신의 "가맹점 식별코드"를 사용하시면 됩니다
			var regex = new RegExp(',', 'g');
			price = price.replace(regex, '');

			//모바일 구분자
			var mobile = 'yes';

			var redirect_url = null;

			if (p_method == 'card') {
				redirect_url = 'https://repickus.com/estimate/ajax_confirm_payment.php?no_estimate=' + p_uid + '&&p_uid=' + p_uid + '&&mobile=' + mobile + '&&amount=' + price + '&&p_name=' + p_name + '&&uname=' + uname + '&&uemail=' + uemail + '&&umobile=' + umobile + '&&items_count=' + items_count + '&&company=' + company;
			} else {
				redirect_url = 'https://repickus.com/estimate/ajax_confirm_vbank.php?no_estimate=' + p_uid + '&&p_uid=' + p_uid + '&&mobile=' + mobile + '&&amount=' + price + '&&p_name=' + p_name + '&&uname=' + uname + '&&uemail=' + uemail + '&&umobile=' + umobile + '&&items_count=' + items_count + '&&company=' + company;
			}

			IMP.request_pay({
					pg: 'html5_inicis', //필수
					pay_method: p_method, //필수
					merchant_uid: p_uid + '_' + new Date().getTime(), //필수
					name: p_name, //필수(주문명 보통 상품명 입력함)
					amount: price, //필수
					buyer_email: uemail,
					buyer_name: uname,
					buyer_tel: umobile, //필수
					//buyer_addr : uaddr,
					//buyer_postcode : '123-456',
					app_scheme: 'iamportapp',
					m_redirect_url: redirect_url //결제완료 후 이동될 페이지 주소를 지정해주세요. query string이 추가되
					//m_redirect_url : 'https://repickus.com/estimate/my_estimate_form_match_sa.php?no_estimate=' + p_uid //결제완료 후 이동될 페이지 주소를 지정해주세요. query string이 추가되어 전달됩니다.
				},
				function(rsp) { // callback
					if (rsp.success) {
						//위의 parameter 들을 보내서 결제 동작을 한경우

						//결제 성공 검증 후 가맹점 서버에 내용 기록
						var imp_uid = rsp.imp_uid; //iamport 거래고유번호
						var merchant_uid = rsp.merchant_uid; //iamport 주문번호
						var amount = price; //결제된 금액
						var apply_num = rsp.apply_num; //카드승인 번호
						var vbank_name = rsp.vbank_name //가상계좌 은행사
						var vbank_num = rsp.vbank_num //가상계좌번호

						if (p_method == 'card')
						//카드결제
						{
							$.ajax({
								url: "ajax_confirm_payment.php",
								type: "post",
								dataType: "json",
								data: {
									p_uid: p_uid,
									imp_uid: imp_uid,
									merchant_uid: merchant_uid,
									amount: amount,
									p_name: p_name,
									uname: uname,
									uemail: uemail,
									umobile: umobile,
									//uaddr : uaddr,
									apply_num: apply_num,
									items_count: items_count,
									company: company
								},
								error: function(request, status, error) {
									alert("code = " + request.status +
										" message = " + request.responseText +
										" error = " + error); // 실패 시 처리
								},

							}).done(function(data) {
								//console.log("test");
								if (data.ret == true) {
									document.frmpay_confirm.submit();
								} else {
									alert(data.msg);
								}
							});

						} else
						//가상계좌	
						{
							//document.frmpay_confirm.submit();
							//alert(imp_uid);//imp_417225010233
							$.ajax({
								url: "ajax_confirm_vbank.php",
								type: "post",
								dataType: "json",
								data: {
									p_uid: p_uid,
									imp_uid: imp_uid,
									merchant_uid: merchant_uid,
									amount: amount,
									p_name: p_name,
									uname: uname,
									uemail: uemail,
									umobile: umobile,
									//uaddr : uaddr,
									vbank_name: vbank_name,
									vbank_num: vbank_num,
									items_count: items_count,
									company: company
								},

								error: function(request, status, error) {
									alert("code = " + request.status +
										" message = " + request.responseText +
										" error = " + error); // 실패 시 처리
								},

							}).done(function(data) { //200정상.
								//console.log("test");

								if (data.ret == true) {
									location.reload();
									//document.frmpay_confirm.submit();
									alert(data.msg);
								} else {

									//alert(data.msg);
								}

							});
						}
					} else {
						// 결제 동작 자체를 실패 한 경우
						/*
						var msg = '결제에 실패하였습니다.';
						msg += '에러내용 : ' + rsp.error_msg;
						*/

						var msg = rsp.error_msg;

						alert(msg);
					}
				}
			);
		}

		doChangeSelect("<?php echo $select_gubun ?>");

		$('#view_slider').bxSlider({
			auto: false, // 자동 슬라이드 사용여부
			controls: false, // 양옆컨트롤(prev/next) 사용여부
			slideWidth: 200,
			minSlides: 3,
			maxSlides: 3,
			speed: 1000,
			preloadImages: 'all',
			pager: true,
		});

		$('#bx-pager').bxSlider({
			minSlides: 5,
			maxSlides: 5,
			slideWidth: 200,
			slideMargin: 5,
			controls: true,
			pager: false
		});

		/*	$('#mob_view_slider').bxSlider({
				auto: false,					// 자동 슬라이드 사용여부
				controls: true,				// 양옆컨트롤(prev/next) 사용여부
				speed: 1000,
				preloadImages: 'all',
				pager : false,
				oneToOneTouch : false
			});*/
	});


	function doChangeSelect(gubun) {
		if (gubun == "1") {
			$("#selectGubun1").removeClass("on");
			$("#selectGubun2").removeClass("on");
			$("#selectGubun1").addClass("on");
			$("#proposeList").show();
			$("#detailTitle").show();
			$("#subDetail").show();
			$("#subList").show();
			$("#partnerNote").show();
			$("#divRreview").show();
			$("#selectList").hide();
		} else {
			$("#selectGubun1").removeClass("on");
			$("#selectGubun2").removeClass("on");
			$("#selectGubun2").addClass("on");
			$("#proposeList").hide();
			$("#detailTitle").hide();
			$("#subDetail").hide();
			$("#subList").hide();
			$("#partnerNote").hide();
			$("#divRreview").hide();
			$("#selectList").show();
		}
	}

	function doReview(rcEmail, score) {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.review.modal.php",
			data: {
				rc_email: rcEmail
			},
			cache: false,
			success: function(data) {
				$("#modal_review_content").html(data);

				$("#modal_review").modal();
			}
		});
	}

	function show_partner_detail(rcEmail) {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.partner_info.modal.php",
			data: {
				rc_email: rcEmail
			},
			cache: false,
			success: function(data) {
				$("#modal_info").html(data);
				$("#modal_info").modal();

			}
		});
	}

	function doAddReview() {
		$("#score").val("5");
		$("#review").val("");
		$('#modal_add_review').modal();
	}

	function doSaveReview() {

		var f = document.frmreview;
		if (!f.review.value) {
			alert("내용을 작성해주세요");
			return;
		}
		f.submit();
	}

	function doCloseReview() {
		$('#modal_add_review').modal("hide");
	}

	function doCancel() {
		if (!confirm("견적을 취소하시겠습니까?")) return;
		var f = document.frmcancel;
		f.submit();
	}

	function doSelect(bizName, no_estimate) {
		//$("#selectBiz").html(bizName);
		$("#selectBiz").html(bizName + " 선택하시겠습니까?");
		var f = document.frmselect;
		f.no_estimate.value = no_estimate;
		f.rc_nickname.value = bizName;
		$("#modal_select").modal();
	}

	function doSelectComplete() {
		var f = document.frmselect;
		f.submit();

	}

	function doPriceDetail(no_estimate, rcEmail) {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.price.modal_match.php",
			data: {
				no_estimate: no_estimate,
				rc_email: rcEmail
			},
			cache: false,
			success: function(data) {
				$("#frmPrice").html(data);

				$("#modal_price_detail").modal();
			}
		});
	}

	function doPriceDetails(no_estimate, rcEmail) {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.price.modal_match.php",
			data: {
				no_estimate: no_estimate,
				rc_email: rcEmail
			},
			cache: false,
			success: function(data) {
				$("#frmPrice").html(data);

				$("#modal_price_detail").modal();
			}
		});
	}

	function doRequest(no_estimate, email) {
		if (confirm("문의 하시겠습니까?")) {
			var f = document.frmrequest;
			f.no_estimate.value = no_estimate;
			f.email.value = email;
			f.submit();
		}
	}

	function goMove() {
		location.href = "<?php echo G5_URL; ?>/estimate/my_estimate_list.php";
	}
</script>

<script type="text/javascript" src="/js/swiper.min.js"></script>
<script>
	new Swiper('.swiper-container', {
		slidesPerView: 1,
		loop: true,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});
</script>

<?php

include_once('./_tail.php');
?>


<style>
	@media(max-width:703px) {
		.tab {
			margin-top: 10px;
		}
	}
</style>
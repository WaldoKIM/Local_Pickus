<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$sql = " select
			a.idx,
			ifnull(c.idx,0) as sub_idx,
			a.sub_key,
			a.email,
			a.nickname,
			a.title,
			concat('<p>',replace(a.content,'\n','</p><p>'),'</p>') as content,
			a.phone,
			a.item_cat,
			a.item_cat_dtl,
			a.manufacturer,
			a.floor,
			a.elevator_yn,
			a.pickup_date,
			a.medel_name,
			a.year,
			a.use_year,
			a.goods_state,
			a.item_qty,
			a.area_total,
			a.area1,
			a.area2,
			a.area3,
			a.photo1,
			a.photo2,
			a.photo3,
			a.photo4,
			a.photo5,
			a.photo6,
			a.photo7,
			a.photo8,
			a.photo9,
			a.photo1_rotate,
			a.photo2_rotate,
			a.photo3_rotate,
			a.photo4_rotate,
			a.photo5_rotate,
			a.photo6_rotate,
			a.photo7_rotate,
			a.photo8_rotate,
			a.photo9_rotate,
			a.attach_file,
			a.state,
			a.e_type,
			a.simple_yn,
			a.writetime,
			a.deadline,
			a.pull_kind,
			a.pull_kind_etc,
			a.pull_floor_bottom,
			a.test_type,
			b.price_qty,
			case when a.e_type = '0' then b.min_price_pe end as price_pe,
			case when a.e_type = '1' then b.max_price_cha end as max_price_cha,
			case when a.e_type = '2' then b.min_price else b.max_price end as price,
			ifnull(c.review,'') as review,
			case when trim(ifnull(c.review,'')) = '' then '0' else '1' end as review_yn,
			ifnull(c.selected,'0') as selected,
			date_format(ifnull(c.requesttime, ''), '%Y-%m-%d') as requesttime,
			date_format(ifnull(c.completetime, ''), '%Y-%m-%d') as completetime
		from
			{$g5['estimate_list']} a
			left join (
				select
						estimate_idx,
						count(*) as price_qty,
						max(price) as max_price,
						max(price_cha) as max_price_cha,
						min(price) as min_price,
						min(price_minus) as min_price_pe
				from
					{$g5['estimate_propose']}
				where
					estimate_idx =  '$idx'
					and meet = '0'
					and NOT selected = '2'
				group by estimate_idx
			) b on a.idx = b.estimate_idx
			left join {$g5['estimate_propose']} c on a.idx = c.estimate_idx and c.selected = '1'
			left join (
				select estimate_idx, count(*) as cnt from {$g5['estimate_propose']} group by estimate_idx
			) d on a.idx = d.estimate_idx
		where
			a.idx =  '$idx'	 ";
$master = sql_fetch($sql);

$sql = "select * from {$g5['estimate_propose']} where price_cha = '{$master['max_price_cha']}' and estimate_idx = '$idx' ";
$daryang_chk = sql_fetch($sql);

if ($master['sub_key'] != '0') {
	$sql = " select count(*) as cnt from {$g5['estimate_list_multi']} where sub_key = '{$master['sub_key']}'  ";
	$detail_cnt = sql_fetch($sql);
	$detailCnt = $detail_cnt['cnt'];
	$sql = " select * from {$g5['estimate_list_multi']} where sub_key = '{$master['sub_key']}'  ";
	if ($detail_cnt['cnt'] == 1 && $master['e_type'] == "2") {
		$detail = sql_fetch($sql);
	} else {
		$detail = sql_query($sql);
	}
}

$sql = " 		select
					a.idx,
					a.estimate_idx,
					a.rc_email,
					a.rc_nickname,
					a.email,
					a.nickname,
					a.price,
					a.price_minus,
					a.charge_rate,
					a.charge_amt,
					a.remain_amt,
					a.meet,
					a.selected,
					a.proposetime,
					a.free,
					b.mb_biz_addr1,
					b.mb_biz_score,
					b.mb_photo_site,
					b.mb_hp,
					a.attach_file
				from
					{$g5['estimate_propose']} a
					join {$g5['member_table']} b on a.rc_email = b.mb_email
				where
					a.estimate_idx = '$idx'
					and a.selected = '1'
				order by a.selected desc, a.price desc, a.idx desc ";
$propose_success = sql_fetch($sql);


$sql = " 		select
					a.idx,
					a.estimate_idx,
					a.rc_email,
					a.rc_nickname,
					a.email,
					a.nickname,
					a.price,
					a.price_minus,
					a.charge_rate,
					a.charge_amt,
					a.remain_amt,
					a.meet,
					a.selected,
					a.proposetime,
					b.mb_biz_addr1,
					b.mb_biz_score,
					b.mb_photo_site,
					a.free,
					a.attach_file
				from
					{$g5['estimate_propose']} a
					join {$g5['member_table']} b on a.rc_email = b.mb_email
				where
					a.estimate_idx = '$idx'
					and a.selected = '0'
				order by a.selected desc, a.price desc, a.idx desc ";
$propose_process = sql_query($sql);


$sql = " 		select
					a.idx,
					a.estimate_idx,
					a.rc_email,
					a.rc_nickname,
					a.email,
					a.nickname,
					a.price,
					a.price_minus,
					a.charge_rate,
					a.charge_amt,
					a.remain_amt,
					a.meet,
					a.selected,
					a.proposetime,
					b.mb_biz_addr1,
					b.mb_biz_score,
					b.mb_photo_site,
					a.attach_file,
					a.free
				from
					{$g5['estimate_propose']} a
					join {$g5['member_table']} b on a.rc_email = b.mb_email
				where
					a.estimate_idx = '$idx'
					and a.selected = '0'
				order by a.selected desc, a.price desc, a.idx desc ";
$propose_process_fetch = sql_fetch($sql);

$sql = " 		select
					a.idx,
					a.photo1,
					b.photo1_rotate,
					b.e_type,
					b.item_cat,
					concat(substr(a.nickname,1,1),'**') AS nickname,
					b.area1,
					b.area2,
					a.score,
					b.goods_state,
					case when length(b.title) <= 20 then b.title else concat(substr(b.title,1,10),'...') end as title,
					a.review,
					date_format(a.proposetime,'%y.%m.%d') as completetime,
					case when ifnull(a.review,'') !=  ''  then 'Y' else 'N' end as review_yn,
					a.attach_file
				from
					{$g5['estimate_propose']} a
					join {$g5['estimate_list']} b on a.estimate_idx = b.idx
				where
					a.estimate_idx = '$idx'
					and ifnull(a.review,'') !=  '' ";

$propose_review = sql_fetch($sql);
$sql = "update g5_notify set read_gb = 1 where email = '{$member['mb_email']}' AND estimate_idx = '$idx' ";

sql_query($sql);
$sql = " select count(*) as cnt from {$g5['estimate_propose']} where estimate_idx = '$idx' AND NOT selected = 2";
$propose_cnt = sql_fetch($sql);
$centerCnt = $propose_cnt['cnt'];

$sql = " select
			a.idx,
			ifnull(b.idx,0) as sub_idx,
			a.sub_key,
			a.email,
			a.nickname,
			concat(substr(a.nickname,1,1),'**') as nickname1,
			a.title,
			concat('<p>',replace(a.content,'\n','</p><p>'),'</p>') as content,
			case when ifnull(a.phone,'') = '' then '-' else a.phone end as phone,
			a.item_cat,
			a.item_cat_dtl,
			a.manufacturer,
			a.floor,
			a.elevator_yn,
			a.pickup_date,
			a.medel_name,
			a.year,
			a.use_year,
			a.goods_state,
			a.item_qty,
			a.area_total,
			a.area1,
			a.area2,
			a.area3,
			a.photo1, 
			a.photo2,
			a.photo3,
			a.photo4,
			a.photo5,
			a.photo6,
			a.photo7,
			a.photo8,
			a.photo9,	
			a.photo1_rotate, 
			a.photo2_rotate,
			a.photo3_rotate,
			a.photo4_rotate,
			a.photo5_rotate,
			a.photo6_rotate,
			a.photo7_rotate,
			a.photo8_rotate,
			a.photo9_rotate,			
			a.state,
			a.e_type,
			a.simple_yn,
			a.writetime,
			a.deadline,
			a.pull_kind,
			a.pull_kind_etc,
			a.pull_floor_bottom,
			a.test_type,			
			b.price,
			b.price_minus,
			b.charge_rate,
			b.charge_amt,
			b.remain_amt,	
			a.attach_file,
			b.attach_file as attach_file1,		
			ifnull(b.selected,'0') as selected,
			b.meet,
			b.meet_confirm,
			b.free,
			date_format(ifnull(b.requesttime, ''), '%Y-%m-%d') as requesttime,
			date_format(ifnull(b.completetime,''), '%Y-%m-%d') as completetime,
			date_format(now(),'%Y-%m-%d') as completedate,
			d.*
		from
			{$g5['estimate_list']} a
			left join {$g5['estimate_propose']} b  on a.idx = b.estimate_idx and b.rc_email = '{$member['mb_email']}' 
			left join {$g5['estimate_propose_detail']} c on a.idx = c.estimate_idx and c.rc_email = '{$member['mb_email']}' 
			left join (
				select estimate_idx, count(*) as cnt from {$g5['estimate_propose']} group by estimate_idx
			) d on a.idx = d.estimate_idx
					
		where
			a.idx =  '$idx'	 ";
$master2 = sql_fetch($sql);

$sql = "select * from g5_member a
		left join {$g5['estimate_list']} b on a.mb_email = b.email where a.mb_email = '{$master2['email']}'";
$cli_info = sql_fetch($sql);

if ($master['state'] == "7" && $member['mb_level'] > 9) {
	alert("취소된 견적입니다.");
}

$price = 0;
$price_minus = 0;
if ($propose_success) {
	$price = $propose_success['price'];
	$price_minus = $propose_success['price_minus'];
}

?>
<link rel="stylesheet" type="text/css" href="/css/board.css" />
<link rel="stylesheet" type="text/css" href="/css/member.css" />
<link rel="stylesheet" type="text/css" href="/css/swiper.min.css" />
<link rel="stylesheet" type="text/css" href="/share/css/jquery.bxslider.css" />
<style type="text/css">
	.md_guide {
		padding: 10px;
	}

	#mobileInfo1 .ma,
	#mobileInfo1 .pe {
		display: inline-block;
	}

	.ma,
	.pe {
		margin-right: 10px;
	}

	dd span.pe {
		margin-left: 15px;
	}

	#board .view .info dd,
	#board .view .info dt {
		height: 44px;
	}

	#content {
		padding: 10px;
	}

	#modal_price_detail .col-xs-7 {
		margin-top: 13px;
	}

	.propose_price+.propose_price {
		margin-top: 5px;
	}

	#frmPrice p {
		margin-bottom: 10px !important;
	}

	.swiper-slide a {
		text-align: center;
	}

	.pay span:nth-of-type(2) {
		margin-left: 10px
	}

	#mob_view_slider li a img {
		height: 350px;
	}

	@media(max-width: 768px) {
		h3 {
			font-size: 20px;
		}

		.modal_table .title {
			font-size: 12px
		}
	}

	@media(min-width: 768px) {
		.bx-wrapper {
			max-height: 350px;
		}

		.bx-wrapper img {
			width: 350px;
			height: 350px;
		}

		#bx-pager img {
			max-height: 64px;
		}

		#board .view .shop_list>li {
			height: auto;
		}
	}
</style>
<form name="frmrequest" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_request_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="idx">
	<input type="hidden" name="email">
</form>
<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">내신청현황</h1>
		</div><!-- sub_title -->
		<div id="board">

			<div class="view">
				<div class="mob">
					<div class="mob_slider swiper-container">
						<ul id="mob_view_slider" class="swiper-wrapper">
							<?php
							$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
							$photo = sql_query($sql);
							for ($i = 0; $row1 = sql_fetch_array($photo); $i++) {
								echo '<li class="swiper-slide"><a href="' . G5_DATA_URL . '/estimate/' . $row1['photo'] . '" target="_blank"><img src="' . G5_DATA_URL . '/estimate/' . $row1['photo'] . '" /></a></li>';
							}
							?>
						</ul>
						<div class="text" id="mobileEtype"><?php echo get_etype($master['e_type']); ?></div>
						<!-- Add Arrows -->
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>

					<div class="text-center mob_ing" id="mobileStatus">
						<?php echo get_estimate_mobile_state_tag($master['state']); ?>
					</div>

					<ul class="row mob_info" id="mobileInfo1">
						<?php

						echo "<li class='col-xs-6'>";
						echo "<p class='text-center main_co'><i class='xi-emoticon'></i> 참여수</p>";
						if ($master['price_qty'] > 0) {
							echo "<p class='text-center'>" . $master['price_qty'] . "명</p>";
						} else {
							echo "<p class='text-center'>-명</p>";
						}
						echo "</li>";
						echo "<li class='col-xs-6'>";

						if ($master['state'] == "0" || $master['state'] == "1" || $master['state'] == "2") {
							if ($master['e_type'] == "0") {
								echo "<p class='text-center main_co'><i class='xi-money'></i> 업체 최고가</p>";
								if ($master['price_qty'] > 0) {
									if ($master['price'] && $master['price'] > 0) {
										echo "<p class='text-center'><span class='ma'>매입</span>" . display_estimate_price($master['price']) . "</p>";
									} else if ($propose_process_fetch['free'] == '1') {
										echo "<p class='text-center'><span class='ma'>매입</span>" . display_estimate_price($master['price']) . "</p>";
									} else if ($master['price_pe'] > 0) {
										echo "<p class='text-center'><span  class='pe'>폐기</span>" . number_format($master['price_pe']) . "원</p>";
									} else {
										echo "<p class='text-center'><span class='ma'>매입</span>" . display_estimate_price($master['price_pe']) . "</p>";
									}
								} else {
									echo "<p class='text-center'>-원</p>";
								}
							}
							if ($master['e_type'] == "1") {
								echo "<p class='text-center main_co'><i class='xi-money'></i> 업체 최고가</p>";
								if ($master['price_qty'] > 0) {

									if ($daryang_chk['price'] && $daryang_chk['price'] > 0) {
										echo "<p class='text-center'><span class='ma'>매입</span>" . display_estimate_price($daryang_chk['price']) . "</p>";
									} else if ($propose_process_fetch['free'] == '1') {
										echo "<p class='text-center'><span class='ma'>매입</span>" . display_estimate_price($daryang_chk['price']) . "</p>";
									}

									if ($daryang_chk['price_minus'] > 0) {
										echo "<p class='text-center'><span  class='pe'>폐기</span>" . number_format($daryang_chk['price_minus']) . "원</p>";
									}
								} else {
									echo "<p class='text-center'>-원</p>";
								}
							}
							if ($master['e_type'] == "2") {
								echo "<p class='text-center main_co'><i class='xi-money'></i> 업체 최저가</p>";
								if ($master['price_qty'] > 0) {
									if ($propose_process_fetch['price']) {
										echo "<p class='text-center'>" . display_estimate_price($master['price']) . "</p>";
									}
								} else {
									echo "<p class='text-center'>-원</p>";
								}
							}
						} else {
							echo "<p class='text-center main_co'><i class='xi-money'></i> 선택견적가</p>";
							if ($master['e_type'] == "0" || $master['e_type'] == "1") {


								if ($propose_success['price']) {
									echo "<p class='text-center'>";
									echo "<span class='ma'>매입</span>" . display_estimate_price($price);
									echo "</p>";
								}

								if ($propose_success['free'] == '1') {
									echo "<p class='text-center'>";
									echo "<span class='ma'>매입</span>" . display_estimate_price($price);
									echo "</p>";
								}

								if ($propose_success['price_minus']) {
									echo "<p class='text-center'>";
									echo "<span class='pe'>폐기</span>" . display_estimate_price($price_minus);
									echo "</p>";
								}
							} else {
								echo "<p class='text-center'>" . display_estimate_price($price) . "</p>";
							}
						}
						echo "</li>";
						?>
					</ul>

					<div class="customer">
						<dl class="row" id="mobileInfo2">
							<?php
							echo "<dt class='col-xs-4 main_co'>마감일</dt>";
							echo "<dd class='col-xs-8'>" . $master['deadline'] . "</dd>";
							if ($master['selected'] != "1") {
								if ($master['e_type'] == "2") {
									echo "<dt class='col-xs-4 main_co'> 철거요청일</dt>";
								} else {
									echo "<dt class='col-xs-4 main_co'> 수거요청일</dt>";
								}
								echo "<dd class='col-xs-8'>" . $master['pickup_date'] . "</dd>";
							} else {
								if ($master['completetime']) {
									if ($master['e_type'] == "2") {
										echo "<dt class='col-xs-4 main_co'>  철거확정일</dt>";
									} else {
										echo "<dt class='col-xs-4 main_co'>  수거확정일</dt>";
									}
									echo "<dd class='col-xs-8'>" . $master['completetime'] . "</dd>";
								} else {
									if ($master['e_type'] == "2") {
										echo "<dt class='col-xs-4 main_co'> 철거요청일</dt>";
									} else {
										echo "<dt class='col-xs-4 main_co'> 수거요청일</dt>";
									}
									echo "<dd class='col-xs-8'>" . $master['requesttime'] . "</dd>";
								}
							}

							echo "<div style='border-bottom:1px solid #ddd; overflow:hidden; width:100%;'><dt style='border-bottom:0;' class='col-xs-4 main_co'>지역</dt>";
							echo "<dd style='border-bottom:0;' class='col-xs-8'>" . $master['area1'] . " " . $master['area2'] . " " . $master['area3'] . "</dd></div>";
							echo "<dt class='col-xs-4 main_co'>층수</dt>";
							echo "<dd class='col-xs-8'>" . $master['elevator_yn'] . "/" . $master['floor'] . "</dd>";
							?>
							<?php
							if ($master['attach_file']) {
								echo "<dt class='col-xs-1 main_co'>파일</dt><dd class='col-xs-11'><a href='" . G5_DATA_URL . '/estimate/' . $master['attach_file'] . "' style='height:23px;line-height:25px;'>다운로드</a></dd>";
							}
							?>
						</dl>
						<?php
						if ($master['state'] == "3" || $master['state'] == "4" || $master['state'] == "5") {
						}
						?>
					</div>
					<div class="warning" id="mobileWaring">
						<?php
						if ($master['state'] == "2") {
							echo "<h1 class='text-center main_co'>견적이 완료되었습니다.업체를 선택해주세요</h1>";
						} else if ($master['state'] == "3") {
							echo "<h1 class='text-center main_co'>* 센터에서 고객님께 곧 연락드립니다.</h1>";
						}
						?>
					</div>

					<div class="customer">
						<dl class="row" id="mobileButton">
							<?php
							$add_day = strtotime("-1 days");
							if (($master['state'] == "0" || $master['state'] == "1") && strtotime($master['deadline']) > strtotime(date("Y-m-d", $add_day))) {
								echo "<ul class='row'>";
								echo "<li class='col-xs-6'>";
								echo "<a href='#.' data-toggle='modal' data-target='#img_guide' class='guide_estimate' style='color: #1379cd; border: 2px solid #1379cd; display: block;height: 40px;line-height: 37px;text-align: center; border-radius: 5px;'>견적진행 가이드</a>";
								echo "</li>";
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
					<?php

					$timenow = date("Y-m-d");
					$pickup_date = $master['pickup_date'];
					$deadline = $master['deadline'];

					$cha_pick = date_diff($timenow, $pickup_date);
					$cha_deac = date_diff($timenow, $deadline);
					$cha_last = date_diff($deadline, $pickup_date);

					if ($cha_last->days > 29 || $cha_deac->days > 29 || $cha_pick->days > 29) : ?>
						<p>견적마감일과 수거요청일이 1달이 넘을 경우,
							<br /><br />
							견적변동이 가능하여 업체견적이 늦을 수도 있습니다.
						</p>
					<?php endif; ?>
					<tr>
						<th class="photo">
							<ul id="view_slider">
								<?php
								$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
								$photo = sql_query($sql);
								for ($i = 0; $row1 = sql_fetch_array($photo); $i++) {
									echo '<li><a href="' . G5_DATA_URL . '/estimate/' . $row1['photo'] . '" target="_blank"><img src="' . G5_DATA_URL . '/estimate/' . $row1['photo'] . '" /></a></li>';
								}
								?>
							</ul>
							<div class="pager_wrap">
								<ul id="bx-pager">
									<?php
									$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
									$photo = sql_query($sql);
									for ($i = 0; $row1 = sql_fetch_array($photo); $i++) {
										echo "<li><a data-slide-index='" . $i . "' href=''>" . estimate_img_thumbnail($row1['photo'], 350, 350) . "</a></li>";
									}
									?>
								</ul>
							</div>
						</th>
						<td class="info" id="mainTitle">
							<h1><?php echo get_etype($master['e_type']); ?></h1>
							<?php if ($master['simple_yn'] == 0 && $master['e_type'] != '3') { ?>
								<dl>
									<dt class="col-xs-3">제목</dt>
									<dd class="col-xs-9"><?php echo $master['title']; ?></dd>
									<?php

									$state    = $master['state'];
									$e_type   = $master['e_type'];
									$selected = $master['selected'];

									if ($state == "0" || $state == "1" || $state == "6") {
										if ($master['price_qty'] > 0) {
											if ($e_type == "2") {
												echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>" . $master['price_qty'] . "명</dd>";
												echo "<dt class='col-xs-3'>업체 최저가</dt><dd class='col-xs-9'>" . display_estimate_price($master['price']) . "</dd>";
											} else {
												echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>" . $master['price_qty'] . "명</dd>";
												if ($centerCnt >  0) {
													echo "<dt class='col-xs-3'>업체 최고가</dt>
													<dd class='col-xs-9'>";
													if ($e_type == "0") {
														if ($master['price'] && $master['price'] > 0) {
															echo "<span class='ma'>매입</span>" . display_estimate_price($master['price']);
														} else if ($propose_process_fetch['free'] == '1') {
															echo "<span class='ma'>매입</span>" . display_estimate_price($master['price']);
														} else if ($master['price_pe'] > 0) {
															echo "<span  class='pe'>폐기</span>" . number_format($master['price_pe']) . "원";
														} else {
															echo "<span class='ma'>매입</span>" . display_estimate_price($master['price_pe']);
														}
														echo "</dd>";
													} else if ($e_type == "1") {

														if ($daryang_chk['price'] && $daryang_chk['price'] > 0) {
															echo "<span class='ma'>매입</span>" . display_estimate_price($daryang_chk['price']);
														} else if ($propose_process_fetch['free'] == '1') {
															echo "<span class='ma'>매입</span>" . display_estimate_price($daryang_chk['price']);
														}

														if ($daryang_chk['price_minus'] > 0) {
															echo "<span  class='pe'>폐기</span>" . number_format($daryang_chk['price_minus']) . "원";
														}

														echo "</dd>";
													} else {
														echo "<dt class='col-xs-3'>업체 최저가</dt><dd class='col-xs-9'>" . display_estimate_price($master['price'], $master['meet']) . "</dd>";
													}
												}
											}
										} else {
											if ($e_type == "2") {
												echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>- 명</dd>";
												echo "<dt class='col-xs-3'>업체 최저가</dt><dd class='col-xs-9'>- 원</dd>";
											} else {
												echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>- 명</dd>";
												echo "<dt class='col-xs-3'>업체 최고가</dt><dd class='col-xs-9'>- 원</dd>";
											}
										}
									} else if ($state == "2" && $centerCnt > 0) {
										echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>" . $master['price_qty'] . "명</dd>";
										if ($e_type == "2") {
											echo "<dt class='col-xs-3'>업체 최저가</dt><dd class='col-xs-9'>" . display_estimate_price($master['price']) . "</dd>";
										} else {
											echo "<dt class='col-xs-3'>업체 최고가</dt>";
											echo "<dd class='col-xs-9'>";
											if ($e_type == "0") {
												if (!$master['price_pe']) {
													echo display_estimate_price($master['price']);
												}

												if ($master['price_pe']) {
													echo display_estimate_price($master['price_pe']);
												}
											}

											if ($e_type == "1") {
												if ($master['price']) {
													echo display_estimate_price($master['price']);
												}
												if ($propose_process_fetch['free'] == '1') {
													echo display_estimate_price($master['price']);
												}
												if ($master['price_pe']) {
													echo display_estimate_price($master['price_pe']);
												}
											}
										}
									} else if ($state == "3" || $state == "8") {
										echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>" . $master['price_qty'] . "명</dd>";
										echo "<dt class='col-xs-3'>선택견적가</dt>";
										if ($master['e_type'] == "0") {
											echo "<dd class='col-xs-9'>";
											if (!$propose_success['price_minus']) {
												echo "<span class='ma'>매입</span>" . display_estimate_price($price);
											}

											if ($propose_success['price_minus']) {
												echo "<span class='pe'>폐기</span>" . display_estimate_price($price_minus);
											}
											echo "</dd>";
										} else if ($master['e_type'] == "1") {
											echo "<dd class='col-xs-9'>";
											if ($propose_success['price']) {
												echo "<span class='ma'>매입</span>" . display_estimate_price($price);
											}
											if ($propose_success['free'] == '1') {
												echo "<span class='ma'>매입</span>" . display_estimate_price($price);
											}
											if ($propose_success['price_minus']) {
												echo "<span class='pe'>폐기</span>" . display_estimate_price($price_minus);
											}
											echo "</dd>";
										} else {
											echo "<dd class='col-xs-9'>" . display_estimate_price($price) . "</dd>";
										}
									} else {
										echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>" . $master['price_qty'] . "명</dd>";
										echo "<dt class='col-xs-3'>선택견적가</dt><dd class='col-xs-9'>";
										if ($master['e_type'] == "0" || $master['e_type'] == "1") {
											if ($propose_success['price']) {
												echo "<span class='ma'>매입</span>" . display_estimate_price($price);
											}
											if ($propose_success['free'] == '1') {
												echo "<span class='ma'>매입</span>" . display_estimate_price($price);
											}
											if ($propose_success['price_minus']) {
												echo "<span class='pe'>폐기</span>" . display_estimate_price($price_minus);
											}
										} else {
											echo display_estimate_price($price);
										}
										echo "</dd>";
									}

									?><?php

										echo "<div style='border-bottom:1px solid #ddd; overflow:hidden; width:100%;'><dt style='border-bottom:0; height:100%;' id='area_tit' class='col-xs-3 '>지역</dt>";
										echo "<dd style='border-bottom:0; height:100%;' class='col-xs-9' id='area'>" . $master['area1'] . " " . $master['area2'] . " " . $master['area3'] . "</dd></div>"; ?>

									<dt class="col-xs-3">층수</dt>
									<dd class="col-xs-9"><?php echo $master['elevator_yn']; ?>/<?php echo $master['floor']; ?></dd>
									<?php
									if ($master['selected'] != "1") {
										if ($master['e_type'] == "2") {
											echo "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>" . $master['pickup_date'] . "</dd>";
										} else {
											echo "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>" . $master['pickup_date'] . "</dd>";
										}
									} else {
										if ($master['completetime']) {
											if ($master['e_type'] == "2") {
												echo "<dt class='col-xs-3'>철거확정일</dt><dd class='col-xs-9'>" . $master['completetime'] . "</dd>";
											} else {
												echo "<dt class='col-xs-3'>수거확정일</dt><dd class='col-xs-9'>" . $master['completetime'] . "</dd>";
											}
										} else {
											if ($master['e_type'] == "2") {
												echo "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>" . $master['requesttime'] . "</dd>";
											} else {
												echo "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>" . $master['requesttime'] . "</dd>";
											}
										}
									}
									?>
									<?php echo "<dt class='col-xs-3'>견적마감일</dt><dd class='col-xs-9'>" . $master['deadline'] . "</dd>"; ?>


								<?php } else { //간편견적 
								?>
									<dt class='col-xs-3'>이름</dt>
									<dd class='col-xs-9'><?php echo $master['nickname'] ?></dd>
									<dt class='col-xs-3'>이메일</dt>
									<dd class='col-xs-9'><?php echo $master['email'] ?></dd>
									<dt class='col-xs-3'>연락처</dt>
									<dd class='col-xs-9'><?php echo $master['phone'] ?></dd>
									<dt class='col-xs-12' style="text-align: center;">설명</dt>
									<div class='col-xs-12'><?php echo $master['content'] ?></div>

								<?php } ?>
								</dl>
								<?php
								if ($master['attach_file']) {
									echo "<dt class='col-xs-3'>첨부파일</dt><dd class='col-xs-9'><a href='" . G5_DATA_URL . '/estimate/' . $master['attach_file'] . "' style='height:23px;line-height:25px;'>다운로드</a></dd>";
								}
								?>
								<?php
								$add_day = strtotime("-1 days");
								if ($member['mb_level'] != '10') {
									if (($state == "0" || $state == "1") && strtotime($master['deadline']) > strtotime(date("Y-m-d", $add_day))) {
										echo "<ul class='row'>";
										echo "<li class='col-xs-6'>";
										echo "<a href='#.' data-toggle='modal' data-target='#img_guide' class='guide_estimate' style='color: #1379cd; border: 2px solid #1379cd; display: block;height: 40px;line-height: 37px;text-align: center; border-radius: 5px;'>견적진행 가이드</a>";
										echo "</li>";
										echo "<li class='col-xs-6'>";
										echo "<a class='main_bg' href='javascript:doCancel()'>";
										echo "견적취소";
										echo "</a>";
										echo "</li>";
										echo "</ul>";
									}
								}
								?>

								<?php
								if ($member['mb_level'] == '10') {
									if (($state == "0" || $state == "1")) {
										echo "<ul class='row'>";
										echo "<li class='col-xs-6'>";
										echo "<a href='#.' data-toggle='modal' data-target='#img_guide' class='guide_estimate' style='color: #1379cd; border: 2px solid #1379cd; display: block;height: 40px;line-height: 37px;text-align: center; border-radius: 5px;'>견적진행 가이드</a>";
										echo "</li>";
										echo "<li class='col-xs-6'>";
										echo "<a class='main_bg' href='javascript:doCancel()'>";
										echo "견적취소";
										echo "</a>";
										echo "</li>";
										echo "</ul>";
									}
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
						} else if ($state == "3" || $state == "8") {
							echo "<h1 class='text-center main_co '>* 센터에서 고객님께 곧 연락드립니다.</h1>";
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
						<?php if ($member['mb_level'] == '10' && $state == "1" || $state == "2") { ?>
							<li class="col-xs-3" id="selectGubun3">
								<a href="javascript:doChangeSelect('3')">
									<h4>모든업체</h4>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>



				<ul class="shop_list" id="proposeList">
					<?php
					if ($centerCnt > 0) {
						if ($state == "3" || $state == "4" || $state == "5" || $state == "8") {
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
										and a.rc_email = '{$propose_success['rc_email']}'
									group by a.rc_email ";

							$score_row = sql_fetch($sql);

							$score = $score_row['score'];
							echo "<li>";
							echo "<div>";
							echo "<div class='img'> <img src = '/data/estimate/" . $propose_success['mb_photo_site'] . "'><p id='partner_show' onclick='show_partner_detail(\"" . $propose_success['rc_email'] . "\")'>업체소개</p></div>";
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

							$propose_success['rc_nickname'] = preg_replace('/(?<=.{1})./u', '○', $propose_success['rc_nickname']);
							echo "<h4>" . $propose_success['rc_nickname'] . "</h4>";
							//echo "<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>".$propose_success['mb_biz_addr1']."</h5>";
							if ($propose_success['meet']) {
								echo "<div class='pay main_co'><span>방문견적</span></div>";
							} else {
								if (!$propose_success['price'] && !$propose_success['price_minus']) {
									if ($e_type == "2") {
										echo "<div class='pay main_co'><span>무료철거</span></div>";
									} else {
										echo "<div class='pay main_co'><span>무료수거</span></div>";
									}
								} else {
									if ($e_type == "2") {
										echo "<div class='pay'><span class=' ma'>견적가</span> " . number_format($propose_success['price']) . "원</div>";
									} else {
										if ($propose_success['price']) {
											echo "<div class='pay'><span class='white ma'>매입</span>" . number_format($propose_success['price']) . "원<span>보상</span></div>";
										}
										if ($propose_success['price_minus']) {
											echo "<div class='pay'><span class='white pe'>폐기</span>" . number_format($propose_success['price_minus']) . "원<span>결제</span></div>";
										}
									}
								}
							}
							echo "</div>";
							echo "<div class='btn_list'>";
							echo "<ul class='row'>";
							if ($e_type == "2") {
								echo "<a class='line_bg' href='javascript:doPriceDetail(\"" . $propose_success['idx'] . "\",\"" . $propose_success['estimate_idx'] . "\",\"" . $propose_success['rc_email'] . "\")'>상세견적</a>";
							} else {
								if ($propose_success['attach_file']) {
									echo "<a class='line_bg' href='" . G5_DATA_URL . '/estimate/' . $propose_success['attach_file'] . "'>파일확인</a>";
								}
							}


							echo "<a class='sub_bg' href='javascript:'>선택완료</a>";
							/*echo "<a class='main_bg1' href='javascript:doSelect(\"".$row['idx']."\",\"".$row['estimate_idx']."\",\"".$row['rc_nickname']."\")'>파일확인</a>";*/
							echo "</ul>";
							echo "</div>";
							echo "</div>";
							echo "</li>";
							if ($member['mb_level'] == '10') {
								for ($i = 0; $row = sql_fetch_array($propose_process); $i++) {
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
											and a.rc_email = '{$row['rc_email']}'
										group by a.rc_email ";

									$score_row = sql_fetch($sql);

									$score = $score_row['score'];

									echo "<li>";
									echo "<div>";
									echo "<div class='img'> <img src = '/data/estimate/" . $row['mb_photo_site'] . "'><p id='partner_show' onclick='show_partner_detail(\"" . $row['mb_email'] . "\")'>업체소개</p></div>";
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
									$row['rc_nickname'] = preg_replace('/(?<=.{1})./u', '○', $row['rc_nickname']);
									echo "<h4>" . $row['rc_nickname'] . "</h4>";
									//echo "<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>".$row['mb_biz_addr1']."</h5>";
									if ($row['meet']) {
										echo "<div class='pay main_co'><span>방문견적</span></div>";
									} else {
										if (!$row['price'] && !$row['price_minus']) {
											if ($e_type == "2") {
												echo "<div class='pay main_co'><span>무료철거</span></div>";
											} else {
												if (!$row['price_minus']) {
													echo "<div class='pay main_co'><span>무료수거</span></div>";
												}
											}
										} else {
											if ($e_type == "2") {
												echo "<div class='pay'><span class=' ma'>견적가</span> " . number_format($row['price']) . "원</div>";
											} else {
												$arUnit = array(
													'price' => $row['price'],
													'price_minus' => $row['price_minus']
												);
												array_push($price_array, $arUnit);
												if ($row['price']) {
													echo "<div class='pay'><span class='white ma'>매입</span>" . number_format($row['price']) . "원 <span>보상</span></div>";
												}
												if ($row['price_minus']) {
													echo "<div class='pay'><span class='white pe'>폐기</span>" . number_format($row['price_minus']) . "원<span>결제</span></div>";
												}
											}
										}
									}
									echo "</div>";
									echo "<div class='btn_list'>";
									echo "<ul class='row'>";
									echo "<li class='col-xs-12'>";
									if ($e_type == "2" && !$row['meet']) {
										echo "<a class='line_bg' href='javascript:doPriceDetail(\"" . $row['idx'] . "\",\"" . $row['estimate_idx'] . "\",\"" . $row['rc_email'] . "\")'>상세견적</a>";
									} else {
										if ($row['attach_file']) {
											echo "<a class='line_bg' href='" . G5_DATA_URL . '/estimate/' . $row['attach_file'] . "'>파일확인</a>";
										}
									}
									echo "</li>";
									echo "<li class='col-xs-12'>";
									if ($row['meet']) {
										echo "<a class='main_bg' href='javascript:'>방문견적</a>";
									}

									echo "</li>";
									echo "</ul>";
									echo "</div>";
									echo "</div>";
									echo "</li>";
								}
							}
						} else if ($state == "1" || $state == "2" || $state == "6") {
							for ($i = 0; $row = sql_fetch_array($propose_process); $i++) {
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
											and a.rc_email = '{$row['rc_email']}'
										group by a.rc_email ";

								$score_row = sql_fetch($sql);

								$score = $score_row['score'];

								echo "<li>";
								echo "<div>";
								echo "<div class='img'> <img src = '/data/estimate/" . $row['mb_photo_site'] . "'><p id='partner_show' onclick='show_partner_detail(\"" . $row['rc_email'] . "\")'>업체소개!!!</p></div>";
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
								//업체명을 가려야 하는가?
								//$row['rc_nickname'] = preg_replace('/(?<=.{1})./u', '○', $row['rc_nickname']);
								echo "<h4>" . $row['rc_nickname'] . "</h4>";
								//echo "<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>".$row['mb_biz_addr1']."</h5>";
								if ($row['meet']) {
									echo "<div class='pay main_co'><span>방문견적</span></div>";
								} else {
									if (!$row['price'] && !$row['price_minus']) {
										if ($e_type == "2") {
											echo "<div class='pay main_co'><span>무료철거</span></div>";
										} else {
											if (!$row['price_minus']) {
												echo "<div class='pay main_co'><span>무료수거</span></div>";
											}
										}
									} else {
										if ($e_type == "2") {
											echo "<div class='pay'><span class=' ma'>견적가</span> " . number_format($row['price']) . "원</div>";
										} else {
											$arUnit = array(
												'price' => $row['price'],
												'price_minus' => $row['price_minus']
											);
											array_push($price_array, $arUnit);
											if ($row['price']) {
												echo "<div class='pay'><span class='white ma'>매입</span>" . number_format($row['price']) . "원<span>보상</span></div>";
											}
											if ($row['price_minus']) {
												echo "<div class='pay'><span class='white pe'>폐기</span>" . number_format($row['price_minus']) . "원<span>결제</span></div>";
											}
										}
									}
								}
								echo "</div>";
								echo "<div class='btn_list'>";
								echo "<ul class='row'>";
								echo "<li class='col-xs-12'>";
								if ($e_type == "2" && !$row['meet']) {
									echo "<a class='line_bg' href='javascript:doPriceDetail(\"" . $row['idx'] . "\",\"" . $row['estimate_idx'] . "\",\"" . $row['rc_email'] . "\")'>상세견적</a>";
								} else {
									if ($row['attach_file']) {
										echo "<a class='line_bg' href='" . G5_DATA_URL . '/estimate/' . $row['attach_file'] . "'>파일확인</a>";
									}
								}
								echo "</li>";
								echo "<li class='col-xs-12'>";
								if ($row['meet']) {
									echo "<a class='main_bg' href='javascript:'>방문견적</a>";
								} else {
									if ($row['price'] > 0 && $e_type != '2') {
										echo "<a class='main_bg' href='javascript:doSelect(\"" . $row['idx'] . "\",\"" . $row['estimate_idx'] . "\",\"" . $row['rc_nickname'] . "\")'>업체선택</a>";
									} else {
										echo "<a class='main_bg' href='javascript:doSelect_normal(\"" . $row['idx'] . "\",\"" . $row['estimate_idx'] . "\",\"" . $row['rc_nickname'] . "\")'>업체선택</a>";
									}
								}
								echo "</li>";
								echo "</ul>";
								echo "</div>";
								echo "</div>";
								echo "</li>";
							}
						}
					} else {
						echo '<p style="text-align: center; margin-bottom: 5px;">업체 견적이 들어오지 않았습니다.</p>';
					}
					?>
				</ul><!-- shop_list -->
				<ul class="shop_list" id="selectList">
					<p style="text-align: center; margin-bottom: 5px;">*업체에게 문의 하여 빠른 답변을 받아보세요*</p>
					<?php
					if ($state == "1" || $state == "2") {
					?>
						<?php

						$sql = " select a.*, case when b.rc_email is not null then 'Y' else 'N' end as request_yn, b.estimate_yn from {$g5['member_table']} a left join {$g5['estimate_request']} b on a.mb_email = b.rc_email and b.estimate_idx = '$idx'";
						if ($e_type == "0" || $e_type == "1") {
							$sql .= " where mb_biz_type in ('1','3') ";
						} else {
							$sql .= " where mb_biz_type in ('2','3') ";
						}

						$marea1 = $master['area1'];
						$marea2 = $master['area2'];
						if ($member['mb_level'] == 10) {

							$sql .= " and mb_id in ( select mb_id from {$g5['member_area_table']} where 1=1 and ( ( mb_area1 = '$marea1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$marea1' and mb_area2 = '$marea2'))) ";
						} else {
							$sql .= " and a.mb_show_type = '1' and mb_id in ( select mb_id from {$g5['member_area_table']} where 1=1 and ( ( mb_area1 = '$marea1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$marea1' and mb_area2 = '$marea2'))) ";
						}
						$sql .= " and mb_email not in ( select rc_email from {$g5['estimate_propose']} where estimate_idx = '$idx') ";
						$sql .= " order by mb_biz_score desc limit 8";

						$request_list = sql_query($sql);
						for ($i = 0; $row = sql_fetch_array($request_list); $i++) {
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
										and a.rc_email = '{$row['mb_email']}'
									group by a.rc_email ";

							$score_row = sql_fetch($sql);

							$score = $score_row['score'];
							echo "<li>";
							echo "<div>";
							echo "<div class='img'><img src='/data/estimate/" . $row['mb_photo_site'] . "'><p id='partner_show' onclick='show_partner_detail(\"" . $row['mb_email'] . "\")'>업체소개</p></div>";
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
							//업체명을 가려야 하는가?
							//$row['mb_name'] = preg_replace('/(?<=.{1})./u', '○', $row['mb_name']);
							echo "<h4>" . $row['mb_name'] . "</h4>";
							//echo "<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>".$row['mb_biz_addr1']."</h5>";
							echo "</div>";
							echo "<div class='btn_list'>";
							echo "<ul class='row'>";


							if ($row['estimate_yn']) {
								echo "<a class='sub_bg' href='javascript:' style='background:#da1a1a !important; color:#fff;'>수거불가</a>";
							} else {
								if ($row['request_yn'] == "Y") {
									echo "<a class='sub_bg' href='javascript:'>문의중</a>";
								} else {
									echo "<a class='main_bg' href='javascript:doRequest(\"" . $idx . "\",\"" . $row['mb_email'] . "\")'>문의하기</a>";
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



				<!-- <a class='main_bg2'>선택 업체 전화하기</a>  0403 선태 업체 전화하기 삭제요청-->
				<?php
				if ($state == "3" || $state == "4" || $state == "5" || $state == "8") {
				?>
					<div id="btn_test" class="btn_wrap">
						<ul class="row">
							<li class="co1-10">
								<a class='sub_bg_call' href='javascript:doTel("<?php echo $propose_success['mb_hp'] ?>")'>선택업체 전화하기</a> <!-- 0403 전화하기 추가-->
							</li>
						</ul>
					</div>
					<?php if ($cli_info['mb_bank_num'] && ($e_type == '0' || $e_type == '1') && $propose_success['price'] > 0) { ?>
						<style type="text/css">
							.box_banks {
								display: block;
								padding: 10px;
								font-size: 16px;
								background: #fff;
								border: 1px solid #e0e0e0;
								border-radius: 10px;
								overflow: hidden;
								box-shadow: -1px 1px 5px #e0e0e0;
							}

							.btn_mypage {
								width: 120px;
								padding: 15px 0;
								margin: 0 auto;
							}
						</style>
						<h1 class="tt" id="detailTitle">고객계좌</h1>
						<div>
							<div style="text-align: center;">
								<h3 style="margin-bottom: 20px;">업체 진행 완료 후 고객님 계좌로 입금 됩니다.</h3>
								<table>
									<tr>
										<td class="main_co">은행 : </td>
										<td>
											<p style="margin: 10px 0;"><?php echo $cli_info['mb_bank']; ?></p>
										</td>
									</tr>
									<tr>
										<td class="main_co">계좌번호 : </td>
										<td>
											<p style="margin: 10px 0;"><?php echo $cli_info['mb_bank_num']; ?></p>
										</td>
									</tr>
									<tr>
										<td class="main_co">예금주 : </td>
										<td>
											<p style="margin: 10px 0;"><?php echo $cli_info['mb_bank_name']; ?></p>
										</td>
									</tr>
								</table>
								<?php if ($member["mb_level"] == "1") : ?>
									<a style="margin-top: 20px; color: #fff;" class="btn_mypage main_bg" href="/bbs/mypage.php">계좌 확인/변경</a>
								<?php endif; ?>
								<?php if ($member["mb_level"] == "8") : ?>
									<a style="margin-top: 20px; color: #fff;" class="btn_mypage main_bg" href="/bbs/mypage_guest.php">계좌 확인/변경</a>
								<?php endif; ?>
							</div>
						</div>
				<?php
					}
				}
				?>


				<h1 class="tt" id="detailTitle">상세정보</h1>


				<table class="requst_list" id="subDetail">
					<?php
					if ($e_type == "0" || ($e_type == "2" && $detailCnt == 1 & $master['test_type'] != "B")) {
						echo "<colgroup>";
						echo "<col style='width: 20%' />";
						echo "<col style='width: 30%' />";
						echo "<col style='width: 20%' />";
						echo "<col style='width: 30%' />";
						echo "</colgroup>";
						if ($e_type == "0") {
							echo "<tr>";
							echo "<th>품목</th><td>" . $master['item_cat'] . " " . $master['item_cat_dtl'] . "</td>";
							echo "<th>제조사</th><td>" . $master['manufacturer'] . "</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>모델명</th><td>" . $master['medel_name'] . "</td>";
							echo "<th>연식</th><td>" . $master['year'] . "</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>참고사항</th><td colspan='3'>" . $master['content'] . "</td>";
							echo "</tr>";
						} else {
							echo "<tr>";
							echo "<th>철거종류</th><td>" . $detail['pull_kind'] . "</td>";
							echo "<th>천장/바닥 철거</th><td>" . $detail['pull_floor_bottom'] . "</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>철거평수</th><td>" . $detail['pull_space'] . "</td>";
							echo "<th>철거사이즈</th><td>" . $detail['pull_size'] . "</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>참고사항</th><td colspan='3'>" . $master['content'] . "</td>";
							echo "</tr>";
						}
					}

					if ($master['test_type'] == "B") {
						if ($e_type == "2") {
							$pull_kind_etc = "";
							if ($master['pull_kind_etc']) {
								$pull_kind_etc = ',' . $master['pull_kind_etc'];
							}
							echo "<tr>";
							echo "<th>철거종류</th><td>" . $master['pull_kind'] . $pull_kind_etc . "</td>";
							echo "<th>천장/바닥 철거</th><td>" . $master['pull_floor_bottom'] . "</td>";
							echo "</tr>";
						}
						if ($e_type == "1" || $e_type == "2") {
							echo "<tr>";
							echo "<th>참고사항</th><td colspan='3'>" . $master['content'] . "</td>";
							echo "</tr>";
						}
					}
					?>
				</table>

				<table class="requst_list02" id="subList">
					<?php
					if (($e_type == "1" || ($e_type == "2" && $detailCnt > 1)) && $master['test_type'] != "B") {
						if ($e_type == "1") {
							echo "<colgroup class='web_col'>";
							echo "<col style='width: 10%' />";
							echo "<col style='width: 20%' />";
							echo "<col style='width: 20%' />";
							echo "<col style='width: 20%' />";
							echo "<col style='width: 15%' />";
							echo "<col style='width: 15%' />";
							echo "</colgroup>";
							echo "<tr>";
							echo "<th class='web_td'>품목</th>";
							echo "<th>세부카테고리</th>";
							echo "<th>제조사</th>";
							echo "<th>모델명</th>";
							echo "<th>년식</th>";
							echo "<th>수량</th>";
							echo "</tr>";
							for ($i = 0; $row = sql_fetch_array($detail); $i++) {
								echo "<tr>";
								echo "<td class='web_td'>" . $row['item_cat'] . "</td>";
								echo "<td>" . $row['item_cat_dtl'] . "</td>";
								echo "<td>" . $row['manufacturer'] . "</td>";
								echo "<td>" . $row['medel_name'] . "</td>";
								echo "<td>" . $row['year'] . "</td>";
								echo "<td>" . $row['item_qty'] . "</td>";
								echo "</tr>";
							}
							echo "<tr>";
							echo "<th>참고사항</th>";
							echo "<td class='web_td' colspan='5'>" . $master['content'] . "</td>";
							echo "<td class='mob_td' colspan='4'>" . $master['content'] . "</td>";
							echo "</tr>";
						} else {
							echo "<colgroup>";
							echo "<col style='width: 30%' />";
							echo "<col style='width: 30%' />";
							echo "<col style='width: 20%' />";
							echo "<col style='width: 20%' />";
							echo "</colgroup>";
							echo "<tr>";
							echo "<th>철거종류</th>";
							echo "<th>천장/바닥 철거 유뮤</th>";
							echo "<th>철거평수</th>";
							echo "<th>철거사이즈</th>";
							echo "</tr>";
							for ($i = 0; $row = sql_fetch_array($detail); $i++) {
								echo "<tr>";
								echo "<td>" . $row['pull_kind'] . "</td>";
								echo "<td>" . $row['pull_floor_bottom'] . "</td>";
								echo "<td>" . $row['pull_space'] . "</td>";
								echo "<td>" . $row['pull_size'] . "</td>";
								echo "</tr>";
							}
							echo "<tr>";
							echo "<th>참고사항</th>";
							echo "<td colspan='3'>" . $master['content'] . "</td>";
							echo "</tr>";
						}
					}
					?>
				</table>
				<?php
				$sql = " select count(*) as cnt from {$g5['estimate_propose']} where estimate_idx = '$idx' and ifnull(content,'') != '' ";
				$request_cnt = sql_fetch($sql);
				if ($request_cnt['cnt'] > 0) {
					$sql = " select * from {$g5['estimate_propose']} where estimate_idx = '$idx' and ifnull(content,'') != '' ";
					$request_list = sql_query($sql);
					echo '<div class="text_note" id="partnerNote" style="margin-top:30px;">';
					echo '<h1>업체 견적 참고사항</h1>';
					for ($i = 0; $row = sql_fetch_array($request_list); $i++) {
						//업체명을 가려야 하는가?
						//$row['rc_nickname'] = preg_replace('/(?<=.{1})./u', '○', $row['rc_nickname']);
						echo '<p>' . $row['rc_nickname'] . ' - ' . $row['content'] . '</p>';
					}
					echo '</div>';
				}
				?>

				<div id="divRreview">
					<?php
					if ($state == "5") {
						if ($master['review_yn'] == "0") {
							echo "<h1 class='tt'>고객후기 <a class='main_bg' href='javascript:doAddReview();'>후기작성</a></h1>";
						} else {
							$sql1 = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' order by idx limit 1 ";
							$photo = sql_fetch($sql1);
							$score = $propose_review['score'];
							echo "<h1 class='tt'>고객후기</h1>";
							echo "<table class='re_view'>";
							echo "<colgroup class='web_col'>";
							echo "<col style='width: 15%' />";
							echo "<col style='width: 85%' />";
							echo "</colgroup>";
							echo "<tr>";
							if ($propose_review['photo1']) {
								echo "<th>" . estimate_img_thumbnail($propose_review['photo1'], 100, 100) . "</th>";
							} else {
								echo "<th>" . estimate_img_thumbnail($photo['photo'], 100, 100) . "</th>";
							}
							echo "<td>";
							echo "<div class='sub_tt'>" . get_etype($propose_review['e_type']) . " / " . $propose_review['title'] . "</div>";
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
							echo "<div class='date'>작성자 : " . $propose_review['nickname'] . " ㅣ 등록일 : " . $propose_review['completetime'] . "</div>";
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

<div class="modal fade" id="modal_select" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<form name="frmselect" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_select.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" id="idx" name="idx" value="<?php echo $master['idx']; ?>">
					<input type="hidden" id="sub_idx" name="sub_idx">
					<div class="text-center" id="area_before">
						<i class="xi-error-o"></i>
						<p id="selectBiz">재활용센터 선택하시겠습니까?</p>
						<input type="hidden" id="requesttime" name="requesttime" value="<?php echo $master['pickup_date']; ?>">
					</div>
					<div style="display: none;" class="text-center" id="area_after">
						<p style=" margin: 15px 0 30px;">업체 수거 완료 후 고객님 계좌로 입금 됩니다.</p>
						<div class="form-group">
							<input type="hidden" name="mb_bank" id="mb_bank" value="NH농협">
							<select id="mb_bank_select">
								<option value="NH농협">NH농협</option>
								<option value="우리은행">우리은행</option>
								<option value="국민은행">국민은행</option>
								<option value="기업은행">기업은행</option>
								<option value="신한은행">신한은행</option>
								<option value="하나은행">하나은행</option>
								<option value="SC은행">SC은행</option>
								<option value="카카오뱅크">카카오뱅크</option>
								<option value="산업은행">산업은행</option>
								<option value="대구은행">대구은행</option>
								<option value="광주은행">광주은행</option>
								<option value="전북은행">전북은행</option>
								<option value="한국씨티은행">한국씨티은행</option>
								<option value="부산은행">부산은행</option>
								<option value="수협은행">수협은행</option>
								<option value="경남은행">경남은행</option>
								<option value="기타은행입력">기타은행입력</option>
							</select>
							<input id="mb_bank_txt" style="display: none; margin-top: 15px;" type="text" name="mb_bank_txt" placeholder="은행명">
						</div>
						<div class="form-group">
							<input type="number" id="mb_bank_num" name="mb_bank_num" aria-describedby="계좌번호" placeholder="정산계좌번호">
						</div>
						<div class="form-group">
							<input type="text" id="mb_bank_name" name="mb_bank_name" aria-describedby="예금주명" placeholder="예금주명">
						</div>
						<p>작성해주신 이름과 같아야 합니다. </p>
					</div>
				</form>
				<div class="btn_wrap">
					<ul class="row">
						<li class="col-xs-3 col-xs-offset-3"><a class="line_bg" href="#." data-dismiss="modal">닫기</a></li>
						<li class="col-xs-3" id="confirm_before"><a class="main_bg" href="#none">확인</a></li>
						<li class="col-xs-3" id="confirm_after" style="display: none;"><a class="main_bg" href="javascript:doSelectComplete();">확인</a></li>
					</ul>
				</div>

			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 선택 -->
<div class="modal fade" id="modal_select_normal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<form name="frmselect_normal" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_select.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" id="idx" name="idx" value="<?php echo $master['idx']; ?>">
					<input type="hidden" id="sub_idx" name="sub_idx">
					<div class="text-center" id="area_before">
						<i class="xi-error-o"></i>
						<p id="selectBiz_normal">재활용센터 선택하시겠습니까?</p>
						<input type="hidden" id="requesttime" name="requesttime" value="<?php echo $master['pickup_date']; ?>">
					</div>
				</form>
				<div class="btn_wrap">
					<ul class="row">
						<li class="col-xs-3 col-xs-offset-3"><a class="line_bg" href="#." data-dismiss="modal">닫기</a></li>
						<li class="col-xs-3" id="confirm_after"><a class="main_bg" href="javascript:doSelectComplete_normal();">확인</a></li>
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
					<form name="frmreview" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_review_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
						<input type="hidden" id="idx" name="idx" value="<?php echo $master['idx']; ?>">
						<input type="hidden" id="sub_idx" name="sub_idx" value="<?php echo $master['sub_idx']; ?>">
						<div class="write">
							<table>
								<colgroup>
									<col style="width: 20%" />
									<col style="width: 80%" />
								</colgroup>
								<tr>
									<th>평점</th>
									<td>
										<input type="hidden" id="subIdx">
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
</div><!-- 업체정보 -->
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
<form name="frmcancel" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_cancel.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="idx" name="idx" value="<?php echo $master['idx']; ?>">
	<input type="hidden" id="state" name="state" value="6">
	<input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
</form>
<div class="loader"></div>
<?php
if (!$select_gubun) {
	$select_gubun = "1";
}
?>
<script type="text/javascript" src="/share/js/jquery.bxslider.js"></script>
<script>
	jQuery(document).ready(function() {
		$('#mb_bank_select').change(function() {
			if ($(this).val() == '기타은행입력') {
				$('#mb_bank_txt').css('display', 'block');
				$("#mb_bank").val('');
			} else {
				$('#mb_bank_txt').css('display', 'none');
				$("#mb_bank").val($(this).val());
			}
		});
		$("#confirm_before").click(function() {
			$(this).css('display', 'none');
			$("#confirm_after").css('display', 'block');
			$("#area_after").css('display', 'block');
			$("#area_before").css('display', 'none');
		});

		$('#view_slider').bxSlider({
			auto: false, // 자동 슬라이드 사용여부
			controls: false, // 양옆컨트롤(prev/next) 사용여부
			speed: 1000,
			preloadImages: 'all',
			pager: true,
			pagerCustom: '#bx-pager'
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
		$("#mob_view_slider a").lightbox();
		$("#view_slider a").lightbox();
		doChangeSelect("<?php echo $select_gubun ?>");
	});

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

	function doChangeSelect(gubun) {
		if (gubun == "1") {
			$("#selectGubun1").removeClass("on");
			$("#selectGubun2").removeClass("on");
			$("#selectGubun3").removeClass("on");
			$("#selectGubun1").addClass("on");
			$("#proposeList").show();
			$("#detailTitle").show();
			$("#subDetail").show();
			$("#subList").show();
			$("#partnerNote").show();
			$("#divRreview").show();
			$("#selectList").hide();
			$("#searchList").hide();
		} else if (gubun == "2") {
			$("#selectGubun1").removeClass("on");
			$("#selectGubun2").removeClass("on");
			$("#selectGubun3").removeClass("on");
			$("#selectGubun2").addClass("on");
			$("#proposeList").hide();
			$("#detailTitle").hide();
			$("#subDetail").hide();
			$("#subList").hide();
			$("#partnerNote").hide();
			$("#divRreview").hide();
			$("#selectList").show();
			$("#searchList").hide();
		} else if (gubun == "3") {
			$("#selectGubun1").removeClass("on");
			$("#selectGubun2").removeClass("on");
			$("#selectGubun3").removeClass("on");
			$("#selectGubun3").addClass("on");
			$("#proposeList").hide();
			$("#detailTitle").hide();
			$("#subDetail").hide();
			$("#subList").hide();
			$("#partnerNote").hide();
			$("#divRreview").hide();
			$("#selectList").hide();
			$("#searchList").show();
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

	function doSelect_normal(idx, estimateIdx, bizName) {
		//폐기만 있을 떄
		//$("#selectBiz").html(bizName);
		$("#selectBiz_normal").html(bizName + " 선택하시겠습니까?");
		var f = document.frmselect_normal;
		f.idx.value = estimateIdx;
		f.sub_idx.value = idx;
		vEstimateIdx = estimateIdx;
		$("#modal_select_normal").modal();
	}

	function doSelect(idx, estimateIdx, bizName) {
		//$("#selectBiz").html(bizName);
		$("#selectBiz").html(bizName + " 선택하시겠습니까?");
		var f = document.frmselect;
		f.idx.value = estimateIdx;
		f.sub_idx.value = idx;
		vEstimateIdx = estimateIdx;
		$("#modal_select").modal();
	}

	function doSelectComplete_normal() {
		var f = document.frmselect_normal;
		f.submit();

	}

	function doSelectComplete() {
		var f = document.frmselect;
		if (!cfnNullCheckInput($("#mb_bank_num").val(), "계좌번호")) return;
		if (!cfnNullCheckInput($("#mb_bank_name").val(), "예금주명")) return;
		f.submit();

	}

	function doPriceDetail(idx, estimateIdx, rcEmail) {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.price.modal.php",
			data: {
				idx: estimateIdx,
				rc_email: rcEmail
			},
			cache: false,
			success: function(data) {
				$("#frmPrice").html(data);

				$("#modal_price_detail").modal();
			}
		});
	}

	function doRequest(idx, email) {
		if (confirm("문의 하시겠습니까?")) {
			var f = document.frmrequest;
			f.idx.value = idx;
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
	var swiper = new Swiper('.swiper-container', {
		slidesPerView: 1,
		loop: true,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		var btn_x = document.getElementById("close_modal");
		var modal = document.getElementById("modal_background");

		$("#close_modal").click(function() {
			$('#modal_info').modal("hide");
		});

		window.onclick = function(event) {

			if (event.target == modal) {
				$('#modal_info').modal("hide");
			}
		}

		$("#area_tit").height($('#area').height());
	});

	$(window).load(function() { //페이지 로드 완료시. 기존 loader가 있어서 사용.
		$(".loader").fadeOut(function() {
			$(this).remove();
		});
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

<div class="modal fade guide" id="img_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="color:#1379cd !important; font-weight: 700;" class="modal-title" id="myModalLabel">견적진행 가이드</h4>
			</div>
			<div class="modal-body">
				<div>
					<ul class="row">
						<li class="md_guide">
							- 사진 넣을때 실제사진을 넣어야 견적을 정확하게 받을수있습니다.
						</li>
						<li class="md_guide">
							- 무료수거가 아닌경우에는 폐기로 진행되실 수 있습니다.
						</li>
						<li class="md_guide">
							- 연식이나 물품상태따라 폐기견적이 들어올수있습니다.
						</li>
						<li class="md_guide">
							- 폐기 및 철거는 비용이 발생하며 고객님 부담사항입니다.
						</li>
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
</div><!--  가이드 -->

<script type="text/javascript">
	var v_area1 = "<?php echo $area1; ?>";
	var v_area2 = "<?php echo $area2; ?>";


	jQuery(document).ready(function() {

		doSelectArea1();


	});

	function doSelectArea1() {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.area1.php",
			data: {
				"area1": $('#srchArea1').val()
			},
			cache: false,
			success: function(data) {
				var fvHtml = "<option value=\"\" selected>시/도 전체</option>";
				fvHtml += data;
				$("#srchArea1").html(fvHtml);

				if (v_area1) {
					$("#srchArea1").val(v_area1);
					v_area1 = "";
					doSelectArea2();
				} else {
					fvHtml = "<option value=\"\" selected>시/구/군  전체</option>";
					$("#srchArea2").html(fvHtml);
				}
				$('#srchArea1').change(function() {
					doSelectArea2();
				});

			}
		});
	}

	function doSelectArea2() {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.area2.php",
			data: {
				"area1": $('#srchArea1').val()
			},
			cache: false,
			success: function(data) {
				var fvHtml = "";
				if ($("#srchArea1").val()) {
					fvHtml += "<option value=\"\" selected>" + $("#srchArea1").val() + " 전체</option>";
				} else {
					fvHtml += "<option value=\"\" selected>시/도</option>";
				}
				fvHtml += data;
				$("#srchArea2").html(fvHtml);
				if (v_area2) {
					$("#srchArea2").val(v_area2);
					v_area2 = "";
				}

			}
		});
	}
</script>
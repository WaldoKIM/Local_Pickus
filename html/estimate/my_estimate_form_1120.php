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
						min(price) as min_price
				from
					{$g5['estimate_propose']}
				where
					estimate_idx =  '$idx'
					and meet = '0'
				group by estimate_idx
			) b on a.idx = b.estimate_idx
			left join {$g5['estimate_propose']} c on a.idx = c.estimate_idx and c.selected = '1'
			left join (
				select estimate_idx, count(*) as cnt from {$g5['estimate_propose']} group by estimate_idx
			) d on a.idx = d.estimate_idx
		where
			a.idx =  '$idx'	 ";
$master = sql_fetch($sql);

if($master['sub_key'] !='0'){
	$sql = " select count(*) as cnt from {$g5['estimate_list_multi']} where sub_key = '{$master['sub_key']}'  ";
	$detail_cnt = sql_fetch($sql);
	$detailCnt = $detail_cnt['cnt'];
	$sql = " select * from {$g5['estimate_list_multi']} where sub_key = '{$master['sub_key']}'  ";
	if($detail_cnt['cnt'] == 1 && $master['e_type'] == "2"){
		$detail = sql_fetch($sql);
	}else{
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
					a.charge_rate,
					a.charge_amt,
					a.remain_amt,
					a.meet,
					a.selected,
					a.proposetime,
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
					a.charge_rate,
					a.charge_amt,
					a.remain_amt,
					a.meet,
					a.selected,
					a.proposetime,
					b.mb_biz_addr1,
					b.mb_biz_score,
					b.mb_photo_site,
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
					date_format(a.updatetime,'%y.%m.%d') as updatetime,
					case when ifnull(a.review,'') !=  ''  then 'Y' else 'N' end as review_yn,
					a.attach_file
				from
					{$g5['estimate_propose']} a
					join {$g5['estimate_list']} b on a.estimate_idx = b.idx
				where
					a.estimate_idx = '$idx'
					and ifnull(a.review,'') !=  '' ";

$propose_review = sql_fetch($sql);

$sql = " select count(*) as cnt from {$g5['estimate_propose']} where estimate_idx = '$idx' ";
$propose_cnt = sql_fetch($sql);
$centerCnt = $propose_cnt['cnt'];

if($master['state'] == "7"){
	alert("취소된 견적입니다.");
}

$price = 0;
if($propose_success){
	$price = $propose_success['price'];
}
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/swiper.min.css"/>
<link rel="stylesheet" type="text/css" href="/share/css/jquery.bxslider.css"/>
<div class="sub_title">
	<h1 class="main_co">내신청현황</h1>
</div><!-- sub_title -->
<form name="frmrequest" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_request_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="idx">
	<input type="hidden" name="email">
</form>
<div class="member com_pd">
	<div class="container">

		<div id="board">

			<div class="view">
				<div class="mob">
					<div class="mob_slider swiper-container">
						<ul id="mob_view_slider" class="swiper-wrapper">
							<?php
								$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
								$photo = sql_query($sql);
								for ($i=0; $row1=sql_fetch_array($photo); $i++) {
									echo '<li class="swiper-slide"><a href="'.G5_DATA_URL.'/estimate/'.$row1['photo'].'" target="_blank">'.estimate_img_thumbnail($row1['photo'], 350, 350).'</a></li>';
								}
							?>
						</ul>
						<div class="text" id="mobileEtype"><?php echo get_etype($master['e_type']);?></div>
				    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
					</div>

					<div class="text-center mob_ing" id="mobileStatus">
						<?php echo get_estimate_mobile_state_tag($master['state']);?>
					</div>

					<ul class="row mob_info" id="mobileInfo1">
					<?php
						echo "<li class='col-xs-4'>";
						if($master['selected'] != "1"){
							if($master['e_type'] == "2"){
								echo "<p class='text-center main_co'><i class='xi-calendar-check'></i> 철거요청일</p>";
							}else{
								echo "<p class='text-center main_co'><i class='xi-calendar-check'></i> 수거요청일</p>";
							}
							echo "<p class='text-center'>".$master['pickup_date']."</p>";
						}else{
							if($master['completetime'])
							{
								if($master['e_type'] == "2"){
									echo "<p class='text-center main_co'><i class='xi-calendar-check'></i> 철거확정일</p>";
								}else{
									echo "<p class='text-center main_co'><i class='xi-calendar-check'></i> 수거확정일</p>";
								}
								echo "<p class='text-center'>".$master['completetime']."</p>";
							}else{
								if($master['e_type'] == "2"){
									echo "<p class='text-center main_co'><i class='xi-calendar-check'></i> 철거요청일</p>";
								}else{
									echo "<p class='text-center main_co'><i class='xi-calendar-check'></i> 수거요청일</p>";
								}
								echo "<p class='text-center'>".$master['requesttime']."</p>";
							}
						}
						echo "</li>";
						echo "<li class='col-xs-4'>";
						echo "<p class='text-center main_co'><i class='xi-emoticon'></i> 참여수</p>";
						if($master['price_qty'] > 0){
							echo "<p class='text-center'>".$master['price_qty']."명</p>";
						}else{
							echo "<p class='text-center'>-명</p>";
						}
						echo "</li>";
						echo "<li class='col-xs-4'>";
						if($master['state'] == "0" || $master['state'] == "1" || $master['state'] == "2"){
							echo "<p class='text-center main_co'><i class='xi-money'></i> 센터견적가격</p>";
						}else{
							echo "<p class='text-center main_co'><i class='xi-money'></i> 선택견적가격</p>";
						}
						if($master['price_qty'] > 0){
							if($master['state'] == "0" || $master['state'] == "1" || $master['state'] == "6"){
								echo "<p class='text-right'>".display_estimate_price($master['price'])."</p>";
							}else if($master['state'] == "2"){
								echo "<p class='text-right'>".display_estimate_price($master['price'])."</p>";
							}else{
								echo "<p class='text-right'>".display_estimate_price($price)."</p>";
							}
						}else{
							echo "<p class='text-right'>- 원</p>";
						}

						echo "</li>";
					?>
					</ul>

					<div class="customer">
						<dl class="row" id="mobileInfo2">
						<?php
							echo "<dt class='col-xs-1 main_co'>지역</dt>";
							echo "<dd class='col-xs-11'>".$master['area1']." ".$master['area2']." ".$master['area3']."</dd>";
							echo "<dt class='col-xs-1 main_co'>층수</dt>";
							echo "<dd class='col-xs-11'>".$master['elevator_yn']."/".$master['floor']."</dd>";
						?>
						<?php
							if($master['attach_file']){
								echo "<dt class='col-xs-1 main_co'>파일</dt><dd class='col-xs-11'style='padding-bottom: 4px;'><a href='".G5_DATA_URL.'/estimate/'.$master['attach_file']."' style='height:23px;line-height:25px;'>다운로드</a></dd>";
							}
						?>
						</dl>
						<?php
							if($master['state'] == "3" || $master['state'] == "4" ||$master['state'] == "5"){
								 /* echo "<a class='line_bg1' href='#!' onClick='doTel(\"".$propose_success['mb_hp']."\")')'>센터전화 하기</a>"; */
							}
						?>
					</div>
					<div class="warning" id="mobileWaring">
						<?php
							if($master['state'] == "2"){
								echo "<h1 class='text-center main_co'>견적이 완료되었습니다.업체를 선택해주세요</h1>";
							}else if($master['state'] == "3"){
								echo "<h1 class='text-center main_co'>* 센터에서 고객님께 곧 연락드립니다.</h1>";
							}
						?>
					</div>

					<div class="customer">
						<dl class="row" id="mobileButton">
						<?php
							if($master['state'] == "0" || $master['state'] == "1"){
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
						<th class="photo">
							<ul id="view_slider">
							<?php
								$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
								$photo = sql_query($sql);
								for ($i=0; $row1=sql_fetch_array($photo); $i++) {
									echo '<li>'.estimate_img_thumbnail($row1['photo'], 350, 350).'</li>';
								}
							?>
							</ul>
							<div class="pager_wrap">
								<ul id="bx-pager">
								<?php
									$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
									$photo = sql_query($sql);
									for ($i=0; $row1=sql_fetch_array($photo); $i++) {
										echo "<li><a data-slide-index='".$i."' href=''>".estimate_img_thumbnail($row1['photo'], 350, 350)."</a></li>";
									}
								?>
								</ul>
							</div>
						</th>
						<td class="info" id="mainTitle">
							<h1><?php echo get_etype($master['e_type']); ?></h1>
							<dl>
								<dt class="col-xs-3">제목</dt><dd class="col-xs-9"><?php echo $master['title']; ?></dd>
							<?php

								$state    = $master['state'];
								$e_type   = $master['e_type'];
								$selected = $master['selected'];

								if($state == "0" || $state == "1" || $state == "6"){
									if($master['price_qty'] > 0){
										if($e_type == "2"){
											echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>".$master['price_qty']."명</dd>";
											echo "<dt class='col-xs-3'>최저가적</dt><dd class='col-xs-9'>".display_estimate_price($master['price'])."</dd>";
										}else{
											echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>".$master['price_qty']."명</dd>";
											echo "<dt class='col-xs-3'>최고견적</dt><dd class='col-xs-9'>".display_estimate_price($master['price'])."</dd>";
										}
									}else{
										if($e_type == "2"){
											echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>- 명</dd>";
											echo "<dt class='col-xs-3'>최저가적</dt><dd class='col-xs-9'>- 원</dd>";
										}else{
											echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>- 명</dd>";
											echo "<dt class='col-xs-3'>최고견적</dt><dd class='col-xs-9'>- 원</dd>";
										}
									}
								}else if($state == "2"){
									echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>".$master['price_qty']."명</dd>";
									if($e_type == "2"){
										echo "<dt class='col-xs-3'>최저가적</dt><dd class='col-xs-9'>".display_estimate_price($master['price'])."</dd>";
									}else{
										echo "<dt class='col-xs-3'>최고견적</dt><dd class='col-xs-9'>".display_estimate_price($master['price'])."</dd>";
									}
								}else if($state == "3"){
									echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>".$master['price_qty']."명</dd>";
									echo "<dt class='col-xs-3'>선택견적</dt><dd class='col-xs-9'>".display_estimate_price($price)."</dd>";
								}else{
									echo "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>".$master['price_qty']."명</dd>";
									echo "<dt class='col-xs-3'>선택견적</dt><dd class='col-xs-9'>".display_estimate_price($price)."</dd>";
								}

							?>
								<dt class="col-xs-3">지역</dt><dd class="col-xs-9"><?php echo $master['area1']; ?> <?php echo $master['area2']; ?> <?php echo $master['area3']; ?></dd>
								<dt class="col-xs-3">층수</dt><dd class="col-xs-9"><?php echo $master['elevator_yn']; ?>/<?php echo $master['floor']; ?></dd>
								<dt class="col-xs-3">견적마감일</dt><dd class="col-xs-9"><?php echo date( 'Y-m-d', strtotime($master['deadline'] ) ); ?></dd>
							<?php
								if($master['selected'] != "1"){
									if($master['e_type'] == "2"){
										echo "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>".$master['pickup_date']."</dd>";
									}else{
										echo "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>".$master['pickup_date']."</dd>";
									}
								}else{
									if($master['completetime']){
										if($master['e_type'] == "2"){
											echo "<dt class='col-xs-3'>철거확정일</dt><dd class='col-xs-9'>".$master['completetime']."</dd>";
										}else{
											echo "<dt class='col-xs-3'>수거확정일</dt><dd class='col-xs-9'>".$master['completetime']."</dd>";
										}
									}else{
										if($master['e_type'] == "2"){
											echo "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>".$master['requesttime']."</dd>";
										}else{
											echo "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>".$master['requesttime']."</dd>";
										}
									}
								}
							?>
							</dl>
							<?php
								if($master['attach_file']){
									echo "<dt class='col-xs-3'>첨부파일</dt><dd class='col-xs-9'><a href='".G5_DATA_URL.'/estimate/'.$master['attach_file']."' style='height:23px;line-height:25px;'>다운로드</a></dd>";
								}
							?>
							<?php
								if($state == "0" || $state == "1"){
									echo "<ul class='row'>";
									echo "<li class='col-xs-6'></li>";
									echo "<li class='col-xs-6'>";
									echo "<a class='main_bg' href='javascript:doCancel()'>";
									echo "견적취소";
									echo "</a>";
									echo "</li>";
									echo"</ul>";
								}
							?>
						</td>
					</tr>
				</table>
				<div class="web">
					<div class="warning" id="divWaring">
					<?php
						if($state == "2"){
							echo "<h1 class='text-center main_co'>견적이 완료되었습니다.업체를 선택해주세요</h1>";;
						}else if($state == "3"){
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
						<?php if($state == "1"||$state == "2"){ ?>
						<li class="col-xs-3" id="selectGubun2">
							<a href="javascript:doChangeSelect('2')">
								<h4>추천업체</h4>
							</a>
						</li>
					<?php } ?>
					</ul>
				</div>

				<!--0403 별점 없는것 추천업체
				<ul class="shop_list" id="selectList" style="display: block;">
					<li>
						<div>
							<div class="img"><img src="/" style="width:100%;"></div>
							<div class="text">
								<h4>피커스 PICKUS</h4>
							</div>
							<div class="btn_list">
								<ul class="row">
									<li class="col-xs-6"></li>
									<li class="col-xs-6"><a class="main_bg" href="javascript:doRequest(&quot;2704&quot;,&quot;modoo@repickus.com&quot;)">문의하기</a></li>
								</ul>
							</div>
						</div>
						-->

				<!--0403 별점 있는 추천업체
						<ul class="shop_list" id="selectList" style="display: block;">
							<li>
								<div>
									<div class="img"><img src="/" style="width:100%;"></div>
									<div class="text">
										<i class="xi-star"></i>
										<i class="xi-star"></i>
										<i class="xi-star"></i>
										<i class="xi-star"></i>
										<i class="xi-star"></i>
										<a class="re_btn" href="javascript:doReview(&quot;modoo@repickus.com&quot;,&quot;5&quot;)">후기보기 <i class="xi-angle-right-min"></i></a>
									<h4>피커스 PICKUS</h4>
									</div>
									<div class="btn_list">
										<ul class="row">
											<li class="col-xs-6"></li>
											<li class="col-xs-6"><a class="main_bg" href="javascript:doRequest(&quot;2704&quot;,&quot;modoo@repickus.com&quot;)">문의하기</a></li>
										</ul>
									</div>
								</div>
									-->




				<ul class="shop_list" id="proposeList">
				<?php
					if($centerCnt > 0){
						if($state == "3"||$state == "4"||$state == "5"){
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
							echo "<div class='img'>".estimate_img_thumbnail($propose_success['mb_photo_site'], 350, 350)."</div>";
							echo "<div class='text'>";
							if($score > 0 && $score_row['cnt'] > 0)
							{
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
								echo "<a class='re_btn' href='javascript:doReview(\"".$propose_success['rc_email']."\",\"".$propose_success['score']."\")'>후기보기 <i class='xi-angle-right-min'></i></a>";								
							}

							echo "<h4>".$propose_success['rc_nickname']."</h4>";
							//echo "<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>".$propose_success['mb_biz_addr1']."</h5>";
							if($propose_success['meet']){
								echo "<div class='pay main_co'><span>방문견적</span></div>";
							}else{
								if(!$propose_success['price']){
									if($e_type =="2"){
										echo "<div class='pay main_co'><span>무료철거</span></div>";
									}else{
										echo "<div class='pay main_co'><span>무료수거</span></div>";
									}
								}else{
									echo "<div class='pay main_co'><span>".number_format($propose_success['price'],0)."</span>원</div>";
								}

							}
							echo "</div>";
							echo "<div class='btn_list'>";
							echo "<ul class='row'>";
							echo "<li class='col-xs-6'>";
							if($e_type =="2"){
								echo "<a class='line_bg' href='javascript:doPriceDetail(\"".$propose_success['idx']."\",\"".$propose_success['estimate_idx']."\",\"".$propose_success['rc_email']."\")'>상세견적</a>";

							}else{
								if($propose_success['attach_file'])
								{
									echo "<a class='line_bg' href='".G5_DATA_URL.'/estimate/'.$propose_success['attach_file']."'>파일확인</a>";
								}
							}
							echo "</li>";

							echo "<li class='col-xs-6'>";

							echo "<a class='sub_bg' href='javascript:'>선택완료</a>";
							/*echo "<a class='main_bg1' href='javascript:doSelect(\"".$row['idx']."\",\"".$row['estimate_idx']."\",\"".$row['rc_nickname']."\")'>파일확인</a>";*/
							echo "</li>";
							echo "</ul>";
							echo "</div>";
							echo "</div>";
							echo "</li>";
						}else if($state == "1"||$state == "2"){
							for ($i=0; $row=sql_fetch_array($propose_process); $i++) {
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
								echo "<div class='img'>".estimate_img_thumbnail($row['mb_photo_site'], 350, 350)."</div>";
								echo "<div class='text'>";
								if($score > 0 && $score_row['cnt'] > 0)
								{
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
									echo "<a class='re_btn' href='javascript:doReview(\"".$row['rc_email']."\",\"".$row['score']."\")'>후기보기 <i class='xi-angle-right-min'></i></a>";

								}
								echo "<h4>".$row['rc_nickname']."</h4>";
								//echo "<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>".$row['mb_biz_addr1']."</h5>";
								if($row['meet']){
									echo "<div class='pay main_co'><span>방문견적</span></div>";
								}else{
									if(!$row['price']){
										if($e_type =="2"){
											echo "<div class='pay main_co'><span>무료철거</span></div>";
										}else{
											echo "<div class='pay main_co'><span>무료수거</span></div>";
										}
									}else{
										echo "<div class='pay main_co'><span>".number_format($row['price'],0)."</span>원</div>";
									}

								}
								echo "</div>";
								echo "<div class='btn_list'>";
								echo "<ul class='row'>";
								echo "<li class='col-xs-6'>";
								if($e_type =="2" && !$row['meet']){
									echo "<a class='line_bg' href='javascript:doPriceDetail(\"".$row['idx']."\",\"".$row['estimate_idx']."\",\"".$row['rc_email']."\")'>상세견적</a>";
								}else{
									if($row['attach_file'])
									{
	                                    echo "<a class='line_bg' href='".G5_DATA_URL.'/estimate/'.$row['attach_file']."'>파일확인</a>";

									}
								}
								echo "</li>";
								echo "<li class='col-xs-6'>";
								if($row['meet']){
									echo "<a class='main_bg' href='javascript:'>방문견적</a>";
                                }
                                else{

									echo "<a class='main_bg' href='javascript:doSelect(\"".$row['idx']."\",\"".$row['estimate_idx']."\",\"".$row['rc_nickname']."\")'>업체선택</a>";

                                }
								echo "</li>";
								echo "</ul>";
								echo "</div>";
								echo "</div>";
								echo "</li>";
							}
						}
					}else{
						echo "<li class='no_data'><div><i class='xi-error-o'></i>업체 견적이 들어오지 않았습니다.</div></li>";
					}
				?>
				</ul><!-- shop_list -->
				<ul class="shop_list" id="selectList">
				<?php
					if($state == "1"||$state == "2"){
				?>
				<?php
						$sql = " select a.*, case when b.rc_email is not null then 'Y' else 'N' end as request_yn, b.estimate_yn from {$g5['member_table']} a left join {$g5['estimate_request']} b on a.mb_email = b.rc_email and b.estimate_idx = '$idx' ";
						if($e_type == "0" || $e_type == "1"){
							$sql .= " where mb_biz_type in ('1','3') ";
						}else{
							$sql .= " where mb_biz_type in ('2','3') ";
						}

						$area1 = $master['area1'];
						$area2 = $master['area2'];
						$sql .= " and mb_id in ( select mb_id from {$g5['member_area_table']} where 1=1 and ( ( mb_area1 = '$area1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$area1' and mb_area2 = '$area2'))) ";
						$sql .= " and mb_email not in ( select rc_email from {$g5['estimate_propose']} where estimate_idx = '$idx') ";
						$sql .= " order by mb_biz_score desc limit 8";

						$request_list = sql_query($sql);
						for ($i=0; $row=sql_fetch_array($request_list); $i++) {
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
							echo "<div class='img'>".estimate_img_thumbnail($row['mb_photo_site'], 350, 350)."</div>";
							echo "<div class='text'>";
							if($score > 0 && $score_row['cnt'] > 0)
							{
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
								echo "<a class='re_btn' href='javascript:doReview(\"".$row['mb_email']."\",\"".$row['mb_biz_score']."\")'>후기보기 <i class='xi-angle-right-min'></i></a>";
							}
							echo "<h4>".$row['mb_name']."</h4>";
							//echo "<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>".$row['mb_biz_addr1']."</h5>";
							echo "</div>";
							echo "<div class='btn_list'>";
							echo "<ul class='row'>";
							echo "<li class='col-xs-6'>";
							echo "</li>";
							echo "<li class='col-xs-6'>";
							if($row['estimate_yn']){
								echo "<a class='sub_bg' href='javascript:' style='background:#da1a1a !important; color:#fff;'>수거불가</a>";
							}else{
								if($row['request_yn'] == "Y"){
									echo "<a class='sub_bg' href='javascript:'>문의중</a>";
								}else{
									echo "<a class='main_bg' href='javascript:doRequest(\"".$idx."\",\"".$row['mb_email']."\")'>문의하기</a>";
								}
							}
							echo "</li>";
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
			    	if($state == "3"||$state == "4"||$state == "5"){
			    ?>
                	<div id="btn_test" class="btn_wrap">
                		<ul class="row">
                			<li class="co1-10">
                				<a class='sub_bg_call' href='javascript:doTel("<?php echo $propose_success['mb_hp'] ?>")'>선택업체 전화하기</a> <!-- 0403 전화하기 추가-->
                			</li>
                		</ul>
                	</div>
			    <?php
			    	}
			    ?>

				<h1 class="tt" id="detailTitle">상세정보</h1>


				<table class="requst_list" id="subDetail">
				<?php
					if($e_type == "0" || ($e_type == "2" && $detailCnt == 1 & $master['test_type'] != "B" )){
						echo "<colgroup>";
						echo "<col style='width: 20%' />";
						echo "<col style='width: 30%' />";
						echo "<col style='width: 20%' />";
						echo "<col style='width: 30%' />";
						echo "</colgroup>";
						if($e_type == "0"){
							echo "<tr>";
							echo "<th>품목</th><td>".$master['item_cat']." ".$master['item_cat_dtl']."</td>";
							echo "<th>제조사</th><td>".$master['manufacturer']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>모델명</th><td>".$master['medel_name']."</td>";
							echo "<th>연식</th><td>".$master['year']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>참고사항</th><td colspan='3'>".$master['content']."</td>";
							echo "</tr>";
						}else{
							echo "<tr>";
							echo "<th>철거종류</th><td>".$detail['pull_kind']."</td>";
							echo "<th>천장/바닥 철거</th><td>".$detail['pull_floor_bottom']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>철거평수</th><td>".$detail['pull_space']."</td>";
							echo "<th>철거사이즈</th><td>".$detail['pull_size']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>참고사항</th><td colspan='3'>".$master['content']."</td>";
							echo "</tr>";
						}
					}

					if($master['test_type'] == "B"){
						if($e_type == "2"){
							$pull_kind_etc = "";
							if($master['pull_kind_etc']){
								$pull_kind_etc = ','.$master['pull_kind_etc'];
							}
							echo "<tr>";
							echo "<th>철거종류</th><td>".$master['pull_kind'].$pull_kind_etc."</td>";
							echo "<th>천장/바닥 철거</th><td>".$master['pull_floor_bottom']."</td>";
							echo "</tr>";
						}
						if($e_type == "1" || $e_type == "2"){
							echo "<tr>";
							echo "<th>참고사항</th><td colspan='3'>".$master['content']."</td>";
							echo "</tr>";
						}
					}
				?>
				</table>

				<table class="requst_list02" id="subList">
				<?php
					if(($e_type == "1" || ($e_type == "2" && $detailCnt > 1)) && $master['test_type'] != "B"){
						if($e_type == "1"){
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
							for ($i=0; $row=sql_fetch_array($detail); $i++) {
								echo "<tr>";
								echo "<td class='web_td'>".$row['item_cat']."</td>";
								echo "<td>".$row['item_cat_dtl']."</td>";
								echo "<td>".$row['manufacturer']."</td>";
								echo "<td>".$row['medel_name']."</td>";
								echo "<td>".$row['year']."</td>";
								echo "<td>".$row['item_qty']."</td>";
								echo "</tr>";
							}
							echo "<tr>";
							echo "<th>참고사항</th>";
							echo "<td class='web_td' colspan='5'>".$master['content']."</td>";
							echo "<td class='mob_td' colspan='4'>".$master['content']."</td>";
							echo "</tr>";
						}else{
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
							for ($i=0; $row=sql_fetch_array($detail); $i++) {
								echo "<tr>";
								echo "<td>".$row['pull_kind']."</td>";
								echo "<td>".$row['pull_floor_bottom']."</td>";
								echo "<td>".$row['pull_space']."</td>";
								echo "<td>".$row['pull_size']."</td>";
								echo "</tr>";
							}
							echo "<tr>";
							echo "<th>참고사항</th>";
							echo "<td colspan='3'>".$master['content']."</td>";
							echo "</tr>";
						}
					}
				?>
				</table>
				<?php
					$sql = " select count(*) as cnt from {$g5['estimate_propose']} where estimate_idx = '$idx' and ifnull(content,'') != '' ";
					$request_cnt = sql_fetch($sql);
					if($request_cnt['cnt'] > 0){
						$sql = " select * from {$g5['estimate_propose']} where estimate_idx = '$idx' and ifnull(content,'') != '' ";
						$request_list = sql_query($sql);
						echo '<div class="text_note" id="partnerNote" style="margin-top:30px;">';
						echo '<h1>업체 견적 참고사항</h1>';
						for ($i=0; $row=sql_fetch_array($request_list); $i++) {
							echo '<p>'.$row['rc_nickname'].' - '.$row['content'].'</p>';
						}
						echo '</div>';
					}
				?>

				<div id="divRreview">
				<?php
					if($state == "5"){
						if($master['review_yn'] == "0"){
							echo "<h1 class='tt'>고객후기 <a class='main_bg' href='javascript:doAddReview();'>후기작성</a></h1>";
						}else{
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
							if($propose_review['photo1']){
								echo "<th>".estimate_img_thumbnail($propose_review['photo1'], 100, 100)."</th>";
							}else{
									echo "<th>".estimate_img_thumbnail($photo['photo'], 100, 100)."</th>";
							}
							echo "<td>";
							echo "<div class='sub_tt'>".get_etype($propose_review['e_type'])." / ".$propose_review['title']."</div>";
							echo "<div class='con'>".$propose_review['review']."</div>";
							echo "<div class='icon'>";
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
							echo "</div>";
							echo "<div class='date'>작성자 : ".$propose_review['nickname']." ㅣ 등록일 : ".$propose_review['updatetime']."</div>";
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
						<a class="main_bg" href="./my_estimate_list.php?page=<?php echo $page;?>">리스트</a>
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
					<input type="hidden" id="idx"     name="idx" value="<?php echo $master['idx']; ?>">
					<input type="hidden" id="sub_idx" name="sub_idx">
					<div class="text-center">
						<i class="xi-error-o"></i>
						<p id="selectBiz">재활용센터 선택하시겠습니까?</p>
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
					<p>선택 완료했습니다<br/>곧 연락예정입니다</p>
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
					<input type="hidden" id="idx"     name="idx" value="<?php echo $master['idx']; ?>">
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
									<select class="input_default" id="score"  name="score">
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
<form name="frmcancel" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_cancel.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="idx"  name="idx" value="<?php echo $master['idx']; ?>">
	<input type="hidden" id="state" name="state" value="6">
	<input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
</form>
<?php
	if(!$select_gubun){
		$select_gubun = "1";
	}
?>
<script type="text/javascript" src="/share/js/jquery.bxslider.js"></script>
<script>
jQuery(document).ready(function(){
	$('#view_slider').bxSlider({
		auto: false,					// 자동 슬라이드 사용여부
		controls: false,				// 양옆컨트롤(prev/next) 사용여부
		speed: 1000,
		preloadImages: 'all',
		pager : true,
		pagerCustom:'#bx-pager'
	});

	$('#bx-pager').bxSlider({
		minSlides : 5,
		maxSlides : 5,
		slideWidth : 200,
		slideMargin : 5,
		controls: true,
		pager : false
	});

/*	$('#mob_view_slider').bxSlider({
		auto: false,					// 자동 슬라이드 사용여부
		controls: true,				// 양옆컨트롤(prev/next) 사용여부
		speed: 1000,
		preloadImages: 'all',
		pager : false,
		oneToOneTouch : false
	});*/

	doChangeSelect("<?php echo $select_gubun ?>");
});

function doChangeSelect(gubun)
{
	if(gubun == "1"){
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
	}else{
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
function doReview(rcEmail, score)
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.review.modal.php",
        data: {
        	rc_email:rcEmail
        },
        cache: false,
        success: function(data) {
			$("#modal_review_content").html(data);

			$("#modal_review").modal();
        }
    });
}

function doAddReview()
{
	$("#score").val("5");
	$("#review").val("");
	$('#modal_add_review').modal();
}

function doSaveReview()
{

	var f = document.frmreview;
	if(!f.review.value){
		alert("내용을 작성해주세요");
		return;
	}
	f.submit();
}

function doCloseReview()
{
	$('#modal_add_review').modal("hide");
}
function doCancel()
{
	if(!confirm("견적을 취소하시겠습니까?")) return;
	var f = document.frmcancel;
	f.submit();
}

function doSelect(idx, estimateIdx, bizName)
{
	//$("#selectBiz").html(bizName);
	$("#selectBiz").html(bizName+" 선택하시겠습니까?");
	var f = document.frmselect;
	f.idx.value = estimateIdx;
	f.sub_idx.value = idx;
	vEstimateIdx = estimateIdx;
	$("#modal_select").modal();
}

function doSelectComplete()
{
	var f = document.frmselect;
	f.submit();

}

function doPriceDetail(idx, estimateIdx, rcEmail)
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.price.modal.php",
        data: {
        	idx:estimateIdx,
        	rc_email:rcEmail
        },
        cache: false,
        success: function(data) {
			$("#frmPrice").html(data);

			$("#modal_price_detail").modal();
        }
    });
}

function doRequest(idx, email){
	if(confirm("문의 하시겠습니까?")){
		var f = document.frmrequest;
		f.idx.value = idx;
		f.email.value = email;
		f.submit();
	}
}
function goMove()
{
	location.href="<?php echo G5_URL; ?>/estimate/my_estimate_list.php";
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

<?php

include_once('./_tail.php');
?>


<style>
    @media(max-width:703px){
            .tab{
                margin-top: 10px;
            }
    }
</style>
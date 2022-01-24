<?php
include_once('./_common.php');
?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<div class="sub_title">
	<h1 class="main_co">견적현황</h1>
</div><!-- sub_title -->

<div class="member com_pd">
	<div class="container">
		
		<div id="board">
			<div class="view">

				<div class="mob">
					<div class="mob_slider">
						<ul id="mob_view_slider">
							<?php
								$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
								$photo = sql_query($sql);
								for ($i=0; $row1=sql_fetch_array($photo); $i++) {
									echo '<li><a href="'.G5_DATA_URL.'/estimate/'.$row1['photo'].'" target="_blank">'.estimate_img_thumbnail($row1['photo'], 350, 350).'</a></li>';
								}
							?>							
						</ul>
						<div class="text" id="mobileEtype"><?php echo get_etype($master['e_type']);?></div>
					</div>

					<div class="mob_info"  id="mobileInfo1">
						<dl>
							<d2 class='col-xs-12'>
								<p>센터사장님!</p>
								<p>충전금이 부족합니다.</p>
								<p>피커스 계좌 : 농협 302-1237-9285-41 천정훈(디휴브)</p>
								<p>충전금 입금 주시면 관리자 확인 후 고객정보가 공개됩니다.</p>
								<p>감사합니다.</p>
							</d2>
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
								<d2 class='col-xs-12'>
									<p>센터사장님!</p>
									<p>충전금이 부족합니다.</p>
									<p>피커스 계좌 : 농협 302-1237-9285-41 천정훈(디휴브)</p>
									<p>충전금 입금 주시면 관리자 확인 후 고객정보가 공개됩니다.</p>
									<p>감사합니다.</p>
								</d2>
							</dl>						
						</td>
					</tr>
				</table>

			</div><!-- view -->

			<div class="btn_wrap">
				<ul class="row">
					<li class="col-xs-3 col-xs-offset-9 col-md-1 col-md-offset-11">
						<a class="main_bg" href="./partner_estimate_list.php?gubun=<?php echo $gubun; ?>&&page=<?php echo $page; ?>">리스트</a>
					</li>
				</ul>
			</div>
			
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
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

	$('#mob_view_slider').bxSlider({
		auto: false,					// 자동 슬라이드 사용여부
		controls: true,				// 양옆컨트롤(prev/next) 사용여부
		speed: 1000,
		preloadImages: 'all',
		pager : false,
		oneToOneTouch : false
	});			
});

function goMove()
{
	location.href="<?php echo G5_URL; ?>/estimate/partner_estimate_list.php";
}

</script>
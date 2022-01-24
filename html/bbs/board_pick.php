<?php
include_once('./_common.php');

include_once('./_head.php');

?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<style type="text/css">
	.mob_back{display: none !important;}
    #fixed_kakao{display: block !important;}
	#bo_gall .gall_text_href{margin-right: 0 !important; padding: 0 10px !important;}
	.pic_lt li a p,
	.lat_title{display: none !important;}
	.pic_lt{border:0; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #1379cd;}
	.pic_lt ul{padding: 0; border:0;}
	.pic_lt li{width: 33.3%;}
	.pic_lt li:nth-child(n+4){display: none;}
	.pic_lt li a{font-size: 16px;color: #1379cd; margin: 10px 0; font-weight: 600;}
	.pic_lt li a:hover{color: #1379cd;}
	.pic_lt li a p{font-size: 13px; margin-top: 10px; color: #333; height: 48px; text-overflow: ellipsis; overflow: hidden;}
	.pic_lt li .lt_img img{max-height: 100%; max-width: 100%; border:1px solid #ededed;}
	.pic_lt li .new_icon{display: none;}
	.pic_lt .lt_date{font-size: 12px; margin-top: 0;}
	.bo_name{font-size: 16px; color: #fff; background-color: #1379cd; width: 200px; padding: 10px 0; text-align: center; border-radius: 20px; margin-bottom: 20px;}
	.pic_cate .bo_name{float: left;}
	.pic_cate .bo_name:nth-of-type(2){background-color: #13ce81;}
	.pic_cate .bo_name:nth-of-type(3){background-color: #fe8e3a;}
	
	.pic_cate .bo_name + .bo_name{margin-left: 20px;}
	.show_more{float: right; font-size: 16px; color: #999;}
	.pic_bottom{padding-bottom: 80px;}
	.p2_tit{display: none;}
	.bd1{border-top: 0;}
	.bo_name{cursor: pointer;}
	.pic_lt li a div{display: none;}
	.pic_lt li a p{display: none;}
	@media (max-width: 768px){
		.bo_name{max-width: 150px;}
		.pic_cate .bo_name{width: 32.5%; font-size: 14px;}
		.pic_cate .bo_name + .bo_name{margin-left: 1%;}
	}
	@media (max-width: 480px){
		.pic_lt ul li{display: none;}
		.pic_lt ul li:first-of-type{display: block; width: 100%;}
	}
</style>
<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">피커스 PICK</span></h1>
			<!-- <p class="tit_desc">내 정보를 확인 및 수정 할 수 있습니다.</p> -->
		</div>
		<div>
			<!-- <p>
				<?php
					$bo_table = 'notice';
					$write_table = "g5_write_{$bo_table}"; 
					$sql = " select * from $write_table";
					$result = sql_query($sql);
					while ($row = sql_fetch_array($result))
					{
					  echo  $row['wr_subject'];
					}
				?>
			</p> -->
			<div class="pic_basic">
				<span class="bo_name">피커스 PICK</span>
				<a href="/bbs/board.php?bo_table=gallery" class="show_more"> 더보기 </a>
				<?php echo latest('pic_basic', 'gallery', 3, 25); ?>
			</div>
			<div class="pic_bottom">
				<div class="pic_cate">
					<span class="bo_name notice">공지사항</span>
					<?php if( ($member['mb_level'] == 2) || ($member['mb_level'] == 10) ) : ?>
					<span class="bo_name notice_partner">업체 공지사항</span>
					<?php endif; ?>
					<!-- <span class="bo_name intro">업체 소개</span> -->
					<span class="bo_name event">이벤트</span>
					<a href="/bbs/board.php?bo_table=notice" class="show_more" id="cate_more"> 더보기 </a>
				</div>
				<div id="notice">
				<?php echo latest('pic_basic_bottom', 'notice', 3, 25); ?>
				</div>
				<div id="intro" style="display: none;">
				<?php echo latest('pic_basic_bottom', 'intro', 3, 25); ?>
				</div>
				<div id="event" style="display: none;">
				<?php echo latest('pic_basic_bottom', 'event', 3, 25); ?>
				</div>
				<div id="notice_partner" style="display: none;">
				<?php echo latest('pic_basic_bottom', 'notice_partner', 3, 25); ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- member -->
<script type="text/javascript">
	$(document).ready(function(){
		$(".notice").click(function(){
			$("#notice").css('display', 'block');
			$("#intro").css('display', 'none');
			$("#event").css('display', 'none');
			$("#notice_partner").css('display', 'none');
			$("#cate_more").attr('href', '/bbs/board.php?bo_table=notice');
		});
		$(".intro").click(function(){
			$("#notice").css('display', 'none');
			$("#intro").css('display', 'block');
			$("#event").css('display', 'none');
			$("#notice_partner").css('display', 'none');
			$("#cate_more").attr('href', '/bbs/board.php?bo_table=intro');
		});
		$(".event").click(function(){
			$("#notice").css('display', 'none');
			$("#intro").css('display', 'none');
			$("#event").css('display', 'block');
			$("#notice_partner").css('display', 'none');
			$("#cate_more").attr('href', '/bbs/board.php?bo_table=event');
		});
		$(".notice_partner").click(function(){
			$("#notice").css('display', 'none');
			$("#intro").css('display', 'none');
			$("#event").css('display', 'none');
			$("#notice_partner").css('display', 'block');
			$("#cate_more").attr('href', '/bbs/board.php?bo_table=notice_partner');
		});
	});
</script>
<?php
include_once('./_tail.php');
?>

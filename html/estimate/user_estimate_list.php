<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$gubun = $_GET['gubun'];

if(!$gubun)
	$gubun = "1";

if($gubun == "1")
{
	$class_on1 = "on";
	$class_on2 = "";
	$class_on3 = "";
}else if($gubun == "2"){
	$class_on1 = "";
	$class_on2 = "on";
	$class_on3 = "";
}else{
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "on";
}

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

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<style type="text/css">
	.row{margin: 0;}
	.req_list{width: 49%; float: left; overflow: hidden; border:2px solid #1379cd; border-radius: 20px; margin-top: 2%; padding: 15px;}
	.req_list + .req_list:nth-of-type(2n){margin-left: 2%;}
	.status_req{width: 80px; text-align: center; border-radius: 20px; background-color: #1379cd; color: #fff; font-size: 14px; padding: 5px 0;}
	.thumb_area{width: 20%; float: left;}
	.info_area{width: 76%; float: left; margin-left: 4%;}
	.end_req{color: #fe8e3a; font-weight: 600; font-size: 14px; margin-bottom: 5px;}
	.ea_req{line-height: 21px; font-size: 16px;}
	.btn_req{text-align: center; overflow: hidden; width: 100%; font-size: 18px; margin-top: 20px;}
	.btn_req a{background-color:#1379cd; color: #fff; text-align: center; max-width: 450px; margin: 0 auto; display: block; padding: 10px;margin-top: 20px; border-radius: 10px;}
	@media(max-width: 768px){
		.req_list{width: 100%; margin-left: 0 !important;} 
	}
</style>
<!-- <div class="sub_title login">
	<h5>내견적현황</h5>
	<h1>피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</h1>
</div> --><!-- sub_title -->
<script type="text/javascript">
	$(".mob_back").hide();
	var gubun = "<?php echo $gubun; ?>";
	function doChangePatiGubun(v_gubun)
	{
		if(v_gubun != gubun)
		{
			location.href = "./partner_estimate_list.php?gubun="+v_gubun;
		}
	}
	function doDetail(idx)
	{
		location.href = "./partner_estimate_form.php?idx="+idx+"&&gubun="+gubun+"&&page=<?php echo $page; ?>";
	}
</script>
<!-- <div class="btm_quick">
	<ul>
		<li ><a href="/" >HOME</a></li>
		<li style="background-color: #1379cd; color: #fff;"><a href="#" style="color: #fff;">신청내역</a></li>
		<li><a href="/bbs/mypage_partner.php">더보기</a></li>
	</ul>
</div> -->
<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">신청 현황</h1>
			<p class="tit_desc">진행 여부와 견적 현황, 총 금액을 체크할 수 있습니다.</p>
		</div>
		<div class="tab">
			<ul class="row">
				<li style="background-color:#1379cd !important; color: #fff;" class="col-md-6 col-xs-6 <?php echo $class_on1; ?>">
					<a href="#" style="color: #fff;">매입/철거</a>
				</li>
				<li class="col-md-6 col-xs-6 <?php echo $class_on1; ?>">
					<a href="#">구매</a>
				</li>
			</ul>
		</div>
		<div class="list_memeber">
			<div class="req_list">
				<div class="status_req">견적중</div>
				<h4 class="title_req">삼성냉장고 (제조사,품목카테고리)</h4>
				<div class="info_req">
					<div class="thumb_area">
						<img src="/img/step3.png">
					</div>
					<div class="info_area">
						<div class="end_req">견적마감일 D-3</div>

						<div class="ea_req">입찰업체 : 5</div>

						<div class="ea_req">견적요청 : 중고매입</div>
					</div>
					<div class="btn_req"><a href="#">견적 확인</a></div>
				</div>
			</div>
			<div class="req_list">
				<div class="status_req">견적중</div>
				<h4 class="title_req">삼성냉장고 (제조사,품목카테고리)</h4>
				<div class="info_req">
					<div class="thumb_area">
						<img src="/img/step3.png">
					</div>
					<div class="info_area">
						<div class="end_req">견적마감일 D-3</div>

						<div class="ea_req">입찰업체 : 5</div>

						<div class="ea_req">견적요청 : 중고매입</div>
					</div>
					<div class="btn_req"><a href="#">견적 확인</a></div>
				</div>
			</div>
			<div class="req_list">
				<div class="status_req">견적중</div>
				<h4 class="title_req">삼성냉장고 (제조사,품목카테고리)</h4>
				<div class="info_req">
					<div class="thumb_area">
						<img src="/img/step3.png">
					</div>
					<div class="info_area">
						<div class="end_req">견적마감일 D-3</div>

						<div class="ea_req">입찰업체 : 5</div>

						<div class="ea_req">견적요청 : 중고매입</div>
					</div>
					<div class="btn_req"><a href="#">견적 확인</a></div>
				</div>
			</div>
		</div>
		<div id="board">
			<?php
				include_once('./user_estimate_list.skin.php');
			?>
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->

<?php

include_once('./_tail.php');
?>
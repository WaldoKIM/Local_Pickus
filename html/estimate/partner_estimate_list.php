<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$gubun = $_GET['gubun'];

if(!$gubun)
	$gubun = "";
	$class_on1 = "on";
if($gubun == "1")
{
	$class_on1 = "on";
	$class_on2 = "";
	$class_on3 = "";
	$class_on4 = "";
	$class_on5 = "";
}else if($gubun == "2"){
	$class_on1 = "";
	$class_on2 = "on";
	$class_on3 = "";
	$class_on4 = "";
	$class_on5 = "";
}else if($gubun == "3"){
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "on";
	$class_on4 = "";
	$class_on5 = "";
}else if($gubun == "4"){
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "";
	$class_on4 = "on";
	$class_on5 = "";
}else if($gubun == "5"){
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "";
	$class_on4 = "";
	$class_on5 = "on";

}else if($gubun == "6"){
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "";
	$class_on4 = "on";
	$class_on5 = "";

	/*$other = "on";*/
}else if($gubun == "7"){
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "";
	$class_on4 = "on";
	$class_on5 = "";

}else{
	$class_on1 = "on";
	$class_on2 = "";
	$class_on3 = "";
	$class_on4 = "";
	$class_on5 = "";
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

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 연결된 리스트에 새 알림이 있는지 표기 with KJS dance 20220119
$sql_noti_choice = "select count(*) as cnt from g5_notify where category = 'p3' AND email = '{$member['mb_email']}' AND read_gb = 0";
$fet_noti_choice = sql_fetch($sql_noti_choice);
$newnotice = $fet_noti_choice['cnt'];

if($newnotice == "0")
{
    $class_off = "off";
}else{
    $class_off = "";
}

$sql_noti_choice_match = "select count(*) as cnt from g5_notify where category = 'p23' AND email = '{$member['mb_email']}' AND read_gb = '0'";
$fet_noti_choice_match = sql_fetch($sql_noti_choice_match);

$newnotice_match = $fet_noti_choice_match['cnt'];

if($newnotice_match == "0")
{
    $class_off_match = "off";
}else{
    $class_off_match = "";
}


$sql_noti_req = "select count(*) as cnt from g5_notify where category = 'p2' AND email = '{$member['mb_email']}' AND read_gb = 0";
$fet_noti_req = sql_fetch($sql_noti_req);

$newnotice_req = $fet_noti_req['cnt'];

if($newnotice_req == "0")
{
    $class_off_req = "off";
}else{
    $class_off_req = "";
}


?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/estimatelist.css" />


	

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
	function doDetail_match(no_estimate)
	{
		location.href = "./partner_estimate_match_form.php?no_estimate="+no_estimate+"&&gubun="+gubun+"&&page=<?php echo $page; ?>";
	}
</script>
<style>
	@media(max-width:1024px){
		#board{
			margin-bottom: 50% !important;
		}
	}
</style>
<!-- <div class="btm_quick">
	<ul>
		<li style="background-color: #1379cd; color: #fff;"><a href="/estimate/partner_estimate_list.php?gubun=1" style="color: #fff;">내견적현황</a></li>
		<li style="background-color: #fff;"><a href="/estimate/estimate_list2.php">견적리스트</a></li>
		<li id="btn_more"><a href="/estimate/partner_estimate_list.php?gubun=2"><img src="/img/show_more.png" title="">진행일정</a></li>
	</ul>
</div> -->
<div class="member com_pd" style="margin-top: 0;">
	<div class="container">
		<div class="sub_title minus10">
		<?php if(!isset($_GET['gubun'])){ ?>
		<h2> 잘못된 접근입니다 </h2>
		<?php return false; } ?>		
		<?php if($_GET['gubun'] == 1){ ?>	
			<h1 class="main_co">참여 견적 리스트</h1>
			<p class="tit_desc">내가 참여한 매입&#47;철거 견적 리스트를 확인하실 수 있습니다.</p>
			<?php }else if($_GET['gubun'] == 2){ ?> 
				<h1 class="main_co">연결 리스트</h1>
			<p class="tit_desc">고객과 연결된 매입&#47;철거 견적 리스트를 확인하실 수 있습니다.</p>
			<?php }else if($_GET['gubun'] == 4){ ?>
				<h1 class="main_co">참여 판매 리스트</h1>
			<p class="tit_desc">내가 참여한 중고물품 바로 판매 견적 리스트를 확인합니다</p>
			<?php }else if($_GET['gubun'] == 5){ ?>
				<h1 class="main_co">연결 리스트</h1>
			<p class="tit_desc">참여 후 고객과 연결된 중고물품 바로 판매 리스트를 확인합니다.</p>
			<?php }else if($_GET['gubun'] == 3 || $_GET['gubun'] == 7){ ?>
				<h1 class="main_co">고객 관리</h1>
			<p class="tit_desc">매입&#47;철거, 바로 판매, 마켓에서 고객들이 남긴 문의와 후기를 확인하실 수 있습니다.</p>
			<?php }else if($_GET['gubun'] == 11){ ?>
				<h1 class="main_co htitle">고객 관리</h1>
			<p class="tit_desc hdesc">매입&#47;철거, 바로 판매, 마켓에서 고객들이 남긴 문의와 후기를 확인하실 수 있습니다.</p>

			<?php }else if($_GET['gubun'] == 8){ ?>
				<h1 class="main_co">배송 내역 관리</h1>
			<p class="tit_desc">고객 결제가 완료된 물품들의 배송 내역을 확인합니다.</p>
			<?php }else{ ?>
				<h1 class="main_co">피커스</h1>
			<p class="tit_desc">피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</p>
			<?php } ?>
			
		</div>
		<div id="board">
			<div class="list_info">
				<div class="tab_area">				
					<div class="tab">
						<ul class="row">													
						<?php if($_GET['gubun'] == 1){ ?>
						<li class="col-lg-3 col-md-2 col-xs-6">								
						<a class="tooltips" href="/estimate/estimate_list2.php">전체 리스트</a>
						<span class="tooltiptexts"><p>모든 매입&#47;철거 견적 리스트를 확인합니다.</p></span>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6">
						<a class="tooltips" href="/estimate/estimate_list1.php">맞춤 추천 리스트</a>
						<span class="tooltiptexts"><p>내가 설정한 조건에 맞는 매입&#47;철거 견적 리스트만 확인합니다.</p></span>
						</li>						
						<li class="col-lg-3 col-md-2 col-xs-6 on main_bg">
						<a class="white tooltips" href="/estimate/partner_estimate_list.php?gubun=1">참여 견적 리스트</a>
						<span class="tooltiptexts"><p>내가 입찰에 참여한 매입&#47;철거 견적 리스트를 확인합니다.</p></span>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6 ">
						<span class="newconnect <?php echo $class_off; ?> z3"><?php echo $fet_noti_choice['cnt'] ?></span>
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=2">연결 리스트</a>						
						<span class="tooltiptexts"><p>입찰 후 고객과 연결된 매입&#47;철거 견적 리스트를 확인합니다.</p></span>						
						</li>
						</ul>
						<br />						
						<?php }else if($_GET['gubun'] == 2){ ?>
						<li class="col-lg-3 col-md-2 col-xs-6">	
						<a class="tooltips" href="/estimate/estimate_list2.php">전체 리스트</a>
						<span class="tooltiptexts"><p>모든 매입&#47;철거 견적 리스트를 확인합니다.</p></span>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6">
						<a class="tooltips" href="/estimate/estimate_list1.php">맞춤 추천 리스트</a>
						<span class="tooltiptexts"><p>내가 설정한 조건에 맞는 매입&#47;철거 견적 리스트만 확인합니다.</p></span>
						</li>	
						<li class="col-lg-3 col-md-2 col-xs-6">	
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=1">참여 견적 리스트</a>
						<span class="tooltiptexts"><p>내가 입찰에 참여한 매입&#47;철거 견적 리스트를 확인합니다.</p></span>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6 on main_bg">
						<span class="newconnect <?php echo $class_off; ?> z3"><?php echo $fet_noti_choice['cnt'] ?></span>
						<a class="white tooltips" href="/estimate/partner_estimate_list.php?gubun=2">연결 리스트</a>						
						<span class="tooltiptexts"><p>입찰 후 고객과 연결된 매입&#47;철거 견적 리스트를 확인합니다.</p></span>						
						</li>
						</ul>
						<br />
						<!-- 판매 매칭 메뉴-->
						<?php }else if($_GET['gubun'] == 4){ ?>
						<li class="col-lg-3 col-md-2 col-xs-6">											
						<a class="tooltips" href="/estimate/estimate_list3.php">전체 리스트</a>
						<span class="tooltiptexts"><p>모든 중고물품 바로 판매 견적 리스트를 확인합니다.</p></span>
						</li>						
						<li class="col-lg-3 col-md-2 col-xs-6 on main_bg">
						<a class="white tooltips" href="/estimate/partner_estimate_list.php?gubun=4">참여 판매 리스트</a>
						<span class="tooltiptexts"><p>내가 참여한 중고물품 바로 판매 견적 리스트를 확인합니다.</p></span>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6 ">
						<span class="newconnect <?php echo $class_off_match;?>"><?php echo $fet_noti_choice_match['cnt']?></span> 
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=5">연결 리스트</a>
						<span class="tooltiptexts"><p>참여 후 고객과 연결된 중고물품 바로 판매 리스트를 확인합니다.</p></span>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6 ">
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=8">배송 내역 관리</a>						
						<span class="tooltiptexts"><p>고객 결제가 완료된 물품들의 배송 내역을 확인합니다.</p></span>						
						</li>
						</ul>
						<br />
						<?php }else if($_GET['gubun'] == 5){ ?>
						<li class="col-lg-3 col-md-2 col-xs-6">											
						<a class="tooltips" href="/estimate/estimate_list3.php">전체 리스트</a>
						<span class="tooltiptexts"><p>모든 중고물품 바로 판매 견적 리스트를 확인합니다.</p></span>
						</li>						
						<li class="col-lg-3 col-md-2 col-xs-6">
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=4">참여 판매 리스트</a>
						<span class="tooltiptexts"><p>내가 참여한 중고물품 바로 판매 견적 리스트를 확인합니다.</p></span>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6 on main_bg">
						<span class="newconnect <?php echo $class_off_match;?>"><?php echo $fet_noti_choice_match['cnt']?></span> 
						<a class="white tooltips" href="/estimate/partner_estimate_list.php?gubun=5">연결 리스트</a>
						<span class="tooltiptexts"><p>참여 후 고객과 연결된 중고물품 바로 판매 리스트를 확인합니다.</p></span>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6 ">
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=8">배송 내역 관리</a>						
						<span class="tooltiptexts"><p>고객 결제가 완료된 물품들의 배송 내역을 확인합니다.</p></span>						
						</li>
						</ul>						
						<?php }else if($_GET['gubun'] == 8){ ?>
						<li class="col-lg-3 col-md-2 col-xs-6">
						<a class="tooltips" href="/estimate/estimate_list3.php">전체 리스트</a>
						<span class="tooltiptexts"><p>모든 중고물품 바로 판매 견적 리스트를 확인합니다.</p></span>
						</li>						
						<li class="col-lg-3 col-md-2 col-xs-6">
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=4">참여 판매 리스트</a>
						<span class="tooltiptexts"><p>내가 참여한 중고물품 바로 판매 견적 리스트를 확인합니다.</p></span>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6 ">
						<span class="newconnect <?php echo $class_off_match;?>"><?php echo $fet_noti_choice_match['cnt']?></span> 
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=5">연결 리스트</a>
						<span class="tooltiptexts"><p>참여 후 고객과 연결된 중고물품 바로 판매 리스트를 확인합니다.</p></span>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6 on main_bg">
						<a class="white tooltips" href="/estimate/partner_estimate_list.php?gubun=8">배송 내역 관리</a>						
						<span class="tooltiptexts"><p>고객 결제가 완료된 물품들의 배송 내역을 확인합니다.</p></span>						
						</li>
						</ul>
						<br/>
						<!-- 문의 및 후기 관리 메뉴 -->
						<br /><?php }else if($_GET['gubun'] == 3){ ?>
						<li class="col-lg-2 col-md-2 col-xs-2 selc" id="selc">	
						<form action="" class="cmform">						
							<input type="radio" name="customer_manage"  id="customer_manage" class="cmanage" onclick="offsrcform()" style="display:none;">
					    	<label for='customer_manage' class="cmanage" style="display:none;">고객 문의 보기 ▼</label>
							<input type="radio" name="customer_manage"  id="review_manage" class="rmanage" checked="checked" onclick="onsrcform()">
					    	<label for='review_manage' class="rmanage">고객 후기 보기 ▼</label>    								
						</form>	
						</li>						
						<li class="col-lg-2 col-md-2 col-xs-4 on main_bg noty mbtn1">
						<span class="newconnect <?php echo $class_off_req;?>"><?php echo $fet_noti_req['cnt'];?></span> 	
						<a class="tooltips white" href="/estimate/partner_estimate_list.php?gubun=3">매입&#47;철거</a>
						<span class="tooltiptexts"><p>매입&#47;철거에 관련된 문의 또는 후기를 확인합니다.</p></span>
						</li>
						<li class="col-lg-2 col-md-2 col-xs-4 mbtn2">
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=7">바로 판매</a>
						<span class="tooltiptexts"><p>매입&#47;철거에 관련된 문의 또는 후기를 확인합니다.</p></span>
						</li>
						<li class="col-lg-2 col-md-2 col-xs-4 mbtn3">
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=11">마켓</a>
						<span class="tooltiptexts"><p>매입&#47;철거에 관련된 문의 또는 후기를 확인합니다.</p></span>						
						</li>
						</ul>
						<br />
						<br /><?php }else if($_GET['gubun'] == 7){ ?>
						<li class="col-lg-2 col-md-2 col-xs-2 selc">	
						<form action="" class="cmform">						
							<input type="radio" name="customer_manage"  id="customer_manage" class="cmanage" onclick="offsrcform()" style="display:none;">
					    	<label for='customer_manage' class="cmanage" style="display:none;">고객 문의 보기 ▼</label>
							<input type="radio" name="customer_manage"  id="review_manage" class="rmanage" checked="checked" onclick="onsrcform()">
					    	<label for='review_manage' class="rmanage">고객 후기 보기 ▼</label>    								
						</form>										
						</li>						
						<li class="col-lg-2 col-md-2 col-xs-4 mbtn1">
						<span class="newconnect <?php echo $class_off_req;?>"><?php echo $fet_noti_req['cnt'];?></span> 
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=3">매입&#47;철거</a>
						<span class="tooltiptexts"><p>매입&#47;철거에 관련된 문의 또는 후기를 확인합니다.</p></span>
						</li>
						<li class="col-lg-2 col-md-2 col-xs-4 on main_bg mbtn2">
						<a class="tooltips white" href="/estimate/partner_estimate_list.php?gubun=7">바로 판매</a>
						<span class="tooltiptexts"><p>매입&#47;철거에 관련된 문의 또는 후기를 확인합니다.</p></span>
						</li>
						<li class="col-lg-2 col-md-2 col-xs-4 mbtn3">
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=11">마켓</a>
						<span class="tooltiptexts"><p>매입&#47;철거에 관련된 문의 또는 후기를 확인합니다.</p></span>						
						</li>
						</ul>
						<br />
						<br /><?php }else if($_GET['gubun'] == 11){ ?>
						<li class="col-lg- col-md-2 col-xs-2 selc">	
						<form action="" class="cmform">						
							<input type="radio" name="customer_manage"  id="customer_manage" class="cmanage" onclick="offsrcform()" style="display:none;">
					    	<label for='customer_manage' class="cmanage hlabel" style="display:none;">고객 문의 보기 ▼</label>
							<input type="radio" name="customer_manage"  id="review_manage" class="rmanage" checked="checked" onclick="onsrcform()">
					    	<label for='review_manage' class="rmanage hlabel">고객 후기 보기 ▼</label>    								
						</form>	
						
						
						</li>						
						<li class="col-lg-2 col-md-2 col-xs-4 mbtn1">
						<span class="newconnect <?php echo $class_off_req;?>"><?php echo $fet_noti_req['cnt'];?></span>
						<a class="tooltips ha" href="/estimate/partner_estimate_list.php?gubun=3">매입&#47;철거</a>
						<span class="tooltiptexts"><p>매입&#47;철거에 관련된 문의 또는 후기를 확인합니다.</p></span>
						</li>
						<li class="col-lg-2 col-md-2 col-xs-4 mbtn2">
						<a class="tooltips ha" href="/estimate/partner_estimate_list.php?gubun=7">바로 판매</a>
						<span class="tooltiptexts"><p>매입&#47;철거에 관련된 문의 또는 후기를 확인합니다.</p></span>
						</li>
						<li class="col-lg-2 col-md-2 col-xs-4 on main_bg mbtn3">
						<a class="tooltips white" href="/estimate/partner_estimate_list.php?gubun=11">마켓</a>
						<span class="tooltiptexts"><p>매입&#47;철거에 관련된 문의 또는 후기를 확인합니다.</p></span>						
						</li>
						</ul>
						<br />
						<?php }else{ ?>
						<li class="col-lg-3 col-md-2 col-xs-6">							
						<a class="tooltips" href="/bbs/content.php?co_id=company">피커스 소개</a>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6">
						<a class="tooltips" href="/bbs/faq.php">피커스 고객센터</a>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6 ">
						<a class="tooltips" href="/market/main/">피커스 마켓</a>
						</li>
						<li class="col-lg-3 col-md-2 col-xs-6">
						<a class="tooltips" href="/">피커스 홈</a>
						</li>
						</ul>
						<br />
						<?php } ?>
						
					</div>
				</div>
				
			</div>
			<!--불필요한 코드 과감히 삭제 KJS 20220120-->
			
			
			<?php
				include_once('./partner_estimate_list.skin'.$gubun.'.php');
			?>
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
<script>

function onsrcform(){		
	$('.src_form').show();
	$('.req_form').hide();
	$('.cmanage').show();
	$('.rmanage').hide();
		}	
function offsrcform(){
	$('.src_form').hide();
	$('.req_form').show();
	$('.cmanage').hide();
	$('.rmanage').show();
		}
</script>

<?php

include_once('./_tail.php');
?>
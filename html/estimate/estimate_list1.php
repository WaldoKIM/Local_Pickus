<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

//사용자의 지역을 조회한다.
$sql = " select * from {$g5['member_area_table'] } where  mb_id = '{$member['mb_id']}' ";
$result_area = sql_query($sql);

$biztype    = $member['mb_biz_type'];
$goodsItem  = $member['mb_biz_goods_item'];
$goodsYear  = $member['mb_biz_goods_year'];
$removeItem = $member['mb_biz_remove_item'];
if($biztype == "1"){
	if(!$goodsItem){
		alert("마이페이지에서 업체가 원하는 견적을 설정해 보세요",G5_BBS_URL."/mypage_partner.php");
	}
}else if($biztype == "2"){
	if(!$removeItem){
		alert("마이페이지에서 업체가 원하는 견적을 설정해 보세요",G5_BBS_URL."/mypage_partner.php");
	}
}else if($biztype == "3"){
	if(!$goodsItem && !$removeItem){
		alert("마이페이지에서 업체가 원하는 견적을 설정해 보세요",G5_BBS_URL."/mypage_partner.php");
	}
}

$sql_common = "";
$sql_area   = "";
for ($i=0; $row=sql_fetch_array($result_area); $i++){
	if($i > 0){
		$sql_area .= " or ";
	}
	$sql_area .= "( area1 = '{$row['mb_area1']}' ";
	if($row['mb_area2']){
		$sql_area .= " and area2 = '{$row['mb_area2']}' ";
	}
	$sql_area .= " ) ";
}

if($sql_area){
	$sql_common .= " and ( ".$sql_area." ) ";
}

if(!$goodsItem){
	$sql_common .= " and e_type != 0 and e_type != 1 ";
}

if(!$removeItem){
	$sql_common .= " and e_type != 2 ";
}
$sql_common .= " and ( 1!=1 ";
//매입확인하기
if($biztype == "1" || $biztype == "3"){
	$array_goodsItem = explode(',',$goodsItem);
	$array_goodsYear = explode(',',$goodsYear);
	//가전/가구 매입
	$sql_common .= " or ( e_type = 0 and ( ";
	$sql_common .= " 1!=1 ";
	for($i=0; $i<count($array_goodsItem); $i++){
		if($array_goodsItem[$i] == "모두수거"){
			$sql_common .= " or ( ifnull(use_year,'0') <= ".$array_goodsYear[$i]." ) ";
		}else{
			$sql_common .= " or ( item_cat='".$array_goodsItem[$i]."' and ifnull(use_year,'0') <= ".$array_goodsYear[$i]." ) ";
		}
	}
	$sql_common .= " )) or ( e_type = 1 and ( sub_key in ( select distinct sub_key from {$g5['estimate_list_multi']} where 1=1 and ( 1=1 ";
	for($i=0; $i<count($array_goodsItem); $i++){
		if($array_goodsItem[$i] == "모두수거"){
			$sql_common .= " or ( ifnull(use_year,'0') <= ".$array_goodsYear[$i]." ) ";
		}else{
			$sql_common .= " or ( item_cat='".$array_goodsItem[$i]."' and ifnull(use_year,'0') <= ".$array_goodsYear[$i]." ) ";
		}
	}
	$sql_common .= " )))) ";
}else if($biztype == "2" || $biztype == "3"){
	$array_removeItem = explode(',',$removeItem);
	$sql_common .= " or ( e_type = 2 and ( sub_key in ( select distinct sub_key from {$g5['estimate_list_multi']} where 1=1 and ( 1=1 ";
	for($i=0; $i<count($array_removeItem); $i++){
		if($array_removeItem[$i] == "모두철거"){
			$sql_common .= " or ( 1=1 ) ";		
		}else{
			$sql_common .= " or ( pull_kind='".$array_removeItem[$i]."' ";
		}

	}
	$sql_common .= " )))) ";
}
$sql_common .= " ) ";

$sql_where  = " where state = '1' and simple_yn != '1' and e_type in ('0','1','2') ";
$sql_where .= " and idx not in ( select estimate_idx from {$g5['estimate_propose']} where rc_email = '{$member['mb_email']}' ) ";
$sql_where .= " and deadline >= DATE_FORMAT(now(), '%Y-%m-%d') ";
$sql_where .= " $sql_common ";

$sql = " select count(*) as cnt from {$g5['estimate_list']} " . $sql_where;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select 
			idx, 
			concat(substr(nickname,1,1),'**') as nickname, 
			case when length(title) <= 20 then title else concat(substr(title,1,10),'...') end as title, 
			area1,
			area2,
			state,
			e_type,
			deadline,
			date_format(writetime, '%Y.%m.%d') as writetime 
		  from {$g5['estimate_list']} ";
$sql .= $sql_where;
$sql .= " order by idx desc ";
$sql .= " limit $from_record, $rows ";



$result = sql_query($sql);

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

?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/estimatelist.css" />

<div class="member com_pd esti_list">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">맞춤 추천 견적 리스트<span></h1>			
			<p class="tit_desc">내 지역 및 취급 품목 설정에 따른<br class="visible-xs"> 맞춤형 매입&#47;철거 견적 리스트 입니다.</p>
		</div>
		<div id="board">
			<div class="tab">
				<ul class="row">
					<li class="col-lg-3 col-md-2 col-xs-6">
						<a class="tooltips" href="/estimate/estimate_list2.php">전체 리스트</a>
						<span class="tooltiptexts"><p>모든 매입&#47;철거 견적 리스트를 확인합니다.</p></span>
					</li>
					<li class="col-lg-3 col-md-2 col-xs-6 on main_bg">
						<a class="white tooltips" href="/estimate/estimate_list1.php">맞춤 추천 리스트</a>
						<span class="tooltiptexts"><p>내가 설정한 조건에 맞는 매입&#47;철거 견적 리스트만 확인합니다.</p></span>
					</li>
					<li class="col-lg-3 col-md-2 col-xs-6 ">
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=1">참여 견적 리스트</a>
						<span class="tooltiptexts"><p>내가 입찰에 참여한 매입&#47;철거 견적 리스트를 확인합니다.</p></span>
					</li>
					<li class="col-lg-3 col-md-2 col-xs-6 ">
						<span class="newconnect <?php echo $class_off; ?>"><?php echo $fet_noti_choice['cnt'] ?></span>
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=2">연결 리스트</a>						
						<span class="tooltiptexts"><p>입찰 후 고객과 연결된 매입&#47;철거 견적 리스트를 확인합니다.</p></span>						
					</li>
				</ul>
				<br />
			</div>

			<div id="board">
				<div class="member">
					<?php
	    				for ($i=0; $row=sql_fetch_array($result); $i++)
	    				{
	    					$state = $row['state'];
	    					$e_type1 = $row['e_type'];
	    					$img_path = estimate_img($row['idx']);
	    				?>
	    					<div class='req_list'>
	    						<a href='javascript:doDetailEstimate(<?php echo $row['idx'] ?>);'>
		    					<div class='status_req'>
			    					<div class='sub_tt white'><?php echo get_estimate_state($state); ?></div>
			    				</div>
		    					<h4 class="subject title_req"><?php echo $row['title'] ?></h4>
		    					<div class="thumb_area">
			    					<?php echo estimate_img_thumbnail($img_path, 350, 350); ?>
			    				</div>
		    					<div class='info_area'>
		    					<!-- <div class="end_req">견적마감일 : <?php 
								if(intval(strtotime($row['deadline'])-strtotime(date("Y-m-d"))) == 0){
									echo $row['deadline'];
								}else{
									echo 'D-' . intval(strtotime($row['deadline'])-strtotime(date("Y-m-d"))) / 86400;
								} ?></div> -->
								<div class="end_req">견적마감일 : <?php if (intval(strtotime($row['deadline']) - strtotime(date("Y-m-d"))) < 1) {
																		echo '오늘';
																	} else if (intval(strtotime($row['deadline']) - strtotime(date("Y-m-d"))) < 0) {
																		echo '선택중';
																	} else {
																		echo 'D-' . floor(intval(strtotime($row['deadline']) - strtotime(date("Y-m-d"))) / 86400);
																	} ?></div>
		    					<div class='info_req'>
		    						<div class="ea_req">지역 : <?php echo $row['area1'] . ' '. $row['area2'] ?></div>
		    						<div class="ea_req">분류 : <?php echo get_etype($e_type1); ?></div>
	    						</div>
	    					</div>
	    						</a>
	    					</div>
	    				<?php }
	    				if($i==0){
	    					echo "<p class='nolistatall'> 조건에 맞는 견적 내역이 없습니다.</p>";
	    				}
					?>
				</div><!-- list -->			

				<div id="page">
					<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?area1=$area1&&area2=$area2&&e_type=$e_type&&item_cat=$item_cat&&page="); ?>
				</div><!-- page -->
			</div>
		</div><!-- board -->		

			<div id="page">
				<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?page="); ?>
			</div><!-- page -->
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
<script type="text/javascript">
$(".mob_back").hide();
function doDetailEstimate(idx)
{
	location.href = "estimate_form.php?idx="+idx;
}	
</script>
<?php

include_once('./_tail.php');
?>
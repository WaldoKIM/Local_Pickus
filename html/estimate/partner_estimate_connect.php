<?php
include_once('./_common.php');


$g5['title'] = '연결 내역';
include_once('./_head.php');

$gubun = $_GET['gubun'];


if(!$gubun)
	$gubun = "2";	

if($gubun == "2")
{
	$class_on1 = "on";
	$class_on2 = "";
	$class_on3 = "";	
}else if($gubun == "5"){
	$class_on1 = "";
	$class_on2 = "on";
	$class_on3 = "";	
}else if($gubun == "9"){
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "on";
}else{
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "";	
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


?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/estimateconnect.css"/>
<script type="text/javascript">
	$(".mob_back").hide();
	var gubun = "<?php echo $gubun; ?>";
	function doChangePatiGubun(v_gubun)
	{
		if(v_gubun != gubun)
		{
			location.href = "./partner_estimate_connect.php?gubun="+v_gubun;
		}
	}	
</script>  
<div class="member com_pd esti_list">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">연결 내역</h1>
			<p class="tit_desc">매입철거&#44;&#160;바로&#160;판매&#44;&#160;마켓&#160;고객과&#160;연결된&#160;내역들을<br class="visible-xs">&#160;확인&#160;하실&#160;수&#160;있습니다. 
			</p>
		</div>
		<div id="board">
			<div class="tab">
				<ul class="row">                
					<li class="col-md-3 col-xs-6 mr4 <?php echo $class_on1; ?>">
                    <span class="newconnect <?php echo $class_off; ?>"><?php echo $fet_noti_choice['cnt']?></span>
						<!-- <a href="/estimate/estimate_list2.php">매입/철거 견적</a>-->
                        <a href="javascript:doChangePatiGubun('2');">매입&#47;철거 고객 연결</a>
					</li>
					<li class="col-md-3 col-xs-6 mr4 <?php echo $class_on2; ?>">
                    <span class="newconnect <?php echo $class_off_match; ?>"><?php echo $fet_noti_choice_match['cnt']?></span>                    
                         <a href="javascript:doChangePatiGubun('5');">바로판매 고객 연결</a>
					</li>
					<li class="col-md-3 col-xs-6 <?php echo $class_on3; ?>">
                    <a href="javascript:doChangePatiGubun('9');">마켓 고객 연결</a>
					</li>
				</ul>
				<br />
			</div>			
			<?php
				include_once('./partner_estimate_list.skin'.$gubun.'.php');
			?>
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->

<?php

include_once('./_tail.php');
?>
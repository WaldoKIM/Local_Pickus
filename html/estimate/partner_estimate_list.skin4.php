<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql_common  = " from ";
$sql_common .= " 	{$g5['estimate_match']} a ";
$sql_common .= " 	join {$g5['estimate_match_propose']} b on a.no_estimate = b.no_estimate and b.rc_email = '{$member['mb_email']}' and b.selected = '0' ";
$sql_common .= " 	left join ( ";
$sql_common .= " 		select no_estimate, count(*) as cnt from {$g5['estimate_match_propose']} group by no_estimate ";
$sql_common .= " 	) c on a.no_estimate = c.no_estimate where a.date_close >= NOW()";
/*$sql_common .= " where ";
$sql_common .= " 	a.state in ('0', '1') ";*/

$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select * ";
$sql .= $sql_common;
$sql .= " order by a.no_estimate desc ";
$sql .= " limit $from_record, $rows ";

$result_list = sql_query($sql);
?>
<style type="text/css">
	.title_req{padding: 10px 0;}
	.partner_li li{border-bottom: 1px solid #ddd; font-size: 20px; padding: 10px 0;}
	.partner_li li a{width: 100%;}
	.partner_li li span{float: right; color: #999;}
	.req_list{width: 49%; float: left; overflow: hidden; box-shadow: 2px 3px 5px #ccc; border-radius: 20px; margin: 2% 0; padding: 15px;}
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
<!-- <div class="tab_area">
	<div class="tab">
		<ul class="row">
			<li id="patiGubun1" class="col-xs-6 on">
				<a href="/estimate/partner_estimate_list.php?gubun=4">참여현황</a>
			</li>
			<li id="patiGubun1" class="col-xs-6 ">
				<a href="/estimate/partner_estimate_list.php?gubun=7">문의현황</a>
			</li>
		</ul>
	</div>
</div> -->
<div class="list esti_list" id="tableList">
	<div class="member">
		<?php 
			for ($i=0; $row_list=sql_fetch_array($result_list); $i++){ ?>
				<div class='req_list list_<?php echo $i ?>'>
					<div class='status_req'>
    					<div class='sub_tt white'><?php echo get_estimate_state_match($state); ?></div>
    				</div>
					<a class="subject" href='javascript:doDetail_match(<?php echo $row_list['no_estimate'] ?>);'> <h4 class='title_req'><?php echo $row_list['title'] ?></h4></a>
						<div class="end_req">견적마감일 : <?php 
						if(intval(strtotime($row_list['date_close'])-strtotime(date("Y-m-d"))) <= 0){
							echo $row_list['date_close'];
						}else{
							echo 'D-' . intval(strtotime($row_list['date_close'])-strtotime(date("Y-m-d"))) / 86400;
						} ?></div>
						<div class="ea_req">지역 : <?php echo $row_list['area1'] . ' '. $row_list['area2'] ?></div>
				</div>
		<?php } ?>
	
	
	<?php 
		if($i == 0){
			echo '<p>견적 내역이 없습니다</p>';
		} ?>
	</div>
	<style type="text/css">
		#board .list{border-top: 0;}
		.form_req{width: 100%; overflow: hidden; padding: 20px 0; border-bottom: 1px solid #ccc;}
		.form_req:first-of-type{padding-top: 0 !important}		
		.form_req .form_now span{font-size: 16px; border-radius: 40px; border:1px solid #ededed; background-color: #1379cd; color: #fff; padding: 7px 10px; text-align: center;} 
		.form_req .tit_req{padding-bottom: 10px;}
		.form_req .tit_req h2{font-size: 24px; background-color: #f4f5f9; padding: 15px;}
		.form_req .detail_info{width: 100%; display: block;}
		.form_req .detail_info p{width: 100%; display: block; overflow: hidden; padding-top: 15px; color:#333; line-height: 20px; font-size: 16px;}
		.form_req .detail_info img{width: 20%; max-width: 120px; max-height: 90px; float: left;}
		.form_req .detail_info .info_table{width: 80%; float: left;}
		.form_req .detail_info .info_table table{width: 100%;}
		.form_req table td{border-bottom: 0 !important; text-align: left !important; color: #333 !important; font-size: 18px !important;} 
		.form_req table td:nth-of-type(2){border-right: 1px solid #ccc;}
		tr:hover{background-color: transparent !important; }
		.tab li{font-size: 18px;}
		td.td_ten{width: 40%;}
		td.td_tw{width: 40%;}
	</style>
</div><!-- list -->

<div id="page">
	<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?gubun=1&&page="); ?>
</div><!-- page -->
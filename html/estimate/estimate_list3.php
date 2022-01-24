<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$sql_where  = " where state = '1'";
//$sql_where .= " where 1=1 ";
$sql_where .= " and no_estimate not in ( select no_estimate from {$g5['estimate_match_propose']} where rc_email = '{$member['mb_email']}' ) ";
$sql_where .= " and date_close  >= DATE_FORMAT(now(), '%Y-%m-%d') ";

if ($area1)
	$sql_where .= " and area1 = '$area1' ";

if ($area2)
	$sql_where .= " and area2 = '$area2' ";

/*if($e_type){
	if($e_type == "1"){
		$sql_where .= " and e_type = '1' ";
		if($item_cat){
			$sql_where .= " and item_cat_dtl = '$item_cat' ";
		}
	}else if($e_type == "2"){
		$sql_where .= " and e_type = '2' ";
		if($item_cat){
			$sql_where .= " and sub_key in ( select distinct sub_key from {$g5['estimate_list_multi']} where pull_kind='$item_cat' ) ";
		}
	}else{
		$sql_where .= " and item_cat = '$e_type' ";
		if($item_cat){
			$sql_where .= " and item_cat_dtl = '$item_cat' ";
		}
	}
}*/

$sql = " select count(*) as cnt from {$g5['estimate_match']} " . $sql_where;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
	$page = 1;
} // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select 
			no_estimate, 
			concat(substr(name,1,1),'**') as nickname, 
			case when length(title) <= 20 then title else concat(substr(title,1,10),'...') end as title, 
			area1,
			area2,
			place,
			state,
			apply_date as writetime,
			date_close,
			jangso,
			cate
		  from {$g5['estimate_match']} ";
$sql .= $sql_where;
$sql .= " order by no desc ";
$sql .= " limit $from_record, $rows ";


$result = sql_query($sql);

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
<link rel="stylesheet" type="text/css" href="/css/board.css" />
<link rel="stylesheet" type="text/css" href="/css/member.css" />
<link rel="stylesheet" type="text/css" href="/css/estimatelist.css" />
<div class="member com_pd esti_list">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">바로 판매 견적 리스트<span></h1>
			<p class="tit_desc">피커스에 등록된 모든 중고물품 바로 판매 견적 리스트를<br class="visible-xs"> 확인 하실 수 있습니다.
			</p>
		</div>
		<div id="board">
			<div class="tab">
				<ul class="row">
					<li class="col-lg-3 col-md-2 col-xs-6 on main_bg">
						<a class="white tooltips" href="/estimate/estimate_list2.php">전체 리스트</a>
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
					<li class="col-lg-3 col-md-2 col-xs-6 ">
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=8">배송 내역 관리</a>						
						<span class="tooltiptexts"><p>고객 결제가 완료된 물품들의 배송 내역을 확인합니다.</p></span>						
					</li>
				</ul>
				<br />
			</div>

			<div class="control_wrap">
				<form name="fregisterform" action="./estimate_list3.php" method="get" autocomplete="off">
					<div id="control">
						<div class="col-md-2 col-xs-3">
							<select id="srchArea1" name="area1">
								<option value="" selected>시도</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-3">
							<select id="srchArea2" name="area2">
								<option value="" selected>군구</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-3">
							<select id="srchEType" name="e_type">
								<option value="" selected>종류</option>
								<option value="가전">가전</option>
								<option value="가구">가구</option>
								<option value="주방집기">주방집기</option>
								<option value="헬스용품">헬스용품</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-3">
							<select id="srchItemCat" name="item_cat">
								<option value="" selected>세부</option>
							</select>
						</div>
						<div class="mob"></div>
						<!-- 
						<div class="col-md-2 col-xs-6">
							<div class="border">
								<input type="text">
							</div>
						</div>
						-->
						<div class="col-md-1 col-xs-3">
							<input class="main_bg" type="submit" value="검색">
						</div>
						<div class="col-md-1 col-xs-3">
							<a class="gray_bg" href="./estimate_list3.php">전체</a>
						</div>
					</div>
				</form>
			</div>

			<div id="board">
				<div class="member">
					<?php
					for ($i = 0; $row = sql_fetch_array($result); $i++) {
						$state = $row['state'];
					?>
						<div class='req_list'>
							<a href='javascript:doDetailEstimate(<?php echo $row['no_estimate'] ?>);'>
								<div class='status_req'>

									<div class='sub_tt white'><?php echo get_estimate_state($state); ?></div>
								</div>
								<h4 class='subject title_req'><?php echo $row['title'] ?></h4>
								<div class="end_req">견적마감일 : <?php
																if (intval(strtotime($row['date_close']) - strtotime(date("Y-m-d"))) == 0) {
																	echo $row['date_close'];
																} else {
																	echo 'D-' . intval(strtotime($row['date_close']) - strtotime(date("Y-m-d"))) / 86400;
																} ?></div>
								<div class='info_req'>
									<div class="ea_req">지역 : <?php echo $row['area1'] . ' ' . $row['area2'] . ' ' . $row['place'] ?></div>
									<!-- <div class="ea_req">장소 : <?php echo $row['jangso']; ?></div> -->
								</div>
							</a>
						</div>
					<?php
					}
					if ($i == 0) {
						echo '<p>견적 내역이 없습니다</p>';
					}
					?>

				</div><!-- list -->

				<div style="margin-bottom:10%;" id="page">
					<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?area1=$area1&&area2=$area2&&e_type=$e_type&&item_cat=$item_cat&&page="); ?>
				</div><!-- page -->
			</div>
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
<script type="text/javascript">
	var v_area1 = "<?php echo $area1; ?>";
	var v_area2 = "<?php echo $area2; ?>";
	var v_e_type = "<?php echo $e_type; ?>";
	var v_item_cat = "<?php echo $item_cat; ?>";

	jQuery(document).ready(function() {
		$(".mob_back").hide();

		$('#srchEType').change(function() {
			doChangeEType();
		})

		doSelectArea1();

		if (v_e_type) {
			$("#srchEType").val(v_e_type);
			v_e_type = "";
			doChangeEType();
		}

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

	function doDetailEstimate(no_estimate) {
		location.href = "estimate_form_match.php?no_estimate=" + no_estimate;
	}

	function doChangeEType() {
		$("#srchItemCat").html("");
		var vEType = $("#srchEType").val();
		if (vEType == "1") {
			$("#srchItemCat").html("<option value='' selected>세부</option>");
		} else if (vEType == "2") {
			var fvHtml = "<option value='' selected>세부</option>";
			var pullKinds = cfnGetRemoveItem();
			for (var i = 0; i < pullKinds.length; i++) {
				fvHtml += "<option value='" + pullKinds[i] + "'>" + pullKinds[i] + "</option>";
			}
			$("#srchItemCat").html(fvHtml);
			if (v_item_cat) {
				$("#srchItemCat").val(v_item_cat);
				v_item_cat = "";
			}
		} else {
			$.ajax({
				type: "POST",
				url: "<?php echo G5_URL ?>/estimate/ajax.category2.php",
				data: {
					"category1": $("#srchEType").val()
				},
				cache: false,
				success: function(data) {
					var fvHtml = "<option value='' selected>세부</option>";
					fvHtml += data;
					$("#srchItemCat").html(fvHtml);
					if (v_item_cat) {
						$("#srchItemCat").val(v_item_cat);
						v_item_cat = "";
					}
				}
			});
		}
	}
</script>
<?php

include_once('./_tail.php');
?>
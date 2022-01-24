<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$sql_where  = " where state = '1' and simple_yn != '1' and e_type in ('0','1','2') ";
//$sql_where .= " where 1=1 ";
$sql_where .= " and idx not in ( select estimate_idx from {$g5['estimate_propose']} where rc_email = '{$member['mb_email']}' ) ";
$sql_where .= " and deadline > now() ";

if($area1)
	$sql_where .= " and area1 = '$area1' ";

if($area2)
	$sql_where .= " and area2 = '$area2' ";

if($e_type){
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
		$sql_where .= " and e_type = '0' ";
		$sql_where .= " and item_cat = '$e_type' ";
		if($item_cat){
			$sql_where .= " and item_cat_dtl = '$item_cat' ";
		}
	}
}

$sql = " select count(*) as cnt from {$g5['estimate_match']} " . $sql_where;
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
			apply_date as writetime 
		  from {$g5['estimate_match']} ";
$sql .= $sql_where;
$sql .= " order by no desc ";
$sql .= " limit $from_record, $rows ";


$result = sql_query($sql);

?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<style type="text/css">
	.partner_li li{border-bottom: 1px solid #ddd; font-size: 20px; padding: 10px 0;}
	.partner_li li a{width: 100%;}
	.partner_li li span{float: right; color: #999;}
	.req_list{width: 49%; float: left; overflow: hidden; border:2px solid #1379cd; border-radius: 20px; margin: 2% 0; padding: 15px;}
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
<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">견적 리스트</h1>
			<p class="tit_desc">피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.
			</p>
		</div>
		<div id="board">
			<div class="tab">
				<ul class="row">
					<li class="col-md-3 col-xs-6">
						<a href="/estimate/estimate_list2.php">견적신청</a>
					</li>
					<li class="col-md-3 col-xs-6 on">
						<a href="/estimate/estimate_list3.php">중고매칭</a>
					</li>
					<li class="col-md-3 col-xs-6 ">
						<a href="/estimate/estimate_list1.php">맞춤견적</a>
					</li>
				</ul>
				<br/>
			</div>
			
			<div class="control_wrap">
				<form id="fregisterform" name="fregisterform" action="./estimate_list2.php" method="get" autocomplete="off">
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
								<option value="1">다량매입</option>
								<option value="2">철거/원상복구</option>								
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
							<a class="gray_bg" href="./estimate_list2.php">전체</a>
						</div>
					</div>
				</form>
			</div>

			<div class="view">

				<table class="re_view">
					<colgroup class="web_col">
						<col style="width: 15%" />
						<col style="width: 85%" />
					</colgroup>
					<tbody id="tableList">
					<?php
	    				for ($i=0; $row=sql_fetch_array($result); $i++)
	    				{
	    					$state = $row['state'];
	    					$e_type1 = $row['e_type'];
	    					$img_path = estimate_img($row['idx']);
	    					
	    					echo "<tr>";
	    					echo "<th>";
                            echo "<a href='javascript:doDetailEstimate(\"".$row['idx']."\");'>".estimate_img_thumbnail($img_path, 350, 350)."</a>";
                            echo "</th>";
	    					echo "<td>";
	    					echo "<a href='javascript:doDetailEstimate(\"".$row['idx']."\");'>";
	    					echo "<div class='sub_tt main_co'>".get_estimate_state($state)." / ".get_etype($e_type1)."</div>";
	    					echo "<div>".$row['title']."</div>";
	    					echo "<div>".$row['area1']." ".$row['area2']."</div>";
	    					echo "<div class='date'>작성자 : ".$row['nickname']." ㅣ 등록일 : ".$row['writetime']."</div>";
	    					echo "</a>";
	    					echo "</td>";
	    					echo "</tr>";
	    				}
	    				if($i==0){
	    					echo '<div class="req_list">
				<div class="status_req">견적중</div>
				<h4 class="title_req">삼성냉장고 (제조사,품목카테고리)</h4>
				<div class="info_req">
					<div class="thumb_area">
						<img src="/img/step1.png">
					</div>
					<div class="info_area">
						<div class="end_req">견적마감일 D-3</div>

						<div class="ea_req">입찰업체 : 5</div>

						<div class="ea_req">견적요청 : 중고매입</div>
					</div>
					<div class="btn_req"><a href="#">자세히</a></div>
				</div>
			</div><div class="req_list">
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
					<div class="btn_req"><a href="#">자세히</a></div>
				</div>
			</div><div class="req_list">
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
					<div class="btn_req"><a href="#">자세히</a></div>
				</div>
			</div><div class="req_list">
				<div class="status_req">견적중</div>
				<h4 class="title_req">삼성냉장고 (제조사,품목카테고리)</h4>
				<div class="info_req">
					<div class="thumb_area">
						<img src="/img/step2.png">
					</div>
					<div class="info_area">
						<div class="end_req">견적마감일 D-3</div>

						<div class="ea_req">입찰업체 : 5</div>

						<div class="ea_req">견적요청 : 중고매입</div>
					</div>
					<div class="btn_req"><a href="#">자세히</a></div>
				</div>
			</div>';	    					/*echo "<tr class='no_data'><td colspan='2'>견적 내역이 없습니다</td></tr>";*/
	    				}
    				?>
					</tbody>
				</table>

			</div><!-- view -->			

			<div id="page">
				<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?area1=$area1&&area2=$area2&&e_type=$e_type&&item_cat=$item_cat&&page="); ?>
			</div><!-- page -->
			
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
<script type="text/javascript">
var v_area1    = "<?php echo $area1; ?>";
var v_area2    = "<?php echo $area2; ?>";
var v_e_type   = "<?php echo $e_type; ?>";
var v_item_cat = "<?php echo $item_cat; ?>";

jQuery(document).ready(function(){
	$(".mob_back").hide();
	
	$('#srchEType').change(function(){ 
		doChangeEType(); 
	})	

	doSelectArea1();

	if(v_e_type){
		$("#srchEType").val(v_e_type);
		v_e_type = "";
		doChangeEType();
	}

});
function doSelectArea1()
{
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

            if(v_area1){
            	$("#srchArea1").val(v_area1);
            	v_area1 = "";
            	doSelectArea2(); 
            }else{
	            fvHtml="<option value=\"\" selected>시/구/군  전체</option>";
				$("#srchArea2").html(fvHtml);
            }
			$('#srchArea1').change(function(){ 
				doSelectArea2(); 
			}); 
        }
    });
}

function doSelectArea2()
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.area2.php",
        data: {
        	"area1": $('#srchArea1').val()
        },
        cache: false,
        success: function(data) {
            var fvHtml="";
			if($("#srchArea1").val())
			{
				fvHtml += "<option value=\"\" selected>"+$("#srchArea1").val()+" 전체</option>";
			}else{
				fvHtml += "<option value=\"\" selected>시/도</option>";
			}
			fvHtml += data;
			$("#srchArea2").html(fvHtml);
			if(v_area2){
				$("#srchArea2").val(v_area2);
				v_area2 = "";
			}

        }
    });
}
function doDetailEstimate(idx)
{
	location.href = "estimate_form.php?idx="+idx;
}	

function doChangeEType()
{
	$("#srchItemCat").html("");
	var vEType = $("#srchEType").val();
	if(vEType == "1")
	{
		$("#srchItemCat").html("<option value='' selected>세부</option>");
	}else if(vEType == "2"){
		var fvHtml = "<option value='' selected>세부</option>";
		var pullKinds = cfnGetRemoveItem();
		for(var i=0; i<pullKinds.length; i++)
		{
			fvHtml += "<option value='"+pullKinds[i]+"'>"+pullKinds[i]+"</option>";
		}		
		$("#srchItemCat").html(fvHtml);
		if(v_item_cat){
			$("#srchItemCat").val(v_item_cat);
			v_item_cat = "";
		}
	}else{
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
				if(v_item_cat){
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
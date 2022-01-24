<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>


<style type="text/css">
	@media(max-width: 768px) {
		.top_list {
			display: none;
		}

		.sub_tt {
			font-size: 10px;
			padding-bottom: 0;
		}
	}

	#board .subject {
		padding: 10px 0;
	}
</style>
<!-- <div class="tab_area">
	<div class="tab">
		<ul class="row">
			<li id="patiGubun1" class="col-xs-6">
				<a href="/estimate/partner_estimate_list.php?gubun1">참여현황</a>
			</li>
			<li id="patiGubun1" class="col-xs-6 on">
				<a href="/estimate/partner_estimate_list.php?gubun=3">문의현황</a>
			</li>
		</ul>
	</div>
</div> -->
<h2 class='req_form hsubtitle'> 마켓 문의 관리 </h2>
<h2 class='src_form hsubtitle' style='display:none'; > 마켓 고객 후기 관리</h2>
<div class="req_form">
	<?php
    include_once('../market/seller/other/qnamin.php');
    ?>
</div>
	
<div style="display:none;" class="src_form">
    <?php
    include_once('../bbs/mypage_review_bottom.php');
    ?>
</div>

<div id="page">
	<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?gubun=3&&area1=$area1&&area2=$area2&&e_type=$e_type&&item_cat=$item_cat&&page="); ?>
</div><!-- page -->
<script type="text/javascript">
	function doDetailEstimate(idx) {
		location.href = "estimate_form.php?idx=" + idx;
	}
</script>
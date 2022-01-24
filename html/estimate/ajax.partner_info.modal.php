<?php
include_once("./_common.php");

$sql = " select * from {$g5['member_table']} where mb_email = '$rc_email'";

$row = sql_fetch($sql);

$sql = " select
	a.*,
	round(avg(a.score),1) as score,
	round(avg(a.score)/5 * 100,0) as rate,
	count(*) as cnt
from
	g5_estimate_match_propose a
	join g5_estimate_match b on a.no_estimate = b.no_estimate
where
	ifnull(a.review,'') !=  ''
	and a.rc_email = '$rc_email'
group by a.rc_email ";

$score_row = sql_fetch($sql);
$score = $score_row['score'];

$sql = " select * from {$g5['member_area_table']} where mb_id = '$rc_email' ";
$member_area = sql_query($sql);

?>
<style type="text/css">
	.modal_info img {
		max-width: 100%;
		height: auto !important;
	}

	.modal_top {
		background-image: none;
		overflow: hidden;
	}

	.modal_info {
		width: 100%;
		max-width: 700px;
	}

	.modal_info .img {
		float: left !important;
		overflow: hidden;
		width: 20% !important;
	}

	.modal_info .img img {
		width: 100%;
		max-width: 120px;
		max-height: 120px;
	}

	.name_part,
	.addr_part,
	.text_star {
		float: left;
		width: 75%;
		overflow: hidden;
		margin-left: 5%;
	}

	.modal_info .img img {
		border-radius: 50%;
		height: 150px;
		width: 150px;
	}

	.tit_intro {
		width: 100%;
		display: block;
		margin-top: 40px;
		margin-bottom: 15px;
		border-left: 2px solid #333;
		padding-left: 10px;
	}

	.cont_partner tr {
		display: block;
		width: 100%;
	}

	.cont_partner th {
		padding: 10px 0;
		width: 100%;
	}

	.cont_partner th,
	.cont_partnertd {
		display: block;
		text-align: center;
	}

	.cont_partner th.main_co {
		background-color: #3a8ddb !important;
		color: #fff !important;
		border-radius: 5px;
		font-size: 18px;
		max-width: 80px;
		margin: 0 auto;
	}

	.cont_partner th {
		margin-bottom: 15px !important;
	}

	.cont_partner td {
		margin-bottom: 30px !important;
		display: block;
		width: 100%;
		text-align: center;
	}

	.xi-star {
		color: #ffc12f;
	}

	.xi-star-o {
		color: #ddd;
	}

	@media(max-width: 768px) {
		.modal_info .img {
			width: 30% !important;
		}

		.name_part,
		.addr_part,
		.text_star {
			width: 65% !important;
		}

		.modal_info .img img {
			width: 90px;
			height: 90px !important;
		}

	}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		var fullStr = $('.cont_partner td span:last-of-type').text();
		var sliceStr = fullStr.slice(0, -2);
		$('.cont_partner td span:last-of-type').text(sliceStr);
	});
</script>

<div class='modal_background' id='modal_background'>
	<div class='modal_info'>
		<a href='#'><img id='close_modal' src='/img/btn_x.png'></a>
		<div class='modal_top'>
			<div class='img'><img src='/data/estimate/<?php echo $row['mb_photo_site'] ?>'></div>
			<table class="cont_partner">
				<h3 class="name_part"><?php
										$row['mb_name'] = preg_replace('/(?<=.{1})./u', '○', $row['mb_name']);
										echo $row['mb_name'];
										?></h3>
				<p class="addr_part main_co" style="text-align: left;">
					<?php
					$row['mb_biz_addr1'] = preg_replace('/(?<=.{8})./u', '○', $row['mb_biz_addr1']);
					echo $row['mb_biz_addr1'];
					?></p>
				<?php
				echo "<div class='text_star'>";
				if ($score > 0 && $score_row['cnt'] > 0) {
					if ($score < 1) {
						echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
					} else if ($score < 2) {
						echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
					} else if ($score < 3) {
						echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
					} else if ($score < 4) {
						echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
					} else if ($score < 5) {
						echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
					} else {
						echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
					}
					echo $score;
				}
				?>

		</div>
		<tr>
			<th class="main_co">활동지역</th>
			<td><?php for ($i = 0; $rows = sql_fetch_array($member_area); $i++) {
					echo $rows['mb_area1'] . ' <span>';
					if ($rows['mb_area2'] == '') {
						echo ' 전체';
					} else {
						echo $rows['mb_area2'];
					}
					echo ' , </span> ';
				} ?>

			</td>
		</tr>
		<tr>
			<th class="main_co">매입내역</th>
			<td><?php echo $row['mb_biz_goods_item']; ?></td>
		</tr>
		<tr>
			<th class="main_co">철거내역</th>
			<td></td>
		</tr>
		<tr>
			<th class="main_co">중고판매</th>
			<td><?php if ($row['mb_match'] == '1') {
					echo "중고전문판매점";
				} else {
					echo "미진행";
				} ?></td>
		</tr>
		</table>
	</div>

	<!-- <p style='background-color: aliceblue;
    margin-bottom: 10px;
    padding: 10px 20px;'> <span style='color:gold;'>★</span><?php if ($score) {
																echo $score;
															} else {
																echo '0';
															}; ?> <span id='stick'>|</span> <span id='where'><img id='location_icon' src='/img/ico_location.png' style="margin-right: 5px;"><?php echo $row['mb_biz_addr1']; ?></span></p> -->
	<!-- <p style="border-bottom : 1px solid #ccc;"><?php if ($row['mb_biz_type'] == '1') {
														echo '재활용센터';
													} else if ($row['mb_biz_type'] == '2') {
														echo '철거업체';
													} else {
														echo '재활용센터, 철거업체';
													} ?></p> -->
	<h3 class="tit_intro">업체한마디</h3>
	<p style="border:1px solid #ccc; padding: 15px;"><?php echo $row['mb_biz_intro']; ?></p>
	<h3 class="tit_intro">업체소개</h3>
	<div style="border:1px solid #ccc;  padding: 15px;">
		<?php echo $row['mb_intro_center']; ?>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var btn_x = document.getElementById("close_modal");
		var modal = document.getElementById("modal_background");

		$("#close_modal").click(function() {
			$('#modal_info').modal("hide");
		});

		window.onclick = function(event) {

			if (event.target == modal) {
				$('#modal_info').modal("hide");
			}
		}
	});
</script>
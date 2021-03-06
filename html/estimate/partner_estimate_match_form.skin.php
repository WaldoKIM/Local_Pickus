<?php
include_once('./_common.php');
?>
<link rel="stylesheet" type="text/css" href="/css/board.css" />
<link rel="stylesheet" type="text/css" href="/css/member.css" />
<link rel="stylesheet" type="text/css" href="/share/css/jquery.bxslider.css" />
<style type="text/css">
	.img_pros {
		width: 25%;
		position: relative;
		float: left;
		margin-right: 1%;
		border: 1px solid #ededed;
	}

	p.tit_modal_match {
		font-size: 20px;
		padding: 10px 0;
		color: #1379cd !important;
		margin-bottom: 10px;
		width: 35%;
		display: inline;
	}

	#del_fee {
		margin-bottom: 15px;
		padding-left: 10px;
		border-radius: 10px;
	}

	.add_line {
		background-color: #707070;
		color: #fff !important;
		padding: 10px;
		margin: 10px 0;
	}

	.delete_item {
		overflow: hidden;
		background-color: #ccc;
		margin-right: 15px;
	}

	.add_pro {
		padding: 5px 0;
	}

	.add_pro input {
		border-radius: 10px;
		padding-left: 10px;
	}

	.requst_list {
		margin-top: 60px;
	}

	#frmcompletedate {
		padding: 10px;
	}

	#frmcompletedate .row {
		margin-bottom: 10px !important;
	}

	#frmcompletedate .row .title {
		font-size: 13px;
	}

	.swiper-imgs {
		position: relative;
		overflow: hidden;
	}

	.estimate_photo {
		border: 0;
		padding: 0 !important;
	}

	.estimate_photo img {
		width: auto;
	}

	.one_line p .tit_modal_match {
		width: 35%;
		display: inline;
		margin-bottom: 0;
	}

	.one_line ul {
		width: 60%;
		float: right;
	}

	.one_line input[type="radio"] {
		display: none;
	}

	form canvas {
		height: 100% !important;
		width: 100% !important;
	}

	#imageList {
		padding-top: 1rem;
	}

	#imageList .estimate_photo .estimate_image_click_bg {
		height: 10.0rem !important;
		width: 10.0rem !important;
	}

	#imageList .estimate_photo {

		margin: 1rem;
		margin-top: 0rem;
		height: 10.0rem !important;
		width: 10.0rem !important;
	}

	#imageList .estimate_photo img {
		height: 10.0rem !important;
		width: 10.0rem !important;
	}

	#imageList .estimate_photo .estimate_image_click_bg p {
		margin-top: -9rem !important;
	}

	#imageList .estimate_photo .estimate_image_del_bg a {

		margin-top: -1rem !important;
		margin-right: -2rem !important;
	}
</style>
<?php
$sql = "update g5_notify set read_gb = 1 where email = '{$member['mb_email']}' AND estimate_idx = '$idx' ";

sql_query($sql);
?>
<div class="layer loader_bg hidden"></div>
<div class="layer loader hidden"></div>
<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">??????????????????</h1>
		</div><!-- sub_title -->
		<div id="board">
			<div class="view">

				<div class="mob">
					<div class="mob_slider">
						<div class="text" id="mobileEtype">????????????</div>
					</div>
					<div class="text-center mob_ing" id="mobileStatus">
						<?php echo get_estimate_mobile_state_tag_match($master['state']); ?>
					</div>


					<div class="mob_info" id="mobileInfo1">
						<?php
						echo "<ul class='row'>";

						echo "<li class='col-xs-6'>";
						echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>???????????????</p> "; ?>
						<p class='text-center'>
							<?php
							if (intval(strtotime($master['date_close']) - strtotime(date("Y-m-d")) / 86400) == 0) {
								echo $master['date_close'];
							} else {
								echo 'D-' . intval(strtotime($master['date_close']) - strtotime(date("Y-m-d"))) / 86400;
							}

							echo "</p>";
							echo "</li>";
							echo "<li class='col-xs-6'>";
							if ($selected != "1") {
								echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>???????????????</p> ";

								echo "<p class='text-center'>" . $master['date_req'] . "</p> ";
							} else {
								if ($master['completetime']) {
									echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>???????????????</p> ";
									echo "<p class='text-center'>" . $master['completetime'] . "</p> ";
								} else {
									echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>???????????????</p> ";
									echo "<p class='text-center'>" . $master['date_req'] . "</p> ";
								}
							}
							echo "</li>";
							echo "</ul>";
							if ($state == "1") {
								echo "<ul class='row'>";
								echo "<li class='col-xs-6'>";
								echo "<a class='line_bg' href='javascript:doCancel();'>?????? ??????</a>";
								echo "</li>";
								echo "<li class='col-xs-6'>";
								echo "<a class='main_bg' href='javascript:doModify();'>?????? ??????</a>";
								echo "</li>";
								echo "</ul>";
							}
							?>
					</div>

					<div class="customer" id="mobileInfo2">
						<h3>????????????</h3>
						<dl>
							<dt class='col-xs-1 main_co'>??????</dt>
							<dd class='col-xs-11'><?php echo $master['title'] ?></dd>
							<!-- <dt class='col-xs-1 main_co'>??????</dt>
							<dd class='col-xs-11'><?php echo $master['jangso'] ?></dd> -->
							<dt class='col-xs-1 main_co'>??????</dt>
							<dd class='col-xs-11'><?php echo number_format($master['price_client']) ?>???</dd>

							<?php
							if ($selected == '1' && $master['pay_confirm'] == '1') {
								echo "<dt class='col-xs-1 main_co'>??????</td>";
								echo "<dd class='col-xs-11'>" . $master['name'] . "</dd>";
								echo "<dt class='col-xs-1 main_co'>?????????</td>";
								echo "<dd class='col-xs-11'>" . $master['number'] . "</dd>";
								echo "<dt class='col-xs-1 main_co'>??????</td>";
								echo "<dd class='col-xs-11'>" . $master['area1'] . " " . $master['area2'] . " " . $master['place'] . "</dd>";
								echo "<dt class='col-xs-1 main_co'>??????</td>";
								echo "<dd class='col-xs-11'>" . $master['elevator_yn'] . " / " . $master['floor'] . "???" . "</dd>";
							} else { ?>
								<dt class='col-xs-1 main_co'>??????</dt>
								<dd class='col-xs-11'><?php echo $master['area1'] . " " . $master['area2'] . " " . $master['place']; ?></dd>
								<dt class='col-xs-1 main_co'>??????</dt>
								<dd class='col-xs-11'><?php echo $master['elevator_yn'] . " / " . $master['floor'] . "???"; ?></dd>
							<?php }
							?>
						</dl>
					</div>
					<div class="warning" id="mobileWaring">
						<?php
						if ($state == "2") {
							echo "<h1 class='text-center main_co'>????????? ?????? ????????? ?????????.</h1>";
						}

						if (($state == "3" || $state == "8") && $selected == "1") {
							if ($req_pay == '1') {
								echo "<h3>????????????</h3>";
								echo "<p>";
								echo "<span class='main_co'>????????? ?????? ??? ?????? ??????</span>?????? ??????????????????.<br/>";
								echo "????????? ???????????? <span class='main_co'>??????</span>?????? ??????????????????.";
								echo "</p>";
								if ($master['completetime']) {
									echo "<a style='width:100%; padding: 5px 0; text-align:center;border-radius: 5px; margin-top:10px;' class='main_bg' href='#none'>???????????????</a>";
								} else {
									echo "<a style='width:100%; padding: 5px 0; text-align:center;border-radius: 5px; margin-top:10px;' class='main_bg' href='javascript:doChangeCompeteDate(\"1\");'>????????????</a>";
								}

								echo "<a class='line_bg2' href='javascript:doCompleteEstimate()'>???????????? ??????</a>";
								echo "<a class='line_bg1' href='#!' onClick='doTel(\"" . $master['number'] . "\")')'>?????? ????????????</a>";
								echo "<a style='width:100%; padding: 5px 0; text-align:center;border-radius: 5px; margin-top:10px; background-color:#ff1616;'  href='javascript:doCancel_del();'>?????? ??????</a>";
							} else {
								echo "<a style='width:100%; padding: 5px 0; text-align:center;border-radius: 5px; margin-top:10px; background-color:#ff1616;'  href='javascript:doCancel_del();'>?????? ??????</a>";
								echo "<a style='width:100%; border:1px solid #ededed; padding: 5px 0; text-align:center;border-radius: 5px; margin-top:10px;'  href='javascript:req_pay();'>????????????</a>";

								echo '<p style="margin-top: 20px;">????????? ????????? ????????? ?????????<br/>
							 				??????????????? ??????????????? ????????????.</p>';
							}
						}
						?>

					</div>
				</div>

				<table class="web">
					<tr>
						<td class="info" id="mainTitle">
							<h1><?php echo $master['title']; ?></h1>
							<?php
							echo "<dl>";
							// echo "<dt class='col-xs-3'>??????</dt><dd class='col-xs-9'>".$master['jangso']."</dd>";
							if ($master['pay_confirm'] == '1' && $selected == "1") {
								echo "<dt class='col-xs-3'>??????</dt><dd class='col-xs-9'>" . $master['name'] . "</dd>";
								echo "<dt class='col-xs-3'>??????</dt><dd class='col-xs-9'>" . $master['area1'] . " " . $master['area2'] . " " . $master['place'] . "</dd>";
								echo "<dt class='col-xs-3'>??????</dt><dd class='col-xs-9'>" . $master['elevator_yn'] . " / " . $master['floor'] . "???" . "</dd>";
								echo "<dt class='col-xs-3'>?????????</dt><dd class='col-xs-9'>" . $master['number'] . "</dd>";
							} else {
								echo "<dt class='col-xs-3'>??????</dt><dd class='col-xs-9'>" . $master['area1'] . " " . $master['area2'] . " " . $master['place'] . "</dd>";
								echo "<dt class='col-xs-3'>??????</dt><dd class='col-xs-9'>" . $master['elevator_yn'] . " / " . $master['floor'] . "???" . "</dd>";
							}
							echo "<dt class='col-xs-3'>??????</dt><dd class='col-xs-9'>" . number_format($master['price_client']) . "???</dd>";
							echo "<dt class='col-xs-3'>???????????????</dt><dd class='col-xs-9'>";
							if (intval(strtotime($master['date_close']) - strtotime(date("Y-m-d"))) == 0) {
								echo $master['date_close'];
							} else {
								echo 'D-' . intval(strtotime($master['date_close']) - strtotime(date("Y-m-d"))) / 86400;
							}
							echo "</dd>";
							if ($master['completetime']) {
								echo "<dt class='col-xs-3'>???????????????</dt><dd class='col-xs-9'>" . $master['completetime'] . "</dd>";
							} else {
								echo "<dt class='col-xs-3'>???????????????</dt><dd class='col-xs-9'>" . $master['date_req'] . "</dd>";
							}

							if ($state == "1") {
								echo "<ul class='row'>";
								echo "<li class='col-xs-6'>";
								echo "<a class='line_bg' href='javascript:doCancel();'>?????? ??????</a>";
								echo "</li>";
								echo "<li class='col-xs-6'>";
								echo "<a class='main_bg' href='javascript:doModify();'>?????? ??????</a>";
								echo "</li>";
								echo "</ul>";
							}
							if (($state == "3" || $state == "8") && $selected == "1") {

								echo "<dt class='col-xs-3'>??????????????????</dt><dd class='col-xs-9'>" . number_format($propose_detail['amt0'] + $propose_detail['amt1'] + $propose_detail['amt2'] + $propose_detail['amt3'] + $propose_detail['amt4'] + $propose_detail['amt5'] + $propose_detail['amt6'] + $propose_detail['amt7'] + $propose_detail['amt8'] + $propose_detail['amt9'] + $propose_detail['amt10'] + $master['shipping']);
								"???</dd>";
							} else if ($state == "5" && $selected == "1") { ?>
								<dt class='col-xs-3'>????????????</dt>
								<dd class='col-xs-9'><?php echo number_format($propose_detail['amt0'] + $propose_detail['amt1'] + $propose_detail['amt2'] + $propose_detail['amt3'] + $propose_detail['amt4'] + $propose_detail['amt5'] + $propose_detail['amt6'] + $propose_detail['amt7'] + $propose_detail['amt8'] + $propose_detail['amt9'] + $propose_detail['amt10'] + $master['shipping']); ?>???</dd>
							<?php
							}
							echo "</dl>";
							?>

						</td>
					</tr>
				</table>
				<div class="web">
					<div class="warning" id="divWaring">
						<?php
						if ($state == "2") {
							echo "<h1 class='text-center main_co'>????????? ?????? ????????? ?????????.</h1>";
						}

						if (($state == "3" || $state == "8") && $selected == "1") {
							if ($req_pay == '1') {
								echo "<h3>????????????</h3>";
								echo "<p>";
								echo "<span class='main_co'>????????? ?????? ??? ?????? ??????</span>?????? ??????????????????.<br/>";
								echo "????????? ???????????? <span class='main_co'>??????</span>?????? ??????????????????.";
								echo "</p>";
								if ($master['completetime']) {

									echo "<a class='main_bg' href='#none'>???????????????</a>";
								} else {
									echo "<a class='main_bg' href='javascript:doChangeCompeteDate(\"1\");'>????????????</a>";
								}
								echo "<a class='line_bg' href='javascript:doCompleteEstimate()'>???????????? ??????</a>";
								echo "<a style='background-color:#ff1616; color:#fff !important;' href='javascript:doCancel_del();'>?????? ??????</a>";
							} else {
								echo "<a style='background-color:#ff1616; color:#fff !important;'  href='javascript:doCancel_del();'>?????? ??????</a>";
								echo "<a class='line_bg' href='javascript:req_pay()'>????????????</a>";
								echo '<p style="margin-top: 20px;">  ????????? ????????? ????????? ?????????<br/>
								??????????????? ??????????????? ????????????.
								</p>';
							}
						}
						?>

					</div>
				</div>
				<h1 class="tt">??????????????????</h1>
				<p> <?php echo $master['etc_req']; ?> </p>
				<h1 class="tt">??????????????????</h1>

				<table style="margin-top: 0; padding-top: 0;" class="requst_list" id="subDetail">
					<tr>
						<th>????????????</th>
						<th>??????</th>
						<th>??????</th>
					</tr>
					<?php

					for ($i = 0; $row = sql_fetch_array($info); $i++) {
						echo "<tr>";
						echo "<td style='text-align:center'>" . $row['cate'] . "</td>";
						echo "<td style='text-align:center'>" . $row['cate_name'] . $row['item_cat_dtl_s'] . "</td>";
						echo "<td style='text-align:center'>" . $row['qty'] . "</td>";
						echo "</tr>";
					}
					?>
				</table>

				<h1 class="tt">??? ????????????</h1>
				<div class="list requst_list02" id="tableList">
					<table class="info_basic" style="margin-bottom: 20px;">

						<tr>
							<th>?????????</th>
							<td><?php echo number_format($master['shipping']) . '???'; ?></td>
							<th>AS ??????/??????</th>
							<td><?php
								if ($master['pro_as'] == '1') {
									echo '??????</td><td>' . $master['month_as'] . '??????</td>';
								} else {
									echo "?????????</td>";
								} ?>

						</tr>
					</table>
					<table>

						<tr>
							<th>?????????</th>
							<th>??????</th>
						</tr>
						<tr>
							<td><?php echo $propose_detail['item0']; ?></td>
							<td><?php echo number_format($propose_detail['amt0']); ?>???</td>
						</tr>
						<?php
						if ($propose_detail['item1']) {
							echo '<tr><td>' . $propose_detail['item1'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt1']) . '???</td></tr>';
						}
						?>
						<?php
						if ($propose_detail['item2']) {
							echo '<tr><td>' . $propose_detail['item2'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt2']) . '???</td></tr>';
						}
						?>
						<?php
						if ($propose_detail['item3']) {
							echo '<tr><td>' . $propose_detail['item3'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt3']) . '???</td></tr>';
						}
						?>
						<?php
						if ($propose_detail['item4']) {
							echo '<tr><td>' . $propose_detail['item4'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt4']) . '???</td></tr>';
						}
						?>
						<?php
						if ($propose_detail['item5']) {
							echo '<tr><td>' . $propose_detail['item5'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt5']) . '???</td></tr>';
						}
						?>
						<?php
						if ($propose_detail['item6']) {
							echo '<tr><td>' . $propose_detail['item6'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt6']) . '???</td></tr>';
						}
						?>
						<?php
						if ($propose_detail['item7']) {
							echo '<tr><td>' . $propose_detail['item7'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt7']) . '???</td></tr>';
						}
						?>
						<?php
						if ($propose_detail['item8']) {
							echo '<tr><td>' . $propose_detail['item8'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt8']) . '???</td></tr>';
						}
						?>
						<?php
						if ($propose_detail['item9']) {
							echo '<tr><td>' . $propose_detail['item9'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt9']) . '???</td></tr>';
						}
						?>
						<?php
						if ($propose_detail['item10']) {
							echo '<tr><td>' . $propose_detail['item10'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt10']) . '???</td></tr>';
						}
						?>
					</table>
					<div class="swiper-imgs">
						<div class="swiper-wrapper img_lists">
							<div class="mob">
								<ul id="view_slider">
									<?php
									$no_estimate = $master['no_estimate'];
									$sql = " select * from g5_estimate_list_photo_match where no_estimate=$no_estimate and rc_email='{$member['mb_email']}' ";
									$photo = sql_query($sql);
									for ($i = 0; $row_photos = sql_fetch_array($photo); $i++) {
										echo '<div class="swiper-slide estimate_photo estimate_image_bg col-md-4 text-center"><a href="/data/estimate/' . $row_photos['photo'] . '"><img src="/data/estimate/' . $row_photos['photo'] . '"></a></div>';
									}
									?>
								</ul>
							</div>
							<div class="web">
								<div class="pager_wrap">
									<ul id="bx-pager">
										<?php
										$no_estimate = $master['no_estimate'];
										$sql = " select * from g5_estimate_list_photo_match where no_estimate=$no_estimate and rc_email='{$member['mb_email']}' ";
										$photo = sql_query($sql);
										for ($i = 0; $row_photos = sql_fetch_array($photo); $i++) {
											echo '<div class="swiper-slide estimate_photo estimate_image_bg col-md-4 text-center"><a href="/data/estimate/' . $row_photos['photo'] . '">
										<img src="/data/estimate/' . $row_photos['photo'] . '"></a></div>';
										}
										?>
									</ul>
								</div>
							</div>
						</div>
						<!-- Add Arrows -->
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
					<table style="margin-top: 20px;">
						<th>?????????</th>
						<td>
							<?php echo number_format($propose_detail['amt0'] + $propose_detail['amt1'] + $propose_detail['amt2'] + $propose_detail['amt3'] + $propose_detail['amt4'] + $propose_detail['amt5'] + $propose_detail['amt6'] + $propose_detail['amt7'] + $propose_detail['amt8'] + $propose_detail['amt9'] + $propose_detail['amt10'] + $master['shipping']); ?>???
						</td>
					</table>
				</div>
				<?php


				$sql = " select * from g5_estimate_match_propose where no_estimate = '{$master['no_estimate']}' and ifnull(content,'') != '' and rc_email = '{$member['mb_email']}' ";
				//echo $sql;
				$request_row = sql_fetch($sql);
				if ($request_row) {
					echo '<div class="text_note">';
					echo '<h1 style="margin-top:35px;">?????? ?????? ????????????</h1>';
					echo '<p>' . $request_row['rc_nickname'] . ' - ' . $request_row['content'] . '</p>';
					echo '</div>';
				}

				?>
				<div id="divRreview">
					<?php
					if ($propose_review) {
						/*$sql1 = " select * from {$g5['estimate_list_photo']} where no_estimate = '$no_estimate' order by no_estimate limit 1 ";
						$photo = sql_fetch($sql1);*/
						$score = $propose_review['score'];
						echo "<h1 class='tt'>????????????</h1>";
						echo "<table class='re_view'>";
						echo "<colgroup class='web_col'>";
						/*echo "<col style='width: 15%' />";*/
						echo "<col style='width: 85%' />";
						echo "</colgroup>";
						echo "<tr>";
						/*if($propose_review['photo1']){
							echo "<th>".estimate_img_thumbnail($propose_review['photo1'], 100, 100)."</th>";
						}else{
								echo "<th>".estimate_img_thumbnail($photo['photo'], 100, 100)."</th>";
						}*/
						echo "<td>";
						echo "<div class='sub_tt'>" . get_etype($propose_review['e_type']) . " / " . $propose_review['title'] . "</div>";
						echo "<div class='con'>" . $propose_review['review'] . "</div>";
						echo "<div class='icon'>";
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
						echo "</div>";
						echo "<div class='date'>????????? : " . $propose_review['nickname'] . " ??? ????????? : " . $propose_review['updatetime'] . "</div>";
						echo "</td>";
						echo "</tr>";
						echo "</table>";
					}
					?>
				</div>

			</div><!-- view -->

			<div class="btn_wrap">
				<ul class="row">
					<li class="col-xs-3 col-xs-offset-9 col-md-1 col-md-offset-11">
						<a class="main_bg" href="./partner_estimate_list.php?gubun=<?php echo $gubun; ?>&&page=<?php echo $page; ?>">?????????</a>
					</li>
				</ul>
			</div>

		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
<form name="frmpay" style="display: none" action="<?php echo G5_URL; ?>/estimate/partner_estimate_req.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="no_estimate" value="<?php echo $no_estimate; ?>">
</form>
<div style="z-index: 99999999;" class="modal fade modal_table" id="modal_price" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div style="border-bottom:none; margin:0; padding:0; padding-top:10px;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="color:#1379cd; font-weight:800; text-align:center;" class="modal-title">???????????????</h4>
				<hr style="border:1px solid #1379cd;">
			</div>
			<div class="modal-body" style="padding-top:0;">
				<form name="frmprice" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_price_update_match.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="no_estimate" value="<?php echo $no_estimate; ?>">
					<input type="hidden" name="rc_email" value="<?php echo $member['mb_email']; ?>">
					<div class="form-group" style="border-bottom:none;margin-bottom:5px; padding-bottom:0;">

						<div style="border-bottom:none;" class="row" id="imageList">
							<?php
							$sql = " select * from g5_estimate_list_photo_match where no_estimate='$no_estimate' AND rc_email = '{$member['mb_email']}'";
							$photo = sql_query($sql);

							for ($i = 0; $row_photos = sql_fetch_array($photo); $i++) {
								//echo	var_dump($row_photos);
								if ($row_photos['photo'] != null) {
									echo '<div class="estimate_photo col-md-4 text-center"><input type="file" name="photo[]" accept="image/*" style="height: 165;" class="estimate_photo_file"><div class="estimate_image_del_bg"><a href="javascript:" class="estimate_photo_file_remove"><i class="xi-close-min"></i></a></div><img id="phn_' . $i . '" src="/data/estimate/' . $row_photos['photo'] . '" width="150" height="126"></div>';
								}
							}
							?>
						</div>
					</div>

					<div class="form-group" style="padding-bottom:0rem; border:none;">
						<!-- <div class="row">
							<span class="tit_modal_match">????????????(?????? ????????? ??????)</span>
							<button type="button" class="btn btn-secondary" id="btn_article">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"></path>
								</svg>
							</button>
						</div> -->
						<!--
						<p class="tit_modal_match">????????????</p>
						-->
						<div class="row" id="multiList">
							<div style="display:flex; justify-content: space-evenly;">
								<?php
								$sql = " select * from g5_estimate_match_propose_detail where no_estimate='$no_estimate'";
								$items = sql_fetch($sql);

								for ($i = 0; $i < 11; $i++) {

									$amt_num = 'amt' . $i;
									$item_num = 'item' . $i;


									$amt = $items[$amt_num];
									$item = $items[$item_num];

									if ($amt != 0) {
										echo '<div style="display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-items: center;"class="form_new add_pro">
									<div style="width:40%;" class="add_name col-xs-5"><input placeholder="?????????" type="text" name="pro_name[]" value="' . $item . '"></div>
									<div style="width:40%; display:flex; align-items:center;" class="add_qty col-xs-5"><input  placeholder="??????" type="number" name="pro_price[]" value="' . $amt . '"><p>???</p></div>
									<a style="width:20%; margin:0; line-height:36px;" class="form_btn delete_item" href="javascript:" >??????</a>
									
								</div>';
									}
								};

								?>
								<a class="add_line" id="add_goods" style="width:20%;background:#1379cd; text-align:center; border-radius: 5px;white-space: nowrap;" href="#">+ ??????</a>
							</div>
						</div>

					</div>
					<hr style="border:1px solid #1379cd;">
					<div class="form-group one_line" id="delivery" style="padding-bottom: 0rem; border:none;">
						<p style="font-weight:500; font-size:18px;" class="tit_modal_match">?????????</p>
						<ul class="row" style="margin-top:-1rem;">
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
									<input type="radio" id="shipping_on" name="shipping_check" value="1"><i>
										<p>??????</p>
									</i></label>
							</li>
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
									<input type="radio" id="shipping_off" name="shipping_check" value="2"><i>
										<p>??????</p>
									</i></label>
							</li>
						</ul>
						<div class="row">
							<li class="col-xs-12">
								<?php
								$sql = " select * from g5_estimate_match_propose where no_estimate='$no_estimate'";
								$propose = sql_fetch($sql);
								?>
								<input style="display: none;" type="number" placeholder="????????? ??????????????????" value="<?php echo $propose['shipping'] ?>" name="shipping_pro" id="del_fee">
							</li>
						</div>
					</div>


					<div class="form-group one_line" id="guarantee" style="border:0 !important; margin-bottom:0rem">
						<p style="font-weight:500; font-size:18px;" class="tit_modal_match">AS ??????/??????</p>
						<ul class="row" style="margin-top:-1rem;">
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
									<input type="radio" id="as_on" name="as_pro" value="1"><i>
										<p>??????</p>
									</i></label>
							</li>
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
									<input type="radio" id="as_off" name="as_pro" value="2"><i>
										<p>?????????</p>
									</i></label>
							</li>
						</ul>
					</div>
					<div class="form-group" style="border:0 !important; margin-bottom: 0;">
						<input type="hidden" id="as_pro_num" value="<?php echo $propose['pro_as']; ?>">
						<input type="hidden" id="month_as_num" value="<?php echo $propose['month_as']; ?>">
						<select name="month_as" id="month_as">
							<option value="1">1??????</option>
							<option value="2">2??????</option>
							<option value="3">3??????</option>
							<option value="4">4??????</option>
							<option value="5">5??????</option>
							<option value="6">6??????</option>
							<option value="7">7??????</option>
							<option value="8">8??????</option>
							<option value="9">9??????</option>
							<option value="10">10??????</option>
							<option value="11">11??????</option>
							<option value="12">12??????</option>
						</select>
					</div>
					<hr style="border:1px solid #1379cd;">
					<div class="form-group" style="border:0 !important; margin-bottom:5px; padding-bottom:0;">
						<p style="margin-bottom:0; font-weight: 700;" class="tit_modal_match">????????????</p>
						<textarea name="match_desc" style="margin-top:1rem;"><?php echo $propose['content']; ?></textarea>
					</div>
					<hr style="border:1px solid #1379cd;">
					<div class="form-group" style="border:0 !important; padding-bottom:10px; margin-bottom:0;">
						<ul class="row">
							<li class="col-xs-12">
								<p class="tit_modal_match" style="margin-bottom:0; display:inline; margin-right:2vw; font-weight: 700;">??? ??????</p>
								<input type="text" name="total_price" id="total_price" value="" readonly="" style="width:75%; border-radius:3%" />
							</li>
						</ul>
					</div>


					<div class="btn_wrap" style="padding-top:3%;">
						<ul class="row">
							<li class="col-xs-6"><a class="line_bg" href="#" data-dismiss="modal">??????</a></li>
							<li class="col-xs-6"><a href="#." class="main_bg" id="main_bg_one" onClick="doSavePriceDetail();">??????</a></li>
						</ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</div><!-- ?????? -->
<div class="modal fade modal_table" id="modal_price_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">???????????????</h4>
			</div>
			<div class="modal-body">
				<form name="frmpricedetail" action="<?php echo G5_URL; ?>/estimate/estimate_form_match_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="no_estimate" value="<?php echo $no_estimate; ?>">
					<div class="form-group">
						<p class="tit_modal_match">?????? ??????</p>
						<div class="row" id="imageList">

						</div>
					</div>

					<div class="form-group">
						<p class="tit_modal_match">????????????</p>
						<div class="row" id="multiList">
							<div class='form_new add_pro'>
								<div class='add_name col-xs-5'><input placeholder='?????????' type='text' name='pro_name[]'></div>
								<div class='add_qty col-xs-5'><input placeholder='??????' type='number' name='pro_price[]'></div>
								<div class='remove_pro'><a class='form_btn delete_item' href='javascript:'>??????</a></div>
							</div>

						</div>
						<a class="add_line" id="add_goods" href="#">+ ??????</a>
					</div>
					<div class="form-group">
						<p class="tit_modal_match">?????????</p>
						<ul class="row">
							<li class="col-xs-9">
								<input type="number" placeholder="????????? ??????????????????" name="shipping_pro" id="del_fee">
							</li>
						</ul>
					</div>
					<div class="form-group" style="border:0 !important">
						<p class="tit_modal_match">AS ??????/??????</p>
						<ul class="row">
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
									<input type="radio" name="as_pro" value="1" checked=""><i>
										<p>??????</p>
									</i></label>
							</li>
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
									<input type="radio" name="as_pro" value="2"><i>
										<p>?????????</p>
									</i></label>
							</li>
						</ul>
					</div>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-6"><a class="line_bg" href="#" data-dismiss="modal">??????</a></li>
							<li class="col-xs-6"><a href="#." class="main_bg" onClick="doSavePriceDetail();">??????</a></li>
						</ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</div><!-- ?????? -->
<div class="modal fade" id="modal_completeDate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div>
					<p>* ????????????????????? ???????????????</p>
				</div>
				<form name="frmcompletedate" id="frmcompletedate" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_complete_date_update_match.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="no_estimate" value="<?php echo $no_estimate; ?>">
					<div class="form-group">
						<ul class="row">
							<li class="col-xs-3 title">
								??????????????????
							</li>
							<li class="col-xs-9">
								<input type="text" id="change_complete_time" name="change_complete_time">
								<input type="hidden" id="completetime" name="completetime" value="<?php echo $master['completetime']; ?>">
								<input type="hidden" id="completedate" name="completedate" value="<?php echo $master['completedate']; ?>">
							</li>
						</ul>
					</div>
				</form>
				<div class="btn_wrap">
					<ul class="row">
						<li class="col-xs-6"><a class="line_bg" href="#" data-dismiss="modal">??????</a></li>
						<li class="col-xs-6"><a href="javascript:doSaveCompleteDate()" class="main_bg">??????</a></li>
					</ul>
				</div>

			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- ?????? -->
<div class='modal fade' id='modal_complete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<h4 class='modal-title' id='myModalLabel'>????????????</h4>
			</div>
			<div class='modal-body'>
				<form name="frmcomplete2" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_complete_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" id="no_estimate" name="no_estimate" value="<?php echo $master['no_estimate']; ?>">
					<input type="hidden" id="state" name="state" value="5">
					<input type="hidden" id="completetime" name="completetime" value="<?php echo $master['completetime']; ?>">
					<input type="hidden" id="completedate" name="completedate" value="<?php echo $master['completedate']; ?>">
					<div class='form-group'>
						<div class='row' id='imageList'>
							<div class='col-xs-4 text-center' id="divPhoto1"></div>
							<div class='col-xs-4 text-center' id="divPhoto2"></div>
							<div class='col-xs-4 text-center' id="divPhoto3"></div>
							<div class='col-xs-4 text-center' id="divPhoto4"></div>
							<div class='col-xs-4 text-center' id="divPhoto5"></div>
							<div class='col-xs-4 text-center' id="divPhoto6"></div>
						</div><!-- imageList -->

						<input type="hidden" id="photo1" name="photo1">
						<input type="hidden" id="photo2" name="photo2">
						<input type="hidden" id="photo3" name="photo3">
						<input type="hidden" id="photo4" name="photo4">
						<input type="hidden" id="photo5" name="photo5">
						<input type="hidden" id="photo6" name="photo6">
						<input type="hidden" id="photo1_rotate" name="photo1_rotate">
						<input type="hidden" id="photo2_rotate" name="photo2_rotate">
						<input type="hidden" id="photo3_rotate" name="photo3_rotate">
						<input type="hidden" id="photo4_rotate" name="photo4_rotate">
						<input type="hidden" id="photo5_rotate" name="photo5_rotate">
						<input type="hidden" id="photo6_rotate" name="photo6_rotate">
					</div>

					<div class='btn_wrap'>
						<ul class='row'>
							<li class='col-xs-6'><a class='line_bg' href='#' data-dismiss='modal'>??????</a></li>
							<li class='col-xs-6'><input class='main_bg' type='button' value='??????' onClick="doSaveComplete();"></li>
						</ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<form name="frmcancel" id="frmcancel" class="modal fade modal_table" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_update_cancel_match.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="no_estimate" name="no_estimate" value="<?php echo $master['no_estimate']; ?>">
	<input type="hidden" name="title" value="<?php echo $master['title'] ?>">
	<input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
</form>
<form name="frmcancel_del" id="frmcancel_del" class="modal fade modal_table" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_update_cancel_match.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="no_estimate" name="no_estimate" value="<?php echo $master['no_estimate']; ?>">
	<input type="hidden" id="rc_email" name="rc_email" value="<?php echo $member['mb_email'] ?>">
	<input type="hidden" id="mb_name" name="mb_name" value="<?php echo $member['mb_name'] ?>">
	<input type="hidden" id="title" name="title" value="<?php echo $master['title'] ?>">
	<input type="hidden" id="email" name="email" value="<?php echo $master['email'] ?>">
	<div style="position: absolute; top: 50%; left: 50%; padding: 20px; background-color: #fff; border:1px solid #ddd; transform: translate(-50%, -50%);">
		<textarea name="reason" id="reason" style="background-color: #fff; border-radius: 1px solid #ddd;" required="" placeholder="??????????????? ???????????????"></textarea>
		<input style="background-color: #ff1616; color: #fff; margin-top: 15px;" type="submit" name="" value="????????????">
	</div>
</form>
<form name="frmcomplete1" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_complete_update_match.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="no_estimate" name="no_estimate" value="<?php echo $master['no_estimate']; ?>">
	<input type="hidden" id="state" name="state" value="5">
	<input type="hidden" id="completetime" name="completetime" value="<?php echo $master['completetime']; ?>">
	<input type="hidden" id="completedate" name="completedate" value="<?php echo $master['completedate']; ?>">
	<input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
</form>
<script type="text/javascript" src="/share/js/jquery.bxslider.js"></script>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">
<script src="http://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
<script>
	jQuery(document).ready(function() {

		$('#view_slider').bxSlider({
			minSlides: 3,
			maxSlides: 3,
			slideWidth: 200,
			auto: false, // ?????? ???????????? ????????????
			controls: true, // ???????????????(prev/next) ????????????
			speed: 1000,
			touchEnabled: false,
			pager: false,

		});

		$('#bx-pager').bxSlider({
			minSlides: 5,
			maxSlides: 5,
			slideWidth: 200,
			slideMargin: 5,
			controls: true,
			pager: false
		});

		$("#view_slider a").lightbox();
		/*
			new Swiper('.swiper-imgs', {
		      navigation: {
		        nextEl: '.swiper-button-next',
		        prevEl: '.swiper-button-prev',
		      },
		    });
		*/
		$("#mob_view_slider a").lightbox();
		$(".swiper-imgs a").lightbox();

		doInitImage2("165");
		var now = new Date();

		var Year = now.getFullYear();

		var Month = now.getMonth() + 1;
		if (Month < 10) Month = "0" + Month

		var Day = now.getDate();
		if (Day < 10) Day = "0" + Day

		var toDate = Year + "-" + Month + "-" + Day;

		var date = $.datepicker.parseDate("yy-mm-dd", toDate);
		$.datepicker.setDefaults({
			dateFormat: 'yymmdd',
			prevText: '?????? ???',
			nextText: '?????? ???',
			monthNames: ['1???', '2???', '3???', '4???', '5???', '6???', '7???', '8???', '9???', '10???', '11???', '12???'],
			monthNamesShort: ['1???', '2???', '3???', '4???', '5???', '6???', '7???', '8???', '9???', '10???', '11???', '12???'],
			dayNames: ['???', '???', '???', '???', '???', '???', '???'],
			dayNamesShort: ['???', '???', '???', '???', '???', '???', '???'],
			dayNamesMin: ['???', '???', '???', '???', '???', '???', '???'],
			showMonthAfterYear: true,
			yearSuffix: '???'
		});
		$("#change_complete_time").datepicker({
			dateFormat: "yy-mm-dd",
			language: "kr",
			minDate: date
		});

		$("#attach_file1").bind('change', function() {
			$("#attfilename1").html(this.files[0].name);
		});

		$("#attach_file2").bind('change', function() {
			$("#attfilename2").html(this.files[0].name);
		});


		var estimateCnt = 0;

		$("#add_goods").click(function() {
			var vHtml = "";
			vHtml += "<div class='form_new add_pro'>";
			vHtml += "<div class='add_name col-xs-5'><input placeholder='?????????'' type='text' name='pro_name[]'></div>";
			vHtml += "<div class='add_qty col-xs-5'><input  placeholder='??????' type='number' name='pro_price[]'></div>";
			vHtml += "<div class='remove_pro'><a class='form_btn delete_item' href='javascript:' >??????</a></div>";
			vHtml += "</div>";

			$("#multiList").append(vHtml);
			estimateCnt++;
		});

		$(document).on("click", ".delete_item", function() {
			$(this).closest(".add_pro").remove();
			estimateCnt--;

			var c = $('input[type="number"]'),
				total_c = 0;
			c.each(function() {
				total_c += +this.value;
			});
			total_c = 0;
			c.each(function() {
				total_c += +this.value;
			});
			$('#total_price').val(total_c);
		});

		$('input[type="number"]').on('keyup', function(e) {
			var i = $('input[type="number"]'),
				total = 0;
			i.each(function() {
				total += +this.value;
			});
			total = 0;
			i.each(function() {
				total += +this.value;
			});
			$('#total_price').val(total);
		});

		var b = $('input[type="number"]'),
			total_b = 0;
		b.each(function() {
			total_b += +this.value;
		});
		total_b = 0;
		b.each(function() {
			total_b += +this.value;
		});
		$('#total_price').val(total_b);


		$(document).on('click', '.estimate_photo_file_remove', function() {
			//	$(document).on( 'click', '#main_bg_one', function () {
			//$('.estimate_photo_file_remove').click(function(){

			//var test2 = $(this).find('.estimate_photo .ph').attr('src');

			var test1 = new Array();

			var rc_email = $('#rc_email').val();
			var no_estimate = $('#no_estimate').val();

			var photo_number = $(".estimate_photo > img").size();

			for (i = 0; i < photo_number; i++) {
				var test2 = '.estimate_photo:eq(' + i + ') img';
				var test3 = $(test2).attr('src');

				//var test4 = test3.replace('/');
				test1.push(test3);
			}
			$.ajax({
				type: "POST",
				url: "<?php echo G5_URL ?>/estimate/partner_estimate_form_price_update_match(test).php",
				data: {
					test1: test1,
					rc_email: rc_email,
					no_estimate: no_estimate
				},
				cache: false,
				success: function(data) {
					console.log('??????');
				}
			});

			//test1.push(test2);
			//console.log(test1);
		})
		var btn_article = 0;
		$('#btn_article').click(function() {
			if (btn_article == 0) {
				btn_article = 1;
				$('#multiList').slideDown();
			} else {
				btn_article = 0;
				$('#multiList').slideUp();
			}
		});

		var del_fee = $("#del_fee").val();

		if (del_fee == 0) {
			$("#shipping_on").prop('checked', false);
			$("#shipping_off").prop('checked', true);
		} else {
			$("#shipping_on").prop('checked', true);
			$("#shipping_off").prop('checked', false);
			$("#del_fee").css('display', 'block');
		}

		var del_fee_m = $("#del_fee").val();
		var del_fee_mt = 1;

		$("#shipping_off").click(function() {
			console.log(del_fee_mt);
			$("#del_fee").css('display', 'none');
			if (del_fee_mt != 0) {
				del_fee_m = $("#del_fee").val();
				del_fee_mt = 0;
			}
			$("#del_fee").val('0');


			var f = $('input[type="number"]'),
				total_f = 0;
			f.each(function() {
				total_f += +this.value;
			});
			total_f = 0;
			f.each(function() {
				total_f += +this.value;
			});
			$('#total_price').val(total_f);
			console.log(typeof(del_fee_m));
			console.log(del_fee_mt);
		});
		$("#shipping_on").click(function() {
			$("#del_fee").css('display', 'block');
			$("#del_fee").val(del_fee_m);

			if (del_fee_mt != 0) {
				del_fee_m = $("#del_fee").val();
				del_fee_mt = 1;
			}
			console.log(del_fee_mt);

			var g = $('input[type="number"]'),
				total_g = 0;
			g.each(function() {
				total_g += +this.value;
			});
			total_g = 0;
			g.each(function() {
				total_g += +this.value;
			});
			$('#total_price').val(total_g);
		});

		var as_pro_num = $("#as_pro_num").val();
		var month_as_num = $("#month_as_num").val();

		if (as_pro_num == 1) {
			$("#as_on").prop('checked', true);
			$("#as_off").prop('checked', false);
			$("[id=month_as]").val(month_as_num);
			$("#month_as").css('display', 'block');
		} else {
			$("#as_on").prop('checked', false);
			$("#as_off").prop('checked', true);
			$("[id=month_as]").val(1);
			$("#month_as").css('display', 'none');
		}

		$("#as_off").click(function() {
			$("#month_as").css('display', 'none');
		});
		$("#as_on").click(function() {
			$("#month_as").css('display', 'block');
		});
	});

	function fnCalcAmt() {
		var totalAmt = 0;
		for (var i = 1; i <= 11; i++) {
			var vId = i;
			if (i < 10) vId = "0" + i;

			var vAmtId = "#amt" + vId;
			var vVatId = "#vat" + vId;

			var vAmt = 0;
			var vVat = 0;
			if ($(vAmtId).val()) {
				vAmt = parseInt(cfnNumberRemoveComma($(vAmtId).val()));
			}

			if ($(vVatId).val()) {
				vVat = parseInt(cfnNumberRemoveComma($(vVatId).val()));
			}

			totalAmt = totalAmt + vAmt + vVat;
		}
		$("#divTotalAmt").html(cfnNumberComma(totalAmt) + " ???");
		$("#totalAmt").val(totalAmt);


	}

	function doCancel() {
		if (confirm("????????? ?????????????????????????")) {
			var f = document.frmcancel;
			f.submit();
		}
	}

	function doCancel_del() {
		if (confirm("????????? ?????????????????????????")) {
			$('#frmcancel_del').modal();
		}
	}

	function doModify() {
		$('#modal_price').modal();
	}


	function doSavePriceDetail() {
		if ($("#pro_price").val() < 1) {
			alert("?????? ????????? ??????????????????.");
			return;
		}

		var f = document.frmprice;
		f.submit();
	}

	function doSave() {
		var f = document.frmprice;
		f.submit();
	}

	function doModifyPrice() {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.price.input.modal.php",
			data: {
				no_estimate: "<?php echo $master['no_estimate']; ?>",
				rc_email: "<?php echo $member['mb_email']; ?>"
			},
			cache: false,
			success: function(data) {
				$("#frmpricedetail").html(data);

				$("#modal_price_detail").modal();
			}
		});
	}

	function req_pay() {
		if (confirm("??????????????? ???????????????????")) {
			var f = document.frmpay;
			f.submit();
		}
	}

	function doSavePrice() {
		var f = document.frmpricedetail;
		f.submit();
	}

	function doChangeCompeteDate(vGubun) {
		document.frmcompletedate.change_complete_time.value = document.frmcompletedate.completetime.value;
		//$("#change_complete_time").val($("#completetime").val());
		if (vGubun == "1") {
			$("#divCompleteDate").html("??????????????????");
			$("#divCompleteDateConetent").html("* ????????????????????? ???????????????");
		} else {
			$("#divCompleteDate").html("??????????????????");
			$("#divCompleteDateConetent").html("* ????????????????????? ???????????????");
		}
		$('#modal_completeDate').modal();
	}

	function doSaveCompleteDate() {
		var f = document.frmcompletedate;
		f.submit();
	}

	function doCompleteEstimate() {

		if (!confirm("???????????????????????????????")) return;
		var f = document.frmcomplete1;
		if (!f.completetime.value) {
			f.completetime.value = f.completedate.value;
		}
		f.submit();

	}

	function doSaveComplete() {
		var nCnt = 0;
		for (var i = 1; i <= 6; i++) {
			if ($("#photo" + i).val()) {
				nCnt++;
			}

		}

		if (nCnt == 0) {
			alert("????????? ??????????????????.");
			return;
		}

		if (!confirm("???????????????????????????????")) return;
		var f = document.frmcomplete2;
		if (!f.completetime.value) {
			f.completetime.value = f.completedate.value;
		}
		f.submit();
	}

	function fileUpload() {
		$("#attfile").val("");
		$('#modal_upload').modal();
	}

	function doSaveUpload() {
		if (!$("#attfile").val()) {
			return;
		}

		if (!confirm("????????????????????????????")) return;
		var f = document.frmupload;
		f.submit();
	}

	function goMove() {
		location.href = "<?php echo G5_URL; ?>/estimate/partner_estimate_list.php";
	}
</script>
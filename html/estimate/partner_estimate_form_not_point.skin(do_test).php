<?php
include_once('./_common.php');
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/share/css/jquery.bxslider.css"/>
<style type="text/css">
	.img_pros{width: 25%; position: relative; float: left; margin-right: 1%; border:1px solid #ededed;}
	p.tit_modal_match{font-size: 20px; padding: 10px 0; color: #1379cd !important; margin-bottom: 10px;}
	#del_fee{margin-bottom: 15px; padding-left: 10px; border-radius: 10px;}
	.add_line{background-color:#707070; color: #fff !important; padding: 10px; margin:10px 0;}
	.delete_item{overflow: hidden; background-color: #ccc; margin-right: 15px; }
	.add_pro{padding: 5px 0;}
	.add_pro input{border-radius: 10px; padding-left: 10px;}
	.requst_list{margin-top: 60px;}
	#frmcompletedate{padding: 10px;}
	#frmcompletedate .row{margin-bottom: 10px !important;}
	#frmcompletedate .row .title{font-size: 13px;}
	.swiper-imgs{position: relative; overflow: hidden;}
	.estimate_photo { border:0;}
	.estimate_photo img{width: auto;}
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
			<h1 class="main_co">고객구매내역</h1>
		</div><!-- sub_title -->
		<div id="board">
			<div class="view">

				<div class="mob">
					<div class="mob_slider">
						<div class="text" id="mobileEtype">중고매칭</div>
					</div>
					<div class="text-center mob_ing" id="mobileStatus">
						<?php echo get_estimate_mobile_state_tag_match($master['state']);?>
					</div>


					<div class="mob_info"  id="mobileInfo1">
					<?php
						echo "<ul class='row'>";
						
						echo "<li class='col-xs-6'>";
						echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>견적마감일</p> "; ?>
						<p class='text-center'>
						<?php 
						if(intval(strtotime($master['date_close'])-strtotime(date("Y-m-d")) / 86400) == 0){
							echo $master['date_close'];
						}else{
							echo 'D-' . intval(strtotime($master['date_close'])-strtotime(date("Y-m-d"))) / 86400;
						}

						echo "</p>";
						echo "</li>";
						echo "<li class='col-xs-6'>";
						if($selected != "1"){
							echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>배송요청일</p> ";
						
							echo "<p class='text-center'>".$master['date_req']."</p> ";

						}else{
							if($master['completetime']){
								echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>배송확정일</p> ";
								echo "<p class='text-center'>".$master['completetime']."</p> ";
							}else{
								echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>배송요청일</p> ";
								echo "<p class='text-center'>".$master['date_req']."</p> ";
							}
						}
						echo "</li>";
						echo "</ul>";
						if($state == "1"){
							echo "<ul class='row'>";
							echo "<li class='col-xs-6'>";
							echo "<a class='line_bg' href='javascript:doCancel();'>견적 취소</a>";
							echo "</li>";
							echo "<li class='col-xs-6'>";
							echo "<a class='main_bg' href='javascript:doModify();'>견적 수정</a>";
							echo "</li>";
							echo "</ul>";
						}
					?>
					</div>

					<div class="customer"  id="mobileInfo2">
						<h3>요청고객</h3>
						<dl>
							<dt class='col-xs-1 main_co'>제목</dt>
							<dd class='col-xs-11'><?php echo $master['title'] ?></dd>
							<dt class='col-xs-1 main_co'>장소</dt>
							<dd class='col-xs-11'><?php echo $master['jangso'] ?></dd>
							<dt class='col-xs-1 main_co'>예산</dt>
							<dd class='col-xs-11'><?php echo number_format($master['price_client']) ?>원</dd>
							
					<?php
						if($selected== '1'&&$master['pay_confirm'] == '1'){
							echo "<dt class='col-xs-1 main_co'>이름</td>";
							echo "<dd class='col-xs-11'>".$master['name']."</dd>";
							echo "<dt class='col-xs-1 main_co'>연락처</td>";
							echo "<dd class='col-xs-11'>".$master['number']."</dd>";
							echo "<dt class='col-xs-1 main_co'>지역</td>";
							echo "<dd class='col-xs-11'>".$master['area1']." ".$master['area2']." ".$master['place']."</dd>";
						}else{ ?>
							<dt class='col-xs-1 main_co'>지역</dt>
							<dd class='col-xs-11'><?php echo $master['area1']." ".$master['area2']; ?></dd>
						<?php }
					?>		
						</dl>
					</div>
					<div class="warning" id="mobileWaring">
					<?php
						if($state == "2"){
							echo "<h1 class='text-center main_co'>고객이 업체 선택중 입니다.</h1>";
						}

						if(($state == "3" || $state == "8") && $selected == "1"){
							if($req_pay == '1'){
								echo "<h3>주의사항</h3>";
								echo "<p>";
								echo "<span class='main_co'>고객과 연락 후 배송 확정</span>일을 설정해주세요.<br/>";
								echo "일정을 잊지않게 <span class='main_co'>알림</span>으로 알려드립니다.";
								echo "</p>";
								if($master['completetime']){
									echo "<a style='width:100%; padding: 5px 0; text-align:center;border-radius: 5px; margin-top:10px;' class='main_bg' href='#none'>진행확정됨</a>";

								}else{
									echo "<a style='width:100%; padding: 5px 0; text-align:center;border-radius: 5px; margin-top:10px;' class='main_bg' href='javascript:doChangeCompeteDate(\"1\");'>진행확정</a>";
								}
								
									echo "<a class='line_bg2' href='javascript:doCompleteEstimate()'>배송완료 하기</a>";
                                	echo "<a class='line_bg1' href='#!' onClick='doTel(\"".$master['number']."\")')'>고객 전화하기</a>";
                                	echo "<a style='width:100%; padding: 5px 0; text-align:center;border-radius: 5px; margin-top:10px; background-color:#ff1616;'  href='javascript:doCancel_del();'>배송 취소</a>";
							}else{
									echo "<a style='width:100%; padding: 5px 0; text-align:center;border-radius: 5px; margin-top:10px; background-color:#ff1616;'  href='javascript:doCancel_del();'>배송 취소</a>";
									echo "<a style='width:100%; border:1px solid #ededed; padding: 5px 0; text-align:center;border-radius: 5px; margin-top:10px;'  href='javascript:req_pay();'>결제요청</a>";
									
									echo '<p style="margin-top: 20px;">고객이 선택한 물품에 판매가<br/>
							 				가능하시면 결제요청을 해주세요.</p>';
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
							echo "<dt class='col-xs-3'>장소</dt><dd class='col-xs-9'>".$master['jangso']."</dd>";
							if($master['pay_confirm'] == '1'&&$selected == "1")
							{
							echo "<dt class='col-xs-3'>이름</dt><dd class='col-xs-9'>".$master['name']."</dd>";
							echo "<dt class='col-xs-3'>지역</dt><dd class='col-xs-9'>".$master['area1']." ".$master['area2']." ".$master['place']."</dd>";
							echo "<dt class='col-xs-3'>연락처</dt><dd class='col-xs-9'>".$master['number'] ."</dd>";
							}else{
								echo "<dt class='col-xs-3'>지역</dt><dd class='col-xs-9'>".$master['area1']." ".$master['area2']."</dd>";
							}
							echo "<dt class='col-xs-3'>예산</dt><dd class='col-xs-9'>".number_format($master['price_client'])."원</dd>";
							echo "<dt class='col-xs-3'>견적마감일</dt><dd class='col-xs-9'>";
								if(intval(strtotime($master['date_close'])-strtotime(date("Y-m-d"))) == 0){
									echo $master['date_close'];
								}else{
									echo 'D-' . intval(strtotime($master['date_close'])-strtotime(date("Y-m-d"))) / 86400;
								}
							echo "</dd>";
							if($master['completetime']){
								echo "<dt class='col-xs-3'>배송확정일</dt><dd class='col-xs-9'>".$master['completetime']."</dd>";
							}else{
								echo "<dt class='col-xs-3'>배송요청일</dt><dd class='col-xs-9'>".$master['date_req']."</dd>";
							}
								
							if($state == "1"){
								echo "<ul class='row'>";
								echo "<li class='col-xs-6'>";
								echo "<a class='line_bg' href='javascript:doCancel();'>견적 취소</a>";
								echo "</li>";
								echo "<li class='col-xs-6'>";
								echo "<a class='main_bg' href='javascript:doModify();'>견적 수정</a>";
								echo "</li>";
								echo "</ul>";
							}
							if(($state == "3" || $state == "8") && $selected == "1"){
								
									echo "<dt class='col-xs-3'>선택견적가격</dt><dd class='col-xs-9'>".number_format($propose_detail['amt0'] + $propose_detail['amt1'] + $propose_detail['amt2'] + $propose_detail['amt3'] + $propose_detail['amt4'] + $propose_detail['amt5'] + $propose_detail['amt6'] + $propose_detail['amt7'] + $propose_detail['amt8'] + $propose_detail['amt9'] + $propose_detail['amt10'] + $master['shipping']); "원</dd>";
									
							}else if($state == "5" && $selected == "1"){ ?>
									<dt class='col-xs-3'>견적가격</dt><dd class='col-xs-9'><?php echo number_format($propose_detail['amt0'] + $propose_detail['amt1'] + $propose_detail['amt2'] + $propose_detail['amt3'] + $propose_detail['amt4'] + $propose_detail['amt5'] + $propose_detail['amt6'] + $propose_detail['amt7'] + $propose_detail['amt8'] + $propose_detail['amt9'] + $propose_detail['amt10'] + $master['shipping']);?>원</dd>
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
						if($state == "2"){
							echo "<h1 class='text-center main_co'>고객이 업체 선택중 입니다.</h1>";
						}

						if(($state == "3" || $state == "8") && $selected == "1"){
							if($req_pay == '1'){
									echo "<h3>주의사항</h3>";
									echo "<p>";
									echo "<span class='main_co'>고객과 연락 후 배송 확정</span>일을 설정해주세요.<br/>";
									echo "일정을 잊지않게 <span class='main_co'>알림</span>으로 알려드립니다.";
									echo "</p>";
									if($master['completetime']){

									echo "<a class='main_bg' href='#none'>진행확정됨</a>";
								}else{
									echo "<a class='main_bg' href='javascript:doChangeCompeteDate(\"1\");'>진행확정</a>";

								}
								echo "<a class='line_bg' href='javascript:doCompleteEstimate()'>배송완료 하기</a>";
								echo "<a style='background-color:#ff1616; color:#fff !important;'  href='javascript:doCancel_del();'>배송 취소</a>";
							}else{
								echo "<a style='background-color:#ff1616; color:#fff !important;'  href='javascript:doCancel_del();'>배송 취소</a>";
								echo "<a class='line_bg' href='javascript:req_pay()'>결제요청</a>";
								echo '<p style="margin-top: 20px;">  고객이 선택한 물품에 판매가<br/>
								가능하시면 결제요청을 해주세요.
								</p>';
							}
							
						}
					?>
					
					</div>
				</div>
				<h1 class="tt">고객요청사항</h1>
				<p> <?php echo $master['etc_req']; ?> </p>
				<h1 class="tt">구매요청내역</h1>

				<table style="margin-top: 0; padding-top: 0;"  class="requst_list" id="subDetail">
					<tr>
					<th>카테고리</th>
					<th>품목</th>
					<th>수량</th>
					</tr>
				<?php
					
					for ($i=0; $row=sql_fetch_array($info); $i++) {
						echo "<tr>";
						echo "<td style='text-align:center'>".$row['cate']."</td>";
						echo "<td style='text-align:center'>".$row['cate_name']."</td>";
						echo "<td style='text-align:center'>".$row['qty']."</td>";
						echo "</tr>";
					}
				?>
				</table>

				<h1 class="tt">내 견적정보</h1>
				<div class="list requst_list02" id="tableList">
					<table class="info_basic" style="margin-bottom: 20px;">

						<tr>
							<th>배송비</th>
							<td><?php echo number_format($master['shipping']). '원'; ?></td>
							<th>AS 보증/교환</th>
							<td><?php 
							if($master['pro_as'] == '1'){
								echo '가능</td><td>' . $master['month_as'] . '개월</td>';	
							}else{
								echo "불가능</td>";
							} ?>
							
						</tr>
					</table>
					<table>

						<tr>
							<th>품목명</th>
							<th>가격</th>
						</tr>
						<tr>
							<td><?php echo $propose_detail['item0']; ?></td>
							<td><?php echo number_format($propose_detail['amt0']); ?>원</td>
						</tr>
						<?php 
						if($propose_detail['item1']){
							echo '<tr><td>' . $propose_detail['item1'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt1']) . '원</td></tr>';
						}
						?>
						<?php 
						if($propose_detail['item2']){
							echo '<tr><td>' . $propose_detail['item2'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt2']) . '원</td></tr>';
						}
						?>
						<?php 
						if($propose_detail['item3']){
							echo '<tr><td>' . $propose_detail['item3'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt3']) . '원</td></tr>';
						}
						?>
						<?php 
						if($propose_detail['item4']){
							echo '<tr><td>' . $propose_detail['item4'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt4']) . '원</td></tr>';
						}
						?>
						<?php 
						if($propose_detail['item5']){
							echo '<tr><td>' . $propose_detail['item5'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt5']) . '원</td></tr>';
						}
						?>
						<?php 
						if($propose_detail['item6']){
							echo '<tr><td>' . $propose_detail['item6'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt6']) . '원</td></tr>';
						}
						?>
						<?php 
						if($propose_detail['item7']){
							echo '<tr><td>' . $propose_detail['item7'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt7']) . '원</td></tr>';
						}
						?>
						<?php 
						if($propose_detail['item8']){
							echo '<tr><td>' . $propose_detail['item8'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt8']) . '원</td></tr>';
						}
						?>
						<?php 
						if($propose_detail['item9']){
							echo '<tr><td>' . $propose_detail['item9'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt9']) . '원</td></tr>';
						}
						?>
						<?php 
						if($propose_detail['item10']){
							echo '<tr><td>' . $propose_detail['item10'] . '</td>';
							echo '<td>' . number_format($propose_detail['amt10']) . '원</td></tr>';
						}
						?>
					</table>
					<div class="swiper-imgs">
						<div class="swiper-wrapper img_lists">
							<?php 
							$no_estimate = $master['no_estimate'];
							$sql = " select * from g5_estimate_list_photo_match where no_estimate=$no_estimate and rc_email='{$member['mb_email']}' ";
							$photo = sql_query($sql);
							for ($i=0; $row_photos=sql_fetch_array($photo); $i++) { 
								echo '<div class="swiper-slide estimate_photo estimate_image_bg col-md-4 text-center"><a href="/data/estimate/'. $row_photos['photo'] . '"><img src="/data/estimate/'. $row_photos['photo'] . '"></a></div>'; 
							}
							?>
						</div>
						<!-- Add Arrows -->
					    <div class="swiper-button-next"></div>
					    <div class="swiper-button-prev"></div>
					</div>
					<table style="margin-top: 20px;">
						<th>총비용</th>
						<td>
							<?php echo number_format($propose_detail['amt0'] + $propose_detail['amt1'] + $propose_detail['amt2'] + $propose_detail['amt3'] + $propose_detail['amt4'] + $propose_detail['amt5'] + $propose_detail['amt6'] + $propose_detail['amt7'] + $propose_detail['amt8'] + $propose_detail['amt9'] + $propose_detail['amt10'] + $master['shipping']);?>원
						</td>
					</table>
				</div>
				<?php
					

					$sql = " select * from g5_estimate_match_propose where no_estimate = '{$master['no_estimate']}' and ifnull(content,'') != '' and rc_email = '{$member['mb_email']}' ";
					//echo $sql;
					$request_row = sql_fetch($sql);
					if($request_row){
						echo '<div class="text_note">';
						echo '<h1 style="margin-top:35px;">업체 견적 참고사항</h1>';
						echo '<p>'.$request_row['rc_nickname'].' - '.$request_row['content'].'</p>';
						echo '</div>';
					}

				?>
				<div id="divRreview">
				<?php
					if($propose_review){
						/*$sql1 = " select * from {$g5['estimate_list_photo']} where no_estimate = '$no_estimate' order by no_estimate limit 1 ";
						$photo = sql_fetch($sql1);*/
						$score = $propose_review['score'];
						echo "<h1 class='tt'>고객후기</h1>";
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
						echo "<div class='sub_tt'>".get_etype($propose_review['e_type'])." / ".$propose_review['title']."</div>";
						echo "<div class='con'>".$propose_review['review']."</div>";
						echo "<div class='icon'>";
						if($score < 1){
							echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 2){
							echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 3){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 4){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 5){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
						}else{
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
						}
						echo "</div>";
						echo "<div class='date'>작성자 : ".$propose_review['nickname']." ㅣ 등록일 : ".$propose_review['updatetime']."</div>";
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
						<a class="main_bg" href="./partner_estimate_list.php?gubun=<?php echo $gubun; ?>&&page=<?php echo $page; ?>">리스트</a>
					</li>
				</ul>
			</div>

		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
<form name="frmpay" style="display: none" action="<?php echo G5_URL; ?>/estimate/partner_estimate_req.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="no_estimate" value="<?php echo $no_estimate; ?>">
</form>
<div class="modal fade modal_table" id="modal_price" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">상세견적서</h4>
			</div>
			<div class="modal-body">
				<form name="frmprice" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_price_update_match.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="no_estimate" value="<?php echo $no_estimate; ?>">
					<input type="hidden" name="rc_email" value="<?php echo $member['mb_email']; ?>">
					<div class="form-group">
						<p class="tit_modal_match">상품 사진</p>
						<div class="row" id="imageList">

						</div>
					</div>

					<div class="form-group">
						<p class="tit_modal_match">물품내역</p>
						<div class="row" id="multiList">
							<div class='form_new add_pro'>
								<div class='add_name col-xs-5'><input placeholder='품목명' type='text' name='pro_name[]'></div>
								<div class='add_qty col-xs-5'><input  placeholder='가격' type='number' name='pro_price[]'></div>
								<div class='remove_pro'><a class='form_btn delete_item' href='javascript:' >삭제</a></div>
							</div>
						</div>
						<a class="add_line" id="add_goods" href="#">+ 추가</a>
					</div>
					<div class="form-group">
						<p class="tit_modal_match">배송비</p>
						<ul class="row">
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
								<input type="radio" id="shipping_on" name="shipping_check" value="1" ><i><p>있음</p></i></label>
							</li>
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
								<input type="radio" id="shipping_off" name="shipping_check" value="2" checked=""><i><p>없음</p></i></label>
							</li>
						</ul>
						<ul class="row shipping_fee">
							<li class="col-xs-9">
								<input style="display: none;" type="number" placeholder="숫자만 입력해주세요" name="shipping_pro" id="del_fee">
							</li>
						</ul>
					</div>
					<div class="form-group" style="border:0 !important">
						<p class="tit_modal_match">AS 보증/교환</p>
						<ul class="row">
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
								<input type="radio" id="as_on" name="as_pro" value="1" checked=""><i><p>가능</p></i></label>
							</li>
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
								<input type="radio" id="as_off" name="as_pro" value="2"><i><p>불가능</p></i></label>
							</li>
						</ul>
					</div>
					<div class="form-group" style="border:0 !important; margin-bottom: 0;">
						<select name="month_as" id="month_as">
							<option value="1">1개월</option>
							<option value="2">2개월</option>
							<option value="3">3개월</option>
							<option value="4">4개월</option>
							<option value="5">5개월</option>
							<option value="6">6개월</option>
							<option value="7">7개월</option>
							<option value="8">8개월</option>
							<option value="9">9개월</option>
							<option value="10">10개월</option>
							<option value="11">11개월</option>
							<option value="12">12개월</option>
						</select>
					</div>
					<div class="form-group">
						<p class="tit_modal_match">참고사항</p>
						<textarea name="match_desc"></textarea>
					</div>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-6"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
							<li class="col-xs-6"><a href="#." class="main_bg" onClick="doSavePriceDetail();">확인</a></li>
						</ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</div><!-- 견적 -->
<div class="modal fade modal_table" id="modal_price_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">상세견적서</h4>
			</div>
			<div class="modal-body">
				<form name="frmpricedetail" action="<?php echo G5_URL; ?>/estimate/estimate_form_match_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="no_estimate" value="<?php echo $no_estimate; ?>">
					<div class="form-group">
						<p class="tit_modal_match">상품 사진</p>
						<div class="row" id="imageList">

						</div>
					</div>

					<div class="form-group">
						<p class="tit_modal_match">물품내역</p>
						<div class="row" id="multiList">
							<div class='form_new add_pro'>
								<div class='add_name col-xs-5'><input placeholder='품목명' type='text' name='pro_name[]'></div>
								<div class='add_qty col-xs-5'><input  placeholder='가격' type='number' name='pro_price[]'></div>
								<div class='remove_pro'><a class='form_btn delete_item' href='javascript:' >삭제</a></div>
							</div>
						</div>
						<a class="add_line" id="add_goods" href="#">+ 추가</a>
					</div>
					<div class="form-group">
						<p class="tit_modal_match">배송비</p>
						<ul class="row">
							<li class="col-xs-9">
								<input type="number" placeholder="숫자만 입력해주세요" name="shipping_pro" id="del_fee">
							</li>
						</ul>
					</div>
					<div class="form-group" style="border:0 !important">
						<p class="tit_modal_match">AS 보증/교환</p>
						<ul class="row">
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
								<input type="radio" name="as_pro" value="1" checked=""><i><p>가능</p></i></label>
							</li>
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
								<input type="radio" name="as_pro" value="2"><i><p>불가능</p></i></label>
							</li>
						</ul>
					</div>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-6"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
							<li class="col-xs-6"><a href="#." class="main_bg" onClick="doSavePriceDetail();">확인</a></li>
						</ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</div><!-- 견적 -->
<div class="modal fade" id="modal_completeDate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div>
					<p>* 배송확정일자를 입력하세요</p>
				</div>
				<form name="frmcompletedate" id="frmcompletedate" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_complete_date_update_match.php" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="no_estimate" value="<?php echo $no_estimate; ?>">
				<div class="form-group">
					<ul class="row">
						<li class="col-xs-3 title">
							배송확정일자
						</li>
						<li class="col-xs-9">
							<input type="text" id="change_complete_time" name="change_complete_time">
							<input type="hidden" id="completetime" name="completetime" value="<?php echo $master['completetime'];?>">
							<input type="hidden" id="completedate" name="completedate" value="<?php echo $master['completedate'];?>">
						</li>
					</ul>
				</div>
				</form>
				<div class="btn_wrap">
					<ul class="row">
						<li class="col-xs-6"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						<li class="col-xs-6"><a href="javascript:doSaveCompleteDate()" class="main_bg">확인</a></li>
					</ul>
				</div>

			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 선택 -->
<div class='modal fade' id='modal_complete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<h4 class='modal-title' id='myModalLabel'>철거완료</h4>
			</div>
			<div class='modal-body'>
				<form name="frmcomplete2" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_complete_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" id="no_estimate"  name="no_estimate" value="<?php echo $master['no_estimate']; ?>">
					<input type="hidden" id="state" name="state" value="5">
					<input type="hidden" id="completetime" name="completetime" value="<?php echo $master['completetime'];?>">
					<input type="hidden" id="completedate" name="completedate" value="<?php echo $master['completedate'];?>">
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
							<li class='col-xs-6'><a class='line_bg' href='#' data-dismiss='modal'>닫기</a></li>
							<li class='col-xs-6'><input class='main_bg' type='button' value='확인' onClick="doSaveComplete();"></li>
						</ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<form name="frmcancel" id="frmcancel" class="modal fade modal_table" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_update_cancel_match.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="no_estimate"  name="no_estimate" value="<?php echo $master['no_estimate']; ?>">
	<input type="hidden" name="title" value="<?php echo $master['title'] ?>">
	<input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
</form>
<form name="frmcancel_del" id="frmcancel_del" class="modal fade modal_table" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_update_cancel_match.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="no_estimate"  name="no_estimate" value="<?php echo $master['no_estimate']; ?>">
	<input type="hidden" id="rc_email" name="rc_email" value="<?php echo $member['mb_email'] ?>">
	<input type="hidden" id="mb_name" name="mb_name" value="<?php echo $member['mb_name'] ?>">
	<input type="hidden" id="title" name="title" value="<?php echo $master['title'] ?>">
	<div style="position: absolute; top: 50%; left: 50%; padding: 20px; background-color: #fff; border:1px solid #ddd; transform: translate(-50%, -50%);">
		<textarea name="reason" id="reason" style="background-color: #fff; border-radius: 1px solid #ddd;" required="" placeholder="취소사유를 말해주세요"></textarea>
		<input style="background-color: #ff1616; color: #fff; margin-top: 15px;" type="submit" name="" value="취소하기">
	</div>
</form>
<form name="frmcomplete1" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_complete_update_match.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="no_estimate"  name="no_estimate" value="<?php echo $master['no_estimate']; ?>">
	<input type="hidden" id="state" name="state" value="5">
	<input type="hidden" id="completetime" name="completetime" value="<?php echo $master['completetime'];?>">
	<input type="hidden" id="completedate" name="completedate" value="<?php echo $master['completedate'];?>">
	<input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
</form>
<script type="text/javascript" src="/share/js/jquery.bxslider.js"></script>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">
<script src="http://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
<script>
jQuery(document).ready(function(){

	new Swiper('.swiper-imgs', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
	$("#mob_view_slider a").lightbox();
	$(".swiper-imgs a").lightbox();

	doInitImage2("165");
	var now = new Date();

	var Year = now.getFullYear();

	var Month   = now.getMonth()+1;
	if(Month < 10) Month = "0"+Month

	var Day   = now.getDate();
	if(Day < 10) Day = "0"+Day

	var toDate = Year +"-" + Month + "-"+ Day;

	var date = $.datepicker.parseDate( "yy-mm-dd", toDate );
	$.datepicker.setDefaults({
        dateFormat: 'yymmdd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: '년'
    });
	$( "#change_complete_time" ).datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr",
		minDate:date
	});

	$("#attach_file1").bind('change', function() {
		$("#attfilename1").html(this.files[0].name);
	});

	$("#attach_file2").bind('change', function() {
		$("#attfilename2").html(this.files[0].name);
	});		

	
	var estimateCnt = 0;

	$("#add_goods").click(function(){
		var vHtml = "";
		vHtml += "<div class='form_new add_pro'>";
		vHtml += "<div class='add_name col-xs-5'><input placeholder='품목명'' type='text' name='pro_name[]'></div>";
		vHtml += "<div class='add_qty col-xs-5'><input  placeholder='가격' type='number' name='pro_price[]'></div>";
		vHtml += "<div class='remove_pro'><a class='form_btn delete_item' href='javascript:' >삭제</a></div>";
		vHtml += "</div>";

		$("#multiList").append(vHtml);
		estimateCnt++;
	});

	$("#shipping_off").click(function(){
		$("#del_fee").css('display', 'none');
		$("#del_fee").val('0');
	});
	$("#shipping_on").click(function(){
		$("#del_fee").css('display', 'block');
	});

	$("#as_off").click(function(){
		$("#month_as").css('display', 'none');
		$("#month_as").val('0');
	});
	$("#as_on").click(function(){
		$("#month_as").css('display', 'block');
	});
});

function fnCalcAmt()
{
	var totalAmt = 0;
	for(var i=1; i<=11; i++)
	{
		var vId = i;
		if(i<10) vId = "0"+i;

		var vAmtId = "#amt"+vId;
		var vVatId = "#vat"+vId;

		var vAmt = 0;
		var vVat = 0;
		if($(vAmtId).val())
		{
			vAmt = parseInt(cfnNumberRemoveComma($(vAmtId).val()));
		}

		if($(vVatId).val())
		{
			vVat = parseInt(cfnNumberRemoveComma($(vVatId).val()));
		}

		totalAmt = totalAmt + vAmt + vVat;
	}
	$("#divTotalAmt").html(cfnNumberComma(totalAmt)+" 원");
	$("#totalAmt").val(totalAmt);


}

function doCancel()
{
	if(confirm("견적을 취소하시겠습니까?")){
		var f = document.frmcancel;
		f.submit();
	}
}

function doCancel_del(){
	if(confirm("배송을 취소하시겠습니까?")){
		$('#frmcancel_del').modal();
	}
}

function doModify()
{
	$('#modal_price').modal();
}


function doSavePriceDetail()
{
	if($("#pro_price").val() < 1)
	{
		alert("상세 견적을 입력하십시오.");
		return;
	}

	var f = document.frmprice;
	f.submit();
}

function doSave()
{
	var f = document.frmprice;
	f.submit();
}

function doModifyPrice()
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.price.input.modal.php",
        data: {
        	no_estimate:"<?php echo $master['no_estimate']; ?>",
        	rc_email:"<?php echo $member['mb_email']; ?>"
        },
        cache: false,
        success: function(data) {
			$("#frmpricedetail").html(data);

			$("#modal_price_detail").modal();
        }
    });
}

function req_pay(){
	if(confirm("결제요청을 하시겠습니까?")){
		var f = document.frmpay;
		f.submit();
	}
}

function doSavePrice()
{
	var f = document.frmpricedetail;
	f.submit();
}

function doChangeCompeteDate(vGubun)
{
	document.frmcompletedate.change_complete_time.value = document.frmcompletedate.completetime.value;
	//$("#change_complete_time").val($("#completetime").val());
	if(vGubun=="1")
	{
		$("#divCompleteDate").html("배송확정일자");
		$("#divCompleteDateConetent").html("* 배송확정일자를 입력하세요");
	}else{
		$("#divCompleteDate").html("철거확정일자");
		$("#divCompleteDateConetent").html("* 철거확정일자를 입력하세요");
	}
	$('#modal_completeDate').modal();
}

function doSaveCompleteDate()
{
	var f = document.frmcompletedate;
	f.submit();
}

function doCompleteEstimate()
{
	
	if(!confirm("배송완료하시겠습니까?")) return;
	var f = document.frmcomplete1;
	if(!f.completetime.value){
		f.completetime.value = f.completedate.value;
	}
	f.submit();

}
function doSaveComplete()
{
	var nCnt = 0;
	for(var i=1; i<=6; i++)
	{
		if($("#photo"+i).val()){
			nCnt++;
		}

	}

	if(nCnt == 0){
		alert("사진을 등록하십시오.");
		return;
	}

	if(!confirm("철거완료하시겠습니까?")) return;
	var f = document.frmcomplete2;
	if(!f.completetime.value){
		f.completetime.value = f.completedate.value;
	}
	f.submit();
}

function fileUpload()
{
	$("#attfile").val("");
	$('#modal_upload').modal();
}

function doSaveUpload()
{
	if(!$("#attfile").val()){
		return;
	}

	if(!confirm("업로드하시겠습니까?")) return;
	var f = document.frmupload;
	f.submit();
}

function goMove()
{
	location.href="<?php echo G5_URL; ?>/estimate/partner_estimate_list.php";
}

</script>

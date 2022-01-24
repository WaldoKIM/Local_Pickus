<?php
include_once('./_common.php');
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/swiper.min.css"/>
<link rel="stylesheet" type="text/css" href="/share/css/jquery.bxslider.css"/>
<?php

	$sql = "update g5_notify set read_gb = 1 where email = '{$member['mb_email']}' AND estimate_idx = '$idx' ";

	sql_query($sql);

?>
<style type="text/css">
	.swiper-container-android .swiper-slide, .swiper-wrapper{text-align: center;}
	.mob_slider .bx-wrapper .bx-controls-direction a{z-index: 999;}
	input#input_photo1_file,
	input#input_photo2_file,
	input#input_photo3_file,
	input#input_photo4_file,
	input#input_photo5_file,
	input#input_photo6_file{height: 180px !important;}
	.estimate_image_bg img{max-height: 180px;}
	.ma,.pe{margin-right: 10px;}
	dd .pe{margin-left: 15px;}
	#board .view .info dt,
	#board .view .info dd,
	#mobileInfo2 .col-xs-1,
	#mobileInfo2 .col-xs-11{height: 43px;}
	#divTotalAmt{margin-top: 12px;}
	#frmpricedetail p{margin-bottom: 10px;}
	#frmpricedetail #content{margin-bottom: 20px; padding: 10px;}
	.warning a{padding: 10px 0; font-size: 14px;}
	#desc_pe{white-space: nowrap;}
	@media(max-width: 768px){
		.estimate_image_bg img{max-height: 124px;}
		.estimate_image_click_bg{margin-bottom: 10px;}
		.modal_table .title{line-height: 24px;}
		h3{font-size: 20px;}
	}
</style>

<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">견적현황</h1>
		</div><!-- sub_title --> 
		<div id="board">
			<div class="view">
				<div class="mob">
					<div class="mob_slider swiper-container">
						<ul id="mob_view_slider" class="swiper-wrapper">
							<?php
								$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
								$photo = sql_query($sql);
								for ($i=0; $row1=sql_fetch_array($photo); $i++) {
									echo '<li class="swiper-slide"><a href="'.G5_DATA_URL.'/estimate/'.$row1['photo'].'" target="_blank">'.estimate_img_thumbnail($row1['photo'], 350, 350).'</a></li>';
								}
							?>
						</ul>
						<div class="text" id="mobileEtype"><?php echo get_etype($master['e_type']);?></div>
					<!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
					</div>

					<div class="text-center mob_ing" id="mobileStatus">
						<?php 
						if($master['e_type']=="2" && $selected == "1" && $state=="5"){
							echo "<h1 class='gray_co'>철거완료</h1>";
						}else{
							echo get_estimate_mobile_state_tag($master['state']);
						}
						?>
					</div>


					<div class="mob_info"  id="mobileInfo1">
					<?php
						echo "<ul class='row'>";
						echo "<li class='col-xs-6'>";
						if($selected != "1"){
							if($e_type == "2"){
								echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>철거요청일</p> ";
							}else{
								echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>수거요청일</p> ";
							}
							echo "<p class='text-center'>".$master['pickup_date']."</p> ";
						}else{
							if($master['completetime']){
								if($e_type == "2"){
									echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>철거확정일</p> ";
								}else{
									echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>수거확정일</p> ";
								}
								echo "<p class='text-center'>".$master['completetime']."</p> ";
							}else{
								if($e_type == "2"){
									echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>철거요청일</p> ";
								}else{
									echo "<p class='text-center main_co'><i class='xi-calendar-check'></i>수거요청일</p> ";
								}
								echo "<p class='text-center'>".$master['requesttime']."</p> ";
							}
						}
						echo "</li>";
						echo "<li class='col-xs-6' style='text-align:center'>";
						if($state == "0" || $state == "1" ||$state == "2"){
							echo "<p class='text-center main_co'><i class='xi-money'></i>내 견적가</p> ";
							if($e_type == "0" || $e_type == "1"){
								if($master['price']){
								echo "<p class='text-center'><span class='ma'>매입</span>".display_estimate_price($master['price'], $master['meet'])."</p> ";
								}
								if($master['price_minus']){
									echo "<p class='text-center'><span class='pe'>폐기</span>".number_format($master['price_minus'])."원</p> ";
								}
								if($master['free'] == '1'){
										echo "<span class='ma'>매입</span>".display_estimate_price($master['price'], $master['meet']);
									}
								if($master['meet']){
									echo "<p class='text-center'>방문견적</p>";
								}
							}else if($e_type == "2"){
								echo "<p class='text-center'>".display_estimate_price($master['price'], $master['meet'])."</p>";
							}
						}else{
							echo "<p class='text-center main_co'><i class='xi-money'></i>선택견적가</p> ";
							if($e_type == "0"){
								if($master['price'] || ($master['price']=="0" && !$master['price_minus'])){
								echo "<p class='text-center'><span class='ma'>매입</span>".display_estimate_price($master['price'], $master['meet'])."</p> ";
								}
								if($master['price_minus']){
									echo "<p class='text-center'><span class='pe'>폐기</span>".number_format($master['price_minus'])."원</p> ";
								}
								if($master['meet']){
									echo "<p class='text-center'>방문견적</p>";
								}
							}else if($e_type == "1"){
								if($master['price'] || ($master['price']=="0" && !$master['price_minus'])){
								echo "<p class='text-center'><span class='ma'>매입</span>".display_estimate_price($master['price'], $master['meet'])."</p> ";
								}
								if($master['price_minus']){
									echo "<p class='text-center'><span class='pe'>폐기</span>".number_format($master['price_minus'])."원</p> ";
								}
								if($master['meet']){
									echo "<p class='text-center'>방문견적</p>";
								}
							}else if($e_type == "2"){
								echo "<p class='text-center'>".display_estimate_price($master['price'], $master['meet'])."</p>";
							}
						}
						
						echo "</li>";
						echo "</ul>";
						
						if($state == "1"){
							if($master["meet"]){
								if($e_type == "2"){
									echo "<ul class='row'>";
									echo "<li class='col-xs-6'>";
									echo "<a class='line_bg' href='javascript;'>방문중</a>";
									echo "</li>";
									echo "<li class='col-xs-6'>";
									echo "<a class='main_bg' href='javascript:doModifyPrice();'>견적 참여</a>";
									echo "</li>";
									echo "</ul>";
								}else{
									echo "<ul class='row'>";
									echo "<li class='col-xs-6'>";
									echo "<a class='line_bg' href='javascript;'>방문중</a>";
									echo "</li>";
									echo "<li class='col-xs-6'>";
									echo "<a class='main_bg' href='javascript:doModify();'>견적 참여</a>";
									echo "</li>";
									echo "</ul>";
								}
							}else{
								if($e_type == "2"){
									echo "<ul class='row'>";
									echo "<li class='col-xs-6'>";
									echo "<a class='line_bg' href='javascript:doCancel();'>견적 취소</a>";
									echo "</li>";
									echo "<li class='col-xs-6' style='border-left:0;'>";
									echo "<a class='main_bg' href='javascript:doModifyPrice();'>견적확인/수정</a>";
									echo "</li>";
									echo "</ul>";
								}else{
									echo "<ul class='row'>";
									echo "<li class='col-xs-6'>";
									echo "<a class='line_bg' href='javascript:doCancel();'>견적 취소</a>";
									echo "</li>";
									echo "<li class='col-xs-6' style='border-left:0;'>";
									echo "<a class='main_bg' href='javascript:doModify();'>견적 수정</a>";
									echo "</li>";
									echo "</ul>";
								}
							}
						}
					?>
					</div>

					<div class="customer"  id="mobileInfo2">
						<h3>요청고객</h3>
					<?php
						/**/
						if(($state == "3" || $state == "8" || $state == "4" ||$state == "5")&&$selected == "1"){
							echo "<dl>";
							echo "<dt class='col-xs-1 main_co'>이름</td>";
							echo "<dd class='col-xs-11'>".$master['nickname']."</dd>";
							echo "<dt class='col-xs-1 main_co'>연락처</td>";
							echo "<dd class='col-xs-11'>".$master['phone']."</dd>";
							echo "<dt class='col-xs-1 main_co'>지역</td>";
							echo "<dd class='col-xs-11'>".$master['area1']." ".$master['area2']." ".$master['area3']."</dd>";
							echo "<dt class='col-xs-1 main_co'>층수</td>";
							echo "<dd class='col-xs-11'>".$master['elevator_yn']."/".$master['floor']."</dd>";
							if($master['attach_file']){
								echo "<dt class='col-xs-1 main_co'>파일</dt><dd class='col-xs-11'><a href='".G5_DATA_URL.'/estimate/'.$master['attach_file']."' style='height:17px;line-height:15px;'>다운로드</a></dd>";
							}
							echo "</dl>";
							/* echo "<a class='line_bg1' href='#!' onClick='doTel(\"".$master['phone']."\")')'>전화 하기</a>"; */
							/*echo "<a class='sub_bg' href='#!' onClick='doTel(\"".$master['phone']."\")'>전화하기</a>";*/ /*전화하기버튼이통*/
						}else{
							echo "<dl>";
							if($state == "1" && $master["meet"] && $master["meet_confirm"])
							{
								echo "<dt class='col-xs-1 main_co'>이름</td>";
								echo "<dd class='col-xs-11'>".$master['nickname']."</dd>";
								echo "<dt class='col-xs-1 main_co'>연락처</td>";
								echo "<dd class='col-xs-11'>".$master['phone']."</dd>";
								echo "<dt class='col-xs-1 main_co'>지역</td>";
								echo "<dd class='col-xs-11'>".$master['area1']." ".$master['area2']." ".$master['area3']."</dd>";
							}else{
								echo "<dt class='col-xs-1 main_co'>지역</td>";
								echo "<dd class='col-xs-11'>".$master['area1']." ".$master['area2']."</dd>";
							}
							echo "<dt class='col-xs-1 main_co'>층수</td>";
							echo "<dd class='col-xs-11'>".$master['elevator_yn']."/".$master['floor']."</dd>";
							if($master['attach_file']){
								echo "<dt class='col-xs-1 main_co'>파일</dt><dd class='col-xs-11'><a href='".G5_DATA_URL.'/estimate/'.$master['attach_file']."' style='height:17px;line-height:15px;'>다운로드</a></dd>";
							}
							echo "</dl>";
						}
						echo "<dt class='col-xs-1 main_co'>마감일</td>";
							echo "<dd class='col-xs-11'>".$master['deadline']."</dd>";
					?>
					<?php
						if($master['attach_file']){
							//echo "<dt class='col-xs-1 main_co'>파일</dt><dd class='col-xs-11'><a href='".G5_DATA_URL.'/estimate/'.$master['attach_file']."' style='height:17px;line-height:15px;'>다운로드</a></dd>";
							//echo "<a class='sub_bg1' href='#!' onClick='doTel(\"".$master['phone']."\")'></a>"; /*전화하기버튼이통 sub_bg로 클래스 변경시 */
							//echo "<a class='line_bg1' href='#!' onClick='doTel(\"".$master['phone']."\")')'>전화 하기</a>";
						}
					?>
					</div>

					<div class="warning" id="mobileWaring">
					<?php
						if($state == "2"){
							echo "<h1 class='text-center main_co'>고객이 업체 선택중 입니다.</h1>";
						}

						if(($state == "3" || $state == "8") && $selected == "1"){
							if($e_type == "2"){
								echo "<h3>주의사항</h3>";
								echo "<p>고객과 연락 후 철거일정 확정되면, 꼭 진행확정을 눌러주세요</p>";
								if($master['completetime']){
									
									echo "<a class='main_bg' href='#none'>진행확정됨</a>";
								}else{
									echo "<a class='line_bg' href='javascript:doChangeCompeteDate(\"2\");'>진행확정</a>";
								}
								echo '<a class="line_bg" href="javascript:doCancel_del();">철거 취소</a>';
                                echo "<a class='line_bg2' href='javascript:doCompleteEstimate(\"".$e_type."\")'>철거완료 하기</a>";
                                echo "<a class='line_bg1' href='#!' onClick='doTel(\"".$master['phone']."\")')'>전화 하기</a>";  /* 전화하기 버튼 0402*/
							}else{
								echo "<h3>주의사항</h3>";
								echo "<p>고객과 연락 후 수거일정 확정되면, 꼭 진행확정을 눌러주세요</p>";
								if(($state == "3" || $state == "8") && $selected == "1"){
							
										if($master['completetime']){
											
											echo "<a class='main_bg' href='#none'>진행확정됨</a>";
										}else{
											
											echo "<a class='line_bg' href='javascript:doChangeCompeteDate(\"1\");'>진행확정</a>";
										}
									
								}
								echo "<a class='line_bg' href='javascript:doCancel_del();'>수거 취소</a>";
                                echo "<a class='line_bg2' href='javascript:doCompleteEstimate(\"".$e_type."\")'>수거완료 하기</a>";
                                echo "<a class='line_bg1' href='#!' onClick='doTel(\"".$master['phone']."\")')'>전화 하기</a>";  /* 전화하기 버튼 0402*/
							}
						}
					?>
					
					</div>
				</div>
				
				<table class="web">
					<tr>
						<th class="photo">
							<ul id="view_slider">
							<?php
								$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
								$photo = sql_query($sql);
								for ($i=0; $row1=sql_fetch_array($photo); $i++) {
									echo '<li><a href="'.G5_DATA_URL.'/estimate/'.$row1['photo'].'" target="_blank">'.estimate_img_thumbnail($row1['photo'], 350, 350).'</a></li>';
								}
							?>
							</ul>
							<div class="pager_wrap">
								<ul id="bx-pager">
								<?php
									$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
									$photo = sql_query($sql);
									for ($i=0; $row1=sql_fetch_array($photo); $i++) {
										echo "<li><a data-slide-index='".$i."' href=''>".estimate_img_thumbnail($row1['photo'], 350, 350)."</a></li>";
									}
								?>
								</ul>
							</div>
						</th>
						<td class="info" id="mainTitle">
							<h1><?php echo get_etype($master['e_type']); ?></h1>
						<?php
							echo "<dl>";
							echo "<dt class='col-xs-3'>제목</dt><dd class='col-xs-9'>".$master['title']."</dd>";
							if(($state == "3" || $state == "4" ||$state == "5" ||$state == "8")&&$selected == "1")
							{
								echo "<dt class='col-xs-3'>고객</dt><dd class='col-xs-9'>".$master['nickname']."</dd>";
							}else{
								if($state == "1" && $master["meet"] && $master["meet_confirm"])
								{
									echo "<dt class='col-xs-3'>고객</dt><dd class='col-xs-9'>".$master['nickname']."</dd>";
								}else{
									echo "<dt class='col-xs-3'>고객</dt><dd class='col-xs-9'>".$master['nickname1']."</dd>";
								}

							}
							if($state == "1")
							{
								if($e_type == "0" || $e_type== "1"){
									echo "<dt class='col-xs-3'>내견적가</dt>";
									echo "<dd class='col-xs-9'>";
									if($master['price']){
										echo "<span class='ma'>매입</span>".display_estimate_price($master['price'], $master['meet']);
									}
									if($master['price_minus']){
										echo "<span class='pe'>폐기</span>".number_format($master['price_minus'])."원";
									}
									if($master['free'] == '1'){
										echo "<span class='ma'>매입</span>".display_estimate_price($master['price'], $master['meet']);
									}

									if($master["meet"]){
										echo '방문견적';
									}
									echo " </dd>";
								}

								if($e_type == "2"){
									echo "<dt class='col-xs-3'>내견적가</dt><dd class='col-xs-9'>".display_estimate_price($master['price'], $master['meet'])."</dd>";
								}
								
							}

							if($state == "2"){
								if($e_type != "2" && $master['price_minus'] > 0){
									echo "<dt class='col-xs-3'>폐기가격</dt><dd class='col-xs-9'>".number_format($master['price_minus'])."원&nbsp;&nbsp;* 고객이 업체 선택중 입니다.</dd>";
								}else{
									echo "<dt class='col-xs-3'>내견적가</dt>";
									echo "<dd class='col-xs-9'>";
									if($master['price']){
										echo "<span class='ma'>매입</span>".display_estimate_price($master['price'], $master['meet']);
									}
									if($master['price_minus']){
										echo "<span class='pe'>폐기</span>".number_format($master['price_minus'])."원";
									}
									if(!$master['price'] && !$master['price_minus'] && !$master["meet"]){
										echo "<span class='ma'>매입</span>".display_estimate_price($master['price'], $master['meet']);
									}
									echo "&nbsp;&nbsp;* 고객이 업체 선택중 입니다.</dd>";
								}
								
							}

							if(($state == "3" || $state == "4" ||$state == "5" ||$state == "8")&&$selected == "1")
							{
								echo "<dt class='col-xs-3'>지역</dt><dd class='col-xs-9'>".$master['area1']." ".$master['area2']." ".$master['area3']."</dd>";
								echo "<dt class='col-xs-3'>연락처</dt><dd class='col-xs-9'>".$master['phone']."</dd>";
							}else{
								if($state == "1" && $master["meet"] && $master["meet_confirm"]){
									echo "<dt class='col-xs-3'>지역</dt><dd class='col-xs-9'>".$master['area1']." ".$master['area2']." ".$master['area3']."</dd>";
									echo "<dt class='col-xs-3'>연락처</dt><dd class='col-xs-9'>".$master['phone']."</dd>";
								}else{
									echo "<dt class='col-xs-3'>지역</dt><dd class='col-xs-9'>".$master['area1']." ".$master['area2']."</dd>";
								}

							}

							echo "<dt class='col-xs-3'>층수</dt><dd class='col-xs-9'>".$master['elevator_yn']."/".$master['floor']."</dd>";

							if($selected != "1"){
								if($e_type == "2"){
									echo "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>".$master['pickup_date']."</dd>";
								}else{
									echo "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>".$master['pickup_date']."</dd>";
								}
							}

							if(($state == "3"||$state == "8") && $selected == "1"){
								echo "<dt class='col-xs-3'>선택견적가</dt>";
								if($e_type == "2"){
									echo "<dd class='col-xs-9'>".display_estimate_price($master['price'], $master['meet'])."</dd>";
									if($master['completetime']){
										echo "<dt class='col-xs-3'>철거확정일</dt><dd class='col-xs-9'>".$master['completetime']."</dd>";
									}else{
										echo "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>".$master['requesttime']."</dd>";
									}
								}else if($e_type == "1" || $e_type == "0"){

									echo "<dd class='col-xs-9'>";
									if($master['price'] || ($master['price']=="0" && !$master['price_minus'])){
										echo "<span class='ma'>매입</span>".display_estimate_price($master['price'], $master['meet']);
									}
									if($master['price_minus']){
										echo "<span class='pe'>폐기</span>".number_format($master['price_minus'])."원";
									}
									if($master["meet"]){
										echo '방문견적';
									}
									echo "</dd>";
									if($master['completetime']){
										echo "<dt class='col-xs-3'>수거확정일</dt><dd class='col-xs-9'>".$master['completetime']."</dd>";
									}else{
										echo "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>".$master['requesttime']."</dd>";
									}
								}
								
							}else if($state == "5" && $selected == "1"){
								if($e_type == "2"){
									echo "<dt class='col-xs-3'>내견적가</dt><dd class='col-xs-9'>".display_estimate_price($master['price'], $master['meet'])."</dd>";
									echo "<dt class='col-xs-3'>철거확정일</dt><dd class='col-xs-9'>".$master['completetime']."</dd>";
								}else{
									echo "<dt class='col-xs-3'>내견적가</dt><dd class='col-xs-9'>";

									if($master['price']){
										echo "<span class='ma'>매입</span>".display_estimate_price($master['price'], $master['meet']);
									}
									if($master['price_minus']){
										echo "<span class='pe'>폐기</span>".number_format($master['price_minus'])."원";
									}
									if(!$master['price'] && !$master['price_minus'] && !$master["meet"]){
										echo "<span class='ma'>매입</span>".display_estimate_price($master['price'], $master['meet']);
									}

									if($master["meet"]){
										echo '방문견적';
									}
									echo "</dd>";
									echo "<dt class='col-xs-3'>수거확정일</dt><dd class='col-xs-9'>".$master['completetime']."</dd>";
								}
							}
							echo "</dl>";
							?>
							<?php
								if($master['attach_file']){
									echo "<dt class='col-xs-3'>첨부파일</dt><dd class='col-xs-9'><a href='".G5_DATA_URL.'/estimate/'.$master['attach_file']."' style='height:23px;line-height:25px;'>다운로드</a></dd>";
								}
							?>
							<?php
							if($state == "1")
							{
								if($master["meet"]){
									if($e_type == "2"){
										echo "<ul class='row'>";
										echo "<li class='col-xs-6'>";
										echo "<a class='line_bg' href='javascript:'>방문중</a>";
										echo "</li>";
										echo "<li class='col-xs-6'>";
										echo "<a class='main_bg' href='javascript:doModifyPrice();'>견적 참여</a>";
										echo "</li>";
										echo "</ul>";
									}else{
										echo "<ul class='row'>";
										echo "<li class='col-xs-6'>";
										echo "<a class='line_bg' href='javascript:'>방문중</a>";
										echo "</li>";
										echo "<li class='col-xs-6'>";
										echo "<a class='main_bg' href='javascript:doModify();'>견적 참여</a>";
										echo "</li>";
										echo "</ul>";
									}
								}else{
									if($e_type == "2"){
										echo "<ul class='row'>";
										echo "<li class='col-xs-6'>";
										echo "<a class='line_bg' href='javascript:doCancel();'>견적 취소</a>";
										echo "</li>";
										echo "<li class='col-xs-6'>";
										echo "<a class='main_bg' href='javascript:doModifyPrice();'>견적확인/수정</a>";
										echo "</li>";
										echo "</ul>";
									}else{
										echo "<ul class='row'>";
										echo "<li class='col-xs-6'>";
										echo "<a class='line_bg' href='javascript:doCancel();'>견적 취소</a>";
										echo "</li>";
										echo "<li class='col-xs-6'>";
										echo "<a class='main_bg' href='javascript:doModify();'>견적 수정</a>";
										echo "</li>";
										echo "</ul>";
									}

								}
							}

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

						if(($state == "3"||$state == "8") && $selected == "1"){
							if($e_type == "2"){
								echo "<h3>주의사항</h3>";
								echo "<p>고객과 연락 후 철거일정 확정되면, 꼭 진행확정을 눌러주세요</p>";
								if($master['completetime']){
										echo "<a class='main_bg' href='#none'>진행확정됨</a>";
								}else{
									echo "<a class='main_bg' href='javascript:doChangeCompeteDate(\"2\");'>진행확정</a>";
								}
								echo "<a class='line_bg' href='javascript:doCancel_del();'>철거 취소</a>";
								echo "<a class='line_bg2' href='javascript:doCompleteEstimate(\"".$e_type."\") '>철거완료 하기</a>";
							}else{
								echo "<h3>주의사항</h3>";
								echo "<p>고객과 연락 후 수거일정 확정되면, 꼭 진행확정을 눌러주세요</p>";
								if(($state == "3"||$state == "8") && $selected == "1"){								
										if($master['completetime']){

											echo "<a class='main_bg' href='#none'>진행확정됨</a>";
										}else{
											
											echo "<a class='main_bg' href='javascript:doChangeCompeteDate(\"1\");'>진행확정</a>";
										}									
								}
								echo "<a class='main_bg' href='javascript:doCancel_del();'>수거 취소</a>";
								echo "<a class='main_bg' href='javascript:doCompleteEstimate(\"".$e_type."\")'>수거완료 하기</a>";
							}
						} ?>
						</div>
					</div>
					<div class="area_payInfo">

					

										

					<?php 
					if($selected == "1" && $e_type != "2" ){ ?>
						<style type="text/css">
							.pick_pay,.pick_pay2{border:1px solid #e0e0e0; box-shadow: -1px 1px 5px #e0e0e0;padding: 10px; border-radius: 10px;}
							.pick_pay h4, .pick_pay2 h4{margin-bottom: 20px;}
							@media(max-width: 768px){
								.pick_pay h4, .pick_pay2 h4, .pick_pay p , .pick_pay2 p {text-align: center;}
							}
							.pick_pay p + p, .pick_pay2 p + p{margin-top: 10px;}
							.pick_pay2{margin-top: 30px;}
						</style>
					<?php 
						if( $success['price']){
					?>
						<h1 class="tt" id="detailTitle" style="width: 100%;">고객계좌</h1>
		                <div>
					    	<div style="text-align: center;">
					    		<h3 style="margin-bottom: 20px;">진행 완료 후 고객께 계좌 또는 현금 지급해 주세요.</h3>
					    		<table>
					    			<tr>
					    				<td class="main_co">은행 : </td>
					    				<td><p style="margin: 10px 0;"><?php echo $cli_info['mb_bank']; ?></p></td>
					    			</tr>
					    			<tr>
					    				<td class="main_co">계좌번호 : </td>
					    				<td><p style="margin: 10px 0;"><?php echo $cli_info['mb_bank_num']; ?></p></td>
					    			</tr>
					    			<tr>
					    				<td class="main_co">예금주 : </td>
					    				<td><p style="margin: 10px 0;"><?php echo $cli_info['mb_bank_name']; ?></p></td>
					    			</tr>
					    		</table>
					    	</div>
					    </div>		
						<h1 class="tt" style="margin: 20px 0 10px">정산내역</h1>
					
						<div class="pick_pay">
							<h4 class="main_co">피커스 정산 내역</h4>
							<p style="padding: 5px 0;">최종 입금가: 
								<span class="main_co" style="font-weight: bold;"><?php
									if($cli_biz_info['mb_biz_charge_rate'] != 0){
										$price_amt = $success['price'] * ($cli_biz_info['mb_biz_charge_rate'] / 100);
										$last_price = $price_amt + ($price_amt / 10);
									}else{
										$last_price = $success['price'];
									}

									if($last_price == 0){
									 echo '무료수거';
									}else{
									 echo number_format(floor($last_price)) . '원';
									}
									?>
								</span>
							</p>
							<p>
							디휴브(천정훈)
							농협 302-1237-9285-41
							</p>
							<p>(수수료와 VAT 포함가)</p>
							<p style="margin-top: 30px;">진행 완료 후 <span class="main_co">피커스계좌로</span> 최종 입금가 <span class="main_co">입금</span> 부탁 드립니다.</p>
						</div>
					<?php } 
						if($success['price_minus']){ 
							if($e_type != '1' && !$success['price']){ ?>
								<h3 style="margin: 20px 0 10px">정산내역</h3>
							<?php } ?>
						<div class="pick_pay2">
							<h4 class="main_co">업체 정산 내역</h4>

							<p style="padding: 5px 0;">피커스 지급가: 
								<span class="main_co" style="font-weight: bold;"><?php
									if($cli_biz_info['mb_biz_charge_rate'] != 0){
										$price_amt = $success['price_minus'] * ($cli_biz_info['mb_biz_charge_rate'] / 100);
										$last_price = $success['price_minus'] - ($price_amt + ($price_amt / 10));
									}else{
										$last_price = $success['price_minus'];
									}
									 echo number_format(floor($last_price)) . '원<br/>';
									?>
								</span>
							</p>
							<p>(수수료와 VAT 포함가 제외 금액)</p>
							<p style="margin-top: 30px;">진행완료 후 <span class="main_co">업체계좌로</span> 정산일에 맞춰 <span class="main_co">입금</span> 됩니다.</p>
						</div>
					<?php } 
				} ?>
				</div>
				<h1 class="tt">상세정보</h1>

				<table class="requst_list" id="subDetail">
				<?php
					if($e_type == "0" || ($e_type == "2" && $detailCnt == 1 & $master['test_type'] != "B" )){
						echo "<colgroup>";
						echo "<col style='width: 20%' />";
						echo "<col style='width: 30%' />";
						echo "<col style='width: 20%' />";
						echo "<col style='width: 30%' />";
						echo "</colgroup>";
						if($e_type == "0"){
							echo "<tr>";
							echo "<th>품목</th><td>".$master['item_cat']." ".$master['item_cat_dtl']."</td>";
							echo "<th>제조사</th><td>".$master['manufacturer']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>모델명</th><td>".$master['medel_name']."</td>";
							echo "<th>연식</th><td>".$master['year']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>참고사항</th><td colspan='3'>".$master['content']."</td>";
							echo "</tr>";
						}else{
							echo "<tr>";
							echo "<th>철거종류</th><td>".$detail['pull_kind']."</td>";
							echo "<th>천장/바닥 철거</th><td>".$detail['pull_floor_bottom']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>철거평수</th><td>".$detail['pull_space']."</td>";
							echo "<th>철거사이즈</th><td>".$detail['pull_size']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>참고사항</th><td colspan='3'>".$master['content']."</td>";
							echo "</tr>";
						}
					}

					if($master['test_type'] == "B"){
						if($e_type == "2"){
							$pull_kind_etc = "";
							if($master['pull_kind_etc']){
								$pull_kind_etc = ','.$master['pull_kind_etc'];
							}
							echo "<tr>";
							echo "<th>철거종류</th><td>".$master['pull_kind'].$pull_kind_etc."</td>";
							echo "<th>천장/바닥 철거</th><td>".$master['pull_floor_bottom']."</td>";
							echo "</tr>";
						}
						if($e_type == "1" || $e_type == "2"){
							echo "<tr>";
							echo "<th>참고사항</th><td colspan='3'>".$master['content']."</td>";
							echo "</tr>";
							
						}
					}
				?>
				</table>

				<table class="requst_list02" id="subList">
				<?php
					if(($e_type == "1" || ($e_type == "2" && $detailCnt > 1)) && $master['test_type'] != "B"){
						if($e_type == "1"){
							echo "<colgroup class='web_col'>";
							echo "<col style='width: 10%' />";
							echo "<col style='width: 20%' />";
							echo "<col style='width: 20%' />";
							echo "<col style='width: 20%' />";
							echo "<col style='width: 15%' />";
							echo "<col style='width: 15%' />";
							echo "</colgroup>";
							echo "<tr>";
							echo "<th class='web_td'>품목</th>";
							echo "<th>세부카테고리</th>";
							echo "<th>제조사</th>";
							echo "<th>모델명</th>";
							echo "<th>년식</th>";
							echo "<th>수량</th>";
							echo "</tr>";
							for ($i=0; $row=sql_fetch_array($detail); $i++) {
								echo "<tr>";
								echo "<td class='web_td'>".$row['item_cat']."</td>";
								echo "<td>".$row['item_cat_dtl']."</td>";
								echo "<td>".$row['manufacturer']."</td>";
								echo "<td>".$row['medel_name']."</td>";
								echo "<td>".$row['year']."</td>";
								echo "<td>".$row['item_qty']."</td>";
								echo "</tr>";
							}
							echo "<tr>";
							echo "<th>참고사항</th>";
							echo "<td class='web_td' colspan='5'>".$master['content']."</td>";
							echo "<td class='mob_td' colspan='4'>".$master['content']."</td>";
							echo "</tr>";
						}else{
							echo "<colgroup>";
							echo "<col style='width: 30%' />";
							echo "<col style='width: 30%' />";
							echo "<col style='width: 20%' />";
							echo "<col style='width: 20%' />";
							echo "</colgroup>";
							echo "<tr>";
							echo "<th>철거종류</th>";
							echo "<th>천장/바닥 철거 유뮤</th>";
							echo "<th>철거평수</th>";
							echo "<th>철거사이즈</th>";
							echo "</tr>";
							for ($i=0; $row=sql_fetch_array($detail); $i++) {
								echo "<tr>";
								echo "<td>".$row['pull_kind']."</td>";
								echo "<td>".$row['pull_floor_bottom']."</td>";
								echo "<td>".$row['pull_space']."</td>";
								echo "<td>".$row['pull_size']."</td>";
								echo "</tr>";
							}
							echo "<tr>";
							echo "<th>참고사항</th>";
							echo "<td colspan='3'>".$master['content']."</td>";
							echo "</tr>";
						}
					}
				?>
				</table>
				<?php
					/*
					$sql = " select count(*) as cnt from {$g5['estimate_propose']} where estimate_idx = '$idx' and ifnull(content) != '' ";
					$request_cnt = sql_fetch($sql);
					if($request_cnt['cnt'] > 0){
						$sql = " select * where estimate_idx = '$idx' and ifnull(content) != '' ";
						$request_list = sql_query($sql);
						echo '<div class="text_note">';
						echo '<h1>업체 견적 참고사항</h1>';
						for ($i=0; $row=sql_fetch_array($request_list); $i++) {
							if($row['rc_email'] == $member['mb_email']){
								echo '<p>'.$row['rc_nickname'].' - '.$row['content'].'</p>';
							}
						}
						echo '</div>';
					}
					*/

					$sql = " select * from {$g5['estimate_propose']} where estimate_idx = '{$master['idx']}' and ifnull(content,'') != '' and rc_email = '{$member['mb_email']}' ";
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
						$sql1 = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' order by idx limit 1 ";
						$photo = sql_fetch($sql1);
						$score = $propose_review['score'];
						echo "<h1 class='tt'>고객후기</h1>";
						echo "<table class='re_view'>";
						echo "<colgroup class='web_col'>";
						echo "<col style='width: 15%' />";
						echo "<col style='width: 85%' />";
						echo "</colgroup>";
						echo "<tr>";
						if($propose_review['photo1']){
							echo "<th>".estimate_img_thumbnail($propose_review['photo1'], 100, 100)."</th>";
						}else{
								echo "<th>".estimate_img_thumbnail($photo['photo'], 100, 100)."</th>";
						}
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
						echo "<div class='date'>작성자 : ".$propose_review['nickname']." ㅣ 등록일 : ".$propose_review['completetime']."</div>";
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
<div class="modal fade" id="modal_confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="tit_modal">
					<p class="main_co" style="text-align: center;">비용이 변경되셨습니까?</p>
				</div>
				<div class="form-group" style="text-align: center;">
					<button style="border:1px solid #ccc; padding: 5px; width: 80px; margin-right: 10px; " id="yes_change">예</button>
					<button style="border:1px solid #ccc; padding: 5px;  width: 80px; " id="no_change">아니요</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_price" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<form name="frmprice" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_price_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="idx" value="<?php echo $idx; ?>">
				<input type="hidden" name="sub_idx" value="<?php echo $master['sub_idx']; ?>">
				<input type="hidden" name="chk_free" value="0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="tit_modal">
					<p class="main_co">희망 견적가격을 입력하세요</p>
				</div>	
				<?php if($e_type == "0"){ ?>
				<style type="text/css">
					.sell_price{display: none;}
				</style>
				<div class="form-group">
					<ul class="row">
						<li class="col-xs-6">
							<label style="width: 100%;" class="box">
								<input type="radio" checked="" id="buy" name="sell" value="0" ><i><p>매입</p></i></label>
						</li>
						<li class="col-xs-6">
							<label style="width: 100%;" class="box">
								<input type="radio" id="sell" name="sell" value="1" ><i><p>폐기</p></i></label>
						</li>
						<p id="desc_pe" style="font-size: 13px; margin-top: 5px; text-align: right;">매입 및 무료수거 불가 할 시에만 폐기 견적을 넣어주세요.</p>
					</ul>
				</div>
				<?php } ?>
				<div class="form-group buy_price">
					<ul class="row">
						<li class="col-xs-3 title">
							매입가
						</li>
						<li class="col-xs-9">
							<input type="text" class="input_default" id="price" name="price">
						</li>
					</ul>
				</div>
				<div class="form-group sell_price">
					<ul class="row">
						<li class="col-xs-3 title">
							폐기가
						</li>
						<li class="col-xs-9">
							<input type="text" class="input_default" id="price_pe" name="price_pe">
							<?php if($e_type=="1") {?>
							<p id="desc" style="font-size: 13px; margin-top: 5px; text-align: right;">매입만, 폐기만 각각 따로 또는 함께 견적이 가능합니다.</p>
						<?php } ?>
						</li>
					</ul>
				</div>
				<div class="form-group">
					<ul class="row">
						<li class="col-xs-3 title">
							참고사항
						</li>
						<li class="col-xs-9">
							<textarea id="content" name="content" placeholder="견적내역에 대해 고객이 참고할 사항이 있으면 함께 작성해 주세요."></textarea>
						</li>
					</ul>
				</div>
				</form>
				<div class="btn_wrap">
					<ul class="row">
					<?php
						if($master['e_type'] == "1"){
					?>
					  <li class="col-xs-12">
						<div class="box-file-input">
							<label>
								<input type="file" id="attach_file1" name="attfile" class="file-input" accept="image/*">
							</label>
							<span id="attfilename1" class="filename">파일을 선택해주세요.</span>
						</div>
					 </li>
					<?php
						}
					?>						
						<li class="col-xs-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						<li class="col-xs-4"><a href="javascript:doPriceZero()" class="sub_bg">무료수거</a></li>
						<li class="col-xs-4"><a href="javascript:doSave()" class="main_bg">확인</a></li>
					</ul>
				</div>

			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 선택 -->

<div class="modal fade" id="modal_price_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<form name="frmprice_update" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_price_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="idx" value="<?php echo $idx; ?>">
				<input type="hidden" name="sub_idx" value="<?php echo $master['sub_idx']; ?>">
				<input type="hidden" name="chk_update" value="1">
				<input type="hidden" name="chk_free" value="0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="tit_modal">
					<p class="main_co">변경된 견적가격을 입력하세요</p>
				</div>	
				<?php if($e_type == "0"){ ?>
				<style type="text/css">
					.sell_price_update{display: none;}
				</style>
				<div class="form-group">
					<ul class="row">
						<li class="col-xs-6">
							<label style="width: 100%;" class="box">
								<input type="radio" checked="" id="buy_update" name="sell_update" value="0" ><i><p>매입</p></i></label>
						</li>
						<li class="col-xs-6">
							<label style="width: 100%;" class="box">
								<input type="radio" id="sell_update" name="sell_update" value="1" ><i><p>폐기</p></i></label>
						</li>
						<p id="desc_pe" style="font-size: 13px; margin-top: 5px; text-align: right;">매입 및 무료수거 불가 할 시에만 폐기 견적을 넣어주세요.</p>
					</ul>
				</div>
				<?php } ?>
				<div class="form-group buy_price_update">
					<ul class="row">
						<li class="col-xs-3 title">
							매입가
						</li>
						<li class="col-xs-9">
							<input type="text" class="input_default" id="price_update" name="price">
						</li>
					</ul>
				</div>
				<div class="form-group sell_price_update">
					<ul class="row">
						<li class="col-xs-3 title">
							폐기가
						</li>
						<li class="col-xs-9">
							<input type="text" class="input_default" id="price_pe_update" name="price_pe">
						</li>
					</ul>
				</div>
				</form>
				<div class="btn_wrap">
					<ul class="row">
						<li class="col-xs-6"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						<li class="col-xs-6"><a href="javascript:doSave_update()" class="main_bg">확인</a></li>
					</ul>
				</div>

			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 선택 -->
<div class="modal fade" id="modal_price_update_end" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<form name="frmprice_update_end" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_price_update_end.php" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="idx" value="<?php echo $idx; ?>">
				<input type="hidden" name="sub_idx" value="<?php echo $master['sub_idx']; ?>">
				<input type="hidden" id="state" name="state" value="5">
				<input type="hidden" id="completetime" name="completetime" value="<?php echo $master['completetime'];?>">
				<input type="hidden" id="completedate" name="completedate" value="<?php echo $master['completedate'];?>">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="tit_modal">
					<p class="main_co">최종 변경된 견적가격을 입력하세요</p>
				</div>	
				<?php if($e_type == "0"){ ?>
				<style type="text/css">
					.sell_price_update_end{display: none;}
				</style>
				<div class="form-group">
					<ul class="row">
						<li class="col-xs-6">
							<label style="width: 100%;" class="box">
								<input type="radio" checked="" id="buy_update_end" name="sell_update_end" value="0" ><i><p>매입</p></i></label>
						</li>
						<li class="col-xs-6">
							<label style="width: 100%;" class="box">
								<input type="radio" id="sell_update_end" name="sell_update_end" value="1" ><i><p>폐기</p></i></label>
						</li>
						<p id="desc_pe" style="font-size: 13px; margin-top: 5px; text-align: right;">매입 및 무료수거 불가 할 시에만 폐기 견적을 넣어주세요.</p>
					</ul>
				</div>
				<?php } ?>
				<div class="form-group buy_price_update_end">
					<ul class="row">
						<li class="col-xs-3 title">
							매입가
						</li>
						<li class="col-xs-9">
							<input type="text" class="input_default" id="price_update_end" name="price">
						</li>
					</ul>
				</div>
				<div class="form-group sell_price_update_end">
					<ul class="row">
						<li class="col-xs-3 title">
							폐기가
						</li>
						<li class="col-xs-9">
							<input type="text" class="input_default" id="price_pe_update_end" name="price_pe">
						</li>
					</ul>
				</div>
				</form>
				<div class="btn_wrap">
					<ul class="row">
						<li class="col-xs-6"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						<li class="col-xs-6"><a href="javascript:doSave_update_end()" class="main_bg">확인</a></li>
					</ul>
				</div>

			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 선택 -->
<div class="modal fade modal_table" id="modal_price_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">상세견적서</h4>
			</div>
			<div class="modal-body">
				<form name="frmpricedetail" id="frmpricedetail" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_price_detail_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
				</form>

				<div class="btn_wrap">
					<ul class="row">
						<li class="col-xs-6"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						<li class="col-xs-6"><a href="javascript:doSavePrice()" class="main_bg">확인</a></li>
					</ul>
				</div>
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
					<p>* 확정일자를 입력하세요</p>
				</div>
				<form name="frmcompletedate" id="frmcompletedate" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_complete_date_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="idx" value="<?php echo $idx; ?>">
				<input type="hidden" name="sub_idx" value="<?php echo $master['sub_idx']; ?>">
				<div class="form-group">
					<ul class="row" style="margin: 15px 0; padding: 15px 0;">
						<li class="col-xs-3 title">
							확정일자
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
<!-- 철거완료 하기 -->
<div class='modal fade' id='modal_complete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<h4 class='modal-title' id='myModalLabel'>철거완료</h4>
			</div>
			<div class='modal-body'>
				<form name="frmcomplete2" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_complete_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" id="idx"  name="idx" value="<?php echo $master['idx']; ?>">
					<input type="hidden" id="sub_idx" name="sub_idx" value="<?php echo $master['sub_idx']; ?>">
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
					<div class='form-group last_chul'>
						<ul class='row'>
							<li class="col-xs-3 title">
								최종 진행비용
							</li>
							<li class="col-xs-9">
								<input type="number" name="last_price_chul" id="last_price_chul">
							</li>
						</ul>
					</div>
					<div class='btn_wrap'>
						<ul class='row'>
							<li class='col-xs-6'><a style="margin: 0;" class='line_bg' href='#' data-dismiss='modal'>닫기</a></li>
							<li class='col-xs-6' ><input style="margin-top: 0;" class='main_bg' type='button' value='확인' onClick="doSaveComplete();"></li>
						</ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</div><!-- 철거완료 비용변경 있음 -->
<div class='modal fade' id='modal_upload' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<h4 class='modal-title' id='myModalLabel'>첨부파일</h4>
			</div>
			<div class='modal-body'>
				<form name="frmupload" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_file_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" id="idx"  name="idx" value="<?php echo $master['idx']; ?>">
					<input type="hidden" id="sub_idx" name="sub_idx" value="<?php echo $master['sub_idx']; ?>">
					<div class='form-group'>
						<ul class="row">
							<li class="col-xs-3 title">
								첨부파일
							</li>
							<li class="col-xs-9">
								<input type="file" id="attfile" name="attfile" style="opacity:1;widht:100%;height:40px;font-size:1em;position:relative;padding:0"/>
							</li>
						</ul>

					</div>

					<div class='btn_wrap'>
						<ul class='row'>
							<li class='col-xs-6'><a class='line_bg' href='#' data-dismiss='modal'>닫기</a></li>
							<li class='col-xs-6'><input class='main_bg' type='button' value='확인' onClick="doSaveUpload();"></li>
						</ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</div><!-- 철거완료 하기 -->
<form name="frmcancel" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_update_cancel.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="idx"  name="idx" value="<?php echo $master['idx']; ?>">
	<input type="hidden" id="sub_idx" name="sub_idx" value="<?php echo $master['sub_idx']; ?>">
	<input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
</form>
<form name="frmcancel_del" id="frmcancel_del" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_update_cancel.php" method="post" enctype="multipart/form-data" autocomplete="off" style="display: none;">
	<input type="hidden" id="idx"  name="idx" value="<?php echo $master['idx']; ?>">
	<input type="hidden" id="sub_idx" name="sub_idx" value="<?php echo $master['sub_idx']; ?>">
	<input type="hidden" id="title" name="title" value="<?php echo $master['title']; ?>">
	<input type="hidden" id="mb_name" name="mb_name" value="<?php echo $member['mb_name'] ?>">
	<input type="hidden" id="rc_email" name="rc_email" value="<?php echo $member['mb_email'] ?>">
	<input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
	<div style="position: absolute; top: 50%; left: 50%; padding: 20px; background-color: #fff; border:1px solid #ddd; transform: translate(-50%, -50%);">
		<textarea name="reason" id="reason" style="background-color: #fff; border-radius: 1px solid #ddd;" required="" placeholder="취소사유를 말해주세요"></textarea>
		<input style="background-color: #ff1616; color: #fff; margin-top: 15px;" type="submit" name="" value="취소하기">
	</div>
</form>
<form name="frmcomplete1" action="<?php echo G5_URL; ?>/estimate/partner_estimate_form_complete_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="idx"  name="idx" value="<?php echo $master['idx']; ?>">
	<input type="hidden" id="sub_idx" name="sub_idx" value="<?php echo $master['sub_idx']; ?>">
	<input type="hidden" id="state" name="state" value="5">
	<input type="hidden" id="completetime" name="completetime" value="<?php echo $master['completetime'];?>">
	<input type="hidden" id="completedate" name="completedate" value="<?php echo $master['completedate'];?>">
	<input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
</form>

<script type="text/javascript" src="/share/js/jquery.bxslider.js"></script>
<script>
jQuery(document).ready(function(){
	$('#view_slider').bxSlider({
		auto: false,					// 자동 슬라이드 사용여부
		controls: false,				// 양옆컨트롤(prev/next) 사용여부
		speed: 1000,
		preloadImages: 'all',
		pager : true,
		pagerCustom:'#bx-pager',
		touchEnabled : true
	});

	$('#bx-pager').bxSlider({
		minSlides : 5,
		maxSlides : 5,
		slideWidth : 200,
		slideMargin : 5,
		controls: true,
		pager : false,
		touchEnabled : true
	});
/*
	$('#mob_view_slider').bxSlider({
		auto: false,				
		controls: true,				
		speed: 1000,
		preloadImages: 'all',
		pager : false,
		oneToOneTouch : false
	});*/

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
	var now = new Date();

	var Year = now.getFullYear();

	var Month   = now.getMonth()+1;
	if(Month < 10) Month = "0"+Month

	var Day   = now.getDate();
	if(Day < 10) Day = "0"+Day

	var toDate = Year +"-" + Month + "-"+ Day;

	var date = $.datepicker.parseDate( "yy-mm-dd", toDate );
	$( "#change_complete_time" ).datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr",
		//minDate:getDateAsValue(data.master.requesttime)
		minDate:date
	});
	$("#attach_file1").bind('change', function() {
		$("#attfilename1").html(this.files[0].name);
	});

	$("#attach_file2").bind('change', function() {
		$("#attfilename2").html(this.files[0].name);
	});		
	$('input[type=radio][name=sell]').change(function() {
	    if (this.value == '0') {
	        $('.buy_price').css('display','block');
	        $('.sell_price').css('display','none');
	        $('#desc_pe').css('display','none');
	        $("#price").val('');
	        $("#price_pe").val('');
	    }
	    else if (this.value == '1') {
	        $('.buy_price').css('display','none');
	        $('.sell_price').css('display','block');
	        $('#desc_pe').css('display','block');
	        $("#price").val('');
	        $("#price_pe").val('');
	    }
	});

	$('input[type=radio][name=sell_update]').change(function() {
	    if (this.value == '0') {
	        $('.buy_price_update').css('display','block');
	        $('.sell_price_update').css('display','none');
	    }
	    else if (this.value == '1') {
	        $('.buy_price_update').css('display','none');
	        $('.sell_price_update').css('display','block');
	    }
	});
	$('input[type=radio][name=sell_update_end]').change(function() {
	    if (this.value == '0') {
	    	$("#price_update_end").val('');
	    	$("#price_pe_update_end").val('');

	        $('.buy_price_update_end').css('display','block');
	        $('.sell_price_update_end').css('display','none');
	    }
	    else if (this.value == '1') {
	    	$("#price_update_end").val('');
	    	$("#price_pe_update_end").val('');
	        $('.buy_price_update_end').css('display','none');
	        $('.sell_price_update_end').css('display','block');
	    }
	});
	$("#view_slider a").lightbox();
	$("#mob_view_slider a").lightbox();

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

function doCancel_del()
{
	if(confirm("취소하시겠습니까?")){
		$('#frmcancel_del').show();
	}
}

function doCancel()
{
	if(confirm("견적을 취소하시겠습니까?")){
		var f = document.frmcancel;
		f.submit();
	}
}

function doModify()
{
	$('#modal_price').modal();
}

function doPriceZero()
{
	var f = document.frmprice;
	f.price.value = "0"	;
	f.chk_free.value = "1";
	f.submit();
}

function doSave()
{
	var f = document.frmprice;
	
	if( $(".sell_price").is(':visible') && $(".buy_price").is(':visible') == false ){
		if(!cfnNullCheckInput($("#price_pe").val(), "폐기가")) return;
	}
	if( $(".sell_price").is(':visible') == false && $(".buy_price").is(':visible') ){
		if(!cfnNullCheckInput($("#price").val(), "매입가")) return;
	}

	f.submit();
}

function doSave_update()
{
	var f = document.frmprice_update;
	
	if( $(".sell_price_update").is(':visible') && $(".buy_price_update").is(':visible') == false ){
		if(!cfnNullCheckInput($("#price_pe_update").val(), "폐기가")) return;
	}
	if( $(".sell_price").is(':visible') == false && $(".buy_price").is(':visible') ){
		if(!cfnNullCheckInput($("#price_update").val(), "매입가")) return;
	}

	f.submit();
}
function doSave_update_end()
{
	var f = document.frmprice_update_end;
	
	if( $(".sell_price_update_end").is(':visible') && $(".buy_price_update_end").is(':visible') == false ){
		if(!cfnNullCheckInput($("#price_pe_update_end").val(), "폐기가")) return;
	}
	if( $(".sell_price_update_end").is(':visible') == false && $(".buy_price_update_end").is(':visible') ){
		if(!cfnNullCheckInput($("#price_update_end").val(), "매입가")) return;
	}

	f.submit();
}
function doModifyPrice()
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.price.input.modal.php",
        data: {
        	idx:"<?php echo $master['idx']; ?>",
        	rc_email:"<?php echo $member['mb_email']; ?>"
        },
        cache: false,
        success: function(data) {
			$("#frmpricedetail").html(data);

			$("#modal_price_detail").modal();
        }
    });
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
		$("#divCompleteDate").html("수거확정일자");
		$("#divCompleteDateConetent").html("* 수거확정일자를 입력하세요");
	}else{
		$("#divCompleteDate").html("철거확정일자");
		$("#divCompleteDateConetent").html("* 철거확정일자를 입력하세요");
	}
	$('#modal_completeDate').modal();
}

function doSaveCompleteDate()
{
	var f = document.frmcompletedate;
	if(!cfnNullCheckInput($("#change_complete_time").val(), "확정일자")) return;
	f.submit();
}

function doCompleteEstimate(eType)
{
	if(eType == "2")
	{
		if(!confirm("철거완료하시겠습니까?")) return;

			$("#modal_confirm").modal();

			$("#yes_change").click(function(){
				$(".last_chul").css('display','block');
				$('#modal_complete').modal();
		        
		        for(var i=1; i<=6; i++)
				{
					var vComp    = "photo"+i;
					var vDivComp = "divPhoto"+i;
					var vText    = "사진파일 업로드";

					doInitImageAjax(vComp, vDivComp, vText);
				}
			});

			$("#no_change").click(function(){
				$(".last_chul").css('display','none');
				$('#modal_complete').modal();

				for(var i=1; i<=6; i++)
				{
					var vComp    = "photo"+i;
					var vDivComp = "divPhoto"+i;
					var vText    = "사진파일 업로드";

					doInitImageAjax(vComp, vDivComp, vText);
				}
			});
			/*if(confirm("비용이 변경되었습니까?")){

				

			}else{
				$(".last_chul").css('display','none');
				$('#modal_complete').modal();


				for(var i=1; i<=6; i++)
				{
					var vComp    = "photo"+i;
					var vDivComp = "divPhoto"+i;
					var vText    = "사진파일 업로드";

					doInitImageAjax(vComp, vDivComp, vText);
				}
			}*/
	
	}else{
		if(!confirm("수거완료하시겠습니까?")) return;
		
		$("#modal_confirm").modal();

		$("#yes_change").click(function(){
			$("#modal_price_update_end").modal();
		});

		$("#no_change").click(function(){
			var f = document.frmcomplete1;
			if(!f.completetime.value){
				f.completetime.value = f.completedate.value;
			}
			f.submit();	
		});

		/*if(confirm("비용이 변경되었습니까?")){
			$("#modal_price_update_end").modal();
		}else{
			var f = document.frmcomplete1;
			if(!f.completetime.value){
				f.completetime.value = f.completedate.value;
			}
			f.submit();	
		}*/
		
	}

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

	if($(".last_chul").is(':visible')){
		if(!cfnNullCheckInput($("#last_price_chul").val(), "최종 진행비용")) return;
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
<script type="text/javascript" src="/js/swiper.min.js"></script>
<script>
var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
     navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
</script>
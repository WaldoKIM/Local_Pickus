<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$sql = " select a.*, concat(substr(nickname,1,1),'**') as nickname1, concat('<p>',replace(a.content,'\n','</p><p>'),'</p>') as content1  from {$g5['estimate_list']} a where idx =  '$idx'	 ";

$master = sql_fetch($sql);

if($master['sub_key'] !='0'){
	$sql = " select count(*) as cnt from {$g5['estimate_list_multi']} where sub_key = '{$master['sub_key']}'  ";
	$detail_cnt = sql_fetch($sql);
	$detailCnt = $detail_cnt['cnt'];
	$sql = " select * from {$g5['estimate_list_multi']} where sub_key = '{$master['sub_key']}'  ";
	if($detail_cnt['cnt'] == 1 && $master['e_type'] == "2"){
		$detail = sql_fetch($sql);
	}else{
		$detail = sql_query($sql);
	}
}

$e_type = $master['e_type'];

$request_yn = "N";
$sql = " select * from {$g5['estimate_request']} a where estimate_idx =  '$idx' and rc_email = '{$member['mb_email']}' ";

$er = sql_fetch($sql);
if($er){
	$request_yn = "Y";
}

?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/share/css/jquery.bxslider.css"/>
<div class="sub_title">
	<h1 class="main_co">견적현황</h1>
</div><!-- sub_title -->
<div class="member com_pd">
	<div class="container">

		<div id="board">
			<div class="view">

				<div class="mob">
					<div class="mob_slider">
						<ul id="mob_view_slider">
							<?php
								$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
								$photo = sql_query($sql);
								for ($i=0; $row1=sql_fetch_array($photo); $i++) {
									echo '<li><a href="'.G5_DATA_URL.'/estimate/'.$row1['photo'].'" target="_blank">'.estimate_img_thumbnail($row1['photo'], 350, 350).'</a></li>';
								}
							?>
						</ul>
						<div class="text" id="mobileEtype"><?php echo get_etype($master['e_type']);?></div>
					</div>

					<div class="text-center mob_ing" id="mobileStatus">
						<?php echo get_estimate_mobile_state_tag($master['state']);?>
					</div>


					<div class="mob_info">
						<ul class="row"  id="mobileInfo1">
						<?php
						echo "<li class='col-xs-6'>";
						if($master['e_type'] == "2"){
							echo "<p class='text-center main_co'><i class='xi-calendar-check'></i> 철거요청일</p>";
						}else{
							echo "<p class='text-center main_co'><i class='xi-calendar-check'></i> 수거요청일</p>";
						}
						echo "<p class='text-center'>".$master['pickup_date']."</p>";
						echo "</li>";
						echo "<li class='col-xs-6'>";
						echo "<p class='text-center main_co'><i class='xi-money'></i> 내견적가</p>";
						echo "<p class='text-center'>견적에 참여하세요</p>";
						echo "</li>";
					?>
						</ul>
					</div>

					<div class="customer"  id="mobileInfo2">
						<?php
							echo "<dt class='col-xs-1 main_co'>지역</dt>";
							echo "<dd class='col-xs-11'>".$master['area1']." ".$master['area2']."</dd>";
							echo "<dt class='col-xs-1 main_co'>층수</dt>";
							echo "<dd class='col-xs-11'>".$master['elevator_yn']."/".$master['floor']."</dd>";
						?>
						<?php
							if($master['attach_file']){
								echo "<dt class='col-xs-1 main_co'>파일</dt><dd class='col-xs-11'><a href='".G5_DATA_URL.'/estimate/'.$master['attach_file']."' style='height:23px;line-height:25px;'>다운로드</a></dd>";
							}
						?>
					</div>

					<div class="customer" id="mobileButton">
						<?php
							if($master['e_type'] == "2"){
								echo "<ul class='row'>";
								echo "<li class='col-xs-6'>";
								echo "<a class='main_bg' href='javascript:doMeet()'>방문견적</a>";
								echo "</li>";
								echo "<li class='col-xs-6'>";
								echo "<a class='main_bg' href='javascript:doPriceDetail()'>견적 참여하기</a>";
								echo "</li>";
								echo "</ul>";
							}else{
								echo "<ul class='row'>";
								echo "<li class='col-xs-6'>";
								if($master['e_type'] == "1"){
									echo "<a class='main_bg' href='javascript:doMeet()'>방문견적</a>";
								}
								echo "</li>";
								echo "<li class='col-xs-6'>";
								echo "<a class='main_bg' href='javascript:doPrice()'>견적 참여하기</a>";
								echo "</li>";
								echo "</ul>";
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
									echo '<li>'.estimate_img_thumbnail($row1['photo'], 350, 350).'</li>';
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
							<dl>
								<dt class="col-xs-3">제목</dt><dd class="col-xs-9"><?php echo $master['title']; ?></dd>
								<dt class="col-xs-3">고객</dt><dd class="col-xs-9"><?php echo $master['nickname1']; ?></dd>
								<dt class="col-xs-3">지역</dt><dd class="col-xs-9"><?php echo $master['area1']; ?> <?php echo $master['area2']; ?></dd>
								<dt class="col-xs-3">층수</dt><dd class="col-xs-9"><?php echo $master['elevator_yn']; ?>/<?php echo $master['floor']; ?></dd>
							<?php
								if($e_type == "2"){
									echo "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>".$master['pickup_date']."</dd>";
								}else{
									echo "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>".$master['pickup_date']."</dd>";
								}
							?>
							</dl>
							<?php
								if($master['attach_file']){
									echo "<dt class='col-xs-3'>첨부파일</dt><dd class='col-xs-9'><a href='".G5_DATA_URL.'/estimate/'.$master['attach_file']."' style='height:23px;line-height:25px;'>다운로드</a></dd>";
								}
							?>
							<?php
								if($master['e_type'] == "2"){
									echo "<ul class='row'>";
									echo "<li class='col-xs-6'>";
									echo "<a class='main_bg' href='javascript:doMeet()'>방문견적</a>";
									echo "</li>";
									echo "<li class='col-xs-6'>";
									echo "<a class='main_bg' href='javascript:doPriceDetail()'>견적 참여하기</a>";
									echo "</li>";
									echo "</ul>";
								}else{
									echo "<ul class='row'>";
									echo "<li class='col-xs-6'>";
									if($master['e_type'] == "1"){
										echo "<a class='main_bg' href='javascript:doMeet()'>방문견적</a>";
									}
									echo "</li>";
									echo "<li class='col-xs-6'>";
									echo "<a class='main_bg' href='javascript:doPrice()'>견적 참여하기</a>";
									echo "</li>";
									echo "</ul>";
								}
							?>
						</td>
					</tr>
				</table>

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
							echo "<th>참고사항</th><td colspan='3'>".$master['content1']."</td>";
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
							echo "<th>참고사항</th><td colspan='3'>".$master['content1']."</td>";
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
							echo "<th>참고사항</th><td colspan='3'>".$master['content1']."</td>";
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
							echo "<td class='web_td' colspan='5'>".$master['content1']."</td>";
							echo "<td class='mob_td' colspan='4'>".$master['content1']."</td>";
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
							echo "<td colspan='3'>".$master['content1']."</td>";
							echo "</tr>";
						}
					}
				?>
				</table>
				<?php
					$sql = " select count(*) as cnt from {$g5['estimate_propose']} where estimate_idx = '$idx' and ifnull(content) != '' ";
					$request_cnt = sql_fetch($sql);
					if($request_cnt['cnt'] > 0){
						$sql = " select * where estimate_idx = '$idx' and ifnull(content) != '' ";
						$request_list = sql_query($sql);
						echo '<div class="text_note">';
						echo '<h1>업체 견적 참고사항</h1>';
						for ($i=0; $row=sql_fetch_array($request_list); $i++) {
							echo '<p>'.$row['rc_nickname'].' - '.$row['content'].'</p>';
						}
						echo '</div>';
					}
				?>
			</div><!-- view -->

			<div class="btn_wrap">
				<ul class="row">
					<li class="col-xs-3 col-xs-offset-9 col-md-1 col-md-offset-11">
						<a class="main_bg" href="./estimate_list2.php">리스트</a>
					</li>
				</ul>
			</div>

		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->


<div class="modal fade" id="modal_price" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<form name="frmprice" action="<?php echo G5_URL; ?>/estimate/estimate_form_price_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="idx" value="<?php echo $idx; ?>">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div>
					<p>* 희망 견적가격을 입력하세요</p>
				</div>
				<div class="form-group">
					<ul class="row">
						<li class="col-xs-3 title">
							견적가격
						</li>
						<li class="col-xs-9">
							<input type="text" class="input_default" id="price" name="price">
						</li>
					</ul>
				</div>
				<div class="form-group">
					<ul class="row">
						<li class="col-xs-3 title">
							참고사항
						</li>
						<li class="col-xs-9">
							<textarea id="content" name="content"></textarea>
						</li>
					</ul>
				</div>
				<div class="btn_wrap">
					<ul class="row">
					<?php
						if($request_yn == "Y"){
					?>
						<li class="col-xs-3"><a class="line_bg" href="#." data-dismiss="modal">닫기</a></li>
						<li class="col-xs-3"><a href="javascript:doPriceZero()" class="sub_bg">무료수거</a></li>
						<li class="col-xs-3"><a href="javascript:doNotRequest()" style="background:#da1a1a; color:#fff;">수거불가</a></li>
						<li class="col-xs-3"><a href="javascript:doSavePrice()" class="main_bg">확인</a></li>
					<?php
						}else{
							if($e_type == "1"){
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

						<!-- <a class="main_bg1" href="#." data-dismiss="modal">파일 업로드</a></li> -->
						<li class="col-xs-4"><a class="line_bg" href="#." data-dismiss="modal">닫기</a></li>
						<li class="col-xs-4"><a href="javascript:doPriceZero()" class="sub_bg">무료수거</a></li>
						<li class="col-xs-4"><a href="javascript:doSavePrice()" class="main_bg">확인</a></li>
					<?php
						}
					?>
					</ul>
				</div>
				</form>

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
				<form name="frmpricedetail" action="<?php echo G5_URL; ?>/estimate/estimate_form_price_detail_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="idx" value="<?php echo $idx; ?>">
					<div class="form-group">
						<ul class="row">
							<li class="col-xs-5 title gray_bg">
								총 견적 (공금가+세액)
							</li>
							<li class="col-xs-7">
								<div id="divTotalAmt">0 원</div>
								<input type="hidden" id="totalAmt" name="total_amt">
							</li>
						</ul>
					</div>

					<div class="form-group">
						<table>
							<tr>
								<th>품목</th>
								<th>내역</th>
								<th>공급가액</th>
								<th>세액</th>
							</tr>
							<tbody id="itemList"></tbody>

						</table>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="col-xs-12">
								<p>고객참고사항</p>
								<textarea id="content" name="content" style="color:gray;" placeholder="고객이 견적에 참고할 내역을 작성해 주세요."></textarea>
							</li>
						</ul>
					</div>

					<div class="btn_wrap">
						<ul class="row">
						<?php
							if($request_yn == "Y"){
						?>
							<li class="col-xs-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
							<li class="col-xs-4"><a href="javascript:doNotRequest()" style="background:#da1a1a; color:#fff;">철거불가</a></li>
							<li class="col-xs-4"><a href="#." class="main_bg" onClick="doSavePriceDetail();">확인</a></li>
						<?php
							}else{
						?>
							<li class="col-xs-12">
								<div class="box-file-input">
									<label>
										<input type="file" id="attach_file2" name="attfile" class="file-input" accept="image/*">
									</label>
									<span id="attfilename2" class="filename">파일을 선택해주세요.</span>
								</div>
							</li>
							<li class="col-xs-6"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
							<li class="col-xs-6"><a href="#." class="main_bg" onClick="doSavePriceDetail();">확인</a></li>
						<?php
							}
						?>

						</ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</div><!-- 견적 -->
<form name="frmmeet" action="<?php echo G5_URL; ?>/estimate/estimate_form_meet_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="idx" value="<?php echo $idx; ?>">
</form>
<script type="text/javascript" src="/share/js/jquery.bxslider.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	$("#attach_file1").bind('change', function() {
		$("#attfilename1").html(this.files[0].name);
	});

	$("#attach_file2").bind('change', function() {
		$("#attfilename2").html(this.files[0].name);
	});		
	$('#view_slider').bxSlider({
		auto: false,					// 자동 슬라이드 사용여부
		controls: false,				// 양옆컨트롤(prev/next) 사용여부
		speed: 1000,
		preloadImages: 'all',
		pager : true,
		pagerCustom:'#bx-pager'
	});

	$('#bx-pager').bxSlider({
		minSlides : 5,
		maxSlides : 5,
		slideWidth : 200,
		slideMargin : 5,
		controls: true,
		pager : false
	});

	$('#mob_view_slider').bxSlider({
		auto: false,					// 자동 슬라이드 사용여부
		controls: true,				// 양옆컨트롤(prev/next) 사용여부
        touchEnabled: true,
		speed: 1000,
		preloadImages: 'all',
		pager : false,
		oneToOneTouch : false
	});

	$("#price").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});

	var vHtml = "";
	for(var i=1; i<=11; i++)
	{
		var vId = i;
		if(i<10) vId = "0"+i;

		var vItemId = "item"+vId;
		var vDescId = "desc"+vId;
		var vAmtId = "amt"+vId;
		var vVatId = "vat"+vId;
		vHtml += "<tr>";
		vHtml += '<td><input type="text" id="'+vItemId+'" name="'+vItemId+'"></td>';
		vHtml += '<td><input type="text" id="'+vDescId+'" name="'+vDescId+'"></td>';
		vHtml += '<td><input type="text" id="'+vAmtId+'" name="'+vAmtId+'"></td>';
		vHtml += '<td><input type="text" id="'+vVatId+'" name="'+vVatId+'"></td>';
		vHtml += "</tr>";
	}
	$("#itemList").html(vHtml);
	for(var i=1; i<=11; i++)
	{
		var vId = i;
		if(i<10) vId = "0"+i;

		var vAmtId = "#amt"+vId;
		var vVatId = "#vat"+vId;

		$(vAmtId).inputFilter(function(value) {
			  return /^\d*$/.test(value);
		});

		$(vAmtId).focus(function() {
			  $(this).val(cfnNumberRemoveComma($(this).val()));
		});

		$(vAmtId).blur(function() {
			var amtId = $(this).attr("id");
			var vatId = "#"+amtId.replace("amt","vat");
			var vAmt = $(this).val();
			if(vAmt)
			{
				var vVat = Math.round(vAmt * 0.1);
				$(this).val(cfnNumberComma(vAmt));
				$(vatId).val(cfnNumberComma(vVat));
			}else{
				$(vatId).val("");
			}

			fnCalcAmt();
		});

		$(vVatId).inputFilter(function(value) {
			  return /^\d*$/.test(value);
		});

		$(vVatId).focus(function() {
			  $(this).val(cfnNumberRemoveComma($(this).val()));
		});

		$(vVatId).blur(function() {
			  $(this).val(cfnNumberComma($(this).val()));
			  fnCalcAmt();
		});

	}
});

function doPrice()
{
	var vPoint = "<?php echo $member['mb_point']; ?>";
	/*
	if(vPoint < 100){
		alert("충전금이 부족하여 견적에 참여하실 수 없습니다.");
		return;
	}
	*/
	$("#price").val("");
	$('#modal_price').modal();
}

function  doCancelPrice()
{
	$('#modal_price').modal("hide");
}

function doPriceZero()
{
	var f = document.frmprice;
	f.price.value = "0"	;
	f.submit();
}

function doSavePrice()
{
	var f = document.frmprice;
	if(!f.price.value){
		alert("견적 가격을 입력하십시오.");
		return false;
	}
	f.submit();
}

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


function doPriceDetail()
{
	var vPoint = parseInt($("#userPoint").val());
	if(vPoint < 100){
		alert("충전금이 부족하여 견적에 참여하실 수 없습니다.");
		return;
	}


	for(var i=1; i<=5; i++)
	{
		var vId = i;
		if(i<10) vId = "0"+i;

		$("#item"+vId).val("");
		$("#desc"+vId).val("");
		$("#amt"+vId).val("");
		$("#vat"+vId).val("");
	}
	$("#divTotalAmt").html("0 원");
	$("#totalAmt").val("");
	$("#content").val("");
	//$("#discoutContent").val("");

	$('#modal_price_detail').modal();
}

function  doCancelPriceDetail()
{
	$('#modal_price_detail').modal("hide");
}

function doSavePriceDetail()
{
	if($("#totalAmt").val() < 1)
	{
		alert("상세 견적을 입력하십시오.");
		return;
	}

	var f = document.frmpricedetail;
	f.submit();
}

function doMeet()
{
	if(confirm("방문견적을 신청하시겠습니까?"))
	{
		var f = document.frmmeet;
		f.submit();
	}
}

function doNotRequest()
{
	if(confirm("수거불가하시겠습니까?"))
	{
		var f = document.frmmeet;
		f.action = "./estimate_form_not_request_update.php"
		f.submit();
	}
}

function goMove()
{
	location.href="<?php echo G5_URL; ?>/estimate/estimate_list2.php";
}

</script>
<!-- 파일 다운로드 테스트버전 _20200401 -->
<script>
$(document).on("change", ".file-input", function(){
     $filename = $(this).val();
     if($filename == "")
         $filename = "파일을 선택해주세요.";
     $(".filename").text($filename);
 })
</script>

<?php

include_once('./_tail.php');
?>

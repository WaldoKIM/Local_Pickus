<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$sql = " select a.*, concat(substr(email,1,1),'**') as nickname1 from {$g5['estimate_match']} a where no_estimate =  '$no_estimate'	 ";

$master = sql_fetch($sql);

$request_yn = "N";
$sql = " select * from {$g5['estimate_match_propose']} a where no_estimate =  '$no_estimate' and rc_email = '{$member['mb_email']}' ";

$er = sql_fetch($sql);
if($er){
	$request_yn = "Y";
}

$sql_match = " 		select *
				from
					g5_estimate_match_info a
				where
					a.no_estimate = '$no_estimate'";
$info = sql_query($sql_match);
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/swiper.min.css"/>
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
	.requst_list td{text-align: center;}
	.one_line p.tit_modal_match{width: 35%; display: inline-block; margin-bottom: 0;}
	.one_line ul{width: 60%; float: right;}
	.one_line input[type="radio"]{display: none;}
</style>
<div class="layer loader_bg hidden"></div>
<div class="layer loader hidden"></div>
<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">고객 구매 내역</h1>
		</div><!-- sub_title -->
		<div id="board">
			<div class="view">

				<div class="mob">
					<div class="mob_slider">
						<div class="text" id="mobileEtype">중고매칭</div>
					</div>

					<div class="text-center mob_ing" id="mobileStatus">
						<?php echo get_estimate_mobile_state_tag($master['state']);?>
					</div>


					<div class="mob_info">
						<ul class="row"  id="mobileInfo1">
						<?php
						echo "<li class='col-xs-6'>";
						echo "<p class='text-center main_co'><i class='xi-calendar-check'></i> 견적마감일</p>"; ?>
						<p class='text-center'>
						<?php echo $master['date_close'];  ?>
						</p>
						<?php
						echo "</li>";
						echo "<li class='col-xs-6'>";
						echo "<p class='text-center main_co'><i class='xi-money'></i> 배송요청일</p>";
						echo "<p class='text-center'>".$master['date_req']."</p>";
						echo "</li>";
					?>
						</ul>
					</div>

					<div class="customer"  id="mobileInfo2">
						<?php
							echo "<dt class='col-xs-1 main_co'>제목</dt>";
							echo "<dd class='col-xs-11'>".$master['title']." </dd>";
							echo "<dt class='col-xs-1 main_co'>장소</dt>";
							echo "<dd class='col-xs-11'>".$master['jangso']." </dd>";
							echo "<dt class='col-xs-1 main_co'>예산</dt>";
							echo "<dd class='col-xs-11'>". number_format($master['price']) . " 원</dd>";
							echo "<dt class='col-xs-1 main_co'>지역</dt>";
							echo "<dd class='col-xs-11'>".$master['area1']." ".$master['area2']."</dd>";

						?>
					</div>

					<div class="customer" id="mobileButton">
						<?php
							echo "<ul class='row'>";
							echo "<li class='col-xs-6'>";
							echo "<a class='main_bg' href='javascript:doPriceDetail()'>견적 참여하기</a>";
							echo "</li>";
							echo "</ul>";
						?>
					</div>
				</div>
				<div class="col-xs-6">
					<table class="web">
						<tr>
							<td class="info" id="mainTitle">
								<h1><?php echo $master['title']; ?></h1>
								<dl>
									<!-- <dt class="col-xs-3">고객</dt><dd class="col-xs-9"><?php echo $master['name']; ?></dd> -->
									<dt class="col-xs-3">장소</dt><dd class="col-xs-9"><?php echo $master['jangso']; ?></dd>
									<dt class="col-xs-3">지역</dt><dd class="col-xs-9"><?php echo $master['area1']; ?> <?php echo $master['area2']; ?></dd>
									<dt class="col-xs-3">예산</dt><dd class="col-xs-9"><?php echo number_format($master['price']); ?>원</dd>
									<dt class='col-xs-3'>견적마감일</dt><dd class='col-xs-9'><?php 
									if(intval(strtotime($master['date_close'])-strtotime(date("Y-m-d"))) == 0){
										echo $master['date_close'];
									}else{
										echo 'D-' . intval(strtotime($master['date_close'])-strtotime(date("Y-m-d"))) / 86400;
									} ?></dd>
									<dt class='col-xs-3'>배송요청일</dt><dd class='col-xs-9'><?php echo $master['date_req']; ?></dd>
								</dl>
								<?php
									echo "<ul class='row'>";
									echo "<li class='col-xs-6'>";
									echo "<a class='main_bg' href='javascript:doPriceDetail()'>견적 참여하기</a>";
									echo "</li>";
									echo "</ul>";
								?>
							</td>
						</tr>
					</table>
				</div>

				<div class="col-md-6 col-xs-12" style="padding-left:20px;">
					<h1 class="tt">고객 요청사항</h1>
					<p><?php echo $master['etc_req']; ?></p>
				</div>
				<div class="col-xs-12">
					<h1 style="margin-top: 40px;" class="tt">구매 요청내역</h1>
				</div>
				<table style="margin-top: 0; padding-top: 0;"  class="requst_list" id="subDetail">
				<?php
					echo "<tr>";
					echo "<th>카테고리</th>";
					echo "<th>품목</th>";
					echo "<th>수량</th>";
					echo "</tr>";
					for ($i=0; $row=sql_fetch_array($info); $i++) {
						echo "<tr>";
						echo "<td>".$row['cate']."</td>";
						echo "<td>".$row['cate_name']."</td>";
						echo "<td>".$row['qty']."</td>";
						echo "</tr>";
					}
				?>
				</table>

				<?php
					$sql = " select count(*) as cnt from {$g5['estimate_match_propose']} where no_estimate = '$no_estimate' and ISNULL(content) != '' ";
					$request_cnt = sql_fetch($sql);
					if($request_cnt['cnt'] > 0){
						$sql = " select * from {$g5['estimate_match_propose']} where no_estimate = $no_estimate and ISNULL(content) != '' ";
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
						<a class="main_bg" href="./partner_estimate_list.php?gubun=4">리스트</a>
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
							<input type="number" class="input_default" id="price" name="price">
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
			<div class="modal-body" style="padding-top:0;">
				<form name="frmpricedetail" action="<?php echo G5_URL; ?>/estimate/estimate_form_match_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="no_estimate" value="<?php echo $no_estimate; ?>">
					<div class="form-group" style="padding-bottom:0;">
						<p class="tit_modal_match" style="margin-bottom:0;">상품 사진</p>
						<div class="row" id="imageList">

						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<span class="tit_modal_match">물품내역</span>
							<a class="add_line" id="add_goods" href="#" style="float:right;">+ 추가</a>
						</div>
						<div class="row" id="multiList">
							<div class='form_new add_pro'>
								<div class='add_name col-xs-5'>
									<p style="margin-bottom: 5px;">품목명</p><input placeholder='' type='text' name='pro_name[]' class="pro_name"></div>
								<div class='add_qty col-xs-5'><p style="margin-bottom: 5px;">가격</p><input  placeholder='가격' type='number' name='pro_price[]' class="pro_price" id="pro_price1"></div>
								<div class='remove_pro' style="margin-top: 20px;"><a class='form_btn delete_item' href='javascript:' >삭제</a></div>
							</div>
						</div>
					</div>
					<div class="form-group one_line" style="border:0 !important; padding-bottom:0;">
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
					</div>
					<div class="form-group" style="border:0 !important; display:none;">
						<input style="display: none;" type="number" value="0" name="shipping_pro" id="del_fee">
					</div>
					<div class="form-group one_line" style="border:0 !important; padding-bottom:0">
						<p class="tit_modal_match">AS 보증/교환</p>
						<ul class="row">
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
								<input type="radio" name="as_pro" id="as_on" value="1" checked=""><i><p>가능</p></i></label>
							</li>
							<li class="col-xs-6">
								<label style="width: 100%;" class="box">
								<input type="radio" name="as_pro" id="as_off" value="2"><i><p>불가능</p></i></label>
							</li>
						</ul>
					</div>
					<div class="form-group" style="border:0 !important; margin-bottom: 0; padding-bottom:0;">
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
					<div class="form-group" style="border:0 !important padding-bottom:0;">
						<p class="tit_modal_match" style="margin-bottom:0;">총 금액</p>
						<ul class="row">
							<li class="col-xs-12">
								<input type="text" name="total_price" id="total_price" value="" readonly="" />
							</li>
						</ul>
					</div>
					<div class="form-group" style="border:0 !important; padding-bottom:0;">
						<p class="tit_modal_match" style="margin-bottom:0;">참고사항</p>
						<textarea name="match_desc"></textarea>
					</div>
					<div class="btn_wrap" style="padding-top:0;">
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
<form name="frmmeet" action="<?php echo G5_URL; ?>/estimate/estimate_form_meet_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="idx" value="<?php echo $idx; ?>">
</form>
<script type="text/javascript" src="/share/js/jquery.bxslider.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	doInitImage2("165");
	$("#photo_1").bind('change', function() {
		alert('change');
		$("#photo_1_show").html(this.files[0].name);
	});
	$("#photo_2").bind('change', function() {
		$("#photo_2_show").html(this.files[0].name);
	});
	$("#photo_3").bind('change', function() {
		$("#photo_3_show").html(this.files[0].name);
	});


	$("#price").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});
	$('input[type="number"]').val(0).on('change', function(e) {
        var i = $('input[type="number"]'),
            total = 0;
        i.each(function() {
            total += +this.value;
        });
        total = 0;
        i.each(function() {
            total += +this.value;
        });
        $('#total_price').val( total );
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
	$("#shipping_on").click(function(){
		$("#del_fee").css('display', 'block');
	});
	$("#shipping_off").click(function(){
		$("#del_fee").css('display', 'none');
		$("#del_fee").val('0');
	});
	$("#as_on").click(function(){
		$("#month_as").css('display', 'block');
		$("#month_as").val('0');
	});
	$("#as_off").click(function(){
		$("#month_as").css('display', 'none');
	});
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
	if($('#del_fee').css('display', 'block')){
		if(!cfnNullCheckInput($("#del_fee").val(), "배송비")) return false;	

	}
	if(!cfnNullCheckInput($(".pro_name").val(), "상품")) return false;	
	if(!cfnNullCheckInput($(".pro_price").val(), "가격")) return false;	
	


	if(photo_count == 0){
		alert("사진을 등록하십시오.");
		return false;
	}
	if($("#totalAmt").val() < 1)
	{
		alert("상세 견적을 입력하십시오.");
		return;
	}
	if($('#del_fee').val() == 0){
		$('#del_fee').css('display', 'none')
	}
	$(".loader").attr('style', 'display: block !important');
	$(".loader").attr('style', 'visibility: visible !important');
	$(".loader_bg").attr('style', 'display: block !important');
	$(".loader_bg").attr('style', 'visibility: visible !important');
	var f = document.frmpricedetail;
	f.submit();
}


function goMove()
{
	location.href="<?php echo G5_URL; ?>/estimate/estimate_list2.php";
}

var estimateCnt = 0;
var i = 2;
$("#add_goods").click(function(){

	

	var vHtml = "";
	
	vHtml += "<div class='form_new add_pro'>";
	vHtml += "<div class='add_name col-xs-5'><input placeholder='품목명'' type='text' name='pro_name[]' class='pro_name'></div>";
	vHtml += "<div class='add_qty col-xs-5'><input placeholder='가격' type='number' name='pro_price[]' class='pro_price' id='pro_price" + i + " '></div>";
	vHtml += "<div class='remove_pro'><a class='form_btn delete_item' href='javascript:' >삭제</a></div>";
	vHtml += "</div>";

	$("#multiList").append(vHtml);
	estimateCnt++;
	i++;
	$('.pro_price').on('change', function(e) {
        var i = $('input[type="number"]'),
            total = 0;
        i.each(function() {
            total += +this.value;
        });
        total = 0;
        i.each(function() {
            total += +this.value;
        });
        $('#total_price').val( total );
    });

});
$(document).on("click", ".delete_item", function() {
			$(this).closest(".add_pro").remove();
			estimateCnt--;
		});
</script>

<script type="text/javascript" src="/js/swiper.min.js"></script>
<script>
var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      loop: true,      
     navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
</script>
<?php

include_once('./_tail.php');
?>
<style>
    /*woojin*/
    .customer a {
        display: inherit;
        height: inherit !important;
        line-height: inherit !important;
        text-align: left;
    }
    .customer .row a {
    display: block;
    height: 40px !important;
    line-height: 40px !important;
    text-align: center;
    border-radius: 5px;
    margin-top: 20px;
    }
</style>
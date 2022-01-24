<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<!-- <div class="sub_title">
	<h1 class="main_co">견적현황</h1>
</div> --><!-- sub_title -->
<div class="member com_pd">
	<div class="container">

		<div id="board">
			<div class="view">

				<div class="mob">
					<div class="mob_slider swiper-container">
						<ul id="mob_view_slider" class="swiper-wrapper">
							
						</ul>
						<!-- <div class="text" id="mobileEtype">TET</div> -->
				    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
					</div>
					<div class="text-center mob_ing" id="mobileStatus">
						<h1 class="main_co">견적중</h1>					
					</div>
				


					<div class="mob_info">
						<ul class="row"  id="mobileInfo1">
						<li class='col-xs-6'>
							<p class='text-center main_co'><i class='xi-calendar-check'></i> 수거요청일</p>
						
						<p class='text-center'>2020-09-29</p>
						</li>
						<li class='col-xs-6'>
						<p class='text-center main_co'><i class='xi-money'></i> 내견적가</p>
						<p class='text-center'>견적에 참여하세요</p>
						</li>
						</ul>
					</div>

					<div class="customer"  id="mobileInfo2">
							<dt class='col-xs-1 main_co'>지역</dt>
							<dd class='col-xs-11'>서울시 강남구</dd>
							<dt class='col-xs-1 main_co'>층수</dt>
							<dd class='col-xs-11'>6층</dd>
					</div>

				</div>

				<table class="web">
					<tr>
						<td class="info" id="mainTitle">
							<h1>타입명</h1>
							<dl>
								<dt class="col-xs-3">제목</dt><dd class="col-xs-9">제목명</dd>
								<dt class="col-xs-3">고객</dt><dd class="col-xs-9">고객명</dd>
								<dt class="col-xs-3">지역</dt><dd class="col-xs-9">왕십리</dd>
								<dt class="col-xs-3">층수</dt><dd class="col-xs-9">4층</dd>
								
									<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>2020-09-29</dd>
							
							</dl>
							<ul class='row'>
								<li class='col-xs-6'>
								<!-- <a class='main_bg' href='javascript:doMeet()'>방문견적</a> -->
								</li>
									<li class='col-xs-6'>
									<a class='main_bg' href='javascript:doPriceDetail()'>견적 취소</a>
								</li>
							</ul>
						</td>
					</tr>
				</table>

				<h1 class="tt" id="tit_select">업체선택</h1>
				<ul class="shop_list" id="proposeList">
					<li>
						<div>
							<div class='img'><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/pg_img/pg_kg.jpg"></div>
							<div class='text'>
								<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>

								<h4>닉네임</h4>
								<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>TEST</h5>
								<div class='pay main_co'><span>무료철거</span></div>
							</div>
							<div class='btn_list'>
								<ul class='row'>
									<li class='col-xs-6'>
									<a class='line_bg' href='javascript:doPriceDetail()'>상세견적</a>
									</li>
									<li class='col-xs-6'>
									<a class='sub_bg' href='javascript:'>선택완료</a>
									</li>
								</ul>
							</div>
						</div>
					</li>
					<li>
						<div>
							<div class='img'><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/pg_img/pg_kg.jpg"></div>
							<div class='text'>
								<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>

								<h4>제일환경</h4>
								<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>서울시 마포구 염리동 8-12 4층 텍스트 늘려서 출력시</h5>
								<div class='pay main_co'><span>무료철거</span></div>
							</div>
							<div class='btn_list'>
								<ul class='row'>
									<li class='col-xs-6'>
									<a class='line_bg' href='javascript:doPriceDetail()'>상세견적</a>
									</li>
									<li class='col-xs-6'>
										<a class='main_bg' href='#'>업체선택</a>
									</li>
								</ul>
							</div>
						</div>
					</li>
				</ul>
				<h1 class="tt main_co">상세정보</h1>

				<table class="requst_list" id="subDetail">
						<colgroup>
						<col style='width: 20%' />
						<col style='width: 30%' />
						<col style='width: 20%' />
						<col style='width: 30%' />
						</colgroup>
						
							<tr>
							<th>품목</th><td>가구</td>
							<th>제조사</th><td>삼성</td>
							</tr>
							<tr>
							<th>모델명</th><td>EA-05478</td>
							<th>연식</th><td>6년</td>
							</tr>
							<tr>
							<th>참고사항</th><td colspan='3'>스크레치 심함</td>
							</tr>
				</table>
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
						<li class="col-xs-3"><a class="line_bg" href="#." data-dismiss="modal">닫기</a></li>
						<li class="col-xs-3"><a href="javascript:doPriceZero()" class="sub_bg">무료수거</a></li>
						<li class="col-xs-3"><a href="javascript:doNotRequest()" style="background:#da1a1a; color:#fff;">수거불가</a></li>
						<li class="col-xs-3"><a href="javascript:doSavePrice()" class="main_bg">확인</a></li>
						<li class="col-xs-4"><a class="line_bg" href="#." data-dismiss="modal">닫기</a></li>
						<li class="col-xs-4"><a href="javascript:doPriceZero()" class="sub_bg">무료수거</a></li>
						<li class="col-xs-4"><a href="javascript:doSavePrice()" class="main_bg">확인</a></li>
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
				<h4 class="modal-title" style="color: #1379cd !important;">상세견적서</h4>
			</div>
			<div class="modal-body">
				<form name="frmpricedetail"  method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="idx" >
					<div class="form-group">
						<ul class="row">
							<li class="col-xs-12 title ">
								상품 사진
							</li>
							<li class="col-xs-3">
								<div class="estimate_image_click_bg"><img src="../img/common/estimate_icon_image_info.png"><p>사진파일 업로드</p></div>
								<input type="hidden" id="totalAmt" name="total_amt">
							</li>
							<li class="col-xs-3">
								<div class="estimate_image_click_bg"><img src="../img/common/estimate_icon_image_info.png"><p>사진파일 업로드</p></div>
								<input type="hidden" id="totalAmt" name="total_amt">
							</li>
						</ul>
					</div>
					<div class="form-group">
						<ul class="row">
							<li class="col-xs-12 title">물품내역</li>
							<table>
								<tr>
									<td>품명</td>
									<td>가격</td>
								</tr>
								<tr>
									<td><input type="text" name=""></td>
									<td><input type="number" name="" placeholder="숫자만 입력해주세요"></td>
								</tr>
							</table>
							<!-- <li class="col-xs-5 title">
								
							</li>
							<li class="col-xs-7">
								<div id="divTotalAmt">0 원</div>
								<input type="hidden" id="totalAmt" name="total_amt">
							</li>
							<li class="col-xs-5 title">
								품명
							</li>
							<li class="col-xs-7">
								<div id="divTotalAmt">0 원</div>
								<input type="hidden" id="totalAmt" name="total_amt">
							</li> -->
						</ul>
					</div>
					<style type="text/css">
						#tit_select{color: #1379cd !important; border-bottom: 2px solid #1379cd; padding-bottom: 10px;}
						#board .view .shop_list h4{padding: 0  !important;}
						#proposeList .img{width: 100% !important; text-align: center; float: unset !important; margin-bottom: 5px;}
						#proposeList .img img{max-height: 210px; max-width: auto !important; border-radius: 0 !important;}
						#proposeList .pay{width: 100%;}

						#proposeList .btn_list{width: 100% !important; 
							margin-left: 0 !important;}
						#proposeList .text{width: 100% !important; float: unset !important; margin-left: 0 !important;}
						#proposeList .btn_list .col-xs-6 + .col-xs-6{ padding-left: 0; }
						#price_fee{margin-bottom: 10px}
						.modal_table .title{font-size: 20px;}
						@media(max-width: 720px){
							div#mobileInfo2 dd{padding-left: 20px;}
							.col-xs-3{width: 50%;}
							#tit_select{margin: 0; width: 100%;}
							.col-xs-offset-9{margin-left: 0;}
						}
.modal-content{padding: 15px;}
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
  vertical-align:middle;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.estimate_image_click_bg p{width: 100%;}
.switch{float: right;}
					</style>
					
					<div class="form-group">
						<ul class="row">
							<li class="col-xs-12 title switch_chk">배송비
								<label class="switch">
								  <input type="checkbox" id="chk_fee">
								  <span class="slider round"></span>
								</label>
								<span class="chk">X</span>
								<span class="chk" style="display:none;">O</span>
							</li>
							<li class="col-xs-12">
								<div id="divTotalAmt" style="display: none;">
									<input type="number" name="" placeholder="숫자만 입력하세요" id="price_fee">
								</div>
								<input type="hidden" id="totalAmt" name="total_amt">
							</li>
						</ul>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="col-xs-12 title switch_chk_as">AS 보증/교환
								<label class="switch">
								  <input type="checkbox" id="chk_fee_as">
								  <span class="slider round"></span>
								</label>
								<span class="chk_as">X</span>
								<span class="chk_as" style="display:none;">O</span>
							</li>
						</ul>
					</div>
					<div class="form-group">
						<ul class="row">
							<li class="col-xs-12" style="margin-bottom: 15px;">총 견적가</li>
							<li class="col-xs-12"><input type="number" name="" placeholder="숫자만 입력해주세요"></li>
						</ul>
					</div>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
							<li class="col-xs-4"><a href="javascript:doNotRequest()" style="background:#da1a1a; color:#fff;">철거불가</a></li>
							<li class="col-xs-4"><a href="#." class="main_bg" onClick="doSavePriceDetail();">확인</a></li>
						</ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</div><!-- 견적 -->
<!-- <form name="frmmeet" action="<?php echo G5_URL; ?>/estimate/estimate_form_meet_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="idx" value="<?php echo $idx; ?>">
</form> -->
<script type="text/javascript">
jQuery(document).ready(function(){
	$("#attach_file1").bind('change', function() {
		$("#attfilename1").html(this.files[0].name);
	});

	$("#attach_file2").bind('change', function() {
		$("#attfilename2").html(this.files[0].name);
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
	/*$("#divTotalAmt").html("0 원");*/
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

/*function goMove()
{
	location.href="<?php echo G5_URL; ?>/estimate/estimate_list2.php
}
*/
</script>
<script type="text/javascript">
	var check = $("#chk_fee");
	check.click(function(){
		$(".switch_chk .chk").toggle();
		if($(".switch_chk .chk_on").is(":visible")){
			$("#divTotalAmt").css('display', 'block');
		}else{
			$("#divTotalAmt").css('display', 'none');
		}
	});
	var check_as = $("#chk_fee_as");
	check_as.click(function(){
		$(".switch_chk_as .chk_as").toggle();
	});
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
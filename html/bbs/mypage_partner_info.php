<?php
include_once('./_common.php');

include_once('./_head.php');

$register_action_url = G5_HTTPS_BBS_URL.'/register_form_update.php';
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<style type="text/css">
	.tb_sample th, td{color: #000; font-size: 18px;}
	.tb_sample th{padding: 17px 7px; width: 7%; font-weight: 400;}
	.tb_sample td{padding: 10px; width: 20%;}
	.box_area h2{text-align: center; margin-bottom: 20px; color: #000; font-size: 22px;}
	.box_area .box1{width: 30%; float: left; margin-right: 1%; padding: 20px; background-color: #fff;}
	.box_area .box3{width: 69%; float: left; background-color: #fff; padding: 20px;}
	.box_area .box3 p{font-size: 17px; line-height: 24px;}
	.box_area .box2 li span{margin: 20px 0;}
	#fregisterform{border:0; max-width: 100%; background-color: transparent;}
	.is-pc .at-body{background-color: #f4f5f9;}
</style>
<div class="member com_pd">
	<div class="container">
		<!-- <div class="sub_title">
			<h1 class="main_co">파트너 정보</h1>
			<p class="tit_desc">피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</p>
		</div> -->
		<div class="join_wrap">
			<div class="form_wrap">
				
				<form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" method="post" enctype="multipart/form-data" autocomplete="off">

					<div class="form-group" style=" margin-bottom: 1%; overflow: hidden; border: 1px solid #ededed !important; background-color: #fff;">
						<div style="float: left; width: 30%;  padding: 20px;">
							<img style="border-radius: 15px; max-width: 300px; max-height: 250px;" src="https://www.repickus.com//data/estimate/2019/09/05/thumb-386920190905152020_350x350.jpg">
						</div>
						<div style="width: 69%; float: left; background-color: #fff; padding: 20px; max-height: 290px;">
							<h4 style="border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 20px;"><span style="color: rgb(19, 121, 205);">PICKUS</span> 파트너스</h4>
							<h3 style="font-weight: 600; color: #000; font-size: 30px; margin-top: 0; margin-bottom: 20px">영등포철거</h3>
							<table class="tb_sample">
								<tr>
									<th>활동지역</th>
									<td>서울, 경기 북부</td>
								</tr>
								<tr>
									<th>전문분야</th>
									<td>내부철거,부분복구,원상복구</td>
								</tr>
								<tr>
									<th>등록일</th>
									<td>2020-09-06</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="box_area">
						<ul>
							<li class="box1" style="border: 1px solid #ededed;">
								<h2>
									고객평가
								</h2>
								<ul>
									<li style="border-top: 1px solid #ccc;padding: 10px 0;">
									<p><span style="color: rgb(19, 121, 205);">★★★★★</span> <span style="float: right;">dasd***</span></p>
									<p style="line-height: 20px;">약속 시간보다 일찍 와서 미리 기다려주시고 사장님도 친절하십니다.</p>
									</li>
									<li style="margin-bottom: 15px;   padding: 10px 0;">
									<p><span style="color: rgb(19, 121, 205);">★★★★★</span> <span style="float: right;">dasd***</span></p>
									<p style="line-height: 20px;">약속 시간보다 일찍 와서 미리 기다려주시고 사장님도 친절하십니다.</p>
									</li>
									<li style="margin-bottom: 15px;   padding: 10px 0;">
									<p><span style="color: rgb(19, 121, 205);">★★★★</span> <span style="float: right;">dasd***</span></p>
									<p style="line-height: 20px;">약속 시간보다 일찍 와서 미리 기다려주시고 사장님도 친절하십니다.</p>
									</li>
									<a href="#" style="border: 1px solid rgb(19, 121, 205); width: 100%; height: 40px; line-height: 38px; text-align: center;">더보기</a>
								</ul>
							</li>
							<li class="box3" style="border: 1px solid #ededed;">
								<h2>파트너 소개</h2>
								<p>
									안녕하세요 저희는 영등포구에 위치한 철거 전문업체입니다.
									부분철거, 전체철거, 복구 작업 등 다양한 작업을 소화할 수 있는 업력 20년 이상의 노하우가 풍부한 업체면서 동시에 여러 작업을 다발적으로 소화할 수 있는 업체입니다.<br/><br/>

									<img src="/img/sample1.jpg">
									<br/><br/>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								<br/>
								<br/>
								<img src="/img/sample2.jpg">
								<br/>
								<br/>
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							<a href="#" style="background-color:rgb(19, 121, 205); color: #fff; width: 200px; height: 40px; line-height: 38px; text-align: center;">파트너 목록</a>
								
							</li>
						</ul>

					</div>

				</form>

			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->
<script type="text/javascript">
var vEmail;
var vBizType;
jQuery(document).ready(function(){
	vEmail   = $("#mb_email").val();
	vBizType = $("#mb_biz_type").val();
	
	if(vBizType == "1"){
		$("#divGoodsItemList").show();
		$("#divRemoveItemList").hide();
	}else if(vBizType == "2"){
		$("#divRemoveItemList").show();
		$("#divGoodsItemList").hide();
	}else if(vBizType == "3"){
		$("#divGoodsItemList").show();
		$("#divRemoveItemList").show();
	}

	//alert($("#mb_biz_goods_year").val());
	//alert($("#mb_biz_goods_item").val());
	//alert($("#mb_biz_remove_item").val());
	cfnBizTypesOnlyOne("divBizType", $("#mb_biz_type").val());
	cfnGoodsItem("divGoodsItem",$("#mb_biz_goods_item").val(),$("#mb_biz_goods_year").val());
	cfnRemoveItem("divRemoveItem",$("#mb_biz_remove_item").val());


	$("#email").html($("#mb_email").val());
	$("#bizname").html($("#mb_biz_name").val());

	$("#removeEtc").val($("#mb_biz_remove_etc").val());

	doSetImage('divPhoto','mb_photo','담당자사진 업로드');
	doSetImage('divPhotoSite','mb_photo_site','사업장 정면 또는 내부 사진 업로드');
	doSetImage('divPhotoBizcard','mb_photo_bizcard','사업자등록증 업로드');


	$('input[name="goodsItem"]').click(function() {

		var vId = $(this).attr('id');
		var vIdx = vId.replace("goodsItem","");
		var vValue = $(this).val();
		if ($(this).is(':checked')) {
			if(vValue == "모두수거"){
				$("input:checkbox[name='goodsItem']").each(function(){
					this.checked = true;
				});
				for(var i=0; i<cfnGoodsItemLength()-1; i++)
				{
					$("#goodsYear"+i).show();
					$("#goodsYear"+vIdx).val("1");
				}
			}
		    $("#goodsYear"+vIdx).show();
		    $("#goodsYear"+vIdx).val("1");
		}else{
			if(vValue == "모두수거"){
				$("input:checkbox[name='goodsItem']").each(function(){
					this.checked = false;
				});
				for(var i=0; i<cfnGoodsItemLength()-1; i++)
				{
					$("#goodsYear"+i).hide();
				}
			}
			$("#goodsYear"+vIdx).hide();
		}
		
	}); 
	
	$('#goodsYear4').change(function() { 
		var vValue = $(this).val();
		for(var i=0; i<cfnGoodsItemLength()-1; i++)
		{
			$("#goodsYear"+i).val(vValue);
		}
	});
	
	$('input[name="removeItem"]').click(function() {
		var vValue = $(this).val();
		var vId = $(this).attr('id');
		var vIdx = vId.replace("removeItem","");
		var vSeq = cfnRemoveItemLength();
		if(vIdx == vSeq)
		{
			$("#removeEtc").val("");
			if ($(this).is(':checked')) {
			    $("#removeEtc").show();
			}else{
				$("#removeEtc").hide();
			}
		}
		
		if ($(this).is(':checked')) {
			if(vValue == "모두철거"){
				$("input:checkbox[name='removeItem']").each(function(){
					this.checked = true;
				});
				$("#removeEtc").val("");
				$("#removeEtc").show();
			}
		}else{
			if(vValue == "모두철거"){
				$("input:checkbox[name='removeItem']").each(function(){
					this.checked = false;
				});
				$("#removeEtc").val("");
				$("#removeEtc").hide();
			}
		}		
	}); 	
	$("#phone").inputFilter(function(value) {
		return /^\d*$/.test(value);
	});

	$("#bizWorkerPhone").inputFilter(function(value) {
		 return /^\d*$/.test(value);
	});

	$('.remove_area').click(function() {
		var $el = $(this).closest(".signup_txt_area");
		$el.remove();
	})	
});	

function doSetImage(vDiv, vComp, vTitle)
{
	if($("#"+vComp).val()){
        var vHtml2 = "";
        vHtml2 += "<div class='estimate_image_bg'>";
        vHtml2 += "<div class='estimate_image_del_bg'>";
        vHtml2 += "<a href='#none' onClick='doInitImageAjax(\""+vComp+"\",\""+vDiv+"\",\""+vTitle+"\");'>";
        vHtml2 += "<i class='xi-close-min'></i>";
        vHtml2 += "</a>";
        vHtml2 += "</div>";
        vHtml2 += "<img src='/data/estimate/"+$("#"+vComp).val()+"' style='width:100%;'/>";
        vHtml2 += "</div>";
        $("#"+vDiv).empty().html(vHtml2);
	}else{
		doInitImageAjax(vComp, vDiv, vTitle);
	}
}

function doSelectArea1()
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.area1.php",
        data: {
        	"area1": $('#area1').val()
        },
        cache: false,
        success: function(data) {
            var fvHtml = "<option value=\"\" selected>시/도</option>";
            fvHtml += data;
            $("#area1").html(fvHtml);
            fvHtml="<option value=\"\" selected>시/구/군</option>";
			$("#area2").html(fvHtml);
			$('#area1').change(function(){ 
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
        	"area1": $('#area1').val()
        },
        cache: false,
        success: function(data) {
            var fvHtml="";
			if($("#area1").val())
			{
				fvHtml += "<option value=\"\" selected>"+$("#area1").val()+" 전체</option>";
			}else{
				fvHtml += "<option value=\"\" selected>시/도</option>";
			}
			fvHtml += data;
			$("#area2").html(fvHtml);

        }
    });
}

function doSaveArea()
{
	if(!$("#area1").val()){
		alert("시/도를 선택하십시오.");
		return;
	}

	var area1 = $("#area1").val();
	var area2 = $("#area2").val();

	var vHtml = "";
	vHtml += "<p class='signup_txt_area'>";
	vHtml += "<input type='hidden' name='mb_area1[]' value='"+area1+"'>";
	vHtml += "<input type='hidden' name='mb_area2[]' value='"+area2+"'>";
	vHtml += area1+" "+cfNvl2(area2,"전체");
	vHtml += "&nbsp;&nbsp;";
	vHtml += "<a href='javascript:' class='remove_area'>";
	vHtml += "<i class='xi-close-min'></i>";
	vHtml += "</a></p>";
	//vHtml += "</p>";
	$("#divArea").append(vHtml);
	$('.remove_area').click(function() {
		var $el = $(this).closest(".signup_txt_area");
		$el.remove();
	})
}

function fregisterform_submit(){
	//return false;

	var f = document.fregisterform;
	if(!checkFields())	 return false;

	if(f.password_new.value){
		f.mb_password.value = hex_md5(f.password_new.value);	
	}
	
	var goodsItem = "";
	var goodsYear = "";
	
	if(vBizType == "1" || vBizType == "3")
	{
		$('input[name="goodsItem"]:checked').each(function(index,item){
			if(index != 0){
				goodsItem += ",";
				goodsYear += ",";
			}
			goodsItem += $(this).val();
			
			var vId = $(this).attr('id');
			var vIdx = vId.replace("goodsItem","");
			
			if($("#goodsYear"+vIdx).val())
			{
				goodsYear += $("#goodsYear"+vIdx).val();
			}else{
				goodsYear += "0";
			}
		});		
	}
	
	var removeItem = "";
	var removeEtc = "";
	if(vBizType == "2" || vBizType == "3")
	{
		$('input[name="removeItem"]:checked').each(function(index,item){
			if(index != 0){
				removeItem += ",";
			}
			removeItem += $(this).val();
		});
		removeEtc = ("#removeEtc").val();
	}


	f.mb_biz_goods_item.value = goodsItem;
	f.mb_biz_goods_year.value = goodsYear;
	f.mb_biz_remove_item.value = removeItem;
	f.mb_biz_remove_etc.value = removeEtc;
	
	//return false;
	f.submit();

	
}

function checkFields() {  
	
	if($("#password_new").val()){
		if($("#password_new").val()!=$("#password_new_c").val()){
			alert("비밀번호와 비밀번호확인이 일치하지 않습니다.");
			return false;
		}

		if($("#password_new").val().length  < 8 || $("#password_new").val().length  > 15){
			alert("비밀번호는 8자 이상 15자 이하입니다.");
		}
	}
	if(!cfnNullCheckInput($("#mb_hp").val(), "전화번호")) return false;
	if(!cfnNullCheckInput($("#mb_biz_addr1").val(), "센터주소")) return false;
	if(!cfnNullCheckInput($("#mb_biz_addr2").val(), "센터상세주소")) return false;
	if(!cfnNullCheckInput($("#mb_biz_worker_name").val(), "담당자 이름")) return false;
	if(!cfnNullCheckInput($("#mb_biz_worker_phone").val(), "담당자 휴대전화번호")) return false;
	if(!cfnNullCheckInput($("#mb_biz_intro").val(), "업체 소개글")) return false;

	return true;
}

function doWithdrawal()
{
	if(!confirm("회원을 탈퇴하시겠습니까?"))  return;
	
	location.href = "./member_leave.php";
}
</script>
<?php
include_once('./_tail.php');
?>


<style>
    
    .input_default {margin-bottom: 10px;}
    @media(max-width:991px){
        #divGoodsItemList .col-md-4 {width: auto;}
    }
</style>
<?php
include_once('./_common.php');

include_once('./_head.php');

$register_action_url = G5_HTTPS_BBS_URL.'/register_form_update.php';
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<!-- <div class="sub_title login">
	<h5>고객과 쉽게 만날 수 있는 방법</h5>
	<h1>피커스는 언제나 빠르게 원하는 고객을 만날 수 있습니다.</h1>
</div> --><!-- sub_title -->
<style type="text/css">
	.show_event{margin-bottom: 40px;}
	.show_event h4{font-size: 24px; color: #1379cd; padding-bottom: 10px;}
	.right{float: right;}
	.show_more ul + ul{margin-top: 60px;}
	.show_more ul li{border-bottom: 1px solid #ddd; padding: 15px 0;}
	.show_more ul li a{width: 100%; font-size: 18px;}
</style>
<div class="member com_pd">
	<div class="container">
		<div class="show_more">
			<div class="show_event">
				<h4>진행중인 이벤트</h4>
				<div>
					<div style="width: 48%; margin-right: 2%; background-color: #ccc; display: inline-block;height: 280px"></div>
					<div style="width: 48%; background-color: #ccc;display: inline-block; height: 280px"></div>
				</div>
			</div>
			<ul>
				<li><a href="#">내정보확인/변경<span class="right">></span></a></li>
				<li><a href="#">프로모션 코드 입력<span class="right">></span></a></li>
				<li><a href="#">피커스 공지사항(피커스픽)<span class="right">></span></a></li>
				<li><a href="#">1:1 문의 / FAQ(고객센터)<span class="right">></span></a></li>
				<li><a href="#">로그아웃<span class="right">></span></a></li>
			</ul>
			<ul>
				<li><a href="#">피커스 마켓<span class="right">></span></a></li>
				<li><a href="#">마켓 정보 리스트<span class="right">></span></a></li>
			</ul>
		</div>
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
(function($){
	$.fn.image_gallery = function(prop){
		var options = $.extend({
		},prop);
				
		//Click event on element
		return this.hover(function(e){
			$('.pati_main_img img').attr('src',$(this).children('img').attr('src'));
			
		});
		
		return this;
	};
	
})(jQuery);


jQuery(document).ready(function(){
	
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
	
	var params={
		idx:$("#idx").val()
	};

	var url = "../estimate/selectPatiEstimate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$('#main_photo').html("<img src='"+_setPhoto(data.master.photo1, data.master.eType)+"'>");
			
			$('#thumb_photo1').html("<div class='overlay'></div><img src='"+_setPhoto(data.master.photo1, data.master.eType)+"'>");
			$('#thumb_photo2').html("<div class='overlay'></div><img src='"+_setPhoto(data.master.photo2, data.master.eType)+"'>");
			$('#thumb_photo3').html("<div class='overlay'></div><img src='"+_setPhoto(data.master.photo3, data.master.eType)+"'>");
			$('#thumb_photo4').html("<div class='overlay'></div><img src='"+_setPhoto(data.master.photo4, data.master.eType)+"'>");
			$('#thumb_photo5').html("<div class='overlay'></div><img src='"+_setPhoto(data.master.photo5, data.master.eType)+"'>");
			$('#thumb_photo6').html("<div class='overlay'></div><img src='"+_setPhoto(data.master.photo6, data.master.eType)+"'>");
			
			var vHtml1 = "";
			vHtml1 += "<div class='row'><div class='col-lg-12'><h1 class='pati_main_title'>"+_strEType(data.master.eType)+"</h1></div></div>";
			vHtml1 += "<div class='space-15'></div>";
			vHtml1 += "<div class='row'><div class='col-lg-12'><div class='pati_main_line'></div></div></div>";
			vHtml1 += "<div class='space-30'></div>	";
			vHtml1 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>제목</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.title+"</p></div></div>";
			vHtml1 += "<div class='space-15'></div>";
			vHtml1 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>고객</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.nickname+"</p></div></div>";
			vHtml1 += "<div class='space-15'></div>";
			vHtml1 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>지역</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.area1+" "+data.master.area2+"</p></div></div>";
			vHtml1 += "<div class='space-15'></div>";
			vHtml1 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>층수</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.elevatorYn+"/"+data.master.floor+"</p></div></div>";
			vHtml1 += "<div class='space-15'></div>";
			vHtml1 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>희망일</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.pickupDate+"</p></div></div>";
			vHtml1 += "<div class='space-90'></div>";
			if(data.master.eType == "2"){
				vHtml1 += "<div class='row'><div class='col-lg-12'><button class='btn btn_default_03' type='button' onClick='doPriceDetail()'><span>견적 참여하기</span></button></div></div>";
			}else{
				vHtml1 += "<div class='row'><div class='col-lg-12'><button class='btn btn_default_03' type='button' onClick='doPrice()'><span>견적 참여하기</span></button></div></div>";
			}
			
			$('#mainTitle').html(vHtml1);
			
			var vHtml2 = "";
			if(data.master.eType == "0")
			{
				vHtml2 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>품목</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.itemCat+"</p></div></div>";
				vHtml2 += "<div class='space-15'></div>";
				vHtml2 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>모델명</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.medelName+"</p></div></div>";
				vHtml2 += "<div class='space-15'></div>";
				vHtml2 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>연식</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.year+"</p></div></div>";
				vHtml2 += "<div class='space-15'></div>";
				vHtml2 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참고사항</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.content+"</p></div></div>";
			}else if(data.master.eType == "1"){
				vHtml2 += "<div class='row'>";
				for(var i=0; i<data.detail.length; i++)
				{
					vHtml2 += "<div class='col-lg-4'>";
					vHtml2 += "<div class='pati_multi_bg'>";
					vHtml2 += "<div class='row'><div class='col-lg-12'><h2 class='pati_main_sub_title01'>"+data.detail[i].itemCat+"</h2></div></div>";
					vHtml2 += "<div class='space-40'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-5'><h2 class='pati_main_sub_title'>세부</h2></div><div class='col-lg-7'><h2 class='pati_main_sub_content'>"+data.detail[i].manufacturer+"</h2></div></div>";
					vHtml2 += "<div class='space-20'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-5'><h2 class='pati_main_sub_title'>모델명 </h2></div><div class='col-lg-7'><h2 class='pati_main_sub_content'>"+data.detail[i].medelName+"</h2></div></div>";
					vHtml2 += "<div class='space-20'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-5'><h2 class='pati_main_sub_title'>연식</h2></div><div class='col-lg-7'><h2 class='pati_main_sub_content'>"+data.detail[i].year+"</h2></div></div>";
					vHtml2 += "<div class='space-20'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-5'><h2 class='pati_main_sub_title'>수량</h2></div><div class='col-lg-7'><h2 class='pati_main_sub_content'>"+data.detail[i].itemQty+"</h2></div></div>";
					vHtml2 += "</div>";
					vHtml2 += "</div>";
					if(i > 0 && i%3 == 2)
					{
						vHtml2 += "</div>";
						vHtml2 += "<div class='space-15'></div>";
						vHtml2 += "<div class='row'>";
					}
				}
				vHtml2 += "</div>";
				vHtml2 += "<div class='space-60'></div>";
				vHtml2 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참고사항</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.content+"</p></div></div>";
			}else if(data.master.eType == "2"){
				vHtml2 += "<div class='row'>";
				for(var i=0; i<data.detail.length; i++)
				{
					vHtml2 += "<div class='col-lg-4'>";
					vHtml2 += "<div class='pati_multi_bg'>";
					vHtml2 += "<div class='row'><div class='col-lg-12'><h2 class='pati_main_sub_title01'>철거</h2></div></div>";
					vHtml2 += "<div class='space-40'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-6'><h2 class='pati_main_sub_title'>종류</h2></div><div class='col-lg-6'><h2 class='pati_main_sub_content'>"+data.detail[i].itemCat+"</h2></div></div>";
					vHtml2 += "<div class='space-20'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-6'><h2 class='pati_main_sub_title'>철거 유뮤 </h2></div><div class='col-lg-6'><h2 class='pati_main_sub_content'>"+data.detail[i].manufacturer+"</h2></div></div>";
					vHtml2 += "<div class='space-20'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-6'><h2 class='pati_main_sub_title'>평수</h2></div><div class='col-lg-6'><h2 class='pati_main_sub_content'>"+data.detail[i].medelName+"</h2></div></div>";
					vHtml2 += "<div class='space-20'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-6'><h2 class='pati_main_sub_title'>사이즈</h2></div><div class='col-lg-6'><h2 class='pati_main_sub_content'>"+data.detail[i].year+"</h2></div></div>";
					vHtml2 += "</div>";
					vHtml2 += "</div>";
					if(i > 0 && i%3 == 2)
					{
						vHtml2 += "</div>";
						vHtml2 += "<div class='space-15'></div>";
						vHtml2 += "<div class='row'>";
					}
				}
				vHtml2 += "</div>";
				vHtml2 += "<div class='space-60'></div>";
				vHtml2 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참고사항</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.content+"</p></div></div>";
			}
			
			$('#sub_content').html(vHtml2);
			
			$('.pati_select_img_thumb').image_gallery();
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
})

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

function _strEType(e_type) {
	if(e_type==0) {
		return '가전/가구 매입';
	} else if(e_type==1){
		return '다량 매입';
	} else {
		return '철거/원상복구';
	}
}

function _setPhoto(photo, e_type) {          
	if(photo) {
		return '../common/file/imageDownload.do?fileNewName='+photo;
	} else {
		if(e_type==2){
			return '../images/review/blank_destory.jpg';
		} else{
			return '../images/review/blank_bulk.jpg';
		}            
	}
}

function doPrice()
{
	$("#price").val("");
	$('#modal_price').modal();
}

function  doCancelPrice()
{
	$('#modal_price').modal("hide");
}

function doSavePrice()
{
	idx = $("#idx").val();
	var params={
			estimateIdx:$("#idx").val(),
			price:$("#price").val()
	};	
	
	var url = "../estimate/insertPatiEstimate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적에 참여하였습니다.");
			document.frm.idx.value = idx;
			document.frm.action = "modifyPatiEstimate.do?idx="+idx;
			document.frm.submit();	
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doPriceDetail()
{
	for(var i=1; i<=11; i++)
	{
		var vId = i;
		if(i<10) vId = "0"+i;
		
		$("#item"+vId).val("");
		$("#desc"+vId).val("");
		$("#amt"+vId).val("");
		$("#vat"+vId).val("");
	}
	
	$("#content").val("");
	$("#discoutContent").val("");
	
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
	idx = $("#idx").val();
	var params={
			estimateIdx:$("#idx").val(),
			totalAmt:$("#totalAmt").val(),
			item01:$("#item01").val(),
			item02:$("#item02").val(),
			item03:$("#item03").val(),
			item04:$("#item04").val(),
			item05:$("#item05").val(),
			item06:$("#item06").val(),
			item07:$("#item07").val(),
			item08:$("#item08").val(),
			item09:$("#item09").val(),
			item10:$("#item10").val(),
			item11:$("#item11").val(),
			desc01:$("#desc01").val(),
			desc02:$("#desc02").val(),
			desc03:$("#desc03").val(),
			desc04:$("#desc04").val(),
			desc05:$("#desc05").val(),
			desc06:$("#desc06").val(),
			desc07:$("#desc07").val(),
			desc08:$("#desc08").val(),
			desc09:$("#desc09").val(),
			desc10:$("#desc10").val(),
			desc11:$("#desc11").val(),
			amt01:cfnNumberRemoveCommaZero($("#amt01").val()),
			amt02:cfnNumberRemoveCommaZero($("#amt02").val()),
			amt03:cfnNumberRemoveCommaZero($("#amt03").val()),
			amt04:cfnNumberRemoveCommaZero($("#amt04").val()),
			amt05:cfnNumberRemoveCommaZero($("#amt05").val()),
			amt06:cfnNumberRemoveCommaZero($("#amt06").val()),
			amt07:cfnNumberRemoveCommaZero($("#amt07").val()),
			amt08:cfnNumberRemoveCommaZero($("#amt08").val()),
			amt09:cfnNumberRemoveCommaZero($("#amt09").val()),
			amt10:cfnNumberRemoveCommaZero($("#amt10").val()),
			amt11:cfnNumberRemoveCommaZero($("#amt11").val()),
			vat01:cfnNumberRemoveCommaZero($("#vat01").val()),
			vat02:cfnNumberRemoveCommaZero($("#vat02").val()),
			vat03:cfnNumberRemoveCommaZero($("#vat03").val()),
			vat04:cfnNumberRemoveCommaZero($("#vat04").val()),
			vat05:cfnNumberRemoveCommaZero($("#vat05").val()),
			vat06:cfnNumberRemoveCommaZero($("#vat06").val()),
			vat07:cfnNumberRemoveCommaZero($("#vat07").val()),
			vat08:cfnNumberRemoveCommaZero($("#vat08").val()),
			vat09:cfnNumberRemoveCommaZero($("#vat09").val()),
			vat10:cfnNumberRemoveCommaZero($("#vat10").val()),
			vat11:cfnNumberRemoveCommaZero($("#vat11").val()),
			content:$("#content").val(),
			discoutContent:$("#discoutContent").val()
	};	
	
	var url = "../estimate/insertPatiEstimateDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적에 참여하였습니다.");
			document.frm.idx.value = idx;
			document.frm.action = "modifyPatiEstimate.do?idx="+idx;
			document.frm.submit();	
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

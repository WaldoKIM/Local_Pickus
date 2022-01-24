jQuery(document).ready(function(){
	
	cfnLoginCheck("2");
	
	$("#price").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});
	
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

	var url = "../estimate/selectEstimateDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.master.state == "6")
			{
				alert("취소된 견적입니다.");
				location.href = "../estimate/estimateList1.do";
			}
			
			fnCreateMasterImage(data.master);

			fnCreateMaster(data.master);
			
			if(data.master.eType == "0"){
				fnCreateDetail(data.master, data.master.eType, data.master.content)
			}else if(data.master.eType == "1"){
				fnCreateDetailList(data.detail, data.master.eType, data.master.content)
			}else if(data.master.eType == "2"){
				if(data.detail.length == 1){
					fnCreateDetail(data.detail[0], data.master.eType, data.master.content)
				}else{
					fnCreateDetailList(data.detail, data.master.eType, data.master.content)
				}
			}
			
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

function fnCreateMasterImage(data)
{
	var vHtml1 = "";
	var vHtml2 = "";
	var nCnt = 0;
	if(data.photo1)
	{
		vHtml1 += "<li><img class='rotate"+data.photo1Rotate+"' src='"+_setPhoto(data.photo1, data.eType)+"'></li>";
		vHtml2 += "<li><a data-slide-index='"+nCnt+"' href=''><img class='rotate"+data.photo1Rotate+"' src='"+_setPhoto(data.photo1, data.eType)+"'></a></li>";
		nCnt++;
	}	
	if(data.photo2)
	{
		vHtml1 += "<li><img class='rotate"+data.photo2Rotate+"' src='"+_setPhoto(data.photo2, data.eType)+"'></li>";
		vHtml2 += "<li><a data-slide-index='"+nCnt+"' href=''><img class='rotate"+data.photo2Rotate+"' src='"+_setPhoto(data.photo2, data.eType)+"'></a></li>";
		nCnt++;
	}	
	
	if(data.photo3)
	{
		vHtml1 += "<li><img class='rotate"+data.photo3Rotate+"' src='"+_setPhoto(data.photo3, data.eType)+"'></li>";
		vHtml2 += "<li><a data-slide-index='"+nCnt+"' href=''><img class='rotate"+data.photo3Rotate+"' src='"+_setPhoto(data.photo3, data.eType)+"'></a></li>";
		nCnt++;
	}
	
	if(data.photo4)
	{
		vHtml1 += "<li><img class='rotate"+data.photo4Rotate+"' src='"+_setPhoto(data.photo4, data.eType)+"'></li>";
		vHtml2 += "<li><a data-slide-index='"+nCnt+"' href=''><img class='rotate"+data.photo4Rotate+"' src='"+_setPhoto(data.photo4, data.eType)+"'></a></li>";
		nCnt++;
	}
	
	if(data.photo5)
	{
		vHtml1 += "<li><img class='rotate"+data.photo5Rotate+"' src='"+_setPhoto(data.photo5, data.eType)+"'></li>";
		vHtml2 += "<li><a data-slide-index='"+nCnt+"' href=''><img class='rotate"+data.photo5Rotate+"' src='"+_setPhoto(data.photo5, data.eType)+"'></a></li>";
		nCnt++;
	}
	
	if(data.photo6)
	{
		vHtml1 += "<li><img class='rotate"+data.photo6Rotate+"' src='"+_setPhoto(data.photo6, data.eType)+"'></li>";
		vHtml2 += "<li><a data-slide-index='"+nCnt+"' href=''><img class='rotate"+data.photo6Rotate+"' src='"+_setPhoto(data.photo6, data.eType)+"'></a></li>";
		nCnt++;
	}	
	
	if(data.photo7)
	{
		vHtml1 += "<li><img class='rotate"+data.photo7Rotate+"' src='"+_setPhoto(data.photo7, data.eType)+"'></li>";
		vHtml2 += "<li><a data-slide-index='"+nCnt+"' href=''><img class='rotate"+data.photo7Rotate+"' src='"+_setPhoto(data.photo7, data.eType)+"'></a></li>";
		nCnt++;
	}
	
	if(data.photo8)
	{
		vHtml1 += "<li><img class='rotate"+data.photo8Rotate+"' src='"+_setPhoto(data.photo8, data.eType)+"'></li>";
		vHtml2 += "<li><a data-slide-index='"+nCnt+"' href=''><img class='rotate"+data.photo8Rotate+"' src='"+_setPhoto(data.photo8, data.eType)+"'></a></li>";
		nCnt++;
	}
	
	if(data.photo9)
	{
		vHtml1 += "<li><img class='rotate"+data.photo9Rotate+"' src='"+_setPhoto(data.photo9, data.eType)+"'></li>";
		vHtml2 += "<li><a data-slide-index='"+nCnt+"' href=''><img class='rotate"+data.photo9Rotate+"' src='"+_setPhoto(data.photo9, data.eType)+"'></a></li>";
		nCnt++;
	}
	
	var vHtml = "";
	vHtml += "<ul id='view_slider'>";
	vHtml += vHtml1;
	vHtml += "</ul>";
	vHtml += "<div id='bx-pager'>";
	vHtml += "<ul>";
	vHtml += vHtml2;
	vHtml += "</ul>";
	vHtml += "</div>";
	
	$("#thumb_photo").html(vHtml);
	
	$('#view_slider').bxSlider({
		auto: false,					// 자동 슬라이드 사용여부
		controls: false,				// 양옆컨트롤(prev/next) 사용여부
		speed: 1000,
		preloadImages: 'all',
		pager : true,
		pagerCustom:'#bx-pager'
	});
}

function fnCreateMaster(data)
{
	var vHtml1 = "";
	vHtml1 += "<h1>"+_strEType(data.eType)+"</h1>";
	vHtml1 += "<dl>";
	vHtml1 += "<dt class='col-xs-3'>제목</dt><dd class='col-xs-9'>"+data.title+"</dd>";
	vHtml1 += "<dt class='col-xs-3'>고객</dt><dd class='col-xs-9'>"+_getNickname(data.nickname)+"</dd>";
	vHtml1 += "<dt class='col-xs-3'>지역</dt><dd class='col-xs-9'>"+data.area1+" "+data.area2+"</dd>";
	vHtml1 += "<dt class='col-xs-3'>층수</dt><dd class='col-xs-9'>"+data.elevatorYn+"/"+data.floor+"</dd>";
	if(data.eType == "2"){
		vHtml1 += "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>"+data.pickupDate+"</dd>";
	}else{
		vHtml1 += "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>"+data.pickupDate+"</dd>";
	}
	vHtml1 += "</dl>";
	if(data.eType == "2"){
		vHtml1 += "<ul class='row'>";
		vHtml1 += "<li class='col-xs-6'></li>";
		vHtml1 += "<li class='col-xs-6'>";
		vHtml1 += "<a class='main_bg' href='#.' onClick='doPriceDetail()'>";
		vHtml1 += "견적 참여하기";
		vHtml1 += "</a>";
		vHtml1 += "</li>";
		vHtml1 += "</ul>";	
	}else{
		vHtml1 += "<ul class='row'>";
		vHtml1 += "<li class='col-xs-6'></li>";
		vHtml1 += "<li class='col-xs-6'>";
		vHtml1 += "<a class='main_bg' href='#.' onClick='doPrice()'>";
		vHtml1 += "견적 참여하기";
		vHtml1 += "</a>";
		vHtml1 += "</li>";
		vHtml1 += "</ul>";	
	}

	$('#mainTitle').html(vHtml1);	
}

function fnCreateDetail(data, eType, content)
{
	var vHtml = "";
	vHtml += "<colgroup>";
	vHtml += "<col style='width: 20%' />";
	vHtml += "<col style='width: 30%' />";
	vHtml += "<col style='width: 20%' />";
	vHtml += "<col style='width: 30%' />";
	vHtml += "</colgroup>";
	if(eType == "0")
	{
		vHtml += "<tr>";
		vHtml += "<th>품목</th><td>"+data.itemCat+" "+cfNvl1(data.itemCatDtl)+"</td>";
		vHtml += "<th>제조사</th><td>"+data.manufacturer+"</td>";
		vHtml += "</tr>";
		vHtml += "<tr>";
		vHtml += "<th>모델명</th><td>"+cfNvl2(data.medelName,"-")+"</td>";
		vHtml += "<th>연식</th><td>"+data.year+"</td>";
		vHtml += "</tr>";
		vHtml += "<tr>";
		vHtml += "<th>참고사항</th><td colspan='3'>"+content+"</td>";
		vHtml += "</tr>";
	}else if(eType == "2"){ //철거
		vHtml += "<tr>";
		vHtml += "<th>철거종류</th><td>"+data.pullKind+"</td>";
		vHtml += "<th>천장/바닥 철거</th><td>"+cfNvl2(data.pullFloorBottom,"-")+"</td>";
		vHtml += "</tr>";
		vHtml += "<tr>";
		vHtml += "<th>철거평수</th><td>"+cfNvl2(data.pullSpace,"-")+"</td>";
		vHtml += "<th>철거사이즈</th><td>"+cfNvl2(data.pullSize,"-")+"</td>";
		vHtml += "</tr>";
		vHtml += "<tr>";
		vHtml += "<th>참고사항</th><td> colspan='3'"+content+"</td>";
		vHtml += "</tr>";
		
	}
	$('#subDetail').html(vHtml);
}

function fnCreateDetailList(data, eType, content)
{
	var vHtml = "";
	if(eType == "1")
	{
		vHtml += "<colgroup>";
		vHtml += "<col style='width: 10%' />";
		vHtml += "<col style='width: 20%' />";
		vHtml += "<col style='width: 20%' />";
		vHtml += "<col style='width: 20%' />";
		vHtml += "<col style='width: 15%' />";
		vHtml += "<col style='width: 15%' />";
		vHtml += "</colgroup>";
		vHtml += "<tr>";
		vHtml += "<th>품목</th>";
		vHtml += "<th>세부카테고리</th>";
		vHtml += "<th>제조사</th>";
		vHtml += "<th>모델명</th>";
		vHtml += "<th>년식</th>";
		vHtml += "<th>수량</th>";
		vHtml += "</tr>";
		for(var i=0; i<data.length; i++)
		{
			vHtml += "<tr>";
			vHtml += "<td>"+cfNvl2(data[i].itemCat,"-")+"</td>";
			vHtml += "<td>"+cfNvl2(data[i].itemCatDtl,"-")+"</td>";
			vHtml += "<td>"+cfNvl2(data[i].manufacturer,"-")+"</td>";
			vHtml += "<td>"+cfNvl2(data[i].medelName,"-")+"</td>";
			vHtml += "<td>"+cfNvl2(data[i].year,"-")+"</td>";
			vHtml += "<td>"+cfNvl2(data[i].itemQty,"-")+"</td>";
			vHtml += "</tr>";
		}
		vHtml += "<tr>";
		vHtml += "<th>참고사항</th>";
		vHtml += "<td colspan='5'>"+content+"</td>";
		vHtml += "</tr>";
	}else if(eType == "2"){ //철거
		vHtml += "<colgroup>";
		vHtml += "<col style='width: 30%' />";
		vHtml += "<col style='width: 30%' />";
		vHtml += "<col style='width: 20%' />";
		vHtml += "<col style='width: 20%' />";
		vHtml += "</colgroup>";
		vHtml += "<tr>";
		vHtml += "<th>철거종류</th>";
		vHtml += "<th>천장/바닥 철거 유뮤</th>";
		vHtml += "<th>철거평수</th>";
		vHtml += "<th>철거사이즈</th>";
		vHtml += "</tr>";
		for(var i=0; i<data.length; i++)
		{
			vHtml += "<tr>";
			vHtml += "<td>"+cfNvl2(data[i].pullKind,"-")+"</td>";
			vHtml += "<td>"+cfNvl2(data[i].pullFloorBottom,"-")+"</td>";
			vHtml += "<td>"+cfNvl2(data[i].pullSpace,"-")+"</td>";
			vHtml += "<td>"+cfNvl2(data[i].pullSize,"-")+"</td>";
			vHtml += "</tr>";
		}
		vHtml += "<tr>";
		vHtml += "<th>참고사항</th>";
		vHtml += "<td colspan='3'>"+content+"</td>";
		vHtml += "</tr>";
	}	
	$('#subList').html(vHtml);
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

function doPrice()
{
	var vPoint = parseInt($("#userPoint").val());
	if(vPoint < 100){
		alert("충전금이 부족하여 견적에 참여하실 수 없습니다.");
		return;
	}
	$("#price").val("");
	$('#modal_price').modal();
}

function  doCancelPrice()
{
	$('#modal_price').modal("hide");
}

function doPriceZero()
{
	doBtnDisablePrice();
	var idx = $("#idx").val();
	var params={
			estimateIdx:$("#idx").val(),
			price:0
	};	
	
	var url = "../estimate/insertEstimateDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적에 참여하였습니다.");
			/*
			document.frm.idx.value = idx;
			document.frm.action = "partnerestimateList1.do?idx="+idx;
			document.frm.submit();
			*/
			location.href = "estimateList1.do";
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}
function doSavePrice()
{
	doBtnDisablePrice();
	var idx = $("#idx").val();
	var params={
			estimateIdx:$("#idx").val(),
			price:$("#price").val()
	};	
	
	var url = "../estimate/insertEstimateDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적에 참여하였습니다.");
			/*
			document.frm.idx.value = idx;
			document.frm.action = "partnerestimateList1.do?idx="+idx;
			document.frm.submit();	
			*/
			location.href = "estimateList1.do";
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doBtnDisablePrice()
{
	$("#btnCanCelPrice").attr("disabled", true);
	$("#btnPriceZero").attr("disabled", true);
	$("#btnSavePrice").attr("disabled", true);
	$("#btnCancelPriceDetail").attr("disabled", true);
	$("#btnSavePriceDetail").attr("disabled", true);
	
}
function doPriceDetail()
{
	var vPoint = parseInt($("#userPoint").val());
	if(vPoint < 100){
		alert("충전금이 부족하여 견적에 참여하실 수 없습니다.");
		return;
	}

	
	for(var i=1; i<=11; i++)
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
	doBtnDisablePrice();
	var idx = $("#idx").val();
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
	
	var url = "../estimate/insertEstimateDetailPrice.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적에 참여하였습니다.");
			/*
			document.frm.idx.value = idx;
			document.frm.action = "modifyPatiEstimate.do?idx="+idx;
			document.frm.submit();	
			*/
			location.href = "estimateList1.do";
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

var estimateCnt = 0;
var imageMaxCnt = 9;
var isClose = false;
jQuery(document).ready(function(){
	cfnLoginCheck("0","8");

	var now = new Date();

	var Year = now.getFullYear();
	
	var Month   = now.getMonth()+1;
	if(Month < 10) Month = "0"+Month
	
	var Day   = now.getDate();
	if(Day < 10) Day = "0"+Day
	
	var toDate = Year +"-" + Month + "-"+ Day;
	
	$( "#pickupDate" ).datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr",
		minDate:getDateAsValue(toDate)
	});
	
	//createImage();
	for(var i=1; i<=imageMaxCnt; i++)
	{
		var vComp    = "photo"+i;
		var vDivComp = "divPhoto"+i;
		var vText    = "사진파일 업로드";
		
		doInitImage(vComp, vDivComp, vText);

	}
	$('#itemCatDtl').change(function(){ 
		if($('#itemCatDtl').val() == "기타")
		{
			$("#itemCatDtlEtc").show();
		}else{
			$("#itemCatDtlEtc").hide();
		}
	});

	var pullKinds = cfnGetRemoveItem();
	var vKindHtml = "<option value='' selected>선택</option>";
	for(var i=0; i<pullKinds.length; i++)
	{
		vKindHtml += "<option value='"+pullKinds[i]+"' selected>"+pullKinds[i]+"</option>";
	}
	vKindHtml += "<option value='기타' selected>기타</option>";
	$('#pullKind').html(vKindHtml);
	$('#pullKind').change(function(){ 
		var itemCat = $('#pullKind').val();
		$('#pullFloorBottom').val("");
		$('#pullSpace').val("");
		$('#pullSize').val("");
		doChangePullKind(itemCat);
	});
	
	
	var params={};	
	
	var url1 = "../common/selectArea1List.do";	
	$.ajax({
		type: "POST",
		url : url1,
		data: params,
		success : function(data) {
			$("#area1").html("");
			var fvHtml="<option value=\"\" selected>선택</option>";
			for(var i=0; i<data.row.length; i++)
			{
				fvHtml += "<option value='"+data.row[i].area1+"'>"+data.row[i].area1+"</option>";
			}

			$("#area1").html(fvHtml);
			$('#area1').change(function(){ 
				doChangeArea1(); 
			}); 
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
})

function doChangeArea1()
{
	var params={
			area1:$("#area1").val()
	};	
	
	var url = "../common/selectArea2List.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#area2").html("");
			var fvHtml="<option value=\"\" selected>선택</option>";
			for(var i=0; i<data.row.length; i++)
			{
				fvHtml += "<option value='"+data.row[i].area2+"'>"+data.row[i].area2+"</option>";
			}

			$("#area2").html(fvHtml);
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}
function doInitImage(vComp, vDivComp, vText)
{
	$("#"+vComp).val("");
	
	var fileId = "input_"+vComp+"_file";
	var formId = "form_"+vComp;
	var vHtml1 = "";
	vHtml1 += "<div class='estimate_image_click_bg'>";
	vHtml1 += "<input type='file' id='"+fileId+"' accept='image/*' style='height: 370px;'  onchange=\"cfnGetFileSize(this);\"/>";
	vHtml1 += "<img src='../img/common/estimate_icon_image_info.png'/>";
	vHtml1 += "<p>"+vText+"</p>";
	vHtml1 += "</div>";
	vHtml1 += "<form id='"+formId+"' name='"+formId+"' method='post' enctype='multipart/form-data'></form>";
	$("#"+vDivComp).empty().html(vHtml1);
	
	$("#"+fileId).bind('change', function() {
		var fv_file = this.files[0].name;
		var fv_type = fv_file.substring(fv_file.length-3,fv_file.length);
		fv_type = fv_type.toUpperCase();
		if(fv_type=="JPG"||fv_type=="PNG"||fv_type=="GIF"||fv_type=="BMP")
		{
			var form = $('#'+formId);
			var formData = new FormData(form);	
			formData.append('files', this.files[0]);
			$.ajax({
				url : "../common/file/imageUploadJSon.do",
				data : formData,
				type : 'POST',
				enctype : 'multipart/form-data',
				processData : false,
				contentType : false,
				dataType : 'json',
				cache : false,
				success : function(data) {
					var vFileName = data.uploadPath+data.fileName;
					$("#"+vComp).val(vFileName);
					$("#"+vComp+"Rotate").val(data.fileRotation);
					var vHtml2 = "";
					vHtml2 += "<div class='estimate_image_bg'>";
					vHtml2 += "<div class='estimate_image_del_bg'>";
					vHtml2 += "<a href='#none' onClick='doInitImage(\""+vComp+"\",\""+vDivComp+"\",\""+vText+"\");'>";
					vHtml2 += "<i class='xi-close-min'></i>";
					vHtml2 += "</a>";
					vHtml2 += "</div>";
					vHtml2 += "<img class='rotate"+data.fileRotation+"' src='../common/file/imageDownload.do?fileNewName="+vFileName+"' style='width:100%;height:340px'/>";
					vHtml2 += "</div>";
					$("#"+vDivComp).empty().html(vHtml2);
				}
			});
		}else{
			alert("이미지 파일만 업로드 가능합니다.");
		}
	});	
}

function doSelectItemList()
{
	var params={
			subKey:$("#subKey").val()
	};	
	
	var url = "../estimate/selectEstimateMultiList.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			estimateCnt = data.length;
			/*
			if(estimateCnt > 6){
				imageMaxCnt = estimateCnt;
			}else{
				imageMaxCnt = 6;
			}
			*/
			$('#multiList').html("");
			
			var vHtml = "";
			for(var i=0; i<data.length; i++)
			{
				vHtml += "<tr>";
				vHtml += "<td class='text-center'>"+cfNvl2(data[i].pullKind,"-")+"</td>";
				vHtml += "<td class='text-center'>"+cfNvl2(data[i].pullFloorBottom,"-")+"</td>";
				vHtml += "<td >"+cfNvl2(data[i].pullSpace,"-")+"</td>";
				vHtml += "<td class='text-center'>"+cfNvl2(data[i].pullSize,"-")+"</td>";
				vHtml += "<td class='text-center'>";
				vHtml += "<p><button class='btn_default_05' onClick='doModifyItem(\""+data[i].idx+"\")'>수정</button></p>";
				vHtml += "<p><button class='btn_default_05' onClick='doDeleteItem(\""+data[i].idx+"\")'>삭제</button></p>";
				vHtml += "</td>";
				vHtml += "</tr>";
			}
			$('#multiList').html(vHtml);
			createImage();
			
			if(estimateCnt < 9)
			{
				if(isClose)
				{
					$('#modal_regist_item').modal("hide");
				}else{
					$('#flag').val("I");
					$('#idx').val("");
					$('#pullKind').val("");
					$('#pullFloorBottom').val("");
					$('#pullSpace').val("");
					$('#pullSize').val("");
					doChangePullKind("");					
				}
			}else{
				$('#modal_regist_item').modal("hide");
			}			

		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}


function doAddItem()
{
	if(estimateCnt == 9){
		alert("최대 9개까지만 등록하실수 있습니다.");
		return;
	}
	
	$('#flag').val("I");
	$('#idx').val("");
	$('#pullKind').val("");
	$('#pullFloorBottom').val("");
	$('#pullSpace').val("");
	$('#pullSize').val("");
	doChangePullKind("");
	
	$("#divAddItem").show();
	$("#divModifyItem").hide();
	$('#modal_regist_item').modal();
}

function doModifyItem(idx)
{
	var params={
			idx:idx
	};	
	
	var url = "../estimate/selectEstimateMultiDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$('#flag').val("U");
			$('#idx').val(data.idx);
			$('#pullKind').val(data.pullKind);
			$('#pullFloorBottom').val(data.pullFloorBottom);
			$('#pullSpace').val(data.pullSpace);
			$('#pullSize').val(data.pullSize);
			doChangePullKind(data.pullKind);
			
			$("#divAddItem").hide();
			$("#divModifyItem").show();
			
			$('#modal_regist_item').modal();
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});

}

function doSaveItem()
{
	if(!cfnNullCheckSelect($('#pullKind').val(),"철거종류")) return;
	if($("#pullFloorBottomChk").val() == "1"){
		if(!cfnNullCheckSelect($('#pullFloorBottom').val(),"천장/바닥철거")) return;
	}
	if($("#pullSpaceChk").val() == "1"){
		if(!cfnNullCheckInput($('#pullSpace').val(),"철거평수 ")) return;
	}
	if($("#pullSizeChk").val() == "1"){
		if(!cfnNullCheckInput($('#pullSize').val(),"철거사이즈")) return;
	}

	var params={
			idx:$("#idx").val(),
			subKey:$("#subKey").val(),
			flag:$('#flag').val(),
			pullKind:$('#pullKind').val(),
			pullFloorBottom:$('#pullFloorBottom').val(),
			pullSpace:$('#pullSpace').val(),
			pullSize:$('#pullSize').val()
	};	
	
	var url = "../estimate/saveEstimateMulti.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			isClose = false;
			doSelectItemList();
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doCompleteItem()
{
	if(!cfnNullCheckSelect($('#pullKind').val(),"철거종류")) return;
	if($("#pullFloorBottomChk").val() == "1"){
		if(!cfnNullCheckSelect($('#pullFloorBottom').val(),"천장/바닥철거")) return;
	}
	if($("#pullSpaceChk").val() == "1"){
		if(!cfnNullCheckInput($('#pullSpace').val(),"철거평수 ")) return;
	}
	if($("#pullSizeChk").val() == "1"){
		if(!cfnNullCheckInput($('#pullSize').val(),"철거사이즈")) return;
	}

	var params={
			idx:$("#idx").val(),
			subKey:$("#subKey").val(),
			flag:$('#flag').val(),
			pullKind:$('#pullKind').val(),
			pullFloorBottom:$('#pullFloorBottom').val(),
			pullSpace:$('#pullSpace').val(),
			pullSize:$('#pullSize').val()
	};	
	
	var url = "../estimate/saveEstimateMulti.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			isClose = true;
			doSelectItemList();
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doChangePullKind(itemCat)
{
	$("#pullSizeText").html("");
	if(itemCat == "붙박이장")
	{
		$("#pullSizeText").html("몇자 또는 몇 미터로 작성해 주세요.");
	}else if(itemCat == "가벽철거"){
		$("#pullSizeText").html("넓이(m) x 높이(m) 로 작성해 주세요.");
	}else if(itemCat == "간판철거"){
		$("#pullSizeText").html("가로(m) x 세로(m) 길이로 작성해 주세요.");
	}
	
	if(itemCat == "붙박이장" || itemCat == "간판철거" || itemCat == "가벽철거"){
		$("#divPullFloorBottom").hide();
		$("#divPullSpace").hide();
		$("#divPullSize").show();
		$("#pullFloorBottomChk").val("0");
		$("#pullSpaceChk").val("0");
		$("#pullSizeChk").val("1");
	}else if(itemCat == "인테리어" || itemCat == "내부철거" || itemCat == "타일철거"){
		$("#divPullFloorBottom").show();
		$("#divPullSpace").show();
		$("#divPullSize").hide();
		$("#pullFloorBottomChk").val("1");
		$("#pullSpaceChk").val("1");
		$("#pullSizeChk").val("0");
	}else if(itemCat == "건물철거" || itemCat == "원상복구"){
		$("#divPullFloorBottom").hide();
		$("#divPullSpace").show();
		$("#divPullSize").hide();
		$("#pullFloorBottomChk").val("0");
		$("#pullSpaceChk").val("1");
		$("#pullSizeChk").val("0");
	}else if(itemCat == "폐기물처리"){
		$("#divPullFloorBottom").hide();
		$("#divPullSpace").show();
		$("#divPullSize").show();
		$("#pullFloorBottomChk").val("0");
		$("#pullSpaceChk").val("1");
		$("#pullSizeChk").val("1");
	}else if(itemCat == "모두철거" || itemCat == "기타"){
		$("#divPullFloorBottom").show();
		$("#divPullSpace").show();
		$("#divPullSize").show();
		$("#pullFloorBottomChk").val("1");
		$("#pullSpaceChk").val("1");
		$("#pullSizeChk").val("1");
	}else{
		$("#divPullFloorBottom").show();
		$("#divPullSpace").show();
		$("#divPullSize").show();
		$("#pullFloorBottomChk").val("1");
		$("#pullSpaceChk").val("1");
		$("#pullSizeChk").val("1");
	}
}
function doDeleteItem(idx)
{
	var params={
			idx:idx,
			flag:"D"
	};	
	
	var url = "../estimate/saveEstimateMulti.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			doSelectItemList();
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doRegistEstimate()
{
	
	var itemCatDtl = "";
	if($('#itemCatDtl').val() == "기타")
	{
		itemCatDtl = $("#itemCatDtlEtc").val();
	}else{
		itemCatDtl = $("#itemCatDtl").val();
	}
	
	if(!cfnNullCheckSelect($("#area1").val(), "기본주소")) return;
	if(!cfnNullCheckSelect($("#area2").val(), "기본주소")) return;
	if(!cfnNullCheckInput($("#area3").val(), "상세주소")) return;
	if(!cfnNullCheckInput($("#floor").val(), "층수")) return;
	if(!cfnNullCheckInput($("#pickupDate").val(), "수거요청일")) return;
	if(!cfnNullCheckInput($("#title").val(), "철거제목")) return;
	if(!cfnNullCheckInput(itemCatDtl, "철거장소")) return;
	if(!cfnNullCheckInput($("#content").val(), "참고사항")) return;

	if(estimateCnt == 0)
	{
		alert("철거종류를 등록하십시오.");
		return;
	}
	
	var params={
			subKey:$("#subKey").val(),
			area1:$("#area1").val(),
			area2:$("#area2").val(),
			area3:$("#area3").val(),
			areaTotal:$("#area1").val()+" "+$("#area2").val()+" "+$("#area3").val(),
			floor:$("#floor").val(),
			elevatorYn:$('input[name="elevatorYn"]:checked').val(),
			pickupDate:$("#pickupDate").val(),
			itemCat:"카테고리",
			manufacturer:"카테고리",
			title:$("#title").val(),
			itemCatDtl:itemCatDtl,
			year:"",
			goodsState:"중고",
			content:$("#content").val(),
			useYear:$("#useYear").val(),
			itemQty:$("#itemQty").val(),
			photo1:$("#photo1").val(),
			photo2:$("#photo2").val(),
			photo3:$("#photo3").val(),
			photo4:$("#photo4").val(),
			photo5:$("#photo5").val(),
			photo6:$("#photo6").val(),
			photo7:$("#photo7").val(),
			photo8:$("#photo8").val(),
			photo9:$("#photo9").val(),
			photo1Rotate:$("#photo1Rotate").val(),
			photo2Rotate:$("#photo2Rotate").val(),
			photo3Rotate:$("#photo3Rotate").val(),
			photo4Rotate:$("#photo4Rotate").val(),
			photo5Rotate:$("#photo5Rotate").val(),
			photo6Rotate:$("#photo6Rotate").val(),				
			photo7Rotate:$("#photo7Rotate").val(),				
			photo8Rotate:$("#photo8Rotate").val(),				
			photo9Rotate:$("#photo9Rotate").val(),				
			eType:"2"
	};	
	
	var url = "../estimate/saveEstimate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적이 신청되었습니다.");
			location.href="../estimate/myEstimateList.do";
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}
var imagePaths = new Array();
var imageRotations = new Array();
var imageidx = 0;
var estimateCnt = 0;
var imageMaxCnt = 9;
var isClose = false;
jQuery(document).ready(function(){
	cfnLoginCheck("9");
	
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
	
	$("#useYear").html(cfnEstimateYearsCombo("선택"));
	
	$('#useYear').change(function(){ 
		$('#year').val($("#useYear option:selected").text()); 
		var itemCat = $('#itemCat').val();
		if(itemCat)
		{
			var vYear = $("#useYear").val();
			if(itemCat == "가전"){
				if(vYear >= 10)
				{
					alert("년식이 오래되어 무료수거나 수거 불가 할 수도 있습니다.");
				}
			}else if(itemCat == "가구"){
				if(vYear >= 5)
				{
					alert("년식이 오래되어 무료수거나 수거 불가 할 수도 있습니다.");
				}
			}

		}
	}); 
	
	$("#itemQty").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});
	
	createImage();
	
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
	
	var url2 = "../common/selectCategory1List.do";	
	$.ajax({
		type: "POST",
		url : url2,
		data: params,
		success : function(data) {
			$("#itemCat").html("");
			var fvHtml="<option value=\"\" selected>선택</option>";
			for(var i=0; i<data.row.length; i++)
			{
				fvHtml += "<option value='"+data.row[i].category1+"'>"+data.row[i].category1+"</option>";
			}

			$("#itemCat").html(fvHtml);
			
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

function doChangeItemCate1()
{
	var itemCat = $('#itemCat').val();
	if(itemCat == "가구")
	{
		$("#divModelName").hide();
	}else{
		$("#divModelName").show();
	}
	
	if(itemCat == "가전"){
		$("#spanYear").html("*가전 제조년식을 넣어주세요");
		$("#spanYear").show();
	}else if(itemCat == "가구"){
		$("#spanYear").html("*가구 사용년식을 넣어주세요");
		$("#spanYear").show();
	}else{
		$("#spanYear").html(itemCat+" 제조년식을 넣어주세요");
		$("#spanYear").show();
	}
	
	var params={
			category1:$('#itemCat').val()
	};	
	
	var url = "../common/selectCategory2List.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$('#itemCatDtlEtc').hide();
			$('#manufacturerEtc').hide();
			
			$("#itemCatDtl").html("");
			var fvHtml="<option value=\"\" selected>선택</option>";
			$("#manufacturer").html(fvHtml);
			if($('#itemCat').val())
			{
				for(var i=0; i<data.row.length; i++)
				{
					fvHtml += "<option value='"+data.row[i].category2+"'>"+data.row[i].category2+"</option>";
				}
	
				$("#itemCatDtl").html(fvHtml);
				$('#itemCatDtl').change(function(){
					$('#itemCatDtlEtc').val("");
					if($(this).val() == "직접입력")
					{
						$('#itemCatDtlEtc').show();
					}else{
						$('#itemCatDtlEtc').hide();
					}
				});
				
				
			}
			
			$("#itemCatDtl").html(fvHtml);
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function doChangeItemCate2()
{
	var params={
			category1:$('#itemCat').val(),
			category2:$('#itemCatDtl').val()
	};	
	
	var url = "../common/selectCategory3List.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$('#manufacturerEtc').hide();
			var fvHtml="<option value=\"\" selected>선택</option>";
			if($('#itemCatDtl').val())
			{
				for(var i=0; i<data.row.length; i++)
				{
					fvHtml += "<option value='"+data.row[i].category3+"'>"+data.row[i].category3+"</option>";
				}
			}

			$("#manufacturer").html(fvHtml);
			
			$('#manufacturer').change(function(){
				$('#manufacturerEtc').val("");
				if($(this).val() == "직접입력")
				{
					$('#manufacturerEtc').show();
				}else{
					$('#manufacturerEtc').hide();
				}
			});

		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function doImageSearch()
{
	cfnOpenPopup('../common/file/imageSearch.do','350','250','auto','auto','0','0','0');
}


function setImage(filePath, fileRotation)
{
	var idx = imagePaths.length;
	imagePaths[idx]     = filePath;
	imageRotations[idx] = fileRotation;
	createImage();
}

function doImageDel(idx)
{
	var defaultImages = new Array();
	var defaultRotations = new Array();
	var nSeq = 0;
	var nLen = imagePaths.length;
	for(var i=0; i<nLen; i++)
	{
		if(idx != i)
		{
			defaultImages[nSeq] = imagePaths[i];
			defaultRotations[nSeq] = imageRotations[i];
			nSeq++;
		}
	}
	imagePaths = new Array();
	imageRotations = new Array();
	var vCnt = defaultImages.length;
	if(vCnt > imageMaxCnt)
	{
		vCnt = imageMaxCnt;
	}
	for(var i=0; i<vCnt; i++)
	{
		imagePaths[i] = defaultImages[i];
		imageRotations[i] = defaultRotations[i];
	}
	createImage();
}


function createImage()
{
	$("#imageList").html("");
	var vHtml = "";
	var idx = imagePaths.length;
	if(idx > imageMaxCnt)
	{
		idx = imageMaxCnt;
	}
	for(var i=0; i<idx; i++)
	{
		vHtml += "<div class='col-lg-4 text-center'>";
		vHtml += "	<div class='estimate_image_bg'>";
		vHtml += "		<div class='estimate_image_del_bg'>";
		vHtml += "			<a href='#none' onClick='doImageDel("+i+");'>";
		vHtml += "				<img src='../images/estimate/estimate_icon_image_del.png'/>";
		vHtml += "			</a>";
		vHtml += "		</div>";
		vHtml += "		<img class='rotate"+imageRotations[i]+"' src='../common/file/imageDownload.do?fileNewName="+imagePaths[i]+"'/>";
		vHtml += "	</div>";
		vHtml += "</div>";
	}
	if(idx < imageMaxCnt)
	{
		vHtml += "<div class='col-lg-4 text-center'>";
		vHtml += "	<div class='estimate_image_click_bg'>";
		vHtml += "		<a href='#none' onClick='doImageSearch();'>";
		vHtml += "			<p>";
		vHtml += "				<img src='../images/estimate/estimate_icon_image_info.png'/>";
		vHtml += "			</p>";
		vHtml += "			<p>";
		vHtml += "				<span class='estimate_image_label2'>사진파일 업로드 </span>";
		vHtml += "			</p>";
		vHtml += "		</a>";
		vHtml += "	</div>";
		vHtml += "</div>";
	}
	for(var i=idx+1; i<imageMaxCnt; i++)
	{
		vHtml += "<div class='col-lg-4 text-center'>";
		vHtml += "	<div class='estimate_image_register_bg'>";
		vHtml += "		<img src='../images/estimate/estimate_icon_image_regist.png'/>";
		vHtml += "	</div>";
		vHtml += "</div>";
	}
	$("#imageList").html(vHtml);
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
			//estimateCnt = data.length;
			estimateCnt = 0;
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
				vHtml += "<td class='text-center'>"+data[i].itemCat+"</td>";
				vHtml += "<td class='text-center'>"+data[i].itemCatDtl+"</td>";
				vHtml += "<td class='text-center'>"+data[i].manufacturer+"</td>";
				vHtml += "<td >"+data[i].medelName+"</td>";
				vHtml += "<td class='text-center'>"+data[i].year+"</td>";
				vHtml += "<td class='text-center'>"+data[i].itemQty+"</td>";
				vHtml += "<td class='text-center'>";
				vHtml += "<p><button class='btn_default_05' onClick='doModifyItem(\""+data[i].idx+"\")'>수정</button></p>";
				vHtml += "<p><button class='btn_default_05' onClick='doDeleteItem(\""+data[i].idx+"\")'>삭제</button></p>";
				vHtml += "</td>";
				vHtml += "</tr>";
				estimateCnt = estimateCnt + parseInt(data[i].itemQty);
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
					$('#itemCat').val("");
					$('#idx').val("");
					$('#manufacturer').val("");
					$('#medelName').val("");
					$('#itemQty').val("1");
					$('#useYear').val("");
					$('#year').val("");
					doChangeItemCate1();
					$("#spanYear").hide();
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
	$('#itemCat').val("");
	$('#idx').val("");
	$('#manufacturer').val("");
	$('#medelName').val("");
	$('#itemQty').val("1");
	$('#useYear').val("");
	$('#year').val("");
	doChangeItemCate1();
	doChangeItemCate2();
	$("#spanYear").hide();
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
			$('#itemCat').val(data.itemCat);
			$('#medelName').val(data.medelName);
			$('#itemQty').val(data.itemQty);
			$('#useYear').val(data.useYear);
			$('#year').val(data.year);

			$('#itemCatDtlEtc').val("");
			$('#manufacturerEtc').val("");

			var itemCatDtl   = data.itemCatDtl;
			var itemCat      = data.itemCat;
			var manufacturer = data.manufacturer;
			var params1={
					category1:data.itemCat,
					category2:data.itemCatDtl
			};
			
			var url1 = "../common/selectCategory23List.do";	
			$.ajax({
				type: "POST",
				url : url1,
				data: params1,
				success : function(data) {
					var isItemCat = false;
					$("#itemCatDtl").html("");
					var fvHtml="<option value=\"\">선택</option>";
					for(var i=0; i<data.row.length; i++)
					{
						var seleted = "";
						if(data.row[i].category2 == itemCatDtl)
						{
							seleted = "selected";
							isItemCat = true;
						}
						fvHtml += "<option value='"+data.row[i].category2+"' "+seleted+">"+data.row[i].category2+"</option>";
					}

					$("#itemCatDtl").html(fvHtml);

					if(isItemCat)
					{
						$('#itemCatDtlEtc').hide();
					}else{
						$('#itemCatDtl').val("직접입력");
						$('#itemCatDtlEtc').val(itemCatDtl);
						$('#itemCatDtlEtc').show();
					}
					
					var isManufacturer = false;
					$("#manufacturer").html("");
					fvHtml="<option value=\"\">선택</option>";
					for(var i=0; i<data.row1.length; i++)
					{
						var seleted = "";
						if(data.row1[i].category3 == manufacturer)
						{
							seleted = "selected";
							isManufacturer = true;
						}
						fvHtml += "<option value='"+data.row1[i].category3+"' "+seleted+">"+data.row1[i].category3+"</option>";
					}

					$("#manufacturer").html(fvHtml);

					if(isManufacturer)
					{
						$('#manufacturerEtc').hide();
					}else{
						$('#manufacturer').html("<option value=\"\">선택</option><option value=\"직접입력\" selected>직접입력</option>");
						$('#manufacturerEtc').val(manufacturer);
						$('#manufacturerEtc').show();
					}
					
					if(itemCat == "가구")
					{
						$("#divModelName").hide();
					}else{
						$("#divModelName").show();
					}
					
					if(itemCat == "가전"){
						$("#spanYear").html("*가전 제조년식을 넣어주세요");
						$("#spanYear").show();
					}else if(itemCat == "가구"){
						$("#spanYear").html("*가구 사용년식을 넣어주세요");
						$("#spanYear").show();
					}else{
						$("#spanYear").html(itemCat+" 제조년식을 넣어주세요");
						$("#spanYear").show();
					}
					
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
	if(!cfnNullCheckSelect($('#itemCat').val(),"품목")) return;
	var itemCatDtl = $("#itemCatDtl").val();
	if(itemCatDtl == "직접입력")
	{
		itemCatDtl = $("#itemCatDtlEtc").val();
	}
	
	var manufacturer = $("#manufacturer").val();
	if(manufacturer == "직접입력")
	{
		manufacturer = $("#manufacturerEtc").val();
	}
	
	if(!cfnNullCheckSelect(itemCatDtl, "세부카테고리")) return;
	if(!cfnNullCheckInput(manufacturer, "제조사")) return;
	
	if(!cfnNullCheckInput($('#itemQty').val(),"수량")) return;
	if(!cfnNullCheckInput($('#useYear').val(),"연식")) return;
	var itemCat = $('#itemCat').val();
	if(itemCat != "가구")
	{
		if(!cfnNullCheckInput($("#medelName").val(), "모델명")) return;
	}
	var params={
			idx:$("#idx").val(),
			subKey:$("#subKey").val(),
			flag:$('#flag').val(),
			itemCat:$('#itemCat').val(),
			itemCatDtl:itemCatDtl,
			manufacturer:manufacturer,
			medelName:$('#medelName').val(),
			itemQty:$('#itemQty').val(),
			year:$('#year').val(),
			useYear:$('#useYear').val()
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
	if(!cfnNullCheckSelect($('#itemCat').val(),"품목")) return;
	var itemCatDtl = $("#itemCatDtl").val();
	if(itemCatDtl == "직접입력")
	{
		itemCatDtl = $("#itemCatDtlEtc").val();
	}
	
	var manufacturer = $("#manufacturer").val();
	if(manufacturer == "직접입력")
	{
		manufacturer = $("#manufacturerEtc").val();
	}
	
	if(!cfnNullCheckSelect(itemCatDtl, "세부카테고리")) return;
	if(!cfnNullCheckInput(manufacturer, "제조사")) return;
	
	if(!cfnNullCheckInput($('#itemQty').val(),"수량")) return;
	if(!cfnNullCheckInput($('#useYear').val(),"연식")) return;
	var itemCat = $('#itemCat').val();
	if(itemCat != "가구")
	{
		if(!cfnNullCheckInput($("#medelName").val(), "모델명")) return;
	}
	var params={
			idx:$("#idx").val(),
			subKey:$("#subKey").val(),
			flag:$('#flag').val(),
			itemCat:$('#itemCat').val(),
			itemCatDtl:itemCatDtl,
			manufacturer:manufacturer,
			medelName:$('#medelName').val(),
			itemQty:$('#itemQty').val(),
			year:$('#year').val(),
			useYear:$('#useYear').val()
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
	if(!cfnNullCheckInput($("#nickname").val(), "이름")) return;
	if(!cfnNullCheckInput($("#phone").val(), "연락처")) return;
	if(!cfnNullCheckInput($("#email").val(), "이메일")) return;
	if(!cfnNullCheckSelect($("#area1").val(), "기본주소")) return;
	if(!cfnNullCheckSelect($("#area2").val(), "기본주소")) return;
	if(!cfnNullCheckInput($("#area3").val(), "상세주소")) return;
	if(!cfnNullCheckInput($("#floor").val(), "층수")) return;
	if(!cfnNullCheckInput($("#pickupDate").val(), "수거요청일")) return;
	if(!cfnNullCheckInput($("#title").val(), "견적제목")) return;

	if(!cfnNullCheckInput($("#content").val(), "참고사항")) return;

	if(estimateCnt < 2)
	{
		alert("수량/물품을 2개이상 등록하십시오.");
		return;
	}
	var idx = imagePaths.length;
	if(idx == 0)
	{
		alert("사진을 등록하십시오.");
		return;
	}
	
	if(idx > imageMaxCnt)
	{
		idx = imageMaxCnt;
	}
	for(var i=0; i<idx; i++)
	{
		$("#photo"+(i+1)).val(imagePaths[i]);
		$("#photo"+(i+1)+"Rotate").val(imageRotations[i]);
	}
	
	for(var i=idx; i<9; i++)
	{
		$("#photo"+(i+1)).val("");
		$("#photo"+(i+1)+"Rotate").val("");
	}
	
	var params={
			subKey:$("#subKey").val(),
			nickname:$("#nickname").val(),
			phone:$("#phone").val(),
			email:$("#email").val(),
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
			content:$("#content").val(),
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
			eType:"1"
	};	
	
	var url = "../admin/insertEstimate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적이 등록되었습니다.");
			location.href="../admin/estimate.do";
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}

function doCancelEstimate()
{
	location.href="../admin/estimate.do";
}
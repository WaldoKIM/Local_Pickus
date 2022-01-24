var imagePaths = new Array();
var imageRotations = new Array();
var imageidx = 0;

var isItemCate1 = false;
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
	$("#useYear").val($("#srchUseYear").val());
	$("#srchUseYear").val("");
	$('#useYear').change(function(){ 
		$('#year').val($("#useYear option:selected").text()); 
		var itemCat = $('input[name="itemCat"]:checked').val();
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
	var nCnt = 0;
	for(var i=1; i<=6; i++)
	{
		if($("#photo"+i).val())
		{
			imagePaths[nCnt] = $("#photo"+i).val();
			imageRotations[nCnt] = $("#photo"+i+"Rotate").val();
			nCnt++;
		}
	}
	
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
			
			if($("#srchArea1").val())
			{
				$("#area1").val($("#srchArea1").val());
				$("#srchArea1").val("");
				doChangeArea1();
			}
			
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
			/*
			$("#cate1").html("");
			var fvHtml="<option value=\"\" selected>선택</option>";
			for(var i=0; i<data.row.length; i++)
			{
				fvHtml += "<option value='"+data.row[i].category1+"'>"+data.row[i].category1+"</option>";
			}

			$("#cate1").html(fvHtml);
			*/
			
			
			$('input[name="itemCat"]').change(function() { 
				doChangeItemCate1();

			}); 

			$('#itemCatDtl').change(function() { 
				doChangeItemCate2();

			}); 
			
			doChangeItemCate1();
			
			
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
			
			if($("#srchArea2").val())
			{
				$("#area2").val($("#srchArea2").val());
				$("#srchArea2").val("");
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

function doChangeItemCate1()
{
	var itemCat = $('input[name="itemCat"]:checked').val();
	if(itemCat == "가구")
	{
		$("#divModelName").hide();
	}else{
		$("#divModelName").show();
	}
	
	if(isItemCate1)
	{
		if(itemCat == "가전"){
			$("#spanYear").html("*가전 제조년식을 넣어주세요");
		}else if(itemCat == "가구"){
			$("#spanYear").html("*가구 사용년식을 넣어주세요");
		}else{
			//$("#spanYear").html("");
			$("#spanYear").html(itemCat+" 제조년식을 넣어주세요");
			$("#spanYear").show();
		}
		
		$("#manufacturer").val("");
		$("#medelName").val("");
		$("#year").val("");
		$("#useYear").val("");
	}
	var params={
			category1:$('input[name="itemCat"]:checked').val()
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
			var vItemCatDtl = $("#srchItemCatDtl").val();
			var isItemCatDtl = false;
			if($('input[name="itemCat"]:checked').val())
			{	
				for(var i=0; i<data.row.length; i++)
				{
					if(vItemCatDtl)
					{
						if(vItemCatDtl == data.row[i].category2)
						{
							isItemCatDtl = true;
						}
					}
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
			if(vItemCatDtl)
			{
				if(isItemCatDtl)
				{
					$("#itemCatDtl").val(vItemCatDtl);
				}else{
					$("#itemCatDtl").val("직접입력");
					$('#itemCatDtlEtc').show();
					$("#itemCatDtlEtc").val(vItemCatDtl);
				}
				$("#srchItemCatDtl").val("");
				doChangeItemCate2();
			}
			isItemCate1 = true;
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
			category1:$('input[name="itemCat"]:checked').val(),
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
			var vManufacturer = $("#srchManufacturer").val();
			var isManufacturer = false;
			
			if($('#itemCatDtl').val())
			{
				for(var i=0; i<data.row.length; i++)
				{
					if(vManufacturer)
					{
						if(vManufacturer == data.row[i].category3)
						{
							isManufacturer = true;
						}
					}
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
			
			if(vManufacturer)
			{
				if(isManufacturer)
				{
					$("#manufacturer").val(vManufacturer);
				}else{
					$("#manufacturer").val("직접입력");
					$('#manufacturerEtc').show();
					$("#manufacturerEtc").val(vManufacturer);
				}
				$("#srchManufacturer").val("");
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
	var defaultImages    = new Array();
	var defaultRotations = new Array();
	var nSeq = 0;
	var nLen = imagePaths.length;
	for(var i=0; i<nLen; i++)
	{
		if(idx != i)
		{
			defaultImages[nSeq]    = imagePaths[i];
			defaultRotations[nSeq] = imageRotations[i];
			
			nSeq++;
		}
	}
	imagePaths     = new Array();
	imageRotations = new Array();
	for(var i=0; i<defaultImages.length; i++)
	{
		imagePaths[i]     = defaultImages[i];
		imageRotations[i] = defaultRotations[i];
	}
	createImage();
}

function createImage()
{
	$("#imageList").html("");
	var vHtml = "";
	var idx = imagePaths.length;
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
	if(idx < 6)
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
	for(var i=idx+1; i<6; i++)
	{
		vHtml += "<div class='col-lg-4 text-center'>";
		vHtml += "	<div class='estimate_image_register_bg'>";
		vHtml += "		<img src='../images/estimate/estimate_icon_image_regist.png'/>";
		vHtml += "	</div>";
		vHtml += "</div>";
	}
	$("#imageList").html(vHtml);
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

	var itemCat = $('input[name="itemCat"]:checked').val();
	if(itemCat != "가구")
	{
		if(!cfnNullCheckInput($("#medelName").val(), "모델명")) return;
	}
	if(!cfnNullCheckSelect($("#useYear").val(), "년식")) return;
	if(!cfnNullCheckInput($("#content").val(), "참고사항")) return;

	
	var idx = imagePaths.length;
	if(idx == 0)
	{
		alert("사진을 등록하십시오.");
		return;
	}
	for(var i=0; i<idx; i++)
	{
		$("#photo"+(i+1)).val(imagePaths[i]);
		$("#photo"+(i+1)+"Rotate").val(imageRotations[i]);
		
	}
	
	for(var i=idx; i<6; i++)
	{
		$("#photo"+(i+1)).val("");
		$("#photo"+(i+1)+"Rotate").val("");
	}
	
	var params={
			idx:$("#estimateIdx").val(),
			subKey:'0',
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
			itemCat:$('input[name="itemCat"]:checked').val(),
			itemCatDtl:itemCatDtl,
			manufacturer:manufacturer,
			title:$('input[name="itemCat"]:checked').val()+" "+$("#manufacturer").val()+" "+$("#itemCatDtl").val(),
			medelName:$("#medelName").val(),
			year:$("#year").val(),
			useYear:$("#useYear").val(),
			goodsState:$('input[name="goodsState"]:checked').val(),
			content:$("#content").val(),
			photo1:$("#photo1").val(),
			photo2:$("#photo2").val(),
			photo3:$("#photo3").val(),
			photo4:$("#photo4").val(),
			photo5:$("#photo5").val(),
			photo6:$("#photo6").val(),
			photo1Rotate:$("#photo1Rotate").val(),
			photo2Rotate:$("#photo2Rotate").val(),
			photo3Rotate:$("#photo3Rotate").val(),
			photo4Rotate:$("#photo4Rotate").val(),
			photo5Rotate:$("#photo5Rotate").val(),
			photo6Rotate:$("#photo6Rotate").val(),				
			eType:"0"
	};	
	
	var url = "../admin/updateEstimate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적이 수정되었습니다.");
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
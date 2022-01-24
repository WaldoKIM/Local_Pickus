var imageMaxCnt = 6;
jQuery(document).ready(function(){
	cfnLoginCheck("0","8");
	
	var now = new Date();

	var Year = now.getFullYear();
	
	var Month   = now.getMonth()+1;
	if(Month < 10) Month = "0"+Month
	
	var Day   = now.getDate();
	if(Day < 10) Day = "0"+Day
	
	var toDate = Year +"-" + Month + "-"+ Day;
	
	var date = $.datepicker.parseDate( "yy-mm-dd", toDate );
	
	$( "#pickupDate" ).datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr",
		minDate:date
	});
	
	$("#useYear").html(cfnEstimateYearsCombo("선택"));
	
	$('#useYear').change(function(){ 
		$('#year').val($("#useYear option:selected").text()); 
		var itemCat = $('input[name="itemCat"]:checked').val();
		if(itemCat)
		{
			var vYear = $("#useYear").val();
			if(itemCat == "가구"){
				if(vYear >= 5)
				{
					alert("년식이 오래되어 무료수거나 수거 불가 할 수도 있습니다.");
				}
			}else{
				if(vYear >= 10)
				{
					alert("년식이 오래되어 무료수거나 수거 불가 할 수도 있습니다.");
				}
			}

		}		
	}); 
	
	//createImage();
	for(var i=1; i<=imageMaxCnt; i++)
	{
		var vComp    = "photo"+i;
		var vDivComp = "divPhoto"+i;
		var vText    = "사진파일 업로드";
		
		doInitImage(vComp, vDivComp, vText);

	}
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
			if($('input[name="itemCat"]:checked').val())
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


function doRegistEstimate()
{
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

	
	var params={
			subKey:'0',
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
			title:$('input[name="itemCat"]:checked').val()+" "+manufacturer+" "+itemCatDtl,
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
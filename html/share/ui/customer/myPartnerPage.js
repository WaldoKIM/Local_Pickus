var partnerData;

var isLoad = false;

var vEmail;
var vBiztype;

jQuery(document).ready(function(){
	cfnLoginCheck("2");
	var params={};

	var url = "selectUser.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			partnerData = data;
			cfnBizTypesOnlyOne("divBizType", data.biztype);
			cfnGoodsItem("divGoodsItem",data.goodsItem,data.goodsYear);
			cfnRemoveItem("divRemoveItem",data.removeItem);
			
			vEmail   = data.email;
			vBiztype = data.biztype;
			
			if(vBiztype == "1"){
				$("#divGoodsItemList").show();
				$("#divRemoveItemList").hide();
			}else if(vBiztype == "2"){
				$("#divRemoveItemList").show();
				$("#divGoodsItemList").hide();
			}else if(vBiztype == "3"){
				$("#divGoodsItemList").show();
				$("#divRemoveItemList").show();
			}
			
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
							$("#goodsYear"+i).val("1");
							$("#goodsYear"+i).show();
						}
					}
					$("#goodsYear"+vIdx).val("1");
				    $("#goodsYear"+vIdx).show();
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
			setData();
			doSelectArea();
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
	
});


function doSelectArea1()
{
	var params={};	
	
	var url1 = "selectMyPartnerArea1.do";	
	$.ajax({
		type: "POST",
		url : url1,
		data: params,
		success : function(data) {
			$("#area1").html("");
			var fvHtml="<option value=\"\" selected>시/도</option>";
			for(var i=0; i<data.length; i++)
			{
				fvHtml += "<option value='"+data[i].area1+"'>"+data[i].area1+"</option>";
			}

			$("#area1").html(fvHtml);
			
			fvHtml="<option value=\"\" selected>시/구/군</option>";
			$("#area2").html(fvHtml);
			$('#area1').change(function(){ 
				doSelectArea2(); 
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


function doSelectArea2()
{
	//$("#area").val($("#area1").val())
	var params={
			area1:$("#area1").val()
	};	
	
	var url = "selectMyPartnerArea2.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#area2").html("");
			var fvHtml="";
			if($("#area1").val())
			{
				fvHtml += "<option value=\"\" selected>"+$("#area1").val()+" 전체</option>";
			}else{
				fvHtml += "<option value=\"\" selected>시/도</option>";
			}
			for(var i=0; i<data.length; i++)
			{
				fvHtml += "<option value='"+data[i].area2+"'>"+data[i].area2+"</option>";
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

function setData()
{
	$("#email").html(partnerData.email);
	$("#bizname").html(partnerData.bizname);
	$("#phone").val(partnerData.phone);
	$("#bizPost").val(partnerData.bizPost);
	$("#bizAddr1").val(partnerData.bizAddr1);
	$("#bizAddr2").val(partnerData.bizAddr2);
	
	doSetImage('divPhoto','photo','담당자사진 업로드', partnerData.photo, partnerData.photoRotate);
	doSetImage('divPhotoSite','photoSite','사업장 정면 또는 내부 사진 업로드', partnerData.photoSite, partnerData.photoSiteRotate);
	doSetImage('divPhotoBizcard','photoBizcard','사업자등록증 업로드', partnerData.photoBizcard, partnerData.photoBizcardRotate);

	$("#bizWorkerName").val(partnerData.bizWorkerName);
	$("#bizWorkerPhone").val(partnerData.bizWorkerPhone);
	$("#intro").val(partnerData.intro);
	$("#goodsYear").val(partnerData.goodsYear);
	$("#removeEtc").val(partnerData.removeEtc);
	$("#area").val(partnerData.area1+" "+partnerData.area2);
}



function doCustomerSignUp(){
	location.href="../customer/signup.do";
}

function doSearchPost()
{
	new daum.Postcode({
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var fullAddr = ''; // 최종 주소 변수
            var extraAddr = ''; // 조합형 주소 변수

            // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                fullAddr = data.roadAddress;

            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                fullAddr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
            if(data.userSelectedType === 'R'){
                //법정동명이 있을 경우 추가한다.
                if(data.bname !== ''){
                    extraAddr += data.bname;
                }
                // 건물명이 있을 경우 추가한다.
                if(data.buildingName !== ''){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            $('#bizPost').val(data.zonecode); //5자리 새우편번호 사용
            $('#bizAddr1').val(fullAddr);

            // 커서를 상세주소 필드로 이동한다.
            $('#bizAddr2').focus();
        }
    }).open();	
}


var divImage;
var compImage;
var titleImage;
function doSetImage(vDiv, vComp, vTitle, filePath, fileRotate)
{
	$("#"+vComp).val(filePath);
	$("#"+vComp+"Rotate").val(fileRotate);
	var vHtml2 = "";
	vHtml2 += "<div class='estimate_image_bg'>";
	vHtml2 += "<div class='estimate_image_del_bg'>";
	vHtml2 += "<a href='#none' onClick='doInitImage(\""+vComp+"\",\""+vDiv+"\",\""+vTitle+"\");'>";
	vHtml2 += "<i class='xi-close-min'></i>";
	vHtml2 += "</a>";
	vHtml2 += "</div>";
	vHtml2 += "<img class='rotate"+fileRotate+"' src='../common/file/imageDownload.do?fileNewName="+filePath+"' style='width:100%;height:370px'/>";
	vHtml2 += "</div>";
	$("#"+vDiv).empty().html(vHtml2);
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
					vHtml2 += "<img class='rotate"+data.fileRotation+"' src='../common/file/imageDownload.do?fileNewName="+vFileName+"' style='width:100%;height:370px'/>";
					vHtml2 += "</div>";
					$("#"+vDivComp).empty().html(vHtml2);
				}
			});
		}else{
			alert("이미지 파일만 업로드 가능합니다.");
		}
	});	
}

function doWithdrawal()
{
	if(!confirm("회원을 탈퇴하시겠습니까?"))  return;
	
	var params={
			typeGb:"4"
	};

	var url = "updateWithdrawal.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("탈퇴하였습니다.");
			location.href="../main/main.do";
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
		
}

function doSavePartner()
{
	if(!confirm("회원정보를 수정하시겠습니까?"))  return;
	
	var vPassword = "";
	if($("#password").val())
	{
		vPassword = hex_md5($("#password").val());
	}

	
	
	var goodsItem = "";
	var goodsYear = "";
	
	if(vBiztype == "1" || vBiztype == "3")
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
	if(vBiztype == "2" || vBiztype == "3")
	{
		$('input[name="removeItem"]:checked').each(function(index,item){
			if(index != 0){
				removeItem += ",";
			}
			removeItem += $(this).val();
		});
	}
		
	

	var params={
			password:vPassword,
			phone:$("#phone").val(),
			bizPost:$("#bizPost").val(),
			bizAddr1:$("#bizAddr1").val(),
			bizAddr2:$("#bizAddr2").val(),
			photo:$("#photo").val(),
			photoSite:$("#photoSite").val(),
			photoBizcard:$("#photoBizcard").val(),
			photoRotate:$("#photoRotate").val(),
			photoSiteRotate:$("#photoSiteRotate").val(),
			photoBizcardRotate:$("#photoBizcardRotate").val(),
			bizWorkerName:$("#bizWorkerName").val(),
			bizWorkerPhone:$("#bizWorkerPhone").val(),
			intro:$("#intro").val(),
			goodsItem:goodsItem,
			goodsYear:goodsYear,
			removeItem:removeItem,
			removeEtc:$("#removeEtc").val()
	};

	var url = "updateMyPartnerPage.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("수정하였습니다.");
			location.href="../main/main.do";
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
	
}


function doSaveArea()
{
	if(!$("#area1").val()){
		alert("시/도를 선택하십시오.");
		return;
	}
	
	
	var params={
			email:vEmail,
			subKey:"0",
			area1:$("#area1").val(),
			area2:$("#area2").val()
	};	
	
	console.log(params);
	var url = "insertMyPartnerArea.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			doSelectArea();
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function doDeleteArea(idx)
{
	var params={
			idx:idx
	};	
	
	var url = "deletePartnerArea.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			doSelectArea();
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function doSelectArea()
{
	var params={
			
	};	
	
	var url = "selectMyPartnerArea.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#divArea").html("");
			var vHtml = "";
			for(var i=0; i<data.length; i++)
			{
				
				vHtml += "<p class='signup_txt_area'>";
				vHtml += data[i].area1+" "+cfNvl2(data[i].area2,"전체");
				vHtml += "&nbsp;&nbsp;";
				vHtml += "<a href='#none' onClick='doDeleteArea("+data[i].idx+")'>";
				vHtml += "<i class='xi-close-min'></i>";
				vHtml += "</a></p>";

			}
			$("#divArea").html(vHtml);
			
			doSelectArea1();
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}
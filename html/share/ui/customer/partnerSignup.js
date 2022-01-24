var vBizType;
jQuery(document).ready(function(){
	doInitImage("photo",        "divPhoto",        "담당자 사진");
	doInitImage("photoSite",    "divPhotoSite",    "사업장 정면 또는 내부 사진");
	doInitImage("photoBizcard", "divPhotoBizcard", "사업자 등록증");
	
	vBizType = $("#srchBizType").val();
	if(!vBizType) vBizType = "1";
	
	cfnBizTypes("divBizType", vBizType);
	cfnGoodsItem("divGoodsItem","가전","2006년");
	cfnRemoveItem("divRemoveItem","", "");

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
	
	doSelectArea1();
});

function doSelectArea1()
{
	var params={
			subKey:$("#subKey").val()
	};	
	
	var url1 = "selectPartnerArea1.do";	
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
	var params={
			subKey:$("#subKey").val(),
			area1:$("#area1").val()
	};	
	
	var url = "selectPartnerArea2.do";	
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


function doSignup()
{
	
	if(!checkFields()) return false;

	//var vBiztype = $('input[name="biztype"]:checked').val();
	
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
	if(vBizType == "2" || vBizType == "3")
	{
		$('input[name="removeItem"]:checked').each(function(index,item){
			if(index != 0){
				removeItem += ",";
			}
			removeItem += $(this).val();
		});
	}
	
	var emailYn = "N";
	if(!$("#sendAgree").prop("checked")){
		emailYn = "Y";
	}
	
	var params={
			typeGb:"1",
			email:$("#email").val(),
			biztype:vBizType,
			bizname:$("#bizname").val(),
			nickname:$("#bizname").val(),
			password:hex_md5($("#password").val()),
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
			goodsItem:goodsItem,
			goodsYear:goodsYear,
			removeItem:removeItem,
			removeEtc:$("#removeEtc").val(),
			intro:$("#intro").val(),
			subKey:$("#subKey").val(),
			emailYn:emailYn
	};

	var url = "insertPartnerSignup.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.flag == "0")
			{
				alert("이미 가입된 이메일입니다!");
			}else{
				alert("회원 가입 완료 되었으며,\n관리자 승인 후 이용이 가능합니다.");
				location.href="../main/main.do";
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
function checkFields() {  
	
	removeClass();

	if(!$("#bizname").val()){
		$("#lbl_bizname").html("센터이름을 입력해주세요.");
		$("#lbl_bizname").show();
		$("#bizname").addClass("input_error");
		return false;
	}
	
	if(!$("#email").val()){
		$("#lbl_email").html("이메일을 입력해주세요.");
		$("#lbl_email").show();
		$("#email").addClass("input_error");
		return false;        		
	}
	
	if(!this.validateEmail($("#email").val())){
		$("#lbl_email").html("이메일 형식이 잘못되었습니다.");
		$("#lbl_email").show();
		$("#email").addClass("input_error");
		return false;
	}
	
	if(!$("#password").val()){
		$("#lbl_password").html("비밀번호를 입력해주세요.");
		$("#lbl_password").show();
		$("#password").addClass("input_error");
		return false;
	}
	
	if($("#password").val()!=$("#passwordConfirm").val()){
		$("#lbl_passwordConfirm").html("비밀번호와 비밀번호확인이 일치하지 않습니다.");
		$("#lbl_passwordConfirm").show();
		$("#passwordConfirm").addClass("input_error");
		return false;
	}

	if($("#password").val().length  < 8 || $("#password").val().length  > 15){
		$("#lbl_password").html("비밀번호는 8자 이상 15자 이하입니다.");
		$("#lbl_password").show();
		$("#password").addClass("input_error");
		return false;
	}


	if(!$("#phone").val()){
		$("#lbl_phone").html("전화번호를 입력해주세요.");
		$("#lbl_phone").show();
		$("#phone").addClass("input_error");
		return false;
	}


	if(!$("#bizAddr1").val()){
		$("#lbl_bizAddr1").html("센터주소를 입력해주세요.");
		$("#lbl_bizAddr1").show();
		$("#bizAddr1").addClass("input_error");
		return false;
	}
	
	if(!$("#bizAddr2").val()){
		$("#lbl_bizAddr2").html("센터상세주소를 입력해주세요.");
		$("#lbl_bizAddr2").show();
		$("#bizAddr2").addClass("input_error");
		return false;
	}
	
	if(!$("#bizWorkerName").val()){
		$("#lbl_bizWorkerName").html("담당자 이름를 입력해주세요.");
		$("#lbl_bizWorkerName").show();
		$("#bizWorkerName").addClass("input_error");
		return false;
	}

	if(!$("#bizWorkerPhone").val()){
		$("#lbl_bizWorkerPhone").html("담당자 휴대전화번호를 입력해주세요.");
		$("#lbl_bizWorkerPhone").show();
		$("#bizWorkerPhone").addClass("input_error");
		return false;
	}

	if(!$("#intro").val()){
		$("#lbl_intro").html("업체 소개글를 입력해주세요.");
		$("#lbl_intro").show();
		$("#intro").addClass("input_error");
		return false;
	}

	if(!cfnNullCheckSelect($("#photoBizcard").val(), "사업자등록증사진")) return false;
	if(!cfnNullCheckSelect($("#photoSite").val(), "사업장사진")) return false;
	if(!cfnNullCheckSelect($("#photo").val(), "담당자사진")) return false;
	
	if(!$("#pbAgree").prop("checked")){
		alert("이용약관에 동의해주세요!");
		return false;
	}
	return true;
}
        
function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function removeClass()
{
	$("#lbl_bizname").hide();
	$("#lbl_email").hide();
	$("#lbl_password").hide();
	$("#lbl_passwordConfirm").hide();
	$("#lbl_phone").hide();
	$("#lbl_bizAddr1").hide();
	$("#lbl_bizAddr2").hide();
	$("#lbl_bizWorkerName").hide();
	$("#lbl_bizWorkerPhone").hide();
	$("#lbl_intro").hide();
	
	$("#bizname").removeClass("input_error");
	$("#email").removeClass("input_error");
	$("#password").removeClass("input_error");
	$("#passwordConfirm").removeClass("input_error");
	$("#phone").removeClass("input_error");
	$("#bizAddr1").removeClass("input_error");
	$("#bizAddr2").removeClass("input_error");
	$("#bizWorkerName").removeClass("input_error");
	$("#bizWorkerPhone").removeClass("input_error");
	$("#intro").removeClass("input_error");
}


function doSaveArea()
{
	if(!$("#area1").val()){
		alert("시/도를 선택하십시오.");
		return;
	}
	


	
	var params={
			subKey:$("#subKey").val(),
			area1:$("#area1").val(),
			area2:$("#area2").val()
	};	
	
	var url = "insertPartnerArea.do";	
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
			subKey:$("#subKey").val()
	};	
	
	var url = "selectPartnerArea.do";	
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

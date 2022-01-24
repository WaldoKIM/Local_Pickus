jQuery(document).ready(function(){
	cfnBizTypes("divBizType", "1");
	cfnGoodsItem("divGoodsItem","가전","2006년");
	cfnRemoveItem("divRemoveItem","", "");
	
	
	$('input[name="biztype"]').change(function() { 
		var idx = $('input[name="biztype"]:checked').val()
		if(idx == "1"){
			$("#divGoodsItemList").show();
			$("#divRemoveItemList").hide();
		}else if(idx == "2"){
			$("#divRemoveItemList").show();
			$("#divGoodsItemList").hide();
		}else if(idx == "3"){
			$("#divGoodsItemList").show();
			$("#divRemoveItemList").show();
		}
	}); 
	
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
				}
			}
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

var divImage;
var compImage;
var titleImage;
function doImageSearch(vDiv, vComp, vTitle)
{
	divImage   = vDiv;
	compImage  = vComp;
	titleImage = vTitle;
	cfnOpenPopup('../common/file/imageSearch.do','350','250','auto','auto','0','0','0');
}

function setImage(filePath, fileRotation)
{
	$("#"+compImage).val(filePath);
	$("#"+compImage+"Rotate").val(fileRotation);
	var vHtml = "";
	vHtml += "	<div class='estimate_image_bg'>";
	vHtml += "		<div class='estimate_image_del_bg'>";
	vHtml += "			<a href='#none' onClick='doImageDel(\""+divImage+"\",\""+compImage+"\",\""+titleImage+"\");'>";
	vHtml += "				<img src='../images/estimate/estimate_icon_image_del.png'/>";
	vHtml += "			</a>";
	vHtml += "		</div>";
	vHtml += "		<img class='rotate"+fileRotation+"' src='../common/file/imageDownload.do?fileNewName="+filePath+"'/>";
	vHtml += "	</div>";
	$("#"+divImage).html(vHtml);
}

function doImageDel(vDiv, vComp,vTitle)
{
	$("#"+vComp).val("");
	var vHtml = "";
	vHtml += "	<div class='estimate_image_click_bg'>";
	vHtml += "		<a href='#none' onClick='doImageSearch(\""+vDiv+"\",\""+vComp+"\",\""+vTitle+"\");'>";
	vHtml += "			<p>";
	vHtml += "				<img src='../images/estimate/estimate_icon_image_info.png'/>";
	vHtml += "			</p>";
	vHtml += "			<p>";
	vHtml += "				<span class='estimate_image_label2'>"+vTitle+"</span>";
	vHtml += "			</p>";
	vHtml += "		</a>";
	vHtml += "	</div>";
	$("#"+vDiv).html(vHtml);
	
}
function doSignup()
{
	
	if(!checkFields()) return false;

	var vBiztype = $('input[name="biztype"]:checked').val();
	
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
			typeGb:"2",
			email:$("#email").val(),
			biztype:$('input[name="biztype"]:checked').val(),
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
			emailYn:"Y"
	};

	var url = "insertMember.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.flag == "0")
			{
				alert("이미 가입된 이메일입니다!");
			}else{
				alert("회원 가입이 완료되었습니다!");
				location.href="../admin/member2.do";
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

function doCancelSignup()
{
	location.href="../admin/member2.do";
	
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
	/*
	if(!$("#pbAgree").prop("checked")){
		alert("이용약관에 동의해주세요!");
		return false;
	}
	*/
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
			$("#divArea1").html("");
			$("#divArea2").html("");
			var nCnt = parseInt(data.length/2);
			if(data.length%2 > 0)
			{
				nCnt = nCnt + 1;
			}
			
			var nLen = data.length;
			var vHtml1 = "";
			var vHtml2 = "";
			for(var i=0; i<nCnt; i++)
			{
				var idx1 = i * 2;
				var idx2 = i * 2 + 1;
				
				vHtml1 += "<p class='signup_txt_area'>";
				vHtml1 += data[idx1].area1+" "+cfNvl2(data[idx1].area2,"전체");
				vHtml1 += "&nbsp;&nbsp;";
				vHtml1 += "<a href='#none' onClick='doDeleteArea("+data[idx1].idx+")'>";
				vHtml1 += "<img src='../images/customer/icon_delete.png'>";
				vHtml1 += "</a></p>";
				
				if(idx2 < nLen)
				{
					vHtml2 += "<p class='signup_txt_area'>";
					vHtml2 += data[idx2].area1+" "+cfNvl2(data[idx2].area2,"전체");
					vHtml2 += "&nbsp;&nbsp;";
					vHtml2 += "<a href='#none' onClick='doDeleteArea("+data[idx2].idx+")'>";
					vHtml2 += "<img src='../images/customer/icon_delete.png'>";
					vHtml2 += "</a></p>";
				}
			}
			$("#divArea1").html(vHtml1);
			$("#divArea2").html(vHtml2);
			
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

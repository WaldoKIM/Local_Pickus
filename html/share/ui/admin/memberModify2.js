var partnerData;

var isLoad = false;

var vEmail;
var vBiztype;

jQuery(document).ready(function(){
	var params={
			idx:$("#idx").val()
		};

		var url = "selectMember.do";	
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
	var params={
		email:vEmail
	};	
	
	var url1 = "../admin/selectMemberArea1.do";	
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
			email:vEmail,
			area1:$("#area1").val()
	};	
	
	var url = "../admin/selectMemberArea2.do";	
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
	var vHtml = "";
	vHtml += "	<div class='estimate_image_bg'>";
	vHtml += "		<img src='../common/file/imageDownload.do?fileNewName="+filePath+"'/>";
	vHtml += "		<div class='estimate_image_del_bg'>";
	vHtml += "			<a href='#none' onClick='doImageDel(\""+vDiv+"\",\""+vComp+"\",\""+vTitle+"\");'>";
	vHtml += "				<img class='rotate"+fileRotate+"' src='../images/estimate/estimate_icon_image_del.png'/>";
	vHtml += "			</a>";
	vHtml += "		</div>";
	vHtml += "	</div>";
	$("#"+vDiv).html(vHtml);
}

function doImageSearch(vDiv, vComp, vTitle)
{
	divImage   = vDiv;
	compImage  = vComp;
	titleImage = vTitle;
	cfnOpenPopup('../common/file/imageSearch.do','350','250','auto','auto','0','0','0');
}

function setImage(filePath,fileRotation)
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
			email:vEmail,
			typeGb:"2",
			password:vPassword,
			phone:$("#phone").val(),
			bizPost:$("#bizPost").val(),
			bizAddr1:$("#bizAddr1").val(),
			bizAddr2:$("#bizAddr2").val(),
			photo:$("#photo").val(),
			photoSite:$("#photoSite").val(),
			photoBizcard:$("#photoBizcard").val(),
			bizWorkerName:$("#bizWorkerName").val(),
			bizWorkerPhone:$("#bizWorkerPhone").val(),
			intro:$("#intro").val(),
			goodsItem:goodsItem,
			goodsYear:goodsYear,
			removeItem:removeItem,
			removeEtc:$("#removeEtc").val()
	};

	var url = "updateMember.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("수정하였습니다.");
			location.href="../admin/member2.do";
			
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
	
	var url = "../admin/insertMemberArea.do";	
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
	
	var url = "../admin/deleteMemberArea.do";	
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

function doCancelSavePartner()
{
	location.href="../admin/member2.do";
}
function doSelectArea()
{
	var params={
			email:vEmail
	};	
	
	var url = "../admin/selectMemberArea.do";	
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
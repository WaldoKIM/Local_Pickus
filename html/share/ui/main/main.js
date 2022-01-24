var vPageCount = 3;

jQuery(document).ready(function(){
	
	var mainTitles = [["검증된 재활용센터 ‘피커스＇","처치곤란 대형 중고가전/가구 3일 내로 평균 5개 무료비교견적","&nbsp;"],
	                  ["재활용 물건의 가치를 정리하다","돈 될지도 모르는데","폐기물 스티커 붙이기 전에 견적 한번 받아보세요."],
	                  ["다량 물건도 한번에 처리","가정.사무실.식당 등","이사.폐업 전에도 다량 물건 한번에 비교 견적 처리"],
	                  ["안심하게 중고매입.철거/원상복구.폐기물 처리까지","한번에 비교견적","&nbsp;"],
	                  ["언제까지 힘들게 중고거래 할래?","중고거래 정 안되면 ‘피커스’에 맡겨 보는 건 어때요?","&nbsp;"]];
	for(var i=0; i<mainTitles.length; i++)
	{
		var vHtml = "";
		vHtml += "<div class='container'>";
		vHtml += "	<div class='space-90'></div>";
		vHtml += "	<div class='row'>";
		vHtml += "		<div class='col-lg-12'>";
		vHtml += "			<h1 class='h1_main_title'>"+mainTitles[i][0]+"</h1>";
		vHtml += "		</div>";
		vHtml += "	</div>";
		vHtml += "	<div class='row'>";
		vHtml += "		<div class='col-lg-12'>";
		vHtml += "			<h1 class='h1_main_title'>"+mainTitles[i][1]+"</h1>";
		vHtml += "		</div>";
		vHtml += "	</div>";
		vHtml += "	<div class='row'>";
		vHtml += "		<div class='col-lg-12'>";
		vHtml += "			<h1 class='h1_main_title'>"+mainTitles[i][2]+"</h1>";
		vHtml += "		</div>";
		vHtml += "	</div>";
		vHtml += "	<div class='space-15'></div>";
		vHtml += "	<div class='row'>";
		vHtml += "		<div class='col-lg-12'>";
		vHtml += "			<h2 class='h2_main_title'>우리동네 재활용 센터를 모으다</h2>";
		vHtml += "		</div>";
		vHtml += "	</div>";
		vHtml += "	<div class='row'>";
		vHtml += "		<div class='col-lg-12 text-center'>";
		vHtml += "			<button type='button' class='btn btn_main_title1' onClick='doRegistEstimate();'>";
		vHtml += "				<span>무료비교견적<img src='../images/main/main_icon_arrow.png'></span>";
		vHtml += "			</button>";
		vHtml += "		</div>";
		vHtml += "	</div>";
		vHtml += "	<div class='space-80'></div>";
		vHtml += "</div>	";
		
		var idx = i+1;
		$("#main_slide_bg_0"+idx).html(vHtml);
	}


	/*
	$("#main_slide_bg_01").html(vHtml);
	$("#main_slide_bg_02").html(vHtml);
	$("#main_slide_bg_03").html(vHtml);
	$("#main_slide_bg_04").html(vHtml);
	$("#main_slide_bg_05").html(vHtml);
	$("#main_slide_bg_06").html(vHtml);
	$("#main_slide_bg_07").html(vHtml);
	$("#main_slide_bg_08").html(vHtml);
	$("#main_slide_bg_09").html(vHtml);
	*/
	var params={};	
	
	var url1 = "../common/selectArea1List.do";	
	$.ajax({
		type: "POST",
		url : url1,
		data: params,
		success : function(data) {
			$("#area1").html("");
			var fvHtml="<option value=\"\" selected>시/도 전체</option>";
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
	
	doSearchEstimateList();
	doSearchCenterList(1);
	doSearchPopupList();
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
			var fvHtml="<option value=\"\" selected>"+$("#area1").val()+" 전체</option>";
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

function doSearchPopupList()
{
	var params={
			state:"1"
	};

	var url = "selectPopupList.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			var intWidth  = 250;
			var intHeight = 350;
			var intLeft   = 0;
			var intTop    = 0;
			for(var i=0; i<data.length; i++)
			{
				var fvPopupId = "popup_"+data[i].idx;
				if(cfnGetCookiePopup(fvPopupId) != "close")
				{
					var features = eval("'width=" + intWidth + ",height=" + intHeight + ",left=" + intLeft + ",top=" + intTop + "'");
					intLeft = intLeft + intWidth + 20;
					window.open("../common/popup/mainPopup.do?idx="+data[i].idx,fvPopupId,features);
				}
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
function doSearchEstimateList()
{
	var params={
			pageCount:5,
			pageNum:1
	};

	var url = "selectEstimateList.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#estimateList").html("");
			var fvHtml="";
			for(var i=0; i<data.row.length; i++)
			{
				fvHtml += "<tr>";
				fvHtml += "<td class='text-center'>"+data.row[i].writetime+"</td>";
				fvHtml += "<td class='text-center'>"+_strEType(data.row[i].eType)+"</td>";
				fvHtml += "<td>"+data.row[i].title+"</td>";
				fvHtml += "<td class='text-center'>"+_strState(data.row[i].state)+"</td>";
				fvHtml += "</tr>";
			}
			$("#estimateList").html(fvHtml);
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function doSearchCenter()
{
	doSearchCenterList(1);
}

function doSearchCenterList(pageNum)
{
	var params={
			area1:$("#area1").val(),
			area2:$("#area2").val(),
			typeGb:"2",
			pageCount:vPageCount,
			pageNum:pageNum
	};
	var url = "selectCenterList.do";
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#centerList").html("");
			$("#centerPageList").html("");
			if(data.totalCount > 0 )
			{
				var fvHtml = "";
				for(var i=0; i<data.row.length; i++)
				{
					var vScore = parseInt(data.row[i].score);
					var vRate = vScore/5 * 100 ;
					fvHtml += "<div class='col-lg-4 text-center'>";
					fvHtml += "<div class='main_center_list_bg' style='background-image:linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(\""+_setPhotoSite(data.row[i].photoSite)+"\");'>";
					fvHtml += "<p class='main_center_list_name'>"+data.row[i].bizname+"</p>";
					fvHtml += "<p class='main_center_list_area'>"+data.row[i].area1+" "+data.row[i].area2+"</p>";
					fvHtml += "<p class='main_center_list_name'>ㅡ</p>";
					fvHtml += "<p><span class='review_star1'><em style='width:"+vRate+"%;'>평점</em></span></p>";
					fvHtml += "</div>";
					fvHtml += "</div>";
				}
				
				$("#centerList").html(fvHtml);
				
				var pageHtml = "";
				var lv_TotCnt  = parseInt(data.totalCount);
				var lv_CurPage = pageNum;
				var lv_TotPage = parseInt(data.totalPage);

				var lv_last = lv_TotPage%10-1;

				if(lv_last == -1) lv_last = 9;

				lv_last = lv_TotPage - lv_last;

				var lv_InitVal  = 1;
				if(lv_CurPage%10 == 0 && lv_CurPage > 10){	
					lv_InitVal = lv_CurPage - 9;
				}else if(lv_CurPage > 10){
					lv_InitVal =lv_CurPage - (lv_CurPage%10) + 1;
				}

				var lv_PageGab  = lv_TotPage - lv_InitVal + 1;

				if(lv_PageGab > 10)	lv_PageGab = 10;

				if(lv_TotCnt > 0 && lv_CurPage > 10)
				{
					pageHtml += "<li>";
					pageHtml += "<a href='#none' onClick='doSearchCenterList("+(lv_InitVal-1)+");' aria-label='Previous'>";
					pageHtml += "<span aria-hidden='true'>◀</span>";
					pageHtml += "</a>";
					pageHtml += "</li>";
				}
				for(var t=1; t<=lv_PageGab; t++)
				{
					var lv_value = lv_InitVal-1+t;
					if(lv_value == lv_CurPage)
					{
						pageHtml += "<li class='active'><span>"+lv_value+"</span></li>";
					}else{
						pageHtml += "<li><a href='#none' onClick='doSearchCenterList("+lv_value+");'>"+lv_value+"</a></li>";
					}
				}
				if(lv_TotPage > lv_InitVal+9){
					pageHtml += "<li>";
					pageHtml += "<a href='#none' onClick='doSearchCenterList("+(lv_InitVal+10)+");' aria-label='Next'>";
					pageHtml += "<span aria-hidden='true'>▶</span>";
					pageHtml += "</a>";
					pageHtml += "</li>";
				}
				$("#centerPageList").html(pageHtml);				
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

function doRegistEstimate()
{
	location.href = "../estimate/registEstimate.do";
}

function doPartnerService()
{
	location.href = "../customer/partnerService.do";
}

var vUrl = "";

var vFlag;
function doMoveRegist(fvFlag)
{
	vFlag = fvFlag;
	
	if(fvFlag=="6"){
		alert("준비중입니다.");
		return;
	}
	var params={};

	var url = "../common/loginCheck.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(fvFlag!="4" && fvFlag!="5")
			{
				vUrl ="../estimate/registEstimate"+fvFlag+".do";
			}
			if(data.flag == "1")
			{
				if(fvFlag=="4" || fvFlag=="5")
				{
					if(fvFlag=="4")
					{
						$("#estimateTitle").html(_strEType(3));
						$("#eType").val("3");
					}else if(fvFlag=="5"){
						$("#estimateTitle").html(_strEType(4));
						$("#eType").val("4");
					}
					$("#title").val("");
					$("#content").val("");
					$('#modal_regist_estimate').modal();	
				}else{
					location.href = vUrl;
				}
			}else{
				$('#modal_login').modal();	
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

function doMoveLogin()
{
	location.href="../customer/login.do?turnUrl="+vUrl;
}

function doMoveSignup()
{
	location.href="../customer/signup.do";
}

function doMoveNotLogin()
{
	email:$("#email").val("");
	nickname:$("#nickname").val("");
	phone:$("#phone").val("");

	$('#modal_login').modal("hide");	
	$('#modal_not_signup').modal();
}

function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function doSaveNotLogin()
{
	if(!cfnNullCheckInput($("#nickname").val(),"이름")) return;
	if(!cfnNullCheckInput($("#email").val(),"E-Mail")) return;
	if(!validateEmail($("#email").val())){
		alert("이메일 형식이 잘못되었습니다.");
		return;
	}
	if(!cfnNullCheckInput($("#phone").val(),"핸드폰 번호")) return;
	
	var params={
			email:$("#email").val(),
			nickname:$("#nickname").val(),
			phone:$("#phone").val(),
			typeGb:"8"			
	};

	var url = "../estimate/insertNotSignup.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$('#modal_login').modal("hide");
			if(data.flag == "1")
			{
				if(vFlag=="4" || vFlag=="5")
				{
					if(vFlag=="4")
					{
						$("#estimateTitle").html(_strEType(3));
						$("#eType").val("3");
					}else if(fvFlag=="5"){
						$("#estimateTitle").html(_strEType(4));
						$("#eType").val("4");
					}
					$("#title").val("");
					$("#content").val("");
					$('#modal_regist_estimate').modal();	
				}else{
					location.href = vUrl;
				}
			}else if(data.flag == "2")
			{
				alert("이전에 신청한 경력이 있습니다.");
				if(vFlag=="4" || vFlag=="5")
				{
					if(vFlag=="4")
					{
						$("#estimateTitle").html(_strEType(3));
						$("#eType").val("3");
					}else if(fvFlag=="5"){
						$("#estimateTitle").html(_strEType(4));
						$("#eType").val("4");
					}
					$("#title").val("");
					$("#content").val("");
					$('#modal_regist_estimate').modal();	
				}else{
					location.href = vUrl;
				}
			}else{
				alert("회원이 존재합니다. 로그인 후 사용하십시오.");
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

function doCloseNotLogin()
{
	$('#modal_not_signup').modal("hide");
}

function doCloseEstimate()
{
	$('#modal_regist_estimate').modal("hide");	
}

function doSaveEstimate()
{
	if(!cfnNullCheckInput($("#title").val(), "견적제목")) return;
	if(!cfnNullCheckInput($("#content").val(), "견적내역")) return;	
	
	var params={
			subKey:'0',
			title:$("#title").val(),
			content:$("#content").val(),
			eType:$("#eType").val()
	};	
	
	var url = "../estimate/saveEstimate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적이 신청되었습니다.");
			$('#modal_regist_estimate').modal("hide");
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}
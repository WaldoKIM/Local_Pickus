var imagePaths = new Array();
var imageidx = 0;

jQuery(document).ready(function(){
	cfnLoginCheck("2");
	
	
	$("#bankName").html(cfnBankTypesCombo());
	$('#bankName').change(function(){
		$("#bankAccount").val(cfnBankTypesBank($('#bankName').val()));
	});
	$("#price").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});
	
	$("#bankPrice").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});
	
	for(var i=0; i<=11; i++)
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

	var url = "../estimate/selectPartnerEstimateDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.master.state == "6")
			{
				alert("취소된 견적입니다.");
				location.href = "../estimate/partnerEstimateList.do";
			}
			$("#price").val(data.master.price);
			$("#subIdx").val(data.master.subIdx);
			$("#detailIdx").val(data.master.detailIdx);
			$("#completetime").val(data.master.completetime);
			
			fnCreateMasterImage(data.master);
			if(data.master.state == "3" && data.master.remainAmt != "0")
			{
				fnCreateMasterNotPoint(data.master);
			}else{
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
				
				if(data.master.state == "5")
				{
					fnCreateReview(data.propose_review);
				}			
			}

			
			$( "#changeCompletetime" ).datepicker({
				dateFormat: "yy-mm-dd",
				language: "kr",
				//minDate:getDateAsValue(data.master.requesttime)
				minDate:getDateAsValue(getToDay())
			});
			
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

function fnCreateMasterNotPoint(data)
{
	var vHtml = "";
	vHtml += "<h1>"+_strEType(data.eType)+"</h1>";
	vHtml += "<dl>";
	vHtml += "<d2 class='col-xs-12'>";
	vHtml += "<p>센터사장님!</p>";
	vHtml += "<p>충전금이 부족합니다.</p>";
	vHtml += "<p>피커스 계좌 : 농협 302-1237-9285-41 천정훈(디휴브)</p>";
	vHtml += "<p>충전금 입금 주시면 관리자 확인 후 고객정보가 공개됩니다.</p>";
	vHtml += "<p>감사합니다.</p>";
	//vHtml += "<div class='row'><div class='col-xs-12'><button class='btn btn_default_03' type='button' onClick='doPoint()'><span>충전하기</span></button></div></div>";
	$('#mainTitle').html(vHtml);
}

function fnCreateMaster(data)
{

	var vHtml = "";
	vHtml += "<h1>"+_strEType(data.eType)+"</h1>";
	vHtml += "<dl>";
	vHtml += "<dt class='col-xs-3'>제목</dt><dd class='col-xs-9'>"+data.title+"</dd>";
	if((data.state == "3" || data.state == "4" || data.state == "5") && data.selected == "1")
	{
		vHtml += "<dt class='col-xs-3'>고객</dt><dd class='col-xs-9'>"+data.nickname+"</dd>";
	}else{
		vHtml += "<dt class='col-xs-3'>고객<</dt><dd class='col-xs-9'>"+_getNickname(data.nickname)+"</dd>";
	}
	if(data.state == "1")
	{
		if(data.eType == "2")
		{
			vHtml += "<dt class='col-xs-3'>견적가격</dt><dd class='col-xs-9'>"+cfnNumberCommaEstimate(data.price)+"&nbsp;&nbsp;<a href='#none' onClick='doModifyPrice();' style='display:inline;line-height:0px;'>수정</a><a href='#none' onClick='doCancel();'>취소</a></dd>";
		}else{
			vHtml += "<dt class='col-xs-3'>견적가격</dt><dd class='col-xs-9'>"+cfnNumberCommaEstimate(data.price)+"&nbsp;&nbsp;<a href='#none' onClick='doModify();' style='display:inline;line-height:0px;'>수정</a><a href='#none' onClick='doCancel();' style='display:inline;line-height:0px;'>취소</a></dd>";
		}
	}
	if(data.state == "2")
	{
		vHtml += "<dt class='col-xs-3'>견적가격</dt><dd class='col-xs-9'>"+cfnNumberCommaEstimate(data.price)+"&nbsp;&nbsp;* 고객이 업체 선택중 입니다.</dd>";
	}
	
	if((data.state == "3" || data.state == "4" || data.state == "5") && data.selected == "1")
	{	
		vHtml += "<dt class='col-xs-3'>지역</dt><dd class='col-xs-9'>"+data.area1+" "+data.area2+" "+data.area3+"</dd>";
		vHtml += "<dt class='col-xs-3'>연락처</dt><dd class='col-xs-9'>"+cfNvl2(data.phone,"-")+"</dd>";
	}else{
		vHtml += "<dt class='col-xs-3'>지역</dt><dd class='col-xs-9'>"+data.area1+" "+data.area2+"</dd>";
	}
	vHtml += "<dt class='col-xs-3'>층수</dt><dd class='col-xs-9'>"+data.elevatorYn+"/"+data.floor+"</dd>";
	if(data.selected != "1")
	{
		if(data.eType == "2"){
			vHtml += "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>"+data.pickupDate+"</dd>";
		}else{
			vHtml += "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>"+data.pickupDate+"</dd>";
		}
	}
	if(data.state == "3" && data.selected == "1")
	{
		if(data.eType == "2")
		{
			vHtml += "<dt class='col-xs-3'>선택견적가격</dt><dd class='col-xs-9'>"+cfnNumberCommaEstimate(data.price)+"</dd>";
			if(cfNvl1(data.completetime))
			{
				vHtml += "<dt class='col-xs-3'>철거확정일</dt><dd class='col-xs-9'>"+data.completetime+"&nbsp;&nbsp;<a href='#none' onClick='doChangeCompeteDate(\"2\");' style='display:inline;line-height:0px;'>철거확정일변경</a></dd>";
			}else{
				vHtml += "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>"+data.requesttime+"&nbsp;&nbsp;<a href='#none' onClick='doChangeCompeteDate(\"2\");' style='display:inline;line-height:0px;'>철거확정일설정</a></dd>";
			}
			vHtml += "<dt class='col-xs-3'>주의사항</dt>";
			vHtml += "<dd class='col-xs-9'>";
			vHtml += "고객과 연락 후 철거 확정일을 설정해주세요<br/>";
			vHtml += "일정을 잊지 않게 알림으로 알려드립니다";
			vHtml += "</dd>";
			vHtml += "</dl>";
			vHtml += "<ul class='row'>";
			vHtml += "<li class='col-xs-6'></li>";
			vHtml += "<li class='col-xs-6'>";
			vHtml += "<a class='main_bg' href='#.' onClick='doCompleteEstimate(\""+data.eType+"\")'>";
			vHtml += "철거 완료 하기";
			vHtml += "</a>";
			vHtml += "</li>";
			vHtml += "</ul>";
			
		}else{
			vHtml += "<dt class='col-xs-3'>선택견적가격</dt><dd class='col-xs-9'>"+cfnNumberCommaEstimate(data.price)+"</dd>";
			if(cfNvl1(data.completetime))
			{
				vHtml += "<dt class='col-xs-3'>수거확정일</dt><dd class='col-xs-9'>"+data.completetime+"&nbsp;&nbsp;<a href='#none' onClick='doChangeCompeteDate(\"1\");' style='display:inline;line-height:0px;'>수거확정일변경</a></dd>";
			}else{
				vHtml += "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>"+data.requesttime+"&nbsp;&nbsp;<a href='#none' onClick='doChangeCompeteDate(\"1\");' style='display:inline;line-height:0px;'>수거확정일설정</a></dd>";
			}
			vHtml += "<dd class='col-xs-9'>";
			vHtml += "고객과 연락 후 수거 확정일을 설정해주세요<br/>";
			vHtml += "일정을 잊지 않게 알림으로 알려드립니다";
			vHtml += "</dd>";
			vHtml += "</dl>";
			vHtml += "<ul class='row'>";
			vHtml += "<li class='col-xs-6'></li>";
			vHtml += "<li class='col-xs-6'>";
			vHtml += "<a class='main_bg' href='#.' onClick='doCompleteEstimate(\""+data.eType+"\")'>";
			vHtml += "수거 완료 하기";
			vHtml += "</a>";
			vHtml += "</li>";
			vHtml += "</ul>";
		}
	}else if(data.state == "5" && data.selected == "1")
	{
		if(data.eType == "2")
		{
			vHtml += "<dt class='col-xs-3'>견적가격</dt><dd class='col-xs-9'>"+cfnNumberCommaEstimate(data.price)+"</dd>";
			vHtml += "<dt class='col-xs-3'>철거확정일</dt><dd class='col-xs-9'>"+data.completetime+"</dd>";
			
			vHtml += "<ul class='row'>";
			vHtml += "<li class='col-xs-12'>";
			vHtml += "<a class='main_bg' href='#.'>";
			vHtml += "철거  완료되었습니다";
			vHtml += "</a>";
			vHtml += "</li>";
			vHtml += "</ul>"
				
		}else{
			vHtml += "<dt class='col-xs-3'>견적가격</dt><dd class='col-xs-9'>"+cfnNumberCommaEstimate(data.price)+"</dd>";
			vHtml += "<dt class='col-xs-3'>수거확정일</dt><dd class='col-xs-9'>"+data.completetime+"</dd>";

			vHtml += "<ul class='row'>";
			vHtml += "<li class='col-xs-12'>";
			vHtml += "<a class='main_bg' href='#.'>";
			vHtml += "수거  완료되었습니다";
			vHtml += "</a>";
			vHtml += "</li>";
			vHtml += "</ul>"
		}
	}else{
		vHtml += "</dl>";
	}
	
	$('#mainTitle').html(vHtml);
	
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

function fnCreateReview(review)
{
	var vHtml = "";
	if(review.length > 0)
	{
		var vScore = parseInt(review[0].score);
		var vRate = vScore/5 * 100 ;
		vHtml += "<h1 class='tt'>고객후기</h1>";
		vHtml += "<table class='re_view'>";
		vHtml += "<colgroup class='web_col'>";
		vHtml += "<col style='width: 15%' />";
		vHtml += "<col style='width: 85%' />";
		vHtml += "</colgroup>";
		vHtml += "<tr>";
		vHtml += "<th><img src='"+_setPhoto(review[0].photo1, review[0].eType)+"'/></th>";
		vHtml += "<td>";
		vHtml += "<div class='sub_tt'>"+_strEType(review[0].eType)+" / "+_getTitleReview(review[0].title)+"</div>";
		vHtml += "<div class='con'>"+review[0].review+"</div>";
		vHtml += "<div class='icon'>";
		if(vScore >= 1)
		{
			vHtml += "<i class='xi-star'></i>";
		}else{
			vHtml += "<i class='xi-star-o'></i>";
		}
		if(vScore >= 2)
		{
			vHtml += "<i class='xi-star'></i>";
		}else{
			vHtml += "<i class='xi-star-o'></i>";
		}
		if(vScore >= 3)
		{
			vHtml += "<i class='xi-star'></i>";
		}else{
			vHtml += "<i class='xi-star-o'></i>";
		}
		if(vScore >= 4)
		{
			vHtml += "<i class='xi-star'></i>";
		}else{
			vHtml += "<i class='xi-star-o'></i>";
		}
		if(vScore >= 5)
		{
			vHtml += "<i class='xi-star'></i>";
		}else{
			vHtml += "<i class='xi-star-o'></i>";
		}
				
		vHtml += "</div>";
		vHtml += "<div class='date'>작성자 : "+_getNickname(review[0].nickname)+" ㅣ 등록일 : "+_getDate(review[0].updatetime)+"</div>";
		vHtml += "</td>";
		vHtml += "</tr>";
		vHtml += "</table>";	
	}

	
	$("#divRreview").html(vHtml);
}

var vShowIdx;
function doClickReview(idx)
{
	var vClickReview = "review_"+idx;
	if(vClickReview == vShowIdx)
	{
		$("#"+vShowIdx).hide();
		vShowIdx = "";
	}else{
		if(vShowIdx)
		{
			$("#"+vShowIdx).hide();
		}
		vShowIdx = vClickReview;
		$("#"+vShowIdx).show();
	}
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

function doModify()
{
	$('#modal_price').modal();
}

function doModifyPrice()
{
	var params={
			estimateIdx:$("#idx").val()
		};

		var url = "../estimate/selectPartnerEstimateDetailPrice.do";	
		$.ajax({
			type: "POST",
			url : url,
			data: params,
			success : function(data) {
				$("#divTotalAmt").html(cfnNumberComma(data.totalAmt)+" 원");
				$("#totalAmt").val(data.totalAmt);
				
				for(var i=1; i<=11; i++)
				{
					var vId = i;
					if(i<10) vId = "0"+i;

					var vId = i;
					if(i<10) vId = "0"+i;
					var vAmtId  = "amt"+vId;
					var vVatId  = "vat"+vId;
					var vItemId = "item"+vId;
					var vDescId = "desc"+vId;
					
					$("#"+vItemId).val(cfNvl1(data[vItemId]));
					$("#"+vDescId).val(cfNvl1(data[vDescId]));
					$("#"+vAmtId).val(cfnNumberRemoveCommaZero(data[vAmtId]));
					$("#"+vVatId).val(cfnNumberRemoveCommaZero(data[vVatId]));
				}
				$("#content").val(data.content);
				$("#discoutContent").val(data.discoutContent);
				
				$('#modal_price_detail').modal();
			},
		    beforeSend : function(){
		    	
			},
			complete : function(){
				
		    },
			error: function(jqXHR, textStatus, errorThrown){
				
		    }
		});	
		
}

function doClose()
{
	$('#modal_price').modal("hide");
}

function doClosePrice()
{
	$('#modal_price_detail').modal("hide");
}

function doPriceZero()
{
	var idx = $("#idx").val();
	var params={
			idx:$("#subIdx").val(),
			price:0
	};	
	
	var url = "../estimate/updatePartnerEstimateDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적을 수정하였습니다.");
			location.href = "partnerEstimateDetail.do?idx="+idx;
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doSave()
{
	var idx = $("#idx").val();
	var params={
			idx:$("#subIdx").val(),
			price:$("#price").val()
	};	
	
	var url = "../estimate/updatePartnerEstimateDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적을 수정하였습니다.");
			location.href = "partnerEstimateDetail.do?idx="+idx;
			
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
	var idx = $("#idx").val();
	var params={
			idx:$("#subIdx").val(),
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
	var url = "../estimate/updatePartnerEstimateDetailPrice.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적을 수정하였습니다.");
			location.href = "partnerEstimateDetail.do?idx="+idx;
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doCancel()
{
	var idx = $("#idx").val();
	var params={
			idx:idx,
			subIdx:$("#subIdx").val(),
			detailIdx:$("#detailIdx").val()
	};	
	
	var url = "../estimate/deletePartnerEstimateDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적에 취소하였습니다.");
			location.href = "partnerEstimateList.do";
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doChangeCompeteDate(vGubun)
{
	$("#changeCompletetime").val($("#completetime").val());
	if(vGubun=="1")
	{
		$("#divCompleteDate").html("수거확정일자");
		$("#divCompleteDateConetent").html("* 수거확정일자를 입력하세요");
	}else{
		$("#divCompleteDate").html("철거확정일자");
		$("#divCompleteDateConetent").html("* 철거확정일자를 입력하세요");
	}
	$('#modal_completeDate').modal();
}

function doSaveCompleteDate()
{
	var idx = $("#idx").val();
	var params={
			estimateIdx:idx,
			idx:$("#subIdx").val(),
			completetime:$("#changeCompletetime").val()
	};	
	
	var url = "../estimate/updatePartnerEstimateDetailCompleteDate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			location.href = "partnerEstimateDetail.do?idx="+idx;
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}

function doCloseCompleteDate()
{
	$('#modal_completeDate').modal("hide");
}

function doCloseComplete()
{
	$('#modal_complete').modal("hide");
}

function doSaveComplete()
{
	var idx = imagePaths.length;
	if(idx == 0)
	{
		alert("사진을 등록하십시오.");
		return;
	}
	for(var i=0; i<idx; i++)
	{
		$("#photo"+(i+1)).val(imagePaths[i]);
	}
	
	for(var i=idx; i<6; i++)
	{
		$("#photo"+(i+1)).val("");
	}
	
	if(!confirm("철거완료하시겠습니까?")) return;
	
	var idx = $("#idx").val();
	var params={
			idx:$("#idx").val(),
			subIdx:$("#subIdx").val(),
			state:"5",
			photo1:$("#photo1").val(),
			photo2:$("#photo2").val(),
			photo3:$("#photo3").val(),
			photo4:$("#photo4").val(),
			photo5:$("#photo5").val(),
			photo6:$("#photo6").val(),			
			completetime:$("#completetime").val()
	};	
	
	var url = "../estimate/updatePartnerEstimate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("완료하였습니다.");
			location.href = "partnerEstimateDetail.do?idx="+idx;
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}
function doCompleteEstimate(eType)
{
	if(!$("#completetime").val()){
		alert("확정일을 선택하십시오.");
		return;
	}
	
	if(eType == "2")
	{
		//imagePaths = new Array();	
		//createImage();
		//$('#modal_complete').modal();
		location.href = "partnerEstimateDetailComplete.do?idx="+$("#idx").val()+"&&subIdx="+$("#subIdx").val()+"&&completetime="+$("#completetime").val();
	}else{
		if(!confirm("수거완료하시겠습니까?")) return;
		var idx = $("#idx").val();
		var params={
				idx:$("#idx").val(),
				subIdx:$("#subIdx").val(),
				state:"5",
				completetime:$("#completetime").val()
		};	
		
		var url = "../estimate/updatePartnerEstimate.do";	
		$.ajax({
			type: "POST",
			url : url,
			data: params,
			success : function(data) {
				alert("완료하였습니다.");
				location.href = "partnerEstimateDetail.do?idx="+idx;
				
			},
		    beforeSend : function(){
		    	
			},
			complete : function(){
				
		    },
			error: function(jqXHR, textStatus, errorThrown){
				
		    }
		});			
	}

}


function doImageSearch()
{
	cfnOpenPopup('../common/file/imageSearch.do','350','250','auto','auto','0','0','0');
}

function setImage(filePath)
{
	var idx = imagePaths.length;
	imagePaths[idx] = filePath;
	createImage();
}

function doImageDel(idx)
{
	var defaultImages = new Array();
	var nSeq = 0;
	var nLen = imagePaths.length;
	for(var i=0; i<nLen; i++)
	{
		if(idx != i)
		{
			defaultImages[nSeq] = imagePaths[i];
			nSeq++;
		}
	}
	imagePaths = new Array();
	for(var i=0; i<defaultImages.length; i++)
	{
		imagePaths[i] = defaultImages[i];
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
		vHtml += "<div class='col-xs-4 text-center'>";
		vHtml += "	<div class='estimate_image_bg'>";
		vHtml += "		<div class='estimate_image_del_bg'>";
		vHtml += "			<a href='#none' onClick='doImageDel("+i+");'>";
		vHtml += "				<img src='../images/estimate/estimate_icon_image_del.png'/>";
		vHtml += "			</a>";
		vHtml += "		</div>";
		vHtml += "		<img src='../common/file/imageDownload.do?fileNewName="+imagePaths[i]+"'/>";
		vHtml += "	</div>";
		vHtml += "</div>";
	}
	if(idx < 6)
	{
		vHtml += "<div class='col-xs-4 text-center'>";
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
		vHtml += "<div class='col-xs-4 text-center'>";
		vHtml += "	<div class='estimate_image_register_bg'>";
		vHtml += "		<img src='../images/estimate/estimate_icon_image_regist.png'/>";
		vHtml += "	</div>";
		vHtml += "</div>";
	}
	$("#imageList").html(vHtml);
}

function doPoint()
{
	$('#bankName').val("");
	$('#bankAccount').val("");
	$('#bankSender').val("");
	$('#bankPrice').val("");
	$('#modal_point').modal();
}

function doClosePoint()
{
	$('#modal_point').modal("hide");
}

function doSavePoint()
{
	if(!cfnNullCheckInput($('#bankSender').val(), "입금자명")) return;
	if(!cfnNullCheckInput($('#bankName').val(), "은행")) return;
	if(!cfnNullCheckInput($('#bankPrice').val(), "금액")) return;
	
	var params={
			price:$("#bankPrice").val(),
			priceType:"1",
			bankName:$("#bankName").val(),
			bankAccount:$("#bankAccount").val(),
			bankSender:$("#bankSender").val(),
			estimateIdx:$("#idx").val(),
		};

		var url = "../estimate/insertPartnerPoint.do";	
		$.ajax({
			type: "POST",
			url : url,
			data: params,
			success : function(data) {
				location.href = "../customer/myPartnerPoint.do";
			},
		    beforeSend : function(){
		    	
			},
			complete : function(){
				
		    },
			error: function(jqXHR, textStatus, errorThrown){
				
		    }
		});		
}
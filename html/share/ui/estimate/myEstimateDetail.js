jQuery(document).ready(function(){
	var params={
		idx:$("#idx").val()
	};

	var url = "../estimate/selectMyEstimateDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.master.state == "6")
			{
				alert("취소된 견적입니다.");
				location.href = "../estimate/myEstimateList.do";
			}
			$("#requesttime").val(data.master.pickupDate);
			$("#subIdx").val(data.master.subIdx);
			var price = 0;
			if(data.propose_success.length > 0)
			{
				price = data.propose_success[0].price;
			}
			var centerCnt =  data.propose_success.length + data.propose_process.length;
			
			fnCreatePhoto(data.master);
			fnCreateMaster(data.master, price, centerCnt);
			
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
			
			if(data.master.state == "1"||data.master.state == "2"||data.master.state == "3"||data.master.state == "4"||data.master.state == "5")
			{
				fnCreateCenterList(data.master.eType, data.master.state, data.propose_success, data.propose_process);
			}
			
			if(data.master.state == "5")
			{
				fnCreateReview(data.master.reviewYn, data.propose_review);
			}
			$('.pati_select_img_thumb').image_gallery();
			
			var now = new Date();

			var Year = now.getFullYear();
			
			var Month   = now.getMonth()+1;
			if(Month < 10) Month = "0"+Month
			
			var Day   = now.getDate();
			if(Day < 10) Day = "0"+Day
			
			var toDate = Year +"-" + Month + "-"+ Day;
			
			$( "#requesttime" ).datepicker({
				dateFormat: "yy-mm-dd",
				language: "kr",
				minDate:getDateAsValue(toDate)
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

function fnCreatePhoto(data)
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
function fnCreateMaster(data, price, centerCnt)
{
	var vHtml = "";
	vHtml += "<h1>"+_strEType(data.eType)+"</h1>";
	vHtml += "<dl>";
	vHtml += "<dt class='col-xs-3'>제목</dt><dd class='col-xs-9'>"+data.title+"</dd>";
	if(data.state == "0" || data.state == "1" || data.state == "6")
	{
		if(centerCnt > 0)
		{
			if(data.eType == "2")
			{
				vHtml += "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>"+data.priceQty+"명</dd>";
				vHtml += "<dt class='col-xs-3'>최저가적</dt><dd class='col-xs-9'>"+cfnNumberCommaEstimate(data.price)+"</dd>";
			}else{
				vHtml += "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>"+data.priceQty+"명</dd>";
				vHtml += "<dt class='col-xs-3'>최고견적</dt><dd class='col-xs-9'>"+cfnNumberCommaEstimate(data.price)+"</dd>";
			}
		}else{
			if(data.eType == "2")
			{
				vHtml += "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>- 명</dd>";
				vHtml += "<dt class='col-xs-3'>최저가적</dt><dd class='col-xs-9'>- 원</dd>";
			}else{
				vHtml += "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>- 명</dd>";
				vHtml += "<dt class='col-xs-3'>최고견적</dt><dd class='col-xs-9'>- 원</dd>";
			}
		}
	}else if(data.state == "2"){
		vHtml += "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>"+data.priceQty+"명</dd>";
		if(data.eType == "2")
		{
			vHtml += "<dt class='col-xs-3'>최저가적</dt><dd class='col-xs-9'>"+cfnNumberCommaEstimate(data.price)+"</dd>";
		}else{
			vHtml += "<dt class='col-xs-3'>최고견적</dt><dd class='col-xs-9'>"+cfnNumberCommaEstimate(data.price)+"</dd>";
		}
	}else if(data.state == "3"){
		vHtml += "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>"+data.priceQty+"명</dd>";
		vHtml += "<dt class='col-xs-3'>선택견적</dt><dd class='col-xs-9'>"+cfnNumberComma(price)+"원</dd>";
	}else{
		vHtml += "<dt class='col-xs-3'>참여자</dt><dd class='col-xs-9'>"+data.priceQty+"명</dd>";
		vHtml += "<dt class='col-xs-3'>선택견적</dt><dd class='col-xs-9'>"+cfnNumberComma(price)+"원</dd>";
	}
	vHtml += "<dt class='col-xs-3'>지역</dt><dd class='col-xs-9'>"+data.area1+" "+data.area2+" "+data.area3+"</dd>";
	vHtml += "<dt class='col-xs-3'>층수</dt><dd class='col-xs-9'>"+data.elevatorYn+"/"+data.floor+"</dd>";
	if(data.selected != "1"){
		if(data.eType == "2")
		{
			vHtml += "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>"+data.pickupDate+"</dd>";
		}else{
			vHtml += "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>"+data.pickupDate+"</dd>";
		}
	}else{
		if(cfNvl1(data.completetime))
		{
			if(data.eType == "2")
			{
				vHtml += "<dt class='col-xs-3'>철거확정일</dt><dd class='col-xs-9'>"+data.completetime+"</dd>";
			}else{
				vHtml += "<dt class='col-xs-3'>철거확정일</dt><dd class='col-xs-9'>"+data.completetime+"</dd>";
			}
		}else{
			if(data.eType == "2")
			{
				vHtml += "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>"+data.requesttime+"</dd>";
			}else{
				vHtml += "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>"+data.requesttime+"</dd>";
			}
		}
	}
	
	
	vHtml += "</dl>";
	if(data.state == "0" || data.state == "1")
	{
		vHtml += "<ul class='row'>";
		vHtml += "<li class='col-xs-6'></li>";
		vHtml += "<li class='col-xs-6'>";
		vHtml += "<a class='main_bg' href='#.' onClick='doCancel()'>";
		vHtml += "견적취소";
		vHtml += "</a>";
		vHtml += "</li>";
		vHtml += "</ul>";
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

function fnCreateCenterList(eType, state, successList, processList)
{
	var vHtml = "";
	if(state == "3" || state == "4" || state == "5")
	{
		var vScore = parseInt(successList[0].score);
		//var vRate = vScore;
		
		vHtml += "<li>";
		vHtml += "<div>";
		vHtml += "<div class='img'><img src='"+_setPhotoSite(successList[0].photoSite)+"'></div>";
		vHtml += "<div class='text'>";
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
		
		vHtml += "<a class='re_btn' href='#.' onClick='doReview(\""+successList[0].rcEmail+"\",\""+successList[0].score+"\")'>후기보기 <i class='xi-angle-right-min'></i></a>";
		vHtml += "<h4>"+successList[0].rcNickname+"</h4>";
		vHtml += "<h5>"+_getArea(successList[0].area1)+"</h5>";
		if(successList[0].price == "0")
		{
			if(eType == "2")
			{
				vHtml += "<div class='pay main_co'><span>무료철거</span></div>";
			}else{
				vHtml += "<div class='pay main_co'><span>무료수거</span></div>";
			}
		}else{
			vHtml += "<div class='pay main_co'><span>"+cfnNumberComma(successList[0].price)+"</span>원</div>";
		}
		vHtml += "</div>";
		vHtml += "<div class='btn_list'>";
		vHtml += "<ul class='row'>";
		vHtml += "<li class='col-xs-6'>";
		if(eType == "2")
		{
			vHtml += "<a class='line_bg' href='#.' onClick='doPriceDetail(\""+successList[0].idx+"\",\""+successList[0].estimateIdx+"\",\""+successList[0].rcEmail+"\")'>상세견적</a>";
		}
		vHtml += "</li>";
		vHtml += "<li class='col-xs-6'>";
		vHtml += "<a class='sub_bg' href='#.'>선택완료</a>";
		vHtml += "</li>";
		vHtml += "</ul>";
		vHtml += "</div>";
		vHtml += "</div>";
		vHtml += "</li>";
	}
	
	if(state == "1" || state == "2")
	{
		
		if(processList.length > 0)
		{
			for(var i=0; i<processList.length; i++)
			{
				//var vScore = parseInt(processList[i].score);
				var vScore = processList[i].score;
				var vRate = vScore/5 * 100 ;
				
				vHtml += "<li>";
				vHtml += "<div>";
				vHtml += "<div class='img'><img src='"+_setPhotoSite(processList[i].photoSite)+"'></div>";
				vHtml += "<div class='text'>";
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
				
				vHtml += "<a class='re_btn' href='#.' onClick='doReview(\""+processList[i].rcEmail+"\",\""+processList[i].score+"\")'>후기보기 <i class='xi-angle-right-min'></i></a>";
				vHtml += "<h4>"+processList[i].rcNickname+"</h4>";
				vHtml += "<h5>"+_getArea(processList[i].area1)+"</h5>";
				if(processList[i].price == "0")
				{
					if(eType == "2")
					{
						vHtml += "<div class='pay main_co'><span>무료철거</span></div>";
					}else{
						vHtml += "<div class='pay main_co'><span>무료수거</span></div>";
					}
				}else{
					vHtml += "<div class='pay main_co'><span>"+cfnNumberComma(processList[i].price)+"</span>원</div>";
				}
				vHtml += "</div>";
				vHtml += "<div class='btn_list'>";
				vHtml += "<ul class='row'>";
				vHtml += "<li class='col-xs-6'>";
				if(eType == "2")
				{
					vHtml += "<a class='line_bg' href='#.' onClick='doPriceDetail(\""+processList[i].idx+"\",\""+processList[i].estimateIdx+"\",\""+processList[i].rcEmail+"\")'>상세견적</a>";
				}
				vHtml += "</li>";
				vHtml += "<li class='col-xs-6'>";
				vHtml += "<a class='main_bg' href='#.' onClick='doSelect(\""+processList[i].idx+"\",\""+processList[i].estimateIdx+"\",\""+processList[i].rcNickname+"\")'>업체선택</a>";
				vHtml += "</li>";
				vHtml += "</ul>";
				vHtml += "</div>";
				vHtml += "</div>";
				vHtml += "</li>";
			}
		}else{
			vHtml += "<li class='no_data'>";
			vHtml += "<div><i class='xi-error-o'></i>업체 견적이 들어오지 않았습니다.</div>";
			vHtml += "</li>";
		}
	}	
	
	$('#proposeList').html(vHtml);
}

function fnCreateReview(reviewYn, review)
{
	var vHtml = "";
	if(reviewYn == "0")
	{
		vHtml += "<h1 class='tt'>고객후기 <a class='main_bg' href='#.' onClick='doAddReview();'>후기작성</a></h1>";
	}else{
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

function doAddReview()
{
	$("#score").val("5");
	$("#review").val("");
	$('#modal_add_review').modal();
}

function doSaveAddReview()
{
	
	var params={
			idx:$("#subIdx").val(),
			score:$("#score").val(),
			review:$("#review").val()
	};	
	
	var url = "../estimate/updateReview.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("후기를 작성하였습니다.");
			location.href = "myEstimateDetail.do?idx="+$("#idx").val();
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doCancelAddReview()
{
	$('#modal_add_review').modal("hide");
}

function doReview(rcEmail, score)
{
	var params={
		rcEmail:rcEmail,
		pageCount:4,
		pageNum:1
	};	
	
	var url1 = "../review/selectReviewList.do";	
	$.ajax({
		type: "POST",
		url : url1,
		data: params,
		success : function(data) {
			$("#reviewTitle").html("");
			$("#reviewList").html("");
			
			var vHtml1 = "";
			var vHtml2 = "";
			
			var vScore1 = 0;
			if(data.score.length > 0)
			{
				vScore1 = data.score[0].score;
			}
			vHtml1 += "평점 <span class='main_co'>"+vScore1+"</span> / 5.0";
			vHtml1 += "<span class='icon_star'>";
			if(vScore1 >= 1)
			{
				vHtml1 += "<i class='xi-star'></i>";
			}else{
				vHtml1 += "<i class='xi-star-o'></i>";
			}
			if(vScore1 >= 2)
			{
				vHtml1 += "<i class='xi-star'></i>";
			}else{
				vHtml1 += "<i class='xi-star-o'></i>";
			}
			if(vScore1 >= 3)
			{
				vHtml1 += "<i class='xi-star'></i>";
			}else{
				vHtml1 += "<i class='xi-star-o'></i>";
			}
			if(vScore1 >= 4)
			{
				vHtml1 += "<i class='xi-star'></i>";
			}else{
				vHtml1 += "<i class='xi-star-o'></i>";
			}
			if(vScore1 >= 5)
			{
				vHtml1 += "<i class='xi-star'></i>";
			}else{
				vHtml1 += "<i class='xi-star-o'></i>";
			}			
			vHtml1 += "</span>	";
			$("#reviewTitle").html(vHtml1);
			
			if(data.row.length > 0)
			{
				for(var i=0; i<data.row.length; i++)
				{
					var vScore2 = parseInt(data.row[i].score);
					
					vHtml2 += "<tr>";
					vHtml2 += "<td>";
					vHtml2 += "<a href='#.'>";
					vHtml2 += "<div class='title'>";
					vHtml2 += "<p class='type'>"+_strEType(data.row[i].eType)+"</p>";
					vHtml2 += "<p class='date'>"+data.row[i].updatetime+"</p>";
					vHtml2 += "</div>";
					vHtml2 += "<div class='con_wrap'>";
					vHtml2 += "<div class='img'><img src='"+_setPhoto(data.row[i].photo1, data.row[i].eType)+"'/></div>";
					vHtml2 += "<div class='con'>";
					vHtml2 += "<h5 class='main_co'>"+data.row[i].title+"</h5>";
					vHtml2 += "<span class='name'>"+_getNickname(data.row[i].nickname)+"</span>&nbsp;&nbsp;";
					vHtml2 += "<span class='icon_star'>";
					vHtml2 += "<i class='xi-star'></i>";
					vHtml2 += "<i class='xi-star-o'></i>";
					vHtml2 += "<i class='xi-star-o'></i>";
					vHtml2 += "<i class='xi-star-o'></i>";
					vHtml2 += "<i class='xi-star-o'></i>";
					vHtml2 += "</span>";
					vHtml2 += "<div class='subject2' href='#.'>"+data.row[i].review+"</div>";
					vHtml2 += "</div>";
					vHtml2 += "</div>";
					vHtml2 += "</a>";
					vHtml2 += "</td>";
					vHtml2 += "</tr>";
				}
			}else{
				vHtml2 += "<tr><td colspan='2' class='no_data'><div><i class='xi-error-o'></i>이용후기가 없습니다.</div></td></tr>";
			}
			$("#reviewList").html(vHtml2);
			
			$("#modal_review").modal();			
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
	if(!confirm("견적을 취소하시겠습니까?")) return;
	var params={
			idx:$("#idx").val(),
			state:"6"
	};	
	
	var url = "../estimate/updateEstimate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적을 취소하였습니다.");
			location.href = "myEstimateList.do";
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}

var vIdx;
var vEstimateIdx;
function doSelect(idx, estimateIdx, bizName)
{
	$("#selectBiz").html(bizName);
	$("#selectCompleteBiz").html(bizName+" 선택하시겠습니까?");
	
	vIdx = idx;
	vEstimateIdx = estimateIdx;
	$("#modal_select").modal();
}

function doPriceDetail(idx, estimateIdx, rcEmail)
{
	var params={
			estimateIdx:estimateIdx,
			rcEmail:rcEmail
	};	
	
	var url = "../estimate/selectMyEstimatePriceDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#divTotalAmt").html(cfnNumberComma(data.totalAmt)+" 원");
			
			var vHtml = "";
			for(var i=1; i<=11; i++)
			{
				var vId = i;
				if(i<10) vId = "0"+i;
				var vAmtId  = "amt"+vId;
				var vVatId  = "vat"+vId;
				var vItemId = "item"+vId;
				var vDescId = "desc"+vId;
				
				vHtml += "<tr>";
				vHtml += "<td style='word-break:break-all;'><p>"+cfNvl1(data[vItemId])+"</p></td>";
				vHtml += "<td style='word-break:break-all;'><p>"+cfNvl1(data[vDescId])+"</p></td>";
				vHtml += "<td class='text-right' style='word-break:break-all;'>"+cfnNumberCommaOne(cfNvl1(data[vAmtId]))+"</td>";
				vHtml += "<td class='text-right' style='word-break:break-all;'>"+cfnNumberCommaOne(cfNvl1(data[vVatId]))+"</td>";
				vHtml += "</tr>";
				
			}
			$("#priceList").html(vHtml);
			$("#priceDetail1").html(cfNvl1(data.content));
			$("#priceDetail2").html(cfNvl1(data.discoutContent));
			$("#modal_price_detail").modal();
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doClosePriceDetail()
{
	$("#modal_price_detail").modal("hide");
}
function doSelectComplete()
{
	if(!cfnNullCheckInput($("#requesttime").val(), "요청일자")) return;
	
	$("#modal_select").modal("hide");
	
	var params={
			idx:vIdx,
			estimateIdx:vEstimateIdx,
			requesttime:$("#requesttime").val()
	};	
	
	var url = "../estimate/updateEstimatePropose.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#modal_select_complete").modal();
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}

function doSelectCancel()
{
	$("#modal_select").modal("hide");
}

function doSelectCompleteEnd()
{
	$("#modal_select_complete").modal("hide");
	location.href = "myEstimateDetail.do?idx="+$("#idx").val();
}
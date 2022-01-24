(function($){
	$.fn.image_gallery = function(prop){
		var options = $.extend({
		},prop);
				
		//Click event on element
		return this.hover(function(e){
			//$('.pati_main_img img').attr('src',$(this).children('img').attr('src'));
			var vHtml =$(this).find(".thumb_img").html(); 
			//vHtml = vHtml.replace("<div class='overlay'></div>","");
			//alert($(this).html());
			$('#main_photo').html(vHtml);
		});
		
		return this;
	};
	
})(jQuery);


jQuery(document).ready(function(){
	cfnLoginCheck("9");
	
	var params={
		idx:$("#idx").val()
	};

	var url = "../admin/selectEstimateDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			var price = 0;
			if(data.propose_success.length > 0)
			{
				price = data.propose_success[0].price;
			}
			var centerCnt =  data.propose_success.length + data.propose_process.length;
			
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
			
			fnCreateCenterList(data.master.eType, data.master.state, data.propose_success, data.propose_process);

			fnCreateReview(data.master.reviewYn, data.propose_review);
			
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

function fnCreateMaster(data, price, centerCnt)
{
	$('#main_photo').html("<img class='rotate"+data.photo1Rotate+"' src='"+_setPhoto(data.photo1, data.eType)+"'>");
	var pHtml = "";
	if(data.photo1)
	{
		pHtml += "<div class='pati_select_img_thumb'>";
		pHtml += "<div class='overlay'></div><div class='thumb_img'><img class='rotate"+data.photo1Rotate+"' src='"+_setPhoto(data.photo1, data.eType)+"'></div>";
		pHtml += "</div>";
	}
	if(data.photo2)
	{
		pHtml += "<div class='pati_select_img_thumb'>";
		pHtml += "<div class='overlay'></div><div class='thumb_img'><img class='rotate"+data.photo2Rotate+"' src='"+_setPhoto(data.photo2, data.eType)+"'></div>";
		pHtml += "</div>";
	}
	if(data.photo3)
	{
		pHtml += "<div class='pati_select_img_thumb'>";
		pHtml += "<div class='overlay'></div><div class='thumb_img'><img class='rotate"+data.photo3Rotate+"' src='"+_setPhoto(data.photo3, data.eType)+"'></div>";
		pHtml += "</div>";
	}
	if(data.photo4)
	{
		pHtml += "<div class='pati_select_img_thumb'>";
		pHtml += "<div class='overlay'></div><div class='thumb_img'><img class='rotate"+data.photo4Rotate+"' src='"+_setPhoto(data.photo4, data.eType)+"'></div>";
		pHtml += "</div>";
	}
	if(data.photo5)
	{
		pHtml += "<div class='pati_select_img_thumb'>";
		pHtml += "<div class='overlay'></div><div class='thumb_img'><img class='rotate"+data.photo5Rotate+"' src='"+_setPhoto(data.photo5, data.eType)+"'></div>";
		pHtml += "</div>";
	}
	if(data.photo6)
	{
		pHtml += "<div class='pati_select_img_thumb'>";
		pHtml += "<div class='overlay'></div><div class='thumb_img'><img class='rotate"+data.photo6Rotate+"' src='"+_setPhoto(data.photo6, data.eType)+"'></div>";
		pHtml += "</div>";
	}
	if(data.photo7)
	{
		pHtml += "<div class='pati_select_img_thumb'>";
		pHtml += "<div class='overlay'></div><div class='thumb_img'><img sclass='rotate"+data.photo7Rotate+"' src='"+_setPhoto(data.photo7, data.eType)+"'></div>";
		pHtml += "</div>";
	}
	if(data.photo8)
	{
		pHtml += "<div class='pati_select_img_thumb'>";
		pHtml += "<div class='overlay'></div><div class='thumb_img'><img class='rotate"+data.photo8Rotate+"' src='"+_setPhoto(data.photo8, data.eType)+"'></div>";
		pHtml += "</div>";
	}
	if(data.photo9)
	{
		pHtml += "<div class='pati_select_img_thumb'>";
		pHtml += "<div class='overlay'></div><div class='thumb_img'><img class='rotate"+data.photo9Rotate+"' src='"+_setPhoto(data.photo9, data.eType)+"'></div>";
		pHtml += "</div>";
	}
	$('#thumb_photo').html(pHtml);

	var vHtml = "";
	vHtml += "<div class='row'><div class='col-lg-12'><h1 class='pati_main_title'>"+_strEType(data.eType)+"</h1></div></div>";
	vHtml += "<div class='space-15'></div>";
	vHtml += "<div class='row'><div class='col-lg-12'><div class='pati_main_line'></div></div></div>";
	vHtml += "<div class='space-30'></div>	";
	vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>제목</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.title+"</p></div></div>";
	vHtml += "<div class='space-15'></div>";
	if(data.state == "0" || data.state == "1" || data.state == "6")
	{
		if(centerCnt > 0)
		{
			if(data.eType == "2")
			{
				vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참여자</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.priceQty+"명</p></div></div>";
				vHtml += "<div class='space-15'></div>";
				vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title02'>최저가적</h2></div><div class='col-lg-8'><p class='pati_main_sub_content02'>"+cfnNumberCommaEstimate(data.price)+"</p></div></div>";
			}else{
				vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참여자</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.priceQty+"명</p></div></div>";
				vHtml += "<div class='space-15'></div>";
				vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title02'>최고견적</h2></div><div class='col-lg-8'><p class='pati_main_sub_content02'>"+cfnNumberCommaEstimate(data.price)+"</p></div></div>";
			}
		}else{
			if(data.eType == "2")
			{
				vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참여자</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>- 명</p></div></div>";
				vHtml += "<div class='space-15'></div>";
				vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title02'>최저가적</h2></div><div class='col-lg-8'><p class='pati_main_sub_content02'>- 원</p></div></div>";
			}else{
				vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참여자</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>- 명</p></div></div>";
				vHtml += "<div class='space-15'></div>";
				vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title02'>최고견적</h2></div><div class='col-lg-8'><p class='pati_main_sub_content02'>- 원</p></div></div>";
			}
		}
		vHtml += "<div class='space-15'></div>";
	}else if(data.state == "2"){
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참여자</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.priceQty+"명</p></div></div>";
		vHtml += "<div class='space-15'></div>";
		if(data.eType == "2")
		{
			vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title02'>최저가적</h2></div><div class='col-lg-3'><p class='pati_main_sub_content02'>"+cfnNumberCommaEstimate(data.price)+"</p></div><div class='col-lg-5'><p class='pati_main_sub_content'>* 견적이 완료되었습니다.<br/>&nbsp;&nbsp;&nbsp;<span class='pati_main_sub_content02'>업체를 선택</span>해주세요</p></div></div>";
		}else{
			vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title02'>최고견적</h2></div><div class='col-lg-3'><p class='pati_main_sub_content02'>"+cfnNumberCommaEstimate(data.price)+"</p></div><div class='col-lg-5'><p class='pati_main_sub_content'>* 견적이 완료되었습니다.<br/>&nbsp;&nbsp;&nbsp;<span class='pati_main_sub_content02'>업체를 선택</span>해주세요</p></div></div>";
		}
		vHtml += "<div class='space-15'></div>";
	}else if(data.state == "3"){
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참여자</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.priceQty+"명</p></div></div>";
		vHtml += "<div class='space-15'></div>";
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title02'>선택견적</h2></div><div class='col-lg-3'><p class='pati_main_sub_content02'>"+cfnNumberComma(price)+"원</p></div><div class='col-lg-5'><p class='pati_main_sub_content'>* 센터에서 고객님께<br/>&nbsp;&nbsp;&nbsp;곧 연락드립니다.</p></div></div>";
		vHtml += "<div class='space-15'></div>";
	}else{
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참여자</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.priceQty+"명</p></div></div>";
		vHtml += "<div class='space-15'></div>";
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title02'>선택견적</h2></div><div class='col-lg-3'><p class='pati_main_sub_content02'>"+cfnNumberComma(price)+"원</p></div></div>";
		vHtml += "<div class='space-15'></div>";
	}
	vHtml += "<div class='row'><div class='col-lg-12'><h2 class='pati_main_sub_title'>ㅡ</h2></div></div>";
	vHtml += "<div class='space-15'></div>";
	vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>이름</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.nickname+"</p></div></div>";
	vHtml += "<div class='space-15'></div>";
	vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>E-Mail</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.email+"</p></div></div>";
	vHtml += "<div class='space-15'></div>";
	vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>연락처</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.phone+"</p></div></div>";
	vHtml += "<div class='space-15'></div>";
	vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>지역</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.area1+" "+data.area2+" "+data.area3+"</p></div></div>";
	vHtml += "<div class='space-15'></div>";
	vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>층수</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.elevatorYn+"/"+data.floor+"</p></div></div>";
	vHtml += "<div class='space-15'></div>";
	if(data.eType == "2")
	{
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>철거요청일</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.pickupDate+"</p></div></div>";
	}else{
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>수거요청일</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.pickupDate+"</p></div></div>";
	}
	
	$('#mainTitle').html(vHtml);	
}

function fnCreateDetail(data, eType, content)
{
	var vHtml = "";
	if(eType == "0")
	{
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>품목</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.itemCat+" "+cfNvl1(data.itemCatDtl)+"</p></div></div>";
		vHtml += "<div class='space-15'></div>";
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>제조사</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.manufacturer+"</p></div></div>";
		vHtml += "<div class='space-15'></div>";
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>모델명</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+cfNvl2(data.medelName,"-")+"</p></div></div>";
		vHtml += "<div class='space-15'></div>";
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>연식</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.year+"</p></div></div>";
		vHtml += "<div class='space-15'></div>";
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참고사항</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+content+"</p></div></div>";
	}else if(eType == "2"){ //철거
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>철거종류 </h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.pullKind+"</p></div></div>";
		vHtml += "<div class='space-15'></div>";
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>천장/바닥 철거  </h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+cfNvl2(data.pullFloorBottom,"-")+"</p></div></div>";
		vHtml += "<div class='space-15'></div>";
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>철거평수</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+cfNvl2(data.pullSpace,"-")+"</p></div></div>";
		vHtml += "<div class='space-15'></div>";
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>철거사이즈</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+cfNvl2(data.pullSize,"-")+"</p></div></div>";
		vHtml += "<div class='space-15'></div>";
		vHtml += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참고사항</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+content+"</p></div></div>";
		
	}
	$('#sub_content').html(vHtml);
}

function fnCreateDetailList(data, eType, content)
{
	var vHtml = "";
	if(eType == "1")
	{
		vHtml += "<div class='row'><div class='col-lg-12'>";
		vHtml += "<table class='myestimate_item_table'><thead>";
		vHtml += "<tr>";
		vHtml += "<th class='text-center'>품목</th>";
		vHtml += "<th class='text-center'>세부카테고리</th>";
		vHtml += "<th class='text-center'>제조사</th>";
		vHtml += "<th class='text-center'>모델명</th>";
		vHtml += "<th class='text-center'>년식</th>";
		vHtml += "<th class='text-center'>수량</th>";
		vHtml += "</tr>";
		vHtml += "</thead><tbody>";
		for(var i=0; i<data.length; i++)
		{
			vHtml += "<tr>";
			vHtml += "<td class='text-center'>"+cfNvl2(data[i].itemCat,"-")+"</th>";
			vHtml += "<td class='text-center'>"+cfNvl2(data[i].itemCatDtl,"-")+"</th>";
			vHtml += "<td class='text-center'>"+cfNvl2(data[i].manufacturer,"-")+"</th>";
			vHtml += "<td class='text-center'>"+cfNvl2(data[i].medelName,"-")+"</th>";
			vHtml += "<td class='text-center'>"+cfNvl2(data[i].year,"-")+"</th>";
			vHtml += "<td class='text-center'>"+cfNvl2(data[i].itemQty,"-")+"</th>";
			vHtml += "</tr>";
		}
		vHtml += "</tbody></table>";
		vHtml += "</div></div>";
		vHtml += "<div class='space-45'></div>";
		vHtml += "<div class='row'><div class='col-lg-12'><h2 class='pati_main_sub_title'>참고사항</h2></div></div>";
		vHtml += "<div class='row'><div class='col-lg-12'><p class='pati_main_sub_content'>"+content+"</p></div></div>";
	}else if(eType == "2"){ //철거
		vHtml += "<div class='row'><div class='col-lg-12'>";
		vHtml += "<table class='myestimate_item_table'><thead>";
		vHtml += "<tr>";
		vHtml += "<th class='text-center'>철거종류</th>";
		vHtml += "<th class='text-center'>천장/바닥 철거 유뮤</th>";
		vHtml += "<th class='text-center'>철거평수</th>";
		vHtml += "<th class='text-center'>철거사이즈</th>";
		vHtml += "</tr>";
		vHtml += "</thead><tbody>";
		for(var i=0; i<data.length; i++)
		{
			vHtml += "<tr>";
			vHtml += "<td class='text-center'>"+cfNvl2(data[i].pullKind,"-")+"</th>";
			vHtml += "<td class='text-center'>"+cfNvl2(data[i].pullFloorBottom,"-")+"</th>";
			vHtml += "<td class='text-center'>"+cfNvl2(data[i].pullSpace,"-")+"</th>";
			vHtml += "<td class='text-center'>"+cfNvl2(data[i].pullSize,"-")+"</th>";
			vHtml += "</tr>";
		}
		vHtml += "</tbody></table>";
		vHtml += "</div></div>";
		vHtml += "<div class='space-45'></div>";
		vHtml += "<div class='row'><div class='col-lg-12'><h2 class='pati_main_sub_title'>참고사항</h2></div></div>";
		vHtml += "<div class='row'><div class='col-lg-12'><p class='pati_main_sub_content'>"+content+"</p></div></div>";
	}	
	$('#sub_content').html(vHtml);
}

function fnCreateCenterList(eType, state, successList, processList)
{

	var vHtml = "";
	if(state == "3" || state == "4" || state == "5")
	{
		var vScore = parseInt(successList[0].score);
		var vRate = vScore/5 * 100 ;
		
		vHtml += "<div class='row'><div class='col-lg-12'><span class='txt_title_06_underline'>선택업체</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='txt_label_10'>센터에서 고객님께 곧 연락 예정입니다</span></div></div>";
		vHtml += "<div class='space-60'></div>";
		vHtml += "<div class='row'><div class='col-lg-12'>";
		vHtml += "<table class='myestimate_detail_table'><tbody id='proposeList'>";
		vHtml += "<tr class='select'>";
		vHtml += "<td class='image'><img src='"+_setPhotoSite(successList[0].photoSite)+"'></td>";
		vHtml += "<td class='data'>";
		vHtml += "<h4>"+successList[0].rcNickname+"</h4>";
		vHtml += "<p class='area'>"+_getArea(successList[0].area1)+"</p>";
		vHtml += "<span class='review_star1'><em style='width:"+vRate+"%;'>평점</em></span>";
		vHtml += "<p class='price'>";
		if(successList[0].price == "0")
		{
			if(eType == "2")
			{
				vHtml += "<span class='title'>견적가격&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='price'>무료철거</span>";
			}else{
				vHtml += "<span class='title'>견적가격&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='price'>무료수거</span>";
			}
		}else{
			vHtml += "<span class='title'>견적가격&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='price'>"+cfnNumberComma(successList[0].price)+"원</span>";
		}
		vHtml += "</p>";
		vHtml += "</td>";
		if(eType == "2")
		{
			vHtml += "<td class='button1'>";
			vHtml += "<button class='btn btn_default_07' type='button' onClick='doPriceDetail(\""+successList[0].idx+"\",\""+successList[0].estimateIdx+"\",\""+successList[0].rcEmail+"\")'><span>상세견적보기</span></button>";
			vHtml += "</td>";
		}		
		vHtml += "</tr>";
		vHtml += "</tbody></table>";
		vHtml += "</div></div>";
		
		vHtml += "<div class='space-100'></div>";
		
	}
	vHtml += "<div class='row'><div class='col-lg-12'><div class='txt_title_06_underline'>참여업체</div></div></div>";
	vHtml += "<div class='space-60'></div>";
	vHtml += "<div class='row'><div class='col-lg-12'>";
	vHtml += "<table class='myestimate_detail_table'><tbody id='proposeList'>";
	for(var i=0; i<processList.length; i++)
	{
		//var vScore = parseInt(processList[i].score);
		var vScore = processList[i].score;
		var vRate = vScore/5 * 100 ;

		vHtml += "<tr class='data'>";
		vHtml += "<td class='image'><img src='"+_setPhotoSite(processList[i].photoSite)+"'></td>";
		vHtml += "<td class='data'>";
		vHtml += "<h4>"+processList[i].rcNickname+"</h4>";
		vHtml += "<p class='area'>"+_getArea(processList[i].area1)+"</p>";
		vHtml += "<span class='review_star1'><em style='width:"+vRate+"%;'>평점</em></span>";
		vHtml += "<p class='price'>";
		vHtml += "<span class='title'>견적가격&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='price'>"+cfnNumberCommaEstimate(processList[i].price)+"</span>";
		vHtml += "</p>";
		vHtml += "</td>";
		if(eType == "2")
		{
			vHtml += "<td class='button1'>";
			vHtml += "<button class='btn btn_default_07' type='button' onClick='doPriceDetail(\""+processList[i].idx+"\",\""+processList[i].estimateIdx+"\",\""+processList[i].rcEmail+"\")'><span>상세견적보기</span></button>";
			vHtml += "</td>";
		}		
		vHtml += "</tr>";
		vHtml += "<tr style='height:80px;'><td colspan='3'></td></tr>";
	}
	vHtml += "</tbody></table>";
	vHtml += "</div></div>";

	$('#proposeList').html(vHtml);
}

function fnCreateReview(reviewYn, review)
{
	var vHtml = "";
	if(reviewYn == "0")
	{
		vHtml += "<div class='row'>";
		vHtml += "<div class='col-lg-12'><div class='txt_title_07'>고객후기</div></div>";
		vHtml += "</div>";
		vHtml += "</div>";
		vHtml += "<div class='space-20'></div>";
		vHtml += "<div class='row'><div class='col-lg-12'><div class='pati_main_line'></div></div></div>";
		vHtml += "<div class='space-90'></div>";
		vHtml += "<div class='row'><div class='col-lg-12 text-center'><h2 class='pati_main_sub_title'>작성된 후기가 없습니다.</h2></div></div>";
	}else{
		vHtml += "<div class='row'><div class='col-lg-12'><div class='txt_title_07'>고객후기</div></div></div>";
		vHtml += "<div class='space-20'></div>";
		vHtml += "<div class='row'><div class='col-lg-12'><div class='pati_main_line'></div></div></div>";
		vHtml += "<div class='space-70'></div>";
		//vHtml += "<div class='row'><div class='col-lg-12'><p>"+review+"</p></div></div>";
		var vScore = parseInt(review[0].score);
		var vRate = vScore/5 * 100 ;
		vHtml += "<div class='row'>";
		vHtml += "<div class='col-lg-2'>";
		vHtml += "<div class='review_img'>";
		vHtml += "<img src='"+_setPhoto(review[0].photo1, review[0].eType)+"'/>";
		vHtml += "</div>";
		vHtml += "</div>";
		vHtml += "<div class='col-lg-7'>";
		vHtml += "<div class='review_content'>";
		vHtml += "<span><a href='#here' onClick='doClickReview(\""+review[0].idx+"\")'>"+_strEType(review[0].eType)+" / "+_getTitleReview(review[0].title)+" / </a></span>";
		vHtml += "<span class='review_star1'><em style='width:"+vRate+"%;'>평점</em></span>";
		vHtml += "<p>"+review[0].area1+" "+review[0].area2+"</p>";
		vHtml += "<p>"+_getReview(review[0].idx, review[0].review)+"</p>";
		vHtml += "</div>";
		vHtml += "</div>";
		vHtml += "<div class='col-lg-3'>";
		vHtml += "<div class='review_write'>";
		vHtml += "<p>작성자  :  "+_getNickname(review[0].nickname)+"</p>";
		vHtml += "<p>등록일  :  "+_getDate(review[0].updatetime)+"</p>";
		vHtml += "</div>";
		vHtml += "</div>";
		vHtml += "</div>";	
		vHtml += "<div id='review_"+review[0].idx+"' class='review_detail' style='display:none;'>";
		vHtml += "<p>"+review[0].review+"</p>";
		vHtml += "</div>";
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

function doEstimateModify()
{
	var vIdx   =$("#idx").val();
	var vGubun =$("#subIdx").val();
	location.href="../admin/estimateModify"+vGubun+".do?idx="+vIdx;
}

function doEstimateList()
{
	location.href="../admin/estimate.do";
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
				vHtml += "<td class='text-center' style='word-break:break-all;'><p>"+cfNvl1(data[vItemId])+"</p></td>";
				vHtml += "<td style='word-break:break-all;'><p>"+cfNvl1(data[vDescId])+"</p></td>";
				vHtml += "<td class='text-right' style='word-break:break-all;'><p>"+cfnNumberCommaOne(cfNvl1(data[vAmtId]))+"</p></td>";
				vHtml += "<td class='text-right' style='word-break:break-all;'><p>"+cfnNumberCommaOne(cfNvl1(data[vVatId]))+"</p></td>";
				vHtml += "</tr>";
				
			}
			vHtml += "<tr>";
			vHtml += "<td colspan='4' style='word-break:break-all;'>";
			vHtml += "<div class='row'>";
			vHtml += "<div class='col-lg-6'>";
			vHtml += "<span class='pati_detail_label_03'>추가사항</span>";
			vHtml += "<span class='pati_detail_label_04'>(고객 정보내역보다 추가 될 사항 있을 시)</span><br/>";
			vHtml += "<p>"+cfNvl1(data.content)+"</p>";
			vHtml += "</div>";
			vHtml += "<div class='col-lg-6'>";
			vHtml += "<span class='pati_detail_label_03'>감가사항</span>";
			vHtml += "<span class='pati_detail_label_04'>(고객내역에서 감가 가능한 사항)</span><br/>";
			vHtml += "<p>"+cfNvl1(data.discoutContent)+"</p>";
			vHtml += "</div>";
			vHtml += "</div>";									 			
			vHtml += "</td>";
			vHtml += "</tr>";
			$("#priceList").html(vHtml);
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
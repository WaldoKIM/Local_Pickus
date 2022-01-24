(function($){
	$.fn.image_gallery = function(prop){
		var options = $.extend({
		},prop);
				
		//Click event on element
		return this.hover(function(e){
			$('.pati_main_img img').attr('src',$(this).children('img').attr('src'));
			
		});
		
		return this;
	};
	
})(jQuery);


jQuery(document).ready(function(){
	var params={
		idx:$("#idx").val()
	};

	var url = "../estimate/selectPatiEstimate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#price").val(data.master.price);
			$("#subIdx").val(data.master.subIdx);
			$("#detailIdx").val(data.master.detailIdx);

			$('#main_photo').html("<img src='"+_setPhoto(data.master.photo1, data.master.eType)+"'>");
			
			$('#thumb_photo1').html("<div class='overlay'></div><img src='"+_setPhoto(data.master.photo1, data.master.eType)+"'>");
			$('#thumb_photo2').html("<div class='overlay'></div><img src='"+_setPhoto(data.master.photo2, data.master.eType)+"'>");
			$('#thumb_photo3').html("<div class='overlay'></div><img src='"+_setPhoto(data.master.photo3, data.master.eType)+"'>");
			$('#thumb_photo4').html("<div class='overlay'></div><img src='"+_setPhoto(data.master.photo4, data.master.eType)+"'>");
			$('#thumb_photo5').html("<div class='overlay'></div><img src='"+_setPhoto(data.master.photo5, data.master.eType)+"'>");
			$('#thumb_photo6').html("<div class='overlay'></div><img src='"+_setPhoto(data.master.photo6, data.master.eType)+"'>");
			
			var vHtml1 = "";
			vHtml1 += "<div class='row'><div class='col-lg-12'><h1 class='pati_main_title'>가전/가구 매입</h1></div></div>";
			vHtml1 += "<div class='space-15'></div>";
			vHtml1 += "<div class='row'><div class='col-lg-12'><div class='pati_main_line'></div></div></div>";
			vHtml1 += "<div class='space-30'></div>	";
			vHtml1 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>제목</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.title+"</p></div></div>";
			vHtml1 += "<div class='space-15'></div>";
			vHtml1 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>고객</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.nickname+"</p></div></div>";
			vHtml1 += "<div class='space-15'></div>";
			vHtml1 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title02'>견적가격</h2></div><div class='col-lg-8'><p class='pati_main_sub_content02'>"+cfnNumberComma(data.master.price)+"원&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#none' onClick='doModify();'>수정</a><a href='#none' onClick='doCancel();'>취소</a></p></div></div>";
			vHtml1 += "<div class='space-15'></div>";
			vHtml1 += "<div class='row'><div class='col-lg-12'><h2 class='pati_main_sub_title'>ㅡ</h2></div></div>";
			vHtml1 += "<div class='space-15'></div>";
			vHtml1 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>지역</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.area1+" "+data.master.area2+"</p></div></div>";
			vHtml1 += "<div class='space-15'></div>";
			vHtml1 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>층수</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.elevatorYn+"/"+data.master.floor+"</p></div></div>";
			vHtml1 += "<div class='space-15'></div>";
			vHtml1 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>희망일</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.pickupDate+"</p></div></div>";
			$('#mainTitle').html(vHtml1);
			
			var vHtml2 = "";
			if(data.master.eType == "0")
			{
				vHtml2 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>품목</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.itemCat+"</p></div></div>";
				vHtml2 += "<div class='space-15'></div>";
				vHtml2 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>모델명</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.medelName+"</p></div></div>";
				vHtml2 += "<div class='space-15'></div>";
				vHtml2 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>연식</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.year+"</p></div></div>";
				vHtml2 += "<div class='space-15'></div>";
				vHtml2 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참고사항</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.content+"</p></div></div>";
			}else if(data.master.eType == "1"){
				vHtml2 += "<div class='row'>";
				for(var i=0; i<data.detail.length; i++)
				{
					vHtml2 += "<div class='col-lg-4'>";
					vHtml2 += "<div class='pati_multi_bg'>";
					vHtml2 += "<div class='row'><div class='col-lg-12'><h2 class='pati_main_sub_title01'>"+data.detail[i].itemCat+"</h2></div></div>";
					vHtml2 += "<div class='space-40'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-5'><h2 class='pati_main_sub_title'>세부</h2></div><div class='col-lg-7'><h2 class='pati_main_sub_content'>"+data.detail[i].manufacturer+"</h2></div></div>";
					vHtml2 += "<div class='space-20'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-5'><h2 class='pati_main_sub_title'>모델명 </h2></div><div class='col-lg-7'><h2 class='pati_main_sub_content'>"+data.detail[i].medelName+"</h2></div></div>";
					vHtml2 += "<div class='space-20'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-5'><h2 class='pati_main_sub_title'>연식</h2></div><div class='col-lg-7'><h2 class='pati_main_sub_content'>"+data.detail[i].year+"</h2></div></div>";
					vHtml2 += "<div class='space-20'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-5'><h2 class='pati_main_sub_title'>수량</h2></div><div class='col-lg-7'><h2 class='pati_main_sub_content'>"+data.detail[i].itemQty+"</h2></div></div>";
					vHtml2 += "</div>";
					vHtml2 += "</div>";
					if(i > 0 && i%3 == 2)
					{
						vHtml2 += "</div>";
						vHtml2 += "<div class='space-15'></div>";
						vHtml2 += "<div class='row'>";
					}
				}
				vHtml2 += "</div>";
				vHtml2 += "<div class='space-60'></div>";
				vHtml2 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참고사항</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.content+"</p></div></div>";
			}else if(data.master.eType == "2"){
				vHtml2 += "<div class='row'>";
				for(var i=0; i<data.detail.length; i++)
				{
					vHtml2 += "<div class='col-lg-4'>";
					vHtml2 += "<div class='pati_multi_bg'>";
					vHtml2 += "<div class='row'><div class='col-lg-12'><h2 class='pati_main_sub_title01'>철거</h2></div></div>";
					vHtml2 += "<div class='space-40'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-6'><h2 class='pati_main_sub_title'>종류</h2></div><div class='col-lg-6'><h2 class='pati_main_sub_content'>"+data.detail[i].itemCat+"</h2></div></div>";
					vHtml2 += "<div class='space-20'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-6'><h2 class='pati_main_sub_title'>철거 유뮤 </h2></div><div class='col-lg-6'><h2 class='pati_main_sub_content'>"+data.detail[i].manufacturer+"</h2></div></div>";
					vHtml2 += "<div class='space-20'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-6'><h2 class='pati_main_sub_title'>평수</h2></div><div class='col-lg-6'><h2 class='pati_main_sub_content'>"+data.detail[i].medelName+"</h2></div></div>";
					vHtml2 += "<div class='space-20'></div>";
					vHtml2 += "<div class='row'><div class='col-lg-6'><h2 class='pati_main_sub_title'>사이즈</h2></div><div class='col-lg-6'><h2 class='pati_main_sub_content'>"+data.detail[i].year+"</h2></div></div>";
					vHtml2 += "</div>";
					vHtml2 += "</div>";
					if(i > 0 && i%3 == 2)
					{
						vHtml2 += "</div>";
						vHtml2 += "<div class='space-15'></div>";
						vHtml2 += "<div class='row'>";
					}
				}
				vHtml2 += "</div>";
				vHtml2 += "<div class='space-60'></div>";
				vHtml2 += "<div class='row'><div class='col-lg-4'><h2 class='pati_main_sub_title'>참고사항</h2></div><div class='col-lg-8'><p class='pati_main_sub_content'>"+data.master.content+"</p></div></div>";
			}
			
			$('#sub_content').html(vHtml2);
			
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

function _strEType(e_type) {
	if(e_type==0) {
		return '가전/가구 매입';
	} else if(e_type==1){
		return '다량 매입';
	} else {
		return '철거/원상복구';
	}
}

function _setPhoto(photo, e_type) {          
	if(photo) {
		return '../common/file/imageDownload.do?fileNewName='+photo;
	} else {
		if(e_type==2){
			return '../images/review/blank_destory.jpg';
		} else{
			return '../images/review/blank_bulk.jpg';
		}            
	}
}

function doModify()
{
	$('#modal_price').modal();
}

function doCancelPrice()
{
	$('#modal_price').modal("hide");
}

function doSavePrice()
{
	idx = $("#idx").val();
	var params={
			idx:$("#subIdx").val(),
			price:$("#price").val()
	};	
	
	var url = "../estimate/updatePatiEstimate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적을 수정하였습니다.");
			location.href = "modifyPatiEstimate.do?idx="+idx;
			
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
	idx = $("#idx").val();
	var params={
			subIdx:$("#subIdx").val(),
			detailIdx:$("#detailIdx").val()
	};	
	
	var url = "../estimate/deletePatiEstimate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적에 취소하였습니다.");
			location.href = "patiEstimate.do?idx="+idx;
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}
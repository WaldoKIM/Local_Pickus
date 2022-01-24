var vPageCount = 5;
var vShowIdx = "";

jQuery(document).ready(function(){
	doSearchList(1);	
});

function doSearchList(pageNum)
{
	vShowIdx = "";
	
	var params={
			pageCount:vPageCount,
			pageNum:pageNum
	};
	var url = "selectReviewList.do";
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#reviewList").html("");
			$("#pageList").html("");
			if(data.totalCount > 0 )
			{
				var fvHtml = "";
				for(var i=0; i<data.row.length; i++)
				{
					var vScore = parseInt(data.row[i].score);
					var vRate = vScore/5 * 100 ;
					fvHtml += "<div class='row'>";
					fvHtml += "<div class='col-lg-2'>";
					fvHtml += "<div class='review_img'>";
					fvHtml += "<img class='rotate"+data.row[i].photo1Rotate+"' src='"+_setPhoto(data.row[i].photo1, data.row[i].eType)+"'/>";
					fvHtml += "</div>";
					fvHtml += "</div>";
					fvHtml += "<div class='col-lg-7'>";
					fvHtml += "<div class='review_content'>";
					fvHtml += "<span><a href='#here' onClick='doClickReview(\""+data.row[i].idx+"\")'>"+_strEType(data.row[i].eType)+" / "+_getTitleReview(data.row[i].title)+" / </a></span>";
					fvHtml += "<span class='review_star1'><em style='width:"+vRate+"%;'>평점</em></span>";
					fvHtml += "<p>"+data.row[i].area1+" "+data.row[i].area2+"</p>";
					fvHtml += "<p>"+_getReview(data.row[i].idx, data.row[i].review)+"</p>";
					fvHtml += "</div>";
					fvHtml += "</div>";
					fvHtml += "<div class='col-lg-3'>";
					fvHtml += "<div class='review_write'>";
					fvHtml += "<p>작성자  :  "+_getNickname(data.row[i].nickname)+"</p>";
					fvHtml += "<p>등록일  :  "+_getDate(data.row[i].updatetime)+"</p>";
					fvHtml += "</div>";
					fvHtml += "</div>";
					fvHtml += "</div>";	
					fvHtml += "<div id='review_"+data.row[i].idx+"' class='review_detail' style='display:none;'>";
					//fvHtml += "<span>"+data.row[i].title+"</span>";
					fvHtml += "<p>"+data.row[i].review+"</p>";
					fvHtml += "</div>";
					fvHtml += "<div class='space-75'></div>";				
				}
				
				$("#reviewList").html(fvHtml);
				
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
					pageHtml += "<a href='#none' onClick='doSearchList("+(lv_InitVal-1)+");' aria-label='Previous'>";
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
						pageHtml += "<li><a href='#none' onClick='doSearchList("+lv_value+");'>"+lv_value+"</a></li>";
					}
				}
				if(lv_TotPage > lv_InitVal+9){
					pageHtml += "<li>";
					pageHtml += "<a href='#none' onClick='doSearchList("+(lv_InitVal+10)+");' aria-label='Next'>";
					pageHtml += "<span aria-hidden='true'>▶</span>";
					pageHtml += "</a>";
					pageHtml += "</li>";
				}
				$("#pageList").html(pageHtml);				
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
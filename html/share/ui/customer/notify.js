var vPageCount = 10;
var vPageNum;
var vShowIdx = "";


jQuery(document).ready(function(){
	doSearchList(1);
});

function doSearchList(pageNum)
{
	vPageNum = pageNum;
	var params={
			pageCount:vPageCount,
			pageNum:pageNum
	};
	var url = "selectNotifyList.do";
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#tableList").html("");
			$("#page").html("");
			var fvHtml="";
			if(data.totalCount > 0 )
			{
				for(var i=0; i<data.row.length; i++)
				{
					fvHtml+="<tr>";
					fvHtml+="<td class='tt_left'>"+cfNvl1(data.row[i].title)+"</td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].updatetime)+"</td>";
					if(data.row[i].readGb == "1")
					{
						fvHtml+="<td id='read_"+data.row[i].idx+"' class='web_td'>";
						fvHtml+="<span class='end'>읽음</span>";
						fvHtml+="</td>";
					}else{
						fvHtml+="<td id='read_"+data.row[i].idx+"' class='web_td'>";
						fvHtml+="<span class='ready'>읽지않음</span>";
						fvHtml+="</td>";
					}
					fvHtml+="<td>";
					fvHtml+="<a href='#' class='btn main_bg' onClick='doMoveNotify(\""+data.row[i].idx+"\",\""+data.row[i].notiType+"\",\""+data.row[i].estimateIdx+"\")'>이동</a>";
					fvHtml+="</td>";
				}
				$("#tableList").html(fvHtml);
				
				//페이징 처리.
				var pageHtml = "<span>";
				var lv_TotCnt  = parseInt(data.totalCount);
				var lv_CurPage = pageNum;
				var lv_TotPage = parseInt(data.totalPage);
				
				var lv_last = lv_TotPage%5-1;
				
				if(lv_last == -1) lv_last = 4;
				
				lv_last = lv_TotPage - lv_last;
				
				var lv_InitVal  = 1;
				if(lv_CurPage%5 == 0 && lv_CurPage > 5){	
					lv_InitVal = lv_CurPage - 4;
				}else if(lv_CurPage > 5){
					lv_InitVal =lv_CurPage - (lv_CurPage%5) + 1;
				}
				
				var lv_PageGab  = lv_TotPage - lv_InitVal + 1;
				
				if(lv_PageGab > 5)	lv_PageGab = 5;
				
				if(lv_TotCnt > 0 && lv_CurPage > 5)
				{
					pageHtml += "<a href='#none' onClick='doSearchList("+(lv_InitVal-1)+");' class='prev' title='이전 블럭'></a>";
				}
				for(var t=1; t<=lv_PageGab; t++)
				{
					var lv_value = lv_InitVal-1+t;
					if(lv_value == lv_CurPage)
					{
						pageHtml += "<a href='#none' onClick='doSearchList("+lv_value+");' class='on'>"+lv_value+"</a>";
					}else{
						pageHtml += "<a href='#none' onClick='doSearchList("+lv_value+");' class=''>"+lv_value+"</a>";
					}
				}
				if(lv_TotPage > lv_InitVal+4){
					pageHtml += "<a href='#none' onClick='doSearchList("+(lv_InitVal+5)+");' class='next' title='다음 블럭'></a>";
				}
				pageHtml += "</span>";
				
				$("#page").html(pageHtml);	
			}else{
				fvHtml+="<tr>";
				
				fvHtml+="<td colspan='4' class='text-center'>알림이 없습니다.</td>";
				fvHtml+="</tr>";	
				$("#tableList").html(fvHtml);
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

function doMoveNotify(idx, notiType, estimateIdx)
{
	var params={
			idx:idx
	};	
	
	var url = "readNotify.do";

	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(notiType == "11"){
				location.href="../estimate/myEstimateDetail.do?idx="+estimateIdx;
			}else if(notiType == "12"){
				location.href="../estimate/myEstimateDetail.do?idx="+estimateIdx;
			}else if(notiType == "13"){
				location.href="../estimate/myEstimateDetail.do?idx="+estimateIdx;
			}else if(notiType == "14"){
				location.href="../estimate/myEstimateDetail.do?idx="+estimateIdx;
			}else if(notiType == "15"){
				location.href="../estimate/myEstimateDetail.do?idx="+estimateIdx;
			}else if(notiType == "21"){
				location.href="../estimate/estimateList1.do";
			}else if(notiType == "22"){
				location.href = "../estimate/partnerEstimateDetail.do?idx="+estimateIdx;
			}else if(notiType == "23"){
				location.href = "../estimate/partnerEstimateDetail.do?idx="+estimateIdx;
			}else if(notiType == "24"){
				location.href = "../estimate/partnerEstimateDetail.do?idx="+estimateIdx;
			}else if(notiType == "25"){
				location.href = "../estimate/partnerEstimateDetail.do?idx="+estimateIdx;
			}else if(notiType == "26"){
				location.href = "../estimate/partnerEstimateDetail.do?idx="+estimateIdx;
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

function doSearchDetail(idx){
	/*
	var vClickNotify = "notify_"+idx;
	var vClickRead   = "read_"+idx;
	if(vClickNotify == vShowIdx)
	{
		$("#"+vShowIdx).hide();
		vShowIdx = "";
	}else{
		if(vShowIdx)
		{
			$("#"+vShowIdx).hide();
		}
		vShowIdx = vClickNotify;
		
		var params={
				idx:idx
		};	
		
		var url = "readNotify.do";

		$.ajax({
			type: "POST",
			url : url,
			data: params,
			success : function(data) {
				$("#"+vClickNotify).show();
				$("#"+vClickRead).html("<span class='customer_qna_success'>읽음</span>");
			},
		    beforeSend : function(){
		    	
			},
			complete : function(){
				
		    },
			error: function(jqXHR, textStatus, errorThrown){
				
		    }
		});	
		
	}
	*/
}


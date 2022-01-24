var vPageCount = 10;
var vPageNum;

jQuery(document).ready(function(){
	doSearch(1);
});

function doSearch(pageNum)
{
	vPageNum = pageNum;
	var params={
			pageCount:vPageCount,
			pageNum:pageNum
	};
	var url = "selectNoticeList.do";
	
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
					
					fvHtml+="<td>"+cfNvl1(data.row[i].idx)+"</td>";
					fvHtml+="<td><a class='subject' href='./noticeDetail.do?idx="+cfNvl1(data.row[i].idx)+"'>"+cfNvl1(data.row[i].title)+"</a></td>";
					fvHtml+="<td class='web_td'>"+cfNvl1(data.row[i].updatetime)+"</td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].hit)+"</td>";
					fvHtml+="</tr>";
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
					pageHtml += "<a href='#none' onClick='doSearch("+(lv_InitVal-1)+");' class='prev' title='이전 블럭'></a>";
				}
				for(var t=1; t<=lv_PageGab; t++)
				{
					var lv_value = lv_InitVal-1+t;
					if(lv_value == lv_CurPage)
					{
						pageHtml += "<a href='#none' onClick='doSearch("+lv_value+");' class='on'>"+lv_value+"</a>";
					}else{
						pageHtml += "<a href='#none' onClick='doSearch("+lv_value+");' class=''>"+lv_value+"</a>";
					}
				}
				if(lv_TotPage > lv_InitVal+4){
					pageHtml += "<a href='#none' onClick='doSearch("+(lv_InitVal+5)+");' class='next' title='다음 블럭'></a>";
				}
				pageHtml += "</span>";
				
				$("#page").html(pageHtml);
			}else{
				fvHtml+="<tr>";
				
				fvHtml+="<td colspan='4' class='text-center'>공지사항이 없습니다.</td>";
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
var vPageCount = 6;
var vPageNum = 1;
var patiGubun = "1";

jQuery(document).ready(function(){
	cfnLoginCheck("2");
	$('input[name="srchPatiGubun"]').change(function() { 
		doChangePatiGubun();
	});
	
	doSearchList(1);
})

function doChangePatiGubun(vGubun)
{
	if(vGubun != patiGubun)
	{
		patiGubun = vGubun;
		if(vGubun == "1"){
			$("#patiGubun2").removeClass("on");
			$("#patiGubun1").addClass("on");
		}else{
			$("#patiGubun1").removeClass("on");
			$("#patiGubun2").addClass("on");
		}
		
		
	}
	doSearchList(1);
}

function doSearchList(pageNum)
{
	vPageNum = pageNum;
	
	//var patiGubun = $('input[name="srchPatiGubun"]:checked').val();
	
	var params={
			patiGubun:patiGubun,
			pageCount:vPageCount,
			pageNum:pageNum
	};
	var url = "selectPartnerEstimateList.do";
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#tableList").html("");
			$("#page").html("");
			if(data.totalCount > 0 )
			{
				var fvHtml = "";
				fvHtml += "<table>";
				if(patiGubun == "1")
				{
					fvHtml += "<tr>";
					fvHtml += "<th class='text-center'>날짜</th>";
					fvHtml += "<th class='text-center'>종류</th>";
					fvHtml += "<th class='text-center'>견적정보</th>";
					fvHtml += "<th class='text-center'>가격</th>";
					fvHtml += "<th class='text-center'>진행</th>";
					fvHtml += "</tr>";
				}else{
					fvHtml += "<tr>";
					fvHtml += "<th class='text-center'>날짜</th>";
					fvHtml += "<th class='text-center'>종류</th>";
					fvHtml += "<th class='text-center'>견적정보</th>";
					fvHtml += "<th class='text-center'>가격</th>";
					fvHtml += "<th class='text-center'>확정일</th>";
					fvHtml += "<th class='text-center'>요청일</th>";
					fvHtml += "<th class='text-center'>진행</th>";
					fvHtml += "</tr>";
				}
				for(var i=0; i<data.row.length; i++)
				{
					fvHtml += "<tr onClick='doDetail(\""+data.row[i].idx+"\")'>";
					if(patiGubun == "1")
					{
						fvHtml += "<td class='text-center'>"+data.row[i].writetime+"</td>";
						fvHtml += "<td class='text-center'>"+_strEType(data.row[i].eType)+"</td>";
						fvHtml += "<td>"+data.row[i].title+"</td>";
						fvHtml += "<td class='text-right'>"+cfnNumberCommaEstimate(data.row[i].price)+"</td>";
						fvHtml += "<td class='text-center'>";
						fvHtml += "<p><span>"+_strState(data.row[i].state)+"</span></p>";
						//fvHtml += "<p><a href='modifyPatiEstimate.do?idx="+data.row[i].idx+"'>수정하기</a></p>";
						fvHtml += "</td>";
					}else{
						fvHtml += "<td class='text-center'>"+data.row[i].writetime+"</td>";
						fvHtml += "<td class='text-center'>"+_strEType(data.row[i].eType)+"</td>";
						fvHtml += "<td>"+data.row[i].title+"</td>";
						fvHtml += "<td class='text-right'>"+cfnNumberCommaEstimate(data.row[i].price)+"</td>";
						fvHtml += "<td class='text-center'>"+data.row[i].completetime+"</td>";
						fvHtml += "<td class='text-center'>"+data.row[i].requesttime+"</td>";
						fvHtml += "<td class='text-center'>";
						fvHtml += "<p><span>"+_strState(data.row[i].state)+"</span></p>";
						/*
						if(data.row[i].state == "3")
						{
							fvHtml += "<p><a href='#none' onClick='doRequestEstimate(\""+data.row[i].idx+"\",\""+data.row[i].subIdx+"\");'>수거하기</a></p>";
						}
						if(data.row[i].state == "4")
						{
							fvHtml += "<p><a href='#none' onClick='doCompleteEstimate(\""+data.row[i].idx+"\",\""+data.row[i].subIdx+"\");'>수거완료</a></p>";
						}
						*/
						fvHtml += "</td>";
					}
					fvHtml += "</tr>";
				}
				fvHtml += "</table>";
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
				var fvHtml = "";
				fvHtml += "<table>";
				if(patiGubun == "1")
				{
					fvHtml += "<tr>";
					fvHtml += "<th class='text-center'>날짜</th>";
					fvHtml += "<th class='text-center'>종류</th>";
					fvHtml += "<th class='text-center'>견적정보</th>";
					fvHtml += "<th class='text-center'>가격</th>";
					fvHtml += "<th class='text-center'>진행</th>";
					fvHtml += "</tr>";
				}else{
					fvHtml += "<tr>";
					fvHtml += "<th class='text-center'>날짜</th>";
					fvHtml += "<th class='text-center'>종류</th>";
					fvHtml += "<th class='text-center'>견적정보</th>";
					fvHtml += "<th class='text-center'>가격</th>";
					fvHtml += "<th class='text-center'>확정일</th>";
					fvHtml += "<th class='text-center'>요청일</th>";
					fvHtml += "<th class='text-center'>진행</th>";
					fvHtml += "</tr>";
				}
				fvHtml += "<tr>";
				if(patiGubun == "1")
				{
					fvHtml += "<td colspan='5' class='text-center'>견적을 넣어주세요</td>";
				}else{
					fvHtml += "<td colspan='7' class='text-center'>견적을 넣어주세요</td>";
				}
				fvHtml += "</tr>";
				fvHtml += "</table>";
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

function doDetail(idx)
{
	location.href = "partnerEstimateDetail.do?idx="+idx
}

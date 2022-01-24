var vPageCount = 6;
var vPageNum = 1;
jQuery(document).ready(function(){
	cfnLoginCheck("0","8");
	doSearchList(1);
})

function doSearchList(pageNum)
{
	vPageNum = pageNum;
	vShowIdx = "";
	
	var params={
			pageCount:vPageCount,
			pageNum:pageNum
	};
	var url = "selectMyEstimateList.do";
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#tableList").html("");
			$("#pageList").html("");
			if(data.totalCount > 0 )
			{
				var fvHtml = "";
				for(var i=0; i<data.row.length; i++)
				{
					var state = data.row[i].state;
					var eType = data.row[i].eType;
					fvHtml += "<tr>";
					fvHtml += "<td>"+data.row[i].writetime+"</td>";
					fvHtml += "<td>"+_strEType(data.row[i].eType)+"</td>";
					fvHtml += "<td>";
					fvHtml += "<a class='subject' href='#.' onClick='doSelectEstimate(\""+data.row[i].idx+"\",\""+eType+"\",\""+state+"\")'>";
					fvHtml += data.row[i].title;
					fvHtml += "</a>";
					fvHtml += "</td>";
					fvHtml += "<td>";
					fvHtml += _strState(state);
					fvHtml += "</td>";
					fvHtml += "<td>";
					if(state == "0" || state == "1" )
					{
						fvHtml += "		<a href='#none' onClick='doCancelEstimate(\""+data.row[i].idx+"\")' class='ready'>견적취소</a>";
					}
					
					if(state == "5" && data.row[i].reviewYn == "0")
					{
						fvHtml += "		<a href='#none' onClick='doReviewEstimate(\""+data.row[i].subIdx+"\")' class='ing'>후기작성</a>";
					}
					
					if(data.row[i].reviewYn == "1")
					{
						fvHtml += "		<p class='end'>후기작성완료</p>";
					}
					fvHtml += "	</td>";
					fvHtml += "</tr>";
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
				var fvHtml = "";
				fvHtml += "<tr>";
				fvHtml += "	<td colspan='4'>견적 내역이 없습니다</td>";
				fvHtml += "</tr>";
				
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


function doCancelEstimate(idx)
{
	if(!confirm("견적을 취소하시겠습니까?")) return;
	var params={
			idx:idx,
			state:"6"
	};	
	
	var url = "../estimate/updateEstimate.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("견적을 취소하였습니다.");
			doSearchList(vPageNum);
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
	
}

function doSelectEstimate(idx, eType, state)
{
	if(eType == "3" || eType == "4") return;
	/*
	document.frm.idx.value = idx;
	document.frm.action = "myEstimateDetail.do";
	document.frm.submit();
	*/			
	if(state == "7")
	{
		alert("견적 선택기간이 마감되어 취소 되었습니다.");
		return;
	}
	
	if(state == "6")
	{
		alert("취소된 견적입니다.");
		return;
	}
	
	location.href="../estimate/myEstimateDetail.do?idx="+idx;
}

function doReviewEstimate(idx)
{
	$("#subIdx").val(idx);
	$("#review").val("");
	doScore(5);
	$('#modal_review').modal();
}

function doScore(score)
{
	$("#score").val(score);
	for(var i=1; i<=5; i++)
	{
		$("#score"+i).attr("src","../images/review/review_icon_start_off.png");
	}
	
	for(var i=1; i<=score; i++)
	{
		$("#score"+i).attr("src","../images/review/review_icon_start_on.png");
	}
}
function doSaveReview()
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
			$('#modal_review').modal("hide");
			alert("후기를 작성하였습니다.");
			doSearchList(vPageNum);
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doCancelReview()
{
	$('#modal_review').modal("hide");
}
var vPageCount = 10;
var vPageNum;

jQuery(document).ready(function(){
	doSearch(1);
	
	$('input[name="customerGubun"]').change(function() { 
		var url = $('input[name="customerGubun"]:checked').val()
		location.href="../admin/"+url;
	}); 
});

function doSearch(pageNum)
{
	vPageNum = pageNum;
	var params={
			pageCount:vPageCount,
			pageNum:pageNum
	};
	var url = "selectBoardList.do";
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#tableList").html("");
			$("#pageList").html("");
			var fvHtml="";
			if(data.totalCount > 0 )
			{
				for(var i=0; i<data.row.length; i++)
				{
					fvHtml+="<tr>";
					if(data.row[i].retYn == "Y")
					{
						fvHtml+="<td>";
						fvHtml+="<span class='end'>답변완료</span>";
						fvHtml+="</td>";
					}else{
						fvHtml+="<td>";
						fvHtml+="<span class='ing'>답변대기</span>";
						fvHtml+="</td>";
					}
					fvHtml+="<td>"+cfNvl1(data.row[i].title)+"</td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].nickname)+"</td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].updatetime)+"</td>";
					fvHtml+="<td class='text-center'>";
					fvHtml += "<ul>";
					fvHtml += "<li class='col-xs-7'><a class='main_bg' href='#!' onClick='doSearchDetail(\""+data.row[i].idx+"\")'>수정/답변<a></li>";
					fvHtml += "<li class='col-xs-5'><a class='red_bg' href='#!' onClick='doDelete(\""+data.row[i].idx+"\")'>삭제<a></li>";
					fvHtml += "</ul>";
					fvHtml+="</td>";
					
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
				
				fvHtml+="<td colspan='3' class='text-center'>1:1 문의사항이 없습니다.</td>";
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

function doDelete(idx)
{
	if(!confirm("삭제하시겠습니까?")) return;
	var params={
			idx:idx
	};	
	
	var url = "deleteBoard.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			doSearch(vPageNum);

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
	var params={
			idx:idx
	};	
	
	var url = "selectBoardDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$('#idx').val(data.idx);
			$('#nickname').val(data.nickname);
			$('#email').val(data.email);
			$('#phone').val(data.phone);
			$('#resType').val(data.resType);
			$('#title').val(data.title);
			$('#resContent').val(data.resContent);
			$('#retContent').val(cfNvl1(data.retContent));
			$("#modal_board").modal();

		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}
function doSaveBoard(){
	if(!cfnNullCheckSelect($('#retContent').val(),"답변내역")) return;

	var params={
			idx:$("#idx").val(),
			resType:$("#resType").val(),
			title:$("#title").val(),
			resContent:$("#resContent").val(),
			retContent:$("#retContent").val()
	};	
	
	var url = "updateBoard.do";
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$('#modal_board').modal("hide");
			doSearch(vPageNum);
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function doCloseBoard(){
	$("#modal_board").modal("hide");
}

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
	var url = "selectQnaList.do";
	
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
					fvHtml+="<td class='web_td'>"+cfNvl1(data.row[i].idx)+"</td>";
					fvHtml+="<td><a class='subject' href='#none' onClick='doSearchDetail(\""+data.row[i].idx+"\")'>"+cfNvl1(data.row[i].title)+"</a></td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].nickname)+"</td>";
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
					fvHtml+="</tr>";
				}
				$("#tableList").html(fvHtml);
				//페이징 처리.
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

function doAddQna()
{
	var params={};

	var url = "../common/loginCheck.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.flag != "1")
			{
				alert("로그인 후 작성 가능합니다.");
			}else{
				location.href="./qnaWrite.do";
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
	var params={};

	var url = "../common/loginCheck.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data1) {
			if(data1.flag != "1")
			{
				alert("로그인 후 내용을 보실수 있습니다.")
			}else{
				var email = data1.email;
				var params1={
						idx:idx
				};	
				
				var url1 = "selectQnaDetail.do";	
				$.ajax({
					type: "POST",
					url : url1,
					data: params1,
					success : function(data) {
						
						if(email == data.email)
						{
							location.href="./qnaView.do?idx="+idx;
						}else{
							alert("작성한 회원만 볼수 있습니다.");
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
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

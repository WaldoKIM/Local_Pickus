var vPageCount = 6;
var vPageNum = 1;

jQuery(document).ready(function(){
	$('input[name="srchPatiGubun"]').change(function() { 
		doChangePatiGubun();
	});
	
	$('#srchEType').change(function(){ 
		doChangeEType(); 
	})
	
	var params={};	
	
	var url1 = "../common/selectArea1List.do";	
	$.ajax({
		type: "POST",
		url : url1,
		data: params,
		success : function(data) {
			$("#srchArea1").html("");
			var fvHtml="<option value=\"\" selected>시/도 전체</option>";
			for(var i=0; i<data.row.length; i++)
			{
				fvHtml += "<option value='"+data.row[i].area1+"'>"+data.row[i].area1+"</option>";
			}

			$("#srchArea1").html(fvHtml);
			$("#srchArea2").html("");
			var fvHtml1="<option value=\"\" selected>시/구/군  전체</option>";

			$("#srchArea2").html(fvHtml1);			
			$('#srchArea1').change(function(){ 
				doChangeArea1(); 
			}); 
			
			doSearchList(1);
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
});

function doChangeArea1()
{
	var params={
			area1:$("#srchArea1").val()
	};	
	
	var url = "../common/selectArea2List.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#srchArea2").html("");
			var fvHtml="<option value=\"\" selected>전체</option>";
			for(var i=0; i<data.row.length; i++)
			{
				fvHtml += "<option value='"+data.row[i].area2+"'>"+data.row[i].area2+"</option>";
			}

			$("#srchArea2").html(fvHtml);
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function doSearch()
{
	doSearchList(1);
}

function doSearchList(pageNum)
{
	vPageNum = pageNum;

	var vEType = $("#srchEType").val();
	var vDetail = $("#srchItemCat").val();
	var itemCat = "";
	var eType = "";
	if(vEType)
	{
		if(vEType == "1")
		{
			eType = vEType;
			if(vDetail)
			{
				itemCat += "and item_cat_dtl = '"+vDetail+"' ";
			}
		} else if(vEType == "2"){
			eType = vEType;
			if(vDetail)
			{
				itemCat += " and sub_key in ( select distinct sub_key from estimate_list_multi where pull_kind='"+vDetail+"' ) ";
			}
		}else{
			eType = "0";
			var vText = $("#srchEType option:selected").text();
			itemCat = "and item_cat = '"+vText+"' ";
			if(vDetail)
			{
				itemCat += "and item_cat_dtl = '"+vDetail+"' ";
			}
			
		}		
	}

	var params={
			area1:$("#srchArea1").val(),
			area2:$("#srchArea2").val(),
			eType:eType,
			itemCat:itemCat,
			pageCount:vPageCount,
			pageNum:pageNum
	};
	var url = "selectEstimateList.do";
	
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
				for(var i=0; i<data.row.length; i++)
				{
					var state = data.row[i].state;
					var eType = data.row[i].eType;
					fvHtml += "<tr>";
					fvHtml += "<th><img class='rotate"+data.row[i].photo1Rotate+"' src='"+_setPhoto(data.row[i].photo1, eType)+"'/></th>";
					fvHtml += "<td>";
					fvHtml += "<a href='#' onClick='doDetailEstimate(\""+data.row[i].idx+"\");'>";
					fvHtml += "<div class='sub_tt main_co'>"+_strState(state)+" / "+_strEType(eType)+"</div>";
					fvHtml += "<div>"+_getTitle(data.row[i].title)+"</div>";
					fvHtml += "<div>"+data.row[i].area1+" "+data.row[i].area2+"</div>";
					fvHtml += "<div class='date'>작성자 : "+_getNickname(data.row[i].nickname)+" ㅣ 등록일 : "+data.row[i].writetime+"</div>";
					fvHtml += "</a>";
					fvHtml += "</td>";
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
				fvHtml += "<tr class='no_data'>";
				fvHtml += "	<td colspan='2'>견적 내역이 없습니다</td>";
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

function doDetailEstimate(idx)
{
	location.href = "estimateDetail.do?idx="+idx;
	/*
	document.frm.idx.value = idx;
	document.frm.action = "patiEstimate.do";
	document.frm.submit();	
	*/
}

function doChangePatiGubun()
{
	var patiGubun = $('input[name="srchPatiGubun"]:checked').val();
	location.href = "estimateList"+patiGubun+".do";
}

function doChangeEType()
{
	$("#srchItemCat").html("");
	var vEType = $("#srchEType").val();
	if(vEType == "1")
	{
		$("#srchItemCat").html("<option value='' selected>세부</option>");
	}else if(vEType == "2"){
		var fvHtml = "<option value='' selected>세부</option>";
		var pullKinds = cfnGetRemoveItem();
		for(var i=0; i<pullKinds.length; i++)
		{
			fvHtml += "<option value='"+pullKinds[i]+"'>"+pullKinds[i]+"</option>";
		}		
		$("#srchItemCat").html(fvHtml);
	}else{
		var vText = $("#srchEType option:selected").text();
		var params={
				category1:vText
		};	
		
		var url = "../common/selectCategory2List.do";	
		$.ajax({
			type: "POST",
			url : url,
			data: params,
			success : function(data) {
				$("#itemCatDtl").html("");
				var fvHtml="<option value=\"\" selected>세부</option>";
				for(var i=0; i<data.row.length; i++)
				{
					fvHtml += "<option value='"+data.row[i].category2+"'>"+data.row[i].category2+"</option>";
				}

				$("#srchItemCat").html(fvHtml);
				
			},
		    beforeSend : function(){
		    	
			},
			complete : function(){
				
		    },
			error: function(jqXHR, textStatus, errorThrown){
				
		    }
		});
	}
}
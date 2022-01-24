var vPageCount = 6;
var vPageNum = 1;

var vSql = "";
jQuery(document).ready(function(){
	$('input[name="srchPatiGubun"]').change(function() { 
		doChangePatiGubun();
	});
	
	var params={};	
	
	var url1 = "selectEstimateUserInfo.do";	
	$.ajax({
		type: "POST",
		url : url1,
		data: params,
		success : function(data) {
			vSql = "";
			var areaList = data.userAreaList;
			var userInfo = data.userInfo;
			
			//주소쿼리 생성
			vAreaSql = "";
			for(var i=0 ; i<areaList.length; i++)
			{
				if(i > 0)
				{
					vAreaSql += " or ";
				}
				vAreaSql += "(";
				vAreaSql += "area1 = '"+areaList[i].area1+"' ";
				if(areaList[i].area2)
				{
					vAreaSql += "and area2 = '"+areaList[i].area2+"' ";
				}
				vAreaSql += ")";
			}
			
			if(vAreaSql){
				vSql += " and ( "+vAreaSql+" ) \n";
			}
			
			var goodsItem  = userInfo.goodsItem;
			var goodsYear  = userInfo.goodsYear;
			var removeItem = userInfo.removeItem;
			
			if(userInfo.biztype == "1")
			{
				if(!goodsItem){
					alert("마이페이지에서 업체가 원하는 견적을 설정해 보세요");
					return;
				}
			}else if(userInfo.biztype == "2"){
				if(!removeItem){
					alert("마이페이지에서 업체가 원하는 견적을 설정해 보세요");
					return;
				}
			}else if(userInfo.biztype == "3"){
				if(!goodsItem && !removeItem){
					alert("마이페이지에서 업체가 원하는 견적을 설정해 보세요");
					return;
				}
			}
			if(!goodsItem)
			{
				vSql += " and e_type != 0 and e_type != 1 \n";
			}
			if(!removeItem)
			{
				vSql += " and e_type != 2 \n";
			}
			vSql += " and ( 1!=1 ";
			//매입확인하기
			if(userInfo.biztype == "1" || userInfo.biztype == "3")
			{
				var arrVal1 = goodsItem.split(",");
				var arrVal2 = goodsYear.split(",");
				
				//가전/가구 매입
				vSql += "or ( e_type = 0 and ( ";
				vSql += "1!=1";
				for(var i=0; i<arrVal1.length; i++)
				{
					if(arrVal1[i] == "모두수거")
					{
						var goodsItems = cfnGetGoodsItem();
						for(var j=0; j<goodsItems.length; j++)
						{
							vSql += " or ( item_cat='"+goodsItems[j]+"' and ifnull(use_year,'0') <= "+arrVal2[i]+")";
						}
					}else{
						vSql += " or ( item_cat='"+arrVal1[i]+"' and ifnull(use_year,'0') <= "+arrVal2[i]+")";
					}
				}
				vSql += ") )\n";
				//다량 매입
				vSql += "or ( e_type = 1 and ( sub_key in ( select distinct sub_key from estimate_list_multi where 1=1 and (";
				vSql += "1=1";
				for(var i=0; i<arrVal1.length; i++)
				{
					if(arrVal1[i] == "모두수거")
					{
						var goodsItems = cfnGetGoodsItem();
						for(var j=0; j<goodsItems.length; j++)
						{
							vSql += " or ( item_cat='"+goodsItems[j]+"' and ifnull(use_year,'0') <= "+arrVal2[i]+")";
						}
					}else{
						vSql += " or ( item_cat='"+arrVal1[i]+"' and ifnull(use_year,'0') <= "+arrVal2[i]+")";
					}
				}
				vSql += ") ) ) )\n";
			}
			if(userInfo.biztype == "2" || userInfo.biztype == "3")
			{
				//철거
				var arrVal = removeItem.split(",");
				vSql += "or ( e_type = 2 and ( sub_key in ( select distinct sub_key from estimate_list_multi where 1=1 and (";
				vSql += "1=1";
				for(var i=0; i<arrVal.length; i++)
				{
					if(arrVal[i] == "모두철거")
					{
						var removeItems = cfnGetRemoveItem();
						for(var j=0; j<removeItems.length; j++)
						{
							vSql += " or ( pull_kind='"+removeItems[j]+"' )";
						}
					}else{
						vSql += " or ( pull_kind='"+arrVal[i]+"' )";
					}
				}
				vSql += ") ) ) )\n";
			}
			vSql += " ) ";

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

function doSearchList(pageNum)
{
	vPageNum = pageNum;

	var params={
			itemCat:vSql,
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
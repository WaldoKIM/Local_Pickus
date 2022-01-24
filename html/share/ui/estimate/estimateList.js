var vPageCount = 6;
var vPageNum = 1;
var isLoad = false;

var goodsItem;
var goodsYear;
var removeItem;

jQuery(document).ready(function(){
	cfnLoginCheck("2");
	var params={};	
	
	var url1 = "../common/loginCheck.do";	
	$.ajax({
		type: "POST",
		url : url1,
		data: params,
		success : function(data) {
			goodsItem = data.goodsItem;
			goodsYear = data.goodsYear;
			removeItem = data.removeItem;
			
			$("#srchEType").html("");
			var vHtml = "";
			if(data.biztype == "1")
			{
				vHtml += "<option value='0'>가전/가구 매입</option>";
				vHtml += "<option value='1'>다량 매입</option>";
			}else if(data.biztype == "2"){
				vHtml += "<option value='2'>철거/원상복구</option>";
			}else if(data.biztype == "3"){
				vHtml += "<option value='0' selected>가전/가구 매입</option>";
				vHtml += "<option value='1'>다량 매입</option>";
				vHtml += "<option value='2'>철거/원상복구</option>";
			}
			$("#srchEType").html(vHtml);
			doSelectArea1();
			doChangeEType();
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
	
	$('#srchEType').change(function(){ 
		doChangeEType();

	}); 
	
})

function doChangeEType()
{
	var vHtml1 = "";
	if($('#srchEType').val() == "0" || $('#srchEType').val() == "1")
	{
		vHtml1 += "<option value='' selected>세부</option>";
		var arrVal1 = goodsItem.split(",");
		var arrVal2 = goodsYear.split(",");
		
		for(var i=0; i<arrVal1.length; i++)
		{
			if(arrVal1[i] != "모두수거")
			{
				vHtml1 += "<option value='"+arrVal1[i]+","+arrVal2[i]+"'>"+arrVal1[i]+"</option>";
			}
		}
	}else if($('#srchEType').val() == "2"){
		vHtml1 += "<option value='' selected>세부</option>";
		var arrVal = removeItem.split(",");
		for(var i=0; i<arrVal.length; i++)
		{
			vHtml1 += "<option value='"+arrVal[i]+"'>"+arrVal[i]+"</option>";
		}
	}
	$("#srchItemCat").html(vHtml1);
	
}
function doSelectArea1()
{
	var params={};	
	
	var url1 = "selectEstimateArea1.do";	
	$.ajax({
		type: "POST",
		url : url1,
		data: params,
		success : function(data) {
			$("#srchArea1").html("");
			var fvHtml = ""; 
			for(var i=0; i<data.length; i++)
			{
				if(i==0)
				{
					fvHtml += "<option value='"+data[i].area1+"' selected>"+data[i].area2+"</option>";
				}else{
					fvHtml += "<option value='"+data[i].area1+"'>"+data[i].area2+"</option>";
				}
			}
			$("#srchArea1").html(fvHtml);

			$('#srchArea1').change(function(){ 
				doChangeArea1(); 
			}); 
			
			if($("#srchArea1").val())
			{
				doChangeArea1(); 
			}else{
				isLoad = true;
				doSearchList(1);
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
function doChangeArea1()
{
	var optionText = "";
	if($("#srchArea1").val())
	{
		optionText = $("#srchArea1").val()+" 전체";
		
		var params={
				area1:$("#srchArea1").val()
		};	
		
		var url = "selectEstimateArea2.do";	
		$.ajax({
			type: "POST",
			url : url,
			data: params,
			success : function(data) {
				$("#srchArea2").html("");
				for(var i=0; i<data.length; i++)
				{
					if(i==0)
					{
						fvHtml += "<option value='"+data[i].area1+"' selected>"+data[i].area2+"</option>";
					}else{
						fvHtml += "<option value='"+data[i].area1+"'>"+data[i].area2+"</option>";
					}
				}

				$("#srchArea2").html(fvHtml);
				if(!isLoad){
					isLoad = true;
					doSearchList(1);
				}
				
			},
		    beforeSend : function(){
		    	
			},
			complete : function(){
				
		    },
			error: function(jqXHR, textStatus, errorThrown){
				
		    }
		});	
		
	}else{
		var fvHtml = "<option value=''>시/구/군  전체</option>";
		$("#srchArea2").html(fvHtml);
		if(!isLoad){
			isLoad = true;
			doSearchList(1);
		}
	}

	
}
function doSearch()
{
	doSearchList(1);
}

function doSearchList(pageNum)
{
	vPageNum = pageNum;
	vShowIdx = "";
	var vSql = "";
	var vItemCat = $("#srchItemCat").val();
	if($("#srchEType").val() == "0")
	{
		vSql += "and (";
		if(vItemCat)
		{
			var arrVal = vItemCat.split(",");
			vSql += "item_cat='"+arrVal[0]+"' and ifnull(use_year,'0') <= "+arrVal[1];
		}else{
			var arrVal1 = goodsItem.split(",");
			var arrVal2 = goodsYear.split(",");
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
		}
		vSql += ")";
	}else if($("#srchEType").val() == "1"){
		vSql += "and sub_key in ( select distinct sub_key from estimate_list_multi where 1=1 and (";
		if(vItemCat)
		{
			var arrVal = vItemCat.split(",");
			vSql += "item_cat='"+arrVal[0]+"' and ifnull(use_year,'0') <= "+arrVal[1];
		}else{
			var arrVal1 = goodsItem.split(",");
			var arrVal2 = goodsYear.split(",");
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
		}
		vSql += "))";		
	}else if($("#srchEType").val() == "2"){
		vSql += "and sub_key in ( select distinct sub_key from estimate_list_multi where 1=1 and (";
		if(vItemCat)
		{
			vSql += "pull_kind='"+vItemCat+"'";
		}else{
			var arrVal = removeItem.split(",");
			vSql += "1!=1";
			for(var i=0; i<arrVal.length; i++)
			{
				if(arrVal[i] == "모두수거")
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
		}
		vSql += "))";		
	}
	var params={
			area1:$("#srchArea1").val(),
			area2:$("#srchArea2").val(),
			eType:$("#srchEType").val(),
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
			$("#pageList").html("");
			if(data.totalCount > 0 )
			{
				var fvHtml = "";
				for(var i=0; i<data.row.length; i++)
				{
					var state = data.row[i].state;
					var eType = data.row[i].eType;
					fvHtml += "<tr>";
					fvHtml += "	<td width='200px;'>";
					fvHtml += "		<img src='"+_setPhoto(data.row[i].photo1, eType)+"' style='width:200px;height:200px;'>";
					fvHtml += "	</td>";
					fvHtml += "	<td>";
					fvHtml += "		<a href='#' onClick='doDetailEstimate(\""+data.row[i].idx+"\");'><p class='estimate_search_table_title01'>"+_strState(state)+" / "+_strEType(eType)+"</p></a>";
					fvHtml += "		<p class='estimate_search_table_title02'>ㅡ</p>";
					fvHtml += "		<p class='estimate_search_table_title02'>"+_getTitle(data.row[i].title)+"</p>";
					fvHtml += "		<p class='estimate_search_table_title02'>"+data.row[i].area1+" "+data.row[i].area2+"</p>";
					fvHtml += "	</td>";
					fvHtml += "	<td width='250px;' class='text-right'>";
					fvHtml += "		<div style='text-align:left;'>";
					fvHtml += "			<p class='estimate_search_table_title03'>작성자  :  "+_getNickname(data.row[i].nickname)+"</p>";
					fvHtml += "			<p class='estimate_search_table_title03'>등록일  :  "+data.row[i].writetime+"</p>";
					//fvHtml += "			<p class='estimate_search_table_title03'>물품명  :  "+data.row[i].medelName+"</p>";
					fvHtml += "		</div>";
					fvHtml += "	</td>";
					fvHtml += "</tr>";
					fvHtml += "<tr style='height:75px;'><td colspan='3'></td></tr>";
				}
				
				$("#tableList").html(fvHtml);
				
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
			}else{
				var fvHtml = "";
				fvHtml += "<tr class='no_data'>";
				fvHtml += "	<td colspan='4' class='text-center'>견적 내역이 없습니다</td>";
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
var vPageCount = 10;
var vPageNum;
jQuery(document).ready(function(){
	cfnLoginCheck("9");
	$("#inputEtype").html(cfnETypesCombo("선택"));
	$("#inputState").html(cfnStatesCombo("선택"));
	
	if($("#hiddenState").val()) $("#inputState").val($("#hiddenState").val());
	if($("#hiddenEType").val()) $("#inputEtype").val($("#hiddenEType").val());
	
	var from1 = $("#inputStartWriteTime").datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr"
	}).on( "change", function() {
		to1.datepicker( "option", "minDate", getDate( this ) );
	});

	var to1 = $("#inputEndtWriteTime").datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr"
	}).on( "change", function() {
		from1.datepicker( "option", "maxDate", getDate( this ) );
	});

	var from2 = $("#inputStartPickupDate").datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr"
	}).on( "change", function() {
		to2.datepicker( "option", "minDate", getDate( this ) );
	});

	var to2 = $("#inputEndPickupDate").datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr"
	}).on( "change", function() {
		from2.datepicker( "option", "maxDate", getDate( this ) );
	});


	var from3 = $("#inputStartEstimateDate").datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr"
	}).on( "change", function() {
		to3.datepicker( "option", "minDate", getDate( this ) );
	});

	var to3 = $("#inputEndEstimateDate").datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr"
	}).on( "change", function() {
		from3.datepicker( "option", "maxDate", getDate( this ) );
	});


	
	var params={};	
	
	var url1 = "../common/selectArea1List.do";	
	$.ajax({
		type: "POST",
		url : url1,
		data: params,
		success : function(data) {
			$("#inputArea1").html("");
			var fvHtml="<option value=\"\" selected>시/도</option>";
			for(var i=0; i<data.row.length; i++)
			{
				fvHtml += "<option value='"+data.row[i].area1+"'>"+data.row[i].area1+"</option>";
			}

			$("#inputArea1").html(fvHtml);
			$('#inputArea1').change(function(){ 
				doChangeArea1(); 
			}); 
			
			doSearch(1);
			
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
			area1:$("#inputArea1").val()
	};	
	
	var url = "../common/selectArea2List.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#inputArea2").html("");
			var fvHtml="<option value=\"\" selected>시/구/군</option>";
			for(var i=0; i<data.row.length; i++)
			{
				fvHtml += "<option value='"+data.row[i].area2+"'>"+data.row[i].area2+"</option>";
			}

			$("#inputArea2").html(fvHtml);
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function doSearch(pageNum)
{
	var inputWriteTime       = "";
	var inputPickupDate      = "";
	var inputEstimateDate    = "";

	var inputStartWriteTime    = $("#inputStartWriteTime").val();
	var inputEndtWriteTime     = $("#inputEndtWriteTime").val();
	var inputStartPickupDate   = $("#inputStartPickupDate").val();
	var inputEndPickupDate     = $("#inputEndPickupDate").val();
	var inputStartEstimateDate = $("#inputStartEstimateDate").val();
	var inputEndEstimateDate   = $("#inputEndEstimateDate").val();
	
	if(inputStartWriteTime)
	{
		if(inputEndtWriteTime)
		{
			inputWriteTime       = "and date_format(a.writetime, '%Y-%m-%d') between '"+inputStartWriteTime+"' and '"+inputEndtWriteTime+"' ";
		}else{
			inputWriteTime       = "and date_format(a.writetime, '%Y-%m-%d') between '"+inputStartWriteTime+"' and '9999-99-99' ";
		}
	}else{
		if(inputEndtWriteTime)
		{
			inputWriteTime       = "and date_format(a.writetime, '%Y-%m-%d') between '0000-00-00' and '"+inputEndtWriteTime+"' ";
		}
	}
	
	if(inputStartPickupDate)
	{
		if(inputEndPickupDate)
		{
			inputPickupDate       = "and a.pickup_date between '" + inputStartPickupDate + "' and '" + inputEndPickupDate + "' ";
		}else{
			inputPickupDate       = "and a.pickup_date between '" + inputStartPickupDate + "' and '9999-99-99' ";
		}
	}else{
		if(inputEndPickupDate)
		{
			inputPickupDate       = "and a.pickup_date between '0000-00-00' and '" + inputEndPickupDate+"' ";
		}
	}

	if(inputStartEstimateDate)
	{
		if(inputEndEstimateDate)
		{
			inputEstimateDate       = "and b.estimateDate between '" + inputStartEstimateDate + "' and '" + inputEndEstimateDate + "' ";
		}else{
			inputEstimateDate       = "and b.estimateDate between '" + inputStartEstimateDate + "' and '9999-99-99' ";
		}
	}else{
		if(inputEndEstimateDate)
		{
			inputEstimateDate       = "and b.estimateDate between '0000-00-00' and '" + inputEndEstimateDate + "' ";
		}
	}

	
	vPageNum = pageNum;
	var params={
			eType:$("#inputEtype").val(),
			email:$("#inputEmail").val(),
			nickname:$("#inputNickname").val(),
			title:$("#inputTitle").val(),
			area1:$("#inputArea1").val(),
			area2:$("#inputArea2").val(),
			state:$("#inputState").val(),
			writetime:inputWriteTime,
			pickupDate:inputPickupDate,
			estimateDate:inputEstimateDate,
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
			var fvHtml="";
			for(var i=0; i<data.row.length; i++)
			{
				fvHtml+="<tr>";
				
				fvHtml+="<td>"+_strEType(cfNvl1(data.row[i].eType))+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].email)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].area1)+" "+cfNvl1(data.row[i].area2)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].nickname)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].title)+"</td>";
				fvHtml+="<td>"+cfnNumberComma(cfNvl1(data.row[i].estimateAmt))+"</td>";
				fvHtml+="</tr>";
				fvHtml+="<tr>";
				fvHtml+="<td>"+cfNvl1(data.row[i].writetime)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].pickupDate)+"</td>";
				fvHtml+="<td>"+cfnGetStates(cfNvl1(data.row[i].state))+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].estimateDate)+"</td>";
				fvHtml+="<td>"+cfnNumberComma(cfNvl1(data.row[i].estimateCnt))+"</td>";
				fvHtml+="<td>";
				fvHtml+= "<ul>";
				if(data.row[i].state == "3")
				{
					fvHtml+= "<li class='col-xs-4'><a class='sub_bg' href='#none' onClick='doChangeAmt(\""+data.row[i].idx+"\",\""+data.row[i].subIdx+"\",\""+data.row[i].estimateAmt+"\")'>금액변경</a><br/></li>";
				}
				
				if(data.row[i].eType == "0" || data.row[i].eType == "1" || data.row[i].eType == "2")
				{
					fvHtml+= "<li class='col-xs-4'><a class='gray_bg' href='#none' onClick='doView(\""+data.row[i].idx+"\", \""+data.row[i].eType+"\")'>보기</a></li>";
					fvHtml+= "<li class='col-xs-4'><a class='main_bg' href='#none' onClick='doModify(\""+data.row[i].idx+"\", \""+data.row[i].eType+"\")'>수정</a></li>";
				}
				fvHtml+= "<li class='col-xs-4'><a class='red_bg' href='#' onClick='doDelete(\""+data.row[i].idx+"\")'>삭제</a></li>";
				fvHtml+= "</ul>";					
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
			
			
			
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}

function doAdd(vGubun)
{
	location.href="estimateInsert"+vGubun+".do";
}

function doView(vIdx, vGubun)
{
	if(vGubun == "0"){
		vGubun = "1";
	}else if(vGubun == "1"){
		vGubun = "2";
	}else if(vGubun == "2"){
		vGubun = "3";
	}
	
	location.href="estimateView.do?idx="+vIdx+"&&subIdx="+vGubun;
}


function doModify(vIdx, vGubun)
{
	if(vGubun == "0"){
		vGubun = "1";
	}else if(vGubun == "1"){
		vGubun = "2";
	}else if(vGubun == "2"){
		vGubun = "3";
	}
	location.href="estimateModify"+vGubun+".do?idx="+vIdx;
}

function doDelete(vIdx)
{
	if(!confirm("삭제하시겠습니까?"+vIdx)) return;
	
	var params={
			idx:vIdx
	};	
	
	var url = "deleteEstimate.do";	
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

function doChangeAmt(idx, subIdx, price)
{
	$("#idx").val(idx);
	$("#subIdx").val(subIdx);
	$("#price").val(price);
	
	$("#modal_price").modal();
}

function doCancelPrice()
{
	$("#modal_price").modal("hide");
}

function doPriceZero()
{
	if(!confirm("무료수거 하시겠습니까?")) return;
	
	var params={
			idx:$("#idx").val(),
			subIdx:$("#subIdx").val(),
			price:"0"
	};	
	
	var url = "insertEstimatePrice.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#modal_price").modal("hide");
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

function doSavePrice()
{
	if(!confirm("견적금액을 수정 하시겠습니까?")) return;
	
	var params={
			idx:$("#idx").val(),
			subIdx:$("#subIdx").val(),
			price:$("#price").val()
	};	
	
	var url = "insertEstimatePrice.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#modal_price").modal("hide");
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
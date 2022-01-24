var vPageCount = 10;
var vPageNum;

jQuery(document).ready(function(){
	cfnLoginCheck("9");
	
	$("#bankName").html(cfnBankTypesCombo());
	$('#bankName').change(function(){
		$("#bankAccount").val(cfnBankTypesBank($('#bankName').val()));
	});
	$("#price").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});
	
	var from = $("#startDate").datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr"
    }).on( "change", function() {
    	to.datepicker( "option", "minDate", getDate( this ) );
    });
	
	var to = $("#endDate").datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr"
	}).on( "change", function() {
		from.datepicker( "option", "maxDate", getDate( this ) );
	});
	
	doSearch(1);
});

function doSearch(pageNum)
{
	vPageNum = pageNum;
	
	var strDate = $("#startDate").val();
	if(!strDate)strDate = "0000-00-00"; 
	var endDate = $("#endDate").val();
	if(!endDate)endDate = "9999-99-99";
	
	var params={
			priceType:$("#srchType").val(),
			email:$("#srchName").val(),
			nickname:$("#srchNickname").val(),
			startDate:strDate,
			endDate:endDate,
			pageCount:vPageCount,
			pageNum:pageNum
	};
	var url = "selectPointList.do";
	
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
					
					fvHtml+="<td>"+cfNvl1(data.row[i].email)+"</td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].nickname)+"</td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].bankName)+"</td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].bankAccount)+"</td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].bankSender)+"</td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].price)+"</td>";
					if(data.row[i].priceType == "1")
					{
						fvHtml+="<td>입금중</td>";
					}else if(data.row[i].priceType == "2"){
						fvHtml+="<td>입금완료</td>";
					}
					fvHtml += "<td>";
					if(data.row[i].priceType == "1")
					{
						fvHtml += "<ul>";
						fvHtml += "<li class='col-xs-6'><a class='main_bg' href='#!' onClick='doCompletePoint(\""+data.row[i].idx+"\")'>입금완료</a></li>";
						fvHtml += "<li class='col-xs-6'><a class='red_bg' href='#!' onClick='doDelete(\""+data.row[i].idx+"\")'>삭제</a></li>";
						fvHtml += "</ul>";
					}
					fvHtml += "</td>";
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
				
				fvHtml+="<td colspan='8' class='text-center'>충전내역이 없습니다.</td>";
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

function doCompletePoint(vIdx)
{
	if(!confirm("입금완료하시겠습니까?")) return;
	
	var params={
			idx:vIdx,
			priceType:"2"
	};	
	
	var url = "updatePoint.do";	
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

function doDelete(vIdx)
{
	if(!confirm("삭제하시겠습니까?")) return;
	
	var params={
			idx:vIdx
	};	
	
	var url = "deletePoint.do";	
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

function doAdd()
{
	$('#email').val("");
	$('#bankName').val("");
	$('#bankAccount').val("");
	$('#bankSender').val("");
	$('#price').val("");
	$('#priceType').val("");
	
	$("#modal_point").modal();
}

function doSave()
{
	if(!cfnNullCheckInput($('#email').val(), "입금자명")) return;
	if(!cfnNullCheckInput($('#bankName').val(), "은행")) return;
	if(!cfnNullCheckInput($('#bankSender').val(), "입금자")) return;
	if(!cfnNullCheckInput($('#price').val(), "입금액")) return;
	if(!cfnNullCheckInput($('#priceType').val(), "입금상태")) return;
	
	var params={
			email:$("#email").val(),
			bankName:$("#bankName").val(),
			bankAccount:$("#bankAccount").val(),
			bankSender:$("#bankSender").val(),
			price:$("#price").val(),
			priceType:$("#priceType").val()
	};	
	
	var url = "insertPoint.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#modal_point").modal("hide");
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

function doClose()
{
	$("#modal_point").modal("hide");
}
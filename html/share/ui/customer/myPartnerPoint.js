var vPageCount = 6;
var vPageNum = 1;
jQuery(document).ready(function(){
	cfnLoginCheck("2");
	
	$("#liUserPoint").html("잔액 : "+cfnNumberComma($("#userPoint").val()));
	$("#bankName").html(cfnBankTypesCombo());
	$('#bankName').change(function(){
		$("#bankAccount").val(cfnBankTypesBank($('#bankName').val()));
	});

	$("#bankPrice").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});

	
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
	var url = "selectMyPartnerPointList.do";
	
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
					fvHtml += "	<td>"+data.row[i].updatetime+"</td>";
					if(data.row[i].priceType == "3")
					{
						fvHtml += "	<td>&nbsp;</td>";
						fvHtml += "	<td><span class='plus'>"+cfnNumberComma(data.row[i].price)+"</span></td>";
						fvHtml += "	<td>&nbsp;</td>";
					}else{
						fvHtml += "	<td><span class='plus'>"+cfnNumberComma(data.row[i].price)+"</span></td>";
						fvHtml += "	<td>&nbsp;</td>";
						if(data.row[i].priceType == "1"){
							fvHtml += "	<td><span class='ready'>입금확인중</span><br/><a href='#none' onClick='doDeletePoint(\""+data.row[i].idx+"\")'>입금취소</a></td>";
						}else{
							fvHtml += "	<td><span class='end'>입금완료</span></td>";
						}
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
				fvHtml += "<tr class='no_data'>";
				fvHtml += "	<td colspan='4' class='text-center'>충전내역이 없습니다</td>";
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

function doDeletePoint(idx)
{
	if(!confirm("입금 취소하시겠습니까?")) return;
	
	var params={
			idx:idx
		};

		var url = "../customer/deleteMyPartnerPoint.do";	
		$.ajax({
			type: "POST",
			url : url,
			data: params,
			success : function(data) {
				$('#modal_point').modal("hide");
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
function doPoint()
{
	$('#bankName').val("");
	$('#bankAccount').val("");
	$('#bankSender').val("");
	$('#bankPrice').val("");
	$('#modal_point').modal();
}

function doClosePoint()
{
	$('#modal_point').modal("hide");
}

function doSavePoint()
{
	if(!cfnNullCheckInput($('#bankSender').val(), "입금자명")) return;
	if(!cfnNullCheckInput($('#bankName').val(), "은행")) return;
	if(!cfnNullCheckInput($('#bankPrice').val(), "금액")) return;
	
	var params={
			price:$("#bankPrice").val(),
			priceType:"1",
			bankName:$("#bankName").val(),
			bankAccount:$("#bankAccount").val(),
			bankSender:$("#bankSender").val()
		};

		var url = "../customer/insertMyPartnerPoint.do";	
		$.ajax({
			type: "POST",
			url : url,
			data: params,
			success : function(data) {
				$('#modal_point').modal("hide");
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
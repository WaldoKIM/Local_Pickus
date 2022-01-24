var vPageCount = 10;
var vPageNum;

var vPointPageCount = 10;
var vPointPageNum;

jQuery(document).ready(function(){
	cfnLoginCheck("9");
	$("#biztype").html(cfnBizTypesCombo("선택"));
	$('input[name="memberGubun"]').change(function() { 
		var idx = $('input[name="memberGubun"]:checked').val()
		if(idx == "0"){
			location.href = "member1.do";
		}else if(idx == "2"){
			location.href = "member2.do";
		}else if(idx == "1"){
			location.href = "member3.do";
		}

	}); 
	
	var from = $("#strJoinTime").datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr"
    }).on( "change", function() {
    	to.datepicker( "option", "minDate", getDate( this ) );
    });
	
	var to = $("#endJoinTime").datepicker({
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
	var vTypeGb = $('#typeGb').val();
	var typeGb;
	if(!vTypeGb)
	{
		vTypeGb = "2,4";
	}
	
	var strDate = $("#strJoinTime").val();
	if(!strDate)strDate = "0000-00-00"; 
	var endDate = $("#endJoinTime").val();
	if(!endDate)endDate = "9999-99-99";
	var params={
			pageCount:vPageCount,
			pageNum:pageNum,
			typeGb:vTypeGb,
			email:$("#email").val(),
			nickname:$("#nickname").val(),
			phone:$("#phone").val(),
			phone:$("#phone").val(),
			biztype:$("#biztype").val(),
			score:$("#score").val(),			
			strJoinTime:strDate,
			endJoinTime:endDate
	};
	var url = "selectMemberList.do";
	
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
				fvHtml+="<td>"+cfnGetBizTypes(data.row[i].biztype)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].email)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].bizname)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].bizWorkerName)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].bizWorkerPhone)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].phone)+"</td>";
				fvHtml+= "<td rowspan='2'>";
				fvHtml+= "<ul>";
				fvHtml+= "<li class='col-xs-6'><a class='sub_bg' href='#none' onClick='doPointUser(\""+data.row[i].email+"\")'>충전내역</a><br/></li>";
				fvHtml+= "<li class='col-xs-6'><a class='gray_bg' href='#none' onClick='doChangeChargeRate(\""+data.row[i].email+"\",\""+data.row[i].chargeRate+"\")'>수수료율</a><br/></li>";
				fvHtml+= "<li class='col-xs-6'><a class='main_bg' href='#none' onClick='doModifyUser(\""+data.row[i].idx+"\",\""+data.row[i].typeGb+"\")'>수정</a></li>";
				fvHtml+= "<li class='col-xs-6'><a class='red_bg' href='#' onClick='doDeleteUser(\""+data.row[i].email+"\",\""+data.row[i].typeGb+"\")'>삭제</a></li>";
				fvHtml+= "</ul>";				
				fvHtml+= "</td>";
				fvHtml+="</tr>";
				fvHtml+="<tr>";
				fvHtml+="<td>"+cfNvl1(data.row[i].area1)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].score)+"점</td>";
				fvHtml+="<td>"+cfnNumberComma(cfNvl1(data.row[i].point))+"</td>";
				fvHtml+="<td>"+cfnNumberComma(data.row[i].estimateProposeCnt)+"건/"+cfnNumberComma(data.row[i].estimateProposeAmt)+"원</td>";
				fvHtml+="<td class='text-right'>"+cfNvl1(data.row[i].chargeRate)+"</td>";
				fvHtml+="<td class='text-center'>"+cfNvl1(data.row[i].emailYn)+"</td>";
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

function doPointUser(vEmail)
{
	selectMemberPointList(1, vEmail);
	$("#modal_pont").modal();
}

function selectMemberPointList(pageNum, vEmail)
{
	vPointPageNum = pageNum;
	var params={
			email:vEmail,
			pageCount:vPointPageCount,
			pageNum:pageNum
	};
	var url = "../admin/selectMemberPointList.do";
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#pointList").html("");
			$("#pointPageList").html("");
			if(data.totalCount > 0 )
			{
				var fvHtml = "";
				for(var i=0; i<data.row.length; i++)
				{
					var state = data.row[i].state;
					var eType = data.row[i].eType;
					fvHtml += "<tr>";
					fvHtml += "	<td class='text-center'>"+data.row[i].updatetime+"</td>";
					if(data.row[i].priceType == "2")
					{
						fvHtml += "	<td class='text-right'>"+cfnNumberComma(data.row[i].price)+"</td>";
						fvHtml += "	<td class='text-right'>&nbsp;</td>";
					}else if(data.row[i].priceType == "3"){
						fvHtml += "	<td class='text-right'>&nbsp;</td>";
						fvHtml += "	<td class='text-right'>"+cfnNumberComma(data.row[i].price)+"</td>";
					}
					
					fvHtml += "	</td>";
					fvHtml += "</tr>";
				}
				
				$("#pointList").html(fvHtml);
				
				var pageHtml = "";
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
					pageHtml += "<li class='page-item'>";
					pageHtml += "<a class='page-link' href='#none' onClick='selectMemberPointList("+(lv_InitVal-1)+",\""+vEmail+"\");' aria-label='Previous'>";
					pageHtml += "<span aria-hidden='true'>◀</span>";
					pageHtml += "<span class='sr-only'>Previous</span>";
					pageHtml += "</a>";
					pageHtml += "</li>";
				}
				for(var t=1; t<=lv_PageGab; t++)
				{
					var lv_value = lv_InitVal-1+t;
					if(lv_value == lv_CurPage)
					{
						pageHtml += "<li class='page-item active'>";
					}else{
						pageHtml += "<li class='page-item'>";
					}
					pageHtml += "<a class='page-link' href='#none' onClick='selectMemberPointList("+lv_value+",\""+vEmail+"\");'>"+lv_value+"</a></a>";
					pageHtml += "</li>";
				}
				if(lv_TotPage > lv_InitVal+4){
					pageHtml += "<li class='page-item'>";
					pageHtml += "<a class='page-link' href='#none' onClick='selectMemberPointList("+(lv_InitVal+10)+",\""+vEmail+"\");' aria-label='Next'>";
					pageHtml += "<span aria-hidden='true'>▶</span>";
					pageHtml += "<span class='sr-only'>Next</span>";
					pageHtml += "</a>";
					pageHtml += "</li>";
				}
				$("#pointPageList").html(pageHtml);				
			}else{
				var fvHtml = "";
				fvHtml += "<tr class='no_data'>";
				fvHtml += "	<td colspan='3' class='text-center'>충전내역이 없습니다</td>";
				fvHtml += "</tr>";
				
				$("#pointList").html(fvHtml);
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
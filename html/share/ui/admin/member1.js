var vPageCount = 10;
var vPageNum;
jQuery(document).ready(function(){
	cfnLoginCheck("9");
	
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
		vTypeGb = "0,3";
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
				fvHtml+="<td>"+cfNvl1(data.row[i].email)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].nickname)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].jointime)+"</td>";
				fvHtml+="<td>"+cfNvl1(data.row[i].phone)+"</td>";
				if(data.row[i].estimateCnt > 0)
				{
					fvHtml+="<td>"+cfnNumberComma(data.row[i].estimateCnt)+"건</td>";
				}else{
					fvHtml+="<td>없음</td>";
				}
				fvHtml+="<td>"+cfNvl1(data.row[i].emailYn)+"</td>";
				if(data.row[i].typeGb == "3")
				{
					fvHtml+="<td>"+data.row[i].updatetime+"건</td>";
				}else{
					fvHtml+="<td></td>";
				}					
				fvHtml += "<td>";
				fvHtml += "<ul>";
				fvHtml += "<li class='col-xs-6'><a class='main_bg' href='#!' onClick='doModifyUser(\""+data.row[i].idx+"\",\""+data.row[i].typeGb+"\")'>수정<a></li>";
				fvHtml += "<li class='col-xs-6'><a class='red_bg' href='#!' onClick='doDeleteUser(\""+data.row[i].email+"\",\""+data.row[i].typeGb+"\")'>삭제<a></li>";
				fvHtml += "</ul>";
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
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}


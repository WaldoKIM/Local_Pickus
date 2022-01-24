var dateFormat = "yy-mm-dd";

jQuery(document).ready(function(){
	cfnLoginCheck("9");
	var now = new Date();

	var startYear = now.getFullYear();
	var endYear   = now.getFullYear();
	
	var startMonth = "01";
	var endMonth   = now.getMonth()+1;
	if(endMonth < 10) endMonth = "0"+endMonth
	
	var startDate = "01";
	var endDate   = now.getDate();
	if(endDate < 10) endDate = "0"+endDate

	$("#startDate").val(startYear+"-"+startMonth+"-"+startDate);
	$("#endDate").val(endYear+"-"+endMonth+"-"+endDate);
	
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
	
	doSearch();
});

function getDate( element ) {
	var date;
	try {
		date = $.datepicker.parseDate( dateFormat, element.value );
	} catch( error ) {
		date = null;
	}
	return date;
}

function doSearch(){
	var vStartDate = $("#startDate").val();
	var vEndDate   = $("#endDate").val();
	
	if(!vStartDate) vStartDate = "0000-00-00";
	if(!vEndDate)   vEndDate   = "9999-99-99";
	
	var params={
			startDate:vStartDate,
			endDate:vEndDate
	};

	var url = "selectState.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#memberList").html("");
			$("#estimateList").html("");
			$("#amtList").html("");
			
			var vHtml1 = "";
			vHtml1 += "<tr><td>회원가입 수</td><td class='text-right'><a href='#' onClick='doGoMember(\"1\",\"0\");'>"+cfnNumberComma(data.memberInfo.memberCnt)+"</a></td></tr>";
			vHtml1 += "<tr><td>센터회원 수</td><td class='text-right'><a href='#' onClick='doGoMember(\"2\",\"2\");'>"+cfnNumberComma(data.memberInfo.centerCnt)+"</a></td></tr>";
			vHtml1 += "<tr><td>센터승인 수</td><td class='text-right'><a href='#' onClick='doGoMember(\"3\",\"1\");'>"+cfnNumberComma(data.memberInfo.centerAcceptCnt)+"</a></td></tr>";
			vHtml1 += "<tr><td>탈퇴회원 수</td><td class='text-right'><a href='#' onClick='doGoMember(\"1\",\"3\");'>"+cfnNumberComma(data.memberInfo.memberWithdrawCnt)+"</a></td></tr>";
			vHtml1 += "<tr><td>탈퇴센터 수</td><td class='text-right'><a href='#' onClick='doGoMember(\"2\",\"4\");'>"+cfnNumberComma(data.memberInfo.centerWithdrawCnt)+"</a></td></tr>";
			
			$("#memberList").html(vHtml1);

			var vHtml2 = "";
			vHtml2 += "<tr><td>총 견적 신청 수</td><td class='text-right'><a href='#' onClick='doGoEstimate(\"\",\"\");'>"+cfnNumberComma(data.estimateInfo.estimateCnt)+"</a></td></tr>";
			vHtml2 += "<tr><td>견적중(신청 수)</td><td class='text-right'><a href='#' onClick='doGoEstimate(\"1\",\"\");'>"+cfnNumberComma(data.estimateInfo.estimateIngCnt)+"</a></td></tr>";
			vHtml2 += "<tr><td>견적 선택</td><td class='text-right'><a href='#' onClick='doGoEstimate(\"3\",\"\");'>"+cfnNumberComma(data.estimateInfo.estimateSelectCnt)+"</a></td></tr>";
			vHtml2 += "<tr><td>수거 완료</td><td class='text-right'><a href='#' onClick='doGoEstimate(\"5\",\"0\");'>"+cfnNumberComma(data.estimateInfo.estimateCompleteCnt1)+"</a></td></tr>";
			vHtml2 += "<tr><td>철거완료</td><td class='text-right'><a href='#' onClick='doGoEstimate(\"5\",\"2\");'>"+cfnNumberComma(data.estimateInfo.estimateCompleteCnt2)+"</a></td></tr>";

			$("#estimateList").html(vHtml2);

			var vHtml3 = "";
			vHtml3 += "<tr><td>총 거래 현황</td><td class='text-right'><a href='#' onClick='doGoEstimate(\"5\",\"\");'>"+cfnNumberComma(data.amtInfo.estimateAmt)+"</a></td></tr>";
			vHtml3 += "<tr><td>충전 현황</td><td class='text-right'><a href='#' onClick='doGoPoint();'>"+cfnNumberComma(data.amtInfo.pointAmt)+"</a></td></tr>";
			vHtml3 += "<tr><td>가전/가구 매입</td><td class='text-right'><a href='#' onClick='doGoEstimate(\"5\",\"0\");'>"+cfnNumberComma(data.amtInfo.estimateAmt0)+"</a></td></tr>";
			vHtml3 += "<tr><td>다량 매입</td><td class='text-right'><a href='#' onClick='doGoEstimate(\"5\",\"1\");'>"+cfnNumberComma(data.amtInfo.estimateAmt1)+"</a></td></tr>";
			vHtml3 += "<tr><td>철거/원상복구</td><td class='text-right'><a href='#' onClick='doGoEstimate(\"5\",\"2\");'>"+cfnNumberComma(data.amtInfo.estimateAmt2)+"</a></td></tr>";

			$("#amtList").html(vHtml3);
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}

function doGoMember(vGubun, vTypeGb)
{
	var vStartDate = $("#startDate").val();
	var vEndDate   = $("#endDate").val();
	var url = "member"+vGubun+".do?typeGb="+vTypeGb+"&&strJoinTime="+vStartDate+"&&endJoinTime="+vEndDate;
	
	location.href = url;
}

function doGoEstimate(vState, vEtype)
{
	var vStartDate = $("#startDate").val();
	var vEndDate   = $("#endDate").val();
	var url = "estimate.do?eType="+vEtype+"&&state="+vState+"&&startDate="+vStartDate+"&&endDate="+vEndDate;
	
	location.href = url;
}

function doGoPoint()
{
	var vStartDate = $("#startDate").val();
	var vEndDate   = $("#endDate").val();
	var url = "point.do?priceType=2&&startDate="+vStartDate+"&&endDate="+vEndDate;
	
	location.href = url;
}
var vPageCount = 12;
var typeGb = 2;
jQuery(document).ready(function(){
	var params={};	
	
	var url = "../common/selectArea1List.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#srchArea1").html("");
			var fvHtml="<option value=\"\" selected>전체</option>";
			for(var i=0; i<data.row.length; i++)
			{
				fvHtml += "<option value='"+data.row[i].area1+"'>"+data.row[i].area1+"</option>";
			}

			$("#srchArea1").html(fvHtml);
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
	
	doSearchList(1);	
});

function doSearchList(pageNum)
{
	var params={
			pageCount:vPageCount,
			pageNum:pageNum,
			typeGb:typeGb,
			area1:$("#srchArea1").val(),
			area2:$("#srchArea2").val()
	};
	var url = "selectCenterList.do";
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			var pageSize = $("#pageCount").val();
			$("#centerList").html("");
			var fvHtml="";
			for(var i=0; i<data.row.length; i++)
			{
				fvHtml += "<div class='col-lg-4'>";
				fvHtml += "<div class='card mb-4'>";
				fvHtml += "<div class='card-body'>";
				fvHtml += "<div class='row'>";
				fvHtml += "<div class='col-lg-6'>";
				fvHtml += "<a href='#here' onClick='doDetail(\""+data.row[i].idx+"\")'>";
				fvHtml += "<img class='img-fluid rounded'  style='width:90px;height:90px;' src='"+_setPhotoSite(data.row[i].photoSite)+"' alt=''/>";
				fvHtml += "</a>";
				fvHtml += "</div>";
				fvHtml += "<div class='col-lg-6'>";
				fvHtml += "<p class='card-title'>";
				fvHtml += "<a href='#here' onClick='doDetail(\""+data.row[i].idx+"\")'>"+data.row[i].bizname+"</a>";
				fvHtml += "</p>";
				fvHtml += "<p class='card-text'>"+data.row[i].area1+" "+data.row[i].area2+"</p>";
				//fvHtml += "<a href='#' class='btn btn-primary'>Read More &rarr;</a>";
				fvHtml += "</div>";
				fvHtml += "</div>";
				fvHtml += "</div>";
				fvHtml += "</div>";
				fvHtml += "</div>";
			}
			$("#centerList").html(fvHtml);
			//페이징 처리.
			$("#pageList").html("");
			if(data.totalCount > 0 )
			{
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
					pageHtml += "<a class='page-link' href='#none' onClick='doSearchList("+(lv_InitVal-1)+");' aria-label='Previous'>";
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
					pageHtml += "<a class='page-link' href='#none' onClick='doSearchList("+lv_value+");'>"+lv_value+"</a>";
					pageHtml += "</li>";
				}
				if(lv_TotPage > lv_InitVal+4){
					pageHtml += "<li class='page-item'>";
					pageHtml += "<a class='page-link' href='#none' onClick='doSearchList("+(lv_InitVal+5)+");' aria-label='Next'>";
					pageHtml += "<span aria-hidden='true'>▶</span>";
					pageHtml += "<span class='sr-only'>Next</span>";
					pageHtml += "</a>";
					pageHtml += "</li>";
				}
				$("#pageList").html(pageHtml);
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

function doDetail(idx)
{
	var params={
			idx:idx
	};	
	
	var url = "selectCenterDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#centerTitle").html(data.bizname);
			$("#centerImage").html("<img class='img-fluid rounded'  style='width:340px;height:340px;' src='"+_setPhotoSite(data.photoSite)+"' alt=''/>");
			$("#centerPhoto").html("<img class='img-fluid rounded'  style='width:150px;height:150px;' src='"+_setPhotoSite(data.photo)+"' alt=''/>");
			$("#centerCompleteCnt").html(data.completeCnt+"건");
			$("#centerBizName").html(data.bizname);
			$("#centerArea").html(data.area1 + " " + data.area2);
			$("#centerScore").html("5점 / "+data.score+"점");
			$("#centerIntro").html(_renderHTML(data.intro));
			$('#centerInfo').modal();
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

function _setPhotoSite(photoSite) {          
	if(photoSite) {
		return '../uploads/img/'+photoSite;
	} else {
		return '../images/center/center_empty.png';
	}
}

function _renderHTML(html){
    return html.replace(/\n/g, "<br />"); 
  }
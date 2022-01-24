jQuery(document).ready(function(){
	cfnLoginCheck("9");
	doSearch();
});

function doSearch(){
	var params={
			state:$("#state").val()
	};

	var url = "selectPopup.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#popupList").html("");
			var vHtml = "";
			for(var i=0;i<data.length; i++)
			{
				vHtml += "<li class='col-md-3'>";
				vHtml += "<ul class='row'>";
				vHtml += "<li class='col-md-12'>";
				vHtml += "<img src='../common/file/imageDownload.do?fileNewName="+data[i].photo+"' style='width:250px;height:300px;'/>";
				vHtml += "</li>";
				vHtml += "<li class='col-md-12'>";
				if(data[i].state == "0")
				{
					vHtml += "<button class='btn btn-sm btn-info' onClick='doState(\""+data[i].idx+"\",\"1\")'>개시</button>&nbsp;&nbsp;";
				}else{
					vHtml += "<button class='btn btn-sm btn-info' onClick='doState(\""+data[i].idx+"\",\"0\")'>대기</button>&nbsp;&nbsp;";
				}
				vHtml += "<button class='btn btn-sm btn-warning' onClick='doModify(\""+data[i].idx+"\")'>수정</button>&nbsp;&nbsp;";
				vHtml += "<button class='btn btn-sm btn-danger' onClick='doDelete(\""+data[i].idx+"\")'>삭제</button>";
				vHtml += "</li>";
				vHtml += "</ul>";
				vHtml += "</li>";
			}
			$("#popupList").html(vHtml);
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}

var flag;
var vIdx;
function doAdd()
{
	flag = "I";
	cfnOpenPopup('../common/file/imageSearch.do','350','250','auto','auto','0','0','0');
}

function doModify(idx)
{
	vIdx = idx
	flag = "U";
	cfnOpenPopup('../common/file/imageSearch.do','350','250','auto','auto','0','0','0');
}

function setImage(filePath)
{
	var params={
			idx:vIdx,
			photo:filePath,
			state:"0"
	};

	var url;
	if(flag == "I")
	{
		url = "insertPopup.do";
	}else{
		url = "updatePopup.do";
	}
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			doSearch();
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doDelete(fvIdx)
{
	if(!confirm("삭제하시겠습니까?")) return;
	var params={
			idx:fvIdx
	};

	var url = "deletePopup.do";

	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			doSearch();
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function doState(fvIdx, fvState)
{
	var params={
			idx:fvIdx,
			state:fvState
	};

	var url = "updatePopupState.do";

	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			doSearch();
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}
var vGubun;
jQuery(document).ready(function(){
	
	var params={};	
	
	var url = "selectCategory1.do";	
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#srchCategory1").html("");
			var fvHtml="<option value=\"\" selected>선택</option>";
			for(var i=0; i<data.length; i++)
			{
				fvHtml += "<option value='"+data[i].category1+"'>"+data[i].category1+"</option>";
			}

			$("#srchCategory1").html(fvHtml);
			$("#category1").html(fvHtml);
			$('#category1').change(function() { 
				doChangeCategory2();

			});		
			doSearch();
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
})

function doSearch()
{
	var params={
			category1:$("#srchCategory1").val()
	};	
	
	var url = "selectCategory.do";	
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			var vHtml1 = "";
			for(var i=0; i<data.list1.length; i++)
			{
				vHtml1 += "<tr>";
				vHtml1 += "<td>"+cfNvl1(data.list1[i].category1)+"</td>";
				vHtml1 += "<td>"+cfNvl1(data.list1[i].category2)+"</td>";
				vHtml1 += "<td class='text-center'>";
				vHtml1 += "<button class='btn btn-sm btn-warning' onClick='doModify(\"1\",\""+data.list1[i].idx+"\",\""+data.list1[i].category1+"\",\""+data.list1[i].category2+"\",\""+data.list1[i].category3+"\")'>수정</button>&nbsp;&nbsp;";
				vHtml1 += "<button class='btn btn-sm btn-danger' onClick='doDelete(\"1\",\""+data.list1[i].idx+"\")'>삭제</button>";
				vHtml1 += "</td>";
				vHtml1 += "</tr>";
			}
			$("#category1List").html(vHtml1);
			
			vHtml1 = "";
			for(var i=0; i<data.list2.length; i++)
			{
				vHtml1 += "<tr>";
				vHtml1 += "<td>"+cfNvl1(data.list2[i].category1)+"</td>";
				vHtml1 += "<td>"+cfNvl1(data.list2[i].category2)+"</td>";
				vHtml1 += "<td>"+cfNvl1(data.list2[i].category3)+"</td>";
				vHtml1 += "<td class='text-center'>";
				vHtml1 += "<button class='btn btn-sm btn-warning' onClick='doModify(\"2\",\""+data.list2[i].idx+"\",\""+data.list2[i].category1+"\",\""+data.list2[i].category2+"\",\""+data.list2[i].category3+"\")'>수정</button>&nbsp;&nbsp;";
				vHtml1 += "<button class='btn btn-sm btn-danger' onClick='doDelete(\"2\",\""+data.list2[i].idx+"\")'>삭제</button>";
				vHtml1 += "</td>";
				vHtml1 += "</tr>";
			}
			$("#category2List").html(vHtml1);
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function doChangeCategory2()
{
	if(vGubun != '2') return;
	var params={
			category1:$("#category1").val()	
	};	
	
	var url = "selectCategory2.do";	
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#category2").html("");
			var fvHtml="<option value=\"\" selected>선택</option>";
			if($("#category1").val())
			{
				for(var i=0; i<data.length; i++)
				{
					fvHtml += "<option value='"+data[i].category2+"'>"+data[i].category2+"</option>";
				}
			}

			$("#category2").html(fvHtml);
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

function doAdd(gubun)
{
	vGubun = gubun;
	$("#idx").val("");
	$("#flag").val("I");
	$("#gubun").val(gubun);
	$("#category1").val("");
	$("#category2").val("");
	$("#category3").val("");
	if(gubun == "1")
	{
		$("#modalTitle").html("세부 카테고리 등록");
		$("#divCategory2").html("<input type='text' class='input_default' id='category2'>");
		
		$("#divCategory3").hide();
	}else{
		$("#modalTitle").html("제조사  등록");
		$("#divCategory2").html("<select class='input_default' id='category2'><option value='' selected>선택</option><select>");

		$("#divCategory3").show();
	}
	$("#category1").attr("disabled",false);
	$("#category2").attr("disabled",false);
	$('#modal_category').modal();
}

function doModify(gubun, idx, category1, category2, category3)
{
	vGubun = gubun;
	$("#divCategory2").html("<input type='text' class='input_default' id='category2'>");
	$("#idx").val(idx);
	$("#flag").val("U");
	$("#gubun").val(gubun);
	$("#category1").val(category1);
	$("#category2").val(category2);
	$("#category3").val(category3);
	if(gubun == "1")
	{
		$("#category2").attr("disabled",false);
		$("#modalTitle").html("세부 카테고리 수정");
		$("#divCategory3").hide();
	}else{
		$("#category2").attr("disabled",true);
		$("#modalTitle").html("제조사  수정");
		$("#divCategory3").show();
	}
	$("#category1").attr("disabled",true);
	$('#modal_category').modal();	
}

function doDelete(gubun, idx)
{
	if(!confirm("삭제하시겠습니까?")) return;
	
	var params={
			idx:idx	
	};	
	
	var url;
	if(gubun == "1")
	{
		url = "deleteCategory2.do";
	}else{
		url = "deleteCategory3.do";
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

function doSave()
{
	var url;
	var flag  = $("#flag").val();
	var gubun = $("#gubun").val();

	if(!cfnNullCheckSelect($("#category1").val(), "품목")) return;
	if(gubun == "1")
	{
		if(!cfnNullCheckSelect($("#category2").val(), "세부 카테고리")) return;
	}else{
		if(!cfnNullCheckSelect($("#category3").val(), "제조사")) return;
	}
	
	var params={
			idx:$("#idx").val(),
			category1:$("#category1").val(),
			category2:$("#category2").val(),
			category3:$("#category3").val()
	};	
	
	if(flag == "I")
	{
		if(gubun == "1")
		{
			url = "insertCategory2.do";
		}else{
			url = "insertCategory3.do";
		}
	}else{
		if(gubun == "1")
		{
			url = "updateCategory2.do";
		}else{
			url = "updateCategory3.do";
		}
	}
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$('#modal_category').modal("hide");
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

function doClose()
{
	$('#modal_category').modal("hide");
}
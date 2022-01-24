var vCategory1;
var vCategory2;
jQuery(document).ready(function(){
	
	var params={};	
	
	var url = "selectCategory1.do";	
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#category1List").html("");
			var fvHtml="";
			for(var i=0; i<data.length; i++)
			{
				fvHtml += "<tr onClick='doSearchCategory2(\""+data[i].category1+"\")'>";
				fvHtml += "<td class='text-center'>"+cfNvl1(data[i].category1)+"</td>";
				fvHtml += "</tr>";			
			}

			$("#category1List").html(fvHtml);
			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
})

function doSearchCategory2(category1)
{
	vCategory1 = category1;
	vCategory2 = "";
	
	var params={
			category1:category1
	};	
	
	var url = "selectCategory2.do";	
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#category2List").html("");
			$("#category3List").html("");
			var vHtml1 = "";
			for(var i=0; i<data.length; i++)
			{
				vHtml1 += "<tr>";
				vHtml1 += "<td onClick='doSearchCategory3(\""+data[i].category1+"\",\""+data[i].category2+"\")'>"+cfNvl1(data[i].category1)+"</td>";
				vHtml1 += "<td onClick='doSearchCategory3(\""+data[i].category1+"\",\""+data[i].category2+"\")'>"+cfNvl1(data[i].category2)+"</td>";
				vHtml1 += "<td>";
				vHtml1 += "<ul>";
				vHtml1 += "<li class='col-xs-6'><a class='main_bg' href='#!' onClick='doModityCategory2(\""+data[i].idx+"\",\""+data[i].category1+"\",\""+data[i].category2+"\")'>수정</a></li>";
				vHtml1 += "<li class='col-xs-6'><a class='red_bg' href='#!' onClick='doDeleteCategory2(\""+data[i].idx+"\",\""+data[i].category1+"\",\""+data[i].category2+"\")'>삭제</a></li>";
				vHtml1 += "</ul>";
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

function doSearchCategory3(category1, category2)
{
	vCategory1 = category1;
	vCategory2 = category2;
	
	var params={
			category1:category1,
			category2:category2
	};	
	
	var url = "selectCategory3.do";	
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#category3List").html("");
			var vHtml1 = "";
			for(var i=0; i<data.length; i++)
			{
				vHtml1 += "<tr>";
				vHtml1 += "<td>"+cfNvl1(data[i].category1)+"</td>";
				vHtml1 += "<td>"+cfNvl1(data[i].category2)+"</td>";
				vHtml1 += "<td>"+cfNvl1(data[i].category3)+"</td>";
				vHtml1 += "<td>";
				vHtml1 += "<ul>";
				vHtml1 += "<li class='col-xs-6'><a class='main_bg' href='#!' onClick='doModityCategory3(\""+data[i].idx+"\",\""+data[i].category1+"\",\""+data[i].category2+"\",\""+data[i].category3+"\")'>수정</a></li>";
				vHtml1 += "<li class='col-xs-6'><a class='red_bg' href='#!' onClick='doDeleteCategory3(\""+data[i].idx+"\",\""+data[i].category1+"\",\""+data[i].category2+"\",\""+data[i].category3+"\")'>삭제</a></li>";
				vHtml1 += "</ul>";
				vHtml1 += "</td>";
				vHtml1 += "</tr>";
			}
			$("#category3List").html(vHtml1);

			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}
var vGubun = "";
var vUrl = "";
function doAddCategory2()
{
	vGubun = "2";
	if(!vCategory1){
		alert("품목을 선택하십시오.");
		return;
	}
	vUrl = "insertCategory2.do";
	$("#idx").val("");
	$("#category1").val(vCategory1);
	$("#oldCategory1").val(vCategory1);
	$("#category2").val("");
	$("#oldCategory2").val("");
	$("#category3").val("");
	$("#oldCategory3").val("");
	$("#divCategory3").hide();
	$("#category2").attr("disabled",false);
	
	$('#modal_category').modal();
}

function doAddCategory3()
{
	vGubun = "3";
	if(!vCategory2){
		alert("세부 카테고리를 선택하십시오.");
		return;
	}
	vUrl = "insertCategory3.do";
	$("#idx").val("");
	$("#category1").val(vCategory1);
	$("#oldCategory1").val(vCategory1);
	$("#category2").val(vCategory2);
	$("#oldCategory2").val(vCategory2);
	$("#category3").val("");
	$("#oldCategory3").val("");
	$("#divCategory3").show();
	$("#category2").attr("disabled",true);
	
	$('#modal_category').modal();
}


function doModityCategory2(idx,category1,category2)
{
	vGubun = "2";
	vUrl = "updateCategory2.do";
	$("#idx").val(idx);
	$("#category1").val(category1);
	$("#oldCategory1").val(category1);
	$("#category2").val(category2);
	$("#oldCategory2").val(category2);
	$("#category3").val("");
	$("#oldCategory3").val("");
	$("#divCategory3").hide();
	$("#category2").attr("disabled",false);
	
	$('#modal_category').modal();
}

function doModityCategory3(idx,category1,category2, category3)
{
	vGubun = "3";
	vUrl = "updateCategory3.do";
	$("#idx").val(idx);
	$("#category1").val(category1);
	$("#oldCategory1").val(category1);
	$("#category2").val(category2);
	$("#oldCategory2").val(category2);
	$("#category3").val(category3);
	$("#oldCategory3").val(category3);
	$("#divCategory3").show();
	$("#category2").attr("disabled",true);
	
	$('#modal_category').modal();
}


function doDeleteCategory2(idx,category1,category2)
{
	if(!confirm("삭제하시겠습니까?")) return;
	var params={
			idx:idx,
			category1:category1,
			category2:category2
	};	
	
	$.ajax({
		type: "POST",
		url : "deleteCategory2.do",
		data: params,
		success : function(data) {
			doSearchCategory2(vCategory1);
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});

}

function doDeleteCategory3(idx,category1,category2, category3)
{
	if(!confirm("삭제하시겠습니까?")) return;
	var params={
			idx:idx,
			category1:category1,
			category2:category2,
			category3:category3
	};	
	
	$.ajax({
		type: "POST",
		url : "deleteCategory3.do",
		data: params,
		success : function(data) {
			doSearchCategory3(vCategory1,vCategory2);
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
	if(vGubun == "2")
	{
		if(!cfnNullCheckSelect($("#category2").val(), "세부 카테고리")) return;
	}else{
		if(!cfnNullCheckSelect($("#category3").val(), "제조사")) return;
	}
	if(!confirm("저장하시겠습니까?")) return;
	var params={
			idx:$("#idx").val(),
			category1:$("#category1").val(),
			oldCategory1:$("#oldCategory1").val(),
			category2:$("#category2").val(),
			oldCategory2:$("#oldCategory2").val(),
			category3:$("#category3").val(),
			oldCategory3:$("#oldCategory3").val()
	};	
	
	$.ajax({
		type: "POST",
		url : vUrl,
		data: params,
		success : function(data) {
			$('#modal_category').modal("hide");
			if(vGubun == "2")
			{
				doSearchCategory2(vCategory1);
			}else{
				doSearchCategory3(vCategory1,vCategory2);
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

function doClose()
{
	$('#modal_category').modal("hide");
}
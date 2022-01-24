jQuery(document).ready(function(){
	doSearch();
	
	$('input[name="customerGubun"]').change(function() { 
		var url = $('input[name="customerGubun"]:checked').val()
		location.href="../admin/"+url;
	}); 
});


function doSearch()
{
	var params={};
	var url = "selectFaqList.do";
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#tableList").html("");
			var fvHtml="";
			if(data.length > 0 )
			{
				for(var i=0; i<data.length; i++)
				{
					fvHtml+="<tr>";
					
					fvHtml += "<td>"+cfNvl1(data[i].idx)+"</td>";
					fvHtml += "<td>"+cfNvl1(data[i].title)+"</td>";
					fvHtml += "<td>"+cfNvl1(data[i].updatetime)+"</td>";
					fvHtml += "<td>";
					fvHtml += "<ul>";
					fvHtml += "<li class='col-xs-6'><a class='main_bg' href='#!' onClick='doModifyFaq(\""+data[i].idx+"\")'>수정<a></li>";
					fvHtml += "<li class='col-xs-6'><a class='red_bg' href='#!' onClick='doDeleteFaq(\""+data[i].idx+"\")'>삭제<a></li>";
					fvHtml += "</ul>";
					fvHtml += "</td>";
					
					fvHtml += "</tr>";
				}
				$("#tableList").html(fvHtml);

			}else{
				fvHtml+="<tr>";
				
				fvHtml+="<td colspan='4' class='text-center'>FAQ가 없습니다.</td>";
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

function doAddFaq(){
	$('#flag').val("I");
	$('#title').val("");
	$('#content').val("");
	
	$('#modal_faq').modal();
}

function doModifyFaq(idx){
	var params={
			idx:idx
	};	
	
	var url = "selectFaqDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$('#flag').val("U");
			$('#idx').val(data.idx);
			$('#title').val(data.title);
			$('#content').val(data.content);

			$('#modal_faq').modal();
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
	
}

function doSaveFaq()
{
	if(!cfnNullCheckSelect($('#title').val(),"제목")) return;
	if(!cfnNullCheckSelect($('#content').val(),"내용")) return;

	var params={
			idx:$("#idx").val(),
			title:$("#title").val(),
			content:$('#content').val(),
	};	
	
	var url;
	if($("#flag").val() == "I")
	{
		url = "insertFaq.do";
	}else{
		url = "updateFaq.do";
	}
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$('#modal_faq').modal("hide");
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

function doCloseFaq()
{
	$('#modal_faq').modal("hide");
}

function doDeleteFaq(idx){
	if(!confirm("삭제하시겠습니까?")) return;
	
	var params={
			idx:idx
	};	
	
	var url = "deleteFaq.do";	
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


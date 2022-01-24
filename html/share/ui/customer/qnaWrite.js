function doSaveQna()
{
	if(!cfnNullCheckSelect($('#resType').val(),"제목")) return;
	if(!cfnNullCheckSelect($('#title').val(),"제목")) return;
	if(!cfnNullCheckSelect($('#resContent').val(),"작성내역")) return;

	var params={
			resType:$("#resType").val(),
			title:$("#title").val(),
			resContent:$('#resContent').val()
	};	
	
	var url = "insertQna.do";

	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("1:1 문의가 등록되었습니다.\n빠른시일내로 답변드리겠습니다.");
			location.href="./qna.do";
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}
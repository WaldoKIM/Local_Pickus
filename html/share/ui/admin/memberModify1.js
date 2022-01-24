jQuery(document).ready(function(){
	var params={
		idx:$("#idx").val()
	};

	var url = "selectMember.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#nickname").val(data.nickname);
			$("#email").val(data.email);
			$("#phone").val(data.phone);
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
	
});

function doSaveUser()
{
	if(!confirm("회원정보를 수정하시겠습니까?"))  return;
	
	var vPassword = "";
	if($("#password").val())
	{
		vPassword = hex_md5($("#password").val());
	}
	var params={
			email:$("#email").val(),
			phone:$("#phone").val(),
			password:vPassword,
			typeGb:"0"
	};

	var url = "updateMember.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("수정하였습니다.");
			location.href="../admin/member1.do";
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function doCancelSaveUser()
{
	location.href="../admin/member1.do";
}

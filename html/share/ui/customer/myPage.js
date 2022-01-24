jQuery(document).ready(function(){
	cfnLoginCheck("0","","","", true);
	var params={};

	var url = "selectUser.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#nickname").val(data.nickname);
			$("#email").val(data.email);
			$("#phone").val(data.phone);
			$("#span_email").html(data.email);
			$("#span_nickname").html(data.nickname);

		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
	
});

function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}


function doSaveUser()
{
	if(!confirm("회원정보를 수정하시겠습니까?"))  return;
	
	var vPassword = "";
	if($("#password").val())
	{
		vPassword = hex_md5($("#password").val());
	}
	var params={
			phone:$("#phone").val(),
			password:vPassword
	};

	var url = "updateMyPage.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("수정하였습니다.");
			location.href="../main/main.do";
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function doWithdrawal()
{
	if(!confirm("회원을 탈퇴하시겠습니까?"))  return;
	
	var params={
			typeGb:"3"
	};

	var url = "updateWithdrawal.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("탈퇴하였습니다.");
			location.href="../main/main.do";
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
		
}
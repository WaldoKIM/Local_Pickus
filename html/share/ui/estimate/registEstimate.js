jQuery(document).ready(function(){
	$("#phone").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});
})

var vUrl = "";
function doMoveRegist(fvFlag)
{
	$('#registEstimate1').removeClass("on");
	$('#registEstimate2').removeClass("on");
	$('#registEstimate3').removeClass("on");
	$('#registEstimate4').removeClass("on");
	$('#'+fvFlag).addClass("on");
	var params={};

	var url = "../common/loginCheck.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			vUrl ="../estimate/"+fvFlag+".do";
			if(data.flag == "1")
			{
				location.href = vUrl;
			}else{
				$('#divNotLogin').show();	
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

function doMoveLogin()
{
	location.href="../customer/login.do?turnUrl="+vUrl;
}

function doSaveNotLogin()
{
	if(!cfnNullCheckInput($("#nickname").val(),"이름")) return;
	if(!cfnNullCheckInput($("#email").val(),"E-Mail")) return;
	if(!validateEmail($("#email").val())){
		alert("이메일 형식이 잘못되었습니다.");
		return;
	}
	if(!cfnNullCheckInput($("#phone").val(),"핸드폰 번호")) return;
	
	if(!$("#pbAgree").prop("checked")){
		alert("이용약관에 동의해주세요!");
		return false;
	}
	
	var params={
			email:$("#email").val(),
			nickname:$("#nickname").val(),
			phone:$("#phone").val(),
			typeGb:"8"			
	};

	var url = "insertNotSignup.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.flag == "1")
			{
				location.href = vUrl;
			}else if(data.flag == "2")
			{
				alert("이전에 신청한 경력이 있습니다.");
				location.href = vUrl;
			}else{
				alert("회원이 존재합니다. 로그인 후 사용하십시오.");
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

function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
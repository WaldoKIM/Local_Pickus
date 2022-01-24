jQuery(document).ready(function(){
	alert( "등록된 이메일정보가 없어 SNS 회원가입 페이지로 이동합니다.");
	//LoginWithNaverId Javscript 설정 정보 및 초기화
	/*
	var naverLogin = new naver.LoginWithNaverId(
		{
			clientId: "oDmAvcPKBwWXgSfBZYbg",
			callbackUrl: "http://" + window.location.hostname + ((location.port==""||location.port==undefined)?"":":" + location.port) + "/oauth/sample/callback.html",
			isPopup: false,
			loginButton: {color: "green", type: 3, height: 60}
		}
	);
	
	naverLogin.init();
	*/
	
	$("#phone").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});
});

function doSnsSignup()
{
	if(!checkFields()) return false;
	
	var emailYn = "N";
	if(!$("#sendAgree").prop("checked")){
		emailYn = "Y";
	}
	
	var params={
			googleId:$("#googleId").val(),
			kakaoId:$("#kakaoId").val(),
			facebookId:$("#facebookId").val(),
			naverId:$("#naverId").val(),
			googleDisplayname:$("#googleDisplayname").val(),
			kakaoNickname:$("#kakaoNickname").val(),
			facebookDisplayname:$("#facebookDisplayname").val(),
			naverDisplayname:$("#naverDisplayname").val(),
			email:$("#email").val(),
			//password:hex_md5($("#password").val()),
			nickname:$("#nickname").val(),
			phone:$("#phone").val(),
			typeGb:"0",
			emailYn:emailYn
	};

	var url = "../customer/insertSnsSignup.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("회원 가입이 완료되었습니다!");
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

function doMappingUser()
{
	$("#map_email").val("");
	$("#map_password").val("");
	$("#modal_login").modal();
}

function doMappingSave()
{
	if(!$("#map_email").val()){
		alert("이메일을 입력해주세요.");
		return false;        		
	}
	
	
	if(!$("#map_password").val()){
		alert("비밀번호를 입력해주세요.");
		return false;
	}
	
	var params={
			email:$("#map_email").val(),
			password:hex_md5($("#map_password").val()),
			snsGubun:$("#snsGubun").val(),
			googleId:$("#googleId").val(),
			kakaoId:$("#kakaoId").val(),
			facebookId:$("#facebookId").val(),
			naverId:$("#naverId").val(),
			googleDisplayname:$("#googleDisplayname").val(),
			kakaoNickname:$("#kakaoNickname").val(),
			facebookDisplayname:$("#facebookDisplayname").val(),
			naverDisplayname:$("#naverDisplayname").val()
	};

	var url = "../customer/mappingSnsSignup.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.flag == "0")
			{
				alert("이메일이나 비밀번호를 확인하십시오.");
			}else if(data.flag == "1"){
				location.href="../main/main.do";			
			}else if(data.flag == "2"){
				alert("아직 인증되지 않은 사업자회원입니다.");
			}else if(data.flag == "3"){
				alert("이미 탈퇴한 회원입니다.");
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

function doMappingClose()
{
	$("#modal_login").modal("hide");
}

function checkFields() {  
	
	removeClass();

	if(!$("#nickname").val()){
		$("#lbl_nickname").html("이름을 입력해주세요.");
		$("#lbl_nickname").show();
		$("#nickname").addClass("input_error");
		return false;
	}
	
	if(!$("#email").val()){
		$("#lbl_email").html("이메일을 입력해주세요.");
		$("#lbl_email").show();
		$("#email").addClass("input_error");
		return false;        		
	}
	
	if(!this.validateEmail($("#email").val())){
		$("#lbl_email").html("이메일 형식이 잘못되었습니다.");
		$("#lbl_email").show();
		$("#email").addClass("input_error");
		return false;
	}
	/*
	if(!$("#password").val()){
		$("#lbl_password").html("비밀번호를 입력해주세요.");
		$("#lbl_password").show();
		$("#password").addClass("input_error");
		return false;
	}
	
	if($("#password").val()!=$("#passwordConfirm").val()){
		$("#lbl_passwordConfirm").html("비밀번호와 비밀번호확인이 일치하지 않습니다.");
		$("#lbl_passwordConfirm").show();
		$("#passwordConfirm").addClass("input_error");
		return false;
	}

	if($("#password").val().length  < 8 || $("#password").val().length  > 15){
		$("#lbl_password").html("비밀번호는 8자 이상 15자 이하입니다.");
		$("#lbl_password").show();
		$("#password").addClass("input_error");
		return false;
	}

*/
	if(!$("#phone").val()){
		$("#lbl_phone").html("전화번호를 입력해주세요.");
		$("#lbl_phone").show();
		$("#phone").addClass("input_error");
		return false;
	}

	if(!$("#pbAgree").prop("checked")){
		alert("이용약관에 동의해주세요!");
		return false;
	}
	return true;
}
        
function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function removeClass()
{
	$("#lbl_nickname").hide();
	$("#lbl_email").hide();
	$("#lbl_password").hide();
	$("#lbl_passwordConfirm").hide();
	$("#lbl_phone").hide();
	
	$("#nickname").removeClass("input_error");
	$("#email").removeClass("input_error");
	$("#password").removeClass("input_error");
	$("#passwordConfirm").removeClass("input_error");
	$("#phone").removeClass("input_error");
}

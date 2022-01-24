var vType = "1"
var vEmail = "";

jQuery(document).ready(function(){
	$("#srchHpNo").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});
	
	var emailId = fnGetCookie("emailId");
	if(emailId){
		$("#user_email").val(emailId);
		$("#SAVEID").attr("checked",true);
		$("#user_password").focus();
	}else{
		$("#user_email").focus();
	}

	$("#user_email").keydown(function(){
		if(event.keyCode == 13) $("#user_password").focus(); 
	});
	
	$("#user_password").keydown(function(){
		if(event.keyCode == 13) doLogin(); 
	});
	
	vEmail = $("#user_email").val();


	doChangeLogin("1");
});

function doChangeLogin(fvType)
{
	vType = fvType;
	$("#divLogin").html("");
	
	var vHtml = "";
	vHtml += "<div class='col-lg-4'>";
	if(fvType == "1")
	{
		vHtml += "	<span id='spanSign' class='txt_title_01'>회원 로그인</span>";
	}else{
		vHtml += "	<a href='#none' onClick='doChangeLogin(\"1\");'>";
		vHtml += "		<span class='txt_title_08'>회원 로그인</span>";
		vHtml += "	</a>";
	}
	vHtml += "</div>";
	vHtml += "<div class='col-lg-1' style='margin-top:-5px;'>";
	vHtml += "	<span class='txt_title_01'> | </span>";
	vHtml += "</div>";
	vHtml += "<div class='col-lg-5'>";
	if(fvType == "1")
	{
		vHtml += "	<a href='#none' onClick='doChangeLogin(\"2\");'>";
		vHtml += "		<span class='txt_title_08'>비회원 로그인</span>";
		vHtml += "	</a>";
	}else{
		vHtml += "	<span id='spanSign' class='txt_title_01'>비회원 로그인</span>";
	}
	vHtml += "</div>";
	$("#divLogin").html(vHtml);
	
	if(fvType == "1")
	{
		$("#user_email").val(vEmail);
		$("#divNotSign").hide();
		$("#divSign").show();
	}else{
		$("#user_email").val("");
		$("#divNotSign").show();
		$("#divSign").hide();
	}	
}
function doLogin()
{
	if(vType == "1")
	{
		doLoginSign()
	}else{
		doLoginNotSign()
	}
}

function doLoginSign()
{
	if(!$("#user_email").val()){
		alert("이메일을 입력해주세요.");
		return false;        		
	}
	

	if(!$("#user_password").val()){
		alert("비밀번호를 입력해주세요.");
		return false;
	}
	
	var params={
			email:$("#user_email").val(),
			password:hex_md5($("#user_password").val())
	};

	var url = "selectLogin.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.flag == "0")
			{
				alert("이메일이나 비밀번호를 확인하십시오.");
			}else if(data.flag == "1"){
				if($("#SAVEID").is(":checked")){
					var date = fnGetExpDate(30, 12, 00);
					fnSetCookie("emailId", $("#user_email").val(), date);
				} else {
					fnDeleteCookie("emailId");
				}
				
				location.href=$("#turnUrl").val();				
			}else if(data.flag == "2"){
				alert("관리자 승인 후 이용이 가능합니다.");
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

function doLoginNotSign()
{

	if(!$("#user_nickname").val()){
		alert("이름을 입력해주세요.");
		return false;
	}
	
	if(!$("#user_email").val()){
		alert("이메일을 입력해주세요.");
		return false;        		
	}
	

	
	var params={
			nickname:$("#user_nickname").val(),
			email:$("#user_email").val()
	};

	var url = "selectLoginNotSign.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.flag == "0")
			{
				alert("비회원 정보가 없습니다.");
			}else if(data.flag == "1"){
				location.href=$("#turnUrl").val();				
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

function doRegister()
{
	location.href="../customer/signup.do";
}

function doSearchUserId()
{
	$("#srchHpNo").val("");
	$("#srchUserIdInfo").html("");
	$('#modal_search_userid').modal();	
}

function doSearchUserIdCompete()
{
	if(!cfnNullCheckInput($('#srchHpNo').val(), "휴대폰 번호")) return;
	$("#srchUserIdInfo").html("");
	var params={
			phone:$("#srchHpNo").val()
	};

	var url = "selectFindUser.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.length == "0")
			{
				alert("회원 정보가 없습니다.");
			}else{
				if(data[0].typeGb == "0" || data[0].typeGb == "2")
				{
					$("#srchUserIdInfo").html("귀하의 ID는 "+data[0].email+" 입니다.");
				}else{
					alert("회원 정보가 없습니다.");
				}
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

function doSearchUserIdClose()
{
	$('#modal_search_userid').modal("hide");
}

function doSearchPswd()
{
	$("#srchEmail").val("");
	$('#modal_search_pswd').modal();	
}

function doSearchPswdComplete()
{
	if(!cfnNullCheckInput($('#srchEmail').val(), "이메일")) return;
	var params={
			email:$("#srchEmail").val()
	};

	var url = "selectFindUser.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.loginYn == "N")
			{
				alert("회원 정보가 없습니다.");
			}else{
				if(data.typeGb == "0" || data.typeGb == "2")
				{
					var email = $("#srchEmail").val();
					var password = hex_md5(data.password);
					var passwordTemp = data.password;
					var params1={
							email:email,
							password:password,
							passwordTemp:passwordTemp
					};

					var url1 = "insertPasswordTemp.do";	
					$.ajax({
						type: "POST",
						url : url1,
						data: params1,
						success : function(data) {
							alert("이메일로 임시 비밀번호가 전송되었습니다.");
							$('#modal_search_pswd').modal("hide");
						},
					    beforeSend : function(){
					    	
						},
						complete : function(){
							
					    },
						error: function(jqXHR, textStatus, errorThrown){
							
					    }
					});
					
				}else{
					alert("회원 정보가 없습니다.");
				}
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

function doSearchPswdClose()
{
	$('#modal_search_pswd').modal("hide");
}

function fnSetCookie(name, value, expires, path, domain, secure) 
{
    if (!path) {
        path = "/";
    }
    document.cookie = name + "=" + escape (value) +
                    ((expires) ? "; expires=" + expires : "") +
                    ((path) ? "; path=" + path : "") +
                    ((domain) ? "; domain=" + domain : "") +
                    ((secure) ? "; secure" : "");
}

function fnGetCookie(name)
{
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    while (i < clen) {
        var j = i + alen;
        if (document.cookie.substring(i, j) == arg) {
            return fnGetCookieVal(j);
        }
        i = document.cookie.indexOf(" ", i) + 1;
        if (i == 0) break;
    }
    return "";	
}
 
function fnGetCookieVal(offset)
{
    var endstr = document.cookie.indexOf (";", offset);
    if (endstr == -1) {
        endstr = document.cookie.length;
    }
    return unescape(document.cookie.substring(offset, endstr));
}

function fnDeleteCookie(name, path, domain)
{
    if (!path) {
        path = "/";
    }
    if (fnGetCookie(name)) {
        document.cookie = name + "=" +
            ((path) ? "; path=" + path : "") + 
            ((domain) ? "; domain=" + domain : "") + 
            "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    }
	
}

function fnGetExpDate(days, hours, minutes) {
    var expDate = new Date( );
    if (typeof days == "number" && typeof hours == "number" &&
        typeof hours == "number") {
        expDate.setDate(expDate.getDate( ) + parseInt(days));
        expDate.setHours(expDate.getHours( ) + parseInt(hours));
        expDate.setMinutes(expDate.getMinutes( ) +
        parseInt(minutes));
        return expDate.toGMTString( );
    }
}

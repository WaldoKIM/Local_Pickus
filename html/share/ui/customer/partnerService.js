function doSave()
{
	if(!_checkFields()) return;
	
	var params={
			area:$("#area").val(),
			bizname:$("#bizname").val(),
			name:$("#name").val(),
			email:$("#email").val(),
			phone:$("#phone").val()
	};

	var url = "insertPartner.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			alert("감사합니다. 피커스 고객센터에서 업체로 연락이 갈 예정입니다.");
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

function _initData() {
    $("#area").val("");          
    $("#bizname").val("");          
    $("#name").val("");
    $("#email").val("");
    $("#phone").val("");
}

function  _checkFields() {     
	if(!$("#area").val()){
		alert("지역을 입력해주세요.");
		return false;
	}   	        
	if(!$("#bizname").val()){
		alert("업체명을 입력해주세요.");
		return false;
	}	
	if(!$("#email").val()){
		alert("이메일을 입력해주세요.");
		return false;        		
	}
	if(!_validateEmail($("#email").val())){
		alert("이메일 형식이 잘못되었습니다.");
		return false;
	}        	
	if(!$("#name").val()){
		alert("이름을 입력해주세요.");
		return false;
	}
	if(!$("#phone").val()){
		alert("전화번호를 입력해주세요.");
		return false;
	}        	
	return true;
}

function _validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
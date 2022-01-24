function doAddUser(typeGb)
{
	if(typeGb == "0"){
		location.href = "../admin/memberInsert1.do";
	}
	if(typeGb == "2"){
		location.href = "../admin/memberInsert2.do";
	}
}

function doModifyUser(idx, typeGb)
{
	if(typeGb == "0"){
		location.href = "../admin/memberModify1.do?idx="+idx;
	}else{
		location.href = "../admin/memberModify2.do?idx="+idx;
	}
}

function doDeleteUser(email, typeGb)
{
	if(!confirm("삭제하시겠습니까?")) return;
	
	var params={
		email:email,
		typeGb:typeGb
	};

	var url = "deleteMember.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			doSearch(vPageNum);	
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}

function doApplyUser(email, typeGb)
{
	if(!confirm("승인하시겠습니까?")) return;
	
	var params={
		email:email,
		typeGb:"2"
	};

	var url = "applyMember.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			doSearch(vPageNum);	
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function doChangeChargeRate(email, chargeRate)
{
	$('#chargeEmail').val(email);
	$('#chargeRate').val(chargeRate);
	$('#modal_charge').modal();
}

function doChangeChargeRateClose()
{
	$('#modal_charge').modal("hide");
}

function doChangeChargeRateComplete()
{
	if(!$('#chargeRate').val()){
		alert("수수료율을 입력하십시오.");
		return;
	}
	
	var params={
			email:$('#chargeEmail').val(),
			chargeRate:$('#chargeRate').val()
		};

		var url = "changeChargeMember.do";	
		$.ajax({
			type: "POST",
			url : url,
			data: params,
			success : function(data) {
				$('#modal_charge').modal("hide");
				doSearch(vPageNum);	
			},
		    beforeSend : function(){
		    	
			},
			complete : function(){
				
		    },
			error: function(jqXHR, textStatus, errorThrown){
				
		    }
		});
		
}

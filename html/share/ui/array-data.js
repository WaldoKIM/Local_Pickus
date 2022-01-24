var bizTypes = [["1","재활용센터"],
                ["2","철거업체"],
                ["3","센터, 업체 둘다"]];

var goodsItems = [["2","가전"],
                   ["2","가구"],
                   ["4","주방집기"],
                   ["2","헬스용품"],
                   ["2","모두수거"]];

var goodsYears = [["1","1년 미만"],
                  ["2","2년 미만"],
                  ["3","3년 미만"],
                  ["4","4년 미만"],
                  ["5","5년 미만"],
                  ["6","6년 미만"],
                  ["7","7년 미만"],
                  ["8","8년 미만"],
                  ["9","9년 미만"],
                  ["10","10년 미만"],
                  ["99","상관없음"]];

var years =       [["1","1년 미만"],
                  ["2","2년 미만"],
                  ["3","3년 미만"],
                  ["4","4년 미만"],
                  ["5","5년 미만"],
                  ["6","6년 미만"],
                  ["7","7년 미만"],
                  ["8","8년 미만"],
                  ["9","9년 미만"],
                  ["10","10년 미만"],
                  ["99","10년 이상"]];

var removeItems = ["붙박이장",
                   "인테리어",
                   "내부철거",
                   "간판철거",
                   "가벽철거",
                   "타일철거",
                   "건물철거",
                   "폐기물처리",
                   "원상복구",
                   "모두철거"
                   ];

var eTypes = [["0","가전/가구 매입"],
                  ["1","다량 매입"],
                  ["2","철거/원상복구"]];

var states = [["0","견적 대기중"],
              ["1","견적중"],
              ["2","견적선택중"],
              ["3","견적선택됨"],
              ["4","수거중"],
              ["5","수거완료"]];

var bankTypes = [["농협","302-1237-9285-41"]];

function cfnBizTypesCombo(defaultValue)
{
	
	var vHtml ="";
	if(defaultValue)
	{
		vHtml +="<option value=''>"+defaultValue+"</option>";
	}
	
	for(var i=0; i<bizTypes.length; i++)
	{
		vHtml +="<option value='"+bizTypes[i][0]+"'>"+bizTypes[i][1]+"</option>";
	}
	
	return vHtml;
}

function cfnBizTypesOnlyOne(compId, val)
{
	$("#"+compId).html("");
	var vHtml ="";
	vHtml +="<div class='row'>";
	for(var i=0; i<bizTypes.length; i++)
	{
		var checked = "";
		if(val == bizTypes[i][0])
		{
			vHtml +="<div class='col-lg-4'>";
			vHtml +="<input type='radio' class='css-input-radio' name='biztype' id='biztype"+i+"' value='"+bizTypes[i][0]+"' checked/>";
			vHtml +="<label for='biztype"+i+"' class='css-input-radio-label'>"+bizTypes[i][1]+"</label>";
			vHtml +="</div>";
		}
	}
	vHtml +="</div>	";

	$("#"+compId).html(vHtml);	
}
	
function cfnBizTypes(compId, val)
{
	$("#"+compId).html("");
	var vHtml ="";
	for(var i=0; i<bizTypes.length; i++)
	{
		var checked = "";
		if(val == bizTypes[i][0])
		{
			checked = "current";
		}
		vHtml +="<li class='"+checked+" col-xs-4'>";
		vHtml +="<a href='../customer/partnerSignup.do?biztype="+bizTypes[i][0]+"'>";
		vHtml +=bizTypes[i][1];
		vHtml +="</a>";
		vHtml +="</li>";
	}

	$("#"+compId).html(vHtml);	
}

function cfnGetBizTypes(val)
{
	var rtn = "";
	for(var i=0; i<bizTypes.length; i++)
	{
		if(val == bizTypes[i][0])
		{
			rtn = bizTypes[i][1];
			break;
		}
	}
	
	return rtn;
}


function cfnBizTypeLength()
{
	return bizTypes.length;
}

function cfnGoodsItem(compId, val, yearVal)
{
	var arrVal = val.split(",");
	var arrYearVal = yearVal.split(",");
	$("#"+compId).html("");
	var vHtml ="";
	//var vHtml1 ="";
	for(var i=0; i<goodsItems.length; i++)
	{
		vHtml  +="<div class='col-md-"+goodsItems[i][0]+"'>";
		vHtml  +="<div class='row'>";

		var checked = "";
		var idx = arrVal.indexOf(goodsItems[i][1]);
		var yearValue = "";

		if(idx >= 0)
		{
			checked = "checked";
		}

		vHtml  +="<div class='col-xs-8 col-md-12'>";
		vHtml  +="<input type='checkbox' class='css-input-radio-checkbox' name='goodsItem' id='goodsItem"+i+"' value='"+goodsItems[i][1]+"'"+checked+"/>";
		vHtml  +="<label for='goodsItem"+i+"' class='css-input-radio-checkbox-label'>"+goodsItems[i][1]+"</label>";
		vHtml  +="</div>";
		
		vHtml  +="<div class='col-xs-8 col-md-12'>";
		if(idx >= 0)
		{
			yearValue = arrYearVal[idx];
			vHtml +="<select  class='input_default' id='goodsYear"+i+"'>";
		}else{
			vHtml +="<select  class='input_default' id='goodsYear"+i+"' style='display:none;'>";
		}
		for(var j=0; j<goodsYears.length; j++)
		{
			var optionSelect = "";
			if(goodsYears[j][0] == yearValue)
			{
				optionSelect = "selected";
			}
			vHtml +="<option value='"+goodsYears[j][0]+"' "+optionSelect+">"+goodsYears[j][1]+"</option>";
		}
		vHtml +="</select>";
		vHtml  +="</div>";
		
		vHtml  +="</div>";
		vHtml  +="</div>";
	}
	$("#"+compId).html(vHtml);
	

}

function cfnGoodsItemLength()
{
	return goodsItems.length;
}

function cfnGetGoodsItem()
{
	return goodsItems;
}

function cfnRemoveItem(compId, val, removeEtc)
{
	var arrVal = val.split(",");
	
	$("#"+compId).html("");
	var vHtml ="";
	vHtml +="<ul class='row list'>";
	for(var i=0; i<removeItems.length; i++)
	{
		var checked = "";
		if(arrVal.indexOf(removeItems[i]) >= 0)
		{
			checked = "checked";
		}
		vHtml +="<li class='col-xs-3 col-md-2'>";
		vHtml +="<input type='checkbox' class='css-input-radio-checkbox' name='removeItem' id='removeItem"+i+"' value='"+removeItems[i]+"'"+checked+"/>";
		vHtml +="<label for='removeItem"+i+"' class='css-input-radio-checkbox-label'>"+removeItems[i]+"</label>";
		vHtml +="</li>";
	}
	vHtml +="</ul>";
	var checked = "";
	var vHtml1 = "";
	if(arrVal.indexOf("기타") >= 0)
	{
		checked = "checked";
		vHtml1 = "<input type='text' class='input_default' id='removeEtc' aria-describedby='기타입력' placeholder='기타입력' value='"+removeEtc+"'>";
	}else{
		vHtml1 = "<input type='text' class='input_default' id='removeEtc' aria-describedby='기타입력' placeholder='기타입력' value='"+removeEtc+"' style='display:none;'>";
	}	
	vHtml +="<ul class='row list'>";
	vHtml +="<li class='col-xs-3 col-md-2'>";
	vHtml +="<input type='checkbox' class='css-input-radio-checkbox' name='removeItem' id='removeItem"+removeItems.length+"' value='기타'"+checked+"/>";
	vHtml +="<label for='removeItem"+i+"' class='css-input-radio-checkbox-label'>기타</label>";
	vHtml +="</li>";
	vHtml +="<li class='col-xs-9 col-md-10'>";
	vHtml +=vHtml1;
	vHtml +="</li>";
	vHtml +="</ul>";
	$("#"+compId).html(vHtml);	
	
	
}

function cfnGetRemoveItem()
{
	return removeItems;
}

function cfnRemoveItemLength()
{
	return removeItems.length;
}

function cfnETypesCombo(defaultValue)
{
	
	var vHtml ="";
	if(defaultValue)
	{
		vHtml +="<option value=''>"+defaultValue+"</option>";
	}
	
	for(var i=0; i<eTypes.length; i++)
	{
		vHtml +="<option value='"+eTypes[i][0]+"'>"+eTypes[i][1]+"</option>";
	}
	
	return vHtml;
}

function cfnGetETypes(val)
{
	var rtn = "";
	for(var i=0; i<eTypes.length; i++)
	{
		if(val == eTypes[i][0])
		{
			rtn = eTypes[i][1];
			break;
		}
	}
	
	return rtn;
}

function cfnStatesCombo(defaultValue)
{
	
	var vHtml ="";
	if(defaultValue)
	{
		vHtml +="<option value=''>"+defaultValue+"</option>";
	}
	
	for(var i=0; i<states.length; i++)
	{
		vHtml +="<option value='"+states[i][0]+"'>"+states[i][1]+"</option>";
	}
	
	return vHtml;
}

function cfnGetStates(val)
{
	var rtn = "";
	for(var i=0; i<states.length; i++)
	{
		if(val == states[i][0])
		{
			rtn = states[i][1];
			break;
		}
	}
	
	return rtn;
}

function cfnYearsCombo(defaultValue)
{
	
	var vHtml ="";
	if(defaultValue)
	{
		vHtml +="<option value=''>"+defaultValue+"</option>";
	}
	
	for(var i=0; i<years.length; i++)
	{
		vHtml +="<option value='"+years[i][0]+"'>"+years[i][1]+"</option>";
	}
	
	return vHtml;
}

function cfnEstimateYearsCombo(defaultValue)
{
	var now = new Date();

	var nYear = now.getFullYear();
	var vHtml ="";
	if(defaultValue)
	{
		vHtml +="<option value=''>"+defaultValue+"</option>";
	}
	
	for(var i=0; i<20; i++)
	{
		vHtml +="<option value='"+(i+1)+"'>"+(nYear-i)+"년</option>";
	}
	
	return vHtml;
}

function cfnBankTypesCombo()
{
	var vHtml ="";
	vHtml +="<option value='' selected>선택</option>";
	
	for(var i=0; i<bankTypes.length; i++)
	{
		vHtml +="<option value='"+bankTypes[i][0]+"'>"+bankTypes[i][0]+"</option>";
	}
	
	return vHtml;	
}

function cfnBankTypesBank(bankName)
{
	var vAccount = "";
	if(!bankName) return "";
	for(var i=0; i<bankTypes.length; i++)
	{
		if(bankTypes[i][0] == bankName){
			vAccount = bankTypes[i][1];
			break;
		}
	}	
	
	return vAccount;
}
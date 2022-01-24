var dateFormat = "yy-mm-dd";
function getDateAsValue( val) {
	var date;
	try {
		date = $.datepicker.parseDate( dateFormat, val );
	} catch( error ) {
		date = null;
	}
	return date;
}

function getToDay()
{
	var now = new Date();

	var sYear   = now.getFullYear();
	
	var sMonth   = now.getMonth()+1;
	if(sMonth < 10) sMonth = "0"+sMonth
	
	var sDate   = now.getDate();
	if(sDate < 10) sDate = "0"+sDate

	return sYear+"-"+sMonth+"-"+sDate;
}
function _strEType(e_type) {
	if(e_type==0) {
		return '가전/가구 매입';
	} else if(e_type==1){
		return '다량 매입';
	} else if(e_type==2){
		return '철거/원상복구';
	} else if(e_type==3){
		return '가전/가구 케어 서비스';
	} else if(e_type==4){
		return '중고 A/S수리';
	} else if(e_type==5){
		return '우리동네 재활용 마켓';
	}
}

function _getNickname(name){
	if(name){            
		const s0 = name.charAt(0);
		return s0+"**";                      
	}        
}

function _setPhoto(photo, e_type) {          
	if(photo) {
		return '../common/file/imageDownload.do?fileNewName='+photo;
	} else {
		if(e_type==2){
			return '../images/review/blank_destory.jpg';
		} else{
			return '../images/review/blank_bulk.jpg';
		}            
	}
}

function _setPhotoSite(photoSite) {          
	if(photoSite) {
		return '../common/file/imageDownload.do?fileNewName='+photoSite;
	} else {
		return '../images/center/center_empty.png';
	}
}

//1:견적중, 2:견적선택중, 3:견적선택됨, 4:수거중, 5:수거완료, 6:견적취소
function _strState(state) {
	if(state==0){
		return '견적 대기중';
	} else if(state==1) {
		return '견적중';          
	} else if(state==2) {
		return '견적선택중';
	} else if(state==3) {
		return '견적선택됨';
	} else if(state==4) {
		return '수거중';
	} else if(state==5) {
		return '수거완료';
	} else if(state==6) { 
		return '견적취소';
	} else if(state==7) {
		return '견적마감';
	}
}

function _getTitle(title){
	if(title.length > 20)
	{
		return title.substr(0,20)+"...";
	}
	
	return title;
}

function _getTitleReview(title){
	if(title.length > 10)
	{
		return title.substr(0,10)+"...";
	}
	
	return title;
}

//1:견적중, 2:견적선택중, 3:견적선택됨, 4:수거중, 5:수거완료, 6:견적취소
function _strProcess(state) {
	if(state==0){
		return 'process';
	} else if(state==1) {
		return 'process';          
	} else if(state==2) {
		return 'process';
	} else if(state==3) {
		return 'process';
	} else if(state==4) {
		return 'process';
	} else if(state==5) {
		return 'success';
	} else {
		return 'process';
	}
}

function _getDate(date){
	if(date){            
		return date.substr(2,8);                      
	} 	
}
function _getArea(area){
	if(area.length > 15)
	{
		var rtn = area.substr(0,15)+"...";
		return rtn;
	}
	
	return area;
}

function _getReview(idx, review){
	if(review.length > 35)
	{
		var rtn = review.substr(0,35)+"...";
		rtn += "<span><a href='#here' onClick='doClickReview(\""+idx+"\")'>더보기</a></span>";
		return rtn;
	}
	
	return review;
}
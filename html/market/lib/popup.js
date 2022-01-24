function setCookie( name, value, expiredays ){
	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}

function closeWin(fname, value){
	if ( document.forms[fname].popup_end.checked ) {
		setCookie(value, 'NO', 1 );//쿠기 저장 기간은 1일로 한다.
	}
	hideMe(value);
}

function closeWinm(fname, name, value){
	if ( document.forms[fname].popup_end.checked ) {
		setCookie(value, 'NO', 1 );//쿠기 저장 기간은 1일로 한다.
	}
	hideMe(name);
}

function closeWinyear(fname, value){
	if ( document.forms[fname].popup_end.checked ) {
		setCookie(value, 'NO', 365 );//쿠기 저장 기간은 1일로 한다.
	}
	hideMe(value);
}
function closeWinyearm(fname, name, value){
	if ( document.forms[fname].popup_end.checked ) {
		setCookie(value, 'NO', 365 );//쿠기 저장 기간은 1일로 한다.
	}
	hideMe(name);
}

function closeGo(url){
	location.href=url;
}

//팝업
function hideMe(value) {
	document.getElementById(value).style.display = "none";
}


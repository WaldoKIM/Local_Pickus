var fontObj ;
var nowFontSz = 11 ; // 위의 CSS prtArt와 같은 사이즈로...
function fontSz(){
	if (document.getElementById) fontObj = document.getElementById("fontSzArea").style ;
	else if (document.all) fontObj = document.all("fontSzArea").style ;
	
	if (arguments[0] == "-"){
		if (nowFontSz <= 9) return ;
		fontObj.fontSize = (nowFontSz-1) + "pt" ;
		nowFontSz = eval(nowFontSz-1) ;
	}else if (arguments[0] == "+"){
		if (nowFontSz >= 14) return ;
		fontObj.fontSize = (nowFontSz+1) + "pt" ;
		nowFontSz = eval(nowFontSz+1) ;
	}
}

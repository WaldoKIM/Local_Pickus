var jsReady = false;
var ubIsReady = false;

function isReady() {
	return jsReady;
}
function pageInit() {
	jsReady = true;
}
function ubIsReadySet(){
	ubIsReady = true;
}
function strHelp(strVar){
	na_open_window('win', strVar, 0, 0, 640, 600, 0, 0, 0, 1, 0);
}
function gooolim() {
	window.open("http://www.oolim.net", "", "");
}
function goURL(varURL) {
	location.href=varURL;
}
function swfRunner(varUrl, varID, varWidth, varHeight)
{
	document.write('<object id="'+varID+'" width="'+varWidth+'" height="'+varHeight+'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"');
	document.write('codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">');
	document.write('<param name="movie" value="'+ varUrl +'" />');
	document.write('<param name="quality" value="high" />');
	document.write('<param name="bgcolor" value="#ffffff" />');
	document.write('<param name="allowScriptAccess" value="Always" />');
	document.write('<param name="wmode" value="transparent" />');
	document.write('<embed name="'+varID+'" src="'+varUrl+'" quality="high" bgcolor="#ffffff"');
	document.write('width="'+varWidth+'" height="'+varHeight+'" align="middle"');
	document.write('play="true" loop="false" quality="high"');
	document.write('allowScriptAccess="Always"');
	document.write('type="application/x-shockwave-flash"');
	document.write('pluginspage="http://www.adobe.com/go/getflashplayer">');
	document.write('</embed>');
	document.write('</object>');
}

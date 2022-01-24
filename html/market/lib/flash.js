function MakeFlash(Url,Width,Height,img){ 
//	var aaa="<param name=\"flashVars\" value=\"img="+img+"\">";
//	alert(aaa);
  document.writeln("<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"" + Width + "\" height=\"" + Height + "\">"); 
  document.writeln("<param name=\"movie\" value=\"" + Url + "\">"); 
  document.writeln("<param name=\"quality\" value=\"high\" />");     
  document.writeln("<param name=\"wmode\" value=\"transparent\">"); 
  document.writeln("<param name=\"flashVars\" value=\"img="+img+"\">");
  document.writeln("<embed src=\"" + Url + "\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"" + Width + "\"  height=\"" + Height + "\">"); 
  document.writeln("</object>");  
 
} 

function MakeFlash1(Url,Width,Height){                 
  document.writeln("<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"" + Width + "\" height=\"" + Height + "\">"); 
  document.writeln("<param name=\"movie\" value=\"" + Url + "\">"); 
  document.writeln("<param name=\"quality\" value=\"high\" />");     
  document.writeln("<param name=\"wmode\" value=\"transparent\">"); 
  document.writeln("<embed src=\"" + Url + "\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"" + Width + "\"  height=\"" + Height + "\">"); 
  document.writeln("</object>");   
} 

function MakeFlash3(Url,Width,Height,bestImg,bestUrl,hometxt){ 
//	var aaa="<param name=\"flashVars\" value=\"img="+img+"\">";
//	alert(aaa);
  document.writeln("<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"" + Width + "\" height=\"" + Height + "\">"); 
  document.writeln("<param name=\"movie\" value=\"" + Url + "\">"); 
  document.writeln("<param name=\"quality\" value=\"high\" />");     
  document.writeln("<param name=\"wmode\" value=\"transparent\">"); 
  document.writeln("<param name=\"flashVars\" value=\"bestimg="+bestImg+"&besturl="+bestUrl+"&hometxt="+hometxt+"\">");
  document.writeln("<embed src=\"" + Url + "\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"" + Width + "\"  height=\"" + Height + "\">");
  document.writeln("</object>");  
 
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
	document.write('<embed name="'+varID+'" src="'+ varUrl +'" quality="high" bgcolor="#ffffff"');
	document.write('width="'+varWidth+'" height="'+varHeight+'" align="middle"');
	document.write('play="true"	loop="false" quality="high"');
	document.write('allowScriptAccess="Always"');
	document.write('type="application/x-shockwave-flash"');
	document.write('pluginspage="http://www.adobe.com/go/getflashplayer">');
	document.write('</embed>');
	document.write('</object>');
}

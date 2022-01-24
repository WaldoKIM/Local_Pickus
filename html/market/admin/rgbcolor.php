<? 
$value = $_GET['value'];
?>
<html>
<head>
<title>Pension RGB색상표</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<LINK REL="stylesheet" HREF="css/admin_style.css" TYPE="TEXT/CSS">
</head>
<script type="text/javascript" src="../lib/jquery-1.8.3.min.js"></script>
<script>
	$(document).ready(function () {
		$('td').css('cursor','pointer');
		$('td').on('click',function(){
			parent.document.all.<?=$value?>.value=$( this ).text();
			<?if($_GET[value]!="footerbg_color"){?>
			parent.$.RiModal.get('self').close();
			<?}else{?>
			alert('코드 입력되었습니다. 색상선택창을 닫으신 후 등록하여 주세요.');
			<?}?>
		});
	});   
  </script>
<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red">
<div class='date'>※ 총 216개 칼라값이 등록되어 있습니다.</div>
<TABLE cellSpacing=2>
<TR>
<TD align=middle width=90 bgColor=#000000 height=15 class='date'><font color="white">000000</font></TD>
<TD align=middle width=90 bgColor=#333333 height=15 class='date'><font color="white">333333</font></TD>
<TD align=middle width=90 bgColor=#666666 height=15 class='date'><font color="white">666666</font></TD>
<TD align=middle width=90 bgColor=#999999 height=15 class='date'><font color="white">999999</font></TD>
<TD align=middle width=90 bgColor=#cccccc height=15 class='date'>CCCCCC</TD>
<TD align=middle width=90 bgColor=#ffffff height=15 class='date'>FFFFFF</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#000033 height=15 class='date'><font color="white">000033</font></TD>
<TD align=middle width=90 bgColor=#333300 height=15 class='date'><font color="white">333300</font></TD>
<TD align=middle width=90 bgColor=#666600 height=15 class='date'><font color="white">666600</font></TD>
<TD align=middle width=90 bgColor=#999900 height=15 class='date'><font color="white">999900</font></TD>
<TD align=middle width=90 bgColor=#cccc00 height=15 class='date'>CCCC00</TD>
<TD align=middle width=90 bgColor=#ffff00 height=15 class='date'>FFFF00</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#000066 height=15 class='date'><font color="white">000066</font></TD>
<TD align=middle width=90 bgColor=#333366 height=15 class='date'><font color="white">333366</font></TD>
<TD align=middle width=90 bgColor=#666633 height=15 class='date'><font color="white">666633</font></TD>
<TD align=middle width=90 bgColor=#999933 height=15 class='date'><font color="white">999933</font></TD>
<TD align=middle width=90 bgColor=#cccc33 height=15 class='date'>CCCC33</TD>
<TD align=middle width=90 bgColor=#ffff33 height=15 class='date'>FFFF33</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#000099 height=15 class='date'><font color="white">000099</font></TD>
<TD align=middle width=90 bgColor=#333399 height=15 class='date'><font color="white">333399</font></TD>
<TD align=middle width=90 bgColor=#666699 height=15 class='date'><font color="white">666699</font></TD>
<TD align=middle width=90 bgColor=#999966 height=15 class='date'><font color="white">999966</font></TD>
<TD align=middle width=90 bgColor=#cccc66 height=15 class='date'>CCCC66</TD>
<TD align=middle width=90 bgColor=#ffff66 height=15 class='date'>FFFF66</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#0000cc height=15 class='date'><font color="white">0000CC</font></TD>
<TD align=middle width=90 bgColor=#3333cc height=15 class='date'><font color="white">3333CC</font></TD>
<TD align=middle width=90 bgColor=#6666cc height=15 class='date'><font color="white">6666CC</font></TD>
<TD align=middle width=90 bgColor=#9999cc height=15 class='date'><font color="white">9999CC</font></TD>
<TD align=middle width=90 bgColor=#cccc99 height=15 class='date'>CCCC99</TD>
<TD align=middle width=90 bgColor=#ffff99 height=15 class='date'>FFFF99</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#0000ff height=15 class='date'><font color="white">0000FF</font></TD>
<TD align=middle width=90 bgColor=#3333ff height=15 class='date'><font color="white">3333FF</font></TD>
<TD align=middle width=90 bgColor=#6666ff height=15 class='date'><font color="white">6666FF</font></TD>
<TD align=middle width=90 bgColor=#9999ff height=15 class='date'><font color="white">9999FF</font></TD>
<TD align=middle width=90 bgColor=#ccccff height=15 class='date'>CCCCFF</TD>
<TD align=middle width=90 bgColor=#ffffcc height=15 class='date'>FFFFCC</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#003300 height=15 class='date'><font color="white">003300</font></TD>
<TD align=middle width=90 bgColor=#336633 height=15 class='date'><font color="white">336633<BR></font></TD>
<TD align=middle width=90 bgColor=#669966 height=15 class='date'><font color="white">669966</font></TD>
<TD align=middle width=90 bgColor=#99cc99 height=15 class='date'>99CC99</TD>
<TD align=middle width=90 bgColor=#ccffcc height=15 class='date'>CCFFCC</TD>
<TD align=middle width=90 bgColor=#ff00ff height=15 class='date'><font color="white">FF00FF</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#006600 height=15 class='date'><font color="white">006600</font></TD>
<TD align=middle width=90 bgColor=#339933 height=15 class='date'><font color="white">339933</font></TD>
<TD align=middle width=90 bgColor=#66cc66 height=15 class='date'>66CC66</TD>
<TD align=middle width=90 bgColor=#99ff99 height=15 class='date'>99FF99</TD>
<TD align=middle width=90 bgColor=#cc00cc height=15 class='date'><font color="white">CC00CC</font></TD>
<TD align=middle width=90 bgColor=#ff33ff height=15 class='date'><font color="white">FF33FF</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#009900 height=15 class='date'><font color="white">009900</font></TD>
<TD align=middle width=90 bgColor=#33cc33 height=15 class='date'>33CC33</TD>
<TD align=middle width=90 bgColor=#66ff66 height=15 class='date'>66FF66</TD>
<TD align=middle width=90 bgColor=#990099 height=15 class='date'><font color="white">990099</font></TD>
<TD align=middle width=90 bgColor=#cc33cc height=15 class='date'><font color="white">CC33CC</font></TD>
<TD align=middle width=90 bgColor=#ff66ff height=15 class='date'><font color="white">FF66FF</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#00cc00 height=15 class='date'>00CC00</TD>
<TD align=middle width=90 bgColor=#33ff33 height=15 class='date'>33FF33</TD>
<TD align=middle width=90 bgColor=#660066 height=15 class='date'><font color="white">660066</font></TD>
<TD align=middle width=90 bgColor=#993399 height=15 class='date'><font color="white">993399</font></TD>
<TD align=middle width=90 bgColor=#cc66cc height=15 class='date'><font color="white">CC66CC</font></TD>
<TD align=middle width=90 bgColor=#ff99ff height=15 class='date'>FF99FF</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#00ff00 height=15 class='date'>00FF00</TD>
<TD align=middle width=90 bgColor=#330033 height=15 class='date'><font color="white">330033</font></TD>
<TD align=middle width=90 bgColor=#663366 height=15 class='date'><font color="white">663366</font></TD>
<TD align=middle width=90 bgColor=#996699 height=15 class='date'><font color="white">996699</font></TD>
<TD align=middle width=90 bgColor=#cc99cc height=15 class='date'><font color="white">CC99CC</font></TD>
<TD align=middle width=90 bgColor=#ffccff height=15 class='date'>FFCCFF</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#00ff33 height=15 class='date'>00FF33</TD>
<TD align=middle width=90 bgColor=#330066 height=15 class='date'><font color="white">330066</font></TD>
<TD align=middle width=90 bgColor=#663399 height=15 class='date'><font color="white">663399</font></TD>
<TD align=middle width=90 bgColor=#9966cc height=15 class='date'><font color="white">9966CC</font></TD>
<TD align=middle width=90 bgColor=#cc99ff height=15 class='date'><font color="white">CC99FF</font></TD>
<TD align=middle width=90 bgColor=#ffcc00 height=15 class='date'>FFCC00</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#00ff66 height=15 class='date'>00FF66</TD>
<TD align=middle width=90 bgColor=#330099 height=15 class='date'><font color="white">330099</font></TD>
<TD align=middle width=90 bgColor=#6633cc height=15 class='date'><font color="white">6633CC</font></TD>
<TD align=middle width=90 bgColor=#9966ff height=15 class='date'><font color="white">9966FF</font></TD>
<TD align=middle width=90 bgColor=#cc9900 height=15 class='date'><font color="white">CC9900</font></TD>
<TD align=middle width=90 bgColor=#ffcc33 height=15 class='date'>FFCC33</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#00ff99 height=15 class='date'>00FF99</TD>
<TD align=middle width=90 bgColor=#3300cc height=15 class='date'><font color="white">3300CC</font></TD>
<TD align=middle width=90 bgColor=#6633ff height=15 class='date'><font color="white">6633FF</font></TD>
<TD align=middle width=90 bgColor=#996600 height=15 class='date'><font color="white">996600</font></TD>
<TD align=middle width=90 bgColor=#cc9933 height=15 class='date'><font color="white">CC9933</font></TD>
<TD align=middle width=90 bgColor=#ffcc66 height=15 class='date'>FFCC66</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#00ffcc height=15 class='date'>00FFCC</TD>
<TD align=middle width=90 bgColor=#3300ff height=15 class='date'><font color="white">3300FF</font></TD>
<TD align=middle width=90 bgColor=#663300 height=15 class='date'><font color="white">663300</font></TD>
<TD align=middle width=90 bgColor=#996633 height=15 class='date'><font color="white">996633</font></TD>
<TD align=middle width=90 bgColor=#cc9966 height=15 class='date'><font color="white">CC9966</font></TD>
<TD align=middle width=90 bgColor=#ffcc99 height=15 class='date'>FFCC99</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#00ffff height=15 class='date'>00FFFF</TD>
<TD align=middle width=90 bgColor=#330000 height=15 class='date'><font color="white">330000</font></TD>
<TD align=middle width=90 bgColor=#663333 height=15 class='date'><font color="white">663333</font></TD>
<TD align=middle width=90 bgColor=#996666 height=15 class='date'><font color="white">996666</font></TD>
<TD align=middle width=90 bgColor=#cc9999 height=15 class='date'><font color="white">CC9999</font></TD>
<TD align=middle width=90 bgColor=#ffcccc height=15 class='date'>FFCCCC</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#00cccc height=15 class='date'>00CCCC</TD>
<TD align=middle width=90 bgColor=#33ffff height=15 class='date'>33FFFF</TD>
<TD align=middle width=90 bgColor=#660000 height=15 class='date'><font color="white">660000</font></TD>
<TD align=middle width=90 bgColor=#993333 height=15 class='date'><font color="white">993333</font></TD>
<TD align=middle width=90 bgColor=#cc6666 height=15 class='date'><font color="white">CC6666</font></TD>
<TD align=middle width=90 bgColor=#ff9999 height=15 class='date'>FF9999</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#009999 height=15 class='date'><font color="white">009999</font></TD>
<TD align=middle width=90 bgColor=#33cccc height=15 class='date'>33CCCC</TD>
<TD align=middle width=90 bgColor=#66ffff height=15 class='date'>66FFFF </TD>
<TD align=middle width=90 bgColor=#990000 height=15 class='date'><font color="white">990000 
</font></TD>
<TD align=middle width=90 bgColor=#cc3333 height=15 class='date'><font color="white">CC3333</font></TD>
<TD align=middle width=90 bgColor=#ff6666 height=15 class='date'><font color="white">FF6666</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#006666 height=15 class='date'><font color="white">006666</font></TD>
<TD align=middle width=90 bgColor=#339999 height=15 class='date'><font color="white">339999</font></TD>
<TD align=middle width=90 bgColor=#66cccc height=15 class='date'>66CCCC</TD>
<TD align=middle width=90 bgColor=#99ffff height=15 class='date'>99FFFF</TD>
<TD align=middle width=90 bgColor=#cc0000 height=15 class='date'><font color="white">CC0000</font></TD>
<TD align=middle width=90 bgColor=#ff3333 height=15 class='date'><font color="white">FF3333</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#003333 height=15 class='date'><font color="white">003333</font></TD>
<TD align=middle width=90 bgColor=#336666 height=15 class='date'><font color="white">336666</font></TD>
<TD align=middle width=90 bgColor=#669999 height=15 class='date'><font color="white">669999</font></TD>
<TD align=middle width=90 bgColor=#99cccc height=15 class='date'>99CCCC</TD>
<TD align=middle width=90 bgColor=#ccffff height=15 class='date'>CCFFFF</TD>
<TD align=middle width=90 bgColor=#ff0000 height=15 class='date'><font color="white">FF0000</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#003366 height=15 class='date'><font color="white">003366</font></TD>
<TD align=middle width=90 bgColor=#336699 height=15 class='date'><font color="white">336699</font></TD>
<TD align=middle width=90 bgColor=#6699cc height=15 class='date'><font color="white">6699CC</font></TD>
<TD align=middle width=90 bgColor=#99ccff height=15 class='date'>99CCFF</TD>
<TD align=middle width=90 bgColor=#ccff00 height=15 class='date'>CCFF00</TD>
<TD align=middle width=90 bgColor=#ff0033 height=15 class='date'><font color="white">FF0033</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#003399 height=15 class='date'><font color="white">003399</font></TD>
<TD align=middle width=90 bgColor=#3366cc height=15 class='date'><font color="white">3366CC</font></TD>
<TD align=middle width=90 bgColor=#6699ff height=15 class='date'><font color="white">6699FF</font></TD>
<TD align=middle width=90 bgColor=#99cc00 height=15 class='date'>99CC00</TD>
<TD align=middle width=90 bgColor=#ccff33 height=15 class='date'>CCFF33</TD>
<TD align=middle width=90 bgColor=#ff0066 height=15 class='date'><font color="white">FF0066</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#0033cc height=15 class='date'><font color="white">0033CC</font></TD>
<TD align=middle width=90 bgColor=#3366ff height=15 class='date'><font color="white">3366FF</font></TD>
<TD align=middle width=90 bgColor=#669900 height=15 class='date'><font color="white">669900</font></TD>
<TD align=middle width=90 bgColor=#99cc33 height=15 class='date'><font color="white">99CC33</font></TD>
<TD align=middle width=90 bgColor=#ccff66 height=15 class='date'>CCFF66</TD>
<TD align=middle width=90 bgColor=#ff0099 height=15 class='date'><font color="white">FF0099</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#0033ff height=15 class='date'><font color="white">0033FF</font></TD>
<TD align=middle width=90 bgColor=#336600 height=15 class='date'><font color="white">336600</font></TD>
<TD align=middle width=90 bgColor=#669933 height=15 class='date'><font color="white">669933</font></TD>
<TD align=middle width=90 bgColor=#99cc66 height=15 class='date'><font color="white">99CC66</font></TD>
<TD align=middle width=90 bgColor=#ccff99 height=15 class='date'>CCFF99</TD>
<TD align=middle width=90 bgColor=#ff00cc height=15 class='date'><font color="white">FF00CC</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#0066ff height=15 class='date'><font color="white">0066FF</font></TD>
<TD align=middle width=90 bgColor=#339900 height=15 class='date'><font color="white">339900</font></TD>
<TD align=middle width=90 bgColor=#66cc33 height=15 class='date'>66CC33</TD>
<TD align=middle width=90 bgColor=#99ff66 height=15 class='date'>99FF66</TD>
<TD align=middle width=90 bgColor=#cc0099 height=15 class='date'><font color="white">CC0099</font></TD>
<TD align=middle width=90 bgColor=#ff33cc height=15 class='date'><font color="white">FF33CC</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#0099ff height=15 class='date'><font color="white">0099FF</font></TD>
<TD align=middle width=90 bgColor=#33cc00 height=15 class='date'>33CC00</TD>
<TD align=middle width=90 bgColor=#66ff33 height=15 class='date'>66FF33</TD>
<TD align=middle width=90 bgColor=#990066 height=15 class='date'><font color="white">990066</font></TD>
<TD align=middle width=90 bgColor=#cc3399 height=15 class='date'><font color="white">CC3399</font></TD>
<TD align=middle width=90 bgColor=#ff66cc height=15 class='date'><font color="white">FF66CC</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#00ccff height=15 class='date'>00CCFF</TD>
<TD align=middle width=90 bgColor=#33ff00 height=15 class='date'>33FF00</TD>
<TD align=middle width=90 bgColor=#660033 height=15 class='date'><font color="white">660033</font></TD>
<TD align=middle width=90 bgColor=#993366 height=15 class='date'><font color="white">993366</font></TD>
<TD align=middle width=90 bgColor=#cc6699 height=15 class='date'><font color="white">CC6699</font></TD>
<TD align=middle width=90 bgColor=#ff99cc height=15 class='date'>FF99CC</TD></TR>
<TR>
<TD align=middle width=90 bgColor=#00cc33 height=15 class='date'>00CC33</TD>
<TD align=middle width=90 bgColor=#33ff66 height=15 class='date'>33FF66</TD>
<TD align=middle width=90 bgColor=#660099 height=15 class='date'><font color="white">660099</font></TD>
<TD align=middle width=90 bgColor=#9933cc height=15 class='date'><font color="white">9933CC</font></TD>
<TD align=middle width=90 bgColor=#cc66ff height=15 class='date'><font color="white">CC66FF</font></TD>
<TD align=middle width=90 bgColor=#ff9900 height=15 class='date'><font color="white">FF9900</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#00cc66 height=15 class='date'>00CC66</TD>
<TD align=middle width=90 bgColor=#33ff99 height=15 class='date'>33FF99</TD>
<TD align=middle width=90 bgColor=#6600cc height=15 class='date'><font color="white">6600CC</font></TD>
<TD align=middle width=90 bgColor=#9933ff height=15 class='date'><font color="white">9933FF</font></TD>
<TD align=middle width=90 bgColor=#cc6600 height=15 class='date'><font color="white">CC6600</font></TD>
<TD align=middle width=90 bgColor=#ff9933 height=15 class='date'><font color="white">FF9933</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#00cc99 height=15 class='date'>00CC99</TD>
<TD align=middle width=90 bgColor=#33ffcc height=15 class='date'>33FFCC</TD>
<TD align=middle width=90 bgColor=#6600ff height=15 class='date'><font color="white">6600FF</font></TD>
<TD align=middle width=90 bgColor=#993300 height=15 class='date'><font color="white">993300</font></TD>
<TD align=middle width=90 bgColor=#cc6633 height=15 class='date'><font color="white">CC6633</font></TD>
<TD align=middle width=90 bgColor=#ff9966 height=15 class='date'><font color="white">FF9966</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#009933 height=15 class='date'><font color="white">009933</font></TD>
<TD align=middle width=90 bgColor=#33cc66 height=15 class='date'>33CC66</TD>
<TD align=middle width=90 bgColor=#66ff99 height=15 class='date'>66FF99</TD>
<TD align=middle width=90 bgColor=#9900cc height=15 class='date'><font color="white">9900CC</font></TD>
<TD align=middle width=90 bgColor=#cc33ff height=15 class='date'><font color="white">CC33FF</font></TD>
<TD align=middle width=90 bgColor=#ff6600 height=15 class='date'><font color="white">FF6600</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#006633 height=15 class='date'><font color="white">006633</font></TD>
<TD align=middle width=90 bgColor=#339966 height=15 class='date'><font color="white">339966</font></TD>
<TD align=middle width=90 bgColor=#66cc99 height=15 class='date'>66CC99</TD>
<TD align=middle width=90 bgColor=#99ffcc height=15 class='date'>99FFCC</TD>
<TD align=middle width=90 bgColor=#cc00ff height=15 class='date'><font color="white">CC00FF</font></TD>
<TD align=middle width=90 bgColor=#ff3300 height=15 class='date'><font color="white">FF3300</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#009966 height=15 class='date'><font color="white">009966</font></TD>
<TD align=middle width=90 bgColor=#33cc99 height=15 class='date'>33CC99</TD>
<TD align=middle width=90 bgColor=#66ffcc height=15 class='date'>66FFCC</TD>
<TD align=middle width=90 bgColor=#9900ff height=15 class='date'><font color="white">9900FF</font></TD>
<TD align=middle width=90 bgColor=#cc3300 height=15 class='date'><font color="white">CC3300</font></TD>
<TD align=middle width=90 bgColor=#ff6633 height=15 class='date'><font color="white">FF6633</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#0099cc height=15 class='date'><font color="white">0099CC</font></TD>
<TD align=middle width=90 bgColor=#33ccff height=15 class='date'>33CCFF</TD>
<TD align=middle width=90 bgColor=#66ff00 height=15 class='date'>66FF00</TD>
<TD align=middle width=90 bgColor=#990033 height=15 class='date'><font color="white">990033</font></TD>
<TD align=middle width=90 bgColor=#cc3366 height=15 class='date'><font color="white">CC3366</font></TD>
<TD align=middle width=90 bgColor=#ff6699 height=15 class='date'><font color="white">FF6699</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#0066cc height=15 class='date'><font color="white">0066CC</font></TD>
<TD align=middle width=90 bgColor=#3399ff height=15 class='date'><font color="white">3399FF</font></TD>
<TD align=middle width=90 bgColor=#66cc00 height=15 class='date'>66CC00</TD>
<TD align=middle width=90 bgColor=#99ff33 height=15 class='date'>99FF33</TD>
<TD align=middle width=90 bgColor=#cc0066 height=15 class='date'><font color="white">CC0066</font></TD>
<TD align=middle width=90 bgColor=#ff3399 height=15 class='date'><font color="white">FF3399</font></TD></TR>
<TR>
<TD align=middle width=90 bgColor=#006699 height=15 class='date'><font color="white">006699</font></TD>
<TD align=middle width=90 bgColor=#3399cc height=15 class='date'><font color="white">3399CC</font></TD>
<TD align=middle width=90 bgColor=#66ccff height=15 class='date'>66CCFF</TD>
<TD align=middle width=90 bgColor=#99ff00 height=15 class='date'>99FF00</TD>
<TD align=middle width=90 bgColor=#cc0033 height=15 class='date'><font color="white">CC0033</font></TD>
<TD align=middle width=90 bgColor=#ff3366 height=15 class='date'><font color="white">FF3366</font></TD></TR></TABLE>
</body>

</html>

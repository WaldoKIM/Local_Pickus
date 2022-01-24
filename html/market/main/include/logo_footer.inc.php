
<?
$Temp_A = explode(".",$design_stat->title_logo2);
if($design_stat->title_logo2) {
	$logo_img="<a href='index.php'><img src='../data/designImages/$design_stat->title_logo2' border='0' align='absmiddle'></a>";
}else{
	$logo_img="<div align='center'><font color='red'>디자인설정 > 메인디자인설정<br>하단 로고를 등록하여 주세요.</font></div>";
}
?>
<?=$logo_img;?>
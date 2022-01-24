<?
//with KJS dance
if($design_stat->title_logo) {
		$logo_img="<a href='index.php' class='logo'><img src='../data/designImages/$design_stat->title_logo' border='0' title='$admin_info->shop_name' ></a>";
}else{
	$logo_img="디자인설정 > 메인디자인설정<br>상단 로고를 등록하여 주세요.";
}
?>

<?=$logo_img;?>
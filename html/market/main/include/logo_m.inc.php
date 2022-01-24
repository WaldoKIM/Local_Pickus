<?
if($design_stat->title_mobile_logo) {
	$logo_img="<a href='index.php' class='logoM'><img src='../data/designImages/$design_stat->title_mobile_logo' border='0' title='$admin_info->shop_name'></a>";
}else{
	$logo_img="디자인설정 > 메인디자인설정에서 모바일 로고를 등록하여 주세요.";
}
?>
<?=$logo_img;?>
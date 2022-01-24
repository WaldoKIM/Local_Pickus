<!--***********서브 비주얼이미지 배경*******-->
<?
//상품과 주문관련된 배경과 그외 배경으로 구분
if($db->cnt("cs_navigation", "where bgfilename like '%$TARGETFILENAME%'")){
	$pageinfo = $db->object("cs_navigation", "where bgfilename like '%$TARGETFILENAME%'");
}else{
	$pageinfo = $db->object("cs_navigation", "where idx=1");
}
if(!$pageinfo->footerbg_color) $pageinfo->footerbg_color = "000000";
?>
<style>
.bg-page-background{
	background-image:url(../data/designImages/<?=$pageinfo->footerbg_img?>)!important;
}
.grey_section.bg_image{
	background-position:50% 0;
	background-repeat:repeat-x;
}
.grey_section{
	background-color:#E7E2E8; /*배경이미지 없을때 기본 색상*/
}
.titletxt_A { color:#<?=$pageinfo->footerbg_color?>; text-decoration:none;}
.titletxt_A:link{color:#<?=$pageinfo->footerbg_color?>;text-decoration:none;}
.titletxt_A:visited{color:#<?=$pageinfo->footerbg_color?>;text-decoration:none;}
.titletxt_A:hover{color:#<?=$pageinfo->footerbg_color?>;text-decoration:none;}
.titletxt_B{color:#<?=$pageinfo->footerbg_color?>  !important;text-decoration:none;}
</style>
<section id="breadcrumbs" class="grey_section bg_image bg-page-background">
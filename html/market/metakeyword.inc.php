<?
$TargetFileName = basename($_SERVER['PHP_SELF']);				//현재 파일명
$MetaDescription = $design_stat->meta_title;
$MetaKeywords = $design_stat->status_bar;
$MetaTailebar = $design_stat->title_bar;

if($_GET["goods_data"]){
	$META_DATA	= $tools->decode( $_GET["goods_data"] );
	if($META_DATA["idx"]){
		$meta_bbs_stat			= $db->object("cs_goods", "where idx=$META_DATA[idx]");
	}
	$MetaKeywords = strip_tags($meta_bbs_stat->tag);
	$MetaKeywords = preg_replace("/\"/i", "", $MetaKeywords);
	$MetaKeywords = trim(preg_replace("/ /i", ", ", $MetaKeywords));

	$MetaDescription = strip_tags($meta_bbs_stat->description);
	$MetaDescription = preg_replace("/&nbsp;/i", "", $MetaDescription);
	$MetaDescription = preg_replace("/\"/i", " ", $MetaDescription);
	$MetaDescription = preg_replace("/\\r\\n/i", " ", $MetaDescription);
	
	$MetaTailebar = $meta_bbs_stat->name;
}else if($_GET["board_data"] && $_GET["boardT"]=="v"){
	$META_DATA	= $tools->decode( $_GET[board_data] );
	if($META_DATA[idx]){
		$meta_bbs_stat			= $db->object("cs_bbs_data", "where idx=$META_DATA[idx]");
	}
	$MetaKeywords = strip_tags($meta_bbs_stat->subject);
	$MetaKeywords = preg_replace("/\"/i", "", $MetaKeywords);
	$MetaKeywords = trim(preg_replace("/ /i", ", ", $MetaKeywords));

	$MetaDescription = strip_tags($meta_bbs_stat->content);
	$MetaDescription = preg_replace("/&nbsp;/i", "", $MetaDescription);
	$MetaDescription = preg_replace("/\"/i", " ", $MetaDescription);
	$MetaDescription = preg_replace("/\\r\\n/i", " ", $MetaDescription);
	$MetaDescription = $MetaKeywords." - ".$MetaDescription;
	$MetaDescription = trim($tools->strCut($MetaDescription, 250, ".."));
	
	$MetaTailebar = $MetaKeywords."-".$MetaTailebar;
}
?>

<?
include('../common.php');
include($ROOT_DIR."/lib/page_class.php");
//게시판에 필요한 값들
if($_GET[start] )					{ $start = $_GET[start]; }
if($_GET[end] )				{ $end = $_GET[end]; }
$totalcnt = $db->cnt( "cs_part", "where part_index=1 and part_display_check=1");
if($totalcnt > $start+$end){?>
<!--카테고리 창 열기/닫기-->
<div class='gallery-mainitem-more' id="nextpagebtn"><span onclick="ajaxcateitem('<?=$start+$end;?>', '<?=$end?>')" style="cursor:pointer;"><i class='fa-plus-circle fa-chevron-circle-down_font_main' title='더보기'></i></span></div>
<?}else{?>
<div class='gallery-mainitem-more' id="nextpagebtn"><span onclick="ajaxcateitemreset('0', '<?=$end?>')" style="cursor:pointer;"><i class='fa-times-circle fa-chevron-circle-down_font_main' title='닫기'></i></span></div>
<?}?>
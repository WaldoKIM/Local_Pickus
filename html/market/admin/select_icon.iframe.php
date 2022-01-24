<?
include('../common.php'); 
//$_GET=&$HTTP_GET_VARS;
$_POST=&$HTTP_POST_VARS;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>아이콘 선택</title>

<LINK REL="stylesheet" HREF="css/admin_iframe_style.css" TYPE="TEXT/CSS">
<SCRIPT LANGUAGE="JavaScript">
<!--

function iconcheck(idx, file) {
	parent.document.viewicon.src = "../../data/designImages/"+file;
	parent.part_form.sub_list_img1.value = idx;
	parent.$.RiModal.get('self').close();
}

function layerClose(){
	parent.$.RiModal.get('self').close();
}
//-->
</SCRIPT>
<br>
<a href="javascript:layerClose()" class='oolimbtn-botton3'>닫기</a>※사용하고자 하는 아이콘을 선택해 주세요. <font	color='FF4800'>원하시는 아이콘이 없을 경우에는 <U>아이콘 관리에서 직접 아이콘 등록</U>을 하신후 이용해주세요.</font>
<table width="100%" class="table_all">
	<tr align="center">
		<?
		$table				= "cs_mobile_icon";
		$notice_result		= $db->select( $table, "order by idx desc" );
		$i=1;
		$new_cnt = 0;
		$new_tr = 0;
		$td_width = 4 ; // 가로리스트 수
		while( $row = mysqli_fetch_object($notice_result) ) {
		$new_cnt++;

		?>
		<td class='contenM tabletd_all'><img src="../data/designImages/<?=$row->icon?>"><br><input type="radio" name="icon" onclick="iconcheck('<?=$row->idx?>','<?=$row->icon?>')"> 선택</td>
		<? if (($new_cnt % $td_width) == 0) { $new_tr++;?>
	</tr>
	<tr align="center">
		<?}}?>
		<? $new_td = $td_width - ($new_cnt%$td_width);	for($i=0; $i<$new_td; $i++) { if( $new_cnt != $td_width * $new_tr) {?>
		<!-- 반복 생성 -->
		<td width="<? $width_td = 100/$td_width; echo($width_td."%");?>" align="center">
			&nbsp;
		</td>
		<?}}?>
	</tr>
</table>
<div align='center'><a href="javascript:layerClose()" class='oolimbtn-botton3'>닫기</a></div>

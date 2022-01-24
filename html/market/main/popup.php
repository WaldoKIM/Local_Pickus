<?
include('../common.php');

$popup_stat = $db->object("cs_popup", "where idx='$_GET[idx]'");
$COOKIE_NAME="POPUP_COOKIE_".$popup_stat->idx;
?>
<html>
<head>
<title><?=$popup_stat->title_bar;?></title>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/popup.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript">
<!--
function setCookie( name, value, expiredays )
{
	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}
<? if($popup_stat->live==0) {?>
function closeWin(){
	if ( document.popup_form.popup_end.checked ) {
		setCookie( '<?=$COOKIE_NAME;?>', 'NO', 1 );//쿠기 저장 기간은 1일로 한다.
	}
	window.close();
}
<?} else if($popup_stat->live==1) {?>
function closeWin(){
	if ( document.popup_form.popup_end.checked ) {
		setCookie( '<?=$COOKIE_NAME;?>', 'NO', 365 );//쿠기 저장 기간은 1일로 한다.
	}
	window.close();
}
<?}?>
function closeGo(url){
	opener.parent.window.location.href='http://'+url;
	window.close();
}
//-->
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="100%" valign="top"><? if($popup_stat->display==0) {?><?=$popup_stat->content;?><?} else if($popup_stat->display==1) {?><? if($popup_stat->link_url) {?><a href="javascript:closeGo('<?=$popup_stat->link_url;?>')"><img src='../data/designImages/<?=$popup_stat->popup_images;?>' border='0'></a><?} else {?><img src='../data/designImages/<?=$popup_stat->popup_images;?>' border='0'><?}?><?}?></td>
  </tr>
	<tr>
		<td height="3" background="skinimage/icon_line1.gif"></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
<form name="popup_form">
  <tr>
    <td height="20" align="right" class="menu" valign="bottom"><input type=checkbox name="popup_end"><? if($popup_stat->live==0) {?>
오늘 하루 이창을 열지 않음<?} else if($popup_stat->live==1) {?>이창은 다시는 띄우지 않음<?}?>&nbsp;&nbsp;<a href="javascript:closeWin();"><img src="images/bt_pop_close.gif" align="absbottom" border="0"></a>&nbsp;</td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
  </form>
</table>
</body>
</html>
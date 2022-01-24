<?
include('../common.php');
include($ROOT_DIR."/lib/page_class.php");
//게시판에 필요한 값들
$MV_DATA	= $_GET[board_data];
$BOARD_DATA	= $tools->decode( $_GET[board_data] );
if($_GET[idx] )					{ $idx = $_GET[idx]; }					else { $idx = $BOARD_DATA[idx]; }
if($_GET[listNo] )				{ $listNo = $_GET[listNo]; }			else { $listNo = $BOARD_DATA[listNo]; }
if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }		else { $startPage	= $BOARD_DATA[startPage]; }
if($_GET[totalList] )			{ $totalList = $_GET[totalList]; }		else { $totalList	= $BOARD_DATA[totalList]; }
$MV_SEARCH_ITEM	= $_GET[search_items];
$SEARCH_ITEM	= $tools->decode( $_GET[search_items] );
if($_GET[code] )			{ $code = $_GET[code]; }		else { $code = $SEARCH_ITEM[code]; }
if($_GET[search_item] )			{ $search_item = $_GET[search_item]; }		else { $search_item	= $SEARCH_ITEM[search_item]; }
if($_GET[search_order] )			{ $search_order = $_GET[search_order]; }		else { $search_order	= urldecode($SEARCH_ITEM[search_order]); }
if($_GET[boardT] )			{ $boardT = $_GET[boardT]; }		else { $boardT = $_POST[boardT]; }
if($_GET[goods_idx] )			{ $goods_idx = $_GET[goods_idx]; }		else { $goods_idx = $SEARCH_ITEM[goods_idx]; }
$review=$db->object("cs_goods_qna", "where idx='$idx'");
if($review->hold==1){
	if($_SESSION[USERID]){
		if($_SESSION[USERID]!=$review->userid){
			$tools->errMsg(' 비밀글 읽기권한이 없습니다.');
		}
	}else{
		if(!$db->cnt("cs_goods_qna", "where idx='$idx' and pwd=PASSWORD('$_POST[pwd]')")){
			$tools->errMsg(' 비밀글 읽기권한이 없습니다.');
		}
	}
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>상품문의</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<script language="javascript">
<!--
	function board_del() {
		var choose = confirm( '영구히 삭제 하시겠습니까?');
		if(choose) {	location.href='product_qna_del.php?board_data=<?=$MV_DATA;?>' }
		else { return; }
	}
//-->
</script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" media="all" href="css/joinform_layout.css" media="screen and (max-width:980px)">
<link rel="stylesheet" type="text/css" media="all" href="css/joinform_style.css">
<body>
<table style="border: 1px solid #ededed !important;border-radius: 10px;box-shadow: 2px 3px 5px #ccc;display: flex;justify-content: center;" width="100%">
	
	<tr bgColor="white">
		<td style="display:none;" width=20% height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>이 름</td>
		<td height="45" style="padding-left:3px" align="left">이름 : <?=$review->name?></td>
	</tr>
	
	<tr bgColor="white">
		<td style="display:none;" width=20% height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>제 목</td>
		<td height="45" style="padding-left:3px" align="left">제목 : <?=$review->title?></td>
	</tr>
	
	<tr style="display:none;">
		<td colspan="2" height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>내 용</td>
	</tr>
	
	<tr>
		<td bgColor='#ffffff' style="padding-left:3px" align="left">내용 : <?=$review->content?></td>
	</tr>
	
	<?if($review->coment_check==1){?>
	<tr style="display:none;">
		<td colspan="2" height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>답 변</td>
	</tr>
	
	<tr>
		<td bgColor='#ffffff' style="padding-left:3px" align="left">답변 : <?=$review->coment?></td>
	</tr>
	
	<?}?>
</table>
<table style='width:100%'>
	<tr>
		<td style="padding-top:15px;text-align:center;">
			<a href="javascript:history.go(-1);" class='oolimbtn-botton3'>목록으로</a>
			<?if($review->coment_check!=1){?>
			<a href="<?if($_SESSION[USERID]==$review->userid && $_SESSION[USERID]!=""){?>product_qna_edit.php?board_data=<?=$MV_DATA;?><?}else{?>product_qna_pwd.php?type=E&board_data=<?=$MV_DATA;?><?}?>" class='oolimbtn-botton2'>수정</a>
			<a href="<?if($_SESSION[USERID]==$review->userid && $_SESSION[USERID]!=""){?>javascript:board_del()<?}else{?>product_qna_pwd.php?type=D&board_data=<?=$MV_DATA;?><?}?>" class='oolimbtn-botton1'>삭제</a>
			<?}?>
		</td>
	</tr>
</table>
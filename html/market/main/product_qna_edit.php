<? include('../common.php');?>
<?
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
if($_SESSION[USERID]){
	if($_SESSION[USERID]!=$review->userid){
		$tools->errMsg('  권한이 없습니다.');
	}
}else{
	if(!$db->cnt("cs_goods_qna", "where idx='$idx' and pwd=PASSWORD('$_POST[pwd]')")){
		$tools->errMsg(' 권한이 없습니다.');
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
</head>
<script language="JavaScript">
<!--
function sendit() {
	var form=document.review_form;
	if(form.name.value=="") {
		alert("이름을 입력해 주십시오.");
		form.name.focus();
	}else if(form.title.value=="") {
		alert("제목을 입력해 주십시오.");
		form.title.focus();
	} else if( form.content.value=="") {
		alert("내용을 입력해 주십시오.");
		form.content.focus();
	} else {
		form.submit();
	}
}
//-->
</script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" media="all" href="css/joinform_layout.css" media="screen and (max-width:980px)">
<link rel="stylesheet" type="text/css" media="all" href="css/joinform_style.css">
<body text="black" link="blue" vlink="purple" alink="red" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%">
<form name="review_form" action="product_qna_edit_ok.php" method="post">
<input type="hidden" name="board_data" value="<?=$MV_DATA;?>">
	<tr>
		<td align="center">
		<table style="width: 95%; margin: auto;" width="100%" bgColor="#CDCDCD" class="qna_edit_table menu" border="0" align="center">
			
			<tr bgColor="white"<?if($_SESSION[USERID]){?> style="display:none"<?}?>>
				<td width='20%' height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>이 름</td>
				<td height="45" style="padding-left:3px" align="left"><input type="text" name="name" class="formText" maxlength="15" value="<?=$review->name?>"><br>(예 : 홍길동)</td>
			</tr>
			<?if(!$_SESSION[USERID]){?>
			
			<?}?>
			<tr bgColor="white"<?if($_SESSION[USERID]){?> style="display:none"<?}?>>
				<td width='20%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>비밀번호</td>
				<td height="45" style="padding-left:3px" align="left"><input type="password" name="pwd" class="formText"><br>(수정 및 삭제시 필요합니다)</td>
			</tr>
			<?if(!$_SESSION[USERID]){?>
			
			<?}?>
			<tr bgColor="white">
				<td style="display:none;" width='20%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>비밀글</td>
				<td height="45" style="padding-left:3px" align="left" class='email'><input type="checkbox" name="hold" value="1" class='bbs_input' <?if($review->hold==1){?>checked<?}?>><img src="images/key_icon2.gif" border="0"></td>
			</tr>
			
			<tr bgColor="white">
				<td style="display:none;" width='20%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>제 목</td>
				<td height="45" style="padding-left:3px" align="left" class='email'><input type="text" name="title" placeholder="제목을 입력해주세요." class="formText formText_subject" value="<?=$review->title?>"></td>
			</tr>
			
			
			<tr bgColor="white">
				<td colspan="2">
					<div id="comment">
					<fieldset>
						<table>
							<colgroup><col width="*" /><col width="131" /></colgroup>
							<tbody>
								<tr>
									<td><div class="box"><textarea name="content" placeholder="내용을 입력해주세요."><?=$review->content?></textarea></div></td>
								</tr>
							</tbody>
						</table>
					</fieldset>
					</div>
				</td>
			</tr>
			
		</table>
		<table width="100%" border="0">
			<tr>
				<td align='center' style="padding-top:15px;">
					<div id='btncenter_warp'>
						<div class='btncenter_container'>
							<a href="javascript:sendit();" class='oolimbtn-botton2'>글쓰기</a>
							<a href="javascript:history.go(-1);" class='oolimbtn-botton3'>취소</a>
						</div>
					</div>
				<tr>
			</tr>
		</table>
		</td>
	</tr>
</form>
</table>
</body>
</html>

<style>
	
.qna_edit_table tbody{
	border: 1px solid #ededed !important;
    border-radius: 10px;
    box-shadow: 2px 3px 5px #ccc;
}


</style>
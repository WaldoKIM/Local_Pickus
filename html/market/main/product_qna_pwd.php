<? include('../common.php');?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?
	//게시판에 필요한 값들
	$MV_DATA	= $_GET[board_data];
	$BOARD_DATA	= $tools->decode( $_GET[board_data] );
	if(!$_GET[board_data]) { $tools->errMsg('중요정보가 부족합니다.');}
	
?>
<script language="JavaScript">
<!--
function sendit() {
	var form=document.review_form;
	if(form.pwd.value=="") {
		alert("비밀번호를 입력해 주십시오.");
		form.pwd.focus();
	} else {
		form.submit();
	}
}
//-->
</script>
<title>비밀번호확인</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" media="all" href="css/joinform_layout.css" media="screen and (max-width:980px)">
<link rel="stylesheet" type="text/css" media="all" href="css/joinform_style.css">
<body text="black" link="blue" vlink="purple" alink="red">
		<table width="50%" bgColor="#CDCDCD" style='margin:0 auto;'>
			<?if($_GET[type]=="E"){?>
			<form name="review_form" action="product_qna_edit.php?board_data=<?=$MV_DATA;?>" method="post">
			<?}else if($_GET[type]=="V"){?>
			<form name="review_form" action="product_qna_view.php?board_data=<?=$MV_DATA;?>" method="post">
			<?}else{?>
			<form name="review_form" action="product_qna_del.php?board_data=<?=$MV_DATA;?>" method="post">
			<?}?>
			<tr>
				<td width="7" colspan="2" height="2" bgColor='#333333'></td>
			</tr>
			<tr bgColor="white">
				<td width=80 height="35" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>비밀번호</td>
			</tr>
			<tr>
				<td height="45" style="padding-left:3px" align="center" bgcolor="white"><input type="password" name="pwd" class="formText" style="width:250px;"></td>
			</tr>
			<tr>
				<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
			</tr>
		</form>
		</table>
		<table style='width:100%; margin:0 auto;'>
			<tr>
				<td style='text-align:center'>
				<a href="javascript:sendit();" class='btn-type5_view'>비밀번호 확인하기</a> <a href="javascript:history.go(-1);" class='btn-type4_view'>취소</a>
				<tr>
			</tr>
		</table>
</body>
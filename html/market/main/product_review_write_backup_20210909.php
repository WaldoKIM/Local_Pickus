<? include('../common.php');?>
<?
	if(!$_GET[goods_idx]) { $tools->msgClose('중요정보가 부족합니다.');}
	
	$goods_stat=$db->object("cs_goods", "where idx='$_GET[goods_idx]'");
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>제품문의글</title>
</head>
<script language="JavaScript">
<!--
function sendit() {
	var form=document.review_form;
	if(form.name.value=="") {
		alert("이름을 입력해 주십시오.");
		form.name.focus();
	}else if(form.pwd.value=="") {
		alert("비밀번호를 입력해 주십시오.");
		form.pwd.focus();
	}else if(form.title.value=="") {
		alert("제목을 입력해 주십시오.");
		form.title.focus();
	}else if(form.star[0].checked==false && form.star[1].checked==false && form.star[2].checked==false && form.star[3].checked==false && form.star[4].checked==false){
		alert("상품평을 등록하여 주세요.");
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
<!-- 게시판 첨부파일 속성 -->
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/form_file.js"></script>
<script>
    $(document).ready(function() {
        fileInput();
    });
</script>
<!-- 게시판 첨부파일 속성 -->
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div class="spec_cont">
	<div class="joinInfo">
		<div class="bbs_write01">
			<table width="100%">
			<form name="review_form" action="product_review_write_ok.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="goods_idx" value="<?=$_GET[goods_idx]?>">
				<tr>
					<td align="center">
					<table width="100%" bgColor="#CDCDCD" class="menu" border="0" align="center">
						<tr>
							<td width="7" colspan="2" height="2" bgColor='#333333'></td>
						</tr>
						<tr bgColor="white"<?if($_SESSION[USERID]){?> style="display:none"<?}?>>
							<td width='20%' height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>이 름</td>
							<td height="45" style="padding-left:3px" align="left"><input type="text" name="name" class="formText" maxlength="15" value="<?=$_SESSION[NAME];?>"><br>(예 : 홍길동)</td>
						</tr>
						<?if(!$_SESSION[USERID]){?>
						<tr>
							<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
						</tr>
						<?}?>
						<tr bgColor="white"<?if($_SESSION[USERID]){?> style="display:none"<?}?>>
							<td width='20%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>비밀번호</td>
							<td height="45" style="padding-left:3px" align="left"><input type="password" name="pwd" class="formText" value="<?=$_SESSION[PASSWD];?>"><br>(수정 및 삭제시 필요합니다)</td>
						</tr>
						<?if(!$_SESSION[USERID]){?>
						<tr>
							<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
						</tr>
						<?}?>
						<tr bgColor="white">
							<td width='20%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>비밀글</td>
							<td height="45" style="padding-left:3px" align="left" class='email'><input type="checkbox" name="hold" value="1" class='bbs_input'><img src="images/key_icon2.gif" border="0"></td>
						</tr>
						<tr>
							<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
						</tr>
						<tr bgColor="white">
							<td width='20%' align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>제 목</td>
							<td style="padding-left:3px" align="left" class='email'><input type="text" name="title" class="formText formText_subject"></td>
						</tr>
						<tr>
							<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
						</tr>
						<tr bgColor="white">
							<td width='20%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>평 가</td>
							<td height="45" style="padding-left:3px" align="left" class='email'>
							<input type="radio" name="star" value="1"><i class='fa-star_rev fa-star'></i>&nbsp;
							<input type="radio" name="star" value="2"><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i>&nbsp;
							<input type="radio" name="star" value="3"><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i>&nbsp;
							<input type="radio" name="star" value="4"><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i>&nbsp;
							<input type="radio" name="star" value="5"><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i><i class='fa-star_rev fa-star'></i>&nbsp;</td>
						</tr>
						<tr>
							<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
						</tr>
						<tr bgColor="white">
							<td width='20%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>사진첨부</td>
							<td height="45" style="padding-left:3px" align="left" class='email'><input type="file" name="bbs_file" ></td>
						</tr>
						<tr>
							<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
						</tr>
						<tr bgColor="white">
							<td colspan="2" height="40" align="center" bgcolor="F4F4F4" class="oolimmobilemenuM">내용</td>
						</tr>
						<tr>
							<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
						</tr>
						<tr bgColor="white">
							<td colspan="2">
								<div id="comment">
									<fieldset>
										<table>
											<colgroup><col width="*" /><col width="131" /></colgroup>
											<tbody>
												<tr>
													<td><div class="box"><textarea name="content"></textarea></div></td>
												</tr>
											</tbody>
										</table>
									</fieldset>
								</div>
							</td>
						</tr>
						<tr>
							<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
						</tr>
					</table>
					<table style='margin:0 auto;'>
						<tr>
							<td align='center' style="padding-top:15px;text-align:center;">
								<a href="javascript:sendit();" class='oolimbtn-botton2' style='width:100px;'>글쓰기</a>
								<a href="javascript:history.go(-1);" class='oolimbtn-botton3'>취소</a>
							<tr>
						</tr>
					</table>
					</td>
				</tr>
			</form>
			</table>
		</div>
	</div>
</div>
</body>
</html>
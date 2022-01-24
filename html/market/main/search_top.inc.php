<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--[if lt IE 9]>
<style>.container-fluid {display:none;}</style>
<p style="font-size:12pt; color:#000000; font-family: 'NanumGothicBold', 'NanumGothic','Dotum'; padding-top:50px; text-align:center"><img src="images/ie8er.jpg"/><br/>죄송합니다. 익스플로러 9버전 이하에서는 이용할 수 없습니다.<br/>사용하고 계신 익스플로러 버전을 업그레이드 하신후 이용해 주시기 바랍니다.<br/><br/><a href='http://browsehappy.com/' target='_new' class='iecheck01' style="font-size:12pt; font-family: 'NanumGothicBold', 'NanumGothic','Dotum'; padding:20px; text-align:center">업그레이드 바로가기</a></p>
<![endif]-->
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/style_main.css">
<link rel="stylesheet" type="text/css" media="all" href="css/joinform_style.css">
<!-- 통합검색폼출력 -->
<script language="javascript">
<!--
// 제품검색
function searchSendit() {
	var form=document.all;
	if(form.search.value=="") {
		alert("검색어를 입력해 주십시오.");
		form.search.focus();
	} else {
		parent.location.href="./product_search.php?search="+form.search.value;
	}
}
function searchInputSendit() {
	if(event.keyCode==13) {
		searchSendit();
	}
}
//-->
</script>
<div class='product_search_popup'>
	<div class='product_search_popup_title' style='width:100%;text-align:center;'><h1>Product</h1><h2> Search</h2></div>
	<table style='margin:0 auto'>
	<tr>
	  <td>
		<input name="search" type="text" class='formText formText_subject' onKeyDown="searchInputSendit();"></td>
	  <td width="73"><a href="javascript:searchSendit();"  style='width:60px;' class='btn-add'>검색</a></td>
	</tr>
	</table>
</div>
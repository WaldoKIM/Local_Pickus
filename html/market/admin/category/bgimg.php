<?
include('../../common.php');
$stat = $db->object("cs_navigation", "where idx='$_GET[idx]'");
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>배경이미지 및 서브페이지 제목색상 관리</title>

<LINK REL="stylesheet" HREF="../css/admin_iframe_style.css" TYPE="TEXT/CSS">
<LINK REL="stylesheet" HREF="../css/joinform_style.css" TYPE="TEXT/CSS">
</head>

<script type="text/javascript" src="../../lib/jquery-1.8.3.min.js"></script>

<!-- 모달팡업창 -->
<script src="../js/modal_js/jquery.rimodal.js"></script>
<link rel="stylesheet" href="../css/modal_css/jquery.rimodal.css">

<!--모달팝업창-->
<script>
	$(document).riModal({delegate:'.modal'});
	var logElement = $('#Log').get(0);
	function logFiring(text, props) {
		return function(event) {
			if (props && event.data) {
				console.log('event.data =', event);
			}
			logElement.innerHTML += 'Fired `' + text + '` event<br>';
		};
	}
	var example4 = new $.RiModal({
		text: '',
		ajax: function() {
			return 'index.php';
		},
		width: 300,
		height: 200,
		cover: false,
		draggable: true,
		destroy_on_close: false
	});
	example4
	.on('Init', logFiring('Init'))
	.on('Rendered', logFiring('Rendered'))
	.on('Calculated', logFiring('Calculated', ['size']))
	.on('Opening', logFiring('Opening'))
	.on('Opened', logFiring('Opened'))
	.on('Loading', logFiring('Loading'))
	.on('Loaded', logFiring('Loaded'))
	.on('Dragging', logFiring('Dragging', ['mousedown']))
	.on('Dragged', logFiring('Dragged', ['mouseup']))
	.on('Resizing', logFiring('Resizing', ['size']))
	.on('Resized', logFiring('Resized', ['size']))
	.on('Closing', logFiring('Closing'))
	.on('Closed', logFiring('Closed'))
	;
	$('#TextExample').on('click', function(evt) {
		evt.preventDefault();
		example4.open();
	});
</script>
<!--모달팝업창 End-->
<script language="JavaScript">
<!--
// 사용자 화면 출력
function displaySendit() {
	var form=document.display_form;
	form.submit();
}

// 아이콘 파일 업로드
function bgcheck() {
	var form=document.display_form;
	if(form.footerbg[0].checked==true){
		document.getElementById('color').style.display="";
		document.getElementById('img').style.display="none";
	}else{
		document.getElementById('color').style.display="none";
		document.getElementById('img').style.display="";
	}
}
//-->
</script>
<body>
<!--콘텐츠출력-->
<table width="100%">
	<form action="bgimg_ok.php" method="post" name="display_form" enctype="multipart/form-data">
	<input type="hidden" name="idx" value="<?=$_GET[idx]?>">
	<tr> 
		<td style='padding:1em;'>
			

				<table width="100%">
					<tr>
						<td height="25">
						<table>
							<tr>
								<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" style='vertical-align:-5%'><?=$stat->title?> 배경설정</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td height="20" class='noneoolim'>
						<!--도움말-->
							<table width="100%">
								<tr>
									<td bgcolor="#E9F2F8" class='tipbox'>
										<img src="../img/tip_icon.gif" width="28" height="11"><br>
										<font color='#FC6E51'>상단제목타이틀 및 네이게이션 위치의 배경이미지를 관리하실수 있습니다.</font><br>
										배경등록시 패턴으로써 반복해서 적용됩니다.<br>

										<font color='#FC6E51'><b>주의 - 이미지로 배경을 변경하실 경우에는 노출되는 텍스트가 잘 보일수 있도록 배색이 되는 이미지를 이용하시기 바랍니다.</b></font><br>
									</td>
								</tr>
							</table>
						<!--도움말--->

						</td>
					</tr>
					<tr>
						<td height="5"></td>
					</tr>
				</table>
								
				<table width="100%" class="table_all">
					<tr>
						<td width="15%" bgcolor="E4E7EF" class='contenM tabletd_all'>이미지</td>
						<td class='tabletd_all tabletd_small'><input name="footerbg_img" type="file" class="formText" maxlength="30" size="39">
							<?if($stat->footerbg_img){
							$view_img = @getimagesize("../../data/designImages/".$stat->footerbg_img);
							if(  $view_img[0] > 300 ) {$wsize = "width=300"; } else {$wsize = $view_img[0];}
							?>
							<br><br>&nbsp;<a href="../../data/designImages/<?=$stat->footerbg_img?>" rel="lightbox"><img src="../../data/designImages/<?=$stat->footerbg_img?>" <?=$wsize?>></a>
							<?}?>
						</td>
					</tr>
					<tr>
						<td width="15%" bgcolor="E4E7EF" class='contenM tabletd_all'>타이틀 색상</td>
						<td class='tabletd_all tabletd_small'>
							<input name="footerbg_color" type="text" class="formText" maxlength="6" size="9" value="<?=$stat->footerbg_color?>">&nbsp;<a href="#" class='modal searchC' data-modal-height="500" data-modal-width="484" data-modal-iframe="../rgbcolor.php?value=footerbg_color" data-modal-title="선택후 닫기 버튼을 이용하여 주세요.">색상코드</a>
						</td>
					</tr>
				</table>

			<div style='width:100%; height:80px;line-height:60px; text-align:center;'><a href="javascript:displaySendit();" class='oolimbtn-botton1'>등록</a></div>

		</td>
	</tr>
</form>


</body>

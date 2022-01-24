<?
include('../common.php');


if( $_GET[method] == 1 || $_POST[method] == 1) { $method = 1;}
if( $_GET[method] == 2 || $_POST[method] == 2) { $method = 2;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"">
<meta name="format-detection" content="telephone=no">
<title>우편번호검색</title>
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Expires" content="-1"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?=$design_stat->browser_title;?>">
<meta name="keywords" content="<?=$design_stat->meta_title;?>">
</head>
<script language="javascript">
<!--
function choice(f){
<? if( $method == 1) {?>
	parent.document.join_form.add1.value	=	document.getElementById('address').value;
	parent.document.join_form.zip.value		=	document.getElementById('zip').value;
	parent.document.join_form.add2.focus();
	parent.$.RiModal.get('self').close();
<? } else if( $method == 2) { ?>
	parent.document.trade_form.deliv_add1.value	=	document.getElementById('address').value;
	parent.document.trade_form.deliv_zip.value	=	document.getElementById('zip').value;
	parent.document.trade_form.deliv_add2.focus();
	parent.$.RiModal.get('self').close();
<? }?>
}
//-->
</script>
<body>
<div style="display:none">
<form name="form_post">
<input type="text" id="zip" name="zip">
<input type="text" id="address" name="address">
</form>
</div>
<div id="wrap" style="display:none;border:0px solid;width:100%;height:100%;">
</div>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
	// 우편번호 찾기 찾기 화면을 넣을 element
	var element_wrap = document.getElementById('wrap');
	function sample3_execDaumPostcode() {
		// 현재 scroll 위치를 저장해놓는다.
		var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
		new daum.Postcode({
			oncomplete: function(data) {
				// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
				// 각 주소의 노출 규칙에 따라 주소를 조합한다.
				// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
				var fullAddr = data.address; // 최종 주소 변수
				var extraAddr = ''; // 조합형 주소 변수
				// 기본 주소가 도로명 타입일때 조합한다.
				if(data.addressType === 'R'){
					//법정동명이 있을 경우 추가한다.
					if(data.bname !== ''){
						extraAddr += data.bname;
					}
					// 건물명이 있을 경우 추가한다.
					if(data.buildingName !== ''){
						extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
					}
					// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
					fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
				}
				// 우편번호와 주소 및 영문주소 정보를 해당 필드에 넣는다.
				document.getElementById('zip').value = data.zonecode;
				document.getElementById('address').value = fullAddr;
				choice("document.form_post");
				// 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
				//document.body.scrollTop = currentScroll;
				sample3_execDaumPostcode();
			},
			// 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
			onresize : function(size) {
				element_wrap.style.height = size.height+"px";
			},
			width : '100%',
			height : '100%'
		}).embed(element_wrap);
		// iframe을 넣은 element를 보이게 한다.
		element_wrap.style.display = 'block';
	}
	sample3_execDaumPostcode();
</script>
</body>
</html>
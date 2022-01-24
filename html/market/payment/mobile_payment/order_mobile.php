<?
  $tablet_size     = "1.0"; // 화면 사이즈 고정
  $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<title>유전체연합심포지엄</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="Cache-Control" content="No-Cache">
<meta http-equiv="Pragma" content="No-Cache">
<meta name="viewport" content="width=device-width, user-scalable=<?=$tablet_size?>, initial-scale=<?=$tablet_size?>, maximum-scale=<?=$tablet_size?>, minimum-scale=<?=$tablet_size?>">
<link href="css/style.css" rel="stylesheet" type="text/css" id="cssLink"/>
<link href="css/payment.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript">
        function chk_frm()
        {
			var frm = document.order_info;
			if(frm.buyr_name.value ==""){
				alert('성명을 입력해 주세요.');
			}else if(frm.buyr_mail.value ==""){
				alert('이메일을 입력해 주세요.');
			}else if(frm.buyr_tel1.value ==""){
				alert('전화번호를 입력해 주세요.');
			}else{	
				frm.submit();
			}
		}
		function mny_input()
		{
			var frm = document.order_info;
			var good_mny2 = "";
			if(frm.good_name1.value==190000 && frm.good_name2.value == "Y"){
				good_mny2 = 100000;
			}else if(frm.good_name1.value==50000 && frm.good_name2.value == "Y"){
				good_mny2 = 10000;
			}
			frm.good_mny.value = Number(frm.good_name1.value)+Number(good_mny2);
		}
	</script>
</head>

<body>

<form name="order_info" method="post" action="./order_mobile1.php">
  <!-- 타이틀 -->
	<div class="title">
	   유전체 연합 심포지엄 등록
	</div>
	<div class="payform_div">
		<table class="payform_wrap" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td>
					<table class="payform" width="100%" border="0" cellspacing="0" cellpadding="0" >
						<tr>
							<td>
								<table class="payform_inner" width="100%" align="center" >					
								  <tr>
									<td>
								<!-- 주문자명(buyr_name) -->
										<br/><b>성명</b>
										<br/><input type="text" name="buyr_name" class="w100" value=""/>
										
								<!-- 주문자 E-mail(buyr_mail) -->
										<br/><b>이메일</b>
										<br/><input type="text" name="buyr_mail" class="w200" value="" maxlength="30" />
										
								<!-- 주문자 연락처1(buyr_tel1) -->
										<br/><b>전화번호</b>
										<br/><input type="text" name="buyr_tel1" class="w100" value=""/>
								
								<!-- 휴대폰번호(buyr_tel2) -->
										<br/><b>휴대폰번호</b>
										<br/><input type="text" name="buyr_tel2" class="w100" value=""/>
									</td>
								  </tr>
								</table>
							</td>
						</tr>				
					</table>
				</td>
			</tr>		
		</table>
	
		<!-- 결제 요청/처음으로 이미지 -->
		<div class="btnset" id="display_pay_button" style="display:block">
			<div class="paybtn">
				<input name="" type="button"  class="pay_start" value="다 음" onclick="chk_frm();" />
				<?/*<a href="../" class="back" >처음으로</a>	*/?>			
			</div>
		</div>
		<br>
		<div class="footer" style="text-align:center;">
		유전체 연합 심포지엄.
		</div>
	</div>
</form>

						  <!--footer-->
						  <div class="footer">
							Copyright (c) NHN KCP INC. All Rights reserved.
						  </div>
						  <!--//footer-->


</body>
</html>

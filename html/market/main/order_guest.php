<? include('./include/head.inc.php');?>
<?

?>
<script language="JavaScript">
	<!--
	function sendit() {
		var form=document.trade_form;
		if(form.order_name.value=="") {
			alert("주문자의 이름을 입력해 주세요.");
			form.order_name.focus();
		} else if(form.order_email.value=="") {
			alert("주문자의 E-Mail를 입력해 주세요.");
			form.order_email.focus();
		} else if(form.trade_code.value=="") {
			alert("주문 번호를 입력해주세요.");
			form.trade_code.focus();
		} else {
			form.submit();
		}
	}
	//-->
</script>
<div class="site-wrapper" id="box_wrapper">
	<!--상단로고, 가이드메뉴-->
	<? include('./include/top_guide.inc.php');?>
	<!--상단메뉴, 로테이트베너-->
	<? include('./include/top_menu.inc.php');?>
		<!--페이지 위치-->
		<div class="my_location">
			<ol class="breadcrumb titletxt_B">
				<li><a href="index.php" class="titletxt_A">Home</a></li>
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li>비회원 주문내역조회</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section order_check check_guest">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************내용영역 출력 시작********************-->
					<!--페이지서브메뉴-->
					<? include('./include/mymenu.inc.php');?>
					<!--페이지서브메뉴-->
					<div class="guest_log">
						<form method="post" action="order_guest_view.php" name="trade_form">
							<h2>비회원 주문내역조회</h2>
							<table>
								<tr>
									<th>주문자 이름</th>
									<td><input name="order_name" type="text" size="20" maxlength="20"></td>
								</tr>
								<tr>
									<th>주문자 E-Mail</th>
									<td><input name="order_email" type="text" style="IME-MODE:disabled" maxlength="40"></td>
								</tr>
								<tr>
									<th>주문번호</th>
									<td><input name="trade_code" type="text" size="20" maxlength="20"></td>
								</tr>
								<tr>
									<td colspan="2" class="text_info">주문시에 받으신 주문코드 및 주문자 정보를 입력해 주세요.</td>
								</tr>
							</table>
							<div class="bottom_btn">
								<a href="javascript:sendit();">주문내역조회하기</a>
							</div>
						</form>
					</div>
					<!--********************내용영역 출력 끝********************-->
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->
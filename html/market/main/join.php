<? include('./include/head.inc.php');?>
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
				<li><i class="fas fa-arrow-left"></i>회원가입약관</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section join_step1">
		<div class="container-fluid">
			<div class="row" style='width:100%;margin:0 auto;max-width:1200px'>
				<div class="to_animate">
						<!--********************내용영역 출력 시작********************-->
							<span class="product-viewboxT"><i class="far fa-check-circle"></i>이용약관</span>
							<div class="joinInfo">
								<div class="bbs_write01">
									<p><section class="join" title='약관'>
										<fieldset class="joinRule">
											<div class="ruleBox">
											<?
											echo $admin_stat->agreement;
											?>
											</div>
										</fieldset>
									</section></p>
								</div>
							</div>
							<p style='text-align:center;color:#000;margin-top:10px;'><input type="checkbox" value="0" name="agreecheck" id="agreecheck" style='vertical-align: -5%;'> 위 약관에 동의함.</p>
							<div class='spaceline01'></div>
							<span class="product-viewboxT"><i class="far fa-check-circle"></i>개인정보취급방침</span>
							<div class="joinInfo">
								<div class="bbs_write01">
									<p><section class="join" title='약관'>
										<fieldset class="joinRule">
											<div class="ruleBox">
											<?
											echo $admin_stat->memberinfoadmin;
											?>
											</div>
										</fieldset>
									</section></p>
								</div>
							</div>
							<p style='text-align:center;color:#000;margin-top:10px;'><input type="checkbox" value="0" name="useragreecheck" id="useragreecheck" style='vertical-align: -5%;'> 위 약관에 동의함.</p>
							<div class='spaceline01'></div>
							<?if($admin_stat->realname > 0){
								include('../ipin/page_ipin.php');
							}else{?>
								<script language="javascript">
								<!--
								function agreeSendit() {
									if(document.getElementById('agreecheck').checked!=true){
										alert("이용약관에 동의하여 주세요.");
									}else if(document.getElementById('useragreecheck').checked!=true){
										alert("개인정보취급방침에 동의하여 주세요.");
									} else {
										location.href="joinform.php";
									}
								}
								//-->
								</script>
								<div class="bottom_btn">
									<a href="javascript:agreeSendit()" class="oolimbtn-botton1" style="width:150px">동의함</a>
									<a href="javascript:history.go(-1);" class="oolimbtn-botton2" style="width:150px">동의하지 않음</a>
								</div>
							<?}?>
						<!--********************내용영역 출력 끝********************-->
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<br>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->
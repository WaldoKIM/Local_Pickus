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
				<li>Contact US</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section page_view_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************내용영역 출력 시작********************-->
					<!--페이지서브메뉴-->
					<?
					$subpcnt	= $db->cnt("cs_page", "where 1 order by idx desc" );
					if($subpcnt){
					?>
					<? include('./include/pagesub_menu.inc.php');?>
					<!--페이지서브메뉴-->
					<div class='spaceline01'></div>
					<?}?>
					<div class="main">
						<script language="JavaScript">
						<!--
						function sendit() {
							var form=document.mail_form;
							if(form.tomail.value=="") {
								alert("받는 사람 이메일을 입력해 주세요.");
								form.tomail.focus();
							} else if(form.title.value=="") {
								alert("보내실 메일의 제목을 입력해 주세요.");
								form.title.focus();
							} else if(form.content.value=="") {
								alert("보내실 메일의 내용을 입력해 주세요.");
								form.content.focus();
							} else {
								<?if($SECURITYDOMAIN){?>
								form.action = "<?=$SECURITYDOMAIN?>/mail_to_admin_ok.php";
								<?}else{?>
								form.action = "mail_to_admin_ok.php";
								<?}?>
								form.submit();
							}
						}
						//-->
						</script>
						<section id="subpage_contents">
						<div class="info_subpage_map">
							<table width="100%">
								<tr>
								  <td style='padding-bottom:2em;'>
								  <!--회사기본정보-->
										<ul>
											<li class='oolimmobilemenuL mail_to_admin_box'>Company Name</li>
											<li class='mail_to_admin_box_in'><?=$admin_stat->shop_name;?></li>
											<li class='oolimmobilemenuL mail_to_admin_box'>Address</li>
											<li class='mail_to_admin_box_in'><?=$admin_stat->shop_address;?></li>
											<li class='oolimmobilemenuL mail_to_admin_box'>Phone</li>
											<li class='mail_to_admin_box_in'>Tel:<?=$admin_stat->shop_tel1;?>, Fax:<?=$admin_stat->shop_fax;?></li>
											<li class='oolimmobilemenuL mail_to_admin_box'>E-mail</li>
											<li class='mail_to_admin_box_in'><?=$admin_stat->shop_email;?></li>
										</ul>
								  <!--//회사기본정보-->
								  </td>
								</tr>
								<tr>
									<td>
										<table width="100%" border="0">
											<form method="post" name="mail_form"  enctype="multipart/form-data">
											<tr>
											  <td height="2" bgcolor='333333'></td>
											  <td height="2" bgcolor='333333'></td>
											</tr>
											<tr>
											  <td width='15%' height="45" align="center" bgcolor="F3F3F3" class="oolimmobilecont_Ls">보내는사람<br>메일</td>
											  <td height="45" class='email' style='padding-left:10px'><input name="tomail" type="text" size="45" style="IME-MODE:disabled" class="formText textDomin" value="<?=$_SESSION[EMAIL]?>"></td>
											</tr>
											<tr>
												<td height='1' bgcolor='#777777'></td><td height='1' bgcolor='#777777'></td>
											</tr>
											<tr>
											  <td width='15%' height="45" align="center" bgcolor="F3F3F3" class="oolimmobilecont_Ls">제 목</td>
											  <td  style='padding-left:10px'><input name="title" type="text" class="formText formText_subject"  size="45"></td>
											</tr>
											<tr>
												<td height='1' bgcolor='#777777'></td><td height='1' bgcolor='#777777'></td>
											</tr>
											<tr>
											  <td width='15%' height="45" align="center" bgcolor="F3F3F3" class="oolimmobilecont_Ls">내 용</td>
											  <td style='padding-left:10px;padding-bottom:10px'>
												<table width="100%">
													<tr>
													  <td height="30" class="bbs1"><input type="radio" name="tag" value="0" checked class="input1"> text <input type="radio" name="tag" value="1" class="input1"> html</td>
													</tr>
												</table>
												<textarea name="content" style="width:100%" rows="10"></textarea>
											  </td>
											</tr>
											<tr>
											  <td height="1" bgcolor='333333'></td>
											  <td height="1" bgcolor='333333'></td>
											  </form>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="10"></td>
								</tr>
								<tr>
									<td align="center">
										<table>
											<tr>
												<td><a href="javascript:sendit();" class='oolimbtn-botton3'>메일보내기</a></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</div>
						<div class="rightspec_cont_map">
							<table width="100%">
								<tr>
									<td class='tableborder_sens'>
										<iframe src='detail_map.php?addr=<?=$admin_stat->shop_address?>' name='searchframe' width='100%' height='600' marginwidth='0' marginheight='0' frameborder='no' scrolling='no'></iframe>
									</td>
								</tr>
							</table>
						</div>
						</section>
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
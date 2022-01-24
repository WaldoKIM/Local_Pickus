<? 
include('../header.php'); 

// 기본 관리자 정보 불러오기.
?>

<script language="javascript">
<!--
// 폼 전송
function sendit() {
	var form=document.admin_form;
	form.memberinfoadmin.value = myeditor.outputBodyHTML();
	if(form.memberinfoadmin.value=="") {
		alert("개인정보보호정책을 입력해 주세요.");
		form.memberinfoadmin.focus();
	} else {
		form.submit();
	}
}
//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/sub_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">개인정보보호정책</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#666666"></td>
			</tr>
			<tr>
				<td height="25"></td>
			</tr>
			<tr>
				<td height="5"></td>
			</tr>
			<form action="memberinfoadmin_ok.php" method="post" name="admin_form">
			<!-- 한단락 -->
			<tr>
				<td height="5" class="padding_5">
					<table width="100%">
						<tr>
							<td height="25" class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">개인정보보호정책 관리</td>
						</tr>
						<tr>
							<td>
							<!----------도움말------------>
								<table width="100%" class='tipbox'>
									<tr>
										<td bgcolor="#E9F2F8">
											<table width="100%">
												<tr>
													<td height="20">
														<p><img src="../img/tip_icon.gif" width="28" height="11" border="0"></p>
													</td>
												</tr>
												<tr>
													<td>회원가입시 약관을 관리할 수 있습니다.<font color='red'>(회원가입을 받지 않을 경우에는 입력할 필요 없음.)</font><br>
											회원가입할때 보여지는 회원가입 약관 페이지를 꾸미는 폼입니다.</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							<!----------도움말------------>
							</td>
						</tr>				
						<tr>
							<td height="5">
								
							</td>
						</tr>
						<tr>
							<td height="5">
								 <table width="100%" bgcolor="white">
									<tr>
										<td valign="top" align="right" class="padding_5">
											<table width="100%" border="0" height="30" class="table_all">
												<tr>
													<td class='contenM tabletd_all'> 
														<textarea id="memberinfoadmin" name="memberinfoadmin" style="display:none"><?=$admin_stat->memberinfoadmin?></textarea>
														<!-- 에디터를 화면에 출력합니다. -->
														<script type="text/javascript" language="javascript">
															var myeditor = new cheditor();
															myeditor.config.editorHeight = '300px';             // 에디터 세로폭입니다.
															myeditor.config.editorWidth = '100%';                // 에디터 가로폭입니다.
															myeditor.inputForm = 'memberinfoadmin';                     // 입력 textarea의 ID 이름입니다.
															myeditor.run();                                     // 에디터를 실행합니다.
														</script>
														</td>
													</tr>
													
												</tr>
											</table><br>
											<a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td height="10">
							</td>
						</tr>
						<tr>
							<td>
							<!--------페이지정보출력--------->
							<table width="100%">
								<tr>
									<td class='pageinfo_box'>
										<table width="100%">
											<tr>
												<td>
													<p><img src="../img/pageinformation_title.gif" width="118" height="21" border="0"></p>
												</td>
											</tr>
											<tr>
												<td style="padding-top:5px; padding-bottom:5px;">
													<table width="100%">
														<tr>
															<td style="padding-left:10px;" class='pageinfoB'>
																<img src="../img/pageinformation_icon.gif" width="8" height="7" border="0" align='absmiddle'>개인정보보호정책 페이지 http://사용자도매인/스킨명/memberinfoadmin.php
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!--------페이지정보출력--------->
							</td>
						</tr>
					</table>
				</td>
			</tr>
			</form>
		</table>
	</article>
	
</div>



<? include('../footer.php'); ?>


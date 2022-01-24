<? 
include('../header.php');
//$_GET=&$HTTP_GET_VARS; //$_POST=&$HTTP_POST_VARS;
$mv_data	= $_GET[review_data];
$review_data	= $tools->decode( $_GET[review_data] );
$review_stat=$db->object("cs_goods_qna", "where idx=$review_data[idx]");
$goods_stat=$db->object("cs_goods", "where idx='$review_stat->goods_idx'");
?>
<script language="JavaScript">
<!--
////  포인트 설정창오픈 ///////////////////////////////////////////////////////////////////////////////
function pointWinOpen(data) {
	window.open("../member/point.php?userid="+data,"","scrollbars=yes, width=418, height=300");
}
//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/etc_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table border="0" width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0">상품Q&A관리</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#666666">
				</td>
			</tr>
			<tr>
				<td height="25">
				</td>
			</tr>
			<tr>
				<td class="padding_5">
					<table width="100%">
						<tr>
							<td>
<!---------내용출력----------->
<table width="100%">
	<tr> 
		<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
		<table width="100%">
				<tr>
				<td>
					<table border="0" width="100%">
						<tr>
							<td height="25">
							<table>
								<tr>
									<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">상품Q&A관리</td>
								</tr>
							</table>
							</td>
						</tr>
						<tr>
							<td height="20">
								<!--도움말-->
									<table width="100%" class='tipbox noneoolim'>
										<tr>
											<td bgcolor="#E9F2F8">
												<table width="100%">
													<tr>
														<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
													</tr>
													<tr>
														<td class='sensbody'>포인트관리버튼을 누르시면 해당 포인트관리 페이지가 나타납니다.<br>해당 회원의 포인트를 적립시키거나 삭제할 수 있습니다.</td>	
													</tr>
												</table>
											</td>
										</tr>
									</table>
								<!--도움말-->
							</td>
						</tr>
						<tr>
							<td height="5">
							</td>
						</tr>
					</table>
				</td>
				</tr>
			</table>  
 
			<script language="javascript">
				<!--
				// 폼 전송
				function writeSendit() {
					var form=document.write_form;
					if(form.title.value=="") {
						alert("제목을 입력해 주십시오.");
						form.title.focus();
					} else if( form.content.value=="") {
						alert("내용 입력해 주십시오.");
						form.title.focus();
					} else {
						form.submit();
					}
				}
				//-->
			</script>
			<table width="100%" class="table_all">
				<form name="write_form" action="qna_edit_ok.php" method="post">
				<input type="hidden" name="review_data" value="<?=$mv_data;?>">
				<tr bgColor="white"> 
					<td width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>상 품 명</td>
					<td class='tabletd_all tabletd_small'>&nbsp;&nbsp;<?=$goods_stat->name;?></td>
				</tr>
				<tr bgColor="white"> 
					<td width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>제 목</td>
					<td class='tabletd_all tabletd_small'>&nbsp;&nbsp;<input name="title" type="text" class="formText formText_subject" value="<?=$review_stat->title;?>"></td>
				</tr>
				<tr bgColor="white"> 
					<td width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>내 용</td>
					<td class='tabletd_all tabletd_small'>
						<div id="comment">
						<fieldset>
							<table>
								<colgroup><col width="*" /><col width="131" /></colgroup>
								<tbody>
									<tr>
										<td><div class="box" style='height:300px'><textarea name="content" style='height:300px'><?=$review_stat->content;?></textarea></div></td>
									</tr>
								</tbody>
							</table>
						</fieldset>
						</div>
					
					</td>
				</tr>
				<tr bgColor="white"> 
					<td width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>아이디(이름)</td>
					<td class='tabletd_all tabletd_small'>&nbsp;&nbsp;<?=$review_stat->userid;?>(<?=$review_stat->name;?>)&nbsp;&nbsp;&nbsp;<a href="#" class='modal searchC' data-modal-height="300" data-modal-width="418" data-modal-iframe="../member/point.php?userid=<?=$review_stat->userid;?>" data-modal-title="포인트추가">포인트추가</a></td>
				</tr>
				<tr bgColor="white"> 
					<td width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>작성일</td>
					<td class='tabletd_all tabletd_small'>&nbsp;&nbsp;<?=$tools->strDateCut($review_stat->register, 1);?></td>
				</tr>
				</form>
			</table><br>
			<a href="javascript:writeSendit();" class="oolimbtn-botton1_1"> 등록 </a>&nbsp;<a href="qna.php?review_data=<?=$mv_data;?>" class="oolimbtn-botton1"> 돌아가기 </a>
		</td>
	</tr>
</table>
<!---------내용출력끝----------->
								</td>
							</tr>
						</table>
					</td>
				</tr>													
			</table>
	</article>
	
</div>



<? include('../footer.php'); ?>

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
														<td class='sensbody'>질문글에 대한 답변완료로 변경하신 이후에는 작성자가 수정 및 삭제가 불가능합니다.</td>	
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
			<script language="JavaScript">
			<!--
			function sendit() {
				var form=document.review_form;
				if( form.coment.value=="") {
					alert("답변을 입력해 주십시오.");
					form.coment.focus();
				} else {
					form.submit();			
				}
			}

			function qnareset(){
				var choose = confirm( '답변을 삭제하시면 미답변 상태로 변경됩니다. 삭제 하시겠습니까?');
				if(choose) {	location.href='qna_reset_ok.php?review_data=<?=$mv_data?>'; }
				else { return; }
			}
			//-->
			</script>

			<table width="100%" class="table_all">
				<form name="review_form" action="qna_coment_ok.php" method="post">
				<input type="hidden" name="review_data" value="<?=$mv_data?>">
				<tr> 
					<td width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>상 품 명</td>
					<td class='tabletd_all tabletd_small'>&nbsp;&nbsp;<?=$goods_stat->name;?></td>
				</tr>
				<tr bgColor="white"> 
					<td width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>제 목</td>
					<td class='tabletd_all tabletd_small'>&nbsp;&nbsp;<font color='E14141'><?=$review_stat->title;?></font></td>
				</tr>
				<tr bgColor="white"> 
					<td width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>내 용</td>
					<td class='tabletd_all tabletd_small'>&nbsp;&nbsp;<font color="#0066FF"><span style="font-size:11pt;">Q,</span></font><?=$tools->strHtmlBr($review_stat->content);?>
					<br>
					<div id="comment">
					<fieldset>
						<table>
							<colgroup><col width="*" /><col width="131" /></colgroup>
							<tbody>
								<tr>
									<td><div class="box" style='height:200px'><textarea name="coment" style='height:200px'><?=$review_stat->coment?></textarea></div></td>
								</tr>
							</tbody>
						</table>
					</fieldset>
					</div>

					<br>
					<p align='center'><a href="javascript:sendit();" class="menusmall_btn3">등록</a>&nbsp;<a href="javascript:qnareset()" class="menusmall_btn4">답변지우기</a></p>
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
			<a href="qna.php?review_data=<?=$mv_data;?>" class='search_bbs'>돌아가기</a>
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

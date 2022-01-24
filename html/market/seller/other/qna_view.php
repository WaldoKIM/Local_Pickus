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
<div class="mypage_btn_header">
    <a href="javascript:history.back();" class="back_btn"><img src="../img/back.png" alt=""></a>
    <div class="title">문의관리 - 답글작성</div>
</div>
<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/etc_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table border="0" width="100%">
			<tr>
				<td class="padding_5">
					<table width="100%">
						<tr>
							<td>
<!---------내용출력----------->
<table width="100%">
	<tr> 
		<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
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

			<table width="100%" class="table_all qna_view_table">
				<form name="review_form" action="qna_coment_ok.php" method="post">
				<input type="hidden" name="review_data" value="<?=$mv_data?>">
				<tr> 
					<td style="display:none;" width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>상 품 명</td>
					<td class='trade_font_bold qna_view_border'>&nbsp;&nbsp;<?=$goods_stat->name;?></td>
				</tr>
				<tr bgColor="white"> 
					<td style="display:none;" width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>제 목</td>
					<td class='trade_font_bold qna_view_border'>&nbsp;&nbsp;<?=$review_stat->title;?></td>
				</tr>
				<tr bgColor="white"> 
					<td style="display:none;" width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>내 용</td>
					<td class='trade_font_bold qna_view_border'>&nbsp;&nbsp;Q,<?=$tools->strHtmlBr($review_stat->content);?>
					<br>
					<div id="comment">
					<fieldset>
						<table>
							<colgroup><col width="*" /><col width="131" /></colgroup>
							<tbody>
								<tr>
									<td style="width:100%" qna_view_border><div class="box" style='height:200px'><textarea name="coment" style='height:200px'><?=$review_stat->coment?></textarea></div></td>
								</tr>
							</tbody>
						</table>
					</fieldset>
					</div>

					<br>
					<p style="display: flex;flex-direction: row;flex-wrap: nowrap;justify-content: center; align-items: center;" align='center'>
						<a style="width: 60px;height: 30px;line-height: 30px;border-radius: 10px;" href="javascript:sendit();" class="menusmall_btn3">등록</a>&nbsp;
						<a style="width: 60px;height: 30px;line-height: 30px;border-radius: 10px;" href="javascript:qnareset()" class="menusmall_btn4">삭제</a>
					</p>
					</td>
				</tr>
				<tr bgColor="white"> 
					<td style="display:none;" width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>아이디(이름)</td>
					<td class='trade_font_bold qna_view_border'>&nbsp;&nbsp;<?=$review_stat->userid;?>(<?=$review_stat->name;?>)</td>
				</tr>
				<tr bgColor="white"> 
					<td style="display:none;" width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>작성일</td>
					<td class='trade_font_bold qna_view_border'>&nbsp;&nbsp;<?=$tools->strDateCut($review_stat->register, 1);?></td>
				</tr>
				</form>
				
			</table><br>
			<table style='margin:0 auto;'>
				<tr>
					<td height='70'><a href="qna.php?review_data=<?=$mv_data;?>" class='oolimbtn-botton1'>돌아가기</a></td>
				</tr>
				<tr>
					<td height='70'></td>
				</tr>
			</table>
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

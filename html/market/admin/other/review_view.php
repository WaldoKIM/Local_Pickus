<? 
include('../header.php');
//$_GET=&$HTTP_GET_VARS; //$_POST=&$HTTP_POST_VARS;
$mv_data	= $_GET[review_data];
$review_data	= $tools->decode( $_GET[review_data] );
$review_stat=$db->object("cs_goods_review", "where idx=$review_data[idx]");
$goods_stat=$db->object("cs_goods", "where idx='$review_stat->goods_idx'");
$ThumbEncode = $tools->encode("idx=".$review_stat->idx."&table=cs_goods_review&img=bbs_file&dire=bbsData&w=400&h=400");
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
		<table width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle">제품사용후기</td>
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
					<table width="100%">
						<tr>
							<td height="25">
							<table>
								<tr>
									<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle">제품사용후기</td>
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
														<td height="20"><img src="../img/tip_icon.gif" width="28" height="11"></td>
													</tr>
													<tr>
														<td class='sensbody'>질문글에 대한 답변글을 작성 하신 후에는 반드시 상태 변경(답변완료) 체크를 해주시기 바랍니다.</td>	
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
				if(choose) {	location.href='review_reset_ok.php?review_data=<?=$mv_data?>'; }
				else { return; }
			}
			//-->
			</script>

			<table width="100%" class="table_all">
				<form name="review_form" action="review_coment_ok.php" method="post">
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
					<td width="20%" height="35" bgcolor="E4E7EF" class='contenM tabletd_all'>사진</td>
					<td class='tabletd_all tabletd_small'>&nbsp;&nbsp;<?if($review_stat->bbs_file!="none"){?><a href="../../data/bbsData/<?=$review_stat->bbs_file;?>" rel="lightbox"><img src="../thumbnail.img.php?ThumbEncode=<?=$ThumbEncode?>" class='resizeM'></a><?}?></td>
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

			<table style='margin:0 auto;'>
				<tr>
					<td height='70'><a href="review.php?review_data=<?=$mv_data;?>" class="oolimbtn-botton1"> 돌아가기</a></td>
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

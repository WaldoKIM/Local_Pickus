<?
include('../header.php');
include($ROOT_DIR."/lib/page_class.php");
//$_GET=&$HTTP_GET_VARS; 
//$_POST=&$HTTP_POST_VARS;

// 상품리뷰레벨 수정(level) 변수
if($_POST[hidden_level_idx]) { $db->update("cs_goods_qna", "coment_check='$_POST[admin_auth]' where idx='$_POST[hidden_level_idx]'");}
$mv_data	= $_GET[review_data];
$review_data	= $tools->decode( $_GET[review_data] );
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $review_data[idx]; }
if($_GET[listNo] )					{ $listNo = $_GET[listNo]; }									else { $listNo = $review_data[listNo]; }
if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $review_data[startPage]; }
if($_POST[search_item] )	{ $search_item = $_POST[search_item]; }			else { $search_item	= $review_data[search_item]; }
if($_POST[search_order] )	{ $search_order = $_POST[search_order]; }		else { $search_order	= $review_data[search_order]; }
?>

<script language="JavaScript">
<!--
// 검색기능
function search(){
	var form=document.review_form;
	if(form.search_order.value=="")	{
		alert("검색할 내용을 입력해 주십시오.");
		form.search_order.focus();
	} else {
		form.submit();
	}
}

// 상품리뷰레벨수정
function authChange(form_data){
	form_data.submit();
}

// 상품리뷰정보 수정
function reviewView( mv_data ) {
	location.href='qna_view.php?review_data='+mv_data;
}

// 상품리뷰정보 삭제
function reviewDel( mv_data ) {
    var choose = confirm( '영구히 삭제 하시겠습니까?');
	if(choose) {	location.href='qna_del_ok.php?review_data='+mv_data; }
	else { return; }
}
////  회원에게 메일 보내기 ///////////////////////////////////////////////////////////////////////////////
function userSendmailWinOpen(data) {
	window.open("../member/user_sendmail.php?user_mail="+data,"","scrollbars=no, width=484, height=500");
}
//-->
</script>



<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/etc_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">

		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'>
					<img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">서비스 문의 관리
				</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#dddddd"></td>
			</tr>
			<tr>
				<td height="25" bgColor="white"></td>
			</tr>
			<tr>
				<td class="padding_5">
					<table  width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
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
									<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">서비스 문의 관리</td>
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
			<table width="100%" class="table_all">
				<tr height='40'> 
					<td bgcolor="E4E7EF" class='contenM tabletd_all revbox_none'>No</td>
					<td bgcolor="E4E7EF" class='contenM tabletd_all'>상태</td>
					<td bgcolor="E4E7EF" bgcolor="E4E7EF" class='contenM tabletd_all revbox_none'>상품명</td>
					<td bgcolor="E4E7EF" class='contenM tabletd_all'>제목</td>
					<td bgcolor="E4E7EF" class='contenM tabletd_all revbox_none'>ID</td>
					<td bgcolor="E4E7EF" class='contenM tabletd_all'>작성일</td>
				</tr>
				<?
				$listScale			=	15; 		// 리스트갯수
				$pageScale		=	15;		// 페이지 갯수
				if( !$startPage ) { $startPage = 0; }		// 스타트 페이지
				$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
				if( $search_item == 1 ) {
					$totalList	= $db->cnt( "cs_goods_qna", "where goods_name like '%$search_order%' and seller='$_SESSION[USERID]'" );
					$result		= $db->select( "cs_goods_qna", "where goods_name like '%$search_order%' and seller='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale" );
				} else if( $search_item == 2 ) {
					$totalList	= $db->cnt( "cs_goods_qna", "where goods_code like '$search_order' and seller='$_SESSION[USERID]'" );
					$result		= $db->select( "cs_goods_qna", "where goods_code like '$search_order' and seller='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale" );
				} else if( $search_item == 3 ) {
					$totalList	= $db->cnt( "cs_goods_qna", "where title like '%$search_order%' and seller='$_SESSION[USERID]'" );
					$result		= $db->select( "cs_goods_qna", "where title like '%$search_order%' and seller='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale" );
				} else if( $search_item == 4 ) {
					$totalList	= $db->cnt( "cs_goods_qna", "where userid like '$search_order' and seller='$_SESSION[USERID]'" );
					$result		= $db->select( "cs_goods_qna", "where userid like '$search_order' and seller='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale" );
				} else { 
					$totalList	= $db->cnt( "cs_goods_qna", "where seller='$_SESSION[USERID]'" );
					$result		= $db->select( "cs_goods_qna", "where seller='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale" );
				}
				
				$form_name=0; // 폼리스트 변수
				if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }		// 페이지넘버
				while( $row = mysqli_fetch_object($result)) {
						$form_name++; // 폼네임변경 숫자증가
						$member_stat=$db->object("cs_member", "where userid='$row->userid'", "email");
						$goods_stat=$db->object("cs_goods", "where idx='$row->goods_idx'");
						$review_data = $tools->encode("idx=".$row->idx."&startPage=".$startPage."&listNo=".$listNo."&search_item=".$search_item."&search_order=".$search_order);
						$goods_data = $tools->encode("idx=".$goods_stat->idx."&part_idx=".$goods_stat->part_idx);
				?>
				<form name="form_<?=$form_name?>" method="post" action="<?=$_SERVER[PHP_SELF];?>?review_data=<?=$review_data;?>">
				<input type="hidden" name="hidden_level_idx" value="<?=$row->idx;?>">
				<tr bgColor="white" align="center" height="25"> 
					<td class='tabletd_all tabletd_Lmall revbox_none'><?=$listNo;?></td>
					<td class='tabletd_all tabletd_Lmall'>
						<select name="admin_auth" class="input" onChange="javascript:authChange(document.form_<?=$form_name?>);">
							<option value="1" <? if( $row->coment_check == 1 ) { echo("selected");} ?>>답변완료</option>
							<option value="0" <? if( $row->coment_check == 0 ) { echo("selected");} ?>>미답변</option>
						</select>
					</td>
					<td class='tabletd_all tabletd_Lmall revbox_none'><a href="http://<?=$admin_stat->shop_url?>/product_view.php?goods_data=<?=$goods_data;?>" target="_NEW"><font color='909090'><?=$goods_stat->name;?></font></a></td>
					
					<td class='tabletd_all tabletd_Lmall' style='text-align:left;'><?=$row->title;?><a href="javascript:reviewView('<?=$review_data;?>');" class="menusmall_btn3">답글달기</a><br><span class='request_noneoolim'><font color='909090'><?=$goods_stat->name;?></font></span></td>
					
					<td class='tabletd_all tabletd_Lmall revbox_none'><a href="javascript:userSendmailWinOpen('<?=$member_stat->email;?>');"><font color='7AA9E9'><?=$row->userid;?></font></a></td>

					<td class='tabletd_all tabletd_Lmall'>
					<span class='revbox_on' style='text-align:center;'><font color='7AA9E9'><?=$row->userid;?></font></span>
					
					<font color='E35858'><?=$tools->strDateCut($row->register,1);?></font></td>
				</tr>
				</form>
				<?
					$listNo--;	
				}
				?>
				
				<? if( !$totalList ) { ?>
				<tr bgColor="white"> 
					<td height="100" colspan="7"  style='text-align:center'> 등록한 질문이 없습니다.</td>
				</tr>
				<?}?>
			</table>
			<table width="100%" class="submenu">
				<tr> 
					<td height="60" style='text-align:center' valign="middle"><? $page->review( $totalPage, $totalList, $listScale, $pageScale, $startPage, "<img src='../images/prev.gif' border='0'>", "<img src='../images/next.gif' border='0'>", $search_item, $search_order );?></td>
				</tr>
			</table>
			<table width="100%">
				<form action="<?=$_SERVER[PHP_SELF];?>" method="post" name="review_form">
				<tr> 
					<td height="25">
						<select name="search_item" class="input">
							<option value="1">상품이름</option>
							<option value="2">상품코드</option>
							<option value="3">리뷰제목</option>
							<option value="4"> 아 이 디</option>
						</select>
						<input name="search_order" type="text" class="formText" size="20" value="<?=$review_stat->title;?>"> <a href="javascript:search();" class='search_bbs'>검색</a>
					</td>
					<td height="25" align="right"></td>
				</tr>
				</form>
			</table><br>
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

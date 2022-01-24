<?
	$code="qna";
?>
<script language='javascript'>
	// 공지창 띄우기
	function openNotice(data) {
		window.open("notice.php?bbs_data="+data, "","scrollbars=yes, width=510, height=450");
	}
	//-->
</script>
<!--룰오버 메뉴시작-->
<table width="100%">
	<tr height='30'>
		<td width="40%" align="center" class='main_noticeQ' onclick="hiddenView('noticeqna','0')" style="CURSOR:pointer;"  title='공지사항'>공지사항</td>
		<td width="40%" align="center" onclick="hiddenView('noticeqna','1')" class='main_noticeL' style="CURSOR:pointer;"  title='질답게시판'>질답게시판</td>
		<td width="20%" id="btn-more-links"><a href="bbs_list.php?code=<?=$code?>" title="전체보기" id="link-btn-more-links"></a></td>
	</tr>
</table>
<!--룰오버 메뉴 끝-->
<div class="main_notice_contsL">
	<div id='main_notice_box'>
		<div id='main_notice_box_left2'></div>
		<div id='main_notice_box_right'>
			<table width="100%">
				<?
				$bbs_admin_stat = $db->object("cs_bbs", "where code='$code'");
				$notice_result		= $db->select("cs_bbs_data", "where code='$code'  order by ref desc, re_step ASC LIMIT 6" );
				$SEARCH_DATA = $tools->encode("code=".$code);
				while( $notice_row = @mysqli_fetch_object($notice_result)) {
					$subject				=		$tools->strHtmlNo($tools->strCut($notice_row->subject, 100));
					$new_check			=		$bbs_admin_stat->new_check;
					if( $new_check ) {	$new_img			=		$page->bbsNewImg( $notice_row->reg_date, $bbs_admin_stat->new_mark, "&nbsp;<img src='./images/icon_new1.gif' align='absmiddle' border='0'>" ); }
					$reg_date		=		$tools->strDateCut( $notice_row->reg_date );
					$bbs_data = $tools->encode("idx=".$notice_row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&code=".$code."&search_item=".$search_item."&search_order=".$search_order);
				?>
				<tr>
					<td class='notice_subI'><a href="bbs_list.php?boardT=v&board_data=<?=$bbs_data;?>&search_items=<?=$SEARCH_DATA?>"><?=$db->stripSlash($subject);?></a>
					</td>
				</tr>
				<?}?>
			</table>
		</div>
	</div>
</div>
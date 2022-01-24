<?
include('../common.php');
include($ROOT_DIR."/lib/page_class.php");
//게시판에 필요한 값들
$MV_DATA	= $_GET[board_data];
$BOARD_DATA	= $tools->decode( $_GET[board_data] );
if($_GET[idx] )					{ $idx = $_GET[idx]; }					else { $idx = $BOARD_DATA[idx]; }
if($_GET[listNo] )				{ $listNo = $_GET[listNo]; }			else { $listNo = $BOARD_DATA[listNo]; }
if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }		else { $startPage	= $BOARD_DATA[startPage]; }
if($_GET[totalList] )			{ $totalList = $_GET[totalList]; }		else { $totalList	= $BOARD_DATA[totalList]; }
$MV_SEARCH_ITEM	= $_GET[search_items];
$SEARCH_ITEM	= $tools->decode( $_GET[search_items] );
if($_GET[code] )			{ $code = $_GET[code]; }		else { $code = $SEARCH_ITEM[code]; }
if($_GET[search_item] )			{ $search_item = $_GET[search_item]; }		else { $search_item	= $SEARCH_ITEM[search_item]; }
if($_GET[search_order] )			{ $search_order = $_GET[search_order]; }		else { $search_order	= urldecode($SEARCH_ITEM[search_order]); }
if($_GET[boardT] )			{ $boardT = $_GET[boardT]; }		else { $boardT = $_POST[boardT]; }
if($_GET[goods_idx] )			{ $goods_idx = $_GET[goods_idx]; }		else { $goods_idx = $SEARCH_ITEM[goods_idx]; }
$SEARCH_DATA = $tools->encode("search_item=".$search_item."&search_order=".urlencode($search_order)."&goods_idx=".$goods_idx);
?>
<!DOCTYPE html>
<html lang="ko">
<title>상품평</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" media="all" href="css/joinform_layout.css" media="screen and (max-width:980px)">
<link rel="stylesheet" type="text/css" media="all" href="css/joinform_style.css">
<body text="black" link="blue" vlink="purple" alink="red">
<!-- 리뷰 정보 출력 -->
<script language="JavaScript">
	<!--
	function review(value){
		location.href = "product_review_write.php?trade_data=<?=$mv_data;?>&trade_code=<?=$trade_stat->trade_code?>&goods_idx="+value;
	}
	function reviewedit(value){
		<?if($_SESSION[USERID]){?>
			window.open("product_review_edit.php?trade_data=<?=$mv_data;?>&idx="+value, "","scrollbars=yes, width=500, height=400");
		<?}else{?>
			window.open("product_review_pwd.php?type=E&trade_data=<?=$mv_data;?>&idx="+value, "","scrollbars=yes, width=500, height=400");
		<?}?>
	}
	function review_del(value) {
		<?if($_SESSION[USERID]){?>
			var choose = confirm( '영구히 삭제 하시겠습니까?');
			if(choose) {	location.href='product_review_del.php?trade_data=<?=$mv_data;?>&idx='+value }
			else { return; }
		<?}else{?>
			window.open("product_review_pwd.php?type=D&trade_data=<?=$mv_data;?>&idx="+value, "","scrollbars=yes, width=484, height=400");
		<?}?>
	}
	//-->
</script>
<table class="review_iframe_table"style='width:100%'>
	<tr style="display:none;" class='bar_button_review'>
		<td style='width:60%' align="center" height="40" class="bbs2">제목</td>
		<td style='width:20%' align="center" class="bbs2">작성자</td>
		<td style='width:20%' align="center" class="bbs2 noneoolim">작성일</td>
	</tr>
		<?
		// 리스트갯수
		$listScale			=	10;
		// 페이지 갯수
		$pageScale		=	10;
		// 스타트 페이지
		if( !$startPage ) { $startPage = 0; }
		// 토탈페이지
		$totalPage = floor($startPage / ($listScale * $pageScale));
		$totalList	= $db->cnt("cs_goods_review", "where goods_idx='$goods_idx'");
		$review_result=$db->select("cs_goods_review", "where goods_idx='$goods_idx' order by idx desc LIMIT $startPage, $listScale");
		// 페이지넘버
		if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
		while( $review_row = @mysqli_fetch_object($review_result)) {
			$review_check++;
			$review_content = $tools->strHtmlNo($review_row->content);
			$bbs_data = $tools->encode("idx=".$review_row->idx."&startPage=".$startPage."&listNo=".$listNo);
			$ThumbEncode = $tools->encode("idx=".$review_row->idx."&table=cs_goods_review&img=bbs_file&dire=bbsData&w=120&h=120");
		?>
	<tr class="review_iframe_tr" bgcolor='#ffffff' style='border-bottom: 1px solid rgba(0,0,0,0.1);'>
		<td class="oolimitembbs"><?for($i=1;$i<=$review_row->star;$i++){?><i class='fa-star_rev fa-star'></i><?}?></td>
		<td align="left" class="oolimitembbs">
		<?if($review_row->bbs_file!="none"){?><img src="thumbnail.img.php?ThumbEncode=<?=$ThumbEncode?>" border="0" style='margin:5px 0 5px 0; border-radius:5px;' class='noneoolim'><?}?>
		
		<a href="<?if($review_row->hold==1 && $review_row->userid!=$_SESSION[USERID]){?>javascript:alert('권한이 없습니다.')<?}else{?>product_review_view.php?board_data=<?=$bbs_data;?><?}?>"><?=$review_row->title;?></a>
		</td>
		<td align="center" class="oolimitembbs">
		<?
		//작성자 이름 숨김 사용안함
		//for($i=0;$i<strlen($review_row->name);$i++){
		//	if($i < 2) echo substr($review_row->name, $i, 1); else echo "*";
		//}
		?>
		<?=$review_row->name;?>
		</td>
		
		<td align="center" class="oolimitembbs noneoolim">
		<?=$tools->strDateCut($review_row->register);?>
		</td>
		<td class="oolimitembbs">
			<? if( $review_row->coment_check == 1 ) { ?><span class='minibox_btn02_chomini_black'>답변완료</span><?}else if( $review_row->coment_check == 0 ) { ?><span class='minibox_btn03_chomini_black'>답변대기</span><?}?>
		</td>
	</tr>
	<?$listNo--; }?>
	<!-- 리뷰글이 없으면 출력 -->
	<? if(!$totalList) {?>
	<tr bgColor="white">
		<td align='center' colspan="4">
			<br>등록된 문의글이 없습니다<br><br>
		</td>
	</tr>
	<? }?>
</table>
<br>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td align='center'>
			<? $page->board( $totalPage, $totalList, $listScale, $pageScale, $startPage, "", "<img src='images/prev.gif' border='0' align='absmiddle'>", "<img src='images/next.gif' border='0' align='absmiddle'>", "", $SEARCH_DATA);?>
		</td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%" border='0'>
	<tr>
		<td align='right' style="padding-right:10px;"> <a href="javascript:<? if($_SESSION[USERID]) {?>review('<?=$goods_idx?>')<?}else{?>alert('회원 로그인 해주세요')<?}?>" class='btn-type2_view'>상품평쓰기</a></td>
	</tr>
	<tr>
		<td height='5'></td>
	</tr>
</table>
</body>
</html>
<style>
	
.review_iframe_table tbody{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
}
.review_iframe_tr{
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 33%;
	border: 1px solid #ededed !important;
    border-radius: 10px;
    box-shadow: 2px 3px 5px #ccc;
}
@media(max-width:1100px){
	.review_iframe_tr{
    	display: flex;
		flex-direction: column;
		align-items: center;
		width: 48%;
		border: 1px solid #ededed !important;
		border-radius: 10px;
		box-shadow: 2px 3px 5px #ccc;
		margin-left: 1%;
		margin-bottom: 1%;
}
}
</style>
<!-- .페이지 제목출력 -->
<?
$My_ch_arr = array("1", "1", "1", "1", "1","1", "1"); //1은 일반링크 2는 자바스크립트 새창
$My_page_arr = array("my_member_edit.php", "my_point_list.php", "my_review.php", "my_qna.php", "my_order_list.php", "my_wishlist.php");
$My_menu_arr = array("회원정보수정", "나의 적립금", "구매 후기", "상품 문의", "주문내역조회", "관심 상품");
if($TARGETFILENAME=="my_order_view.php") $TARGETFILENAME = "my_order_list.php";
if($TARGETFILENAME=="my_review_view.php" || $TARGETFILENAME=="my_review_edit.php") $TARGETFILENAME = "my_review.php";
if($TARGETFILENAME=="my_qna_view.php" || $TARGETFILENAME=="my_qna_edit.php") $TARGETFILENAME = "my_qna.php";

?>
<div class="left_gnb"><!--전체사이즈-->
	<h3>마이페이지</h3>
	<ul class="menu"><!--줄간격-->
		<?for($i=0;$i<count($My_menu_arr);$i++){?>
			<li><button class="<?if(array_search($TARGETFILENAME, $My_page_arr)==$i){?>sensbutton-checked<?}else{?>sensbutton<?}?>" onclick="<?if($My_ch_arr[$i]==1){?>location.href='<?=$My_page_arr[$i]?>'<?}else{?><?=$My_page_arr[$i]?><?}?>"><?=$My_menu_arr[$i]?></button></li>
		<?}?>
	</ul>
	<ul class="info">
		<li class="tel">
			<a href="tel:<?=$admin_stat->shop_tel1;?>"><?=$admin_stat->shop_tel1;?></a>
		</li>
		<li class="time"><?=$tools->strHtmlBr($admin_stat->week);?></li>
		<?
		$bankResult = $db->select( "cs_banklist", "where main_marking=1 order by idx asc");
		while( $bankRow = @mysqli_fetch_object($bankResult) ) {?>
		<?}?>
	</ul>
</div>

<script language="javascript">
	<!--
	function link_change(value) {
		location.href=value;
	}
	//-->
</script>

<? include('./include/head.inc.php');?>
<?

if($_GET[idx]) {
$pageview_stat = $db->object("cs_main_flash", "where idx='$_GET[idx]'");
$content = $pageview_stat->content;
$title = $pageview_stat->subject;
} else {
$pageview_stat = $db->object("cs_main_flash", "order by idx desc limit 1");
$content = $pageview_stat->content;
$title = $pageview_stat->subject;
}
?>
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
				<li>기획전&amp;이벤트</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section event_view_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<h3 class="tit">기획전&amp;이벤트</h3>
					<!--********************내용영역 출력 시작********************-->
					<p class='eventpage_table_title'><?=$title?></p>
					<div class='info_tumb_oolim_view_box'><?=$content;?></div>
					<a href="event_list.php" class="oolimbtn-botton1">목록으로</a>
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
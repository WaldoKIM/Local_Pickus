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
	<section id="blog" class="section event_list_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************내용영역 출력 시작********************-->
					<h3 class="tit">기획전&amp;이벤트</h3>
					<div class="list_tb">
						<table>
							<tr>
								<th>제목</th>
							</tr>
							<!-- 타이틀 미리 나올수 있도록 info_tumb_oolim 추가 -->
							<? if($db->cnt( "cs_main_flash", "" )) {?>
							<?
							$flash_result = $db->select("cs_main_flash", "order by idx asc");
							while( $flash_row = @mysqli_fetch_object( $flash_result )) {
							?>
							<tr>
								<td><a href="event_view.php?idx=<?=$flash_row->idx;?>"><span><?=$flash_row->subject?><?=$flash_row->subject?></span></a></td>
							<?}?>
							</tr>
							<? } ?>
						</table>
					</div>
					<script>
					// vars
					var filter_link = $('ul#filter a'),
						filter_current = $('ul#filter .current'),
						gallery_item = $('.tumb_oolim');
					filter_link.click(function(){
						// Remove class
						filter_current.siblings().removeClass('current');
						filter_current.removeClass('current');
						// Add parent class
						$(this).parent().addClass('current');
						// find same class of menu
						var filterVal = $(this).text().toLowerCase();
						if(filterVal == 'all') {
						// Each all and filter values
						gallery_item.each(function() {
							$(this).removeClass('blurme_tumb_oolim')
							.parent().addClass('info_tumb_oolim');
						});
						}else{
						// Each all and filter values
						gallery_item.each(function() {
							// Hide
							if(!$(this).hasClass(filterVal)) {
							$(this).addClass('blurme_tumb_oolim')
							.parent().addClass('info_tumb_oolim');
							}else{
							$(this).removeClass('blurme_tumb_oolim')
							.parent().removeClass('info_tumb_oolim');
							}
						});
						}
						return false;
					});
					// simply preloader
					gallery_img.each(function() {
						$(this).css({opacity: 0}).load(function() {
						$(this).animate({opacity: 1}, 1000);
						}).attr('src', $(this).data('src'))
						// wait and remove data-src
						.delay(100)
						.attr('data-src','');
					});
					</script>
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->
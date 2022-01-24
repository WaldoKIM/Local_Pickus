<? include('./include/head.inc.php');?>
<?

if($_GET[url]) {
$pageview_stat = $db->object("cs_page", "where page_index='$_GET[url]'");
$content = $pageview_stat->content;
$title = $pageview_stat->title;
} else {
$tools->errMsg('잘못된 접근입니다');
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
				<li><?=$title;?></li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section page_view_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************내용영역 출력 시작********************-->
					<!--페이지서브메뉴-->
					<? include('./include/pagesub_menu.inc.php');?>
					<!--페이지서브메뉴-->
					<div class="main">
						<h3 class="tit"><?=$title;?></h3>
						<div class='joinform_size'>
							<table width="100%">
								<?if($pageview_stat->title_img){?>
								<tr>
									<td align='left'>
										<img src='../data/designImages/<?=$pageview_stat->title_img?>' border='0' align='absmiddle'>
									</td>
								</tr>
								<?}?>
								<tr>
									<td align='left' class="menu">
										<?=$content;?>
									</td>
								</tr>
							</table>
						</div>
					</div>
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
<? include('./include/head.inc.php');?>
<? include($ROOT_DIR."/lib/page_class.php");?>
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
				<li><i class="fas fa-arrow-left"></i>고객센터</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section bbs_sub_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--페이지서브메뉴-->
					<? include('./include/bbssub_menu.inc.php');?>
					<!--페이지서브메뉴-->
					<!--********************내용영역 출력 시작********************-->
					<div class="bbs_data_area">
						<h3 class="customer_tit">고객센터</h3>
						<!--상단안내-->
						<div class="customer_top">
							<ul class="left">
								<li class="tel"><?=$admin_stat->shop_tel1;?></li>
								<li class="time"><?=$tools->strHtmlBr($admin_stat->week);?></li>
								<?
								$bankResult = $db->select( "cs_banklist", "where main_marking=1 order by idx asc");
								while( $bankRow = @mysqli_fetch_object($bankResult) ) {?>
								<li class="bank">
									<span>계좌번호 : <?=$bankRow->bank_account?></span>
									<span><?=$bankRow->bank_name?> &nbsp;|&nbsp; <?=$bankRow->name?></span>
								</li>
								<?}?>
							</ul>
							<ul class="right">
								<li class="tit">카카오톡 친구찾기에서 <br /><span><?=$admin_stat->shop_name;?></span> 검색</li>
								<li class="time">상담시간:<?=$tools->strHtmlBr($admin_stat->week);?></li>
								<li><a href="#"><img src="images/kakao_counsel_btn.gif"/></a></li>
							</ul>
						</div>
						<!--//상단안내-->
						<!--최근게시글-->
						<div class="customer_latest">
							<!--FAQ-->
							<div class="left latest_data">
								<h2>자주찾는 FAQ<a href="bbs_list.php?code=faq" title="전체보기">+</a></h2>
								<table width="100%" class="faq_latest">
									<?
										$code="faq";
										$bbs_admin_stat = $db->object("cs_bbs", "where code='$code'");
										$notice_result		= $db->select("cs_bbs_data", "where code='$code'  order by ref desc, re_step ASC LIMIT 9" );
										$i=0;
										while( $notice_row = @mysqli_fetch_object($notice_result)) {
											$i++;
											$subject				=		$tools->strCut($notice_row->subject, 95);
											$new_check			=		$bbs_admin_stat->new_check;
											if( $new_check ) {	$new_img			=		$page->newImg( $notice_row->reg_date, $bbs_admin_stat->new_mark, "&nbsp;&nbsp;<img src='./images/new3.gif'>" ); }
											$bbs_data = $tools->encode("idx=".$notice_row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table);
											$SEARCH_DATA = $tools->encode("code=".$code."&search_item=".$search_item."&search_order=".$search_order);
										?>
									<tr>
										<td><a href="bbs_list.php?board_data=<?=$bbs_data;?>&search_items=<?=$SEARCH_DATA?>&view=<?=$notice_row->idx?>"><span>Q</span><?=$db->stripSlash($subject);?></a><?=$new_img?><?=$new_img?>
										</td>
									</tr>
									<?}?>
								</table>
							</div>
							<!--//FAQ-->
							<!--공지사항 & NEWS-->
							<div class="right">
								<!--Notice-->
								<div class="latest1 latest_data">
									<h2>공지사항<a href="bbs_list.php?code=news" title="전체보기">+</a></h2>
									<div>
										<ul>
											<?
												$code="news";
												$bbs_admin_stat = $db->object("cs_bbs", "where code='$code'");
												$notice_result		= $db->select("cs_bbs_data", "where code='$code'  order by ref desc, re_step ASC LIMIT 6" );
												while( $notice_row = @mysqli_fetch_object($notice_result)) {
													$subject				=		$tools->strCut($notice_row->subject, 95);
													$new_check			=		$bbs_admin_stat->new_check;
													if( $new_check ) {	$new_img			=		$page->newImg( $notice_row->reg_date, $bbs_admin_stat->new_mark, "&nbsp;&nbsp;<img src='./images/new3.gif'>" ); }
													$bbs_data = $tools->encode("idx=".$notice_row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table);
													$SEARCH_DATA = $tools->encode("code=".$code."&search_item=".$search_item."&search_order=".$search_order);
												?>
											<li>
												<a href="bbs_list.php?boardT=v&board_data=<?=$bbs_data;?>&search_items=<?=$SEARCH_DATA?>"><?=$db->stripSlash($subject);?></a><?=$new_img?>
											</li>
											<?}?>
										</ul>
									</div>
								</div>
								<!--//Notice-->
								<!--News-->
								<div class="latest2 latest_data">
									<h2>포토리뷰<a href="bbs_list.php?code=nomalphoto" title="전체보기">+</a></h2>
									<div>
										<ul>
											<?
												$code="nomalphoto";
												$bbs_admin_stat = $db->object("cs_bbs", "where code='$code'");
												$notice_result		= $db->select("cs_bbs_data", "where code='$code'  order by ref desc, re_step ASC LIMIT 6" );
												while( $notice_row = @mysqli_fetch_object($notice_result)) {
													$subject				=		$tools->strCut($notice_row->subject, 95);
													$new_check			=		$bbs_admin_stat->new_check;
													if( $new_check ) {	$new_img			=		$page->newImg( $notice_row->reg_date, $bbs_admin_stat->new_mark, "&nbsp;&nbsp;<img src='./images/new3.gif'>" ); }
													$bbs_data = $tools->encode("idx=".$notice_row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table);
													$SEARCH_DATA = $tools->encode("code=".$code."&search_item=".$search_item."&search_order=".$search_order);
												?>
											<li>
												<a href="bbs_list.php?boardT=v&board_data=<?=$bbs_data;?>&search_items=<?=$SEARCH_DATA?>"><?=$db->stripSlash($subject);?></a><?=$new_img?>
											</li>
											<?}?>
										</ul>
									</div>
								</div>
								<!--//News-->
							</div>
							<!--//공지사항 & NEWS-->
						</div>
						<!--//최근게시글-->
					</div><!--customer_divcont-->
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
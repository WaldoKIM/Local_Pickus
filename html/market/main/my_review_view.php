<? include('./include/head.inc.php');?>
<? include($ROOT_DIR.'/lib/page_class.php');
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
$review=$db->object("cs_goods_review", "where idx='$idx'");
$goods_stat = $db->object("cs_goods", "where idx='$review->goods_idx'");
$goods_data = $tools->encode("idx=".$goods_stat->idx."&part_idx=".$goods_stat->part_idx);
?>
<script language="javascript">
<!--
	function board_del() {
		var choose = confirm( '영구히 삭제 하시겠습니까?');
		if(choose) {	location.href='my_review_del.php?board_data=<?=$MV_DATA;?>' }
		else { return; }
	}
//-->
</script>
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
				<li><i class="fas fa-arrow-left"></i>마이페이지</li>				
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li><i class="fas fa-arrow-left"></i>구매 후기 보기</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section order_check login_check_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************내용영역 출력 시작********************-->
					<!--페이지서브메뉴-->
					<? include('./include/mymenu.inc.php');?>
					<!--페이지서브메뉴-->
					<div class="main">
						<h2 class="tit">구매 후기 보기</h2>
						
								<table class="my_qna_view_table" width="100%">
									<tr>
										<td width="7" colspan="2" height="2" bgColor='#333333'></td>
									</tr>
									<?if($review->bbs_file != "none"){?>
									<tr>
										<td width='20%' height="65" align="center" bgcolor="#f8f8f8" class='oolimmobilemenuM'>제품정보</td>
										<td height="45" style="padding-left:3px" align="left" class='oolimitembbs'>
											<div id='rev_view_box'>
												<div id='rev_view_box_left'>
													<span style='color:#333;font-size:13pt;'><i class="rev_viewsubject_icon"></i>서비스 : <?=$db->stripSlash($goods_stat->name);?></span>
													<div class='spaceline05'></div>
													<i class="rev_viewsubject_icon"></i>판매가격 : <span class="product-viewbox_price"><?=number_format($goods_stat->shop_price);?>원</span>
													<div class='spaceline05'></div>
													<i class="rev_viewsubject_icon"></i>적립금 : <?=number_format($goods_stat->shop_price*$goods_stat->point*0.01);?>point
													<div class='spaceline05'></div>
													<i class="rev_viewsubject_icon"></i>배송방법 : <?=$admin_stat->delivery_company;?> (<span class='product_price_point'><?=number_format($admin_stat->express_free)?></span>원 이상 무료배송)
													<div class='spaceline05'></div>
													<i class="rev_viewsubject_icon"></i>브랜드 : <?=$goods_stat->company;?>
													<div class='spaceline05'></div>
													<i class="rev_viewsubject_icon"></i>판매수량 : <? if($goods_stat->unlimit==0) { if($goods_stat->number==0) { echo('품절'); } else { echo($goods_stat->number."&nbsp;개");}} else { echo('재고보유');}?>
													<div class='spaceline05'></div>
												</div>
												<div id='rev_view_box_right'>
													<img src="../data/bbsData/<?=$review->bbs_file?>" style='width:100%;'>
												</div>
											</div>
											<div style='width:100%;padding:1em;'><a href="product_view.php?goods_data=<?=$goods_data;?>" class="oolimbtn-botton1" style="width:100px">서비스 상세보기</a></div>
										</td>
									</tr>
									
									<?}?>
									<tr>
										<td><?for($i=1;$i<=$review->star;$i++){?><i class='fa-star_rev fa-star'></i><?}?></td>
										<td >이름 : <?=$review->name?></td>
										<td>제목 : <span style='color:#333;font-size:12pt;'><?=$review->title?></span></td>
										<td>후기 : <?=$review->content?></td>
										<?if($review->coment_check==1){?>
										<td>답변 : <?=$review->coment?></td>
										<?}?>
									</tr>
								</table>
								<div style='margin:1em auto; width:100%;text-align:center'>
									<a href="javascript:history.go(-1);" class="oolimbtn-botton1" style="width:100px">목록으로</a>
									<?if($review->coment_check!=1){?>
									<a href="my_review_edit.php?board_data=<?=$MV_DATA;?>" class="oolimbtn-botton2" style="width:100px">수정</a>
									<a href="javascript:board_del()" class="oolimbtn-botton3" style="width:100px">삭제</a>
									<?}?>
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
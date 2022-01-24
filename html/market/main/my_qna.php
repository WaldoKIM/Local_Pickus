<? include('./include/head.inc.php');?>
<? include($ROOT_DIR.'/lib/page_class.php');
	// 회원체크
	if( !$_SESSION[USERID] || !$_SESSION[PASSWD] ) {
		// 로그인 상태가 아니면 회원 로그인으로 보낸다
		//$tools->metaGo('login.php?login_go='.$_SERVER[REQUEST_URI]);
		$tools->metaGo('../../bbs/login.php?login_go=myp_qna.php');
	}
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
				<li><i class="fas fa-arrow-left"></i>상품문의</li>
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
						<h2 class="tit">상품문의</h2>
						<table class="my_qna_flex"style='width:100%'>
							<tr style="display:none;" class='bar_button_review'>
								<td style='width:10%' height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>번호</td>
								<td style='width:30%' height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>상품명</td>
								<td style='width:50%' height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>제목</td>
								<td style='width:10%' height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>작성일</td>
							</tr>
								<?
								$listScale			=	10; 		// 리스트갯수
								$pageScale		=	10;		// 페이지 갯수
								if( !$startPage ) { $startPage = 0; }		// 스타트 페이지
								$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
								$totalList	= $db->cnt( "cs_goods_qna", "where userid='$_SESSION[USERID]'" );
								$result		= $db->select( "cs_goods_qna", "where userid='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale" );
								$form_name=0; // 폼리스트 변수
								if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }// 페이지넘버
								while( $review_row = mysqli_fetch_object($result)) {
								$goods_stat = $db->object("cs_goods", "where idx='$review_row->goods_idx'");
								$goods_data = $tools->encode("idx=".$goods_stat->idx."&part_idx=".$goods_stat->part_idx);
								$review_content = $tools->strHtmlNo($review_row->content);
								$bbs_data = $tools->encode("idx=".$review_row->idx."&startPage=".$startPage."&listNo=".$listNo);
								//비밀글
								$hold_img="";
								if($review_row->hold==1){
									$hold_img = "<img src='images/key_icon.gif' hspace='5' border='0' align='absmiddle'>";
								}
								?>
							<tr class="my_qna_tr mypage_design" style='border-bottom: 1px solid rgba(0,0,0,0.1);' id='calendar_list_tableTD_on'>
								<td class='mypage_border calendar_list_tableTD_bg' style='text-align:center;'>
									<div class="mypage_design_font">No</div><?=$listNo;?>
								</td>
								<td class='mypage_border calendar_list_tableTD_bg' style='text-align:center;line-height:18px;'>
									<div class="mypage_design_font">상품명</div><a href="product_view.php?goods_data=<?=$goods_data;?>"><?=$tools->strCut($review_row->goods_name, 100);?></a>
								</td>
								<td class='mypage_border calendar_list_tableTD_bg' style='text-align:center;'>
									<div class="mypage_design_font">제목</div>
									<a href="my_qna_view.php?board_data=<?=$bbs_data;?>"><?=$review_row->title;?></a>&nbsp;<?=$hold_img?>&nbsp;
								</td>
								
								<td class='mypage_border calendar_list_tableTD_bgright' style='text-align:center;line-height:18px;'>
									<div class="mypage_design_font">내용</div><?=$review_row->content;?>
								</td>
								<td class='mypage_border calendar_list_tableTD_bgright' style='text-align:center;line-height:18px;'>
									<div class="mypage_design_font">작성일</div><?=$tools->strDateCut($review_row->register);?>
								</td>
								<td class='mypage_border calendar_list_tableTD_bgright' style='text-align:center;line-height:18px; justify-content: center;'>
									<? if( $review_row->coment_check == 1 ) { ?><span style="width: auto;"class='company_smallBtn03'>답변완료</span><?}else if( $review_row->coment_check == 0 ) { ?><span style="width: auto;" class='company_smallBtn01'>답변대기</span><?}?>
								</td>
							</tr>
							<?
								$listNo--;
							}
							?>
							<? if( !$totalList ) { ?>
							<tr align="center">
								<td height="100" colspan="4" align="center" class='sens_body2' style='border-bottom: 1px solid rgba(0,0,0,0.1);'>
									 등록된 내용이 없습니다.
								</td>
							</tr>
							<? }?>
						</table>
						<div class='spacelin11'></div>
						<div style='height:50px;width:100%;text-align:center'>
							<? $page->board( $totalPage, $totalList, $listScale, $pageScale, $startPage, "", "<img src='images/prev.gif' border='0' align='absmiddle'>", "<img src='images/next.gif' border='0' align='absmiddle'>", "", $SEARCH_DATA);?>
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
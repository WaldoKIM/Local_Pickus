<? include('./include/head.inc.php');?>
<? include($ROOT_DIR.'/lib/page_class.php');?>
<?
	// 회원체크
	if( !$_SESSION[USERID] || !$_SESSION[PASSWD] ) {
		// 로그인 상태가 아니면 회원 로그인으로 보낸다
		//$tools->metaGo('login.php?login_go='.$_SERVER[REQUEST_URI]);
		$tools->metaGo('../../bbs/login.php?login_go=my_point_list.php');
	}
?>
<?
 
$mv_data	= $_GET[point_data];
$review_data	= $tools->decode( $_GET[point_data] );
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $review_data[idx]; }
if($_GET[listNo] )					{ $listNo = $_GET[listNo]; }									else { $listNo = $review_data[listNo]; }
if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $review_data[startPage]; }
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
				<li><i class="fas fa-arrow-left"></i>나의적립금</li>
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
						<h2 class="tit">나의적립금</h2>
						<table width="90%">
							<tr>
								<td style='text-align:right' class='ordertitle' height="45">
									현재  나의 적립금 : <font color='FF7800'><? $total_point = $db->sum("cs_point", "where userid='$_SESSION[USERID]'", "point"); echo(number_format($total_point));?></font>&nbsp;원
								</td>
							</tr>
						</table>
						<table width="90%" style='margin:0 auto;'>
							<tr style="display:none;" class='bar_button_review'>
								<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>거래내역</td>
								<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>적립금</td>
								<td height='50' class='calendar_list_table_bg calendar_list_tableTD_bgtitleB'>거래일자</td>
							</tr>
							<?
								$listScale			=	10; 		// 리스트갯수
								$pageScale		=	10;		// 페이지 갯수
								if( !$startPage ) { $startPage = 0; }		// 스타트 페이지
								$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
								$totalList	= $db->cnt( "cs_point", "where userid='$_SESSION[USERID]'" );
								$result	= $db->select("cs_point", "where userid='$_SESSION[USERID]' order by idx desc LIMIT $startPage, $listScale" );
								if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }		// 페이지넘버
								while( $row = mysqli_fetch_object($result)) {
								?>
							<tr id='mypage_design calendar_list_tableTD_on'>
								<td height="45" class='mypage_border calendar_list_tableTD_bg' style='text-align:center;'>
									<div class="mypage_design_font">거래내역</div><?=$row->title;?>
								</td>
								<td height="45" class='mypage_border calendar_list_tableTD_bg' style='text-align:center;'>
									<!-- 포인를 사용한 경우 색상변경 --> <div class="mypage_design_font">적립금</div><? if($row->point < 0) {?><font color="#FF7800"><?=number_format($row->point);?></font><?} else {?><font color="#3A73BF"><?=number_format($row->point);?><?}?></font> 원
								</td>
								<td height="45" class='mypage_border calendar_list_tableTD_bgright' style='text-align:center;'>
									<div class="mypage_design_font">거래일자</div><?=$tools->strDateCut($row->register, 1);?>
								</td>
							</tr>
							<?}?>
						</table>
						<table STYLE='margin:0 auto; width:100%;text-align:center;'>
							<tr>
								<td STYLE='padding:20px;'>
									<? $page->my_point( $totalPage, $totalList, $listScale, $pageScale, $startPage, "", "", "", "");?>
								</td>
							</tr>
						</table>
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
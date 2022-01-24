<? include('./include/head.inc.php'); ?>
<? include($ROOT_DIR . "/lib/page_class.php"); ?>
<?
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//=======       POPUP 창 설정 ==========================================================
//--with KJS dance--
/*$popup_result = $db->select("cs_popup", "");
$now_time = time();
while ($popup_row = @mysqli_fetch_object($popup_result)) {
	if ($_COOKIE['POPUP_COOKIE_' . $popup_row->idx] != 'NO') {
		if ($popup_row->start_day <= $now_time && $popup_row->end_day >= $now_time) {
			$popup_row->height = $popup_row->height + 24;
			$code = $popup_row->idx;
			include "popup.layer.php";
?>
			<script>
				$(document).ready(function() {
					$("#POPUP_COOKIE_<?= $code ?>").draggable();
				});
			</script>
<?
		}
	}
}
*/
//=====================================================================================
?>
<SCRIPT LANGUAGE="JavaScript">
	<!--
	function hiddenView(target, value) {
		for (i = 0; i < document.all[target].length; i++) {
			document.all[target][i].style.display = "none";
		}
		document.all[target][value].style.display = "";
	}
	//
	-->
</SCRIPT>
<!--상단로고, 가이드메뉴-->
<? include('./include/top_guide.inc.php'); ?>
<? include('./include/top_menu.inc.php'); ?>
<? include('include/subtitle.inc.php'); ?>
<!-- // 상단테이블 끝-->
<!--/********************여기부터 메인영역 시작********************/-->
<!--반응형솔루션소개-->
<section id="blog" class="section">
	<div class="container-fluid">
		<div class="row">
			<div class="to_animate" style='width:90%;margin:0 auto; min-height:20em; padding:2em 0;max-width:1200px'>
				<div class="main">
					<!--메인 베스트상품 출력 시작-->
					<?
					$main_position = 1;
					include('main_event_item.inc.php');
					?>
					<!--메인 베스트상품 출력 ENd-->
				
					<!--메인 신상품 출력 시작-->
					<?
					$main_position = 2;
					include('main_event_item.inc.php');
					?>
					<!--메인 신상품 출력 ENd-->

					<!--메인 배너 출력-->
					<div class="subbanners">
						<? include("./include/banner_code1.inc.php"); ?>
					</div>
					<!--메인 배너 출력ENd-->

					<!--메인 추천상품 출력 시작-->
					<?
					$main_position = 3;
					include('main_event_item.inc.php');
					?>
					<!--메인 추천상품 출력 ENd-->
					<!--메인 할인상품 출력 시작-->
					<?
					$main_position = 4;
					include('main_event_item.inc.php');
					?>
					<!--메인 할인상품 출력 ENd-->
				</div>
			</div>
			<!--to_animate-->
		</div>
		<!--row-->
		<div class="row" style="display:none">
			<!--메인 배너 출력-->
			<div class="main_mid_banners">
				<? include("./include/banner_code9.inc.php"); ?>
			</div>
		</div>
		<!--******************사용후기 출력******************-->
		<div style="display:none;" class="row" style="background-color:#EFEFEF">
			<div class="to_animate" style='width:90%;margin:0 auto; min-height:20em;max-width:1200px;'>
				<div class="main">
					<div class='oolimbox-wrapper oolimbox-grid5'>
						<!--공지사항출력시작-->
						<? include('./include/main_notice.inc.php'); ?>
						<!--공지사항출력끝-->
						<!--고객센터 안내-->
						<div class="main_center_info">
							<h3><?= $admin_stat->shop_name; ?> 고객센터</h3>
							<div class="info_data">
								<a href="tel:<?= $admin_stat->shop_tel1; ?>" class="center_tel"><?
																								if (!function_exists('str_split')) {
																									function str_split($string, $string_length = 1)
																									{
																										if (strlen($string) > $string_length || !$string_length) {
																											do {
																												$c = strlen($string);
																												$parts[] = substr($string, 0, $string_length);
																												$string = substr($string, $string_length);
																											} while ($string !== false);
																										} else {
																											$parts = array($string);
																										}
																										return $parts;
																									}
																								}
																								$shopTel = str_split($admin_stat->shop_tel1);
																								for ($i = 0; $i < count($shopTel); $i++) {
																									if (!preg_match("/([0-9])/", $shopTel[$i])) {
																								?><span class='main_cscenter_m1_tel'>-</span><? } else { ?><span class='main_cscenter_m1_tel'><?= $shopTel[$i] ?></span><? } ?><? } ?>
								</a>
								<ul class="other_info">
									<li class="time"><?= $tools->strHtmlBr($admin_stat->week); ?></li>
									<?
									$bankResult = $db->select("cs_banklist", "where main_marking=1 order by idx asc");
									while ($bankRow = @mysqli_fetch_object($bankResult)) { ?>
										<li class="bank">계좌번호 : <?= $bankRow->bank_account ?></li>
										<li class="bank"><?= $bankRow->bank_name ?> &nbsp;|&nbsp; <?= $bankRow->name ?></li>
									<? } ?>
									<li class="time">카카오톡 채널 : <a href="http://<?= $admin_stat->kakao_chnl; ?>" target="_blank"><?= $tools->strHtmlBr($admin_stat->kakao_chnl); ?></a></li>
									<li class="time">카카오톡 ID : <?= $tools->strHtmlBr($admin_stat->kakao_id); ?></li>
								</ul>
								<div class="btn">
									<?/*<a href="mail_to_admin.php" class='contactus'>Contact Us</a>*/ ?>
									<a href="customer.php" class="customer">고객센터</a>
								</div>
							</div>
						</div>
						<!--//고객센터 안내-->
						<!--Infomation SNS-->
						<div class="main_info_sns">
							<ul>
								<li><a href="./bbs_list.php?code=faq"><img src="images/main_info_icon1.png" /><span>FAQ</span></a></li>
								<li><a href="./bbs_list.php?code=qna"><img src="images/main_info_icon2.png" /><span>1:1 문의</span></a></li>
								<li><a href="./pageview.php?url=guide"><img src="images/main_info_icon3.png" /><span>이용안내</span></a></li>
								<? if ($db->cnt("cs_mobile_main", "where 1 order by ranking asc")) { ?>
									<?
									$mainCnt = 0;
									$mainresult	= $db->select("cs_mobile_main", "where open=1 order by ranking asc");
									while ($mainrow = mysqli_fetch_object($mainresult)) {
										$mainCnt++;
										$iconinfo = $db->object("cs_mobile_icon", "where idx='$mainrow->icon'");
										$iconsize = @getimagesize("../data/designImages/" . $iconinfo->icon);
									?>
										<li><a href="<?= $mainrow->linkurl ?>" target="_blank"><img src="../data/designImages/<?= $iconinfo->icon ?>" title="<?= $mainrow->name ?>"><span><?= $mainrow->name ?></span></a></li>
									<? } ?>
								<? } else { ?>
								<? } ?>
							</ul>
						</div>
						<!--//Infomation SNS-->
					</div>
				</div>
			</div>
			<!--to_animate-->
		</div>
	</div>
	<!--container-fluid-->
</section>
<!--******************메인테이블 끝******************-->
<SCRIPT LANGUAGE="JavaScript">
	<!--
	function hiddenView(target, value) {
		for (i = 0; i < document.all[target].length; i++) {
			document.all[target][i].style.display = "none";
		}
		document.all[target][value].style.display = "";
	}
	//
	-->
</SCRIPT>
<!--하단 카피라이트-->
<? include('./include/footer.inc.php'); ?>
<!-- // 하단테이블 끝-->
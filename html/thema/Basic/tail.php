<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>
<?php if ($col_name) { ?>
	<?php if ($col_name == "two") { ?>
		</div>
		<div class="col-md-<?php echo $col_side; ?><?php echo ($at_set['side']) ? ' pull-left' : ''; ?> at-col at-side">
			<?php include_once($is_side_file); // Side 
			?>
		</div>
		</div>
	<?php } else { ?>
		</div><!-- .at-content -->
	<?php } ?>
	</div><!-- .at-container -->
<?php } ?>
</div><!-- .at-body -->

<?php if (!$is_main_footer) { ?>
	<div class="footer if_main">
		<!-- 푸터메뉴 -->
		<div class="bottom_menu mobile_none">
			<div class="layout_fix">
				<div class="left_menu">
					<ul>
						<!--<li><a href="/?pn=member.login.form&_rurl=%2F%3F" class="btn">로그인</a></li>
						<li><a href="/?pn=member.join.agree" class="btn">회원가입</a></li>
						<li><a href="/?pn=service.guest.order.list" class="btn">주문조회</a></li> -->

						<li><a href="/bbs/content.php?co_id=company" class="btn">회사소개</a></li>
						<li><a href="/bbs/content.php?co_id=provision" class="btn">이용약관</a></li>
						<li><a href="/bbs/content.php?co_id=privacy" class="btn">개인정보처리방침</a></li>
						<li><a href="/bbs/content.php?co_id=deny" class="btn">이메일무단수집거부</a></li>
					</ul>
				</div>

				<!-- sns -->
				<div class="sns_box">
					<ul>
						<!-- 관리자에서 sns링크 걸어둘 경우 노출 /  링크 없으면 li 삭제 -->
						<li>
							<a href="https://www.instagram.com/official_pickus/" class="sns" title="인스타그램" target="_blank"><img src="/images/b_insta.png" alt="인스타그램"></a>
						</li>
						<li>
							<a href=" https://www.facebook.com/pickus2" class="sns" title="페이스북" target="_blank"><img src="/images/b_facebook.png" alt="페이스북"></a>
						</li>
						<li>
							<a href="http://blog.naver.com/pickus" class="sns" title="블로그" target="_blank"><img src="/images/b_blog.png" alt="블로그"></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<style type="text/css">
			.gdrNna {
				bottom: 90px !important;
			}

			.footer .sns_box .sns img {
				width: auto;
			}

			#fixed_kakao {

				position: fixed;
				bottom: 95px;
				right: 70px;
				z-index: 100
			}

			#fixed_kakao img {
				width: 165px;
			}

			@media(max-width: 768px) {
				#fixed_kakao {
					right: 6px;
					bottom: 100px;
				}

				#fixed_kakao img {
					width: 53px;
				}

				.mobile_none {
					display: none;
				}
			}
		</style>
		<?php if ($member['mb_level'] == '2') { ?>
			<style type="text/css">
				#fixed_kakao {
					display: none;
				}
			</style>
		<?php } ?>
		<div id="fixed_kakao">
			<a target="_blank" href="http://pf.kakao.com/_qBNaxl/chat"><img src="/images/btn_kakao.png" class="mobile"><img style="width:62px;" src="/images/btn_kakao.png" class="web"></a>
		</div>
		<div class="layout_fix mobile_none">
			<ul class="copyright">
				<li class="li info">
					<!-- 회사/사이트 정보 -->
					<ul class="info_box">
						<li>
							<div class="logo_box">
								<dl>
									<dt>
										<img src="/images/928194268.png" alt="">
									</dt>
									<dd>
										<div class="shop_name">피커스</div>
									</dd>
								</dl>
							</div>
						</li>
						<li>
							<span class="txt">상호명 : 디휴브</span>
							<span class="txt">대표: 천정훈</span>
							<span class="txt">대표전화: 1800-5528</span>
						</li>
						<li>
							<span class="txt">통신판매업 신고번호 : 제 2017-고양일산동-1604호</span>
							<span class="txt">
								사업자 등록번호: 291-39-00208 <a href="#none" onclick="window.open('http://www.ftc.go.kr/info/bizinfo/communicationViewPopup.jsp?wrkr_no=2913900208', 'communicationViewPopup', 'width=750, height=700;'); return false;" class="btn">사업자정보확인</a>
							</span>
						</li>
						<li>
							<span class="txt">소재지 : 경기도 고양시 일산동구 동국로 32 동국대학교 산학협력관 203호</span>
							<span class="txt">개인정보처리책임자: 천정훈 (cs@repickus.com)</span>
							<!-- <span class="txt">Hosting by 상상너머</span> -->
						</li>
						<li class="copy">Copyright(c) dehuv All Rights Reserved.</li>
					</ul>
				</li>
				<li class="li pg">
					<!-- PG정보 -->
					<div class="pg_box">
						<div style="display:none;" class="inner">
							<div class="ic_pg"><img src="/images/pg_kg.jpg" alt=""></div>
							<div class="pc_txt">
								<a href="#none" onclick="window.open('https://mark.inicis.com/mark/escrow_popup.php?mid=', 'escrow_popup', 'width=565, height=683, scrollbars=no, left=200, top=50'); return false;" class="btn">구매안전 서비스<br>가입&nbsp;&nbsp;사실&nbsp;&nbsp;확인</a>
							</div>
						</div>

						<div class="tip">상품에 대하여 민원, 환불 등은 '디휴브' 에서<br> 처리하며 모든 책임은 디휴브'에 있습니다.<br>
							민원 담당자 연락처: 천정훈(성명) <br>1800-5528(유선 연락처)</div>
					</div>
				</li>
			</ul>

		</div>
	</div>
<?php } ?>
</div><!-- .wrapper -->

<div class="at-go">
	<div id="go-btn" class="go-btn">
		<span class="go-top cursor"><i class="fa fa-chevron-up"></i></span>
		<span class="go-bottom cursor"><i class="fa fa-chevron-down"></i></span>
	</div>
</div>
<style type="text/css">
	@media(max-width: 768px) {
		#btm_fixed_bar {
			position: fixed;
			background-color: #fff;
			z-index: 1;
			bottom: 0;
			left: 0;
			width: 100%;
			display: flex;
			flex-wrap: nowrap;
			flex-direction: row;
			justify-content: space-around;
		}

		#btm_fixed_bar li {
			width: 33%;
			overflow: hidden;
			margin: 0;
			text-align: center;
		}

		ul#btm_fixed_bar img {
			max-width: 80px;
		}

		ul#btm_fixed_bar li a p {
			margin-bottom: 15px;
		}
	}
</style>
<?php if ($member['mb_level'] == 0 || $member['mb_level'] == 10 || $member['mb_level'] == 8) { // 고객 
?>
	<!-- <ul class="mobile" id="btm_fixed_bar">
		<li>
			<a class="" href="https://repickus.com/bbs/page.php?hid=main_new">
				<img src="/img/homebtn.png">
				<p>홈</p>
			</a>
		</li>
		<li>
			<a class="" href="/estimate/estimate_register.php">
				<img src="/img/666666.png">
				<p>견적신청</p>
			</a>
		</li>
		<li>
			<a class="" href="/estimate/my_estimate_list.php">
				<img src="/img/111.png">
				<p>내견적현황</p>
			</a>
		</li>
		<li>
			<a class="" href="/bbs/history_member.php">
				<img src="/img/10.png">
				<p>정산내역</p>
			</a>
		</li>
	</ul> -->
	<div class="fixbar">
			<div class="fixbar_flex">
				<a class="fixbar_btn" href="https://repickus.com/"><img src="../img/home_btn.png" alt=""><p>홈</p></a>
				<a class="fixbar_btn" href="https://repickus.com/estimate/my_estimate_list.php"><img src="../img/my_estimate_btn.png" alt=""><p>내신청현황</p></a>
				<a class="fixbar_btn" href="https://repickus.com/estimate/estimate_register.php"><img src="../img/register_btn.png" alt=""><p>견적신청</p></a>
				<a style="display:none !important;" class="fixbar_btn" href="https://repickus.com/market"><img src="../img/market_btn.png" alt=""><p>마켓</p></a>
				<a class="fixbar_btn" href="https://repickus.com/bbs/mypage.php"><img src="../img/mypage_btn.png" alt=""><p>마이페이지</p></a>
			</div>
		</div>
<?php } ?>
<?php if ($member['mb_level'] == 2) { //업체 
?>
	<div class="fixbar">
			<div class="fixbar_flex">
				<a class="fixbar_btn" href="https://repickus.com/estimate/estimate_list2.php"><img src="../img/list_btn.png" alt=""><p>견적리스트</p></a>
				<a class="fixbar_btn" href="https://repickus.com/estimate/partner_estimate_list.php"><img src="../img/estimate_btn.png" alt=""><p>내견적현황</p></a>
				<a class="fixbar_btn" href="https://repickus.com/market/seller/product/product_add.php"><img src="../img/register_btn.png" alt=""><p>물품등록</p></a>
				<!-- <a class="fixbar_btn" href="https://repickus.com/market/seller/product/product_list.php"><img src="../img/market_btn.png" alt=""><p>판매자센터</p></a> -->
				<a class="fixbar_btn" href="https://repickus.com/bbs/mypage_btn.php"><img src="../img/mypage_btn.png" alt=""><p>마이페이지</p></a>
			</div>
		</div>
<?php } ?>


<script>
	(function() {
		var w = window;
		if (w.ChannelIO) {
			return (window.console.error || window.console.log || function() {})('ChannelIO script included twice.');
		}
		var d = window.document;
		var ch = function() {
			ch.c(arguments);
		};
		ch.q = [];
		ch.c = function(args) {
			ch.q.push(args);
		};
		w.ChannelIO = ch;

		function l() {
			if (w.ChannelIOInitialized) {
				return;
			}
			w.ChannelIOInitialized = true;
			var s = document.createElement('script');
			s.type = 'text/javascript';
			s.async = true;
			s.src = 'https://cdn.channel.io/plugin/ch-plugin-web.js';
			s.charset = 'UTF-8';
			var x = document.getElementsByTagName('script')[0];
			x.parentNode.insertBefore(s, x);
		}
		if (document.readyState === 'complete') {
			l();
		} else if (window.attachEvent) {
			window.attachEvent('onload', l);
		} else {
			window.addEventListener('DOMContentLoaded', l, false);
			window.addEventListener('load', l, false);
		}
	})();

	ChannelIO('boot', {
		"pluginKey": "72479109-3846-4884-9753-4b1ef825171c", //please fill with your plugin key
		"userId": "<?php echo $member['mb_name'] ?>", //fill with user id
		"profile": {
			"name": "<?php echo $member['mb_email'] ?>", //fill with user name
			"mobileNumber": "<?php echo $member['mb_hp'] ?>", //fill with user phone number
			"CUSTOM_VALUE_1": "", //any other custom meta data
			"CUSTOM_VALUE_2": ""
		}
	});
</script>
<script type="text/javascript">
	$(function() {
		$("input[type=email]").on("change keyup paste", function() {
			$(this).val($(this).val().replace(/\s+/g, ""));
		});
		$("#email").on("change keyup paste", function() {
			$(this).val($(this).val().replace(/\s+/g, ""));
		});

	});
</script>
<!-- NAVER SCRIPT -->
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
	if (!wcs_add) var wcs_add = {};
	wcs_add["wa"] = "s_4e5aa7de4638";
	if (!_nasa) var _nasa = {};
	wcs.inflow("repickus.com");
	wcs_do(_nasa);
</script>
<!-- NAVER SCRIPT END -->
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo THEMA_URL; ?>/assets/js/respond.js"></script>
<![endif]-->

<!-- JavaScript -->
<script>
	var sub_show = "<?php echo $at_set['subv']; ?>";
	var sub_hide = "<?php echo $at_set['subh']; ?>";
	var menu_startAt = "<?php echo ($m_sat) ? $m_sat : 0; ?>";
	var menu_sub = "<?php echo $m_sub; ?>";
	var menu_subAt = "<?php echo ($m_subsat) ? $m_subsat : 0; ?>";
</script>
<script type="text/javascript">
	$('.list-wrap .item-price b').after('<span class="won">원</span>');
	$('.list-wrap .item-price b').before('<span class="state">중고상품</span>');
	if (window.location.pathname == '/') {
		$('.at-body .at-container').css('padding', '0');
	}
</script>
<!-- <script src="<?php echo THEMA_URL; ?>/assets/bs3/js/bootstrap.min.js"></script> -->
<script src="<?php echo THEMA_URL; ?>/assets/js/sly.min.js"></script>
<script src="<?php echo THEMA_URL; ?>/assets/js/custom.js"></script>
<?php if ($is_sticky_nav) { ?>
	<script src="<?php echo THEMA_URL; ?>/assets/js/sticky.js"></script>
<?php } ?>

<?php echo apms_widget('basic-sidebar'); //사이드바 및 모바일 메뉴(UI) 
?>

<?php if ($is_designer || $is_demo) include_once(THEMA_PATH . '/assets/switcher.php'); //Style Switcher 
?>

<style>
	/*픽스바*/
@media(max-width:1100px){
.fixbar{
	border-top: 1px solid #ddd !important;
	border-top-left-radius: 30px !important;
	border-top-right-radius: 30px !important;
	position:fixed !important;  
  	left:0px !important; 
  	bottom:0px !important; 
 	height:10% !important; 
 	width:100% !important; 
 	background:#fff !important;
  	color: #6e6e6e !important;  
	display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    z-index: 1 !important;
}
.fixbar_flex{
	display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    justify-content: space-evenly !important;
    align-items: center !important;
    width: 100% !important;
	align-items: center !important;
}

.fixbar_btn{
	display: flex !important;
	flex-direction: column !important;
	align-items: center !important;
    text-align: center !important;
}

.fixbar_btn > p{
    font-size: 9pt !important;
    margin: 0 auto !important;
}

.fixbar_btn > img{
	width: 19px;
}
}

@media(min-width:1101px){
	.fixbar{ 
		display:none !important;
	}
}
/*픽스바끝*/
</style>
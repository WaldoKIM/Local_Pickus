<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>
		<?php if($col_name) { ?>
			<?php if($col_name == "two") { ?>
					</div>
					<div class="col-md-<?php echo $col_side;?><?php echo ($at_set['side']) ? ' pull-left' : '';?> at-col at-side">
						<?php include_once($is_side_file); // Side ?>
					</div>
				</div>
			<?php } else { ?>
				</div><!-- .at-content -->
			<?php } ?>
			</div><!-- .at-container -->
		<?php } ?>
	</div><!-- .at-body -->

	<?php if(!$is_main_footer) { ?>
		<div class="footer if_main">
	<!-- 푸터메뉴 -->
	<div class="bottom_menu">
		<div class="layout_fix">
			<div class="left_menu">
				<ul>
					<!-- 						<li><a href="/?pn=member.login.form&_rurl=%2F%3F" class="btn">로그인</a></li>
						<li><a href="/?pn=member.join.agree" class="btn">회원가입</a></li>
										<li><a href="/?pn=service.guest.order.list" class="btn">주문조회</a></li> -->

					<li><a href="/bbs/content.php?co_id=company" class="btn">회사소개</a></li>
					<li><a href="/bbs/content.php?co_id=guide" class="btn">이용안내</a></li>
					<li><a href="/bbs/content.php?co_id=provision" class="btn">이용약관</a></li>
					<li><a href="/bbs/content.php?co_id=privacy" class="btn">개인정보처리방침</a></li>
					<li><a href="/bbs/content.php?co_id=deny" class="btn">이메일무단수집거부</a></li>
				</ul>
			</div>

			<!-- sns -->
							<div class="sns_box">
					<ul>
						<!-- 관리자에서 sns링크 걸어둘 경우 노출 /  링크 없으면 li 삭제 -->
													<li><a href="https://www.instagram.com/" class="sns" title="인스타그램" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/b_insta.png" alt="인스타그램"></a></li>
																			<li><a href="https://www.facebook.com/" class="sns" title="페이스북" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/b_face.png" alt="페이스북"></a></li>
																			<li><a href="https://twitter.com" class="sns" title="트위터" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/b_twitt.png" alt="트위터"></a></li>
																			<li><a href="http://blog.naver.com/" class="sns" title="블로그" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/b_blog.png" alt="블로그"></a></li>
																			<li><a href="http://cafe.naver.com/" class="sns" title="카페" target="_blank"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/skin/b_cafe.png" alt="블로그"></a></li>
																													</ul>
				</div>
					</div>
	</div>


	<div class="layout_fix">
		<ul class="copyright">
			<li class="li info">
				<!-- 회사/사이트 정보 -->
				<ul class="info_box">
					<li>
						<div class="logo_box">
							<dl>
																								<dt>
																											<img src="//dehuv.onedaynet.co.kr/upfiles/banner/928194268.png" alt="">
																										</dt>
																<dd><div class="shop_name">피커스몰</div></dd>
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
								사업자 등록번호: 291-39-00208								<a href="#none" onclick="window.open('http://www.ftc.go.kr/info/bizinfo/communicationViewPopup.jsp?wrkr_no=2913900208', 'communicationViewPopup', 'width=750, height=700;'); return false;" class="btn">사업자정보확인</a>
							</span>
						</li>
										<li>
						<span class="txt">소재지 : 경기도 고양시 일산동구 동국로 32 동국대학교 산학협력관 123호</span>
						<span class="txt">개인정보처리책임자: 천정훈  (cs@repickus.com)</span>
						<!-- <span class="txt">Hosting by 상상너머</span> -->
					</li>
					<li class="copy">Copyright(c) dehuv.onedaynet.co.kr. All Rights Reserved.</li>
				</ul>
			</li>
							<li class="li pg">
					<!-- PG정보 -->
					<div class="pg_box">
						<div class="inner">
															<div class="ic_pg"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/pg_img/pg_kg.jpg" alt=""></div>
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

<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/respond.js"></script>
<![endif]-->

<!-- JavaScript -->
<script>
var sub_show = "<?php echo $at_set['subv'];?>";
var sub_hide = "<?php echo $at_set['subh'];?>";
var menu_startAt = "<?php echo ($m_sat) ? $m_sat : 0;?>";
var menu_sub = "<?php echo $m_sub;?>";
var menu_subAt = "<?php echo ($m_subsat) ? $m_subsat : 0;?>";
</script>
<script src="<?php echo THEMA_URL;?>/assets/bs3/js/bootstrap.min.js"></script>
<script src="<?php echo THEMA_URL;?>/assets/js/sly.min.js"></script>
<script src="<?php echo THEMA_URL;?>/assets/js/custom.js"></script>
<?php if($is_sticky_nav) { ?>
<script src="<?php echo THEMA_URL;?>/assets/js/sticky.js"></script>
<?php } ?>

<?php echo apms_widget('basic-sidebar'); //사이드바 및 모바일 메뉴(UI) ?>

<?php if($is_designer || $is_demo) include_once(THEMA_PATH.'/assets/switcher.php'); //Style Switcher ?>
